<?php

namespace App\Orchid\Screens\Blog;

use App\Models\Blog\Posts;
use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\Movies\Movies;
use App\Orchid\Layouts\Category\CategoryEditLayout;
use App\Orchid\Layouts\Post\PostEditLayout;
use App\Orchid\Layouts\Tags\TagModalLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $name
 * @property $description
 * @property $post
 * @property $exists
 */
class PostEditScreen extends Screen
{


    /**
     * Query data.
     *
     * @param Posts $posts
     * @return array
     */
    public function query(Posts $posts): array
    {
        $this->name = 'Blog Creation';
        $posts->load('categories');
        $this->post = $posts;
        $this->exists = $posts->exists;
        if($this->exists){ $this->name = 'Blog Modification';}
        return [
            'post'=>$posts,
            'exists' => $this->exists,
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

            ModalToggle::make('New Tags')
                ->modal('asyncTagsModal')
                ->method('createTags')
                ->icon('config'),


            ModalToggle::make('New Category')
                ->modal('asyncCategoryModal')
                ->method('createCategory')
                ->icon('layers'),

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
            PostEditLayout::class,

            Layout::modal('asyncCategoryModal', [
                CategoryEditLayout::class
            ])->title('Manage Category'),


            Layout::modal('asyncTagsModal', [
                TagModalLayout::class
            ])->title('Manage Tags'),
        ];
    }




    /**
     * @param Posts $posts
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Posts $posts, Request $request)
    {
        $creation = $posts->exists;
        $data = $request->get('post');
        $posts->categories_id = $data['categories_id'];
        if(empty($data['banner'])) {$data['banner'] = 'https://via.placeholder.com/1920x1080/FF0000/FFFFFF?Text='.Str::snake($data['name']);}
        if(empty($data['display_image'])){$data['display_image'] = 'https://via.placeholder.com/744x432/FF0000/FFFFFF?Text='.Str::snake($data['name']);}
        $posts->tags = $data['tags'];
        $posts->fill($data)->save();
        $contentTitle = $data['name'] ?? $posts->name;

        if($creation)
        {
            Alert::success('You have successfully Update '.config('app.path.post').' '.config('app.path.post').' '.$contentTitle);
        }else{
            Alert::success('You have successfully Create '.config('app.path.post').' '.config('app.path.post').' '.$contentTitle);
        }
        return redirect()->route('platform.blog.list');
    }


    /**
     * @param Posts $posts
     * @param Category $category
     * @param Request $request
     * @return RedirectResponse
     */
    public function createCategory(Posts $posts,Category $category, Request $request)
    {
        // Create
        $data = $request->get('category');
        // Fix For Categories ID
        //$category->categories_id = $data['categories_id'];
        $category->fill($data)->save();
        //$category->fill($data)->save();
        $images = $request->input('category.banner', []);
        if ($images) {
            $category->attachment()->syncWithoutDetaching(
                $images,
            );

        }
        Alert::info('You have successfully created a '.config('app.path.category'));
        //    return redirect()->route('platform.movie.list');
        return redirect()->route('platform.blog.edit',$posts->id);
    }


    /**
     * @param Posts $posts
     * @param Tags $tags
     * @param Request $request
     * @return RedirectResponse
     */
    public function createTags(Posts $posts,Tags $tags, Request $request)
    {
        $tags->fill($request->get('tag'))->save();
        Alert::success('You have successfully created a'.config('app.path.tag'));
        return redirect()->route('platform.blog.edit',$posts->id);
    }


    /**
     * @param Posts $posts
     * @return RedirectResponse
     */
    public function remove(Posts $posts)
    {
        $contentTitle = $posts->name;
        $posts->delete();
        Alert::warning('You have successfully deleted the' .ucfirst(config('app.path.post')).' '.config('app.path.post').' '.$contentTitle);
        return redirect()->route('platform.blog.list');
    }




}
