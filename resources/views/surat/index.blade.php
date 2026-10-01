@extends('layouts.master')

@section('css')
    <style>
        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-pale: #e8f5f1;
            --gold: #c9a84c;
            --red: #ef4444;
            --blue: #2563eb;
            --yellow: #f0a500;
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
            background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
            border-radius: var(--radius);
            padding: 22px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h4 {
            font-size: 20px;
            font-weight: 800;
            margin: 0;
            color: #fff;
        }

        .page-header p {
            margin: 3px 0 0;
            font-size: 13px;
            color: rgba(255, 255, 255, .8);
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

        .stat-icon.blue {
            background: #eff6ff;
            color: var(--blue);
        }

        .stat-icon.yellow {
            background: #fff8e6;
            color: var(--yellow);
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
        .surat-table {
            width: 100%;
        }

        .surat-table th {
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

        .surat-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f4f6f5;
            font-size: 13.5px;
            color: var(--text);
            vertical-align: middle;
        }

        .surat-table tr:last-child td {
            border-bottom: none;
        }

        .surat-table tr:hover td {
            background: #fafcfb;
        }

        /* ── NOMOR SURAT ── */
        .nomor-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
            font-family: monospace;
            background: var(--green-pale);
            color: var(--green);
            letter-spacing: .3px;
        }

        .nomor-kosong {
            color: var(--gray);
            font-style: italic;
            font-size: 12px;
        }

        /* ── FILE BADGE ── */
        .file-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--tr);
            border: 1px solid var(--border);
            background: var(--white);
            color: var(--text);
            max-width: 200px;
            overflow: hidden;
        }

        .file-badge:hover {
            background: var(--green-pale);
            border-color: var(--green);
            color: var(--green);
        }

        .file-badge .file-icon {
            font-size: 16px;
            flex-shrink: 0;
        }

        .file-badge .file-name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ext-pdf {
            color: #dc2626;
        }

        .ext-doc {
            color: #2563eb;
        }

        .ext-docx {
            color: #2563eb;
        }

        .ext-xls {
            color: #16a34a;
        }

        .ext-xlsx {
            color: #16a34a;
        }

        .ext-img {
            color: #7c3aed;
        }

        /* ── AUTHOR ── */
        .author-av {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--green-pale);
            color: var(--green);
            font-size: 11px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 6px;
            flex-shrink: 0;
        }

        /* ── MODAL ── */
        .modal-header {
            background: linear-gradient(135deg, var(--green), var(--green-light));
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

        /* ── FILE UPLOAD AREA ── */
        .file-upload-area {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 28px 16px;
            text-align: center;
            cursor: pointer;
            transition: all var(--tr);
            position: relative;
            background: #fafcfb;
        }

        .file-upload-area:hover,
        .file-upload-area.dragover {
            border-color: var(--green);
            background: var(--green-pale);
        }

        .file-upload-area i {
            font-size: 34px;
            color: var(--green);
            display: block;
            margin-bottom: 8px;
        }

        .file-upload-area p {
            font-size: 13px;
            color: var(--gray);
            margin: 0;
            line-height: 1.5;
        }

        .file-upload-area small {
            display: block;
            margin-top: 5px;
            font-size: 11px;
            color: #aaa;
        }

        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        /* Pilihan File Terpilih */
        .file-chosen {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--green-pale);
            border: 1px solid rgba(0, 127, 95, .2);
            border-radius: 8px;
            margin-top: 10px;
            font-size: 13px;
            color: var(--green-dark);
        }

        .file-chosen.show {
            display: flex;
        }

        .file-chosen i {
            font-size: 20px;
            flex-shrink: 0;
        }

        .file-chosen-name {
            font-weight: 700;
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-chosen-remove {
            background: none;
            border: none;
            color: var(--red);
            cursor: pointer;
            font-size: 15px;
            padding: 0 4px;
            flex-shrink: 0;
        }

        /* Ganti File (saat edit) */
        .current-file {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #f9fafb;
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .current-file i {
            font-size: 18px;
            flex-shrink: 0;
        }

        .current-file span {
            flex: 1;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .current-file small {
            color: var(--gray);
            font-size: 11px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 24px 28px;">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h4><i class="mdi mdi-email-outline" style="margin-right:8px;"></i>Manajemen Surat</h4>
                <p>Kelola arsip surat masuk & keluar MUI Digital</p>
            </div>
            <button type="button" class="btn btn-light btn-sm font-weight-bold" id="btn-create-surat">
                <i class="mdi mdi-plus-circle"></i> Unggah Surat
            </button>
        </div>

        {{-- STAT CARDS --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="mdi mdi-email-multiple"></i></div>
                    <div>
                        <div class="stat-value" id="stat-total">–</div>
                        <div class="stat-label">Total Surat</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="mdi mdi-file-pdf-box"></i></div>
                    <div>
                        <div class="stat-value" id="stat-bulan">–</div>
                        <div class="stat-label">Bulan Ini</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="mdi mdi-account-edit"></i></div>
                    <div>
                        <div class="stat-value" id="stat-saya">–</div>
                        <div class="stat-label">Diunggah Saya</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="panel-card">
            <div class="panel-header">
                <h5><i class="mdi mdi-format-list-bulleted"></i> Daftar Surat</h5>
            </div>
            <div class="table-responsive" style="padding:0;">
                <table class="surat-table" id="surat-table">
                    <thead>
                        <tr>
                            <th style="width:44px;">#</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Tgl Surat</th>
                            <th>File</th>
                            <th>Diunggah Oleh</th>
                            <th>Tgl Upload</th>
                            <th style="width:110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── MODAL CRUD ── --}}
    <div class="modal fade" id="surat-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="surat-modal-title">Unggah Surat</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="surat-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="surat-form-errors" class="alert alert-danger d-none"></div>
                        <div class="row">

                            {{-- Nomor Surat --}}
                            <div class="form-group col-md-5">
                                <label>Nomor Surat <small class="text-muted">(opsional)</small></label>
                                <input type="text" class="form-control" id="s-nomor" name="nomor_surat" maxlength="100"
                                    placeholder="cth: 001/MUI/IX/2026">
                            </div>

                            {{-- Tanggal Surat --}}
                            <div class="form-group col-md-4">
                                <label>Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="s-tanggal" name="tanggal_surat" required>
                            </div>

                            {{-- Perihal --}}
                            <div class="form-group col-12">
                                <label>Perihal <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="s-perihal" name="perihal" rows="3" maxlength="500" required
                                    placeholder="Tuliskan perihal surat..."></textarea>
                                <div class="text-right" style="font-size:11px;color:var(--gray);margin-top:3px;">
                                    <span id="perihal-count">0</span>/500
                                </div>
                            </div>

                            {{-- File Upload --}}
                            <div class="form-group col-12">
                                <label>File Surat <span class="text-danger" id="file-required-star">*</span>
                                    <small class="text-muted" id="file-optional-note" style="display:none;">(biarkan kosong
                                        jika tidak diganti)</small>
                                </label>

                                {{-- Tampil file saat edit --}}
                                <div class="current-file d-none" id="current-file-info">
                                    <i class="mdi mdi-file-document" id="current-file-icon" style="color:var(--green);"></i>
                                    <span id="current-file-name">—</span>
                                    <small>File saat ini</small>
                                </div>

                                <div class="file-upload-area" id="file-upload-area">
                                    <input type="file" id="s-file" name="file_surat"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                                    <i class="mdi mdi-cloud-upload-outline"></i>
                                    <p><strong>Klik atau seret file ke sini</strong></p>
                                    <small>PDF, DOC, DOCX, XLS, XLSX, JPG, PNG · Maks 5 MB</small>
                                </div>

                                <div class="file-chosen" id="file-chosen">
                                    <i class="mdi mdi-file-check" style="color:var(--green);"></i>
                                    <span class="file-chosen-name" id="file-chosen-name">—</span>
                                    <span class="file-chosen-size text-muted" id="file-chosen-size"
                                        style="font-size:11px;white-space:nowrap;"></span>
                                    <button type="button" class="file-chosen-remove" id="file-remove-btn"
                                        title="Hapus pilihan">
                                        <i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btn-save-surat">
                            <i class="mdi mdi-content-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ── MODAL DETAIL ── --}}
    <div class="modal fade" id="surat-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="mdi mdi-eye mr-2"></i>Detail Surat</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="surat-detail-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
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
            var baseUrl = @json(auth()->user()->isAdmin() ? route('admin.surat.index') : route('operator.surat.index'));
            var crudBase = @json(auth()->user()->isAdmin() ? url('admin/surat') : url('operator/surat'));
            var myId = @json(auth()->id());

            var rows = {};
            var editingId = null;
            var table;

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
                    length: 1000
                }, function(res) {
                    var total = res.recordsTotal;
                    var bulan = 0;
                    var saya = 0;
                    var now = new Date();

                    $.each(res.data, function(i, r) {
                        var d = new Date(r.created_at);
                        if (d.getMonth() === now.getMonth() && d.getFullYear() === now
                        .getFullYear()) bulan++;
                        if (r.pengunggah && r.pengunggah.id === myId) saya++;
                    });

                    $('#stat-total').text(total);
                    $('#stat-bulan').text(bulan);
                    $('#stat-saya').text(saya);
                });
            }

            loadStats();

            /* ── FILE ICON ── */
            function fileIcon(ext) {
                var map = {
                    pdf: '<i class="mdi mdi-file-pdf-box ext-pdf"></i>',
                    doc: '<i class="mdi mdi-file-word ext-doc"></i>',
                    docx: '<i class="mdi mdi-file-word ext-docx"></i>',
                    xls: '<i class="mdi mdi-file-excel ext-xls"></i>',
                    xlsx: '<i class="mdi mdi-file-excel ext-xlsx"></i>',
                    jpg: '<i class="mdi mdi-file-image ext-img"></i>',
                    jpeg: '<i class="mdi mdi-file-image ext-img"></i>',
                    png: '<i class="mdi mdi-file-image ext-img"></i>',
                };
                return map[ext] || '<i class="mdi mdi-file-outline" style="color:var(--gray);"></i>';
            }

            function humanSize(bytes) {
                if (!bytes) return '';
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1048576).toFixed(1) + ' MB';
            }

            /* ── DATATABLE ── */
            table = $('#surat-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: baseUrl,
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
                    [3, 'desc']
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
                        data: 'nomor_surat',
                        render: function(data) {
                            return data ?
                                '<span class="nomor-badge">' + $('<div>').text(data).html() +
                                '</span>' :
                                '<span class="nomor-kosong">— tanpa nomor —</span>';
                        }
                    },
                    {
                        data: 'perihal',
                        render: function(data) {
                            var safe = $('<div>').text(data).html();
                            return '<div style="max-width:280px;line-height:1.4;">' +
                                (safe.length > 80 ? safe.substring(0, 80) + '…' : safe) + '</div>';
                        }
                    },
                    {
                        data: 'tanggal_surat',
                        render: function(data, type) {
                            if (type === 'sort' || type === 'type') return data;
                            var d = new Date(data);
                            return d.toLocaleDateString('id-ID', {
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
                            var icon = fileIcon(row.file_ext);
                            var name = row.file_surat ? row.file_surat.split('/').pop() : '—';
                            return '<a href="' + row.file_url +
                                '" target="_blank" class="file-badge">' +
                                '<span class="file-icon">' + icon + '</span>' +
                                '<span class="file-name">' + $('<div>').text(name).html() +
                                '</span>' +
                                '</a>';
                        }
                    },
                    {
                        data: 'pengunggah',
                        render: function(data) {
                            if (!data) return '<span class="text-muted">—</span>';
                            var init = data.name ? data.name.charAt(0).toUpperCase() : '?';
                            return '<div style="display:flex;align-items:center;">' +
                                '<span class="author-av">' + init + '</span>' +
                                $('<div>').text(data.name || '').html() + '</div>';
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
                            return '<button type="button" class="btn btn-outline-info btn-sm btn-detail-surat mr-1" data-id="' +
                                row.id + '" title="Detail"><i class="mdi mdi-eye"></i></button>' +
                                '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-surat mr-1" data-id="' +
                                row.id + '" title="Edit"><i class="mdi mdi-pencil"></i></button>' +
                                '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-surat" data-id="' +
                                row.id + '" title="Hapus"><i class="mdi mdi-delete"></i></button>';
                        }
                    }
                ],
                language: {
                    search: 'Cari:',
                    processing: 'Memuat...',
                    lengthMenu: 'Tampilkan _MENU_ surat',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ surat',
                    infoEmpty: 'Tidak ada surat',
                    infoFiltered: '(difilter dari _MAX_ surat)',
                    zeroRecords: 'Surat tidak ditemukan',
                    emptyTable: 'Belum ada data surat',
                    paginate: {
                        first: '«',
                        last: '»',
                        next: '›',
                        previous: '‹'
                    }
                },
                responsive: true
            });

            /* ── PERIHAL COUNTER ── */
            $('#s-perihal').on('input', function() {
                $('#perihal-count').text($(this).val().length);
            });

            /* ── FILE PILIH ── */
            $('#s-file').on('change', function() {
                var file = this.files[0];
                if (!file) {
                    resetFileUI();
                    return;
                }

                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5 MB.');
                    this.value = '';
                    resetFileUI();
                    return;
                }

                $('#file-upload-area').hide();
                $('#file-chosen-name').text(file.name);
                $('#file-chosen-size').text(humanSize(file.size));
                $('#file-chosen').addClass('show');
            });

            $('#file-remove-btn').on('click', function() {
                $('#s-file').val('');
                resetFileUI();
            });

            function resetFileUI() {
                $('#file-upload-area').show();
                $('#file-chosen').removeClass('show');
                $('#file-chosen-name').text('—');
                $('#file-chosen-size').text('');
            }

            /* ── DRAG & DROP ── */
            var dropArea = document.getElementById('file-upload-area');
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
                        var input = document.getElementById('s-file');
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
                $('#surat-form')[0].reset();
                $('#surat-form-errors').addClass('d-none').empty();
                $('#surat-modal-title').text('Unggah Surat');
                $('#file-required-star').show();
                $('#file-optional-note').hide();
                $('#current-file-info').addClass('d-none');
                $('#s-file').prop('required', true);
                $('#perihal-count').text('0');
                resetFileUI();
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
                $('#surat-form-errors').html(msgs.join('<br>')).removeClass('d-none');
            }

            function refresh() {
                table.ajax.reload(null, false);
                loadStats();
            }

            /* ── CREATE ── */
            $('#btn-create-surat').on('click', function() {
                resetForm();
                $('#surat-modal').modal('show');
            });

            /* ── EDIT ── */
            $(document).on('click', '.btn-edit-surat', function() {
                var item = rows[$(this).data('id')];
                if (!item) return;
                resetForm();
                editingId = item.id;
                $('#surat-modal-title').text('Edit Surat');

                // Isi field
                $('#s-nomor').val(item.nomor_surat || '');
                $('#s-perihal').val(item.perihal).trigger('input');
                $('#s-tanggal').val(item.tanggal_surat);

                // File saat ini
                var ext = item.file_ext;
                var name = item.file_surat ? item.file_surat.split('/').pop() : '—';
                $('#current-file-icon').attr('class', 'mdi mdi-' +
                    (ext === 'pdf' ? 'file-pdf-box' : ext === 'doc' || ext === 'docx' ? 'file-word' :
                        ext === 'xls' || ext === 'xlsx' ? 'file-excel' :
                        ext === 'jpg' || ext === 'jpeg' || ext === 'png' ? 'file-image' :
                        'file-document'));
                $('#current-file-name').text(name);
                $('#current-file-info').removeClass('d-none');

                // File tidak wajib saat edit
                $('#file-required-star').hide();
                $('#file-optional-note').show();
                $('#s-file').prop('required', false);

                $('#surat-modal').modal('show');
            });

            /* ── DETAIL ── */
            $(document).on('click', '.btn-detail-surat', function() {
                var item = rows[$(this).data('id')];
                if (!item) return;

                var ext = item.file_ext;
                var icon = fileIcon(ext);
                var name = item.file_surat ? item.file_surat.split('/').pop() : '—';

                var html = '<div style="font-size:14px;">' +
                    '<table class="table table-sm table-bordered" style="font-size:13.5px;">' +
                    '<tbody>' +
                    '<tr><th style="width:40%;background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Nomor Surat</th>' +
                    '<td><strong>' + (item.nomor_surat ? $('<div>').text(item.nomor_surat).html() :
                        '<em class="text-muted">— tanpa nomor —</em>') + '</strong></td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Perihal</th>' +
                    '<td>' + $('<div>').text(item.perihal).html() + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Tanggal Surat</th>' +
                    '<td>' + new Date(item.tanggal_surat).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) + '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Diunggah Oleh</th>' +
                    '<td>' + (item.pengunggah ? $('<div>').text(item.pengunggah.name).html() : '—') +
                    '</td></tr>' +
                    '<tr><th style="background:#fafcfb;color:var(--gray);font-size:11px;text-transform:uppercase;letter-spacing:.7px;">Tgl Upload</th>' +
                    '<td>' + new Date(item.created_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) + '</td></tr>' +
                    '</tbody></table>' +
                    '<div style="margin-top:14px;">' +
                    '<a href="' + item.file_url +
                    '" target="_blank" class="file-badge" style="display:inline-flex;">' +
                    '<span class="file-icon">' + icon + '</span>' +
                    '<span class="file-name">' + $('<div>').text(name).html() + '</span>' +
                    '&nbsp;<i class="mdi mdi-open-in-new" style="font-size:14px;color:var(--green);"></i>' +
                    '</a>' +
                    '</div>' +
                    '</div>';

                $('#surat-detail-body').html(html);
                $('#surat-detail-modal').modal('show');
            });

            /* ── SAVE ── */
            $('#surat-form').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                if (editingId) {
                    formData.append('_method', 'PUT');
                }

                var $btn = $('#btn-save-surat').prop('disabled', true).html(
                    '<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...');
                var url = editingId ? crudBase + '/' + editingId : crudBase;

                $.ajax({
                    url: url,
                    method: 'POST', // _method=PUT dikirim via FormData untuk update
                    data: formData,
                    processData: false,
                    contentType: false,
                }).done(function(res) {
                    $('#surat-modal').modal('hide');
                    alertify.success(res.message);
                    refresh();
                }).fail(function(xhr) {
                    showErrors(xhr);
                }).always(function() {
                    $btn.prop('disabled', false).html(
                    '<i class="mdi mdi-content-save"></i> Simpan');
                });
            });

            /* ── DELETE ── */
            $(document).on('click', '.btn-delete-surat', function() {
                var id = $(this).data('id');
                var item = rows[id];
                var peri = item ? item.perihal.substring(0, 60) : 'surat ini';
                if (!confirm('Hapus surat:\n"' + peri +
                        '"\n\nFile terlampir juga akan dihapus. Tindakan ini tidak dapat dibatalkan.'))
                    return;

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
            $('#surat-modal').on('hidden.bs.modal', resetForm);
        });
    </script>
@endsection
