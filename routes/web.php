<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupChatController;
use App\Jobs\Proccessimage;




// Route::get('/', fn() => redirect()->route('login'));

Auth::routes();



// Route::get('/',function(){

//     Proccessimage::dispatch();
 

// });


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function (){
    Route::get('/users', [ChatController::class, 'index'])->name('users');
    Route::get('/chat/{receiverId}', [ChatController::class, 'chat'])->name('chat');
    Route::post('/chat/{receiverId}/send', [ChatController::class, 'sendMessage']);
    Route::post('/chat/typing', [ChatController::class, 'typing']);
    Route::post('/online', [ChatController::class, 'setOnline']);
    Route::post('/offline', [ChatController::class, 'setOffline']);
    Route::post('/creategroup', [GroupChatController::class, 'create']);
    Route::get('/group/{id}', [GroupChatController::class, 'index'])->middleware('auth');
    Route::post('/chat/{groupId}/sendtogroup', [GroupChatController::class, 'sendMessage'])->middleware('auth');
});




