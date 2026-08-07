<?php

namespace App\Http\Controllers\Index;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @param string $lang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $lang = 'am')
    {
        App::setLocale($lang);

        $sliders = Slider::where('slider_status', 1)->orderBy('order_number')->get();
        $brands = Brand::where('brand_status', 1)->orderBy('order_number')->get();
        $banners = Banner::where('banner_status', 1)->get();
        $query = Product::with(['colorshas'])->orderBy('id', 'DESC');

        if ($request->sale) {
            $query->where('sale', '!=', 0);
        }

        if ($request->bestseller) {
            $query->where('bestseller', 1);
        }

        if ($request->get('max-price')) {
            $query->whereBetween('price', [$request->get('min-price'), $request->get('max-price')]);
        }

        $products = $query->paginate(30);

        $favorites = $request->session()->get('favorites');

        $view = $request->ajax() ? 'pages.product' : 'pages.index';
        $categories = \App\Models\Category::where('category_status', 1)->orderBy('order_number')->get();

        return view($view, [
            'favorites' => $favorites,
            'sliders' => $sliders,
            'brands' => $brands,
            'banners' => $banners,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function page($locale = 'am', $alias = '')
    {
        $availableLocales = ['am', 'ru'];
        $lang = in_array($locale, $availableLocales) ? $locale : 'am';

        App::setLocale($lang);

        if ($lang == 'am') {
            $alias = $locale;
        }
        $page = Page::where('alias', $alias)->first();

        if (empty($page)) {
            abort(404);
        }

        return view('pages.simple', [
            'page' => $page,
        ]);
    }
}
