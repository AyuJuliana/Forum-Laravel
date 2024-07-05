<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;


Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/add', [ForumController::class, 'create'])->name('forum.create');
Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');
Route::get('/forum/{forum}/view', [ForumController::class, 'view'])->name('forum.view');
Route::post('/forum/{forum}/view', [ForumController::class, 'postkomentar'])->name('postkomentar'); // Tambahkan nama rute di sini
Route::get('/login', [AuthController::class, 'login']);
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index']);
