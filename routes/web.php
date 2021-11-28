<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AppCommonsMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
// Client
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\Movies\MoviesController;
use App\Http\Controllers\Front\Shows\ShowsController;
use App\Http\Controllers\Front\Shows\EpisodeController;
use App\Http\Controllers\Front\Category\CategoryController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Front\SearchController;



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

Route::get('/', [FrontController::class, 'index'])->name('');

// Member Auth
Route::get('/login', [AuthController::class, 'login'])->name('login.user');
Route::get('/register', [AuthController::class, 'register'])->name('register.user');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.user');

Route::match(['get','post'],'/search', [SearchController::class, 'searchFront'])->name('search.front');

//Socialite
Route::get('/login/{social}', [SocialAuthController::class,'redirectToSocial']);
Route::get('/login/{social}/callback', [SocialAuthController::class,'handleSocialCallback']);

Route::get('/dashboard',[MemberController::class,'dashboard'])->name('dashboard.user')->name('member.dashboard');

Route::get('/'.env('MOVIE').'s/{movies:name}',[MoviesController::class,'getSingle'])->name('movie.view');

Route::get('/'.env('SHOW').'s/{shows:name}',[ShowsController::class,'getSingle'])->name('show.view');

Route::get('/'.env('CATEGORY').'/'.env('MOVIE').'s/',[CategoryController::class,'moviesOnly'])->name('category.movie');
Route::get('/'.env('CATEGORY').'/'.env('SHOW').'s/',[CategoryController::class,'showsOnly'])->name('category.show');


// Backend Client




// Backend Admin

//Route::get('/dashboard','');

