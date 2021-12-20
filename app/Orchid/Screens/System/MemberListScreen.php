<?php

namespace App\Orchid\Screens\System;

use App\Models\System\Members;
use App\Orchid\Layouts\System\MemberListLayout;
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
        $members = Members::orderby('updated_at','desc')->paginate();
       // dd($members);
        return [
            'members' => $members,
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
            MemberListLayout::class,
        ];
    }
}
