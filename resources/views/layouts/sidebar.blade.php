<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                @php
                    $nameParts = explode(' ', Auth::user()->name);
                    $firstInitial = strtoupper(substr($nameParts[0], 0, 1)); // Inisial nama depan
                    $lastInitial = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : ''; // Inisial nama belakang (jika ada)
                @endphp
                {{ $firstInitial }}{{ $lastInitial }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Pages</li>
            <li class="dropdown {{ Route::currentRouteName() == 'karyawan.index' ? 'active' : '' }}">
                <a href="{{ route('karyawan.index') }}" class="nav-link "><i class="far fa-user"></i>
                    <span>Karyawan</span></a>
            </li>
            <li class="dropdown {{ Route::currentRouteName() == 'absensi.index' ? 'active' : '' }}">
                <a href="{{ route('absensi.index') }}" class="nav-link"><i class="fas fa-book"></i>
                    <span>Absensi</span></a>

            </li>
            <li class="dropdown {{ Route::currentRouteName() == 'gaji.index' ? 'active' : '' }}">
                <a href="{{ route('gaji.index') }}" class="nav-link"><i class="fas fa-money-bill"></i>
                    <span>Gaji</span></a>

            </li>
            <li class="dropdown">
                <a href="{{ route('laporan') }}" class="nav-link"><i class="fas fa-file"></i>
                    <span>Laporan</span></a>

            </li>

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success btn-lg btn-block btn-icon-split"> <i
                        class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </aside>
</div>
