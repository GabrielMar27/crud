<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userController;
use App\Http\Middleware\isEditor;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\isSubscribedMiddleWare;
Route::get("/",[PostController::class,'index'])->name('/');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware([isSubscribedMiddleWare::class])->group(function () {
    Route::get('/subscribe/{user}', [SubscriptionController::class, 'create'])->name("subscribe.SubscribeForm");
    Route::post('/subscribe/{user}',[SubscriptionController::class,'store'])->name('subscribe.store');
    Route::delete('/subscribe/{userID}',[SubscriptionController::class,'delete'])->name('subscribe.destroy');
});
Route::middleware([isEditor::class])->group(function () {

    //route for new post
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/posts/create',[PostController::class,'store'])->name('posts.store');
    //rotue for editing posts
    Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}/edit',[PostController::class,'update'])->name('posts.update');
    //route for delet post
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
    Route::resource("usersManagement",userController::class)->middleware(IsAdminMiddleware::class);

});
Route::get("/posts/{post}",[PostController::class,'show'])->name('posts.show');
Route::get('/post/{user}',[PostController::class,'indexCreatedBy'])->name('posts.indexCreatedBy');
require __DIR__.'/auth.php';
