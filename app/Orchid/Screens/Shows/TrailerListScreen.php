<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Models\Shows\Seasons;
use App\Models\Shows\Trailers;
use App\Orchid\Layouts\Movies\VideoModalLayout;
use App\Orchid\Layouts\Movies\WhichVideoDetailsLayout;
use App\Orchid\Layouts\Shows\TrailerListLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $exists
 * @property $name
 * @property $description
 * @property $season
 */
class TrailerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'TrailerListScreen';

    /**
     * Query data.
     *
     * @param Seasons $seasons
     * @return array
     */
    public function query(Seasons $seasons): array
    {
        $seasons->load('trailers','trailers.videos');
        $this->season = $seasons;
        return [
            'trailers' => $seasons->trailers,
            'seasons'=> $seasons,
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
            Link::make('Back All Season')
                ->icon('note')
                ->route('platform.season.list',[$this->season->shows_id]),

            ModalToggle::make('New Trailer')
                ->modal('asyncTrailerModal')
                ->method('createOrUpdate')
                ->icon('layers'),


        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            TrailerListLayout::class,

            Layout::modal('asyncTrailerModal', [
                VideoModalLayout::class
            ])->title('Add Trailer'),
        ];
    }


    /**
     * @param Seasons $seasons
     * @param Request $request
     *
     * @return RedirectResponse|void
     */
    public function createOrUpdate(Seasons $seasons, Request $request)
    {

        $creation = $seasons->exists;
        if (isset($request->url))
        {
            // Create
            $grabber = new VideoGrabber($request->url);
            if(!$grabber->exist())
            {
                if ($grabber->resolve())
                {
                    // Create Video

                    $video = new Videos();
                    $video->fill($grabber->getVideo())->save();

                    // Create Trailer
                    $trailer = new Trailers();
                    $trailer->name = $video->title;
                    $trailer->videos_id = $video->id;
                    $trailer->seasons_id =  $seasons->id;
                    $trailer->duration = '00:00:00';
                    $trailer->status = true;
                    $trailer->display_image  = $video->thumb_url;
                    $trailer->save();


                    $contentTitle = $data['name'] ?? $trailer->name;

                    if($creation)
                    {
                        Alert::success('You have successfully Update '.ucfirst(config('app.path.trailer')).$contentTitle);
                    }else{
                        Alert::success('You have successfully Create '.ucfirst(config('app.path.trailer')).$contentTitle);
                    }
                    return redirect()->route('platform.trailer.edit', $trailer);
                }
            }else{
                Alert::warning('A Trailer already exist with this video url : <i>'.$request->url.'</i>');
                return redirect()->route('platform.trailer.list',$seasons);
            }

        }
    }






}
