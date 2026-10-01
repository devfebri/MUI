@extends('layouts.master')

@section('css')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
    :root {
        --green:      #007f5f;
        --green-dark: #005f47;
        --green-light:#00a878;
        --green-pale: #e8f5f1;
        --gold:       #c9a84c;
        --red:        #ef4444;
        --text:       #1a1a2e;
        --gray:       #6b7280;
        --border:     #e5e7eb;
        --bg:         #f4f7f6;
        --white:      #ffffff;
        --radius:     12px;
        --shadow:     0 2px 16px rgba(0,0,0,.07);
    }

    body { background: var(--bg) !important; }

    .editor-topbar {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 12px 28px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 12px; flex-wrap: wrap;
        position: sticky; top: 0; z-index: 100;
        box-shadow: var(--shadow);
    }

    .editor-topbar-left { display: flex; align-items: center; gap: 10px; }
    .editor-topbar h5 { margin: 0; font-size: 15px; font-weight: 800; color: var(--text); }
    .editor-topbar h5 span { font-size: 12px; color: var(--gray); font-weight: 500; margin-left: 8px; }

    .editor-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 24px;
        padding: 24px 28px;
        max-width: 1400px;
    }

    .editor-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .editor-card-head {
        padding: 14px 20px;
        border-bottom: 1px solid #f0f4f3;
        font-size: 13px; font-weight: 700; color: var(--text);
        display: flex; align-items: center; gap: 8px;
        background: #fafcfb;
    }

    .editor-card-head i { color: var(--green); font-size: 16px; }
    .editor-card-body { padding: 20px; }

    .title-input {
        width: 100%;
        border: none; outline: none;
        font-size: 26px; font-weight: 800; color: var(--text);
        line-height: 1.3; padding: 0; background: transparent;
        font-family: inherit; resize: none; overflow: hidden;
    }

    .title-input::placeholder { color: #d1d5db; }

    .title-separator {
        height: 2px;
        background: linear-gradient(90deg, var(--green), var(--green-pale), transparent);
        margin: 14px 0; border-radius: 2px;
    }

    #quill-editor {
        min-height: 400px;
        font-size: 15px; line-height: 1.8; color: var(--text);
    }

    .ql-toolbar  { border: none !important; border-bottom: 1px solid var(--border) !important; background: #fafcfb; padding: 10px !important; }
    .ql-container { border: none !important; font-family: inherit !important; }
    .ql-editor { padding: 20px !important; }
    .ql-editor.ql-blank::before { color: #d1d5db; font-style: normal; font-size: 15px; }

    .form-group { margin-bottom: 16px; }
    .form-group label {
        display: block; font-size: 12px; font-weight: 700; color: var(--gray);
        text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 7px;
    }

    .form-control {
        border-radius: 8px; border: 1.5px solid var(--border);
        padding: 9px 12px; font-size: 13.5px; color: var(--text); width: 100%;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-control:focus {
        border-color: var(--green); box-shadow: 0 0 0 3px rgba(0,127,95,.1); outline: none;
    }

    .status-pills { display: flex; gap: 6px; flex-wrap: wrap; }

    .status-pill {
        flex: 1; min-width: 70px; text-align: center;
        padding: 8px 10px; border-radius: 8px;
        border: 2px solid var(--border);
        font-size: 12px; font-weight: 700;
        cursor: pointer; transition: all .2s;
        background: var(--white); color: var(--gray); user-select: none;
    }

    .status-pill.checked {
        border-color: var(--green);
        background: var(--green-pale);
        color: var(--green);
    }

    .status-pill input[type="radio"] { display: none; }

    .img-upload-area {
        border: 2px dashed var(--border); border-radius: 10px;
        padding: 24px 16px; text-align: center; cursor: pointer;
        transition: all .2s; position: relative; background: #fafcfb;
    }

    .img-upload-area:hover, .img-upload-area.dragover {
        border-color: var(--green); background: var(--green-pale);
    }

    .img-upload-area i { font-size: 32px; color: var(--green); display: block; margin-bottom: 8px; }
    .img-upload-area p { font-size: 13px; color: var(--gray); margin: 0; line-height: 1.5; }
    .img-upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

    .img-current {
        width: 100%; border-radius: 8px; margin-bottom: 12px; position: relative;
    }

    .img-current img {
        width: 100%; height: 180px; object-fit: cover; border-radius: 8px; display: block;
    }

    .img-current-actions {
        display: flex; gap: 8px; margin-top: 8px; align-items: center;
    }

    .img-preview {
        width: 100%; border-radius: 8px; margin-top: 12px; display: none; position: relative;
    }

    .img-preview img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; display: block; }

    .img-preview-remove {
        position: absolute; top: 6px; right: 6px;
        background: rgba(239,68,68,.9); color: #fff; border: none;
        border-radius: 6px; padding: 4px 8px; font-size: 12px; cursor: pointer;
    }

    .char-meta {
        display: flex; justify-content: space-between; align-items: center;
        margin-top: 5px; font-size: 11.5px; color: var(--gray);
    }

    .btn-publish {
        background: linear-gradient(135deg, var(--green), var(--green-light));
        color: #fff; border: none; padding: 10px 22px; border-radius: 8px;
        font-size: 13.5px; font-weight: 700; cursor: pointer;
        display: inline-flex; align-items: center; gap: 7px;
        transition: all .2s; box-shadow: 0 4px 14px rgba(0,127,95,.3);
    }

    .btn-publish:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,127,95,.4); }

    .btn-draft {
        background: var(--white); color: var(--text);
        border: 1.5px solid var(--border); padding: 10px 20px;
        border-radius: 8px; font-size: 13.5px; font-weight: 600;
        cursor: pointer; display: inline-flex; align-items: center; gap: 7px;
        transition: all .2s;
    }

    .btn-draft:hover { border-color: var(--green); color: var(--green); }

    .alert-success-bar {
        background: var(--green-pale); border-left: 4px solid var(--green);
        padding: 12px 20px; border-radius: 8px; font-size: 13.5px; color: var(--green-dark);
        display: flex; align-items: center; gap: 10px; margin: 0 28px 20px;
    }

    .validation-errors {
        background: #fef2f2; border-left: 4px solid var(--red);
        padding: 14px 20px; border-radius: 8px; font-size: 13px; color: #b91c1c;
        margin: 0 28px 20px;
    }

    .validation-errors ul { margin: 4px 0 0 16px; padding: 0; }

    @media (max-width: 991px) { .editor-layout { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')

{{-- TOPBAR --}}
<div class="editor-topbar">
    <div class="editor-topbar-left">
        <a href="{{ route(auth()->user()->role . '.berita.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="mdi mdi-arrow-left"></i>
        </a>
        <h5>Edit Berita <span class="text-truncate" style="max-width:300px;">{{ $berita->judul }}</span></h5>
    </div>
    <div class="d-flex align-items-center" style="gap:8px;">
        <button type="button" class="btn-draft" id="btn-save-draft" onclick="submitForm('draft')">
            <i class="mdi mdi-content-save-outline"></i> Simpan Draft
        </button>
        <button type="button" class="btn-publish" id="btn-publish" onclick="submitForm()">
            <i class="mdi mdi-send" id="btn-publish-icon"></i> <span id="btn-publish-text">Perbarui & Publish</span>
        </button>
    </div>
</div>

{{-- ERRORS --}}
@if($errors->any())
<div class="validation-errors">
    <strong>Terdapat kesalahan:</strong>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert-success-bar">
    <i class="mdi mdi-check-circle"></i> {{ session('success') }}
</div>
@endif

{{-- FORM --}}
<form id="berita-form"
    action="{{ route(auth()->user()->role . '.berita.update', $berita) }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" id="hidden-isi" name="isi">
    <input type="hidden" name="hapus_gambar" id="hapus_gambar" value="0">

    <div class="editor-layout">

        {{-- ── KIRI: Konten ── --}}
        <div>
            <div class="editor-card">
                <div class="editor-card-body" style="padding:24px 28px;">
                    <textarea
                        class="title-input"
                        name="judul"
                        rows="2"
                        placeholder="Tulis judul berita di sini..."
                        maxlength="255"
                        id="judul-input"
                        required
                    >{{ old('judul', $berita->judul) }}</textarea>
                    <div class="title-separator"></div>
                    <div class="char-meta">
                        <span style="color:var(--gray);font-size:12px;">
                            <i class="mdi mdi-format-title" style="color:var(--green);"></i>
                            Judul artikel
                        </span>
                        <span><span id="judul-count">{{ strlen(old('judul', $berita->judul)) }}</span>/255</span>
                    </div>
                </div>
            </div>

            <div class="editor-card">
                <div class="editor-card-head">
                    <i class="mdi mdi-file-document-edit"></i> Isi Berita
                </div>
                <div id="quill-editor"></div>
            </div>
        </div>

        {{-- ── KANAN: Sidebar ── --}}
        <aside>

            {{-- Status --}}
            <div class="editor-card">
                <div class="editor-card-head">
                    <i class="mdi mdi-publish"></i> Status Publikasi
                </div>
                <div class="editor-card-body">
                    <div class="status-pills">
                        @foreach(['draft' => ['mdi-pencil-box','Draft'], 'published' => ['mdi-check-circle','Publish'], 'archived' => ['mdi-archive','Arsip']] as $val => $info)
                        <label class="status-pill {{ old('status',$berita->status) === $val ? 'checked' : '' }}"
                               id="pill-{{ $val }}">
                            <input type="radio" name="status" value="{{ $val }}"
                                {{ old('status',$berita->status) === $val ? 'checked' : '' }}>
                            <i class="mdi {{ $info[0] }}"></i><br>{{ $info[1] }}
                        </label>
                        @endforeach
                    </div>

                    <div class="form-group mt-3" id="published-at-wrap"
                         style="{{ old('status',$berita->status) === 'published' ? '' : 'display:none;' }}">
                        <label>Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                            value="{{ old('published_at', $berita->published_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>
            </div>

            {{-- Kategori --}}
            <div class="editor-card">
                <div class="editor-card-head d-flex justify-content-between align-items-center">
                    <div><i class="mdi mdi-tag"></i> Kategori</div>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.kategori.index') }}" target="_blank" style="font-size:11.5px;font-weight:600;color:var(--green);text-decoration:none;">
                            <i class="mdi mdi-plus-circle-outline"></i> Kelola Kategori
                        </a>
                    @endif
                </div>
                <div class="editor-card-body">
                    <div class="form-group" style="margin:0;">
                        <select name="kategori" class="form-control" required>
                            <option value="">— Pilih Kategori —</option>
                            @foreach($kategoriList as $kat)
                                @php
                                    $val = is_object($kat) ? $kat->nama : $kat;
                                @endphp
                                <option value="{{ $val }}"
                                    {{ old('kategori', $berita->kategori) === $val ? 'selected' : '' }}>
                                    {{ $val }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Gambar --}}
            <div class="editor-card">
                <div class="editor-card-head">
                    <i class="mdi mdi-image"></i> Gambar Utama (Thumbnail)
                </div>
                <div class="editor-card-body">

                    {{-- Gambar yang sudah ada --}}
                    @if($berita->gambar)
                    <div class="img-current" id="current-img-wrap">
                        <img src="{{ asset('uploads/berita/' . basename($berita->gambar)) }}" alt="Gambar saat ini">
                        <div class="img-current-actions">
                            <span style="font-size:12px;color:var(--gray);flex:1;">Gambar saat ini</span>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="btn-remove-current">
                                <i class="mdi mdi-delete"></i> Hapus Gambar
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Upload baru --}}
                    <div class="img-upload-area" id="img-upload-area"
                         style="{{ $berita->gambar ? 'display:none;' : '' }}">
                        <input type="file" name="gambar" id="gambar-input"
                            accept="image/jpeg,image/png,image/jpg,image/webp">
                        <i class="mdi mdi-cloud-upload-outline"></i>
                        <p><strong>Klik atau seret gambar ke sini</strong><br>
                            JPEG, PNG, WEBP · Maks 2 MB</p>
                    </div>

                    {{-- Ganti gambar --}}
                    @if($berita->gambar)
                    <div style="margin-top:10px;" id="change-img-wrap">
                        <button type="button" class="btn btn-sm btn-outline-secondary w-100" id="btn-change-img">
                            <i class="mdi mdi-swap-horizontal"></i> Ganti Gambar
                        </button>
                    </div>
                    @endif

                    <div class="img-preview" id="img-preview">
                        <img src="" alt="Preview" id="img-preview-img">
                        <button type="button" class="img-preview-remove" id="img-remove-btn">
                            <i class="mdi mdi-close"></i> Batal
                        </button>
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="editor-card">
                <div class="editor-card-head">
                    <i class="mdi mdi-information-outline"></i> Informasi
                </div>
                <div class="editor-card-body" style="font-size:13px;color:var(--gray);padding-top:14px;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="mdi mdi-account mr-2" style="color:var(--green);"></i>
                        Penulis: <strong class="ml-1">{{ $berita->penulis?->name ?? auth()->user()->name }}</strong>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="mdi mdi-calendar-plus mr-2" style="color:var(--green);"></i>
                        Dibuat: <strong class="ml-1">{{ $berita->created_at->translatedFormat('d M Y') }}</strong>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="mdi mdi-calendar-edit mr-2" style="color:var(--green);"></i>
                        Diperbarui: <strong class="ml-1">{{ $berita->updated_at->translatedFormat('d M Y') }}</strong>
                    </div>
                </div>
            </div>

        </aside>
    </div>
</form>
@endsection

@section('javascript')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
$(function() {
    /* ── QUILL ── */
    var quill = new Quill('#quill-editor', {
        theme      : 'snow',
        placeholder: 'Tulis isi berita di sini...',
        modules    : {
            toolbar: [
                [{ header: [1,2,3,4,false] }],
                ['bold','italic','underline','strike'],
                [{ color:[] },{ background:[] }],
                [{ list:'ordered' },{ list:'bullet' }],
                [{ indent:'-1' },{ indent:'+1' }],
                [{ align:[] }],
                ['blockquote','code-block'],
                ['link','image'],
                ['clean']
            ]
        }
    });

    /* Pre-fill isi */
    var beritaIsi = @json(old('isi', $berita->isi));
    if (beritaIsi) {
        quill.clipboard.dangerouslyPasteHTML(beritaIsi);
    }

    /* ── CHAR COUNTER ── */
    var $judul = $('#judul-input');
    $judul.on('input', function() {
        $('#judul-count').text($(this).val().length);
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    }).trigger('input');

    /* ── STATUS PILLS & UI SYNC ── */
    function syncStatusUI() {
        var $checked = $('input[name="status"]:checked');
        var val = $checked.val() || '{{ $berita->status }}';

        $('.status-pill').removeClass('checked');
        $checked.closest('.status-pill').addClass('checked');
        $('#published-at-wrap').toggle(val === 'published');

        if (val === 'draft') {
            $('#btn-publish-icon').attr('class', 'mdi mdi-content-save-outline');
            $('#btn-publish-text').text('Simpan Perubahan (Draft)');
            $('#btn-save-draft').hide();
        } else if (val === 'published') {
            $('#btn-publish-icon').attr('class', 'mdi mdi-send');
            $('#btn-publish-text').text('Perbarui & Publish');
            $('#btn-save-draft').show();
        } else if (val === 'archived') {
            $('#btn-publish-icon').attr('class', 'mdi mdi-archive');
            $('#btn-publish-text').text('Simpan ke Arsip');
            $('#btn-save-draft').show();
        }
    }

    $('input[name="status"]').on('change', syncStatusUI);
    syncStatusUI();

    /* ── GANTI GAMBAR ── */
    $('#btn-change-img').on('click', function() {
        $('#img-upload-area').show();
        $(this).hide();
    });

    /* ── HAPUS GAMBAR SAAT INI ── */
    $('#btn-remove-current').on('click', function() {
        $('#hapus_gambar').val('1');
        $('#current-img-wrap').hide();
        $('#change-img-wrap').hide();
        $('#img-upload-area').show();
    });

    /* ── PREVIEW GAMBAR BARU ── */
    $('#gambar-input').on('change', function() {
        var file = this.files[0];
        if (!file) return;

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 2 MB.');
            this.value = '';
            return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img-preview-img').attr('src', e.target.result);
            $('#img-preview').show();
            $('#img-upload-area').hide();
        };
        reader.readAsDataURL(file);
    });

    $('#img-remove-btn').on('click', function() {
        $('#gambar-input').val('');
        $('#img-preview').hide();
        $('#img-upload-area').show();
    });

    /* ── DRAG & DROP ── */
    var area = document.getElementById('img-upload-area');
    if (area) {
        area.addEventListener('dragover', function(e) { e.preventDefault(); this.classList.add('dragover'); });
        area.addEventListener('dragleave', function() { this.classList.remove('dragover'); });
        area.addEventListener('drop', function(e) {
            e.preventDefault(); this.classList.remove('dragover');
            var file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                var input = document.getElementById('gambar-input');
                var dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                $(input).trigger('change');
            }
        });
    }
});

/* ── SUBMIT ── */
function submitForm(overrideStatus) {
    if (overrideStatus) {
        $('input[name="status"][value="' + overrideStatus + '"]').prop('checked', true).trigger('change');
    }

    var judul = document.getElementById('judul-input').value.trim();
    if (!judul) {
        alert('Judul berita wajib diisi.');
        document.getElementById('judul-input').focus();
        return;
    }

    var kategori = document.querySelector('select[name="kategori"]').value;
    if (!kategori) {
        alert('Kategori berita wajib dipilih.');
        document.querySelector('select[name="kategori"]').focus();
        return;
    }

    var isi = document.querySelector('.ql-editor').innerHTML.trim();
    if (isi === '<p><br></p>' || isi === '') {
        alert('Isi berita wajib diisi.');
        return;
    }
    document.getElementById('hidden-isi').value = isi;
    document.getElementById('berita-form').submit();
}
</script>
@endsection
