<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Shows\Seasons;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ShowSeasonsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'show.seasons';
    protected $title = 'Available Seasons';

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
                ->render(function (Seasons $seasons) {
                    //$trailers->load('videos');
                    return Link::make($seasons->name)
                        ->route('platform.movie.edit', $seasons);
                }),
            TD::make('updated_at', 'Modified')->render(function ($seasons) {
                return $seasons->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($seasons) {
                return ($seasons->status) ? 'Active':'DeActive';
            })->sort(),

            TD::make('Action')->width('15%')
                ->render(function (Seasons $seasons) {
                    return

                        DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Button::make(__('Delete'))
                                    ->method('deleteSeasons')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete this Seasons ? <br> All Episodes of this season also be deleted!'))
                                    ->parameters([
                                        'seasons_id' => $seasons->id,
                                    ]),

                                Link::make('Edit Seasons')->href(url('admin/season/'.$seasons->id)),


                            ]);
                }),


        ];
    }
}
