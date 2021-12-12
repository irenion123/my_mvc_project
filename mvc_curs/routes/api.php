<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CyclesController;
use App\Http\Controllers\SeriesController;

Route::apiResource('cycles', CyclesController::class)
    ->only('index', 'store', 'show');

Route::apiResource('series', SeriesController::class)
    ->parameter('series', 'seria')
    ->only('index', 'store', 'show');
