<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdBlockRequest;
use App\Models\AdBlocks;
use App\Models\Page;
use App\Post;
use Illuminate\Http\Request;

class AdBlocksController extends Controller
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

    public function index(Request $request)
    {

        $statusID = $request->get('statusID');
        $ad = AdBlocks::find($statusID);

        if (!empty($ad)){
            $ad->is_hidden = $ad->is_hidden ? 0 : 1;
            $ad->save();
        }

        return AdBlocks::select('*', 'is_hidden as hidden')->get();
    }



    public function edit($id)
    {
        $post = AdBlocks::find($id);
        return response()->json($post);
    }

    public function update($id, AdBlockRequest $request)
    {
        $post = AdBlocks::find($id);
        $post->update($request->all());

        return ['success' => 'successfully updated'];
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        return response()->json('successfully deleted');
    }
}
