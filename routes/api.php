<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    
    return $request->user();
});
Route::post('create_question', [App\Http\Controllers\QuestionController::class, 'store'])->name('create_question');
Route::post('save_progress',[App\Http\Controllers\ProgressController::class,'store'])->name('save_progress');
Route::get('progress/{user_id}',[App\Http\Controllers\ProgressController::class,'show'])->name('current_progress');


