<?php

namespace App\Orchid\Screens\SubEssence;

use App\Models\SubEssence;
use App\Orchid\Layouts\SubEssence\SubEssenceListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SubEssenceListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'subEssences' => SubEssence::query()->paginate(15),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Список подразделов';
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
                ->route('platform.subEssence.edit'),
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
            SubEssenceListLayout::class,
        ];
    }
}
