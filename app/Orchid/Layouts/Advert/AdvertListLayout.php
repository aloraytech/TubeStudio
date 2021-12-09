<?php

namespace App\Orchid\Layouts\Advert;

use App\Models\Business\Adverts;
use App\Models\Category\Tags;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AdvertListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'adverts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')->render(function ($adverts) {
                return $adverts->name;
            })->sort(),

            TD::make('updated_at', 'Modified')->render(function ($adverts) {
                return $adverts->updated_at;
            })->sort(),


            TD::make('Action')->width('15%')
                ->render(function (Adverts $adverts) {
                    return

                        DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Button::make(__('Delete'))
                                    ->method('remove')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete this Tags ?'))
                                    ->parameters([
                                        'tag_id' => $adverts->id,
                                    ]),

                                // Ticket Modal
                                ModalToggle::make('Edit Adverts')
                                    ->icon('pen')
                                    ->modal('asyncTagsModal')
                                    ->modalTitle('Modify Tag')
                                    ->method('createOrUpdate')
                                    ->asyncParameters([
                                        'tag_id' => $adverts->id,
                                    ])
                            ]);
                }),









        ];
    }
}
