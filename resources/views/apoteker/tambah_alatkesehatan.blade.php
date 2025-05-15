<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Apotik Medicoal - Tambah Alat Kesehatan</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.navigation_apoteker')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="container mt-4">
                        <h3>Tambah Alat Kesehatan</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('alatkesehatan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama">Nama Alat</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="jenis">Jenis</label>
                                <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis') }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="deskripsi">Deskripsi (Opsional)</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="gambar">Gambar (Opsional)</label>
                                <input type="file" name="gambar" id="gambar" class="form-control-file">
                            </div>

                            <div class="form-group mb-3">
                                <label for="golongan_id">Golongan</label>
                                <select name="golongan_id" id="golongan_id" class="form-control" required>
                                    <option value="">-- Pilih Golongan --</option>
                                    @foreach(\App\Models\Golongan::all() as $golongan)
                                        <option value="{{ $golongan->id_golongan }}"
                                            {{ old('golongan_id') == $golongan->id_golongan ? 'selected' : '' }}>
                                            {{ $golongan->NamaGolongan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="penanda_id">Penanda</label>
                                <select name="penanda_id" id="penanda_id" class="form-control" required>
                                    <option value="">-- Pilih Penanda --</option>
                                    @foreach(\App\Models\Penanda::all() as $penanda)
                                        <option value="{{ $penanda->id_penanda }}"
                                            {{ old('penanda_id') == $penanda->id_penanda ? 'selected' : '' }}>
                                            {{ $penanda->nama_penanda }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="lokasi_id">Lokasi</label>
                                <select name="lokasi_id" id="lokasi_id" class="form-control" required>
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach(\App\Models\Lokasi::all() as $lokasi)
                                        <option value="{{ $lokasi->id_lokasi }}"
                                            {{ old('lokasi_id') == $lokasi->id_lokasi ? 'selected' : '' }}>
                                            {{ $lokasi->area }} - Rak {{ $lokasi->rak }}, Baris {{ $lokasi->baris }},
                                            Kolom {{ $lokasi->kolom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="satuan_id">Satuan</label>
                                <select name="satuan_id" id="satuan_id" class="form-control" required>
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach(\App\Models\Satuan::all() as $satuan)
                                        <option value="{{ $satuan->id_satuan }}"
                                            {{ old('satuan_id') == $satuan->id_satuan ? 'selected' : '' }}>
                                            {{ $satuan->nama_satuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="Dipakai" {{ old('status') == 'Dipakai' ? 'selected' : '' }}>Dipakai
                                    </option>
                                    <option value="Sekali Pakai" {{ old('status') == 'Sekali Pakai' ? 'selected' : '' }}>
                                        Sekali Pakai</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('alatkesehatan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Apotik Medicoal {{ date('Y') }}</span>
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
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>
