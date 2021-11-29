<?php

namespace App\Orchid\Screens\Movies;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Orchid\Layouts\Movies\MovieEditLayout;
use App\Orchid\Layouts\Movies\VideoModalLayout;
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
    public $name = 'MovieEditScreen';

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
            Button::make('Creation')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            ModalToggle::make('Set Video')
                ->modal('movieVideoCreateModal')
                ->method('createMovieVideo')
                ->icon('full-screen')
                //->asyncParameters('Hello world!')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
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



            // Movie Video Modal
            Layout::modal('movieVideoCreateModal', [
                VideoModalLayout::class
            ])->title('Set Video'),

            // Movie Video Modal
            Layout::modal('movieVideoUpdateModal', [
                VideoModalLayout::class
            ])->title('Replace Video'),

            Layout::rows([


                Group::make([
                    Input::make('movie.videos.title')
                        ->title('Video Title')
                        ->placeholder('Attractive but mysterious name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),

                    Input::make('movie.videos.channel')
                        ->title('Channel Name')
                        ->placeholder('Attractive but mysterious Channel name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),
                ])->fullWidth(),

                Group::make([
                    TextArea::make('movie.videos.code')
                        ->title('Html')
                        ->placeholder('Attractive but mysterious Channel name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),
                    Input::make('movie.videos.provider')
                        ->title('Provider')
                        ->placeholder('Attractive but mysterious Channel name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),

                ])->fullWidth(),



            ])->title('Available Video')->canSee($this->exists),



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

        // Create
        $data = $request->get('movie');
        // Fix For Categories ID
        $movie->categories_id = $data['categories_id'];
        $movie->fill($data)->save();


     //   $images = $request->input('movie.banner', []);
//        if ($images) {
//            $movie->banner()->syncWithoutDetaching(
//                $images
//            );
//        }
        Alert::info('You have successfully created an Video.');
        //    return redirect()->route('platform.movie.list');
        return redirect()->route('platform.movie.list');
    }







    public function replaceMovieVideo(Movies $movies,Request $request)
    {
        if(isset($request->url))
        {
            $grabber = new VideoGrabber($request->url);
            if($grabber->resolve())
            {
                //dd($movies->videos());
                $movies->videos()->update($grabber->getVideo());


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
                //dd($movies->videos());
                $movies->videos()->create($grabber->getVideo());


                Alert::info('You have successfully Replace a Video.');
                return redirect()->route('platform.movie.list',$movies->id);
            }
        }

    }













}
