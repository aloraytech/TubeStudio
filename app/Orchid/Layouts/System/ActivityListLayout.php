<?php

namespace App\Orchid\Layouts\System;

use App\Models\Category\Tags;
use App\Models\System\Activities;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ActivityListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'activity';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [
            TD::make('name', 'Name')->render(function ($activity) {
                return $activity->name;
            })->sort(),

            TD::make('updated_at', 'Modified')->render(function ($activity) {
                return $activity->updated_at;
            })->sort(),


            TD::make('Action')->width('15%')
                ->render(function (Activities $activity) {
                    return

                        DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Button::make(__('Delete'))
                                    ->method('remove')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete this Activity ?'))
                                    ->method('remove')
                                    ->parameters([
                                        'activity_id' => $activity->id,
                                    ]),

                                // Ticket Modal
//                                ModalToggle::make('Edit Tags')
//                                    ->icon('pen')
//                                    ->modal('asyncTagsModal')
//                                    ->modalTitle('Modify Tag')
//                                    ->method('createOrUpdate')
//                                    ->asyncParameters([
//                                        'tag_id' => $tag->id,
//                                    ])
                            ]);
                }),




        ];

    }
}
