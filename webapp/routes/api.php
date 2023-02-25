<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('stream/on_publish', [PostController::class, 'rtmp_on'])->name('rtmp_on');
Route::post('stream/on_publish_done', [PostController::class, 'rtmp_off'])->name('rtmp_off');
Route::post('stream/on_update', [PostController::class, 'rtmp_update'])->name('rtmp_update');
