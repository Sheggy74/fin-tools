<?php

use Illuminate\Support\Facades\Route;

Route::get('/security', [\App\Http\Controllers\SecurityController::class, 'index']);
