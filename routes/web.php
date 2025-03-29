<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupChatController;

Route::get('/', fn() => redirect()->route('login'));

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function (){
    Route::get('/users', [ChatController::class, 'index'])->name('users');
    Route::get('/chat/{receiverId}', [ChatController::class, 'chat'])->name('chat');
    Route::post('/chat/{receiverId}/send', [ChatController::class, 'sendMessage']);
    Route::post('/chat/typing', [ChatController::class, 'typing']);
    Route::post('/online', [ChatController::class, 'setOnline']);
    Route::post('/offline', [ChatController::class, 'setOffline']);
    Route::post('/creategroup', [GroupChatController::class, 'creategroup']);
});