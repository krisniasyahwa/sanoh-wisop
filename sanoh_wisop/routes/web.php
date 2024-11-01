<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route untuk register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route untuk halaman utama setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Route untuk menampilkan halaman dokumen (sebagai user biasa)
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');

//Route untuk mengambil data
Route::post('/documents/get-document', [DocumentController::class, 'getDocument'])->name('documents.get');

// Route untuk halaman manajemen akun
Route::post('/documents/get-document', [DocumentController::class, 'getDocument'])->name('documents.get');

// Group Route untuk Admin dengan middleware 'isAdmin'
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Menampilkan daftar dokumen
    Route::get('/admin/documents', [DocumentController::class, 'index'])->name('admin.documents.index');
    // Menampilkan form untuk menambah dokumen baru
    Route::get('/admin/documents/create', [DocumentController::class, 'create'])->name('admin.documents.create');
    // Menyimpan dokumen baru
    Route::post('/admin/documents', [DocumentController::class, 'store'])->name('admin.documents.store');
    // Menampilkan form untuk mengedit dokumen
    Route::get('/admin/documents/{id}/edit', [DocumentController::class, 'edit'])->name('admin.documents.edit');
    // Memperbarui dokumen yang sudah ada
    Route::put('/admin/documents/{id}', [DocumentController::class, 'update'])->name('admin.documents.update');
    // Menghapus dokumen
    Route::delete('/admin/documents/{id}', [DocumentController::class, 'destroy'])->name('admin.documents.destroy');
});

// Group Route untuk Warehouse dengan middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Menampilkan halaman untuk scan dokumen
    Route::get('/warehouse/scan', [DocumentController::class, 'scan'])->name('warehouse.scan');
    // Menampilkan detail dokumen setelah scan
    Route::post('/warehouse/show', [DocumentController::class, 'show'])->name('warehouse.show');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
