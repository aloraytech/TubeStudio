<?php

namespace App\Orchid\Screens\System;

use App\Models\System\Activities;
use App\Orchid\Layouts\System\ActivityListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ActivityListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'ActivityListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $activity = Activities::orderby('updated_at','desc')->paginate();
        return [
            'activity' => $activity,
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
            ActivityListLayout::class,
        ];
    }








    public function remove(Activities $activity)
    {
        $activity->delete();

        Alert::warning('You have successfully deleted the Activity.');

        return redirect()->route('platform.activity.list');
    }






}
