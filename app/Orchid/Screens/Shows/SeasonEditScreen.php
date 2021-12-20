<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Models\Shows\Episodes;
use App\Models\Shows\Seasons;
use App\Models\Shows\Trailers;
use App\Orchid\Layouts\Movies\VideoModalLayout;
use App\Orchid\Layouts\Shows\EpisodeForSeasonModalLayout;
use App\Orchid\Layouts\Shows\SeasonEditLayout;
use App\Orchid\Layouts\Shows\SeasonEpisodeListLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $season
 * @property $exists
 * @property $name
 * @property $description
 */
class SeasonEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SeasonEditScreen';

    /**
     * Query data.
     *
     * @param Seasons $seasons
     * @return array
     */
    public function query(Seasons $seasons): array
    {



        $seasons->load('episodes','trailers','trailers.videos');
        $this->exists = $seasons->exists;
        $this->season = $seasons;
        return [
            'season' => $seasons,
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


            Link::make('Available Trailers')->route('platform.trailer.list',$this->season)
                ->icon('note')
                //->method('createOrUpdate')
                ->canSee($this->exists),


            ModalToggle::make('Add Episode')
                ->modal('episodeForSeasonModal')
                ->method('createEpisodeForSeason')
                ->icon('layers')
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

            // Show Trailer Modal
//            Layout::modal('asyncTrailersModal', [
//                ShowTrailerEditModalLayout::class
//            ])->title('Modify Trailer')->canSee($this->exists),
//
//            // Movie Video Modal
//            Layout::modal('showTrailerCreateModal', [
//                ShowTrailerModalLayout::class
//            ])->title('Set Video')->canSee($this->exists),

            SeasonEditLayout::class,

            SeasonEpisodeListLayout::class,



            // Movie Video Modal
            Layout::modal('episodeForSeasonModal', [
                VideoModalLayout::class
            ])->title('Add Episode For ' . $this->season->name),
        ];
    }




    /**
     * METHODS
     */


    /**
     * @param Seasons $season
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Seasons $season, Request $request)
    {


        $creation = $season->exists;

        $data = $request->get('season');
        $contentTitle = $data['name'] ?? $season->name;

        $season->fill($data)->save();
        if($creation)
        {
            Alert::success('You have successfully Update '.ucfirst(config('app.path.season')).': '.$contentTitle);
        }else{
            Alert::success('You have successfully Create '.ucfirst(config('app.path.season')).': '.$contentTitle);
        }

        return redirect()->route('platform.season.list',$season->shows_id);

    }






    /**
     * @param Seasons $seasons
     * @param Request $request
     *
     * @return RedirectResponse|void
     */
        public function createEpisodeForSeason(Seasons $seasons, Request $request)
        {

            $creation = $seasons->exists;
            if (isset($request->url)) {
                // Create
                $grabber = new VideoGrabber($request->url);
                if (!$grabber->exist()) {
                    if ($grabber->resolve()) {
                        // Create Video

                        $video = new Videos();
                        $video->fill($grabber->getVideo())->save();

                        // Create Trailer
                        $episode = new Episodes();
                        $episode->name = $video->title;
                        $episode->videos_id = $video->id;
                        $episode->seasons_id = $seasons->id;
                        $episode->duration = '00:00:00';
                        $episode->release_on = now();
                        $episode->status = true;
                        $episode->display_image = $video->thumb_url;
                        $episode->save();


                        $contentTitle = $data['name'] ?? $episode->name;

                        if ($creation) {
                            Alert::success('You have successfully Update '.ucfirst(config('app.path.episode')).': ' . $contentTitle);
                        } else {
                            Alert::success('You have successfully Create '.ucfirst(config('app.path.episode')).': ' . $contentTitle);
                        }
                        return redirect()->route('platform.episode.edit', $episode);
                    }
                } else {
                    Alert::warning('A Episode already exist with this video url : <i>' . $request->url . '</i>');
                    return redirect()->route('platform.season.list', $seasons);
                }

            }
        }


    /**
     * @param Seasons $seasons
     * @return RedirectResponse
     */
    public function remove(Seasons $seasons)
    {

        $_title = $seasons->name;
        $_show = $seasons->shows_id;
        $seasons->delete();
        Alert::warning('You have successfully deleted the '.ucfirst(config('app.path.season')).': '.$_title);
        return redirect()->route('platform.season.list',$_show);
    }







    }
