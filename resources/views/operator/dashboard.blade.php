@extends('layouts.master')

@section('title', 'Dashboard Operator')

@section('css')
<style>
    :root {
        --green: #007f5f;
        --green-dark: #005f47;
        --green-light: #00a878;
        --green-pale: #e8f5f1;
        --yellow: #f0a500;
        --yellow-pale: #fffbeb;
        --blue: #2563eb;
        --blue-pale: #eff6ff;
        --red: #ef4444;
        --red-pale: #fef2f2;
        --purple: #7c3aed;
        --purple-pale: #f5f3ff;
        --gold: #c9a84c;
        --text: #1a1a2e;
        --gray: #6b7280;
        --bg: #f4f7f6;
        --white: #ffffff;
        --radius: 14px;
        --radius-sm: 8px;
        --shadow: 0 2px 16px rgba(0, 0, 0, .07);
        --shadow-hover: 0 8px 32px rgba(0, 127, 95, .16);
        --transition: .22s cubic-bezier(.4, 0, .2, 1);
    }

    body { background: var(--bg) !important; }

    /* Page Header */
    .dashboard-header {
        background: linear-gradient(135deg, #0b5e42 0%, #10875b 60%, #17a06f 100%);
        border-radius: var(--radius);
        padding: 26px 30px;
        margin-bottom: 24px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        box-shadow: 0 4px 20px rgba(11, 94, 66, 0.22);
    }

    .dashboard-header h4 {
        font-size: 22px;
        font-weight: 800;
        margin: 0;
        color: #fff;
    }

    .dashboard-header p {
        margin: 4px 0 0;
        font-size: 13.5px;
        opacity: .9;
        color: #e6f7f2;
    }

    .badge-role-tag {
        background: rgba(255, 255, 255, .2);
        border: 1px solid rgba(255, 255, 255, .35);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Stat Cards */
    .stat-card-custom {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all var(--transition);
        border: 1px solid #edf2f0;
        height: 100%;
        text-decoration: none !important;
        color: inherit;
    }

    .stat-card-custom:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-3px);
        border-color: #bbf7d0;
        color: inherit;
    }

    .stat-icon-wrap {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        flex-shrink: 0;
    }

    .stat-icon-wrap.green  { background: var(--green-pale); color: var(--green); }
    .stat-icon-wrap.yellow { background: var(--yellow-pale); color: var(--yellow); }
    .stat-icon-wrap.blue   { background: var(--blue-pale); color: var(--blue); }
    .stat-icon-wrap.purple { background: var(--purple-pale); color: var(--purple); }
    .stat-icon-wrap.red    { background: var(--red-pale); color: var(--red); }

    .stat-info-wrap .stat-num {
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        line-height: 1.1;
        margin-bottom: 3px;
    }

    .stat-info-wrap .stat-label {
        font-size: 13px;
        color: var(--gray);
        font-weight: 600;
    }

    .stat-info-wrap .stat-sub {
        font-size: 11.5px;
        margin-top: 3px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Panels */
    .panel-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid #edf2f0;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .panel-card .panel-header {
        padding: 16px 22px;
        border-bottom: 1px solid #f0f4f3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fafcfb;
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

    .panel-card .panel-body {
        padding: 20px 22px;
    }

    /* Custom Badges */
    .badge-urgent {
        background: var(--red-pale);
        color: var(--red);
        border: 1px solid #fecaca;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-active-chat {
        background: var(--green-pale);
        color: var(--green);
        border: 1px solid #bbf7d0;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Table styles */
    .table-modern {
        width: 100%;
        margin-bottom: 0;
    }

    .table-modern th {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--gray);
        border-top: none;
        border-bottom: 2px solid #edf2f0;
        padding: 10px 14px;
        letter-spacing: 0.5px;
    }

    .table-modern td {
        font-size: 13.5px;
        vertical-align: middle;
        padding: 12px 14px;
        border-bottom: 1px solid #f4f7f6;
    }

    .table-modern tr:hover td {
        background: #fbfdfc;
    }

    /* Duty item */
    .duty-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
        margin: 3px;
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
    }

    .duty-chip.active {
        background: var(--green-pale);
        color: var(--green-dark);
        border-color: #a7f3d0;
    }

    .quick-link-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #edf2f0;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all var(--transition);
        color: var(--text);
        background: #fff;
    }

    .quick-link-box:hover {
        border-color: var(--green);
        background: var(--green-pale);
        color: var(--green);
        box-shadow: 0 4px 14px rgba(0, 127, 95, 0.12);
        transform: translateX(4px);
    }

    .quick-link-box .ql-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: var(--green);
        flex-shrink: 0;
        transition: all var(--transition);
    }

    .quick-link-box:hover .ql-icon {
        background: var(--green);
        color: #fff;
        border-color: var(--green);
    }

    .quick-link-box .ql-info {
        flex: 1;
        min-width: 0;
    }

    .quick-link-box .ql-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text);
        display: block;
        margin-bottom: 2px;
    }

    .quick-link-box .ql-desc {
        font-size: 12px;
        color: var(--gray);
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-avatar-lg {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e2e8f0;
    }

    .user-avatar-initials-lg {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--green-dark), var(--green-light));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 800;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,.08);
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 24px 30px;">

    {{-- ===== HEADER DASHBOARD OPERATOR ===== --}}
    <div class="dashboard-header">
        <div>
            <h4><i class="mdi mdi-view-dashboard" style="margin-right: 8px;"></i>Dashboard Petugas Operator</h4>
            <p>Selamat bertugas, <strong>{{ auth()->user()->name_gelar ?: auth()->user()->name }}</strong> · Hari ini {{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="badge-role-tag">
                <i class="mdi mdi-shield-account"></i> Operator Portal
            </span>
            <span class="badge-role-tag" style="background: rgba(0,0,0,0.2); border-color: rgba(255,255,255,0.25);">
                <i class="mdi mdi-check-decagram text-warning"></i> {{ count($assignedPerms) }} Tugas Ditetapkan
            </span>
        </div>
    </div>

    {{-- ===== PERINGATAN BILA BELUM ADA AKSES MENU ===== --}}
    @if(count($assignedPerms) === 0)
        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center mb-4 p-3" style="border-radius: 12px;">
            <i class="mdi mdi-alert-circle text-warning mr-3" style="font-size: 32px;"></i>
            <div>
                <strong class="d-block font-size-15">Belum Ada Wewenang Tugas yang Ditetapkan</strong>
                <span class="text-muted small">Administrator belum mengaktifkan hak akses menu tugas untuk akun Anda. Silakan hubungi Administrator agar dapat membuka menu dan menangani tugas operasional.</span>
            </div>
        </div>
    @endif

    {{-- ===== KARTU INDIKATOR OPERASIONAL (DYNAMIC SESUAI WEWENANG) ===== --}}
    <div class="row g-3 mb-4">
        {{-- Stat Live Chat --}}
        @if(auth()->user()->hasMenuPermission('livechat'))
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.livechat.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap {{ ($stats['chat_menunggu'] ?? 0) > 0 ? 'red' : 'blue' }}">
                        <i class="mdi mdi-chat-processing-outline"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num text-danger">{{ $stats['chat_menunggu'] ?? 0 }}</div>
                        <div class="stat-label">Chat Menunggu</div>
                        <div class="stat-sub text-danger">
                            <i class="mdi mdi-alert-circle-outline"></i> Butuh Respon Segera
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.livechat.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap green">
                        <i class="mdi mdi-wechat"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num text-success">{{ $operatorData['my_active_chats_count'] ?? 0 }}</div>
                        <div class="stat-label">Chat Aktif Saya</div>
                        <div class="stat-sub text-success">
                            <i class="mdi mdi-account-voice"></i> Sedang Ditangani
                        </div>
                    </div>
                </a>
            </div>
        @endif

        {{-- Stat Konsultasi --}}
        @if(auth()->user()->hasMenuPermission('konsultasi'))
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('operator.konsultasi.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap {{ ($stats['konsultasi_pending'] ?? 0) > 0 ? 'yellow' : 'green' }}">
                        <i class="mdi mdi-forum-outline"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num" style="color: var(--yellow);">{{ $stats['konsultasi_pending'] ?? 0 }}</div>
                        <div class="stat-label">Konsultasi Baru</div>
                        <div class="stat-sub text-warning">
                            <i class="mdi mdi-clock-outline"></i> Menunggu Jawaban
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="{{ route('operator.konsultasi.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap purple">
                        <i class="mdi mdi-comment-check-outline"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num text-primary">{{ $operatorData['my_answered_count'] ?? 0 }}</div>
                        <div class="stat-label">Jawaban Saya</div>
                        <div class="stat-sub text-primary">
                            <i class="mdi mdi-check-all"></i> Telah Dijawab
                        </div>
                    </div>
                </a>
            </div>
        @endif

        {{-- Stat Berita --}}
        @if(auth()->user()->hasMenuPermission('berita'))
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('operator.berita.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap green">
                        <i class="mdi mdi-newspaper"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num text-success">{{ $operatorData['my_berita_count'] ?? 0 }}</div>
                        <div class="stat-label">Artikel Ditulis Saya</div>
                        <div class="stat-sub text-success">
                            <i class="mdi mdi-feather"></i> Kontributor Berita
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6">
                <a href="{{ route('operator.berita.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap blue">
                        <i class="mdi mdi-eye-outline"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num text-info">{{ number_format($stats['total_views_berita'] ?? 0) }}</div>
                        <div class="stat-label">Total Pembaca Portal</div>
                        <div class="stat-sub text-info">
                            <i class="mdi mdi-chart-line"></i> Publikasi Terbaca
                        </div>
                    </div>
                </a>
            </div>
        @endif

        {{-- Stat Arsip Fatwa & Surat bila ada --}}
        @if(auth()->user()->hasMenuPermission('fatwa'))
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('operator.fatwa.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap yellow">
                        <i class="mdi mdi-book-open-variant"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num" style="color: var(--yellow);">{{ $stats['total_fatwa'] ?? 0 }}</div>
                        <div class="stat-label">Dokumen Fatwa</div>
                        <div class="stat-sub text-muted">
                            <i class="mdi mdi-file-document-outline"></i> Naskah & Keputusan
                        </div>
                    </div>
                </a>
            </div>
        @endif

        @if(auth()->user()->hasMenuPermission('surat'))
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('operator.surat.index') }}" class="stat-card-custom">
                    <div class="stat-icon-wrap purple">
                        <i class="mdi mdi-email-outline"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <div class="stat-num" style="color: var(--purple);">{{ $stats['total_surat'] ?? 0 }}</div>
                        <div class="stat-label">Arsip Surat</div>
                        <div class="stat-sub text-muted">
                            <i class="mdi mdi-folder-outline"></i> Surat Masuk & Keluar
                        </div>
                    </div>
                </a>
            </div>
        @endif
    </div>

    {{-- ===== WORK QUEUES & OPERATIONAL PANELS ===== --}}
    <div class="row g-3">

        {{-- KOLOM UTAMA: DAFTAR TUGAS DAN ANTRIAN --}}
        <div class="col-lg-8">

            {{-- 1. ANTRIAN LIVE CHAT REALTIME --}}
            @if(auth()->user()->hasMenuPermission('livechat'))
                <div class="panel-card">
                    <div class="panel-header">
                        <h5>
                            <i class="mdi mdi-chat-processing text-danger"></i>
                            Antrian Live Chat Menunggu Respon
                            @if(isset($operatorData['waiting_chats']) && count($operatorData['waiting_chats']) > 0)
                                <span class="badge badge-danger ml-2" style="font-size: 11px;">{{ count($operatorData['waiting_chats']) }} Menunggu</span>
                            @endif
                        </h5>
                        <a href="{{ route('admin.livechat.index') }}" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                            <i class="mdi mdi-open-in-new mr-1"></i> Buka Panel Live Chat
                        </a>
                    </div>
                    <div class="panel-body p-0">
                        @if(isset($operatorData['waiting_chats']) && count($operatorData['waiting_chats']) > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Pengunjung</th>
                                            <th>Kontak</th>
                                            <th>Waktu Menunggu</th>
                                            <th class="text-right">Aksi Layani</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($operatorData['waiting_chats'] as $chat)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs mr-2">
                                                            <span class="avatar-title rounded-circle bg-soft-danger text-danger font-weight-bold" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                                {{ strtoupper(substr($chat->nama_pengunjung, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <strong class="text-dark d-block">{{ $chat->nama_pengunjung }}</strong>
                                                            <small class="text-muted">Topik: {{ $chat->topik ?: 'Layanan Umum' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="d-block small text-dark"><i class="mdi mdi-email-outline mr-1 text-muted"></i>{{ $chat->email_pengunjung ?: '-' }}</span>
                                                    @if($chat->nohp_pengunjung)
                                                        <span class="d-block small text-muted"><i class="mdi mdi-phone mr-1"></i>{{ $chat->nohp_pengunjung }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge-urgent">
                                                        <i class="mdi mdi-clock-fast"></i> {{ $chat->created_at->diffForHumans() }}
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.livechat.show', $chat->id) }}" class="btn btn-sm btn-danger px-3" style="border-radius: 6px; font-weight: 600;">
                                                        <i class="mdi mdi-chat-alert mr-1"></i> Balas Chat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-check-circle-outline text-success" style="font-size: 38px;"></i>
                                <p class="mb-0 mt-2 font-weight-bold">Tidak ada antrian chat saat ini.</p>
                                <small>Semua obrolan masyarakat telah ditangani dengan baik.</small>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sesi Chat Aktif yang Ditangani Saya --}}
                @if(isset($operatorData['my_active_chats']) && count($operatorData['my_active_chats']) > 0)
                    <div class="panel-card">
                        <div class="panel-header">
                            <h5>
                                <i class="mdi mdi-account-voice text-success"></i>
                                Obrolan yang Sedang Anda Tangani
                            </h5>
                        </div>
                        <div class="panel-body p-0">
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Nama Jamaah</th>
                                            <th>Dimulai</th>
                                            <th>Status</th>
                                            <th class="text-right">Masuk Room</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($operatorData['my_active_chats'] as $myChat)
                                            <tr>
                                                <td>
                                                    <strong>{{ $myChat->nama_pengunjung }}</strong>
                                                    <div class="small text-muted">{{ $myChat->email_pengunjung }}</div>
                                                </td>
                                                <td>
                                                    <span class="small text-muted">{{ $myChat->created_at->format('H:i') }} WIB</span>
                                                </td>
                                                <td>
                                                    <span class="badge-active-chat">
                                                        <i class="mdi mdi-circle font-size-10"></i> Terhubung
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('admin.livechat.show', $myChat->id) }}" class="btn btn-sm btn-success px-3" style="border-radius: 6px;">
                                                        <i class="mdi mdi-chat-processing mr-1"></i> Buka Obrolan
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- 2. KONSULTASI SYARIAH MENUNGGU JAWABAN --}}
            @if(auth()->user()->hasMenuPermission('konsultasi'))
                <div class="panel-card">
                    <div class="panel-header">
                        <h5>
                            <i class="mdi mdi-forum text-warning"></i>
                            Konsultasi Syariah Menunggu Tanggapan
                        </h5>
                        <a href="{{ route('operator.konsultasi.index') }}" class="btn btn-sm btn-outline-warning" style="border-radius: 8px;">
                            <i class="mdi mdi-format-list-bulleted mr-1"></i> Semua Konsultasi
                        </a>
                    </div>
                    <div class="panel-body p-0">
                        @if(isset($operatorData['pending_konsultasi']) && count($operatorData['pending_konsultasi']) > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Penanya</th>
                                            <th>Topik / Pertanyaan</th>
                                            <th>Tanggal Masuk</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($operatorData['pending_konsultasi'] as $kon)
                                            <tr>
                                                <td>
                                                    <strong class="text-dark d-block">{{ $kon->nama }}</strong>
                                                    <small class="text-muted">{{ $kon->email }}</small>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bold text-dark mb-1">{{ Str::limit($kon->judul ?: 'Pertanyaan Syariah', 45) }}</div>
                                                    <div class="text-muted small" style="max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ Str::limit(strip_tags($kon->pertanyaan), 65) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="small text-muted">{{ $kon->created_at->translatedFormat('d M Y, H:i') }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('operator.konsultasi.show', $kon->id) }}" class="btn btn-sm btn-warning text-dark px-3 font-weight-bold" style="border-radius: 6px;">
                                                        <i class="mdi mdi-reply mr-1"></i> Jawab
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-check-all text-success" style="font-size: 38px;"></i>
                                <p class="mb-0 mt-2 font-weight-bold">Tidak ada pertanyaan konsultasi yang pending.</p>
                                <small>Semua pertanyaan dari masyarakat telah dijawab.</small>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- 3. BERITA & ARTIKEL TERBARU SAYA --}}
            @if(auth()->user()->hasMenuPermission('berita'))
                <div class="panel-card">
                    <div class="panel-header">
                        <h5>
                            <i class="mdi mdi-newspaper text-success"></i>
                            Berita & Artikel Ditulis Saya
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('operator.berita.create') }}" class="btn btn-sm btn-success" style="border-radius: 8px;">
                                <i class="mdi mdi-plus-circle mr-1"></i> Tulis Berita
                            </a>
                            <a href="{{ route('operator.berita.index') }}" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px;">
                                Kelola Semua
                            </a>
                        </div>
                    </div>
                    <div class="panel-body p-0">
                        @if(isset($operatorData['my_berita']) && count($operatorData['my_berita']) > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Judul Berita</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Pembaca</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($operatorData['my_berita'] as $berita)
                                            <tr>
                                                <td>
                                                    <strong class="text-dark d-block">{{ Str::limit($berita->judul, 45) }}</strong>
                                                    <small class="text-muted">{{ $berita->created_at->translatedFormat('d M Y') }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light border text-dark">{{ $berita->kategori ?: 'Umum' }}</span>
                                                </td>
                                                <td>
                                                    @if($berita->status === 'published')
                                                        <span class="badge badge-success font-weight-bold">Terbit</span>
                                                    @else
                                                        <span class="badge badge-warning text-dark font-weight-bold">Draft</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="text-muted small"><i class="mdi mdi-eye mr-1"></i>{{ number_format($berita->views ?? 0) }}</span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('operator.berita.edit', $berita->id) }}" class="btn btn-sm btn-light border" title="Edit Berita">
                                                        <i class="mdi mdi-pencil text-primary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-file-document-edit-outline text-muted" style="font-size: 38px;"></i>
                                <p class="mb-0 mt-2 font-weight-bold">Anda belum mempublikasikan artikel berita.</p>
                                <small>Klik tombol "Tulis Berita" untuk mulai menulis konten berita portal.</small>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- 4. ARSIP FATWA & SURAT (JIKA DIBERI AKSES) --}}
            @if(auth()->user()->hasMenuPermission('fatwa') || auth()->user()->hasMenuPermission('surat'))
                <div class="row g-3">
                    @if(auth()->user()->hasMenuPermission('fatwa'))
                        <div class="col-md-{{ auth()->user()->hasMenuPermission('surat') ? '6' : '12' }}">
                            <div class="panel-card mb-0">
                                <div class="panel-header">
                                    <h5><i class="mdi mdi-book-open-variant text-warning"></i> Fatwa Terkini</h5>
                                    <a href="{{ route('operator.fatwa.index') }}" class="btn btn-xs btn-outline-secondary" style="font-size: 11px;">Lihat</a>
                                </div>
                                <div class="panel-body p-2">
                                    @if(isset($operatorData['latest_fatwa']) && count($operatorData['latest_fatwa']) > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($operatorData['latest_fatwa'] as $fatwa)
                                                <div class="list-group-item px-2 py-2 border-0 border-bottom d-flex align-items-center justify-content-between">
                                                    <div style="min-width: 0;" class="mr-2">
                                                        <span class="d-block font-weight-bold text-dark text-truncate" style="font-size: 13px;">{{ $fatwa->judul }}</span>
                                                        <small class="text-muted">{{ $fatwa->kategori?->nama ?: 'Fatwa' }} · {{ $fatwa->created_at->format('d/m/Y') }}</small>
                                                    </div>
                                                    @if($fatwa->filepdf)
                                                        <a href="{{ asset('uploads/fatwa/'.$fatwa->filepdf) }}" target="_blank" class="btn btn-xs btn-outline-danger" title="Unduh PDF">
                                                            <i class="mdi mdi-file-pdf-box"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted small text-center my-3">Belum ada data fatwa.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(auth()->user()->hasMenuPermission('surat'))
                        <div class="col-md-{{ auth()->user()->hasMenuPermission('fatwa') ? '6' : '12' }}">
                            <div class="panel-card mb-0">
                                <div class="panel-header">
                                    <h5><i class="mdi mdi-email-outline text-primary"></i> Arsip Surat Terkini</h5>
                                    <a href="{{ route('operator.surat.index') }}" class="btn btn-xs btn-outline-secondary" style="font-size: 11px;">Lihat</a>
                                </div>
                                <div class="panel-body p-2">
                                    @if(isset($operatorData['latest_surat']) && count($operatorData['latest_surat']) > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($operatorData['latest_surat'] as $surat)
                                                <div class="list-group-item px-2 py-2 border-0 border-bottom d-flex align-items-center justify-content-between">
                                                    <div style="min-width: 0;" class="mr-2">
                                                        <span class="d-block font-weight-bold text-dark text-truncate" style="font-size: 13px;">{{ $surat->perihal ?: $surat->nomor_surat }}</span>
                                                        <small class="text-muted">{{ $surat->nomor_surat }}</small>
                                                    </div>
                                                    <span class="badge badge-light border">{{ $surat->jenis ?? 'Surat' }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted small text-center my-3">Belum ada arsip surat.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

        </div>

        {{-- KOLOM SAMPING: PROFIL OPERATOR & PINTASAN TUGAS --}}
        <div class="col-lg-4">

            {{-- 1. KARTU PROFIL OPERATOR --}}
            <div class="panel-card">
                <div class="panel-header">
                    <h5><i class="mdi mdi-account-circle text-primary"></i> Identitas Petugas</h5>
                    <span class="badge badge-success font-weight-bold" style="font-size: 11px;">Aktif</span>
                </div>
                <div class="panel-body text-center pt-4">
                    <div class="mb-3 d-flex justify-content-center">
                        @if(auth()->user()->foto_url)
                            <img src="{{ auth()->user()->foto_url }}" alt="Foto" class="user-avatar-lg">
                        @else
                            <div class="user-avatar-initials-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <h5 class="font-weight-bold mb-1 text-dark">{{ auth()->user()->name_gelar ?: auth()->user()->name }}</h5>
                    <p class="text-muted small mb-2"><i class="mdi mdi-at"></i> {{ auth()->user()->username }} · {{ auth()->user()->email }}</p>

                    @if(auth()->user()->no_hp)
                        <div class="d-inline-flex align-items-center gap-1 text-success small font-weight-bold mb-3">
                            <i class="mdi mdi-whatsapp"></i> {{ auth()->user()->no_hp }}
                        </div>
                    @endif

                    <hr style="border-top: 1px dashed #e2e8f0; margin: 16px 0;">

                    <div class="text-left">
                        <label class="font-weight-bold font-size-12 text-uppercase text-muted d-block mb-2">
                            <i class="mdi mdi-shield-check mr-1 text-success"></i> Wewenang Menu Aktif:
                        </label>
                        <div class="d-flex flex-wrap">
                            @foreach(\App\Models\User::OPERATOR_PERMISSIONS as $pKey => $pVal)
                                @if(auth()->user()->hasMenuPermission($pKey))
                                    <span class="duty-chip active">
                                        <i class="{{ $pVal['icon'] }}"></i> {{ $pVal['label'] }}
                                    </span>
                                @endif
                            @endforeach
                            @if(count($assignedPerms) === 0)
                                <span class="text-muted small font-italic">Belum ada wewenang menu aktif.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. PINTASAN TUGAS OPERASIONAL (QUICK ACCESS) --}}
            <div class="panel-card">
                <div class="panel-header">
                    <h5><i class="mdi mdi-lightning-bolt text-warning"></i> Menu Operasional Saya</h5>
                </div>
                <div class="panel-body">
                    @php $hasMenu = false; @endphp
                    @foreach(\App\Models\User::OPERATOR_PERMISSIONS as $permKey => $perm)
                        @if(auth()->user()->hasMenuPermission($permKey))
                            @php $hasMenu = true; @endphp
                            <a href="{{ route($perm['route']) }}" class="quick-link-box">
                                <div class="ql-icon"><i class="{{ $perm['icon'] }}"></i></div>
                                <div class="ql-info">
                                    <span class="ql-title">{{ $perm['label'] }}</span>
                                    <span class="ql-desc">{{ $perm['description'] }}</span>
                                </div>
                                <i class="mdi mdi-arrow-right text-muted" style="font-size: 18px;"></i>
                            </a>
                        @endif
                    @endforeach

                    @if(! $hasMenu)
                        <div class="text-center py-3 text-muted">
                            <i class="mdi mdi-lock-outline text-muted" style="font-size: 32px;"></i>
                            <p class="small mb-0 mt-1">Tidak ada menu yang dapat dibuka.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 3. PANDUAN RINGKAS PETUGAS --}}
            <div class="panel-card" style="background: linear-gradient(180deg, #ffffff 0%, #f7faf9 100%);">
                <div class="panel-header">
                    <h5><i class="mdi mdi-information-outline text-info"></i> Petunjuk Pelayanan</h5>
                </div>
                <div class="panel-body" style="font-size: 13px; line-height: 1.6; color: #475569;">
                    <div class="d-flex align-items-start mb-2">
                        <i class="mdi mdi-check-circle text-success mr-2 mt-1"></i>
                        <span>Prioritaskan menjawab <strong>Live Chat</strong> dan <strong>Konsultasi Syariah</strong> dengan bahasa santun dan islami.</span>
                    </div>
                    <div class="d-flex align-items-start mb-2">
                        <i class="mdi mdi-check-circle text-success mr-2 mt-1"></i>
                        <span>Pastikan setiap berita yang dipublikasikan telah terverifikasi sumber dan kategorinya.</span>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="mdi mdi-check-circle text-success mr-2 mt-1"></i>
                        <span>Jaga kerahasiaan data pribadi masyarakat yang melakukan konsultasi ataupun live chat.</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
