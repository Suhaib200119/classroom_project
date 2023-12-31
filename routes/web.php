<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinToClassroomController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\TopicsController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Vonage\Meetings\Room;

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

Route::get('/', [PlanController::class,"index"])->middleware("guest:web,admin");
// Route::get('/plans', [PlanController::class,"index"]);
//  Route::view("/parent","Layouts.parent");


Route::middleware('auth:web,admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // subscriptions routes
     Route::post('/subscriptions', [SubscriptionsController::class,"store"])->name("add_subscription");

    // payment routes
    Route::get('/subscriptions/{subscription}/pay', [PaymentsController::class,"create"])->name("payment_create");
    Route::get('/payments/{subscription_id}/success', [PaymentsController::class,"success"])->name("payment_success");
    Route::get('/payments/{subscription_id}/cancel', [PaymentsController::class,"cancel"])->name("payment_cancel");




    
Route::get("/classrooms",[ClassroomsController::class,"index"])->name("index_classroom");
Route::get("/classrooms/create",[ClassroomsController::class,"create"])->name("create_classroom")->middleware("EnsureUserActiveSubscription");
Route::post("/classrooms",[ClassroomsController::class,"store"])->name("store_classroom")->middleware("EnsureUserActiveSubscription");
Route::get("/classrooms/{id}/edit",[ClassroomsController::class,"edit"])->name("edit_classroom");
Route::put("/classrooms/{id}",[ClassroomsController::class,"update"])->name("update_classroom");
Route::delete("/classrooms/{id}",[ClassroomsController::class,"destroy"])->name("delete_classroom");
Route::get("/classrooms/trashed",[ClassroomsController::class,"trashedClassrooms"])->name("trashed_classroom");
// Route::get("classrooms/withOutTrashed",[ClassroomsController::class,"withOutTrashedClassrooms"])->name("withOutTrashed_classroom");
Route::get("/classrooms/{id}",[ClassroomsController::class,"show"])->name("show_classroom");
Route::delete("/classrooms/{id}/forceDelete",[ClassroomsController::class,"forceDelete"])->name("forceDelete_classroom");
Route::put("/classrooms/{id}/restore",[ClassroomsController::class,"restore"])->name("restore_classroom");
Route::get("/clasrooms/{id}/people",[ClassroomsController::class,"people"])->name("people_classroom");
Route::post("/classrooms/{id}/post",[PostController::class,"store"])->name("addPost_classroom");
// Join To Classroom Controller
Route::get("/classrooms/{id}/create",[JoinToClassroomController::class,"joinToClassroomCreate"])->middleware("signed")->name("join_Classroom_create");
Route::post("/classrooms/{id}/join",[JoinToClassroomController::class,"joinToClassroomStore"])->name("join_Classroom_store");
Route::delete("/classrooms/{classroom_id}/exit/{user_id}",[JoinToClassroomController::class,"exitFromClassroom"])->name("exitFromClassroom");
Route::get("/classrooms/join/myClassrooms",[JoinToClassroomController::class,"myClassroom"])->name("my_classroom");


Route::resource("/topics",TopicsController::class);
Route::delete("/topics/{id}/forceDelete",[TopicsController::class,"forceDelete"])->name("delete_topic");
Route::put("/topics/{id}/restore",[TopicsController::class,"restore"])->name("restore_topic");


Route::resource("/classrooms.classworks",ClassworkController::class);//->shallow();

Route::resource("/comments", CommentController::class);


Route::post("classworks/{id}/submissions",[SubmissionController::class,"store"])->name("submissions.store");

Route::view("adminDash","adminDash")->name("AdminDash");


});



require __DIR__.'/auth.php';
