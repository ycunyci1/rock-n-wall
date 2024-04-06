<?php

namespace App\Orchid\Layouts\Essence;

use App\Models\Essence;
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
        $displayTypeMap = [
            0 => 'horizontal',
            1 => 'vertical',
        ];

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

            TD::make('display_type', 'Тип отображения')
                ->width(100)
                ->render(function (Essence $essence) use ($displayTypeMap) {
                    return Link::make(isset($displayTypeMap[$essence->display_type]) ? $displayTypeMap[$essence->display_type] : $essence->display_type)
                        ->route('platform.essence.edit', $essence);
                }),
        ];
    }
}
