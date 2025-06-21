<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('registers')->group(function () {
        Route::view('/forms', 'registers.forms')->name('forms');
        Route::view('/checklists', 'registers.checklists')->name('checklists');
        Route::view('/sheets', 'registers.sheets')->name('sheets');
        Route::view('/texts', 'registers.texts')->name('texts');
        Route::view('/gallery', 'registers.gallery')->name('gallery');
    });

    Route::prefix('settings')->group(function () {
        Route::view('/profiles', 'settings.profiles')->name('profiles');
        Route::view('/users', 'settings.users')->name('users');
        Route::view('/logs', 'settings.logs')->name('logs');
    });
});

// Route::post('/login', [SystemController::class, 'auth']);
