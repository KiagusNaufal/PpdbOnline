<?php

use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('student', studentController::class);
