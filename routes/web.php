<?php

use Illuminate\Support\Facades\Route;


// Client
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\Movies\MoviesController;
use App\Http\Controllers\Front\Shows\ShowsController;
use App\Http\Controllers\Front\Shows\EpisodeController;
use App\Http\Controllers\Front\Category\CategoryController;
use App\Http\Controllers\Auth\MemberAuthenticationController;
use App\Http\Controllers\Member\MemberController;



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


// CLIENT SIDE
Route::get('/', [FrontController::class, 'index']);

// Member Auth
Route::get('/login', [MemberController::class, 'login'])->name('login.user');
Route::get('/register', [MemberController::class, 'register'])->name('register.user');

//Socialite
Route::get('/login/{provider}', [MemberAuthenticationController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [MemberAuthenticationController::class,'handleProviderCallback']);



Route::get('/'.env('MOVIE').'s/{movies:name}',[MoviesController::class,'getSingle']);

Route::get('/'.env('SHOW').'s/{shows:name}',[ShowsController::class,'getSingle']);

Route::get('/'.env('CATEGORY').'/'.env('MOVIE').'s/',[CategoryController::class,'moviesOnly']);
Route::get('/'.env('CATEGORY').'/'.env('SHOW').'s/',[CategoryController::class,'showsOnly']);


// Backend Client



// Backend Admin

//Route::get('/dashboard','');

