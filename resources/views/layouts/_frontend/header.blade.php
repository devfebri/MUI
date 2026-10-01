{{-- ── TOPBAR ──────────────────────────────────────────────────── --}}
<div class="vb-topbar">
    <div class="vb-topbar-inner">
        <div class="vb-topbar-date">
            <i class="fas fa-calendar-alt"></i>
            <span id="topbar-date"></span>
        </div>
        <div class="vb-prayer-pills" id="headerPrayerPills" title="Jadwal Sholat (Otomatis berdasarkan lokasi)">
            <span class="vb-prayer-pill" data-prayer="Subuh"><b>Subuh</b> <span class="prayer-time">04:37</span></span>
            <span class="vb-prayer-pill" data-prayer="Dzuhur"><b>Dzuhur</b> <span class="prayer-time">11:58</span></span>
            <span class="vb-prayer-pill" data-prayer="Ashar"><b>Ashar</b> <span class="prayer-time">15:02</span></span>
            <span class="vb-prayer-pill" data-prayer="Maghrib"><b>Maghrib</b> <span class="prayer-time">18:02</span></span>
            <span class="vb-prayer-pill" data-prayer="Isya"><b>Isya</b> <span class="prayer-time">19:10</span></span>
        </div>
        <div class="vb-topbar-login">
            @auth
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}">
                    <i class="fas fa-user-circle"></i> Login
                </a>
            @endauth
        </div>
    </div>
</div>

{{-- ── MAINBAR ──────────────────────────────────────────────────── --}}
<div class="vb-mainbar">
    <div class="vb-mainbar-inner">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="vb-logo">
            <div class="vb-logo-icon">
                <svg width="22" height="22" viewBox="0 0 28 28" fill="none">
                    <polygon
                        points="14,2 16.9,10.5 26,10.5 18.6,15.9 21.5,24.4 14,19 6.5,24.4 9.4,15.9 2,10.5 11.1,10.5"
                        fill="#c9a84c" />
                    <polygon
                        points="14,6 15.8,11.5 21.5,11.5 17,14.7 18.8,20.2 14,17 9.2,20.2 11,14.7 6.5,11.5 12.2,11.5"
                        fill="#fff" opacity=".7" />
                </svg>
            </div>
            <div>
                <span class="vb-logo-name">MUI<em>Batanghari</em></span>
                <span class="vb-logo-sub">Majelis Ulama Indonesia</span>
            </div>
        </a>

        {{-- Search --}}
        <form class="vb-search" role="search" action="{{ route('berita.list') }}" method="GET">
            <i class="fas fa-search vb-search-icon"></i>
            <input type="search" name="q" class="vb-search-input" placeholder="Cari berita, fatwa, atau topik..."
                autocomplete="off">
        </form>

        {{-- CTA Desktop --}}
        <a href="{{ route('tanya-ulama') }}" class="vb-cta">
            <i class="fas fa-comments"></i> Konsultasi
        </a>

        {{-- Hamburger Mobile --}}
        <button class="vb-hamburger" id="hamburgerBtn" aria-label="Menu" aria-expanded="false">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</div>

{{-- ── NAVBAR (Desktop) ────────────────────────────────────────── --}}
<nav class="vb-nav" id="desktopNav" aria-label="Navigasi utama">
    <div class="vb-nav-inner">
        <div class="vb-nav-item has-children">
            <a href="#"
                class="vb-nav-link {{ request()->routeIs('profilemui', 'visi-misi', 'struktur-organisasi', 'kontak') ? 'active' : '' }}">
                <span>Tentang Kami</span><span class="vb-nav-caret"></span>
            </a>
            <div class="vb-submenu">
                <a href="{{ route('profilemui') }}"
                    class="vb-nav-link {{ request()->routeIs('profilemui') ? 'active' : '' }}">Profil MUI</a>
                <a href="{{ route('visi-misi') }}"
                    class="vb-nav-link {{ request()->routeIs('visi-misi') ? 'active' : '' }}">Visi Misi</a>
                <a href="{{ route('struktur-organisasi') }}"
                    class="vb-nav-link {{ request()->routeIs('struktur-organisasi') ? 'active' : '' }}">Struktur
                    Organisasi</a>
                <a href="{{ route('kontak') }}"
                    class="vb-nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            </div>
        </div>
        <div class="vb-nav-item">
            <a href="{{ route('berita.list') }}"
                class="vb-nav-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                <span>Berita</span>
            </a>
        </div>
        <div class="vb-nav-item has-children">
            <a href="#"
                class="vb-nav-link {{ request()->routeIs('fatwa*', 'surat*') ? 'active' : '' }}"><span>Arsip</span><span
                    class="vb-nav-caret"></span></a>
            <div class="vb-submenu">
                <a href="{{ route('surat') }}"
                    class="vb-nav-link {{ request()->routeIs('surat*') ? 'active' : '' }}">Surat</a>
                <a href="{{ route('fatwa') }}"
                    class="vb-nav-link {{ request()->routeIs('fatwa*') ? 'active' : '' }}">Fatwa</a>
            </div>
        </div>
        <div class="vb-nav-item"><a href="{{ route('konsultasi.list') }}"
                class="vb-nav-link {{ request()->routeIs('konsultasi.*') ? 'active' : '' }}"><span>Konsultasi</span></a>
        </div>

        {{-- <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Donasi</span></a></div> --}}
    </div>
</nav>


{{-- ── MOBILE DRAWER ────────────────────────────────────────────── --}}
<div class="vb-drawer-overlay" id="drawerOverlay"></div>
<div class="vb-drawer" id="mobileDrawer" role="dialog" aria-modal="true" aria-label="Menu navigasi">

    {{-- Header drawer --}}
    <div class="vb-drawer-head">
        <div class="vb-drawer-logo">
            <div
                style="width:32px;height:32px;background:rgba(255,255,255,.15);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="18" height="18" viewBox="0 0 28 28" fill="none">
                    <polygon
                        points="14,2 16.9,10.5 26,10.5 18.6,15.9 21.5,24.4 14,19 6.5,24.4 9.4,15.9 2,10.5 11.1,10.5"
                        fill="#c9a84c" />
                </svg>
            </div>
            <div>
                <div class="vb-drawer-logo-name">MUI<em>Batanghari</em></div>
                <span class="vb-drawer-logo-sub">Majelis Ulama Indonesia</span>
            </div>
        </div>
        <button class="vb-drawer-close" id="drawerClose" aria-label="Tutup menu">
            <i class="fas fa-times"></i>
        </button>
    </div>

    {{-- Search inside drawer --}}
    <div class="vb-drawer-search">
        <form action="{{ route('berita.list') }}" method="GET">
            <i class="fas fa-search"></i>
            <input type="search" name="q" placeholder="Cari berita, fatwa...">
        </form>
    </div>

    {{-- Menu items --}}
    <div class="vb-drawer-menu">
        <div class="vb-drawer-item">
            <a href="{{ url('/') }}" class="vb-drawer-link {{ request()->is('/') ? 'active' : '' }}">
                <span><i class="fas fa-home"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Beranda</span>
            </a>
        </div>
        <div
            class="vb-drawer-item has-sub {{ request()->routeIs('profilemui', 'visi-misi', 'struktur-organisasi', 'kontak') ? 'expanded' : '' }}">
            <div class="vb-drawer-link" role="button" tabindex="0">
                <span><i class="fas fa-info-circle"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Tentang Kami</span>
                <i class="fas fa-chevron-right vb-drawer-caret"></i>
            </div>
            <div class="vb-drawer-sub">
                <a href="{{ route('profilemui') }}"
                    class="vb-drawer-sublink {{ request()->routeIs('profilemui') ? 'active' : '' }}">Profil MUI</a>
                <a href="{{ route('visi-misi') }}"
                    class="vb-drawer-sublink {{ request()->routeIs('visi-misi') ? 'active' : '' }}">Visi Misi</a>
                <a href="{{ route('struktur-organisasi') }}"
                    class="vb-drawer-sublink {{ request()->routeIs('struktur-organisasi') ? 'active' : '' }}">Struktur
                    Organisasi</a>
                <a href="{{ route('kontak') }}"
                    class="vb-drawer-sublink {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
            </div>
        </div>
        <div class="vb-drawer-item">
            <a href="{{ route('berita.list') }}"
                class="vb-drawer-link {{ request()->routeIs('berita.*') ? 'active' : '' }}">
                <span><i class="fas fa-newspaper"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Berita</span>
            </a>
        </div>
        <div class="vb-drawer-item has-sub {{ request()->routeIs('fatwa*', 'surat*') ? 'expanded' : '' }}">
            <div class="vb-drawer-link" role="button" tabindex="0">
                <span><i class="fas fa-archive"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Arsip</span>
                <i class="fas fa-chevron-right vb-drawer-caret"></i>
            </div>
            <div class="vb-drawer-sub">
                <a href="{{ route('surat') }}"
                    class="vb-drawer-sublink {{ request()->routeIs('surat*') ? 'active' : '' }}">Arsip Surat</a>
                <a href="{{ route('fatwa') }}"
                    class="vb-drawer-sublink {{ request()->routeIs('fatwa*') ? 'active' : '' }}">Fatwa MUI</a>
                <a href="#" class="vb-drawer-sublink">Fatwa DSN MUI</a>
            </div>
        </div>
        <div class="vb-drawer-item">
            <a href="{{ route('konsultasi.list') }}"
                class="vb-drawer-link {{ request()->routeIs('konsultasi.*') ? 'active' : '' }}">
                <span><i class="fas fa-comments"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Konsultasi</span>
            </a>
        </div>
        <div class="vb-drawer-item">
            <a href="#" class="vb-drawer-link">
                <span><i class="fas fa-mosque" style="width:18px;color:var(--green);margin-right:8px;"></i>Da'i</span>
            </a>
        </div>
        <div class="vb-drawer-item">
            <a href="#" class="vb-drawer-link">
                <span><i class="fas fa-microphone"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Khutbah</span>
            </a>
        </div>
        <div class="vb-drawer-item">
            <a href="#" class="vb-drawer-link">
                <span><i class="fas fa-check-circle"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Halal</span>
            </a>
        </div>
        <div class="vb-drawer-item">
            <a href="#" class="vb-drawer-link">
                <span><i class="fas fa-map-marker-alt"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Kabar Daerah</span>
            </a>
        </div>
        {{-- <div class="vb-drawer-item">
            <a href="#" class="vb-drawer-link">
                <span><i class="fas fa-heart"
                        style="width:18px;color:var(--green);margin-right:8px;"></i>Donasi</span>
            </a>
        </div> --}}
    </div>

    {{-- Drawer footer CTA --}}
    <div class="vb-drawer-footer">
        @auth
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Panel Dashboard
            </a>
        @else
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard
            </a>
        @endauth
    </div>
</div>
