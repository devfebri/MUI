{{-- ============================================================
     SIDEBAR — MUI DIGITAL | ISLAMIC PROFESSIONAL THEME
     ============================================================ --}}

{{-- ── LOGO AREA ─────────────────────────────────────────────── --}}
<div class="mui-brand">
    <a href="{{ route('home.public') }}" class="mui-brand-link">
        <div class="mui-brand-icon" style="background: #ffffff; border-radius: 50%; padding: 2px;">
            <img src="{{ asset('gambar/mui.png') }}" alt="Logo MUI"
                style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div class="mui-brand-text">
            <span class="mui-brand-name">MUI <em>Batanghari</em></span>
            <span class="mui-brand-sub">Majelis Ulama Indonesia</span>
        </div>
    </a>
</div>

{{-- ── GOLD DIVIDER ───────────────────────────────────────────── --}}
<div class="mui-gold-divider">
    <span></span><span class="star">❖</span><span></span>
</div>

{{-- ── USER MINI CARD ─────────────────────────────────────────── --}}
<div class="mui-user-card">
    <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 11px; text-decoration: none; width: 100%; color: inherit;">
        <div class="mui-user-avatar" style="overflow: hidden;">
            @if(auth()->user()->foto_url)
                <img src="{{ auth()->user()->foto_url }}" alt="{{ auth()->user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="mui-user-info">
            <div class="mui-user-name">{{ auth()->user()->name }}</div>
            <div class="mui-user-role">
                <span class="mui-role-dot"></span>
                {{ ucfirst(auth()->user()->role) }}
            </div>
        </div>
    </a>
</div>

{{-- ── NAVIGATION ─────────────────────────────────────────────── --}}
@php $route = request()->route()->getName(); @endphp

<nav class="mui-nav">

    @if (auth()->user()->isAdmin())
        {{-- ADMIN --}}
        <div class="mui-nav-section">Panel Admin</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="mui-nav-link {{ $route === 'admin.dashboard' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-view-dashboard"></i></span>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.users') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-account-multiple"></i></span>
                    <span class="nav-label">Pengguna</span>
                </a>
            </li>
        </ul>

        <div class="mui-nav-section">Konten</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('admin.berita.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.berita') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-newspaper"></i></span>
                    <span class="nav-label">Berita & Artikel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kategori.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.kategori.') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-tag-multiple"></i></span>
                    <span class="nav-label">Kategori</span>
                </a>
            </li>


        </ul>
        <div class="mui-nav-section">Arsip</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('admin.surat.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.surat') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-email-outline"></i></span>
                    <span class="nav-label">Surat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.fatwa.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.fatwa') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-book-open-variant"></i></span>
                    <span class="nav-label">Fatwa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kategori-fatwa.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.kategori-fatwa') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-label-outline"></i></span>
                    <span class="nav-label">Kategori Fatwa</span>
                </a>
            </li>
        </ul>

        <div class="mui-nav-section">Layanan</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('admin.livechat.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.livechat') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-chat-processing-outline"></i></span>
                    <span class="nav-label">Live Chat</span>
                    @php
                        $waitingChatCount = \App\Models\ChatSession::where('status', 'menunggu')->count();
                    @endphp
                    @if ($waitingChatCount > 0)
                        <span class="badge ml-auto"
                            style="background:#f59e0b; color:#1e293b; font-weight:700; font-size:11px; border-radius:10px; padding:2px 7px;">
                            {{ $waitingChatCount }}
                        </span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.konsultasi.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.konsultasi') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-forum"></i></span>
                    <span class="nav-label">Konsultasi</span>
                    @php
                        $pendingKonsultasi = \App\Models\Konsultasi::where('status', 'pending')->count();
                    @endphp
                    @if ($pendingKonsultasi > 0)
                        <span class="badge ml-auto"
                            style="background:#eab308; color:#1e293b; font-weight:700; font-size:11px; border-radius:10px; padding:2px 7px;">
                            {{ $pendingKonsultasi }}
                        </span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="mui-nav-section">Sistem</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'profile.') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-account-cog"></i></span>
                    <span class="nav-label">Profil Akun</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pengaturan.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.pengaturan') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-cog-outline"></i></span>
                    <span class="nav-label">Pengaturan Web</span>
                </a>
            </li>
        </ul>
    @elseif(auth()->user()->isOperator())
        {{-- OPERATOR --}}
        <div class="mui-nav-section">Panel Operator</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('operator.dashboard') }}"
                    class="mui-nav-link {{ $route === 'operator.dashboard' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-view-dashboard"></i></span>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
        </ul>

        <div class="mui-nav-section">Konten</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('operator.berita.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'operator.berita') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-newspaper"></i></span>
                    <span class="nav-label">Berita & Artikel</span>
                </a>
            </li>
            <li>
                <a href="#" class="mui-nav-link">
                    <span class="nav-icon"><i class="mdi mdi-tag-multiple"></i></span>
                    <span class="nav-label">Kategori</span>
                </a>
            </li>
            <li>
                <a href="#" class="mui-nav-link">
                    <span class="nav-icon"><i class="mdi mdi-image-multiple"></i></span>
                    <span class="nav-label">Media</span>
                </a>
            </li>
        </ul>
        <div class="mui-nav-section">Arsip</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('operator.surat.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'operator.surat') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-email-outline"></i></span>
                    <span class="nav-label">Surat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.fatwa.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'operator.fatwa') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-book-open-variant"></i></span>
                    <span class="nav-label">Fatwa</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.kategori-fatwa.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'operator.kategori-fatwa') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-label-outline"></i></span>
                    <span class="nav-label">Kategori Fatwa</span>
                </a>
            </li>
        </ul>

        <div class="mui-nav-section">Layanan</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('admin.livechat.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'admin.livechat') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-chat-processing-outline"></i></span>
                    <span class="nav-label">Live Chat</span>
                    @php
                        $waitingChatCount = \App\Models\ChatSession::where('status', 'menunggu')->count();
                    @endphp
                    @if ($waitingChatCount > 0)
                        <span class="badge ml-auto"
                            style="background:#f59e0b; color:#1e293b; font-weight:700; font-size:11px; border-radius:10px; padding:2px 7px;">
                            {{ $waitingChatCount }}
                        </span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('operator.konsultasi.index') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'operator.konsultasi') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-forum"></i></span>
                    <span class="nav-label">Konsultasi</span>
                    @php
                        $pendingKonsultasi = \App\Models\Konsultasi::where('status', 'pending')->count();
                    @endphp
                    @if ($pendingKonsultasi > 0)
                        <span class="badge ml-auto"
                            style="background:#eab308; color:#1e293b; font-weight:700; font-size:11px; border-radius:10px; padding:2px 7px;">
                            {{ $pendingKonsultasi }}
                        </span>
                    @endif
                </a>
            </li>
        </ul>

        <div class="mui-nav-section">Sistem</div>
        <ul class="mui-nav-list">
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="mui-nav-link {{ str_starts_with($route, 'profile.') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="mdi mdi-account-cog"></i></span>
                    <span class="nav-label">Profil Akun</span>
                </a>
            </li>
        </ul>
    @endif

</nav>

{{-- ── SIDEBAR FOOTER ─────────────────────────────────────────── --}}
<div class="mui-sidebar-footer">
    <div class="mui-footer-bismillah">بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيم</div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="mui-logout-btn">
            <i class="mdi mdi-logout-variant"></i>
            <span>Keluar</span>
        </button>
    </form>
</div>

{{-- ── SIDEBAR CSS ─────────────────────────────────────────────── --}}
<style>
    /* === BRAND AREA === */
    .mui-brand {
        height: 64px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        background: rgba(0, 0, 0, .15);
        border-bottom: 1px solid rgba(201, 168, 76, .2);
        position: relative;
    }

    .mui-brand::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 18px;
        right: 18px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201, 168, 76, .4), transparent);
    }

    .mui-brand-link {
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none !important;
    }

    .mui-brand-icon {
        flex-shrink: 0;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, .08);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(201, 168, 76, .3);
    }

    .mui-brand-text {
        display: flex;
        flex-direction: column;
        gap: 1px;
    }

    .mui-brand-name {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.3px;
        line-height: 1;
    }

    .mui-brand-name em {
        font-style: normal;
        color: #c9a84c;
    }

    .mui-brand-sub {
        font-size: 9.5px;
        color: rgba(201, 168, 76, .65);
        letter-spacing: 0.8px;
        text-transform: uppercase;
        font-weight: 500;
    }

    /* === GOLD DIVIDER === */
    .mui-gold-divider {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px 6px;
    }

    .mui-gold-divider span:not(.star) {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(201, 168, 76, .35), transparent);
    }

    .mui-gold-divider .star {
        font-size: 9px;
        color: rgba(201, 168, 76, .6);
        flex: 0;
    }

    /* === USER MINI CARD === */
    .mui-user-card {
        display: flex;
        align-items: center;
        gap: 11px;
        margin: 2px 12px 10px;
        padding: 10px 12px;
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(201, 168, 76, .18);
        border-radius: 10px;
        transition: background .2s;
    }

    .mui-user-card:hover {
        background: rgba(255, 255, 255, .11);
    }

    .mui-user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, #c9a84c 0%, #f0d080 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
        color: #004a36;
        flex-shrink: 0;
        border: 2px solid rgba(201, 168, 76, .4);
    }

    .mui-user-info {
        flex: 1;
        min-width: 0;
    }

    .mui-user-name {
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
    }

    .mui-user-role {
        font-size: 10.5px;
        color: rgba(201, 168, 76, .8);
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-top: 2px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .mui-role-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #4ade80;
        flex-shrink: 0;
        box-shadow: 0 0 0 2px rgba(74, 222, 128, .25);
    }

    /* === NAVIGATION === */
    .mui-nav {
        flex: 1;
        overflow-y: auto;
        padding: 0 0 8px;
    }

    .mui-nav-section {
        font-size: 9.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: rgba(201, 168, 76, .55);
        padding: 14px 20px 5px;
    }

    .mui-nav-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .mui-nav-link {
        display: flex !important;
        align-items: center !important;
        gap: 11px !important;
        padding: 10px 20px !important;
        color: rgba(255, 255, 255, .75) !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        text-decoration: none !important;
        transition: all .18s ease !important;
        border-left: 3px solid transparent !important;
        position: relative;
    }

    .mui-nav-link:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, .09) !important;
        border-left-color: rgba(201, 168, 76, .5) !important;
    }

    .mui-nav-link.active {
        color: #fff !important;
        background: rgba(255, 255, 255, .13) !important;
        border-left-color: #c9a84c !important;
        font-weight: 600 !important;
    }

    .mui-nav-link.active .nav-icon i {
        color: #c9a84c !important;
    }

    .nav-icon {
        width: 22px;
        text-align: center;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .nav-icon i {
        font-size: 19px;
        line-height: 1;
        opacity: .85;
        transition: color .18s, opacity .18s;
        display: inline-block;
    }

    .mui-nav-link:hover .nav-icon i {
        opacity: 1;
    }

    .nav-label {
        flex: 1;
    }

    /* === SIDEBAR FOOTER === */
    .mui-sidebar-footer {
        padding: 12px 12px 16px;
        border-top: 1px solid rgba(255, 255, 255, .08);
        margin-top: 8px;
    }

    .mui-footer-bismillah {
        font-family: 'Amiri', serif;
        font-size: 13px;
        color: rgba(201, 168, 76, .6);
        text-align: center;
        margin-bottom: 10px;
        letter-spacing: 1px;
        direction: rtl;
    }

    .mui-logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 14px;
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 8px;
        color: rgba(255, 255, 255, .65);
        font-size: 13px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        cursor: pointer;
        transition: all .18s ease;
        letter-spacing: 0.2px;
    }

    .mui-logout-btn i {
        font-size: 16px;
    }

    .mui-logout-btn:hover {
        background: rgba(239, 68, 68, .18);
        border-color: rgba(239, 68, 68, .35);
        color: #fca5a5;
    }
</style>
