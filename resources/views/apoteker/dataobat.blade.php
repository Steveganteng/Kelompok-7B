<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apotik Medicoal</title>

    <!-- Font & Style -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<style>
    /* Container pagination */
.pagination {
  justify-content: center !important; /* Center pagination */
  margin-top: 1rem;
}

/* Link pagination */
.pagination li.page-item a.page-link,
.pagination li.page-item span.page-link {
  color: #4e73df; /* warna link biru */
  border-radius: 0.375rem;
  border: 1px solid #4e73df;
  padding: 0.4rem 0.75rem;
  margin: 0 0.2rem;
  font-weight: 600;
  transition: background-color 0.3s, color 0.3s;
}

/* Hover efek link */
.pagination li.page-item a.page-link:hover {
  background-color: #4e73df;
  color: white;
  text-decoration: none;
}

/* Aktif page */
.pagination li.page-item.active span.page-link {
  background-color: #4e73df;
  color: white;
  border-color: #4e73df;
  font-weight: 700;
}

/* Disabled page */
.pagination li.page-item.disabled span.page-link {
  color: #aaa;
  cursor: not-allowed;
  background-color: transparent;
  border-color: #ddd;
}

/* Panah (prev/next) */
.pagination li.page-item .page-link svg,
.pagination li.page-item .page-link i {
  vertical-align: middle;
  margin: 0 0.1rem;
}

</style>
<body id="page-top">
<div id="wrapper">
    @include('../layouts/navigation_apoteker')

    <div class="container-fluid mt-4">
        <h1 class="h3 mb-4 text-gray-800">Data Obat</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Obat</h6>
                <a href="{{ url('/tambah_dataobat') }}" class="btn btn-primary">
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
                    <table class="table table-bordered table-striped" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 40px; min-width: 40px; text-align:center;">No</th>
                                <th style="width: 60px; min-width: 60px; text-align:center;">Gambar</th>
                                <th style="min-width: 180px;">Nama Obat</th>
                                <th style="min-width: 140px;">Golongan</th>
                                <th style="width: 150px; min-width: 150px; text-align:right;">Harga</th>
                                <th style="width: 100px; min-width: 100px; text-align:center;">Stok</th>
                                <th style="width: 180px; min-width: 180px; text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $index => $obat)
                            <tr>
                                <td style="text-align:center;">{{ $obats->firstItem() + $index }}</td>
                                <td class="text-center" style="padding: 0.25rem;">
                                    <img src="{{ asset('storage/' . $obat->gambar) }}" alt="{{ $obat->NamaObat }}" width="45" class="img-thumbnail" style="max-height:45px; object-fit:cover;">
                                </td>
                                <td>{{ $obat->NamaObat }}</td>
                                <td>{{ $obat->golongan->NamaGolongan ?? '-' }}</td>
                                <td style="text-align:right;">Rp {{ number_format($obat->harga ?? 0, 0, ',', '.') }}</td>
                                <td style="text-align:center;">{{ $obat->stok }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-info btn-sm px-2" data-toggle="modal" data-target="#detailProdukModal-{{ $obat->id_obat }}" style="min-width: 95px;">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>

                                        <a href="{{ route('edit_dataobat', $obat->id_obat) }}" class="btn btn-warning btn-sm px-2" style="min-width: 75px;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal detail per item -->
                            <div class="modal fade" id="detailProdukModal-{{ $obat->id_obat }}" tabindex="-1" role="dialog" aria-labelledby="detailProdukModalLabel{{ $obat->id_obat }}" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="detailProdukModalLabel{{ $obat->id_obat }}">Detail Produk: {{ $obat->NamaObat }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-4 text-center mb-3">
                                        <img src="{{ asset('storage/' . $obat->gambar) }}" alt="{{ $obat->NamaObat }}" class="img-fluid img-thumbnail" />
                                      </div>
                                      <div class="col-md-8">
                                        <dl class="row">
                                          <dt class="col-sm-4">Nama Obat</dt>
                                          <dd class="col-sm-8">{{ $obat->NamaObat }}</dd>

                                          <dt class="col-sm-4">Golongan</dt>
                                          <dd class="col-sm-8">{{ $obat->golongan->NamaGolongan ?? '-' }}</dd>

                                          <dt class="col-sm-4">Penanda</dt>
                                          <dd class="col-sm-8">{{ $obat->penanda->nama_penanda ?? '-' }}</dd>

                                          <dt class="col-sm-4">Satuan</dt>
                                          <dd class="col-sm-8">{{ $obat->satuan->nama_satuan ?? '-' }}</dd>

                                          <dt class="col-sm-4">Isi per Kemasan</dt>
                                          <dd class="col-sm-8">{{ $obat->deskripsi }}</dd>

                                          <dt class="col-sm-4">Bobot Isi</dt>
                                          <dd class="col-sm-8">{{ $obat->bobot_isi }} mg</dd>

                                          <dt class="col-sm-4">Harga</dt>
                                          <dd class="col-sm-8">Rp {{ number_format($obat->harga ?? 0, 0, ',', '.') }}</dd>

                                          <dt class="col-sm-4">Stok</dt>
                                          <dd class="col-sm-8">{{ $obat->stok }}</dd>

                                          <dt class="col-sm-4">Lokasi Penyimpanan</dt>
                                          <dd class="col-sm-8">
                                            {{ $obat->lokasi->area ?? '-' }} - Rak {{ $obat->lokasi->rak ?? '-' }}, Baris {{ $obat->lokasi->baris ?? '-' }}, Kolom {{ $obat->lokasi->kolom ?? '-' }}
                                          </dd>
                                        </dl>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $obats->links() }}
                </div>
            </div>
        </div>
<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
