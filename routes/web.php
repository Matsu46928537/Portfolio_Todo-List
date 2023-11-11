<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
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

//トップページでログインフォームを表示する
Route::get('/', function () {
    return view('auth.login');
});

//ログイン成功後は以下のページを表示する
Route::middleware('auth')->group(function () {
    Route::get('/todo', [TodoController::class, 'index'])->name('todo');

    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');

    Route::patch('/todo/{todo}', [TodoController::class, 'updateDone'])->name('todo.updateDone');

    Route::get('/todo/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');

    Route::put('/todo/{todo}/edit', [TodoController::class, 'updateEdit'])->name('todo.updateEdit');

    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__ . '/auth.php';
