<?php

namespace App\Orchid\Screens\Blog;

use App\Models\Blog\Posts;
use App\Orchid\Layouts\Post\PostListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'PostListScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $post = Posts::with('categories')->orderby('created_at','desc')->paginate();
        return [
            'post' => $post
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
                ->route('platform.blog.edit')
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
            PostListLayout::class,
        ];
    }
}
