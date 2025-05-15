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
                    <h1 class="h3 mb-0 text-gray-800">Daftar Alat Kesehatan</h1>
                </div>



<div class="mt-3">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Alat Kesehatan</h6>
                <a href="{{ url('/tambah_alatkesehatan') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>

        <div class="card-body">
             <!-- Search Bar -->
    <form method="GET" action="{{ url()->current() }}" class="mb-3 d-flex justify-content-end" role="search">
        <input type="text" name="search" class="form-control w-auto" placeholder="Cari Nama Obat..." value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary ml-2">
            <i class="fas fa-search"></i>
        </button>
    </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="alatTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Satuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alatKesehatans as $alat)
                        <tr>
                            <!-- Gambar -->
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama }}" class="img-thumbnail" width="50">
                            </td>

                            <!-- Nama -->
                            <td>{{ $alat->nama }}</td>

                            <!-- Jenis -->
                            <td>{{ $alat->jenis }}</td>

                            <!-- Satuan -->
                            <td>{{ $alat->satuan->nama_satuan ?? '-' }}</td>

                            <!-- Status -->
                            <td>
                                @php
                                    $badgeClass = 'badge-secondary';
                                    if ($alat->status == 'Tersedia') $badgeClass = 'badge-success';
                                    elseif ($alat->status == 'Dipakai') $badgeClass = 'badge-warning';
                                    elseif ($alat->status == 'Sekali Pakai') $badgeClass = 'badge-info';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $alat->status }}</span>
                            </td>

                            <!-- Aksi -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- Button Edit -->
                                    <a href="{{ route('alatkesehatan.edit', $alat->id_AlatKesehatan) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>


                                    <!-- Button Ubah Status -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ubahStatusModal{{ $alat->id }}">
                                        <i class="fas fa-exchange-alt"></i> Ubah Status
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Ubah Status -->
                        <div class="modal fade" id="ubahStatusModal{{ $alat->id }}" tabindex="-1" role="dialog" aria-labelledby="ubahStatusModalLabel{{ $alat->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                {{-- <form method="POST" action="{{ route('alatkesehatan.updateStatus', $alat->id) }}"> --}}
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- <h5 class="modal-title" id="ubahStatusModalLabel{{ $alat->id }}">Ubah Status Alat</h5> --}}
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="statusSelect{{ $alat->id }}">Status</label>
                                                <select class="form-control" id="statusSelect{{ $alat->id }}" name="status" required>
                                                    <option value="Tersedia" {{ $alat->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                    <option value="Dipakai" {{ $alat->status == 'Dipakai' ? 'selected' : '' }}>Dipakai</option>
                                                    <option value="Sekali Pakai" {{ $alat->status == 'Sekali Pakai' ? 'selected' : '' }}>Sekali Pakai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Pagination -->
<div class="mt-3 d-flex justify-content-center">
    {{ $alatKesehatans->links() }}
</div>

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
