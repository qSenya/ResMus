<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
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

Route::get('/', [Controller::class, "index"])->name("index");
Route::get('/signin', [UserController::class, "signin"])->name("signin");
Route::post('/signin_validate', [UserController::class, 'signin_validate'])->name('signin_validate');
Route::post('/reg_validate', [UserController::class, 'reg_validate'])->name('reg_validate');
Route::get('/signout', [UserController::class, "signout"]);

Route::get('/lk', [UserController::class, "lk"])->name('lk');
Route::post('/add_song', [Controller::class, "add_song"]);
Route::get('/song_redact/{id}', [Controller::class, "song_redact"]);
Route::post('/redact/{song}', [Controller::class, "change_song"]);
Route::get('/song_delete/{song}', [Controller::class, "song_delete"]);
Route::get('/lk-redact/{id}', [UserController::class, "lk_redact"]);
Route::post('/redact_profile/{user}', [UserController::class, "redact_profile"]);


Route::get('/complaint/{id}', [Controller::class, "complaint"]);
Route::get('/create_complaint', [Controller::class, "create_complaint"]);


Route::get('/complaint/{id}/accept', [AdminController::class, "complaint_accept"]);
Route::get('/complaint/{id}/decline', [AdminController::class, "complaint_decline"]);
Route::get('/admin', [AdminController::class, "admin_signin"]);
Route::get('/admin_index', [AdminController::class, "index"]);
Route::get('/add_genre', [AdminController::class, "create_genre"]);
