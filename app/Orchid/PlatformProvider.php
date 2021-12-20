<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Models\System\Systems;
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

    private function getBool($value)
    {
        return $value === 1;
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {

        $system = Systems::first([
            'logo',
            'favicon',
            'slogan',
            'lang',
            'installed',
            "movie_pack",
            "show_pack",
            "trailer_pack",
            "blog_pack",
            "advert_pack",
            "social_pack",
            "shop_pack",
            "private_pack",
            "payment_pack",
            'activity_pack',
            "valid_secret",
            'client_email',
            'suite_by',
        ]);




        return [
            Menu::make('')
                ->title('Studio Section'),


        // SIDEBAR
            Menu::make(ucfirst(config('app.path.movie')).'s')
                ->icon('youtube')
                ->route('platform.movie.list')
                ->canSee($this->getBool($system->movie_pack)),

            Menu::make(ucfirst(config('app.path.show')).'s')
                ->icon('film')
                ->route('platform.show.list')->canSee($this->getBool($system->show_pack)),

            Menu::make(ucfirst(config('app.path.blog')).'s')
                ->icon('book-open')
                ->route('platform.blog.list')->canSee($this->getBool($system->blog_pack)),
                //->title('Tv Shows Section'),



            Menu::make('')
                ->title('Business Section'),

            Menu::make('Members')
                ->icon('people')
                ->route('platform.member.list'),

            Menu::make('Advert')
                ->icon('present')
                ->route('platform.advert.list')->canSee($this->getBool($system->advert_pack)),



            Menu::make('')
                ->title('Setting Section'),

            Menu::make('Activities')
                ->icon('puzzle')
                ->route('platform.activity.list')
                ->canSee($this->getBool($system->activity_pack)),


            Menu::make('Settings')
                ->icon('wrench')
                ->route('platform.setting.list'),

            Menu::make('Pages')
                ->icon('list')
                ->route('platform.page.list'),

            Menu::make(ucfirst(config('app.path.category')))
                ->icon('organization')
                ->route('platform.category.list'),

            Menu::make('Tags')
                ->icon('tag')
                ->route('platform.tag.list'),




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
