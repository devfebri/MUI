@extends('layouts.frontend')

@section('title', ($settings['visi_title'] ?? 'Visi & Misi') . ' — Majelis Ulama Indonesia')
@section('meta_description', $settings['visi_subtitle'] ?? 'Visi dan Misi Majelis Ulama Indonesia (MUI) dalam mewujudkan baldatun thayyibatun wa rabbun ghafur serta masyarakat khaira ummah di Indonesia.')

@section('content')
    {{-- ── HERO / BANNER ── --}}
    <section class="page-hero">
        <div class="mui-shell">
            <nav class="page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span>Tentang Kami</span>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="current">Visi & Misi</span>
            </nav>
            <h1 class="page-hero-title">{{ $settings['visi_title'] ?? 'Visi & Misi MUI' }}</h1>
            <p class="page-hero-desc">
                {{ $settings['visi_subtitle'] ?? 'Arah, cita-cita luhur, dan komitmen pengabdian Majelis Ulama Indonesia bagi kemaslahatan umat dan bangsa.' }}
            </p>
        </div>
    </section>

    {{-- ── CONTENT ── --}}
    <div class="page-content-wrapper">
        <div class="mui-shell">
            <div class="row g-4">
                {{-- Main Column --}}
                <div class="col-lg-8">
                    {{-- VISI MUI --}}
                    <div class="mui-card" style="border-top: 4px solid var(--gold);">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="icon-circle" style="background: var(--gold-light); color: var(--green-dark);">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div>
                                <span class="badge" style="background: var(--green); color: #fff; font-size: 11px; padding: 4px 10px;">Cita-Cita Luhur</span>
                                <h2 class="mb-0 mt-1" style="font-size: 22px; font-weight: 800; color: var(--green-dark);">
                                    Visi Majelis Ulama Indonesia
                                </h2>
                            </div>
                        </div>

                        <div style="background: var(--green-pale); border-left: 4px solid var(--green); border-radius: var(--radius-sm); padding: 22px; margin-top: 14px;">
                            <blockquote style="font-family: 'Amiri', serif; font-size: 20px; line-height: 1.8; color: var(--green-dark); margin-bottom: 12px; font-style: italic;">
                                "{{ $settings['visi_text'] ?? 'Terciptanya kondisi kehidupan kemasyarakatan, kebangsaan dan kenegaraan yang baik, memperoleh ridha dan ampunan Allah SWT (Baldatun Thayyibatun Wa Rabbun Ghafur) menuju masyarakat berkualitas (Khaira Ummah) demi terwujudnya kejayaan Islam dan kaum muslimin (Izzul Islam wal Muslimin) dalam wadah Negara Kesatuan Republik Indonesia.' }}"
                            </blockquote>
                        </div>
                    </div>

                    {{-- MISI MUI --}}
                    <div class="mui-card" style="border-top: 4px solid var(--green);">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="icon-circle">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div>
                                <span class="badge" style="background: var(--gold); color: #1a1a1a; font-size: 11px; padding: 4px 10px;">Langkah Strategis</span>
                                <h2 class="mb-0 mt-1" style="font-size: 22px; font-weight: 800; color: var(--green-dark);">
                                    Misi Majelis Ulama Indonesia
                                </h2>
                            </div>
                        </div>

                        @php
                            $rawMisi = array_filter(array_map('trim', explode("\n", $settings['misi_list'] ?? '')));
                            $misiItems = [];
                            foreach ($rawMisi as $idx => $line) {
                                $num = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
                                if (str_contains($line, '|')) {
                                    $parts = explode('|', $line, 2);
                                    $misiItems[] = [
                                        'num' => $num,
                                        'title' => trim($parts[0]),
                                        'desc' => trim($parts[1]),
                                    ];
                                } else {
                                    $misiItems[] = [
                                        'num' => $num,
                                        'title' => 'Misi ' . ($idx + 1),
                                        'desc' => $line,
                                    ];
                                }
                            }
                        @endphp

                        <div class="d-flex flex-column gap-3 mt-3">
                            @forelse ($misiItems as $m)
                                <div style="display: flex; gap: 16px; padding: 14px 16px; background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius-sm);">
                                    <div style="font-size: 18px; font-weight: 800; color: var(--green); min-width: 32px;">
                                        {{ $m['num'] }}
                                    </div>
                                    <div>
                                        <h5 style="font-size: 14.5px; font-weight: 700; color: var(--green-dark); margin-bottom: 4px;">
                                            {{ $m['title'] }}
                                        </h5>
                                        <p class="mb-0 text-muted" style="font-size: 13.5px; line-height: 1.6;">
                                            {{ $m['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted small">Belum ada daftar misi yang ditambahkan.</div>
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
                            <a href="{{ route('visi-misi') }}" class="btn btn-sm text-start fw-bold" style="background: var(--green-pale); color: var(--green); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-gold"></i> Visi Misi
                            </a>
                            <a href="{{ route('struktur-organisasi') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Struktur Organisasi
                            </a>
                            <a href="{{ route('kontak') }}" class="btn btn-sm text-start text-dark" style="border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px;">
                                <i class="fas fa-chevron-right me-2 text-muted"></i> Kontak Kami
                            </a>
                        </div>
                    </div>

                    {{-- Prinsip Wasathiyah --}}
                    <div class="mui-card" style="padding: 22px; background: linear-gradient(135deg, var(--green-pale) 0%, #fff 100%);">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <h4 style="font-size: 15px; font-weight: 700; color: var(--green-dark); margin-bottom: 8px;">
                            {{ $settings['wasathiyah_title'] ?? 'Prinsip Islam Wasathiyah' }}
                        </h4>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">
                            {{ $settings['wasathiyah_desc'] ?? 'MUI senantiasa mengedepankan corak keislaman yang moderat (tawasuth), berimbang (tawazun), adil (i\'tidal), dan toleran (tasamuh) dalam setiap bimbingan fatwa dan gerak langkahnya.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
