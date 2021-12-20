<?php

namespace App\Orchid\Layouts\System;

use App\Models\System\Themes;
use Illuminate\Validation\Rules\In;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SystemEditLayout extends Rows
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
    protected $title = 'System Information';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }

    protected function fields(): array
    {
        return [



            Group::make([

                Switcher::make('system.installed')
                    ->sendTrueOrFalse()
                    ->title('System Status')->help('System Installed')
                    ->disabled(),

                Switcher::make('system.valid_secret')
                    ->sendTrueOrFalse()
                    ->title('Valid Serial')->help('App Serial Key Status')
                    ->disabled(),

                DateTimer::make('system.valid_upto')
                    ->title('Valid Till:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->disabled(),




            ])->fullWidth(),


            Group::make([

                Input::make('system.client_email')->title('Client Email')->help('Type your Client Email')->required(),

                Input::make('system.secret')->title('Serial Key')->help('Paste Application Serial/Product Key')->required(),


            ])->fullWidth(),







        ];
    }
}
