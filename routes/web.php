<?php

use App\Http\Controllers\ApotekerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\GolonganObatController;
use App\Http\Controllers\PenandaObatController;
use App\Http\Controllers\SatuanObatController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\AlatKesehatanController;
use App\Http\Controllers\ProdukKesehatanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ResepController;





use Illuminate\Http\Request;

// ========== AUTH ==========
// Login view
Route::get('/', function () {
    return view('login');
})->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard berdasarkan role
Route::get('/apoteker/dashboard', function () {
    return view('apoteker.dashboard_apoteker');
});

Route::get('/dokter/dashboard', function () {
    return view('dokter.index');
});

Route::get('/superadmin/dashboard', function () {
    return 'Superadmin Dashboard (buat view sesuai kebutuhan)';
});


// ====== Routes untuk Apoteker ======

Route::get('/dataobat', [ObatController::class, 'index'])->name('dataobat');
Route::get('/tambah_dataobat', [ObatController::class, 'create'])->name('tambah_dataobat');
Route::post('/simpan_dataobat', [ObatController::class, 'store'])->name('simpan_dataobat');
Route::get('/edit_dataobat/{id}', [ObatController::class, 'edit'])->name('edit_dataobat');
Route::put('/update_dataobat/{id}', [ObatController::class, 'update'])->name('update_dataobat');

Route::get('/dataobat', [ObatController::class, 'index'])->name('dataobat');
Route::get('/tambah_dataobat', [ObatController::class, 'create'])->name('tambah_dataobat');
Route::post('/simpan_dataobat', [ObatController::class, 'store'])->name('simpan_dataobat');
Route::get('/edit_dataobat/{id}', [ObatController::class, 'edit'])->name('edit_dataobat');
Route::put('/update_dataobat/{id}', [ObatController::class, 'update'])->name('update_dataobat');

Route::get('/alatkesehatan', [AlatKesehatanController::class, 'index'])->name('alatkesehatan.index');
Route::get('/tambah_alatkesehatan', [AlatKesehatanController::class, 'create'])->name('alatkesehatan.create');
Route::post('/tambah_alatkesehatan', [AlatKesehatanController::class, 'store'])->name('alatkesehatan.store');
Route::get('/alatkesehatan', [AlatKesehatanController::class, 'index'])->name('alatkesehatan.index');
Route::get('/alatkesehatan/{id}/edit', [AlatKesehatanController::class, 'edit'])->name('alatkesehatan.edit');
Route::put('/alatkesehatan/{id}', [AlatKesehatanController::class, 'update'])->name('alatkesehatan.update');
Route::post('/alatkesehatan/{id}/update-status', [AlatKesehatanController::class, 'updateStatus'])->name('alatkesehatan.updateStatus');


Route::get('/produkkesehatan', [ProdukKesehatanController::class, 'index'])->name('produkkesehatan.index');
Route::get('/produkkesehatan/create', [ProdukKesehatanController::class, 'create'])->name('produkkesehatan.create');
Route::post('/produkkesehatan', [ProdukKesehatanController::class, 'store'])->name('produkkesehatan.store');
Route::get('/produkkesehatan/{id}/edit', [ProdukKesehatanController::class, 'edit'])->name('produkkesehatan.edit');
Route::put('/produkkesehatan/{id}', [ProdukKesehatanController::class, 'update'])->name('produkkesehatan.update');


Route::view('/dashboard_apoteker', 'apoteker.dashboard_apoteker');
Route::view('/bobotobat', 'apoteker.bobotobat')->name('bobotobat');

Route::view('/golonganobat', 'apoteker.golonganobat');
Route::view('/lokasiobat', 'apoteker.lokasiobat');
Route::view('/penandaobat', 'apoteker.penandaobat');
Route::view('/resepobat', 'apoteker.resepobat');
Route::view('/satuanobat', 'apoteker.satuanobat');
Route::view('/tambah_alatkesehatan', 'apoteker.tambah_alatkesehatan');Route::view('/tambah_produkkesehatan', 'apoteker.tambah_produkkesehatan');

Route::get('/golonganobat', [GolonganObatController::class, 'index'])->name('golongan_obat.index');
Route::get('/golonganobat/create', [GolonganObatController::class, 'create'])->name('golongan_obat.create');
Route::post('/golonganobat', [GolonganObatController::class, 'store'])->name('golongan_obat.store');
Route::get('/golonganobat/{id}/edit', [GolonganObatController::class, 'edit'])->name('golongan_obat.edit');
Route::put('/golonganobat/{id}', [GolonganObatController::class, 'update'])->name('golongan_obat.update');
Route::delete('/golonganobat/{id}', [GolonganObatController::class, 'destroy'])->name('golongan_obat.destroy');

Route::get('/satuanobat', [SatuanObatController::class, 'index'])->name('satuan_obat.index');
Route::post('/satuanobat', [SatuanObatController::class, 'store'])->name('satuan_obat.store');
Route::put('/satuanobat/{id}', [SatuanObatController::class, 'update'])->name('satuan_obat.update');


Route::get('/penandaobat', [PenandaObatController::class, 'index'])->name('penanda_obat.index');
Route::get('/penandaobat/create', [PenandaObatController::class, 'create'])->name('penanda_obat.create');
Route::post('/penandaobat', [PenandaObatController::class, 'store'])->name('penanda_obat.store');
Route::get('/penandaobat/{id}/edit', [PenandaObatController::class, 'edit'])->name('penanda_obat.edit');
Route::put('/penandaobat/{id}', [PenandaObatController::class, 'update'])->name('penanda_obat.update');


Route::get('/lokasiobat', [LokasiController::class, 'index'])->name('lokasi.index');
Route::post('/lokasiobat', [LokasiController::class, 'store'])->name('lokasi.store');
Route::put('/lokasiobat/{id}', [LokasiController::class, 'update'])->name('lokasi.update');

// ====== Routes untuk Dokter ======
Route::view('/kecelakaankerja', 'dokter.kecelakaankerja');
Route::view('/keteranganberobat', 'dokter.keteranganberobat');
Route::view('/narkotikaalkohol', 'dokter.narkotikaalkohol');
Route::view('/pemeriksaankesehatan', 'dokter.pemeriksaankesehatan');
Route::view('/rawatinap', 'dokter.rawatinap');
Route::view('/rawatjalan', 'dokter.rawatjalan');
Route::view('/tambah_kecelakaankerja', 'dokter.tambah_kecelakaankerja');
Route::view('/tambah_keteranganberobat', 'dokter.tambah_keteranganberobat');
Route::view('/tambah_narkotikaalkohol', 'dokter.tambah_narkotikaalkohol');
Route::view('/tambah_pemeriksaankesehatan', 'dokter.tambah_pemeriksaankesehatan');
Route::view('/tambah_rawatinap', 'dokter.tambah_rawatinap');
Route::view('/tambah_rawatjalan', 'dokter.tambah_rawatjalan');

Route::view('/tambah_tindakan', 'dokter.tambah_tindakan');
Route::view('/tambah_resepobat', 'dokter.tambah_resepobat');





Route::get('/tambah_rawatjalan', [PasienController::class, 'showFormTambah'])->name('rawatjalan.form');
Route::post('/tambah_rawatjalan', [PasienController::class, 'storeRawatJalan'])->name('rawatjalan.store');
Route::get('/tambah_resepobat', [ResepController::class, 'showForm'])->name('resep.form');
Route::post('/tambah_resepobat', [ResepController::class, 'storeResep'])->name('resep.store');
