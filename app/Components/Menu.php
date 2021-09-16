<?php

namespace App\Components;

use Illuminate\Support\Collection;
use Livewire\Component;

class Menu extends Component
{
    public Collection $menu;

    public function mount()
    {
        $this->menu = \App\Models\Menu::query()->where([
            'top_menu_id' => 0,
            'menuable_id' => 0,
        ])->get()->toBase();
    }

    public function render()
    {
        return view('menu');
    }
}
