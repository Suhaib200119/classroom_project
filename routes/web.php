<?php

use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TopicsController;
use App\Models\Classroom;
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

Route::get('/', function () {
    return view('w');
});

// Route::middleware(["auth"])->group(function(){
  
// });

Route::get("/classrooms",[ClassroomsController::class,"index"])->name("index_classroom");
Route::get("/classrooms/create",[ClassroomsController::class,"create"])->name("create_classroom");
Route::post("/classrooms",[ClassroomsController::class,"store"])->name("store_classroom");
Route::get("/classrooms/{id}/edit",[ClassroomsController::class,"edit"])->name("edit_classroom");
Route::put("/classrooms/{id}",[ClassroomsController::class,"update"])->name("update_classroom");
Route::delete("classrooms/{id}",[ClassroomsController::class,"destroy"])->name("delete_classroom");
Route::get("/classrooms/trashed",[ClassroomsController::class,"trashedClassrooms"])->name("trashed_classroom");
Route::get("classrooms/withOutTrashed",[ClassroomsController::class,"withOutTrashedClassrooms"])->name("withOutTrashed_classroom");
Route::get("/classrooms/{id}",[ClassroomsController::class,"show"])->name("show_classroom");
Route::delete("/classrooms/{id}/forceDelete",[ClassroomsController::class,"forceDelete"])->name("forceDelete_classroom");
Route::put("classrooms/{id}/restore",[ClassroomsController::class,"restore"])->name("restore_classroom");


Route::resource("/topics",TopicsController::class);
Route::delete("/topics/{id}/forceDelete",[TopicsController::class,"forceDelete"])->name("delete_topic");




