<?php

use Illuminate\Support\Facades\Route;
use Modules\Enrollment\Http\Controllers\EnrollmentController;

Route::middleware(['auth:sanctum'])->as('enrollment.')->group(function () {
    Route::apiResource('enrollment' , EnrollmentController::class);
});
