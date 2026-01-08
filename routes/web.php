<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| USER (PUBLIC)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ParfumController as UserParfumController;
use App\Http\Controllers\User\ProfilController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-toko', [ProfilController::class, 'index'])->name('profil.toko');
Route::get('/katalog', [UserParfumController::class, 'index'])->name('katalog');
Route::get('/katalog/{id}', [UserParfumController::class, 'show'])->name('katalog.detail');


/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\AuthController;

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| APPROVAL VIA EMAIL (PUBLIC)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\ApprovalController;

Route::get('/admin/approve/{token}', [ApprovalController::class, 'approve'])
    ->name('admin.approve');

Route::get('/admin/reject/{token}', [ApprovalController::class, 'reject'])
    ->name('admin.reject');


/*
|--------------------------------------------------------------------------
| ADMIN AREA (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParfumController;
use App\Http\Controllers\Admin\ProfilTokoController;
use App\Http\Controllers\Admin\AdminUserController;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard (Admin & Superadmin)
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | ADMIN & SUPERADMIN (akses umum)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['is_admin'])->group(function () {

            // Parfum CRUD
            Route::prefix('parfum')->name('parfum.')->group(function () {
                Route::get('/', [ParfumController::class, 'index'])->name('index');
                Route::get('/create', [ParfumController::class, 'create'])->name('create');
                Route::post('/', [ParfumController::class, 'store'])->name('store');
                Route::get('/{id}', [ParfumController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [ParfumController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ParfumController::class, 'update'])->name('update');
                Route::delete('/{id}', [ParfumController::class, 'destroy'])->name('destroy');
            });

            // Profil Toko CRUD
            Route::prefix('profil-toko')->name('profil-toko.')->group(function () {

    // selalu ada 1 profil → hanya edit, tidak bisa hapus / create
    Route::get('/', [ProfilTokoController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [ProfilTokoController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProfilTokoController::class, 'update'])->name('update');

});

        });


        /*
        |--------------------------------------------------------------------------
        | SUPERADMIN ONLY (Kelola Admin)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['is_superadmin'])
            ->prefix('admin-user')
            ->name('admin-user.')
            ->group(function () {

                Route::get('/', [AdminUserController::class, 'index'])->name('index');
                Route::post('/', [AdminUserController::class, 'store'])->name('store');
                Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');

                // Ubah Role Admin <-> Superadmin
                Route::post('/{id}/role', [AdminUserController::class, 'updateRole'])
                    ->name('update-role');
            });
});
