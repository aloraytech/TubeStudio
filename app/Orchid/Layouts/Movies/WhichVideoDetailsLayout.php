<?php

namespace App\Orchid\Layouts\Movies;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class WhichVideoDetailsLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'content';
    protected $title = '';

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
                Input::make('content.videos.title')
                    ->title('Video Title')
                    ->placeholder('Add a video to get video Title')
                    ->disabled(true)->canSee($this->query->get('exists')),
                Input::make('content.videos.channel')
                    ->title('Channel Name')
                    ->placeholder('Add a video to get video Channel Name')
                    ->disabled(true)->canSee($this->query->get('exists')),
            ])->fullWidth(),

            Group::make([
                TextArea::make('content.videos.code')
                    ->title('Embedded Code')
                    ->placeholder('Add a video to get video Embedded Code')
                    ->disabled(true)->canSee($this->query->get('exists')),
                Input::make('content.videos.provider')
                    ->title('Provider')
                    ->placeholder('Add a video to get video Provider')
                    ->disabled(true)->canSee($this->query->get('exists')),
            ])->fullWidth(),


        ];




    }


}
