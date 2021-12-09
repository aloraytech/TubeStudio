<?php

namespace App\Orchid\Layouts\System;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MemberListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'members';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
//            TD::make('name', 'Name')
//                ->sort()
//                ->render(function (Category $category) {
//                    return Link::make($category->name)
//                        ->route('platform.category.edit', $category);
//                }),

            TD::make('name', 'Name')->render(function ($members) {
                return $members->name;
            })->sort(),

            TD::make('email', 'Email')->render(function ($members) {
                return $members->email;
            })->sort(),
            TD::make('status', 'Status')->render(function ($members) {
                return ($members->status) ? 'Active':'DeActive';
            })->sort(),
            TD::make('updated_at', 'Modified')->render(function ($members) {
                return $members->updated_at;
            })->sort(),


        ];
    }
}
