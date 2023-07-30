<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\JoinToClassroomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TopicsController;
use App\Models\Classroom;

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
    return view('welcome');
});
Route::view("/parent","Layouts.parent");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
Route::get("/classrooms",[ClassroomsController::class,"index"])->name("index_classroom");
Route::get("/classrooms/create",[ClassroomsController::class,"create"])->name("create_classroom");
Route::post("/classrooms",[ClassroomsController::class,"store"])->name("store_classroom");
Route::get("/classrooms/{id}/edit",[ClassroomsController::class,"edit"])->name("edit_classroom");
Route::put("/classrooms/{id}",[ClassroomsController::class,"update"])->name("update_classroom");
Route::delete("/classrooms/{id}",[ClassroomsController::class,"destroy"])->name("delete_classroom");
Route::get("/classrooms/trashed",[ClassroomsController::class,"trashedClassrooms"])->name("trashed_classroom");
// Route::get("classrooms/withOutTrashed",[ClassroomsController::class,"withOutTrashedClassrooms"])->name("withOutTrashed_classroom");
Route::get("/classrooms/{id}",[ClassroomsController::class,"show"])->name("show_classroom");
Route::delete("/classrooms/{id}/forceDelete",[ClassroomsController::class,"forceDelete"])->name("forceDelete_classroom");
Route::put("/classrooms/{id}/restore",[ClassroomsController::class,"restore"])->name("restore_classroom");


// Join To Classroom Controller
Route::get("/classrooms/{id}/create",[JoinToClassroomController::class,"joinToClassroomCreate"])->middleware("signed")->name("join_Classroom_create");
Route::post("/classrooms/{id}/join",[JoinToClassroomController::class,"joinToClassroomStore"])->name("join_Classroom_store");
Route::get("/classrooms/student/join",[JoinToClassroomController::class,"classroomsStudent"])->name("myClassrooms_student");
Route::get("/classrooms/teacher/join",[JoinToClassroomController::class,"classroomsTeacher"])->name("myClassrooms_teacher");
Route::delete("/classrooms/{id}/exit",[JoinToClassroomController::class,"exitFromClassroom"])->name("exitFromClassroom");



Route::resource("/topics",TopicsController::class);
Route::delete("/topics/{id}/forceDelete",[TopicsController::class,"forceDelete"])->name("delete_topic");
Route::put("/topics/{id}/restore",[TopicsController::class,"restore"])->name("restore_topic");



});



require __DIR__.'/auth.php';
