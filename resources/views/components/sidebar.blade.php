@if (
    (Auth::check() && Auth::user()->role == 'super_admin') ||
        (Auth::check() && Auth::user()->role == 'admin') ||
        (Auth::check() && Auth::user()->role == 'user'))
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="z-index: 2">
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
            @if (Auth::check() && Auth::user()->role == 'super_admin')
                <!-- Data Master -->
                <li class="menu-item {{ request()->is('data-master*') || request()->is('users*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div data-i18n="Layouts">Data Master</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('data-master/category*') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}" class="menu-link">
                                <div data-i18n="Without navbar">Kategori</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('data-master/sub-category*') ? 'active' : '' }}">
                            <a href="{{ route('sub-category.index') }}" class="menu-link">
                                <div data-i18n="Container">Sub Kategori</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('data-master/location*') ? 'active' : '' }}">
                            <a href="{{ route('location.index') }}" class="menu-link">
                                <div data-i18n="Blank">Lokasi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('data-master/specific-location*') ? 'active' : '' }}">
                            <a href="{{ route('special-location.index') }}" class="menu-link">
                                <div data-i18n="Blank">Sub Lokasi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('data-master/unit*') ? 'active' : '' }}">
                            <a href="{{ route('unit.index') }}" class="menu-link">
                                <div data-i18n="Blank">Unit</div>
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
            @endif

            <!-- Data Asset -->
            <li class="menu-item {{ request()->is('data-asset*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div data-i18n="Layouts">
                        @if ((Auth::check() && Auth::user()->role == 'super_admin') || (Auth::check() && Auth::user()->role == 'admin'))
                            Data Asset
                        @elseif (Auth::check() && Auth::user()->role == 'user')
                            Monitoring
                        @endif
                    </div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('data-assets/fixed*') ? 'active' : '' }}">
                        <a href="{{ route('asset-fixed.index') }}" class="menu-link">
                            <div data-i18n="Without menu">Data Aset Tetap</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ request()->is('report*') ? 'active' : '' }}">
                <a href="{{ route('report.index') }}" class="menu-link">
                    <div data-i18n="Container"><i class="menu-icon tf-icons bx bx-file"></i>Laporan</div>
                </a>
            </li>
        </ul>
    </aside>
@endif
