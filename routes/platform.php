<?php

declare(strict_types=1);

use App\Orchid\Screens\Essence\EssenceEditScreen;
use App\Orchid\Screens\Essence\EssenceListScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Product\ProductEditScreen;
use App\Orchid\Screens\Product\ProductListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\SubEssence\SubEssenceEditScreen;
use App\Orchid\Screens\SubEssence\SubEssenceListScreen;
use App\Orchid\Screens\Tag\TagEditScreen;
use App\Orchid\Screens\Tag\TagListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Product
Route::screen('products', ProductListScreen::class)
    ->name('platform.product.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Images'), route('platform.product.list')));
Route::screen('product/{product?}', ProductEditScreen::class)
    ->name('platform.product.edit')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.product.list')
    ->push(__('Images edit'), route('platform.product.edit')));

//Essence
Route::screen('essences', EssenceListScreen::class)
    ->name('platform.essence.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Essences'), route('platform.essence.list')));
Route::screen('essence/{essence?}', EssenceEditScreen::class)
    ->name('platform.essence.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.essence.list')
        ->push(__('Essence edit'), route('platform.essence.edit')));

//SubEssence
Route::screen('sub-essences', SubEssenceListScreen::class)
    ->name('platform.subEssence.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Category'), route('platform.subEssence.list')));
Route::screen('sub-essence/{subEssence?}', SubEssenceEditScreen::class)
    ->name('platform.subEssence.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.subEssence.list')
        ->push(__('Category edit'), route('platform.subEssence.edit')));

//Tag
Route::screen('tags', TagListScreen::class)
    ->name('platform.tag.list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Tags'), route('platform.tag.list')));
Route::screen('tag/{tag?}', TagEditScreen::class)
    ->name('platform.tag.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.tag.list')
        ->push(__('Tag edit'), route('platform.tag.edit')));




// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Admins > User
Route::screen('admins/{admin}/edit', UserEditScreen::class)
    ->name('platform.systems.admins.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.admins')
        ->push($user->name, route('platform.systems.admins.edit', $user)));

// Platform > System > Users > Create
Route::screen('admin/create', UserEditScreen::class)
    ->name('platform.systems.admins.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.admins')
        ->push(__('Create'), route('platform.systems.admins.create')));

// Platform > System > Users
Route::screen('admins', UserListScreen::class)
    ->name('platform.systems.admins')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.admins')));

// Platform > System > Roles > Role
Route::screen('admin/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
