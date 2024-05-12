<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsController;


Route::get('/', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::group(['middleware' => ['auth', 'check.admin']], function () {

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
