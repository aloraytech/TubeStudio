<?php

namespace App\Orchid\Layouts\Post;


use App\Models\Category\Category;
use App\Models\Category\Tags;

use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

use Orchid\Screen\TD;


class PostEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'post';

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
                Input::make('post.name')
                    ->title('Name')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the event'),

                Select::make('post.categories_id')->fromQuery(Category::where('type', '=', 'blog'), 'name')
                    ->title('Select Category')->required(),

            ])->fullWidth(),

        Group::make([

            DateTimer::make('post.release_on')
                ->title('Publish On:')
                ->format('Y-m-d')
                ->allowInput()
                ->enableTime()
                ->format24hr()
                ->required()->canSee($this->query->get('exists')),

            Relation::make('post.tags')
                ->fromModel(Tags::class, 'name')
                ->multiple()
                ->title('Choose Tags')
                ->placeholder('Click here to get tags'),


            Select::make('post.age_group')
                ->options([
                    'Kids'   => 'Kids',
                    'U'   => 'U',
                    '18+'   => '18+',
                ])
                ->title('Age Group')
                ->canSee($this->query->get('exists')),

        ])->fullWidth(),




            Quill::make('post.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description'),


            Group::make([
                Cropper::make('post.banner')
                    ->title('Banner')
                    ->placeholder('Add Banner Image')
                    ->minCanvas(1000)
                    ->maxWidth(1920)
                    ->maxHeight(1080)
                    ->targetRelativeUrl(),
                Cropper::make('post.display_image')
                    ->title('Display Image')
                    ->placeholder('Add Display Image')
                    ->minCanvas(744)
                    ->maxWidth(744)
                    ->maxHeight(432)
                    ->targetRelativeUrl()
            ])->fullWidth(),


        ];
    }











}
