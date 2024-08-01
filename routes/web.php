<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

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
    return view('layouts.index');
});
Route::get('/document',[MenuController::class,'indexDocs'])->name('document.index');
Route::get('/client',[MenuController::class,'indexClient'])->name('client.index');
Route::get('/Gestion des documents',[MenuController::class,'indexGesDocs'])->name('GesDesDocs.index');
Route::get('/Gestion des dossiers',[MenuController::class,'indexGesDoss'])->name('GesDesDossiers.index');
Route::get('/Gestion des utilisateurs',[MenuController::class,'indexGesUsers'])->name('GesDesUsers.index');
Route::get('/message',[MenuController::class,'indexMessage'])->name('message.index');
Route::get('/notification',[MenuController::class,'indexNotif'])->name('notification.index');
Route::get('/profil',[MenuController::class,'indexProfil'])->name('profil.index');
Route::get('/support',[MenuController::class,'indexSupp'])->name('support.index');

