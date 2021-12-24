<?php

namespace App\Orchid\Screens\System;


use App\Models\System\Systems;
use App\Orchid\Layouts\System\AppDetailLayout;
use App\Orchid\Layouts\System\SystemEditLayout;
use App\Orchid\Layouts\System\SystemImageLayout;
use App\Orchid\Layouts\System\SystemPacksLayout;
use App\Orchid\Layouts\System\SystemPermissionLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

/**
 * @property $system
 * @property $exists
 * @property $name
 * @property $description
 */
class SystemEditScreen extends Screen
{


    /**
     * Query data.
     *
     * @param Systems $system
     * @return array
     */
    public function query(Systems $system): array
    {







        $this->name = 'System Modification';
        $this->description = 'Care fully make changes, changes  applied on your Application';
        $system->load('themes');
        $this->system = $system;
        $this->exists = $system->exists;

        return [
            'system'=>$system,
            'isComingUpto' => (bool)$system->coming_soon,
            'isTrailer' => (bool)$system->show_pack,

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

            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),



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
            SystemEditLayout::class,
            AppDetailLayout::class,
            SystemImageLayout::class,
            SystemPermissionLayout::class,
            SystemPacksLayout::class,
        ];
    }


    /**
     * @param Systems $systems
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Systems $systems, Request $request)
    {
        $data = $request->get('system');
        $data['installed'] = true;
        $systems->themes_id = $data['themes_id'];

        $systems->fill($data)->save();
        Alert::success('System Successfully Updated');
        return redirect()->route('platform.setting.list');
    }






}
