<?php

namespace App\Orchid\Layouts\Tag;

use App\Models\Essence;
use App\Models\Tag;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TagListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tags';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Тэг')
                ->width(350)
                ->render(function (Tag $tag) {
                    return Link::make($tag->name)
                        ->route('platform.tag.edit', $tag);
                }),
        ];
    }
}
