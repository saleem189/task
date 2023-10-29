<?php

use App\Http\Controllers\ConnectionsInCommonController;
use App\Http\Controllers\RecievedRequestController;
use App\Http\Controllers\SentRequestController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/suggestions', function () {
        return response()->json(User::unconnectedUsers(auth()->user()->id)->get());
    });

    Route::post('/send-invite/{id}', [SentRequestController::class, 'store']);
    Route::get('/connections', [ConnectionsInCommonController::class, 'index']);
    Route::post('/connections/{id}', [ConnectionsInCommonController::class, 'destroy']);
    Route::get('/sent-requests', [SentRequestController::class, 'index']);
    Route::post('/sent-requests/{user_id}', [SentRequestController::class, 'store']);
    Route::post('/sent-requests/update/{id}', [SentRequestController::class, 'update']);
    Route::get('/recieved-requests', [RecievedRequestController::class, 'index']);
    Route::post('/recieved-requests/update/{id}', [RecievedRequestController::class, 'update']);
});
