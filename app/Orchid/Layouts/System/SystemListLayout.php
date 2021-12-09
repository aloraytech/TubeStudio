<?php

namespace App\Orchid\Layouts\System;

use App\Models\Category\Tags;
use App\Models\System\Themes;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SystemListLayout extends Rows
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
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function fields(): array
    {
        return [

                Input::make('system.slogan')->title('Slogan')->disabled(),
            Group::make([

                TextArea::make('system.keywords')->title('Keywords')->rows(7)->disabled(),
                TextArea::make('system.desc')->title('Description')->rows(7)->disabled(),
                TextArea::make('system.header')->title('Header')->rows(7)->disabled(),
            ])->fullWidth(),


            Group::make([

                CheckBox::make('system.private')->title('Private Access')
                    ->sendTrueOrFalse()->disabled(),

                CheckBox::make('system.installed')->title('System')
                    ->sendTrueOrFalse()->disabled(),

                CheckBox::make('system.slider')->title('Slider Section')
                    ->sendTrueOrFalse()->disabled(),

                CheckBox::make('system.upcoming_section')->title('Upcoming Section')
                    ->sendTrueOrFalse()->disabled(),

            ])->fullWidth(),



            Group::make([
                Cropper::make('systems.favicon')->title('Favicon')->maxHeight(100)
                    ->maxWidth(100)->disabled(),
                Cropper::make('systems.logo')->title('Logo')->maxHeight(100)
                    ->maxWidth(100)->disabled(),
            ])->fullWidth()->alignBaseLine(),



            Group::make([
                Select::make('system.per_page')
                    ->options([
                        5   => 'Max 5',
                        10   => 'Max 10',
                        15   => 'Max 15',
                        20   => 'Max 20',
                        30   => 'Max 30',
                        45   => 'Max 45',
                        50   => 'Max 50',
                        55   => 'Max 55',
                        75   => 'Max 75',
                        100   => 'Max 100',
                    ])
                    ->title('Display Per Page Limit')
                    ->help('Set Maximum Posts,Movies,Shows Per Page Limit')->disabled(),

                Select::make('system.player_size')
                    ->options([
                        '1by1'=>'1x1',
                        '4by3'=>'4x3',
                        '16by9'=>'16x9',
                        '21by9'=>'21x9',

                    ])
                    ->title('Video Player Size')->disabled(),

                Select::make('system.themes_id')
                    ->fromModel(Themes::class, 'name')->title('Current Theme')->disabled(),
            ])->fullWidth(),



            Group::make([
                Cropper::make('systems.signup_bg')->title('Register Background')->maxHeight(900)
                    ->maxWidth(1020)->disabled(),
                Cropper::make('systems.index_bg')->title('Landing Background')->maxHeight(900)
                    ->maxWidth(1020)->disabled(),
                Cropper::make('systems.login_bg')->title('Login Background')->maxHeight(900)
                    ->maxWidth(1020)->disabled(),
            ])->fullWidth()->alignBaseLine(),


















        ];
    }
}
