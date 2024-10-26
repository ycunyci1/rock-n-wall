<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProductListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::query()
                ->filters()
                ->filtersApply([
                    \App\Orchid\Filters\ProductFilterName::class,
                    \App\Orchid\Filters\ProductFilterVip::class,
                    \App\Orchid\Filters\ProductFilterLive::class,
                    \App\Orchid\Filters\ProductFilterNew::class,
                    \App\Orchid\Filters\ProductFilterPopular::class,
                    ])
                ->orderByDesc('id')
                ->paginate(15),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Список изображений';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать')
                ->icon('pencil')
                ->route('platform.product.edit'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ProductListLayout::class,
        ];
    }
}
