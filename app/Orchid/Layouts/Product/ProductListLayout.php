<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
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
                ->render(function (Product $product) {
                    return Link::make($product->name)
                        ->route('platform.product.edit', $product);
                }),
            TD::make('vip', 'Vip')
                ->width(50)
                ->render(function (Product $product) {
                    return Link::make($product->vip ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('live', 'Live')
                ->width(50)
                ->render(function (Product $product) {
                    return Link::make($product->live ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('image', 'Изображение')
                ->width(350)
                ->render(function (Product $product) {
                    $link = route('platform.product.edit', $product);

                    return "<a href=$link><img src=$product->image width='150' height='150'></a>";
                }),
            TD::make('new', 'Новинка')
                ->width(50)
                ->render(function (Product $product) {
                    return Link::make($product->new ? 'Да' : 'Нет')
                        ->route('platform.product.edit', $product);
                }),
            TD::make('popular', 'Популярное')
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
