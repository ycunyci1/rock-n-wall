<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\Admin;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class UserPasswordLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        /** @var Admin $admin */
        $admin = $this->query->get('admin');

        $placeholder = $admin->exists
            ? __('Leave empty to keep current password')
            : __('Enter the password to be set');

        return [
            Password::make('admin.password')
                ->placeholder($placeholder)
                ->title(__('Password')),
        ];
    }
}
