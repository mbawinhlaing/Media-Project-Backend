<?php

use App\Http\Controllers\api\CategoryController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\ActionLogController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');
//Post
Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('post/search',[PostController::class,'postSearch']);
Route::post('post/details',[PostController::class,'postDetails']);
Route::get('post/all/{id}',[PostController::class,'postGet']);
Route::get('post/single/{id}',[PostController::class,'getSinglePost']);

//Category
Route::get('allCategory',[CategoryController::class, 'getAllCategory']);
Route::post('catetegory/search',[CategoryController::class,'categorySearch']);

//Action Log
Route::post('post/actionLog',[ActionLogController::class,'setActiionlog']);