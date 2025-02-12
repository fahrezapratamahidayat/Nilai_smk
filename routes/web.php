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
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen Guru
    Route::get('/guru', [AdminController::class, 'guruIndex'])->name('guru.index');
    Route::get('/guru/create', [AdminController::class, 'guruCreate'])->name('guru.create');
    Route::post('/guru', [AdminController::class, 'guruStore'])->name('guru.store');
    Route::get('/guru/{id}/edit', [AdminController::class, 'guruEdit'])->name('guru.edit');
    Route::put('/guru/{id}', [AdminController::class, 'guruUpdate'])->name('guru.update');
    Route::delete('/guru/{id}', [AdminController::class, 'guruDestroy'])->name('guru.destroy');

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
});

// Route Wali Kelas
Route::middleware(['auth', 'role:walikelas'])->prefix('walikelas')->group(function () {
    Route::get('/dashboard', [WaliKelasController::class, 'dashboard'])->name('walikelas.dashboard');
    Route::get('/rapot', [WaliKelasController::class, 'rapot'])->name('walikelas.rapot');
    Route::get('/leger', [WaliKelasController::class, 'leger'])->name('walikelas.leger');
});

// Route Guru
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/siswa', [GuruController::class, 'siswa'])->name('guru.siswa');
    Route::get('/nilai', [GuruController::class, 'nilai'])->name('guru.nilai');
});

// Route Siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/gallery', [SiswaController::class, 'gallery'])->name('siswa.gallery');
    Route::get('/nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');
});
