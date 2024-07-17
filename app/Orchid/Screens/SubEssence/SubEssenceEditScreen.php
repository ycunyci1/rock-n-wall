<?php

namespace App\Orchid\Screens\SubEssence;

use App\Models\SubEssence;
use App\Orchid\Layouts\SubEssence\SubEssenceEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SubEssenceEditScreen extends Screen
{
    public $subEssence;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(SubEssence $subEssence): iterable
    {
        return [
            'subEssence' => $subEssence,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->subEssence->exists ? 'Редактировать категорию' : 'Создать новую категорию';
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
                ->canSee(! $this->subEssence->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('update')
                ->canSee($this->subEssence->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->subEssence->exists),
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
            SubEssenceEditLayout::class,
        ];
    }

    public function create(Request $request)
    {
        SubEssence::query()->create($request->get('subEssence'));

        Toast::info('You have successfully created a category.');

        return redirect()->route('platform.subEssence.list');
    }

    public function update(SubEssence $subEssence, Request $request)
    {
        $subEssence->fill($request->get('subEssence'))->save();

        Toast::info('You have successfully updated a category.');

        return redirect()->route('platform.subEssence.list');
    }

    public function remove(SubEssence $subEssence)
    {
        $subEssence->delete();

        Toast::info('You have successfully deleted the category.');

        return redirect()->route('platform.subEssence.list');
    }
}
