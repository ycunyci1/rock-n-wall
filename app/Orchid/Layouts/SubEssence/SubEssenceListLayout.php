<?php

namespace App\Orchid\Layouts\SubEssence;

use App\Models\Product;
use App\Models\SubEssence;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SubEssenceListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'subEssences';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Название')
                ->width(250)
                ->render(function (SubEssence $subEssence) {
                    return Link::make($subEssence->name)
                        ->route('platform.subEssence.edit', $subEssence);
                }),

            TD::make('main_product_id', 'Основное изображение')
                ->width(50)
                ->render(function (SubEssence $subEssence) {
                    $link = route('platform.subEssence.edit', $subEssence);
                    return "<a href=$link><img src={$subEssence->mainProduct->image} width='150' height='150'></a>";
                }),
            TD::make('essence_id', 'Раздел')
                ->width(50)
                ->render(function (SubEssence $subEssence) {
                    return Link::make($subEssence->essence->name)
                        ->route('platform.subEssence.edit', $subEssence);
                }),
            TD::make('sort', 'Сортировка')
                ->width(50)
                ->render(function (SubEssence $subEssence) {
                    return Link::make($subEssence->sort)
                        ->route('platform.subEssence.edit', $subEssence);
                }),
        ];
    }
}
