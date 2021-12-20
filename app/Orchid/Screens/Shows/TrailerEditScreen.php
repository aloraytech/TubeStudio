<?php

namespace App\Orchid\Screens\Shows;

use App\Helpers\Grabber\VideoGrabber;
use App\Models\Movies\Movies;
use App\Models\Shows\Trailers;
use App\Orchid\Layouts\Movies\WhichVideoDetailsLayout;
use App\Orchid\Layouts\Shows\TrailerEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

/**
 * @property $exists
 * @property $name
 * @property $description
 * @property $trailer
 */
class TrailerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'TrailerEditScreen';

    /**
     * Query data.
     *
     * @param Trailers $trailers
     * @return array
     */
    public function query(Trailers $trailers): array
    {
        $trailers->load('videos');
        $this->name = "Trailer Modification";
        $this->trailer = $trailers;
        $this->exists = $trailers->exists;

        return [
            'trailer' => $trailers,
            'exists' => $this->exists,
            'content'=>$trailers,
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

            Button::make('Save')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),




            Link::make('Edit Video Details')
                ->icon('note')
                ->route('platform.video.edit',[$this->trailer->videos_id])
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
            TrailerEditLayout::class,

            Layout::rows([
                Group::make([
                    Cropper::make('trailer.display_image')
                        ->title('Display Image')
                        ->placeholder('Add Display Image')
                        ->minCanvas(744)
                        ->maxWidth(744)
                        ->maxHeight(432)
                        ->targetRelativeUrl()
                ])->fullWidth(),
            ])->canSee($this->exists),


            WhichVideoDetailsLayout::class,

        ];
    }


    /**
     * @param Trailers $trailer
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function createOrUpdate(Trailers $trailer, Request $request)
    {
        $data = $request->get('trailer');
        if(empty($data['display_image'])){$data['display_image'] = 'https://via.placeholder.com/744x432/FF0000/FFFFFF?Text='.Str::snake($data['name']);}
        $trailer->fill($data)->save();
        $contentTitle = $data['name'] ?? $trailer->name;

        Alert::success('You have successfully Update '.ucfirst(config('app.path.trailer')).$contentTitle);
        return redirect()->route('platform.trailer.list', $trailer->seasons_id);
    }


    /**
     * @param Trailers $trailer
     * @return RedirectResponse
     */
    public function remove(Trailers $trailer)
    {

        $_title = $trailer->name;

        $trailer->delete();
        Alert::warning('You have successfully deleted the : '.ucfirst(config('app.path.trailer')).$_title);
        return redirect()->route('platform.trailer.list');
    }




}
