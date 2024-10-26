<?php

namespace App\Orchid\Layouts\Essence;

use App\Models\Essence;
use App\Enum\EssenceDisplayTypeEnum;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EssenceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'essences';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Название')
                ->width(350)
                ->render(function (Essence $essence) {
                    return Link::make($essence->name)
                        ->route('platform.essence.edit', $essence);
                }),

            TD::make('sort', 'Сортировка')
                ->width(50)
                ->render(function (Essence $essence) {
                    return Link::make($essence->sort)
                        ->route('platform.essence.edit', $essence);
                }),
        ];
    }
}
