<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('students.index');
});

Route::get('/students', [StudentController::class, 'index'])->name('students.index');

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::get('/students/show/{student}', [StudentController::class, 'show'])->name('students.show');
Route::post('/students/create', [StudentController::class, 'store'])->name('students.create');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/delete/{student}', [StudentController::class, 'delete'])->name('students.delete');
