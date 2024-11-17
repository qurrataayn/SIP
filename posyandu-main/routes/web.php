<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\UserController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::controller(HomePageController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/pencarian', 'pencarian')->name('pencarian');
    Route::get('/pencarian/{slug}', 'detailArtikel')->name('detailArtikel');
});

Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
    Route::get('/', 'index')->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(UserController::class)->prefix('user')->name('user')->group(function () {
    Route::get('/', 'index')->name('');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/update/{id}', 'updateStatus')->name('.updateStatus');
    Route::get('/resetPassword/{id}', 'resetPassword')->name('.resetPassword');
});

Route::controller(KeluargaController::class)->prefix('keluarga')->name('keluarga')->group(function () {
    Route::get('/', 'index')->name('');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
});

Route::controller(PoskoController::class)->prefix('posko')->name('posko')->group(function () {
    Route::get('/', 'index')->name('');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/{id}', 'delete')->name('.delete');
});

Route::controller(AnggotaController::class)->prefix('anggota')->name('anggota')->group(function () {
    Route::get('/index/{id}', 'index')->name('');
    Route::post('/{keluarga}', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/{id}', 'delete')->name('.delete');
});

Route::controller(JadwalController::class)->prefix('jadwal')->name('jadwal')->group(function () {
    Route::get('/', 'index')->name('');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/{id}', 'delete')->name('.delete');
});

Route::controller(PosyanduController::class)->prefix('posyandu')->name('posyandu')->group(function () {
    Route::get('/', 'index')->name('');
    Route::get('/getAnggota', 'getAnggota')->name('get');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/{id}', 'delete')->name('.delete');
    Route::get('/detail/{id}', 'detail')->name('.detail');
});

Route::controller(LaporanController::class)->prefix('laporan')->name('laporan')->group(function () {
    Route::get('/kegiatan', 'kegiatan')->name('.kegiatan');
    Route::post('/kegiatan/cetak', 'cetakKegiatan')->name('.kegiatan.cetak');
    Route::get('/posyandu', 'posyandu')->name('.posyandu');
    Route::get('/posyandu/detail/{id}', 'posyanduDetail')->name('.posyandu.detail');
    Route::post('/posyandu/cetak', 'cetakPosyandu')->name('.posyandu.cetak');
});
Route::controller(SampahController::class)->prefix('sampah')->name('sampah')->group(function () {
    Route::get('/posko', 'posko')->name('.posko');
    Route::get('/posko/restore/{id}', 'poskoRestore')->name('.posko.restore');
    Route::get('/posko/delete/{id}', 'poskoDelete')->name('.posko.delete');
    Route::get('/jadwal', 'jadwal')->name('.jadwal');
    Route::get('/jadwal/restore/{id}', 'jadwalRestore')->name('.jadwal.restore');
    Route::get('/jadwal/delete/{id}', 'jadwalDelete')->name('.jadwal.delete');
    Route::get('/posyandu', 'posyandu')->name('.posyandu');
    Route::get('/posyandu/detail/{id}', 'posyanduDetail')->name('.posyandu.detail');
    Route::get('/posyandu/restore/{id}', 'posyanduRestore')->name('.posyandu.restore');
    Route::get('/posyandu/delete/{id}', 'posyanduDelete')->name('.posyandu.delete');
});

Route::controller(HomeController::class)->name('auth')->prefix('auth')->group(function () {
    Route::get('/edit/Profile', 'editProfile')->name('.edit.profile');
    Route::post('/update/Profile', 'updateProfile')->name('.update.profile');
    Route::get('/edit/Password', 'editPassword')->name('.edit.Password');
    Route::post('/update/Password', 'updatePassword')->name('.update.Password');
});

Route::controller(GrafikController::class)->prefix('grafik')->name('grafik')->group(function () {
    Route::get('/BeratBadan/{id}', 'BeratBadan')->name('.BeratBadan');
    Route::get('/TinggiBadan/{id}', 'TinggiBadan')->name('.TinggiBadan');
    Route::get('/families/{id}/weights',  'getFamilyWeights');
});

Route::controller(KategoriController::class)->prefix('kategori')->name('kategori')->group(function () {
    Route::get('/', 'index')->name('');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/{id}', 'delete')->name('.delete');
});

Route::controller(ArtikelController::class)->prefix('artikel')->name('artikel')->group(function () {
    Route::get('/', 'index')->name('');
    Route::post('/', 'storeAndUpdate')->name('.createOrUpdate');
    Route::get('/{id}', 'delete')->name('.delete');
});
