<?php

namespace App\Orchid\Layouts\Advert;

use App\Models\Business\Adverts;
use App\Models\Category\Tags;
use Illuminate\Support\Facades\Date;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
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

            TD::make('title', 'Title')
                ->sort()
                ->render(function (Adverts $adverts) {
                    return Link::make($adverts->name)
                        ->route('platform.advert.edit', $adverts);
                }),


            TD::make('position', 'Position')->render(function ($adverts) {
                return $adverts->position;
            })->sort(),

            TD::make('provider', 'Provider')->render(function ($adverts) {
                return $adverts->provider;
            })->sort(),

            TD::make('views', 'Views')->render(function ($adverts) {
                return ($adverts->views)?$adverts->views:'Empty';
            })->sort(),

            TD::make('clicks', 'Clicks')->render(function ($adverts) {
                return ($adverts->clicks)?$adverts->clicks:'Empty';
            })->sort(),




            TD::make('updated_at', 'Modified')->render(function ($adverts) {
                return Date::createFromDate($adverts->updated_at)->format('d/m/Y');
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


                            ]);
                }),









        ];
    }
}
