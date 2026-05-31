<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download/{path}', [\App\Http\Controllers\FileDownloadController::class, 'download'])
    ->name('file.download')
    ->where('path', '.*')
    ->middleware('auth');
