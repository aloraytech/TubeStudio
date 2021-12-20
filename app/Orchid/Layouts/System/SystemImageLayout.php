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
                Cropper::make('systems.favicon')->title('Favicon')->maxHeight(100)
                    ->maxWidth(100),
                Cropper::make('systems.logo')->title('Logo')->maxHeight(100)
                    ->maxWidth(100),
            ])->fullWidth()->alignStart(),


            Group::make([
                Cropper::make('systems.signup_bg')->title('Register Background')->maxHeight(900)
                    ->maxWidth(1020),
                Cropper::make('systems.index_bg')->title('Landing Background')->maxHeight(900)
                    ->maxWidth(1020),
                Cropper::make('systems.login_bg')->title('Login Background')->maxHeight(900)
                    ->maxWidth(1020),
            ])->fullWidth()->alignCenter(),


        ];
    }
}
