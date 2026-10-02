{{-- ============================================================
     HEADER / TOPBAR — MUI DIGITAL | ISLAMIC PROFESSIONAL THEME
     ============================================================ --}}

@php
    $user = auth()->user();
    $canChat = $user && ($user->isAdmin() || $user->hasMenuPermission('livechat'));
    $canKonsultasi = $user && ($user->isAdmin() || $user->hasMenuPermission('konsultasi'));

    $initialWaitingChats = $canChat ? \App\Models\ChatSession::where('status', 'menunggu')->latest()->take(4)->get() : collect();
    $initialPendingKonsultasi = $canKonsultasi ? \App\Models\Konsultasi::where('status', 'pending')->latest()->take(4)->get() : collect();
    $initialChatCount = $canChat ? \App\Models\ChatSession::where('status', 'menunggu')->count() : 0;
    $initialKonsultasiCount = $canKonsultasi ? \App\Models\Konsultasi::where('status', 'pending')->count() : 0;
    $initialTotalNotif = $initialChatCount + $initialKonsultasiCount;

    // Deteksi sub-judul navigasi berdasarkan rute aktif
    $currentRoute = request()->route()?->getName() ?? '';
    $pageSub = 'Dashboard';
    if (str_contains($currentRoute, 'berita')) {
        $pageSub = 'Berita & Artikel';
    } elseif (str_contains($currentRoute, 'kategori-fatwa')) {
        $pageSub = 'Kategori Fatwa';
    } elseif (str_contains($currentRoute, 'kategori')) {
        $pageSub = 'Kategori Berita';
    } elseif (str_contains($currentRoute, 'surat')) {
        $pageSub = 'Arsip Surat';
    } elseif (str_contains($currentRoute, 'fatwa')) {
        $pageSub = 'Fatwa MUI';
    } elseif (str_contains($currentRoute, 'konsultasi')) {
        $pageSub = 'Konsultasi Syariah';
    } elseif (str_contains($currentRoute, 'livechat')) {
        $pageSub = 'Live Chat Realtime';
    } elseif (str_contains($currentRoute, 'users')) {
        $pageSub = 'Kelola Pengguna';
    } elseif (str_contains($currentRoute, 'operator-permissions')) {
        $pageSub = 'Hak Akses Operator';
    } elseif (str_contains($currentRoute, 'pengaturan')) {
        $pageSub = 'Pengaturan Web';
    } elseif (str_contains($currentRoute, 'profile')) {
        $pageSub = 'Profil Saya';
    }
@endphp

<div class="mui-topbar">

    {{-- ── LEFT: Hamburger + Breadcrumb ──────────────────────────── --}}
    <div class="mui-topbar-left">
        {{-- Mobile toggle --}}
        <button type="button" class="mui-menu-toggle button-menu-mobile open-left waves-effect" id="btn-toggle-sidebar" aria-label="Buka/Tutup Navigasi" title="Buka/Tutup Navigasi">
            <i class="mdi mdi-menu"></i>
        </button>

        {{-- Page title / breadcrumb --}}
        <div class="mui-page-info">
            <span class="mui-page-title">
                @if($user && $user->isAdmin())
                    <i class="mdi mdi-shield-crown text-success mr-1"></i>Administrator
                @else
                    <i class="mdi mdi-shield-account text-success mr-1"></i>Operator
                @endif
            </span>
            <span class="mui-page-sep">›</span>
            <span class="mui-page-sub font-weight-bold" id="topbar-page-sub">{{ $pageSub }}</span>
        </div>
    </div>

    {{-- ── RIGHT: Actions (Clock, Chat Alert, Notifikasi, Profile) ───── --}}
    <div class="mui-topbar-right">

        {{-- Jam Digital Realtime --}}
        <div class="mui-topbar-clock d-none d-md-flex" title="Waktu Server (WIB)">
            <i class="mdi mdi-clock-outline"></i>
            <span id="mui-clock-time">--:-- WIB</span>
        </div>

        {{-- Divider --}}
        <div class="mui-topbar-divider d-none d-md-block"></div>

        {{-- Live Chat Quick Alert (Jika diizinkan) --}}
        @if($canChat)
            <a href="{{ route('admin.livechat.index') }}" class="mui-topbar-btn" title="Live Chat Masyarakat" style="text-decoration: none;">
                <i class="mdi mdi-chat-processing-outline"></i>
                <span class="mui-notif-badge mui-livechat-header-badge {{ $initialChatCount > 0 ? '' : 'd-none' }}" style="background: #f59e0b;">
                    {{ $initialChatCount > 99 ? '99+' : $initialChatCount }}
                </span>
            </a>
        @endif

        {{-- Notification Bell Dropdown --}}
        <div class="dropdown mui-dropdown-wrapper">
            <button class="mui-topbar-btn dropdown-toggle {{ $initialTotalNotif > 0 ? 'has-unread' : '' }}"
                    id="topbarNotifBtn"
                    data-toggle="dropdown"
                    data-display="static"
                    type="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    title="Notifikasi Sistem">
                <i class="mdi mdi-bell-outline notif-bell-icon"></i>
                <span class="mui-notif-badge mui-system-notif-badge {{ $initialTotalNotif > 0 ? '' : 'd-none' }}" id="topbar-notif-badge">
                    {{ $initialTotalNotif > 99 ? '99+' : $initialTotalNotif }}
                </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mui-dropdown mui-notif-dropdown" aria-labelledby="topbarNotifBtn">
                {{-- Dropdown Header --}}
                <div class="mui-dropdown-header">
                    <div class="mui-dropdown-title">
                        <i class="mdi mdi-bell text-success"></i>
                        <span>Notifikasi Masuk</span>
                        <span class="badge {{ $initialTotalNotif > 0 ? 'badge-danger' : 'badge-light text-muted' }} ml-1 px-2 py-1 font-weight-bold" id="notif-header-count">
                            {{ $initialTotalNotif }} Baru
                        </span>
                    </div>
                    <button type="button" class="mui-dropdown-refresh-btn" id="btn-refresh-notif" title="Perbarui Notifikasi">
                        <i class="mdi mdi-refresh"></i>
                    </button>
                </div>

                {{-- Dropdown Body: List Notifikasi --}}
                <div class="mui-dropdown-body" id="notif-dropdown-list">
                    @if($initialTotalNotif > 0)
                        {{-- 1. Live Chat Items --}}
                        @foreach($initialWaitingChats as $chat)
                            <a href="{{ route('admin.livechat.show', $chat->id) }}" class="mui-notif-item unread">
                                <div class="mui-notif-icon bg-soft-danger text-danger">
                                    <i class="mdi mdi-chat-processing"></i>
                                </div>
                                <div class="mui-notif-content">
                                    <div class="mui-notif-head">
                                        <span class="badge badge-danger font-size-10 px-2 py-0">Chat Antrian</span>
                                        <span class="mui-notif-time">{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mui-notif-title">{{ $chat->nama_pengunjung }}</div>
                                    <div class="mui-notif-desc">Menunggu respon di antrian #{{ $chat->antrian_nomor }}{{ $chat->topik ? ' ('.$chat->topik.')' : '' }}</div>
                                </div>
                            </a>
                        @endforeach

                        {{-- 2. Konsultasi Syariah Items --}}
                        @foreach($initialPendingKonsultasi as $k)
                            @php
                                $targetKonRoute = $user->isOperator() ? 'operator.konsultasi.index' : 'admin.konsultasi.index';
                                $kUrl = route($targetKonRoute, ['detail_id' => $k->id]);
                            @endphp
                            <a href="{{ $kUrl }}" class="mui-notif-item unread">
                                <div class="mui-notif-icon bg-soft-warning text-warning">
                                    <i class="mdi mdi-forum"></i>
                                </div>
                                <div class="mui-notif-content">
                                    <div class="mui-notif-head">
                                        <span class="badge badge-warning text-dark font-size-10 px-2 py-0 font-weight-bold">Tanya Ulama</span>
                                        <span class="mui-notif-time">{{ $k->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mui-notif-title">{{ $k->nama }}</div>
                                    <div class="mui-notif-desc">{{ Str::limit($k->pertanyaan, 55) }}</div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        {{-- Empty State --}}
                        <div class="mui-empty-state">
                            <i class="mdi mdi-bell-check-outline text-success"></i>
                            <strong class="text-dark font-size-13 mt-1">Alhamdulillah, Tidak Ada Antrian</strong>
                            <p class="text-muted small mb-0">Seluruh sesi Live Chat dan konsultasi syariah telah tertangani.</p>
                        </div>
                    @endif
                </div>

                {{-- Dropdown Footer --}}
                <div class="mui-dropdown-footer">
                    @if($canChat)
                        <a href="{{ route('admin.livechat.index') }}" class="mui-footer-link">
                            <i class="mdi mdi-chat-processing-outline mr-1"></i> Live Chat
                        </a>
                    @endif
                    @if($canKonsultasi)
                        @php
                            $konRoute = $user->isAdmin() ? route('admin.konsultasi.index') : route('operator.konsultasi.index');
                        @endphp
                        <a href="{{ $konRoute }}" class="mui-footer-link">
                            <i class="mdi mdi-forum-outline mr-1"></i> Konsultasi
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="mui-footer-link font-weight-bold">
                        <i class="mdi mdi-view-dashboard-outline mr-1"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="mui-topbar-divider"></div>

        {{-- User Profile Dropdown --}}
        <div class="dropdown mui-dropdown-wrapper">
            <button class="mui-user-trigger dropdown-toggle"
                    id="topbarUserBtn"
                    data-toggle="dropdown"
                    data-display="static"
                    type="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                    title="Menu Akun Saya">
                <div class="mui-topbar-avatar">
                    @if($user && $user->foto_url)
                        <img src="{{ $user->foto_url }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                    @endif
                </div>
                <div class="mui-topbar-user-info d-none d-sm-flex">
                    <span class="mui-topbar-username">{{ $user->name_gelar ?: ($user->name ?? 'Pengguna') }}</span>
                    <span class="mui-topbar-role">
                        @if($user && $user->isAdmin())
                            Administrator
                        @else
                            Operator Portal
                        @endif
                    </span>
                </div>
                <i class="mdi mdi-chevron-down mui-chevron"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right mui-dropdown mui-user-dropdown" aria-labelledby="topbarUserBtn">
                {{-- Header kartu profil --}}
                <div class="mui-user-dropdown-header">
                    <div class="mui-udh-avatar">
                        @if($user && $user->foto_url)
                            <img src="{{ $user->foto_url }}" alt="{{ $user->name }}">
                        @else
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        @endif
                    </div>
                    <div style="min-width: 0; flex: 1;">
                        <div class="mui-udh-name">{{ $user->name_gelar ?: ($user->name ?? 'Pengguna') }}</div>
                        <div class="mui-udh-email">{{ $user->email ?? '-' }}</div>
                        <span class="mui-udh-badge">
                            {{ $user && $user->isAdmin() ? 'Super Admin' : 'Petugas Operator' }}
                        </span>
                    </div>
                </div>

                {{-- Menu items --}}
                <div class="mui-dropdown-items">
                    <a href="{{ route('dashboard') }}" class="mui-dropdown-item">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span>Dashboard Utama</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="mui-dropdown-item">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Profil & Biodata Saya</span>
                    </a>
                    <a href="{{ route('profile.edit') }}#password-section" class="mui-dropdown-item">
                        <i class="mdi mdi-key-outline"></i>
                        <span>Ganti Password Akun</span>
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="mui-dropdown-item">
                        <i class="mdi mdi-open-in-new"></i>
                        <span>Lihat Portal Publik</span>
                    </a>
                </div>

                <div class="mui-dropdown-sep"></div>

                {{-- Logout Button --}}
                <form action="{{ route('logout') }}" method="POST" id="topbar-logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="javascript:void(0);" class="mui-dropdown-item mui-logout-item"
                   onclick="event.preventDefault(); document.getElementById('topbar-logout-form').submit();">
                    <i class="mdi mdi-logout-variant"></i>
                    <span>Keluar dari Sesi</span>
                </a>
            </div>
        </div>

    </div>
</div>

{{-- ── TOPBAR & DROPDOWN CSS FIX ───────────────────────────────── --}}
<style>
/* === TOPBAR WRAPPER === */
.mui-topbar {
    height: 60px;
    background: #ffffff;
    border-bottom: 1px solid #e8f0ec;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px 0 16px;
    position: sticky;
    top: 0;
    z-index: 999;
    overflow: visible !important; /* Mencegah dropdown terpotong oleh topbar */
}

/* === LEFT SIDE === */
.mui-topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 0;
    flex: 1;
}

.mui-menu-toggle {
    width: 38px;
    height: 38px;
    background: #ffffff;
    border: 1px solid #e2ebe6;
    border-radius: 8px;
    color: #007f5f;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .18s;
    padding: 0;
    flex-shrink: 0;
}

.mui-menu-toggle:hover {
    background: #e6f4f0;
    border-color: #007f5f;
    color: #005f47;
}

.mui-page-info {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mui-page-title {
    font-weight: 700;
    color: #007f5f;
    display: flex;
    align-items: center;
}

.mui-page-sep {
    color: #9ca3af;
    font-size: 12px;
}

.mui-page-sub {
    color: #4b5563;
    font-weight: 600;
}

/* === RIGHT SIDE === */
.mui-topbar-right {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
    overflow: visible !important;
}

/* Clock */
.mui-topbar-clock {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 700;
    color: #007f5f;
    background: #f0f9f5;
    border: 1px solid #d1ebe1;
    border-radius: 20px;
    padding: 5px 12px;
    white-space: nowrap;
}

.mui-topbar-clock i {
    font-size: 14px;
    color: #007f5f;
}

/* Divider */
.mui-topbar-divider {
    width: 1px;
    height: 24px;
    background: #e5ebe8;
    margin: 0 4px;
}

/* Icon Buttons */
.mui-topbar-btn {
    width: 38px;
    height: 38px;
    background: #ffffff;
    border: 1px solid #e5ebe8;
    border-radius: 8px;
    color: #4b7c68;
    font-size: 19px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .18s;
    position: relative;
    padding: 0;
}

.mui-topbar-btn::after { display: none !important; }

.mui-topbar-btn:hover,
.mui-topbar-btn[aria-expanded="true"] {
    background: #f0f9f5;
    border-color: #007f5f;
    color: #007f5f;
}

.mui-topbar-btn.has-unread .notif-bell-icon {
    animation: muiBellRing 2.5s infinite ease-in-out;
    transform-origin: top center;
    color: #ef4444;
}

@keyframes muiBellRing {
    0%, 80%, 100% { transform: rotate(0); }
    85% { transform: rotate(14deg); }
    90% { transform: rotate(-12deg); }
    95% { transform: rotate(8deg); }
}

/* Notif badge */
.mui-notif-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    min-width: 18px;
    height: 18px;
    padding: 0 4px;
    background: #ef4444;
    border-radius: 10px;
    font-size: 9.5px;
    font-weight: 800;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    line-height: 1;
    box-shadow: 0 2px 5px rgba(239, 68, 68, 0.4);
}

/* User trigger button */
.mui-user-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #ffffff;
    border: 1px solid #e2ebe6;
    border-radius: 10px;
    padding: 4px 10px 4px 6px;
    cursor: pointer;
    transition: all .18s;
    font-family: inherit;
}

.mui-user-trigger::after { display: none !important; }

.mui-user-trigger:hover,
.mui-user-trigger[aria-expanded="true"] {
    background: #f0f9f5;
    border-color: #007f5f;
}

.mui-topbar-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #007f5f, #00a878);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 800;
    color: #fff;
    flex-shrink: 0;
    border: 2px solid rgba(0, 127, 95, .2);
    overflow: hidden;
}

.mui-topbar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mui-topbar-user-info {
    display: flex;
    flex-direction: column;
    text-align: left;
    gap: 1px;
}

.mui-topbar-username {
    font-size: 13px;
    font-weight: 700;
    color: #1a2e25;
    line-height: 1.1;
    max-width: 130px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mui-topbar-role {
    font-size: 10px;
    font-weight: 600;
    color: #007f5f;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.mui-chevron {
    font-size: 16px;
    color: #9ca3af;
    transition: transform .2s ease;
}

.mui-user-trigger[aria-expanded="true"] .mui-chevron {
    transform: rotate(180deg);
}

/* === DROPDOWN BASE & NAVIGATION FIX === */
.mui-dropdown-wrapper {
    position: relative !important;
}

.mui-dropdown {
    position: absolute !important;
    top: 100% !important;
    right: 0 !important;
    left: auto !important;
    transform: none !important; /* Hentikan translate3d Popper yang merusak posisi */
    margin-top: 8px !important;
    border: 1px solid #dce8e3 !important;
    border-radius: 14px !important;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.14) !important;
    padding: 0 !important;
    overflow: hidden !important;
    z-index: 1050 !important;
    background: #ffffff !important;
}

/* Dropdown Animation (Opacity Only - Tanpa Transform agar tidak merusak koordinat) */
.mui-dropdown.show {
    display: block !important;
    animation: muiFadeIn 0.16s ease-out;
}

@keyframes muiFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* === NOTIFICATION DROPDOWN === */
.mui-notif-dropdown {
    width: 350px !important;
    max-width: calc(100vw - 28px) !important;
}

.mui-dropdown-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: #f8faf9;
    border-bottom: 1px solid #eef3f1;
}

.mui-dropdown-title {
    font-size: 13.5px;
    font-weight: 700;
    color: #1a2e25;
    display: flex;
    align-items: center;
    gap: 6px;
}

.mui-dropdown-refresh-btn {
    border: none;
    background: transparent;
    color: #6b7280;
    cursor: pointer;
    font-size: 17px;
    padding: 2px 4px;
    border-radius: 4px;
    transition: all .15s;
}

.mui-dropdown-refresh-btn:hover {
    color: #007f5f;
    background: #e6f4f0;
}

.mui-dropdown-body {
    max-height: 330px;
    overflow-y: auto;
}

.mui-notif-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 16px;
    border-bottom: 1px solid #f3f6f5;
    text-decoration: none !important;
    color: inherit !important;
    transition: background .15s;
}

.mui-notif-item:hover {
    background: #f4faf7;
}

.mui-notif-item.unread {
    background: #fcfffd;
    border-left: 3px solid #007f5f;
}

.mui-notif-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
    margin-top: 2px;
}

.mui-notif-content {
    flex: 1;
    min-width: 0;
}

.mui-notif-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 6px;
    margin-bottom: 3px;
}

.mui-notif-time {
    font-size: 10.5px;
    color: #9ca3af;
}

.mui-notif-title {
    font-size: 13px;
    font-weight: 700;
    color: #1f2937;
    line-height: 1.2;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mui-notif-desc {
    font-size: 11.5px;
    color: #6b7280;
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.mui-dropdown-footer {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 10px 14px;
    background: #fafcfb;
    border-top: 1px solid #eef3f1;
    font-size: 12px;
}

.mui-footer-link {
    color: #007f5f;
    text-decoration: none !important;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.mui-footer-link:hover {
    color: #005f47;
    text-decoration: underline !important;
}

.mui-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 28px 20px;
    color: #6b7280;
}

.mui-empty-state i {
    font-size: 36px;
    margin-bottom: 6px;
}

/* === USER DROPDOWN === */
.mui-user-dropdown {
    width: 275px !important;
    max-width: calc(100vw - 28px) !important;
}

.mui-user-dropdown-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: linear-gradient(135deg, #005f47, #007f5f);
    color: #fff;
}

.mui-udh-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #c9a84c, #f0d080);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 800;
    color: #004a36;
    flex-shrink: 0;
    border: 2px solid rgba(255, 255, 255, 0.4);
    overflow: hidden;
}

.mui-udh-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mui-udh-name {
    font-size: 14px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mui-udh-email {
    font-size: 11.5px;
    color: rgba(255, 255, 255, 0.8);
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mui-udh-badge {
    display: inline-block;
    margin-top: 5px;
    background: rgba(201, 168, 76, 0.3);
    border: 1px solid rgba(240, 208, 128, 0.5);
    color: #fdf0cd;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.5px;
    padding: 2px 8px;
    border-radius: 12px;
}

.mui-dropdown-items {
    padding: 6px 0;
}

.mui-dropdown-item {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 9px 18px !important;
    font-size: 13.5px !important;
    color: #374151 !important;
    text-decoration: none !important;
    transition: all .15s !important;
    font-weight: 500 !important;
}

.mui-dropdown-item i {
    font-size: 18px;
    color: #6b7280;
    width: 22px;
    text-align: center;
}

.mui-dropdown-item:hover {
    background: #f0f9f5 !important;
    color: #007f5f !important;
}

.mui-dropdown-item:hover i {
    color: #007f5f !important;
}

.mui-dropdown-sep {
    height: 1px;
    background: #edf2f0;
    margin: 4px 0;
}

.mui-logout-item {
    color: #ef4444 !important;
}

.mui-logout-item i {
    color: #ef4444 !important;
}

.mui-logout-item:hover {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}

.mui-logout-item:hover i {
    color: #dc2626 !important;
}

@media (max-width: 575.98px) {
    .mui-topbar {
        padding: 0 10px !important;
        height: 56px !important;
    }
    .mui-page-title {
        font-size: 11.5px;
    }
    .mui-page-sub {
        font-size: 11.5px;
    }
    .mui-topbar-right {
        gap: 4px;
    }
    .mui-user-trigger {
        padding: 2px 4px !important;
    }
    .mui-chevron {
        display: none !important;
    }
}
</style>

{{-- ── REALTIME CLOCK & NOTIFICATION POLLING JS ───────────────── --}}
<script>
(function() {
    // 1. JAM DIGITAL REALTIME
    function updateMuiClock() {
        const clockElem = document.getElementById('mui-clock-time');
        if (!clockElem) return;

        const now = new Date();
        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');
        clockElem.textContent = `${h}:${m}:${s} WIB`;
    }
    updateMuiClock();
    setInterval(updateMuiClock, 1000);

    // 2. SUARA CHIME NOTIFIKASI
    function playNotifChime() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = 'sine';
            osc.frequency.setValueAtTime(784, ctx.currentTime); // G5
            osc.frequency.setValueAtTime(1046, ctx.currentTime + 0.12); // C6
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);
            osc.start(ctx.currentTime);
            osc.stop(ctx.currentTime + 0.5);
        } catch(e) {}
    }

    // 3. POLLING NOTIFIKASI SECARA BERKALA
    let lastKnownTotal = {{ $initialTotalNotif }};
    let lastKnownChatId = null;

    function renderNotifications(data) {
        const notifBadge = document.getElementById('topbar-notif-badge');
        const notifBtn = document.getElementById('topbarNotifBtn');
        const headerCount = document.getElementById('notif-header-count');
        const listContainer = document.getElementById('notif-dropdown-list');

        // Update badge notif lonceng
        if (notifBadge && notifBtn) {
            notifBadge.textContent = data.total > 99 ? '99+' : data.total;
            if (data.total > 0) {
                notifBadge.classList.remove('d-none');
                notifBtn.classList.add('has-unread');
            } else {
                notifBadge.classList.add('d-none');
                notifBtn.classList.remove('has-unread');
            }
        }

        // Update header count badge
        if (headerCount) {
            headerCount.textContent = data.total + ' Baru';
            if (data.total > 0) {
                headerCount.className = 'badge badge-danger ml-1 px-2 py-1 font-weight-bold';
            } else {
                headerCount.className = 'badge badge-light text-muted ml-1 px-2 py-1 font-weight-bold';
            }
        }

        // Update live chat quick badge bila ada
        const livechatBadges = document.querySelectorAll('.mui-livechat-header-badge');
        livechatBadges.forEach(b => {
            b.textContent = data.chat_count > 99 ? '99+' : data.chat_count;
            if (data.chat_count > 0) {
                b.classList.remove('d-none');
            } else {
                b.classList.add('d-none');
            }
        });

        // Mainkan nada dering bila ada notifikasi baru masuk
        if (data.total > lastKnownTotal || (data.latest_chat_id && data.latest_chat_id !== lastKnownChatId)) {
            if (lastKnownTotal > 0 || lastKnownChatId !== null) {
                playNotifChime();
            }
        }
        lastKnownTotal = data.total;
        lastKnownChatId = data.latest_chat_id;

        // Render daftar notifikasi di dropdown
        if (!listContainer) return;

        if (!data.items || data.items.length === 0) {
            listContainer.innerHTML = `
                <div class="mui-empty-state">
                    <i class="mdi mdi-bell-check-outline text-success"></i>
                    <strong class="text-dark font-size-13 mt-1">Alhamdulillah, Tidak Ada Antrian</strong>
                    <p class="text-muted small mb-0">Seluruh sesi Live Chat dan konsultasi syariah telah tertangani.</p>
                </div>
            `;
            return;
        }

        let html = '';
        data.items.forEach(item => {
            html += `
                <a href="${item.url}" class="mui-notif-item unread">
                    <div class="mui-notif-icon ${item.bg_class} ${item.icon_class}">
                        <i class="${item.icon}"></i>
                    </div>
                    <div class="mui-notif-content">
                        <div class="mui-notif-head">
                            <span class="badge ${item.badge_class} font-size-10 px-2 py-0">${item.badge}</span>
                            <span class="mui-notif-time">${item.time}</span>
                        </div>
                        <div class="mui-notif-title">${item.sender}</div>
                        <div class="mui-notif-desc">${item.message}</div>
                    </div>
                </a>
            `;
        });
        listContainer.innerHTML = html;
    }

    function fetchNotifications() {
        const refreshBtn = document.getElementById('btn-refresh-notif');
        if (refreshBtn) refreshBtn.querySelector('i').classList.add('mdi-spin');

        fetch('{{ route('notifications.poll') }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Network error');
            return res.json();
        })
        .then(data => {
            renderNotifications(data);
        })
        .catch(() => {})
        .finally(() => {
            if (refreshBtn) refreshBtn.querySelector('i').classList.remove('mdi-spin');
        });
    }

    // Tombol refresh manual
    const refreshBtn = document.getElementById('btn-refresh-notif');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            fetchNotifications();
        });
    }

    // Polling otomatis setiap 8 detik
    setInterval(fetchNotifications, 8000);
})();
</script>
