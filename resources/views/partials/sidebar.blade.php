<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">40 Library</a>
        </div>
        {{-- <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div> --}}
        <ul class="sidebar-menu">
            {{-- menu admin --}}
            @if (auth()->user()->role === 'admin')
                <li class="menu-header">Menu Admin</li>
                <li class="@if (request()->segment(1) === 'dashboard-admin') active @endif"><a class="nav-link" href="/dashboard-admin">
                        <i class="fas fa-grip-horizontal"></i>
                        <span>Dashboard</span>
                    </a></li>
                <li class="dropdown @if (request()->segment(1) === 'users-management') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                        <span>Manajemen Pengguna</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="/users-management"
                                @if (request()->segment(1) === 'users-management') style="color: #6777ef;" @endif>Data Pengguna</a></li>
                        <li><a class="nav-link" href="/users-management-create"
                                @if (request()->segment(1) === 'users-management-create') style="color: #6777ef;" @endif>Tambah Pengguna</a>
                        </li>
                        <li><a class="nav-link" href="/users-management-application"
                                @if (request()->segment(1) === 'users-management-application') style="color: #6777ef;" @endif>Daftar Pengajuan</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown @if (request()->segment(1) === 'books-management') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i>
                        <span>Manajemen Buku</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="/books-management"
                                @if (request()->segment(1) === 'books-management' && request()->segment(2) != 'create') style="color: #6777ef;" @endif>Kelola Buku</a></li>
                        <li><a class="nav-link" href="/books-management/create"
                                @if (request()->segment(1) === 'books-management' && request()->segment(2) === 'create') style="color: #6777ef;" @endif>Tambah Buku</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown @if (request()->segment(1) === 'categories-management') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-book-reader"></i>
                        <span>Manajemen Kategori</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="/categories-management"
                                @if (request()->segment(1) === 'categories-management' && request()->segment(2) != 'create') style="color: #6777ef;" @endif>Kelola Kategori</a>
                        </li>
                        <li><a class="nav-link" href="/categories-management/create"
                                @if (request()->segment(1) === 'categories-management' && request()->segment(2) === 'create') style="color: #6777ef;" @endif>Tambah Kategori</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown @if (request()->segment(1) === 'bookings-management') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-address-book"></i>
                        <span>Peminjaman Buku</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="/bookings-management"
                                @if (request()->segment(1) === 'bookings-management' && request()->segment(2) != 'create') style="color: #6777ef;" @endif>Kelola
                                Peminjaman</a>
                        </li>
                        <li><a class="nav-link" href="/bookings-management/create"
                                @if (request()->segment(1) === 'bookings-management' && request()->segment(2) === 'create') style="color: #6777ef;" @endif>Tambah
                                Peminjaman</a>
                        </li>
                    </ul>
                </li>
            @endif
            {{-- end of admin --}}
            {{-- menu member --}}
            @if (auth()->user()->role === 'member')
                <li class="menu-header">Menu Member</li>
                <li class="@if (request()->segment(1) === 'dashboard-member') active @endif"><a class="nav-link"
                        href="/dashboard-member">
                        <i class="fas fa-grip-horizontal"></i>
                        <span>Dashboard</span>
                    </a></li>
            @endif
            {{-- end of member --}}
            {{-- menu librarian --}}
            @if (auth()->user()->role === 'librarian')
                <li class="menu-header">Menu Pustakawan</li>
                <li class="@if (request()->segment(1) === 'dashboard-librarian') active @endif"><a class="nav-link"
                        href="/dashboard-librarian">
                        <i class="fas fa-grip-horizontal"></i>
                        <span>Dashboard</span>
                    </a></li>
                <li class="dropdown @if (request()->segment(1) === 'bookings-management') active @endif">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-address-book"></i>
                        <span>Peminjaman Buku</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="/bookings-management"
                                @if (request()->segment(1) === 'bookings-management' && request()->segment(2) != 'create') style="color: #6777ef;" @endif>Kelola
                                Peminjaman</a>
                        </li>
                        <li><a class="nav-link" href="/bookings-management/create"
                                @if (request()->segment(1) === 'bookings-management' && request()->segment(2) === 'create') style="color: #6777ef;" @endif>Tambah
                                Peminjaman</a>
                        </li>
                    </ul>
                </li>
            @endif
            {{-- end of librarian --}}
            {{-- <li class="dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class=active><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                    <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul>
            </li> --}}
            {{-- <li class="menu-header">Starter</li> --}}
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank
                        Page</span></a></li> --}}
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
