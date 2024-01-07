<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/register',[AuthController::class,'register']);
Route::get('/login',[AuthController::class,'login']);
Route::post('/loginProses',[AuthController::class,'loginProses']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard/class/datatable', [App\Http\Controllers\ClassController::class, 'datatable'])->name('class/datatable');
Route::get('/class', [App\Http\Controllers\ClassController::class, 'index']);
Route::get('/class/show/{id}', [App\Http\Controllers\ClassController::class, 'show']);
Route::get('/class/edit/{id}', [App\Http\Controllers\ClassController::class, 'edit']);
Route::post('/class/store', [App\Http\Controllers\ClassController::class, 'store'])->name('class/store');
Route::post('/class/update', [App\Http\Controllers\ClassController::class, 'update']);
Route::get('/class/delete/{id}', [App\Http\Controllers\ClassController::class, 'destroy']);

Route::get('/user/datatable', [App\Http\Controllers\UserController::class, 'datatable'])->name('user/datatable');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user/create');
Route::get('/user/show/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user/store');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);
