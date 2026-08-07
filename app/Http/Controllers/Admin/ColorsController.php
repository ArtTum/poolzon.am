<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Lang;
use App\Models\Color;
use App\Models\ColorLang;
use Illuminate\Http\Request;

class ColorsController extends Controller
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
                $model = Color::find($sort['id']);
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
        $searchWord = $request->get('searchWord');
        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity) - $display_quantity;

        $query = Color::select('id', 'order_number', 'color_status')
            ->with(['lang' => function ($q) {
                $q->select('color_id', 'lang_id', 'color_name');
            }]);

        if (!empty($searchWord)) {
            $query->orWhereHas('lang', function ($query) use ($searchWord) {
                $query->where('color_name', 'like', '%' . $searchWord . '%');
            });
        }

        $count = $query->count();

        if (ceil($count / $display_quantity) > 0) {
            $paginateCount = ceil($count / $display_quantity);
        } else {
            $paginateCount = 1;
        }

        $colors = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('order_number')
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'colors' => $colors,
            'displaying' => $colors->count(),
        ];
    }

    /**
     * @param ColorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ColorRequest $request)
    {
        $color = Color::create(['color_status' => 0]);
        $langs = Lang::all();
        foreach ($langs as $lang) {
            ColorLang::create([
                'lang_id' => $lang->id,
                'color_id' => $color->id,
                'color_name' => $request->get('color_name_' . $lang->iso),
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
        $colorForm = Color::select('id')
            ->where('id', $id)
            ->with(['lang' => function ($q) {
                $q->select('color_id', 'color_name');
            }])
            ->first();

        return ['colorForm' => $colorForm];
    }

    /**
     * @param ColorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ColorRequest $request)
    {
        $id = $request->get('id');
        $query = Color::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $langs = Lang::all();
        foreach ($langs as $lang) {
            ColorLang::where('color_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'color_name' => $request->get('color_name_' . $lang->iso),
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
        $model = Color::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $colorStatus = Color::select('color_status')
            ->where('id', $id)
            ->first();

        Color::where('id', $id)
            ->update([
                'color_status' => !$colorStatus->color_status
            ]);
    }
}
