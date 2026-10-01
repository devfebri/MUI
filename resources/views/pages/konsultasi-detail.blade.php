@extends('layouts.frontend')

@section('title', 'Detail Konsultasi: ' . Str::limit($konsultasi->pertanyaan, 60) . ' — MUI Batanghari')

@section('meta_description', Str::limit($konsultasi->pertanyaan, 150))

@section('content')
<style>
    /* ── PAGE HEADER ── */
    .detail-banner {
        background: linear-gradient(135deg, var(--green-dark, #005f47) 0%, var(--green, #007f5f) 60%, var(--green-light, #00a878) 100%);
        padding: 42px 0 38px;
        color: #fff;
        margin-bottom: 35px;
    }
    .detail-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 12px;
        flex-wrap: wrap;
    }
    .detail-breadcrumb a {
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
    }
    .detail-breadcrumb a:hover {
        color: var(--gold, #c9a84c);
    }
    .detail-banner h1 {
        font-size: 26px;
        font-weight: 800;
        line-height: 1.35;
        margin-bottom: 0;
        color: #fff;
    }

    /* ── CARD SECTIONS ── */
    .detail-card {
        background: #fff;
        border-radius: var(--radius, 14px);
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 28px;
        margin-bottom: 24px;
    }
    .detail-card-title {
        font-size: 17px;
        font-weight: 800;
        color: #1a2e25;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 14px;
        margin-bottom: 20px;
    }
    .detail-card-title i {
        color: var(--green, #007f5f);
    }

    /* Penanya Box */
    .penanya-profile {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #f8fafc;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }
    .penanya-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: var(--green-pale, #e8f5f1);
        color: var(--green, #007f5f);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .penanya-data h4 {
        margin: 0 0 2px;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
    }
    .penanya-data p {
        margin: 0;
        font-size: 12.5px;
        color: #64748b;
    }

    /* Text Boxes */
    .question-content {
        font-size: 16px;
        line-height: 1.8;
        color: #1e293b;
        background: #fcfdfd;
        border-left: 4px solid var(--gold, #c9a84c);
        padding: 18px 22px;
        border-radius: 0 10px 10px 0;
        margin-bottom: 20px;
        font-style: italic;
    }

    .answer-box-full {
        background: #f0fdf4;
        border: 1.5px solid #bbf7d0;
        border-left: 5px solid var(--green, #007f5f);
        border-radius: 10px;
        padding: 24px;
        margin-bottom: 20px;
    }
    .answer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        border-bottom: 1px solid #dcfce7;
        padding-bottom: 12px;
        flex-wrap: wrap;
        gap: 8px;
    }
    .answer-author {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 14.5px;
        color: var(--green-dark, #005f47);
    }
    .answer-date {
        font-size: 12px;
        color: #64748b;
    }
    .answer-body {
        font-size: 15px;
        line-height: 1.8;
        color: #1a2e25;
        white-space: pre-line;
    }

    /* Sidebar widget */
    .side-widget {
        background: #fff;
        border-radius: var(--radius, 14px);
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        padding: 22px;
        margin-bottom: 22px;
    }
    .side-widget-title {
        font-size: 15px;
        font-weight: 800;
        color: #1a2e25;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .related-item {
        display: block;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        text-decoration: none !important;
        transition: all 0.2s;
    }
    .related-item:last-child {
        border-bottom: none;
    }
    .related-item:hover h5 {
        color: var(--green, #007f5f);
    }
    .related-item h5 {
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        line-height: 1.4;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .related-item span {
        font-size: 11.5px;
        color: #94a3b8;
    }
</style>

{{-- ── HERO BANNER ── --}}
<div class="detail-banner">
    <div class="mui-shell">
        <nav class="detail-breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home.public') }}"><i class="fas fa-home"></i> Beranda</a>
            <span>/</span>
            <a href="{{ route('konsultasi.list') }}">Konsultasi</a>
            <span>/</span>
            <a href="{{ route('konsultasi.list', ['kategori' => $konsultasi->kategori]) }}">{{ $konsultasi->kategori }}</a>
            <span>/</span>
            <span>Detail</span>
        </nav>
        <h1>{{ Str::limit($konsultasi->pertanyaan, 90) }}</h1>
    </div>
</div>

<div class="mui-shell mb-5">
    <div class="row g-4">
        {{-- ════ KOLOM UTAMA (PERTANYAAN & JAWABAN) ════ --}}
        <div class="col-lg-8">
            <div class="detail-card">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <span class="badge" style="background: var(--green-pale, #e8f5f1); color: var(--green-dark, #005f47); font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 8px;">
                        <i class="fas fa-tag mr-1"></i> {{ $konsultasi->kategori }}
                    </span>
                    @if($konsultasi->status === 'dijawab')
                        <span class="badge" style="background: #dcfce7; color: #15803d; border: 1px solid #86efac; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                            <i class="fas fa-check-circle mr-1"></i> Telah Dijawab Ulama
                        </span>
                    @else
                        <span class="badge" style="background: #fef9c3; color: #a16207; border: 1px solid #fde047; font-size: 12px; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                            <i class="fas fa-clock mr-1"></i> Dalam Kajian Ulama
                        </span>
                    @endif
                </div>

                <div class="detail-card-title">
                    <i class="fas fa-question-circle"></i> Pertanyaan Jamaah / Masyarakat
                </div>

                {{-- Penanya Profile --}}
                <div class="penanya-profile">
                    <div class="penanya-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="penanya-data">
                        <h4>{{ $konsultasi->nama }}</h4>
                        <p>
                            <span><i class="fas fa-map-marker-alt"></i> {{ $konsultasi->kab_kota ?? 'Indonesia' }}</span>
                            @if($konsultasi->usia)
                                <span class="mx-1">•</span> <span>Usia {{ $konsultasi->usia }} Tahun</span>
                            @endif
                            @if($konsultasi->jenis_kelamin)
                                <span class="mx-1">•</span> <span>{{ $konsultasi->jenis_kelamin }}</span>
                            @endif
                            <span class="mx-1">•</span> <span>Diajukan: {{ $konsultasi->created_at->translatedFormat('d F Y H:i') }}</span>
                        </p>
                    </div>
                </div>

                {{-- Teks Pertanyaan --}}
                <div class="question-content">
                    "{{ $konsultasi->pertanyaan }}"
                </div>

                {{-- Teks Jawaban Ulama --}}
                @if($konsultasi->status === 'dijawab' && $konsultasi->jawaban)
                    <div class="detail-card-title mt-4">
                        <i class="fas fa-certificate text-success"></i> Fatwa & Tanggapan Dewan Ulama MUI
                    </div>

                    <div class="answer-box-full">
                        <div class="answer-header">
                            <div class="answer-author">
                                <i class="fas fa-user-shield" style="font-size: 18px;"></i>
                                <span>{{ $konsultasi->penjawab?->name ?? 'Dewan Ulama Majelis Ulama Indonesia' }}</span>
                            </div>
                            @if($konsultasi->answered_at)
                                <div class="answer-date">
                                    <i class="fas fa-check-double text-success mr-1"></i> Dijawab: {{ $konsultasi->answered_at->translatedFormat('d F Y H:i') }}
                                </div>
                            @endif
                        </div>
                        <div class="answer-body">
                            {{ $konsultasi->jawaban }}
                        </div>
                    </div>

                    <div class="alert alert-light border small text-muted" style="border-radius: 8px;">
                        <i class="fas fa-info-circle mr-1 text-success"></i>
                        <em>Jawaban dan penjelasan di atas merupakan bimbingan syariah yang disusun oleh Tim Ulama Majelis Ulama Indonesia (MUI) sebagai rujukan ilmu dan panduan pengamalan ibadah bagi umat.</em>
                    </div>
                @else
                    <div class="alert alert-warning py-3 px-4 mt-4" style="border-radius: 10px; border-left: 4px solid #eab308;">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-hourglass-half" style="font-size: 24px; color: #a16207;"></i>
                            <div>
                                <strong class="d-block" style="color: #854d0e;">Sedang Dalam Proses Telaah</strong>
                                <span class="small" style="color: #713f12;">Pertanyaan ini telah tercatat dalam sistem dan sedang dalam antrean pengkajian oleh para ulama dan dewan pakar MUI. Jawaban akan otomatis ditampilkan di laman ini setelah selesai dikaji.</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Tombol Navigasi Bawah --}}
                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top flex-wrap gap-2">
                    <a href="{{ route('konsultasi.list') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Konsultasi
                    </a>
                    <a href="{{ route('tanya-ulama') }}" class="btn btn-success btn-sm rounded-pill px-4 font-weight-bold">
                        <i class="fas fa-plus mr-1"></i> Ajukan Pertanyaan Lain
                    </a>
                </div>
            </div>
        </div>

        {{-- ════ SIDEBAR ════ --}}
        <div class="col-lg-4">
            {{-- CTA Widget --}}
            <div class="side-widget text-center" style="background: linear-gradient(135deg, #005f47, #007f5f); color: #fff;">
                <div class="mb-3">
                    <i class="fas fa-comments" style="font-size: 40px; color: #c9a84c;"></i>
                </div>
                <h4 style="font-size: 18px; font-weight: 800; color: #fff; margin-bottom: 8px;">Punya Pertanyaan Syariah?</h4>
                <p style="font-size: 13px; color: rgba(255,255,255,.85); margin-bottom: 18px;">
                    Jangan ragu untuk berkonsultasi seputar masalah ibadah atau hukum Islam kepada Dewan Ulama MUI.
                </p>
                <a href="{{ route('tanya-ulama') }}" class="btn btn-warning btn-sm font-weight-bold w-100 rounded-pill py-2" style="background: #c9a84c; border:none; color: #1a2e25;">
                    <i class="fas fa-paper-plane mr-1"></i> Tanya Ulama Sekarang
                </a>
            </div>

            {{-- Konsultasi Terkait --}}
            @if($terkait->isNotEmpty())
                <div class="side-widget">
                    <div class="side-widget-title">
                        <i class="fas fa-list-alt text-success"></i> Konsultasi Terkait
                    </div>
                    @foreach($terkait as $t)
                        <a href="{{ route('konsultasi.detail', $t->id) }}" class="related-item">
                            <h5>"{{ Str::limit($t->pertanyaan, 70) }}"</h5>
                            <span><i class="fas fa-user-circle"></i> {{ $t->nama }} • {{ $t->created_at->diffForHumans() }}</span>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Hotline Info --}}
            <div class="side-widget">
                <div class="side-widget-title">
                    <i class="fas fa-phone-alt text-success"></i> Layanan Informasi MUI
                </div>
                <p class="small text-muted mb-2">
                    Untuk informasi umum dan layanan sekretariat Majelis Ulama Indonesia:
                </p>
                <ul class="list-unstyled small mb-0" style="color: #475569; line-height: 1.8;">
                    <li><i class="fas fa-envelope text-success mr-2"></i> info@mui.or.id</li>
                    <li><i class="fas fa-globe text-success mr-2"></i> https://mui.or.id</li>
                    <li><i class="fas fa-map-marker-alt text-success mr-2"></i> Gedung MUI Pusat, Jl. Proklamasi No. 51, Menteng, Jakarta Pusat</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
