<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('article/{article}', [ArticleController::class, 'show'])->name('show');
    Route::patch('article/{article}', [ArticleController::class, 'update'])->name('update');
    Route::delete('article/{article}', [ArticleController::class, 'destroy'])->name('delete');
});
