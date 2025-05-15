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

    <div class="container mt-4">
        <h3>Edit Alat Kesehatan: {{ $alat->nama }}</h3>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alatkesehatan.update', $alat->id_AlatKesehatan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="nama">Nama Alat</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $alat->nama) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="jenis">Jenis</label>
                <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis', $alat->jenis) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $alat->stok) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="gambar">Gambar (Opsional)</label><br>
                @if($alat->gambar)
                    <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama }}" width="150" class="mb-3 img-thumbnail"><br>
                @endif
                <input type="file" name="gambar" id="gambar" class="form-control-file">
            </div>

            {{-- Dropdown foreign keys --}}
            <div class="form-group mb-3">
                <label for="golongan_id">Golongan</label>
                <select name="golongan_id" id="golongan_id" class="form-control" required>
                    @foreach(\App\Models\Golongan::all() as $golongan)
                        <option value="{{ $golongan->id_golongan }}" {{ old('golongan_id', $alat->golongan_id) == $golongan->id_golongan ? 'selected' : '' }}>
                            {{ $golongan->NamaGolongan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="penanda_id">Penanda</label>
                <select name="penanda_id" id="penanda_id" class="form-control" required>
                    @foreach(\App\Models\Penanda::all() as $penanda)
                        <option value="{{ $penanda->id_penanda }}" {{ old('penanda_id', $alat->penanda_id) == $penanda->id_penanda ? 'selected' : '' }}>
                            {{ $penanda->nama_penanda }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="lokasi_id">Lokasi</label>
                <select name="lokasi_id" id="lokasi_id" class="form-control" required>
                    @foreach(\App\Models\Lokasi::all() as $lokasi)
                        <option value="{{ $lokasi->id_lokasi }}" {{ old('lokasi_id', $alat->lokasi_id) == $lokasi->id_lokasi ? 'selected' : '' }}>
                            {{ $lokasi->area }} - Rak {{ $lokasi->rak }}, Baris {{ $lokasi->baris }}, Kolom {{ $lokasi->kolom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="satuan_id">Satuan</label>
                <select name="satuan_id" id="satuan_id" class="form-control" required>
                    @foreach(\App\Models\Satuan::all() as $satuan)
                        <option value="{{ $satuan->id_satuan }}" {{ old('satuan_id', $alat->satuan_id) == $satuan->id_satuan ? 'selected' : '' }}>
                            {{ $satuan->nama_satuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $alat->harga) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Tersedia" {{ old('status', $alat->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Dipakai" {{ old('status', $alat->status) == 'Dipakai' ? 'selected' : '' }}>Dipakai</option>
                    <option value="Sekali Pakai" {{ old('status', $alat->status) == 'Sekali Pakai' ? 'selected' : '' }}>Sekali Pakai</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('alatkesehatan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>


<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
