<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
//            Menu::make('Movies')
//                ->icon('monitor')
//                ->route('platform.example')
//                ->title('Navigation')
//                ->badge(function () {
//                    return 6;
//                }),


        // SIDEBAR
            Menu::make('Movies')
                ->icon('film')
                ->route('platform.movie.list')
                ->title('Studio Section'),

            Menu::make('Tv Shows')
                ->icon('film')
                ->route('platform.show.list'),
                //->title('Tv Shows Section'),


            Menu::make('Members')
                ->icon('monitor')
                ->route('platform.member.list')
                ->title('Business Section'),

            Menu::make('Advert')
                ->icon('monitor')
                ->route('platform.advert.list'),



            Menu::make('Activities')
                ->icon('monitor')
                ->route('platform.activity.list')
                ->title('Setting Section'),


            Menu::make('Settings')
                ->icon('monitor')
                ->route('platform.setting.list'),

            Menu::make('Categories')
                ->icon('monitor')
                ->route('platform.category.list'),

            Menu::make('Tags')
                ->icon('monitor')
                ->route('platform.tag.list'),





//            Menu::make('Studio')
//                ->slug('sub-menu')
//                ->icon('code')
//                ->list([
//                    Menu::make('Movies')
//                        ->icon('monitor')
//                        ->route('platform.movie.list'),
//                    Menu::make('Shows')
//                        ->icon('monitor')
//                        ->route('platform.show.list'),
//                ])->title('Studio Management'),
//
//            Menu::make('Features')
//                ->icon('code')
//                ->list([
//                ])->title('Features List'),
//            Menu::make('Dropdown menus')
//                ->icon('code')
//                ->list([
//                    Menu::make('Sub element item 1')->icon('bag'),
//                    Menu::make('Sub element item 2')->icon('heart'),
//                ]),


//
//            Menu::make('Basic Elements')
//                ->title('Form controls')
//                ->icon('note')
//                ->route('platform.example.fields'),
//
//            Menu::make('Advanced Elements')
//                ->icon('briefcase')
//                ->route('platform.example.advanced'),
//
//            Menu::make('Text Editors')
//                ->icon('list')
//                ->route('platform.example.editors'),
//
//            Menu::make('Overview layouts')
//                ->title('Layouts')
//                ->icon('layers')
//                ->route('platform.example.layouts'),
//
//            Menu::make('Chart tools')
//                ->icon('bar-chart')
//                ->route('platform.example.charts'),
//
//            Menu::make('Cards')
//                ->icon('grid')
//                ->route('platform.example.cards')
//                ->divider(),
//
//            Menu::make('Documentation')
//                ->title('Docs')
//                ->icon('docs')
//                ->url('https://orchid.software/en/docs'),
//
//            Menu::make('Changelog')
//                ->icon('shuffle')
//                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
//                ->target('_blank')
//                ->badge(function () {
//                    return Dashboard::version();
//                }, Color::DARK()),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
