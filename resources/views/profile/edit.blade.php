@extends('layouts.master')

@section('title', 'Edit Profil Akun')

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
    .profile-header {
        background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 60%, var(--green-light) 100%);
        border-radius: var(--radius);
        padding: 26px 30px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        box-shadow: 0 6px 20px rgba(0,127,95,.18);
        color: #fff;
    }

    .profile-header-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .profile-header-icon {
        width: 48px;
        height: 48px;
        background: rgba(255, 255, 255, .15);
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .profile-header h4 {
        font-size: 20px;
        font-weight: 800;
        margin: 0;
        color: #fff;
    }

    .profile-header p {
        margin: 4px 0 0;
        font-size: 13px;
        color: rgba(255, 255, 255, .85);
    }

    /* CARD STYLES */
    .profile-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid #eef2f0;
        padding: 24px;
        margin-bottom: 24px;
    }

    .profile-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 16px;
        margin-bottom: 20px;
        border-bottom: 1px solid #eef2f0;
    }

    .profile-card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--green-dark);
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    /* AVATAR BOX */
    .avatar-preview-box {
        position: relative;
        width: 140px;
        height: 140px;
        margin: 0 auto 16px;
    }

    .avatar-img-circle {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 4px 18px rgba(0, 127, 95, 0.2);
        border: 4px solid #ffffff;
        outline: 2px solid var(--green);
    }

    .avatar-default-circle {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold) 0%, #f0d080 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 54px;
        font-weight: 800;
        color: var(--green-dark);
        box-shadow: 0 4px 18px rgba(0, 127, 95, 0.2);
        border: 4px solid #ffffff;
        outline: 2px solid var(--gold);
    }

    .btn-avatar-picker {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--green-pale);
        color: var(--green-dark);
        border: 1px solid #cce8de;
        border-radius: var(--radius-sm);
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all var(--tr);
    }

    .btn-avatar-picker:hover {
        background: var(--green);
        color: #fff;
    }

    .badge-role {
        display: inline-block;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        border-radius: 20px;
        background: #e8f5f1;
        color: var(--green-dark);
        border: 1px solid #b6e2d3;
    }

    /* FORM STYLES */
    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: var(--radius-sm);
        border: 1px solid #d1d5db;
        padding: 9px 13px;
        font-size: 13.5px;
        transition: all var(--tr);
    }

    .form-control:focus {
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(0, 127, 95, 0.15);
    }

    .invalid-feedback {
        font-size: 12px;
        color: var(--red);
        display: block;
        margin-top: 4px;
    }

    /* ACTION BUTTONS */
    .btn-save-profile {
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        color: #fff;
        border: none;
        border-radius: var(--radius-sm);
        padding: 11px 24px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all var(--tr);
        box-shadow: 0 4px 12px rgba(0, 127, 95, 0.25);
    }

    .btn-save-profile:hover {
        opacity: 0.94;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(0, 127, 95, 0.35);
        color: #fff;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    {{-- Page Header --}}
    <div class="profile-header">
        <div class="profile-header-title">
            <div class="profile-header-icon">
                <i class="mdi mdi-account-cog"></i>
            </div>
            <div>
                <h4>Pengaturan Profil Akun</h4>
                <p>Kelola data diri, perbarui foto profil, dan ubah kata sandi akun Anda.</p>
            </div>
        </div>
        <div>
            <span class="badge-role">
                <i class="mdi mdi-shield-account mr-1"></i> Peran: {{ ucfirst(auth()->user()->role) }}
            </span>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: var(--radius-sm);">
            <strong><i class="mdi mdi-alert-circle mr-1"></i> Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            {{-- KOLOM KIRI: Foto & Ringkasan Akun --}}
            <div class="col-lg-4 col-md-5">
                <div class="profile-card text-center">
                    <div class="profile-card-header">
                        <h5 class="profile-card-title">
                            <i class="mdi mdi-camera-account"></i> Foto Profil
                        </h5>
                    </div>

                    <div class="avatar-preview-box">
                        <img id="avatar-preview-img"
                             src="{{ $user->foto_url ?? '#' }}"
                             alt="{{ $user->name }}"
                             class="avatar-img-circle {{ $user->foto_url ? '' : 'd-none' }}">

                        <div id="avatar-fallback-box" class="avatar-default-circle {{ $user->foto_url ? 'd-none' : '' }}">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    <h5 class="font-weight-bold mb-1" style="color: var(--text);">{{ $user->name_gelar ?? $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ '@' . $user->username }} &bull; {{ $user->email }}</p>

                    <div class="mb-3">
                        <label for="foto-input" class="btn-avatar-picker">
                            <i class="mdi mdi-upload"></i> Pilih Foto Baru
                        </label>
                        <input type="file"
                               id="foto-input"
                               name="foto"
                               accept="image/png, image/jpeg, image/jpg, image/webp"
                               class="d-none">

                        @if($user->foto)
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="hapus_foto" name="hapus_foto" value="1">
                                <label class="custom-control-label text-danger small" for="hapus_foto">
                                    <i class="mdi mdi-delete-outline"></i> Hapus foto profil saat ini
                                </label>
                            </div>
                        @endif
                    </div>

                    <div class="p-2 rounded bg-light text-muted small text-left" style="font-size: 11.5px; border: 1px dashed #d1d5db;">
                        <i class="mdi mdi-information-outline text-primary"></i> <strong>Ketentuan Foto:</strong><br>
                        - Format: JPG, JPEG, PNG, WEBP<br>
                        - Ukuran maksimal: 2 MB<br>
                        - Jika tidak ada foto, avatar inisial nama akan otomatis digunakan.
                    </div>
                </div>

                {{-- Detail Login Singkat --}}
                <div class="profile-card">
                    <div class="profile-card-header">
                        <h5 class="profile-card-title">
                            <i class="mdi mdi-shield-check"></i> Status Akun
                        </h5>
                    </div>
                    <ul class="list-unstyled mb-0" style="font-size: 13px;">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">ID Pengguna</span>
                            <span class="font-weight-bold">#{{ $user->id }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Hak Akses</span>
                            <span class="font-weight-bold text-success">{{ ucfirst($user->role) }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Terdaftar Sejak</span>
                            <span>{{ $user->created_at ? $user->created_at->translatedFormat('d M Y') : '-' }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2">
                            <span class="text-muted">Terakhir Diperbarui</span>
                            <span>{{ $user->updated_at ? $user->updated_at->diffForHumans() : '-' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- KOLOM KANAN: Form Edit Profil & Ganti Password --}}
            <div class="col-lg-8 col-md-7">
                {{-- Data Diri & Kontak --}}
                <div class="profile-card">
                    <div class="profile-card-header">
                        <h5 class="profile-card-title">
                            <i class="mdi mdi-account-edit"></i> Data Pribadi & Kontak
                        </h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Contoh: Ahmad Fauzi"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="name_gelar">Nama beserta Gelar</label>
                            <input type="text"
                                   class="form-control @error('name_gelar') is-invalid @enderror"
                                   id="name_gelar"
                                   name="name_gelar"
                                   value="{{ old('name_gelar', $user->name_gelar) }}"
                                   placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Ag">
                            @error('name_gelar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="username" class="d-flex align-items-center justify-content-between">
                                <span>Username Login</span>
                                <span class="badge badge-secondary" style="font-size: 10px; font-weight: 600;"><i class="mdi mdi-lock mr-1"></i>Tidak dapat diubah</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light text-muted" style="border-radius: var(--radius-sm) 0 0 var(--radius-sm);"><i class="mdi mdi-account-lock"></i></span>
                                </div>
                                <input type="text"
                                       class="form-control bg-light"
                                       id="username"
                                       value="{{ $user->username }}"
                                       readonly
                                       tabindex="-1"
                                       style="cursor: not-allowed; background-color: #f3f4f6 !important; color: #4b5563; font-weight: 600; border-radius: 0 var(--radius-sm) var(--radius-sm) 0;">
                            </div>
                            <small class="form-text text-muted" style="font-size: 11.5px;">
                                <i class="mdi mdi-information-outline text-muted"></i> Username bersifat unik dan permanen untuk keperluan otentikasi login.
                            </small>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="email">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="nohp">No. Telepon / WhatsApp</label>
                            <input type="text"
                                   class="form-control @error('nohp') is-invalid @enderror"
                                   id="nohp"
                                   name="nohp"
                                   value="{{ old('nohp', $user->nohp) }}"
                                   placeholder="Contoh: 081234567890">
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-control @error('jk') is-invalid @enderror" id="jk" name="jk">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jk', $user->jk) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk', $user->jk) === 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                      id="alamat"
                                      name="alamat"
                                      rows="3"
                                      placeholder="Alamat domisili atau kantor">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Keamanan & Ganti Password --}}
                <div class="profile-card" id="password-section">
                    <div class="profile-card-header">
                        <h5 class="profile-card-title">
                            <i class="mdi mdi-lock-outline"></i> Keamanan Akun (Ganti Password)
                        </h5>
                    </div>

                    <div class="alert alert-info py-2 px-3 small mb-3" style="border-radius: var(--radius-sm);">
                        <i class="mdi mdi-information mr-1"></i> Biarkan formulir ini kosong jika Anda tidak ingin mengganti kata sandi.
                    </div>

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="password_current">Password Saat Ini</label>
                            <input type="password"
                                   class="form-control @error('password_current') is-invalid @enderror"
                                   id="password_current"
                                   name="password_current"
                                   placeholder="Masukkan password saat ini untuk verifikasi">
                            @error('password_current')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="password">Password Baru</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="Minimal 8 karakter">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="text-right mb-4">
                    <button type="submit" class="btn-save-profile">
                        <i class="mdi mdi-content-save-check"></i> Simpan Perubahan Profil
                    </button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fotoInput = document.getElementById('foto-input');
    const previewImg = document.getElementById('avatar-preview-img');
    const fallbackBox = document.getElementById('avatar-fallback-box');
    const hapusFotoCheckbox = document.getElementById('hapus_foto');

    if (fotoInput) {
        fotoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    previewImg.src = event.target.result;
                    previewImg.classList.remove('d-none');
                    if (fallbackBox) {
                        fallbackBox.classList.add('d-none');
                    }
                    if (hapusFotoCheckbox) {
                        hapusFotoCheckbox.checked = false;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (hapusFotoCheckbox) {
        hapusFotoCheckbox.addEventListener('change', function () {
            if (this.checked) {
                previewImg.classList.add('d-none');
                if (fallbackBox) {
                    fallbackBox.classList.remove('d-none');
                }
                if (fotoInput) {
                    fotoInput.value = '';
                }
            } else {
                @if($user->foto_url)
                    previewImg.classList.remove('d-none');
                    if (fallbackBox) {
                        fallbackBox.classList.add('d-none');
                    }
                @endif
            }
        });
    }
});
</script>
@endsection
