<?php

namespace App\Orchid\Screens\Shows;

use App\Models\Shows\Shows;
use App\Orchid\Layouts\Shows\SeasonForShowModalLayout;
use App\Orchid\Layouts\Shows\SeasonListLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $show
 * @property $name
 * @property $description
 * @property $exists
 */
class SeasonListScreen extends Screen
{


    /**
     * Query data.
     *
     * @param Shows $show
     * @return array
     */
    public function query(Shows $show): array
    {
        $show->load('seasons', 'seasons.episodes','seasons.trailers')->orderby('modified_at','desc');
        $this->show = $show;
        $this->name = 'View All '.ucfirst(config('app.path.season')).'s';
        $this->description = 'All '.ucfirst(config('app.path.season')).' From '.$this->show->name.' '.ucfirst(config('app.path.show'));
        return [
            'seasons' => $show->seasons,
            'show' => $show,

        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Back to Show')
                ->icon('note')
                ->route('platform.show.edit',[$this->show]),

            ModalToggle::make('Add Season')
                ->modal('seasonForShowModal')
                ->method('createOrUpdate')
                ->icon('layers'),

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

            SeasonListLayout::class,


            // Movie Video Modal
            Layout::modal('seasonForShowModal', [
                SeasonForShowModalLayout::class
            ])->title('Add Season For ' . $this->show->name),


        ];
    }


    /**
     * @param Shows $shows
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Shows $shows, Request $request)
    {
        $data = $request->get('season');

        // Fix For Show ID
        // $shows->categories_id = $data['categories_id'] ?? 1;
        $shows->seasons()->updateOrCreate($data);
        //$movie->save();


        Alert::info('You have successfully Replace a Video.');
        return redirect()->route('platform.season.list', $shows->id);

    }


}
