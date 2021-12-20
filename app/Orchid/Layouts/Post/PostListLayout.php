<?php

namespace App\Orchid\Layouts\Post;

use App\Models\Blog\Posts;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'post';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [

            TD::make('display_image', 'Display')->render(function ($post) {
                return '<img src="'.$post->display_image.'" height="100px" width="150px" class="rounded">';
            })->sort(),

            TD::make('name', 'Name')
                ->sort()
                ->render(function (Posts $post) {
                    return Link::make($post->title)
                        ->route('platform.blog.edit', $post);
                }),



            TD::make('categories_id', 'Category')->render(function ($post) {
                return $post->categories->name;
            })->sort(),

            TD::make('views', 'Views')->render(function ($post) {
                return $post->views;
            })->sort(),

            TD::make('updated_at', 'Modified')->render(function ($post) {
                return $post->updated_at;
            })->sort(),
            TD::make('status', 'Status')->render(function ($post) {
                return ($post->status) ? 'Active':'DeActive';
            })->sort(),

        ];
    }
}
