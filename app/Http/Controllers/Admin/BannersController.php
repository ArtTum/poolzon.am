<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannersController extends Controller
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
        $page = $request->get('pageNum');
        $displayQuantity = $request->get('pageCount');
        $offset = ($page * $displayQuantity) - $displayQuantity;

        $query = Banner::select('id', 'banner_url', 'order_number', 'banner_image', 'banner_status');
        $count = $query->count();

        if (ceil($count / $displayQuantity) > 0) {
            $paginateCount = ceil($count / $displayQuantity);
        } else {
            $paginateCount = 1;
        }

        $banners = $query
            ->offset($offset)
            ->limit($displayQuantity)
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'banners' => $banners,
            'displaying' => $banners->count(),
        ];
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $bannerStatus = Banner::select('banner_status')
            ->where('id', $id)
            ->first();

        Banner::where('id', $id)
            ->update([
                'banner_status' => !$bannerStatus->banner_status
            ]);
    }

    /**
     * @param BannerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BannerRequest $request)
    {
        $file = $request->file('banner_image');

        if ($file) {
            $path = public_path('/uploads/banners');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        Banner::create([
            'banner_url' => $request->get('banner_url'),
            'banner_image' => $name ?? null
        ]);

        return response()->json(['success' => 'Done!']);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $bannerForm = Banner::select('id', 'banner_url', 'banner_image')
            ->where('id', $id)
            ->first();

        return ['bannerForm' => $bannerForm];
    }

    /**
     * @param BannerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BannerRequest $request)
    {
        $id = $request->get('id');
        $query = Banner::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $file = $request->file('banner_image');

        if ($file) {
            $path = public_path('/uploads/banners');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);

            $query->banner_image = $name ?? null;
        }
        $query->banner_url = $request->get('banner_url');
        $query->save();

        return response()->json(['form' => 'success']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $model = Banner::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }
}
