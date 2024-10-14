<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductqrController;

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

/*
Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('dashboard', function() {
    return view('dashboard') ;
});
*/
Route::post('UserVerify', [UserController::class, 'verifyUser'] );
Route::post('api/AppUserUniqueAccessLog', [UserController::class, 'AppUserUniqueAccessLog'] );
Route::get('api/dealers', [DealerController::class, 'listing']);
Route::get('api/nonGSTdealers', [DealerController::class, 'nonGSTlisting']);
Route::get('api/dealerlistbylocation/{location}', [DealerController::class, 'dealerlistbylocation']);

Route::get('api/products', [ProductController::class, 'listing']);
Route::get('api/incompleteproducts', [ProductController::class, 'incompletelisting']);
Route::get('api/activeproductsinapp', [ProductController::class, 'appactiveproductlisting']);
Route::get('api/disabledproductsinapp', [ProductController::class, 'appdisabledproductslisting']);
Route::get('api/eolproducts', [ProductController::class, 'eolproductlisting']);
Route::get('api/neworders', [OrderController::class, 'neworders']);
Route::get('api/holdedorders', [OrderController::class, 'holdedorders']);
Route::get('api/rejectedorders', [OrderController::class, 'rejectedorders']);
Route::get('api/confirmedorders', [OrderController::class, 'confirmedorders']);

Route::post('api/getdealerdetails', [DealerController::class, 'getdealerdetails']);
Route::post('api/updatedealer', [DealerController::class, 'updatedealer']);

Route::get('api/dashboard', [DashboardController::class, 'displayFigure']);
Route::post('api/vieworder', [OrderController::class, 'vieworder']);
Route::post('api/updateorder', [OrderController::class, 'updateorder']);
Route::post('api/IncompleteProductDetails', [ProductController::class, 'IncompleteProductDetails']);
Route::post('api/UpdateProduct', [ProductController::class, 'UpdateProduct']);
Route::post('api/UpdateProductImage', [ProductController::class, 'UpdateProductImage']);
Route::post('api/generateQR', [ProductqrController::class, 'generateQR']);
Route::post('api/printQR', [ProductqrController::class, 'printQR']);
Route::get('api/testqr', [ProductqrController::class, 'testQR']);


Route::get('{view}', HomeController::class)->where('view', '(.*)');
