<?php

namespace App\Orchid\Layouts\Product;

use App\Models\SubEssence;
use App\Models\Tag;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;


class ProductEditLayout extends Rows
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
    protected function fields(): iterable
    {
        return [
            Input::make('product.name')
                ->title('Название'),

            CheckBox::make('product.vip')
                ->title('Vip')
                ->sendTrueOrFalse(),

            CheckBox::make('product.live')
                ->title('Live')
                ->sendTrueOrFalse(),

            Picture::make('product.image')
                ->title('Изображение'),

            CheckBox::make('product.new')
                ->title('Новинка')
                ->sendTrueOrFalse(),

            CheckBox::make('product.popular')
                ->title('Популярное')
                ->sendTrueOrFalse(),

            Input::make('product.sort')
                ->title('Сортировка')
                ->help('Чем меньше число - тем выше изображение в списке')
                ->type('number'),

            Select::make('subEssences.')
                ->fromModel(SubEssence::class, 'name', 'id')
                ->multiple()
                ->title('Категории')
                ->help('Выберите категории, к которым относится это изображение'),

            Select::make('tags.')
                ->fromModel(Tag::class, 'name', 'id')
                ->multiple()
                ->title('Тэги')
                ->help('Выберите тэги, к которым относится это изображение')
        ];
    }
}
