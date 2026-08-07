<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\BrandLang;
use App\Models\Category;
use App\Models\Lang;
use Illuminate\Http\Request;

class BrandsController extends Controller
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
                $model = Brand::find($sort['id']);
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

        $query = Brand::select('brands.id', 'alias', 'brand_status', 'brand_name', 'brand_image', 'meta_title', 'meta_keys', 'meta_description')
            ->join('brands_has_lang', 'brands_has_lang.brand_id', 'brands.id')
            ->where('brands_has_lang.lang_id', Lang::LANG_RU);

        if (!empty($searchWord)) {
            $query->where(function ($q) use ($searchWord) {
                $q->where('brands_has_lang.brand_name', 'LIKE', "%{$searchWord}%")
                    ->orWhere('brands_has_lang.meta_title', 'LIKE', "%{$searchWord}%")
                    ->orWhere('brands_has_lang.meta_description', 'LIKE', "%{$searchWord}%")
                    ->orWhere('brands.alias', 'LIKE', "%{$searchWord}%")
                    ->orWhere('brands_has_lang.meta_keys', 'LIKE', "%{$searchWord}%");

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

        $brands = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('order_number')
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'brands' => $brands,
            'displaying' => $brands->count(),
        ];
    }

    /**
     * @param BrandRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BrandRequest $request)
    {
        $file = $request->file('brand_image');

        if ($file) {
            $path = public_path('/uploads/brands');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        $query = Brand::create(['brand_image' => $name ?? null, 'alias' => $request->get('page_alias')]);
        $langs = Lang::all();
        foreach ($langs as $lang) {
            BrandLang::create([
                'lang_id' => $lang->id,
                'brand_id' => $query->id,
                'brand_name' => $request->get('brand_name_' . $lang->iso),
                'meta_title' => $request->get('meta_title_' . $lang->iso),
                'meta_keys' => $request->get('meta_keywords_' . $lang->iso),
                'meta_description' => $request->get('meta_desc_' . $lang->iso),
            ]);
        }

        return response()->json(['success' => 'Done!']);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $brandForm = Brand::select('id', 'alias', 'brand_status', 'brand_image')
            ->where('id', $id)
            ->with(['lang' => function ($q) {
                $q->select('brand_id', 'brand_name', 'meta_title', 'meta_keys', 'meta_description', 'lang_id');
            }])
            ->first();

        return ['brandForm' => $brandForm];
    }

    /**
     * @param $id
     * @param BrandRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BrandRequest $request)
    {
        $id = $request->get('id');
        $query = Brand::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $file = $request->file('brand_image');

        if ($file) {
            $path = public_path('/uploads/brands');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
            $query->brand_image = $name ?? null;
        }

        $query->alias = $request->get('page_alias');
        $query->save();
        $langs = Lang::all();
        foreach ($langs as $lang) {
            BrandLang::where('brand_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'brand_name' => $request->get('brand_name_' . $lang->iso),
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
        $model = Brand::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $brandStatus = Brand::select('brand_status')
            ->where('id', $id)
            ->first();

        Brand::where('id', $id)
            ->update([
                'brand_status' => !$brandStatus->brand_status
            ]);
    }
}
