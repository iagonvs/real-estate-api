<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
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

Route::post('/register', [RegisterController::class, 'register'])->name('create.register');
Route::post('/login', [LoginController::class, 'login'])->name('make.login');

Route::middleware(['auth:sanctum', 'token.expired'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'get'])->name('get.tasks');
        Route::post('/', [TaskController::class, 'store'])->name('create.tasks');
    });

    Route::prefix('comments')->group(function () {
        Route::post('/{task}', [CommentController::class, 'store'])->name('create.comments');
    });
});
