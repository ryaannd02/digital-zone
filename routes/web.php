<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\KeranjangController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\PesananController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProdukController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\Customer\AlamatController;
use App\Http\Controllers\Customer\SearchController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Petugas\PesananController as PetugasPesananController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;



/*
|--------------------------------------------------------------------------
| Midtrans Callback
|--------------------------------------------------------------------------
*/
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle']);

/*
|--------------------------------------------------------------------------
| Login Khusus Role
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    return redirect('/login?role=admin');
})->name('admin.login');

Route::get('/petugas/login', function () {
    return redirect('/login?role=petugas');
})->name('petugas.login');

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'index'])
    ->name('produk.index');

Route::get('/produk/{id}', [ProdukController::class, 'show'])
    ->name('produk.show');

Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('keranjang')->name('keranjang.')->group(function () {
        Route::get('/', [KeranjangController::class, 'index'])->name('index');
        Route::post('/{produk}', [KeranjangController::class, 'store'])->name('store');
        Route::put('/{id}', [KeranjangController::class, 'update'])->name('update');
        Route::delete('/{id}', [KeranjangController::class, 'destroy'])->name('destroy');
    });

    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/search/suggest', [SearchController::class, 'suggest']);

    Route::get('/checkout/retry/{id}', [CheckoutController::class, 'retry'])
    ->name('checkout.retry');

    Route::post('/pesanan/expire/{id}', [PesananController::class, 'expire'])
    ->name('pesanan.expire');

    Route::get('/kategori/{kategori}', [ProdukController::class, 'kategori'])
    ->name('produk.kategori');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');

    Route::get('/notifications/load', [NotificationController::class, 'loadMore'])
    ->name('notifications.load');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');

    Route::get('/customer/pesanan/{id}/invoice', [PesananController::class, 'invoice'])
    ->name('customer.pesanan.invoice');

    Route::patch('/pesanan/{id}/selesai', [PesananController::class, 'selesai'])
        ->name('customer.pesanan.selesai');

    Route::patch('/akun/update', [AlamatController::class, 'updateAkun'])->name('akun.update');

    Route::prefix('alamat')->name('alamat.')->group(function () {
        Route::get('/', [AlamatController::class, 'index'])->name('index');
        Route::get('/create', [AlamatController::class, 'create'])->name('create');
        Route::post('/', [AlamatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AlamatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AlamatController::class, 'update'])->name('update');
        Route::delete('/{id}', [AlamatController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/primary', [AlamatController::class, 'setPrimary'])->name('primary');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Petugas Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // 🔥 /petugas
        Route::get('/', [PetugasDashboardController::class, 'index'])
            ->name('home');

        // 🔥 /petugas/dashboard
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

});     

Route::middleware(['auth','role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

    Route::get('/produk', [\App\Http\Controllers\Petugas\ProdukController::class, 'index'])
        ->name('produk.index');

});

Route::prefix('petugas')
    ->middleware(['auth', 'role:petugas'])
    ->group(function () {

        Route::get('/pesanan', [PetugasPesananController::class, 'index'])
            ->name('petugas.pesanan.index');

        Route::get('/pesanan/{id}', [PetugasPesananController::class, 'show'])
        ->name('petugas.pesanan.show');

        Route::patch('/pesanan/{id}/status', [PetugasPesananController::class, 'updateStatus'])
            ->name('petugas.pesanan.updateStatus');

        Route::get('/riwayat', [PetugasPesananController::class, 'riwayat'])
        ->name('petugas.riwayat.index');
});
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::delete('/produk/bulk-delete', [AdminProdukController::class, 'bulkDelete'])
        ->name('admin.produk.bulkDelete');

        Route::patch('/produk/{id}/toggle', [AdminProdukController::class, 'toggle'])
            ->name('admin.produk.toggle');

        Route::resource('produk', AdminProdukController::class)
            ->names('admin.produk');

        // ✅ PESANAN
        Route::get('/pesanan', [AdminPesananController::class, 'index'])
            ->name('admin.pesanan.index');

        Route::get('/pesanan/{id}', [AdminPesananController::class, 'show'])
            ->name('admin.pesanan.show');

        Route::patch('/pesanan/{id}/status', [AdminPesananController::class, 'updateStatus'])
            ->name('admin.pesanan.updateStatus');

        // lainnya
        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::resource('petugas', PetugasController::class)
            ->names('admin.petugas');

        Route::get('/pesanan/{id}/invoice', [AdminPesananController::class, 'invoice'])
        ->name('admin.pesanan.invoice');

        Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('admin.laporan.index');

        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
        ->name('admin.laporan.pdf');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';