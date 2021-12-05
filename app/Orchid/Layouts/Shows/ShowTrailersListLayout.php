<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Shows\Trailers;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ShowTrailersListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'show.trailers';
    protected $title = 'Available Trailers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('banner', 'Banner')->render(function ($trailers) {
                return '<img src="'.$trailers->banner.'" height="60px" width="80px" class="rounded">';
            })->sort(),
            TD::make('name', 'Title')->render(function ($trailers) {
                return $trailers->name;
            })->sort(),
            TD::make('updated_at', 'Modified')->render(function ($trailers) {
                return $trailers->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($trailers) {
                return ($trailers->status) ? 'Active':'DeActive';
            })->sort(),

            TD::make('Action')->width('15%')
                ->render(function (Trailers $trailers) {
                    return

                        DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Button::make(__('Delete'))
                                    ->method('deleteSeasons')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete this Seasons ? <br> All Episodes of this season also be deleted!'))
                                    ->parameters([
                                        'trailer_id' => $trailers->id,
                                    ]),

                                // Ticket Modal
                                ModalToggle::make('Edit Trailers')
                                    ->icon('pen')
                                    ->modal('asyncTrailersModal')
                                    ->modalTitle('Modify Trailers  Of This Show')
                                    ->method('saveShowTrailers')
                                    ->asyncParameters([
                                        'trailer_id' => $trailers->id,
                                        'show_id' => $trailers->shows->id,
                                    ])
                            ]);
                }),


        ];
    }
}
