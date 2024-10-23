<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Fields\Input;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterNew extends Filter
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'filter[new]';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        if (isset($this->request->get('filter')['new'])) {
            return $builder->where('new', $this->request->get('filter')['new'] === 'Нет' ? 0 : 1);
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
            Select::make('new')
                ->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])
                ->value($this->request->get('new'))
                ->title('New')
        ];
    }
}
