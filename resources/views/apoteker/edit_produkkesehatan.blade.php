<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Produk Kesehatan</title>

    <!-- Font Awesome (CDN) -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet"
        integrity="sha512-papb8qpLu3zC5ujMtvazBddTZL44z1EL1ZwER5cMvmeNpo4Ufx9Z7iHk9RQbBY+xXc5QYAHXBJhvVTrQ4iBMug=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <!-- Google Fonts Nunito -->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900"
        rel="stylesheet"
    />

    <!-- SB Admin 2 CSS (CDN via jsDelivr) -->
    <link
        href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    />
</head>

<body id="page-top">

    <div id="wrapper">
        @include('../layouts/navigation_apoteker')

        <div class="container">
            <h1>Edit Produk Kesehatan</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('produkkesehatan.update', $produk->id_ProdukKesehatan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')



                {{-- Kode Produk --}}
                <div class="form-group">
                    <label for="kode_produkkesehatan">Kode Produk</label>
                    <input type="text" name="kode_produkkesehatan" id="kode_produkkesehatan" class="form-control"
                        value="{{ old('kode_produkkesehatan', $produk->kode_produkkesehatan) }}" required>
                </div>

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="nama_produkkesehatan">Nama Produk</label>
                    <input type="text" name="nama_produkkesehatan" id="nama_produkkesehatan" class="form-control"
                        value="{{ old('nama_produkkesehatan', $produk->nama_produkkesehatan) }}" required>
                </div>

                {{-- Golongan --}}
                <div class="form-group">
                    <label for="golongan_id">Golongan</label>
                    <select name="golongan_id" id="golongan_id" class="form-control" required>
                        @foreach ($golongans as $golongan)
                            <option value="{{ $golongan->id_golongan }}"
                                {{ old('golongan_id', $produk->golongan_id) == $golongan->id_golongan ? 'selected' : '' }}>
                                {{ $golongan->NamaGolongan }}
                            </option>
                        @endforeach
                    </select>
                </div>



                {{-- Satuan --}}
                <div class="form-group">
                    <label for="satuan_id">Satuan</label>
                    <select name="satuan_id" id="satuan_id" class="form-control" required>
                        @foreach ($satuans as $satuan)
                            <option value="{{ $satuan->id_satuan }}"
                                {{ old('satuan_id', $produk->satuan_id) == $satuan->id_satuan ? 'selected' : '' }}>
                                {{ $satuan->nama_satuan }}
                            </option>
                        @endforeach
                    </select>
                </div>

              <div class="form-group">
    <label>Lokasi</label>
    <div class="form-row">

        <div class="col">
            <select name="area" class="form-control" required>
                <option value="">-- Pilih Area --</option>
                @foreach($areas as $area)
                    <option value="{{ $area->area }}" {{ (old('area') ?? $produk->lokasi->area) == $area->area ? 'selected' : '' }}>
                        {{ $area->area }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select name="rak" class="form-control" required>
                <option value="">-- Pilih Rak --</option>
                @foreach($raks as $rak)
                    <option value="{{ $rak->rak }}" {{ (old('rak') ?? $produk->lokasi->rak) == $rak->rak ? 'selected' : '' }}>
                        {{ $rak->rak }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select name="baris" class="form-control" required>
                <option value="">-- Pilih Baris --</option>
                @foreach($bariss as $baris)
                    <option value="{{ $baris->baris }}" {{ (old('baris') ?? $produk->lokasi->baris) == $baris->baris ? 'selected' : '' }}>
                        {{ $baris->baris }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <select name="kolom" class="form-control" required>
                <option value="">-- Pilih Kolom --</option>
                @foreach($koloms as $kolom)
                    <option value="{{ $kolom->kolom }}" {{ (old('kolom') ?? $produk->lokasi->kolom) == $kolom->kolom ? 'selected' : '' }}>
                        {{ $kolom->kolom }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>
</div>



                {{-- Stok --}}
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" min="0"
                        value="{{ old('stok', $produk->stok) }}" required />
                </div>
<!-- Harga (field baru yang ditambahkan) -->
<div class="form-group">
    <label for="harga">Harga</label>
    <input type="number" name="harga" id="harga" class="form-control" min="0"
        value="{{ old('harga', $produk->harga) }}" required />
</div>
 {{-- Gambar --}}
                <div class="form-group">
                    <label for="gambar">Gambar Produk</label><br>
                    <img src="{{ asset('storage/gambar_produk/' . $produk->gambar) }}" alt="Gambar" width="100" class="mb-2" />
                    <input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*" />
                </div>
                <button type="submit" class="btn btn-primary">Update Produk</button>
                <a href="{{ route('produkkesehatan.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white mt-5">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Apotik Medicoal {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JS -->

    <!-- jQuery (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pv6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap Bundle JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <!-- jQuery Easing (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
        integrity="sha512-0I5V+PHLQoNdlr8Tq1w34CN+3zOjFqM2wYtSRO96cjlX+QGxqW1R1oaB0rKXV5dPEP7z1xqEEf5QcXTRWltRdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SB Admin 2 JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
