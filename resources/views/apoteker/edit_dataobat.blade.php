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

            {{-- Nama Obat --}}
            <div class="form-group">
                <label>Nama Obat</label>
                <input type="text" name="NamaObat" class="form-control" value="{{ old('NamaObat', $obat->NamaObat) }}" required>
            </div>

            {{-- Golongan --}}
            <div class="form-group">
                <label>Golongan</label>
                <select name="golongan_id" class="form-control" required>
                    @foreach($golongans as $golongan)
                        <option value="{{ $golongan->id_golongan }}" {{ (old('golongan_id', $obat->golongan_id) == $golongan->id_golongan) ? 'selected' : '' }}>
                            {{ $golongan->NamaGolongan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Penanda --}}
            <div class="form-group">
                <label>Penanda</label>
                <select name="penanda_id" class="form-control" required>
                    @foreach($penandas as $penanda)
                        <option value="{{ $penanda->id_penanda }}" {{ (old('penanda_id', $obat->penanda_id) == $penanda->id_penanda) ? 'selected' : '' }}>
                            {{ $penanda->nama_penanda }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Satuan --}}
            <div class="form-group">
                <label>Satuan</label>
                <select name="satuan_id" class="form-control" required>
                    @foreach($satuans as $satuan)
                        <option value="{{ $satuan->id_satuan }}" {{ (old('satuan_id', $obat->satuan_id) == $satuan->id_satuan) ? 'selected' : '' }}>
                            {{ $satuan->nama_satuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Isi dan Bobot --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Isi per Kemasan</label>
                    <input type="text" name="isi_kemasan" class="form-control" value="{{ old('isi_kemasan', explode(' / ', $obat->deskripsi)[0] ?? '') }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Bobot Isi</label>
                    <input type="text" name="bobot_isi" class="form-control" value="{{ old('bobot_isi', explode(' / ', $obat->deskripsi)[1] ?? '') }}">
                </div>
            </div>

            {{-- Harga dan Stok --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $obat->harga) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ old('stok', $obat->stok) }}">
                </div>
            </div>

            <hr>
            <h5>Lokasi Penyimpanan</h5>

            {{-- Dropdown Area --}}
<div class="form-group">
    <label>Area</label>
    <select name="area" class="form-control" required>
        <option value="">-- Pilih Area --</option>
        @foreach($areaOptions as $area)
            <option value="{{ $area }}" {{ old('area', $obat->lokasi->area ?? '') == $area ? 'selected' : '' }}>
                {{ $area }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-row">
    {{-- Dropdown Rak --}}
    <div class="form-group col-md-4">
        <label>Rak</label>
        <select name="rak" class="form-control" required>
            <option value="">-- Pilih Rak --</option>
            @foreach($rakOptions as $rak)
                <option value="{{ $rak }}" {{ old('rak', $obat->lokasi->rak ?? '') == $rak ? 'selected' : '' }}>
                    {{ $rak }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Dropdown Baris --}}
    <div class="form-group col-md-4">
        <label>Baris</label>
        <select name="baris" class="form-control" required>
            <option value="">-- Pilih Baris --</option>
            @foreach($barisOptions as $baris)
                <option value="{{ $baris }}" {{ old('baris', $obat->lokasi->baris ?? '') == $baris ? 'selected' : '' }}>
                    {{ $baris }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Dropdown Kolom --}}
    <div class="form-group col-md-4">
        <label>Kolom</label>
        <select name="kolom" class="form-control" required>
            <option value="">-- Pilih Kolom --</option>
            @foreach($kolomOptions as $kolom)
                <option value="{{ $kolom }}" {{ old('kolom', $obat->lokasi->kolom ?? '') == $kolom ? 'selected' : '' }}>
                    {{ $kolom }}
                </option>
            @endforeach
        </select>
    </div>
</div>


            {{-- Jika ingin edit lokasi manual (optional) --}}
            {{--
            <div class="form-group">
                <label>Area</label>
                <input type="text" name="area" class="form-control" value="{{ old('area', $obat->lokasi->area ?? '') }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Rak</label>
                    <input type="text" name="rak" class="form-control" value="{{ old('rak', $obat->lokasi->rak ?? '') }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Baris</label>
                    <input type="number" name="baris" class="form-control" value="{{ old('baris', $obat->lokasi->baris ?? '') }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Kolom</label>
                    <input type="number" name="kolom" class="form-control" value="{{ old('kolom', $obat->lokasi->kolom ?? '') }}">
                </div>
            </div>
            --}}

            {{-- Gambar --}}
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control-file">
                @if($obat->gambar)
                    <img src="{{ asset('storage/' . $obat->gambar) }}" alt="Obat Gambar" class="img-thumbnail mt-3" style="max-height:150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('dataobat') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
