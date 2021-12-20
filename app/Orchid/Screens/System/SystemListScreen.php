<?php

namespace App\Orchid\Screens\System;

use App\Models\System\Systems;
use App\Orchid\Layouts\System\SystemListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

/**
 * @property $system
 * @property $name
 * @property $description
 * @property $exists
 */
class SystemListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SystemListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $this->system = Systems::with('themes')->where('id','=',1)->first();
        $this->exists = $this->system->exists;
        return [
            'system' => $this->system,
            'exists' => $this->exists,
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
            Link::make('Modify Setting')
                ->icon('pencil')
                ->route('platform.setting.edit',$this->system->id),

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
            SystemListLayout::class,
        ];
    }
}
