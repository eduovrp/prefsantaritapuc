<?php

use App\Http\Controllers\FileCategoryController;
use App\Http\Controllers\FileSubCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Models\FileSubCategory;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('posts', [PostController::class, 'index'])->name('posts');

Route::get('{fileCategory}/{fileSubCategory}', [FileController::class, 'index'])->name('file.index');

Route::get('manageFiles', [FileController::class, 'files'])->name('manageFiles');
Route::get('manageFiles/{file}/edit', [FileController::class, 'edit'])->name('editFile');
Route::put('manageFiles/{file}',[FileController::class, 'update'])->name('fileUpdate');
Route::get('uploadFiles', [FileCategoryController::class, 'uploadFiles'])->name('uploadFiles');

Route::post('uploadFiles', [FileSubCategoryController::class, 'ajaxRequest'])->name('ajaxRequest');

Route::post('files',[FileController::class, 'upload'])->name('fileUpload');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
