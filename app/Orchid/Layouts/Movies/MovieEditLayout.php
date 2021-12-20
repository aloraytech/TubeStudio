<?php

namespace App\Orchid\Layouts\Movies;

use App\Models\Category\Category;
use App\Models\Category\Tags;
use Illuminate\Contracts\Container\BindingResolutionException;
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

    /**
     * @throws BindingResolutionException
     */
    protected function fields(): array
    {
        return [


            Group::make([
                Input::make('movie.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the event')->canSee($this->query->get('exists')),


            ])->fullWidth(),


            Group::make([
                Select::make('movie.categories_id')->fromQuery(Category::where('type', '=', 'movie'), 'name')
                    ->title('Select Category')->required()->canSee($this->query->get('exists')),

                DateTimer::make('movie.release_on')
                    ->title('Publish On:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->required()->canSee($this->query->get('exists')),
            ])->fullWidth(),


            Group::make([
                Select::make('movie.quality')
                    ->options([
                        '240p'   => '240p',
                        '360p'   => '360p',
                        '480p'   => '480p',
                        '720p'   => '720p',
                        '1080p'   => '1080p',
                    ])
                    ->title('Quality')
                    ->canSee($this->query->get('exists')),

                Select::make('movie.age_group')
                    ->options([
                        'Kids'   => 'Kids',
                        'U'   => 'U',
                        '18+'   => '18+',
                    ])
                    ->title('Age Group')
                   ->canSee($this->query->get('exists')),


                Input::make('movie.duration')
                    ->title('Duration')
                    ->placeholder('Set Movie Duration (hh:mm:ss)')
                    ->canSee($this->query->get('exists')),
            ])->fullWidth(),


            Relation::make('movie.tags')
                ->fromModel(Tags::class, 'name')
                ->multiple()
                ->title('Choose Tags')
                ->placeholder('Click here to get tags')
                ->canSee($this->query->get('exists')),


            Quill::make('movie.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description')->canSee($this->query->get('exists')),


        ];
    }
}
