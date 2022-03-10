<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;

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

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Protected routes
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/password/change', [ChangePasswordController::class, 'create'])
        ->name('password.change');
    Route::post('/password/store', [ChangePasswordController::class, 'store'])
        ->name('password.store');

});


require __DIR__.'/auth.php';
