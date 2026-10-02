@extends('layouts.frontend')

@section('title', ($settings['kontak_title'] ?? 'Kontak Kami') . ' — Majelis Ulama Indonesia')
@section('meta_description', $settings['kontak_subtitle'] ?? 'Hubungi Sekretariat Majelis Ulama Indonesia (MUI). Alamat kantor, nomor telepon, email, serta formulir pengaduan & aspirasi umat.')

@section('content')
    {{-- ── HERO / BANNER ── --}}
    <section class="page-hero">
        <div class="mui-shell">
            <nav class="page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span>Tentang Kami</span>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="current">Kontak Kami</span>
            </nav>
            <h1 class="page-hero-title">{{ $settings['kontak_title'] ?? 'Hubungi MUI Batanghari' }}</h1>
            <p class="page-hero-desc">
                {{ $settings['kontak_subtitle'] ?? 'Sekretariat Majelis Ulama Indonesia siap melayani permohonan informasi, aspirasi keumatan, dan konsultasi keagamaan Anda.' }}
            </p>
        </div>
    </section>

    {{-- ── CONTENT ── --}}
    <div class="page-content-wrapper">
        <div class="mui-shell">
            {{-- Contact Cards --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="mui-card mb-0 h-100" style="padding: 22px;">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 6px;">Kantor Sekretariat</h4>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            {!! nl2br(e($settings['kontak_alamat'] ?? 'Jl. Jenderal Sudirman, Muara Bulian, Kab. Batanghari, Jambi')) !!}
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mui-card mb-0 h-100" style="padding: 22px;">
                        <div class="icon-circle mb-3" style="background: rgba(201,168,76,.15); color: #856404;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 6px;">Telepon & WhatsApp</h4>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Telp: {{ $settings['kontak_telepon'] ?? '(0743) 21123' }}<br>
                            WhatsApp: {{ $settings['kontak_whatsapp'] ?? '0812-3456-7890' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mui-card mb-0 h-100" style="padding: 22px;">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 6px;">Email & Jam Layanan</h4>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Email: {{ $settings['kontak_email'] ?? 'sekretariat@muibatanghari.or.id' }}<br>
                            Layanan: {{ $settings['kontak_jam_layanan'] ?? 'Senin – Jumat: 08.00 – 16.00 WIB' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                {{-- Form Kirim Pesan --}}
                <div class="col-lg-8">
                    <div class="mui-card">
                        <h2 class="mui-card-title">
                            <i class="fas fa-paper-plane text-success"></i>
                            Kirim Aspirasi & Pesan Anda
                        </h2>
                        <p class="text-muted small mb-4">
                            Silakan isi formulir di bawah ini. Tim sekretariat kami akan merespons pesan Anda sesegera mungkin pada hari kerja.
                        </p>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Terima kasih! Pesan Anda telah kami terima dan akan segera ditindaklanjuti.'); this.reset();">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-dark">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-dark">Nomor WhatsApp / HP</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="08xxxxxxxxxx" style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-dark">Kategori Pesan <span class="text-danger">*</span></label>
                                    <select name="kategori" class="form-select" required style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                        <option value="">Pilih Kategori...</option>
                                        <option value="pertanyaan">Pertanyaan Umum</option>
                                        <option value="konsultasi">Permohonan Konsultasi Syariah</option>
                                        <option value="fatwa">Informasi Fatwa</option>
                                        <option value="halal">Informasi Produk Halal</option>
                                        <option value="aspirasi">Aspirasi / Saran Keumatan</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-dark">Subjek Pesan <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control" placeholder="Ringkasan topik pesan" required style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-dark">Isi Pesan <span class="text-danger">*</span></label>
                                    <textarea name="pesan" rows="5" class="form-control" placeholder="Tuliskan pesan, pertanyaan, atau aspirasi Anda secara rinci..." required style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 12px 14px;"></textarea>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn text-white fw-bold px-4 py-2" style="background: var(--green); border-radius: var(--radius-sm); font-size: 14px;">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- Google Maps --}}
                    @if (!empty($settings['kontak_maps_embed']))
                        <div class="mui-card p-0 overflow-hidden">
                            <div style="padding: 16px 22px; background: #fff; border-bottom: 1px solid var(--border);">
                                <h3 style="font-size: 15px; font-weight: 700; color: var(--green-dark); margin: 0;">
                                    <i class="fas fa-map-marked-alt text-success me-2"></i> Peta Lokasi Kantor MUI
                                </h3>
                            </div>
                            <iframe
                                src="{{ $settings['kontak_maps_embed'] }}"
                                width="100%" height="320" style="border:0; display: block;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    @endif
                </div>

                {{-- Sidebar Column --}}
                <div class="col-lg-4">
                    {{-- Quick Nav --}}
                    <div class="mui-card" style="padding: 22px;">
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 14px; border-bottom: 1.5px solid var(--border); padding-bottom: 8px;">
                            Tentang Kami
                        </h3>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('profilemui') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Profil MUI
                            </a>
                            <a href="{{ route('visi-misi') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Visi Misi
                            </a>
                            <a href="{{ route('struktur-organisasi') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Struktur Organisasi
                            </a>
                            <a href="{{ route('kontak') }}" class="btn btn-sm text-start fw-bold" style="background: var(--green-pale); color: var(--green); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-gold"></i> Kontak Kami
                            </a>
                        </div>
                    </div>

                    {{-- Saluran Media Sosial --}}
                    <div class="mui-card" style="padding: 22px;">
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 14px; border-bottom: 1.5px solid var(--border); padding-bottom: 8px;">
                            Media Sosial Resmi
                        </h3>
                        <p class="text-muted small mb-3">Ikuti kanal informasi resmi MUI untuk mendapatkan berita dan fatwa terbaru:</p>
                        <div class="d-flex flex-column gap-2">
                            @if (!empty($settings['kontak_instagram']))
                                <a href="https://instagram.com/{{ ltrim($settings['kontak_instagram'], '@') }}" target="_blank" class="d-flex align-items-center gap-3 p-2 text-dark rounded" style="border: 1px solid var(--border);">
                                    <i class="fab fa-instagram text-danger" style="font-size: 20px; width: 24px; text-align: center;"></i>
                                    <span class="small fw-semibold">{{ $settings['kontak_instagram'] }}</span>
                                </a>
                            @endif

                            @if (!empty($settings['kontak_youtube']))
                                <a href="https://youtube.com/results?search_query={{ urlencode($settings['kontak_youtube']) }}" target="_blank" class="d-flex align-items-center gap-3 p-2 text-dark rounded" style="border: 1px solid var(--border);">
                                    <i class="fab fa-youtube text-danger" style="font-size: 20px; width: 24px; text-align: center;"></i>
                                    <span class="small fw-semibold">{{ $settings['kontak_youtube'] }}</span>
                                </a>
                            @endif

                            @if (!empty($settings['kontak_facebook']))
                                <a href="https://facebook.com/{{ ltrim($settings['kontak_facebook'], '@') }}" target="_blank" class="d-flex align-items-center gap-3 p-2 text-dark rounded" style="border: 1px solid var(--border);">
                                    <i class="fab fa-facebook text-primary" style="font-size: 20px; width: 24px; text-align: center;"></i>
                                    <span class="small fw-semibold">{{ $settings['kontak_facebook'] }}</span>
                                </a>
                            @endif

                            @if (!empty($settings['kontak_twitter']))
                                <a href="https://twitter.com/{{ ltrim($settings['kontak_twitter'], '@') }}" target="_blank" class="d-flex align-items-center gap-3 p-2 text-dark rounded" style="border: 1px solid var(--border);">
                                    <i class="fab fa-twitter text-info" style="font-size: 20px; width: 24px; text-align: center;"></i>
                                    <span class="small fw-semibold">{{ $settings['kontak_twitter'] }}</span>
                                </a>
                            @endif

                            @if (!empty($settings['kontak_tiktok']))
                                <a href="https://tiktok.com/@{{ ltrim($settings['kontak_tiktok'], '@') }}" target="_blank" class="d-flex align-items-center gap-3 p-2 text-dark rounded" style="border: 1px solid var(--border);">
                                    <i class="fab fa-tiktok text-dark" style="font-size: 20px; width: 24px; text-align: center;"></i>
                                    <span class="small fw-semibold">{{ $settings['kontak_tiktok'] }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
