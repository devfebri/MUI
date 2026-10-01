@extends('layouts.frontend')

@section('title')
@if($tahunAktif) Arsip Surat Tahun {{ $tahunAktif }} — @elseif($search) Pencarian Surat: "{{ $search }}" — @endif Arsip Surat Resmi — MUI Batanghari
@endsection

@section('meta_description', 'Koleksi arsip surat resmi, surat edaran, dan korespondensi Majelis Ulama Indonesia (MUI). Akses dan tinjau dokumen surat secara digital.')

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
    .surat-banner {
        background: linear-gradient(135deg, var(--mui-green-dark) 0%, var(--mui-green) 55%, var(--mui-green-light) 100%);
        padding: 55px 0 50px;
        position: relative;
        overflow: hidden;
        color: #fff;
        margin-bottom: 35px;
    }

    .surat-banner::before {
        content: 'سِجِلُّ الرَّسَائِلِ';
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

    .surat-banner h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
        color: #fff;
    }

    .surat-banner p {
        font-size: 15px;
        color: rgba(255, 255, 255, 0.88);
        max-width: 680px;
        margin-bottom: 18px;
        line-height: 1.6;
    }

    .surat-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
    }

    .surat-breadcrumb a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
    }

    .surat-breadcrumb a:hover {
        color: var(--mui-gold);
    }

    .surat-breadcrumb span {
        color: rgba(255, 255, 255, 0.5);
    }

    /* ── TOOLBAR & FILTER ── */
    .surat-toolbar {
        background: #fff;
        border-radius: var(--mui-radius);
        padding: 22px 24px;
        box-shadow: var(--mui-shadow);
        border: 1px solid var(--mui-border);
        margin-bottom: 28px;
    }

    .surat-search-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .surat-search-box {
        flex: 1;
        min-width: 260px;
        position: relative;
    }

    .surat-search-input {
        width: 100%;
        border: 1.5px solid var(--mui-border);
        border-radius: 30px;
        padding: 12px 20px 12px 46px;
        font-size: 14.5px;
        outline: none;
        transition: all var(--mui-tr);
        background: #fff;
    }

    .surat-search-input:focus {
        border-color: var(--mui-green);
        box-shadow: 0 0 0 3px rgba(0, 127, 95, 0.15);
    }

    .surat-search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--mui-gray);
        font-size: 15px;
    }

    .surat-filter-selects {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .surat-select {
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

    .surat-select:focus {
        border-color: var(--mui-green);
    }

    .btn-surat-submit {
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

    .btn-surat-submit:hover {
        background: var(--mui-green-dark);
        color: #fff;
    }

    .btn-surat-reset {
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

    .btn-surat-reset:hover {
        background: #e2e8f0;
        color: var(--mui-text);
    }

    /* ── TAHUN QUICK TABS ── */
    .surat-year-tabs {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
    }

    .year-tab {
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

    .year-tab:hover {
        border-color: var(--mui-green);
        color: var(--mui-green);
    }

    .year-tab.active {
        background: var(--mui-green);
        color: #fff;
        border-color: var(--mui-green);
    }

    /* ── STATS SUMMARY STRIP ── */
    .surat-stats-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 14px;
        color: var(--mui-gray);
    }

    /* ── SURAT GRID & CARDS ── */
    .surat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .surat-card {
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

    .surat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--mui-shadow-hov);
        border-color: rgba(0, 127, 95, 0.25);
    }

    .surat-card-topbar {
        padding: 18px 20px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        flex-wrap: wrap;
    }

    .badge-nomor {
        background: #f1f5f9;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: 1px solid #e2e8f0;
    }

    .badge-ext {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 6px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-ext.pdf {
        background: #fee2e2;
        color: #b91c1c;
    }

    .badge-ext.doc, .badge-ext.docx {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .badge-ext.xls, .badge-ext.xlsx {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-ext.img {
        background: #f3e8ff;
        color: #7e22ce;
    }

    .badge-ext.other {
        background: #f1f5f9;
        color: #475569;
    }

    .surat-card-body {
        padding: 16px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .surat-card-title {
        font-size: 16.5px;
        font-weight: 700;
        color: var(--mui-text);
        line-height: 1.5;
        margin-bottom: 14px;
        flex: 1;
    }

    .surat-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
        font-size: 12.5px;
        color: var(--mui-gray);
        flex-wrap: wrap;
        gap: 6px;
    }

    .surat-card-footer {
        padding: 12px 20px 18px;
        background: #fafcfb;
        border-top: 1px solid #f1f5f9;
        display: flex;
        gap: 8px;
    }

    .btn-baca-surat {
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

    .btn-baca-surat:hover {
        background: var(--mui-green-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-unduh-surat {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        transition: all var(--mui-tr);
    }

    .btn-unduh-surat:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* ── EMPTY STATE ── */
    .surat-empty {
        background: #fff;
        border-radius: var(--mui-radius);
        padding: 60px 20px;
        text-align: center;
        box-shadow: var(--mui-shadow);
        border: 1px solid var(--mui-border);
        margin: 20px 0 50px;
    }

    .surat-empty-icon {
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

    .surat-empty h3 {
        font-size: 20px;
        font-weight: 700;
        color: var(--mui-text);
        margin-bottom: 8px;
    }

    .surat-empty p {
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
        background: var(--mui-green);
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

    /* ── PAGINATION ── */
    .mui-pagination-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 40px 0 50px;
        gap: 12px;
    }

    .mui-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 0;
        flex-wrap: wrap;
    }

    .mui-page-btn {
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        border: 1.5px solid var(--mui-border, #e2e8f0);
        background: #fff;
        color: var(--mui-text, #1a1a2e);
        transition: all var(--mui-tr, 0.22s);
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .mui-page-btn:hover {
        border-color: var(--mui-green, #007f5f);
        color: var(--mui-green, #007f5f);
        background: var(--mui-green-pale, #e8f5f1);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .mui-page-btn.active {
        background: var(--mui-green, #007f5f);
        color: #fff;
        border-color: var(--mui-green, #007f5f);
        box-shadow: 0 4px 12px rgba(0, 127, 95, 0.25);
    }

    .mui-page-btn.disabled {
        opacity: 0.4;
        pointer-events: none;
        cursor: not-allowed;
    }

    .mui-page-info {
        font-size: 13px;
        color: var(--mui-gray, #64748b);
        font-weight: 500;
    }
</style>

{{-- ── PAGE BANNER ── --}}
<div class="surat-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav class="surat-breadcrumb mb-2" aria-label="breadcrumb">
                    <a href="{{ route('home.public') }}"><i class="fas fa-home"></i> Beranda</a>
                    <span>/</span>
                    <a href="{{ route('surat') }}">Arsip</a>
                    <span>/</span>
                    <span class="text-white font-weight-bold">Surat Resmi</span>
                </nav>
                <h1>Arsip Surat Resmi MUI</h1>
                <p>Dokumentasi surat keputusan, surat edaran, pemberitahuan, dan persuratan resmi Majelis Ulama Indonesia.</p>
            </div>
        </div>
    </div>
</div>

{{-- ── CONTENT CONTAINER ── --}}
<div class="container">

    {{-- TOOLBAR & SEARCH FORM --}}
    <div class="surat-toolbar">
        <form action="{{ route('surat') }}" method="GET" class="surat-search-form">
            {{-- Search input --}}
            <div class="surat-search-box">
                <i class="fas fa-search surat-search-icon"></i>
                <input type="text" name="q" value="{{ $search }}" class="surat-search-input"
                    placeholder="Cari nomor surat, perihal, atau kata kunci...">
            </div>

            {{-- Filter Tahun --}}
            <div class="surat-filter-selects">
                <select name="tahun" class="surat-select" onchange="this.form.submit()">
                    <option value="">Semua Tahun</option>
                    @foreach($tahunList as $th)
                        <option value="{{ $th }}" {{ $tahunAktif == $th ? 'selected' : '' }}>
                            Tahun {{ $th }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-surat-submit">
                    <i class="fas fa-filter"></i> Terapkan
                </button>

                @if($search || $tahunAktif)
                    <a href="{{ route('surat') }}" class="btn-surat-reset" title="Reset filter pencarian">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- QUICK TAHUN TABS --}}
        @if($tahunList->isNotEmpty())
            <div class="surat-year-tabs">
                <span class="small font-weight-bold text-muted mr-1"><i class="fas fa-calendar-alt mr-1"></i> Tahun Arsip:</span>
                <a href="{{ route('surat', array_filter(['q' => $search])) }}"
                    class="year-tab {{ !$tahunAktif ? 'active' : '' }}">
                    Semua ({{ $totalSemua }})
                </a>
                @foreach($tahunList->take(6) as $th)
                    <a href="{{ route('surat', array_filter(['tahun' => $th, 'q' => $search])) }}"
                        class="year-tab {{ $tahunAktif == $th ? 'active' : '' }}">
                        {{ $th }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- RESULTS STATS SUMMARY --}}
    <div class="surat-stats-bar">
        <div>
            @if($search || $tahunAktif)
                Ditemukan <strong>{{ $surats->total() }}</strong> dokumen surat
                @if($search) untuk "<strong>{{ $search }}</strong>"@endif
                @if($tahunAktif) pada tahun <strong>{{ $tahunAktif }}</strong>@endif
            @else
                Menampilkan <strong>{{ $surats->total() }}</strong> dokumen surat resmi
            @endif
        </div>
        <div class="small">
            <i class="fas fa-folder-open text-success mr-1"></i> Terbuka untuk referensi informasi publik MUI
        </div>
    </div>

    {{-- SURAT GRID --}}
    @if($surats->count() > 0)
        <div class="surat-grid">
            @foreach($surats as $item)
                @php
                    $fileUrl = $item->file_surat ? asset('uploads/surat/' . basename($item->file_surat)) : null;
                    $ext = strtolower(pathinfo($item->file_surat, PATHINFO_EXTENSION));
                    $isPdf = ($ext === 'pdf');
                    $isImg = in_array($ext, ['jpg', 'jpeg', 'png'], true);
                @endphp
                <div class="surat-card">
                    <div class="surat-card-topbar">
                        @if($item->nomor_surat)
                            <span class="badge-nomor" title="Nomor Surat Resmi">
                                <i class="fas fa-hashtag text-muted"></i> {{ $item->nomor_surat }}
                            </span>
                        @else
                            <span class="badge-nomor text-muted font-italic">
                                — Tanpa Nomor —
                            </span>
                        @endif

                        @if($isPdf)
                            <span class="badge-ext pdf"><i class="fas fa-file-pdf"></i> PDF</span>
                        @elseif(in_array($ext, ['doc', 'docx']))
                            <span class="badge-ext doc"><i class="fas fa-file-word"></i> Word</span>
                        @elseif(in_array($ext, ['xls', 'xlsx']))
                            <span class="badge-ext xls"><i class="fas fa-file-excel"></i> Excel</span>
                        @elseif($isImg)
                            <span class="badge-ext img"><i class="fas fa-file-image"></i> Gambar</span>
                        @else
                            <span class="badge-ext other"><i class="fas fa-file"></i> {{ $ext ?: 'File' }}</span>
                        @endif
                    </div>

                    <div class="surat-card-body">
                        <h2 class="surat-card-title">{{ $item->perihal }}</h2>

                        <div class="surat-card-meta">
                            <span>
                                <i class="far fa-calendar-alt text-muted mr-1"></i>
                                {{ $item->tanggal_surat ? $item->tanggal_surat->translatedFormat('d F Y') : '-' }}
                            </span>
                            @if($item->pengunggah)
                                <span title="Petugas Pengunggah">
                                    <i class="far fa-user text-muted mr-1"></i> {{ $item->pengunggah->name }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="surat-card-footer">
                        @if($fileUrl && $isPdf)
                            <button type="button" class="btn-baca-surat btn-open-pdf-viewer"
                                data-title="{{ $item->perihal }}"
                                data-nomor="{{ $item->nomor_surat ?: 'Tanpa Nomor' }}"
                                data-date="{{ $item->tanggal_surat ? $item->tanggal_surat->translatedFormat('d F Y') : '-' }}"
                                data-pdf="{{ $fileUrl }}">
                                <i class="fas fa-book-reader"></i> Lihat Surat
                            </button>
                        @elseif($fileUrl)
                            <a href="{{ $fileUrl }}" target="_blank" class="btn-baca-surat">
                                <i class="fas fa-external-link-alt"></i> Buka File
                            </a>
                        @endif

                        @if($fileUrl)
                            <a href="{{ $fileUrl }}" download class="btn-unduh-surat" title="Unduh File Surat">
                                <i class="fas fa-download"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        @if($surats->hasPages())
        <div class="mui-pagination-wrap">
            <div class="mui-pagination">
                {{-- Previous --}}
                @if($surats->onFirstPage())
                    <span class="mui-page-btn disabled" aria-disabled="true"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $surats->previousPageUrl() }}" class="mui-page-btn" title="Halaman Sebelumnya" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Pages with smart windowing --}}
                @foreach($surats->getUrlRange(1, $surats->lastPage()) as $page => $url)
                    @if($page == $surats->currentPage())
                        <span class="mui-page-btn active" aria-current="page">{{ $page }}</span>
                    @elseif(abs($page - $surats->currentPage()) <= 2 || $page == 1 || $page == $surats->lastPage())
                        <a href="{{ $url }}" class="mui-page-btn">{{ $page }}</a>
                    @elseif(abs($page - $surats->currentPage()) == 3)
                        <span class="mui-page-btn disabled">…</span>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($surats->hasMorePages())
                    <a href="{{ $surats->nextPageUrl() }}" class="mui-page-btn" title="Halaman Selanjutnya" rel="next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="mui-page-btn disabled" aria-disabled="true"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
            <div class="mui-page-info">
                Menampilkan {{ $surats->firstItem() ?? 0 }}–{{ $surats->lastItem() ?? 0 }} dari {{ $surats->total() }} arsip surat
            </div>
        </div>
        @endif
    @else
        {{-- EMPTY STATE --}}
        <div class="surat-empty">
            <div class="surat-empty-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h3>Surat Tidak Ditemukan</h3>
            <p>Tidak ada arsip surat yang sesuai dengan kriteria pencarian atau tahun yang Anda tentukan.</p>
            <a href="{{ route('surat') }}" class="btn-surat-submit">
                <i class="fas fa-list"></i> Tampilkan Semua Surat
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
                    <i class="fas fa-file-alt"></i>
                </div>
                <div style="min-width: 0;">
                    <h5 class="pdf-modal-title" id="pdfModalTitle">Membuka Dokumen Surat...</h5>
                    <div class="pdf-modal-meta">
                        <span id="pdfModalNomor"><i class="fas fa-hashtag mr-1"></i> -</span>
                        <span>•</span>
                        <span id="pdfModalDate"><i class="far fa-calendar-alt mr-1"></i> -</span>
                    </div>
                </div>
            </div>

            <div class="pdf-modal-actions">
                <button type="button" class="btn-pdf-action" id="btnToggleFullscreen" title="Layar Penuh">
                    <i class="fas fa-expand"></i> <span class="d-none d-sm-inline">Layar Penuh</span>
                </button>
                <button type="button" class="btn-pdf-close" id="btnClosePdfModal" aria-label="Tutup Pratinjau">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <div class="pdf-modal-body">
            <div class="pdf-loader" id="pdfLoader">
                <div class="pdf-spinner"></div>
                <div class="font-weight-bold">Memuat Dokumen Surat...</div>
                <small class="text-muted">Menyiapkan pembaca dokumen terintegrasi</small>
            </div>
            <iframe id="pdfViewerFrame" class="pdf-viewer-frame" src="about:blank" title="Surat Viewer"></iframe>
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
        var nomorEl = document.getElementById('pdfModalNomor');
        var dateEl = document.getElementById('pdfModalDate');

        function openPdfModal(btn) {
            var title = btn.getAttribute('data-title') || 'Dokumen Surat';
            var nomor = btn.getAttribute('data-nomor') || 'Tanpa Nomor';
            var date = btn.getAttribute('data-date') || '-';
            var pdfUrl = btn.getAttribute('data-pdf');

            if (!pdfUrl) return;

            titleEl.textContent = title;
            nomorEl.innerHTML = '<i class="fas fa-hashtag mr-1"></i> ' + nomor;
            dateEl.innerHTML = '<i class="far fa-calendar-alt mr-1"></i> ' + date;

            modalWindow.classList.remove('is-fullscreen');
            btnFullscreen.innerHTML = '<i class="fas fa-expand"></i> <span class="d-none d-sm-inline">Layar Penuh</span>';

            loader.classList.remove('loaded');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

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

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.btn-open-pdf-viewer');
            if (btn) {
                e.preventDefault();
                openPdfModal(btn);
            }
        });

        btnClose.addEventListener('click', closePdfModal);
        btnFullscreen.addEventListener('click', toggleFullscreen);

        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closePdfModal();
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('show')) {
                closePdfModal();
            }
        });
    })();
</script>
@endpush
