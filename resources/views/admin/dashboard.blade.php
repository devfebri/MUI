@extends('layouts.master')

@section('css')
    <style>
        /* ===== DASHBOARD VARIABLES ===== */
        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-pale: #e8f5f1;
            --yellow: #f0a500;
            --blue: #2563eb;
            --red: #ef4444;
            --text: #1a1a2e;
            --gray: #6b7280;
            --bg: #f4f7f6;
            --white: #ffffff;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(0, 0, 0, .07);
            --shadow-hover: 0 8px 32px rgba(0, 127, 95, .16);
            --transition: .22s cubic-bezier(.4, 0, .2, 1);
        }

        body {
            background: var(--bg) !important;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
            border-radius: var(--radius);
            padding: 28px 30px;
            margin-bottom: 28px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h4 {
            font-size: 22px;
            font-weight: 800;
            margin: 0;
            color: #fff;
        }

        .page-header p {
            margin: 4px 0 0;
            font-size: 13px;
            opacity: .85;
            color: #fff;
        }

        .page-header .badge-role {
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .35);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all var(--transition);
            border: 1px solid transparent;
            margin-bottom: 0;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
            border-color: var(--green-pale);
        }

        .stat-icon {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        .stat-icon.green {
            background: var(--green-pale);
            color: var(--green);
        }

        .stat-icon.yellow {
            background: #fff8e6;
            color: var(--yellow);
        }

        .stat-icon.blue {
            background: #eff6ff;
            color: var(--blue);
        }

        .stat-icon.red {
            background: #fef2f2;
            color: var(--red);
        }

        .stat-info {
            flex: 1;
        }

        .stat-info .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-info .stat-label {
            font-size: 13px;
            color: var(--gray);
            font-weight: 500;
        }

        .stat-info .stat-sub {
            font-size: 11px;
            color: var(--green);
            font-weight: 600;
            margin-top: 4px;
        }

        /* ===== PANEL CARDS ===== */
        .panel-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            height: 100%;
        }

        .panel-card .panel-header {
            padding: 18px 22px;
            border-bottom: 1px solid #f0f4f3;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-card .panel-header h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-card .panel-header h5 i {
            color: var(--green);
            font-size: 18px;
        }

        .panel-card .panel-body {
            padding: 20px 22px;
        }

        /* ===== WELCOME ALERT ===== */
        .welcome-alert {
            background: var(--green-pale);
            border-left: 4px solid var(--green);
            border-radius: 10px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .welcome-alert i {
            font-size: 22px;
            color: var(--green);
            flex-shrink: 0;
        }

        .welcome-alert p {
            margin: 0;
            font-size: 14px;
            color: var(--text);
        }

        .welcome-alert strong {
            color: var(--green);
        }

        /* ===== USER TABLE ===== */
        .user-table {
            width: 100%;
        }

        .user-table th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray);
            padding: 10px 12px;
            border-bottom: 2px solid #f0f4f3;
            background: #fafcfb;
        }

        .user-table td {
            padding: 12px 12px;
            border-bottom: 1px solid #f4f6f5;
            font-size: 13.5px;
            color: var(--text);
            vertical-align: middle;
        }

        .user-table tr:last-child td {
            border-bottom: none;
        }

        .user-table tr:hover td {
            background: #fafcfb;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-badge.admin {
            background: var(--green-pale);
            color: var(--green);
        }

        .role-badge.operator {
            background: #fff8e6;
            color: var(--yellow);
        }

        /* ===== ACTIVITY ITEM ===== */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f4f3;
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .activity-dot.green {
            background: var(--green);
        }

        .activity-dot.yellow {
            background: var(--yellow);
        }

        .activity-dot.blue {
            background: var(--blue);
        }

        .activity-text {
            flex: 1;
        }

        .activity-text p {
            margin: 0;
            font-size: 13.5px;
            color: var(--text);
        }

        .activity-text span {
            font-size: 11px;
            color: var(--gray);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 24px 30px;">

        {{-- ===== PAGE HEADER ===== --}}
        <div class="page-header">
            <div>
                <h4><i class="mdi mdi-view-dashboard" style="margin-right:8px;"></i>Dashboard Admin</h4>
                <p>Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong> ·
                    {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <span class="badge-role"><i class="mdi mdi-shield-account" style="margin-right:4px;"></i> Administrator</span>
        </div>

        {{-- ===== STAT CARDS ===== --}}
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="mdi mdi-account-multiple"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">{{ \App\Models\User::count() }}</div>
                        <div class="stat-label">Total Pengguna</div>
                        <div class="stat-sub">↑ Semua role</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="mdi mdi-shield-account"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                        <div class="stat-label">Administrator</div>
                        <div class="stat-sub">Role: admin</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon yellow">
                        <i class="mdi mdi-account-edit"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value">{{ \App\Models\User::where('role', 'operator')->count() }}</div>
                        <div class="stat-label">Operator</div>
                        <div class="stat-sub">Role: operator</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="mdi mdi-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-value" style="font-size:18px;color:var(--green);">Aktif</div>
                        <div class="stat-label">Status Sesi</div>
                        <div class="stat-sub">Login berhasil</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="row g-3">

            {{-- Welcome + User List --}}
            {{-- <div class="col-lg-8">
            <div class="panel-card">
                <div class="panel-header">
                    <h5><i class="mdi mdi-account-multiple"></i> Daftar Pengguna</h5>
                    <span style="font-size:12px;color:var(--gray);">{{ \App\Models\User::count() }} total</span>
                </div>
                <div class="panel-body" style="padding:0;">
                    <div class="welcome-alert" style="margin:20px 22px 0;">
                        <i class="mdi mdi-information-outline"></i>
                        <p>Anda login sebagai <strong>Administrator</strong>. URL panel Anda: <code>/admin/dashboard</code></p>
                    </div>
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\User::latest()->get() as $index => $user)
                            <tr>
                                <td style="color:var(--gray);font-weight:600;">{{ $index + 1 }}</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div style="width:34px;height:34px;border-radius:10px;background:var(--green-pale);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:var(--green);">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span style="font-weight:600;">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td style="color:var(--gray);">{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge {{ $user->role }}">
                                        <i class="mdi {{ $user->role === 'admin' ? 'mdi-shield-account' : 'mdi-account-edit' }}"></i>
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td style="color:var(--gray);font-size:12px;">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

            {{-- Activity & Info --}}
            <div class="col-lg-4">
                <div class="panel-card mb-3">
                    <div class="panel-header">
                        <h5><i class="mdi mdi-clock-outline"></i> Aktivitas Terbaru</h5>
                    </div>
                    <div class="panel-body">
                        <div class="activity-item">
                            <div class="activity-dot green"></div>
                            <div class="activity-text">
                                <p><strong>{{ auth()->user()->name }}</strong> berhasil login</p>
                                <span><i class="mdi mdi-clock-outline"></i> Baru saja · via /admin/dashboard</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot blue"></div>
                            <div class="activity-text">
                                <p>Sistem autentikasi berjalan normal</p>
                                <span><i class="mdi mdi-clock-outline"></i> {{ now()->format('H:i') }}</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot yellow"></div>
                            <div class="activity-text">
                                <p>Database terhubung: <strong>{{ config('database.default') }}</strong></p>
                                <span><i class="mdi mdi-database-check"></i> Koneksi OK</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-card">
                    <div class="panel-header">
                        <h5><i class="mdi mdi-information-outline"></i> Info Akun</h5>
                    </div>
                    <div class="panel-body">
                        <table style="width:100%;font-size:13.5px;">
                            <tr>
                                <td style="color:var(--gray);padding:6px 0;width:40%;">Nama</td>
                                <td style="font-weight:600;color:var(--text);">{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td style="color:var(--gray);padding:6px 0;">Email</td>
                                <td style="font-weight:600;color:var(--text);">{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <td style="color:var(--gray);padding:6px 0;">Role</td>
                                <td>
                                    <span class="role-badge admin">
                                        <i class="mdi mdi-shield-account"></i> Admin
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="color:var(--gray);padding:6px 0;">URL Panel</td>
                                <td style="font-size:12px;"><code>/admin/dashboard</code></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
