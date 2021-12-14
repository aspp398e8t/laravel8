<?php

use App\Http\Controllers\FrontController;
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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [FrontController::class, 'index']);

Route::get('/hello', [FrontController::class, 'hello']);

Route::get('/news', [FrontController::class, 'news']);

Route::get('/news/{id}', [FrontController::class, 'newsContent']);

Route::get('/createNews', [FrontController::class, 'createNews']);

Route::get('/updateNews/{id}', [FrontController::class, 'updateNews']);

Route::get('/deleteNews/{id}', [FrontController::class, 'deleteNews']);

Route::post('/contact', [FrontController::class, 'contact']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
