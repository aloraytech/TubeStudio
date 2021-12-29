<?php

namespace App\Orchid\Screens\Movies;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Models\Shows\Episodes;
use App\Models\Shows\Trailers;
use App\Orchid\Layouts\Movies\VideoEditLayout;
use App\Orchid\Layouts\Movies\VideoModalLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class VideoEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'VideoEditScreen';

    /**
     * Query data.
     *
     * @param Videos $videos
     * @return array
     */
    public function query(Videos $videos): array
    {

        $this->exists = $videos->exists;

        if ($this->exists) {
            $this->name = 'Video Modification';
            $this->description = 'Modify Video Details';
          //  $this->videoID = $videos->id;
            $videos->load('attachment');
        }


        // dd($videos->attachment);

      //  dd($videos);
        return [
            'video' => $videos
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

            ModalToggle::make('Replace Video')
                ->modal('movieVideoModal')
                ->method('replaceVideo')
                ->icon('plus')
                //->asyncParameters('Hello world!')
                ->canSee($this->exists),

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
            VideoEditLayout::class,

            // Movie Video Modal
            Layout::modal('movieVideoModal', [
                VideoModalLayout::class
            ])->title('Set Video'),


        ];
    }




    // Methods


    /**
     * @param Videos $videos
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Videos $videos, Request $request)
    {
        // Create
        $data = $request->get('video');
        $videos->fill($data)->save();
        $images = $request->input('video.thumb_url', []);
        // Default Staff Promo

     //   dd($images);

//        if ($images) {
//            $videos->attachment()->syncWithoutDetaching(
//                $images
//            );
//        }


        // Multiple Return Handler
        $episode = Episodes::where('videos_id',$videos->id)->first();
        $trailer = Trailers::where('videos_id',$videos->id)->first();
        $movie = Movies::where('videos_id',$videos->id)->first();


        if(!is_null($trailer))
        {
            if($trailer->exists)
            {
                $trailer->name = $videos->title;
                $trailer->display_image = $videos->thumb_url;
                $trailer->save();
                Alert::info('You have successfully created a Trailer Video.');
                return redirect()->route('platform.season.edit',$trailer->seasons_id);
            }
        }elseif (!is_null($episode))
        {
            if ($episode->exists)
            {
                $episode->name = $videos->title;
                $episode->display_image = $videos->thumb_url;
                $episode->save();
                Alert::info('You have successfully created an Episode Video.');
                return redirect()->route('platform.season.edit',$episode->seasons_id);
            }
        }else {
            if (!is_null($movie) && $movie->exists) {
                $movie->name = $videos->title;
                $movie->display_image = $videos->thumb_url;
                $movie->banner = $videos->thumb_url;
                $movie->save();
                Alert::info('You have successfully created a Movie Video.');
                return redirect()->route('platform.movie.edit', $movie->id);
            } else {
                return redirect()->route('platform.main');
            }
        }


    }



    /**
     * @param Events $events
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Events $events)
    {
        $events->delete();
        Alert::info('You have successfully deleted the events.');
        return redirect()->route('platform.event.list');
    }


    /**
     * @param Videos $videos
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function replaceVideo(Videos $videos,Request $request)
    {
        if(isset($request->url))
        {
            $grabber = new VideoGrabber($request->url);
            if($grabber->resolve())
            {
                $videos->fill($grabber->getVideo())->save();
            }
        }


        // Multiple Return Handler
        $episode = Episodes::where('videos_id',$videos->id)->first();
        $trailer = Trailers::where('videos_id',$videos->id)->first();
        $movie = Movies::where('videos_id',$videos->id)->first();


        if(!is_null($trailer))
        {
            if($trailer->exists)
            {
                $trailer->name = $videos->title;
                $trailer->display_image = $videos->thumb_url;
                $trailer->save();
                Alert::info('You have successfully created a Trailer Video.');
                return redirect()->route('platform.season.edit',$trailer->seasons_id);
            }
        }elseif (!is_null($episode))
        {
            if ($episode->exists)
            {
                $episode->name = $videos->title;
                $episode->display_image = $videos->thumb_url;
                $episode->save();
                Alert::info('You have successfully created an Episode Video.');
                return redirect()->route('platform.season.edit',$episode->seasons_id);
            }
        }else {
            if (!is_null($movie) && $movie->exists) {
                $movie->name = $videos->title;
                $movie->display_image = $videos->thumb_url;
                $movie->banner = $videos->thumb_url;
                $movie->save();
                Alert::info('You have successfully created a Movie Video.');
                return redirect()->route('platform.movie.edit', $movie->id);
            } else {
                return redirect()->route('platform.main');
            }
        }

    }






}
