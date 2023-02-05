<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [AlbumController::class, 'getList'])->name('list-of-albums');
    Route::get('/create-album', [AlbumController::class, 'getForm'])->name('create-album-form');
    Route::post('/create-album', [AlbumController::class, 'create'])->name('create-album');
    Route::post('/delete-album/{id}', [AlbumController::class, 'delete'])->name('delete-album');
    Route::get('/album/{id}', [AlbumController::class, 'getAlbum'])->name('get-album');
    Route::get('/add-image/{id}', [AlbumController::class, 'getPhotoForm'])->name('show-photo-form');
    Route::post('/add-image/{id}', [AlbumController::class, 'addPhoto'])->name('add-photo');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
