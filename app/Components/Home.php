<?php

namespace App\Components;

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class Home extends Component
{
    use WithFileUploads;

    public Company $company;
    public array $name;
    public $logo;

    protected $listeners = [
        'resetLogo',
    ];

    public function mount(Company $company)
    {
        $this->company = $company->exists ? $company : View::shared('company');
        optional($this->company->exists ? $this->company : null, function (Company $company) {
            $this->fill([
                'name' => $company->getTranslations('name'),
                'logo' => $company->getFirstMedia('logo'),
            ]);
        });
    }

    public function route()
    {
        return Route::get('/home', static::class)
                ->name('home')
                ->middleware([
                    'localize',
                    'localizationRedirect',
                    'localeSessionRedirect',
                    'auth',
                ])
                ->prefix(LaravelLocalization::setLocale())
            ;
    }

    public function getRules()
    {
        return [
            'name.*' => [
                'required',
            ],
        ];
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updatedLogo()
    {
        $this->company->clearMediaCollection('logo');
        $this->company->addMedia($this->logo->getRealPath())->toMediaCollection('logo')->save();
        $this->emit('logo:updated');
        $this->emit('$refresh');
    }

    public function resetLogo()
    {
        $this->company->clearMediaCollection('logo');
        $this->logo = null;
        $this->emit('logo:updated');
        $this->emit('$refresh');
    }

    public function save()
    {
        $validated = $this->validate();
        $this->company->update($validated);
        $this->emit('logo:updated');
    }

    public function render()
    {
        return view('home')->with([
//            'data' => $this->company->toArray(),
        ]);
    }
}
