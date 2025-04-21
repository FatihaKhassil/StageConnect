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
//Route::put('/admin_users/update', [AdminController::class, 'update'])->name('admin.users.update');
Route::patch('/admin_users/{user}/toggle-block', [AdminController::class, 'toggleBlock'])->name('admin.users.toggle-block');
Route::patch('/admin_users/{user}/destroy', [AdminController::class, 'destroy'])->name('admin.users.destroy');
Route::resource('users', AdminController::class)->except(['create', 'store']);

