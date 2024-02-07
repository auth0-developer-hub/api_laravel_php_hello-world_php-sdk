<?php

use App\Http\Controllers\MessagesController;
use App\Models\Message;
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

Route::group(['prefix' => 'messages'], function ($router) {
    Route::get('public', [MessagesController::class, 'showPublicMessage']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('protected', [MessagesController::class, 'showProtectedMessage']);
        Route::get('admin', [MessagesController::class, 'showAdminMessage'])->can('read-admin-messages', Message::class);
    });
});
