<?php

namespace App\Orchid\Screens\Shows;

use App\Models\Shows\Shows;
use App\Orchid\Layouts\Shows\SeasonForShowModalLayout;
use App\Orchid\Layouts\Shows\SeasonListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class SeasonListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SeasonListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Shows $show): array
    {
        $show->load('seasons', 'seasons.episodes');
        $this->show = $show;
        return [
            'seasons' => $show->seasons,

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
     * @return \Illuminate\Http\RedirectResponse
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
