@extends('layouts.master')

@section('css')
<style>
    :root {
        --green:      #007f5f;
        --green-dark: #005f47;
        --green-light:#00a878;
        --green-pale: #e8f5f1;
        --gold:       #c9a84c;
        --gold-pale:  #fff8e6;
        --red:        #ef4444;
        --text:       #1a1a2e;
        --gray:       #6b7280;
        --bg:         #f4f7f6;
        --white:      #ffffff;
        --border:     #e5e7eb;
        --radius:     14px;
        --shadow:     0 2px 16px rgba(0,0,0,.07);
        --shadow-hov: 0 8px 32px rgba(0,127,95,.14);
        --tr:         .22s cubic-bezier(.4,0,.2,1);
    }

    body { background: var(--bg) !important; }

    /* ── PAGE HEADER ── */
    .page-header {
        background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 60%, var(--green-light) 100%);
        border-radius: var(--radius); padding: 22px 28px; margin-bottom: 24px;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
        position: relative; overflow: hidden;
    }
    .page-header::before {
        content: 'تصنيف';
        position: absolute; right: 28px; top: 50%; transform: translateY(-50%);
        font-family: 'serif'; font-size: 80px; color: rgba(255,255,255,.06); pointer-events: none;
        line-height: 1;
    }
    .page-header h4 { font-size: 20px; font-weight: 800; margin: 0; color: #fff; position: relative; }
    .page-header p  { margin: 3px 0 0; font-size: 13px; color: rgba(255,255,255,.8); position: relative; }

    /* ── STAT CARDS ── */
    .stat-card {
        background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow);
        padding: 18px 20px; display: flex; align-items: center; gap: 14px;
        transition: all var(--tr); border: 1px solid transparent;
    }
    .stat-card:hover { box-shadow: var(--shadow-hov); transform: translateY(-2px); border-color: var(--green-pale); }
    .stat-icon {
        width: 50px; height: 50px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .stat-icon.green  { background: var(--green-pale); color: var(--green); }
    .stat-icon.gold   { background: var(--gold-pale);  color: var(--gold);  }
    .stat-icon.red    { background: #fef2f2;            color: var(--red);   }
    .stat-icon.blue   { background: #eff6ff;            color: #2563eb;      }
    .stat-value { font-size: 26px; font-weight: 800; color: var(--text); line-height: 1; }
    .stat-label { font-size: 12.5px; color: var(--gray); margin-top: 3px; }

    /* ── FILTER BAR ── */
    .filter-bar {
        background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow);
        padding: 12px 20px; margin-bottom: 20px;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .filter-pills-wrap { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
    .filter-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px; border-radius: 20px; font-size: 12.5px; font-weight: 600;
        cursor: pointer; transition: all var(--tr);
        background: #f3f4f6; color: var(--gray); border: 1px solid transparent;
    }
    .filter-pill:hover { background: #e5e7eb; color: var(--text); }
    .filter-pill.active { background: var(--green); color: #fff; }
    .filter-pill.active-red { background: var(--red); color: #fff; }

    /* ── PANEL / TABLE ── */
    .panel-card {
        background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow);
        overflow: hidden; border: 1px solid var(--border);
    }
    .panel-header {
        padding: 18px 24px; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
    }
    .panel-header h5 { margin: 0; font-size: 15px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 8px; }

    .kategori-table { width: 100% !important; border-collapse: collapse; }
    .kategori-table thead th {
        background: #f8fafc; color: var(--gray); font-size: 11.5px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .6px; padding: 12px 16px;
        border-bottom: 2px solid var(--border); border-top: none;
    }
    .kategori-table tbody td {
        padding: 13px 16px; vertical-align: middle; border-bottom: 1px solid #f1f5f9;
        font-size: 13px; color: var(--text);
    }
    .kategori-table tbody tr:hover { background: #fbfdfc; }

    /* Badges */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700; cursor: pointer;
    }
    .status-badge.aktif { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .status-badge.nonaktif { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }

    .count-badge {
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--green-pale); color: var(--green-dark);
        font-weight: 700; font-size: 12px; border-radius: 8px; padding: 3px 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding:24px 28px;">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h4><i class="mdi mdi-tag-multiple-outline mr-2"></i>Kategori Fatwa</h4>
            <p>Kelola klasifikasi dan kategori fatwa MUI Digital</p>
        </div>
        <div>
            <button type="button" class="btn btn-light btn-sm font-weight-bold" id="btn-create-kategori">
                <i class="mdi mdi-plus-circle mr-1"></i> Tambah Kategori
            </button>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="mdi mdi-tag-multiple"></i></div>
                <div>
                    <div class="stat-value" id="stat-total">{{ $total }}</div>
                    <div class="stat-label">Total Kategori</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="mdi mdi-check-circle"></i></div>
                <div>
                    <div class="stat-value" id="stat-aktif" style="color:var(--green);">{{ $aktif }}</div>
                    <div class="stat-label">Kategori Aktif</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon red"><i class="mdi mdi-close-circle"></i></div>
                <div>
                    <div class="stat-value" id="stat-nonaktif" style="color:var(--red);">{{ $nonaktif }}</div>
                    <div class="stat-label">Nonaktif</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon gold"><i class="mdi mdi-book-open-variant"></i></div>
                <div>
                    <div class="stat-value" id="stat-fatwa" style="color:var(--gold);">{{ $totalFatwa }}</div>
                    <div class="stat-label">Fatwa Terkategori</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <div class="filter-pills-wrap">
            <label class="mb-0 text-muted font-weight-bold" style="font-size:12.5px;"><i class="mdi mdi-filter-variant mr-1"></i> Filter Status:</label>
            <span class="filter-pill active" data-filter="">Semua</span>
            <span class="filter-pill" data-filter="1">
                <i class="mdi mdi-check-circle"></i> Aktif
            </span>
            <span class="filter-pill" data-filter="0">
                <i class="mdi mdi-close-circle"></i> Nonaktif
            </span>
        </div>
        <div>
            <a href="{{ auth()->user()->isAdmin() ? route('admin.fatwa.index') : route('operator.fatwa.index') }}" class="btn btn-outline-success btn-sm">
                <i class="mdi mdi-arrow-left mr-1"></i> Kembali ke Daftar Fatwa
            </a>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="panel-card">
        <div class="panel-header">
            <h5><i class="mdi mdi-format-list-bulleted"></i> Daftar Kategori Fatwa</h5>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-refresh" title="Muat Ulang">
                <i class="mdi mdi-refresh"></i> Refresh
            </button>
        </div>
        <div class="table-responsive" style="padding:0;">
            <table class="kategori-table" id="kategori-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th style="width:110px; text-align:center;">Jumlah Fatwa</th>
                        <th style="width:100px;">Status</th>
                        <th style="width:110px;">Tgl Dibuat</th>
                        <th style="width:90px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

{{-- ════ MODAL FORM TAMBAH / EDIT KATEGORI FATWA ════ --}}
<div class="modal fade" id="kategori-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: var(--radius); border:none; box-shadow: 0 10px 40px rgba(0,0,0,.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--green-dark), var(--green)); color: #fff; border-top-left-radius: var(--radius); border-top-right-radius: var(--radius);">
                <h5 class="modal-title font-weight-bold" id="kategori-modal-title" style="font-size: 16px;">Tambah Kategori Fatwa</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="kategori-form">
                <div class="modal-body" style="padding: 22px;">
                    <div id="kategori-form-errors" class="alert alert-danger d-none" style="border-radius: 8px;"></div>

                    {{-- Nama Kategori --}}
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="k-nama" name="nama" maxlength="150" required
                               placeholder="cth: Akidah & Ibadah, Ekonomi Syariah, Produk Halal" style="border-radius: 8px;">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small">Deskripsi / Ruang Lingkup</label>
                        <textarea class="form-control" id="k-deskripsi" name="deskripsi" rows="3" maxlength="500"
                                  placeholder="Keterangan singkat tentang lingkup fatwa yang masuk dalam kategori ini..." style="border-radius: 8px;"></textarea>
                        <small class="text-muted"><span id="deskripsi-count">0</span> / 500 karakter</small>
                    </div>

                    {{-- Status Aktif --}}
                    <div class="form-group mb-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="k-aktif" checked>
                            <label class="custom-control-label font-weight-bold small text-dark" for="k-aktif" id="k-aktif-label">
                                Status: Aktif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f8fafc; border-bottom-left-radius: var(--radius); border-bottom-right-radius: var(--radius);">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm font-weight-bold" id="btn-save-kategori">
                        <i class="mdi mdi-content-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    'use strict';

    var baseUrl  = @json(auth()->user()->isAdmin() ? route('admin.kategori-fatwa.index') : route('operator.kategori-fatwa.index'));
    var crudBase = @json(auth()->user()->isAdmin() ? url('admin/kategori-fatwa') : url('operator/kategori-fatwa'));

    var table;
    var rows = {};
    var editingId = null;
    var filterAktifVal = '';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    /* ── INISIALISASI DATATABLE ── */
    table = $('#kategori-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl,
            data: function(d) {
                d.filter_aktif = filterAktifVal;
            },
            dataSrc: function(res) {
                rows = {};
                $.each(res.data, function(i, r) { rows[r.id] = r; });
                return res.data;
            }
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50], [10, 25, 50]],
        searchDelay: 400,
        order: [[1, 'asc']],
        columns: [
            {
                data: null, orderable: false, searchable: false,
                render: function(d, t, r, meta) { return meta.settings._iDisplayStart + meta.row + 1; }
            },
            {
                data: 'nama',
                render: function(data) {
                    return '<strong>' + $('<div>').text(data).html() + '</strong>';
                }
            },
            {
                data: 'slug',
                render: function(data) {
                    return '<code style="color:var(--green-dark);">' + $('<div>').text(data).html() + '</code>';
                }
            },
            {
                data: 'deskripsi',
                render: function(data) {
                    if (!data) return '<span class="text-muted" style="font-size:12px;">—</span>';
                    var safe = $('<div>').text(data).html();
                    return '<div style="max-width:240px; font-size:12.5px; color:var(--gray); overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="' + safe + '">' + safe + '</div>';
                }
            },
            {
                data: 'fatwas_count',
                orderable: true,
                className: 'text-center',
                render: function(data) {
                    return '<span class="count-badge">' + (data || 0) + ' Fatwa</span>';
                }
            },
            {
                data: 'aktif',
                orderable: true,
                render: function(data, type, row) {
                    if (type !== 'display') return data;
                    var cls = data === 1 ? 'aktif' : 'nonaktif';
                    var icon = data === 1 ? 'mdi-check-circle' : 'mdi-close-circle';
                    var label = data === 1 ? 'Aktif' : 'Nonaktif';
                    return '<span class="status-badge ' + cls + ' btn-toggle-status" data-id="' + row.id + '" title="Klik untuk ubah status">' +
                           '<i class="mdi ' + icon + '"></i> ' + label + '</span>';
                }
            },
            {
                data: 'created_at',
                render: function(data) {
                    return '<span style="font-size:12px; color:var(--gray);">' + (data || '—') + '</span>';
                }
            },
            {
                data: null, orderable: false, searchable: false,
                render: function(d, t, row) {
                    return '<div class="d-flex justify-content-center gap-1">' +
                           '<button class="btn btn-outline-primary btn-sm mr-1 btn-edit-kategori" data-id="' + row.id + '" title="Edit">' +
                           '<i class="mdi mdi-pencil"></i></button>' +
                           '<button class="btn btn-outline-danger btn-sm btn-delete-kategori" data-id="' + row.id + '" title="Hapus">' +
                           '<i class="mdi mdi-delete"></i></button>' +
                           '</div>';
                }
            }
        ],
        language: {
            search: 'Cari:',
            processing: 'Memuat data...',
            lengthMenu: 'Tampilkan _MENU_ kategori',
            info: 'Menampilkan _START_–_END_ dari _TOTAL_ kategori',
            infoEmpty: 'Tidak ada kategori',
            infoFiltered: '(difilter dari _MAX_ total kategori)',
            zeroRecords: 'Kategori tidak ditemukan',
            emptyTable: 'Belum ada data kategori fatwa',
            paginate: { first: '«', last: '»', next: '›', previous: '‹' }
        },
        responsive: true
    });

    /* ── FILTER PILLS ── */
    $(document).on('click', '.filter-pill', function() {
        $('.filter-pill').removeClass('active active-red');
        var raw = $(this).attr('data-filter');
        filterAktifVal = (raw !== undefined && raw !== null) ? raw.toString() : '';
        if (filterAktifVal === '0') $(this).addClass('active-red');
        else $(this).addClass('active');
        table.ajax.reload(null, false);
    });

    /* ── REFRESH BUTTON ── */
    $('#btn-refresh').on('click', function() {
        table.ajax.reload(null, false);
    });

    /* ── CHARACTER COUNTER ── */
    $('#k-deskripsi').on('input', function() {
        $('#deskripsi-count').text($(this).val().length);
    });

    /* ── TOGGLE ACTIVE SWITCH LABEL ── */
    $('#k-aktif').on('change', function() {
        $('#k-aktif-label').text($(this).is(':checked') ? 'Status: Aktif' : 'Status: Nonaktif');
    });

    /* ── RESET FORM ── */
    function resetForm() {
        editingId = null;
        $('#kategori-form')[0].reset();
        $('#kategori-form-errors').addClass('d-none').empty();
        $('#kategori-modal-title').text('Tambah Kategori Fatwa');
        $('#k-aktif').prop('checked', true);
        $('#k-aktif-label').text('Status: Aktif');
        $('#deskripsi-count').text(0);
    }

    /* ── BUKA MODAL TAMBAH ── */
    $('#btn-create-kategori').on('click', function() {
        resetForm();
        $('#kategori-modal').modal('show');
    });

    /* ── BUKA MODAL EDIT ── */
    $(document).on('click', '.btn-edit-kategori', function() {
        var id = $(this).data('id');
        var item = rows[id];
        if (!item) return;

        resetForm();
        editingId = id;
        $('#kategori-modal-title').text('Edit Kategori Fatwa');

        $('#k-nama').val(item.nama);
        $('#k-deskripsi').val(item.deskripsi || '');
        $('#deskripsi-count').text((item.deskripsi || '').length);

        var isAktif = item.aktif === 1;
        $('#k-aktif').prop('checked', isAktif);
        $('#k-aktif-label').text(isAktif ? 'Status: Aktif' : 'Status: Nonaktif');

        $('#kategori-modal').modal('show');
    });

    /* ── SUBMIT AJAX FORM SIMPAN / EDIT ── */
    $('#kategori-form').on('submit', function(e) {
        e.preventDefault();
        $('#kategori-form-errors').addClass('d-none').empty();

        var $btn = $('#btn-save-kategori').prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...');

        var payload = {
            nama: $('#k-nama').val(),
            deskripsi: $('#k-deskripsi').val(),
            aktif: $('#k-aktif').is(':checked') ? 1 : 0
        };

        var url = editingId ? (crudBase + '/' + editingId) : crudBase;
        var method = editingId ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            method: method,
            data: payload
        }).done(function(res) {
            $('#kategori-modal').modal('hide');
            alertify.success(res.message);
            table.ajax.reload(null, false);
            updateStats();
        }).fail(function(xhr) {
            var msg = 'Terjadi kesalahan validasi.';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var list = '<ul>';
                $.each(xhr.responseJSON.errors, function(k, v) {
                    list += '<li>' + v[0] + '</li>';
                });
                list += '</ul>';
                $('#kategori-form-errors').html(list).removeClass('d-none');
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                $('#kategori-form-errors').html(xhr.responseJSON.message).removeClass('d-none');
            } else {
                alertify.error(msg);
            }
        }).always(function() {
            $btn.prop('disabled', false).html('<i class="mdi mdi-content-save mr-1"></i> Simpan');
        });
    });

    /* ── TOGGLE STATUS INLINE KLIK ── */
    $(document).on('click', '.btn-toggle-status', function() {
        var id = $(this).data('id');
        $.ajax({
            url: crudBase + '/' + id + '/toggle-status',
            method: 'PATCH'
        }).done(function(res) {
            alertify.success(res.message);
            table.ajax.reload(null, false);
            updateStats();
        }).fail(function() {
            alertify.error('Gagal memperbarui status kategori.');
        });
    });

    /* ── HAPUS DATA KATEGORI ── */
    $(document).on('click', '.btn-delete-kategori', function() {
        var id = $(this).data('id');
        var item = rows[id];
        var nama = item ? item.nama : 'kategori ini';

        if (item && item.fatwas_count > 0) {
            if (!confirm('Peringatan: Kategori "' + nama + '" memiliki ' + item.fatwas_count + ' fatwa terkait.\nJika dihapus, fatwa tersebut tidak lagi memiliki kategori.\nYakin ingin melanjutkan?')) {
                return;
            }
        } else {
            if (!confirm('Hapus kategori fatwa "' + nama + '"?\nTindakan ini tidak dapat dibatalkan.')) {
                return;
            }
        }

        $.ajax({
            url: crudBase + '/' + id,
            method: 'DELETE'
        }).done(function(res) {
            alertify.success(res.message);
            table.ajax.reload(null, false);
            updateStats();
        }).fail(function(xhr) {
            var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Gagal menghapus kategori.';
            alertify.error(msg);
        });
    });

    /* ── UPDATE STATS ── */
    function updateStats() {
        $.get(baseUrl, { draw: 1, start: 0, length: 1 }, function(res) {
            $('#stat-total').text(res.recordsTotal);
        });
    }
});
</script>
@endsection
