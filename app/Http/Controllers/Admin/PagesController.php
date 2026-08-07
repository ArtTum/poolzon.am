<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\PageLang;
use App\Models\Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
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
     * @return array
     */
    public function filter(Request $request)
    {
        $sorting = $request->get('sorting');
        $searchWord = $request->get('searchWord');
        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity) - $display_quantity;

        $query = Page::select('pages.id', 'alias', 'page_status', 'page_name', 'meta_title', 'meta_keys', 'meta_description')
            ->join('pages_has_lang', 'pages_has_lang.page_id', 'pages.id')
            ->where('pages_has_lang.lang_id', Lang::LANG_RU);

        if (!empty($searchWord)) {
            $query->where(function ($q) use ($searchWord) {
                $q->where('pages_has_lang.page_name', 'LIKE', "%{$searchWord}%")
                    ->orWhere('pages_has_lang.meta_title', 'LIKE', "%{$searchWord}%")
                    ->orWhere('pages_has_lang.meta_description', 'LIKE', "%{$searchWord}%")
                    ->orWhere('pages.alias', 'LIKE', "%{$searchWord}%")
                    ->orWhere('pages_has_lang.meta_keys', 'LIKE', "%{$searchWord}%");

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

        $pages = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('pages.id', $pageSort)
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'pages' => $pages,
            'displaying' => $pages->count(),
        ];
    }

    /**
     * @param PageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PageRequest $request)
    {
        $query = Page::create(['alias' => $request->get('page_alias')]);
        $langs = Lang::all();
        foreach ($langs as $lang) {
            PageLang::create([
                'lang_id' => $lang->id,
                'page_id' => $query->id,
                'page_name' => $request->get('page_name_' . $lang->iso),
                'page_description' => $request->get('page_desc_' . $lang->iso),
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
        $pageForm = Page::select('id', 'alias', 'page_status')
            ->where('id', $id)
            ->with(['lang' => function ($q) {
                $q->select('page_id', 'page_name', 'page_description', 'meta_title', 'meta_keys', 'meta_description', 'lang_id');
            }])
            ->first();

        return ['pageForm' => $pageForm];
    }

    /**
     * @param $id
     * @param PageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PageRequest $request)
    {
        $id = $request->get('id');
        $query = Page::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }
        $query->alias = $request->get('page_alias');
        $query->save();
        $langs = Lang::all();
        foreach ($langs as $lang) {
            PageLang::where('page_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'page_name' => $request->get('page_name_' . $lang->iso),
                    'page_description' => $request->get('page_desc_' . $lang->iso),
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
        $model = Page::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $pageStatus = Page::select('page_status')
            ->where('id', $id)
            ->first();

        Page::where('id', $id)
            ->update([
                'page_status' => !$pageStatus->page_status
            ]);
    }
}
