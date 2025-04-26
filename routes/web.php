<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


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
