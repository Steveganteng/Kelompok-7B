<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apotik Medicoal</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('../layouts/navigation_apoteker')


        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tambah Data Obat</h1>
            </div>

            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="manual-tab" data-toggle="tab" href="#manual" role="tab"
                        aria-controls="manual" aria-selected="true">
                        <i class="fas fa-pencil-alt"></i> Input Manual
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="file-tab" data-toggle="tab" href="#file" role="tab" aria-controls="file"
                        aria-selected="false">
                        <i class="fas fa-file-upload"></i> Upload File
                    </a>
                </li>
            </ul>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">

                        <!-- Tab 1: Input Manual -->
                        <div class="tab-pane fade show active" id="manual" role="tabpanel" aria-labelledby="manual-tab">
                            <form action="{{ route('simpan_dataobat') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Upload Gambar dengan Tombol -->
<div class="form-group text-center">
    <!-- Preview Gambar -->
    <img
        id="previewGambar"
        src="https://via.placeholder.com/150"
        alt="Preview Gambar Obat"
        class="img-fluid img-thumbnail mb-3"
        style="max-width: 200px; max-height: 200px; object-fit: cover;"
    >

    <!-- Tombol Upload -->
    <div>
        <input type="file" name="gambar" id="uploadGambar" accept="image/*" class="d-none" onchange="loadPreview(this)">
        <button type="button" class="btn btn-secondary" onclick="document.getElementById('uploadGambar').click();">
            <i class="fas fa-upload"></i> Pilih Gambar
        </button>
    </div>
    <small class="form-text text-muted mt-2">Maksimal ukuran file 2MB. Format: JPG, JPEG, PNG</small>
</div>


                                <!-- Nama Obat -->
                                <div class="form-group">
                                    <label>Nama Obat</label>
                                    <input type="text" name="NamaObat" class="form-control"
                                        placeholder="Contoh: Paracetamol" required>
                                </div>

                                <!-- Golongan -->
                                <div class="form-group">
                                    <label>Golongan</label>
                                    <select name="golongan_id" class="form-control" required>
                                        <option value="">-- Pilih Golongan --</option>
                                        @foreach ($golongans as $g)
                                        <option value="{{ $g->id_golongan }}">{{ $g->NamaGolongan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Satuan -->
                                <div class="form-group">
                                    <label>Satuan Kemasan</label>
                                    <select name="satuan_id" class="form-control" required>
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach ($satuans as $s)
                                        <option value="{{ $s->id_satuan }}">{{ $s->nama_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Isi Kemasan dan Bobot -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Isi per Kemasan</label>
                                        <input type="text" name="isi_kemasan" class="form-control"
                                            placeholder="Contoh: 10 Tablet" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Bobot Isi</label>
                                        <input type="text" name="bobot_isi" class="form-control"
                                            placeholder="Contoh: 500mg" required>
                                    </div>
                                </div>

                                <!-- Harga dan Stok -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control"
                                            placeholder="Contoh: 2500" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Stok</label>
                                        <input type="number" name="stok" class="form-control" placeholder="Contoh: 100"
                                            required>
                                    </div>
                                </div>

                                <!-- Penanda -->
                                <div class="form-group">
                                    <label>Penanda</label>
                                    <select name="penanda_id" class="form-control" required>
                                        <option value="">-- Pilih Penanda --</option>
                                        @foreach ($penandas as $p)
                                        <option value="{{ $p->id_penanda }}">{{ $p->nama_penanda }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <h5 class="mt-4 mb-3">Lokasi Penyimpanan</h5>

                                <div class="form-group">
                                    <label>Area</label>
                                    <select name="area" class="form-control" required>
                                        <option value="">-- Pilih Area --</option>
                                        @foreach ($lokasis->pluck('area')->unique() as $area)
                                            <option value="{{ $area }}">{{ $area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Rak</label>
                                        <select name="rak" class="form-control" required>
                                            <option value="">-- Pilih Rak --</option>
                                            @foreach ($lokasis->pluck('rak')->unique() as $rak)
                                                <option value="{{ $rak }}">{{ $rak }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <div class="form-group col-md-4">
                                        <label>Baris</label>
                                        <select name="baris" class="form-control" required>
                                            <option value="">-- Pilih Baris --</option>
                                            @foreach ($lokasis->pluck('baris')->unique() as $baris)
                                                <option value="{{ $baris }}">{{ $baris }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <div class="form-group col-md-4">
                                        <label>Kolom</label>
                                        <select name="kolom" class="form-control" required>
                                            <option value="">-- Pilih Kolom --</option>
                                            @foreach ($lokasis->pluck('kolom')->unique() as $kolom)
                                                <option value="{{ $kolom }}">{{ $kolom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label>Deskripsi Lokasi (Opsional)</label>
                                    <textarea name="deskripsi" class="form-control" rows="2"
                                        placeholder="Keterangan tambahan lokasi..."></textarea>
                                </div>


                                <button type="submit" class="btn btn-primary btn-block mt-4">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </form>
                        </div>

                        <!-- Tab 2: Upload File -->
                        <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
                            <form>
                                <div class="form-group">
                                    <label>Upload File (CSV/XLSX)</label>
                                    <input type="file" class="form-control-file" accept=".csv, .xlsx" required>
                                    <small class="form-text text-muted">Pastikan file sesuai format template.</small>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mt-4">
                                    <i class="fas fa-upload"></i> Upload File
                                </button>
                            </form>
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
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>




        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

    </script>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>
