<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Shows\Shows;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ShowListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'shows';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('banner', 'Banner')
                ->render(function ($shows) {
                    $img = '<a href="'.route('platform.show.edit', $shows).'"><img src="'.$shows->banner.'" height="100px" width="150px" class="rounded" alt="show-thumb"></a>';
                    return $img;
            })->sort(),

            TD::make('name', 'Name')
                ->sort()
                ->render(function (Shows $shows) {
                    return Link::make($shows->name)
                        ->route('platform.show.edit', $shows);
                }),



            TD::make('categories_id', 'Category')->render(function ($shows) {
                return $shows->categories->name;
            })->sort(),

            TD::make('age_group', 'Age Group')->render(function ($shows) {
                return $shows->age_group;
            })->sort(),

            TD::make('views', 'Views')->render(function ($shows) {
                return $shows->views;
            })->sort(),

            TD::make('seasons', 'Seasons')->render(function ($shows) {
                return $shows->seasons->count();
            })->sort(),



            TD::make('private', 'Private')->render(function ($shows) {
                return ($shows->private) ? 'Private':'Global';
            })->sort(),


            TD::make('updated_at', 'Modified')->render(function ($shows) {
                return $shows->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($shows) {
                return ($shows->status) ? 'Active':'DeActive';
            })->sort(),

        ];
    }
}
