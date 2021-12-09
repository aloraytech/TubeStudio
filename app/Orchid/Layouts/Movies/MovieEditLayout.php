<?php

namespace App\Orchid\Layouts\Movies;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MovieEditLayout extends Rows
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
        return [
        ];
    }

    protected function fields(): array
    {
        return [


            Group::make([
                Input::make('movie.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the event'),


            ])->fullWidth(),






            Group::make([
                Select::make('movie.categories_id')->fromModel(Category::class, 'name','id')
                    ->title('Select Category')->required(),


//                Relation::make('movie.categories_id')
//                    ->fromModel(Category::class, 'name','id')
//                    ->title('Select Category'),




                DateTimer::make('movie.release_on')
                    ->title('Release On:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->required(),
            ])->fullWidth(),


            Group::make([
//                Input::make('movie.quality')
//                    ->title('Quality')
//                    ->placeholder('Attractive but mysterious name')
//                    ->help('Specify a short descriptive title for the event'),


                Select::make('movie.quality')
                    ->options([
                        '240p'   => '240p',
                        '360p'   => '360p',
                        '480p'   => '480p',
                        '720p'   => '720p',
                        '1080p'   => '1080p',
                    ])
                    ->title('Quality')
                    ->help('Allow search bots to index'),



                Input::make('movie.duration')
                    ->title('Duration')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the event'),
            ])->fullWidth(),


            Relation::make('movie.tags')
                ->fromModel(Tags::class, 'name')
                ->multiple()
                ->title('Choose your ideas'),



            Quill::make('movie.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description'),


        ];
    }
}
