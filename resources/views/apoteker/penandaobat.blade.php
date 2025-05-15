<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Apotik Medicoal</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        @include('../layouts/navigation_apoteker')

        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Penanda Obat</h1>
            </div>

            

            <div class="card shadow mb-4">

                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penanda Obat</h6>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPenandaModal">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penanda</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penanda as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_penanda }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btnEditPenanda"
                                            data-toggle="modal"
                                            data-target="#editPenandaModal"
                                            data-id="{{ $item->id_penanda }}"
                                            data-nama="{{ $item->nama_penanda }}">
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
                <!-- Pesan Sukses -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            
            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahPenandaModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenandaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('penanda_obat.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahPenandaModalLabel">Tambah Penanda Obat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="namaPenandaBaru">Nama Penanda</label>
                                    <input type="text" class="form-control" id="namaPenandaBaru" name="nama_penanda" required>
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
<div class="modal fade" id="editPenandaModal" tabindex="-1" role="dialog" aria-labelledby="editPenandaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="formEditPenanda" method="POST" action="#"> {{-- akan diubah via JS --}}
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenandaModalLabel">Edit Penanda Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> {{-- Bootstrap 5 --}}
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editIdPenanda" name="id_penanda">
                    <div class="form-group">
                        <label for="editNamaPenanda">Nama Penanda</label>
                        <input type="text" class="form-control" id="editNamaPenanda" name="nama_penanda" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pakai event delegation agar bisa tetap aktif meski modal di-reload
            $(document).on('click', '.btnEditPenanda', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                // Set data ke input modal
                $('#editIdPenanda').val(id);
                $('#editNamaPenanda').val(nama);

                // Set action ke form
                const url = `/penandaobat/${id}`;
                $('#formEditPenanda').attr('action', url);

                // Debug (bisa dihapus)
                console.log('Form action updated to:', url);
            });
        });
    </script>


        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
    </div>

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


    
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>
</html>
