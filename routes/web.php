<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;


Route::get('/', [MealController::class, "index"])->name('meals');
