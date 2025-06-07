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

    <div id="wrapper">

        @include('../layouts/navigation_apoteker')

        <div class="container-fluid">

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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="alatTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Kode Alat</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Distributor</th>
                                        <th>Status</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alatKesehatans as $alat)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . ($alat->gambar ?? 'default.jpg')) }}" alt="{{ $alat->nama }}" class="img-thumbnail" width="50">
                                        </td>
                                        <td>{{ $alat->kode_alat }}</td>
                                        <td>{{ $alat->nama }}</td>
                                        <td>{{ $alat->jenis }}</td>
                                        <td>{{ $alat->distributor_alat ?? '-' }}</td>
                                        <td>
                                            @php
                                                $badgeClass = 'badge-secondary';
                                                if ($alat->status == 'Available') $badgeClass = 'badge-success';
                                                elseif ($alat->status == 'Unavailable') $badgeClass = 'badge-danger';
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $alat->status }}</span>
                                        </td>
                                        <td>{{ $alat->stok }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('alatkesehatan.edit', $alat->id_AlatKesehatan) }}" class="btn btn-warning btn-sm mb-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#statusModal{{ $alat->id_AlatKesehatan }}">
                                                <i class="fas fa-exchange-alt"></i> Ganti Status
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $alatKesehatans->links() }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Ganti Status --}}
            @foreach($alatKesehatans as $alat)
            <div class="modal fade" id="statusModal{{ $alat->id_AlatKesehatan }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $alat->id_AlatKesehatan }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('alatkesehatan.updateStatus', $alat->id_AlatKesehatan) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statusModalLabel{{ $alat->id_AlatKesehatan }}">Ganti Status Alat: {{ $alat->nama }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="statusSelect{{ $alat->id_AlatKesehatan }}">Pilih Status Baru:</label>
                                <select name="status" id="statusSelect{{ $alat->id_AlatKesehatan }}" class="form-control" required>
                                    <option value="Available" {{ $alat->status == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Unavailable" {{ $alat->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach

        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable without search functionality
            $('#alatTable').DataTable({
                searching: false,  // Disable search functionality
            });
        });
    </script>

</body>

</html>
