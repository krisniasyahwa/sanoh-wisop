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

Route::get('/get-document', [DocumentController::class, 'getDocument'])->name('document.get');

// Route untuk upload file yang bisa diakses oleh semua pengguna yang sudah login
Route::post('/documents/upload', [DocumentController::class, 'uploadFile'])->name('documents.upload');

//Route untuk mengambil data
Route::post('/documents/get-document', [DocumentController::class, 'getDocument'])->name('documents.get');

// // Route untuk halaman manajemen akun
// Route::post('/documents/get-document', [DocumentController::class, 'getDocument'])->name('documents.get');

// Route untuk menampilkan form edit
Route::get('/document/edit/{doc_id}', [DocumentController::class, 'edit'])->name('document.edit');

//Route untuk memperbarui
Route::put('/document/update/{doc_id}', [DocumentController::class, 'update'])->name('documents.update');

Route::get('/home', [DocumentController::class, 'index'])->name('home')->middleware('auth');
