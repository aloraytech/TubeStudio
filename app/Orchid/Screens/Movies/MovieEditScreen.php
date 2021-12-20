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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $videoID
 * @property $movie
 */
class MovieEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Movie Creation';
    private bool $exists;

    /**
     * Query data.
     * @param Movies $movies
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
            if(empty($movies->display_image))
            {
                $movies->display_image = "https://via.placeholder.com/744x432.png?text=744X432";
            }
            if(empty($movies->banner))
            {
                $movies->banner = "https://via.placeholder.com/1930x1080.png?text=1920X1080";
            }
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

            ModalToggle::make('Replace Video')
                ->modal('movieVideoUpdateModal')
                ->method('replaceVideoOfThisMovie')
                ->icon('full-screen')
                //->asyncParameters('Hello world!')
                ->canSee($this->exists),

            Link::make('Edit Video Details')
                ->icon('note')
                ->route('platform.video.edit',[$this->videoID])
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

            Layout::rows([
                Input::make('url')->type('url')
                    ->title('Video Url')
                    ->placeholder('Paste video link here')
                    ->help('Specify a valid video link for generate movie')->required(),
                Select::make('movie.categories_id')->fromModel(Category::class, 'name','id')
                    ->title('Select Category')->required(),
            ])->canSee(!$this->exists)->title('Place Video Url'),

            MovieEditLayout::class,

            Layout::rows([
                Group::make([
                Cropper::make('movie.banner')
                    ->title('Banner')
                    ->placeholder('Add Banner Image')
                    ->minCanvas(1000)
                    ->maxWidth(1920)
                    ->maxHeight(1080)
                    ->targetRelativeUrl(),
                Cropper::make('movie.display_image')
                    ->title('Display Image')
                    ->placeholder('Add Display Image')
                    ->minCanvas(744)
                    ->maxWidth(744)
                    ->maxHeight(432)
                    ->targetRelativeUrl()
                ])->fullWidth(),
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
     * @return RedirectResponse|void
     */
    public function createOrUpdate(Movies $movie, Request $request)
    {

        $creation = $movie->exists;
        if (isset($request->url))
        {
            // Create
            $grabber = new VideoGrabber($request->url);
            if(!$grabber->exist())
            {
                if ($grabber->resolve())
                {
                    // Create Video
                    $grabberData = $movie->videos()->create($grabber->getVideo());
                    $movie->videos_id = $grabberData->id;
                    //dd($movies->videos());
                    // Create
                    $data = $request->get('movie');
                    $data['name'] = $grabberData->title;
                    $data['banner'] = $grabberData->thumb_url;
                    $data['display_image'] = $grabberData->thumb_url;
                    // Fix For Categories ID
                    $movie->categories_id = $data['categories_id'];
                    $movie->release_on = now();
                    $movie->quality = '240p';
                    $movie->duration = '00:00:00';
                    $movie->fill($data)->save();
                    //$movie->save();
                    $contentTitle = $data['name'] ?? $movie->name;

                    if($creation)
                    {
                        Alert::success('You have successfully Update '.$contentTitle);
                    }else{
                        Alert::success('You have successfully Create '.$contentTitle);
                    }
                    return redirect()->route('platform.movie.edit', $movie->id);
                }
            }else{
                Alert::warning('A Movie already exist with this video url : <i>'.$request->url.'</i>');
                return redirect()->route('platform.movie.list');
            }

        }else{
            // Update
            $data = $request->get('movie');

            if(empty($data['banner'])){$data['banner'] = 'https://via.placeholder.com/1920x1080/FF0000/FFFFFF?Text='.Str::snake($data['name']);}
            if(empty($data['display_image'])){$data['display_image'] = 'https://via.placeholder.com/744x432/FF0000/FFFFFF?Text='.Str::snake($data['name']);}

            if(empty($data['release_on'])){$data['release_on'] = now();}
            if(empty($data['duration'])){$data['duration']='00:00:00';}
            $movie->fill($data)->save();
            Alert::success('You have successfully Update a Movie.');
            return redirect()->route('platform.movie.list');
        }
    }


    /**
     * @param Movies $movie
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function replaceVideoOfThisMovie(Movies $movie,Request $request)
    {
        $this->exists = $movie->exists;
        if(isset($request->url))
        {
            $grabber = new VideoGrabber($request->url);
            if($grabber->resolve())
            {
                $grabberData = $grabber->getVideo();
                $movie->videos()->update($grabber->getVideo());

                $movie->name = $grabberData['title'];
                $movie->banner = $grabberData['thumb_url'];
                $movie->save();

                if($this->exists)
                {
                    Alert::success('You have successfully Replace a Video.');
                }else{
                    Alert::warning('A Movie already exist with this video.');
                }
                return redirect()->route('platform.movie.edit',$movie->id);
            }
        }

    }





    // Modal Methods

    /**
     * @param Movies $movies
     * @param Category $category
     * @param Request $request
     * @return RedirectResponse
     */
    public function createCategory(Movies $movies,Category $category, Request $request)
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
        Alert::info('You have successfully created an Category.');
        //    return redirect()->route('platform.movie.list');
        return redirect()->route('platform.movie.edit',$movies->id);
    }


    /**
     * @param Movies $movies
     * @param Tags $tags
     * @param Request $request
     * @return RedirectResponse
     */
    public function createTags(Movies $movies,Tags $tags, Request $request)
    {
        $tags->fill($request->get('tag'))->save();
        Alert::success('You have successfully created an tag.');
        return redirect()->route('platform.movie.edit',$movies->id);
    }


    /**
     * @param Movies $movies
     * @return RedirectResponse
     */
    public function remove(Movies $movies)
    {
        $_title = $movies->name;
        $movies->delete();
        Alert::warning('You have successfully deleted the movie : '.$_title);
        return redirect()->route('platform.movie.list');
    }


}
