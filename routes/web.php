<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\Http\Controllers;
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
    return view('pages.dashboard-v1');
});

Route::get('/class/datatable',[App\Http\Controllers\ClassController::class, 'datatable'])->name('class/datatable');
Route::get('/class',[App\Http\Controllers\ClassController::class, 'index']);
Route::get('/class/show/{id}',[App\Http\Controllers\ClassController::class, 'show']);
Route::get('/class/create',[App\Http\Controllers\ClassController::class, 'create'])->name('class/create');
Route::get('/class/edit/{id}',[App\Http\Controllers\ClassController::class, 'edit']);
Route::post('/class/store',[App\Http\Controllers\ClassController::class, 'store']);
Route::post('/class/update',[App\Http\Controllers\ClassController::class, 'update']);
Route::get('/class/delete/{id}',[App\Http\Controllers\ClassController::class, 'destroy']);

