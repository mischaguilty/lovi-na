<?php

namespace App\Components;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $currentLocale;

    public function mount($locale = null)
    {
        $this->currentLocale = optional($locale ?? null, function (string $locale) {
            return $locale;
            }) ?? app()->getLocale();
    }

    public function render()
    {
        return view('language-switcher');
    }
}
