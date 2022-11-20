<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
// Admin
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Admin\ArticleController;

// Frontend
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiShow;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Frontend\AboutController;

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

// Refresh
Route::get('clear/optimize', [ConfigController::class, 'clearRoute']);

// About
Route::resource('about', AboutController::class);

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('product', [HomeController::class, 'allProduct'])->name('all-product');

// Detail Product
Route::resource('product/detail', DetailController::class);

// Cart
Route::resource('cart', CartController::class);

// Transaksi
Route::resource('detailitem', TransaksiShow::class)->middleware('auth:sanctum');

// Payment
Route::post('transaction/payment', [TransactionController::class, 'payment_pos']);

// Update Success
Route::post('update/success', [TransactionController::class, 'success']);

// Download PDF File
Route::get('transaction/download/{id}', [TransactionController::class, 'convertPDF']);

Route::get("/page", function () {
    return view("pdf.laporan");
});

// Dashboard Admin
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        // Route::resource('user', UserController::class)->only([
        //     'index', 'create', 'store', 'destroy', 'show',
        // ]);

        // Route::resource('user', UserController::class);
        // Laporan
        Route::get('laporan/download', [LaporanController::class, 'convertPDF']);
        Route::resource('laporan', LaporanController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('article', ArticleController::class);
        Route::resource('product', ProductController::class)->middleware('is_admin');
        Route::resource('transaction', TransactionController::class)->only([
            'index', 'create', 'store', 'update', 'edit', 'destroy', 'show',
        ]);
    });
});

// Route::get('/users', function () {
//     return view('pages.admin.user.index');
// })->middleware(['auth', 'verified'])->name('users');

require __DIR__ . '/auth.php';
