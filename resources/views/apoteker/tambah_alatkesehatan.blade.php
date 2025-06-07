<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Alat Kesehatan - Apotik Medicoal</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
</head>
<body id="page-top">
<div id="wrapper">
    @include('../layouts/navigation_apoteker')

    <div class="container mt-4">
        <h3>Tambah Alat Kesehatan</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alatkesehatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nama">Nama Alat</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required />
            </div>

            <div class="form-group mb-3">
                <label for="jenis">Jenis</label>
                <input type="text" name="jenis" id="jenis" class="form-control" value="{{ old('jenis') }}" required />
            </div>

            <div class="form-group mb-3">
                <label for="kode_alat">Kode Alat</label>
                <input type="text" name="kode_alat" id="kode_alat" class="form-control" value="{{ old('kode_alat') }}" required />
            </div>

            <div class="form-group mb-3">
                <label for="distributor_alat">Distributor Alat (Opsional)</label>
                <input type="text" name="distributor_alat" id="distributor_alat" class="form-control" value="{{ old('distributor_alat') }}" />
            </div>

            <div class="form-group mb-3">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required />
            </div>

            <div class="form-group mb-3">
                <label for="gambar">Gambar (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="form-control-file" />
            </div>

           {{-- Lokasi --}}
<div class="form-group">
    <label>Lokasi</label>
    <div class="form-row">

        <div class="col">
    <select name="area" class="form-control" required>
        <option value="">-- Pilih Area --</option>
        @foreach($areas as $area)
            <option value="{{ $area->area }}" {{ old('area', $produk->lokasi->area ?? '') == $area->area ? 'selected' : '' }}>
                {{ $area->area }}
            </option>
        @endforeach
    </select>
</div>

        <div class="col">
            <select name="rak" class="form-control" required>
                <option value="">-- Pilih Rak --</option>
                @foreach($raks as $rak)
                    <option value="{{ $rak->rak }}" {{ old('rak', $produk->lokasi->rak ?? '') == $rak->rak ? 'selected' : '' }}>
                        {{ $rak->rak }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select name="baris" class="form-control" required>
                <option value="">-- Pilih Baris --</option>
                @foreach($bariss as $baris)
                    <option value="{{ $baris->baris }}" {{ old('baris', $produk->lokasi->baris ?? '') == $baris->baris ? 'selected' : '' }}>
                        {{ $baris->baris }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select name="kolom" class="form-control" required>
                <option value="">-- Pilih Kolom --</option>
                @foreach($koloms as $kolom)
                    <option value="{{ $kolom->kolom }}" {{ old('kolom', $produk->lokasi->kolom ?? '') == $kolom->kolom ? 'selected' : '' }}>
                        {{ $kolom->kolom }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>
</div>

                    <!-- Kolom Dropdown -->
                    <div class="col">
                        <select name="kolom" class="form-control" required>
                            <option value="">-- Pilih Kolom --</option>
                            @foreach($koloms as $kolom)
                                <option value="{{ $kolom->kolom }}" {{ old('kolom') == $kolom->kolom ? 'selected' : '' }}>
                                    {{ $kolom->kolom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('alatkesehatan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</div>
</body>
</html>
