<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Alat Kesehatan</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        @include('../layouts/navigation_apoteker')

        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Alat Kesehatan</h1>
            </div>

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="true">Form</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file" aria-selected="false">Upload File</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- Tab 1: Form -->
                <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="{{ route('alatkesehatan.store') }}" enctype="multipart/form-data">
                                @csrf

                                <!-- Nama Alat -->
                                <div class="form-group">
                                    <label for="nama_alat">Nama Alat</label>
                                    <input type="text" name="nama_alat" id="nama_alat" class="form-control" required>
                                </div>

                                <!-- Kode Alat -->
                                <div class="form-group">
                                    <label for="kode_alat">Kode Alat</label>
                                    <input type="text" name="kode_alat" id="kode_alat" class="form-control" required>
                                </div>

                                <!-- Distributor Alat -->
                                <div class="form-group">
                                    <label for="distributor_alat">Distributor Alat</label>
                                    <input type="text" name="distributor_alat" id="distributor_alat" class="form-control">
                                </div>

                                <!-- Stok -->
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control" required>
                                </div>


                                <!-- Lokasi -->
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <div class="form-row">
                                        <!-- Area -->
                                        <div class="col">
                                            <select name="area" class="form-control" required>
                                                <option value="">-- Pilih Area --</option>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->area }}" {{ old('area') == $area->area ? 'selected' : '' }}>
                                                        {{ $area->area }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Rak -->
                                        <div class="col">
                                            <select name="rak" class="form-control" required>
                                                <option value="">-- Pilih Rak --</option>
                                                @foreach($raks as $rak)
                                                    <option value="{{ $rak->rak }}" {{ old('rak') == $rak->rak ? 'selected' : '' }}>
                                                        {{ $rak->rak }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Baris -->
                                        <div class="col">
                                            <select name="baris" class="form-control" required>
                                                <option value="">-- Pilih Baris --</option>
                                                @foreach($bariss as $baris)
                                                    <option value="{{ $baris->baris }}" {{ old('baris') == $baris->baris ? 'selected' : '' }}>
                                                        {{ $baris->baris }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Kolom -->
                                        <div class="col">
                                            <select name="kolom" class="form-control" required>
                                                <option value="">-- Pilih Kolom --</option>
                                                @foreach($koloms as $kolom)
                                                    <option value="{{ $kolom->kolom }}" {{ old('kolom') == $kolom->kolom ? 'selected' : '' }}>
                                                        {{ $kolom->kolom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                                <!-- Gambar -->
                                <div class="form-group text-center">
                                    <label for="gambar">
                                        <img id="previewGambar" src="https://via.placeholder.com/150" class="img-thumbnail mb-3" style="cursor:pointer;" alt="Upload Gambar">
                                    </label>
                                    <input type="file" name="gambar" id="gambar" class="d-none" accept="image/*" onchange="loadPreview(this)">
                                    <small class="form-text text-muted">Klik gambar untuk upload foto alat</small>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-4">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                 <!-- Tab 2: Upload File -->
<!-- Tab 2: Upload File -->
<div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
    <form action="{{ route('produkkesehatan.uploadFile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Upload File (CSV/XLSX)</label>
            <input type="file" name="file" class="form-control-file" accept=".csv, .xlsx" required>
            <small class="form-text text-muted">Pastikan file sesuai format template.</small>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-4">
            <i class="fas fa-upload"></i> Upload File
        </button>
    </form>

    <!-- Button to Download Template -->
    <div class="mt-4">
        <a href="https://docs.google.com/spreadsheets/d/1-PXZPmnL8ZPtrdSIT5SIb0rPqe8JYfyZ/edit?gid=2006717613"
           target="_blank" class="btn btn-success btn-block">
            <i class="fas fa-download"></i> Download Template
        </a>
    </div>
</div>
            </div>
        </div>
    </div>

    <script>
        function loadPreview(input) {
            const preview = document.getElementById('previewGambar');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
