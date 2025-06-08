<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Apotik Medicoal - Dashboard Admin</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>
<body id="page-top">
    <div id="wrapper">
        @include('layouts.navigation_admin')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="bg-light">
                <div class="container-fluid py-4">
                    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

                    <!-- Dashboard Stats Cards -->
                    <div class="row">
                        <!-- Pasien Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pasien</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pasienCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Obat Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Obat</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $obatCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alat Kesehatan Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Alat Kesehatan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alatKesehatanCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-medkit fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Kesehatan Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Produk Kesehatan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $produkKesehatanCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table for Obat with Stok < 50 and Tanggal Kadaluarsa within 2 months -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Obat with Low Stock and Expiring Soon</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Obat</th>
                                            <th>Nama Dagang</th>
                                            <th>Nama Obat</th>
                                            <th>Stok</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($obats as $obat)
                                            <tr>
                                                <td>{{ $obat->kode_obat }}</td>
                                                <td>{{ $obat->nama_dagang_obat }}</td>
                                                <td>{{ $obat->nama_obat }}</td>
                                                <td>{{ $obat->stok }}</td>
                                                <td>{{ $obat->tgl_kadaluarsa->format('d-m-Y') }}</td>
                                                <td>{{ $obat->deskripsi }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="sticky-footer bg-white shadow-sm">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-gray-600">
                        <span>Copyright &copy; Apotik Medicoal 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
