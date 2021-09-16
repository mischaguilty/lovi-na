<?php

namespace App\Components\Products;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;
    public $file = null;
    public array $imported = [];

    public function route()
    {
        return Route::get('products/import', static::class)->name('products.import');
    }

    public function render()
    {
        return view('products.import');
    }

    public function updatedFile()
    {
        optional($this->file ?? null, function (TemporaryUploadedFile $file) {
            $name = now()->timestamp.'.csv';
            $file->storePubliclyAs('uploads', $name);
            $this->imported = (new \App\Actions\Products\Import(storage_path('app/uploads/'.$name)))->handle();
        });
    }
}
