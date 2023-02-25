<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrgController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MediafileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\PostController::class, 'index']);
Route::prefix('posts')->middleware('auth')->group(function () {
    Route::get('/{id?}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('posts');
    Route::get('/{id}/edit', [PostController::class, 'edit'])->where('id', '[0-9]+')->name('editpost');
    Route::get('/add', [PostController::class, 'edit'])->name('addpost');
});

Route::prefix('orgs')->middleware('auth')->group(function () {
    Route::get('/{id?}', [OrgController::class, 'show'])->where('id', '[0-9]+')->name('orgs');
    Route::get('/{id}/edit', [OrgController::class, 'edit'])->where('id', '[0-9]+')->name('editorg');
    Route::get('/add', [OrgController::class, 'edit'])->name('addorg');
});

Route::prefix('inouts')->middleware('auth')->group(function () {
    Route::get('/{id?}', [InoutController::class, 'show'])->where('id', '[0-9]+')->name('inouts');
    Route::get('/add', [InoutController::class, 'edit'])->name('addinout');
    Route::get('/balance', [InoutController::class, 'show_balance'])->name('balance');
    Route::post('/add', [InoutController::class, 'store'])->name('addinout');
    Route::post('/getkvit', [InoutController::class, 'getkvit'])->name('getkvit');
});

Route::prefix('tickets')->middleware('auth')->group(function () {
    Route::post('/buy', [TicketController::class, 'show'])->name('ticketbuy');
    Route::post('/buysubmit', [TicketController::class, 'store'])->name('ticketbuysubmit');
});

Route::prefix('mediafiles')->middleware('auth')->group(function () {
    Route::get('/{id?}', [MediafileController::class, 'show'])->where('id', '[0-9]+')->name('mediafiles');
    Route::get('/{id}/edit', [MediafileController::class, 'edit'])->where('id', '[0-9]+')->name('editmediafile');
    Route::get('/add', [MediafileController::class, 'edit'])->name('addmediafile');
});

Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/{id?}', [UserController::class, 'show'])->where('id', '[0-9]+')->name('users');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('edituser');
});

Route::get('/useroauth/{provider}', [App\Http\Controllers\UserOAuth::class, 'auth']);
Route::get('/LoginViaVk', function () { return Socialite::driver('vkontakte')->redirect(); })->name('LoginViaVk');
