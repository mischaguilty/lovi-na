<?php

namespace App\Components;

use Livewire\Component;

class Logo extends Component
{
    protected $listeners = [
        'logo:updated' => 'logoNeedsUpdate'
    ];

    public function logoNeedsUpdate()
    {
        $this->emit('$refresh');
    }

    public function render()
    {
        return view('logo');
    }
}
