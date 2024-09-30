<?php

namespace App\Orchid\Layouts\BaseUser;

use App\Models\Essence;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BaseUserListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'users';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('vip', 'Vip')
                ->render(function (User $user) {
                    return $user->vip ? 'Да' : 'Нет';
                }),

            TD::make('token', 'Device api key')
                ->render(function (User $user) {
                    return $user->token;
                }),
        ];
    }
}
