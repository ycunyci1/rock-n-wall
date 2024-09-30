<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductEditLayout;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ProductEditScreen extends Screen
{
    public $product;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product,
            'subEssences' => $product->subEssences->pluck('id')->toArray(),
            'tags' => $product->tags->pluck('id')->toArray(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Редактировать продукт' : 'Создать новый продукт';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать')
                ->icon('pencil')
                ->method('create')
                ->canSee(! $this->product->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('update')
                ->canSee($this->product->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->product->exists),
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
            ProductEditLayout::class,
        ];
    }

    public function create(Request $request)
    {
        $productInfo = $request->get('product');
        $live = $productInfo['live'] ?? 0;
        if ($live) {
            $productInfo['live_image'] = $productInfo['image'];
            $productInfo['image'] = ImageService::getPreviewForGif(str_replace(config('app.url') . '/storage/', '/app/public/', $productInfo['live_image']));
        }
        $product = Product::query()->create($productInfo);

        $product->subEssences()->attach($request->get('subEssences'));
        $product->tags()->attach($request->get('tags'));

        Toast::info('You have successfully created a product.');

        return redirect()->route('platform.product.edit', $product->id);
    }

    public function update(Product $product, Request $request)
    {
        $productInfo = $request->get('product');
        $live = $productInfo['live'] ?? 0;
        if ($live) {
            if (str_contains($productInfo['image'], '.gif')) {
                $productInfo['live_image'] = $productInfo['image'];
                $productInfo['image'] = ImageService::getPreviewForGif(str_replace(config('app.url') . '/storage/', '/app/public/', $productInfo['live_image']));
            }else {
                unset($productInfo['image']);
                unset($productInfo['live_image']);
            }
        }
        $product->fill($productInfo)->save();

        $product->subEssences()->detach();
        $product->subEssences()->attach($request->get('subEssences'));

        $product->tags()->detach();
        $product->tags()->attach($request->get('tags'));

        Toast::info('You have successfully updated a product.');
    }

    public function remove(Product $product)
    {
        $product->delete();

        Toast::info('You have successfully deleted the product.');

        return redirect()->route('platform.product.list');
    }
}
