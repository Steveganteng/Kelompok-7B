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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('../layouts/navigation_apoteker')
        <div class="container">
            <h1>Tambah Produk Kesehatan</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produkkesehatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Gambar --}}
                <div class="form-group">
                    <label for="gambar">Gambar Produk</label>
                    <input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*">
                </div>

                {{-- Nama --}}
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                {{-- Satuan --}}
                <div class="form-group">
                    <label for="satuan_id">Satuan</label>
                    <select name="satuan_id" class="form-control" required>
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($satuans as $s)
                        <option value="{{ $s->id_satuan }}">{{ $s->nama_satuan }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="lokasi_id">Lokasi</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-control" required>
                        @foreach(\App\Models\Lokasi::all() as $lokasi)
                            <option value="{{ $lokasi->id_lokasi }}" {{ old('lokasi_id', $produk->lokasi_id ?? '') == $lokasi->id_lokasi ? 'selected' : '' }}>
                                {{ $lokasi->area }} - Rak {{ $lokasi->rak }}, Baris {{ $lokasi->baris }}, Kolom {{ $lokasi->kolom }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Stok --}}
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" min="0" value="{{ old('stok') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                <a href="{{ route('produkkesehatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
            <!-- End of Topbar -->
            <!-- Main Content -->
            <!-- Page Heading -->
            <div class="container-fluid">

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        $(document).ready(function() {
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
