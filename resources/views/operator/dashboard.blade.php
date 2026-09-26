@extends('layouts.master')

@section('css')
<style>
    :root {
        --green: #007f5f;
        --green-dark: #005f47;
        --green-light: #00a878;
        --green-pale: #e8f5f1;
        --yellow: #f0a500;
        --text: #1a1a2e;
        --gray: #6b7280;
        --bg: #f4f7f6;
        --white: #ffffff;
        --radius: 14px;
        --shadow: 0 2px 16px rgba(0,0,0,.07);
        --shadow-hover: 0 8px 32px rgba(0,127,95,.16);
        --transition: .22s cubic-bezier(.4,0,.2,1);
    }

    body { background: var(--bg) !important; }

    .page-header {
        background: linear-gradient(135deg, var(--yellow) 0%, #f5c518 100%);
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
        background: rgba(255,255,255,.25);
        border: 1px solid rgba(255,255,255,.4);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

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

    .stat-icon.green  { background: var(--green-pale); color: var(--green); }
    .stat-icon.yellow { background: #fff8e6; color: var(--yellow); }

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

    .panel-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 20px;
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

    .panel-card .panel-header h5 i { color: var(--yellow); font-size: 18px; }

    .panel-card .panel-body { padding: 20px 22px; }

    .welcome-alert {
        background: #fff8e6;
        border-left: 4px solid var(--yellow);
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .welcome-alert i { font-size: 22px; color: var(--yellow); flex-shrink: 0; }
    .welcome-alert p { margin: 0; font-size: 14px; color: var(--text); }
    .welcome-alert strong { color: var(--yellow); }

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

    .role-badge.operator { background: #fff8e6; color: var(--yellow); }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #f0f4f3;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all var(--transition);
        color: var(--text);
    }

    .quick-link:hover {
        border-color: var(--green);
        background: var(--green-pale);
        color: var(--green);
        box-shadow: var(--shadow-hover);
    }

    .quick-link .ql-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: var(--green-pale);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--green);
        flex-shrink: 0;
    }

    .quick-link .ql-text { flex: 1; }
    .quick-link .ql-text span { display: block; font-size: 14px; font-weight: 600; }
    .quick-link .ql-text small { font-size: 12px; color: var(--gray); }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 24px 30px;">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="page-header">
        <div>
            <h4><i class="mdi mdi-view-dashboard" style="margin-right:8px;"></i>Dashboard Operator</h4>
            <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong> · {{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <span class="badge-role"><i class="mdi mdi-account-edit" style="margin-right:4px;"></i> Operator</span>
    </div>

    {{-- ===== STAT CARDS ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="mdi mdi-account-edit"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value" style="font-size:18px;color:var(--yellow);">Operator</div>
                    <div class="stat-label">Role Aktif</div>
                    <div class="stat-sub" style="color:var(--yellow);">URL: /operator/dashboard</div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="mdi mdi-shield-check"></i>
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

        {{-- Akun Info --}}
        <div class="col-lg-6">
            <div class="panel-card">
                <div class="panel-header">
                    <h5><i class="mdi mdi-account-circle"></i> Info Akun Saya</h5>
                </div>
                <div class="panel-body">
                    <div class="welcome-alert">
                        <i class="mdi mdi-information-outline"></i>
                        <p>Anda login sebagai <strong>Operator</strong>. URL panel Anda: <code>/operator/dashboard</code></p>
                    </div>
                    <table style="width:100%;font-size:14px;">
                        <tr>
                            <td style="color:var(--gray);padding:8px 0;width:35%;font-weight:500;">Nama</td>
                            <td style="font-weight:700;color:var(--text);">{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td style="color:var(--gray);padding:8px 0;font-weight:500;">Email</td>
                            <td style="font-weight:700;color:var(--text);">{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <td style="color:var(--gray);padding:8px 0;font-weight:500;">Role</td>
                            <td>
                                <span class="role-badge operator">
                                    <i class="mdi mdi-account-edit"></i> Operator
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:var(--gray);padding:8px 0;font-weight:500;">Login Sejak</td>
                            <td style="font-size:13px;color:var(--gray);">{{ now()->format('d M Y, H:i') }} WIB</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="col-lg-6">
            <div class="panel-card">
                <div class="panel-header">
                    <h5><i class="mdi mdi-apps"></i> Menu Cepat</h5>
                </div>
                <div class="panel-body">
                    <a href="#" class="quick-link">
                        <div class="ql-icon"><i class="mdi mdi-newspaper"></i></div>
                        <div class="ql-text">
                            <span>Kelola Berita</span>
                            <small>Tambah, edit, dan hapus konten berita</small>
                        </div>
                        <i class="mdi mdi-chevron-right" style="color:var(--gray);"></i>
                    </a>
                    <a href="#" class="quick-link">
                        <div class="ql-icon"><i class="mdi mdi-image-multiple"></i></div>
                        <div class="ql-text">
                            <span>Kelola Media</span>
                            <small>Upload dan manajemen file gambar</small>
                        </div>
                        <i class="mdi mdi-chevron-right" style="color:var(--gray);"></i>
                    </a>
                    <a href="#" class="quick-link">
                        <div class="ql-icon"><i class="mdi mdi-tag-multiple"></i></div>
                        <div class="ql-text">
                            <span>Kategori</span>
                            <small>Atur kategori dan tag berita</small>
                        </div>
                        <i class="mdi mdi-chevron-right" style="color:var(--gray);"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
