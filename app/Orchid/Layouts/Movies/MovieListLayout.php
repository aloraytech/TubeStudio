<?php

namespace App\Orchid\Layouts\Movies;

use App\Models\Movies\Movies;
use Illuminate\Support\Facades\Date;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Picture;
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

            TD::make('display_image', 'Display')->render(function ($movie) {
                $image = '<img src="'.$movie->display_image.'" height="100px" width="150px" class="rounded">';
                return '<a href="'.route('platform.movie.edit', $movie).'">'.$image.'</a>';
            })->sort(),

            TD::make('name', 'Name')
                ->sort()
                ->render(function (Movies $movie) {
                    return Link::make($movie->name)
                        ->route('platform.movie.edit', $movie);
                }),

            TD::make('quality', 'Quality')->render(function ($movie) {
                return $movie->quality;
            })->sort(),

            TD::make('age_group', 'Age Group')->render(function ($movie) {
                return $movie->age_group;
            })->sort(),

            TD::make('views', 'Views')->render(function ($movie) {
                return $movie->views;
            })->sort(),

            TD::make('categories_id', 'Category')->render(function ($movie) {
                return $movie->categories->name;
            })->sort(),

            TD::make('release_on', 'Release On')->render(function ($movie) {
                    $remain = ($movie->release_on > now()) ? '<i class="text-success">'.
                        ((date_diff(date_create($movie->release_on), date_create(now()))->days > 365) ? round(date_diff(date_create($movie->release_on), date_create(now()))->days/365) .' Years Left' : date_diff(date_create($movie->release_on), date_create(now()))->days . ' Days Left' )
                        . '</i>' :
                        ' <i class="text-info">'.( (date_diff(date_create(now()),date_create($movie->release_on))->days >365) ? round(date_diff(date_create(now()),date_create($movie->release_on))->days/365) .' Years Passed' :
                            date_diff(date_create(now()),date_create($movie->release_on))->days . ' Days Passed') . '</i>';

                return date_format(date_create($movie->release_on),'Y-m-d') .'<br> <b>( </b>'.$remain.'<b> )</b>';
                //return now();
            })->sort(),

            TD::make('updated_at', 'Last Modified')->render(function ($movie) {
                return Date::createFromDate($movie->updated_at)->format('d/m/Y')
                    .' - '.Date::createFromDate($movie->updated_at)->format('h:m');
            })->sort(),
            TD::make('status', 'Status')->render(function ($movie) {
                return ($movie->status) ? '<b class="text-success">Active</b>':'<b class="text-danger">DeActive</b>';
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
