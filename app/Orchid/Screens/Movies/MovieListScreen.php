<?php

namespace App\Orchid\Screens\Movies;

use App\Models\Movies\Movies;
use App\Orchid\Layouts\Movies\MovieListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class MovieListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'MovieListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $movies = Movies::orderby('created_at','desc')->paginate();
        $movies->load('categories');

        return [
            'movies' => $movies
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.movie.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            MovieListLayout::class
        ];
    }
}
