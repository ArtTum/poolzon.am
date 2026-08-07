<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 7/14/2016
 * Time: 4:12 PM
 */

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yii;


class FavoritesController extends Controller
{

    /**
     * @return string
     */
    public function index(Request $request, $lang = 'am')
    {
        App::setLocale($lang);
        $item = $request->session()->get('favorites') ? $request->session()->get('favorites') : [];

        $products = Product::whereIn('id', $item)->paginate(12);
        $products->withPath(url()->full());

        return view('favorites.index', [
            'products' => $products,
        ]);
    }


    /**
     * @param Request $request
     */
    public function add(Request $request)
    {
        $id = $request->get('id');

        if ($request->session()->has('favorites')) {
            $item = $request->session()->get('favorites');
            $item[$id] = $id;
        } else {
            $item = [];
            $item[$id] = $id;
        }

        $request->session()->put('favorites', $item);

        echo json_encode([
            'total_count' => count($item),
        ]);

    }


    public function remove(Request $request)
    {

        $id = $request->get('id');


        if ($request->session()->has('favorites')) {
            $item = $request->session()->get('favorites');
            $indexSpam = array_search($id, $item);
            unset($item[$indexSpam]);
        }

        $request->session()->put('favorites', $item);


        echo json_encode([
            'total_count' => count($item),
            'id' => $id,
        ]);
    }


}
