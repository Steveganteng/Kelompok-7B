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
        @include('../layouts/navigation_admin')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" class="bg-light">
                <div class="container-fluid py-4">
                    <h1 class="h3 mb-4 text-gray-800"></h1>

                    <!-- Daftar User -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="mb-3 font-weight-bold">Daftar Akun Pengguna</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
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
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>John Doe</td>
                                            <td>johndoe@example.com</td>
                                            <td>Admin</td>
                                            <td>10 Mei 2025</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Jane Smith</td>
                                            <td>janesmith@example.com</td>
                                            <td>Dokter</td>
                                            <td>15 April 2025</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Mark Johnson</td>
                                            <td>mark.johnson@example.com</td>
                                            <td>Apoteker</td>
                                            <td>20 Maret 2025</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Obat yang Kadaluarsa -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="mb-3 font-weight-bold">Daftar Obat yang Kadaluarsa</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Jumlah Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Paracetamol</td>
                                            <td>01 Juli 2025</td>
                                            <td>100</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Amoxicillin</td>
                                            <td>15 Juni 2025</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Ibuprofen</td>
                                            <td>20 Juni 2025</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Fluoxetine</td>
                                            <td>10 Juli 2025</td>
                                            <td>80</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Metformin</td>
                                            <td>25 Juni 2025</td>
                                            <td>200</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Obat yang Habis Stok -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="mb-3 font-weight-bold">Daftar Obat yang Habis Stok</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Jumlah Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Ibuprofen</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Paracetamol</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Amoxicillin</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Omeprazole</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Diazepam</td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Resep -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="mb-3 font-weight-bold">Daftar Resep</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>Nama Obat</th>
                                            <th>Tanggal Resep</th>
                                            <th>Jumlah</th>
                                            <th>Aturan Pakai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Dr. Aulia Pratama</td>
                                            <td>Paracetamol</td>
                                            <td>01 Juni 2025</td>
                                            <td>2</td>
                                            <td>3x sehari</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Siti Nurhaliza</td>
                                            <td>Amoxicillin</td>
                                            <td>05 Juni 2025</td>
                                            <td>1</td>
                                            <td>2x sehari</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>John Doe</td>
                                            <td>Ibuprofen</td>
                                            <td>10 Mei 2025</td>
                                            <td>3</td>
                                            <td>1x sehari</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Jane Smith</td>
                                            <td>Paracetamol</td>
                                            <td>15 April 2025</td>
                                            <td>1</td>
                                            <td>3x sehari</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Mark Johnson</td>
                                            <td>Amoxicillin</td>
                                            <td>20 Maret 2025</td>
                                            <td>2</td>
                                            <td>2x sehari</td>
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

    <!-- Bootstrap & jQuery Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
