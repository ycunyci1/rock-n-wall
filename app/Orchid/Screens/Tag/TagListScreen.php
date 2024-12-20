<?php

namespace App\Orchid\Screens\Tag;

use App\Models\Tag;
use App\Orchid\Layouts\Tag\TagListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class TagListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tags' => Tag::query()
                ->orderByDesc('id')
                ->paginate(15),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Список тэгов';
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
                ->route('platform.tag.edit'),
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
            TagListLayout::class,
        ];
    }
}
