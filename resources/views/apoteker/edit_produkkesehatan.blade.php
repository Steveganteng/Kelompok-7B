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

                {{-- Gambar --}}
                <div class="form-group">
                    <label for="gambar">Gambar Produk</label><br>
                    <img src="{{ asset('storage/gambar_produk/' . $produk->gambar) }}" alt="Gambar" width="100" class="mb-2" />
                    <input type="file" name="gambar" id="gambar" class="form-control-file" accept="image/*" />
                </div>

                {{-- Nama --}}
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required />
                </div>

                {{-- Satuan --}}
                <div class="form-group">
                    <label for="satuan_id">Satuan</label>
                    <select name="satuan_id" class="form-control" required>
                        <option value="">-- Pilih Satuan --</option>
                        @foreach ($satuans as $s)
                        <option value="{{ $s->id_satuan }}" {{ old('satuan_id', $produk->satuan_id) == $s->id_satuan ? 'selected' : '' }}>
                            {{ $s->nama_satuan }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Lokasi --}}
                <div class="form-group mb-3">
                    <label for="lokasi_id">Lokasi</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-control" required>
                        @foreach(\App\Models\Lokasi::all() as $lokasi)
                            <option value="{{ $lokasi->id_lokasi }}" {{ old('lokasi_id', $produk->lokasi_id) == $lokasi->id_lokasi ? 'selected' : '' }}>
                                {{ $lokasi->area }} - Rak {{ $lokasi->rak }}, Baris {{ $lokasi->baris }}, Kolom {{ $lokasi->kolom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" min="0" value="{{ old('stok', $produk->stok) }}" required />
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
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pv6U4bQz6pRU+gqg7B5/h4x0x8u+TbQlIVYohDXtTH8uR1h7ps6uZIlEBqQFjrAAIQ24JsLkP9LD0eyZc3Vx3Q=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>

    <!-- Bootstrap Bundle JS (CDN) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"
    ></script>

    <!-- jQuery Easing (CDN) -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
        integrity="sha512-0I5V+PHLQoNdlr8Tq1w34CN+3zOjFqM2wYtSRO96cjlX+QGxqW1R1oaB0rKXV5dPEP7z1xqEEf5QcXTRWltRdw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>

    <!-- SB Admin 2 JS (CDN) -->
    <script
        src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"
        crossorigin="anonymous"
    ></script>
</body>

</html>
