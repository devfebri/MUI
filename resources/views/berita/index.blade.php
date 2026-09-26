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
            --yellow: #f0a500;
            --blue: #2563eb;
            --text: #1a1a2e;
            --gray: #6b7280;
            --bg: #f4f7f6;
            --white: #ffffff;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(0, 0, 0, .07);
            --shadow-hov: 0 8px 32px rgba(0, 127, 95, .16);
            --tr: .22s cubic-bezier(.4, 0, .2, 1);
        }

        body {
            background: var(--bg) !important;
        }

        /* PAGE HEADER */
        .page-header {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
            border-radius: var(--radius);
            padding: 24px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            color: #fff;
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

        /* STAT CARDS */
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all var(--tr);
            border: 1px solid transparent;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-hov);
            transform: translateY(-2px);
            border-color: var(--green-pale);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
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

        .stat-icon.yellow {
            background: #fff8e6;
            color: var(--yellow);
        }

        .stat-icon.blue {
            background: #eff6ff;
            color: var(--blue);
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
            font-weight: 500;
            margin-top: 3px;
        }

        /* PANEL */
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

        /* TABLE */
        .news-table {
            width: 100%;
        }

        .news-table th {
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

        .news-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f4f6f5;
            font-size: 13.5px;
            color: var(--text);
            vertical-align: middle;
        }

        .news-table tr:last-child td {
            border-bottom: none;
        }

        .news-table tr:hover td {
            background: #fafcfb;
        }

        .news-title-cell {
            max-width: 280px;
            font-weight: 600;
            line-height: 1.4;
        }

        /* BADGES */
        .kat-badge,
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .kat-badge {
            background: var(--green-pale);
            color: var(--green);
        }

        .status-badge.published {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-badge.draft {
            background: #fef9c3;
            color: #a16207;
        }

        .status-badge.archived {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* MODAL */
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

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(0, 127, 95, .12);
        }

        /* Quill */
        #quill-editor {
            min-height: 220px;
            background: #fff;
            font-size: 14px;
        }

        .ql-toolbar {
            border-radius: 6px 6px 0 0 !important;
            border-color: #dee2e6 !important;
        }

        .ql-container {
            border-color: #dee2e6 !important;
            border-radius: 0 0 6px 6px !important;
        }

        .char-count {
            font-size: 11px;
            color: var(--gray);
            text-align: right;
            margin-top: 3px;
        }

        /* Author avatar */
        .author-av {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--green-pale);
            color: var(--green);
            font-size: 12px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 6px;
        }
    </style>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid" style="padding:24px 28px;">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <h4><i class="mdi mdi-newspaper" style="margin-right:8px;"></i>Manajemen Berita</h4>
                <p>Kelola semua artikel berita MUI Digital</p>
            </div>
            @php
                $createRoute = auth()->user()->isAdmin() ? 'admin.berita.create' : 'operator.berita.create';
            @endphp
            <a href="{{ route($createRoute) }}" class="btn btn-light btn-sm font-weight-bold">
                <i class="mdi mdi-plus-circle"></i> Tambah Berita
            </a>
        </div>

        {{-- STAT CARDS --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon green"><i class="mdi mdi-newspaper"></i></div>
                    <div>
                        <div class="stat-value" id="stat-total">–</div>
                        <div class="stat-label">Total Berita</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="mdi mdi-check-circle"></i></div>
                    <div>
                        <div class="stat-value" id="stat-published">–</div>
                        <div class="stat-label">Dipublikasi</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon yellow"><i class="mdi mdi-pencil-box"></i></div>
                    <div>
                        <div class="stat-value" id="stat-draft">–</div>
                        <div class="stat-label">Draft</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-icon red"><i class="mdi mdi-archive"></i></div>
                    <div>
                        <div class="stat-value" id="stat-archived">–</div>
                        <div class="stat-label">Diarsipkan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="panel-card">
            <div class="panel-header">
                <h5><i class="mdi mdi-format-list-bulleted"></i> Daftar Berita</h5>
                <div class="d-flex align-items-center" style="gap:8px;flex-wrap:wrap;">
                    <select class="form-control form-control-sm" id="filter-status" style="width:140px;">
                        <option value="">Semua Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Archived</option>
                    </select>
                    <select class="form-control form-control-sm" id="filter-kategori" style="width:160px;">
                        <option value="">Semua Kategori</option>
                        @foreach (['Berita Utama', 'Fatwa', 'Bimbingan', 'Halal', 'Khutbah', 'Opini', 'Nasional', 'Internasional', 'Ekonomi', 'Teknologi', 'Sosial', 'Kabar Daerah'] as $kat)
                            <option value="{{ $kat }}">{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive" style="padding:0;">
                <table class="news-table" id="berita-table">
                    <thead>
                        <tr>
                            <th style="width:44px;">#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Penulis</th>
                            <th>Tgl Dibuat</th>
                            <th style="width:110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CRUD --}}
    <div class="modal fade" id="berita-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="berita-modal-title">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="berita-form">
                    <div class="modal-body">
                        <div id="berita-form-errors" class="alert alert-danger d-none"></div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="b-judul" name="judul" maxlength="255"
                                    required placeholder="Masukkan judul berita...">
                                <div class="char-count"><span id="judul-count">0</span>/255 karakter</div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Kategori <span class="text-danger">*</span></label>
                                <select class="form-control" id="b-kategori" name="kategori" required>
                                    <option value="">— Pilih Kategori —</option>
                                    @foreach (['Berita Utama', 'Fatwa', 'Bimbingan', 'Halal', 'Khutbah', 'Opini', 'Nasional', 'Internasional', 'Ekonomi', 'Teknologi', 'Sosial', 'Kabar Daerah'] as $kat)
                                        <option value="{{ $kat }}">{{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="form-control" id="b-status" name="status" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4" id="published-at-group" style="display:none;">
                                <label>Tanggal Publikasi</label>
                                <input type="datetime-local" class="form-control" id="b-published-at"
                                    name="published_at">
                                <small class="text-muted">Kosongkan = otomatis waktu sekarang</small>
                            </div>

                            <div class="form-group col-12">
                                <label>Isi Berita <span class="text-danger">*</span></label>
                                <div id="quill-editor"></div>
                                <input type="hidden" id="b-isi" name="isi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btn-save-berita">
                            <i class="mdi mdi-content-save"></i> Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div class="modal fade" id="berita-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="mdi mdi-eye mr-2"></i>Detail Berita</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="berita-detail-body"></div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        $(function() {
            'use strict';

            /* ── CONFIG ─────────────────────────────── */
            var isAdmin  = @json(auth()->user()->isAdmin());
            var indexUrl = @json(auth()->user()->isAdmin() ? route('admin.berita.index') : route('operator.berita.index'));
            var crudBase = @json(auth()->user()->isAdmin() ? url('admin/berita') : url('operator/berita'));

            var rows = {};
            var editingId = null;
            var table;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            });

            /* ── QUILL ────────────────────────────── */
            var quill = new Quill('#quill-editor', {
                theme: 'snow',
                placeholder: 'Tulis isi berita di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
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
                            align: []
                        }],
                        ['blockquote', 'code-block'],
                        ['link'],
                        ['clean']
                    ]
                }
            });

            /* ── CHAR COUNTER ─────────────────────── */
            $('#b-judul').on('input', function() {
                $('#judul-count').text($(this).val().length);
            });

            /* ── STATUS → toggle published_at ─────── */
            $('#b-status').on('change', function() {
                $('#published-at-group').toggle($(this).val() === 'published');
            });

            /* ── LOAD STATS ───────────────────────── */
            function loadStats() {
                $.get(indexUrl, {
                    draw: 1,
                    start: 0,
                    length: 0
                }, function(res) {
                    $('#stat-total').text(res.recordsTotal);
                });

                ['published', 'draft', 'archived'].forEach(function(s) {
                    $.get(indexUrl, {
                        draw: 1,
                        start: 0,
                        length: 0,
                        'search[value]': s
                    }, function(res) {
                        $('#stat-' + s).text(res.recordsFiltered);
                    });
                });
            }

            loadStats();

            /* ── DATATABLE ────────────────────────── */
            table = $('#berita-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: indexUrl,
                    data: function(d) {
                        var parts = [];
                        var search = $.trim($('#berita-table_filter input').val());
                        var status = $('#filter-status').val();
                        var kat = $('#filter-kategori').val();
                        if (search) parts.push(search);
                        if (status) parts.push(status);
                        if (kat) parts.push(kat);
                        d.search = {
                            value: parts.join(' '),
                            regex: false
                        };
                    },
                    dataSrc: function(res) {
                        rows = {};
                        $.each(res.data, function(i, item) {
                            rows[item.id] = item;
                        });
                        return res.data;
                    }
                },
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                searchDelay: 500,
                order: [
                    [5, 'desc']
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
                        render: function(data, type, row) {
                            if (type !== 'display') return data;
                            var safe = $('<div>').text(data).html();
                            return '<div class="news-title-cell">' +
                                '<a href="#" class="btn-detail-berita" data-id="' + row.id +
                                '" style="font-weight:600;color:#1a1a2e;">' + safe + '</a>' +
                                '</div>';
                        }
                    },
                    {
                        data: 'kategori',
                        render: function(data) {
                            return '<span class="kat-badge">' + $('<div>').text(data).html() +
                                '</span>';
                        }
                    },
                    {
                        data: 'status',
                        render: function(data) {
                            var icon = {
                                published: 'check-circle',
                                draft: 'pencil-box',
                                archived: 'archive'
                            };
                            var label = {
                                published: 'Published',
                                draft: 'Draft',
                                archived: 'Archived'
                            };
                            return '<span class="status-badge ' + data + '">' +
                                '<i class="mdi mdi-' + (icon[data] || 'help') + '"></i> ' +
                                (label[data] || data) + '</span>';
                        }
                    },
                    {
                        data: 'penulis',
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
                            var editUrl = crudBase + '/' + row.id + '/edit';
                            return '<button type="button" class="btn btn-outline-info btn-sm btn-detail-berita mr-1" data-id="' +
                                row.id + '" title="Detail"><i class="mdi mdi-eye"></i></button>' +
                                '<a href="' + editUrl + '" class="btn btn-outline-primary btn-sm mr-1" title="Edit"><i class="mdi mdi-pencil"></i></a>' +
                                '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-berita" data-id="' +
                                row.id + '" title="Hapus"><i class="mdi mdi-delete"></i></button>';
                        }
                    }
                ],
                language: {
                    search: 'Cari:',
                    processing: 'Memuat data...',
                    lengthMenu: 'Tampilkan _MENU_ berita',
                    info: 'Menampilkan _START_–_END_ dari _TOTAL_ berita',
                    infoEmpty: 'Tidak ada berita',
                    infoFiltered: '(difilter dari _MAX_ berita)',
                    zeroRecords: 'Berita tidak ditemukan',
                    emptyTable: 'Belum ada data berita',
                    paginate: {
                        first: '«',
                        last: '»',
                        next: '›',
                        previous: '‹'
                    }
                },
                responsive: true
            });

            $('#filter-status, #filter-kategori').on('change', function() {
                table.ajax.reload();
            });

            /* ── HELPERS ──────────────────────────── */
            function resetForm() {
                editingId = null;
                $('#berita-form')[0].reset();
                $('#berita-form-errors').addClass('d-none').empty();
                $('#berita-modal-title').text('Tambah Berita');
                $('#judul-count').text('0');
                $('#b-status').val('draft').trigger('change');
                quill.setContents([]);
                $('#b-isi').val('');
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
                $('#berita-form-errors')
                    .html(msgs.length ? msgs.join('<br>') : 'Terjadi kesalahan.')
                    .removeClass('d-none');
            }

            function refresh() {
                table.ajax.reload(null, false);
                loadStats();
            }

            /* ── CREATE ───────────────────────────── */
            $('#btn-create-berita').on('click', function() {
                resetForm();
                $('#berita-modal').modal('show');
            });

            /* ── EDIT ─────────────────────────────── */
            $(document).on('click', '.btn-edit-berita', function() {
                var item = rows[$(this).data('id')];
                if (!item) return;
                resetForm();
                editingId = item.id;
                $('#berita-modal-title').text('Edit Berita');
                $('#b-judul').val(item.judul).trigger('input');
                $('#b-kategori').val(item.kategori);
                $('#b-status').val(item.status).trigger('change');
                if (item.published_at) {
                    var dt = new Date(item.published_at);
                    var pad = function(n) {
                        return n.toString().padStart(2, '0');
                    };
                    $('#b-published-at').val(
                        dt.getFullYear() + '-' + pad(dt.getMonth() + 1) + '-' + pad(dt.getDate()) +
                        'T' + pad(dt.getHours()) + ':' + pad(dt.getMinutes())
                    );
                }
                quill.clipboard.dangerouslyPasteHTML(item.isi || '');
                $('#b-isi').val(item.isi || '');
                $('#berita-modal').modal('show');
            });

            /* ── SAVE ─────────────────────────────── */
            $('#berita-form').on('submit', function(e) {
                e.preventDefault();
                var html = quill.root.innerHTML.trim();
                if (html === '<p><br></p>' || html === '') {
                    $('#berita-form-errors').text('Isi berita wajib diisi.').removeClass('d-none');
                    return;
                }
                $('#b-isi').val(html);

                var $btn = $('#btn-save-berita').prop('disabled', true).html(
                    '<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...');
                var url = editingId ? crudBase + '/' + editingId : crudBase;
                var method = editingId ? 'PUT' : 'POST';

                $.ajax({
                        url: url,
                        method: method,
                        data: $(this).serialize()
                    })
                    .done(function(res) {
                        $('#berita-modal').modal('hide');
                        alertify.success(res.message);
                        refresh();
                    })
                    .fail(showErrors)
                    .always(function() {
                        $btn.prop('disabled', false).html(
                            '<i class="mdi mdi-content-save"></i> Simpan Berita');
                    });
            });

            /* ── DELETE ───────────────────────────── */
            $(document).on('click', '.btn-delete-berita', function() {
                var id = $(this).data('id');
                var item = rows[id];
                var judul = item ? item.judul : 'berita ini';
                if (!confirm('Hapus "' + judul + '"?\n\nTindakan ini tidak dapat dibatalkan.')) return;

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

            /* ── DETAIL ───────────────────────────── */
            $(document).on('click', '.btn-detail-berita', function(e) {
                e.preventDefault();
                var item = rows[$(this).data('id')];
                if (!item) return;

                var tanggal = item.created_at ?
                    new Date(item.created_at).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    }) :
                    '—';
                var pubDate = item.published_at ?
                    new Date(item.published_at).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    }) :
                    '—';
                var author = item.penulis ? item.penulis.name : '—';

                $('#berita-detail-body').html(
                    '<div class="mb-3 pb-2 border-bottom">' +
                    '<span class="kat-badge">' + $('<div>').text(item.kategori).html() + '</span> ' +
                    '<span class="status-badge ' + item.status +
                    ' ml-1"><i class="mdi mdi-circle"></i> ' + item.status + '</span>' +
                    '</div>' +
                    '<h5 style="font-weight:800;margin-bottom:12px;">' + $('<div>').text(item.judul)
                    .html() + '</h5>' +
                    '<div class="d-flex flex-wrap mb-3" style="gap:16px;font-size:12.5px;color:#6b7280;">' +
                    '<span><i class="mdi mdi-account mr-1"></i>' + $('<div>').text(author).html() +
                    '</span>' +
                    '<span><i class="mdi mdi-calendar mr-1"></i>' + tanggal + '</span>' +
                    '<span><i class="mdi mdi-publish mr-1"></i>' + pubDate + '</span>' +
                    '</div>' +
                    '<hr>' +
                    '<div style="line-height:1.8;font-size:14.5px;margin-top:12px;">' + (item.isi ||
                        '<em class="text-muted">Tidak ada konten.</em>') + '</div>'
                );
                $('#berita-detail-modal').modal('show');
            });

            /* ── RESET ON CLOSE ───────────────────── */
            $('#berita-modal').on('hidden.bs.modal', resetForm);
        });
    </script>
@endsection
