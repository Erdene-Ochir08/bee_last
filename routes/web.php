<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Livewire\Admin\Brand\Index as BrandIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::controller(FrontendController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/collections', 'categories');

    Route::get('collections/gender/{gender_id}', 'genderProducts');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');
    Route::get('search','searchProduct');
    Route::get('/sale', 'saleProducts');
    Route::get('/new', 'latestProducts');
    Route::get('/trend', 'trendingProducts');
    Route::get('/chart', 'chart');
});


Route::middleware(['auth'])->group(function () {

    Route::controller(CartController::class)->group(function() {
        Route::get('cart', 'index');
    });

    Route::controller(CheckoutController::class)->group(function() {
        Route::get('checkout', 'index');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index');
        Route::get('orders/{orderId}', 'show');
    });

});

Route::get('/thank-you', [FrontendController::class, 'thankyou']);
Route::get('/send', [\App\Http\Controllers\MailController::class, 'index']);

//Route::post('test/{id}', [ProductController::class, 'testColor']);

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::post('/import',[\App\Http\Controllers\ExcelController::class,'import'])->name('product.import');

    Route::controller(CategoryController::class)->group(function() {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/{category}/edit/', 'edit');
        Route::put('category/{category}', 'update');
        Route::get('category/delete/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\GenderController::class)->group(function() {
        Route::get('gender', 'index');
        Route::get('gender/create', 'create');
        Route::post('gender', 'store');
        Route::get('gender/edit/{id}', 'edit');
        Route::put('gender/{id}', 'update');
        Route::get('gender/delete/{id}', 'destroy');
    });

    Route::controller(SliderController::class)->group(function() {
        Route::get('slider', 'index');
        Route::get('slider/create', 'create');
        Route::post('slider', 'store');
        Route::get('slider/edit/{id}', 'edit');
        Route::put('slider/{id}', 'update');
        Route::get('slider/delete/{id}', 'destroy');
    });


    Route::controller(ChartController::class)->group(function(){
        Route::get('charts','index');
        Route::get('charts/create','create');
        Route::post('charts/store','store');
    });

    Route::controller(ProductController::class)->group(function() {
        Route::get('product', 'index');
        Route::get('product/create', 'create');
        Route::post('product', 'store');
        Route::get('product/edit/{id}', 'edit');
        Route::put('product/{id}', 'update');
        Route::get('product/delete/{id}', 'destroy');
        Route::get('product-image/delete/{id}', 'destroyImage');

        Route::post('product-color/{product_color_id}', 'updateProductColorQty');
        Route::get('product-color/delete/{product_color_id}', 'deleteProductColor');
        Route::get('product-size/delete/{product_size_id}','deleteProductSize');

        Route::get('brand-get','brandGet');
    });



    Route::controller(\App\Http\Controllers\Admin\BrandController::class)->group(function () {
        Route::get('brands','index');
        Route::get('brand/create','create');
        Route::post('brand', 'store');
        Route::get('brand/edit/{id}', 'edit');
        Route::put('brand/{id}', 'update');
        Route::get('brand/delete/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\ClientController::class)->group(function (){
       Route::get('client/{id}','edit_setting');
       Route::put('client/update/{id}','setting_update');
    });

    Route::controller(\App\Http\Controllers\Admin\BannerController::class)->group(function () {
       Route::get('banner/{id}', 'edit_banner');
       Route::put('banner/update/{id}','banner_update');
    });

    Route::controller(\App\Http\Controllers\Admin\OrderController::class)->group(function () {
       Route::get('orders','index');
       Route::get('all-orders','all_orders');
       Route::get('orders/{id}','show');
       Route::put('/orders/{id}','updateOrderStatus');
    });

    Route::controller(\App\Http\Controllers\Admin\UserController::class)->group(function (){
       Route::get('users','index');
       Route::get('user/create','create');
       Route::post('user','store');
       Route::get('user/edit/{id}','edit');
       Route::put('user/{id}','update');
       Route::get('user/delete/{id}','destroy');
       Route::get('user/password/{id}','passwordChange');
       Route::post('user/password_update/{id}','passwordUpdate');
    });



    Route::controller(\App\Http\Controllers\Admin\SizeController::class)->group(function () {
        Route::get('sizes','index');
        Route::get('size/create','create');
        Route::post('size','store');
        Route::get('size/edit/{id}','edit');
        Route::put('size/{id}','update');
        Route::get('size/delete/{id}','destroy');
    });

    Route::get('colors', \App\Http\Livewire\Admin\Color\Index::class);


});
