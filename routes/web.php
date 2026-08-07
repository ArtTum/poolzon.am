<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['register' => false]);
Route::get('/vagart-cms', function () {
    if (Auth::guest()){
        return view('/auth/login');
    }else{
        return redirect('/vagart-cms/dashboard');
    }
});
Route::group(['middleware' => ['auth']], function (){
    /**ad-blocks**/
    Route::resource('/ad-blocks', 'Admin\AdBlocksController');
    /**sliders**/
    Route::post('/sliders', 'Admin\SlidersController@filter');
    Route::post('/change-slider-status', 'Admin\SlidersController@changeStatus');
    Route::post('/sliders-edit', 'Admin\SlidersController@edit');
    Route::post('/sliders-store', 'Admin\SlidersController@store');
    Route::post('/sliders-update', 'Admin\SlidersController@update');
    Route::delete('/sliders-delete/{id}', 'Admin\SlidersController@delete');
    /**banners**/
    Route::post('/banners', 'Admin\BannersController@filter');
    Route::post('/change-banner-status', 'Admin\BannersController@changeStatus');
    Route::post('/banners-edit', 'Admin\BannersController@edit');
    Route::post('/banners-store', 'Admin\BannersController@store');
    Route::post('/banners-update', 'Admin\BannersController@update');
    Route::delete('/banners-delete/{id}', 'Admin\BannersController@delete');
    /**socials**/
    Route::post('/socials', 'Admin\SocialsController@filter');
    Route::post('/socials-edit', 'Admin\SocialsController@edit');
    Route::post('/socials-store', 'Admin\SocialsController@store');
    Route::post('/socials-update', 'Admin\SocialsController@update');
    Route::delete('/socials-delete/{id}', 'Admin\SocialsController@delete');
    /**orders**/
    Route::post('/orders', 'Admin\OrdersController@index');
    Route::post('/orders-view', 'Admin\OrdersController@view');
    /**categories**/
    Route::post('/categories', 'Admin\CategoriesController@filter');
    Route::post('/change-category-status', 'Admin\CategoriesController@changeStatus');
    Route::post('/category-edit', 'Admin\CategoriesController@edit');
    Route::post('/categories-store', 'Admin\CategoriesController@store');
    Route::post('/categories-update', 'Admin\CategoriesController@update');
    Route::post('/categories-sort', 'Admin\CategoriesController@sort');
    Route::delete('/categories-delete/{id}', 'Admin\CategoriesController@delete');
    /**pages**/
    Route::post('/pages', 'Admin\PagesController@filter');
    Route::post('/change-page-status', 'Admin\PagesController@changeStatus');
    Route::post('/page-edit', 'Admin\PagesController@edit');
    Route::post('/pages-store', 'Admin\PagesController@store');
    Route::post('/pages-update', 'Admin\PagesController@update');
    Route::delete('/pages-delete/{id}', 'Admin\PagesController@delete');
    /**brands**/
    Route::post('/brands', 'Admin\BrandsController@filter');
    Route::post('/change-brand-status', 'Admin\BrandsController@changeStatus');
    Route::post('/brand-edit', 'Admin\BrandsController@edit');
    Route::post('/brands-store', 'Admin\BrandsController@store');
    Route::post('/brands-update', 'Admin\BrandsController@update');
    Route::post('/brands-sort', 'Admin\BrandsController@sort');
    Route::delete('/brands-delete/{id}', 'Admin\BrandsController@delete');
    /**types**/
    Route::post('/types', 'Admin\TypesController@filter');
    Route::post('/types-edit', 'Admin\TypesController@edit');
    Route::post('/change-type-status', 'Admin\TypesController@changeStatus');
    Route::post('/types-store', 'Admin\TypesController@store');
    Route::post('/types-update', 'Admin\TypesController@update');
    Route::post('/types-sort', 'Admin\TypesController@sort');
    Route::delete('/types-delete/{id}', 'Admin\TypesController@delete');
    /**colors**/
    Route::get('/colors-list', 'Admin\ColorsController@colorsList');
    Route::post('/colors', 'Admin\ColorsController@filter');
    Route::post('/change-color-status', 'Admin\ColorsController@changeStatus');
    Route::post('/colors-edit', 'Admin\ColorsController@edit');
    Route::post('/colors-store', 'Admin\ColorsController@store');
    Route::post('/color-update', 'Admin\ColorsController@update');
    Route::post('/colors-sort', 'Admin\ColorsController@sort');
    Route::delete('/colors-delete/{id}', 'Admin\ColorsController@delete');
    /**appointment**/
    Route::get('/appointments-list', 'Admin\AppointmentsController@appointmentsList');
    Route::post('/appointments', 'Admin\AppointmentsController@filter');
    Route::post('/change-appointment-status', 'Admin\AppointmentsController@changeStatus');
    Route::post('/appointments-edit', 'Admin\AppointmentsController@edit');
    Route::post('/appointments-store', 'Admin\AppointmentsController@store');
    Route::post('/appointment-update', 'Admin\AppointmentsController@update');
    Route::post('/appointments-sort', 'Admin\AppointmentsController@sort');
    Route::delete('/appointments-delete/{id}', 'Admin\AppointmentsController@delete');
    /**products**/
    Route::post('/products-param', 'Admin\ProductsController@param');
    Route::post('/products', 'Admin\ProductsController@filter');
    Route::post('/products-edit/{id}', 'Admin\ProductsController@edit');
    Route::post('/products-store', 'Admin\ProductsController@store');
    Route::post('/products-update/{id}', 'Admin\ProductsController@update');
    Route::post('/products-sort', 'Admin\ProductsController@filter');
    Route::delete('/products-delete/{id}', 'Admin\ProductsController@delete');
    /**parameters**/
    Route::post('/parameters', 'Admin\ParametersController@filter');
    Route::post('/parameters-edit/{id}', 'Admin\ParametersController@edit');
    Route::post('/parameters-update/{id}', 'Admin\ParametersController@update');
    Route::post('/parameters-sort', 'Admin\ParametersController@filter');
    Route::delete('/parameters-delete/{id}', 'Admin\ParametersController@delete');
    /**our-projects**/
    Route::post('/our-projects', 'Admin\OurProjectsController@filter');
    Route::post('/our-projects-edit', 'Admin\OurProjectsController@edit');
    Route::post('/our-projects-store', 'Admin\OurProjectsController@store');
    Route::post('/our-projects-update', 'Admin\OurProjectsController@update');
    Route::post('/our-projects-sort', 'Admin\OurProjectsController@sort');
    Route::delete('/our-projects-delete/{id}', 'Admin\OurProjectsController@delete');
    /**any**/
    Route::get('/vagart-cms/{any}', 'Admin\HomeController@index')->where('any', '.*');
});
Route::get('/catalog/1712', 'Index\ProductsController@ourProjects');
Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::get('/order-info', 'CartController@orderInfo')->name('cart.orderInfo');
Route::get('/step-one', 'CartController@stepOne')->name('cart.stepOne');
Route::get('/step-two', 'CartController@stepTwo')->name('cart.stepTwo');
Route::get('/step-three', 'CartController@stepThree')->name('cart.stepThree');
Route::post('/add', 'CartController@add')->name('cart.store');
Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::post('/cart-remove-all', 'CartController@removeAll')->name('cart.remove-all');
Route::post('/clear', 'CartController@clear')->name('cart.clear');

Route::post('/favorites/add', 'FavoritesController@add')->name('favorites-add');
Route::post('/favorites/remove', 'FavoritesController@remove')->name('favorites-remove');
Route::get('/favorites', 'FavoritesController@index')->name('favorites');

Route::post('/order/{lang}', 'CartController@order')->name('order');
Route::post('order-one/{lang}', 'CartController@orderOne');
Route::post('order-two/{lang}', 'CartController@orderTwo');
Route::get('/page/{alias}', 'Index\HomeController@page');
Route::get('/product/{alias}', 'Index\ProductsController@product');
Route::get('/catalog/{alias}', 'Index\ProductsController@catalog');
Route::get('/search', 'Index\ProductsController@search');
Route::get('/catalog/brand/{alias}', 'Index\ProductsController@brand');
Route::get('/{locale?}', 'Index\HomeController@index')->where('locale', 'en|ru');


Route::get('/simple', function () {
    return view('pages.simple');
});

Route::prefix('/{locale?}')->name('localized.')->group(function () {
    Route::get('/catalog/1712', 'Index\ProductsController@ourProjects');
    Route::get('/cart', 'CartController@cart')->where('locale', 'ru')->name('cart.index');
    Route::get('/order-info', 'CartController@orderInfo')->where('locale', 'ru')->name('cart.orderInfo');
    Route::get('/step-one', 'CartController@stepOne')->where('locale', 'ru')->name('cart.stepOne');
    Route::get('/step-two', 'CartController@stepTwo')->where('locale', 'ru')->name('cart.stepTwo');
    Route::get('/step-three', 'CartController@stepThree')->where('locale', 'ru')->name('cart.stepThree');
    Route::get('/favorites', 'FavoritesController@index')->where('locale', 'ru')->name('favorites');
    Route::get('/page/{alias}', 'Index\HomeController@page')->where('locale', 'ru');
    Route::get('/product/{alias}', 'Index\ProductsController@product')->where('locale', 'ru');
    Route::get('/catalog/{alias}', 'Index\ProductsController@catalog')->where('locale', 'ru');
    Route::get('/search', 'Index\ProductsController@search')->where('locale', 'ru');
    Route::get('/catalog/brand/{alias}', 'Index\ProductsController@brand')->where('locale', 'ru');
});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
