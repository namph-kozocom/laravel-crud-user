<?php

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

Route::get('/', [UserController::class, 'showListUserPage'])->name('index');
Route::get('/create', [UserController::class, 'showAddUserPage'])->name('form-add');
Route::post('/store', [UserController::class, 'addNewUser'])->name(name: 'user.store');
Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name(name: 'user.delete');
Route::get('/edit/{id}', [UserController::class, 'showEditUserPage'])->name('form-edit');
Route::post('/user/update/{id}', [UserController::class, 'editUser'])->name('user.update');