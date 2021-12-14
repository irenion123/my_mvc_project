<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CyclesController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TranslatorsPageController;

Route::apiResource('cycles', CyclesController::class)
    ->only('index', 'store', 'show');

Route::apiResource('series', SeriesController::class)
    ->parameter('series', 'seria')
    ->only('index', 'store', 'show');

Route::apiResource('categories', CategoriesController::class)
    ->parameter('categories', 'category')
    ->only('index', 'store', 'show');

Route::apiResource('translators', TranslatorsPageController::class)
    ->parameter('translators', 'translator')
    ->only('index', 'store', 'show');
