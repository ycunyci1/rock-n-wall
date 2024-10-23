<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            //            Menu::make('Get Started')
            //                ->icon('bs.book')
            //                ->title('Navigation')
            //                ->route(config('platform.index')),

            Menu::make('Изображения')
                ->icon('bs.collection')
                ->title('Basic')
                ->route('platform.product.list'),

            Menu::make('Разделы')
                ->icon('bs.collection')
                ->route('platform.essence.list'),

            Menu::make('Подразделы')
                ->icon('bs.collection')
                ->route('platform.subEssence.list'),

            Menu::make('Тэги')
                ->icon('bs.collection')
                ->route('platform.tag.list'),

            //            Menu::make('Sample Screen')
            //                ->icon('bs.collection')
            //                ->route('platform.example')
            //                ->badge(fn () => 6),
            //
            //            Menu::make('Form Elements')
            //                ->icon('bs.card-list')
            //                ->route('platform.example.fields')
            //                ->active('*/examples/form/*'),
            //
            //            Menu::make('Overview Layouts')
            //                ->icon('bs.window-sidebar')
            //                ->route('platform.example.layouts'),
            //
            //            Menu::make('Grid System')
            //                ->icon('bs.columns-gap')
            //                ->route('platform.example.grid'),
            //
            //            Menu::make('Charts')
            //                ->icon('bs.bar-chart')
            //                ->route('platform.example.charts'),
            //
            //            Menu::make('Cards')
            //                ->icon('bs.card-text')
            //                ->route('platform.example.cards')
            //                ->divider(),

//            Menu::make('Администраторы')
//                ->icon('bs.people')
//                ->route('platform.systems.admins')
//                ->permission('platform.systems.users')
//                ->title(__('Access Controls')),

            Menu::make('Пользователи')
                ->icon('bs.people')
                ->route('platform.base-users.list')
                ->title(__('Access Controls')),

//            Menu::make('Роли')
//                ->icon('bs.shield')
//                ->route('platform.systems.roles')
//                ->permission('platform.systems.roles')
//                ->divider(),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', 'Роли')
                ->addPermission('platform.systems.admins', 'Администраторы'),
        ];
    }
}
