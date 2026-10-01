@extends('layouts.master')

@section('css')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-pale: #e8f5f1;
            --gold: #c9a84c;
            --red: #ef4444;
            --text: #1a1a2e;
            --gray: #6b7280;
            --border: #e5e7eb;
            --bg: #f4f7f6;
            --white: #ffffff;
            --radius: 12px;
            --shadow: 0 2px 16px rgba(0, 0, 0, .07);
        }

        body {
            background: var(--bg) !important;
        }

        /* ── TOPBAR AKSI ── */
        .editor-topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow);
        }

        .editor-topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .editor-topbar h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
        }

        .editor-topbar h5 span {
            font-size: 12px;
            color: var(--gray);
            font-weight: 500;
            margin-left: 8px;
        }

        /* ── LAYOUT EDITOR ── */
        .editor-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 24px;
            padding: 24px 28px;
            max-width: 1400px;
        }

        /* ── CARD ── */
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
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fafcfb;
        }

        .editor-card-head i {
            color: var(--green);
            font-size: 16px;
        }

        .editor-card-body {
            padding: 20px;
        }

        /* ── JUDUL INPUT ── */
        .title-input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.3;
            padding: 0;
            background: transparent;
            font-family: inherit;
            resize: none;
            overflow: hidden;
        }

        .title-input::placeholder {
            color: #d1d5db;
        }

        .title-separator {
            height: 2px;
            background: linear-gradient(90deg, var(--green), var(--green-pale), transparent);
            margin: 14px 0;
            border-radius: 2px;
        }

        /* ── QUILL ── */
        #quill-editor {
            min-height: 400px;
            font-size: 15px;
            line-height: 1.8;
            color: var(--text);
        }

        .ql-toolbar {
            border: none !important;
            border-bottom: 1px solid var(--border) !important;
            background: #fafcfb;
            padding: 10px !important;
        }

        .ql-container {
            border: none !important;
            font-family: inherit !important;
        }

        .ql-editor {
            padding: 20px !important;
        }

        .ql-editor.ql-blank::before {
            color: #d1d5db;
            font-style: normal;
            font-size: 15px;
        }

        /* ── FORM FIELDS (sidebar) ── */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 7px;
        }

        .form-control {
            border-radius: 8px;
            border: 1.5px solid var(--border);
            padding: 9px 12px;
            font-size: 13.5px;
            color: var(--text);
            width: 100%;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(0, 127, 95, .1);
            outline: none;
        }

        /* ── STATUS PILLS ── */
        .status-pills {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .status-pill {
            flex: 1;
            min-width: 70px;
            text-align: center;
            padding: 8px 10px;
            border-radius: 8px;
            border: 2px solid var(--border);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
            background: var(--white);
            color: var(--gray);
            user-select: none;
        }

        .status-pill:has(input:checked),
        .status-pill.checked {
            border-color: var(--green);
            background: var(--green-pale);
            color: var(--green);
        }

        .status-pill input[type="radio"] {
            display: none;
        }

        /* ── GAMBAR UPLOAD ── */
        .img-upload-area {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            position: relative;
            background: #fafcfb;
        }

        .img-upload-area:hover,
        .img-upload-area.dragover {
            border-color: var(--green);
            background: var(--green-pale);
        }

        .img-upload-area i {
            font-size: 32px;
            color: var(--green);
            display: block;
            margin-bottom: 8px;
        }

        .img-upload-area p {
            font-size: 13px;
            color: var(--gray);
            margin: 0;
            line-height: 1.5;
        }

        .img-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .img-preview {
            width: 100%;
            border-radius: 8px;
            margin-top: 12px;
            display: none;
            position: relative;
        }

        .img-preview img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        .img-preview-remove {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(239, 68, 68, .9);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 12px;
            cursor: pointer;
        }

        /* ── CHAR COUNTER ── */
        .char-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
            font-size: 11.5px;
            color: var(--gray);
        }

        /* ── SUBMIT BUTTONS ── */
        .btn-publish {
            background: linear-gradient(135deg, var(--green), var(--green-light));
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(0, 127, 95, .3);
        }

        .btn-publish:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 127, 95, .4);
        }

        .btn-draft {
            background: var(--white);
            color: var(--text);
            border: 1.5px solid var(--border);
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: all .2s;
        }

        .btn-draft:hover {
            border-color: var(--green);
            color: var(--green);
        }

        /* ── ALERT SUCCESS ── */
        .alert-success-bar {
            background: var(--green-pale);
            border-left: 4px solid var(--green);
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 13.5px;
            color: var(--green-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 28px 20px;
        }

        /* ── ERROR ── */
        .validation-errors {
            background: #fef2f2;
            border-left: 4px solid var(--red);
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 13px;
            color: #b91c1c;
            margin: 0 28px 20px;
        }

        .validation-errors ul {
            margin: 4px 0 0 16px;
            padding: 0;
        }

        @media (max-width: 991px) {
            .editor-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    {{-- TOPBAR AKSI --}}
    <div class="editor-topbar">
        <div class="editor-topbar-left">
            <a href="{{ route(auth()->user()->role . '.berita.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="mdi mdi-arrow-left"></i>
            </a>
            <h5>Tambah Berita <span>Artikel baru</span></h5>
        </div>
        <div class="d-flex align-items-center" style="gap:8px;">
            <button type="button" class="btn-draft" id="btn-save-draft" onclick="submitForm('draft')" style="display:none;">
                <i class="mdi mdi-content-save-outline"></i> Simpan Draft
            </button>
            <button type="button" class="btn-publish" id="btn-publish" onclick="submitForm()">
                <i class="mdi mdi-content-save-outline" id="btn-publish-icon"></i> <span id="btn-publish-text">Simpan Draft</span>
            </button>
        </div>
    </div>

    {{-- ERRORS --}}
    @if ($errors->any())
        <div class="validation-errors">
            <strong>Terdapat kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert-success-bar">
            <i class="mdi mdi-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <form id="berita-form" action="{{ route(auth()->user()->role . '.berita.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="hidden-isi" name="isi">

        <div class="editor-layout">

            {{-- ── KIRI: Konten Utama ── --}}
            <div>
                {{-- Judul --}}
                <div class="editor-card">
                    <div class="editor-card-body" style="padding:24px 28px;">
                        <textarea class="title-input" name="judul" rows="2" placeholder="Tulis judul berita di sini..." maxlength="255"
                            id="judul-input" required>{{ old('judul') }}</textarea>
                        <div class="title-separator"></div>
                        <div class="char-meta">
                            <span style="color:var(--gray);font-size:12px;">
                                <i class="mdi mdi-format-title" style="color:var(--green);"></i>
                                Judul artikel
                            </span>
                            <span><span id="judul-count">{{ strlen(old('judul', '')) }}</span>/255</span>
                        </div>
                    </div>
                </div>

                {{-- Editor Konten --}}
                <div class="editor-card">
                    <div class="editor-card-head">
                        <i class="mdi mdi-file-document-edit"></i> Isi Berita
                    </div>
                    <div id="quill-editor">{{ old('isi') }}</div>
                </div>
            </div>

            {{-- ── KANAN: Sidebar Pengaturan ── --}}
            <aside>

                {{-- Status Publish --}}
                <div class="editor-card">
                    <div class="editor-card-head">
                        <i class="mdi mdi-publish"></i> Status Publikasi
                    </div>
                    <div class="editor-card-body">
                        <div class="status-pills" id="status-pills">
                            <label class="status-pill {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}" id="pill-draft">
                                <input type="radio" name="status" value="draft" {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}>
                                <i class="mdi mdi-pencil-box"></i><br>Draft
                            </label>
                            <label class="status-pill {{ old('status') === 'published' ? 'checked' : '' }}" id="pill-published">
                                <input type="radio" name="status" value="published" {{ old('status') === 'published' ? 'checked' : '' }}>
                                <i class="mdi mdi-check-circle"></i><br>Publish
                            </label>
                            <label class="status-pill {{ old('status') === 'archived' ? 'checked' : '' }}" id="pill-archived">
                                <input type="radio" name="status" value="archived" {{ old('status') === 'archived' ? 'checked' : '' }}>
                                <i class="mdi mdi-archive"></i><br>Arsip
                            </label>
                        </div>

                        <div class="form-group mt-3" id="published-at-wrap" style="display:none;">
                            <label>Tanggal Publikasi</label>
                            <input type="datetime-local" name="published_at" class="form-control"
                                value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            <div style="font-size:11px;color:var(--gray);margin-top:4px;">
                                Kosongkan untuk waktu sekarang
                            </div>
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
                                @foreach ($kategoriList as $kat)
                                    @php
                                        $val = is_object($kat) ? $kat->nama : $kat;
                                    @endphp
                                    <option value="{{ $val }}" {{ old('kategori') === $val ? 'selected' : '' }}>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>
                            @if(count($kategoriList) === 0)
                                <small class="text-muted d-block mt-2">
                                    <i class="mdi mdi-information-outline"></i> Belum ada kategori di tabel kategoris.
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('admin.kategori.index') }}" target="_blank" class="text-success font-weight-bold">Tambah Kategori</a>
                                    @endif
                                </small>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Gambar Utama --}}
                <div class="editor-card">
                    <div class="editor-card-head">
                        <i class="mdi mdi-image"></i> Gambar Utama (Thumbnail) <span class="text-danger">*</span>
                    </div>
                    <div class="editor-card-body">
                        <div class="img-upload-area" id="img-upload-area">
                            <input type="file" name="gambar" id="gambar-input"
                                accept="image/jpeg,image/png,image/jpg,image/webp" required>
                            <i class="mdi mdi-cloud-upload-outline"></i>
                            <p><strong>Klik atau seret gambar ke sini</strong><br>
                                JPEG, PNG, WEBP · Maks 2 MB <span class="text-danger font-weight-bold">(Wajib)</span></p>
                        </div>
                        <div class="img-preview" id="img-preview">
                            <img src="" alt="Preview" id="img-preview-img">
                            <button type="button" class="img-preview-remove" id="img-remove-btn">
                                <i class="mdi mdi-close"></i> Hapus
                            </button>
                        </div>
                        @error('gambar')
                            <small class="text-danger font-weight-bold d-block mt-2">{{ $message }}</small>
                        @enderror
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
                            Penulis: <strong class="ml-1">{{ auth()->user()->name }}</strong>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-calendar mr-2" style="color:var(--green);"></i>
                            Dibuat: <strong class="ml-1">{{ now()->translatedFormat('d M Y, H:i') }}</strong>
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
                theme: 'snow',
                placeholder: 'Tulis isi berita di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, 4, false]
                        }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        [{
                            indent: '-1'
                        }, {
                            indent: '+1'
                        }],
                        [{
                            align: []
                        }],
                        ['blockquote', 'code-block'],
                        ['link', 'image'],
                        ['clean']
                    ]
                }
            });

            /* Restore old value jika ada validasi error */
            var oldIsi = @json(old('isi', ''));
            if (oldIsi) quill.clipboard.dangerouslyPasteHTML(oldIsi);

            /* ── CHAR COUNTER JUDUL ── */
            var $judul = $('#judul-input');
            $judul.on('input', function() {
                $('#judul-count').text($(this).val().length);
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            }).trigger('input');

            /* ── STATUS PILLS & UI SYNC ── */
            function syncStatusUI() {
                var $checked = $('input[name="status"]:checked');
                var val = $checked.val() || 'draft';

                $('.status-pill').removeClass('checked');
                $checked.closest('.status-pill').addClass('checked');
                $('#published-at-wrap').toggle(val === 'published');

                if (val === 'draft') {
                    $('#btn-publish-icon').attr('class', 'mdi mdi-content-save-outline');
                    $('#btn-publish-text').text('Simpan Draft');
                    $('#btn-save-draft').hide();
                } else if (val === 'published') {
                    $('#btn-publish-icon').attr('class', 'mdi mdi-send');
                    $('#btn-publish-text').text('Publikasikan');
                    $('#btn-save-draft').show();
                } else if (val === 'archived') {
                    $('#btn-publish-icon').attr('class', 'mdi mdi-archive');
                    $('#btn-publish-text').text('Simpan ke Arsip');
                    $('#btn-save-draft').show();
                }
            }

            $('input[name="status"]').on('change', syncStatusUI);
            syncStatusUI();

            /* ── GAMBAR PREVIEW ── */
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
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            area.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });
            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                var file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    var input = document.getElementById('gambar-input');
                    var dt = new DataTransfer();
                    dt.items.add(file);
                    input.files = dt.files;
                    $(input).trigger('change');
                }
            });
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

            var gambarInput = document.getElementById('gambar-input');
            if (!gambarInput.files || !gambarInput.files.length) {
                alert('Gambar utama (thumbnail) wajib diunggah.');
                return;
            }

            // Sync quill ke hidden field
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
