@extends('layouts.master')

@section('css')
    <style>
        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-pale: #e8f5f1;
            --gold: #c9a84c;
            --gold-pale: #fff8e6;
            --red: #ef4444;
            --text: #1a1a2e;
            --gray: #6b7280;
            --bg: #f4f7f6;
            --white: #ffffff;
            --border: #e5e7eb;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(0, 0, 0, .07);
            --shadow-hov: 0 8px 32px rgba(0, 127, 95, .14);
            --tr: .22s cubic-bezier(.4, 0, .2, 1);
        }

        body {
            background: var(--bg) !important;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 60%, var(--green-light) 100%);
            border-radius: var(--radius);
            padding: 22px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: 'فتوى';
            position: absolute;
            right: 28px;
            top: 50%;
            transform: translateY(-50%);
            font-family: 'serif';
            font-size: 80px;
            color: rgba(255, 255, 255, .06);
            pointer-events: none;
            line-height: 1;
        }

        .page-header h4 {
            font-size: 20px;
            font-weight: 800;
            margin: 0;
            color: #fff;
            position: relative;
        }

        .page-header p {
            margin: 3px 0 0;
            font-size: 13px;
            color: rgba(255, 255, 255, .8);
            position: relative;
        }

        /* ── STAT CARDS ── */
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all var(--tr);
            border: 1px solid transparent;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-hov);
            transform: translateY(-2px);
            border-color: var(--green-pale);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-icon.green {
            background: var(--green-pale);
            color: var(--green);
        }

        .stat-icon.gold {
            background: var(--gold-pale);
            color: var(--gold);
        }

        .stat-icon.red {
            background: #fef2f2;
            color: var(--red);
        }

        .stat-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
            line-height: 1;
        }

        .stat-label {
            font-size: 12.5px;
            color: var(--gray);
            margin-top: 3px;
        }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            background: var(--white);
            border-radius: var(--radius);
            padding: 12px 16px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
        }

        .filter-bar label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--gray);
            margin: 0;
            white-space: nowrap;
        }

        .filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 22px;
            font-size: 13px;
            font-weight: 600;
            border: 1.5px solid var(--border);
            background: var(--white);
            color: var(--gray);
            cursor: pointer;
            transition: all var(--tr);
            user-select: none;
        }

        .filter-pill:hover {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-pale);
        }

        .filter-pill.active {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
        }

        .filter-pill.active-red {
            background: var(--red);
            color: #fff;
            border-color: var(--red);
        }

        /* ── PANEL ── */
        .panel-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-header {
            padding: 16px 22px;
            border-bottom: 1px solid #f0f4f3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .panel-header h5 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .panel-header h5 i {
            color: var(--green);
            font-size: 18px;
        }

        /* ── TABLE ── */
        .fatwa-table {
            width: 100%;
        }

        .fatwa-table th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray);
            padding: 10px 14px;
            border-bottom: 2px solid #f0f4f3;
            background: #fafcfb;
            white-space: nowrap;
        }

        .fatwa-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f4f6f5;
            font-size: 13.5px;
            color: var(--text);
            vertical-align: middle;
        }

        .fatwa-table tr:last-child td {
            border-bottom: none;
        }

        .fatwa-table tr:hover td {
            background: #fafcfb;
        }

        /* ── JUDUL CELL ── */
        .judul-cell {
            font-weight: 700;
            color: var(--text);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 320px;
        }

        /* ── STATUS BADGE ── */
        .pub-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all var(--tr);
            border: 1.5px solid transparent;
            white-space: nowrap;
        }

        .pub-badge.published {
            background: var(--green-pale);
            color: var(--green);
            border-color: rgba(0, 127, 95, .15);
        }

        .pub-badge.published:hover {
            background: var(--green);
            color: #fff;
        }

        .pub-badge.draft {
            background: #fef2f2;
            color: #dc2626;
            border-color: rgba(239, 68, 68, .15);
        }

        .pub-badge.draft:hover {
            background: var(--red);
            color: #fff;
        }

        /* ── PDF LINK ── */
        .pdf-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 13px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            background: #fff0f0;
            color: #dc2626;
            border: 1px solid rgba(220, 38, 38, .15);
            text-decoration: none;
            transition: all var(--tr);
            max-width: 200px;
        }

        .pdf-link:hover {
            background: #dc2626;
            color: #fff;
            border-color: #dc2626;
        }

        .pdf-link i {
            font-size: 17px;
            flex-shrink: 0;
        }

        .pdf-link-name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .pdf-none {
            color: var(--gray);
            font-style: italic;
            font-size: 12px;
        }

        /* ── MODAL ── */
        .modal-header {
            background: linear-gradient(135deg, var(--green-dark), var(--green-light));
            color: #fff;
            padding: 16px 22px;
        }

        .modal-title {
            font-weight: 800;
            font-size: 16px;
        }

        .modal-header .close {
            color: #fff;
            opacity: .8;
            text-shadow: none;
            font-size: 22px;
        }

        .modal-header .close:hover {
            opacity: 1;
        }

        .form-group label {
            font-weight: 600;
            font-size: 13px;
            color: var(--text);
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(0, 127, 95, .12);
        }

        /* ── PDF UPLOAD AREA ── */
        .pdf-upload-area {
            border: 2px dashed #fca5a5;
            border-radius: 10px;
            padding: 30px 16px;
            text-align: center;
            cursor: pointer;
            transition: all var(--tr);
            position: relative;
            background: #fff8f8;
        }

        .pdf-upload-area:hover,
        .pdf-upload-area.dragover {
            border-color: #dc2626;
            background: #fff0f0;
        }

        .pdf-upload-area .pdf-icon {
            font-size: 40px;
            color: #dc2626;
            display: block;
            margin-bottom: 8px;
        }

        .pdf-upload-area p {
            font-size: 13px;
            color: var(--gray);
            margin: 0;
            line-height: 1.6;
        }

        .pdf-upload-area small {
            display: block;
            margin-top: 5px;
            font-size: 11.5px;
            color: #aaa;
        }

        .pdf-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        /* File terpilih */
        .pdf-chosen {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #fff0f0;
            border: 1px solid rgba(220, 38, 38, .2);
            border-radius: 8px;
            margin-top: 10px;
            font-size: 13px;
            color: #991b1b;
        }

        .pdf-chosen.show {
            display: flex;
        }

        .pdf-chosen i {
            font-size: 22px;
            flex-shrink: 0;
        }

        .pdf-chosen-name {
            font-weight: 700;
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .pdf-chosen-size {
            font-size: 11px;
            color: var(--gray);
            white-space: nowrap;
        }

        .pdf-chosen-remove {
            background: none;
            border: none;
            color: var(--red);
            cursor: pointer;
            font-size: 15px;
            padding: 0 4px;
        }

        /* File saat ini */
        .current-pdf {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #fff8f8;
            border: 1px solid rgba(220, 38, 38, .15);
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .current-pdf i {
            font-size: 22px;
            color: #dc2626;
            flex-shrink: 0;
        }

        .current-pdf span {
            flex: 1;
            font-weight: 600;
            font-size: 13px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .current-pdf small {
            color: var(--gray);
            font-size: 11px;
            white-space: nowrap;
        }

        /* ── TOGGLE SWITCH ── */
        .toggle-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-label {
            font-weight: 600;
            font-size: 13px;
            color: var(--text);
        }

        .toggle-switch {
            position: relative;
            width: 48px;
            height: 26px;
            flex-shrink: 0;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            background: #d1d5db;
            border-radius: 26px;
            transition: background .2s;
            cursor: pointer;
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 50%;
            left: 3px;
            top: 3px;
            transition: transform .2s;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
        }

        .toggle-switch input:checked+.toggle-slider {
            background: var(--green);
        }

        .toggle-switch input:checked+.toggle-slider::before {
            transform: translateX(22px);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding:24px 28px;">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h4><i class="mdi mdi-book-open-variant" style="margin-right:8px;"></i>Manajemen Fatwa</h4>
                <p>Kelola koleksi fatwa MUI Digital — upload & publikasikan PDF fatwa</p>
            </div>
            <button type="button" class="btn btn-light btn-sm font-weight-bold" id="btn-create-fatwa">
                <i class="mdi mdi-plus-circle"></i> Tambah Fatwa
            </button>
        </div>

        {{-- STAT CARDS --}}
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="mdi mdi-book-multiple"></i></div>
                    <div>
                        <div class="stat-value" id="stat-total">–</div>
                        <div class="stat-label">Total Fatwa</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon gold"><i class="mdi mdi-eye-check"></i></div>
                    <div>
                        <div class="stat-value" id="stat-published">–</div>
                        <div class="stat-label">Dipublikasikan</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon red"><i class="mdi mdi-eye-off"></i></div>
                    <div>
                        <div class="stat-value" id="stat-draft">–</div>
                        <div class="stat-label">Tidak Aktif</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER BAR --}}
        <div class="filter-bar">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <label class="mb-0"><i class="mdi mdi-filter-outline mr-1"></i> Filter:</label>
                <span class="filter-pill active" data-filter="">Semua</span>
                <span class="filter-pill" data-filter="1">
                    <i class="mdi mdi-eye-check" style="font-size:14px;"></i> Aktif
                </span>
                <span class="filter-pill" data-filter="0">
                    <i class="mdi mdi-eye-off" style="font-size:14px;"></i> Tidak Aktif
                </span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <label for="select-status-fatwa" class="mb-0 text-muted small font-weight-bold">Status Fatwa:</label>
                <select id="select-status-fatwa" class="form-control form-control-sm" style="width: auto; min-width: 140px; border-radius: 8px;">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="direvisi">Direvisi</option>
                    <option value="digantikan">Digantikan</option>
                </select>
            </div>
            <div class="d-flex align-items-center gap-2">
                <label for="select-kategori-fatwa" class="mb-0 text-muted small font-weight-bold">Kategori:</label>
                <select id="select-kategori-fatwa" class="form-control form-control-sm" style="width: auto; min-width: 170px; border-radius: 8px;">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoriFatwas as $kf)
                        <option value="{{ $kf->id }}">{{ $kf->nama }}</option>
                    @endforeach
                </select>
                <a href="{{ auth()->user()->isAdmin() ? route('admin.kategori-fatwa.index') : route('operator.kategori-fatwa.index') }}" class="btn btn-outline-success btn-sm font-weight-bold" title="Kelola Kategori Fatwa">
                    <i class="mdi mdi-tag-multiple-outline mr-1"></i> Kelola Kategori
                </a>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="panel-card">
            <div class="panel-header">
                <h5><i class="mdi mdi-format-list-bulleted"></i> Daftar Fatwa</h5>
            </div>
            <div class="table-responsive" style="padding:0;">
                <table class="fatwa-table" id="fatwa-table">
                    <thead>
                        <tr>
                            <th style="width:44px;">#</th>
                            <th>Judul Fatwa</th>
                            <th>Kategori</th>
                            <th>Status Fatwa</th>
                            <th>Keterangan</th>
                            <th>File PDF</th>
                            <th>Publikasi</th>
                            <th>Tgl Dibuat</th>
                            <th style="width:110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── MODAL CRUD ── --}}
    <div class="modal fade" id="fatwa-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fatwa-modal-title">Tambah Fatwa</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="fatwa-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="fatwa-form-errors" class="alert alert-danger d-none"></div>
                        <div class="row">

                            {{-- Judul --}}
                            <div class="form-group col-12">
                                <label>Judul Fatwa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="f-judul" name="judul" maxlength="255"
                                    required placeholder="cth: Fatwa MUI No. 1 Tahun 2024 Tentang ...">
                            </div>

                            {{-- Kategori Fatwa --}}
                            <div class="form-group col-12">
                                <label>Kategori Fatwa <small class="text-muted">(opsional)</small></label>
                                <select class="form-control" id="f-kategori-fatwa-id" name="kategori_fatwa_id" style="border-radius: 8px;">
                                    <option value="">— Tanpa Kategori —</option>
                                    @foreach ($kategoriFatwas as $kf)
                                        <option value="{{ $kf->id }}">{{ $kf->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Keterangan --}}
                            <div class="form-group col-12">
                                <label>Keterangan <small class="text-muted">(opsional)</small></label>
                                <textarea class="form-control" id="f-keterangan" name="keterangan" rows="3" maxlength="1000"
                                    placeholder="Ringkasan atau catatan mengenai fatwa ini..."></textarea>
                                <div class="text-right" style="font-size:11px;color:var(--gray);margin-top:3px;">
                                    <span id="ket-count">0</span>/1000
                                </div>
                            </div>

                            {{-- Status Publikasi --}}
                            <div class="form-group col-md-6">
                                <label>Status Publikasi</label>
                                <div class="toggle-wrap mt-1">
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="f-publikasi" value="1" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <span class="toggle-label" id="toggle-label-text">Aktif (Ditampilkan)</span>
                                </div>
                                <input type="hidden" id="f-publikasi-hidden" name="publikasi" value="1">
                            </div>

                            {{-- Status Fatwa --}}
                            <div class="form-group col-md-6">
                                <label>Status Keberlakuan <span class="text-danger">*</span></label>
                                <select class="form-control" id="f-status-fatwa" name="status_fatwa" required style="border-radius: 8px;">
                                    <option value="aktif">Aktif</option>
                                    <option value="direvisi">Direvisi</option>
                                    <option value="digantikan">Digantikan</option>
                                </select>
                                <small class="text-muted">Keberlakuan hukum fatwa.</small>
                            </div>

                            {{-- PDF Upload --}}
                            <div class="form-group col-12">
                                <label>
                                    File PDF Fatwa
                                    <span class="text-danger" id="pdf-required-star">*</span>
                                    <small class="text-muted d-none" id="pdf-optional-note">(biarkan kosong jika tidak
                                        diganti)</small>
                                </label>

                                {{-- File saat ini (edit mode) --}}
                                <div class="current-pdf d-none" id="current-pdf-info">
                                    <i class="mdi mdi-file-pdf-box"></i>
                                    <span id="current-pdf-name">—</span>
                                    <small>File saat ini</small>
                                </div>

                                <div class="pdf-upload-area" id="pdf-upload-area">
                                    <input type="file" id="f-filepdf" name="filepdf" accept=".pdf,application/pdf">
                                    <i class="mdi mdi-file-pdf-box pdf-icon"></i>
                                    <p>
                                        <strong>Klik atau seret file PDF ke sini</strong><br>
                                        <span style="font-size:12px;">Hanya format PDF yang diterima</span>
                                    </p>
                                    <small>Maks 10 MB</small>
                                </div>

                                <div class="pdf-chosen" id="pdf-chosen">
                                    <i class="mdi mdi-file-pdf-box"></i>
                                    <span class="pdf-chosen-name" id="pdf-chosen-name">—</span>
                                    <span class="pdf-chosen-size" id="pdf-chosen-size"></span>
                                    <button type="button" class="pdf-chosen-remove" id="pdf-remove-btn"
                                        title="Batal pilih">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btn-save-fatwa">
                            <i class="mdi mdi-content-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── MODAL DETAIL ── --}}
    <div class="modal fade" id="fatwa-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="mdi mdi-book-open-variant mr-2"></i>Detail Fatwa</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="fatwa-detail-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                    <a href="#" id="detail-pdf-link" target="_blank" class="btn btn-danger btn-sm d-none">
                        <i class="mdi mdi-file-pdf-box"></i> Buka PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function() {
            'use strict';

            /* ── CONFIG ── */
            var role = @json(auth()->user()->role);
            var baseUrl = @json(auth()->user()->isAdmin() ? route('admin.fatwa.index') : route('operator.fatwa.index'));
            var crudBase = @json(auth()->user()->isAdmin() ? url('admin/fatwa') : url('operator/fatwa'));
            var toggleBase = crudBase; // /{id}/toggle-publikasi

            var rows = {};
            var editingId = null;
            var table;
            var filterVal = '';
            var filterKategoriVal = '';
            var filterStatusFatwaVal = '';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            });

            /* ── STATS ── */
            function loadStats() {
                $.get(baseUrl, {
                    draw: 1,
                    start: 0,
                    length: 9999
                }, function(res) {
                    var pub = 0,
                        draft = 0;
                    $.each(res.data, function(i, r) {
                        if (r.publikasi === 1) pub++;
                        else draft++;
                    });
                    $('#stat-total').text(res.recordsTotal);
                    $('#stat-published').text(pub);
                    $('#stat-draft').text(draft);
                });
            }
            loadStats();

            /* ── SIZE HELPER ── */
            function humanSize(bytes) {
                if (!bytes) return '';
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1048576).toFixed(1) + ' MB';
            }

            /* ── DATATABLE ── */
            table = $('#fatwa-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: baseUrl,
                    data: function(d) {
                        d.filter_publikasi = filterVal;
                        d.filter_kategori_fatwa = filterKategoriVal;
                        d.filter_status_fatwa = filterStatusFatwaVal;
                    },
                    dataSrc: function(res) {
                        rows = {};
                        $.each(res.data, function(i, r) {
                            rows[r.id] = r;
                        });
                        return res.data;
                    }
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                searchDelay: 400,
                order: [
                    [7, 'desc']
                ],
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(d, t, r, meta) {
                            return meta.settings._iDisplayStart + meta.row + 1;
                        }
                    },
                    {
                        data: 'judul',
                        render: function(data) {
                            return '<div class="judul-cell">' + $('<div>').text(data).html() +
                                '</div>';
                        }
                    },
                    {
                        data: 'kategori_nama',
                        orderable: true,
                        render: function(data) {
                            if (!data) return '<span class="text-muted" style="font-size:12px;">—</span>';
                            return '<span class="badge" style="background:var(--green-pale);color:var(--green-dark);font-weight:700;padding:4px 8px;border-radius:6px;font-size:11.5px;">' +
                                $('<div>').text(data).html() + '</span>';
                        }
                    },
                    {
                        data: 'status_fatwa',
                        orderable: true,
                        render: function(data) {
                            var val = data || 'aktif';
                            if (val === 'aktif') {
                                return '<span class="badge" style="background:#e8f5f1;color:#007f5f;border:1px solid #a7f3d0;font-weight:700;padding:4px 8px;border-radius:6px;font-size:11.5px;"><i class="mdi mdi-check-circle mr-1"></i>Aktif</span>';
                            } else if (val === 'direvisi') {
                                return '<span class="badge" style="background:#fffbeb;color:#b45309;border:1px solid #fde68a;font-weight:700;padding:4px 8px;border-radius:6px;font-size:11.5px;"><i class="mdi mdi-alert mr-1"></i>Direvisi</span>';
                            } else if (val === 'digantikan') {
                                return '<span class="badge" style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;font-weight:700;padding:4px 8px;border-radius:6px;font-size:11.5px;"><i class="mdi mdi-close-circle mr-1"></i>Digantikan</span>';
                            }
                            return $('<div>').text(val).html();
                        }
                    },
                    {
                        data: 'keterangan',
                        render: function(data) {
                            if (!data)
                            return '<span class="text-muted" style="font-size:12px;">—</span>';
                            var safe = $('<div>').text(data).html();
                            return '<div style="max-width:260px;font-size:13px;color:var(--gray);' +
                                'overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="' +
                                safe + '">' +
                                (safe.length > 70 ? safe.substring(0, 70) + '…' : safe) + '</div>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(d, t, row) {
                            if (!row.file_url) return '<span class="pdf-none">Belum ada PDF</span>';
                            return '<a href="' + row.file_url +
                                '" target="_blank" class="pdf-link">' +
                                '<i class="mdi mdi-file-pdf-box"></i>' +
                                '<span class="pdf-link-name">' + $('<div>').text(row.file_name ||
                                    'fatwa.pdf').html() + '</span>' +
                                '</a>';
                        }
                    },
                    {
                        data: 'publikasi',
                        orderable: true,
                        render: function(data, type, row) {
                            if (type !== 'display') return data;
                            var cls = data === 1 ? 'published' : 'draft';
                            var icon = data === 1 ? 'mdi-eye-check' : 'mdi-eye-off';
                            var label = data === 1 ? 'Aktif' : 'Nonaktif';
                            return '<span class="pub-badge ' + cls + ' btn-toggle-pub" data-id="' +
                                row.id + '">' +
                                '<i class="mdi ' + icon + '"></i>' + label + '</span>';
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') return new Date(data).getTime();
                            return new Date(data).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            });
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(d, t, row) {
                            return '<button class="btn btn-outline-info btn-sm mr-1 btn-detail-fatwa" data-id="' +
                                row.id + '" title="Detail">' +
                                '<i class="mdi mdi-eye"></i></button>' +
                                '<button class="btn btn-outline-primary btn-sm mr-1 btn-edit-fatwa" data-id="' +
                                row.id + '" title="Edit">' +
                                '<i class="mdi mdi-pencil"></i></button>' +
                                '<button class="btn btn-outline-danger btn-sm btn-delete-fatwa" data-id="' +
                                row.id + '" title="Hapus">' +
                                '<i class="mdi mdi-delete"></i></button>';
                        }
                    }
                ],
                language: {
                    search: 'Cari:',
                    processing: 'Memuat...',
                    lengthMenu: 'Tampilkan _MENU_ fatwa',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ fatwa',
                    infoEmpty: 'Tidak ada fatwa',
                    infoFiltered: '(difilter dari _MAX_ fatwa)',
                    zeroRecords: 'Fatwa tidak ditemukan',
                    emptyTable: 'Belum ada data fatwa',
                    paginate: {
                        first: '«',
                        last: '»',
                        next: '›',
                        previous: '‹'
                    }
                },
                responsive: true
            });

            /* ── FILTER PILLS ── */
            $(document).on('click', '.filter-pill', function() {
                $('.filter-pill').removeClass('active active-red');
                var raw = $(this).attr('data-filter');
                filterVal = (raw !== undefined && raw !== null) ? raw.toString() : '';
                if (filterVal === '0') $(this).addClass('active-red');
                else $(this).addClass('active');
                table.ajax.reload(null, false);
            });

            /* ── FILTER KATEGORI FATWA ── */
            $('#select-kategori-fatwa').on('change', function() {
                filterKategoriVal = $(this).val();
                table.ajax.reload(null, false);
            });

            /* ── FILTER STATUS FATWA ── */
            $('#select-status-fatwa').on('change', function() {
                filterStatusFatwaVal = $(this).val();
                table.ajax.reload(null, false);
            });

            /* ── KETERANGAN COUNTER ── */
            $('#f-keterangan').on('input', function() {
                $('#ket-count').text($(this).val().length);
            });

            /* ── TOGGLE SWITCH LABEL ── */
            $('#f-publikasi').on('change', function() {
                var on = $(this).is(':checked');
                $('#toggle-label-text').text(on ? 'Aktif (Ditampilkan)' : 'Nonaktif (Disembunyikan)');
                $('#f-publikasi-hidden').val(on ? 1 : 0);
            });

            /* ── FILE PILIH ── */
            $('#f-filepdf').on('change', function() {
                var file = this.files[0];
                if (!file) {
                    resetPdfUI();
                    return;
                }

                if (file.size > 10 * 1024 * 1024) {
                    alert('Ukuran file maksimal 10 MB.');
                    this.value = '';
                    resetPdfUI();
                    return;
                }
                if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                    alert('Hanya file PDF yang diperbolehkan.');
                    this.value = '';
                    resetPdfUI();
                    return;
                }

                $('#pdf-upload-area').hide();
                $('#pdf-chosen-name').text(file.name);
                $('#pdf-chosen-size').text(humanSize(file.size));
                $('#pdf-chosen').addClass('show');
            });

            $('#pdf-remove-btn').on('click', function() {
                $('#f-filepdf').val('');
                resetPdfUI();
            });

            function resetPdfUI() {
                $('#pdf-upload-area').show();
                $('#pdf-chosen').removeClass('show');
                $('#pdf-chosen-name, #pdf-chosen-size').text('');
            }

            /* ── DRAG & DROP ── */
            var dropArea = document.getElementById('pdf-upload-area');
            if (dropArea) {
                dropArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });
                dropArea.addEventListener('dragleave', function() {
                    this.classList.remove('dragover');
                });
                dropArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                    var file = e.dataTransfer.files[0];
                    if (file) {
                        var input = document.getElementById('f-filepdf');
                        var dt = new DataTransfer();
                        dt.items.add(file);
                        input.files = dt.files;
                        $(input).trigger('change');
                    }
                });
            }

            /* ── HELPERS ── */
            function resetForm() {
                editingId = null;
                $('#fatwa-form')[0].reset();
                $('#fatwa-form-errors').addClass('d-none').empty();
                $('#fatwa-modal-title').text('Tambah Fatwa');
                $('#f-kategori-fatwa-id').val('');
                $('#f-status-fatwa').val('aktif');
                $('#pdf-required-star').show();
                $('#pdf-optional-note').addClass('d-none');
                $('#current-pdf-info').addClass('d-none');
                $('#f-filepdf').prop('required', true);
                $('#ket-count').text('0');
                $('#f-publikasi').prop('checked', true);
                $('#f-publikasi-hidden').val(1);
                $('#toggle-label-text').text('Aktif (Ditampilkan)');
                resetPdfUI();
            }

            function showErrors(xhr) {
                var msgs = [];
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(k, arr) {
                        msgs = msgs.concat(arr);
                    });
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msgs.push(xhr.responseJSON.message);
                }
                $('#fatwa-form-errors').html(msgs.join('<br>')).removeClass('d-none');
            }

            function refresh() {
                table.ajax.reload(null, false);
                loadStats();
            }

            /* ── CREATE ── */
            $('#btn-create-fatwa').on('click', function() {
                resetForm();
                $('#fatwa-modal').modal('show');
            });

            /* ── EDIT ── */
            $(document).on('click', '.btn-edit-fatwa', function() {
                var item = rows[$(this).data('id')];
                if (!item) return;
                resetForm();
                editingId = item.id;
                $('#fatwa-modal-title').text('Edit Fatwa');

                $('#f-judul').val(item.judul);
                $('#f-kategori-fatwa-id').val(item.kategori_fatwa_id || '');
                $('#f-status-fatwa').val(item.status_fatwa || 'aktif');
                $('#f-keterangan').val(item.keterangan || '').trigger('input');

                var pub = item.publikasi === 1;
                $('#f-publikasi').prop('checked', pub);
                $('#f-publikasi-hidden').val(pub ? 1 : 0);
                $('#toggle-label-text').text(pub ? 'Aktif (Ditampilkan)' : 'Nonaktif (Disembunyikan)');

                // File saat ini
                if (item.file_name) {
                    $('#current-pdf-name').text(item.file_name);
                    $('#current-pdf-info').removeClass('d-none');
                }

                // PDF tidak wajib saat edit
                $('#pdf-required-star').hide();
                $('#pdf-optional-note').removeClass('d-none');
                $('#f-filepdf').prop('required', false);

                $('#fatwa-modal').modal('show');
            });

            /* ── DETAIL ── */
            $(document).on('click', '.btn-detail-fatwa', function() {
                var item = rows[$(this).data('id')];
                if (!item) return;

                var pub = item.publikasi === 1 ?
                    '<span class="pub-badge published"><i class="mdi mdi-eye-check"></i> Aktif</span>' :
                    '<span class="pub-badge draft"><i class="mdi mdi-eye-off"></i> Nonaktif</span>';

                var katBadge = item.kategori_nama ?
                    '<span class="badge" style="background:var(--green-pale);color:var(--green-dark);font-weight:700;padding:5px 10px;border-radius:6px;font-size:12px;">' + $('<div>').text(item.kategori_nama).html() + '</span>' :
                    '<em class="text-muted">Tanpa Kategori</em>';

                var sfVal = item.status_fatwa || 'aktif';
                var statusFatwaBadge = '';
                if (sfVal === 'aktif') {
                    statusFatwaBadge = '<span class="badge" style="background:#e8f5f1;color:#007f5f;border:1px solid #a7f3d0;font-weight:700;padding:5px 10px;border-radius:6px;font-size:12px;"><i class="mdi mdi-check-circle mr-1"></i>Aktif</span>';
                } else if (sfVal === 'direvisi') {
                    statusFatwaBadge = '<span class="badge" style="background:#fffbeb;color:#b45309;border:1px solid #fde68a;font-weight:700;padding:5px 10px;border-radius:6px;font-size:12px;"><i class="mdi mdi-alert mr-1"></i>Direvisi</span>';
                } else if (sfVal === 'digantikan') {
                    statusFatwaBadge = '<span class="badge" style="background:#fef2f2;color:#b91c1c;border:1px solid #fecaca;font-weight:700;padding:5px 10px;border-radius:6px;font-size:12px;"><i class="mdi mdi-close-circle mr-1"></i>Digantikan</span>';
                }

                var html = '<table class="table table-sm table-bordered" style="font-size:13.5px;">' +
                    '<tbody>' +
                    '<tr><th style="width:35%;background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Judul</th>' +
                    '<td><strong>' + $('<div>').text(item.judul).html() + '</strong></td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Kategori</th>' +
                    '<td>' + katBadge + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Status Fatwa</th>' +
                    '<td>' + statusFatwaBadge + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Keterangan</th>' +
                    '<td style="white-space:pre-wrap;">' + (item.keterangan ? $('<div>').text(item
                        .keterangan).html() : '<em class="text-muted">—</em>') + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Publikasi</th>' +
                    '<td>' + pub + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Dilihat</th>' +
                    '<td><span class="badge badge-light border text-dark font-weight-bold px-2 py-1"><i class="mdi mdi-eye mr-1 text-success"></i>' + (item.views ? Number(item.views).toLocaleString('id-ID') : 0) + ' kali</span></td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">File PDF</th>' +
                    '<td>' + (item.file_url ?
                        '<a href="' + item.file_url +
                        '" target="_blank" class="pdf-link" style="display:inline-flex;">' +
                        '<i class="mdi mdi-file-pdf-box"></i><span class="pdf-link-name">' + $('<div>')
                        .text(item.file_name || 'fatwa.pdf').html() + '</span></a>' :
                        '<span class="pdf-none">Belum ada PDF</span>') + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Tgl Dibuat</th>' +
                    '<td>' + new Date(item.created_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) + '</td></tr>' +
                    '</tbody></table>';

                $('#fatwa-detail-body').html(html);

                if (item.file_url) {
                    $('#detail-pdf-link').attr('href', item.file_url).removeClass('d-none');
                } else {
                    $('#detail-pdf-link').addClass('d-none');
                }

                $('#fatwa-detail-modal').modal('show');
            });

            /* ── SAVE ── */
            $('#fatwa-form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                // Sinkron hidden publikasi dengan checkbox
                formData.set('publikasi', $('#f-publikasi').is(':checked') ? 1 : 0);

                if (editingId) formData.append('_method', 'PUT');

                var $btn = $('#btn-save-fatwa').prop('disabled', true).html(
                    '<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...');
                var url = editingId ? crudBase + '/' + editingId : crudBase;

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                }).done(function(res) {
                    $('#fatwa-modal').modal('hide');
                    alertify.success(res.message);
                    refresh();
                }).fail(function(xhr) {
                    showErrors(xhr);
                }).always(function() {
                    $btn.prop('disabled', false).html(
                    '<i class="mdi mdi-content-save"></i> Simpan');
                });
            });

            /* ── TOGGLE PUBLIKASI (inline badge klik) ── */
            $(document).on('click', '.btn-toggle-pub', function() {
                var id = $(this).data('id');
                $.ajax({
                        url: crudBase + '/' + id + '/toggle-publikasi',
                        method: 'PATCH'
                    })
                    .done(function(res) {
                        alertify.success(res.message);
                        refresh();
                    })
                    .fail(function() {
                        alertify.error('Gagal mengubah status.');
                    });
            });

            /* ── DELETE ── */
            $(document).on('click', '.btn-delete-fatwa', function() {
                var id = $(this).data('id');
                var item = rows[id];
                var judul = item ? item.judul.substring(0, 60) : 'fatwa ini';
                if (!confirm('Hapus fatwa:\n"' + judul +
                        '"\n\nFile PDF juga akan dihapus. Tindakan ini tidak dapat dibatalkan.')) return;

                $.ajax({
                        url: crudBase + '/' + id,
                        method: 'DELETE'
                    })
                    .done(function(res) {
                        alertify.success(res.message);
                        refresh();
                    })
                    .fail(function(xhr) {
                        alertify.error(xhr.responseJSON ? xhr.responseJSON.message :
                        'Gagal menghapus.');
                    });
            });

            /* ── RESET MODAL ── */
            $('#fatwa-modal').on('hidden.bs.modal', resetForm);
        });
    </script>
@endsection
