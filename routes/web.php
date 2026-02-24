<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ProdukController;
use App\Http\Controllers\Customer\KeranjangController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\PesananController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\Customer\AlamatController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Midtrans Callback (tanpa auth)
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle']);


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/{id}', [ProdukController::class, 'show'])->name('produk.show');
});


/*
|--------------------------------------------------------------------------
| Customer Routes (harus login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Keranjang
    |--------------------------------------------------------------------------
    */
    Route::prefix('keranjang')->name('keranjang.')->group(function () {

        Route::get('/', [KeranjangController::class, 'index'])->name('index');

        Route::post('/{produk}', [KeranjangController::class, 'store'])->name('store');

        Route::put('/{id}', [KeranjangController::class, 'update'])->name('update');

        Route::delete('/{id}', [KeranjangController::class, 'destroy'])->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');


    /*
    |--------------------------------------------------------------------------
    | Pesanan
    |--------------------------------------------------------------------------
    */
    Route::get('/pesanan', [PesananController::class, 'index'])
        ->name('pesanan.index');


    /*
    |--------------------------------------------------------------------------
    | Alamat
    |--------------------------------------------------------------------------
    */
    Route::prefix('alamat')->name('alamat.')->group(function () {

        Route::get('/', [AlamatController::class, 'index'])->name('index');
        Route::get('/create', [AlamatController::class, 'create'])->name('create');
        Route::post('/', [AlamatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AlamatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AlamatController::class, 'update'])->name('update');
        Route::delete('/{id}', [AlamatController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/primary', [AlamatController::class, 'setPrimary'])->name('primary');

    });


    /*
    |--------------------------------------------------------------------------
    | Profile (Breeze)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

    /*
    |--------------------------------------------------------------------------
    | Petugas Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('petugas')
        ->middleware(['auth', 'role:petugas'])
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('petugas.dashboard');
            })->name('petugas.dashboard');

            Route::get('/pesanan', function () {
                return view('petugas.pesanan.index');
            })->name('petugas.pesanan.index');

    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        // ->middleware(['auth', 'role:admin'])
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('admin.dashboard');

            Route::get('/produk', function () {
                return view('admin.produk.index');
            })->name('admin.produk.index');

            Route::get('/pesanan', function () {
                return view('admin.pesanan.index');
            })->name('admin.pesanan.index');

            Route::get('/users', function () {
                return view('admin.users.index');
            })->name('admin.users.index');

            Route::get('/petugas', function () {
                return view('admin.petugas.index');
            })->name('admin.petugas.index');

    });

    Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::get('/petugas/login', [AuthenticatedSessionController::class, 'create'])
        ->name('petugas.login');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
