<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'] )->middleware('auth');
Route::post('/todos/create', [TodoController::class,'create']);
Route::post('/todos/update', [TodoController::class,'update']);
Route::post('/todos/delete', [TodoController::class, 'remove']);
Route::get('/todos/find', [TodoController::class, 'find']);
Route::get('/todos/search', [TodoController::class, 'search']);

Route::get('/dashboard', function () {
return view('index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
