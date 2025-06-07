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
            <!-- End of Topbar -->
            <!-- Main Content -->
            <!-- Begin Page Content -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Lokasi Obat</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Tombol Tambah -->


                <!-- Card Daftar Lokasi Obat -->
                <div class="card shadow mb-4">



                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Lokasi Obat</h6>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahLokasiModal">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Area</th>
                                        <th>Rak</th>
                                        <th>Baris</th>
                                        <th>Kolom</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lokasi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->area }}</td>
                                        <td>{{ $item->rak }}</td>
                                        <td>{{ $item->baris }}</td>
                                        <td>{{ $item->kolom }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm btnEditLokasi"
                                                    data-toggle="modal"
                                                    data-target="#editLokasiModal"
                                                    data-id="{{ $item->id_lokasi }}"
                                                    data-area="{{ $item->area }}"
                                                    data-rak="{{ $item->rak }}"
                                                    data-baris="{{ $item->baris }}"
                                                    data-kolom="{{ $item->kolom }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah Lokasi -->
                <div class="modal fade" id="tambahLokasiModal" tabindex="-1" role="dialog" aria-labelledby="tambahLokasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{ route('lokasi.store') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Lokasi Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Area</label>
                                        <input type="text" name="area" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Rak</label>
                                        <input type="text" name="rak" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Baris</label>
                                        <input type="number" name="baris" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kolom</label>
                                        <input type="number" name="kolom" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Edit Lokasi -->
                <div class="modal fade" id="editLokasiModal" tabindex="-1" role="dialog" aria-labelledby="editLokasiModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="formEditLokasi" method="POST" action="#">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Lokasi Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="editIdLokasi">
                                    <div class="form-group">
                                        <label>Area</label>
                                        <input type="text" name="area" id="editArea" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Rak</label>
                                        <input type="text" name="rak" id="editRak" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Baris</label>
                                        <input type="number" name="baris" id="editBaris" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kolom</label>
                                        <input type="number" name="kolom" id="editKolom" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Page Content -->

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Pakai event delegation agar tetap bekerja meskipun DOM berubah
                    $(document).on('click', '.btnEditLokasi', function () {
                        const id = $(this).data('id');
                        const area = $(this).data('area');
                        const rak = $(this).data('rak');
                        const baris = $(this).data('baris');
                        const kolom = $(this).data('kolom');

                        // Set data ke input form edit
                        $('#editIdLokasi').val(id);
                        $('#editArea').val(area);
                        $('#editRak').val(rak);
                        $('#editBaris').val(baris);
                        $('#editKolom').val(kolom);

                        // Set action ke form edit agar pakai PUT ke /lokasiobat/{id}
                        const url = `/lokasiobat/${id}`;
                        $('#formEditLokasi').attr('action', url);

                        // Debug (opsional)
                        console.log('Edit Lokasi -> form action set to:', url);
                    });
                });
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
