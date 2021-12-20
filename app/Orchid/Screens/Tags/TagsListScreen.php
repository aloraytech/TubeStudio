<?php

namespace App\Orchid\Screens\Tags;

use App\Models\Category\Tags;
use App\Orchid\Layouts\Tags\TagModalLayout;
use App\Orchid\Layouts\Tags\TagsListLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class TagsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'TagsListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $tags = Tags::orderby('updated_at','desc')->paginate();
        return [
            'tags' => $tags,
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

            ModalToggle::make('Add Tags')
                ->modal('asyncTagsModal')
                ->method('createOrUpdate')
                ->icon('layers'),


        ];
    }


    /**
     * @param Tags $tags
     * @return array
     */
    public function asyncGetData(Tags $tags): array
    {
        return [
            'tag' => $tags,
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
            TagsListLayout::class,

            Layout::modal('asyncTagsModal', [
                TagModalLayout::class
            ])->title('Modify Tags')->async('asyncGetData'),


        ];
    }


    /**
     * @param Tags $tags
     * @param Request $request
     * @return RedirectResponse
     */
    public function createOrUpdate(Tags $tags, Request $request)
    {
        $tags->fill($request->get('tag'))->save();
        Alert::success('You have successfully created an '.ucfirst(config('app.path.tag')));
        return redirect()->route('platform.tag.list');
    }

    /**
     * @param Tags $tags
     * @return RedirectResponse
     */
    public function remove(Tags $tags)
    {
        $_title = $tags->name;
        $tags->delete();
        Alert::warning('You have successfully deleted the '.ucfirst(config('app.path.tag')).': '.$_title);
        return redirect()->route('platform.tag.list');
    }






















}
