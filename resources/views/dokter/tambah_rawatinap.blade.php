<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Rawat Inap</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <style>
        /* General Stepper Layout */
        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .step {
            width: 25%;
            text-align: center;
            font-size: 0.875rem;
        }

        .step .icon {
            display: inline-block;
            background-color: #ccc;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            line-height: 35px;
            color: white;
            margin-bottom: 8px;
        }

        .step.active .icon {
            background-color: #4e73df;
        }

        .step.completed .icon {
            background-color: #28a745;
        }

        .line {
            height: 2px;
            background: #ccc;
            flex-grow: 1;
            margin: 0 5px;
            align-self: center;
        }

        .progress-bar {
            height: 4px;
            background-color: #4e73df;
            transition: width 0.3s ease;
        }

        .step h5 {
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            font-size: 0.875rem;
            padding: 0.4rem 0.75rem;
        }

        /* Form Input Sizes */
        .form-control {
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            height: auto;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        /* Table styles */
        table {
            width: 100%;
            table-layout: fixed;
            font-size: 0.875rem;
        }

        th, td {
            text-align: center;
            padding: 0.5rem;
        }

        th {
            background-color: #f8f9fc;
        }

        /* Adjust spacing for smaller screen sizes */
        @media (max-width: 768px) {
            .stepper {
                flex-direction: column;
                align-items: center;
            }

            .step {
                width: 100%;
                margin-bottom: 10px;
            }

            .line {
                width: 100%;
                margin-top: 10px;
            }

            .form-control {
                font-size: 0.875rem;
                padding: 0.5rem;
            }

            table {
                font-size: 0.75rem;
            }

            .btn-primary {
                font-size: 0.875rem;
                padding: 0.4rem 0.75rem;
            }
        }

        /* Button styles for action buttons */
        .btn {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .btn-secondary {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-success {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.navigation_dokter')

        <div class="container-fluid mt-4">
            <h1 class="h3 mb-4 text-gray-800">Input Pemeriksaan Pasien</h1>

            <div class="card shadow p-4">
                <form id="rawatinap-form" action="{{ route('rawatinap.store') }}" method="POST">
                    @csrf

                    <!-- Stepper Navigation -->
                    <div class="stepper">
                        <div class="step active" id="step1-nav">
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h5>Data Pasien</h5>
                        </div>
                        <div class="line"></div>
                        <div class="step" id="step2-nav">
                            <div class="icon">
                                <i class="fas fa-notes-medical"></i>
                            </div>
                            <h5>Pemeriksaan</h5>
                        </div>
                        <div class="line"></div>
                        <div class="step" id="step3-nav">
                            <div class="icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h5>Tindakan</h5>
                        </div>
                        <div class="line"></div>
                        <div class="step" id="step4-nav">
                            <div class="icon">
                                <i class="fas fa-pills"></i>
                            </div>
                            <h5>Resep Obat</h5>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress mb-4">
                        <div class="progress-bar" id="progress-bar" style="width: 25%;"></div>
                    </div>

{{-- STEP 1: Data Pasien --}}
<div class="form-step active" id="step1">
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
            <input name="tanggal_lahir" type="date" class="form-control" id="tanggal-lahir" required />
        </div>
        <div class="form-group col-md-6">
            <label>No. Telepon</label>
            <input name="telepon" type="text" class="form-control" id="telepon" required />
        </div>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" rows="2" class="form-control" required></textarea>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" onclick="goToStep(2)">Selanjutnya &rarr;</button>
    </div>
</div>

{{-- STEP 2: Pemeriksaan --}}
<div class="form-step" id="step2">
    <h4 class="mb-4 text-primary">Pemeriksaan Pasien</h4>

    <!-- Grouped Fields for Date, Anamnesis, and Start of Treatment -->
    <div class="form-row mb-3">
        <div class="form-group col-md-6">
            <label>Mulai Dirawat</label>
            <input name="mulai_diwawati" type="datetime-local" class="form-control" required />
        </div>
        <div class="form-group col-md-6">
            <label>Anamnesis</label>
            <textarea name="anamnesis" rows="2" class="form-control"></textarea>
        </div>
    </div>

    <!-- Grouped Fields for Vital Signs (Tinggi, Berat, Suhu, Saturasi) -->
    <div class="form-row mb-3">
        <div class="form-group col-md-3">
            <label>Tinggi (cm)</label>
            <input name="tinggi_badan" type="number" class="form-control" min="0" required />
        </div>
        <div class="form-group col-md-3">
            <label>Berat (kg)</label>
            <input name="berat_badan" type="number" class="form-control" min="0" required />
        </div>
        <div class="form-group col-md-3">
            <label>Suhu (°C)</label>
            <input name="suhu_tubuh" type="number" step="0.1" class="form-control" min="0" required />
        </div>
        <div class="form-group col-md-3">
            <label>Saturasi (%)</label>
            <input name="saturasi_oksigen" type="number" class="form-control" min="0" required />
        </div>
    </div>

    <!-- Grouped Fields for Blood Pressure (Sistolik, Diastolik) and Pulse -->
    <div class="form-row mb-3">
        <div class="form-group col-md-3">
            <label>Sistolik (mmHg)</label>
            <input name="tekanan_darah_sistolik" type="number" class="form-control" min="0" required />
        </div>
        <div class="form-group col-md-3">
            <label>Diastolik (mmHg)</label>
            <input name="tekanan_darah_diastolik" type="number" class="form-control" min="0" required />
        </div>
        <div class="form-group col-md-3">
            <label>Denyut Nadi</label>
            <input name="nadi" type="number" class="form-control" min="0" required />
        </div>
        <div class="form-group col-md-3">
            <label>Laju Pernapasan</label>
            <input name="laju_pernapasan" type="number" class="form-control" min="0" required />
        </div>
    </div>

    <!-- Additional Fields for Examination & Diagnosis -->
    <div class="form-group mb-3">
        <label>Pemeriksaan Penunjang</label>
        <textarea name="pemeriksaan_penunjang" rows="2" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Obat yang Sudah Dikonsumsi</label>
        <textarea name="obat_dikonsumsi_sebelumnya" rows="2" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label>Diagnosa</label>
        <textarea name="diagnosa" rows="2" class="form-control" required></textarea>
    </div>

    <!-- Navigation Buttons with Equal Space Distribution -->
    <div class="d-flex justify-content-between mt-4">
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

        // Step Navigation Logic
        function goToStep(step) {
            [1, 2, 3, 4].forEach(i => {
                document.getElementById('step' + i).style.display = (i === step ? 'block' : 'none');
                document.querySelector(`#step${i}-nav .icon`)
                    .classList.toggle('bg-primary', i === step);
            });

            // Update progress bar width
            document.getElementById('progress-bar').style.width = (step * 25) + '%';
        }

        // Add Tindakan
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

        // Add Obat
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

        // Prevent negative numbers in input fields
        const inputs = document.querySelectorAll('input[type="number"]');
        inputs.forEach(input => {
            input.addEventListener('input', (e) => {
                if (e.target.value < 0) e.target.value = 0;
            });
        });

        // Prevent non-numeric input
        document.getElementById('telepon').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');  // Allow only digits
        });

        // Disable future dates for the birthdate input
        document.getElementById('tanggal-lahir').setAttribute('max', new Date().toISOString().split('T')[0]);

        // Inisialisasi ke step 1
        goToStep(1);
    </script>
</body>

</html>
