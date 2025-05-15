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
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Resep Obat</h1>
                </div>
                <!-- Tombol Tambah ID Resep Obat -->
                <div class="mb-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputIDModal">
                        <i class="fas fa-plus"></i> Masukkan ID Resep Obat
                    </button>
                </div>
                <!-- Modal Input ID Resep -->
                <div class="modal fade" id="inputIDModal" tabindex="-1" role="dialog" aria-labelledby="inputIDModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content shadow">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold text-primary" id="inputIDModalLabel">Masukkan ID Resep Obat</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="formInputID">
                                    <div class="form-group">
                                        <label for="idResep">ID Resep Obat</label>
                                        <input type="text" class="form-control" id="idResep" placeholder="Masukkan ID Resep">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" form="formInputID" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#formInputID').submit(function(e) {
                            e.preventDefault();
                            var idResep = $('#idResep').val();
                            alert('ID Resep yang dimasukkan: ' + idResep);

                            // TODO: Bisa kirim ke server lewat AJAX, atau redirect, dsb
                            $('#inputIDModal').modal('hide');
                        });
                    });
                </script>



                <!-- Card Daftar Pasien -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Pasien</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Andi Saputra</td>
                                        <td>35</td>
                                        <td>Laki-laki</td>
                                        <td>2025-04-22</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm btnResep" data-nama="Andi Saputra" data-id="RJ24110013" data-tanggal="06/11/2024" data-diagnosa="DA08.0 - Dental caries">
                                                <i class="fas fa-file-prescription"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Tambah pasien lain di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Resep Obat -->
                <div class="modal fade" id="resepModal" tabindex="-1" role="dialog" aria-labelledby="resepModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold text-primary" id="resepModalLabel">Informasi Pasien
                                </h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p><strong>Nama Pasien:</strong> <span id="namaPasien"></span></p>
                                        <p><strong>ID Pemeriksaan:</strong> <span id="idPemeriksaan"></span></p>
                                        <p><strong>Tanggal Pemeriksaan:</strong> <span id="tglPemeriksaan"></span></p>
                                        <p><strong>Alergi:</strong> <span id="alergi">-</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Diagnosa:</strong> <span id="diagnosa"></span></p>
                                    </div>
                                </div>

                                <div class="card shadow mb-3">
                                    <div class="card-header py-2">
                                        <strong>Daftar Resep Obat</strong>
                                    </div>
                                    <div class="card-body">
                                        <p>R/ Cataflam 50 mg Tablet no 10</p>
                                        <p>℞ 2 d.d 1 p.c.</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="Masukkan catatan penyerahan obat"></textarea>
                                    <div class="custom-control custom-checkbox small mt-2">
                                        <input type="checkbox" class="custom-control-input" id="beritahuDokter">
                                        <label class="custom-control-label" for="beritahuDokter">Beritahu Dokter</label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success">Serahkan Obat</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Script untuk Load Data ke Modal -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.btnResep').click(function() {
                            var nama = $(this).data('nama');
                            var id = $(this).data('id');
                            var tanggal = $(this).data('tanggal');
                            var diagnosa = $(this).data('diagnosa');

                            $('#namaPasien').text(nama);
                            $('#idPemeriksaan').text(id);
                            $('#tglPemeriksaan').text(tanggal);
                            $('#diagnosa').text(diagnosa);

                            $('#resepModal').modal('show');
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
