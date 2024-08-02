<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\UserController;

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
});
// Routes pour les utilisateurs (clients)
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [UserController::class, 'updateProfile'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/documents/upload', [UserController::class, 'uploadDocument'])->name('documents.upload');
    Route::get('/documents', [UserController::class, 'viewDocuments'])->name('documents.view');
    Route::get('/dossiers', [UserController::class, 'viewDossiers'])->name('dossiers.view');
    Route::post('/support-tickets', [UserController::class, 'createSupportTicket'])->name('support-tickets.create');
    Route::get('/support-tickets', [UserController::class, 'viewSupportTickets'])->name('support-tickets.view');
});

// Routes pour les partenaires
// Route::group(['middleware' => ['auth', 'role:partenaire']], function () {
//     Route::get('/partner/dashboard', [UserController::class, 'viewPartnerDashboard'])->name('partner.dashboard');
//     Route::get('/partner/dossiers', [PartnerController::class, 'viewClientDossiers'])->name('partner.dossiers.view');
//     Route::post('/partner/message', [PartnerController::class, 'sendPartnerMessage'])->name('partner.message.send');
// });

// Routes pour les administrateurs
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.manage');
    Route::post('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/admin/documents', [AdminController::class, 'manageDocuments'])->name('admin.documents.manage');
    Route::post('/admin/documents/{id}/approve', [AdminController::class, 'approveDocument'])->name('admin.documents.approve');
    Route::post('/admin/documents/{id}/reject', [AdminController::class, 'rejectDocument'])->name('admin.documents.reject');
    Route::get('/admin/dossiers', [AdminController::class, 'manageDossiers'])->name('admin.dossiers.manage');
    Route::post('/admin/dossiers/{id}/status', [AdminController::class, 'updateDossierStatus'])->name('admin.dossiers.update.status');
    Route::post('/admin/notifications', [AdminController::class, 'sendNotification'])->name('admin.notifications.send');
    Route::get('/admin/statistics', [AdminController::class, 'viewStatistics'])->name('admin.statistics.view');
});

// Routes CRUD pour les dossiers
Route::get('/dossiers', [DossierController::class, 'index'])->name('dossiers.index');
Route::get('/dossiers/create', [DossierController::class, 'create'])->name('dossiers.create');
Route::post('/dossiers', [DossierController::class, 'store'])->name('dossiers.store');
Route::get('/dossiers/{id}', [DossierController::class, 'show'])->name('dossiers.show');
Route::get('/dossiers/{id}/edit', [DossierController::class, 'edit'])->name('dossiers.edit');
Route::put('/dossiers/{id}', [DossierController::class, 'update'])->name('dossiers.update');
Route::delete('/dossiers/{id}', [DossierController::class, 'destroy'])->name('dossiers.destroy');

// Routes CRUD pour les documents
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

// Routes CRUD pour les tickets de support
Route::get('/support-tickets', [SupportTicketController::class, 'index'])->name('support-tickets.index');
Route::get('/support-tickets/create', [SupportTicketController::class, 'create'])->name('support-tickets.create');
Route::post('/support-tickets', [SupportTicketController::class, 'store'])->name('support-tickets.store');
Route::get('/support-tickets/{id}', [SupportTicketController::class, 'show'])->name('support-tickets.show');
Route::get('/support-tickets/{id}/edit', [SupportTicketController::class, 'edit'])->name('support-tickets.edit');
Route::put('/support-tickets/{id}', [SupportTicketController::class, 'update'])->name('support-tickets.update');
Route::delete('/support-tickets/{id}', [SupportTicketController::class, 'destroy'])->name('support-tickets.destroy');

require __DIR__.'/auth.php';
