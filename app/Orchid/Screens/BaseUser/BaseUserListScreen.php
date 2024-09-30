<?php

namespace App\Orchid\Screens\BaseUser;

use App\Models\Essence;
use App\Models\User;
use App\Orchid\Layouts\BaseUser\BaseUserListLayout;
use App\Orchid\Layouts\Essence\EssenceListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BaseUserListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'users' => User::query()->paginate(15),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Список пользователей';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            Link::make('Создать')
//                ->icon('pencil')
//                ->route('platform.essence.edit'),
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
            BaseUserListLayout::class,
        ];
    }
}
