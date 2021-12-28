<?php

namespace App\Orchid\Screens\Advert;

use App\Models\Blog\Pages;
use App\Models\Business\Adverts;
use App\Orchid\Layouts\Advert\AdvertEditLayout;
use App\Orchid\Layouts\Page\PageEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

/**
 * @property $custom
 * @property $exists
 * @property $name
 * @property $description
 * @property $advert
 */
class AdvertEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Advert Creation';

    /**
     * Query data.
     *
     * @param Adverts $adverts
     * @return array
     */
    public function query(Adverts $adverts): array
    {
        $this->custom = false;
        $this->advert = $adverts;
        $this->exists = $adverts->exists;
        if($adverts->provider === 'private')
        {
            $this->custom = true;
        }
        if($this->exists)
        {
            $this->name = 'Advert Modification';
        }
        return [
            'advert' => $adverts,
            'exists' => $this->exists,
            'custom' => $this->custom,
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
            Button::make('Create')
                ->icon('film')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),


            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            AdvertEditLayout::class,
        ];
    }


    /**
     * @param Adverts $adverts
     * @param Request $request
     * @return RedirectResponse
     */
    public function createOrUpdate(Adverts $adverts, Request $request)
    {
        $creation = $adverts->exists;
        $data = $request->get('advert');
        $adverts->provider = $data['provider'];
        $adverts->fill($data)->save();
        $contentTitle = $data['name'] ?? $adverts->name;

        if($creation)
        {
            Alert::success('You have successfully Update '.$contentTitle);
        }else{
            Alert::success('You have successfully Create '.$contentTitle);
        }
        return redirect()->route('platform.advert.list');
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
