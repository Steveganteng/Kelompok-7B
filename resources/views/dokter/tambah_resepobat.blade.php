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
                        <h1 class="h3 mb-0 text-gray-800">Rawat Inap</h1>
                    </div>


                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->

                        <div class="container-fluid">
                            <!-- Heading -->

                            <div class="row">
                                <!-- Form Input Obat -->
                                <div class="container">
                                    <h4 class="mb-4">Tambah Resep Obat</h4>

                                    <form id="formResep" method="POST" action="{{ route('resep.store') }}">
                                        @csrf

                                        <div class="row">
                                            <!-- Form Input Obat -->
                                            <div class="col-md-6 mb-4">
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <h6 class="mb-3 font-weight-bold text-primary">Form Tambah Obat</h6>

                                                        <div class="form-group">
                                                            <label for="nama_obat_4">Nama Obat</label>
                                                            <select class="form-control" id="nama_obat_4" name="nama_obat_4">
                                                                <option value="">Pilih Obat</option>
                                                                @foreach($obats as $obat)
                                                                    <option value="{{ $obat->NamaObat }}">
                                                                        {{ $obat->NamaObat }} (Stok: {{ $obat->stok }}, Bobot: {{ $obat->bobot ?? '-' }} gram)
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="jumlah_obat_4">Jumlah Obat</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" id="jumlah_obat_4" name="jumlah_obat_4" placeholder="Masukkan jumlah penggunaan" min="1">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Satuan</span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="aturan_pakai_4">Aturan Pakai</label>
                                                            <input type="text" class="form-control" id="aturan_pakai_4" name="aturan_pakai_4" placeholder="Masukkan aturan pakai">
                                                        </div>

                                                        <button type="button" class="btn btn-success mt-2" onclick="tambahObatKeTabel()">
                                                            + Tambah Obat ke Resep
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tabel Resep -->
                                            <div class="col-md-6 mb-4">
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <h6 class="mb-3 font-weight-bold text-primary">Daftar Obat</h6>
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Nama Obat</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Aturan Pakai</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tabel_obat_body">
                                                                <tr id="pesan_kosong">
                                                                    <td colspan="4" class="text-center text-muted">
                                                                        Isi tabel dengan menambahkan obat dari form di sebelah kiri.
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <button type="button" class="btn btn-primary mt-3" onclick="selesaiResep()">
                                                            Selesai
                                                        </button>
                                                        <button type="button" class="btn btn-secondary mt-3 ml-2" onclick="cetakPDF()">
                                                            Print
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    function tambahObatKeTabel() {
        const namaObat = document.getElementById("nama_obat_4").value;
        const jumlah = document.getElementById("jumlah_obat_4").value;
        const aturan = document.getElementById("aturan_pakai_4").value;

        if (!namaObat || !jumlah || !aturan) {
            alert("Harap lengkapi semua data sebelum menambahkan obat.");
            return;
        }

        const tbody = document.getElementById("tabel_obat_body");

        const pesanKosong = document.getElementById("pesan_kosong");
        if (pesanKosong) {
            pesanKosong.remove();
        }

        const row = document.createElement("tr");

        const tdNama = document.createElement("td");
        tdNama.textContent = namaObat;

        const tdJumlah = document.createElement("td");
        tdJumlah.textContent = jumlah;

        const tdAturan = document.createElement("td");
        tdAturan.textContent = aturan;

        const tdAksi = document.createElement("td");
        const btnHapus = document.createElement("button");
        btnHapus.type = "button";
        btnHapus.className = "btn btn-danger btn-sm";
        btnHapus.textContent = "Hapus";
        btnHapus.onclick = function () {
            row.remove();

            if (tbody.children.length === 0) {
                const kosongRow = document.createElement("tr");
                kosongRow.id = "pesan_kosong";
                kosongRow.innerHTML = `<td colspan="4" class="text-center text-muted">Isi tabel dengan menambahkan obat dari form di sebelah kiri.</td>`;
                tbody.appendChild(kosongRow);
            }
        };
        tdAksi.appendChild(btnHapus);

        row.appendChild(tdNama);
        row.appendChild(tdJumlah);
        row.appendChild(tdAturan);
        row.appendChild(tdAksi);

        tbody.appendChild(row);

        document.getElementById("nama_obat_4").value = '';
        document.getElementById("jumlah_obat_4").value = '';
        document.getElementById("aturan_pakai_4").value = '';
    }

    function selesaiResep() {
        const tbody = document.getElementById("tabel_obat_body");
        const pesanKosong = document.getElementById("pesan_kosong");

        if (tbody.children.length === 0 || pesanKosong) {
            alert("Resep masih kosong, silakan tambahkan obat terlebih dahulu.");
            return;
        }

        const form = document.getElementById("formResep");

        // Hapus input hidden obat yang lama (jika ada)
        const oldInputs = form.querySelectorAll('input[name^="obat["]');
        oldInputs.forEach(input => input.remove());

        Array.from(tbody.children).forEach((row, index) => {
            if (row.id === "pesan_kosong") return;

            const cells = row.children;

            const inputNama = document.createElement("input");
            inputNama.type = "hidden";
            inputNama.name = `obat[${index}][nama]`;
            inputNama.value = cells[0].textContent.trim();

            const inputJumlah = document.createElement("input");
            inputJumlah.type = "hidden";
            inputJumlah.name = `obat[${index}][jumlah]`;
            inputJumlah.value = cells[1].textContent.trim();

            const inputAturan = document.createElement("input");
            inputAturan.type = "hidden";
            inputAturan.name = `obat[${index}][aturan]`;
            inputAturan.value = cells[2].textContent.trim();

            form.appendChild(inputNama);
            form.appendChild(inputJumlah);
            form.appendChild(inputAturan);
        });

        form.submit();
    }

    function cetakPDF() {
        const { jsPDF } = window.jspdf;

        const doc = new jsPDF();

        const tabel = document.querySelector("table.table-bordered");

        let text = "Daftar Obat dalam Resep:\n\n";

        const rows = tabel.querySelectorAll("tbody tr");
        let count = 0;
        rows.forEach((row) => {
            if (row.id === "pesan_kosong") return;
            const cells = row.querySelectorAll("td");
            count++;
            text += `${count}. ${cells[0].textContent} - Jumlah: ${cells[1].textContent}, Aturan Pakai: ${cells[2].textContent}\n`;
        });

        doc.text(text, 10, 10);
        doc.save("resep-obat.pdf");
    }
</script>



                            <!-- End of Main Content -->


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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

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
