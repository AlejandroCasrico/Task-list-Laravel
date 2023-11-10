<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\tasksController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

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
    return view('app');
});

Route::get('/welcome', function () {
    return view('app');
});
Route::get('/tasks',[tasksController::class,'index'])->name('tasks');
Route::post('/tasks', [tasksController::class,'store'])->name('tasks');
Route::get('/tasks/{id}', [tasksController::class,'show'])->name('tasks-edit');
Route::put('/tasks/{id}', [tasksController::class,'update'])->name('tasks-update');
Route::delete('/tasks/{id}', [tasksController::class,'destroy'] )->name('tasks-destroy');

Route::resource('categories',CategoriesController::class);
