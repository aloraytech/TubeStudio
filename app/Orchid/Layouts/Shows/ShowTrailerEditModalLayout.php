<?php

namespace App\Orchid\Layouts\Shows;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ShowTrailerEditModalLayout extends Rows
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
        return [







        ];
    }

    protected function fields(): array
    {
        return [


            Input::make('show.trailer.name')
                ->title('Trailer Name')
                ->placeholder('Attractive but mysterious Channel name')
                ->help('Specify a short descriptive title for this name.'),

            Group::make([
                Input::make('show.trailer..duration')
                    ->title('Duration')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the event'),

                Cropper::make('show.trailer.banner')
                    ->title('Thumbnail')
                    ->minCanvas(500)
                    ->maxWidth(1000)
                    ->maxHeight(800)
                    //->targetRelativeUrl()
                    ->targetId()
                ,

            ])->fullWidth(),


            Quill::make('show.trailer.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description'),


        ];
    }
}
