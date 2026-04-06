<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ui', function () {
    return view('components.ui.sections.buttons');
})->name('ui.buttons');

Route::get('/ui/inputs', function () {
    return view('components.ui.sections.inputs');
})->name('ui.inputs');

Route::get('/ui/date-time', function () {
    return view('components.ui.sections.date-time-fields');
})->name('ui.date-time');

Route::get('/ui/textarea', function () {
    return view('components.ui.sections.textareas');
})->name('ui.textarea');

Route::get('/ui/select', function () {
    return view('components.ui.sections.selectors');
})->name('ui.select');

Route::get('/ui/cards', function () {
    return view('components.ui.sections.cards');
})->name('ui.cards');

Route::get('/ui/file-upload', function () {
    return view('components.ui.sections.file-uploads');
})->name('ui.file-upload');
