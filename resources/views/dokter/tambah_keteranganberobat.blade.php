<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah keterangan berobat</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <style>
        .step {
            width: 100px;
            text-align: center;
        }

        .icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .line {
            height: 2px;
            background: #ccc;
            flex-grow: 1;
            margin: 0 8px;
        }

        .step .icon.bg-primary {
            background-color: #4e73df !important;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.navigation_dokter')

        <div class="container-fluid mt-4">
            <h1 class="h3 mb-4 text-gray-800">Input Pemeriksaan Pasien</h1>
            <div class="card shadow p-4">
                <form id="keteranganberobat-form" action="{{ route('keteranganberobat.store') }}" method="POST">
                    @csrf

                    <!-- Stepper Navigation -->
                    <div class="d-flex text-center mb-4">
                        @foreach([1=>'user',2=>'notes-medical',3=>'heartbeat',4=>'pills'] as $i=>$icon)
                            <div class="step" id="step{{ $i }}-nav">
                                <div class="icon bg-secondary text-white rounded-circle mb-2">
                                    <i class="fas fa-{{ $icon }}"></i>
                                </div>
                                <small>
                                    @switch($i)
                                        @case(1) Data Pasien @break
                                        @case(2) Pemeriksaan @break
                                        @case(3) Tindakan @break
                                        @case(4) Resep Obat @break
                                    @endswitch
                                </small>
                            </div>
                            @if($i < 4)
                                <div class="line"></div>
                            @endif
                        @endforeach
                    </div>

                    {{-- STEP 1: Data Pasien --}}
                    <div id="step1">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input name="nama_pasien" type="text" class="form-control" required />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tempat Lahir</label>
                                <input name="tempat_lahir" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Tanggal Lahir</label>
                                <input name="tanggal_lahir" type="date" class="form-control" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. Telepon</label>
                                <input name="telepon" type="text" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="2" class="form-control" required></textarea>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" onclick="goToStep(2)">Selanjutnya &rarr;</button>
                        </div>
                    </div>

                    {{-- STEP 2: Pemeriksaan --}}
                    <div id="step2" style="display:none">
                        <div class="form-group">
                            <label>Mulai Dirawat</label>
                            <input name="mulai_diwawati" type="datetime-local" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label>Anamnesis</label>
                            <textarea name="anamnesis" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Tinggi (cm)</label>
                                <input name="tinggi_badan" type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Berat (kg)</label>
                                <input name="berat_badan" type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Suhu (°C)</label>
                                <input name="suhu_tubuh" type="number" step="0.1" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Saturasi (%)</label>
                                <input name="saturasi_oksigen" type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Sistolik (mmHg)</label>
                                <input name="tekanan_darah_sistolik" type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-md-4">
                                <label>Diastolik (mmHg)</label>
                                <input name="tekanan_darah_diastolik" type="number" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Denyut Nadi</label>
                                <input name="nadi" type="number" class="form-control" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Laju Pernapasan</label>
                                <input name="laju_pernapasan" type="number" class="form-control" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pemeriksaan Penunjang</label>
                            <textarea name="pemeriksaan_penunjang" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Obat Sebelumnya</label>
                            <textarea name="obat_dikonsumsi_sebelumnya" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <textarea name="diagnosa" rows="2" class="form-control" required></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" onclick="goToStep(1)">&larr; Sebelumnya</button>
                            <button type="button" class="btn btn-primary" onclick="goToStep(3)">Selanjutnya &rarr;</button>
                        </div>
                    </div>

       {{-- STEP 3: Tindakan Kesehatan --}}
<div class="form-step" id="step3">
    <h4 class="mb-3">Tindakan Kesehatan</h4>
    <div class="d-flex justify-content-between">
        <!-- Form Row for Tindakan -->
        <div class="form-row" style="width: 45%; margin-right: 10px;">
            <div class="form-group col-md-12">
                <label>Nama Tindakan</label>
                <input id="nama_tindakan" type="text" class="form-control" placeholder="Masukkan nama tindakan" />
            </div>
            <div class="form-group col-md-12">
                <label>Nama Alat</label>
                <select id="nama_alat" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($alatKesehatan as $alat)
                        <option value="{{ $alat->id_AlatKesehatan }}">{{ $alat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Jumlah</label>
                <input id="jumlah_tindakan" type="number" class="form-control" value="1" min="1" />
            </div>
            <div class="form-group col-md-6">
                <label>&nbsp;</label><br />
                <button type="button" class="btn btn-success btn-block" onclick="tambahTindakan()">+ Tambah</button>
            </div>
        </div>

        <!-- Table for Displaying Added Tindakan -->
        <div class="table-container" style="width: 50%;">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th>Tindakan</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelTindakan">
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" name="tindakan_data" id="tindakan_data" value="" />

    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" onclick="goToStep(2)">&larr; Sebelumnya</button>
        <button type="button" class="btn btn-primary" onclick="goToStep(4)">Selanjutnya &rarr;</button>
    </div>
</div>


                    {{-- STEP 4: Resep Obat --}}
                    <div class="form-step" id="step4">
    <h4 class="mb-3">Resep Obat</h4>
    <div class="d-flex justify-content-between">
        <!-- Form Row for Resep Obat -->
        <div class="form-row" style="width: 45%; margin-right: 10px;">
            <div class="form-group col-md-12">
                <label>Nama Obat</label>
                <select id="nama_dagang_obat" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($obats as $o)
                        <option value="{{ $o->id_obat }}">{{ $o->nama_dagang_obat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Jumlah</label>
                <input id="jumlah_obat" type="number" class="form-control" value="1" min="1" />
            </div>
            <div class="form-group col-md-6">
                <label>Aturan Pakai</label>
                <input type="text" id="aturan_pakai" name="aturan_pakai" class="form-control" placeholder="Contoh: 3× sehari" />
            </div>
            <div class="form-group col-md-6">
                <label>Dosis</label>
                <input type="text" id="dosis_obat" name="dosis_obat" class="form-control" placeholder="Contoh: 1 tablet" />
            </div>
            <div class="form-group col-md-6">
                <label>&nbsp;</label><br />
                <button type="button" class="btn btn-success btn-block" onclick="tambahObat()">+ Tambah</button>
            </div>
        </div>

        <!-- Table for Displaying Added Obat -->
        <div class="table-container" style="width: 50%;">
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Aturan Pakai</th>
                        <th>Dosis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelObat">
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <input type="hidden" name="resep_data" id="resep_data" value="" />

    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" onclick="goToStep(3)">&larr; Sebelumnya</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>
    </div>
</div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        let alatKesehatan = [];
        let resepList = [];

        // Navigasi step
        function goToStep(step) {
            [1, 2, 3, 4].forEach(i => {
                document.getElementById('step' + i).style.display = (i === step ? 'block' : 'none');
                document.querySelector(`#step${i}-nav .icon`)
                    .classList.toggle('bg-primary', i === step);
            });
        }

        // Tambah Tindakan (step 3)
        function tambahTindakan() {
            const nama_tindakan = document.getElementById('nama_tindakan').value.trim();
            const alat_id = document.getElementById('nama_alat').value;
            const jumlah = parseInt(document.getElementById('jumlah_tindakan').value);
            const keterangan = prompt('Keterangan (opsional):', '') || '';

            if (!nama_tindakan || !alat_id || !jumlah || jumlah < 1) {
                alert('Lengkapi data tindakan dengan benar!');
                return;
            }

            alatKesehatan.push({
                nama_tindakan,
                alat_id,
                jumlah,
                keterangan
            });

            renderTindakan();

            // Reset input
            document.getElementById('nama_tindakan').value = '';
            document.getElementById('nama_alat').value = '';
            document.getElementById('jumlah_tindakan').value = 1;
        }

        function renderTindakan() {
            const tbody = document.getElementById('tabelTindakan');
            tbody.innerHTML = '';

            if (alatKesehatan.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">Belum ada.</td></tr>`;
                document.getElementById('tindakan_data').value = '';
                return;
            }

            alatKesehatan.forEach((t, idx) => {
                let namaAlat = '';
                const option = document.querySelector(`#nama_alat option[value="${t.alat_id}"]`);
                if (option) namaAlat = option.textContent;

                tbody.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td>${t.nama_tindakan}</td>
                        <td>${namaAlat}</td>
                        <td>${t.jumlah}</td>
                        <td>${t.keterangan}</td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusTindakan(${idx})">Hapus</button></td>
                    </tr>
                `);
            });

            document.getElementById('tindakan_data').value = JSON.stringify(alatKesehatan);
        }

        function hapusTindakan(index) {
            alatKesehatan.splice(index, 1);
            renderTindakan();
        }

        // Tambah Obat (step 4)
        function tambahObat() {
            const obat_id = document.getElementById('nama_dagang_obat').value;
            const nama_dagang_obat = document.getElementById('nama_dagang_obat').selectedOptions[0]?.text || '';
            const jumlah = parseInt(document.getElementById('jumlah_obat').value);
            const aturan_pakai = document.getElementById('aturan_pakai').value.trim();
            const dosis = document.getElementById('dosis_obat').value.trim();

            if (!obat_id || !aturan_pakai || !dosis || !jumlah || jumlah < 1) {
                alert('Lengkapi data resep dengan benar!');
                return;
            }

            resepList.push({
                obat_id,
                nama_dagang_obat,
                jumlah,
                aturan_pakai,
                dosis
            });

            renderObat();

            // Reset input
            document.getElementById('nama_dagang_obat').value = '';
            document.getElementById('jumlah_obat').value = 1;
            document.getElementById('aturan_pakai').value = '';
            document.getElementById('dosis_obat').value = '';
        }

        function renderObat() {
            const tbody = document.getElementById('tabelObat');
            tbody.innerHTML = '';

            if (resepList.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">Belum ada.</td></tr>`;
                document.getElementById('resep_data').value = '';
                return;
            }

            resepList.forEach((r, idx) => {
                tbody.insertAdjacentHTML('beforeend', `
                    <tr>
                        <td>${r.nama_dagang_obat}</td>
                        <td>${r.jumlah}</td>
                        <td>${r.aturan_pakai}</td>
                        <td>${r.dosis}</td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusObat(${idx})">Hapus</button></td>
                    </tr>
                `);
            });

            document.getElementById('resep_data').value = JSON.stringify(resepList);
        }

        function hapusObat(index) {
            resepList.splice(index, 1);
            renderObat();
        }

        // Sebelum submit, pastikan JSON tersimpan
        document.getElementById('keteranganberobat-form').addEventListener('submit', () => {
            document.getElementById('tindakan_data').value = JSON.stringify(alatKesehatan);
            document.getElementById('resep_data').value = JSON.stringify(resepList);
        });

        // Inisialisasi ke step 1
        goToStep(1);
    </script>
</body>

</html>
