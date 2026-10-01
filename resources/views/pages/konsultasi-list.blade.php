@extends('layouts.frontend')

@section('title')
@if($kategoriAktif) Kategori {{ $kategoriAktif }} — @elseif($search) Pencarian: "{{ $search }}" — @endif Konsultasi Syariah & Tanya Ulama — MUI Digital
@endsection

@section('meta_description', 'Kumpulan tanya jawab hukum Islam, bimbingan syariah, dan fatwa keagamaan terpercaya dari dewan ulama MUI Digital.')

@section('content')
<style>
    /* ── PAGE BANNER ── */
    .konsul-banner {
        background: linear-gradient(135deg, var(--green-dark, #005f47) 0%, var(--green, #007f5f) 55%, var(--green-light, #00a878) 100%);
        padding: 50px 0 45px;
        position: relative;
        overflow: hidden;
        color: #fff;
        margin-bottom: 35px;
    }
    .konsul-banner::before {
        content: 'فَاسْأَلُوا أَهْلَ الذِّكْرِ';
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 85px;
        color: rgba(255, 255, 255, 0.07);
        pointer-events: none;
        white-space: nowrap;
        line-height: 1;
    }
    .konsul-banner h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
        color: #fff;
    }
    .konsul-banner p {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.88);
        max-width: 680px;
        margin-bottom: 18px;
        line-height: 1.6;
    }
    .konsul-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
    }
    .konsul-breadcrumb a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
    }
    .konsul-breadcrumb a:hover {
        color: var(--gold, #c9a84c);
    }
    .konsul-breadcrumb span {
        color: rgba(255, 255, 255, 0.5);
    }

    /* ── FILTER & SEARCH TOOLBAR ── */
    .konsul-toolbar {
        background: #fff;
        border-radius: var(--radius, 12px);
        padding: 18px 22px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.06);
        margin-bottom: 28px;
    }
    .konsul-search-form {
        display: flex;
        gap: 10px;
        width: 100%;
    }
    .konsul-search-input {
        flex: 1;
        border: 1.5px solid #e2e8f0;
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 14px;
        outline: none;
        transition: all 0.2s;
    }
    .konsul-search-input:focus {
        border-color: var(--green, #007f5f);
        box-shadow: 0 0 0 3px rgba(0, 127, 95, 0.15);
    }
    .btn-konsul-search {
        background: var(--green, #007f5f);
        color: #fff;
        border: none;
        border-radius: 30px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-konsul-search:hover {
        background: var(--green-dark, #005f47);
        color: #fff;
    }
    .btn-ajukan-baru {
        background: linear-gradient(135deg, #c9a84c, #b38f32);
        color: #1a2e25;
        border: none;
        border-radius: 30px;
        padding: 10px 22px;
        font-weight: 700;
        font-size: 13.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(201, 168, 76, 0.25);
        transition: all 0.2s;
    }
    .btn-ajukan-baru:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(201, 168, 76, 0.35);
        color: #1a2e25;
    }

    /* ── STATUS TABS ── */
    .status-tabs {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .status-tab {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        background: #f1f5f9;
        color: #475569;
        transition: all 0.2s;
    }
    .status-tab:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
    .status-tab.active {
        background: var(--green, #007f5f);
        color: #fff;
    }
    .status-tab .tab-badge {
        font-size: 11px;
        background: rgba(0, 0, 0, 0.08);
        padding: 1px 7px;
        border-radius: 12px;
    }
    .status-tab.active .tab-badge {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    /* ── KATEGORI PILLS SCROLLER ── */
    .kat-scroll-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 10px;
        margin-bottom: 25px;
        scrollbar-width: thin;
    }
    .kat-scroll-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
        padding: 6px 14px;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 600;
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #475569;
        text-decoration: none !important;
        transition: all 0.18s;
        flex-shrink: 0;
    }
    .kat-scroll-pill:hover {
        border-color: var(--green, #007f5f);
        color: var(--green, #007f5f);
    }
    .kat-scroll-pill.active {
        background: var(--green-pale, #e8f5f1);
        border-color: var(--green, #007f5f);
        color: var(--green-dark, #005f47);
        font-weight: 700;
    }

    /* ── CONSULTATION CARDS ── */
    .konsul-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
        gap: 22px;
        margin-bottom: 35px;
    }
    .konsul-card {
        background: #fff;
        border-radius: var(--radius, 14px);
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        padding: 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s ease;
        position: relative;
    }
    .konsul-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(0, 127, 95, 0.12);
        border-color: rgba(0, 127, 95, 0.25);
    }
    .konsul-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        gap: 8px;
    }
    .badge-kat {
        background: var(--green-pale, #e8f5f1);
        color: var(--green-dark, #005f47);
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .badge-status.dijawab {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
    }
    .badge-status.pending {
        background: #fef9c3;
        color: #a16207;
        border: 1px solid #fde047;
    }

    .konsul-question {
        font-size: 15.5px;
        font-weight: 700;
        color: #1a1a2e;
        line-height: 1.45;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .konsul-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        color: #64748b;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }
    .konsul-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Jawaban quote snippet */
    .konsul-answer-box {
        background: #f8fafc;
        border-left: 3px solid var(--green, #007f5f);
        border-radius: 6px;
        padding: 12px 14px;
        margin-bottom: 16px;
        font-size: 13px;
        color: #334155;
        line-height: 1.55;
        position: relative;
    }
    .konsul-answer-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 6px;
    }
    .konsul-answer-by {
        font-size: 11px;
        font-weight: 700;
        color: var(--green-dark, #005f47);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .konsul-card-footer {
        border-top: 1px solid #f1f5f9;
        padding-top: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .btn-detail-link {
        font-size: 13px;
        font-weight: 700;
        color: var(--green, #007f5f);
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }
    .btn-detail-link:hover {
        color: var(--green-dark, #005f47);
        gap: 8px;
    }

    /* ── BOTTOM CTA CARD ── */
    .konsul-cta-banner {
        background: linear-gradient(135deg, #005f47 0%, #007f5f 100%);
        border-radius: var(--radius, 16px);
        padding: 35px 30px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        box-shadow: 0 10px 30px rgba(0, 95, 71, 0.2);
        margin-top: 20px;
        margin-bottom: 50px;
    }
    .konsul-cta-banner h3 {
        font-size: 22px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
    }
    .konsul-cta-banner p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 0;
        max-width: 580px;
    }

    /* Empty state */
    .empty-konsul {
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: var(--radius, 14px);
        border: 1px dashed #cbd5e1;
        margin-bottom: 30px;
    }
    .empty-konsul i {
        font-size: 54px;
        color: #94a3b8;
        margin-bottom: 16px;
    }
    .empty-konsul h4 {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .empty-konsul p {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 20px;
    }
</style>

{{-- ── HERO BANNER ── --}}
<div class="konsul-banner">
    <div class="mui-shell">
        <nav class="konsul-breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.public') }}"><i class="fas fa-home"></i> Beranda</a>
            <span>/</span>
            <strong>Konsultasi Syariah</strong>
        </nav>
        <h1 class="mt-2">Daftar Konsultasi Syariah & Tanya Ulama</h1>
        <p>
            Koleksi tanya jawab seputar ibadah, muamalah, akidah, pernikahan, zakat, dan fatwa hukum Islam terpercaya langsung dari para ulama dan dewan pakar MUI.
        </p>
    </div>
</div>

<div class="mui-shell">

    {{-- ── TOOLBAR PENCARIAN & CTA AJUKAN PERTANYAAN ── --}}
    <div class="konsul-toolbar">
        <div class="row g-3 align-items-center">
            <div class="col-lg-8">
                <form action="{{ route('konsultasi.list') }}" method="GET" class="konsul-search-form">
                    @if($statusAktif)
                        <input type="hidden" name="status" value="{{ $statusAktif }}">
                    @endif
                    @if($kategoriAktif)
                        <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
                    @endif
                    <input type="text"
                           name="q"
                           value="{{ $search }}"
                           class="konsul-search-input"
                           placeholder="Cari topik pertanyaan, kata kunci masalah syariah, atau nama daerah...">
                    <button type="submit" class="btn-konsul-search">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    @if($search || $kategoriAktif || $statusAktif)
                        <a href="{{ route('konsultasi.list') }}" class="btn btn-light rounded-pill px-3 d-inline-flex align-items-center" title="Reset Semua Filter" style="border: 1px solid #e2e8f0; font-size: 13px;">
                            <i class="fas fa-times text-danger"></i>
                        </a>
                    @endif
                </form>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('tanya-ulama') }}" class="btn-ajukan-baru">
                    <i class="fas fa-paper-plane"></i> Tanya Ulama Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- ── FILTER TABS STATUS ── --}}
    <div class="status-tabs">
        <span class="text-muted small fw-bold me-1"><i class="fas fa-filter"></i> Status:</span>
        <a href="{{ route('konsultasi.list', array_filter(['q' => $search, 'kategori' => $kategoriAktif])) }}"
           class="status-tab {{ !$statusAktif ? 'active' : '' }}">
            <span>Semua Konsultasi</span>
            <span class="tab-badge">{{ $totalSemua }}</span>
        </a>
        <a href="{{ route('konsultasi.list', array_filter(['q' => $search, 'kategori' => $kategoriAktif, 'status' => 'dijawab'])) }}"
           class="status-tab {{ $statusAktif === 'dijawab' ? 'active' : '' }}">
            <i class="fas fa-check-circle text-success"></i>
            <span>Telah Dijawab</span>
            <span class="tab-badge">{{ $totalDijawab }}</span>
        </a>
        <a href="{{ route('konsultasi.list', array_filter(['q' => $search, 'kategori' => $kategoriAktif, 'status' => 'pending'])) }}"
           class="status-tab {{ $statusAktif === 'pending' ? 'active' : '' }}">
            <i class="fas fa-clock text-warning"></i>
            <span>Dalam Kajian</span>
            <span class="tab-badge">{{ $totalPending }}</span>
        </a>
    </div>

    {{-- ── FILTER KATEGORI SCROLL PILLS ── --}}
    <div class="kat-scroll-wrap">
        <a href="{{ route('konsultasi.list', array_filter(['q' => $search, 'status' => $statusAktif])) }}"
           class="kat-scroll-pill {{ !$kategoriAktif ? 'active' : '' }}">
            Semua Kategori ({{ $totalSemua }})
        </a>
        @foreach($kategoriList as $kat)
            @php $count = $statKategori[$kat] ?? 0; @endphp
            @if($count > 0 || $kategoriAktif === $kat)
                <a href="{{ route('konsultasi.list', array_filter(['q' => $search, 'status' => $statusAktif, 'kategori' => $kat])) }}"
                   class="kat-scroll-pill {{ $kategoriAktif === $kat ? 'active' : '' }}">
                    {{ $kat }} ({{ $count }})
                </a>
            @endif
        @endforeach
    </div>

    {{-- ── DAFTAR KONSULTASI GRID ── --}}
    @if($konsultasis->isEmpty())
        <div class="empty-konsul">
            <i class="fas fa-comments"></i>
            <h4>Tidak Ada Konsultasi yang Sesuai</h4>
            <p>
                @if($search)
                    Tidak ditemukan hasil pencarian untuk "<strong>{{ $search }}</strong>". Silakan gunakan kata kunci lain atau kirim pertanyaan baru.
                @else
                    Belum ada data pertanyaan untuk kategori atau filter yang dipilih.
                @endif
            </p>
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('konsultasi.list') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    Lihat Semua Konsultasi
                </a>
                <a href="{{ route('tanya-ulama') }}" class="btn btn-success btn-sm rounded-pill px-3 font-weight-bold">
                    <i class="fas fa-plus mr-1"></i> Ajukan Pertanyaan
                </a>
            </div>
        </div>
    @else
        <div class="konsul-grid">
            @foreach($konsultasis as $k)
                <div class="konsul-card">
                    <div>
                        <div class="konsul-card-top">
                            <span class="badge-kat">{{ $k->kategori }}</span>
                            @if($k->status === 'dijawab')
                                <span class="badge-status dijawab"><i class="fas fa-check-circle"></i> Dijawab</span>
                            @else
                                <span class="badge-status pending"><i class="fas fa-clock"></i> Dalam Kajian</span>
                            @endif
                        </div>

                        <a href="{{ route('konsultasi.detail', $k->id) }}" style="text-decoration:none; color:inherit;">
                            <h3 class="konsul-question">
                                "{{ $k->pertanyaan }}"
                            </h3>
                        </a>

                        <div class="konsul-meta">
                            <span><i class="fas fa-user-circle"></i> {{ $k->nama }}</span>
                            @if($k->kab_kota)
                                <span><i class="fas fa-map-marker-alt"></i> {{ $k->kab_kota }}</span>
                            @endif
                            <span><i class="fas fa-calendar-alt"></i> {{ $k->created_at->diffForHumans() }}</span>
                        </div>

                        @if($k->jawaban)
                            <div class="konsul-answer-box">
                                <div class="konsul-answer-text">
                                    {{ Str::limit($k->jawaban, 130) }}
                                </div>
                                <div class="konsul-answer-by">
                                    <i class="fas fa-user-check"></i>
                                    {{ $k->penjawab?->name ?? 'Dewan Ulama MUI' }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="konsul-card-footer">
                        <span class="text-muted small">
                            @if($k->status === 'dijawab')
                                Terverifikasi Syariah
                            @else
                                Menunggu Telaah
                            @endif
                        </span>
                        <a href="{{ route('konsultasi.detail', $k->id) }}" class="btn-detail-link">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ── PAGINATION ── --}}
        <div class="d-flex justify-content-center mb-4">
            {{ $konsultasis->links() }}
        </div>
    @endif

    {{-- ── BANNER AJUKAN PERTANYAAN ── --}}
    <div class="konsul-cta-banner">
        <div>
            <h3>Punya Keraguan atau Masalah Keagamaan?</h3>
            <p>
                Tanyakan langsung permasalahan ibadah, muamalah, pernikahan, atau keraguan syariah Anda. Dewan pakar dan ulama Majelis Ulama Indonesia siap memberikan bimbingan sesuai Al-Qur'an dan Sunnah.
            </p>
        </div>
        <div>
            <a href="{{ route('tanya-ulama') }}" class="btn btn-warning font-weight-bold px-4 py-2" style="border-radius: 25px; color: #1a2e25; background: #c9a84c; border:none; box-shadow: 0 4px 15px rgba(0,0,0,.2);">
                <i class="fas fa-comments mr-2"></i> Buat Konsultasi Baru
            </a>
        </div>
    </div>

</div>
@endsection
