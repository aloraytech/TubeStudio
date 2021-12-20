<?php

namespace App\Orchid\Layouts\System;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SystemPacksLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'system';
    protected $title = 'Plugins';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }

    /**
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Group::make([

                Switcher::make('system.movie_pack')
                    ->sendTrueOrFalse()
                    ->title('Movie Pack')
                    ->help('Show on website'),

                Switcher::make('system.show_pack')
                    ->sendTrueOrFalse()
                    ->title('Show Pack')
                    ->help('Show on website'),

                Switcher::make('system.trailer_pack')
                    ->sendTrueOrFalse()
                    ->title('Trailer Pack')
                    ->help('Show on website'),

                Switcher::make('system.blog_pack')
                    ->sendTrueOrFalse()
                    ->title('Blog Pack')
                    ->help('Show on website'),

                Switcher::make('system.advert_pack')
                    ->sendTrueOrFalse()
                    ->title('Advertising Pack')
                    ->help('Show on website'),
            ])->fullWidth(),
            Group::make([
                Switcher::make('system.social_pack')
                    ->sendTrueOrFalse()
                    ->title('Social Pack')
                    ->help('Show on website')->disabled(),

                Switcher::make('system.shop_pack')
                    ->sendTrueOrFalse()
                    ->title('Shopping Pack')
                    ->help('Show on website')->disabled(),

                Switcher::make('system.private_pack')
                    ->sendTrueOrFalse()
                    ->title('Private Content Pack')
                    ->help('Show on website')->disabled(),

                Switcher::make('system.payment_pack')
                    ->sendTrueOrFalse()
                    ->title('Subscription Pack')
                    ->help('Show on website')->disabled(),

                Switcher::make('system.activity_pack')
                    ->sendTrueOrFalse()
                    ->title('Activity Pack')
                    ->help('Show on website'),

            ])->fullWidth(),
        ];
    }
}
