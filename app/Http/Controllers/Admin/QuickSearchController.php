<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\QuickSearchRequest;
use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\Lang;
use App\Models\Page;
use App\Models\QuickSearch;
use App\Models\QuickSearchLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class QuickSearchController extends Controller
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
    public function filter(Request $request){

        $searchWord = $request->get('searchWord');
        $sortNumber = $request->get('sort_number');
        $statusID = $request->get('statusID');

        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity)-$display_quantity;
        $quick = QuickSearch::where('id', $statusID)->first();
        if (!empty($quick)){
            $quick->is_hidden = $quick->is_hidden ? 0 : 1;
            $quick->save();
        }


        $query =  QuickSearch::select('quick_search.id as id', 'quick_search.is_hidden as hidden')
            ->with('lang');

        if (!empty($searchWord)){
            $query->leftJoin('quick_search_lang', 'quick_search_lang.quick_search_id', 'quick_search.id')
                ->where('quick_search_lang.quick_search_name','LIKE', "%{$searchWord}%" );
        }


        $count = $query->count();

        if (ceil($count / $display_quantity) > 0) {
            $paginateCount = ceil($count / $display_quantity);
        } else {
            $paginateCount = 1;
        }

        $quickSearch = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('quick_search.id', $sortNumber ?? 'asc')
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'quickSearch' => json_decode($quickSearch, true),
            'displaying' => $quickSearch->count(),
        ];
    }


    /**
     * @param QuickSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(QuickSearchRequest $request)
    {

        $model = QuickSearch::create(['is_hidden' => 0]);
        $langs = Lang::all();
        foreach ($langs as $lang){
            QuickSearchLang::create([
                'lang_id' => $lang->id,
                'quick_search_id'=> $model->id,
                'quick_search_name'=> $request->get('quick_search_name_'.$lang->iso),
                'quick_search_alias'=> $request->get('quick_search_alias_'.$lang->iso),
            ]);
        }

        return response()->json(['success'=>'Done!']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $model = QuickSearch::where('id', $id)->with('lang')->first();

        if (!empty($model)){
            return response()->json(['form' => $model]);
        }else{
            return response()->json(['form' => '','error' => '404']);
        }

    }


    /**
     * @param $id
     * @param QuickSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, QuickSearchRequest $request)
    {
        $model = QuickSearch::find($id);

        if (empty($model)){
            return response()->json(['form' => null,'error' => '404']);
        }

        $langs = Lang::all();
        $this->removeLang($id);

        foreach ($langs as $lang){
            QuickSearchLang::create([
                'lang_id' => $lang->id,
                'quick_search_id'=> $model->id,
                'quick_search_name'=> $request->get('quick_search_name_'.$lang->iso),
                'quick_search_alias'=> $request->get('quick_search_alias_'.$lang->iso),
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
        $model = QuickSearch::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param $id
     */
    public function removeLang($id){
        QuickSearchLang::where('quick_search_id', $id)->delete();
    }
}
