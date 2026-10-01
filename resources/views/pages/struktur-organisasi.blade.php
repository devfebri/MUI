@extends('layouts.frontend')

@section('title', 'Struktur Organisasi — Majelis Ulama Indonesia')
@section('meta_description', 'Susunan struktur organisasi Majelis Ulama Indonesia (MUI), Dewan Pertimbangan, Dewan Pimpinan Harian, Komisi, dan Badan/Lembaga.')

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
            <h1 class="page-hero-title">Struktur Organisasi MUI</h1>
            <p class="page-hero-desc">
                Susunan kepengurusan Dewan Pertimbangan, Dewan Pimpinan Harian, Komisi-Komisi, serta Lembaga/Badan Otonom Majelis Ulama Indonesia.
            </p>
        </div>
    </section>

    {{-- ── CONTENT ── --}}
    <div class="page-content-wrapper">
        <div class="mui-shell">
            <div class="row g-4">
                {{-- Main Column --}}
                <div class="col-lg-8">
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
                            Dewan Pertimbangan berwenang memberikan arahan, fatwa pertimbangan strategis, serta nasihat kepada Dewan Pimpinan Harian dalam penetapan garis kebijakan organisasi.
                        </p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px; display: flex; align-items: center; gap: 14px;">
                                    <div class="icon-circle" style="background: var(--green); color: #fff; width: 46px; height: 46px; font-size: 18px;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Ketua Dewan Pertimbangan</span>
                                        <strong style="color: var(--green-dark); font-size: 15px;">Prof. Dr. KH. Ma'ruf Amin</strong>
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
                                        <strong style="color: var(--green-dark); font-size: 15px;">Tokoh & Ulama Ormas Islam</strong>
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
                            Dewan Pimpinan Harian bertanggung jawab menjalankan roda organisasi, kepemimpinan operasional, serta representasi resmi Majelis Ulama Indonesia.
                        </p>

                        <div class="row g-3">
                            {{-- Ketua Umum --}}
                            <div class="col-12">
                                <div style="background: linear-gradient(135deg, var(--green-pale) 0%, #fff 100%); border: 2px solid var(--green); border-radius: var(--radius); padding: 20px; text-align: center;">
                                    <div class="icon-circle mx-auto mb-2" style="background: var(--green); color: #fff; width: 54px; height: 54px; font-size: 22px;">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <span class="badge" style="background: var(--green-dark); color: #fff; font-size: 11px; padding: 4px 10px;">Pucuk Pimpinan</span>
                                    <h4 class="mt-2 mb-1" style="font-weight: 800; color: var(--green-dark); font-size: 18px;">Ketua Umum Dewan Pimpinan MUI</h4>
                                    <p class="mb-0 text-muted small">Memimpin seluruh pelaksanaan ketetapan Munas dan kebijakan Dewan Pimpinan.</p>
                                </div>
                            </div>

                            {{-- Wakil Ketua Umum --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Posisi Pimpinan</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">Wakil Ketua Umum</h5>
                                    <p class="small text-muted mb-0">Membantu pelaksanaan tugas dan wewenang Ketua Umum dalam bidang-bidang strategis.</p>
                                </div>
                            </div>

                            {{-- Sekretaris Jenderal --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Kesekretariatan</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">Sekretaris Jenderal (Sekjen)</h5>
                                    <p class="small text-muted mb-0">Memimpin tata kelola administrasi, koordinasi komisi, dan operasional kesekretariatan.</p>
                                </div>
                            </div>

                            {{-- Bendahara Umum --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Perbendaharaan</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">Bendahara Umum</h5>
                                    <p class="small text-muted mb-0">Mengelola perbendaharaan, transparansi keuangan, dan akuntabilitas anggaran lembaga.</p>
                                </div>
                            </div>

                            {{-- Para Ketua Bidang --}}
                            <div class="col-md-6">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px;">
                                    <span class="text-muted d-block small" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Bidang Kerja</span>
                                    <h5 style="color: var(--green-dark); font-weight: 700; font-size: 15px; margin-bottom: 4px;">Ketua-Ketua Bidang</h5>
                                    <p class="small text-muted mb-0">Mengoordinasikan komisi fatwa, dakwah, ukhuwah, hukum, infokom, dan luar negeri.</p>
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
                        <div class="row g-3">
                            @php
                                $komisiBadan = [
                                    ['name' => 'Komisi Fatwa', 'desc' => 'Merumuskan dan mengeluarkan fatwa-fatwa hukum syariah kontemporer.'],
                                    ['name' => 'Komisi Dakwah & Pengembangan Masyarakat', 'desc' => 'Mengoordinasikan program standardisasi da\'i dan pemberdayaan umat.'],
                                    ['name' => 'Komisi Ukhuwah Islamiyah', 'desc' => 'Merajut kesatuan dan kerukunan antar organisasi kemasyarakatan Islam.'],
                                    ['name' => 'Komisi Hukum & Hak Asasi Manusia', 'desc' => 'Advokasi hukum, perlindungan umat, dan kajian legislasi kebangsaan.'],
                                    ['name' => 'Dewan Syariah Nasional (DSN-MUI)', 'desc' => 'Menetapkan fatwa ekonomi, perbankan, dan keuangan syariah nasional.'],
                                    ['name' => 'Lembaga Pengkajian POM (LPPOM-MUI)', 'desc' => 'Pemeriksaan kepatuhan halal produk pangan, obat, dan kosmetika.'],
                                ];
                            @endphp

                            @foreach ($komisiBadan as $item)
                                <div class="col-md-6">
                                    <div style="border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 14px; background: var(--bg); height: 100%;">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <i class="fas fa-check text-success" style="font-size: 13px;"></i>
                                            <strong style="color: var(--green-dark); font-size: 14px;">{{ $item['name'] }}</strong>
                                        </div>
                                        <p class="mb-0 text-muted small" style="font-size: 12.5px; line-height: 1.5;">
                                            {{ $item['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
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

                    {{-- Periode Kepengurusan --}}
                    <div class="mui-card" style="padding: 22px; background: linear-gradient(135deg, #fff 0%, var(--green-pale) 100%);">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h4 style="font-size: 15px; font-weight: 700; color: var(--green-dark); margin-bottom: 8px;">
                            Musyawarah Nasional (Munas)
                        </h4>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">
                            Kepengurusan Majelis Ulama Indonesia dipilih secara musyawarah mufakat melalui Musyawarah Nasional (Munas) yang diadakan secara berkala setiap 5 (lima) tahun sekali.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
