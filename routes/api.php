<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Profile
Route::get('/profile', [ProfileController::class, 'list']);
Route::get('/profile/{uuid}', [ProfileController::class, 'fetch']);
Route::post('/profile', [ProfileController::class, 'store']);
Route::patch('/profile/{uuid}', [ProfileController::class, 'update']);
Route::delete('/profile/{uuid}', [ProfileController::class, 'delete']);
Route::get('/profile-select', [ProfileController::class, 'options']);

// Users
Route::get('/user', [UserController::class, 'list']);
Route::get('/user/{uuid}', [UserController::class, 'fetch']);
Route::post('/user', [UserController::class, 'store']);
Route::patch('/user/{uuid}', [UserController::class, 'update']);
Route::delete('/user/{uuid}', [UserController::class, 'delete']);

// Modules
Route::get('/module', [ModuleController::class, 'list']);
Route::get('/module-permissions', [ModuleController::class, 'permissionsByModule']);
