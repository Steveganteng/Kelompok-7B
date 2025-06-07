<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Apotik Medicoal - Dashboard</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        @include('../layouts/navigation_apoteker')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="bg-light">
                <div class="container-fluid py-4">
                    <h1 class="h3 mb-4 text-gray-800">Daftar Akun Pengguna (Dummy)</h1>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Tanggal Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Dr. Aulia Pratama</td>
                                            <td>aulia.dokter@example.com</td>
                                            <td>Dokter</td>
                                            <td>01 Juni 2025</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Siti Nurhaliza</td>
                                            <td>siti.apoteker@example.com</td>
                                            <td>Apoteker</td>
                                            <td>05 Juni 2025</td>
                                        </tr>
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

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "ordering": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total data)"
                }
            });
        });
    </script>
</body>

</html>
