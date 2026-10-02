@extends('layouts.master')

@section('title', 'Dashboard Administrator')

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
        background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%);
        border-radius: var(--radius);
        padding: 26px 30px;
        margin-bottom: 24px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        box-shadow: 0 4px 20px rgba(0, 95, 71, 0.2);
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

    .stat-info-wrap .stat-num {
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        line-height: 1.1;
        margin-bottom: 3px;
    }

    .stat-info-wrap .stat-title {
        font-size: 12.5px;
        color: var(--gray);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-info-wrap .stat-note {
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 4px;
    }

    /* Panels */
    .dash-panel {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid #edf2f0;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .dash-panel .panel-head {
        padding: 18px 22px;
        border-bottom: 1px solid #f0f4f3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .dash-panel .panel-head h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dash-panel .panel-body {
        padding: 20px 22px;
    }

    /* Tables in Dashboard */
    .dash-table {
        width: 100%;
        margin-bottom: 0;
    }

    .dash-table th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray);
        padding: 10px 14px;
        border-bottom: 2px solid #f0f4f3;
        background: #fafcfb;
    }

    .dash-table td {
        padding: 12px 14px;
        border-bottom: 1px solid #f4f6f5;
        font-size: 13px;
        color: var(--text);
        vertical-align: middle;
    }

    .dash-table tr:last-child td {
        border-bottom: none;
    }

    .dash-table tr:hover td {
        background: #fbfdfc;
    }

    /* Quick Shortcuts Grid */
    .shortcuts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .shortcut-btn {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 8px;
        color: var(--text);
        text-decoration: none !important;
        font-size: 12px;
        font-weight: 700;
        transition: all var(--transition);
    }

    .shortcut-btn i {
        font-size: 24px;
        color: var(--green);
        transition: transform var(--transition);
    }

    .shortcut-btn:hover {
        background: var(--green-pale);
        border-color: var(--green);
        color: var(--green-dark);
        transform: translateY(-2px);
    }

    .shortcut-btn:hover i {
        transform: scale(1.1);
    }

    /* Operator Mini Item */
    .op-mini-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f4f3;
    }

    .op-mini-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .op-mini-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .op-mini-avatar {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #c9a84c 0%, #f0d080 100%);
        color: #004a36;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 13px;
        overflow: hidden;
    }

    .op-mini-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 24px 30px;">

    {{-- ===== HEADER ===== --}}
    <div class="dashboard-header">
        <div>
            <h4><i class="mdi mdi-view-dashboard mr-1"></i> Dashboard Administrator</h4>
            <p>Assalamu'alaikum, <strong>{{ auth()->user()->name_gelar ?: auth()->user()->name }}</strong> · {{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge-role-tag">
                <i class="mdi mdi-shield-account"></i> Administrator
            </span>
        </div>
    </div>

    {{-- ===== STAT CARDS ROW ===== --}}
    <div class="row g-3 mb-4">
        {{-- 1. Layanan Masyarakat --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <a href="{{ route('admin.livechat.index') }}" class="stat-card-custom">
                <div class="stat-icon-wrap green">
                    <i class="mdi mdi-chat-processing-outline"></i>
                </div>
                <div class="stat-info-wrap">
                    <div class="stat-num">{{ $stats['chat_menunggu'] + $stats['konsultasi_pending'] }}</div>
                    <div class="stat-title">Layanan Perlu Respon</div>
                    <div class="stat-note text-warning">
                        <i class="mdi mdi-clock-alert-outline mr-1"></i>{{ $stats['chat_menunggu'] }} Chat · {{ $stats['konsultasi_pending'] }} Konsultasi
                    </div>
                </div>
            </a>
        </div>

        {{-- 2. Publikasi Berita --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <a href="{{ route('admin.berita.index') }}" class="stat-card-custom">
                <div class="stat-icon-wrap blue">
                    <i class="mdi mdi-newspaper"></i>
                </div>
                <div class="stat-info-wrap">
                    <div class="stat-num">{{ $stats['total_berita'] }}</div>
                    <div class="stat-title">Berita & Artikel</div>
                    <div class="stat-note text-primary">
                        <i class="mdi mdi-eye mr-1"></i>{{ number_format($stats['total_views_berita']) }} Total Pembaca
                    </div>
                </div>
            </a>
        </div>

        {{-- 3. Fatwa & Arsip Surat --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <a href="{{ route('admin.fatwa.index') }}" class="stat-card-custom">
                <div class="stat-icon-wrap yellow">
                    <i class="mdi mdi-book-open-variant"></i>
                </div>
                <div class="stat-info-wrap">
                    <div class="stat-num">{{ $stats['total_fatwa'] }}</div>
                    <div class="stat-title">Dokumen Fatwa</div>
                    <div class="stat-note text-success">
                        <i class="mdi mdi-email-outline mr-1"></i>{{ $stats['total_surat'] }} Arsip Surat
                    </div>
                </div>
            </a>
        </div>

        {{-- 4. Pengguna & Operator --}}
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <a href="{{ route('admin.operator-permissions.index') }}" class="stat-card-custom">
                <div class="stat-icon-wrap purple">
                    <i class="mdi mdi-account-group"></i>
                </div>
                <div class="stat-info-wrap">
                    <div class="stat-num">{{ $stats['total_operator'] }}</div>
                    <div class="stat-title">Operator Bertugas</div>
                    <div class="stat-note text-purple" style="color: var(--purple);">
                        <i class="mdi mdi-account-cog mr-1"></i>Atur Hak Akses
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- ===== MAIN DASHBOARD CONTENT ===== --}}
    <div class="row g-4">

        {{-- LEFT COLUMN: Operasional & Monitoring (col-xl-8) --}}
        <div class="col-xl-8">

            {{-- 1. Monitoring Layanan Warga (Antrian Chat & Konsultasi) --}}
            <div class="dash-panel">
                <div class="panel-head">
                    <h5>
                        <i class="mdi mdi-bell-ring-outline text-warning"></i>
                        Permintaan Layanan Masyarakat Terkini
                    </h5>
                    <div>
                        <a href="{{ route('admin.livechat.index') }}" class="btn btn-sm btn-outline-success font-weight-bold mr-1">
                            <i class="mdi mdi-chat-outline mr-1"></i> Live Chat Panel
                        </a>
                        <a href="{{ route('admin.konsultasi.index') }}" class="btn btn-sm btn-outline-primary font-weight-bold">
                            <i class="mdi mdi-forum-outline mr-1"></i> Konsultasi
                        </a>
                    </div>
                </div>
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Nama Warga</th>
                                    <th>Topik / Perihal</th>
                                    <th>Waktu Masuk</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Antrian Chat Menunggu --}}
                                @foreach($waitingChats as $chat)
                                    <tr>
                                        <td>
                                            <span class="badge badge-warning font-weight-bold">
                                                <i class="mdi mdi-chat-processing mr-1"></i> Live Chat
                                            </span>
                                        </td>
                                        <td class="font-weight-bold text-dark">{{ $chat->nama_pengunjung }}</td>
                                        <td>{{ $chat->topik ?: 'Layanan Umum' }}</td>
                                        <td>{{ $chat->created_at->diffForHumans() }}</td>
                                        <td><span class="badge badge-warning">Antrian #{{ $chat->antrian_nomor }}</span></td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.livechat.show', $chat->id) }}" class="btn btn-sm btn-success font-weight-bold">
                                                <i class="mdi mdi-reply mr-1"></i> Respon
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- Konsultasi Pending --}}
                                @foreach($pendingKonsultasi as $k)
                                    <tr>
                                        <td>
                                            <span class="badge badge-info font-weight-bold">
                                                <i class="mdi mdi-forum mr-1"></i> Tanya Ulama
                                            </span>
                                        </td>
                                        <td class="font-weight-bold text-dark">{{ $k->nama }}</td>
                                        <td>{{ Str::limit($k->pertanyaan, 36) }}</td>
                                        <td>{{ $k->created_at->diffForHumans() }}</td>
                                        <td><span class="badge badge-secondary">Pending</span></td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.konsultasi.show', $k->id) }}" class="btn btn-sm btn-outline-info font-weight-bold">
                                                <i class="mdi mdi-eye mr-1"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($waitingChats->isEmpty() && $pendingKonsultasi->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-check-circle-outline text-success" style="font-size: 28px;"></i>
                                            <p class="mb-0 mt-1 font-weight-bold small">Alhamdulillah, seluruh antrian Live Chat dan pertanyaan konsultasi saat ini telah tertangani.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 2. Berita & Artikel Terbaru --}}
            <div class="dash-panel">
                <div class="panel-head">
                    <h5>
                        <i class="mdi mdi-newspaper-variant-outline text-primary"></i>
                        Publikasi Berita & Artikel Terkini
                    </h5>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary font-weight-bold">
                        Lihat Semua Berita <i class="mdi mdi-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Judul Berita</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestBerita as $berita)
                                    <tr>
                                        <td class="font-weight-bold text-dark" style="max-width: 250px;">
                                            {{ Str::limit($berita->judul, 45) }}
                                        </td>
                                        <td>
                                            <span class="badge badge-light text-dark border">{{ $berita->kategori ?: 'Umum' }}</span>
                                        </td>
                                        <td>{{ $berita->user?->name ?: 'Admin' }}</td>
                                        <td>
                                            @if($berita->status === 'published')
                                                <span class="badge badge-success">Terbit</span>
                                            @else
                                                <span class="badge badge-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td><i class="mdi mdi-eye text-muted mr-1"></i>{{ $berita->views }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Berita">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted small">Belum ada data berita.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 3. Dua Kolom: Fatwa & Arsip Surat Terbaru --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="dash-panel mb-3">
                        <div class="panel-head">
                            <h5 style="font-size: 14px;"><i class="mdi mdi-book-open-variant text-warning"></i> Fatwa Terbaru</h5>
                            <a href="{{ route('admin.fatwa.index') }}" class="small font-weight-bold text-success">Kelola <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                        <div class="panel-body p-2">
                            <ul class="list-unstyled mb-0">
                                @forelse($latestFatwa as $f)
                                    <li class="p-2 border-bottom d-flex justify-content-between align-items-center">
                                        <div style="max-width: 80%;">
                                            <div class="font-weight-bold text-dark small">{{ Str::limit($f->judul, 40) }}</div>
                                            <small class="text-muted">{{ $f->kategoriFatwa?->nama ?: 'Umum' }} · {{ $f->created_at->format('d/m/Y') }}</small>
                                        </div>
                                        @if($f->filepdf)
                                            <a href="{{ asset('uploads/fatwa/'.$f->filepdf) }}" target="_blank" class="btn btn-xs btn-outline-danger" title="Download PDF">
                                                <i class="mdi mdi-file-pdf-box"></i>
                                            </a>
                                        @endif
                                    </li>
                                @empty
                                    <li class="p-3 text-center text-muted small">Belum ada fatwa.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dash-panel mb-3">
                        <div class="panel-head">
                            <h5 style="font-size: 14px;"><i class="mdi mdi-email-outline text-success"></i> Arsip Surat Terbaru</h5>
                            <a href="{{ route('admin.surat.index') }}" class="small font-weight-bold text-success">Kelola <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                        <div class="panel-body p-2">
                            <ul class="list-unstyled mb-0">
                                @forelse($latestSurat as $s)
                                    <li class="p-2 border-bottom d-flex justify-content-between align-items-center">
                                        <div style="max-width: 80%;">
                                            <div class="font-weight-bold text-dark small">{{ Str::limit($s->perihal, 38) }}</div>
                                            <small class="text-muted">No: {{ $s->nomor_surat }} · {{ $s->tanggal_surat ? $s->tanggal_surat->format('d/m/Y') : '' }}</small>
                                        </div>
                                        @if($s->file_surat)
                                            <a href="{{ asset('uploads/surat/'.$s->file_surat) }}" target="_blank" class="btn btn-xs btn-outline-info" title="Download Surat">
                                                <i class="mdi mdi-file-document-outline"></i>
                                            </a>
                                        @endif
                                    </li>
                                @empty
                                    <li class="p-3 text-center text-muted small">Belum ada arsip surat.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN: Pintasan & Pengaturan (col-xl-4) --}}
        <div class="col-xl-4">

            {{-- 1. Pintasan Cepat Admin --}}
            <div class="dash-panel mb-4">
                <div class="panel-head">
                    <h5><i class="mdi mdi-lightning-bolt text-warning"></i> Pintasan Cepat</h5>
                </div>
                <div class="panel-body">
                    <div class="shortcuts-grid">
                        <a href="{{ route('admin.berita.create') }}" class="shortcut-btn">
                            <i class="mdi mdi-pencil-plus"></i>
                            <span>Tulis Berita</span>
                        </a>
                        <a href="{{ route('admin.operator-permissions.index') }}" class="shortcut-btn">
                            <i class="mdi mdi-shield-account"></i>
                            <span>Hak Akses Operator</span>
                        </a>
                        <a href="{{ route('admin.livechat.index') }}" class="shortcut-btn">
                            <i class="mdi mdi-chat-processing"></i>
                            <span>Live Chat</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="shortcut-btn">
                            <i class="mdi mdi-account-multiple-plus"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                        <a href="{{ route('admin.fatwa.index') }}" class="shortcut-btn">
                            <i class="mdi mdi-book-plus"></i>
                            <span>Unggah Fatwa</span>
                        </a>
                        <a href="{{ route('admin.pengaturan.index') }}" class="shortcut-btn">
                            <i class="mdi mdi-cog-outline"></i>
                            <span>Pengaturan Web</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 2. Status Petugas Operator --}}
            <div class="dash-panel mb-4">
                <div class="panel-head">
                    <h5><i class="mdi mdi-account-cog text-success"></i> Operator & Tugas</h5>
                    <a href="{{ route('admin.operator-permissions.index') }}" class="small font-weight-bold text-success">Atur <i class="mdi mdi-chevron-right"></i></a>
                </div>
                <div class="panel-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Operator yang bertugas saat ini:</small>
                    </div>
                    @forelse($operators as $op)
                        @php $assigned = $op->getAssignedPermissions(); @endphp
                        <div class="op-mini-item">
                            <div class="op-mini-info">
                                <div class="op-mini-avatar">
                                    @if($op->foto_url)
                                        <img src="{{ $op->foto_url }}" alt="{{ $op->name }}">
                                    @else
                                        {{ strtoupper(substr($op->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <strong class="d-block text-dark small">{{ $op->name_gelar ?: $op->name }}</strong>
                                    <small class="text-muted">{{ count($assigned) }} menu tugas aktif</small>
                                </div>
                            </div>
                            <span class="badge {{ count($assigned) > 0 ? 'badge-success' : 'badge-danger' }} small">
                                {{ count($assigned) > 0 ? 'Aktif' : 'Nol Tugas' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted small text-center mb-0">Belum ada akun operator.</p>
                    @endforelse
                </div>
            </div>

            {{-- 3. Profil & Status Sistem --}}
            <div class="dash-panel">
                <div class="panel-head">
                    <h5><i class="mdi mdi-server-network text-info"></i> Status Sesi & Sistem</h5>
                </div>
                <div class="panel-body">
                    <table style="width: 100%; font-size: 13px;">
                        <tr>
                            <td class="text-muted py-1" style="width: 45%;">Akun Login:</td>
                            <td class="font-weight-bold text-dark py-1">{{ auth()->user()->username }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Role Autentikasi:</td>
                            <td class="py-1"><span class="badge badge-success">Administrator</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Koneksi Database:</td>
                            <td class="text-success font-weight-bold py-1"><i class="mdi mdi-check-circle mr-1"></i>Terhubung (OK)</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Zona Waktu:</td>
                            <td class="font-weight-bold py-1">{{ config('app.timezone') }} (WIB)</td>
                        </tr>
                        <tr>
                            <td class="text-muted py-1">Waktu Server:</td>
                            <td class="font-weight-bold py-1" id="server-live-clock">{{ now()->format('H:i:s') }} WIB</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    setInterval(function() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
        $('#server-live-clock').text(timeStr + ' WIB');
    }, 1000);
});
</script>
@endsection
