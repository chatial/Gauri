<?php

use App\Models\Product;
use App\Models\Wedding;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('dashboard-user.home');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');

Route::get('/product', [DashboardController::class, 'product']);
Route::get('/wedding', [DashboardController::class, 'wedding']);

Route::get('/products/{product}', [ProductController::class, 'show'])->name('dashboard-admin.product.show');
Route::get('/weddings/{wedding}', [WeddingController::class, 'show'])->name('dashboard-admin.wedding.show');

Route::group(['middleware'=>'auth'], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/admin', [DashboardController::class, 'index']);
    
    Route::resource('/admin-product', ProductController::class)->parameters([
        'admin-product' => 'product',
    ]);
    Route::resource('/admin-wedding', WeddingController::class)->parameters([
        'admin-wedding' => 'wedding',
    ]);
});

Route::get('/about', function () {
    return view('dashboard-user.home');
});

Route::get('/contact', function () {
    return view('dashboard-user.contact');
});
