<!-- resources/views/apoteker/resepobat.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Apotik Medicoal - Daftar Resep Obat</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <style>
        #content {
            min-height: 90vh;
        }

        .btnResep {
            padding: 0.3rem 0.6rem;
            font-size: 0.9rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        th,
        td {
            text-align: center;
            padding: 0.75rem;
        }

        th {
            background-color: #f8f9fc;
        }

        .badge-warning {
            background-color: #ffcc00;
        }

        .badge-success {
            background-color: #28a745;
        }

        .modal-body {
            padding: 20px;
        }

        /* Custom styles for printable view */
        @media print {
            body {
                font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            }

            .modal-footer,
            .btn,
            .table th,
            .table td {
                display: none;
            }

            .print-container {
                display: block;
                padding: 20px;
                text-align: left;
            }

            .print-container h2 {
                color: #4e73df;
                margin-bottom: 10px;
            }

            .print-container p {
                font-size: 1.2rem;
            }

            .print-container strong {
                color: #2e59d9;
            }
        }

        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table td {
                text-align: left;
                padding: 10px 0;
            }

            .table td::before {
                content: attr(data-label);
                font-weight: bold;
                padding-right: 10px;
            }
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        @include('layouts.navigation_apoteker')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content" class="bg-light p-4">
                <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Daftar Resep Obat</h1>

                <div class="card shadow mb-4">
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:5%;">No</th>
                                        <th style="width:25%;">Nama Pasien</th>
                                        <th style="width:30%;">Nama Obat</th>
                                        <th style="width:20%;">Status</th>
                                        <th style="width:20%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reseps as $index => $resep)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $resep->pasien->nama_pasien ?? '-' }}</td>
                                        <td>
                                            @foreach($resep->obats as $obat)
                                                {{ $obat->nama_dagang_obat ?? 'N/A' }}<br>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-{{ $resep->status == 'belum diberikan' ? 'warning' : 'success' }}">
                                                {{ $resep->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-sm btnResep"
                                                title="Lihat Detail Resep"
                                                data-nama="{{ $resep->pasien->nama_pasien ?? 'N/A' }}"
                                                data-obat="{{ $resep->obats->pluck('nama_dagang_obat')->join(', ') }}"
                                                data-tanggal="{{ $resep->tanggal }}"
                                                data-aturan="{{ $resep->obats->pluck('pivot.aturan_pakai')->join(', ') }}"
                                                data-jumlah="{{ $resep->obats->pluck('pivot.jumlah')->join(', ') }}"
                                                data-dosis="{{ $resep->obats->pluck('pivot.dosis')->join(', ') }}"
                                                data-pasien-id="{{ $resep->pasien_id }}"
                                                data-obat-id="{{ $resep->obats->pluck('id_obat')->join(', ') }}">
                                                <i class="fas fa-file-prescription"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Resep -->
                <div class="modal fade" id="resepModal" tabindex="-1" role="dialog" aria-labelledby="resepModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold text-primary" id="resepModalLabel">Detail Resep Obat</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Prescription Table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 25%;">Detail</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Nama Pasien:</strong></td>
                                            <td><span id="namaPasien"></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Obat:</strong></td>
                                            <td><span id="namaObat"></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Resep:</strong></td>
                                            <td><span id="tanggalResep"></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jumlah:</strong></td>
                                            <td><span id="jumlahResep"></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Aturan Pakai:</strong></td>
                                            <td><span id="aturanPakai"></span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dosis:</strong></td>
                                            <td><span id="dosisResep"></span></td>
                                        </tr>
                                        <!-- Status Update Select -->
                                        <tr>
                                            <td><strong>Status:</strong></td>
                                            <td>
                                                <select id="updateStatus" class="form-control">
                                                    <option value="belum diberikan">Belum Diberikan</option>
                                                    <option value="sudah diberikan">Sudah Diberikan</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="btnCetak"><i class="fas fa-print mr-1"></i> Cetak</button>
                                <button type="button" class="btn btn-success" id="btnSerahkan"><i class="fas fa-check mr-1"></i> Serahkan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-warning" id="btnUpdateStatus"><i class="fas fa-sync-alt mr-1"></i> Update Status</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Bootstrap & jQuery Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables -->
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

            $('.btnResep').on('click', function() {
                $('#namaPasien').text($(this).data('nama'));
                $('#namaObat').text($(this).data('obat'));
                $('#tanggalResep').text($(this).data('tanggal'));
                $('#aturanPakai').text($(this).data('aturan'));
                $('#jumlahResep').text($(this).data('jumlah'));
                $('#dosisResep').text($(this).data('dosis'));
                $('#pasienID').text($(this).data('pasien-id'));
                $('#obatID').text($(this).data('obat-id'));
                $('#resepModal').modal('show');
            });

            $('#btnCetak').on('click', function() {
                var namaPasien = $('#namaPasien').text();
                var namaObat = $('#namaObat').text();
                var tanggalResep = $('#tanggalResep').text();
                var aturanPakai = $('#aturanPakai').text();
                var jumlahResep = $('#jumlahResep').text();
                var dosisResep = $('#dosisResep').text();

                var printWindow = window.open('', '', 'height=600,width=700');
                printWindow.document.write(`
                    <html>
                    <head>
                        <title>Cetak Resep</title>
                        <style>
                            body {
                                font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                                padding: 30px;
                                color: #333;
                            }
                            h2 {
                                color: #4e73df;
                                border-bottom: 3px solid #4e73df;
                                padding-bottom: 10px;
                                margin-bottom: 25px;
                                font-weight: 700;
                            }
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin-top: 20px;
                            }
                            table, th, td {
                                border: 1px solid #ddd;
                                padding: 8px;
                                text-align: left;
                            }
                            th {
                                background-color: #f8f9fc;
                                color: #4e73df;
                                font-weight: bold;
                            }
                            td {
                                font-size: 1rem;
                            }
                            strong {
                                color: #2e59d9;
                            }
                        </style>
                    </head>
                    <body>
                        <h2>Detail Resep Obat</h2>
                        <table>
                            <tr>
                                <th>Nama Pasien</th>
                                <td>${namaPasien}</td>
                            </tr>
                            <tr>
                                <th>Nama Obat</th>
                                <td>${namaObat}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Resep</th>
                                <td>${tanggalResep}</td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>${jumlahResep}</td>
                            </tr>
                            <tr>
                                <th>Aturan Pakai</th>
                                <td>${aturanPakai}</td>
                            </tr>
                            <tr>
                                <th>Dosis</th>
                                <td>${dosisResep}</td>
                            </tr>
                        </table>
                    </body>
                    </html>
                `);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            });

            $('#btnUpdateStatus').on('click', function() {
                var status = $('#updateStatus').val();
                var resepId = $('#pasienID').text(); // Use this as the id of the resep

                // Make an AJAX request to update the status, passing the id and status in the URL
                $.ajax({
                    url: '{{ route("updateStatus", ["id" => "ID", "status" => "STATUS"]) }}'.replace("ID", resepId).replace("STATUS", status),
                    type: 'GET', // Use GET since the parameters are in the URL
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#resepModal').modal('hide');
                            // Optionally, update the status on the page without reloading
                            $('#resepStatus' + resepId).text(status); // Update the displayed status
                        } else {
                            alert('Gagal memperbarui status.');
                        }
                    }
                });
            });

            $('#btnSerahkan').on('click', function() {
                alert('Resep sudah diserahkan!');
                $('#resepModal').modal('hide');
            });
        });
    </script>

</body>

</html>
