<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Movies\Movies;
use App\Models\Shows\Seasons;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SeasonListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'seasons';


    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [

            TD::make('banner', 'Banner')
                ->render(function ($seasons) {
                    $img = '<a href="'.route('platform.season.edit', $seasons).'"><img src="https://via.placeholder.com/100X150?text=Thumb" height="100px" width="150px" class="rounded" alt="season-thumb"></a>';
                    return $img;
                })->sort(),



            TD::make('name', 'Name')
                ->sort()
                ->render(function (Seasons $seasons) {
                    return Link::make($seasons->name)
                        ->route('platform.season.edit', $seasons);
                }),


            TD::make('name', 'Total Episodes')
                ->sort()
                ->render(function ($seasons) {
                    return $seasons->episodes->count();
                }),



            TD::make('shows_id', 'Show')->render(function ($seasons) {
                return $seasons->shows->name;
            })->sort(),

            TD::make('updated_at', 'Modified')->render(function ($seasons) {
                return $seasons->updated_at;
            })->sort(),


        ];



    }



}
