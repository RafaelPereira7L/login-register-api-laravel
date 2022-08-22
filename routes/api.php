<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');

Route::post('/user/register', [UserController::class, 'store'])->name('users.store');
Route::post('/user/login', [UserController::class, 'login'])->name('users.login');
