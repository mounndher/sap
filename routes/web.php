<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TypeArticleController;
use App\Http\Controllers\Admin\SettingLdapController;
use App\Http\Controllers\Admin\GroupeArticleController;
use App\Http\Controllers\Admin\UserController;
use LdapRecord\Container;
use App\Http\Controllers\Admin\UserSapController;
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
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles/store', [ArticleController::class, 'storeDonnesdebase'])->name('articles.store');
    Route::post('articles/store/achat', [ArticleController::class, 'storeachat'])->name('articles.storeachat');
    Route::get('articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('articles/update/achat/{id}', [ArticleController::class, 'updateAchat'])->name('articles.updateAchat');
    Route::post('articles/update/donneesbase/{id}', [ArticleController::class, 'updateDonnesdebase'])->name('articles.updatedonneesbase');
    Route::post('articles/update/Comptabilite/{id}', [ArticleController::class, 'updateComptabilite'])->name('articles.updateComptabilite');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    //////////// get groupe article by type article use ajax
    Route::get('/groupe-articles/{typeArticleId}', [ArticleController::class, 'getGroupes']);
    /////////// type article////////////////////////////////////////////////////////////
    Route::get('typearticles', [TypeArticleController::class, 'index'])->name('typearticles.index');
    Route::get('typearticles/create', [TypeArticleController::class, 'create'])->name('typearticles.create');
    Route::post('typearticles/store', [TypeArticleController::class, 'store'])->name('typearticles.store');
    Route::get('typearticles/edit/{id}', [TypeArticleController::class, 'edit'])->name('typearticles.edit');
    Route::post('typearticles/update/{id}', [TypeArticleController::class, 'update'])->name('typearticles.update');
    Route::delete('/typearticles/{article}', [TypeArticleController::class, 'destroy'])->name('typearticles.destroy');


    /////////// Groupe article////////////////////////////////////////////////////////////
    Route::get('groupearticles', [GroupeArticleController::class, 'index'])->name('groupearticles.index');
    Route::get('groupearticles/create', [GroupeArticleController::class, 'create'])->name('groupearticles.create');
    Route::post('groupearticles/store', [GroupeArticleController::class, 'store'])->name('groupearticles.store');
    Route::get('groupearticles/edit/{id}', [GroupeArticleController::class, 'edit'])->name('groupearticles.edit');
    Route::post('groupearticles/update/{id}', [GroupeArticleController::class, 'update'])->name('groupearticles.update');
    Route::delete('/groupearticles/{article}', [GroupeArticleController::class, 'destroy'])->name('groupearticles.destroy');


    ///////////////// Groupe Acheteur Routes //////////////////////////////////////////////////////////////
    Route::get('groupeacheteurs', [App\Http\Controllers\Admin\GroupeAcheteurcontroller::class, 'index'])->name('groupeacheteurs.index');
    Route::get('groupeacheteurs/create', [App\Http\Controllers\Admin\GroupeAcheteurcontroller::class, 'create'])->name('groupeacheteurs.create');
    Route::post('groupeacheteurs/store', [App\Http\Controllers\Admin\GroupeAcheteurcontroller::class, 'store'])->name('groupeacheteurs.store');
    Route::get('groupeacheteurs/edit/{id}', [App\Http\Controllers\Admin\GroupeAcheteurcontroller::class, 'edit'])->name('groupeacheteurs.edit');
    Route::post('groupeacheteurs/update/{id}', [App\Http\Controllers\Admin\GroupeAcheteurcontroller::class, 'update'])->name('groupeacheteurs.update');
    Route::delete('/groupeacheteurs/{groupeAcheteur}', [App\Http\Controllers\Admin\GroupeAcheteurcontroller::class, 'destroy'])->name('groupeacheteurs.destroy');


    ///LDAP sETTING rOUTE//////////////////////////////////////////////////////////////
    Route::get('Ldapsetting', [SettingLdapController::class, 'index'])->name('Ldapsetting.index');
    Route::post('Ldapsetting/update/{id}', [SettingLdapController::class, 'update'])->name('Ldapsetting.update');
    ////////////  USER ROUTES //////////////////////////////////////////////////////////////
    Route::get('users',[UserController::class,'index'])->name('users.index');
     ///////user sap routes///////////////////////////////////////////////////////////////
    Route::get('usersap', [UserSapController::class, 'index'])->name('usersap.index');
    Route::post('usersap/update/{id}', [UserSapController::class, 'update'])->name('usersap.update');

     // Route classv
     Route::get('classv', [App\Http\Controllers\Admin\ClassvController::class, 'index'])->name('classvs.index');
    Route::get('classv/create', [App\Http\Controllers\Admin\ClassvController::class, 'create'])->name('classvs.create');
    Route::post('classv/store', [App\Http\Controllers\Admin\ClassvController::class, 'store'])->name('classvs.store');
    Route::get('classv/edit/{id}', [App\Http\Controllers\Admin\ClassvController::class, 'edit'])->name('classvs.edit');
    Route::post('classv/update/{id}', [App\Http\Controllers\Admin\ClassvController::class, 'update'])->name('classvs.update');
    Route::delete('/classv/{classv}', [App\Http\Controllers\Admin\ClassvController::class, 'destroy'])->name('classvs.destroy');

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



require __DIR__ . '/auth.php';
