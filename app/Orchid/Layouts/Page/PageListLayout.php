<?php

namespace App\Orchid\Layouts\Page;

use App\Models\Blog\Pages;
use App\Models\Blog\Posts;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PageListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'pages';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('display_image', 'Display')->render(function ($pages) {
                $placeholder = url('https://via.placeholder.com/100X120/FF0000/FFFFFF?text=Page');
                return '<img src="'.$placeholder.'" height="100px" width="150px" class="rounded">';
            })->sort(),

            TD::make('title', 'Title')
                ->sort()
                ->render(function (Pages $pages) {
                    return Link::make($pages->title)
                        ->route('platform.page.edit', $pages);
                }),

            TD::make('default_view', 'Default')->render(function ($pages) {
                return ($pages->default_view) ? 'Active':'DeActive';
            })->sort(),



            TD::make('views', 'Views')->render(function ($pages) {
                return $pages->views;
            })->sort(),

            TD::make('updated_at', 'Modified')->render(function ($pages) {
                return $pages->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($pages) {
                return ($pages->status) ? 'Active':'DeActive';
            })->sort(),

        ];
    }
}
