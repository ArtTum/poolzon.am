<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Appointment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductLang;
use App\Models\Lang;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
     * @return array
     */
    public function param()
    {

        $categories = Category::select('categories.id as id', 'categories_has_lang.category_name as category_name')
            ->leftJoin('categories_has_lang', 'categories_has_lang.category_id', 'categories.id')
            ->where('categories_has_lang.lang_id', 2)
            ->where('categories.category_status', 1)
            ->get()->toArray();

        $types = Type::select('types.id as id', 'types_has_lang.type_name as type_name')
            ->leftJoin('types_has_lang', 'types_has_lang.type_id', 'types.id')
            ->where('types_has_lang.lang_id', 2)
            ->where('types.type_status', 1)
            ->get()->toArray();

        $appointments = Appointment::select('appointments.id as id', 'appointments_has_lang.appointment_name as appointment_name')
            ->leftJoin('appointments_has_lang', 'appointments_has_lang.appointment_id', 'appointments.id')
            ->where('appointments_has_lang.lang_id', 2)
            ->where('appointments.appointment_status', 1)
            ->get()->toArray();

        $brands = Brand::select('brands.id as id', 'brands_has_lang.brand_name as brand_name')
            ->leftJoin('brands_has_lang', 'brands_has_lang.brand_id', 'brands.id')
            ->where('brands_has_lang.lang_id', 2)
            ->where('brands.brand_status', 1)
            ->get()->toArray();

        $colors = Color::select('colors.id as id', 'colors_has_lang.color_name as color_name')
            ->leftJoin('colors_has_lang', 'colors_has_lang.color_id', 'colors.id')
            ->where('colors_has_lang.lang_id', 2)
            ->where('colors.color_status', 1)
            ->get()->toArray();

        return [
            'categories' => $categories,
            'types' => $types,
            'appointment' => $appointments,
            'colors' => $colors,
            'brands' => $brands,
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function filter(Request $request)
    {
        $searchWord = $request->get('searchWord');
        $typeId = $request->get('typeId');
        $categoryId = $request->get('categoryId');
        $brandId = $request->get('brandId ');

        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity) - $display_quantity;

        $query = Product::select('products.id as id', 'products.price as price', 'products.product_image as product_image',
            'brands_has_lang.brand_name as brand_name', 'categories_has_lang.category_name as category_name', 'types_has_lang.type_name as type_name', 'products_has_lang.product_name as product_name')
            ->join('categories_has_lang', 'categories_has_lang.category_id', 'products.category_id')
            ->where('categories_has_lang.lang_id', 2)
            ->join('brands_has_lang', 'brands_has_lang.brand_id', 'products.brand_id')
            ->where('brands_has_lang.lang_id', 2)
            ->join('types_has_lang', 'types_has_lang.type_id', 'products.types_id')
            ->where('types_has_lang.lang_id', 2)
            ->join('products_has_lang', 'products_has_lang.product_id', 'products.id')
            ->where('products_has_lang.lang_id', 2);

        if (!empty($searchWord)) {
            $query->where(function ($q) use ($searchWord) {
                $q->orWhere('brands_has_lang.brand_name', 'like', '%' . $searchWord . '%')
                    ->orWhere('types_has_lang.type_name', 'like', '%' . $searchWord . '%')
                    ->orWhere('categories_has_lang.category_name', 'like', '%' . $searchWord . '%')
                    ->orWhere('products_has_lang.product_name', 'like', '%' . $searchWord . '%');
            });
        }

        if ($typeId) {
            $query->where('products.types_id', $typeId);
        }

        if ($categoryId) {
            $query->where('products.category_id', $categoryId);
        }

        if ($brandId) {
            $query->where('products.brand_id', $brandId);
        }


        $count = $query->count();


        if (ceil($count / $display_quantity) > 0) {
            $paginateCount = ceil($count / $display_quantity);
        } else {
            $paginateCount = 1;
        }

        $products = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('products.id', $sortNumber ?? 'desc')
            ->get();

        echo json_encode([
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'products' => json_decode($products, true),
            'displaying' => $products->count(),
        ], true);
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $colors = json_decode($request->get('colors'));
        $file = $request->file('product_image');

        if ($file) {
            $path = public_path('/uploads/products');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }


        $model = Product::create([
            'types_id' => $request->get('product_type_id'),
            'category_id' => $request->get('product_category_id'),
            'brand_id' => $request->get('product_brand_id'),
            'appointment_id' => $request->get('product_appointment_id'),
            'bestseller' => $request->get('best_seller') == "true" ? 1 : 0,
            'sale' => $request->get('sale'),
            'price' => $request->get('price'),
            'product_code' => $request->get('product_code'),
            'alias' => $request->get('alias'),
            'number_mounting_holes' => $request->get('number_mounting_holes'),
            'product_count' => $request->get('product_count'),
            'product_image' => $name ?? null
        ]);

        $langs = Lang::all();
        foreach ($langs as $lang) {
            ProductLang::create([
                'lang_id' => $lang->id,
                'product_id' => $model->id,
                'product_name' => $request->get('product_name_' . $lang->iso),
                'description' => $request->get('product_desc_' . $lang->iso),
                'advantages' => $request->get('product_advantages_' . $lang->iso),
                'meta_keys' => $request->get('meta_keywords_' . $lang->iso),
                'meta_description' => $request->get('meta_desc_' . $lang->iso),
                'meta_title' => $request->get('meta_title_' . $lang->iso),
            ]);
        }

        foreach ($colors as $color) {
            ProductColor::create([
                'products_id' => $model->id,
                'color_id' => $color->id,
            ]);
        }

        return response()->json(['success' => 'Done!']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $model = Product::select('*')
            ->where('id', $id)
            ->with(['lang', 'colors' => function ($q) {
                $q->select('color_id', 'products_id');
            }])
            ->join('categories_has_lang', 'categories_has_lang.category_id', 'products.category_id')
            ->where('categories_has_lang.lang_id', 2)
            ->join('brands_has_lang', 'brands_has_lang.brand_id', 'products.brand_id')
            ->where('brands_has_lang.lang_id', 2)
            ->join('types_has_lang', 'types_has_lang.type_id', 'products.types_id')
            ->where('types_has_lang.lang_id', 2)
            ->first();

        $colors = Color::select('colors.id', 'colors_has_lang.color_name')->whereIn('id', $model->colors->pluck('color_id'))
            ->join('colors_has_lang', 'colors_has_lang.color_id', 'colors.id')
            ->where('colors_has_lang.lang_id', 2)->get();


        if (!empty($model)) {
            return response()->json(['form' => $model, 'colors' => $colors]);
        } else {
            return response()->json(['form' => '', 'error' => '404']);
        }

    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request)
    {
        $colors = json_decode($request->get('colors'));
        $file = $request->file('product_image');

        if ($file) {
            $path = public_path('/uploads/products');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $name = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $name);
        }

        $product = Product::find($request->get('product_id'));

        Product::where('id', $request->get('product_id'))
            ->update([
                'types_id' => $request->get('product_type_id'),
                'category_id' => $request->get('product_category_id'),
                'brand_id' => $request->get('product_brand_id'),
                'appointment_id' => $request->get('product_appointment_id'),
                'bestseller' => $request->get('best_seller') == "true" ? 1 : 0,
                'sale' => $request->get('sale'),
                'price' => $request->get('price'),
                'product_code' => $request->get('product_code'),
                'alias' => $request->get('alias'),
                'number_mounting_holes' => $request->get('number_mounting_holes'),
                'product_count' => $request->get('product_count'),
                'product_image' => $name ?? $product->product_image
            ]);

        $langs = Lang::all();
        foreach ($langs as $lang) {
            ProductLang::where('product_id', $request->get('product_id'))
                ->where('lang_id', $lang->id)
                ->update([
                    'product_name' => $request->get('product_name_' . $lang->iso),
                    'description' => str_replace('null', '', $request->get('product_desc_' . $lang->iso)),
                    'advantages' => str_replace('null', '', $request->get('product_advantages_' . $lang->iso)),
                    'meta_keys' => str_replace('null', '', $request->get('meta_keywords_' . $lang->iso)),
                    'meta_description' => str_replace('null', '', $request->get('meta_desc_' . $lang->iso)),
                    'meta_title' => str_replace('null', '', $request->get('meta_title_' . $lang->iso)),
                ]);
        }

        ProductColor::where('products_id', $request->get('product_id'))
            ->delete();

        foreach ($colors as $color) {
            ProductColor::create([
                'products_id' => $request->get('product_id'),
                'color_id' => $color->id,
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
        $model = Product::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }
}
