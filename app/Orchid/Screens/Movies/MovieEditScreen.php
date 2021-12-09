<?php

namespace App\Orchid\Screens\Movies;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Category\Category;
use App\Models\Category\Tags;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Orchid\Layouts\Category\CategoryEditLayout;
use App\Orchid\Layouts\Category\CategoryModalLayout;
use App\Orchid\Layouts\Movies\MovieEditLayout;
use App\Orchid\Layouts\Movies\VideoModalLayout;
use App\Orchid\Layouts\Movies\WhichVideoDetailsLayout;
use App\Orchid\Layouts\Tags\TagModalLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MovieEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Movie Creation';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Movies $movies): array
    {

        $this->exists = $movies->exists;
        $this->videoID = null;
        $this->movie = $movies;
        if ($this->exists) {
            $this->name = 'Movie Modification';
            $this->description = 'Edit your case study details';
            $movies->load(['categories','videos',]);
            $this->videoID = $movies->videos->id;
        }

        return [
            'movie' => $movies,
            'exists'=>$this->exists,
            'content'=>$movies,
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
            Button::make('Add New')
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

            ModalToggle::make('Replace Video')
                ->modal('movieVideoUpdateModal')
                ->method('replaceMovieVideo')
                ->icon('full-screen')
                //->asyncParameters('Hello world!')
                ->canSee($this->exists),

            Link::make('Modify Video')
                ->icon('note')
                ->route('platform.video.edit',[$this->videoID])
                ->canSee($this->exists),

            ModalToggle::make('Add Tags')
                ->modal('asyncTagsModal')
                ->method('createTagsModal')
                ->icon('full-screen'),


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

            Layout::rows([
                Input::make('url')->type('url')
                    ->title('Video Url')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for the event'),

            ])->canSee(!$this->exists)->title('Place Video Url'),

            MovieEditLayout::class,

            Layout::rows([
                Cropper::make('movie.banner')
                    ->title('Movie Banner')
                    ->placeholder('Add Image')
                    ->minCanvas(500)
                    ->maxWidth(1000)
                    ->maxHeight(800)
                    ->targetRelativeUrl()
            ])->canSee($this->exists),


            Layout::modal('asyncCategoryModal', [
                CategoryEditLayout::class
            ])->title('Manage Category'),


            Layout::modal('asyncTagsModal', [
                TagModalLayout::class
            ])->title('Manage Tags'),



            // Movie Video Modal
            Layout::modal('movieVideoUpdateModal', [
                VideoModalLayout::class
            ])->title('Replace Video'),

            WhichVideoDetailsLayout::class,
        ];
    }



    // Methods


    /**
     * @param Movies $movie
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Movies $movie, Request $request)
    {


        if (isset($request->url)) {
            $grabber = new VideoGrabber($request->url);
            if ($grabber->resolve()) {
                // Create Video
                $vids = $movie->videos()->create($grabber->getVideo());


                $movie->videos_id = $vids->id;

                //dd($movies->videos());
                // Create
                $data = $request->get('movie');
                $data['name'] = $vids->title;
                $data['banner'] = $vids->thumb_url;
                // Fix For Categories ID
                $movie->categories_id = $data['categories_id'] ?? 1;
                $movie->fill($data)->save();
                //$movie->save();


                Alert::info('You have successfully Replace a Video.');
                return redirect()->route('platform.movie.edit', $movie->id);
            }
        }
    }












    public function replaceMovieVideo(Movies $movies,Request $request)
    {
        if(isset($request->url))
        {
            $grabber = new VideoGrabber($request->url);
            if($grabber->resolve())
            {
                $vids = $grabber->getVideo();
                $movies->videos()->update($grabber->getVideo());

                $movies->name = $vids['title'];
                $movies->banner = $vids['thumb_url'];
                $movies->save();


                Alert::info('You have successfully Replace a Video.');
                return redirect()->route('platform.movie.edit',$movies->id);
            }
        }

    }


    public function createMovieVideo(Movies $movies,Request $request)
    {
        if(isset($request->url))
        {
            $grabber = new VideoGrabber($request->url);
            if($grabber->resolve())
            {
                $data =[

                ];

                //dd($movies->videos());
                $movies->videos()->create($grabber->getVideo());


                Alert::info('You have successfully Replace a Video.');
                return redirect()->route('platform.movie.list',$movies->id);
            }
        }

    }



    // Modal Methods

    /**
     * @param Category $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCategoryModal(Movies $movies,Category $category, Request $request)
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

//            $category->banners()->updateOrCreate(
//                [$images],
//            );


        }
        Alert::info('You have successfully created an Category.');
        //    return redirect()->route('platform.movie.list');
        return redirect()->route('platform.movie.edit',$movies->id);
    }


    /**
     * @param Tags $tags
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTagsModal(Movies $movies,Tags $tags, Request $request)
    {

        $tags->fill($request->get('tag'))->save();

        Alert::success('You have successfully created an tag.');

        return redirect()->route('platform.movie.edit',$movies->id);

    }






}
