<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo border-bottom">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/avatars/unila.png') }}" alt class="w-px-40 h-auto rounded-circle" />
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Inventory</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    {{-- <hr> --}}
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-3">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Data Master -->
        <li class="menu-item {{ request()->is('data-master*') || request()->is('users*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Data Master</div>
            </a>
            <ul class="menu-sub">
                {{-- <li class="menu-item {{ request()->is('goods-main*') ? 'active' : '' }}">
                    <a href="{{ route('goods.main.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Barang</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ request()->is('data-master/category*') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Kategori Barang</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('data-master/sub-category*') ? 'active' : '' }}">
                    <a href="{{ route('sub-category.index') }}" class="menu-link">
                        <div data-i18n="Container">Sub Kategori</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ request()->is('goods-brand*') ? 'active' : '' }}">
                    <a href="{{ route('goods.brand.index') }}" class="menu-link">
                        <div data-i18n="Fluid">Merek</div>
                    </a>
                </li> --}}
                {{-- <li class="menu-item {{ request()->is('goods-unit') ? 'active' : '' }}">
                    <a href="{{ route('goods.unit.index') }}" class="menu-link">
                        <div data-i18n="Fluid">Satuan</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ request()->is('data-master/location*') ? 'active' : '' }}">
                    <a href="{{ route('location.index') }}" class="menu-link">
                        <div data-i18n="Blank">Lokasi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('data-master/special*') ? 'active' : '' }}">
                    <a href="{{ route('special-location.index') }}" class="menu-link">
                        <div data-i18n="Blank">Lokasi Khusus</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('data-master/division*') ? 'active' : '' }}">
                    <a href="{{ route('division.index') }}" class="menu-link">
                        <div data-i18n="Blank">Divisi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('data-master/procurement*') ? 'active' : '' }}">
                    <a href="{{ route('procurement.index') }}" class="menu-link">
                        <div data-i18n="Blank">Pengadaan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('data-master/user*') ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="menu-link">
                        <div data-i18n="Blank">User</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Data Asset -->
        <li class="menu-item {{ request()->is('data-asset*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Data Asset</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('data-assets/fixed*') ? 'active' : '' }}">
                    <a href="{{ route('asset-fixed.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Tetap</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ request()->is('asset-moved*') ? 'active' : '' }}">
                    <a href="{{ route('asset-moved.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Berjalan</div>
                    </a>
                </li> --}}
            </ul>
        </li>

        {{-- Monitoring --}}
        <li class="menu-item {{ request()->is('monitoring*') ? 'active' : '' }}">
            <a href="{{ route('monitoring.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-data"></i>
                <div data-i18n="Analytics">Monitoring</div>
            </a>
        </li>
        {{-- Monitoring --}}

        {{-- Laporan --}}
        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Layouts">Laporan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('asset-fixed.index') }}" class="menu-link">
                        <div data-i18n="Without menu">Tetap</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('asset-moved.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">Berjalan</div>
                    </a>
                </li>
            </ul>
        </li> --}}
        <li class="menu-item {{ request()->is('report*') ? 'active' : '' }}">
            <a href="{{ route('report.index') }}" class="menu-link">
                <div data-i18n="Container"><i class="menu-icon tf-icons bx bx-file"></i>Laporan</div>
            </a>
        </li>
        {{-- Laporan --}}

        {{-- <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-data"></i>
                <div data-i18n="Layouts">Monitoring</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="layouts-without-menu.html" class="menu-link">
                        <div data-i18n="Without menu">Aset Tetap</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="layouts-without-navbar.html" class="menu-link">
                        <div data-i18n="Without navbar">Aset Berjalan</div>
                    </a>
                </li>
            </ul>
        </li> --}}
        <!-- Monitoring end -->
    </ul>
</aside>
