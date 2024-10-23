<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Fields\Input;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterVip extends Filter
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'filter[vip]';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        if (isset($this->request->get('filter')['vip'])) {
            return $builder->where('vip', $this->request->get('filter')['vip'] === 'Нет' ? 0 : 1);
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
            Select::make('vip')
                ->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])
                ->value($this->request->get('vip'))
                ->title('Vip')
        ];
    }
}
