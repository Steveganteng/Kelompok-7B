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
                        <h1 class="h3 mb-0 text-gray-800">Pemeriksaan Kecelakaan Kerja</h1>
                    </div>


                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Input Pemeriksaan Pasien</h1>
                        </div>

                        <div class="card shadow mb-4 p-4">
                            <!-- Stepper Navigation -->
                            <div class="mb-4 d-flex justify-content-between align-items-center text-center">
                                <div class="step" id="step1-nav">
                                    <div class="icon bg-primary text-white rounded-circle mb-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <small class="font-weight-bold"><br>Data Pasien</small>
                                </div>
                                <div class="line flex-grow-1 mx-2"></div>
                                <div class="step" id="step2-nav">
                                    <div class="icon bg-secondary text-white rounded-circle mb-2">
                                        <i class="fas fa-notes-medical"></i>
                                    </div>
                                    <small>Pemeriksaan</small>
                                </div>
                                <div class="line flex-grow-1 mx-2"></div>
                                <div class="step" id="step3-nav">
                                    <div class="icon bg-secondary text-white rounded-circle mb-2">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <small><br>Tindakan</small>
                                </div>
                                <div class="line flex-grow-1 mx-2"></div>
                                <div class="step" id="step4-nav">
                                    <div class="icon bg-secondary text-white rounded-circle mb-2">
                                        <i class="fas fa-pills"></i>
                                    </div>
                                    <small><br>Resep Obat</small>
                                </div>
                            </div>

                            <!-- STEP 1: Data Diri Pasien -->
                            <div id="step1" class="container mt-4">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nama Pasien</label>
                                            <input type="text" class="form-control mb-3" required>

                                            <label>Jenis Kelamin</label>
                                            <select class="form-control mb-3" required>
                                                <option value="">Pilih</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>

                                            <label>Tempat Lahir</label>
                                            <input type="text" class="form-control mb-3" required>

                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control mb-3" required>

                                            <label>Alamat</label>
                                            <textarea class="form-control mb-3" required></textarea>

                                            <label>No. Telepon</label>
                                            <input type="text" class="form-control mb-3" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>ID Pemeriksaan</label>
                                            <select class="form-control mb-3" required>
                                                <option value="">Pilih</option>
                                                <option value="rawatinap">Rawat Inap</option>
                                                <option value="rawatjalan">Rawat Jalan</option>
                                            </select>

                                            <label>Tanggal Kejadian</label>
                                            <input type="date" class="form-control mb-3" required>
                                        </div>
                                    </div>

                                    <div class="text-right mt-4">
                                        <button type="button" class="btn btn-primary rounded-pill" onclick="goToStep(2)">
                                            Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- STEP 2: Pemeriksaan -->
                            <div id="step2" style="display: none;">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Upload Hasil Pemeriksaan</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" method="POST" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <label for="namaPemeriksaan">Nama Pemeriksaan</label>
                                                <input type="text" class="form-control" id="namaPemeriksaan" name="namaPemeriksaan" placeholder="Masukkan nama pemeriksaan">
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggalPemeriksaan">Tanggal Pemeriksaan</label>
                                                <input type="date" class="form-control" id="tanggalPemeriksaan" name="tanggalPemeriksaan">
                                            </div>

                                            <div class="form-group">
                                                <label for="fileHasil">Upload File Hasil</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileHasil" name="fileHasil" required>
                                                    <label class="custom-file-label" for="fileHasil">Pilih
                                                        file...</label>
                                                </div>
                                                <small class="form-text text-muted">File dapat berupa PDF, JPG, PNG,
                                                    dll.</small>
                                            </div>

                                            <button type="submit" class="btn btn-primary mt-3">
                                                <i class="fas fa-upload"></i> Upload
                                            </button>
                                            <!-- Tombol Navigasi -->
                                            <div class="d-flex justify-content-between mt-4">
                                                <button class="btn btn-secondary rounded-pill" onclick="goToStep(1)">
                                                    <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                                                </button>
                                                <button class="btn btn-primary rounded-pill" onclick="goToStep(3)">
                                                    Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Tambahkan Script supaya nama file tampil otomatis -->
                        <script>
                            $(document).ready(function() {
                                $('.custom-file-input').on('change', function() {
                                    let fileName = $(this).val().split('\\').pop();
                                    $(this).next('.custom-file-label').addClass("selected").html(
                                        fileName);
                                });
                            });
                        </script>



                        <!-- STEP 3: Tindakan -->
                        <div id="step3" style="display: none;">
                            <h4 class="mb-4">Tindakan</h4>
                            <div class="row">
                                <!-- Form Input -->
                                <div class="col-md-6">
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

                                <!-- Tabel -->
                                <div class="col-md-6">
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

                            <!-- Tombol Navigasi -->
                            <div class="d-flex justify-content-between mt-4">
                                <button class="btn btn-secondary rounded-pill" onclick="goToStep(2)">
                                    <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                                </button>
                                <button class="btn btn-primary rounded-pill" onclick="goToStep(4)">
                                    Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                            </div>
                        </div>

                        <!-- CSS stepper -->
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
                                font-size: 18px;
                            }

                            .line {
                                height: 2px;
                                background-color: #ccc;
                            }

                            .step .icon.bg-primary {
                                background-color: #4e73df !important;
                            }
                        </style>

                        <!-- JS step navigation -->
                        <script>
                            function goToStep(step) {
                                const totalSteps = 5;
                                for (let i = 1; i <= totalSteps; i++) {
                                    const section = document.getElementById('step' + i);
                                    if (section) {
                                        section.style.display = (i === step) ? 'block' : 'none';
                                    }

                                    // Ganti warna ikon di stepper
                                    const navIcon = document.querySelector(`#step${i}-nav .icon`);
                                    if (navIcon) {
                                        navIcon.classList.toggle('bg-primary', i === step);
                                        navIcon.classList.toggle('bg-secondary', i !== step);
                                    }
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
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                            </div>
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
