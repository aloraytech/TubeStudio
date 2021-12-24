<?php

namespace App\Orchid\Layouts\System;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SystemPathModalLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'apps';

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
     * @return Field[]
     */
    protected function fields(): array
    {

        return [

            Group::make([

                Input::make('path.category')
                    ->title('Category Will Be')->required(),

                Input::make('path.movie')
                    ->title('Movie Will Be')->required(),
            ])->fullWidth(),

            Group::make([
                Input::make('path.show')
                    ->title('Tv-Show Will Be')->required(),

                Input::make('path.season')
                    ->title('Season Will Be')->required(),
            ])->fullWidth(),

            Group::make([
                Input::make('path.trailer')
                    ->title('Trailer Will Be')->required(),

                Input::make('path.episode')
                    ->title('Episode Will Be')->required(),
            ])->fullWidth(),

            Group::make([
                Input::make('path.blog')
                    ->title('Blog Will Be')->required(),

                Input::make('path.post')
                    ->title('Post Will Be')->required(),
            ])->fullWidth(),

            Group::make([
                Input::make('path.watchlist')
                    ->title('Watchlist Will Be')->required(),

                Input::make('path.tag')
                    ->title('Tag Will Be')->required(),
            ])->fullWidth(),




        ];
    }
}
