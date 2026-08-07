<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OurProjectRequest;
use App\Models\Lang;
use App\Models\OurProject;
use App\Models\OurProjectLang;
use Illuminate\Http\Request;

class OurProjectsController extends Controller
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

        $query = OurProject::select('*') ->join('our_project_has_lang', 'our_project_has_lang.our_project_id', 'our_projects.id')
            ->where('our_project_has_lang.lang_id', Lang::LANG_RU);;
        $count = $query->count();

        if (ceil($count / $displayQuantity) > 0) {
            $paginateCount = ceil($count / $displayQuantity);
        } else {
            $paginateCount = 1;
        }

        $ourProjects = $query
            ->offset($offset)
            ->limit($displayQuantity)
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'ourProjects' => $ourProjects,
            'displaying' => $ourProjects->count(),
        ];
    }

    /**
     * @param OurProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OurProjectRequest $request)
    {
        $file = $request->file('image');

        if ($file) {
            $path = public_path('/uploads/our-projects');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        $query = OurProject::create([
            'title' => 'new',
            'image' => $name ?? null
        ]);

        $langs = Lang::all();
        foreach ($langs as $lang) {
            OurProjectLang::create([
                'lang_id' => $lang->id,
                'our_project_id' => $query->id,
                'our_project_name' => $request->get('our_project_name_' . $lang->iso),
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
        $ourProject = OurProject::where('id', $id)->with('lang')->first();

        return ['ourProject' => $ourProject];
    }

    /**
     * @param OurProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OurProjectRequest $request)
    {
        $id = $request->get('id');
        $query = OurProject::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $file = $request->file('image');

        if ($file) {
            $path = public_path('/uploads/our-projects');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);

            $query->image = $name ?? null;
        }
        $query->title = 'new';
        $query->save();

        $langs = Lang::all();

        foreach ($langs as $lang) {
            OurProjectLang::where('our_project_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'our_project_name' => $request->get('our_project_name_' . $lang->iso),
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
        $model = OurProject::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }
}
