@extends('layouts.frontend')

@section('title', 'Tanya Ulama — Konsultasi Syariah Majelis Ulama Indonesia')
@section('meta_description',
    'Layanan tanya jawab keagamaan dan konsultasi syariah resmi bersama para ulama Majelis
    Ulama Indonesia (MUI).')

@section('content')
    {{-- ── HERO / BANNER ── --}}
    <section class="page-hero">
        <div class="mui-shell">
            <nav class="page-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home me-1"></i>Beranda</a>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span>Layanan</span>
                <span class="sep"><i class="fas fa-chevron-right"></i></span>
                <span class="current">Tanya Ulama</span>
            </nav>
            <h1 class="page-hero-title">Tanya Ulama & Konsultasi Syariah</h1>
            <p class="page-hero-desc">
                Sampaikan pertanyaan dan kegelisahan keagamaan Anda. Tim Ulama dan Asatidz Majelis Ulama Indonesia siap
                memberikan bimbingan dan fatwa syariah yang menentramkan.
            </p>
        </div>
    </section>

    {{-- ── MAIN CONTENT ── --}}
    <div class="page-content-wrapper">
        <div class="mui-shell">

            {{-- Alert Notifikasi Sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4 p-3 d-flex align-items-center gap-3"
                    role="alert" style="border-radius: var(--radius); border-left: 5px solid var(--green);">
                    <div class="icon-circle" style="background: var(--green); color: #fff; width: 36px; height: 36px;">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <strong class="d-block text-success" style="font-size: 15px;">Pengiriman Berhasil!</strong>
                        <span style="font-size: 13.5px; color: var(--text);">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Alert Notifikasi Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4 p-3" role="alert"
                    style="border-radius: var(--radius); border-left: 5px solid #dc3545;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        <strong class="text-danger">Mohon periksa kembali formulir Anda:</strong>
                    </div>
                    <ul class="mb-0 ps-3 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                {{-- ════ KIRI: FORMULIR KONSULTASI ════ --}}
                <div class="col-lg-8">
                    <div class="mui-card">
                        <h2 class="mui-card-title">
                            <i class="fas fa-comments text-success"></i>
                            Formulir Tanya Ulama
                        </h2>
                        <p class="text-muted small mb-4" style="line-height: 1.6;">
                            Silakan lengkapi data diri dan pertanyaan Anda di bawah ini dengan jelas dan santun. Pertanyaan
                            Anda akan dijawab oleh para ulama dan dewan pakar MUI.
                        </p>

                        <form action="{{ route('tanya-ulama.store') }}" method="POST" id="formTanyaUlama">
                            @csrf

                            {{-- Baris 1: Nama & Email --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label small fw-bold text-dark">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Masukkan nama lengkap Anda" required
                                        style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label small fw-bold text-dark">
                                        Alamat Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="contoh@email.com" required
                                        style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                    <small class="text-muted" style="font-size: 11px;">Notifikasi jawaban akan dikirimkan ke
                                        email ini.</small>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 2: Usia & Jenis Kelamin --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="usia" class="form-label small fw-bold text-dark">
                                        Usia (Tahun) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control @error('usia') is-invalid @enderror"
                                        id="usia" name="usia" value="{{ old('usia') }}" min="5"
                                        max="120" placeholder="Contoh: 30" required
                                        style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                    @error('usia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label small fw-bold text-dark">
                                        Jenis Kelamin <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control form-select @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" required
                                        style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                        <option value="">Pilih Jenis Kelamin...</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 3: Provinsi/Kab. Kota & Kategori Pertanyaan --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="kab_kota" class="form-label small fw-bold text-dark">
                                        Provinsi / Kab. Kota <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('kab_kota') is-invalid @enderror"
                                        id="kab_kota" name="kab_kota" value="{{ old('kab_kota') }}"
                                        placeholder="Contoh: DKI Jakarta / Surabaya" required
                                        style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                    @error('kab_kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="kategori" class="form-label small fw-bold text-dark">
                                        Kategori Pertanyaan <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control form-select @error('kategori') is-invalid @enderror"
                                        id="kategori" name="kategori" required
                                        style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 10px 14px;">
                                        <option value="">Pilih Kategori...</option>
                                        @foreach ($kategoriList as $kat)
                                            <option value="{{ $kat }}"
                                                {{ old('kategori') === $kat ? 'selected' : '' }}>
                                                {{ $kat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Baris 4: Isi Pertanyaan --}}
                            <div class="mb-4">
                                <label for="pertanyaan" class="form-label small fw-bold text-dark">
                                    Isi Pertanyaan & Kasus <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan"
                                    rows="6"
                                    placeholder="Tuliskan secara lengkap detail persoalan atau pertanyaan keagamaan yang ingin Anda konsultasikan..."
                                    required style="border-radius: var(--radius-sm); font-size: 13.5px; padding: 12px 14px; line-height: 1.6;">{{ old('pertanyaan') }}</textarea>
                                <small class="text-muted" style="font-size: 11px;">Jelaskan kronologi dan konteks masalah
                                    secara rinci agar memudahkan kajian fatwa.</small>
                                @error('pertanyaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex align-items-center justify-content-end gap-3 pt-3 border-top">
                                <button type="reset" class="btn btn-light px-4 py-2"
                                    style="font-size: 13.5px; font-weight: 600; border-radius: var(--radius-sm); border: 1px solid var(--border);">
                                    Reset
                                </button>
                                <button type="submit"
                                    class="btn text-white px-4 py-2 fw-bold d-inline-flex align-items-center gap-2"
                                    style="background: var(--green); border-radius: var(--radius-sm); font-size: 14px;">
                                    <i class="fas fa-paper-plane"></i> Kirim Pertanyaan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Tanya Jawab / Konsultasi Terpilih (Jika Ada) --}}
                    @if (isset($konsultasiTerjawab) && $konsultasiTerjawab->isNotEmpty())
                        <div class="mui-card mt-4">
                            <h2 class="mui-card-title">
                                <i class="fas fa-book-reader text-success"></i>
                                Tanya Jawab Terjawab Terbaru
                            </h2>
                            <p class="text-muted small mb-3">Berikut adalah beberapa pertanyaan jamaah yang telah dijawab
                                oleh Dewan Ulama MUI:</p>
                            <div class="d-flex flex-column gap-3">
                                @foreach ($konsultasiTerjawab as $item)
                                    <div
                                        style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 18px;">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="badge"
                                                style="background: var(--green); color: #fff; font-size: 10.5px;">{{ $item->kategori }}</span>
                                            <span class="text-muted small" style="font-size: 11px;"><i
                                                    class="fas fa-clock me-1"></i>{{ $item->answered_at?->diffForHumans() }}</span>
                                        </div>
                                        <h5
                                            style="font-size: 15px; font-weight: 700; color: var(--green-dark); margin-bottom: 6px;">
                                            T: {{ Str::limit($item->pertanyaan, 110) }}
                                        </h5>
                                        <div class="p-3 bg-white rounded mt-2"
                                            style="border-left: 3px solid var(--gold); font-size: 13.5px; color: var(--text); line-height: 1.6;">
                                            <strong>Jawab:</strong> {{ Str::limit(strip_tags($item->jawaban), 220) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- ════ KANAN: SIDEBAR INFORMASI & ALUR ════ --}}
                <div class="col-lg-4">
                    {{-- Alur Konsultasi --}}
                    <div class="mui-card" style="padding: 22px;">
                        <h3
                            style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 16px; border-bottom: 2px solid var(--green-pale); padding-bottom: 8px;">
                            <i class="fas fa-route text-success me-2"></i> Alur Layanan Konsultasi
                        </h3>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex gap-3 align-items-start">
                                <div class="icon-circle"
                                    style="width: 32px; height: 32px; font-size: 13px; font-weight: 800;">1</div>
                                <div>
                                    <strong style="font-size: 13.5px; color: var(--dark); display: block;">Kirim
                                        Pertanyaan</strong>
                                    <span class="text-muted small">Isi formulir dengan data yang valid dan uraian persoalan
                                        yang jelas.</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3 align-items-start">
                                <div class="icon-circle"
                                    style="width: 32px; height: 32px; font-size: 13px; font-weight: 800;">2</div>
                                <div>
                                    <strong style="font-size: 13.5px; color: var(--dark); display: block;">Telaah
                                        Syariah</strong>
                                    <span class="text-muted small">Tim Asatidz dan Dewan Fatwa MUI mengkaji rujukan dalil
                                        Al-Qur'an, Hadits, dan kitab mu'tabarah.</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3 align-items-start">
                                <div class="icon-circle"
                                    style="width: 32px; height: 32px; font-size: 13px; font-weight: 800;">3</div>
                                <div>
                                    <strong style="font-size: 13.5px; color: var(--dark); display: block;">Penerbitan
                                        Jawaban</strong>
                                    <span class="text-muted small">Jawaban dikirimkan via email serta dipublikasikan untuk
                                        kemaslahatan umat luas.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Etika Bertanya --}}
                    <div class="mui-card"
                        style="padding: 22px; background: linear-gradient(180deg, #fff 0%, var(--bg) 100%);">
                        <h3
                            style="font-size: 16px; font-weight: 700; color: var(--green-dark); margin-bottom: 14px; border-bottom: 1.5px solid var(--border); padding-bottom: 8px;">
                            <i class="fas fa-shield-alt text-gold me-2"></i> Ketentuan & Etika
                        </h3>
                        <ul class="text-muted small ps-3 mb-0" style="line-height: 1.8;">
                            <li>Gunakan bahasa yang santun, jelas, dan tidak menyinggung SARA.</li>
                            <li>Tidak mengajukan pertanyaan yang bersifat fitnah atau menjatuhkan pihak tertentu.</li>
                            <li>Fokus pada permasalahan ibadah, muamalah, akidah, dan akhlak.</li>
                            <li>Kerahasiaan identitas penanya akan tetap terjaga.</li>
                        </ul>
                    </div>

                    {{-- Hotline Konsultasi --}}
                    <div class="mui-card"
                        style="background: linear-gradient(135deg, var(--green-dark), var(--green)); color: #fff; border: none; padding: 22px;">
                        <div class="icon-circle mb-3"
                            style="background: rgba(255,255,255,.15); color: var(--gold-light);">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4 style="font-size: 16px; font-weight: 800; color: #fff; margin-bottom: 8px;">Hotline Pelayanan
                        </h4>
                        <p style="font-size: 12.5px; color: rgba(255,255,255,.8); line-height: 1.6; margin-bottom: 14px;">
                            Untuk permohonan bimbingan mendesak atau informasi sertifikasi halal dan fatwa khusus, hubungi
                            sekretariat MUI:
                        </p>
                        <div class="d-flex flex-column gap-2 mb-3 font-monospace" style="font-size: 13px;">
                            <div><i class="fas fa-phone-alt me-2 text-warning"></i> (021) 3917732</div>
                            <div><i class="fab fa-whatsapp me-2 text-success"></i> +62 811-1902-666</div>
                            <div><i class="fas fa-envelope me-2 text-info"></i> tanya@mui.or.id</div>
                        </div>
                        <a href="{{ route('kontak') }}" class="btn btn-sm btn-light fw-bold text-dark w-100"
                            style="border-radius: 20px;">
                            Lihat Kontak Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
