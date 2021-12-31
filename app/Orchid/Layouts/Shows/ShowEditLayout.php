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

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function fields(): array
    {
        return [
            Group::make([
                Input::make('show.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the show')->required(),


                Input::make('show.views')
                    ->title('Views')
                    ->disabled()
                    ->help('Specify a short descriptive title for the show'),

            ])->fullWidth(),



            Group::make([
                Select::make('show.private')
                    ->options([
                        0   => 'Global',
                        1   => 'Private',
                    ])
                    ->title('Visibility')
                    ->help('Set Private For Subscribed Member And Global For All'),


                Select::make('show.age_group')
                    ->options([
                        'Kids'   => 'Kids',
                        'U'   => 'U',
                        '18+'   => '18+',
                    ])
                    ->title('Age Group')
                    ->canSee($this->query->get('exists')),

            ])->fullWidth(),

            Group::make([
                Select::make('show.status')
                    ->options([
                        0  => 'Draft',
                        1  => 'Publish',
                    ])->title('Set Status'),

                Select::make('show.tags')
                    ->fromModel(Tags::class, 'slug', 'slug')->multiple()
                    ->required(),
            ])->fullWidth(),


            Group::make([
                Select::make('show.categories_id')->fromQuery(Category::where('type', '=', 'show'), 'name')
                    ->title('Select Category')->required(),

                DateTimer::make('show.release_on')
                    ->title('Release On:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->required()->canSee($this->query->get('exists')),
            ])->fullWidth(),




            Quill::make('show.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description'),











        ];
    }
}
