<?php

namespace App\Orchid\Layouts\Shows;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TrailerEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'trailer';

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

            Input::make('trailer.name')->title('Name')->required(),
            TextArea::make('trailer.desc')->title('Description')->required(),
            Input::make('trailer.duration')
                ->title('Duration')
                ->placeholder('Set Movie Duration (hh:mm:ss)')
                ->canSee($this->query->get('exists')),

        ];
    }
}
