<?php

namespace App\Orchid\Layouts\System;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SystemImageLayout extends Rows
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
    protected $title = 'Background And Images';

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
                Cropper::make('system.favicon')->title('Favicon')->height(100)
                    ->width(100)->targetRelativeUrl(),
                Cropper::make('systems.logo')->title('Logo')->height(100)
                    ->width(100)->targetRelativeUrl(),
            ])->fullWidth()->alignStart(),


            Group::make([
                Cropper::make('system.signup_bg')->title('Register Background')->height(900)
                    ->width(1020)->targetRelativeUrl(),
                Cropper::make('system.index_bg')->title('Landing Background')->height(900)
                    ->width(1020)->targetRelativeUrl(),
                Cropper::make('system.login_bg')->title('Login Background')->height(900)
                    ->width(1020)->targetRelativeUrl(),
            ])->fullWidth()->alignCenter(),


        ];
    }
}
