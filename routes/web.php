<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FestivityController;
use App\Http\Controllers\FestivityImagesController;
use App\Http\Controllers\FileCategoryController;
use App\Http\Controllers\FileSubCategoryController;
use App\Models\FileCategory;

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
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');

Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('posts', [PostController::class, 'index'])->name('posts');
Route::post('posts', [PostController::class, 'store'])->name('managePosts.store');
Route::get('managePosts/create', [PostController::class, 'create'])->name('managePosts.create');
Route::put('managePosts/{post}',[PostController::class, 'update'])->name('managePosts.update');
Route::get('managePosts', [PostController::class, 'list'])->name('managePosts.index');
Route::get('managePosts/{post}/edit', [PostController::class, 'edit'])->name('managePosts.edit');
Route::delete('managePosts/delete/{id}',[PostController::class, 'destroy'])->name('managePosts.destroy');
Route::delete('managePost/images/delete/{file}',[PostController::class, 'deleteImages'])->name('managePosts.deleteImages');

Route::get('manageTags/list/tags', [TagController::class, 'index']);
Route::delete('manageTags/delete/{tag}/{post}',[TagController::class, 'destroy'])->name('manageTags.destroy');

Route::get('manageFiles', [FileController::class, 'index'])->name('manageFiles.index');
Route::get('uploadFiles', [FileController::class, 'create'])->name('uploadFiles');
Route::post('manageFiles',[FileController::class, 'store'])->name('manageFiles.store');
Route::put('manageFiles/{file}',[FileController::class, 'update'])->name('manageFiles.update');
Route::get('manageFiles/{file}/edit', [FileController::class, 'edit'])->name('manageFiles.edit');
Route::delete('manageFiles/delete/{id}',[FileController::class, 'destroy'])->name('manageFiles.destroy');

Route::get('manageFileCategories', [FileCategoryController::class, 'show'])->name('manageFileCategories.index');
Route::get('manageFileCategories/{fileCategory}/edit', [FileCategoryController::class, 'edit'])->name('manageFileCategories.edit');
Route::post('manageFileCategories',[FileCategoryController::class, 'store'])->name('manageFileCategories.store');
Route::delete('manageFileCategories/delete/{id}',[FileCategoryController::class, 'destroy'])->name('manageFileCategories.destroy');
Route::put('manageFileCategories/{fileCategory}',[FileCategoryController::class, 'update'])->name('manageFileCategories.update');


Route::post('manageFileSubCategories',[FileSubCategoryController::class, 'store'])->name('manageFileSubCategories.store');
Route::put('manageFileSubCategories/{fileSubCategory}',[FileSubCategoryController::class, 'update'])->name('manageFileSubCategories.update');
Route::delete('manageFileSubCategories/delete/{id}',[FileSubCategoryController::class, 'destroy'])->name('manageFileSubCategories.destroy');
Route::post('manageFileSubCategories/{fileSubCategory}',[FileSubCategoryController::class, 'remove_accent'])->name('manageFileSubCategories.remove_accent');

Route::get('manageCards', [CardController::class, 'index'])->name('manageCards.index');
Route::get('manageCards/create', [CardController::class, 'create'])->name('manageCards.create');
Route::post('manageCards',[CardController::class, 'store'])->name('manageCards.store');
Route::get('manageCards/{card}/edit', [CardController::class, 'edit'])->name('manageCards.edit');
Route::delete('manageCards/delete/{id}',[CardController::class, 'destroy'])->name('manageCards.destroy');
Route::delete('manageCards/images/delete/{file}',[CardController::class, 'deleteImages'])->name('manageCards.deleteImages');
Route::delete('manageCards/imagesOnclick/delete/{file}',[CardController::class, 'deleteImagesOnclick'])->name('manageCards.deleteImagesOnclick');
Route::put('manageCards/{id}',[CardController::class, 'update'])->name('manageCards.update');

Route::get('festivities', [FestivityController::class, 'index'])->name('festivities');
Route::get('manageFestivities', [FestivityController::class, 'list'])->name('manageFestivities.index');
Route::get('manageFestivities/create', [FestivityController::class, 'create'])->name('manageFestivities.create');
Route::post('manageFestivities',[FestivityController::class, 'store'])->name('manageFestivities.store');
Route::get('manageFestivities/{festivity}/edit', [FestivityController::class, 'edit'])->name('manageFestivities.edit');
Route::delete('manageFestivities/delete/{id}',[FestivityController::class, 'destroy'])->name('manageFestivities.destroy');
Route::put('manageFestivities/{festivity}',[FestivityController::class, 'update'])->name('manageFestivities.update');

Route::delete('manageFestivityImages/delete/{file}',[FestivityImagesController::class, 'destroy'])->name('manageFestivityImages.destroy');

Route::get('{fileCategory}/{fileSubCategory}', [FileController::class, 'files'])->name('years');
Route::get('{fileCategory}/{fileSubCategory}/{year?}', [FileController::class, 'files'])->name('files');


Route::post('ajaxRequest', [FileController::class, 'ajaxRequest'])->name('ajaxRequest');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
