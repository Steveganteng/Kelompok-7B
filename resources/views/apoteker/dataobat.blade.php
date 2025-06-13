<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Apotik Medicoal</title>

    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

    <style>

.table tbody td {
  color: #54504D;               /* medium dark gray */
}
.table-striped tbody tr:nth-of-type(odd) {
  background-color: #FFFFFF;    /* putih */
}
.table-striped tbody tr:nth-of-type(even) {
  background-color: #F1F4F9;    /* very light gray-blue */
}

.table .btn-info {
  color: #333333;               /* dark gray for contrast */
}
.table .btn-info:hover {
  color: #FFFFFF;
}

.table .btn-warning {
  background-color: #FFBF05;    /* mustard yellow */
  border-color: #FFBF05;
  color: #333333;               /* dark gray for contrast */
}
.table .btn-warning:hover {
  background-color: #D3A004;    /* darker mustard */
  border-color: #D3A004;
  color: #FFFFFF;
}
    /* Warna baris berdasarkan penanda (tetap) */
    .penanda-merah   { background-color: #f8d7da !important; }
    .penanda-kuning  { background-color: #fff3cd !important; }
    .penanda-hijau   { background-color: #d4edda !important; }
    </style>
</head>
<body id="page-top">
@php use Carbon\Carbon; @endphp

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
                <form method="GET" action="{{ url()->current() }}" class="mb-3 d-flex justify-content-end" role="search">
                    <input type="text" name="search" class="form-control w-auto" placeholder="Cari Nama Obat..." value="{{ $search ?? '' }}">
                    <button type="submit" class="btn btn-primary ml-2">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <table class="table table-bordered table-striped" style="width:100%">
    <thead class="thead-light">
        <tr>
            <th style="width: 40px; text-align:center;">No</th>
            <th>Nama Dagang</th>
            <th>Nama Generik</th>
            <th>Distributor</th>
            <th>Golongan</th>
            <th>Satuan</th>
            <th>Bobot Isi</th> {{-- baru --}}
            <th style="width: 120px; text-align:center;">Tgl Kadaluarsa</th>
            <th style="width: 100px; text-align:center;">Stok</th>
            <th style="width: 140px; text-align:center;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($obats as $index => $obat)
            @php
                $penanda = strtolower($obat->penanda->nama_penanda ?? '');
                $class = match($penanda) {
                    'merah','kritikal','bahaya' => 'penanda-merah',
                    'kuning','perhatian'        => 'penanda-kuning',
                    'hijau','aman'              => 'penanda-hijau',
                    default                      => 'penanda-default',
                };
                $stokWarning       = $obat->stok <= 50;
                $tglKadaluarsa     = $obat->tgl_kadaluarsa ? Carbon::parse($obat->tgl_kadaluarsa) : null;
                $kadaluarsaWarning = $tglKadaluarsa
                                     && !$tglKadaluarsa->isPast()
                                     && $tglKadaluarsa->diffInDays(Carbon::now()) <= 7;
            @endphp
            <tr class="{{ $class }}">
                <td class="text-center">{{ $obats->firstItem() + $index }}</td>
                <td>{{ $obat->nama_dagang_obat }}</td>
                <td>{{ $obat->nama_obat }}</td>
                <td>{{ $obat->distributor_obat }}</td>
                <td>{{ $obat->golongan->NamaGolongan ?? '-' }}</td>
                <td>{{ $obat->satuan->nama_satuan ?? '-' }}</td>
                <td>{{ $obat->bobot_isi }} mg</td> {{-- baru --}}
                <td class="text-center">
                    @if($kadaluarsaWarning)
                        <span class="warning-text"><i class="fas fa-exclamation-triangle"></i> {{ $tglKadaluarsa->translatedFormat('d F Y') }}</span>
                    @else
                        {{ $tglKadaluarsa?->translatedFormat('d F Y') ?? '-' }}
                    @endif
                </td>
                <td class="text-center">
                    @if($stokWarning)
                        <span class="warning-text"><i class="fas fa-exclamation-circle"></i> {{ $obat->stok }}</span>
                    @else
                        {{ $obat->stok }}
                    @endif
                </td>
                <td class="text-center">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailProdukModal-{{ $obat->id_obat }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <a href="{{ route('edit_dataobat', $obat->id_obat) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>

            {{-- Modal detail produk --}}
           <div class="modal fade" id="detailProdukModal-{{ $obat->id_obat }}" tabindex="-1" role="dialog" aria-labelledby="detailProdukModalLabel{{ $obat->id_obat }}" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      {{-- Header --}}
      <div class="modal-header">
        <h5 class="modal-title" id="detailProdukModalLabel{{ $obat->id_obat }}">
          Detail: {{ $obat->nama_dagang_obat }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      {{-- Body --}}
      <div class="modal-body">
        <div class="row">
          {{-- Gambar --}}
          <div class="col-md-4 text-center mb-3">
            <img src="{{ asset('storage/' . $obat->gambar) }}"
                 class="img-fluid img-thumbnail"
                 alt="{{ $obat->nama_dagang_obat }}">
          </div>

          {{-- Detail List --}}
          <div class="col-md-8">
            <dl class="row">
              <dt class="col-sm-4">Nama Dagang</dt>
              <dd class="col-sm-8">{{ $obat->nama_dagang_obat }}</dd>

              <dt class="col-sm-4">Nama Generik</dt>
              <dd class="col-sm-8">{{ $obat->nama_obat }}</dd>

              <dt class="col-sm-4">Distributor</dt>
              <dd class="col-sm-8">{{ $obat->distributor_obat }}</dd>

              <dt class="col-sm-4">Golongan</dt>
              <dd class="col-sm-8">{{ $obat->golongan->NamaGolongan ?? '-' }}</dd>

              <dt class="col-sm-4">Penanda</dt>
              <dd class="col-sm-8">{{ $obat->penanda->nama_penanda ?? '-' }}</dd>

              <dt class="col-sm-4">Satuan</dt>
              <dd class="col-sm-8">{{ $obat->satuan->nama_satuan ?? '-' }}</dd>

              <dt class="col-sm-4">Deskripsi</dt>
              <dd class="col-sm-8">{{ $obat->deskripsi ?? '-' }}</dd>

              <dt class="col-sm-4">Bobot Isi</dt>
              <dd class="col-sm-8">{{ $obat->bobot_isi }} mg</dd>

              <dt class="col-sm-4">Harga</dt>
              <dd class="col-sm-8">Rp {{ number_format($obat->harga, 0, ',', '.') }}</dd>

              <dt class="col-sm-4">Tgl Kadaluarsa</dt>
              <dd class="col-sm-8">
                @if($kadaluarsaWarning)
                  <span class="warning-text">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $tglKadaluarsa->translatedFormat('d F Y') }}
                  </span>
                @else
                  {{ $tglKadaluarsa?->translatedFormat('d F Y') ?? '-' }}
                @endif
              </dd>

              <dt class="col-sm-4">Stok</dt>
              <dd class="col-sm-8">
                @if($stokWarning)
                  <span class="warning-text">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $obat->stok }}
                  </span>
                @else
                  {{ $obat->stok }}
                @endif
              </dd>

              <dt class="col-sm-4">Lokasi</dt>
              <dd class="col-sm-8">
                {{ $obat->lokasi->area ?? '-' }} — Rak {{ $obat->lokasi->rak ?? '-' }},
                Baris {{ $obat->lokasi->baris ?? '-' }}, Kolom {{ $obat->lokasi->kolom ?? '-' }}
                @if(!empty($obat->lokasi->deskripsi))
                  <br><small class="text-muted">{{ $obat->lokasi->deskripsi }}</small>
                @endif
              </dd>
            </dl>
          </div>
        </div>
      </div>

      {{-- Footer --}}
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
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
