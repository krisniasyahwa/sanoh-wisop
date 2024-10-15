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

// Route untuk halaman manajemen akun
Route::get('/manage-account', [AccountController::class, 'index'])->name('manage-account');

// Group Route untuk Admin dengan middleware 'isAdmin'
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Menampilkan daftar dokumen
    Route::get('/admin/products', [DocumentController::class, 'index'])->name('admin.products.index');
    // Menampilkan form untuk menambah dokumen baru
    Route::get('/admin/products/create', [DocumentController::class, 'create'])->name('admin.products.create');
    // Menyimpan dokumen baru
    Route::post('/admin/products', [DocumentController::class, 'store'])->name('admin.products.store');
    // Menampilkan form untuk mengedit dokumen
    Route::get('/admin/products/{id}/edit', [DocumentController::class, 'edit'])->name('admin.products.edit');
    // Memperbarui dokumen yang sudah ada
    Route::put('/admin/products/{id}', [DocumentController::class, 'update'])->name('admin.products.update');
    // Menghapus dokumen
    Route::delete('/admin/products/{id}', [DocumentController::class, 'destroy'])->name('admin.products.destroy');
});

// Group Route untuk Warehouse dengan middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Menampilkan halaman untuk scan dokumen
    Route::get('/warehouse/scan', [DocumentController::class, 'scan'])->name('warehouse.scan');
    // Menampilkan detail dokumen setelah scan
    Route::post('/warehouse/show', [DocumentController::class, 'show'])->name('warehouse.show');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
