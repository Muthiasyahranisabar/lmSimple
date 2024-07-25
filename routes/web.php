<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EditorDashboardController;
use App\Http\Controllers\ProfileEditorController;
use App\Http\Controllers\EditorController;

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
    return view('dashboard.index');
});

Route::get('/forms-validation', function () {
    return view('forms-validation');
});

Route::get('/tables-data', function () {
    return view('tables-data');
});
// Rute untuk menampilkan form registrasi
Route::get('/register',[AuthController::class, 'showRegisterForm'])->name('register');
// Rute untuk memproses registrasi
Route::post('/register', [AuthController::class, 'register']);
// Rute untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.index');
// Rute untuk memproses login
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['can:isEditor','auth'])->group(function () {
    Route::get('editor/dashboard', [EditorDashboardController::class, 'index'])->name('editor.dashboard');
    Route::get('editor/users-profile', [ProfileEditorController::class, 'index'])->name('editor.users-profile');
    Route::get('editor/logout', [EditorController::class, 'logout'])->name('editor.logout');
    Route::get('editor/tasks', [EditorController::class, 'index'])->name('editor.tasks.index');
    Route::get('editor/tugas/{id}/edit', [EditorController::class, 'edit'])->name('editor.tasks.edit');
    Route::delete('editor/tugas/{id}', [EditorController::class, 'destroy'])->name('editor.tasks.destroy');
});


Route::middleware(['can:isAuthor','auth'])->group(function () {
    Route::get('user/tasks/{id}/downloadPdf', [UserController::class, 'downloadPdf'])->name('user.tasks.downloadPdf');
    Route::post('user/tasks/{id}/complete', [UserController::class, 'complete'])->name('user.tasks.complete');
    Route::get('user/tasks/{id}', [UserController::class, 'show'])->name('user.tasks.show');
    Route::get('user/tasks', [UserController::class, 'index'])->name('user.tasks.index');
    Route::get('user/users-profile', [ProfileUserController::class, 'index'])->name('user.users-profile');
    Route::get('user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('user/tasks', [UserController::class, 'index'])->name('user.tasks.index');
    Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::middleware(['can:isAdmin','auth'])->group(function () {
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users-profile', [ProfileAdminController::class, 'index'])->name('admin.users-profile');
    Route::get('admin/tasks', [AdminController::class, 'index'])->name('admin.tasks.index');
    Route::get('admin/tasks/create', [AdminController::class, 'create'])->name('admin.tasks.create');
    Route::post('admin/tasks', [AdminController::class, 'store'])->name('admin.tasks.store');
    Route::get('admin/tasks/{id}/edit', [AdminController::class, 'edit'])->name('admin.tasks.edit');
    Route::put('admin/tasks/{id}', [AdminController::class, 'update'])->name('admin.tasks.update');
    Route::delete('admin/tasks/{id}', [AdminController::class, 'destroy'])->name('admin.tasks.destroy');
    Route::get('admin/tasks/{id}/download-pdf', [AdminController::class, 'downloadPdf'])->name('admin.tasks.downloadPdf');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
