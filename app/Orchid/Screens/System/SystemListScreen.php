<?php

namespace App\Orchid\Screens\System;


use App\Helpers\PathCustomizer;
use App\Models\System\Systems;
use App\Orchid\Layouts\System\SystemListLayout;
use App\Orchid\Layouts\System\SystemPathModalLayout;
use App\Orchid\Layouts\Tags\TagModalLayout;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Alert;
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

            ModalToggle::make('Path Setup')
                ->modal('appPathUpdateModal')
                ->method('appPathUpdate')
                ->icon('full-screen')
                ,


        ];
    }


    public function asyncGetPath(): array
    {
        $customizer = new PathCustomizer();
        return [
            'path' => $customizer->getPath(),
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

            Layout::modal('appPathUpdateModal', [
                SystemPathModalLayout::class
            ])->title('App Path Config')->async('asyncGetPath'),



        ];
    }





    public function appPathUpdate(PathCustomizer $customizer,Request $request)
    {
        $data = $request->get('path');

        $customizer->setPath($data);

        Alert::success('You have successfully Update Application Path Configuration. ');
        return redirect()->route('platform.setting.list');

    }






}
