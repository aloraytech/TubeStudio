<?php

namespace App\Orchid\Layouts\System;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SystemPermissionLayout extends Rows
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
    protected $title = 'Features';

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



                Switcher::make('system.has_slider')
                    ->sendTrueOrFalse()
                    ->title('Slider')
                    ->help('Show on website'),

                Switcher::make('system.has_upcoming')
                    ->sendTrueOrFalse()
                    ->title('Upcoming')
                    ->help('Show on website'),

                Switcher::make('system.coming_soon')
                    ->sendTrueOrFalse()
                    ->title('Coming Soon')
                    ->help('Show Default Coming Soon Message'),


                DateTimer::make('show.coming_soon_upto')
                    ->title('Valid Till:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->disabled()->canSee($this->query->get('isComingUpto')),



            ])->fullWidth(),












        ];
    }
}
