<!-- Sidebar -->
<nav class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard-apoteker') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px; height: auto;">
        </div>
    </a><br>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Operasional
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/resepobat') }}">
            <i class="fas fa-prescription-bottle-alt"></i>
            <span>Resep Obat</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/laporanproduk') }}">
            <i class="fas fa-file-medical"></i>
            <span>Laporan Produk Farmasi</span>
        </a>
    </li> --}}

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master Data
    </div>

<!-- Sidebar Menu Tanpa Collapse -->

<li class="nav-item">
    <a class="nav-link" href="{{ url('/dataobat') }}">
        <i class="fas fa-database"></i>
        <span>Data Obat</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('/produkkesehatan') }}">
        <i class="fas fa-medkit"></i>
        <span>Produk Kesehatan</span>
    </a>
</li>


    <li class="nav-item">
        <a class="nav-link" href="{{ url('/alatkesehatan') }}">
            <i class="fas fa-stethoscope"></i>
            <span>Alat Kesehatan</span>
        </a>
    </li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/golonganobat') }}">
        <i class="fas fa-tag"></i>
        <span>Golongan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/satuanobat') }}">
        <i class="fas fa-ruler"></i>
        <span>Satuan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/lokasiobat') }}">
        <i class="fas fa-map-marker-alt"></i>
        <span>Lokasi</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ url('/penandaobat') }}">
        <i class="fas fa-flag"></i>
        <span>Penanda</span>
    </a>
</li>

    {{-- <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manajemen Produk Farmasi
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/pengelolaanpembelian') }}">
            <i class="fas fa-pills"></i>
            <span>Pembelian Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/pengelolaanpeminjaman') }}">
            <i class="fas fa-hand-holding-medical"></i>
            <span>Peminjaman Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/adjustmentproduk') }}">
            <i class="fas fa-exchange-alt"></i>
            <span>Adjustment Produk</span>
        </a>
    </li> --}}

</nav>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span> --}}
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </button>
                            </form>

                        </div>
                    </li>


                </ul>

            </nav>
