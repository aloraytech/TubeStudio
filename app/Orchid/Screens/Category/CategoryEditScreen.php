<?php

namespace App\Orchid\Screens\Category;

use App\Models\Category\Category;
use App\Models\Movies\Movies;
use App\Orchid\Layouts\Category\CategoryEditLayout;
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








    public function createOrUpdate(Category $category, Request $request)
    {

        // Create
        $data = $request->get('category');
        // Fix For Categories ID
        //$category->categories_id = $data['categories_id'];

        $category->fill($data)->save();


        $images = $request->input('category.banner', []);
        if ($images) {
            $category->attachment()->syncWithoutDetaching(
                $images,
            );

//            $category->banners()->updateOrCreate(
//                [$images],
//            );


        }
        Alert::info('You have successfully created an Video.');
        //    return redirect()->route('platform.movie.list');
        return redirect()->route('platform.category.list');
    }











}
