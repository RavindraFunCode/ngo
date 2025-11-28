<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, \App\Models\Language::where('is_active', true)->pluck('code')->toArray())) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
