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
use App\Http\Controllers\RawatJalanController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\kecelakaankerjaController;
use App\Http\Controllers\keteranganberobatController;
use App\Http\Controllers\pemeriksaankesehatanController;
use App\Http\Controllers\narkotikaalkoholController;
use App\Http\Controllers\rawatinapController;
use App\Http\Controllers\UserController;




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
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard_admin');
});


// ====== Routes untuk Apoteker ======

Route::get('/dataobat', [ObatController::class, 'index'])->name('dataobat');
Route::get('/tambah_dataobat', [ObatController::class, 'create'])->name('tambah_dataobat');
Route::post('/simpan_dataobat', [ObatController::class, 'store'])->name('simpan_dataobat');
Route::get('/edit_dataobat/{id}', [ObatController::class, 'edit'])->name('edit_dataobat');
Route::put('/update_dataobat/{id}', [ObatController::class, 'update'])->name('update_dataobat');
Route::post('/upload-obat', [ObatController::class, 'uploadFile'])->name('upload.obat');


Route::get('/dataobat', [ObatController::class, 'index'])->name('dataobat');
Route::get('/tambah_dataobat', [ObatController::class, 'create'])->name('tambah_dataobat');
Route::post('/simpan_dataobat', [ObatController::class, 'store'])->name('simpan_dataobat');
Route::get('/edit_dataobat/{id}', [ObatController::class, 'edit'])->name('edit_dataobat');
Route::put('/update_dataobat/{id}', [ObatController::class, 'update'])->name('update_dataobat');

Route::get('/alatkesehatan', [AlatKesehatanController::class, 'index'])->name('alatkesehatan.index');
Route::get('/tambah_alatkesehatan', [AlatKesehatanController::class, 'create'])->name('alatkesehatan.create');
Route::post('/tambah_alatkesehatan', [AlatKesehatanController::class, 'store'])->name('alatkesehatan.store');
Route::get('/alatkesehatan/{id}/edit', [AlatKesehatanController::class, 'edit'])->name('alatkesehatan.edit');
Route::put('/alatkesehatan/{id}', [AlatKesehatanController::class, 'update'])->name('alatkesehatan.update');
Route::post('/alatkesehatan/{id}/update-status', [AlatKesehatanController::class, 'updateStatus'])->name('alatkesehatan.updateStatus');


Route::post('/alatkesehatan/upload-file', [AlatKesehatanController::class, 'uploadFile'])->name('alatkesehatan.uploadFile');




Route::get('/produkkesehatan', [ProdukKesehatanController::class, 'index'])->name('produkkesehatan.index');
Route::get('/produkkesehatan/create', [ProdukKesehatanController::class, 'create'])->name('produkkesehatan.create');
Route::post('/produkkesehatan', [ProdukKesehatanController::class, 'store'])->name('produkkesehatan.store');
Route::get('/produkkesehatan/{id}/edit', [ProdukKesehatanController::class, 'edit'])->name('produkkesehatan.edit');
Route::put('/produkkesehatan/{id}', [ProdukKesehatanController::class, 'update'])->name('produkkesehatan.update');
Route::post('/produkkesehatan/upload-file', [ProdukKesehatanController::class, 'uploadFile'])->name('produkkesehatan.uploadFile');



Route::view('/dashboard_apoteker', 'apoteker.dashboard_apoteker');
Route::view('/bobotobat', 'apoteker.bobotobat')->name('bobotobat');

Route::view('/golonganobat', 'apoteker.golonganobat');
Route::view('/lokasiobat', 'apoteker.lokasiobat');
Route::view('/penandaobat', 'apoteker.penandaobat');
Route::view('/satuanobat', 'apoteker.satuanobat');



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



Route::get('/resepobat', [ResepController::class, 'index'])->name('resep.index');
Route::post('/update-status/{id}', [ResepController::class, 'updateStatus'])->name('updateStatus');
Route::get('/serahkan/{id}', [ResepController::class, 'serahkan'])->name('serahkan');


// ====== Routes untuk Dokter ======
// Kecelakaan Kerja
Route::get('/kecelakaankerja', [KecelakaanKerjaController::class, 'index'])->name('kecelakaankerja.index');
Route::get('/tambah_kecelakaankerja', [KecelakaanKerjaController::class, 'create'])->name('kecelakaankerja.create');
Route::post('/tambah_kecelakaankerja', [KecelakaanKerjaController::class, 'store'])->name('kecelakaankerja.store');

// Keterangan Berobat
Route::get('/keteranganberobat', [KeteranganBerobatController::class, 'index'])->name('keteranganberobat.index');
Route::get('/tambah_keteranganberobat', [KeteranganBerobatController::class, 'create'])->name('keteranganberobat.create');
Route::post('/tambah_keteranganberobat', [KeteranganBerobatController::class, 'store'])->name('keteranganberobat.store');

// Narkotika Alkohol
Route::get('/narkotikaalkohol', [NarkotikaAlkoholController::class, 'index'])->name('narkotikaalkohol.index');
Route::get('/tambah_narkotikaalkohol', [NarkotikaAlkoholController::class, 'create'])->name('narkotikaalkohol.create');
Route::post('/tambah_narkotikaalkohol', [NarkotikaAlkoholController::class, 'store'])->name('narkotikaalkohol.store');

// Pemeriksaan Kesehatan
Route::get('/pemeriksaankesehatan', [PemeriksaanKesehatanController::class, 'index'])->name('pemeriksaankesehatan.index');
Route::get('/tambah_pemeriksaankesehatan', [PemeriksaanKesehatanController::class, 'create'])->name('pemeriksaankesehatan.create');
Route::post('/tambah_pemeriksaankesehatan', [PemeriksaanKesehatanController::class, 'store'])->name('pemeriksaankesehatan.store');

// Rawat Inap
Route::get('/rawatinap', [RawatInapController::class, 'index'])->name('rawatinap.index');
Route::get('/tambah_rawatinap', [RawatInapController::class, 'create'])->name('rawatinap.create');
Route::post('/tambah_rawatinap', [RawatInapController::class, 'store'])->name('rawatinap.store');

Route::view('/tambah_tindakan', 'dokter.tambah_tindakan');
Route::view('/tambah_resepobat', 'dokter.tambah_resepobat');

Route::get('/rawatjalan', [RawatJalanController::class, 'index'])->name('rawatjalan.index');
Route::get('/tambah_rawatjalan', [RawatJalanController::class, 'create'])->name('rawatjalan.create');
Route::post('/tambah_rawatjalan', [RawatJalanController::class, 'store'])->name('rawatjalan.store');



// Route untuk menampilkan form create user
Route::get('/admin/create-user', [UserController::class, 'create'])->name('admin.createUser');
// Route untuk menyimpan user baru
Route::post('/admin/store-user', [UserController::class, 'store'])->name('admin.storeUser');
