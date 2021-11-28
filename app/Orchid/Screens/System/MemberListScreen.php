<?php

namespace App\Orchid\Screens\System;

use Orchid\Screen\Screen;

class MemberListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'MemberListScreen';

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
