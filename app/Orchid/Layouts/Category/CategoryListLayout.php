<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
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
        return [

            TD::make('banner', 'Display')->render(function ($category) {
                $image = '<img src="'.$category->banner.'" height="100px" width="150px" class="rounded">';
                return '<a href="'.route('platform.category.edit', $category).'">'.$image.'</a>';
            })->sort(),

            TD::make('name', 'Name')
                ->sort()
                ->render(function (Category $category) {
                    return Link::make($category->name)
                        ->route('platform.category.edit', $category);
                }),
            TD::make('type', 'Type')->render(function ($category) {
                return $category->type;
            })->sort(),
            TD::make('status', 'Status')->render(function ($category) {
                return ($category->status) ? 'Active':'DeActive';
            })->sort(),
            TD::make('updated_at', 'Modified')->render(function ($category) {
                return $category->updated_at;
            })->sort(),


        ];
    }



    /**
     * @return string
     */
    protected function iconNotFound(): string
    {
        return 'table';
    }

    /**
     * @return string
     */
    protected function textNotFound(): string
    {
        return __('There are no records in this view');
    }

    /**
     * @return string
     */
    protected function subNotFound(): string
    {
        return '';
    }

    /**
     * @return bool
     */
    protected function striped(): bool
    {
        return true;
    }





}
