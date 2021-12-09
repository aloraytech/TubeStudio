<?php

namespace App\Orchid\Screens\Advert;

use App\Models\Business\Adverts;
use App\Orchid\Layouts\Advert\AdvertListLayout;
use Orchid\Screen\Screen;
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
        $adverts = Adverts::orderby('updated_at')->paginate();
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
        return [];
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
}
