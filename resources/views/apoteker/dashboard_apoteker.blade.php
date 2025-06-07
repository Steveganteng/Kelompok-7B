<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Apotik Medicoal - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <style>
        .card {
            border-radius: 0.75rem;
            transition: transform 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
        }

        .card .card-body i {
            color: #4e73df;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.navigation_apoteker')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="bg-light">

                <!-- Topbar -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid py-4">

                    <!-- Logo Center -->
                    <div class="text-center mb-5">
                        <img src="{{ asset('img/logo.png') }}" alt="MediCoal" style="width: 120px; filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.15));" />
                    </div>

                    <div class="row">

                        <!-- Resep Obat -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-prescription-bottle-alt fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Resep Obat</h5>
                                    <a href="{{ url('/resepobat') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Data Obat -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-database fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Data Obat</h5>
                                    <a href="{{ url('/dataobat') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Kesehatan -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-medkit fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Produk Kesehatan</h5>
                                    <a href="{{ url('/produkkesehatan') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Alat Kesehatan -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-stethoscope fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Alat Kesehatan</h5>
                                    <a href="{{ url('/alatkesehatan') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Golongan Obat -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-tag fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Golongan Obat</h5>
                                    <a href="{{ url('/golonganobat') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Satuan Obat -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-ruler fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Satuan Obat</h5>
                                    <a href="{{ url('/satuanobat') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Lokasi Obat -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Lokasi Obat</h5>
                                    <a href="{{ url('/lokasiobat') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Penanda Obat -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-flag fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Penanda Obat</h5>
                                    <a href="{{ url('/penandaobat') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Laporan Produk Farmasi -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-medical fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Laporan Produk Farmasi</h5>
                                    <a href="{{ url('/laporanproduk') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Pembelian Produk -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-pills fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Pembelian Produk</h5>
                                    <a href="{{ url('/pengelolaanpembelian') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Peminjaman Produk -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-hand-holding-medical fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Peminjaman Produk</h5>
                                    <a href="{{ url('/pengelolaanpeminjaman') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                        <!-- Adjustment Produk -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-exchange-alt fa-3x mb-3"></i>
                                    <h5 class="card-title font-weight-bold">Adjustment Produk</h5>
                                    <a href="{{ url('/adjustmentproduk') }}" class="btn btn-primary btn-sm mt-3 px-4">Buka</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white shadow-sm">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-gray-600">
                        <span>Copyright &copy; Apotik Medicoal 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

</body>

</html>
