<?php

namespace App\Orchid\Layouts\Shows;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SeasonEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'seasons';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
        ];
    }

    protected function fields(): array
    {
        return [

            Input::make('seasons.name')->title('Name'),

            TextArea::make('seasons.desc')->title('Description'),


        ];
    }
}
