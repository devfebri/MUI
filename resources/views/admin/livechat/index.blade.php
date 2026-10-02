@extends('layouts.master')

@section('title', 'Live Chat Petugas')

@section('css')
<style>
    :root {
        --green:      #007f5f;
        --green-dark: #005f47;
        --green-light:#00a878;
        --green-pale: #e8f5f1;
        --gold:       #c9a84c;
        --gold-light: #f5eedb;
        --red:        #ef4444;
        --yellow:     #f0a500;
        --blue:       #2563eb;
        --text:       #1a1a2e;
        --gray:       #6b7280;
        --bg:         #f4f7f6;
        --white:      #ffffff;
        --radius:     14px;
        --radius-sm:  9px;
        --shadow:     0 2px 16px rgba(0,0,0,.07);
        --tr:         .22s cubic-bezier(.4,0,.2,1);
    }

    body { background: var(--bg) !important; }

    /* PAGE HEADER */
    .livechat-header {
        background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 60%, var(--green-light) 100%);
        border-radius: var(--radius);
        padding: 24px 28px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        box-shadow: 0 6px 20px rgba(0,127,95,.18);
        color: #fff;
    }

    .livechat-header-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .livechat-header-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, .15);
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .livechat-header h4 {
        font-size: 20px;
        font-weight: 800;
        margin: 0;
        color: #fff;
    }

    .livechat-header p {
        margin: 4px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, .85);
    }

    /* STATS CARDS */
    .stats-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 18px 20px;
        border: 1px solid #eef2f0;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .stats-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }

    .stats-waiting { background: #fef3c7; color: #d97706; }
    .stats-active { background: #d1fae5; color: #059669; }
    .stats-history { background: #e0e7ff; color: #4338ca; }

    .stats-info h3 {
        font-size: 22px;
        font-weight: 800;
        margin: 0;
        color: var(--text);
    }

    .stats-info span {
        font-size: 12.5px;
        color: var(--gray);
        font-weight: 500;
    }

    /* TABS */
    .nav-livechat {
        display: flex;
        gap: 8px;
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 24px;
        overflow-x: auto;
        padding-bottom: 2px;
    }

    .nav-livechat-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: var(--radius-sm) var(--radius-sm) 0 0;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none !important;
        border-bottom: 3px solid transparent;
        transition: all var(--tr);
        white-space: nowrap;
    }

    .nav-livechat-link:hover {
        color: var(--green);
        background: var(--green-pale);
    }

    .nav-livechat-link.active {
        color: var(--green-dark);
        border-bottom-color: var(--green);
        background: #fff;
    }

    /* CARDS */
    .chat-panel-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid #eef2f0;
        padding: 24px;
        margin-bottom: 30px;
    }

    /* WAITING QUEUE CARD */
    .queue-item {
        background: #ffffff;
        border: 1px solid #e5ebe8;
        border-left: 4px solid #f59e0b;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        transition: all var(--tr);
    }

    .queue-item:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,.08);
        border-color: var(--green);
    }

    .queue-badge-number {
        font-size: 15px;
        font-weight: 800;
        color: #d97706;
        background: #fef3c7;
        padding: 4px 12px;
        border-radius: 8px;
    }

    .btn-take-chat {
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 13.5px;
        font-weight: 700;
        border-radius: var(--radius-sm);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,127,95,.2);
        transition: all var(--tr);
    }

    .btn-take-chat:hover {
        opacity: 0.95;
        transform: translateY(-1px);
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="livechat-header">
        <div class="livechat-header-title">
            <div class="livechat-header-icon">
                <i class="mdi mdi-forum"></i>
            </div>
            <div>
                <h4>Layanan Live Chat & Antrian Online</h4>
                <p>Respon pesan masyarakat secara real-time dan kelola antrian interaksi.</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-light btn-sm font-weight-bold" id="btn-toggle-sound" onclick="enableAudioNotifications()">
                <i class="mdi mdi-bell-ring mr-1 text-success"></i> <span id="sound-btn-text">Aktifkan Notifikasi Suara</span>
            </button>
            <a href="{{ route('admin.pengaturan.index', ['tab' => 'livechat']) }}" class="btn btn-outline-light btn-sm ml-2">
                <i class="mdi mdi-clock-outline mr-1"></i> Jam Operasional
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: var(--radius-sm);">
            <i class="mdi mdi-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Stats Row --}}
    <div class="row">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon-box stats-waiting">
                    <i class="mdi mdi-account-clock"></i>
                </div>
                <div class="stats-info">
                    <h3 id="stat-waiting-count">{{ $waitingSessions->count() }}</h3>
                    <span>Antrian Menunggu Balasan</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon-box stats-active">
                    <i class="mdi mdi-chat-processing"></i>
                </div>
                <div class="stats-info">
                    <h3 id="stat-active-count">{{ $activeSessions->count() }}</h3>
                    <span>Percakapan Sedang Aktif</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon-box stats-history">
                    <i class="mdi mdi-history"></i>
                </div>
                <div class="stats-info">
                    <h3>{{ $historySessions->total() }}</h3>
                    <span>Riwayat Sesi Tersimpan</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs Nav --}}
    <div class="nav-livechat">
        <a href="{{ route('admin.livechat.index', ['tab' => 'antrian']) }}"
           class="nav-livechat-link {{ $tab === 'antrian' ? 'active' : '' }}">
            <i class="mdi mdi-account-multiple-outline"></i>
            <span>Antrian Menunggu</span>
            @if($waitingSessions->count() > 0)
                <span class="badge badge-warning ml-1 font-weight-bold" id="badge-tab-waiting">{{ $waitingSessions->count() }}</span>
            @endif
        </a>
        <a href="{{ route('admin.livechat.index', ['tab' => 'aktif']) }}"
           class="nav-livechat-link {{ $tab === 'aktif' ? 'active' : '' }}">
            <i class="mdi mdi-forum-outline"></i>
            <span>Chat Berlangsung</span>
            @if($activeSessions->count() > 0)
                <span class="badge badge-success ml-1 font-weight-bold">{{ $activeSessions->count() }}</span>
            @endif
        </a>
        <a href="{{ route('admin.livechat.index', ['tab' => 'riwayat']) }}"
           class="nav-livechat-link {{ $tab === 'riwayat' ? 'active' : '' }}">
            <i class="mdi mdi-database-outline"></i>
            <span>Riwayat & Ekspor</span>
        </a>
        <a href="{{ route('admin.livechat.index', ['tab' => 'faq']) }}"
           class="nav-livechat-link {{ $tab === 'faq' ? 'active' : '' }}">
            <i class="mdi mdi-robot-outline"></i>
            <span>FAQ Chatbot Otomatis</span>
        </a>
    </div>

    {{-- TAB 1: Antrian Menunggu --}}
    @if($tab === 'antrian')
        <div class="chat-panel-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="font-weight-bold mb-0 text-success">
                    <i class="mdi mdi-clock-alert mr-1"></i> Daftar Antrian Masuk dari Masyarakat
                </h5>
                <span class="text-muted small">
                    <i class="mdi mdi-sync mr-1"></i> Memeriksa otomatis setiap beberapa detik
                </span>
            </div>

            <div id="waiting-queue-container">
                @forelse($waitingSessions as $session)
                    <div class="queue-item" id="session-card-{{ $session->id }}">
                        <div class="d-flex align-items-center gap-3">
                            <span class="queue-badge-number">#{{ $session->antrian_nomor }}</span>
                            <div class="ml-2">
                                <h6 class="font-weight-bold mb-1">{{ $session->nama_pengunjung }}</h6>
                                <div class="text-muted small">
                                    <span class="mr-3"><i class="mdi mdi-tag mr-1 text-primary"></i> {{ $session->topik ?: 'Layanan Umum' }}</span>
                                    <span class="mr-3"><i class="mdi mdi-whatsapp mr-1 text-success"></i> {{ $session->nohp_pengunjung ?: '-' }}</span>
                                    <span><i class="mdi mdi-clock mr-1"></i> {{ $session->created_at->diffForHumans() }}</span>
                                </div>
                                @if($session->messages->first())
                                    <div class="mt-2 text-dark font-italic bg-light p-2 rounded small" style="max-width: 600px;">
                                        "{{ Str::limit($session->messages->first()->pesan, 120) }}"
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            {{-- Requirement 2: Tombol Balas untuk berinteraksi --}}
                            <form action="{{ route('admin.livechat.take', $session->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-take-chat">
                                    <i class="mdi mdi-chat-outline"></i> Balas Chat
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="mdi mdi-check-circle-outline text-success" style="font-size: 48px;"></i>
                        <h6 class="font-weight-bold mt-2">Tidak ada antrian yang menunggu saat ini</h6>
                        <p class="small">Pemberitahuan suara akan berbunyi otomatis saat ada pesan baru dari masyarakat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    {{-- TAB 2: Chat Berlangsung --}}
    @if($tab === 'aktif')
        <div class="chat-panel-card">
            <h5 class="font-weight-bold mb-4 text-success">
                <i class="mdi mdi-chat-processing mr-1"></i> Percakapan yang Sedang Berlangsung
            </h5>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>No. Antrian</th>
                            <th>Masyarakat / Pengunjung</th>
                            <th>Topik</th>
                            <th>Petugas Pelayan</th>
                            <th>Aktivitas Terakhir</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeSessions as $active)
                            <tr>
                                <td><span class="badge badge-success font-weight-bold">#{{ $active->antrian_nomor }}</span></td>
                                <td>
                                    <strong>{{ $active->nama_pengunjung }}</strong><br>
                                    <small class="text-muted">{{ $active->nohp_pengunjung ?: '-' }}</small>
                                </td>
                                <td>{{ $active->topik ?: 'Umum' }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ $active->operator ? ($active->operator->name_gelar ?: $active->operator->name) : 'Belum Ada' }}</span>
                                </td>
                                <td>{{ $active->last_activity_at ? $active->last_activity_at->diffForHumans() : '-' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.livechat.show', $active->id) }}" class="btn btn-primary btn-sm font-weight-bold">
                                        <i class="mdi mdi-forum mr-1"></i> Buka Chat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada sesi percakapan aktif.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- TAB 3: Riwayat & Ekspor --}}
    @if($tab === 'riwayat')
        <div class="chat-panel-card">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                <h5 class="font-weight-bold mb-0 text-success">
                    <i class="mdi mdi-history mr-1"></i> Riwayat Percakapan
                </h5>

                <div class="d-flex align-items-center gap-2">
                    {{-- Requirement 4: Export CSV --}}
                    <a href="{{ route('admin.livechat.export-csv') }}" class="btn btn-success btn-sm font-weight-bold">
                        <i class="mdi mdi-file-delimited mr-1"></i> Unduh / Export CSV
                    </a>
                </div>
            </div>

            {{-- Filter & Pencarian --}}
            <form action="{{ route('admin.livechat.index') }}" method="GET" class="mb-4">
                <input type="hidden" name="tab" value="riwayat">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           class="form-control"
                           placeholder="Cari berdasarkan nama pengunjung, email, nohp, atau token...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-magnify mr-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>No. Antrian</th>
                            <th>Tanggal</th>
                            <th>Pengunjung</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th>Jumlah Pesan</th>
                            <th class="text-right">Transkrip</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historySessions as $item)
                            <tr>
                                <td><strong>#{{ $item->antrian_nomor }}</strong></td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <strong>{{ $item->nama_pengunjung }}</strong><br>
                                    <small class="text-muted">{{ $item->nohp_pengunjung ?: $item->email_pengunjung ?: '-' }}</small>
                                </td>
                                <td>
                                    @if($item->status === 'selesai')
                                        <span class="badge badge-secondary">Selesai</span>
                                    @elseif($item->status === 'bot')
                                        <span class="badge badge-info">FAQ Bot</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->operator ? ($item->operator->name_gelar ?: $item->operator->name) : 'MUI Bot' }}
                                </td>
                                <td>{{ $item->messages->count() }} pesan</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.livechat.transcript', $item->id) }}" target="_blank" class="btn btn-outline-info btn-xs py-1 px-2 font-weight-bold">
                                        <i class="mdi mdi-printer mr-1"></i> Cetak / Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Tidak ada data riwayat percakapan yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $historySessions->links() }}
            </div>
        </div>
    @endif

    {{-- TAB 4: FAQ Chatbot --}}
    @if($tab === 'faq')
        <div class="chat-panel-card">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h5 class="font-weight-bold mb-1 text-success">
                        <i class="mdi mdi-robot mr-1"></i> Manajemen Pertanyaan Umum (FAQ Chatbot)
                    </h5>
                    <p class="text-muted small mb-0">Pertanyaan ini akan otomatis dijawab oleh bot saat pengunjung bertanya atau saat di luar jam kerja.</p>
                </div>
                <button type="button" class="btn btn-success btn-sm font-weight-bold" data-toggle="modal" data-target="#modalAddFaq">
                    <i class="mdi mdi-plus-circle mr-1"></i> Tambah FAQ Baru
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 50px;">Urutan</th>
                            <th>Kategori</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban Ringkas</th>
                            <th class="text-right" style="width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                            <tr>
                                <td><span class="badge badge-light border">{{ $faq->urutan }}</span></td>
                                <td><span class="badge badge-primary">{{ $faq->kategori ?: 'Umum' }}</span></td>
                                <td class="font-weight-bold">{{ $faq->pertanyaan }}</td>
                                <td class="small text-muted">{{ Str::limit($faq->jawaban, 100) }}</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-warning btn-xs py-1 px-2" data-toggle="modal" data-target="#modalEditFaq{{ $faq->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.livechat.faq.destroy', $faq->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus FAQ ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs py-1 px-2">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit FAQ --}}
                            <div class="modal fade" id="modalEditFaq{{ $faq->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form action="{{ route('admin.livechat.faq.update', $faq->id) }}" method="POST" class="modal-content">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title font-weight-bold">Edit FAQ Chatbot</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Pertanyaan <span class="text-danger">*</span></label>
                                                <input type="text" name="pertanyaan" class="form-control" value="{{ $faq->pertanyaan }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Kategori</label>
                                                <input type="text" name="kategori" class="form-control" value="{{ $faq->kategori }}" placeholder="Contoh: Fatwa, Halal, Konsultasi">
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Jawaban Chatbot <span class="text-danger">*</span></label>
                                                <textarea name="jawaban" class="form-control" rows="4" required>{{ $faq->jawaban }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Urutan Tampil</label>
                                                <input type="number" name="urutan" class="form-control" value="{{ $faq->urutan }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success btn-sm">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada FAQ Chatbot.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Tambah FAQ --}}
        <div class="modal fade" id="modalAddFaq" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('admin.livechat.faq.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header bg-light">
                        <h5 class="modal-title font-weight-bold">Tambah FAQ Chatbot Baru</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Pertanyaan <span class="text-danger">*</span></label>
                            <input type="text" name="pertanyaan" class="form-control" placeholder="Contoh: Berapa biaya permohonan sertifikasi halal?" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Contoh: Konsultasi, Halal, Fatwa, Umum">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Jawaban Chatbot <span class="text-danger">*</span></label>
                            <textarea name="jawaban" class="form-control" rows="4" placeholder="Tuliskan jawaban yang akan diberikan oleh chatbot..." required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    let lastKnownWaitingId = null;
    let audioEnabled = false;

    // Web Audio API Chime generator
    function playOperatorBell() {
        if (!audioEnabled) return;
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);

            osc.frequency.setValueAtTime(800, ctx.currentTime);
            osc.frequency.setValueAtTime(1200, ctx.currentTime + 0.15);
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);

            osc.start(ctx.currentTime);
            osc.stop(ctx.currentTime + 0.5);
        } catch(e) {}
    }

    window.enableAudioNotifications = function() {
        audioEnabled = true;
        playOperatorBell();
        $('#sound-btn-text').text('Notifikasi Suara Aktif');

        if ("Notification" in window && Notification.permission !== "granted") {
            Notification.requestPermission();
        }
    };

    // Polling antrian via jQuery AJAX
    function pollQueueOverview() {
        $.ajax({
            url: "{{ route('admin.livechat.poll-overview') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#stat-waiting-count').text(data.waiting_count);
                $('#stat-active-count').text(data.my_active_count);
                $('#badge-tab-waiting').text(data.waiting_count);

                if (data.latest_waiting_id && data.latest_waiting_id !== lastKnownWaitingId) {
                    if (lastKnownWaitingId !== null) {
                        playOperatorBell();
                        if ("Notification" in window && Notification.permission === "granted") {
                            new Notification("Antrian Chat Baru Masuk", {
                                body: "Pengunjung: " + (data.latest_waiting_name || 'Masyarakat') + " membutuhkan bantuan.",
                                icon: "{{ asset('gambar/mui.png') }}"
                            });
                        }
                    }
                    lastKnownWaitingId = data.latest_waiting_id;
                }
            }
        });
    }

    setInterval(pollQueueOverview, 3000);
});
</script>
@endsection
