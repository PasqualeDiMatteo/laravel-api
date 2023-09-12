<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TypeProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Resource
Route::apiResource("projects", ProjectController::class);

// TypeProject
Route::get("types/{type}/projects", [TypeProjectController::class, "index"]);
