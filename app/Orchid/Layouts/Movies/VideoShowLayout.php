<?php

namespace App\Orchid\Layouts\Movies;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VideoShowLayout extends Rows
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

            Input::make('movie.videos.title')
                ->title('Video Title')
                ->placeholder('Attractive but mysterious name')
                ->help('Specify a short descriptive title for this name.')->disabled(true),

            Group::make([
                Input::make('movie.videos.author')
                    ->title('Author')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),

                Input::make('movie.videos.channel')
                    ->title('Channel Name')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),
            ])->fullWidth(),

            Group::make([
                Input::make('movie.videos.height')
                    ->title('Height')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),

                Input::make('movie.videos.width')
                    ->title('Width')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),
            ])->fullWidth(),

            Input::make('movie.videos.thumb_url')
                ->title('Thumbnail')
                ->placeholder('Attractive but mysterious name')
                ->help('Specify a short descriptive title for this name.')->disabled(true),

            Group::make([
                Input::make('movie.videos.thumb_h')
                    ->title('Thumbnail Height')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),
                Input::make('movie.videos.thumb_w')
                    ->title('Thumbnail Width')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),

            ])->fullWidth(),


            Group::make([
                Input::make('movie.videos.code')
                    ->title('Code')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),
                Input::make('movie.videos.provider')
                    ->title('Provider')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')->disabled(true),

            ])->fullWidth(),

            Input::make('movie.videos.path_url')
                ->title('Uploaded Banner Path')
                ->placeholder('Attractive but mysterious Channel name')
                ->help('Specify a short descriptive title for this name.')->disabled(true),


        ];
    }
}
