<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WaliKelasController;
use App\Http\Controllers\GuruController;


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
    return view('index');
});
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
Route::get('/nilai_siswa', [NilaiController::class, 'index'])->name('nilai_siswa');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Admin
Route::prefix('admin')->name('admin.')->middleware([])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen Guru
    Route::get('/guru', [AdminController::class, 'guruIndex'])->name('guru.index');
    Route::get('/guru/create', [AdminController::class, 'guruCreate'])->name('guru.create');
    Route::post('/guru', [AdminController::class, 'guruStore'])->name('guru.store');
    Route::get('/guru/{guru}/edit', [AdminController::class, 'guruEdit'])->name('guru.edit');
    Route::put('/guru/{guru}', [AdminController::class, 'guruUpdate'])->name('guru.update');
    Route::delete('/guru/{guru}', [AdminController::class, 'guruDestroy'])->name('guru.destroy');

    // Gallery routes
    Route::get('/gallery', [AdminController::class, 'galleryIndex'])->name('gallery.index');
    Route::get('/gallery/create', [AdminController::class, 'galleryCreate'])->name('gallery.create');
    Route::post('/gallery', [AdminController::class, 'galleryStore'])->name('gallery.store');
    Route::delete('/gallery/{gallery}', [AdminController::class, 'galleryDestroy'])->name('gallery.destroy');

    // Manajemen Wali Kelas
    Route::get('/walikelas', [AdminController::class, 'walikelasIndex'])->name('walikelas.index');
    Route::get('/walikelas/create', [AdminController::class, 'walikelasCreate'])->name('walikelas.create');
    Route::post('/walikelas', [AdminController::class, 'walikelasStore'])->name('walikelas.store');
    Route::get('/walikelas/{id}/edit', [AdminController::class, 'walikelasEdit'])->name('walikelas.edit');
    Route::put('/walikelas/{id}', [AdminController::class, 'walikelasUpdate'])->name('walikelas.update');
    Route::delete('/walikelas/{id}', [AdminController::class, 'walikelasDestroy'])->name('walikelas.destroy');

    // Manajemen Siswa
    Route::get('/siswa', [AdminController::class, 'siswaIndex'])->name('siswa.index');
    Route::get('/siswa/create', [AdminController::class, 'siswaCreate'])->name('siswa.create');
    Route::post('/siswa', [AdminController::class, 'siswaStore'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [AdminController::class, 'siswaEdit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [AdminController::class, 'siswaUpdate'])->name('siswa.update');
    Route::delete('/siswa/{id}', [AdminController::class, 'siswaDestroy'])->name('siswa.destroy');

    // Nilai routes
    Route::get('/nilai', [AdminController::class, 'nilaiIndex'])->name('nilai.index');
    Route::get('/nilai/create', [AdminController::class, 'nilaiCreate'])->name('nilai.create');
    Route::post('/nilai', [AdminController::class, 'nilaiStore'])->name('nilai.store');
    Route::get('/nilai/{id}/edit', [AdminController::class, 'nilaiEdit'])->name('nilai.edit');
    Route::put('/nilai/{id}', [AdminController::class, 'nilaiUpdate'])->name('nilai.update');
    Route::delete('/nilai/{id}', [AdminController::class, 'nilaiDestroy'])->name('nilai.destroy');
});

// Route Wali Kelas
Route::middleware([])->prefix('walikelas')->group(function () {
    Route::get('/dashboard', [WaliKelasController::class, 'dashboard'])->name('walikelas.dashboard');
    Route::get('/rapot', [WaliKelasController::class, 'rapot'])->name('walikelas.rapot');
    Route::get('/leger', [WaliKelasController::class, 'leger'])->name('walikelas.leger');
});

// Route Guru
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [GuruController::class, 'profile'])->name('profile');
    Route::put('/profile', [GuruController::class, 'updateProfile'])->name('update-profile');
    Route::get('/siswa', [GuruController::class, 'siswa'])->name('siswa');
    Route::get('/nilai', [GuruController::class, 'nilai'])->name('nilai');
    Route::get('/input-nilai', [GuruController::class, 'inputNilai'])->name('input-nilai');
    Route::post('/input-nilai', [GuruController::class, 'storeNilai'])->name('store-nilai');
    Route::get('/siswa/{id}/detail', [GuruController::class, 'siswaDetail'])->name('siswa.detail');

    // Route untuk CRUD nilai
    Route::get('/nilai/{id}/edit', [GuruController::class, 'editNilai'])->name('nilai.edit');
    Route::put('/nilai/{id}', [GuruController::class, 'updateNilai'])->name('nilai.update');
    Route::delete('/nilai/{id}', [GuruController::class, 'destroyNilai'])->name('nilai.destroy');
});

// Route Siswa
Route::middleware([])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/gallery', [SiswaController::class, 'gallery'])->name('siswa.gallery');
    Route::get('/nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');
});
