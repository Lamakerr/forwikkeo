<?php

use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
        return redirect("students");
});


Route::get('students',[TableController::class, 'index'])->name('students');
Route::post('students',[TableController::class, 'store'])->name('students.store');
Route::get('students/{student}/edit',[TableController::class, 'edit'])->name('students.edit');
Route::get('students/{student}',[TableController::class, 'delete'])->name('students.delete');
