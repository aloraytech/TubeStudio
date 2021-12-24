<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category\Category;
use Illuminate\Support\Str;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryModalLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'category';

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

            Input::make('category.name')->title('Name')->required(),

            Select::make('category.parent_id')->title('Parent '.Str::ucfirst(config('app.path.category')))
                ->fromQuery(Category::where('type', '=', $this->query->get('select')), 'name'),

            TextArea::make('category.desc')->title('Description'),




        ];


    }
}
