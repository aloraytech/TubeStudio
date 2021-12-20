<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Shows\Seasons;
use App\Models\Shows\Trailers;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TrailerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'trailers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [

            TD::make('banner', 'Banner')
                ->render(function ($trailers) {
                    return '<a href="'.route('platform.trailer.edit', $trailers).'">
                    <img src="'.$trailers->display_image.'" height="100px" width="100px" class="rounded" alt="season-thumb"></a>';
                })->sort(),

            TD::make('name', 'Name')
                ->sort()
                ->render(function (Trailers $trailer) {
                    return Link::make($trailer->name)
                        ->route('platform.trailer.edit', $trailer);
                }),


            TD::make('updated_at', 'Modified')->render(function ($trailers) {
                return $trailers->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($trailers) {
                return ($trailers->status) ? 'Active':'DeActive';
            })->sort(),




        ];


    }
}
