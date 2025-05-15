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

            <div class="container-fluid">
            
                <!-- Judul Halaman -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Satuan Obat</h1>
                </div>
            
                <!-- Tombol Tambah -->
                <div class="mb-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahSatuanModal">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            
                <!-- Pesan Sukses -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            
                <!-- Tabel -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Satuan Obat</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($satuan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_satuan }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm btnEditSatuan"
                                                    data-toggle="modal"
                                                    data-target="#editSatuanModal"
                                                    data-id="{{ $item->id_satuan }}"
                                                    data-nama="{{ $item->nama_satuan }}">
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
            
                <!-- Modal Tambah -->
                <div class="modal fade" id="tambahSatuanModal" tabindex="-1" role="dialog" aria-labelledby="tambahSatuanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="{{ route('satuan_obat.store') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahSatuanModalLabel">Tambah Satuan Obat</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="namaSatuanBaru">Nama Satuan</label>
                                        <input type="text" class="form-control" id="namaSatuanBaru" name="nama_satuan" required>
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
            
               <!-- Modal Edit -->
<div class="modal fade" id="editSatuanModal" tabindex="-1" role="dialog" aria-labelledby="editSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEditSatuan" method="POST"> {{-- ACTION akan di-set via JS --}}
            @csrf
            <input type="hidden" name="_method" value="PUT"> {{-- ✅ Gunakan manual untuk jaga-jaga --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSatuanModalLabel">Edit Satuan Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIdSatuan" name="id_satuan">
                    <div class="form-group">
                        <label for="editNamaSatuan">Nama Satuan</label>
                        <input type="text" class="form-control" id="editNamaSatuan" name="nama_satuan" required>
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
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Pakai event delegation agar bisa tetap aktif meski tabel dimuat ulang
                    $(document).on('click', '.btnEditSatuan', function () {
                        const id = $(this).data('id');
                        const nama = $(this).data('nama');
            
                        // Set data ke input dalam modal
                        $('#editIdSatuan').val(id);
                        $('#editNamaSatuan').val(nama);
            
                        // Set form action agar sesuai dengan ID
                        const url = `/satuanobat/${id}`;
                        $('#formEditSatuan').attr('action', url);
            
                        // Debug (boleh dihapus)
                        console.log('Form action updated to:', url);
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
