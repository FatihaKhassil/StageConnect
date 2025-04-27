<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PFERecruteurController;

route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
route::get('/redirect',[HomeController::class,'redirect']);
route::get('/admin_users',[AdminController::class,'index'])->name('admin.users.index');
route::get('/admin_users_edit',[AdminController::class,'edit'])->name('admin.users.edit');
route::put('/admin_users_update',[AdminController::class,'update'])->name('admin.users.update');
route::post('/admin_users_store',[AdminController::class,'store'])->name('admin.users.store');
route::get('/admin_users_create',[AdminController::class,'create'])->name('admin.users.create');
Route::get('/admin_users_destroy/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin_entreprises_en_attente', [AdminController::class, 'en_attente'])->name('admin.entreprises.en_attente');
Route::get('/admin_entreprises_valides', [AdminController::class, 'entreprisesValidees'])->name('admin.entreprises.validees');
Route::get('/admin_entreprises_rejetes', [AdminController::class, 'entreprisesRejetees'])->name('admin.entreprises.rejetees');
Route::post('/entreprises/{id}/valider', [PFERecruteurController::class, 'valider'])->name('entreprises.valider');
Route::post('/entreprises/{id}/rejeter', [PFERecruteurController::class, 'rejeter'])->name('entreprises.rejeter');