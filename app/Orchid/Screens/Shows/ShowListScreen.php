<?php

namespace App\Orchid\Screens\Shows;

use App\Models\Shows\Shows;
use App\Orchid\Layouts\Shows\ShowEditLayout;
use App\Orchid\Layouts\Shows\ShowListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ShowListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ShowListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $shows = Shows::orderby('updated_at','desc')->latest()->paginate();
        $shows->load('seasons.episodes');

        return [
            'shows'=> $shows,
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
                ->route('platform.show.edit')
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
            ShowListLayout::class,
        ];
    }
}
