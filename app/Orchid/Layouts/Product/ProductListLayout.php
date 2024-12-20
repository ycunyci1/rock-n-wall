<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use App\Models\SubEssence;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

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
                ->filter(Input::make())
                ->render(function (Product $product) {
                    return Link::make($product->name)
                        ->route('platform.product.edit', $product);
                }),
            TD::make('sub-essences', 'Категории')
                ->width(250)
                ->filter(Select::make()->fromModel(SubEssence::class, 'name', 'id')->multiple())
                ->render(function (Product $product) {
                    return Link::make($product->subEssences->count() ? implode(',', $product->subEssences->pluck('name')->toArray()) : '')
                        ->route('platform.product.edit', $product);
                    return ;
                }),

            TD::make('vip', 'Vip')
                ->width(50)
                ->filter(Select::make()->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])
                    ->empty('Не выбрано')
                )
                ->render(function (Product $product) {
                    return Link::make($product->vip ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('live', 'Live')
                ->width(50)
                ->filter(Select::make()->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])->empty('Не выбрано'))
                ->render(function (Product $product) {
                    return Link::make($product->live ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('image', 'Изображение')
                ->width(150)
                ->render(function (Product $product) {
                    $link = route('platform.product.edit', $product);

                    return "<a href=$link><img src=$product->image height='150px' style='object-fit: contain;'></a>";
                }),
            TD::make('new', 'Новинка')
                ->width(50)
                ->filter(Select::make()->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])->empty('Не выбрано'))
                ->render(function (Product $product) {
                    return Link::make($product->new ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('popular', 'Популярное')
                ->filter(Select::make()->options([
                    'Нет' => 'Нет',
                    'Да' => 'Да'
                ])->empty('Не выбрано'))
                ->width(50)
                ->render(function (Product $product) {
                    return Link::make($product->popular ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('sort', 'Сортировка')
                ->width(50)
                ->render(function (Product $product) {
                    return Link::make($product->sort)
                        ->route('platform.product.edit', $product);
                }),
        ];
    }
}
