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

        th, td {
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

            .table, .table tbody, .table tr, .table td {
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
            <!-- Display status in the 'Status' column -->
            <span class="badge badge-{{ $obat->pivot->status == 'belum diberikan' ? 'warning' : 'success' }}">
                    Status: {{ $obat->pivot->status ?? 'N/A' }}
                </span><br>
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
                data-status="{{ $resep->status }}"
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
                            <td><strong>Tanggal Resep:</strong></td>
                            <td><span id="tanggalResep"></span></td>
                        </tr>
                    </tbody>
                </table>

                <!-- New Table for Medication Details -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 25%;">Nama Obat</th>
                            <th style="width: 25%;">Jumlah</th>
                            <th style="width: 25%;">Aturan Pakai</th>
                            <th style="width: 25%;">Dosis</th>
                        </tr>
                    </thead>
                    <tbody id="medicationDetails">
                        <!-- Data will be inserted dynamically using JavaScript -->
                    </tbody>
                </table>
            </div>
           <div class="modal-footer">
    <!-- Print Button -->
     <button type="button" class="btn btn-primary" id="btnCetak">
                    <i class="fas fa-print mr-1"></i> Cetak
                </button>
    <!-- Mark as 'Given' (Serahkan) Button -->
    <button type="button" class="btn btn-success" id="btnSerahkan">
        <i class="fas fa-check mr-1"></i> Serahkan
    </button>
    <!-- Close Modal Button -->
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                    "lengthMenu": "",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman PAGE dari PAGES",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari MAX total data)"
                }
            });

          $('.btnResep').on('click', function() {
    // Get data for the modal
        const resepId = $(this).data('pasien-id'); // Atau ganti sesuai kebutuhan, misalnya resep_id
    resepIdTerpilih = resepId;
    const namaPasien = $(this).data('nama');
    const tanggalResep = $(this).data('tanggal');
    const obats = $(this).data('obat').split(','); // Assuming multiple medications are separated by commas

    const jumlah = $(this).data('jumlah').split(',');
    const aturanPakai = $(this).data('aturan').split(',');
    const dosis = $(this).data('dosis').split(',');

    // Set patient info
    $('#namaPasien').text(namaPasien);
    $('#tanggalResep').text(tanggalResep);

    // Clear previous data
    $('#medicationDetails').empty();

    // Insert medication data into the table
    for (let i = 0; i < obats.length; i++) {
        $('#medicationDetails').append(`
            <tr>
                <td>${obats[i]}</td>
                <td>${jumlah[i]}</td>
                <td>${aturanPakai[i]}</td>
                <td>${dosis[i]}</td>
            </tr>
        `);
    }

    // Show the modal
    $('#resepModal').modal('show');
});



$('#btnSerahkan').on('click', function () {
    $.ajax({
        url: '/UbahStatusResep',
        type: 'GET',
        success: function (res) {
            alert(res.message);
            location.reload();
        },
        error: function (xhr) {
            alert('Error: ' + (xhr.responseJSON?.message || 'Gagal mengubah status'));
        }
    });
});

// Function to print the modal content
document.getElementById('btnCetak').addEventListener('click', function () {
    var namaPasien = document.getElementById('namaPasien').innerText;
    var tanggalResep = document.getElementById('tanggalResep').innerText;
    var medicationDetails = document.getElementById('medicationDetails').innerHTML;

    // Creating a new window for printing
    var printWindow = window.open('', '', 'height=600,width=700');
    printWindow.document.write('<html><head><title>Detail Resep Obat</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: Arial, sans-serif; padding: 20px; }');
    printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }');
    printWindow.document.write('th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }');
    printWindow.document.write('th { background-color: #f4f4f4; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2>Detail Resep Obat</h2>');
    printWindow.document.write('<table>');
    printWindow.document.write('<tr><th style="width: 25%;">Detail</th><th>Data</th></tr>');
    printWindow.document.write('<tr><td><strong>Nama Pasien:</strong></td><td>' + namaPasien + '</td></tr>');
    printWindow.document.write('<tr><td><strong>Tanggal Resep:</strong></td><td>' + tanggalResep + '</td></tr>');
    printWindow.document.write('</table>');

    // Medication details table
    printWindow.document.write('<table>');
    printWindow.document.write('<thead><tr><th style="width: 25%;">Nama Obat</th><th style="width: 25%;">Jumlah</th><th style="width: 25%;">Aturan Pakai</th><th style="width: 25%;">Dosis</th></tr></thead>');
    printWindow.document.write('<tbody>' + medicationDetails + '</tbody>');
    printWindow.document.write('</table>');

    printWindow.document.write('</body></html>');

    // Wait until the document is fully loaded, then print
    printWindow.document.close();
    printWindow.print();
});



        });
    </script>

</body>

</html>
