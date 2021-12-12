<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CyclesController;

Route::resource('cycles', CyclesController::class)->only('index', 'store', 'show');
