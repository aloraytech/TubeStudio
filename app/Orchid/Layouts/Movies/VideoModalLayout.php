<?php

namespace App\Orchid\Layouts\Movies;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VideoModalLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'movie';

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
            Input::make('url')->type('url')
                ->title('Enter Video Url')
                ->placeholder('Paste Youtube,DailyMotion Video Url')
                ->help('Specify a full url for the video'),
        ];
    }
}
