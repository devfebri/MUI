@extends('layouts.frontend')

@section('title', $berita->judul . ' — MUI Batanghari')
@section('meta_description', Str::limit(strip_tags($berita->isi), 160))

@section('content')
    {{-- ── BREADCRUMB HERO ── --}}
    <section class="page-hero" style="padding: 24px 0 20px;">
        <div class="mui-shell">
            <nav class="page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home.public') }}"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('berita.list') }}">Berita</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('berita.list', ['kategori' => $berita->kategori]) }}">{{ $berita->kategori }}</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="current">{{ Str::limit($berita->judul, 35) }}</span>
            </nav>
        </div>
    </section>

    {{-- ── ARTICLE MAIN CONTENT ── --}}
    <div class="mui-shell">
        <div class="article-layout">

            {{-- ════ KIRI: KONTEN ARTIKEL ════ --}}
            <article>
                {{-- Header Artikel --}}
                <div class="article-header">
                    <a href="{{ route('berita.list', ['kategori' => $berita->kategori]) }}" class="article-cat-badge">
                        {{ $berita->kategori }}
                    </a>
                    <h1 class="article-title">{{ $berita->judul }}</h1>

                    <div class="article-meta-bar">
                        <div class="article-author-info">
                            <div class="article-author-avatar">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div>
                                <span class="d-block fw-bold text-dark" style="font-size: 13.5px;">
                                    {{ $berita->penulis?->name ?? 'Tim Redaksi MUI Batanghari' }}
                                </span>
                                <span class="text-muted" style="font-size: 12px;">
                                    <i class="fas fa-calendar-alt me-1 text-success"></i>
                                    {{ $berita->published_at ? $berita->published_at->translatedFormat('l, d F Y | H:i') . ' WIB' : $berita->created_at->translatedFormat('l, d F Y | H:i') . ' WIB' }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-eye me-1 text-success"></i>
                                    {{ number_format($berita->views) }} kali dilihat
                                </span>
                            </div>
                        </div>

                        {{-- Tombol Share Atas --}}
                        <div class="article-share-btns">
                            <span class="small text-muted me-1 d-none d-sm-inline">Bagikan:</span>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn-share wa" title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn-share fb" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn-share tw" title="Twitter / X">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <button type="button" class="btn-share copy" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin ke clipboard!');" title="Salin Tautan">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Gambar Utama Berita --}}
                @if($berita->gambar)
                <div class="article-featured-img">
                    <img src="{{ asset('uploads/berita/' . basename($berita->gambar)) }}" alt="{{ $berita->judul }}" loading="eager">
                    <div class="article-img-caption">
                        <i class="fas fa-camera me-1"></i> Dokumentasi MUI Batanghari — {{ $berita->judul }}
                    </div>
                </div>
                @endif

                {{-- Isi Teks Berita --}}
                <div class="article-body">
                    @if(strip_tags($berita->isi) === $berita->isi)
                        {!! nl2br(e($berita->isi)) !!}
                    @else
                        {!! $berita->isi !!}
                    @endif
                </div>

                {{-- Share Footer Bar --}}
                <div class="article-share-footer">
                    <div>
                        <strong class="text-dark d-block mb-1" style="font-size: 14px;">Suka dengan berita ini?</strong>
                        <span class="text-muted small">Bagikan informasi bermanfaat ini kepada kerabat dan keluarga Anda:</span>
                    </div>
                    <div class="article-share-btns">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn-share wa" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn-share fb" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn-share tw" title="Twitter / X">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <button type="button" class="btn-share copy" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin ke clipboard!');" title="Salin Tautan">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>

                {{-- Author Box --}}
                <div class="article-author-card">
                    <div class="article-author-avatar" style="width: 50px; height: 50px; font-size: 20px;">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase fw-bold" style="letter-spacing: .5px;">Ditulis & Diterbitkan Oleh</span>
                        <h4 class="mb-1" style="font-size: 16px; font-weight: 800; color: var(--green-dark);">
                            {{ $berita->penulis?->name ?? 'Redaksi MUI Batanghari' }}
                        </h4>
                        <p class="mb-0 text-muted small" style="line-height: 1.5;">
                            Bagian dari komitmen Majelis Ulama Indonesia dalam menyebarkan informasi keislaman, bimbingan syariah, dan dakwah wasathiyah yang mencerahkan.
                        </p>
                    </div>
                </div>

                {{-- Berita Terkait --}}
                @if(isset($beritaTerkait) && $beritaTerkait->isNotEmpty())
                <div class="mt-5">
                    <div class="mui-section-head">
                        <h2 class="mui-section-title">
                            Berita Terkait
                        </h2>
                        <div class="mui-section-line"></div>
                        <a href="{{ route('berita.list', ['kategori' => $berita->kategori]) }}" style="font-size: 12.5px; color: var(--green); font-weight: 700; text-decoration: none;">
                            Lihat Semua →
                        </a>
                    </div>

                    <div class="row g-3">
                        @foreach($beritaTerkait as $terkait)
                        <div class="col-md-6">
                            <a href="{{ route('berita.detail', $terkait->slug ?? $terkait->id) }}" class="related-card">
                                <div class="related-card-thumb">
                                    @if($terkait->gambar)
                                        <img src="{{ asset('uploads/berita/' . basename($terkait->gambar)) }}" alt="{{ $terkait->judul }}" loading="lazy">
                                    @else
                                        <div class="news-card-thumb-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                            <span>MUI Batanghari</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="related-card-body">
                                    <span class="news-cat" style="align-self: flex-start; margin-bottom: 6px;">{{ $terkait->kategori }}</span>
                                    <h4 class="related-card-title">{{ $terkait->judul }}</h4>
                                    <div class="related-card-date">
                                        <i class="fas fa-clock me-1"></i> {{ $terkait->published_at?->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

            {{-- ════ KANAN: SIDEBAR ════ --}}
            <aside>
                {{-- Form Pencarian --}}
                <div class="sidebar-widget">
                    <div class="widget-title">
                        <i class="fas fa-search"></i> Cari Berita
                    </div>
                    <form method="GET" action="{{ route('berita.list') }}">
                        <div style="position:relative;">
                            <input type="search" name="q" placeholder="Cari topik berita..."
                                style="width:100%;padding:10px 44px 10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13.5px;outline:none;font-family:'Inter',sans-serif;color:var(--text);"
                                autocomplete="off">
                            <button type="submit"
                                style="position:absolute;right:0;top:0;bottom:0;padding:0 14px;background:var(--green);color:#fff;border:none;border-radius:0 8px 8px 0;cursor:pointer;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Berita Terpopuler --}}
                @if(isset($terpopuler) && $terpopuler->isNotEmpty())
                <div class="sidebar-widget">
                    <div class="widget-title">
                        <i class="fas fa-fire-alt"></i> Berita Pilihan
                    </div>
                    @foreach($terpopuler as $idx => $pop)
                    <a href="{{ route('berita.detail', $pop->slug ?? $pop->id) }}" class="pop-item d-flex">
                        <span class="pop-rank">{{ $idx + 1 }}</span>
                        <div>
                            <div class="pop-title">{{ $pop->judul }}</div>
                            <div class="pop-date">
                                <i class="fas fa-clock"></i> {{ $pop->published_at?->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif

                {{-- Widget Kategori --}}
                <div class="sidebar-widget">
                    <div class="widget-title">
                        <i class="fas fa-tag"></i> Kategori Lainnya
                    </div>
                    @foreach(array_slice($kategoriList, 0, 7) as $kat)
                    <a href="{{ route('berita.list', ['kategori' => $kat]) }}" class="kat-widget-item {{ $berita->kategori === $kat ? 'active' : '' }}">
                        <span><i class="fas fa-chevron-right me-2 text-muted" style="font-size: 11px;"></i>{{ $kat }}</span>
                    </a>
                    @endforeach
                </div>

                {{-- Kembali ke Berita --}}
                <div class="sidebar-widget" style="background: linear-gradient(135deg, var(--green-dark), var(--green)); color: #fff; border: none; text-align: center;">
                    <div style="font-family: 'Amiri', serif; font-size: 22px; color: var(--gold-light); margin-bottom: 8px;">
                        بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيم
                    </div>
                    <h4 style="font-size: 15px; font-weight: 800; color: #fff; margin-bottom: 8px;">Portal MUI Batanghari</h4>
                    <p style="font-size: 12.5px; color: rgba(255,255,255,.8); line-height: 1.6; margin-bottom: 14px;">
                        Dapatkan kabar terkini, fatwa, dan bimbingan keislaman langsung dari sumber terpercaya.
                    </p>
                    <a href="{{ route('berita.list') }}" style="display:block;padding:9px 14px;background:rgba(255,255,255,.15);color:#fff;border-radius:8px;font-size:13px;font-weight:700;border:1px solid rgba(255,255,255,.2);text-decoration:none;">
                        ← Kembali ke Indeks Berita
                    </a>
                </div>
            </aside>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .article-body {
        font-size: 16px;
        line-height: 1.85;
        color: #2b2b2b;
        word-break: break-word;
    }
    .article-body p {
        margin-bottom: 18px;
    }
    .article-body h1, .article-body h2, .article-body h3, .article-body h4, .article-body h5, .article-body h6 {
        color: var(--green-dark, #004b38);
        font-weight: 700;
        margin-top: 24px;
        margin-bottom: 12px;
        line-height: 1.35;
    }
    .article-body h1 { font-size: 24px; }
    .article-body h2 { font-size: 21px; }
    .article-body h3 { font-size: 18px; }
    .article-body h4 { font-size: 16px; }
    .article-body ul, .article-body ol {
        margin-bottom: 18px;
        padding-left: 24px;
    }
    .article-body ul { list-style-type: disc; }
    .article-body ol { list-style-type: decimal; }
    .article-body li {
        margin-bottom: 6px;
        line-height: 1.7;
    }
    .article-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 16px 0;
        display: block;
    }
    .article-body a {
        color: var(--green, #007f5f);
        text-decoration: underline;
    }
    .article-body a:hover {
        color: var(--green-dark, #004b38);
    }
    .article-body blockquote {
        background: var(--green-pale, #e8f5f1);
        border-left: 4px solid var(--green, #007f5f);
        padding: 14px 18px;
        border-radius: 0 8px 8px 0;
        margin: 20px 0;
        font-style: italic;
        color: var(--green-dark, #004b38);
    }
    .article-body .ql-align-center { text-align: center; }
    .article-body .ql-align-right { text-align: right; }
    .article-body .ql-align-justify { text-align: justify; }
</style>
@endpush
