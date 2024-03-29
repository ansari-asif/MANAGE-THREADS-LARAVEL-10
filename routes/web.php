<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\ThreadsTagsController;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class,'home'])->middleware('auth')->name('home');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register',[AuthController::class,'register_submit'])->name('register_submit');
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/login',[AuthController::class,'login_submit'])->name('login_submit');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/forgot-password',[AuthController::class,'forgot_password'])->name('forgot_password');
Route::post('/forgot-password',[AuthController::class,'forgot_password_submit'])->name('forgot_password_submit');
Route::get('reset-password/{token}',[AuthController::class,"reset_password"])->name('password.reset');
Route::post('reset-password',[AuthController::class,"reset_password_submit"])->name('password.update');

Route::middleware(['auth'])->group(function(){
    Route::get('thread-tags',[ThreadsTagsController::class,'index'])->name('threads_tags');
    Route::get('add-thread-tags',[ThreadsTagsController::class,'create'])->name('add_threads_tags');
    Route::post('add-thread-tags',[ThreadsTagsController::class,'store'])->name('add_threads_tags_submit');
    Route::get('edit-thread-tags/{id}',[ThreadsTagsController::class,'edit'])->name('edit_threads_tags');
    Route::put('edit-thread-tags/{id}',[ThreadsTagsController::class,'update'])->name('update_threads_tags');
    Route::get('delete-thread-tags/{id}',[ThreadsTagsController::class,'destroy'])->name('delete_threads_tags');
});
Route::middleware(['auth'])->group(function(){
    Route::get('threads',[ThreadsController::class,'index'])->name('threads');
    Route::get('add-thread',[ThreadsController::class,'create'])->name('add_threads');
    Route::post('add-thread',[ThreadsController::class,'store'])->name('add_thread_submit');
    Route::get('edit-thread/{id}',[ThreadsController::class,'edit'])->name('edit_thread');
    Route::put('edit-thread/{id}',[ThreadsController::class,'update'])->name('update_thread');
    Route::get('delete-thread/{id}',[ThreadsController::class,'destroy'])->name('delete_thread');
    Route::post('threads/like',[ThreadsController::class,'thread_like'])->name('threads_like');
    Route::post('threads/comment',[ThreadsController::class,'thread_comment'])->name('thread_comment');
}); 
