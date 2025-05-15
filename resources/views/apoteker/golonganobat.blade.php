<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Apotik Medicoal</title>

    <!-- Bootstrap & Admin Template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
<div id="wrapper">
    @include('../layouts/navigation_apoteker')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-4">
            <h1 class="h3 text-gray-800">Golongan Obat</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Golongan Obat</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Golongan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($golonganObat as $golongan)
                            <tr>
                                <td>{{ $golongan->id_golongan }}</td>
                                <td>{{ $golongan->NamaGolongan }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-edit"
                                            data-id="{{ $golongan->id_golongan }}"
                                            data-nama="{{ $golongan->NamaGolongan }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                        Edit
                                    </button>

                                    <form action="{{ route('golongan_obat.destroy', $golongan->id_golongan) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('golongan_obat.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Golongan Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="NamaGolongan" class="form-label">Nama Golongan</label>
                    <input type="text" name="NamaGolongan" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editForm" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Golongan Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_golongan" id="editIdGolongan">
                <div class="mb-3">
                    <label for="editNamaGolongan" class="form-label">Nama Golongan</label>
                    <input type="text" name="NamaGolongan" id="editNamaGolongan" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        let nama = $(this).data('nama');

        $('#editIdGolongan').val(id);
        $('#editNamaGolongan').val(nama);
        $('#editForm').attr('action', '/golonganobat/' + id);
    });
</script>

</body>
</html>
