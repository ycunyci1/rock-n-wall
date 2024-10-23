<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Fields\Input;
use Orchid\Filters\Filter;
use Orchid\Screen\TD;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterName extends Filter
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'filter[name]';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        if (isset($this->request->get('filter')['name'])) {
            return $builder->where('name', 'like', '%' . $this->request->get('filter')['name'] . '%');
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
            Input::make('name')
                ->type('text')
                ->value($this->request->get('name'))
                ->title('Название')
                ->placeholder('Введите название'),
        ];
    }
}
