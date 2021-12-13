<?php

use App\Http\Controllers\ProgressController;
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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/add-question', function () {
    return view('addQuestion');
})->middleware(['auth'])->name('addQuestion');

Route::get('/my-progress', function () {
    return view('progress');
})->middleware(['auth'])->name('progress');


Route::get('/user',[ProgressController::class, 'getMe']);

require __DIR__.'/auth.php';
