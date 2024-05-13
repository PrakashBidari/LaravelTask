<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\UserController;

Route::get('/', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::group(['middleware' => ['auth', 'check.admin']], function () {
    Route::get('/users',[UserController::class,'index'])->name('user.index');
    Route::get('/users/{user}',[UserController::class,'edit'])->name('user.edit');
    Route::put('/users/{user}/update',[UserController::class,'update'])->name('user.update');
    Route::delete('/users/{id}',[UserController::class,'destroy'])->name('user.delete');
});



// For News Manager Dashboard
Route::group(['middleware' => ['auth','check.newsmanager']], function () {
    Route::resources([
        'categories' => CategoryController::class,
        'news' => NewsController::class,
    ]);

});

// For Blog Manager Dashboard
Route::group(['middleware' => ['auth','check.blogmanager']], function () {
    Route::resources([
        'categories' => CategoryController::class,
    ]);

    Route::resource('news', NewsController::class)->except('index');
    Route::get('/blog',[NewsController::class,'blog'])->name('blog');
});
