<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/users",[UserController::class,'index']);
Route::get("/users/edit/{id}",[UserController::class,'edit']);
Route::get("/users/delete/{id}",[UserController::class,'Delete']);
Route::post("/users/create",[UserController::class,'store']);
Route::post("/users/update/{id}",[UserController::class,'update']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
