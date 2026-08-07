<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\QuickSearchRequest;
use App\Http\Requests\TranslateRequest;
use App\Models\Category;
use App\Models\CategoryLang;
use App\Models\Lang;
use App\Models\Page;
use App\Models\QuickSearch;
use App\Models\QuickSearchLang;
use App\Models\Translate;
use App\Models\TranslateLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametersController extends Controller
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

        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity)-$display_quantity;


        $query =  Translate::select('translate.id as id', 'translate.key as key')
            ->with('lang');

        if (!empty($searchWord)){
            $query->leftJoin('translate_lang', 'translate_lang.translate_id', 'translate.id')
                ->where('translate_lang.text','LIKE', "%{$searchWord}%" );
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
            ->orderBy('translate.id', $sortNumber ?? 'asc')
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $model = Translate::where('id', $id)->with('lang')->first();

        if (!empty($model)){
            return response()->json(['form' => $model]);
        }else{
            return response()->json(['form' => '','error' => '404']);
        }

    }


    /**
     * @param $id
     * @param TranslateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, TranslateRequest $request)
    {
        $model = Translate::find($id);

        if (empty($model)){
            return response()->json(['form' => null,'error' => '404']);
        }

        $langs = Lang::all();
        $this->removeLang($id);

        foreach ($langs as $lang){
            TranslateLang::create([
                'lang_id' => $lang->id,
                'translate_id'=> $model->id,
                'text'=> $request->get('text_'.$lang->iso),
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
        $model = Translate::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param $id
     */
    public function removeLang($id){
        TranslateLang::where('translate_id', $id)->delete();
    }
}
