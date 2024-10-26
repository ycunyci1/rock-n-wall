<?php

namespace App\Orchid\Layouts\Essence;

use App\Enum\EssenceDisplayTypeEnum;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\TD;

class EssenceEditLayout extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'essence';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('essence.name')
                ->required()
                ->title('Название'),

            Input::make('essence.sort')
                ->required()
                ->title('Сортировка'),
        ];
    }
}
