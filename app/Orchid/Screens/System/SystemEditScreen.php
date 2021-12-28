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
use Orchid\Support\Facades\Toast;

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
        $msg='';
        $data = $request->get('system');
        $data['installed'] = true;
        $systems->themes_id = $data['themes_id'];

        if($data['shop_pack'])
        {
            $msg  .= 'Shop Pack -';
            $data['shop_pack'] = false;
        }
        if($data['payment_pack'])
        {
            $msg .= 'Subscription Payment Pack -';
            $data['payment_pack'] = false;
        }

        if($data['social_pack'])
        {
            $msg .='Social Pack -';
            $data['social_pack'] = false;
        }

        if($data['private_pack'])
        {
            $msg .= 'Private Visibility Pack -';
            $data['private_pack'] = false;
        }


        $systems->fill($data)->save();
        Alert::success('System Successfully Updated');
        if(!empty($msg))
        {
            Toast::error($msg.'  Plugin Not Activated!')->delay(10000)->autoHide(true);
        }
        if($data['coming_soon'])
        {
            Toast::error('Please Set Coming Soon Upto Date')->delay(6000);
            return redirect()->route('platform.setting.edit',true);
        }else{
            return redirect()->route('platform.setting.list');
        }

    }






}
