<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Shows\SeasonListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\System\SystemEditScreen;
use App\Orchid\Screens\System\SystemListScreen;
use App\Orchid\Screens\Category\CategoryEditScreen;
use App\Orchid\Screens\Category\CategoryListScreen;
use App\Orchid\Screens\Movies\MovieEditScreen;
use App\Orchid\Screens\Movies\MovieListScreen;
use App\Orchid\Screens\Shows\ShowListScreen;
use App\Orchid\Screens\Shows\ShowEditScreen;
use App\Orchid\Screens\Shows\SeasonEditScreen;
use App\Orchid\Screens\Shows\EpisodeEditScreen;
use App\Orchid\Screens\Shows\TrailerEditScreen;
use App\Orchid\Screens\System\MemberListScreen;
use App\Orchid\Screens\System\ActivityListScreen;
use App\Orchid\Screens\Advert\AdvertListScreen;
use App\Orchid\Screens\Advert\AdvertEditScreen;
use App\Orchid\Screens\Blog\PostEditScreen;
use App\Orchid\Screens\Blog\PostListScreen;
use App\Orchid\Screens\Blog\PageEditScreen;
use App\Orchid\Screens\Blog\PageListScreen;
use App\Orchid\Screens\Movies\VideoEditScreen;
use App\Orchid\Screens\Tags\TagsListScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Example screen');
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', 'Idea::class','platform.screens.idea');


// CUSTOMERS
Route::screen('movie/{movie?}', MovieEditScreen::class)
    ->name('platform.movie.edit');

Route::screen('movies', MovieListScreen::class)
    ->name('platform.movie.list');

Route::screen('video/{video?}', VideoEditScreen::class)
    ->name('platform.video.edit');






Route::screen('category/{category?}', CategoryEditScreen::class)
    ->name('platform.category.edit');

Route::screen('categories', CategoryListScreen::class)
    ->name('platform.category.list');

Route::screen('tags', TagsListScreen::class)
    ->name('platform.tag.list');

//
//Route::screen('category/{category?}', CategoryEditScreen::class)
//    ->name('platform.category.edit');
//
//Route::screen('categories', CategoryListScreen::class)
//    ->name('platform.category.list');


Route::screen('show/{show?}', ShowEditScreen::class)
    ->name('platform.show.edit');

Route::screen('shows', ShowListScreen::class)
    ->name('platform.show.list');

Route::screen('show/{show?}/seasons', SeasonListScreen::class)
    ->name('platform.season.list');

Route::screen('season/{season?}', SeasonEditScreen::class)
    ->name('platform.season.edit');

Route::screen('episode/{episode?}', EpisodeEditScreen::class)
    ->name('platform.episode.edit');

//Route::screen('show/{show?}/trailer/{trailer?}', TrailerEditScreen::class)
//    ->name('platform.trailer.edit');




Route::screen('members', MemberListScreen::class)
    ->name('platform.member.list');

Route::screen('activities', ActivityListScreen::class)
    ->name('platform.activity.list');


Route::screen('settings', SystemListScreen::class)
    ->name('platform.setting.list');

Route::screen('setting/{setting?}', SystemEditScreen::class)
    ->name('platform.setting.edit');


Route::screen('adverts', AdvertListScreen::class)
    ->name('platform.advert.list');

//Route::screen('advert/{advert?}', SystemEditScreen::class)
//    ->name('platform.advert.edit');

