<?php

use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', [MessagesController::class,'index'])->name('messages');
    Route::get('create', [MessagesController::class,'create'])->name('messages.create');
    Route::post('/', [MessagesController::class,'store'])->name('messages.store');
    Route::get('{id}', [MessagesController::class,'show'])->name('messages.show');
    Route::put('{id}', [MessagesController::class,'update'])->name('messages.update');
    Route::get('destroy/{id}', [MessagesController::class,'destroy'])->name('messages.destroy');
});
