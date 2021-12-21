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
use App\Http\Controllers\Front\Pages\PageController;
use App\Http\Controllers\Front\Blog\PostController;



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
Route::get('/', [FrontController::class, 'index'])->name('landing.index');
// Member Auth

Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
Route::match(['get','post'],'/forget-password', [AuthController::class, 'forget'])->name('forget.password');

//Socialite
Route::get('/login/{provider?}', [SocialAuthController::class,'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider?}/callback', [SocialAuthController::class,'handleProviderCallback'])->name('provider.callback');
// Default Pages
Route::match(['get','post'],'/search', [SearchController::class, 'searchFront'])->name('search.front');
Route::get('/about-us',[PageController::class,'view'])->name('pages.about.us');
Route::get('/information',[PageController::class,'view'])->name('pages.information');
Route::get('/privacy-policy',[PageController::class,'view'])->name('pages.privacy.policy');
Route::get('/terms-and-conditions',[PageController::class,'view'])->name('pages.terms.and.conditions');
Route::get('/help',[PageController::class,'view'])->name('pages.help');
Route::get('/faq',[PageController::class,'view'])->name('pages.faq');
Route::get('/contact-us',[PageController::class,'view'])->name('pages.contact.us');
Route::get('/legals',[PageController::class,'view'])->name('pages.legals');
// Studio Pages
Route::get('/'.env('MOVIE').'s/{movies:name}',[MoviesController::class,'getSingle'])->name('movie.view');
Route::get('/'.env('SHOW').'s/{shows:name}',[ShowsController::class,'getSingle'])->name('show.view');
Route::get('/'.env('CATEGORY').'/'.env('MOVIE').'s/',[CategoryController::class,'moviesOnly'])->name('category.movie');
Route::get('/'.env('CATEGORY').'/'.env('SHOW').'s/',[CategoryController::class,'showsOnly'])->name('category.show');
Route::get('/'.env('CATEGORY').'/'.env('BLOG').'s/',[CategoryController::class,'blogsOnly'])->name('category.blog');






// Backend Member
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/details', [AuthController::class, "details"])->name('detail.user');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/member/dashboard',[MemberController::class,'dashboard'])->name('member.dashboard.index');
    Route::get('/member/dashboard/library',[MemberController::class,'library'])->name('member.dashboard.library');
    Route::get('/member/dashboard/watchlist',[MemberController::class,'watchlist'])->name('member.dashboard.watchlist');
});

