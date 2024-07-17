<?php

namespace App\Orchid\Screens\Essence;

use App\Models\Essence;
use App\Orchid\Layouts\Essence\EssenceEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class EssenceEditScreen extends Screen
{
    public $essence;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Essence $essence): iterable
    {
        return [
            'essence' => $essence,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->essence->exists ? 'Редактировать раздел' : 'Создать новый раздел';
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
                ->canSee(! $this->essence->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('update')
                ->canSee($this->essence->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->essence->exists),
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
            EssenceEditLayout::class,
        ];
    }

    public function create(Request $request)
    {
        Essence::query()->create($request->get('essence'));

        Toast::info('You have successfully created a essence.');

        return redirect()->route('platform.essence.list');
    }

    public function update(Essence $essence, Request $request)
    {
        $essence->fill($request->get('essence'))->save();

        Toast::info('You have successfully updated a essence.');

        return redirect()->route('platform.essence.list');
    }

    public function remove(Essence $essence)
    {
        $essence->delete();

        Toast::info('You have successfully deleted the essence.');

        return redirect()->route('platform.essence.list');
    }
}
