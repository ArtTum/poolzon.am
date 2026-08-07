<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\TypeRequest;
use App\Models\Color;
use App\Models\Lang;
use App\Models\Slider;
use App\Models\Type;
use App\Models\TypeLang;
use Illuminate\Http\Request;

class TypesController extends Controller
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
                $model = Type::find($sort['id']);
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

        $query = Type::select('id', 'order_number', 'type_status')
            ->with(['lang' => function ($q) {
                $q->select('type_id', 'lang_id', 'type_name');
            }]);

        if (!empty($searchWord)) {
            $query->orWhereHas('lang', function ($query) use ($searchWord) {
                $query->where('type_name', 'like', '%' . $searchWord . '%');
            });
        }

        $count = $query->count();

        if (ceil($count / $display_quantity) > 0) {
            $paginateCount = ceil($count / $display_quantity);
        } else {
            $paginateCount = 1;
        }

        $types = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('order_number')
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'types' => $types,
            'displaying' => $types->count(),
        ];
    }

    /**
     * @param TypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TypeRequest $request)
    {
        $type = Type::create(['type_status' => 0]);
        $langs = Lang::all();
        foreach ($langs as $lang) {
            TypeLang::create([
                'lang_id' => $lang->id,
                'type_id' => $type->id,
                'type_name' => $request->get('type_name_' . $lang->iso),
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
        $typeForm = Type::select('id')
            ->where('id', $id)
            ->with(['lang' => function ($q) {
                $q->select('type_id', 'type_name');
            }])
            ->first();

        return ['typeForm' => $typeForm];
    }

    /**
     * @param TypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TypeRequest $request)
    {
        $id = $request->get('id');
        $query = Type::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $langs = Lang::all();
        foreach ($langs as $lang) {
            TypeLang::where('type_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'type_name' => $request->get('type_name_' . $lang->iso),
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
        $model = Type::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $typeStatus = Type::select('type_status')
            ->where('id', $id)
            ->first();

        Type::where('id', $id)
            ->update([
                'type_status' => !$typeStatus->type_status
            ]);
    }
}
