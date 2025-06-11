<?php

// use App\Http\Controllers\SystemController;
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

Route::get('/', function () {
    return redirect('/settings/profiles');
});

/* Route::get('/login', function () {
    return view('login');
})->name('login'); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('registers')->group(function () {
    Route::get('/forms', function () {
        return view('registers.forms');
    })->name('forms');

    Route::get('/checklists', function () {
        return view('registers.checklists');
    })->name('checklists');

    Route::get('/sheets', function () {
        return view('registers.sheets');
    })->name('sheets');

    Route::get('/texts', function () {
        return view('registers.texts');
    })->name('texts');

    Route::get('/gallery', function () {
        return view('registers.gallery');
    })->name('gallery');
});

Route::prefix('settings')->group(function () {
    Route::get('/profiles', function () {
        return view('settings.profiles');
    })->name('profiles');

    Route::get('/users', function () {
        return view('settings.users');
    })->name('users');

    Route::get('/logs', function () {
        return view('settings.logs');
    })->name('logs');
});

// Route::post('/login', [SystemController::class, 'auth']);
