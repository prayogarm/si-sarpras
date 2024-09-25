<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="http://127.0.0.1:8000/dist/img/logo.png"
                style="float: left;max-height: 45px;width: auto;"
                class="brand-image img-circle" style="opacity: .9"
            >
        </div>
        <div class="sidebar-brand-text mx-3">SI-SARPRAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @role('Admin')
        <li class="nav-item {{ request()->is('barang') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('barang.index') }}">
                <i class="fas fa-fw fa-tools"></i>
                <span>Data Barang</span></a>
        </li>
        <li class="nav-item {{ request()->is('admin/peminjaman') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.peminjaman') }}">
                <i class="fas fa-fw fa-arrow-left"></i>
                <span>Data Peminjaman</span></a>
        </li>
        <li class="nav-item {{ request()->is('admin/pengembalian') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.pengembalian') }}">
                <i class="fas fa-fw fa-arrow-right"></i>
                <span>Data Pengembalian</span></a>
        </li>
        <li class="nav-item {{ request()->is('admin/users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pengguna</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-book"></i>
                <span>Data Laporan</span>
            </a>
            <div id="collapseTwo" class="collapse {{ request()->is('admin/laporan/peminjaman') ? 'show' : '' }} {{ request()->is('admin/laporan/pengembalian') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Cetak Data Laporan:</h6>
                    <a class="collapse-item {{ request()->is('admin/laporan/peminjaman') ? 'active' : '' }}" href="{{ route('admin.laporan.peminjaman') }}">Laporan Peminjam</a>
                    <a class="collapse-item {{ request()->is('admin/laporan/pengembalian') ? 'active' : '' }}" href="{{ route('admin.laporan.pengembalian') }}">Laporan Pengembalian</a>
                </div>
            </div>
        </li>
    @endrole

    @hasanyrole('Guru|Siswa|Pengawas')
        <li class="nav-item {{ request()->is('pengajuann.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route ('pengajuann.index')}}">
                <i class="fas fa-fw fa-arrow-right"></i>
                <span>Ajukan Peminjaman</span></a>
        </li>
        <li class="nav-item {{ request()->is('pengembalian.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route ('pengembalian.index')}}">
                <i class="fas fa-fw fa-arrow-left"></i>
                <span>Ajukan Pengembalian</span></a>
        </li>
    @endhasanyrole
    
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>