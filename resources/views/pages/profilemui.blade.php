@extends('layouts.frontend')

@section('title', 'Profil MUI — Majelis Ulama Indonesia')
@section('meta_description', 'Profil lengkap Majelis Ulama Indonesia (MUI), sejarah berdirinya, peran khadimul ummah, serta tugas pokok dalam mengayomi umat Islam di Indonesia.')

@section('content')
    {{-- ── HERO / BANNER ── --}}
    <section class="page-hero">
        <div class="mui-shell">
            <nav class="page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span>Tentang Kami</span>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="current">Profil MUI</span>
            </nav>
            <h1 class="page-hero-title">Profil Majelis Ulama Indonesia</h1>
            <p class="page-hero-desc">
                Wadah musyawarah para ulama, zuama, dan cendekiawan muslim di Indonesia yang berkhidmat membimbing, membina, dan mengayomi umat.
            </p>
        </div>
    </section>

    {{-- ── CONTENT ── --}}
    <div class="page-content-wrapper">
        <div class="mui-shell">
            <div class="row g-4">
                {{-- Main Column --}}
                <div class="col-lg-8">
                    {{-- Tentang MUI --}}
                    <div class="mui-card">
                        <h2 class="mui-card-title">
                            <i class="fas fa-landmark text-success"></i>
                            Sekilas Tentang Majelis Ulama Indonesia
                        </h2>
                        <p class="lead text-muted" style="font-size: 15.5px; line-height: 1.8;">
                            <strong>Majelis Ulama Indonesia (MUI)</strong> adalah Lembaga Swadaya Masyarakat yang mewadahi para ulama, zu'ama, dan cendekiawan Islam di Indonesia untuk membimbing, membina, dan mengayomi kaum muslimin di seluruh Indonesia.
                        </p>
                        <p style="color: var(--text); line-height: 1.8; font-size: 14.5px;">
                            MUI berdiri pada tanggal <strong>7 Rajab 1395 Hijriah</strong> atau bertepatan dengan tanggal <strong>26 Juli 1975</strong> di Jakarta, sebagai hasil dari pertemuan para ulama, cendekiawan, dan tokoh dari berbagai organisasi kemasyarakatan Islam di tanah air.
                        </p>
                        <p style="color: var(--text); line-height: 1.8; font-size: 14.5px;">
                            Dalam perjalanannya, MUI terus berdiri di garda terdepan sebagai tenda besar umat Islam Indonesia, merajut persatuan di tengah kebhinekaan serta senantiasa memberikan panduan moral dan syariah bagi masyarakat dan negara.
                        </p>
                    </div>

                    {{-- 3 Peran Strategis MUI --}}
                    <div class="mui-card">
                        <h2 class="mui-card-title">
                            <i class="fas fa-award text-success"></i>
                            Tiga Peran Strategis MUI
                        </h2>
                        <div class="row g-3 mt-1">
                            <div class="col-md-4">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px; height: 100%;">
                                    <div class="icon-circle mb-3">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <h5 style="font-size: 15px; font-weight: 700; color: var(--green-dark);">Khadimul Ummah</h5>
                                    <p class="small text-muted mb-0" style="font-size: 12.5px; line-height: 1.6;">
                                        Pelayan umat yang senantiasa hadir memberikan bimbingan, perlindungan, dan solusi syariah atas berbagai persoalan umat.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px; height: 100%;">
                                    <div class="icon-circle mb-3">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <h5 style="font-size: 15px; font-weight: 700; color: var(--green-dark);">Himayatul Ummah</h5>
                                    <p class="small text-muted mb-0" style="font-size: 12.5px; line-height: 1.6;">
                                        Penjaga dan benteng akidah umat dari pemikiran, aliran menyimpang, dan pengaruh negatif yang merusak moralitas bangsa.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 18px; height: 100%;">
                                    <div class="icon-circle mb-3">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <h5 style="font-size: 15px; font-weight: 700; color: var(--green-dark);">Shodiqul Hukumah</h5>
                                    <p class="small text-muted mb-0" style="font-size: 12.5px; line-height: 1.6;">
                                        Mitra kritis dan konstruktif pemerintah dalam mewujudkan kemaslahatan masyarakat dan kebijakan bangsa yang bermartabat.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tugas Pokok --}}
                    <div class="mui-card">
                        <h2 class="mui-card-title">
                            <i class="fas fa-tasks text-success"></i>
                            Tugas Pokok & Fungsi MUI
                        </h2>
                        <ul style="list-style: none; padding-left: 0; display: flex; flex-direction: column; gap: 14px;">
                            <li style="display: flex; gap: 12px; font-size: 14.5px; line-height: 1.7;">
                                <i class="fas fa-check-circle text-success mt-1" style="font-size: 16px;"></i>
                                <div>
                                    <strong>Pemberi Fatwa dan Panduan Hukum Islam:</strong> Merumuskan fatwa hukum syariah terhadap masalah-masalah kontemporer keagamaan, sosial, dan ekonomi syariah.
                                </div>
                            </li>
                            <li style="display: flex; gap: 12px; font-size: 14.5px; line-height: 1.7;">
                                <i class="fas fa-check-circle text-success mt-1" style="font-size: 16px;"></i>
                                <div>
                                    <strong>Perekat Ukhuwah Islamiyah & Kebangsaan:</strong> Memperkuat persatuan antar umat Islam (Ukhuwah Islamiyah), persaudaraan kebangsaan (Ukhuwah Wathaniyah), dan kemanusiaan (Ukhuwah Insaniyah).
                                </div>
                            </li>
                            <li style="display: flex; gap: 12px; font-size: 14.5px; line-height: 1.7;">
                                <i class="fas fa-check-circle text-success mt-1" style="font-size: 16px;"></i>
                                <div>
                                    <strong>Jaminan Produk Halal:</strong> Mengawal kepastian kehalalan produk pangan, obat-obatan, dan kosmetika untuk ketenangan masyarakat muslim Indonesia.
                                </div>
                            </li>
                            <li style="display: flex; gap: 12px; font-size: 14.5px; line-height: 1.7;">
                                <i class="fas fa-check-circle text-success mt-1" style="font-size: 16px;"></i>
                                <div>
                                    <strong>Pengembangan Ekonomi Syariah:</strong> Memberikan panduan prinsip-prinsip syariah pada industri keuangan, perbankan, pasar modal, dan bisnis syariah melalui DSN-MUI.
                                </div>
                            </li>
                        </ul>
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
                            <a href="{{ route('profilemui') }}" class="btn btn-sm text-start fw-bold" style="background: var(--green-pale); color: var(--green); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-gold"></i> Profil MUI
                            </a>
                            <a href="{{ route('visi-misi') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Visi Misi
                            </a>
                            <a href="{{ route('struktur-organisasi') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Struktur Organisasi
                            </a>
                            <a href="{{ route('kontak') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Kontak Kami
                            </a>
                        </div>
                    </div>

                    {{-- Informasi Singkat --}}
                    <div class="mui-card" style="padding: 22px; background: linear-gradient(180deg, #fbfbfb 0%, #fff 100%);">
                        <h3 style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 14px; border-bottom: 1.5px solid var(--border); padding-bottom: 8px;">
                            Informasi Lembaga
                        </h3>
                        <div class="d-flex flex-column gap-3 font-monospace" style="font-size: 13px;">
                            <div>
                                <span class="text-muted d-block font-sans mb-1" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Tanggal Berdiri</span>
                                <strong style="font-family: 'Inter', sans-serif;">26 Juli 1975 (7 Rajab 1395 H)</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block font-sans mb-1" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Sifat Lembaga</span>
                                <strong style="font-family: 'Inter', sans-serif;">Lembaga Keagamaan Independen</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block font-sans mb-1" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Alamat Kantor Pusat</span>
                                <span style="font-family: 'Inter', sans-serif; color: var(--text);">Jl. Proklamasi No. 51, Menteng, Jakarta Pusat 10320</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
