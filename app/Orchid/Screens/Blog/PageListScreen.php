<?php

namespace App\Orchid\Screens\Blog;

use App\Models\Blog\Pages;
use App\Orchid\Layouts\Page\PageListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class PageListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PageListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $pages = Pages::orderby('created_at','desc')->paginate();
        return [
            'pages'=> $pages,
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.page.edit')
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
            PageListLayout::class
        ];
    }
}
