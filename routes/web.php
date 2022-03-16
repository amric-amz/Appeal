<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
//use Inertia\Inertia;
use App\Http\Controllers\PDFConotroller;
use App\Http\Controllers\AuthorizeNetController;;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Walmart\Alerts\RatingRaviewController;
use App\Http\Controllers\Walmart\Alerts\OnTimeDeliveryController;
use App\Http\Controllers\Walmart\Alerts\OnTimeShipmentController;
use App\Http\Controllers\Walmart\Alerts\CarrierPerformanceController;
use App\Http\Controllers\Walmart\Alerts\RegionalPerformanceController;
use App\Http\Controllers\Walmart\Alerts\OrdersContnroller;
use App\Http\Controllers\Walmart\Alerts\ShippingPerformanceController;
use App\Http\Controllers\Walmart\Alerts\OrderStatusCheckController;
use App\Http\Controllers\Walmart\Alerts\ItemsController;
use App\Http\Controllers\MarketPlace\MarketPlaceController;
use App\Http\Controllers\admin\UserRegistrationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminController;



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
//




Route::get('registration-form', function () {
    return view('payment');
});

    //Route::get('/checkout/{subscribtion}', [CheckoutController::class, 'index'])->name('checkouts');
    Route::get('/register', [CheckoutController::class, 'login'])->name('register');
    Route::get('/', [DashboardController::class, 'home'])->name('home');

    Route::get('/checkout/{subscribtion}', [CheckoutController::class, 'index'])->name('checkouts');
    Route::post('/create', [CheckoutController::class, 'create'])->name('create');



Route::group(['middleware' => 'auth'] , function(){


    Route::group(['middleware' => 'CheckAuthPermission:user' , 'prefix' => 'user' , 'as' => 'user'], function(){
        Route::get('user', [PDFConotroller::class, 'user'])->name('user');
        Route::get('subscriptionn', [PDFConotroller::class, 'createSubscription'])->name('user.subscriptionn');

        Route::prefix('marketplace')->group(function () {
            Route::get('/', [MarketPlaceController::class, 'index'])->name('marketplace');
            Route::get('/plate-form', [MarketPlaceController::class, 'plateForm'])->name('user.select-marketplace');
            Route::get('walmart', [MarketPlaceController::class, 'walmartRegister'])->name('user.select-marketplace.register');
            Route::post('walmart/integration', [MarketPlaceController::class, 'walmartIntegration'])->name('user.marketplace.walmart.integration');
            Route::get('/edit_view/{id}', [MarketPlaceController::class, 'editView'])->name('edit_View');
            Route::get('/thank-you', [MarketPlaceController::class, 'thankYouPage'])->name('thank-you');
        });

    }); // End of user access

    Route::group(['middleware' => 'CheckAuthPermission:password' , 'prefix' => 'password' , 'as' => 'password'], function(){

        Route::get('update-password', [UserController::class, 'show'])->name('password.update-password');
        Route::post('password-updated', [UserController::class, 'store'])->name('password.password-updated');

    }); // end of admin access


    Route::prefix('dashboard')->group(function () {

        Route::get('/', [DashboardController::class, 'admin'])->name('admin');

        Route::group(['middleware' => 'CheckAuthPermission:admin' , 'prefix' => 'admin' , 'as' => 'admin'], function(){

            Route::get('/', [AdminController::class, 'index'])->name('dashboard.admin.index');
            Route::get('user-registration', [UserRegistrationController::class, 'index'])->name('dashboard.admin.user-registration');
            Route::post('user-registration-add', [UserRegistrationController::class, 'create'])->name('dashboard.admin.user-registration-add');

            Route::get('user-view', [UserController::class, 'index'])->name('dashboard.admin.user-view');

        }); // end of admin access




        Route::get('shipping-performance', [ShippingPerformanceController::class, 'index'])->name('dashboard.shipping-performance');
        Route::post('shipping-performance-add', [ShippingPerformanceController::class, 'ratingReview'])->name('dashboard.shipping-performance-add');


        Route::get('rating-review', [RatingRaviewController::class, 'index'])->name('dashboard.rating-review');
        Route::post('rating-review-add', [RatingRaviewController::class, 'ratingReview'])->name('dashboard.rating-review-add');



        Route::get('on-time-delivery', [OnTimeDeliveryController::class, 'index'])->name('dashboard.on-time-delivery');
        Route::get('on-time-delivery-add', [OnTimeDeliveryController::class, 'OnTimeDelivered'])->name('dashboard.on-time-delivery-add');



        Route::get('on-time-shipment', [OnTimeShipmentController::class, 'index'])->name('dashboard.on-time-shipment');
        Route::get('on-time-shipment-add', [OnTimeShipmentController::class, 'OnTimeShipment'])->name('dashboard.on-time-shipment-add');



        Route::get('carrier-performance', [CarrierPerformanceController::class, 'index'])->name('dashboard.carrier-performance');
        Route::get('carrier-performance-add', [CarrierPerformanceController::class, 'carrierPerformance'])->name('dashboard.carrier-performance-add');



        Route::get('regional-performance', [RegionalPerformanceController::class, 'index'])->name('dashboard.regional-performance');
        Route::get('regional-performance-add', [RegionalPerformanceController::class, 'regionalPerformance'])->name('dashboard.regional-performance-add');



        Route::get('order', [OrdersContnroller::class, 'index'])->name('dashboard.order');
        Route::post('order-add', [OrdersContnroller::class, 'orderDetails'])->name('dashboard.order-add');

        Route::get('order-status', [OrderStatusCheckController::class, 'index'])->name('dashboard.order-status');
        Route::post('order-status-check', [OrderStatusCheckController::class, 'orderStatusCheck'])->name('dashboard.order-status-check');


        Route::get('items', [ItemsController::class, 'index'])->name('dashboard.items');
        Route::post('items-add', [ItemsController::class, 'walmartItems'])->name('dashboard.items-add');


        Route::get('client', [DashboardController::class, 'client'])->name('dashboard.client');


        Route::get('authorize', [AuthorizeNetController::class, 'index'])->name('dashboard.authorize');


        Route::get('pay' , [PaymentController::class , 'pay'])->name('pay');
        Route::post('/dopay/online' , [PaymentController::class , 'createSubscriptions'])->name('dashboard.dopay.online');


    }); // End of dashboard prefix


}); //End of middleware



//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');
