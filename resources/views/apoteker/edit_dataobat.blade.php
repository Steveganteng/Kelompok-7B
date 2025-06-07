<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Produk - Apotik Medicoal</title>

  <!-- Font & Style -->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">
  @include('../layouts/navigation_apoteker')

  <div class="container-fluid mt-4">
    <h1 class="h3 mb-4 text-gray-800">Edit Produk</h1>

    <form action="{{ route('update_dataobat', $obat->id_obat) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Nama Dagang Obat --}}
      <div class="form-group">
        <label>Nama Dagang Obat</label>
        <input type="text" name="nama_dagang_obat"
               class="form-control"
               value="{{ old('nama_dagang_obat', $obat->nama_dagang_obat) }}"
               required>
      </div>

      {{-- Nama Generik Obat --}}
      <div class="form-group">
        <label>Nama Generik Obat</label>
        <input type="text" name="nama_obat"
               class="form-control"
               value="{{ old('nama_obat', $obat->nama_obat) }}"
               required>
      </div>

      {{-- Distributor Obat --}}
      <div class="form-group">
        <label>Distributor Obat</label>
        <input type="text" name="distributor_obat"
               class="form-control"
               value="{{ old('distributor_obat', $obat->distributor_obat) }}"
               required>
      </div>

      {{-- Golongan & Penanda --}}
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Golongan</label>
          <select name="golongan_id" class="form-control" required>
            @foreach($golongans as $g)
              <option value="{{ $g->id_golongan }}"
                  {{ old('golongan_id', $obat->golongan_id) == $g->id_golongan ? 'selected' : '' }}>
                {{ $g->NamaGolongan }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Penanda</label>
          <select name="penanda_id" class="form-control" required>
            @foreach($penandas as $p)
              <option value="{{ $p->id_penanda }}"
                  {{ old('penanda_id', $obat->penanda_id) == $p->id_penanda ? 'selected' : '' }}>
                {{ $p->nama_penanda }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- Satuan & Bobot Isi --}}
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Satuan Kemasan</label>
          <select name="satuan_id" class="form-control" required>
            @foreach($satuans as $s)
              <option value="{{ $s->id_satuan }}"
                  {{ old('satuan_id', $obat->satuan_id) == $s->id_satuan ? 'selected' : '' }}>
                {{ $s->nama_satuan }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Bobot Isi (mg)</label>
          <input type="number" name="bobot_isi"
                 class="form-control"
                 value="{{ old('bobot_isi', $obat->bobot_isi) }}"
                 min="1" required>
        </div>
      </div>

      {{-- Harga, Stok & Tgl Kadaluarsa --}}
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Harga (Rp)</label>
          <input type="number" name="harga"
                 class="form-control"
                 value="{{ old('harga', $obat->harga) }}"
                 min="0" required>
        </div>
        <div class="form-group col-md-4">
          <label>Stok</label>
          <input type="number" name="stok"
                 class="form-control"
                 value="{{ old('stok', $obat->stok) }}"
                 min="0" required>
        </div>
        <div class="form-group col-md-4">
          <label>Tanggal Kadaluarsa</label>
          <input type="date" name="tgl_kadaluarsa"
                 class="form-control"
                 value="{{ old('tgl_kadaluarsa', $obat->tgl_kadaluarsa?->format('Y-m-d')) }}"
                 required>
        </div>
      </div>

      {{-- Deskripsi Obat --}}
      <div class="form-group">
        <label>Deskripsi Obat (opsional)</label>
        <textarea name="deskripsi" class="form-control" rows="2"
                  placeholder="Keterangan tambahan...">{{ old('deskripsi', $obat->deskripsi) }}</textarea>
      </div>

      <hr>
      <h5>Lokasi Penyimpanan</h5>

      {{-- Lokasi: Area --}}
      <div class="form-group">
        <label>Area</label>
        <select name="area" class="form-control" required>
          @foreach($areaOptions as $area)
            <option value="{{ $area }}"
                {{ old('area', $obat->lokasi->area) == $area ? 'selected' : '' }}>
              {{ $area }}
            </option>
          @endforeach
        </select>
      </div>
      {{-- Lokasi: Rak / Baris / Kolom --}}
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Rak</label>
          <select name="rak" class="form-control" required>
            @foreach($rakOptions as $rak)
              <option value="{{ $rak }}"
                  {{ old('rak', $obat->lokasi->rak) == $rak ? 'selected' : '' }}>
                {{ $rak }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Baris</label>
          <select name="baris" class="form-control" required>
            @foreach($barisOptions as $baris)
              <option value="{{ $baris }}"
                  {{ old('baris', $obat->lokasi->baris) == $baris ? 'selected' : '' }}>
                {{ $baris }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Kolom</label>
          <select name="kolom" class="form-control" required>
            @foreach($kolomOptions as $kolom)
              <option value="{{ $kolom }}"
                  {{ old('kolom', $obat->lokasi->kolom) == $kolom ? 'selected' : '' }}>
                {{ $kolom }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      {{-- Gambar --}}
      <div class="form-group">
        <label>Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control-file">
        @if($obat->gambar)
          <img src="{{ asset('storage/' . $obat->gambar) }}"
               class="img-thumbnail mt-3"
               style="max-height:150px;"
               alt="Gambar Obat">
        @endif
      </div>

      {{-- Buttons --}}
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      <a href="{{ route('dataobat') }}" class="btn btn-secondary">Batal</a>

    </form>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
