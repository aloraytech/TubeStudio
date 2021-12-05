<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Movies\Videos;
use App\Models\Shows\Seasons;
use App\Models\Shows\Shows;
use App\Models\Shows\Trailers;
use App\Orchid\Layouts\Shows\ShowEditLayout;
use App\Orchid\Layouts\Shows\ShowSeasonsListLayout;
use App\Orchid\Layouts\Shows\ShowTrailerEditModalLayout;
use App\Orchid\Layouts\Shows\ShowTrailerModalLayout;
use App\Orchid\Layouts\Shows\ShowTrailersListLayout;
use Illuminate\Http\Request;
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
     * @return array
     */
    public function query(Shows $shows): array
    {

        $this->exists = $shows->exists;

        if ($this->exists) {
            $this->name = 'Shows Modification';
            $this->description = 'Edit/Modify This Show details';
            $shows->load('seasons','trailers','trailers.videos','categories');
            $this->showID = $shows->id;
        }



        return [
            'show' => $shows,
            'exists' => $this->exists,
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

            Link::make('Available Seasons')
                ->icon('note')
                ->href($this->showID.'/seasons')
                ->parameters(['show_id'=> $this->showID])
                //->method('createOrUpdate')
                ->canSee($this->exists),

            ModalToggle::make('Add Tags')
                ->modal('createTagsModal')
                ->method('createTagsModal')
                ->icon('layers'),


            ModalToggle::make('Add Category')
                ->modal('createCategoryModal')
                ->method('createCategoryModal')
                ->icon('layers'),


            ModalToggle::make('Set Trailer')
                ->modal('showTrailerCreateModal')
                ->method('createShowTrailer')
                ->icon('film')
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
            ShowEditLayout::class,

            // Show Trailer Modal
            Layout::modal('asyncTrailersModal', [
                ShowTrailerEditModalLayout::class
            ])->title('Modify Trailer'),

            // Movie Video Modal
            Layout::modal('showTrailerCreateModal', [
                ShowTrailerModalLayout::class
            ])->title('Set Video'),


            Layout::rows([
                Group::make([
                    Cropper::make('show.banner')
                        ->title('Show Banner')
                        ->placeholder('Add Image')
                        ->minCanvas(500)
                        ->maxWidth(1000)
                        ->maxHeight(800)
                        ->targetRelativeUrl(),


                    Cropper::make('show.display_image')
                        ->title('Show Display Image')
                        ->placeholder('Add Image')
                        ->minCanvas(500)
                        ->maxWidth(1000)
                        ->maxHeight(800)
                        ->targetRelativeUrl(),

                ])->fullWidth(),
            ])->canSee($this->exists),

                ShowTrailersListLayout::class,

             //   ShowSeasonsListLayout::class,










        ];
    }


    // Methods


    /**
     * @param Shows $shows
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Shows $shows, Request $request)
    {


        if (isset($request->url)) {
            $grabber = new VideoGrabber($request->url);

            dd($request);
            if ($grabber->resolve()) {
                // Create Video
                $vids = $shows->trailers()->create($grabber->getVideo());


                $shows->videos_id = $vids->id;

                //dd($movies->videos());
                // Create
                $data = $request->get('show');
//                $data['name'] = $vids->title;
//                $data['banner'] = $vids->thumb_url;
                // Fix For Categories ID
                $shows->categories_id = $data['categories_id'];
                $shows->fill($data)->save();
                //$movie->save();


                Alert::info('You have successfully update a show.');
                return redirect()->route('platform.show.edit', $shows->id);
            }
        }
    }
























    }
