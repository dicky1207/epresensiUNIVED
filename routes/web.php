<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest:pegawai'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

//Reset Password Pegawai
Route::get('send-mail',[AuthController::class,'index']);
Route::get('reset-password', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('reset-password', [AuthController::class, 'sendNewPassword']);

Route::middleware(['auth:pegawai'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //Presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //Edit Profil
    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    //Histori
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //Cuti atau Izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/ajukanizin', [PresensiController::class, 'ajukanizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);
    Route::post('/panel/presensi/cekizincuti', [PresensiController::class, 'cekizincuti']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);
    Route::get('/panel/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);

    //Pegawai
    Route::get('/panel/pegawai', [PegawaiController::class, 'index']);
    Route::post('/panel/pegawai/store', [PegawaiController::class, 'store']);
    Route::post('/panel/pegawai/edit', [PegawaiController::class, 'edit']);
    Route::post('/panel/pegawai/{nik}/update', [PegawaiController::class, 'update']);
    Route::post('/panel/pegawai/{nik}/delete', [PegawaiController::class, 'delete']);

    //Departemen
    Route::get('/panel/departemen', [DepartemenController::class, 'index']);
    Route::post('/panel/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/panel/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/panel/departemen/{kode_dept}/update', [DepartemenController::class, 'update']);
    Route::post('/panel/departemen/{kode_dept}/delete', [DepartemenController::class, 'delete']);

    //Presensi
    Route::get('/panel/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/panel/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::get('/panel/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/panel/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/panel/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/panel/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
    Route::get('/panel/presensi/izincuti', [PresensiController::class, 'izincuti']);
    Route::post('/panel/presensi/approvalizincuti', [PresensiController::class, 'approvalizincuti']);
    Route::get('/panel/presensi/{id}/batalkanizincuti', [PresensiController::class, 'batalkanizincuti']);

    //Konfigurasi Lokasi
    Route::get('/panel/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('/panel/konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);
});
