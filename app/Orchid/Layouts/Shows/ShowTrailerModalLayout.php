<?php

namespace App\Orchid\Layouts\Shows;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ShowTrailerModalLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'show';

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

            Input::make('show.trailer.name')
                ->title('Trailer Name')
                ->placeholder('Attractive but mysterious Channel name')
                ->help('Specify a short descriptive title for this name.'),

            Input::make('url')->type('url')
                ->title('Enter Video Url')
                ->placeholder('Paste Youtube,DailyMotion Video Url')
                ->help('Specify a full url for the video'),

        ];
    }
}
