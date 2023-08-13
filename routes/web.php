<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),
    'verified'])->group(function () {

        //Admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'adminUpdateAccount'])->name('admin#update');
    Route::get('admin/changePasswordPage',[ProfileController::class,'changePasswordPage'])->name('admin#ChangePasswordPage');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    // Admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#accountDelete');
    Route::post('admin/list',[ListController::class,'adminListSearch'])->name('admin#list');
    //Category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::post('category/search',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}',[CategoryController::class,'categoryedit'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');


    //Post
    Route::get('posts',[PostController::class,'index'])->name('admin#post');
    Route::post('admin/createPost',[PostController::class,'createPost'])->name('admin#createPost');
    Route::get('admin/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletePost');
    Route::get('admin/updatePost/{id}',[PostController::class,'updatePostPage'])->name('admin#updatePage');
    Route::post('admin/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');
    //Trend
    Route::get('trend',[TrendPostController::class,'index'])->name('admin#trend');

});
