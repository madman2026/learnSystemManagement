<?php

use Illuminate\Support\Facades\Route;
use Modules\Interaction\Http\Controllers\InteractionController;

Route::middleware(['auth:sanctum'])->as('interaction.')->group(function () {
    Route::post('comment/{type}/{id}' , [InteractionController::class , 'createComment'])->name('comment.create');
    Route::post('like/{type}/{id}' , [InteractionController::class , 'likeToggle'])->name('like.toggle');
    Route::post('view/{type}/{id}' , [InteractionController::class , 'visit'])->name('visit');
});
