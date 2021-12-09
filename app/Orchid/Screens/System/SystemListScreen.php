<?php

namespace App\Orchid\Screens\System;

use App\Models\System\Systems;
use App\Orchid\Layouts\System\SystemListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

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
        $system = Systems::find(1);
        $this->s_id = $system->id;
        return [
            'system' => $system,
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
                ->route('platform.setting.edit',$this->s_id)
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
            SystemListLayout::class
        ];
    }
}
