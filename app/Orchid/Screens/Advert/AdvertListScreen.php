<?php

namespace App\Orchid\Screens\Advert;

use App\Models\Business\Adverts;
use App\Orchid\Layouts\Advert\AdvertListLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;

class AdvertListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Advertisement';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $adverts = Adverts::orderby('created_at','desc')->paginate();
        return [
            'adverts' => $adverts,
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
                ->route('platform.advert.edit')
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
            AdvertListLayout::class,
        ];
    }




    /**
     * @param Adverts $adverts
     * @return RedirectResponse
     */
    public function remove(Adverts $adverts)
    {
        $_title = $adverts->name;
        $adverts->delete();
        Alert::warning('You have successfully deleted the advertisement : '.$_title);
        return redirect()->route('platform.advert.list');
    }








}
