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

        @include('../layouts/navigation_dokter')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Rawat Inap</h1>
                    </div>


                  <!-- POTONGAN BAGIAN DALAM BODY YANG SUDAH DIPERBAIKI -->
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Tindakan</h1>
            </div>

            <!-- Row: Form & Tabel -->
            <div class="row">
                <!-- Form Input -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="mb-3">Form Tindakan</h5>
                            <div class="form-group">
                                <label for="tindakan">Nama Tindakan</label>
                                <select id="tindakan" class="form-control">
                                    <option value="">Pilih Tindakan</option>
                                    <option value="Ganti Perban">Ganti Perban</option>
                                    <option value="Pemasangan Infus">Pemasangan Infus</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="alat">Nama Alat Kesehatan</label>
                                <select id="alat" class="form-control">
                                    <option value="">Pilih alat kesehatan</option>
                                    <option value="Abocath 22 G (TERUMO)">Abocath 22 G (TERUMO)</option>
                                    <option value="Stetoskop">Stetoskop</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" id="jumlah" value="1" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea id="keterangan" class="form-control" rows="3"></textarea>
                            </div>

                            <button class="btn btn-success btn-sm" onclick="tambahTindakan()">+ Tambah</button>
                        </div>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="mb-3">Daftar Tindakan</h5>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tindakan</th>
                                        <th>Alat Kesehatan</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelTindakan">
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            Isi tabel tindakan dengan memasukkan data di form sebelah kiri.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Row -->

        </div>
        <!-- /.container-fluid -->
    </div>
</div>
<!-- End of Content Wrapper -->

<!-- Script Tambah -->
<script>
    function tambahTindakan() {
        const tindakan = document.getElementById("tindakan").value;
        const alat = document.getElementById("alat").value;
        const jumlah = document.getElementById("jumlah").value;
        const keterangan = document.getElementById("keterangan").value;

        if (tindakan && alat && jumlah) {
            const tbody = document.getElementById("tabelTindakan");

            // Kosongkan isi awal placeholder
            if (tbody.children.length === 1 && tbody.children[0].children[0].classList.contains('text-muted')) {
                tbody.innerHTML = '';
            }

            const row = `<tr>
                            <td>${tindakan}</td>
                            <td>${alat}</td>
                            <td>${jumlah}</td>
                            <td>${keterangan}</td>
                        </tr>`;
            tbody.insertAdjacentHTML('beforeend', row);

            // Reset input
            document.getElementById("tindakan").value = '';
            document.getElementById("alat").value = '';
            document.getElementById("jumlah").value = 1;
            document.getElementById("keterangan").value = '';
        } else {
            alert("Harap lengkapi semua data terlebih dahulu.");
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
