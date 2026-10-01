@extends('layouts.frontend')

@section('title', 'MUI Batanghari — Majelis Ulama Indonesia')
@section('meta_description', 'MUI Batanghari — Portal berita Islam, fatwa MUI, bimbingan syariah, dan informasi halal terpercaya.')

@section('ticker')
    {{-- ── LIVE TICKER ──────────────────────────────────────────────── --}}
    @if(isset($tickerBeritas) && $tickerBeritas->isNotEmpty())
        <div class="vb-ticker">
            <div class="vb-ticker-inner">
                <span class="vb-ticker-label">Live Update</span>
                <div class="vb-ticker-mask">
                    <div class="vb-ticker-track">
                        @foreach($tickerBeritas as $b)
                            <a href="{{ route('berita.detail', $b->slug ?? $b->id) }}" class="vb-ticker-item">
                                <span>{{ $b->judul }}</span>
                            </a>
                        @endforeach
                        {{-- duplicate for smooth infinite loop --}}
                        @foreach($tickerBeritas as $b)
                            <a href="{{ route('berita.detail', $b->slug ?? $b->id) }}" class="vb-ticker-item">
                                <span>{{ $b->judul }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    {{-- ── HERO SECTION ─────────────────────────────────────────────── --}}
    <section class="vb-hero">
        <div class="vb-hero-grid">

            {{-- LEFT: Featured + title list --}}
            <div>
                @if($beritaUtama)
                    @php
                        $imgUtama = $beritaUtama->gambar ? asset('uploads/berita/' . basename($beritaUtama->gambar)) : asset('template/assets/img/trending/trending_top.jpg');
                    @endphp
                    <a href="{{ route('berita.detail', $beritaUtama->slug ?? $beritaUtama->id) }}" class="post-card post-classic d-block">
                        <div class="post-media">
                            <img src="{{ $imgUtama }}" alt="{{ $beritaUtama->judul }}" loading="eager">
                        </div>
                        <div class="post-body">
                            <div class="post-meta d-flex justify-content-between align-items-center">
                                <span class="post-category">{{ $beritaUtama->kategori ?: 'Berita Utama' }}</span>
                                <span class="post-date text-muted small">
                                    <i class="fas fa-clock me-1"></i>{{ $beritaUtama->published_at ? $beritaUtama->published_at->translatedFormat('d M Y | H.i') : $beritaUtama->created_at->translatedFormat('d M Y | H.i') }} WIB
                                </span>
                            </div>
                            <h2 class="post-title">{{ $beritaUtama->judul }}</h2>
                        </div>
                    </a>
                @endif

                <div style="padding:0 2px;">
                    @foreach($beritaLeft as $item)
                        <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}" class="post-card post-title-item d-block">
                            <div class="post-meta d-flex justify-content-between align-items-center">
                                <span class="post-category">{{ $item->kategori ?: 'Berita' }}</span>
                                <time class="post-date">{{ $item->published_at ? $item->published_at->diffForHumans() : $item->created_at->diffForHumans() }}</time>
                            </div>
                            <h3 class="post-title">{{ $item->judul }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- MIDDLE: Overlay + thumbnail list --}}
            <div>
                @if($beritaMiddlePrimary)
                    @php
                        $imgMiddle = $beritaMiddlePrimary->gambar ? asset('uploads/berita/' . basename($beritaMiddlePrimary->gambar)) : asset('template/assets/img/trending/trending_bottom1.jpg');
                    @endphp
                    <a href="{{ route('berita.detail', $beritaMiddlePrimary->slug ?? $beritaMiddlePrimary->id) }}" class="post-card post-overlay d-block">
                        <div class="post-media">
                            <img src="{{ $imgMiddle }}" alt="{{ $beritaMiddlePrimary->judul }}" loading="lazy">
                        </div>
                        <div class="post-body">
                            <div class="post-meta d-flex justify-content-between align-items-center">
                                <span class="post-category">{{ $beritaMiddlePrimary->kategori ?: 'Berita' }}</span>
                                <time class="post-date">{{ $beritaMiddlePrimary->published_at ? $beritaMiddlePrimary->published_at->translatedFormat('d M Y') : $beritaMiddlePrimary->created_at->translatedFormat('d M Y') }}</time>
                            </div>
                            <h3 class="post-title">{{ $beritaMiddlePrimary->judul }}</h3>
                        </div>
                    </a>
                @endif

                <div>
                    @foreach($beritaMiddleList as $idx => $item)
                        @php
                            $imgList = $item->gambar ? asset('uploads/berita/' . basename($item->gambar)) : asset('template/assets/img/trending/trending_bottom' . (($idx % 3) + 1) . '.jpg');
                        @endphp
                        <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}" class="post-card post-list d-flex">
                            <div class="post-media">
                                <img src="{{ $imgList }}" alt="{{ $item->judul }}" loading="lazy">
                            </div>
                            <div class="post-body">
                                <div class="post-meta">
                                    <span class="post-category">{{ $item->kategori ?: 'Berita' }}</span>
                                </div>
                                <h3 class="post-title">{{ $item->judul }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- SIDEBAR: Terpopuler --}}
            <aside class="vb-hero-popular">
                <div class="vb-hero-popular-head">
                    <h2>Terpopuler</h2>
                    <span>Paling Banyak Dilihat</span>
                </div>
                @forelse($beritaPopuler as $i => $item)
                    <a href="{{ route('berita.detail', $item->slug ?? $item->id) }}" class="post-rank-item d-flex">
                        <span class="post-rank">{{ $i + 1 }}</span>
                        <div class="post-rank-body">
                            <div class="post-meta" style="margin-bottom:3px;">
                                <span class="post-category">{{ $item->kategori ?: 'Berita' }}</span>
                            </div>
                            <div class="post-title">{{ $item->judul }}</div>
                        </div>
                    </a>
                @empty
                    <div class="p-3 text-muted small">Belum ada berita terpopuler.</div>
                @endforelse
            </aside>

        </div>
    </section>

    {{-- ── FEATURED SERVICES ──────────────────────────────────────── --}}
    <section class="section-featured">
        <div class="mui-shell">
            <div class="featured-grid">
                <a href="{{ route('tanya-ulama') }}" class="featured-card">
                    <span class="featured-card-icon">🎓</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Layanan</span>
                        <span class="featured-card-title">Tanya Ulama</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="{{ route('fatwa') }}" class="featured-card">
                    <span class="featured-card-icon">📜</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Rujukan ({{ $totalFatwa }})</span>
                        <span class="featured-card-title">Fatwa MUI</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="{{ route('surat') }}" class="featured-card">
                    <span class="featured-card-icon">✉️</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Arsip ({{ $totalSurat }})</span>
                        <span class="featured-card-title">Surat Resmi</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="{{ route('berita.list', ['kategori' => 'Halal']) }}" class="featured-card">
                    <span class="featured-card-icon">✅</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Informasi</span>
                        <span class="featured-card-title">Produk Halal</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="{{ route('konsultasi.list') }}" class="featured-card">
                    <span class="featured-card-icon">💬</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Konsultasi</span>
                        <span class="featured-card-title">Tanya Jawab</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ── BERITA TERKINI ──────────────────────────────────────────── --}}
    <section class="mui-section">
        <div class="mui-shell">
            <div class="mui-section-head">
                <h3 class="mui-section-title">Berita Terkini</h3>
                <div class="mui-section-line"></div>
                <a href="{{ route('berita.list') }}" class="mui-section-more">Lihat semua <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid">
                @forelse($beritaTerkini as $n)
                    @php
                        $thumb = $n->gambar ? asset('uploads/berita/' . basename($n->gambar)) : asset('template/assets/img/news/whatNews' . (($loop->index % 4) + 1) . '.jpg');
                    @endphp
                    <div class="news-card">
                        <div class="news-card-thumb">
                            <a href="{{ route('berita.detail', $n->slug ?? $n->id) }}">
                                <img src="{{ $thumb }}" alt="{{ $n->judul }}" loading="lazy">
                            </a>
                        </div>
                        <div class="news-card-body">
                            <span class="news-cat">{{ $n->kategori ?: 'Berita' }}</span>
                            <div class="news-title">
                                <a href="{{ route('berita.detail', $n->slug ?? $n->id) }}">{{ $n->judul }}</a>
                            </div>
                            <div class="news-meta">
                                <span><i class="fas fa-clock me-1"></i>{{ $n->published_at ? $n->published_at->diffForHumans() : $n->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 py-4 text-center text-muted">Belum ada berita terkini.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ── FATWA + JADWAL (with sidebar) ──────────────────────────── --}}
    <section class="mui-section gray">
        <div class="mui-shell">
            <div class="with-sidebar">
                {{-- Main --}}
                <div>
                    <div class="mui-section-head">
                        <h3 class="mui-section-title">Fatwa Resmi MUI</h3>
                        <div class="mui-section-line"></div>
                        <a href="{{ route('fatwa') }}" class="mui-section-more">Selengkapnya <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="news-grid" style="grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));">
                        @forelse($fatwaCards as $f)
                            <div class="news-card">
                                <div class="news-card-body" style="padding: 20px;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="news-cat" style="margin:0;">{{ $f->kategori?->nama ?? 'Fatwa' }}</span>
                                        @if(($f->status_fatwa ?? 'aktif') === 'aktif')
                                            <span class="badge" style="background:#e8f5f1;color:#007f5f;font-size:11px;font-weight:700;padding:3px 8px;border-radius:12px;">Aktif</span>
                                        @elseif($f->status_fatwa === 'direvisi')
                                            <span class="badge" style="background:#fffbeb;color:#b45309;font-size:11px;font-weight:700;padding:3px 8px;border-radius:12px;">Direvisi</span>
                                        @else
                                            <span class="badge" style="background:#fef2f2;color:#b91c1c;font-size:11px;font-weight:700;padding:3px 8px;border-radius:12px;">Digantikan</span>
                                        @endif
                                    </div>
                                    <div class="news-title" style="margin-bottom:12px; font-size:15px; font-weight:700;">
                                        <a href="{{ route('fatwa') }}">{{ $f->judul }}</a>
                                    </div>
                                    @if($f->keterangan)
                                        <p style="font-size:12.5px;color:var(--gray);line-height:1.5;margin-bottom:14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $f->keterangan }}</p>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between pt-2" style="border-top:1px solid #f1f5f9;font-size:11.5px;color:var(--gray);">
                                        <span><i class="far fa-calendar-alt mr-1"></i>{{ $f->created_at ? $f->created_at->translatedFormat('d M Y') : '-' }}</span>
                                        <a href="{{ route('fatwa') }}" style="color:var(--green);font-weight:700;">Baca Fatwa &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 py-3 text-muted">Belum ada dokumen fatwa.</div>
                        @endforelse
                    </div>

                    <div style="margin-top:28px;">
                        <div class="mui-section-head">
                            <h3 class="mui-section-title">Khutbah & Bimbingan Umat</h3>
                            <div class="mui-section-line"></div>
                            <a href="{{ route('berita.list', ['kategori' => 'Khutbah']) }}" class="mui-section-more">Selengkapnya <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="news-grid" style="grid-template-columns: repeat(3,1fr);">
                            @forelse($beritaKhutbah as $k)
                                @php
                                    $kThumb = $k->gambar ? asset('uploads/berita/' . basename($k->gambar)) : asset('template/assets/img/news/whatNews' . (($loop->index % 4) + 1) . '.jpg');
                                @endphp
                                <div class="news-card">
                                    <div class="news-card-thumb" style="height:145px;">
                                        <a href="{{ route('berita.detail', $k->slug ?? $k->id) }}">
                                            <img src="{{ $kThumb }}" alt="{{ $k->judul }}" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="news-card-body">
                                        <span class="news-cat">{{ $k->kategori ?: 'Khutbah' }}</span>
                                        <div class="news-title">
                                            <a href="{{ route('berita.detail', $k->slug ?? $k->id) }}">{{ $k->judul }}</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 py-3 text-muted">Belum ada materi khutbah.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside>
                    <div class="sidebar-widget">
                        <div class="widget-title"><i class="fas fa-clock"></i> Jadwal Sholat</div>
                        <div id="sholat-location-label" style="font-size:11.5px;color:var(--muted);margin-bottom:9px;">Batanghari —
                            {{ now()->translatedFormat('d F Y') }}</div>
                        <table class="sholat-table" id="sidebarSholatTable">
                            <tr data-prayer="Subuh"><td>Subuh</td><td class="prayer-time">04:37</td></tr>
                            <tr data-prayer="Syuruq"><td>Syuruq</td><td class="prayer-time">05:54</td></tr>
                            <tr data-prayer="Dzuhur"><td>Dzuhur</td><td class="prayer-time">11:58</td></tr>
                            <tr data-prayer="Ashar"><td>Ashar</td><td class="prayer-time">15:02</td></tr>
                            <tr data-prayer="Maghrib"><td>Maghrib</td><td class="prayer-time">18:02</td></tr>
                            <tr data-prayer="Isya"><td>Isya</td><td class="prayer-time">19:10</td></tr>
                        </table>
                    </div>
                    <div class="sidebar-widget">
                        <div class="widget-title"><i class="fas fa-file-alt"></i> Fatwa Terbaru</div>
                        @forelse($sidebarFatwas as $sf)
                            <a href="{{ route('fatwa') }}" class="fatwa-item" title="{{ $sf->judul }}">
                                <i class="fas fa-file-pdf text-danger me-1"></i> {{ \Illuminate\Support\Str::limit($sf->judul, 65) }}
                            </a>
                        @empty
                            <div class="text-muted small">Belum ada fatwa.</div>
                        @endforelse
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- ── NEWSLETTER ──────────────────────────────────────────────── --}}
    <section class="newsletter-band">
        <div class="mui-shell newsletter-inner">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <div class="newsletter-arabic">بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيم</div>
                    <div class="newsletter-title">Tetap Terhubung dengan MUI Batanghari</div>
                    <div class="newsletter-sub">Dapatkan berita, fatwa, dan informasi islami terpercaya langsung ke
                        email Anda.</div>
                    <div class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Masukkan alamat email Anda...">
                        <button class="newsletter-btn">Berlangganan</button>
                    </div>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <div style="font-family:'Amiri',serif;font-size:56px;color:rgba(255,255,255,.1);line-height:1;">
                        ﴾ الإسلام ﴿
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
