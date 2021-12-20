<?php

namespace App\Orchid\Screens\Blog;

use App\Models\Blog\Pages;
use App\Models\Blog\Posts;
use App\Orchid\Layouts\Page\PageEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

/**
 * @property $exists
 * @property $description
 * @property $name
 * @property $page
 * @property $custom
 */
class PageEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PageEditScreen';

    /**
     * Query data.
     *
     * @param Pages $pages
     * @return array
     */
    public function query(Pages $pages): array
    {
        $this->custom = true;
        $this->name = 'Page Creation';
        $this->exists = $pages->exists;

        if($pages->default_view === 1)
        {
            $this->custom = false;
        }
        if($this->exists)
        {
            $this->name = 'Page Modification';
        }
        $this->page = $pages;
        return [
            'page' => $pages,
            'exists' => $this->exists,
            'custom'=>$this->custom,
            'position' => $pages->position,
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('film')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),


            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            PageEditLayout::class,
            ];
    }


    /**
     * @param Pages $pages
     * @param Request $request
     * @return RedirectResponse
     */
    public function createOrUpdate(Pages $pages, Request $request)
    {
        $creation = $pages->exists;
        $data = $request->get('page');

        if(empty($data['url']))
        {
            $data['position'] = 0;
            $data['default_view'] = false;
            $data['default_desc'] = '';
        }


        $pages->fill($data)->save();
        $contentTitle = $data['title'] ?? $pages->title;

        if($creation)
        {
            Alert::success('You have successfully Update '.$contentTitle);
        }else{
            Alert::success('You have successfully Create '.$contentTitle);
        }
        return redirect()->route('platform.page.list');
    }



    /**
     * @param Pages $pages
     * @return RedirectResponse
     */
    public function remove(Pages $pages)
    {
        $_title = $pages->name;
        if($pages->position === 0 || $pages->url === null)
        {
            $pages->delete();
            Alert::warning('You have successfully deleted the page : '.$_title);
            return redirect()->route('platform.page.list');
        }else{
            Alert::warning('Default Pages are not removable : '.$_title);
            return redirect()->route('platform.page.list');
        }

    }



}
