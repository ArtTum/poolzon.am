<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Lang;
use App\Models\Slider;
use App\Models\SliderLang;
use Illuminate\Http\Request;

class SlidersController extends Controller
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
        $displayQuantity = $request->get('pageCount');
        $offset = ($page * $displayQuantity) - $displayQuantity;

        $query = Slider::select('sliders.id', 'url', 'order_number', 'slider_status', 'slider_name', 'slider_image')
            ->join('sliders_has_lang', 'sliders_has_lang.slider_id', 'sliders.id')
            ->where('sliders_has_lang.lang_id', Lang::LANG_RU);

        if (!empty($searchWord)) {
            $query->where('sliders_has_lang.slider_name', 'LIKE', "%{$searchWord}%");
        }

        $count = $query->count();

        $pageSort = $sorting ? 'desc' : 'asc';

        if (ceil($count / $displayQuantity) > 0) {
            $paginateCount = ceil($count / $displayQuantity);
        } else {
            $paginateCount = 1;
        }

        $sliders = $query
            ->offset($offset)
            ->limit($displayQuantity)
            ->orderBy('sliders.id', $pageSort)
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'sliders' => $sliders,
            'displaying' => $sliders->count(),
        ];
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $sliderStatus = Slider::select('slider_status')
            ->where('id', $id)
            ->first();

        Slider::where('id', $id)
            ->update([
                'slider_status' => !$sliderStatus->slider_status
            ]);
    }

    /**
     * @param SliderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SliderRequest $request)
    {
        $file = $request->file('slider_image');

        if ($file) {
            $path = public_path('/uploads/sliders');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        $slider = Slider::create([
            'url' => $request->get('slider_url'),
            'slider_image' => $name ?? null
        ]);

        $langs = Lang::all();
        foreach ($langs as $lang) {
            SliderLang::create([
                'lang_id' => $lang->id,
                'slider_id' => $slider->id,
                'slider_name' => $request->get('slider_name_' . $lang->iso),
                'slider_description' => $request->get('slider_desc_' . $lang->iso),
                'slider_button' => $request->get('slider_button_' . $lang->iso),
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
        $sliderForm = Slider::select('id', 'url', 'slider_image')
            ->where('id', $id)
            ->with(['getSliderLang' => function ($q) {
                $q->select('slider_id', 'slider_description', 'slider_button', 'slider_name');
            }])
            ->first();

        return ['sliderForm' => $sliderForm];
    }

    /**
     * @param SliderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SliderRequest $request)
    {
        $id = $request->get('id');
        $query = Slider::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $file = $request->file('slider_image');

        if ($file) {
            $path = public_path('/uploads/sliders');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);

            $query->slider_image = $name ?? null;
        }
        $query->url = $request->get('slider_url');
        $query->save();
        $langs = Lang::all();
        foreach ($langs as $lang) {
            SliderLang::where('slider_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'slider_name' => $request->get('slider_name_' . $lang->iso),
                    'slider_description' => $request->get('slider_desc_' . $lang->iso),
                    'slider_button' => $request->get('slider_button_' . $lang->iso),
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
        $model = Slider::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }
}
