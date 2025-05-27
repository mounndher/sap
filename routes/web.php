<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapController;
use App\Http\Controllers\Admin\ArticleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ///////////////// Article Routes //////////////////////////////////////////////////////////////
    Route::get('articles',[ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/create',[ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles/store',[ArticleController::class, 'storeDonnesdebase'])->name('articles.store');
    Route::post('articles/store/achat',[ArticleController::class, 'storeachat'])->name('articles.storeachat');
    Route::get('/achat-form/{article_id}', [ArticleController::class, 'showAchatForm'])->name('showAchatForm');

    Route::get('articles/edit/{id}',[ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/update/{id}',[ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');



});
// routes/web.php
Route::get('/sap-materials', [SapController::class, 'showMaterials']);
Route::get('/sap-showuinte', [SapController::class, 'showuinte']);
Route::get('/view-materials', [SapController::class, 'viewMaterials'])->name('show.materials');
require __DIR__.'/auth.php';
