<?php

use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, "index"])->name("guest.index");


// Route Admin
Route::prefix("/admin")->middleware(["auth"])->name("admin.")->group(function () {

    // Projects

    // Trash
    Route::get("/projects/trash", [ProjectController::class, "trash"])->name("projects.trash");

    // Restore
    Route::patch("/projects/{project}/restore", [ProjectController::class, "restore"])->name("projects.restore");

    // Drop All
    Route::delete("/projects/drop-all", [ProjectController::class, "dropAll"])->name("projects.dropAll");

    // Drop
    Route::delete("/projects/{project}/drop", [ProjectController::class, "drop"])->name("projects.drop");

    // Resource
    Route::resource("/projects", ProjectController::class);


    // Types

    // Trash
    Route::get("/types/trash", [TypeController::class, "trash"])->name("types.trash");

    // Restore
    Route::patch("/types/{type}/restore", [TypeController::class, "restore"])->name("types.restore");

    // Drop All
    Route::delete("/types/drop-all", [TypeController::class, "dropAll"])->name("types.dropAll");

    // Drop
    Route::delete("/types/{type}/drop", [TypeController::class, "drop"])->name("types.drop");

    // Resource
    Route::resource("types", TypeController::class);


    // Technologies

    // Trash
    Route::get("/technologies/trash", [TechnologyController::class, "trash"])->name("technologies.trash");

    // Restore
    Route::patch("/technologies/{technology}/restore", [TechnologyController::class, "restore"])->name("technologies.restore");

    // Drop All
    Route::delete("/technologies/drop-all", [TechnologyController::class, "dropAll"])->name("technologies.dropAll");

    // Drop
    Route::delete("/technologies/{technology}/drop", [TechnologyController::class, "drop"])->name("technologies.drop");

    // Resource
    Route::resource("technologies", TechnologyController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
