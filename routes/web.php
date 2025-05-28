<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TypeArticleController;
use LdapRecord\Container;
use LdapRecord\Models\ActiveDirectory\User;
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
    Route::post('articles/update/achat/{id}',[ArticleController::class, 'updateAchat'])->name('articles.updateAchat');
    Route::post('articles/update/donneesbase/{id}',[ArticleController::class, 'updateDonnesdebase'])->name('articles.updatedonneesbase');
    Route::post('articles/update/Comptabilite/{id}', [ArticleController::class, 'updateComptabilite'])->name('articles.updateComptabilite');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    /////////// type article////////////////////////////////////////////////////////////
    Route::get('typearticles',[TypeArticleController::class, 'index'])->name('typearticles.index');
    Route::get('typearticles/create',[TypeArticleController::class, 'create'])->name('typearticles.create');
    Route::post('typearticles/store',[TypeArticleController::class, 'store'])->name('typearticles.store');
    Route::get('typearticles/edit/{id}',[TypeArticleController::class, 'edit'])->name('typearticles.edit');
    Route::post('typearticles/update/{id}',[ArticleController::class, 'update'])->name('typearticles.update');
    Route::delete('/typearticles/{article}', [TypeArticleController::class, 'destroy'])->name('typearticles.destroy');







});
// routes/web.php
Route::get('/sap-materials', [SapController::class, 'showMaterials']);
Route::get('/sap-showuinte', [SapController::class, 'showuinte']);
Route::get('/view-materials', [SapController::class, 'viewMaterials'])->name('show.materials');
Route::get('/ldap-test', function () {
    try {
        $connection = Container::getDefaultConnection();
        $connection->connect();
        return '✅ Connexion LDAP réussie !';
    } catch (\Exception $e) {
        return '❌ Erreur : ' . $e->getMessage();
    }
});
Route::get('/ldap-login-test', function () {
    $credentials = [
        'username' => 'glpi1', // CN of LDAP user
        'password' => 'pharma@2025', // User password
    ];

    if (Auth::attempt($credentials)) {
        return '✅ Login successful';
    } else {
        return '❌ Login failed';
    }
});
require __DIR__.'/auth.php';
