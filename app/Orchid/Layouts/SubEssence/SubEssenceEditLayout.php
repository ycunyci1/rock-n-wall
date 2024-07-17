<?php

namespace App\Orchid\Layouts\SubEssence;

use App\Models\Essence;
use App\Models\Product;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;

class SubEssenceEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'subEssence';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('subEssence.name')
                ->title('Название'),

            Select::make('subEssence.main_product_id')
                ->title('Основное изображение')
                ->fromModel(Product::class, 'name', 'id')
                ->empty('Не выбрано'),

            Select::make('subEssence.essence_id')
                ->title('Раздел')
                ->fromModel(Essence::class, 'name', 'id')
                ->empty('Не выбрано'),

            Input::make('subEssence.sort')
                ->title('Сортировка')
                ->type('number'),
        ];
    }
}
