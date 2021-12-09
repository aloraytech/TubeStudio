<?php

namespace App\Orchid\Screens\System;

use App\Models\System\Systems;
use App\Orchid\Layouts\System\SystemEditLayout;
use Orchid\Screen\Screen;

class SystemEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SystemEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Systems $system): array
    {
        $system->load('themes');
        return [
            'system'=>$system
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
            SystemEditLayout::class,
        ];
    }
}
