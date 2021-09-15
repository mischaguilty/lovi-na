<?php

use Illuminate\Support\Facades\Route;

Route::any('logout', function () {
    Auth::logout();
    return redirect()->to(route('welcome'));
})->name('logout');

Route::group(['prefix' => \Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(),
    'middleware' => [
        'localize',
        'localizationRedirect',
        'localeSessionRedirect',
    ]
], function () {

    Route::get('/', \App\Components\Welcome::class)->name('welcome');
});
