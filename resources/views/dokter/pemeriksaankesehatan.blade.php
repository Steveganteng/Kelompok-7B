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
                        <h1 class="h3 mb-0 text-gray-800">Pemeriksaan Kesehatan</h1>
                    </div>
                    <!-- Tombol Tambah Pasien -->
                    <div class="mb-4 d-flex justify-content-end">
                <a href="{{ url('/tambah_pemeriksaankesehatan') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pasien
                </a>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pasien</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                             <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pemeriksaankesehatan as $pasien)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $pasien->nama_pasien }}</td>
                    <td>{{ $pasien->tanggal_lahir }}</td>
                    <td>{{ $pasien->jenis_kelamin }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->telepon }}</td>
                    <td>
                        <button
                            type="button"
                            class="btn btn-info btn-sm btn-view-pemeriksaan"
                            data-toggle="modal"
                            data-target="#pemeriksaanModal"
                            data-nama="{{ $pasien->nama_pasien }}"
                            data-pemeriksaan='@json($pasien->pemeriksaan)'
                            data-reseps='@json($pasien->reseps)'>
                            <i class="fas fa-eye"></i> Lihat Pemeriksaan
                        </button>
                    </td>
                </tr>
                @endforeach

                @if($pemeriksaankesehatan->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pasien.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pemeriksaanModal" tabindex="-1" role="dialog" aria-labelledby="pemeriksaanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="modalPasienNama"></span> - Data Pemeriksaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tablePemeriksaan">
                            <thead>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <th>Anamnesis</th>
                                    <th>Tinggi (cm)</th>
                                    <th>Berat (kg)</th>
                                    <th>Suhu (°C)</th>
                                    <th>Saturasi (%)</th>
                                    <th>Tekanan Darah</th>
                                    <th>Denyut Nadi</th>
                                    <th>Laju Napas</th>
                                    <th>Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated dynamically by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();

            // Show data in the modal when the "view" button is clicked
            $('.btn-view-pemeriksaan').on('click', function() {
                const pasienNama = $(this).data('nama');
                const pemeriksaan = $(this).data('pemeriksaan');

                // Set the patient's name in the modal
                $('#modalPasienNama').text(pasienNama);

                const tbody = $('#tablePemeriksaan tbody');
                tbody.empty();

                // Check if there is pemeriksaan data
                if (pemeriksaan.length === 0) {
                    tbody.append('<tr><td colspan="10" class="text-center">Tidak ada data pemeriksaan.</td></tr>');
                } else {
                    // Populate the modal with pemeriksaan data
                    pemeriksaan.forEach(item => {
                        const tekananDarah = `${item.tekanan_darah_sistolik} / ${item.tekanan_darah_diastolik}`;
                        const row = `
                            <tr>
                                <td>${item.mulai_diwawati}</td>
                                <td>${item.anamnesis || '-'}</td>
                                <td>${item.tinggi_badan}</td>
                                <td>${item.berat_badan}</td>
                                <td>${item.suhu_tubuh}</td>
                                <td>${item.saturasi_oksigen}</td>
                                <td>${tekananDarah}</td>
                                <td>${item.nadi}</td>
                                <td>${item.laju_pernapasan}</td>
                                <td>${item.diagnosa}</td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                }
            });
        });
    </script>

</body>

</html>
