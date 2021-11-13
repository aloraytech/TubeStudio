<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\auth\Users\LoginController as UserLoginController;
use App\Http\Controllers\auth\Users\RegisterController as UserRegisterController;
use App\Http\Controllers\auth\Admin\RegisterController as AdminRegisterController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [FrontController::class, 'index']);
Route::match(['GET', 'POST'], 'register', [UserRegisterController::class, 'register'])->name('register.user');
Route::match(['GET', 'POST'], 'admin/register', [AdminRegisterController::class, 'register'])->name('register.admin');
Route::match(['GET', 'POST'], 'login', [UserLoginController::class, 'login'])->name('login.user');
Route::match(['GET', 'POST'], 'admin/login', [AdminLoginController::class, 'login'])->name('login.admin');



