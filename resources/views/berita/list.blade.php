@extends('layouts.frontend')

@section('title')
@if($kategoriAktif) {{ $kategoriAktif }} — @elseif($search) Pencarian: {{ $search }} — @endif Berita MUI Digital
@endsection

@section('meta_description', 'Berita & Artikel MUI Digital — Majelis Ulama Indonesia')

@section('ticker')
    {{-- ── LIVE TICKER ── --}}
    @if($beritas->isNotEmpty())
    <div class="vb-ticker">
        <div class="vb-ticker-inner">
            <span class="vb-ticker-label">Live Update</span>
            <div class="vb-ticker-mask">
                <div class="vb-ticker-track">
                    @foreach($beritas->take(6) as $b)
                    <a href="{{ route('berita.detail', $b->slug ?? $b->id) }}" class="vb-ticker-item"><span>{{ $b->judul }}</span></a>
                    @endforeach
                    {{-- duplicate for seamless loop --}}
                    @foreach($beritas->take(6) as $b)
                    <a href="{{ route('berita.detail', $b->slug ?? $b->id) }}" class="vb-ticker-item"><span>{{ $b->judul }}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('content')
    {{-- ── PAGE BANNER ── --}}
    <div class="page-banner">
        <div class="mui-shell page-banner-inner">
            <div class="page-banner-arabic">اقرأ</div>
            <h1>
                @if($search)
                    Hasil Pencarian: "{{ $search }}"
                @elseif($kategoriAktif)
                    Berita Kategori: {{ $kategoriAktif }}
                @else
                    Berita & Artikel
                @endif
            </h1>
            <nav class="page-breadcrumb" aria-label="breadcrumb">
                <a href="{{ route('home.public') }}"><i class="fas fa-home"></i> Beranda</a>
                <span>/</span>
                <a href="{{ route('berita.list') }}">Berita</a>
                @if($kategoriAktif)
                <span>/</span>
                <strong>{{ $kategoriAktif }}</strong>
                @elseif($search)
                <span>/</span>
                <strong>Pencarian</strong>
                @endif
            </nav>
        </div>
    </div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="mui-shell">
        <div class="list-layout">

            {{-- ════ KIRI: Konten Berita ════ --}}
            <div>

                {{-- KATEGORI TABS --}}
                <div class="kat-tabs">
                    <a href="{{ route('berita.list', array_filter(['q' => $search])) }}"
                       class="kat-tab {{ !$kategoriAktif ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Semua
                        <span class="kat-count">{{ $beritas->total() }}</span>
                    </a>
                    @foreach($kategoriList as $kat)
                    @if(($statKategori[$kat] ?? 0) > 0)
                    <a href="{{ route('berita.list', array_filter(['kategori' => $kat, 'q' => $search])) }}"
                       class="kat-tab {{ $kategoriAktif === $kat ? 'active' : '' }}">
                        {{ $kat }}
                        <span class="kat-count">{{ $statKategori[$kat] ?? 0 }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>

                {{-- SEARCH INFO --}}
                @if($search)
                <div class="search-info">
                    <i class="fas fa-search"></i>
                    Ditemukan <strong>{{ $beritas->total() }}</strong> artikel untuk
                    "<strong>{{ $search }}</strong>"
                    &nbsp;|&nbsp; <a href="{{ route('berita.list', $kategoriAktif ? ['kategori' => $kategoriAktif] : []) }}" style="color:var(--green);text-decoration:underline;">Hapus pencarian</a>
                </div>
                @endif

                @if($beritas->isEmpty())
                    {{-- ── EMPTY STATE ── --}}
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <h3>Belum Ada Berita</h3>
                        <p>
                            @if($search)
                                Tidak ada artikel yang cocok dengan "{{ $search }}".
                            @elseif($kategoriAktif)
                                Belum ada artikel dalam kategori <strong>{{ $kategoriAktif }}</strong>.
                            @else
                                Belum ada artikel yang dipublikasikan.
                            @endif
                        </p>
                        <a href="{{ route('berita.list') }}" style="display:inline-block;margin-top:16px;padding:9px 22px;background:var(--green);color:#fff;border-radius:24px;font-size:13.5px;font-weight:700;">
                            ← Lihat Semua Berita
                        </a>
                    </div>
                @else
                    {{-- ── SECTION HEADING ── --}}
                    <div class="mui-section-head">
                        <h2 class="mui-section-title">
                            {{ $kategoriAktif ?? ($search ? 'Hasil Pencarian' : 'Berita Terkini') }}
                        </h2>
                        <div class="mui-section-line"></div>
                        <span style="font-size:12px;color:var(--muted);white-space:nowrap;">
                            {{ $beritas->firstItem() }}–{{ $beritas->lastItem() }} dari {{ $beritas->total() }}
                        </span>
                    </div>

                    {{-- ── FEATURED CARD (berita pertama) ── --}}
                    @if(!$kategoriAktif && !$search && $beritaUtama)
                    <a href="{{ route('berita.detail', $beritaUtama->slug ?? $beritaUtama->id) }}" class="news-featured d-block">
                        <div class="news-featured-thumb">
                            @if($beritaUtama->gambar)
                                <img src="{{ Storage::url($beritaUtama->gambar) }}"
                                     alt="{{ $beritaUtama->judul }}" loading="eager">
                            @else
                                <div class="news-card-thumb-placeholder">
                                    <i class="fas fa-newspaper"></i>
                                    <span>MUI Digital</span>
                                </div>
                            @endif
                        </div>
                        <div class="news-featured-body">
                            <div class="d-flex align-items-center" style="gap:10px;margin-bottom:10px;">
                                <span class="news-featured-cat">{{ $beritaUtama->kategori }}</span>
                                <span style="font-size:12px;color:var(--muted);">
                                    <i class="fas fa-clock"></i>
                                    {{ $beritaUtama->published_at?->translatedFormat('d M Y, H:i') }} WIB
                                </span>
                            </div>
                            <h2 class="news-featured-title">{{ $beritaUtama->judul }}</h2>
                            <p class="news-featured-excerpt">
                                {{ Str::limit(strip_tags($beritaUtama->isi), 180) }}
                            </p>
                            <span style="font-size:12.5px;color:var(--muted);">
                                <i class="fas fa-user" style="color:var(--green);"></i>
                                {{ $beritaUtama->penulis?->name ?? 'Tim Redaksi MUI' }}
                            </span>
                        </div>
                    </a>
                    @endif

                    {{-- ── NEWS GRID ── --}}
                    @php
                        $gridItems = (!$kategoriAktif && !$search && $beritaUtama)
                            ? $beritas->slice(1)
                            : $beritas;
                    @endphp

                    @if($gridItems->isNotEmpty())
                    <div class="news-grid">
                        @foreach($gridItems as $berita)
                        <a href="{{ route('berita.detail', $berita->slug ?? $berita->id) }}" class="news-card d-block">
                            <div class="news-card-thumb">
                                @if($berita->gambar)
                                    <img src="{{ Storage::url($berita->gambar) }}"
                                         alt="{{ $berita->judul }}" loading="lazy">
                                @else
                                    <div class="news-card-thumb-placeholder">
                                        <i class="fas fa-newspaper"></i>
                                        <span>MUI Digital</span>
                                    </div>
                                @endif
                                <span class="news-card-cat-badge">{{ $berita->kategori }}</span>
                            </div>
                            <div class="news-card-body">
                                <h3 class="news-title">{{ $berita->judul }}</h3>
                                <div class="news-meta">
                                    <span><i class="fas fa-clock"></i>
                                        {{ $berita->published_at?->diffForHumans() }}</span>
                                    <span><i class="fas fa-user"></i>
                                        {{ $berita->penulis?->name ?? 'Tim Redaksi' }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif

                    {{-- ── PAGINATION ── --}}
                    @if($beritas->hasPages())
                    <div class="mui-pagination">
                        {{-- Previous --}}
                        @if($beritas->onFirstPage())
                            <span class="mui-page-btn disabled"><i class="fas fa-chevron-left"></i></span>
                        @else
                            <a href="{{ $beritas->previousPageUrl() }}" class="mui-page-btn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Pages --}}
                        @foreach($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
                            @if($page == $beritas->currentPage())
                                <span class="mui-page-btn active">{{ $page }}</span>
                            @elseif(abs($page - $beritas->currentPage()) <= 2 || $page == 1 || $page == $beritas->lastPage())
                                <a href="{{ $url }}" class="mui-page-btn">{{ $page }}</a>
                            @elseif(abs($page - $beritas->currentPage()) == 3)
                                <span class="mui-page-btn disabled">…</span>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($beritas->hasMorePages())
                            <a href="{{ $beritas->nextPageUrl() }}" class="mui-page-btn">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="mui-page-btn disabled"><i class="fas fa-chevron-right"></i></span>
                        @endif
                    </div>
                    @endif
                @endif

            </div>

            {{-- ════ KANAN: Sidebar ════ --}}
            <aside>

                {{-- Widget: Kategori --}}
                <div class="sidebar-widget">
                    <div class="widget-title">
                        <i class="fas fa-tag"></i> Kategori
                    </div>
                    <a href="{{ route('berita.list', array_filter(['q' => $search])) }}"
                       class="kat-widget-item {{ !$kategoriAktif ? 'active' : '' }}">
                        <span><i class="fas fa-th" style="margin-right:7px;color:var(--green);font-size:11px;"></i>Semua Berita</span>
                        <span class="kat-widget-count">{{ array_sum($statKategori->toArray()) }}</span>
                    </a>
                    @foreach($kategoriList as $kat)
                    @if(($statKategori[$kat] ?? 0) > 0)
                    <a href="{{ route('berita.list', array_filter(['kategori' => $kat, 'q' => $search])) }}"
                       class="kat-widget-item {{ $kategoriAktif === $kat ? 'active' : '' }}">
                        <span>{{ $kat }}</span>
                        <span class="kat-widget-count">{{ $statKategori[$kat] }}</span>
                    </a>
                    @endif
                    @endforeach
                </div>

                {{-- Widget: Terpopuler --}}
                @if($terpopuler->isNotEmpty())
                <div class="sidebar-widget">
                    <div class="widget-title">
                        <i class="fas fa-fire-alt"></i> Terpopuler
                    </div>
                    @foreach($terpopuler as $i => $pop)
                    <a href="{{ route('berita.detail', $pop->slug ?? $pop->id) }}" class="pop-item d-flex">
                        <span class="pop-rank">{{ $i + 1 }}</span>
                        <div>
                            <div class="pop-title">{{ $pop->judul }}</div>
                            <div class="pop-date">
                                <i class="fas fa-clock"></i>
                                {{ $pop->published_at?->translatedFormat('d M Y') }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif

                {{-- Widget: Cari --}}
                <div class="sidebar-widget">
                    <div class="widget-title">
                        <i class="fas fa-search"></i> Pencarian
                    </div>
                    <form method="GET" action="{{ route('berita.list') }}">
                        @if($kategoriAktif)
                        <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
                        @endif
                        <div style="position:relative;">
                            <input type="search" name="q" value="{{ $search ?? '' }}"
                                placeholder="Cari artikel..."
                                style="width:100%;padding:10px 44px 10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:13.5px;outline:none;font-family:'Inter',sans-serif;color:var(--text);">
                            <button type="submit"
                                style="position:absolute;right:0;top:0;bottom:0;padding:0 14px;background:var(--green);color:#fff;border:none;border-radius:0 8px 8px 0;cursor:pointer;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Widget: Tentang MUI --}}
                <div class="sidebar-widget" style="background:linear-gradient(135deg,var(--green-dark),var(--green));border:none;">
                    <div style="font-family:'Amiri',serif;font-size:20px;color:var(--gold-light);margin-bottom:10px;text-align:center;">
                        بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيم
                    </div>
                    <p style="font-size:13px;color:rgba(255,255,255,.8);line-height:1.7;text-align:center;margin-bottom:14px;">
                        MUI Digital adalah portal resmi Majelis Ulama Indonesia untuk berita Islam, fatwa, dan bimbingan syariah terpercaya.
                    </p>
                    <a href="{{ route('home.public') }}"
                       style="display:block;text-align:center;padding:9px;background:rgba(255,255,255,.15);color:#fff;border-radius:8px;font-size:13px;font-weight:700;border:1px solid rgba(255,255,255,.2);transition:.2s;">
                        ← Kembali ke Beranda
                    </a>
                </div>

            </aside>
        </div>
    </div>

    {{-- ── NEWSLETTER BAND ── --}}
    <div class="newsletter-band">
        <div class="mui-shell newsletter-inner">
            <div class="newsletter-arabic">اشترك معنا</div>
            <h2 class="newsletter-title">Dapatkan Update Terbaru MUI</h2>
            <p class="newsletter-sub">Langganan newsletter kami dan terima berita Islam terpercaya langsung di inbox Anda.</p>
            <form class="newsletter-form" onsubmit="return false;">
                <input type="email" class="newsletter-input" placeholder="Masukkan email Anda...">
                <button type="submit" class="newsletter-btn">Daftar Sekarang</button>
            </form>
        </div>
    </div>
@endsection
