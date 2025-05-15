<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dokter') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px; height: auto;">
        </div>
    </a>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pemeriksaan
    </div>

    <!-- Rawat Jalan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/rawatjalan') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rawat Jalan</span>
        </a>
    </li>

    <!-- Rawat Inap -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/rawatinap') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Rawat Inap</span>
        </a>
    </li>

    <!-- Pemeriksaan Narkotika dan Alkohol -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/narkotikaalkohol') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pemeriksaan Narkotika dan Alkohol</span>
        </a>
    </li>

    <!-- Kecelakaan Kerja -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/kecelakaankerja') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kecelakaan Kerja</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Surat Keterangan
    </div>

    <!-- Keterangan Berobat -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/keteranganberobat') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Keterangan Berobat</span>
        </a>
    </li>

    <!-- Pemeriksaan Kesehatan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/pemeriksaankesehatan') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Pemeriksaan Kesehatan</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

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
