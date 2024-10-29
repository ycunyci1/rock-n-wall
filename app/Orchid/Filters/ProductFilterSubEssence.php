<?php

namespace App\Orchid\Filters;

use Orchid\Screen\Fields\Input;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterSubEssence extends Filter
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'filter[sub-essences]';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        if (isset($this->request->get('filter')['sub-essences'])) {
            return $builder->whereHas('subEssences', fn($subEssences) => $subEssences->whereIn('sub_essences.id', $this->request->get('filter')['sub-essences']));
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
//            Select::make('live')
//                ->options([
//                    'Нет' => 'Нет',
//                    'Да' => 'Да'
//                ])
//                ->value($this->request->get('live'))
//                ->title('Live')
        ];
    }
}
