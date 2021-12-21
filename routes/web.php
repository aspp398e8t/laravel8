<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ToolboxController;

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


// Route::get('/news', [FrontController::class, 'newslist']);

// Route::get('/news/{id}', [FrontController::class, 'newsContent']);

Route::prefix('/news')->group(function () {
    Route::get('/', [FrontController::class, 'newslist']);
    Route::get('/{id}', [FrontController::class, 'newsContent']);
});

Route::post('/contact', [FrontController::class, 'contact']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// 後台
Route::prefix('/admin')->group(function () {
    // 最新消息
    Route::prefix('/news')->middleware(['auth'])->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/', [NewsController::class, 'store'])->name('news.store');
        Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::patch('/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    Route::prefix('facility')->group(function () {
        Route::get('/', [FacilityController::class, 'index'])->name('facility.index');
        Route::get('/create', [FacilityController::class, 'create'])->name('facility.create');
        Route::post('/', [FacilityController::class, 'store'])->name('facility.store');
        Route::get('/{id}/edit', [FacilityController::class, 'edit'])->name('facility.edit');
        Route::patch('/{id}', [FacilityController::class, 'update'])->name('facility.update');
        Route::delete('/{id}', [FacilityController::class, 'destroy'])->name('facility.destroy');
    });

    Route::post('/image-upload', [ToolboxController::class, 'imageUpload'])->name('tool.image_upload');
});
