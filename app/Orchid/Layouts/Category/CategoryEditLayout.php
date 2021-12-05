<?php

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'category';

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
                Input::make('category.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the Category'),

                Select::make('category.type')
                    ->options([
                        'movie'   => 'Movie',
                        'show'   => 'Show',
                        'blog'   => 'Blog',
                    ])
                    ->title('Type')
                    ->help('Select Bellow'),


            ])->fullWidth(),


            Quill::make('category.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description'),



            Cropper::make('category.banners.name')
                ->title('Category Banner')
                ->placeholder('Add Banner')
                ->minCanvas(500)
                ->maxWidth(1000)
                ->maxHeight(800)
                ->targetId(),




        ];
    }
}
