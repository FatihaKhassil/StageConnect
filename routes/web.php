<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PFERecruteurController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\OffreController;
use App\Models\PFERecruteur;

route::get('/',[HomeController::class,'index']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});
Route::post('/offres/{offre}/postuler', [CandidatureController::class, 'postuler'])
    ->name('postuler');
route::get('/redirect',[HomeController::class,'redirect']);
Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
//Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
// Pour les admins
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/offres/{offre}/valider', [OffreController::class, 'validerOffre'])->name('offres.valider');
    route::get('/admin_users',[AdminController::class,'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    route::put('/admin_users_update',[AdminController::class,'update'])->name('admin.users.update');
    route::post('/admin_users_store',[AdminController::class,'store'])->name('admin.users.store');
    route::get('/admin_users_create',[AdminController::class,'create'])->name('admin.users.create');
    Route::get('/admin_users_destroy/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    //Gestion des entreprises par l admin
    Route::get('/admin_entreprises_en_attente', [AdminController::class, 'en_attente'])->name('admin.entreprises.en_attente');
    Route::get('/admin_entreprises_valides', [AdminController::class, 'entreprisesValidees'])->name('admin.entreprises.validees');
    Route::get('/admin_entreprises_rejetes', [AdminController::class, 'entreprisesRejetees'])->name('admin.entreprises.rejetees');
    Route::post('/entreprises/{id}/valider', [PFERecruteurController::class, 'valider'])->name('entreprises.valider');
    Route::post('/entreprises/{id}/rejeter', [PFERecruteurController::class, 'rejeter'])->name('entreprises.rejeter');
    //Gestion des offres par l admin
    Route::get('/offres/en-attente', [AdminController::class, 'enAttende'])->name('offres.en_attente');
    Route::get('/offres/valides', [AdminController::class, 'offresValides'])->name('offres.valides');
    Route::get('/offres/non-valides', [AdminController::class, 'offresNonValides'])->name('offres.non_valides');
    Route::post('/offres/{offre}/valider', [AdminController::class, 'valider'])->name('offres.valider');
    Route::post('/offres/{offre}/rejeter', [AdminController::class, 'rejeter'])->name('offres.rejeter');
});
//entreprises
    Route::get('entreprises/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
    Route::get('/mes-offres', [OffreController::class, 'mesOffres'])->name('mes-offres');
    Route::get('/offres/create', [OffreController::class, 'create'])->name('offres.create');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');
    Route::get('/offres_entreprises', [PFERecruteurController::class, 'index']) ->name('entreprise.offres.index');
         //entreprise .offres.index dashboard
    Route::get('/offres', [OffreController::class, 'index'])->name('entreprise.offres.index');
    // Candidatures par statut
    // routes/web.php
    Route::get('/candidatures/en-attente', [CandidatureController::class, 'enAttente'])
         ->name('entreprise.candidatures.en_attente');
         
    // Vue candidatures acceptées
    Route::get('/candidatures/acceptees', [CandidatureController::class, 'acceptees'])
         ->name('entreprise.candidatures.acceptee');
         
    // Vue candidatures rejetées
    Route::get('/candidatures/rejetees', [CandidatureController::class, 'rejetees'])
         ->name('entreprise.candidatures.rejetee');
         
    // Mise à jour statut
    Route::post('/candidatures/{candidature}/update-statut', [CandidatureController::class, 'updateStatut'])
         ->name('entreprise.candidatures.updateStatut');
// Pour les étudiants
    Route::post('/offres/{offre}/postuler', [CandidatureController::class, 'postuler'])->name('postuler');
    Route::get('/offres-disponibles', [OffreController::class, 'indexEtudiant'])->name('offres.disponibles');
    Route::get('/offres/mes_candidatures', [candidatureController::class, 'mesCandidatures'])->name('etudiant.mes-candidatures');
    Route::get('/offres/{offre}', [OffreController::class, 'showEtudiant'])->name('etudiant.offres.show');
    Route::get('/candidatures/{id}/cv', [CandidatureController::class, 'showCV'])->name('candidatures.cv');
