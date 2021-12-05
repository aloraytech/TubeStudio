<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Shows\Episodes;
use App\Orchid\Layouts\Movies\VideoModalLayout;
use App\Orchid\Layouts\Shows\EpisodeEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EpisodeEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'EpisodeEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Episodes $episodes): array
    {

        $this->exists = $episodes->exists;
        $episodes->load('videos');

        return [
            'episode' => $episodes,
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


            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),


            ModalToggle::make('Replace Video')
                ->modal('episodeVideoUpdateModal')
                ->method('replaceEpisodeVideo')
                ->icon('full-screen')
                //->asyncParameters('Hello world!')
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
            EpisodeEditLayout::class,

            // Movie Video Modal
            Layout::modal('episodeVideoUpdateModal', [
                VideoModalLayout::class
            ])->title('Replace Video'),


            Layout::rows([


                Group::make([
                    Input::make('episode.videos.title')
                        ->title('Video Title')
                        ->placeholder('Attractive but mysterious name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),

                    Input::make('episode.videos.channel')
                        ->title('Channel Name')
                        ->placeholder('Attractive but mysterious Channel name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),
                ])->fullWidth(),

                Group::make([
                    TextArea::make('episode.videos.code')
                        ->title('Html')
                        ->placeholder('Attractive but mysterious Channel name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),
                    Input::make('episode.videos.provider')
                        ->title('Provider')
                        ->placeholder('Attractive but mysterious Channel name')
                        ->help('Specify a short descriptive title for this name.')->disabled(true),

                ])->fullWidth(),



            ])->title('Available Video')->canSee($this->exists),


        ];
    }


    /**
     * @param Episodes $episodes
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function createOrUpdate(Episodes $episodes, Request $request)
    {


        if (isset($request->url)) {
            $grabber = new VideoGrabber($request->url);
            if ($grabber->resolve()) {
                // Create Video
                $vids = $episodes->videos()->create($grabber->getVideo());


                $episodes->videos_id = $vids->id;

                //dd($movies->videos());
                // Create
                $data = $request->get('video');
                $data['name'] = $vids->title;
                $data['banner'] = $vids->thumb_url;
                // Fix For Categories ID
                //$episodes->season_id = $data['categories_id'] ?? 1;
                $episodes->name = $vids->title;
                $episodes->banner = $vids->thumb_url;
                $episodes->fill($data)->save();
                //$movie->save();


                Alert::info('You have successfully Replace a Video.');
                return redirect()->route('platform.episode.edit', $episodes->id);
            }
        }
    }







    public function replaceEpisodeVideo(Episodes $episodes,Request $request)
    {

        if(isset($request->url))
        {
            $grabber = new VideoGrabber($request->url);
            if($grabber->resolve())
            {
                $vids = $grabber->getVideo();
                //dd($movies->videos());
                 $episodes->videos()->update($grabber->getVideo());

//                $episodes->videos_id = $vids->id;

                //dd($movies->videos());
                // Create
//                $data = $request->get('video');
//                $data['name'] = $vids->title;
//                $data['banner'] = $vids->thumb_url;
                // Fix For Categories ID
                //$episodes->season_id = $data['categories_id'] ?? 1;
                $episodes->name = $vids['title'];
                $episodes->banner = $vids['thumb_url'];
                $episodes->save();

                Alert::info('You have successfully Replace a Video.');
                return redirect()->route('platform.episode.edit',$episodes->id);
            }
        }

    }









}
