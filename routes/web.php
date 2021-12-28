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
use App\Helpers\PathCustomizer;
if(!isset($path)){
    $customizer = new PathCustomizer();
    $path = $customizer->getPath();
}





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

//Application Frontend
// Authentication
Route::match(['get','post'],'/login', [AuthController::class, 'login'])->name('login');
Route::match(['get','post'],'/register', [AuthController::class, 'register'])->name('register');
Route::match(['get','post'],'/forget-password', [AuthController::class, 'forget'])->name('forget.password');

//Socialite
Route::get('/login/{provider?}', [SocialAuthController::class,'redirectToProvider'])->name('provider.login');
Route::get('/login/{provider?}/callback', [SocialAuthController::class,'handleProviderCallback'])->name('provider.callback');




// Index
Route::get('/', [FrontController::class, 'index'])->name('landing.index');
// Pages
Route::get('/about-us',[PageController::class,'view'])->name('pages.about.us');
Route::get('/information',[PageController::class,'view'])->name('pages.information');
Route::get('/privacy-policy',[PageController::class,'view'])->name('pages.privacy.policy');
Route::get('/terms-and-conditions',[PageController::class,'view'])->name('pages.terms.and.conditions');
Route::get('/help',[PageController::class,'view'])->name('pages.help');
Route::get('/faq',[PageController::class,'view'])->name('pages.faq');
Route::get('/contact-us',[PageController::class,'view'])->name('pages.contact.us');
Route::get('/legals',[PageController::class,'view'])->name('pages.legals');

/**
 * Categories Routes
 */
Route::get('/'.$path['category'].'/{category:name?}',[CategoryController::class,'getCategory'])->name('category.view');
Route::get('/'.$path['category'].'/'.$path['movie'].'s/',[CategoryController::class,'moviesOnly'])->name('category.movie');
Route::get('/'.$path['category'].'/'.$path['show'].'s/',[CategoryController::class,'showsOnly'])->name('category.show');
Route::get('/'.$path['category'].'/'.$path['blog'].'s/',[CategoryController::class,'blogsOnly'])->name('category.blog');

/**
 * Shows Routes
 */
Route::get('/'.$path['show'].'s',[CategoryController::class,'showsOnly'])->name('show.page');
Route::get('/'.$path['show'].'s/{shows:name}/{seasons:name?}',[ShowsController::class,'getSingle'])->name('show.view');
//Route::get('/'.$path['show'].'s/{shows:name}/{seasons:name?}',[ShowsController::class,'getSingle'])->name('show.view');

/**
 * Trailers Routes
 */
Route::get('/'.$path['category'].'s/{trailer:name?}',[ShowsController::class,'watchTrailer'])->name('trailer.view');
/**
 * Seasons Routes
 */


/**
 * Episodes Routes
 */
Route::get('/'.$path['show'].'s/{shows:name}/{seasons:name}/{episodes:name?}',[EpisodeController::class,'getSingle'])->name('episode.view');


/**
 * Movies Routes
 */
Route::get('/'.$path['movie'].'s',[CategoryController::class,'moviesOnly'])->name('movie.page');
Route::get('/'.$path['movie'].'s/{movies:name}',[MoviesController::class,'getSingle'])->name('movie.view');
// Blogs
Route::get('/'.$path['blog'].'s',[CategoryController::class,'blogsOnly'])->name('blog.page');
Route::get('/'.$path['blog'].'s/{posts:name}',[PostController::class,'getSingle'])->name('blog.view');


/**
 * Search Routes
 */
Route::match(['get','post'],'/search', [SearchController::class, 'searchFront'])->name('search.front');




// Client Backend

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/details', [AuthController::class, "details"])->name('detail.user');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/member/dashboard',[MemberController::class,'dashboard'])->name('member.dashboard.index');
    Route::get('/member/dashboard/library',[MemberController::class,'library'])->name('member.dashboard.library');
    Route::get('/member/dashboard/watchlist',[MemberController::class,'watchlist'])->name('member.dashboard.watchlist');
});


// Api Backend










