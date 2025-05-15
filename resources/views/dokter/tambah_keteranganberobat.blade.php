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
                        <h1 class="h3 mb-0 text-gray-800">Keterangan Berobat</h1>
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
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Mulai Dirawat</label>
                                            <input type="datetime-local" class="form-control mb-3" required>

                                            <label>Anamnesis</label>
                                            <textarea class="form-control mb-3"></textarea>

                                            <div class="form-row">
                                                <div class="col">
                                                    <label>Tinggi Badan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" required>
                                                        <div class="input-group-append"><span class="input-group-text">Cm</span></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label>Berat Badan</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" required>
                                                        <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <label>Suhu Tubuh</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="0.1" class="form-control" required>
                                                <div class="input-group-append"><span class="input-group-text">°C</span></div>
                                            </div>

                                            <label>Saturasi Oksigen</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" required>
                                                <div class="input-group-append"><span class="input-group-text">%</span></div>
                                            </div>

                                            <label>Tekanan Darah</label>
                                            <div class="form-row mb-3">
                                                <div class="col"><input type="number" class="form-control" placeholder="Sistolik" required></div>
                                                <div class="col-auto">/</div>
                                                <div class="col"><input type="number" class="form-control" placeholder="Diastolik" required></div>
                                                <div class="col-auto">mmHg</div>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <label>Denyut Nadi</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" required>
                                                <div class="input-group-append"><span class="input-group-text">x/menit</span></div>
                                            </div>

                                            <label>Laju Pernapasan </label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control" required>
                                                <div class="input-group-append"><span class="input-group-text">x/menit</span></div>
                                            </div>

                                            <label>Pemeriksaan Penunjang</label>
                                            <input type="text" class="form-control mb-3">

                                            <label>Obat yang sudah dikonsumsi sebelumnya</label>
                                            <textarea class="form-control mb-3"></textarea>
                                            <label>Diagnosa </label>
                                            <textarea class="form-control mb-3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-secondary rounded-pill" onclick="goToStep(1)">
                <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
            </button>
                                        <button type="button" class="btn btn-primary rounded-pill" onclick="goToStep(3)">
                Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
            </button>
                                </form>
                                </div>
                            </div>


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



                            <!-- STEP 4: Resep Obat -->
                            <!-- STEP 4 -->
                            <div id="step4" style="display: none;">
                                <div class="row">
                                    <!-- Form Input Obat -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_obat_4">Nama Obat</label>
                                            <select class="form-control" id="nama_obat_4">
            <option>Pilih Obat</option>
            <!-- Tambahkan opsi obat di sini -->
          </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah_obat_4">Jumlah Obat</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="jumlah_obat_4" placeholder="Masukkan jumlah penggunaan">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Satuan</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="aturan_pakai_4">Aturan Pakai</label>
                                            <select class="form-control" id="aturan_pakai_4">
            <option>Pilih aturan pakai</option>
          </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="dosis_4">Dosis</label>
                                            <select class="form-control" id="dosis_4">
            <option>Pilih dosis</option>
          </select>
                                        </div>

                                        <!-- Tombol Tambah Obat -->
                                        <button type="button" class="btn btn-success mt-2" onclick="tambahObatKeTabel()">
          + Tambah Obat ke Resep
        </button>
                                    </div>

                                    <!-- Tabel Data Obat -->
                                    <div class="col-md-6">
                                        <table class="table table-bordered" id="tabel_obat">
                                            <thead>
                                                <tr>
                                                    <th>Nama Obat</th>
                                                    <th>Jumlah</th>
                                                    <th>Aturan Pakai</th>
                                                    <th>Dosis</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabel_obat_body">
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted" id="pesan_kosong">
                                                        Isi tabel tindakan dengan memasukkan data di form sebelah kiri.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- Tombol Cetak Resep -->
                                        <button type="button" class="btn btn-outline-primary" onclick="cetakResep()">
          🖨️ Cetak Resep
        </button>
                                    </div>
                                </div>

                                <!-- Tombol Navigasi -->
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary rounded-pill" onclick="goToStep(3)">
        <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
      </button>
                                    <button type="submit" class="btn btn-success rounded-pill">
        <i class="fas fa-save mr-1"></i> Simpan Data
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
