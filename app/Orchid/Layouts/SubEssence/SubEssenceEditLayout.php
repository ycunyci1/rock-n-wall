<?php

namespace App\Orchid\Layouts\SubEssence;

use App\Models\Essence;
use App\Models\Product;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
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
                ->required()
                ->title('Название'),

            Picture::make('subEssence.image')
                ->required()
                ->title('Изображение'),

            Select::make('subEssence.essence_id')
                ->required()
                ->title('Раздел')
                ->fromModel(Essence::class, 'name', 'id')
                ->empty('Не выбрано'),

            Input::make('subEssence.sort')
                ->required()
                ->title('Сортировка')
                ->value(50)
                ->type('number'),
        ];
    }
}
