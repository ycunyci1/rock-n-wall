<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Fields\Input;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterLive extends Filter
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'filter[live]';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        if (isset($this->request->get('filter')['live'])) {
            return $builder->where('live', $this->request->get('filter')['live'] === 'Нет' ? 0 : 1);
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
            Select::make('live')
                ->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])
                ->value($this->request->get('live'))
                ->title('Live')
        ];
    }
}
