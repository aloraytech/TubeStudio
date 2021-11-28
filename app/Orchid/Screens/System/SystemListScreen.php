<?php

namespace App\Orchid\Screens\System;

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
        return [];
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
        return [];
    }
}
