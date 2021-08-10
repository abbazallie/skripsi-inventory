<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">SMA DARUNNAJAH</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">DN</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="nav-item @if(Route::is('barang.*')) active @endif">
                <a href="{{ route('barang.index') }}" class="nav-link"><i class="fas fa-th"></i> <span>Data Asset</span></a>
            </li>

            <li class="nav-item @if(Route::is('kategori.*')) active @endif">
                <a href="{{ route('kategori.index') }}" class="nav-link"><i class="fas fa-object-ungroup"></i> <span>Kategori</span></a>
            </li>
            <li class="nav-item @if(Route::is('kerusakan.*')) active @endif">
                <a href="{{ route('kerusakan.index') }}" class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Asset Rusak</span></a>
            </li>
            <li class="nav-item @if(Route::is('peminjaman.*')) active @endif">
                <a href="{{ route('peminjaman.index') }}" class="nav-link"><i class="fas fa-hands-helping"></i> <span>Peminjaman</span></a>
            </li>
            <li class="nav-item @if(Route::is('user.*')) active @endif">
                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-users-cog"></i> <span>User Management</span></a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="forms-advanced-form.html">Data Asset</a></li>
                    <li><a class="nav-link" href="forms-editor.html">Peminjaman Asset</a></li>
                    <li><a class="nav-link" href="forms-validation.html">Asset Rusak</a></li>
                </ul>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="#" class="btn btn-danger btn-lg btn-block">
                 <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>
    </aside>
</div>
