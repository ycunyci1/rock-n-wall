<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Fields\Input;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterPopular extends Filter
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'filter[popular]';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        if (isset($this->request->get('filter')['popular'])) {
            return $builder->where('popular', $this->request->get('filter')['popular'] === 'Нет' ? 0 : 1);
        }
        return $builder;
    }

    /**
     * @return TD[]
     */
    public
    function display(): array
    {
        return [
            Select::make('popular')
                ->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])
                ->value($this->request->get('popular'))
                ->title('Popular')
        ];
    }
}
