<?php

namespace App\Orchid\Layouts\Page;

use App\Models\Category\Category;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PageEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'page';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [];
    }

    protected function fields(): array
    {
        return [


            Group::make([

                Input::make('page.title')->title('Title')->required(),


                Select::make('page.position')
                    ->options([
                        '0'   => 'Set Zero',
                    ])
                    ->title('Set Position')->required()
                    ->canSee($this->query->get('custom')),

                Select::make('page.position')
                    ->options([
                        '1'   => 'Set 1',
                        '2'   => 'Set 2',
                        '3'   => 'Set 3',
                        '4'   => 'Set 4',
                        '5'   => 'Set 5',
                        '6'   => 'Set 6',
                        '7'   => 'Set 7',
                        '8'   => 'Set 8',
                        '9'   => 'Set 9',
                        '10'   => 'Set 10',
                    ])
                    ->title('Set Position')->required()
                    ->canSee(!$this->query->get('custom')),




            ])->fullWidth(),



            Group::make([

                Input::make('page.url')->title('Url')->disabled(),
                Input::make('page.target')->title('Target')->type('url')->canSee($this->query->get('custom')),

            ])->fullWidth(),

            Group::make([

                Switcher::make('page.status')
                    ->sendTrueOrFalse()
                    ->title('Publish')
                    ->help('Show on website'),

                Switcher::make('page.default_view')
                    ->sendTrueOrFalse()
                    ->title('Default')
                    ->help('Show on website'),

            ])->fullWidth(),


            Quill::make('page.desc')->toolbar(["text", "color", "header", "list", "format"])
                ->title('Description')->canSee($this->query->get('custom')),




        ];
    }
}
