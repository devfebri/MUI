@extends('layouts.frontend')

@section('title', ($settings['struktur_title'] ?? 'Struktur Organisasi') . ' — Majelis Ulama Indonesia')
@section('meta_description', $settings['struktur_subtitle'] ?? 'Susunan struktur organisasi Majelis Ulama Indonesia (MUI), Dewan Pertimbangan, Dewan Pimpinan Harian, Komisi, dan Badan/Lembaga.')

@section('content')
    {{-- ── HERO / BANNER ── --}}
    <section class="page-hero">
        <div class="mui-shell">
            <nav class="page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span>Tentang Kami</span>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="current">Struktur Organisasi</span>
            </nav>
            <h1 class="page-hero-title">{{ $settings['struktur_title'] ?? 'Struktur Organisasi MUI' }}</h1>
            <p class="page-hero-desc">
                {{ $settings['struktur_subtitle'] ?? 'Susunan kepengurusan Dewan Pertimbangan, Dewan Pimpinan Harian, Komisi-Komisi, serta Lembaga/Badan Otonom Majelis Ulama Indonesia.' }}
            </p>
        </div>
    </section>

    {{-- ── CONTENT ── --}}
    <div class="page-content-wrapper">
        <div class="mui-shell">
            <div class="row g-4">
                {{-- Main Column --}}
                <div class="col-lg-8">

                    {{-- Bagan Struktur Organisasi (Jika Diunggah) --}}
                    @if (!empty($settings['struktur_bagan_gambar']))
                        <div class="mui-card mb-4" style="border-top: 4px solid var(--green);">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                                <h2 class="mui-card-title mb-0">
                                    <i class="fas fa-project-diagram text-success"></i>
                                    Bagan Struktur Organisasi
                                </h2>
                                <a href="{{ asset('uploads/pengaturan/' . $settings['struktur_bagan_gambar']) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-expand me-1"></i> Perbesar Bagan
                                </a>
                            </div>
                            <div class="text-center p-2 rounded" style="background: #f8fafc; border: 1px solid var(--border);">
                                <img src="{{ asset('uploads/pengaturan/' . $settings['struktur_bagan_gambar']) }}"
                                     alt="Bagan Struktur Organisasi MUI" class="img-fluid rounded shadow-sm" style="max-height: 480px; object-fit: contain;">
                            </div>
                        </div>
                    @endif

                    {{-- Dewan Pertimbangan --}}
                    <div class="mui-card">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                            <h2 class="mui-card-title mb-0">
                                <i class="fas fa-crown text-warning"></i>
                                Dewan Pertimbangan MUI
                            </h2>
                            <span class="badge" style="background: var(--gold); color: #111; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                                Pengarah & Kebijakan
                            </span>
                        </div>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            {{ $settings['struktur_dewan_pertimbangan_desc'] ?? 'Dewan Pertimbangan berwenang memberikan arahan, fatwa pertimbangan strategis, serta nasihat kepada Dewan Pimpinan Harian dalam penetapan garis kebijakan organisasi.' }}
                        </p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px; display: flex; align-items: center; gap: 14px;">
                                    <div class="icon-circle" style="background: var(--green); color: #fff; width: 46px; height: 46px; font-size: 18px;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Ketua Dewan Pertimbangan</span>
                                        <strong style="color: var(--green-dark); font-size: 15px;">{{ $settings['struktur_ketua_pertimbangan'] ?? "Prof. Dr. KH. Ma'ruf Amin" }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px; display: flex; align-items: center; gap: 14px;">
                                    <div class="icon-circle" style="background: var(--gold); color: #111; width: 46px; height: 46px; font-size: 18px;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Wakil Ketua & Anggota</span>
                                        <strong style="color: var(--green-dark); font-size: 15px;">{{ $settings['struktur_anggota_pertimbangan'] ?? 'Tokoh & Ulama Ormas Islam' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dewan Pimpinan Harian --}}
                    <div class="mui-card">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                            <h2 class="mui-card-title mb-0">
                                <i class="fas fa-sitemap text-success"></i>
                                Dewan Pimpinan Harian
                            </h2>
                            <span class="badge" style="background: var(--green); color: #fff; font-weight: 700; padding: 6px 12px; border-radius: 20px;">
                                Pelaksana Harian
                            </span>
                        </div>
                        <p class="text-muted small mb-3" style="line-height: 1.6;">
                            {{ $settings['struktur_pimpinan_harian_desc'] ?? 'Dewan Pimpinan Harian bertanggung jawab menjalankan roda organisasi, kepemimpinan operasional, serta representasi resmi Majelis Ulama Indonesia.' }}
                        </p>

                        <div class="row g-3">
                            {{-- Ketua Umum --}}
                            <div class="col-12">
                                <div style="background: linear-gradient(135deg, var(--green-pale) 0%, #fff 100%); border: 2px solid var(--green); border-radius: var(--radius); padding: 20px; text-align: center;">
                                    <div class="icon-circle mx-auto mb-2" style="background: var(--green); color: #fff; width: 54px; height: 54px; font-size: 22px;">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <span class="badge" style="background: var(--green-dark); color: #fff; font-size: 11px; padding: 4px 10px;">Pucuk Pimpinan</span>
                                    <h4 class="mt-2 mb-1" style="font-weight: 800; color: var(--green-dark); font-size: 18px;">
                                        {{ $settings['struktur_ketua_umum'] ?? 'Ketua Umum Dewan Pimpinan MUI' }}
                                    </h4>
                                    <p class="mb-0 text-muted small">
                                        {{ $settings['struktur_ketua_umum_desc'] ?? 'Memimpin seluruh pelaksanaan ketetapan Munas dan kebijakan Dewan Pimpinan.' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Wakil Ketua Umum --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; height: 100%;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Posisi Pimpinan</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">
                                        {{ $settings['struktur_wakil_ketua_umum'] ?? 'Wakil Ketua Umum' }}
                                    </h5>
                                    <p class="small text-muted mb-0">
                                        {{ $settings['struktur_wakil_ketua_umum_desc'] ?? 'Membantu pelaksanaan tugas dan wewenang Ketua Umum dalam bidang-bidang strategis.' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Sekretaris Jenderal --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; height: 100%;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Kesekretariatan</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">
                                        {{ $settings['struktur_sekjen'] ?? 'Sekretaris Jenderal (Sekjen)' }}
                                    </h5>
                                    <p class="small text-muted mb-0">
                                        {{ $settings['struktur_sekjen_desc'] ?? 'Memimpin tata kelola administrasi, koordinasi komisi, dan operasional kesekretariatan.' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Bendahara Umum --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; height: 100%;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Perbendaharaan</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">
                                        {{ $settings['struktur_bendahara_umum'] ?? 'Bendahara Umum' }}
                                    </h5>
                                    <p class="small text-muted mb-0">
                                        {{ $settings['struktur_bendahara_umum_desc'] ?? 'Mengelola perbendaharaan, transparansi keuangan, dan akuntabilitas anggaran lembaga.' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Para Ketua Bidang --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; height: 100%;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Bidang Kerja</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">
                                        {{ $settings['struktur_ketua_bidang'] ?? 'Ketua-Ketua Bidang' }}
                                    </h5>
                                    <p class="small text-muted mb-0">
                                        {{ $settings['struktur_ketua_bidang_desc'] ?? 'Mengoordinasikan komisi fatwa, dakwah, ukhuwah, hukum, infokom, dan luar negeri.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Komisi & Lembaga --}}
                    <div class="mui-card">
                        <h2 class="mui-card-title">
                            <i class="fas fa-layer-group text-success"></i>
                            Komisi, Badan & Lembaga Otonom
                        </h2>
                        @php
                            $rawKomisi = array_filter(array_map('trim', explode("\n", $settings['struktur_komisi_list'] ?? '')));
                            $komisiItems = [];
                            foreach ($rawKomisi as $k) {
                                if (str_contains($k, '|')) {
                                    $p = explode('|', $k, 2);
                                    $komisiItems[] = ['name' => trim($p[0]), 'desc' => trim($p[1])];
                                } else {
                                    $komisiItems[] = ['name' => $k, 'desc' => ''];
                                }
                            }
                        @endphp
                        <div class="row g-3">
                            @forelse ($komisiItems as $item)
                                <div class="col-md-6">
                                    <div style="border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 14px; background: var(--bg); height: 100%;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-check text-success" style="font-size: 13px;"></i>
                                            <strong style="color: var(--green-dark); font-size: 14px;">{{ $item['name'] }}</strong>
                                        </div>
                                        @if ($item['desc'])
                                            <p class="mb-0 text-muted small" style="font-size: 12.5px; line-height: 1.5;">
                                                {{ $item['desc'] }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-muted small">Belum ada komisi atau badan otonom terdaftar.</div>
                            @endforelse
                        </div>
                    </div>
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
                            <a href="{{ route('struktur-organisasi') }}" class="btn btn-sm text-start fw-bold" style="background: var(--green-pale); color: var(--green); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-gold"></i> Struktur Organisasi
                            </a>
                            <a href="{{ route('kontak') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Kontak Kami
                            </a>
                        </div>
                    </div>

                    {{-- Informasi Singkat --}}
                    <div class="mui-card" style="padding: 22px; background: linear-gradient(180deg, #fbfbfb 0%, #fff 100%);">
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 14px; border-bottom: 1.5px solid var(--border); padding-bottom: 8px;">
                            Musyawarah Nasional
                        </h3>
                        <p class="small text-muted mb-0" style="line-height: 1.7;">
                            Struktur kepengurusan Majelis Ulama Indonesia ditetapkan secara berkala melalui Musyawarah Nasional (Munas) yang dihadiri oleh perwakilan ormas Islam dan utusan ulama se-Indonesia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
