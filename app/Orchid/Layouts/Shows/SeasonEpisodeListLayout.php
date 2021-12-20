<?php

namespace App\Orchid\Layouts\Shows;

use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SeasonEpisodeListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'season.episodes';

    protected $title = 'Available Episodes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('display_image', 'Display Image')
                ->render(function ($episodes) {
                    $img = '<a href="'.route('platform.episode.edit', $episodes).'"><img src="'.$episodes->display_image.'" height="100px" width="150px" class="rounded" alt="show-thumb"></a>';
                    return $img;
                })->sort(),


            TD::make('name', 'Name')
                ->sort()
                ->render(function (Episodes $episodes) {
                    //$trailers->load('videos');
                    return Link::make($episodes->name)
                        ->route('platform.episode.edit', $episodes);
                }),
            TD::make('updated_at', 'Modified')->render(function ($episodes) {
                return $episodes->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($episodes) {
                return ($episodes->status) ? 'Active':'DeActive';
            })->sort(),

            TD::make('Action')->width('15%')
                ->render(function (Episodes $episodes) {
                    return

                        DropDown::make('options')
                            ->icon('options-vertical')
                            ->list([
                                Button::make(__('Delete'))
                                    ->method('deleteEpisode')
                                    ->icon('trash')
                                    ->confirm(__('Are you sure you want to delete this Episode'))
                                    ->parameters([
                                        'episodes_id' => $episodes->id,
                                    ]),

                                Link::make('Edit Episodes')->href(url('admin/episode/'.$episodes->id)),


                            ]);
                }),



        ];
    }
}
