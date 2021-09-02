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

Route::get('{fileCategory}/{fileSubCategory}', [FileController::class, 'files'])->name('files');

Route::get('manageFiles', [FileController::class, 'index'])->name('manageFiles.index');
Route::get('uploadFiles', [FileController::class, 'create'])->name('uploadFiles');
Route::post('manageFiles',[FileController::class, 'store'])->name('manageFiles.store');
Route::put('manageFiles/{file}',[FileController::class, 'update'])->name('manageFiles.update');
Route::get('manageFiles/{file}/edit', [FileController::class, 'edit'])->name('manageFiles.edit');
Route::delete('manageFiles/delete/{id}',[FileController::class, 'destroy'])->name('manageFiles.destroy');

Route::post('ajaxRequest', [FileController::class, 'ajaxRequest'])->name('ajaxRequest');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
