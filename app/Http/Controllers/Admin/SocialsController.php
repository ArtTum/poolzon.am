<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialsController extends Controller
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

        $query = Social::select('id', 'url', 'name', 'icon');
        $count = $query->count();

        if (ceil($count / $displayQuantity) > 0) {
            $paginateCount = ceil($count / $displayQuantity);
        } else {
            $paginateCount = 1;
        }

        $socials = $query
            ->offset($offset)
            ->limit($displayQuantity)
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'socials' => $socials,
            'displaying' => $socials->count(),
        ];
    }

    /**
     * @param SocialRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SocialRequest $request)
    {
        $file = $request->file('icon_image');

        if ($file) {
            $path = public_path('/uploads/socials');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        Social::create([
            'name' => $request->get('name'),
            'url' => $request->get('icon_url'),
            'icon' => $name ?? null
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
        $socialForm = Social::select('id', 'url', 'icon', 'name')
            ->where('id', $id)
            ->first();

        return ['socialForm' => $socialForm];
    }

    /**
     * @param SocialRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SocialRequest $request)
    {
        $id = $request->get('id');
        $query = Social::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $file = $request->file('icon_image');

        if ($file) {
            $path = public_path('/uploads/socials');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);

            $query->icon = $name ?? null;
        }
        $query->name = $request->get('name');
        $query->url = $request->get('icon_url');
        $query->save();

        return response()->json(['form' => 'success']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $model = Social::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }
}
