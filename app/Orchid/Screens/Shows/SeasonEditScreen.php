<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Orchid\Layouts\Shows\EpisodeForSeasonModalLayout;
use App\Orchid\Layouts\Shows\SeasonEditLayout;
use App\Orchid\Layouts\Shows\SeasonEpisodeListLayout;
use App\Orchid\Layouts\Shows\SeasonForShowModalLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

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
     * @return array
     */
    public function query(Seasons $seasons): array
    {
        $seasons->load('episodes');
        $this->exists = $seasons->exists;
        $this->season = $seasons;
        return [
            'seasons' => $seasons,
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

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
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
            SeasonEditLayout::class,

            SeasonEpisodeListLayout::class,

            // Movie Video Modal
            Layout::modal('episodeForSeasonModal', [
                EpisodeForSeasonModalLayout::class
            ])->title('Add Episode For ' . $this->season->name),
        ];
    }






        /**
         * @param Movies $movie
         * @param Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function createEpisodeForSeason(Seasons $seasons, Request $request)
        {

            dd($request->url);

            if (isset($request->url)) {
                $grabber = new VideoGrabber($request->url);
                if ($grabber->resolve()) {
                    // Create Video
                    $vids = $seasons->videos()->create($grabber->getVideo());


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













    }
