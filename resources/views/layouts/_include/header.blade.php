{{-- ============================================================
     HEADER / TOPBAR — MUI DIGITAL | ISLAMIC PROFESSIONAL THEME
     ============================================================ --}}

<div class="mui-topbar">

    {{-- ── LEFT: Hamburger + Breadcrumb ──────────────────────────── --}}
    <div class="mui-topbar-left">
        {{-- Mobile toggle --}}
        <button class="mui-menu-toggle button-menu-mobile open-left waves-effect">
            <i class="mdi mdi-menu"></i>
        </button>

        {{-- Page title / breadcrumb --}}
        <div class="mui-page-info">
            <span class="mui-page-title">
                @if(auth()->user()->isAdmin())
                    Panel Administrator
                @else
                    Panel Operator
                @endif
            </span>
            <span class="mui-page-sep">›</span>
            <span class="mui-page-sub">Dashboard</span>
        </div>
    </div>

    {{-- ── RIGHT: Actions ────────────────────────────────────────── --}}
    <div class="mui-topbar-right">

        {{-- Clock --}}
        <div class="mui-topbar-clock">
            <i class="mdi mdi-clock-outline"></i>
            <span id="time">--:--</span>
        </div>

        {{-- Divider --}}
        <div class="mui-topbar-divider"></div>

        {{-- Notification Bell --}}
        <div class="dropdown">
            <button class="mui-topbar-btn dropdown-toggle"
                    data-toggle="dropdown" type="button"
                    aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-bell-outline"></i>
                <span class="mui-notif-badge">0</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right mui-dropdown">
                <div class="mui-dropdown-header">
                    <span class="mui-dropdown-title">
                        <i class="mdi mdi-bell"></i> Notifikasi
                    </span>
                    <a href="#" class="mui-dropdown-action">Tandai dibaca</a>
                </div>
                <div class="mui-dropdown-body">
                    <div class="mui-empty-state">
                        <i class="mdi mdi-bell-off-outline"></i>
                        <p>Tidak ada notifikasi</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="mui-topbar-divider"></div>

        {{-- User Profile --}}
        <div class="dropdown">
            <button class="mui-user-trigger dropdown-toggle"
                    data-toggle="dropdown" type="button"
                    aria-haspopup="true" aria-expanded="false">
                <div class="mui-topbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="mui-topbar-user-info">
                    <span class="mui-topbar-username">{{ auth()->user()->name }}</span>
                    <span class="mui-topbar-role">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
                <i class="mdi mdi-chevron-down mui-chevron"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right mui-dropdown mui-user-dropdown">
                {{-- Header kartu --}}
                <div class="mui-user-dropdown-header">
                    <div class="mui-udh-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="mui-udh-name">{{ auth()->user()->name }}</div>
                        <div class="mui-udh-email">{{ auth()->user()->email }}</div>
                        <span class="mui-udh-badge">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </div>

                {{-- Menu items --}}
                <div class="mui-dropdown-items">
                    <a href="#" class="mui-dropdown-item">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Profil Saya</span>
                    </a>
                    <a href="#" class="mui-dropdown-item">
                        <i class="mdi mdi-lock-outline"></i>
                        <span>Ubah Password</span>
                    </a>
                </div>

                <div class="mui-dropdown-sep"></div>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" id="topbar-logout-form">
                    @csrf
                </form>
                <a href="#" class="mui-dropdown-item mui-logout-item"
                   onclick="event.preventDefault(); document.getElementById('topbar-logout-form').submit();">
                    <i class="mdi mdi-logout-variant"></i>
                    <span>Keluar</span>
                </a>
            </div>
        </div>

    </div>
</div>

{{-- ── TOPBAR CSS ──────────────────────────────────────────────── --}}
<style>
/* === TOPBAR WRAPPER === */
.mui-topbar {
    height: 60px;
    background: #ffffff;
    border-bottom: 1px solid #e8f0ec;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px 0 16px;
    position: sticky;
    top: 0;
    z-index: 99;
}

/* === LEFT SIDE === */
.mui-topbar-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.mui-menu-toggle {
    width: 38px;
    height: 38px;
    background: transparent;
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
}

.mui-page-info {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
}

.mui-page-title {
    font-weight: 700;
    color: #007f5f;
}

.mui-page-sep {
    color: #9ca3af;
    font-size: 12px;
}

.mui-page-sub {
    color: #6b7280;
    font-weight: 400;
}

/* === RIGHT SIDE === */
.mui-topbar-right {
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Clock */
.mui-topbar-clock {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12.5px;
    font-weight: 600;
    color: #4b7c68;
    background: #f0f9f5;
    border: 1px solid #d1ebe1;
    border-radius: 20px;
    padding: 5px 12px;
    white-space: nowrap;
}

.mui-topbar-clock i { font-size: 14px; color: #007f5f; }

/* Divider */
.mui-topbar-divider {
    width: 1px;
    height: 26px;
    background: #e5ebe8;
    margin: 0 6px;
}

/* Icon Buttons */
.mui-topbar-btn {
    width: 38px;
    height: 38px;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 8px;
    color: #4b7c68;
    font-size: 18px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .18s;
    position: relative;
    padding: 0;
}

.mui-topbar-btn::after { display: none !important; } /* remove bootstrap caret */

.mui-topbar-btn:hover {
    background: #f0f9f5;
    border-color: #d1ebe1;
    color: #007f5f;
}

/* Notif badge */
.mui-notif-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 16px;
    height: 16px;
    background: #ef4444;
    border-radius: 50%;
    font-size: 9px;
    font-weight: 800;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    line-height: 1;
}

/* User trigger button */
.mui-user-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: 1px solid #e2ebe6;
    border-radius: 10px;
    padding: 5px 10px 5px 6px;
    cursor: pointer;
    transition: all .18s;
    font-family: 'Inter', sans-serif;
}

.mui-user-trigger::after { display: none !important; }

.mui-user-trigger:hover {
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
    border: 2px solid rgba(0,127,95,.2);
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
    max-width: 120px;
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
}

/* === DROPDOWN BASE === */
.mui-dropdown {
    border: 1px solid #e5ebe8;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,.12);
    padding: 0;
    overflow: hidden;
    min-width: 240px;
    margin-top: 8px;
    animation: dropIn .15s ease;
}

@keyframes dropIn {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
}

.mui-dropdown-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: linear-gradient(90deg, #e6f4f0, #f5faf8);
    border-bottom: 1px solid #d4e8df;
}

.mui-dropdown-title {
    font-size: 13px;
    font-weight: 700;
    color: #007f5f;
    display: flex;
    align-items: center;
    gap: 6px;
}

.mui-dropdown-action {
    font-size: 11px;
    color: #007f5f;
    font-weight: 600;
    text-decoration: none;
    opacity: .8;
}

.mui-dropdown-action:hover { opacity: 1; text-decoration: underline; }

.mui-dropdown-body {
    max-height: 260px;
    overflow-y: auto;
}

.mui-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 24px 16px;
    color: #9ca3af;
}

.mui-empty-state i { font-size: 28px; color: #d1ebe1; }
.mui-empty-state p { font-size: 12.5px; margin: 0; }

/* === USER DROPDOWN === */
.mui-user-dropdown { min-width: 260px; }

.mui-user-dropdown-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: linear-gradient(135deg, #005f47, #007f5f);
}

.mui-udh-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: linear-gradient(135deg, #c9a84c, #f0d080);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    font-weight: 800;
    color: #004a36;
    flex-shrink: 0;
    border: 2px solid rgba(255,255,255,.3);
}

.mui-udh-name {
    font-size: 14px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
}

.mui-udh-email {
    font-size: 11px;
    color: rgba(255,255,255,.7);
    margin-top: 2px;
    max-width: 160px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.mui-udh-badge {
    display: inline-block;
    margin-top: 4px;
    background: rgba(201,168,76,.25);
    border: 1px solid rgba(201,168,76,.4);
    color: #f0d080;
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 2px 8px;
    border-radius: 10px;
}

.mui-dropdown-items { padding: 6px 0; }

.mui-dropdown-item {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 9px 16px !important;
    font-size: 13.5px !important;
    color: #374151 !important;
    text-decoration: none !important;
    transition: all .15s !important;
    font-weight: 500 !important;
}

.mui-dropdown-item i { font-size: 17px; color: #6b7280; width: 20px; text-align: center; }

.mui-dropdown-item:hover {
    background: #f0f9f5 !important;
    color: #007f5f !important;
}

.mui-dropdown-item:hover i { color: #007f5f; }

.mui-dropdown-sep {
    height: 1px;
    background: #f0f4f2;
    margin: 4px 0;
}

.mui-logout-item { color: #ef4444 !important; }
.mui-logout-item i { color: #ef4444 !important; }
.mui-logout-item:hover { background: #fef2f2 !important; color: #dc2626 !important; }
.mui-logout-item:hover i { color: #dc2626 !important; }
</style>
