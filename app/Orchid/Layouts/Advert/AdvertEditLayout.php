<?php

namespace App\Orchid\Layouts\Advert;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AdvertEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'advert';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }

    /**
     * @return Field[]
     */
    protected function fields(): array
    {
        return [


            Group::make([

                Input::make('advert.name')->title('Name')->type('text')->required(),



                Select::make('advert.provider')
                    ->options([
                        'global'   => 'Global Ads Providers [GOOGLE]',
                        'private'   => 'Private Ads Provider [OWN]',

                    ])
                    ->title('Set Provider')->required(),
            ])->fullWidth(),


            Select::make('advert.position')
                ->options([
                    'top' => ' Top ',
                    'right_side' => ' Right ',
                    'left_side' => ' Left ',
                    'in_desc' => ' Between Desc ',
                    'footer' => ' Footer ',
                ])->autocomplete()->horizontal()
                ->title('Set Position')->required(),


            Group::make([

                Input::make('advert.target_url')->title('Set Url')->type('url')->canSee($this->query->get('custom')),
                Input::make('advert.target_view')->title('Set Views')->canSee($this->query->get('custom')),
                Input::make('advert.target_click')->title('Set Clicks')->canSee($this->query->get('custom')),
            ])->fullWidth(),

            Group::make([
                Input::make('advert.target_country')->title('Set Country')->help('Country Not Applicable')->disabled()->canSee($this->query->get('custom')),
                Input::make('advert.views')->title('Views Progress')->disabled(),
                Input::make('advert.clicks')->title('Clicks Progress')->disabled(),
            ])->fullWidth(),

            Switcher::make('advert.status')
                ->sendTrueOrFalse()
                ->title('Publish')
                ->help('Show on website'),

            Group::make([

                TextArea::make('advert.code')->title('Code')->rows(15),
                Cropper::make('advert.banner')
                    ->title('Banner')
                    ->placeholder('Add Custom Banner Image')
                    ->minCanvas(1000)
                    ->maxWidth(1920)
                    ->maxHeight(1080)
                    ->targetRelativeUrl()->canSee($this->query->get('custom')),
            ])->fullWidth(),









        ];
    }
}
