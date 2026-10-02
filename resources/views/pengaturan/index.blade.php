@extends('layouts.master')

@section('css')
<style>
    :root {
        --green:      #007f5f;
        --green-dark: #005f47;
        --green-light:#00a878;
        --green-pale: #e8f5f1;
        --gold:       #c9a84c;
        --gold-light: #f5eedb;
        --red:        #ef4444;
        --yellow:     #f0a500;
        --blue:       #2563eb;
        --text:       #1a1a2e;
        --gray:       #6b7280;
        --bg:         #f4f7f6;
        --white:      #ffffff;
        --radius:     14px;
        --radius-sm:  9px;
        --shadow:     0 2px 16px rgba(0,0,0,.07);
        --shadow-hov: 0 8px 32px rgba(0,127,95,.16);
        --tr:         .22s cubic-bezier(.4,0,.2,1);
    }

    body { background: var(--bg) !important; }

    /* PAGE HEADER */
    .page-header {
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        border-radius: var(--radius);
        padding: 24px 28px;
        margin-bottom: 24px;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 12px;
    }
    .page-header h4 { font-size: 20px; font-weight: 800; margin: 0; color: #fff; }
    .page-header p  { margin: 3px 0 0; font-size: 13px; color: rgba(255,255,255,.85); }

    /* TABS NAV */
    .nav-settings {
        display: flex;
        gap: 10px;
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 24px;
        overflow-x: auto;
        padding-bottom: 2px;
    }
    .nav-settings-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: var(--radius-sm) var(--radius-sm) 0 0;
        font-size: 14px;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none !important;
        border-bottom: 3px solid transparent;
        transition: all var(--tr);
        white-space: nowrap;
    }
    .nav-settings-link:hover {
        color: var(--green);
        background: var(--green-pale);
    }
    .nav-settings-link.active {
        color: var(--green-dark);
        border-bottom-color: var(--green);
        background: #fff;
    }

    /* CARD CONTAINER */
    .settings-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid #eef2f0;
        padding: 28px;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--green-dark);
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-desc {
        font-size: 13px;
        color: var(--gray);
        margin-bottom: 20px;
    }

    /* FORM ELEMENTS */
    .form-label {
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 6px;
    }
    .form-label small {
        font-weight: 400;
        color: var(--gray);
    }
    .form-control, .form-select {
        border-radius: var(--radius-sm);
        border: 1.5px solid #e2e8f0;
        font-size: 13.5px;
        padding: 10px 14px;
        transition: all var(--tr);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(0, 127, 95, .15);
    }
    .input-group-text {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-right: none;
        color: var(--green);
        font-size: 14px;
        border-radius: var(--radius-sm) 0 0 var(--radius-sm);
    }
    .input-group .form-control {
        border-left: none;
    }

    .form-divider {
        height: 1px;
        background: #eef2f0;
        margin: 28px 0;
    }

    .btn-save {
        background: var(--green);
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        padding: 12px 28px;
        border-radius: var(--radius-sm);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0, 127, 95, .25);
        transition: all var(--tr);
    }
    .btn-save:hover {
        background: var(--green-dark);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 127, 95, .35);
    }

    .preview-box {
        background: #fbfcfb;
        border: 1px dashed #cbd5e1;
        border-radius: var(--radius-sm);
        padding: 14px;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h4><i class="mdi mdi-cog-outline me-2"></i> Pengaturan Website — Tentang Kami</h4>
            <p>Kelola konten halaman Profil MUI, Visi & Misi, Struktur Organisasi, serta Kontak yang tampil di frontend.</p>
        </div>
        <div>
            <a href="{{ route('profilemui') }}" target="_blank" class="btn btn-light btn-sm text-dark fw-bold px-3 py-2 shadow-sm rounded-pill">
                <i class="mdi mdi-open-in-new me-1 text-success"></i> Lihat Frontend
            </a>
        </div>
    </div>

    {{-- TABS MENU --}}
    <div class="nav-settings">
        <a href="{{ route('admin.pengaturan.index', ['tab' => 'profil']) }}"
           class="nav-settings-link {{ $tab === 'profil' ? 'active' : '' }}">
            <i class="mdi mdi-card-account-details-outline"></i> 1. Profil MUI
        </a>
        <a href="{{ route('admin.pengaturan.index', ['tab' => 'visi_misi']) }}"
           class="nav-settings-link {{ $tab === 'visi_misi' ? 'active' : '' }}">
            <i class="mdi mdi-bullseye-arrow"></i> 2. Visi & Misi
        </a>
        <a href="{{ route('admin.pengaturan.index', ['tab' => 'struktur']) }}"
           class="nav-settings-link {{ $tab === 'struktur' ? 'active' : '' }}">
            <i class="mdi mdi-sitemap-outline"></i> 3. Struktur Organisasi
        </a>
        <a href="{{ route('admin.pengaturan.index', ['tab' => 'kontak']) }}"
           class="nav-settings-link {{ $tab === 'kontak' ? 'active' : '' }}">
            <i class="mdi mdi-phone-classic"></i> 4. Kontak & Medsos
        </a>
        <a href="{{ route('admin.pengaturan.index', ['tab' => 'livechat']) }}"
           class="nav-settings-link {{ $tab === 'livechat' ? 'active' : '' }}">
            <i class="mdi mdi-forum-outline"></i> 5. Live Chat & Jam Kerja
        </a>
    </div>

    {{-- TAB 1: PROFIL MUI --}}
    @if ($tab === 'profil')
    <div class="settings-card">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
            @csrf
            <input type="hidden" name="_section" value="profil">

            <div class="section-title">
                <i class="mdi mdi-format-title"></i> Judul & Deskripsi Singkat Header
            </div>
            <p class="section-desc">Teks judul utama dan pengantar yang muncul pada banner halaman Profil MUI.</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Judul Utama Halaman <span class="text-danger">*</span></label>
                    <input type="text" name="profil_title" class="form-control"
                           value="{{ old('profil_title', $settings['profil_title'] ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subtitle / Ringkasan Banner</label>
                    <input type="text" name="profil_subtitle" class="form-control"
                           value="{{ old('profil_subtitle', $settings['profil_subtitle'] ?? '') }}">
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-book-open-page-variant"></i> Sekilas Tentang Majelis Ulama Indonesia
            </div>
            <p class="section-desc">Uraian 3 paragraf penjelasan sejarah dan profil MUI.</p>

            <div class="mb-3">
                <label class="form-label">Paragraf 1 (Pengertian Umum MUI)</label>
                <textarea name="profil_sekilas_1" rows="3" class="form-control">{{ old('profil_sekilas_1', $settings['profil_sekilas_1'] ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Paragraf 2 (Sejarah Pendirian MUI)</label>
                <textarea name="profil_sekilas_2" rows="3" class="form-control">{{ old('profil_sekilas_2', $settings['profil_sekilas_2'] ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Paragraf 3 (Perjalanan & Komitmen MUI)</label>
                <textarea name="profil_sekilas_3" rows="3" class="form-control">{{ old('profil_sekilas_3', $settings['profil_sekilas_3'] ?? '') }}</textarea>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-shield-star"></i> Tiga Peran Strategis MUI
            </div>
            <p class="section-desc">Tiga pilar peran MUI: Khadimul Ummah, Himayatul Ummah, dan Shodiqul Hukumah.</p>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <label class="form-label">Peran 1: Judul</label>
                        <input type="text" name="profil_peran_1_title" class="form-control mb-2"
                               value="{{ old('profil_peran_1_title', $settings['profil_peran_1_title'] ?? 'Khadimul Ummah') }}">
                        <label class="form-label">Peran 1: Deskripsi</label>
                        <textarea name="profil_peran_1_desc" rows="3" class="form-control">{{ old('profil_peran_1_desc', $settings['profil_peran_1_desc'] ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <label class="form-label">Peran 2: Judul</label>
                        <input type="text" name="profil_peran_2_title" class="form-control mb-2"
                               value="{{ old('profil_peran_2_title', $settings['profil_peran_2_title'] ?? 'Himayatul Ummah') }}">
                        <label class="form-label">Peran 2: Deskripsi</label>
                        <textarea name="profil_peran_2_desc" rows="3" class="form-control">{{ old('profil_peran_2_desc', $settings['profil_peran_2_desc'] ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 border rounded bg-light">
                        <label class="form-label">Peran 3: Judul</label>
                        <input type="text" name="profil_peran_3_title" class="form-control mb-2"
                               value="{{ old('profil_peran_3_title', $settings['profil_peran_3_title'] ?? 'Shodiqul Hukumah') }}">
                        <label class="form-label">Peran 3: Deskripsi</label>
                        <textarea name="profil_peran_3_desc" rows="3" class="form-control">{{ old('profil_peran_3_desc', $settings['profil_peran_3_desc'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-format-list-checks"></i> Tugas Pokok & Fungsi MUI
            </div>
            <p class="section-desc">Poin-poin tugas dan fungsi pokok (pisahkan tiap poin dengan baris baru. Format: <code>Judul: Penjelasan</code>).</p>

            <div class="mb-3">
                <textarea name="profil_tugas_pokok" rows="5" class="form-control">{{ old('profil_tugas_pokok', $settings['profil_tugas_pokok'] ?? '') }}</textarea>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-information-outline"></i> Informasi Lembaga (Sidebar)
            </div>
            <p class="section-desc">Informasi singkat tanggal berdiri, sifat lembaga, dan alamat kantor pusat/daerah.</p>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Berdiri</label>
                    <input type="text" name="profil_tgl_berdiri" class="form-control"
                           value="{{ old('profil_tgl_berdiri', $settings['profil_tgl_berdiri'] ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sifat Lembaga</label>
                    <input type="text" name="profil_sifat_lembaga" class="form-control"
                           value="{{ old('profil_sifat_lembaga', $settings['profil_sifat_lembaga'] ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Alamat Kantor</label>
                    <input type="text" name="profil_alamat_kantor" class="form-control"
                           value="{{ old('profil_alamat_kantor', $settings['profil_alamat_kantor'] ?? '') }}">
                </div>
            </div>

            <div class="mt-4 pt-3">
                <button type="submit" class="btn-save">
                    <i class="mdi mdi-content-save"></i> Simpan Pengaturan Profil
                </button>
            </div>
        </form>
    </div>
    @endif

    {{-- TAB 2: VISI & MISI --}}
    @if ($tab === 'visi_misi')
    <div class="settings-card">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
            @csrf
            <input type="hidden" name="_section" value="visi_misi">

            <div class="section-title">
                <i class="mdi mdi-format-title"></i> Header Visi & Misi
            </div>
            <p class="section-desc">Judul dan pengantar banner halaman Visi & Misi.</p>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                    <input type="text" name="visi_title" class="form-control"
                           value="{{ old('visi_title', $settings['visi_title'] ?? 'Visi & Misi MUI') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subtitle Banner</label>
                    <input type="text" name="visi_subtitle" class="form-control"
                           value="{{ old('visi_subtitle', $settings['visi_subtitle'] ?? '') }}">
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-eye"></i> Teks Visi MUI
            </div>
            <p class="section-desc">Rumusan visi utama Majelis Ulama Indonesia.</p>

            <div class="mb-4">
                <textarea name="visi_text" rows="4" class="form-control" required>{{ old('visi_text', $settings['visi_text'] ?? '') }}</textarea>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-bullseye"></i> Daftar Butir Misi MUI
            </div>
            <p class="section-desc">Tuliskan tiap butir misi per baris dengan format: <code>Judul Misi | Uraian Misi</code>.</p>

            <div class="mb-4">
                <textarea name="misi_list" rows="10" class="form-control font-monospace" style="font-size: 13px;">{{ old('misi_list', $settings['misi_list'] ?? '') }}</textarea>
                <small class="text-muted d-block mt-1">
                    <i class="mdi mdi-information-outline text-info"></i> Format: <code>Judul Langkah | Penjelasan langkah kerja</code> per baris.
                </small>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-scale-balance"></i> Prinsip Islam Wasathiyah (Sidebar)
            </div>
            <p class="section-desc">Prinsip moderasi beragama yang ditampilkan pada kartu sidebar.</p>

            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Judul Prinsip</label>
                    <input type="text" name="wasathiyah_title" class="form-control"
                           value="{{ old('wasathiyah_title', $settings['wasathiyah_title'] ?? 'Prinsip Islam Wasathiyah') }}">
                </div>
                <div class="col-md-7">
                    <label class="form-label">Penjelasan / Uraian</label>
                    <textarea name="wasathiyah_desc" rows="3" class="form-control">{{ old('wasathiyah_desc', $settings['wasathiyah_desc'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-4 pt-3">
                <button type="submit" class="btn-save">
                    <i class="mdi mdi-content-save"></i> Simpan Visi & Misi
                </button>
            </div>
        </form>
    </div>
    @endif

    {{-- TAB 3: STRUKTUR ORGANISASI --}}
    @if ($tab === 'struktur')
    <div class="settings-card">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_section" value="struktur">

            <div class="section-title">
                <i class="mdi mdi-format-title"></i> Header Struktur Organisasi
            </div>
            <p class="section-desc">Judul dan pengantar susunan struktur organisasi MUI.</p>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                    <input type="text" name="struktur_title" class="form-control"
                           value="{{ old('struktur_title', $settings['struktur_title'] ?? 'Struktur Organisasi MUI') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subtitle Banner</label>
                    <input type="text" name="struktur_subtitle" class="form-control"
                           value="{{ old('struktur_subtitle', $settings['struktur_subtitle'] ?? '') }}">
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-image"></i> Gambar / Bagan Struktur Organisasi (Opsional)
            </div>
            <p class="section-desc">Unggah foto bagan / diagram kepengurusan organisasi jika tersedia (PNG, JPG, WEBP, maks 4MB).</p>

            <div class="row align-items-center g-3 mb-3">
                <div class="col-md-6">
                    <input type="file" name="struktur_bagan_gambar" class="form-control" accept="image/*">
                </div>
                @if (!empty($settings['struktur_bagan_gambar']))
                <div class="col-md-6">
                    <div class="preview-box d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('uploads/pengaturan/' . $settings['struktur_bagan_gambar']) }}"
                                 alt="Bagan" style="height: 60px; object-fit: contain; border-radius: 6px; border: 1px solid #ddd;">
                            <span class="small text-muted">{{ $settings['struktur_bagan_gambar'] }}</span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hapus_bagan_gambar" value="1" id="hapusBagan">
                            <label class="form-check-label text-danger small fw-bold" for="hapusBagan">
                                Hapus Bagan Ini
                            </label>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-crown"></i> Dewan Pertimbangan
            </div>
            <p class="section-desc">Keterangan fungsi, nama ketua, dan anggota dewan pertimbangan.</p>

            <div class="mb-3">
                <label class="form-label">Deskripsi Dewan Pertimbangan</label>
                <textarea name="struktur_dewan_pertimbangan_desc" rows="2" class="form-control">{{ old('struktur_dewan_pertimbangan_desc', $settings['struktur_dewan_pertimbangan_desc'] ?? '') }}</textarea>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Ketua Dewan Pertimbangan</label>
                    <input type="text" name="struktur_ketua_pertimbangan" class="form-control"
                           value="{{ old('struktur_ketua_pertimbangan', $settings['struktur_ketua_pertimbangan'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Wakil Ketua & Anggota</label>
                    <input type="text" name="struktur_anggota_pertimbangan" class="form-control"
                           value="{{ old('struktur_anggota_pertimbangan', $settings['struktur_anggota_pertimbangan'] ?? '') }}">
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-account-group"></i> Dewan Pimpinan Harian
            </div>
            <p class="section-desc">Pimpinan operasional harian Majelis Ulama Indonesia.</p>

            <div class="mb-3">
                <label class="form-label">Deskripsi Dewan Pimpinan Harian</label>
                <textarea name="struktur_pimpinan_harian_desc" rows="2" class="form-control">{{ old('struktur_pimpinan_harian_desc', $settings['struktur_pimpinan_harian_desc'] ?? '') }}</textarea>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light mb-3">
                        <label class="form-label">Ketua Umum</label>
                        <input type="text" name="struktur_ketua_umum" class="form-control mb-2"
                               value="{{ old('struktur_ketua_umum', $settings['struktur_ketua_umum'] ?? '') }}">
                        <label class="form-label">Keterangan / Peran Ketua Umum</label>
                        <input type="text" name="struktur_ketua_umum_desc" class="form-control"
                               value="{{ old('struktur_ketua_umum_desc', $settings['struktur_ketua_umum_desc'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light mb-3">
                        <label class="form-label">Wakil Ketua Umum</label>
                        <input type="text" name="struktur_wakil_ketua_umum" class="form-control mb-2"
                               value="{{ old('struktur_wakil_ketua_umum', $settings['struktur_wakil_ketua_umum'] ?? '') }}">
                        <label class="form-label">Keterangan / Peran Wakil Ketua Umum</label>
                        <input type="text" name="struktur_wakil_ketua_umum_desc" class="form-control"
                               value="{{ old('struktur_wakil_ketua_umum_desc', $settings['struktur_wakil_ketua_umum_desc'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light mb-3">
                        <label class="form-label">Sekretaris Jenderal (Sekjen)</label>
                        <input type="text" name="struktur_sekjen" class="form-control mb-2"
                               value="{{ old('struktur_sekjen', $settings['struktur_sekjen'] ?? '') }}">
                        <label class="form-label">Keterangan / Peran Sekjen</label>
                        <input type="text" name="struktur_sekjen_desc" class="form-control"
                               value="{{ old('struktur_sekjen_desc', $settings['struktur_sekjen_desc'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light mb-3">
                        <label class="form-label">Bendahara Umum</label>
                        <input type="text" name="struktur_bendahara_umum" class="form-control mb-2"
                               value="{{ old('struktur_bendahara_umum', $settings['struktur_bendahara_umum'] ?? '') }}">
                        <label class="form-label">Keterangan / Peran Bendahara Umum</label>
                        <input type="text" name="struktur_bendahara_umum_desc" class="form-control"
                               value="{{ old('struktur_bendahara_umum_desc', $settings['struktur_bendahara_umum_desc'] ?? '') }}">
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-3 border rounded bg-light mb-3">
                        <label class="form-label">Ketua-Ketua Bidang</label>
                        <input type="text" name="struktur_ketua_bidang" class="form-control mb-2"
                               value="{{ old('struktur_ketua_bidang', $settings['struktur_ketua_bidang'] ?? '') }}">
                        <label class="form-label">Keterangan / Peran Para Ketua Bidang</label>
                        <input type="text" name="struktur_ketua_bidang_desc" class="form-control"
                               value="{{ old('struktur_ketua_bidang_desc', $settings['struktur_ketua_bidang_desc'] ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-layers-outline"></i> Komisi, Badan & Lembaga Otonom
            </div>
            <p class="section-desc">Daftar nama komisi/badan beserta deskripsi singkatnya. Tulis per baris dengan format: <code>Nama Komisi | Deskripsi</code>.</p>

            <div class="mb-4">
                <textarea name="struktur_komisi_list" rows="8" class="form-control font-monospace" style="font-size: 13px;">{{ old('struktur_komisi_list', $settings['struktur_komisi_list'] ?? '') }}</textarea>
                <small class="text-muted d-block mt-1">
                    <i class="mdi mdi-information-outline text-info"></i> Format: <code>Nama Lembaga/Komisi | Penjelasan tugas</code> per baris.
                </small>
            </div>

            <div class="mt-4 pt-3">
                <button type="submit" class="btn-save">
                    <i class="mdi mdi-content-save"></i> Simpan Struktur Organisasi
                </button>
            </div>
        </form>
    </div>
    @endif

    {{-- TAB 4: KONTAK & MEDIA SOSIAL --}}
    @if ($tab === 'kontak')
    <div class="settings-card">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
            @csrf
            <input type="hidden" name="_section" value="kontak">

            <div class="section-title">
                <i class="mdi mdi-format-title"></i> Header Halaman Kontak
            </div>
            <p class="section-desc">Judul dan pengantar pada banner halaman kontak.</p>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Judul Kontak <span class="text-danger">*</span></label>
                    <input type="text" name="kontak_title" class="form-control"
                           value="{{ old('kontak_title', $settings['kontak_title'] ?? 'Hubungi MUI Batanghari') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Subtitle Banner</label>
                    <input type="text" name="kontak_subtitle" class="form-control"
                           value="{{ old('kontak_subtitle', $settings['kontak_subtitle'] ?? '') }}">
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-map-marker-radius"></i> Informasi Kontak & Alamat
            </div>
            <p class="section-desc">Alamat kantor fisik, nomor telepon, WhatsApp, dan jam operasional pelayanan.</p>

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Alamat Kantor Lengkap</label>
                    <textarea name="kontak_alamat" rows="2" class="form-control">{{ old('kontak_alamat', $settings['kontak_alamat'] ?? '') }}</textarea>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nomor Telepon Kantor</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                        <input type="text" name="kontak_telepon" class="form-control"
                               value="{{ old('kontak_telepon', $settings['kontak_telepon'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nomor WhatsApp Pelayanan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-whatsapp text-success"></i></span>
                        <input type="text" name="kontak_whatsapp" class="form-control"
                               value="{{ old('kontak_whatsapp', $settings['kontak_whatsapp'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Alamat Email Resmi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                        <input type="email" name="kontak_email" class="form-control"
                               value="{{ old('kontak_email', $settings['kontak_email'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hari & Jam Layanan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                        <input type="text" name="kontak_jam_layanan" class="form-control"
                               value="{{ old('kontak_jam_layanan', $settings['kontak_jam_layanan'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Google Maps Embed Link (URL iframe)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-map"></i></span>
                        <input type="text" name="kontak_maps_embed" class="form-control"
                               value="{{ old('kontak_maps_embed', $settings['kontak_maps_embed'] ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-share-variant"></i> Akun Media Sosial Resmi
            </div>
            <p class="section-desc">Tautan atau username akun media sosial resmi yang tertera di kontak dan footer.</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Instagram</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-instagram text-danger"></i></span>
                        <input type="text" name="kontak_instagram" class="form-control" placeholder="@username"
                               value="{{ old('kontak_instagram', $settings['kontak_instagram'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">YouTube</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-youtube text-danger"></i></span>
                        <input type="text" name="kontak_youtube" class="form-control" placeholder="Nama Channel / Link"
                               value="{{ old('kontak_youtube', $settings['kontak_youtube'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Facebook</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-facebook text-primary"></i></span>
                        <input type="text" name="kontak_facebook" class="form-control" placeholder="Halaman Facebook"
                               value="{{ old('kontak_facebook', $settings['kontak_facebook'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Twitter / X</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-twitter text-info"></i></span>
                        <input type="text" name="kontak_twitter" class="form-control" placeholder="@username"
                               value="{{ old('kontak_twitter', $settings['kontak_twitter'] ?? '') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">TikTok</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="mdi mdi-music-note"></i></span>
                        <input type="text" name="kontak_tiktok" class="form-control" placeholder="@username"
                               value="{{ old('kontak_tiktok', $settings['kontak_tiktok'] ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3">
                <button type="submit" class="btn-save">
                    <i class="mdi mdi-content-save"></i> Simpan Kontak & Medsos
                </button>
            </div>
        </form>
    </div>
    @endif

    {{-- TAB 5: LIVE CHAT & JAM OPERASIONAL --}}
    @if ($tab === 'livechat')
    <div class="settings-card">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST">
            @csrf
            <input type="hidden" name="_section" value="livechat">

            <div class="section-title">
                <i class="mdi mdi-toggle-switch"></i> Status Fitur Live Chat
            </div>
            <p class="section-desc">Aktifkan atau nonaktifkan widget floating live chat di seluruh halaman website publik.</p>

            <div class="form-check form-switch mb-4">
                <input class="form-check-input" type="checkbox" name="chat_is_enabled" id="chat_is_enabled" value="1"
                       {{ old('chat_is_enabled', $settings['chat_is_enabled'] ?? '1') === '1' ? 'checked' : '' }} style="width: 44px; height: 22px;">
                <label class="form-check-label ms-2 fw-bold" for="chat_is_enabled">
                    Aktifkan Fitur Live Chat di Frontend
                </label>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-clock-outline"></i> Jam & Hari Operasional Petugas
            </div>
            <p class="section-desc">Tentukan jam kerja operasional petugas melayani masyarakat. Di luar jam ini, sistem akan otomatis beralih ke Asisten Virtual (Chatbot FAQ 24 Jam).</p>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Jam Mulai Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="chat_operational_start" class="form-control" placeholder="08:00"
                           value="{{ old('chat_operational_start', $settings['chat_operational_start'] ?? '08:00') }}" required>
                    <small class="text-muted">Format 24 jam (WIB), contoh: 08:00</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jam Selesai Layanan <span class="text-danger">*</span></label>
                    <input type="text" name="chat_operational_end" class="form-control" placeholder="16:00"
                           value="{{ old('chat_operational_end', $settings['chat_operational_end'] ?? '16:00') }}" required>
                    <small class="text-muted">Format 24 jam (WIB), contoh: 16:00</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estimasi Waktu Tunggu / Antrian <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" name="chat_avg_wait_minutes" class="form-control" min="1" max="60"
                               value="{{ old('chat_avg_wait_minutes', $settings['chat_avg_wait_minutes'] ?? '4') }}" required>
                        <span class="input-group-text">Menit / Antrian</span>
                    </div>
                    <small class="text-muted">Digunakan untuk menghitung perkiraan waktu tunggu pengunjung.</small>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Hari Operasional Petugas</label>
                    <input type="text" name="chat_operational_days" class="form-control" placeholder="1,2,3,4,5"
                           value="{{ old('chat_operational_days', $settings['chat_operational_days'] ?? '1,2,3,4,5') }}">
                    <small class="text-muted">Keterangan: 1 = Senin, 2 = Selasa, 3 = Rabu, 4 = Kamis, 5 = Jumat, 6 = Sabtu, 7 = Minggu (Pisahkan dengan koma).</small>
                </div>
            </div>

            <div class="form-divider"></div>

            <div class="section-title">
                <i class="mdi mdi-robot"></i> Pesan & Sapaan Chatbot
            </div>
            <p class="section-desc">Kustomisasi teks pembuka dan respon otomatis saat petugas offline / di luar jam kerja.</p>

            <div class="mb-3">
                <label class="form-label">Teks Sapaan Awal (Jam Kerja) <span class="text-danger">*</span></label>
                <textarea name="chat_bot_greeting" rows="2" class="form-control" required>{{ old('chat_bot_greeting', $settings['chat_bot_greeting'] ?? 'Assalamu\'alaikum! Selamat datang di Layanan Bantuan Online MUI Batanghari. Ada yang bisa kami bantu?') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Pesan Otomatis di Luar Jam Operasional <span class="text-danger">*</span></label>
                <textarea name="chat_offline_message" rows="3" class="form-control" required>{{ old('chat_offline_message', $settings['chat_offline_message'] ?? 'Mohon maaf, saat ini kantor MUI Batanghari sedang di luar jam operasional (Jam kerja: Senin - Jumat 08.00 - 16.00 WIB). Silakan pilih pertanyaan umum di bawah ini atau tinggalkan pesan untuk petugas kami.') }}</textarea>
            </div>

            <div class="mt-4 pt-3">
                <button type="submit" class="btn-save">
                    <i class="mdi mdi-content-save"></i> Simpan Pengaturan Live Chat
                </button>
            </div>
        </form>
    </div>
    @endif

</div>
@endsection
