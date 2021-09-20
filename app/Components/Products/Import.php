<?php

namespace App\Components\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Import extends Component
{
    use WithFileUploads;
    public $file = null;
    public array $imported = [];
    public $importableClass = null;
    public $columns = [];
    public $keys = [];

    public function route(): \Illuminate\Routing\Route
    {
        return Route::get('products/import', static::class)->name('products.import');
    }

    public function render()
    {
        return view('products.import')->with([
            'importables' => $this->getImportables(),
            'keys' => optional($this->imported ?? null, function (array $imported) {
                $keys = [];
                foreach ($imported as $key => $value) {
                    foreach (array_keys($value) as $key) {
                        $keys[] = $key;
                    }
                }
                return collect($keys)->unique();
            }),
        ]);
    }

    public function updatedImportableClass()
    {
       $this->columns = optional(class_exists($this->importableClass) ? $this->importableClass : null, function (string  $class) {
            return (new $class)->getImportablesAttribute();
        });
    }

    public function getImportables()
    {
        return [
            'Products' => Product::class,
        ];
//        $path = app_path() . "/Models";
//
//        function getModels($path){
//            $out = [];
//            $results = scandir($path);
//            foreach ($results as $result) {
//                if ($result === '.' or $result === '..') continue;
//                $filename = $path . '/' . $result;
//                if (is_dir($filename)) {
//                    $out = array_merge($out, getModels($filename));
//                }else{
//                    $out[] = substr($filename,0,-4);
//                }
//            }
//            return $out;
//        }
//
//        dd(getModels($path));
    }

    public function removeItem(int $index)
    {
        unset($this->imported[$index]);
        $this->imported = collect($this->imported)->values()->toArray();
        $this->emit('$refresh');
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
