<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/profile', [AdminController::class, 'Admin_Profile'])->name('admin.profile');
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');


    Route::get('admin/user', [AdminController::class, 'AdminUser'])->name('admin.user');
    Route::get('admin/user/add', [AdminController::class, 'AdminUser_add'])->name('admin.user_add');
    Route::get('admin/user/edit/{id}', [AdminController::class, 'AdminUser_edit'])->name('admin.user_edit');
    Route::post('admin/user/update/{id}', [AdminController::class, 'AdminUser_update'])->name('admin.user_update');
    Route::post('admin/user/updated/', [AdminController::class, 'AdminUser_updated'])->name('admin.user_updated');
    Route::get('admin/user/ChangeStatus/', [AdminController::class, 'AdminUser_ChangeStatus'])->name('admin.user_ChangeStatus');
    Route::get('admin/user/delete/{id}', [AdminController::class, 'AdminUser_delete'])->name('admin.user_delete');
    Route::post('admin/user/add', [AdminController::class, 'AdminUser_add_store'])->name('admin.user_add.store');



    Route::get('admin/email/compose', [EmailController::class, 'email_compose'])->name('admin.email_compose');
    Route::get('admin/email/sent', [EmailController::class, 'email_sent'])->name('admin.email_sent');
    Route::post('admin/email/compose_post', [EmailController::class, 'email_compose_post'])->name('admin_email.post');

    
    Route::get('admin/email_sent/', [EmailController::class, 'admin_email_sent_delete']);
    Route::get('admin/user/view/{id}', [AdminController::class, 'admin_user_view'])->name('admin.user_view');

    
    Route::post('admin_profile/update', [AdminController::class, 'admin_profile_update'])->name('admin_profile.update');

    Route::get('admin/email/read/{id}' , [EmailController::class , 'admin_email_read']);
    Route::get('admin/email/single_delete/{id}' , [EmailController::class , 'admin_email_single_delete']);

    Route::get('admin/myprofile' , [AdminController::class , 'admin_myprofile']);
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('set_new_password/{token}' , [AdminController::class , 'set_new_password']);
Route::post('set_new_password/{token}' , [AdminController::class , 'set_new_password_post']);
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');