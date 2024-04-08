<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\LogoutController; 
use App\Http\Controllers\PostCreateController; 
use App\Http\Controllers\PostDestroyController; 
use App\Http\Controllers\PostUpdateController; 

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

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [RegisterController::class,'create'])->name('register'); # Форма регистрации

    Route::post('/register', [RegisterController::class,'store'])->name('register.store'); # Создание записи пользователя в БД

    Route::get('/login', [LoginController::class,'create'])->name('login'); # Форма логина

    Route::post('/login', [LoginController::class,'store'])->name('login.store'); # Авторизация пользователя
});

Route::middleware(['auth'])->group(function() {
    Route::get('/{username}/post/create', [PostCreateController::class,'create'])->name('post.create'); # Форма создания поста

    Route::post('/{username}/post/create', [PostCreateController::class,'store'])->name('post.store'); # Создание поста в БД

    Route::get('/{username}/post/edit/{id}', [PostUpdateController::class,'edit'])->name('post.edit'); # Форма редактирования поста

    Route::post('/{username}/post/edit/{id}', [PostUpdateController::class,'update'])->name('post.update'); # Редактирование поста в БД

    Route::get('/{username}/post/delete/{id}', [PostDestroyController::class,'destroy'])->name('post.destroy'); # Удаление поста

    Route::get('/{username}/logout', [LogoutController::class,'destroy'])->name('user.logout'); # Выход из учётной записи
});

Route::get('/', [WelcomeController::class,'index'])->name('welcome'); # Главная настраница

Route::get('/{username}', [ProfileController::class,'index'])->name('user.profile');  # Открыть посты пользователя