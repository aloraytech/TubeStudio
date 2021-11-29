<?php

namespace App\Orchid\Layouts\Movies;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VideoEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'video';

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
                Input::make('video.title')
                    ->title('Video Title')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for this name.'),

                Input::make('video.provider')
                    ->title('Provider')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.'),

            ])->fullWidth(),



            Group::make([

                TextArea::make('video.code')
                    ->title('Code')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.')
                ->rows(17),


                Input::make('video.thumb_url')
                    ->title('Uploaded Video Thumbnail')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.'),



                Cropper::make('video.thumb_url')
                    ->title('Uploaded Video Thumbnail')
                    ->minCanvas(500)
                    ->maxWidth(1000)
                    ->maxHeight(800)
                    //->targetRelativeUrl()
                    ->targetId()
                    ,




                ]),



            Group::make([
                Input::make('video.author')
                    ->title('Author')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for this name.'),

                Input::make('video.channel')
                    ->title('Channel Name')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.'),
            ])->fullWidth(),

            Group::make([
                Input::make('video.height')
                    ->title('Height')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for this name.'),

                Input::make('video.width')
                    ->title('Width')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.'),
            ])->fullWidth(),




            Group::make([
                Input::make('video.thumb_h')
                    ->title('Thumbnail Height')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.'),
                Input::make('video.thumb_w')
                    ->title('Thumbnail Width')
                    ->placeholder('Attractive but mysterious Channel name')
                    ->help('Specify a short descriptive title for this name.'),

            ])->fullWidth(),










        ];
    }
}
