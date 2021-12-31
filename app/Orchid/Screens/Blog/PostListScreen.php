<?php

namespace App\Orchid\Screens\Blog;

use App\Helpers\SystemHandler;
use App\Models\Blog\Posts;
use App\Orchid\Layouts\Post\PostListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{

    private object $_system;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {

        $_system_handler = new SystemHandler();
        $this->_system = $_system_handler->getSystem();
        if($this->_system->blog_pack)
        {
            $this->name = 'View All '.ucfirst($this->_system->path->post.'s');
            $this->description = 'All '.ucfirst($this->_system->path->post.'s').' From '.ucfirst($this->_system->path->blog.'s');
            $post = Posts::with('categories')->orderby('created_at','desc')->paginate();
            return [
                'post' => $post
            ];

        }else{
            $this->name = "Plugin Not Activate";

            return [];
        }



    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        if($this->_system->blog_pack)
        {
            return [
                Link::make('Create new')
                    ->icon('pencil')
                    ->route('platform.blog.edit')
            ];
        }else{
            return [
//                Link::make('Settings')
//                    ->icon('pencil')
//                    ->route('platform.setting.list')
            ];
        }

    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array
    {
        if($this->_system->blog_pack)
        {
            return [
                PostListLayout::class,
            ];
        }else{
            return [];
        }

    }
}
