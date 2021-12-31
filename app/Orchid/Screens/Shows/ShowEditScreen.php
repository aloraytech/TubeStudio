<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Models\Shows\Trailers;
use App\Orchid\Layouts\Category\CategoryEditLayout;
use App\Orchid\Layouts\Category\CategoryModalLayout;
use App\Orchid\Layouts\Shows\ShowEditLayout;
use App\Orchid\Layouts\Shows\ShowSeasonsListLayout;
use App\Orchid\Layouts\Shows\ShowTrailerEditModalLayout;
use App\Orchid\Layouts\Shows\ShowTrailerModalLayout;
use App\Orchid\Layouts\Shows\ShowTrailersListLayout;
use App\Orchid\Layouts\Tags\TagModalLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $exists
 * @property $showID
 */
class ShowEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Show Creation';

    /**
     * Query data.
     *
     * @param Shows $shows
     * @return array
     */
    public function query(Shows $shows): array
    {

        $this->exists = $shows->exists;
        $this->showID = $shows->id ?? '';
        if ($this->exists) {
            $this->name = 'Shows Modification';
            $this->description = 'Edit/Modify This Show details';
            $shows->load('seasons','trailers','trailers.videos','categories');
            if(empty($shows->display_image))
            {
                $shows->display_image = "https://via.placeholder.com/744x432.png?text=744X432";
            }
            if(empty($shows->banner))
            {
                $shows->banner = "https://via.placeholder.com/1930x1080.png?text=1920X1080";
            }
        }



        return [
            'show' => $shows,
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
                ->icon('pencil')
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

            Link::make('Available Seasons')
                ->icon('note')
                ->href($this->showID.'/seasons')
                ->parameters(['show_id'=> $this->showID])
                //->method('createOrUpdate')
                ->canSee($this->exists),

            ModalToggle::make('Add Tags')
                ->modal('asyncTagsModal')
                ->method('createTagsModal')
                ->icon('layers'),


            ModalToggle::make('Add Category')
                ->modal('asyncCategoryModal')
                ->method('createCategoryModal')
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
            ShowEditLayout::class,
            // Show Trailer Modal
            Layout::modal('asyncTagsModal', [
                TagModalLayout::class
            ])->title('Create Tags'),
//
            Layout::modal('asyncCategoryModal', [
                CategoryEditLayout::class
            ])->title('Manage Category'),




            Layout::rows([
                Group::make([
                    Cropper::make('show.banner')
                        ->title('Show Banner')
                        ->placeholder('Add Image')
                        ->width(1600)
                        ->height(900)
                        ->targetRelativeUrl(),


                    Cropper::make('show.display_image')
                        ->title('Show Display Image')
                        ->placeholder('Add Image')
                        ->width(744)
                        ->height(432)
                        ->targetRelativeUrl(),

                ])->fullWidth(),
            ])->canSee($this->exists),


        ];
    }


    // Methods


    /**
     * @param Shows $shows
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Shows $shows, Request $request)
    {
        $has = $shows->exists;

        $data = $request->get('show');
        if(empty($data['release_on']))
        {
            $data['release_on'] = now();
        }
        if(empty($data['banner']) && empty($data['display_image']))
        {
            $data['banner'] = 'https://via.placeholder.com/1920x1080/FF0000/FFFFFF?Text='.Str::snake($data['name']);
            $data['display_image'] = 'https://via.placeholder.com/744x432/FF0000/FFFFFF?Text='.Str::snake($data['name']);
        }
        $contentTitle = $data['name'] ?? $shows->name;
        $shows->categories_id = $data['categories_id'];
        $shows->fill($data)->save();
        ($has)? Alert::info('You have successfully update '.ucfirst(config('app.path.show')).': '.$contentTitle) :
            Alert::info('You have successfully create '.ucfirst(config('app.path.show')).': '.$contentTitle);
        return  ($has)? redirect()->route('platform.show.list') : redirect()->route('platform.show.edit', $shows->id);

    }





    // Modal Methods

    /**
     * @param Shows $shows
     * @param Category $category
     * @param Request $request
     * @return RedirectResponse
     */
    public function createCategoryModal(Shows $shows,Category $category, Request $request)
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
        Alert::info('You have successfully created a'.ucfirst(config('app.path.category')));
        return redirect()->route('platform.show.edit',$shows->id);
    }


    /**
     * @param Shows $shows
     * @param Tags $tags
     * @param Request $request
     * @return RedirectResponse
     */
    public function createTagsModal(Shows $shows,Tags $tags, Request $request)
    {

        $tags->fill($request->get('tag'))->save();

        Alert::success('You have successfully created a'.ucfirst(config('app.path.tag')));

        return redirect()->route('platform.show.edit',$shows->id);

    }


    /**
     * @param Shows $shows
     * @return RedirectResponse
     */
    public function remove(Shows $shows)
    {

        $_title = $shows->name;

        $shows->delete();
        Alert::warning('You have successfully deleted the '.ucfirst(config('app.path.show')).': '.$_title);
        return redirect()->route('platform.show.list');
    }













}
