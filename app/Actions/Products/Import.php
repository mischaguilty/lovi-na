<?php

namespace App\Actions\Products;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Lorisleiva\Actions\Concerns\AsAction;

class Import
{
    use AsAction;

    public $commandSignature = 'products:import {path?}';


    public string $path;

    public function __construct(string $path = null)
    {
        $this->path = $path ?? '';
    }

    public function handle()
    {
        return optional(File::get($this->path) ?? null, function (string $csv) {
            return collect(explode(PHP_EOL, $csv))->map(function (string $line) {
                return collect(explode(',', $line))->filter(function ($item) {
                    return !empty($item);
                })->toArray();
            })->toArray();
        }) ?? [];
    }

    public function asCommand(Command $command)
    {
        $this->path = optional($command->argument('path') ?? null, function (string $path) {
            return $path;
        }) ?? __DIR__.DIRECTORY_SEPARATOR.'0209.csv';
        $this->handle();
    }
}
