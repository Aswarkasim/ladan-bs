<?php

use App\Http\Controllers\AdminAkunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBalitaController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminCategoryPostController;
use App\Http\Controllers\AdminCatinController;
use App\Http\Controllers\AdminConfigurationController;
use App\Http\Controllers\AdminDataKeluargaController;
use App\Http\Controllers\AdminDataPendudukController;
use App\Http\Controllers\AdminDesaController;
use App\Http\Controllers\AdminDusunController;
use App\Http\Controllers\AdminIbuHamilController;
use App\Http\Controllers\AdminIndikatorStuntingController;
use App\Http\Controllers\AdminKecamatanController;
use App\Http\Controllers\AdminKeluargaController;
use App\Http\Controllers\AdminLansiaController;
use App\Http\Controllers\AdminMutasiController;
use App\Http\Controllers\AdminPendudukController;
use App\Http\Controllers\AdminPusController;
use App\Http\Controllers\AdminRegionController;
use App\Http\Controllers\AdminRemajaController;
use App\Http\Controllers\AdminRtController;
use App\Http\Controllers\AdminStuntingController;
use App\Http\Controllers\AdminWusController;
use App\Http\Controllers\HomeIkhtisarController;
use App\Http\Controllers\HomeLaporanController;

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

Route::get('/', [HomeController::class, 'index']);



Route::prefix('/admin/auth')->group(function () {
    Route::get('/', [AdminAuthController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::get('/register', [AdminAuthController::class, 'register']);
    Route::post('/doRegister', [AdminAuthController::class, 'doRegsiter']);
    Route::get('/logout', [AdminAuthController::class, 'logout']);
});


Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $data = [
            'content' => 'admin/dashboard/index'
        ];
        return view('admin/layouts/wrapper', $data);
    });

    Route::resource('/user', AdminUserController::class);

    Route::get('/konfigurasi', [AdminConfigurationController::class, 'index']);
    Route::put('/konfigurasi/update', [AdminConfigurationController::class, 'update']);

    Route::resource('/banner', AdminBannerController::class);


    Route::prefix('/posts')->group(function () {
        Route::resource('/post', AdminPostController::class);
        Route::resource('/kategori', AdminCategoryPostController::class);
    });


    Route::prefix('/tahunan')->group(function () {
        Route::resource('/stunting/indikatorstunting', AdminIndikatorStuntingController::class);


        Route::post('/stunting/indikator', [AdminStuntingController::class, 'addIndikator']);
        Route::get('/stunting/export', [AdminStuntingController::class, 'export']);
        Route::resource('/stunting', AdminStuntingController::class);

        Route::get('/remaja/export', [AdminRemajaController::class, 'export']);
        Route::resource('/remaja', AdminRemajaController::class);


        Route::get('/catin/export', [AdminCatinController::class, 'export']);
        Route::resource('/catin', AdminCatinController::class);

        Route::get('/mutasi/export', [AdminMutasiController::class, 'export']);
        Route::resource('/mutasi', AdminMutasiController::class);

        Route::get('/ibuhamil/export', [AdminIbuHamilController::class, 'export']);
        Route::resource('/ibuhamil', AdminIbuHamilController::class);

        Route::get('/balita/export', [AdminBalitaController::class, 'export']);
        Route::resource('/balita', AdminBalitaController::class);

        Route::get('/pus/export', [AdminPusController::class, 'export']);
        Route::resource('/pus', AdminPusController::class);



        Route::get('/wus/export', [AdminWusController::class, 'export']);
        Route::resource('/wus', AdminWusController::class);

        Route::get('/lansia/export', [AdminLansiaController::class, 'export']);
        Route::resource('/lansia', AdminLansiaController::class);

        Route::get('/datapenduduk/export', [AdminDataPendudukController::class, 'export']);
        Route::get('/datapenduduk/bynik', [AdminDataPendudukController::class, 'dataPendudukByNik']);
        Route::resource('/datapenduduk', AdminDataPendudukController::class);

        Route::get('/datakeluarga/export', [AdminDataKeluargaController::class, 'export']);
        Route::resource('/datakeluarga', AdminDataKeluargaController::class);
    });

    Route::prefix('/dp')->group(function () {
        Route::resource('/penduduk', AdminPendudukController::class);
        Route::resource('/keluarga', AdminKeluargaController::class);
    });


    Route::prefix('/wilayah')->group(function () {
        Route::resource('/kecamatan', AdminKecamatanController::class);
        Route::resource('/desa', AdminDesaController::class);
        Route::resource('/dusun', AdminDusunController::class);
        Route::resource('/rt', AdminRtController::class);
    });


    Route::prefix('/akun')->group(function () {
        Route::get('/data', [AdminAkunController::class, 'indexData']);
        Route::put('/data', [AdminAkunController::class, 'simpanData']);
    });
});

Route::prefix('/home')->group(function () {
    Route::get('/tentang', [HomeController::class, 'tentang']);
    Route::get('/laporan', [HomeLaporanController::class, 'index']);
    Route::get('/ikhtisar', [HomeIkhtisarController::class, 'index']);
});



Route::get('/region/get-desa/{id}', [AdminRegionController::class, 'getDesa']);
Route::get('/region/get-dusun/{id}', [AdminRegionController::class, 'getDusun']);
Route::get('/region/get-rt/{id}', [AdminRegionController::class, 'getRt']);
Route::get('/region/get-pasar-by-kecamatan/{id}', [AdminRegionController::class, 'getPasarByKecamatan']);
