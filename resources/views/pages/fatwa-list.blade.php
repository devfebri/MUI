@extends('layouts.frontend')

@section('title')
@if($kategoriAktif) Kategori Fatwa: {{ $kategoriAktif }} — @elseif($search) Pencarian Fatwa: "{{ $search }}" — @endif Fatwa Majelis Ulama Indonesia — MUI Digital
@endsection

@section('meta_description', 'Kumpulan fatwa resmi Majelis Ulama Indonesia (MUI). Baca langsung dokumen fatwa digital secara online dan terpercaya.')

@section('content')
<style>
    :root {
        --mui-green-dark: #005f47;
        --mui-green: #007f5f;
        --mui-green-light: #00a878;
        --mui-green-pale: #e8f5f1;
        --mui-gold: #c9a84c;
        --mui-gold-pale: #fff8e6;
        --mui-text: #1a1a2e;
        --mui-gray: #64748b;
        --mui-gray-light: #f8fafc;
        --mui-border: #e2e8f0;
        --mui-radius: 14px;
        --mui-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        --mui-shadow-hov: 0 12px 30px rgba(0, 127, 95, 0.12);
        --mui-tr: 0.22s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ── PAGE BANNER ── */
    .fatwa-banner {
        background: linear-gradient(135deg, var(--mui-green-dark) 0%, var(--mui-green) 55%, var(--mui-green-light) 100%);
        padding: 55px 0 50px;
        position: relative;
        overflow: hidden;
        color: #fff;
        margin-bottom: 35px;
    }

    .fatwa-banner::before {
        content: 'فَتَاوَى مُعْتَمَدَة';
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        font-family: 'Amiri', 'Traditional Arabic', serif;
        font-size: 85px;
        color: rgba(255, 255, 255, 0.08);
        pointer-events: none;
        white-space: nowrap;
        line-height: 1;
    }

    .fatwa-banner h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
        color: #fff;
    }

    .fatwa-banner p {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.88);
        max-width: 680px;
        margin-bottom: 18px;
        line-height: 1.6;
    }

    .fatwa-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
    }

    .fatwa-breadcrumb a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
    }

    .fatwa-breadcrumb a:hover {
        color: var(--mui-gold);
    }

    .fatwa-breadcrumb span {
        color: rgba(255, 255, 255, 0.5);
    }

    /* ── TOOLBAR & FILTER ── */
    .fatwa-toolbar {
        background: #fff;
        border-radius: var(--mui-radius);
        padding: 22px 24px;
        box-shadow: var(--mui-shadow);
        border: 1px solid var(--mui-border);
        margin-bottom: 28px;
    }

    .fatwa-search-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .fatwa-search-box {
        flex: 1;
        min-width: 260px;
        position: relative;
    }

    .fatwa-search-input {
        width: 100%;
        border: 1.5px solid var(--mui-border);
        border-radius: 30px;
        padding: 12px 20px 12px 46px;
        font-size: 14.5px;
        outline: none;
        transition: all var(--mui-tr);
        background: #fff;
    }

    .fatwa-search-input:focus {
        border-color: var(--mui-green);
        box-shadow: 0 0 0 3px rgba(0, 127, 95, 0.15);
    }

    .fatwa-search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--mui-gray);
        font-size: 15px;
    }

    .fatwa-filter-selects {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .fatwa-select {
        border: 1.5px solid var(--mui-border);
        border-radius: 24px;
        padding: 10px 18px;
        font-size: 13.5px;
        outline: none;
        background: #fff;
        color: var(--mui-text);
        cursor: pointer;
        transition: all var(--mui-tr);
    }

    .fatwa-select:focus {
        border-color: var(--mui-green);
    }

    .btn-fatwa-submit {
        background: var(--mui-green);
        color: #fff;
        border: none;
        border-radius: 24px;
        padding: 10px 24px;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all var(--mui-tr);
    }

    .btn-fatwa-submit:hover {
        background: var(--mui-green-dark);
        color: #fff;
    }

    .btn-fatwa-reset {
        background: #f1f5f9;
        color: var(--mui-gray);
        border: none;
        border-radius: 24px;
        padding: 10px 18px;
        font-weight: 600;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: all var(--mui-tr);
    }

    .btn-fatwa-reset:hover {
        background: #e2e8f0;
        color: var(--mui-text);
    }

    /* ── STATUS TABS ── */
    .fatwa-status-tabs {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }

    .status-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all var(--mui-tr);
        border: 1px solid var(--mui-border);
        color: var(--mui-gray);
        background: #fff;
    }

    .status-tab:hover {
        border-color: var(--mui-green);
        color: var(--mui-green);
    }

    .status-tab.active {
        background: var(--mui-green);
        color: #fff;
        border-color: var(--mui-green);
    }

    .status-tab.active-warning {
        background: #d97706;
        color: #fff;
        border-color: #d97706;
    }

    .status-tab.active-danger {
        background: #dc2626;
        color: #fff;
        border-color: #dc2626;
    }

    .status-tab-count {
        background: rgba(0, 0, 0, 0.08);
        padding: 2px 7px;
        border-radius: 10px;
        font-size: 11px;
    }

    .status-tab.active .status-tab-count,
    .status-tab.active-warning .status-tab-count,
    .status-tab.active-danger .status-tab-count {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
    }

    /* ── STATS SUMMARY STRIP ── */
    .fatwa-stats-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 14px;
        color: var(--mui-gray);
    }

    /* ── FATWA GRID & CARDS ── */
    .fatwa-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .fatwa-card {
        background: #fff;
        border-radius: var(--mui-radius);
        box-shadow: var(--mui-shadow);
        border: 1px solid var(--mui-border);
        display: flex;
        flex-direction: column;
        transition: all var(--mui-tr);
        position: relative;
        overflow: hidden;
    }

    .fatwa-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--mui-shadow-hov);
        border-color: rgba(0, 127, 95, 0.25);
    }

    .fatwa-card-topbar {
        padding: 18px 20px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge-kat {
        background: var(--mui-green-pale);
        color: var(--mui-green-dark);
        font-size: 11.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-status-fatwa {
        font-size: 11.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-status-fatwa.aktif {
        background: #e8f5f1;
        color: #007f5f;
        border: 1px solid #a7f3d0;
    }

    .badge-status-fatwa.direvisi {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-status-fatwa.digantikan {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .fatwa-card-body {
        padding: 16px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .fatwa-card-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--mui-text);
        line-height: 1.45;
        margin-bottom: 12px;
    }

    .fatwa-card-desc {
        font-size: 13.5px;
        color: var(--mui-gray);
        line-height: 1.6;
        margin-bottom: 16px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .fatwa-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
        font-size: 12.5px;
        color: var(--mui-gray);
    }

    .fatwa-card-footer {
        padding: 12px 20px 18px;
        background: #fafcfb;
        border-top: 1px solid #f1f5f9;
        display: flex;
        gap: 8px;
    }

    .btn-baca-fatwa {
        flex: 1;
        background: var(--mui-green);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all var(--mui-tr);
        text-decoration: none;
    }

    .btn-baca-fatwa:hover {
        background: var(--mui-green-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-baca-fatwa-disabled {
        flex: 1;
        background: #e2e8f0;
        color: #94a3b8;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: not-allowed;
    }

    /* ── EMPTY STATE ── */
    .fatwa-empty {
        background: #fff;
        border-radius: var(--mui-radius);
        padding: 60px 20px;
        text-align: center;
        box-shadow: var(--mui-shadow);
        border: 1px solid var(--mui-border);
        margin: 20px 0 50px;
    }

    .fatwa-empty-icon {
        width: 80px;
        height: 80px;
        background: var(--mui-green-pale);
        color: var(--mui-green);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin-bottom: 20px;
    }

    .fatwa-empty h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--mui-text);
        margin-bottom: 8px;
    }

    .fatwa-empty p {
        color: var(--mui-gray);
        font-size: 14px;
        max-width: 450px;
        margin: 0 auto 20px;
    }

    /* ── PDF VIEWER MODAL ── */
    .pdf-modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(4px);
        z-index: 1050;
        display: none;
        opacity: 0;
        transition: opacity 0.25s ease-in-out;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }

    .pdf-modal-backdrop.show {
        display: flex;
        opacity: 1;
    }

    .pdf-modal-window {
        background: #fff;
        border-radius: 16px;
        width: 100%;
        max-width: 1100px;
        height: 92vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        animation: modalSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes modalSlideUp {
        from {
            transform: translateY(20px) scale(0.98);
            opacity: 0;
        }
        to {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    .pdf-modal-window.is-fullscreen {
        max-width: 100vw;
        height: 100vh;
        border-radius: 0;
    }

    .pdf-modal-header {
        background: #0f172a;
        color: #fff;
        padding: 14px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-shrink: 0;
    }

    .pdf-modal-title-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        overflow: hidden;
    }

    .pdf-modal-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #dc2626;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .pdf-modal-title {
        font-size: 15px;
        font-weight: 700;
        color: #fff;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
    }

    .pdf-modal-meta {
        font-size: 11.5px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 2px;
    }

    .pdf-modal-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .btn-pdf-action {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 7px 12px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.18s;
        text-decoration: none;
    }

    .btn-pdf-action:hover {
        background: rgba(255, 255, 255, 0.22);
        color: #fff;
    }

    .btn-pdf-close {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
        border-radius: 6px;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .btn-pdf-close:hover {
        background: #ef4444;
        color: #fff;
    }

    .pdf-modal-body {
        flex: 1;
        position: relative;
        background: #475569;
        overflow: hidden;
    }

    .pdf-viewer-frame {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
        background: #fff;
    }

    .pdf-loader {
        position: absolute;
        inset: 0;
        background: #1e293b;
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        z-index: 2;
        transition: opacity 0.3s;
    }

    .pdf-loader.loaded {
        opacity: 0;
        pointer-events: none;
    }

    .pdf-spinner {
        width: 42px;
        height: 42px;
        border: 3.5px solid rgba(255, 255, 255, 0.2);
        border-top-color: var(--mui-green-light);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

{{-- ── PAGE BANNER ── --}}
<div class="fatwa-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav class="fatwa-breadcrumb mb-2" aria-label="breadcrumb">
                    <a href="{{ route('home.public') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span>/</span>
                    <a href="{{ route('fatwa') }}">Arsip</a>
                    <span>/</span>
                    <span class="text-white font-weight-bold">Fatwa MUI</span>
                </nav>
                <h1>Fatwa Majelis Ulama Indonesia</h1>
                <p>Kumpulan keputusan hukum Islam, pedoman syariah, dan fatwa resmi MUI untuk bimbingan kehidupan bermasyarakat dan berbangsa.</p>
            </div>
        </div>
    </div>
</div>

{{-- ── CONTENT SHELL ── --}}
<div class="container">

    {{-- TOOLBAR & SEARCH FORM --}}
    <div class="fatwa-toolbar">
        <form action="{{ route('fatwa') }}" method="GET" class="fatwa-search-form">
            {{-- Search input --}}
            <div class="fatwa-search-box">
                <i class="fas fa-search fatwa-search-icon"></i>
                <input type="text" name="q" value="{{ $search }}" class="fatwa-search-input"
                    placeholder="Cari fatwa, topik, atau kata kunci...">
            </div>

            {{-- Filter Kategori --}}
            <div class="fatwa-filter-selects">
                <select name="kategori" class="fatwa-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat->slug }}" {{ $kategoriAktif == $kat->slug ? 'selected' : '' }}>
                            {{ $kat->nama }} ({{ $kat->fatwas_count }})
                        </option>
                    @endforeach
                </select>

                <select name="status" class="fatwa-select" onchange="this.form.submit()">
                    <option value="">Semua Status Fatwa</option>
                    <option value="aktif" {{ $statusFatwaAktif == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="direvisi" {{ $statusFatwaAktif == 'direvisi' ? 'selected' : '' }}>Direvisi</option>
                    <option value="digantikan" {{ $statusFatwaAktif == 'digantikan' ? 'selected' : '' }}>Digantikan</option>
                </select>

                <button type="submit" class="btn-fatwa-submit">
                    <i class="fas fa-filter"></i> Terapkan
                </button>

                @if($search || $kategoriAktif || $statusFatwaAktif)
                    <a href="{{ route('fatwa') }}" class="btn-fatwa-reset" title="Reset filter pencarian">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- STATUS QUICK TABS --}}
        <div class="fatwa-status-tabs">
            <span class="small font-weight-bold text-muted mr-1"><i class="fas fa-tags mr-1"></i> Status Keberlakuan:</span>
            <a href="{{ route('fatwa', array_filter(['q' => $search, 'kategori' => $kategoriAktif])) }}"
                class="status-tab {{ !$statusFatwaAktif ? 'active' : '' }}">
                Semua Status <span class="status-tab-count">{{ $totalSemua }}</span>
            </a>
            <a href="{{ route('fatwa', array_filter(['status' => 'aktif', 'q' => $search, 'kategori' => $kategoriAktif])) }}"
                class="status-tab {{ $statusFatwaAktif === 'aktif' ? 'active' : '' }}">
                <i class="fas fa-check-circle text-success mr-1"></i> Aktif <span class="status-tab-count">{{ $statStatus['aktif'] ?? 0 }}</span>
            </a>
            <a href="{{ route('fatwa', array_filter(['status' => 'direvisi', 'q' => $search, 'kategori' => $kategoriAktif])) }}"
                class="status-tab {{ $statusFatwaAktif === 'direvisi' ? 'active-warning' : '' }}">
                <i class="fas fa-exclamation-circle text-warning mr-1"></i> Direvisi <span class="status-tab-count">{{ $statStatus['direvisi'] ?? 0 }}</span>
            </a>
            <a href="{{ route('fatwa', array_filter(['status' => 'digantikan', 'q' => $search, 'kategori' => $kategoriAktif])) }}"
                class="status-tab {{ $statusFatwaAktif === 'digantikan' ? 'active-danger' : '' }}">
                <i class="fas fa-times-circle text-danger mr-1"></i> Digantikan <span class="status-tab-count">{{ $statStatus['digantikan'] ?? 0 }}</span>
            </a>
        </div>
    </div>

    {{-- RESULTS STATS SUMMARY --}}
    <div class="fatwa-stats-bar">
        <div>
            @if($search || $kategoriAktif || $statusFatwaAktif)
                Ditemukan <strong>{{ $fatwas->total() }}</strong> dokumen fatwa
                @if($search) untuk "<strong>{{ $search }}</strong>"@endif
                @if($kategoriAktif) dalam kategori "<strong>{{ $kategoriList->firstWhere('slug', $kategoriAktif)?->nama ?? $kategoriAktif }}</strong>"@endif
                @if($statusFatwaAktif) dengan status "<strong>{{ ucfirst($statusFatwaAktif) }}</strong>"@endif
            @else
                Menampilkan <strong>{{ $fatwas->total() }}</strong> dokumen fatwa resmi
            @endif
        </div>
        <div class="small">
            <i class="fas fa-file-pdf text-danger mr-1"></i> Baca langsung dokumen fatwa tanpa unduh
        </div>
    </div>

    {{-- FATWA GRID --}}
    @if($fatwas->count() > 0)
        <div class="fatwa-grid">
            @foreach($fatwas as $item)
                @php
                    $fileUrl = $item->filepdf ? \Illuminate\Support\Facades\Storage::url($item->filepdf) : null;
                    $statusFatwa = $item->status_fatwa ?? 'aktif';
                @endphp
                <div class="fatwa-card">
                    <div class="fatwa-card-topbar">
                        <span class="badge-kat">
                            <i class="fas fa-tag"></i> {{ $item->kategori?->nama ?? 'Umum' }}
                        </span>

                        @if($statusFatwa === 'aktif')
                            <span class="badge-status-fatwa aktif" title="Fatwa masih berlaku aktif">
                                <i class="fas fa-check-circle"></i> Aktif
                            </span>
                        @elseif($statusFatwa === 'direvisi')
                            <span class="badge-status-fatwa direvisi" title="Fatwa ini telah mengalami revisi">
                                <i class="fas fa-exclamation-triangle"></i> Direvisi
                            </span>
                        @elseif($statusFatwa === 'digantikan')
                            <span class="badge-status-fatwa digantikan" title="Fatwa ini telah digantikan oleh fatwa baru">
                                <i class="fas fa-times-circle"></i> Digantikan
                            </span>
                        @endif
                    </div>

                    <div class="fatwa-card-body">
                        <h2 class="fatwa-card-title">{{ $item->judul }}</h2>

                        @if($item->keterangan)
                            <p class="fatwa-card-desc">{{ $item->keterangan }}</p>
                        @else
                            <p class="fatwa-card-desc text-muted font-italic">Tidak ada ringkasan keterangan tambahan.</p>
                        @endif

                        <div class="fatwa-card-meta">
                            <span>
                                <i class="far fa-calendar-alt mr-1"></i> {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }}
                            </span>
                            <span>
                                <i class="fas fa-shield-alt text-success mr-1"></i> Dokumen Resmi
                            </span>
                        </div>
                    </div>

                    <div class="fatwa-card-footer">
                        @if($fileUrl)
                            <button type="button" class="btn-baca-fatwa btn-open-pdf-viewer"
                                data-id="{{ $item->id }}"
                                data-views="{{ (int) $item->views }}"
                                data-title="{{ $item->judul }}"
                                data-kategori="{{ $item->kategori?->nama ?? 'Umum' }}"
                                data-status="{{ ucfirst($statusFatwa) }}"
                                data-date="{{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }}"
                                data-pdf="{{ $fileUrl }}">
                                <i class="fas fa-book-reader"></i> Baca Fatwa
                            </button>
                        @else
                            <span class="btn-baca-fatwa-disabled">
                                <i class="fas fa-exclamation-circle"></i> PDF Belum Tersedia
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mb-5">
            {{ $fatwas->links() }}
        </div>
    @else
        {{-- EMPTY STATE --}}
        <div class="fatwa-empty">
            <div class="fatwa-empty-icon">
                <i class="fas fa-book"></i>
            </div>
            <h3>Fatwa Tidak Ditemukan</h3>
            <p>Tidak ada dokumen fatwa yang sesuai dengan kata kunci atau filter yang Anda pilih saat ini.</p>
            <a href="{{ route('fatwa') }}" class="btn-fatwa-submit">
                <i class="fas fa-list"></i> Lihat Semua Fatwa
            </a>
        </div>
    @endif

</div>

{{-- ── INTEGRATED PDF VIEWER MODAL ── --}}
<div class="pdf-modal-backdrop" id="pdfViewerModal" role="dialog" aria-modal="true" aria-labelledby="pdfModalTitle">
    <div class="pdf-modal-window" id="pdfModalWindow">
        {{-- Header --}}
        <div class="pdf-modal-header">
            <div class="pdf-modal-title-wrap">
                <div class="pdf-modal-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div style="min-width: 0;">
                    <h5 class="pdf-modal-title" id="pdfModalTitle">Membuka Dokumen Fatwa...</h5>
                    <div class="pdf-modal-meta">
                        <span id="pdfModalKategori"><i class="fas fa-tag mr-1"></i> -</span>
                        <span>•</span>
                        <span id="pdfModalStatus"><i class="fas fa-info-circle mr-1"></i> -</span>
                        <span>•</span>
                        <span id="pdfModalDate"><i class="far fa-calendar-alt mr-1"></i> -</span>
                        <span>•</span>
                        <span id="pdfModalViews"><i class="fas fa-eye mr-1"></i> -</span>
                    </div>
                </div>
            </div>

            <div class="pdf-modal-actions">
                <button type="button" class="btn-pdf-action" id="btnToggleFullscreen" title="Layar Penuh">
                    <i class="fas fa-expand"></i> <span class="d-none d-sm-inline">Layar Penuh</span>
                </button>
                <button type="button" class="btn-pdf-close" id="btnClosePdfModal" aria-label="Tutup PDF">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <div class="pdf-modal-body">
            <div class="pdf-loader" id="pdfLoader">
                <div class="pdf-spinner"></div>
                <div class="font-weight-bold">Memuat Dokumen Fatwa...</div>
                <small class="text-muted">Menyiapkan pembaca dokumen terintegrasi</small>
            </div>
            <iframe id="pdfViewerFrame" class="pdf-viewer-frame" src="about:blank" title="PDF Viewer"></iframe>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        'use strict';

        var modal = document.getElementById('pdfViewerModal');
        var modalWindow = document.getElementById('pdfModalWindow');
        var iframe = document.getElementById('pdfViewerFrame');
        var loader = document.getElementById('pdfLoader');
        var btnClose = document.getElementById('btnClosePdfModal');
        var btnFullscreen = document.getElementById('btnToggleFullscreen');

        var titleEl = document.getElementById('pdfModalTitle');
        var katEl = document.getElementById('pdfModalKategori');
        var statusEl = document.getElementById('pdfModalStatus');
        var dateEl = document.getElementById('pdfModalDate');
        var viewsEl = document.getElementById('pdfModalViews');

        function openPdfModal(btn) {
            var title = btn.getAttribute('data-title') || 'Dokumen Fatwa';
            var kat = btn.getAttribute('data-kategori') || 'Umum';
            var status = btn.getAttribute('data-status') || 'Aktif';
            var date = btn.getAttribute('data-date') || '-';
            var pdfUrl = btn.getAttribute('data-pdf');
            var fatwaId = btn.getAttribute('data-id');
            var initialViews = parseInt(btn.getAttribute('data-views') || '0', 10);

            if (!pdfUrl) return;

            titleEl.textContent = title;
            katEl.innerHTML = '<i class="fas fa-tag mr-1"></i> ' + kat;
            statusEl.innerHTML = '<i class="fas fa-info-circle mr-1"></i> Status: ' + status;
            dateEl.innerHTML = '<i class="far fa-calendar-alt mr-1"></i> ' + date;
            if (viewsEl) {
                viewsEl.innerHTML = '<i class="fas fa-eye mr-1"></i> ' + new Intl.NumberFormat('id-ID').format(initialViews) + ' dilihat';
            }

            // Increment views via AJAX
            if (fatwaId) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch('/fatwa/' + fatwaId + '/baca', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json'
                    }
                }).then(function (res) {
                    return res.json();
                }).then(function (data) {
                    if (data && data.views !== undefined) {
                        btn.setAttribute('data-views', data.views);
                        var formatted = new Intl.NumberFormat('id-ID').format(data.views);
                        var counterEl = document.getElementById('fatwa-views-' + fatwaId);
                        if (counterEl) {
                            counterEl.textContent = formatted;
                        }
                        if (viewsEl) {
                            viewsEl.innerHTML = '<i class="fas fa-eye mr-1"></i> ' + formatted + ' dilihat';
                        }
                    }
                }).catch(function (err) {
                    console.error('Error incrementing views:', err);
                });
            }

            // Reset fullscreen
            modalWindow.classList.remove('is-fullscreen');
            btnFullscreen.innerHTML = '<i class="fas fa-expand"></i> <span class="d-none d-sm-inline">Layar Penuh</span>';

            // Show loader and modal
            loader.classList.remove('loaded');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            // Load PDF in iframe
            // Appending toolbar parameters ensures rich in-browser PDF experience
            var viewUrl = pdfUrl + '#toolbar=1&navpanes=0&scrollbar=1';
            iframe.onload = function () {
                setTimeout(function () {
                    loader.classList.add('loaded');
                }, 350);
            };
            iframe.src = viewUrl;
        }

        function closePdfModal() {
            modal.classList.remove('show');
            document.body.style.overflow = '';
            iframe.src = 'about:blank';
        }

        function toggleFullscreen() {
            var isFull = modalWindow.classList.toggle('is-fullscreen');
            btnFullscreen.innerHTML = isFull
                ? '<i class="fas fa-compress"></i> <span class="d-none d-sm-inline">Perkecil</span>'
                : '<i class="fas fa-expand"></i> <span class="d-none d-sm-inline">Layar Penuh</span>';
        }

        // Event delegation for "Baca Fatwa" buttons
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.btn-open-pdf-viewer');
            if (btn) {
                e.preventDefault();
                openPdfModal(btn);
            }
        });

        // Close handlers
        btnClose.addEventListener('click', closePdfModal);
        btnFullscreen.addEventListener('click', toggleFullscreen);

        // Click on backdrop to close
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closePdfModal();
            }
        });

        // ESC key to close
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                closePdfModal();
            }
        });
    })();
</script>
@endpush
