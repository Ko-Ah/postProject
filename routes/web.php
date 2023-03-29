<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/categories', function () {
    return view('dashboard.categories.index');
})->middleware(['auth'])->name('categories.index');

//posts
Route::get('/dashboard/posts/create',[PostController::class,'create'])->middleware(['auth'])->name('posts.create');
Route::get('/dashboard/posts',[PostController::class,'show'])->middleware(['auth'])->name('posts.show');
Route::post('/dashboard/posts',[PostController::class,'store'])->middleware(['auth'])->name('posts.store');
Route::get('/dashboard/posts/{post}',[PostController::class,'showPost'])->middleware(['auth'])->name('posts.showPost');
Route::get('/dashboard/posts/{post}/edit',[PostController::class,'edit'])->middleware(['auth'])->name('posts.edit');
Route::patch('/dashboard/posts/{post}/update',[PostController::class,'update'])->middleware(['auth'])->name('posts.update');
Route::get('/dashboard/posts-delete',[PostController::class,'destroy'])->middleware(['auth'])->name('posts.delete');
Route::get('/dashboard/posts-search',[PostController::class,'search'])->middleware(['auth'])->name('posts.search');
Route::post('ckeditor/upload', [PostController::class,'ckeditor'])->name('ckeditor.upload');
//tags
Route::get('/dashboard/tags-delete',[TagController::class,'destroy'])->middleware(['auth'])->name('tags.destroy');
Route::get('/dashboard/tags-edit',[TagController::class,'edit'])->middleware(['auth'])->name('tags.edit');
Route::get('/dashboard/tags/ajax',[TagController::class,'show'])->middleware(['auth'])->name('tags.show');
Route::get('/dashboard/tags',[TagController::class,'index'])->middleware(['auth'])->name('tags.index');
Route::get('/dashboard/tags-update',[TagController::class,'update'])->middleware(['auth'])->name('tags.update');
Route::get('/dashboard/tags/add',[TagController::class,'store'])->middleware(['auth'])->name('tags.store');

//categories
Route::get('/dashboard/categories-delete',[CategoryController::class,'destroy'])->middleware(['auth'])->name('categories.destroy');
Route::get('/dashboard/categories-edit',[CategoryController::class,'edit'])->middleware(['auth'])->name('categories.edit');
Route::get('/dashboard/categories/Category',[CategoryController::class,'showCategory'])->middleware(['auth'])->name('categories.showCategory');
Route::get('/dashboard/categories/ajax',[CategoryController::class,'show'])->middleware(['auth'])->name('categories.show');
Route::get('/dashboard/categories',[CategoryController::class,'index'])->middleware(['auth'])->name('categories.index');
Route::get('/dashboard/categories-update',[CategoryController::class,'update'])->middleware(['auth'])->name('categories.update');
Route::get('/dashboard/categories/add',[CategoryController::class,'store'])->middleware(['auth'])->name('categories.store');

Route::middleware('auth')->group(function () {
    Route::get('/like', [LikeController::class,'like'])->name('dashboard.like');
    Route::get('/unlike', [LikeController::class,'unlike'])->name('dashboard.unlike');
    Route::get('/dashboard/posts-comments',[CommentController::class,'store'])->name('comments');
});
require __DIR__.'/auth.php';
