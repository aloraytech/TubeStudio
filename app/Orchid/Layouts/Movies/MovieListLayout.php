<?php

namespace App\Orchid\Layouts\Movies;

use App\Models\Movies\Movies;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MovieListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'movies';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function (Movies $movie) {
                    return Link::make($movie->name)
                        ->route('platform.movie.edit', $movie);
                }),

            TD::make('quality', 'Quality')->render(function ($movie) {
                return $movie->quality;
            })->sort(),

            TD::make('categories_id', 'Category')->render(function ($movie) {
                return $movie->categories->name;
            })->sort(),

            TD::make('updated_at', 'Modified')->render(function ($movie) {
                return $movie->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($movie) {
                return ($movie->status) ? 'Active':'DeActive';
            })->sort(),

        ];
    }






    /**
     * @return string
     */
    protected function iconNotFound(): string
    {
        return 'table';
    }

    /**
     * @return string
     */
    protected function textNotFound(): string
    {
        return __('There are no records in this view');
    }

    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return '';
    }



















}
