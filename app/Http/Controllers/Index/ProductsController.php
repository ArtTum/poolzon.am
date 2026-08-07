<?php

namespace App\Http\Controllers\Index;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OurProject;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class ProductsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product(Request $request, $locale = 'am', $alias = '')
    {
        $availableLocales = ['am', 'ru'];
        $lang = in_array($locale, $availableLocales) ? $locale : 'am';

        App::setLocale($lang);

        if ($lang == 'am'){
            $alias = $locale;
        }
        $product = Product::where('alias', $alias)->with(['colorshas'])->first();
        $bestsellers = Product::where('bestseller', 1)->limit(15)->inRandomOrder()->get();
        $categoryProducts = Product::where('category_id', $product->category_id)->limit(15)->inRandomOrder()->get();

        if (empty($product)){
            abort(404);
        }

        $favorites = $request->session()->get('favorites');

        return view('pages.product-view', [
            'categoryProducts' => $categoryProducts,
            'bestsellers' => $bestsellers,
            'product' => $product,
            'favorites' => $favorites,
        ]);
    }

    /**
     * @param Request $request
     * @param string $locale
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catalog(Request $request, $locale = 'am', $alias = ''){
        $availableLocales = ['am', 'ru'];
        $lang = in_array($locale, $availableLocales) ? $locale : 'am';

        App::setLocale($lang);

        if ($lang == 'am'){
            $alias = $locale;
        }

        $sliders = Slider::where('slider_status', 1)->orderBy('order_number')->get();
        $brands = Brand::where('brand_status', 1)->orderBy('order_number')->get();
        $banners = Banner::where('banner_status', 1)->get();
        $category = Category::where('category_status', 1)->where('alias', $alias)->first();
        $query = Product::with(['colorshas']);

        if (empty($category)){
            abort(404);
        }else{
            $query->where('category_id', $category->id);
        }

        if ($request->sale) {
            $query->where('sale', '!=', 0);
        }

        if ($request->bestseller){
            $query->where('bestseller', 1);
        }

        if ($request->get('max-price')){
            $query->whereBetween('price', [$request->get('min-price'), $request->get('max-price')]);
        }

        $products = $query->orderBy('id', 'DESC')
            ->paginate(30);

        $favorites = $request->session()->get('favorites');
        $view = $request->ajax() ? 'pages.product' : 'pages.index';
        $categories = \App\Models\Category::where('category_status', 1)->orderBy('order_number')->get();
        return view($view, [
            'sliders' => $sliders,
            'brands' => $brands,
            'banners' => $banners,
            'products' => $products,
            'alias' => $alias,
            'category' => $category,
            'favorites' => $favorites,
            'categories' => $categories,
        ]);
    }


    /**
     * @param Request $request
     * @param string $locale
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brand(Request $request, $locale = 'am', $alias = ''){

        $availableLocales = ['am', 'ru'];
        $lang = in_array($locale, $availableLocales) ? $locale : 'am';

        App::setLocale($lang);

        if ($lang == 'am'){
            $alias = $locale;
        }

        $brand = Brand::where('alias', $alias)->first();
        $sliders = Slider::where('slider_status', 1)->orderBy('order_number')->get();
        $brands = Brand::where('brand_status', 1)->orderBy('order_number')->get();

        $banners = Banner::where('banner_status', 1)->get();
        $query = Product::with(['colorshas']);

        if (empty($brand)){
            abort(404);
        }else{
            $query->where('brand_id', $brand->id);
        }

        if ($request->sale) {
            $query->where('sale', '!=', 0);
        }

        if ($request->bestseller){
            $query->where('bestseller', 1);
        }

        if ($request->get('max-price')){
            $query->whereBetween('price', [$request->get('min-price'), $request->get('max-price')]);
        }

        $products = $query->orderBy('id', 'DESC')
            ->paginate(30);

        $favorites = $request->session()->get('favorites');
        $view = $request->ajax() ? 'pages.product' : 'pages.index';
        $categories = \App\Models\Category::where('category_status', 1)->orderBy('order_number')->get();
        return view($view, [
            'sliders' => $sliders,
            'brands' => $brands,
            'banners' => $banners,
            'products' => $products,
            'alias' => $alias,
            'category' => null,
            'favorites' => $favorites,
            'categories' => $categories,
        ]);
    }


    /**
     * @param Request $request
     * @param string $locale
     * @param string $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request, $locale = 'am'){

        $availableLocales = ['am', 'ru'];
        $lang = in_array($locale, $availableLocales) ? $locale : 'am';

        App::setLocale($lang);

        $sliders = Slider::where('slider_status', 1)->orderBy('order_number')->get();
        $brands = Brand::where('brand_status', 1)->orderBy('order_number')->get();

        $banners = Banner::where('banner_status', 1)->get();
        $query = Product::with(['colorshas']);
        $term = $request->q;
        if ($term){
            $query->whereHas('lang', function ($query) use ($term) {
                $query->where('product_name', 'like', '%'.$term.'%')
                    ->orWhere('description', 'like', '%'.$term.'%')
                    ->orWhere('alias', 'like', '%'.$term.'%');
            })->orWhere('price', 'like', '%'.$term.'%');
        }

        $products = $query->orderBy('id', 'DESC')
            ->paginate(30);
        $favorites = $request->session()->get('favorites');
        $categories = \App\Models\Category::where('category_status', 1)->orderBy('order_number')->get();
        return view('pages.index', [
            'sliders' => $sliders,
            'brands' => $brands,
            'banners' => $banners,
            'products' => $products,
            'alias' => null,
            'category' => null,
            'favorites' => $favorites,
            'categories' => $categories,
        ]);
    }

    public function ourProjects(Request $request, $locale = 'am')
    {

        $availableLocales = ['am', 'ru'];
        $lang = in_array($locale, $availableLocales) ? $locale : 'am';

        App::setLocale($lang);


        $category = Category::where('category_status', 1)->where('alias', 1712)->first();
        $sliders = Slider::where('slider_status', 1)->orderBy('order_number')->get();
        $brands = Brand::where('brand_status', 1)->orderBy('order_number')->get();
        $banners = Banner::where('banner_status', 1)->get();


        $ourProjects = OurProject::orderBy('id', 'DESC')->get();

        $favorites = $request->session()->get('favorites');
        $categories = \App\Models\Category::where('category_status', 1)->orderBy('order_number')->get();

        return view('pages.our-projects', [
            'sliders' => $sliders,
            'brands' => $brands,
            'banners' => $banners,
            'ourProjects' => $ourProjects,
            'alias' => null,
            'category' => $category,
            'favorites' => $favorites,
            'categories' => $categories,
        ]);
    }
}
