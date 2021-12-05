<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\Shows\Shows;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ShowEditLayout extends Rows
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
            Group::make([
                Input::make('show.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the show'),


                Input::make('show.views')
                    ->title('Views')
                    ->disabled()
                    ->help('Specify a short descriptive title for the show'),

            ])->fullWidth(),



            Group::make([
                Select::make('show.private')
                    ->options([
                        1   => 'Private',
                        0   => 'Global',
                    ])
                    ->title('Visibility')
                    ->help('Set Private For Subscribed Member And Global For All'),


                Relation::make('show.tags')
                    ->fromModel(Tags::class, 'name')
                    ->multiple()
                    ->title('Choose Tags From List'),

            ])->fullWidth(),




            Group::make([
                Select::make('show.categories_id')->fromModel(Category::class, 'name','id')
                    ->title('Select Category')->required(),

                DateTimer::make('show.release_on')
                    ->title('Release On:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->required(),
            ])->fullWidth(),















            Quill::make('show.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description'),











        ];
    }
}
