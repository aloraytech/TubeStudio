<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Orchid\Layouts\Category\CategoryEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Category Modification';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): array
    {
        $this->exists = $category->exists;
        if(!$this->exists)
        {
            $this->name = "Category Creation";
        }
        $category->load('banners');


        return [
            'category' => $category,
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

            Button::make('Create')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),



            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
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
            CategoryEditLayout::class,
        ];
    }


    /**
     * @param Category $category
     * @param Request $request
     * @return RedirectResponse
     */
    public function createOrUpdate(Category $category, Request $request)
    {
        $creation = $category->exists;
        $data = $request->get('page');
        $category->fill($data)->save();
        $contentTitle = $data['title'] ?? $category->title;

        if($creation)
        {
            Alert::success('You have successfully Update '.$contentTitle);
        }else{
            Alert::success('You have successfully Create '.$contentTitle);
        }
        return redirect()->route('platform.category.list');
    }


    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function remove(Category $category)
    {
        $_title = $category->name;
        $category->delete();
        Alert::warning('You have successfully deleted the category : '.$_title);
        return redirect()->route('platform.category.list');
    }






}
