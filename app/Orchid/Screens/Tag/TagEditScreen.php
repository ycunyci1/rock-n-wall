<?php

namespace App\Orchid\Screens\Tag;

use App\Models\Essence;
use App\Models\Product;
use App\Models\Tag;
use App\Orchid\Layouts\Essence\EssenceEditLayout;
use App\Orchid\Layouts\Tag\TagEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TagEditScreen extends Screen
{
    public $tag;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Tag $tag): iterable
    {
        return [
            'tag' => $tag,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->tag->exists ? 'Редактировать тэг' : 'Создать новый тэг';
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
                ->canSee(!$this->tag->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('update')
                ->canSee($this->tag->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->tag->exists),
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
            TagEditLayout::class
            ];
    }

    public function create(Request $request)
    {
        Tag::query()->create($request->get('tag'));

        Toast::info('You have successfully created a tag.');

        return redirect()->route('platform.tag.list');
    }

    public function update(Tag $tag, Request $request)
    {
        $tag->fill($request->get('tag'))->save();

        Toast::info('You have successfully updated a tag.');

        return redirect()->route('platform.tag.list');
    }

    public function remove(Tag $tag)
    {
        $tag->delete();

        Toast::info('You have successfully deleted the tag.');

        return redirect()->route('platform.tag.list');
    }
}
