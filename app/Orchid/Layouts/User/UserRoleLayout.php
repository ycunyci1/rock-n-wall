<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\AdminRole;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserRoleLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('admin.roles.')
                ->fromModel(AdminRole::class, 'name')
                ->multiple()
                ->title(__('Name role'))
                ->help('Specify which groups this account should belong to'),
        ];
    }
}
