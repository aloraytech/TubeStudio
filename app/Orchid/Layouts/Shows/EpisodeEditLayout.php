<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Category\Tags;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EpisodeEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'episode';

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
                Input::make('episode.name')->title('Name')->required(),

                Input::make('episode.e_code')->title('Code')->required()
                ->help('Set Code With Season No And Episode No S1E01'),

                Input::make('episode.duration')->title('Duration')->required(),

                DateTimer::make('episode.release_on')
                    ->title('Release On:')
                    ->format('Y-m-d')
                    ->allowInput()
                    ->enableTime()
                    ->format24hr()
                    ->required(),

            ])->fullWidth(),

            Group::make([
                Select::make('episode.status')
                    ->options([
                        0  => 'Draft',
                        1  => 'Publish',
                    ])->title('Set Status'),


            ])->fullWidth(),

            Group::make([

                Cropper::make('episode.display_image')
                    ->title('Episode Display')
                    ->placeholder('Add Image')
                    ->minCanvas(744)
                    ->width(744)
                    ->height(432)
                    ->targetRelativeUrl(),


                Quill::make('episode.desc')->toolbar(["text", "color", "header", "list", "format"])
                    ->title('Description'),

            ])->fullWidth(),

        ];
    }



}
