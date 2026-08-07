<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\Color;
use App\Models\Lang;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     */
    public function sort(Request $request){
        if ($request->sort){
            foreach ($request->sort as $k => $sort){
                $model = Category::find($sort['id']);
                $model->order_number = $k;
                $model->save();
            }
        }

    }

    /**
     * @param Request $request
     * @return array
     */
    public function filter(Request $request)
    {
        $sorting = $request->get('sorting');
        $searchWord = $request->get('searchWord');
        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity) - $display_quantity;

        $query = Category::select('categories.id', 'alias', 'category_status', 'category_name', 'category_image', 'meta_title', 'meta_keys', 'meta_description')
            ->join('categories_has_lang', 'categories_has_lang.category_id', 'categories.id')
            ->where('categories_has_lang.lang_id', Lang::LANG_RU);

        if (!empty($searchWord)) {
            $query->where(function ($q) use ($searchWord) {
                $q->where('categories_has_lang.category_name', 'LIKE', "%{$searchWord}%")
                    ->orWhere('categories_has_lang.meta_title', 'LIKE', "%{$searchWord}%")
                    ->orWhere('categories_has_lang.meta_description', 'LIKE', "%{$searchWord}%")
                    ->orWhere('categories.alias', 'LIKE', "%{$searchWord}%")
                    ->orWhere('categories_has_lang.meta_keys', 'LIKE', "%{$searchWord}%");

                return $q;
            });
        }
        $count = $query->count();

        $pageSort = $sorting ? 'desc' : 'asc';

        if (ceil($count / $display_quantity) > 0) {
            $paginateCount = ceil($count / $display_quantity);
        } else {
            $paginateCount = 1;
        }

        $categories = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('categories.order_number')
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'categories' => $categories,
            'displaying' => $categories->count(),
        ];
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $file = $request->file('category_image');

        if ($file) {
            $path = public_path('/uploads/categories');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        $query = Category::create(['category_image' => $name ?? null, 'alias' => $request->get('page_alias')]);
        $langs = Lang::all();
        foreach ($langs as $lang) {
            CategoryLang::create([
                'lang_id' => $lang->id,
                'category_id' => $query->id,
                'category_name' => $request->get('category_name_' . $lang->iso),
                'meta_title' => $request->get('meta_title_' . $lang->iso),
                'meta_keys' => $request->get('meta_keywords_' . $lang->iso),
                'meta_description' => $request->get('meta_desc_' . $lang->iso),
            ]);
        }

        return response()->json(['success' => 'Done!']);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $categoryForm = Category::select('id', 'alias', 'category_status', 'category_image')
            ->where('id', $id)
            ->with(['lang' => function ($q) {
                $q->select('category_id', 'category_name', 'meta_title', 'meta_keys', 'meta_description', 'lang_id');
            }])
            ->first();

        return ['categoryForm' => $categoryForm];
    }

    /**
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request)
    {
        $id = $request->get('id');
        $query = Category::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $file = $request->file('category_image');

        if ($file) {
            $path = public_path('/uploads/categories');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
            $query->category_image = $name ?? null;
        }
        $query->alias = $request->get('page_alias');
        $query->save();
        $langs = Lang::all();
        foreach ($langs as $lang) {
            CategoryLang::where('category_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'category_name' => $request->get('category_name_' . $lang->iso),
                    'meta_keys' => $request->get('meta_keywords_' . $lang->iso),
                    'meta_description' => $request->get('meta_desc_' . $lang->iso),
                    'meta_title' => $request->get('meta_title_' . $lang->iso),
                ]);
        }
        return response()->json(['form' => 'success']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $model = Category::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $categoryStatus = Category::select('category_status')
            ->where('id', $id)
            ->first();

        Category::where('id', $id)
            ->update([
                'category_status' => !$categoryStatus->category_status
            ]);
    }
}
