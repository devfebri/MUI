@extends('layouts.master')

@section('css')
<style>
    :root {
        --green:      #007f5f;
        --green-dark: #005f47;
        --green-light:#00a878;
        --green-pale: #e8f5f1;
        --gold:       #c9a84c;
        --red:        #ef4444;
        --yellow:     #f0a500;
        --blue:       #2563eb;
        --text:       #1a1a2e;
        --gray:       #6b7280;
        --bg:         #f4f7f6;
        --white:      #ffffff;
        --radius:     14px;
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
    .page-header p  { margin: 3px 0 0; font-size: 13px; color: rgba(255,255,255,.8); }

    /* STAT CARDS */
    .stat-card {
        background: var(--white); border-radius: var(--radius);
        box-shadow: var(--shadow); padding: 20px 22px;
        display: flex; align-items: center; gap: 16px;
        transition: all var(--tr); border: 1px solid transparent;
    }
    .stat-card:hover { box-shadow: var(--shadow-hov); transform: translateY(-2px); border-color: var(--green-pale); }
    .stat-icon {
        width: 52px; height: 52px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; flex-shrink: 0;
    }
    .stat-icon.green  { background: var(--green-pale); color: var(--green); }
    .stat-icon.yellow { background: #fff8e6; color: var(--yellow); }
    .stat-icon.blue   { background: #eff6ff; color: var(--blue); }
    .stat-value { font-size: 26px; font-weight: 800; color: var(--text); line-height: 1; }
    .stat-label { font-size: 12.5px; color: var(--gray); font-weight: 500; margin-top: 3px; }

    /* PANEL */
    .panel-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
    .panel-header {
        padding: 16px 22px; border-bottom: 1px solid #f0f4f3;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 10px;
    }
    .panel-header h5 {
        font-size: 15px; font-weight: 700; color: var(--text); margin: 0;
        display: flex; align-items: center; gap: 8px;
    }
    .panel-header h5 i { color: var(--green); font-size: 18px; }

    /* TABLE */
    .kat-table { width: 100%; }
    .kat-table th {
        font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        color: var(--gray); padding: 10px 14px;
        border-bottom: 2px solid #f0f4f3; background: #fafcfb; white-space: nowrap;
    }
    .kat-table td {
        padding: 12px 14px; border-bottom: 1px solid #f4f6f5;
        font-size: 13.5px; color: var(--text); vertical-align: middle;
    }
    .kat-table tr:last-child td { border-bottom: none; }
    .kat-table tr:hover td { background: #fafcfb; }

    /* NAMA CELL */
    .kat-nama-wrap {
        display: flex; align-items: center; gap: 10px;
    }
    .kat-color-dot {
        width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0;
        border: 2px solid rgba(0,0,0,.08);
    }
    .kat-nama { font-weight: 700; font-size: 14px; }
    .kat-slug { font-size: 11.5px; color: var(--gray); margin-top: 2px; }

    /* STATUS BADGE */
    .aktif-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
    }
    .aktif-badge.aktif     { background: #dcfce7; color: #16a34a; }
    .aktif-badge.nonaktif  { background: #f3f4f6; color: #6b7280; }

    /* WARNA PREVIEW */
    .warna-preview {
        display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px;
        font-family: monospace; font-weight: 600; color: var(--text);
    }
    .warna-swatch {
        width: 20px; height: 20px; border-radius: 5px;
        border: 1px solid rgba(0,0,0,.1); flex-shrink: 0;
    }

    /* MODAL */
    .modal-header {
        background: linear-gradient(135deg, var(--green), var(--green-light));
        color: #fff; padding: 16px 22px; border-radius: 0;
    }
    .modal-title { font-weight: 800; font-size: 16px; }
    .modal-header .close { color: #fff; opacity: .8; text-shadow: none; font-size: 22px; }
    .modal-header .close:hover { opacity: 1; }
    .form-group label { font-weight: 600; font-size: 13px; color: var(--text); margin-bottom: 5px; }
    .form-control:focus { border-color: var(--green); box-shadow: 0 0 0 3px rgba(0,127,95,.12); }
    .form-control { border-radius: 8px; }

    /* COLOR SWATCHES PICKER */
    .color-presets {
        display: flex; flex-wrap: wrap; gap: 8px; margin-top: 8px;
    }
    .color-preset {
        width: 28px; height: 28px; border-radius: 6px; cursor: pointer;
        border: 2px solid transparent; transition: all .2s; flex-shrink: 0;
    }
    .color-preset:hover, .color-preset.selected { border-color: var(--text); transform: scale(1.15); }

    /* TOGGLE AKTIF */
    .toggle-wrap {
        display: flex; align-items: center; gap: 10px;
    }

    .toggle-switch {
        position: relative; display: inline-block; width: 44px; height: 24px;
    }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-slider {
        position: absolute; cursor: pointer;
        inset: 0; background: #d1d5db; border-radius: 24px; transition: .3s;
    }
    .toggle-slider::before {
        content: ''; position: absolute;
        width: 18px; height: 18px; left: 3px; bottom: 3px;
        background: #fff; border-radius: 50%; transition: .3s;
        box-shadow: 0 1px 4px rgba(0,0,0,.2);
    }
    .toggle-switch input:checked + .toggle-slider { background: var(--green); }
    .toggle-switch input:checked + .toggle-slider::before { transform: translateX(20px); }
    .toggle-label { font-size: 13.5px; color: var(--text); font-weight: 500; }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 24px 28px;">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h4><i class="mdi mdi-shape" style="margin-right:8px;"></i>Manajemen Kategori</h4>
            <p>Kelola kategori berita MUI Batanghari</p>
        </div>
        <button type="button" class="btn btn-light btn-sm font-weight-bold" id="btn-create-kategori">
            <i class="mdi mdi-plus-circle"></i> Tambah Kategori
        </button>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="stat-icon green"><i class="mdi mdi-shape"></i></div>
                <div><div class="stat-value" id="stat-total">–</div><div class="stat-label">Total Kategori</div></div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="mdi mdi-check-circle"></i></div>
                <div><div class="stat-value" id="stat-aktif">–</div><div class="stat-label">Aktif</div></div>
            </div>
        </div>
        <div class="col-6 col-md-4">
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="mdi mdi-eye-off"></i></div>
                <div><div class="stat-value" id="stat-nonaktif">–</div><div class="stat-label">Nonaktif</div></div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="panel-card">
        <div class="panel-header">
            <h5><i class="mdi mdi-format-list-bulleted"></i> Daftar Kategori</h5>
            <select class="form-control form-control-sm" id="filter-aktif" style="width:150px;">
                <option value="">Semua Status</option>
                <option value="1">Aktif</option>
                <option value="0">Nonaktif</option>
            </select>
        </div>
        <div class="table-responsive" style="padding:0;">
            <table class="kat-table" id="kategori-table">
                <thead>
                    <tr>
                        <th style="width:44px;">#</th>
                        <th>Nama Kategori</th>
                        <th>Warna</th>
                        <th>Deskripsi</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL CRUD --}}
<div class="modal fade" id="kategori-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategori-modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="kategori-form">
                <div class="modal-body">
                    <div id="kategori-form-errors" class="alert alert-danger d-none"></div>
                    <div class="row">

                        {{-- Nama --}}
                        <div class="form-group col-md-6">
                            <label>Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="k-nama" name="nama"
                                maxlength="100" required placeholder="cth: Berita Utama">
                        </div>

                        {{-- Urutan --}}
                        <div class="form-group col-md-3">
                            <label>Urutan Tampil</label>
                            <input type="number" class="form-control" id="k-urutan" name="urutan"
                                min="0" value="0" placeholder="0">
                            <small class="text-muted">Angka kecil = tampil lebih dulu</small>
                        </div>

                        {{-- Status --}}
                        <div class="form-group col-md-3">
                            <label>Status</label>
                            <div class="toggle-wrap mt-2">
                                <label class="toggle-switch">
                                    <input type="checkbox" id="k-aktif" name="aktif" value="1" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                                <span class="toggle-label" id="aktif-label">Aktif</span>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group col-md-12">
                            <label>Deskripsi <small class="text-muted">(opsional)</small></label>
                            <textarea class="form-control" id="k-deskripsi" name="deskripsi"
                                rows="2" maxlength="500"
                                placeholder="Deskripsi singkat tentang kategori ini..."></textarea>
                            <div class="text-right" style="font-size:11px;color:var(--gray);margin-top:3px;">
                                <span id="deskripsi-count">0</span>/500
                            </div>
                        </div>

                        {{-- Warna --}}
                        <div class="form-group col-md-12">
                            <label>Warna Badge <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center gap-3" style="gap:12px;">
                                <input type="color" class="form-control" id="k-warna" name="warna"
                                    value="#007f5f" style="width:56px;height:40px;padding:4px;cursor:pointer;border-radius:8px;">
                                <div>
                                    <div style="font-size:12px;color:var(--gray);margin-bottom:6px;">Pilih warna cepat:</div>
                                    <div class="color-presets" id="color-presets">
                                        @foreach([
                                            '#007f5f','#16a34a','#0284c7','#7c3aed',
                                            '#dc2626','#ea580c','#d97706','#0f766e',
                                            '#c9a84c','#6b7280','#1e40af','#be185d'
                                        ] as $c)
                                        <div class="color-preset" style="background:{{ $c }};" data-color="{{ $c }}" title="{{ $c }}"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- Preview badge --}}
                            <div class="mt-3">
                                <span style="font-size:12px;color:var(--gray);">Preview badge:</span>
                                <span id="badge-preview" style="
                                    display:inline-flex; align-items:center; gap:4px;
                                    padding:3px 12px; border-radius:20px; margin-left:8px;
                                    font-size:12px; font-weight:700; color:#fff;
                                    background:#007f5f;">
                                    Kategori
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="btn-save-kategori">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(function () {
    'use strict';

    /* ── CONFIG ── */
    var baseUrl  = @json(auth()->user()->isOperator() ? route('operator.kategori.index') : route('admin.kategori.index'));
    var rows     = {};
    var editingId = null;
    var table;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept'      : 'application/json'
        }
    });

    /* ── LOAD STATS ── */
    function loadStats() {
        $.get(baseUrl, { draw:1, start:0, length:0 }, function(res) {
            $('#stat-total').text(res.recordsTotal);
        });
        ['1','0'].forEach(function(v) {
            $.get(baseUrl, { draw:1, start:0, length:0, 'search[value]': v === '1' ? 'aktif:1' : 'aktif:0' }, function(res) {
                // hitung manual dari client karena filter aktif butuh param khusus
            });
        });
        // Hitung aktif & nonaktif via tinker-style: ambil semua data max 1000
        $.get(baseUrl, { draw:1, start:0, length:1000 }, function(res) {
            var aktif    = 0;
            var nonaktif = 0;
            $.each(res.data, function(i, r) {
                if (r.aktif) aktif++; else nonaktif++;
            });
            $('#stat-aktif').text(aktif);
            $('#stat-nonaktif').text(nonaktif);
        });
    }

    loadStats();

    /* ── DATATABLE ── */
    table = $('#kategori-table').DataTable({
        processing : true,
        serverSide : true,
        ajax: {
            url : baseUrl,
            data: function(d) {
                var parts  = [];
                var search = $.trim($('#kategori-table_filter input').val());
                if (search) parts.push(search);
                d.search = { value: parts.join(' '), regex: false };
            },
            dataSrc: function(res) {
                rows = {};
                $.each(res.data, function(i, item) { rows[item.id] = item; });
                return res.data;
            }
        },
        pageLength : 10,
        lengthMenu : [[10,25,50],[10,25,50]],
        searchDelay: 400,
        order      : [[4,'asc']],  // urutan asc by default
        columns    : [
            {
                data: null, orderable: false, searchable: false,
                render: function(d,t,r,meta) { return meta.settings._iDisplayStart + meta.row + 1; }
            },
            {
                data: 'nama',
                render: function(data, type, row) {
                    if (type !== 'display') return data;
                    return '<div class="kat-nama-wrap">' +
                        '<div class="kat-color-dot" style="background:' + (row.warna || '#007f5f') + ';"></div>' +
                        '<div>' +
                            '<div class="kat-nama">' + $('<div>').text(data).html() + '</div>' +
                            '<div class="kat-slug">' + $('<div>').text(row.slug || '').html() + '</div>' +
                        '</div></div>';
                }
            },
            {
                data: 'warna',
                render: function(data) {
                    var safe = $('<div>').text(data || '#007f5f').html();
                    return '<div class="warna-preview">' +
                        '<div class="warna-swatch" style="background:' + safe + ';"></div>' +
                        safe + '</div>';
                }
            },
            {
                data: 'deskripsi',
                render: function(data) {
                    if (!data) return '<span class="text-muted" style="font-size:12px;">—</span>';
                    var safe = $('<div>').text(data).html();
                    return safe.length > 60 ? safe.substring(0,60) + '…' : safe;
                }
            },
            {
                data: 'urutan',
                render: function(data) {
                    return '<span style="font-weight:700;color:var(--green);">' + data + '</span>';
                }
            },
            {
                data: 'aktif',
                render: function(data) {
                    return data
                        ? '<span class="aktif-badge aktif"><i class="mdi mdi-check-circle"></i> Aktif</span>'
                        : '<span class="aktif-badge nonaktif"><i class="mdi mdi-minus-circle"></i> Nonaktif</span>';
                }
            },
            {
                data: 'created_at',
                render: function(data, type) {
                    if (type === 'sort' || type === 'type') return new Date(data).getTime();
                    return new Date(data).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
                }
            },
            {
                data: null, orderable: false, searchable: false,
                render: function(d,t,row) {
                    return '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-kat mr-1" data-id="' + row.id + '" title="Edit"><i class="mdi mdi-pencil"></i></button>' +
                           '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-kat" data-id="' + row.id + '" title="Hapus"><i class="mdi mdi-delete"></i></button>';
                }
            }
        ],
        language: {
            search       : 'Cari:',
            processing   : 'Memuat...',
            lengthMenu   : 'Tampilkan _MENU_ kategori',
            info         : 'Menampilkan _START_–_END_ dari _TOTAL_ kategori',
            infoEmpty    : 'Tidak ada kategori',
            infoFiltered : '(difilter dari _MAX_ kategori)',
            zeroRecords  : 'Kategori tidak ditemukan',
            emptyTable   : 'Belum ada data kategori',
            paginate     : { first:'«', last:'»', next:'›', previous:'‹' }
        },
        responsive: true
    });

    /* ── FILTER STATUS ── */
    $('#filter-aktif').on('change', function() { table.ajax.reload(); });

    /* ── WARNA PICKER ── */
    $('#k-warna').on('input change', function() {
        var c = $(this).val();
        $('#badge-preview').css('background', c);
        $('.color-preset').removeClass('selected');
        $('.color-preset[data-color="' + c + '"]').addClass('selected');
    });

    $(document).on('click', '.color-preset', function() {
        var c = $(this).data('color');
        $('#k-warna').val(c).trigger('change');
    });

    /* ── TOGGLE AKTIF LABEL ── */
    $('#k-aktif').on('change', function() {
        $('#aktif-label').text(this.checked ? 'Aktif' : 'Nonaktif');
    });

    /* ── DESKRIPSI COUNTER ── */
    $('#k-deskripsi').on('input', function() {
        $('#deskripsi-count').text($(this).val().length);
    });

    /* ── HELPERS ── */
    function resetForm() {
        editingId = null;
        $('#kategori-form')[0].reset();
        $('#kategori-form-errors').addClass('d-none').empty();
        $('#kategori-modal-title').text('Tambah Kategori');
        $('#k-warna').val('#007f5f').trigger('change');
        $('#k-aktif').prop('checked', true);
        $('#aktif-label').text('Aktif');
        $('#k-urutan').val('0');
        $('#deskripsi-count').text('0');
        $('.color-preset').removeClass('selected');
        $('.color-preset[data-color="#007f5f"]').addClass('selected');
    }

    function showErrors(xhr) {
        var msgs = [];
        if (xhr.responseJSON && xhr.responseJSON.errors) {
            $.each(xhr.responseJSON.errors, function(k, arr) { msgs = msgs.concat(arr); });
        } else if (xhr.responseJSON && xhr.responseJSON.message) {
            msgs.push(xhr.responseJSON.message);
        }
        $('#kategori-form-errors')
            .html(msgs.length ? msgs.join('<br>') : 'Terjadi kesalahan.')
            .removeClass('d-none');
    }

    function refresh() { table.ajax.reload(null, false); loadStats(); }

    /* ── CREATE ── */
    $('#btn-create-kategori').on('click', function() {
        resetForm();
        $('#kategori-modal').modal('show');
    });

    /* ── EDIT ── */
    $(document).on('click', '.btn-edit-kat', function() {
        var item = rows[$(this).data('id')];
        if (!item) return;
        resetForm();
        editingId = item.id;
        $('#kategori-modal-title').text('Edit Kategori');
        $('#k-nama').val(item.nama);
        $('#k-urutan').val(item.urutan);
        $('#k-deskripsi').val(item.deskripsi || '').trigger('input');
        $('#k-warna').val(item.warna || '#007f5f').trigger('change');
        $('#k-aktif').prop('checked', !!item.aktif);
        $('#aktif-label').text(item.aktif ? 'Aktif' : 'Nonaktif');
        // mark preset
        $('.color-preset').removeClass('selected');
        $('.color-preset[data-color="' + (item.warna || '#007f5f') + '"]').addClass('selected');
        $('#kategori-modal').modal('show');
    });

    /* ── SAVE ── */
    $('#kategori-form').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serializeArray();
        // Pastikan aktif terkirim (checkbox tidak ikut jika unchecked)
        var hasAktif = formData.some(function(f){ return f.name === 'aktif'; });
        if (!hasAktif) formData.push({ name: 'aktif', value: '0' });

        var $btn = $('#btn-save-kategori').prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...');
        var url    = editingId ? baseUrl + '/' + editingId : baseUrl;
        var method = editingId ? 'PUT' : 'POST';

        $.ajax({
            url    : url,
            method : method,
            data   : $.param(formData)
        }).done(function(res) {
            $('#kategori-modal').modal('hide');
            alertify.success(res.message);
            refresh();
        }).fail(function(xhr) {
            showErrors(xhr);
        }).always(function() {
            $btn.prop('disabled', false).html('<i class="mdi mdi-content-save"></i> Simpan');
        });
    });

    /* ── DELETE ── */
    $(document).on('click', '.btn-delete-kat', function() {
        var id   = $(this).data('id');
        var item = rows[id];
        var nama = item ? item.nama : 'kategori ini';
        if (!confirm('Hapus kategori "' + nama + '"?\n\nTindakan ini tidak dapat dibatalkan.')) return;

        $.ajax({ url: baseUrl + '/' + id, method: 'DELETE' })
            .done(function(res) { alertify.success(res.message); refresh(); })
            .fail(function(xhr) { alertify.error(xhr.responseJSON ? xhr.responseJSON.message : 'Gagal menghapus.'); });
    });

    /* ── RESET MODAL ON CLOSE ── */
    $('#kategori-modal').on('hidden.bs.modal', resetForm);

    /* ── INIT COLOR PRESET DEFAULT ── */
    $('.color-preset[data-color="#007f5f"]').addClass('selected');
});
</script>
@endsection
