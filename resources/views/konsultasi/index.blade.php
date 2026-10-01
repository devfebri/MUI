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
        content: 'استشارة';
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
    .stat-icon.yellow { background: #fef9c3;            color: #b45309;      }
    .stat-icon.red    { background: #fef2f2;            color: var(--red);   }
    .stat-value { font-size: 26px; font-weight: 800; color: var(--text); line-height: 1; }
    .stat-label { font-size: 12.5px; color: var(--gray); margin-top: 3px; }

    /* ── FILTER BAR ── */
    .filter-bar {
        background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow);
        padding: 12px 20px; margin-bottom: 20px;
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
    }
    .filter-pills-wrap {
        display: flex; align-items: center; flex-wrap: wrap; gap: 8px;
    }
    .filter-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px; border-radius: 20px; font-size: 12.5px; font-weight: 600;
        cursor: pointer; transition: all var(--tr);
        background: #f3f4f6; color: var(--gray); border: 1px solid transparent;
    }
    .filter-pill:hover { background: #e5e7eb; color: var(--text); }
    .filter-pill.active { background: var(--green); color: #fff; }
    .filter-pill.active-yellow { background: #eab308; color: #fff; }
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

    .konsultasi-table { width: 100% !important; border-collapse: collapse; }
    .konsultasi-table thead th {
        background: #f8fafc; color: var(--gray); font-size: 11.5px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .6px; padding: 12px 16px;
        border-bottom: 2px solid var(--border); border-top: none;
    }
    .konsultasi-table tbody td {
        padding: 13px 16px; vertical-align: middle; border-bottom: 1px solid #f1f5f9;
        font-size: 13px; color: var(--text);
    }
    .konsultasi-table tbody tr:hover { background: #fbfdfc; }

    /* ── BADGES ── */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700;
    }
    .status-badge.pending { background: #fef9c3; color: #a16207; border: 1px solid #fde047; }
    .status-badge.dijawab { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .status-badge.ditolak { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }

    .category-badge {
        display: inline-block; padding: 3px 8px; border-radius: 6px;
        background: var(--green-pale); color: var(--green-dark); font-size: 11px; font-weight: 600;
    }

    .penanya-name { font-weight: 700; color: var(--text); font-size: 13.5px; line-height: 1.2; }
    .penanya-meta { font-size: 11.5px; color: var(--gray); margin-top: 2px; }

    .pertanyaan-preview {
        max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        font-size: 12.5px; color: #374151;
    }

    /* ── DETAIL CARD IN MODAL ── */
    .question-box {
        background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid var(--gold);
        border-radius: 8px; padding: 14px 16px; margin: 12px 0; font-size: 13.5px; line-height: 1.6;
    }
    .answer-box {
        background: #f0fdf4; border: 1px solid #bbf7d0; border-left: 4px solid var(--green);
        border-radius: 8px; padding: 14px 16px; margin: 12px 0; font-size: 13.5px; line-height: 1.6;
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding:24px 28px;">

    {{-- PAGE HEADER --}}
    <div class="page-header">
        <div>
            <h4><i class="mdi mdi-forum-outline" style="margin-right:8px;"></i>Konsultasi Syariah (Tanya Ulama)</h4>
            <p>Kelola pertanyaan dan konsultasi keagamaan dari masyarakat</p>
        </div>
        <div>
            @if(auth()->user()->isOperator())
                <span class="badge" style="background: #c9a84c; color: #1a2e25; font-weight: 700; padding: 8px 14px; border-radius: 20px; font-size: 12px; box-shadow: 0 2px 8px rgba(0,0,0,.15);">
                    <i class="mdi mdi-account-edit mr-1"></i> Operator — Akses Penuh & Membalas
                </span>
            @else
                <span class="badge" style="background: rgba(255,255,255,.2); color: #fff; border: 1px solid rgba(255,255,255,.4); padding: 8px 14px; border-radius: 20px; font-size: 12px;">
                    <i class="mdi mdi-eye mr-1"></i> Admin — Mode Lihat Saja
                </span>
            @endif
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="mdi mdi-comment-question-outline"></i></div>
                <div>
                    <div class="stat-value" id="stat-total">{{ $total }}</div>
                    <div class="stat-label">Total Masuk</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="mdi mdi-clock-outline"></i></div>
                <div>
                    <div class="stat-value" id="stat-pending" style="color:#b45309;">{{ $pending }}</div>
                    <div class="stat-label">Menunggu Jawaban</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon green"><i class="mdi mdi-check-circle-outline"></i></div>
                <div>
                    <div class="stat-value" id="stat-dijawab" style="color:var(--green);">{{ $dijawab }}</div>
                    <div class="stat-label">Telah Dijawab</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon red"><i class="mdi mdi-close-circle-outline"></i></div>
                <div>
                    <div class="stat-value" id="stat-ditolak" style="color:var(--red);">{{ $ditolak }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-bar">
        <div class="filter-pills-wrap">
            <label class="mb-0 text-muted font-weight-bold" style="font-size:12.5px;"><i class="mdi mdi-filter-variant mr-1"></i> Status:</label>
            <span class="filter-pill active" data-status="">Semua</span>
            <span class="filter-pill" data-status="pending">
                <i class="mdi mdi-clock-outline"></i> Menunggu Jawaban
            </span>
            <span class="filter-pill" data-status="dijawab">
                <i class="mdi mdi-check-circle-outline"></i> Dijawab
            </span>
            <span class="filter-pill" data-status="ditolak">
                <i class="mdi mdi-close-circle-outline"></i> Ditolak
            </span>
        </div>

        <div class="d-flex align-items-center gap-2">
            <label for="select-kategori" class="mb-0 text-muted small font-weight-bold">Kategori:</label>
            <select id="select-kategori" class="form-control form-control-sm" style="width: auto; min-width: 180px; border-radius: 8px;">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $kat)
                    <option value="{{ $kat }}">{{ $kat }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- NOTICE KHUSUS ADMIN --}}
    @if(auth()->user()->isAdmin())
        <div class="alert alert-info d-flex align-items-center mb-3" style="border-radius: var(--radius); background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af;">
            <i class="mdi mdi-information mr-2" style="font-size: 20px;"></i>
            <span style="font-size: 13px;">
                <strong>Perhatian:</strong> Akun Admin memiliki hak akses <em>read-only</em> (hanya melihat konsultasi). Pembalasan tanggapan syariah dilakukan oleh akun <strong>Operator</strong>.
            </span>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="panel-card">
        <div class="panel-header">
            <h5><i class="mdi mdi-format-list-bulleted"></i> Daftar Konsultasi Masyarakat</h5>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-refresh" title="Muat Ulang">
                <i class="mdi mdi-refresh"></i> Refresh
            </button>
        </div>
        <div class="table-responsive" style="padding:0;">
            <table class="konsultasi-table" id="konsultasi-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th style="width:110px;">Tanggal</th>
                        <th>Penanya</th>
                        <th>Kategori</th>
                        <th>Pertanyaan</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:100px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

{{-- ════ MODAL DETAIL KONSULTASI ════ --}}
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: var(--radius); border:none; box-shadow: 0 10px 40px rgba(0,0,0,.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--green-dark), var(--green)); color: #fff; border-top-left-radius: var(--radius); border-top-right-radius: var(--radius);">
                <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
                    <i class="mdi mdi-comment-account-outline mr-1"></i> Detail Konsultasi Syariah
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 24px;">
                {{-- Info Penanya --}}
                <div class="row g-2 mb-3">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless mb-0" style="font-size: 13px;">
                            <tr>
                                <td style="width: 100px; color: var(--gray);">Nama</td>
                                <td>: <strong id="d-nama" class="text-dark"></strong></td>
                            </tr>
                            <tr>
                                <td style="color: var(--gray);">Email</td>
                                <td>: <span id="d-email"></span></td>
                            </tr>
                            <tr>
                                <td style="color: var(--gray);">Usia / JK</td>
                                <td>: <span id="d-usia-jk"></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless mb-0" style="font-size: 13px;">
                            <tr>
                                <td style="width: 100px; color: var(--gray);">Asal Daerah</td>
                                <td>: <span id="d-kab-kota"></span></td>
                            </tr>
                            <tr>
                                <td style="color: var(--gray);">Kategori</td>
                                <td>: <span id="d-kategori" class="category-badge"></span></td>
                            </tr>
                            <tr>
                                <td style="color: var(--gray);">Status</td>
                                <td>: <span id="d-status"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Teks Pertanyaan --}}
                <div class="mb-3">
                    <label class="text-muted small font-weight-bold text-uppercase" style="letter-spacing: .6px;">Pertanyaan dari Masyarakat:</label>
                    <div class="question-box" id="d-pertanyaan"></div>
                    <small class="text-muted"><i class="mdi mdi-clock-outline mr-1"></i>Diajukan pada: <span id="d-created-at"></span></small>
                </div>

                {{-- Tanggapan / Jawaban --}}
                <div class="mb-2">
                    <label class="text-muted small font-weight-bold text-uppercase" style="letter-spacing: .6px;">Jawaban / Fatwa Dewan Ulama:</label>
                    <div id="d-jawaban-wrap">
                        <div class="answer-box" id="d-jawaban"></div>
                        <small class="text-muted" id="d-penjawab-info"></small>
                    </div>
                    <div id="d-jawaban-empty" class="alert alert-warning py-2 px-3 small d-none" style="border-radius: 8px;">
                        <i class="mdi mdi-alert-circle-outline mr-1"></i> Pertanyaan ini belum dijawab.
                    </div>
                </div>

                @if(auth()->user()->isAdmin())
                    <div class="alert alert-light border small text-muted mt-3 mb-0">
                        <i class="mdi mdi-lock mr-1"></i> Anda dalam mode <strong>Admin (Hanya Melihat)</strong>. Tombol balas hanya aktif untuk akun <strong>Operator</strong>.
                    </div>
                @endif
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-bottom-left-radius: var(--radius); border-bottom-right-radius: var(--radius);">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                @if(auth()->user()->isOperator())
                    <button type="button" class="btn btn-success btn-sm font-weight-bold" id="btn-modal-open-balas">
                        <i class="mdi mdi-reply mr-1"></i> <span id="btn-modal-open-balas-text">Balas Konsultasi</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ════ MODAL BALAS KONSULTASI (KHUSUS OPERATOR) ════ --}}
@if(auth()->user()->isOperator())
<div class="modal fade" id="modal-balas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: var(--radius); border:none; box-shadow: 0 10px 40px rgba(0,0,0,.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, #005f47, #007f5f); color: #fff; border-top-left-radius: var(--radius); border-top-right-radius: var(--radius);">
                <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
                    <i class="mdi mdi-reply mr-1"></i> Balas Pertanyaan Konsultasi Syariah
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-balas">
                <input type="hidden" id="b-id" name="id">
                <div class="modal-body" style="padding: 24px;">
                    <div id="balas-form-errors" class="alert alert-danger d-none" style="border-radius: 8px;"></div>

                    {{-- Ringkasan Penanya --}}
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="font-weight-bold text-dark" id="b-penanya-nama"></span>
                            <span class="category-badge" id="b-penanya-kategori"></span>
                        </div>
                        <div class="small text-muted" id="b-penanya-pertanyaan" style="font-style: italic;"></div>
                    </div>

                    {{-- Pilihan Status --}}
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-dark small">Status Tanggapan <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" id="b-status" name="status" required style="border-radius: 8px;">
                            <option value="dijawab">Dijawab (Terbitkan Jawaban ke Portal Publik)</option>
                            <option value="ditolak">Ditolak (Pertanyaan Tidak Relevan / Melanggar Ketentuan)</option>
                        </select>
                    </div>

                    {{-- Input Jawaban Ulama --}}
                    <div class="form-group mb-2">
                        <label class="font-weight-bold text-dark small">
                            Jawaban / Penjelasan Syariah <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="b-jawaban" name="jawaban" rows="7" required
                                  placeholder="Tuliskan jawaban atau penjelasan syariah dari para ulama MUI dengan bahasa yang santun, jelas, dan berlandaskan dalil..."
                                  style="border-radius: 8px; font-size: 13.5px;"></textarea>
                        <div class="d-flex justify-content-between text-muted small mt-1">
                            <span>Berikan penjelasan lengkap dan dalil yang mendukung.</span>
                            <span>Karakter: <span id="jawaban-count">0</span></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background: #f8fafc; border-bottom-left-radius: var(--radius); border-bottom-right-radius: var(--radius);">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm font-weight-bold" id="btn-submit-balas">
                        <i class="mdi mdi-send mr-1"></i> Simpan & Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@section('javascript')
<script>
$(document).ready(function () {
    /* ── KONFIGURASI ROLE & URL ── */
    var isOperator = @json(auth()->user()->isOperator());
    var isAdmin    = @json(auth()->user()->isAdmin());
    var baseUrl    = @json(auth()->user()->isAdmin() ? route('admin.konsultasi.index') : route('operator.konsultasi.index'));
    var crudBase   = @json(auth()->user()->isAdmin() ? url('admin/konsultasi') : url('operator/konsultasi'));

    var table;
    var rows = {};
    var filterStatus = '';
    var filterKategori = '';
    var currentKonsultasi = null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    /* ── INISIALISASI DATATABLE ── */
    table = $('#konsultasi-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl,
            data: function (d) {
                d.filter_status = filterStatus;
                d.filter_kategori = filterKategori;
            },
            dataSrc: function (res) {
                rows = {};
                $.each(res.data, function (i, r) { rows[r.id] = r; });
                return res.data;
            }
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        searchDelay: 400,
        order: [[1, 'desc']],
        columns: [
            {
                data: null, orderable: false, searchable: false,
                render: function (d, t, r, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            {
                data: 'created_at',
                render: function (data) {
                    return '<span style="font-size:12px; color:var(--gray);">' + (data || '—') + '</span>';
                }
            },
            {
                data: 'nama',
                render: function (data, type, row) {
                    var safeName = $('<div>').text(data).html();
                    var kota = row.kab_kota ? $('<div>').text(row.kab_kota).html() : '—';
                    var jk = row.jenis_kelamin || '';
                    var usia = row.usia ? row.usia + ' th' : '';
                    var meta = [kota, jk, usia].filter(Boolean).join(' • ');

                    return '<div>' +
                           '<div class="penanya-name">' + safeName + '</div>' +
                           '<div class="penanya-meta">' + meta + '</div>' +
                           '</div>';
                }
            },
            {
                data: 'kategori',
                render: function (data) {
                    return '<span class="category-badge">' + $('<div>').text(data).html() + '</span>';
                }
            },
            {
                data: 'pertanyaan',
                render: function (data) {
                    var safe = $('<div>').text(data).html();
                    return '<div class="pertanyaan-preview" title="' + safe + '">' + safe + '</div>';
                }
            },
            {
                data: 'status',
                render: function (data) {
                    if (data === 'dijawab') {
                        return '<span class="status-badge dijawab"><i class="mdi mdi-check-circle"></i> Dijawab</span>';
                    } else if (data === 'ditolak') {
                        return '<span class="status-badge ditolak"><i class="mdi mdi-close-circle"></i> Ditolak</span>';
                    }
                    return '<span class="status-badge pending"><i class="mdi mdi-clock-outline"></i> Menunggu</span>';
                }
            },
            {
                data: null, orderable: false, searchable: false,
                render: function (d, t, row) {
                    var btns = '<div class="d-flex justify-content-center gap-1">';
                    
                    // Tombol Detail (Bisa dilihat Admin dan Operator)
                    btns += '<button class="btn btn-outline-info btn-sm mr-1 btn-detail-konsultasi" data-id="' + row.id + '" title="Lihat Detail">' +
                            '<i class="mdi mdi-eye"></i></button>';

                    // Tombol Balas & Hapus (HANYA UNTUK OPERATOR)
                    if (isOperator) {
                        var replyIcon = row.status === 'dijawab' ? 'mdi-pencil' : 'mdi-reply';
                        var replyTitle = row.status === 'dijawab' ? 'Edit Jawaban' : 'Balas Pertanyaan';
                        btns += '<button class="btn btn-outline-success btn-sm mr-1 btn-balas-konsultasi" data-id="' + row.id + '" title="' + replyTitle + '">' +
                                '<i class="mdi ' + replyIcon + '"></i></button>';
                        btns += '<button class="btn btn-outline-danger btn-sm btn-delete-konsultasi" data-id="' + row.id + '" title="Hapus">' +
                                '<i class="mdi mdi-delete"></i></button>';
                    }

                    btns += '</div>';
                    return btns;
                }
            }
        ],
        language: {
            search: 'Cari:',
            processing: 'Memuat data...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            infoFiltered: '(difilter dari _MAX_ total data)',
            zeroRecords: 'Konsultasi tidak ditemukan',
            emptyTable: 'Belum ada data konsultasi',
            paginate: { first: '«', last: '»', next: '›', previous: '‹' }
        },
        responsive: true
    });

    /* ── FILTER PILLS ── */
    $(document).on('click', '.filter-pill', function () {
        $('.filter-pill').removeClass('active active-yellow active-red');
        filterStatus = $(this).data('status');
        if (filterStatus === 'pending') $(this).addClass('active-yellow');
        else if (filterStatus === 'ditolak') $(this).addClass('active-red');
        else $(this).addClass('active');

        table.ajax.reload();
    });

    /* ── FILTER KATEGORI ── */
    $('#select-kategori').on('change', function () {
        filterKategori = $(this).val();
        table.ajax.reload();
    });

    /* ── REFRESH BUTTON ── */
    $('#btn-refresh').on('click', function () {
        table.ajax.reload(null, false);
    });

    /* ── LIHAT DETAIL ── */
    $(document).on('click', '.btn-detail-konsultasi', function () {
        var id = $(this).data('id');
        var item = rows[id];
        if (!item) return;

        currentKonsultasi = item;

        // Render modal detail
        $('#d-nama').text(item.nama);
        $('#d-email').text(item.email);
        $('#d-usia-jk').text((item.usia ? item.usia + ' Tahun' : '—') + ' / ' + (item.jenis_kelamin || '—'));
        $('#d-kab-kota').text(item.kab_kota || '—');
        $('#d-kategori').text(item.kategori);
        $('#d-pertanyaan').text(item.pertanyaan);
        $('#d-created-at').text(item.created_at || '—');

        // Status badge
        var statusHtml = '';
        if (item.status === 'dijawab') {
            statusHtml = '<span class="status-badge dijawab"><i class="mdi mdi-check-circle"></i> Dijawab</span>';
        } else if (item.status === 'ditolak') {
            statusHtml = '<span class="status-badge ditolak"><i class="mdi mdi-close-circle"></i> Ditolak</span>';
        } else {
            statusHtml = '<span class="status-badge pending"><i class="mdi mdi-clock-outline"></i> Menunggu Jawaban</span>';
        }
        $('#d-status').html(statusHtml);

        // Jawaban
        if (item.jawaban) {
            $('#d-jawaban').text(item.jawaban);
            var penjawabInfo = '<i class="mdi mdi-account-check mr-1"></i> Dijawab oleh: <strong>' +
                               (item.penjawab || 'Operator MUI') + '</strong>' +
                               (item.answered_at ? ' pada ' + item.answered_at : '');
            $('#d-penjawab-info').html(penjawabInfo);
            $('#d-jawaban-wrap').removeClass('d-none');
            $('#d-jawaban-empty').addClass('d-none');
            if (isOperator) {
                $('#btn-modal-open-balas-text').text('Ubah Jawaban');
            }
        } else {
            $('#d-jawaban-wrap').addClass('d-none');
            $('#d-jawaban-empty').removeClass('d-none');
            if (isOperator) {
                $('#btn-modal-open-balas-text').text('Balas Sekarang');
            }
        }

        $('#modal-detail').modal('show');
    });

    @if(auth()->user()->isOperator())
    /* ── BUKA MODAL BALAS (DARI TABEL ATAU DARI DETAIL) ── */
    function openModalBalas(item) {
        if (!item) return;
        currentKonsultasi = item;
        $('#modal-detail').modal('hide');

        $('#balas-form-errors').addClass('d-none').empty();
        $('#b-id').val(item.id);
        $('#b-penanya-nama').text(item.nama + ' (' + (item.kab_kota || 'Indonesia') + ')');
        $('#b-penanya-kategori').text(item.kategori);
        $('#b-penanya-pertanyaan').text('"' + (item.pertanyaan.length > 120 ? item.pertanyaan.substring(0, 120) + '...' : item.pertanyaan) + '"');

        $('#b-status').val(item.status === 'ditolak' ? 'ditolak' : 'dijawab');
        $('#b-jawaban').val(item.jawaban || '');
        $('#jawaban-count').text((item.jawaban || '').length);

        $('#modal-balas').modal('show');
    }

    $(document).on('click', '.btn-balas-konsultasi', function () {
        var id = $(this).data('id');
        openModalBalas(rows[id]);
    });

    $('#btn-modal-open-balas').on('click', function () {
        openModalBalas(currentKonsultasi);
    });

    $('#b-jawaban').on('input', function () {
        $('#jawaban-count').text($(this).val().length);
    });

    /* ── SUBMIT FORM BALAS KONSULTASI ── */
    $('#form-balas').on('submit', function (e) {
        e.preventDefault();
        var id = $('#b-id').val();
        var $btn = $('#btn-submit-balas').prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i> Menyimpan...');

        var payload = {
            jawaban: $('#b-jawaban').val(),
            status: $('#b-status').val()
        };

        $.ajax({
            url: crudBase + '/' + id + '/jawab',
            method: 'POST',
            data: payload
        }).done(function (res) {
            $('#modal-balas').modal('hide');
            alertify.success(res.message);
            table.ajax.reload(null, false);
            // Update counter stat card
            updateStats();
        }).fail(function (xhr) {
            var msg = 'Terjadi kesalahan.';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                var list = '<ul>';
                $.each(xhr.responseJSON.errors, function (k, v) {
                    list += '<li>' + v[0] + '</li>';
                });
                list += '</ul>';
                $('#balas-form-errors').html(list).removeClass('d-none');
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                $('#balas-form-errors').html(xhr.responseJSON.message).removeClass('d-none');
            } else {
                alertify.error('Gagal menyimpan jawaban.');
            }
        }).always(function () {
            $btn.prop('disabled', false).html('<i class="mdi mdi-send mr-1"></i> Simpan & Kirim Jawaban');
        });
    });

    /* ── HAPUS DATA KONSULTASI ── */
    $(document).on('click', '.btn-delete-konsultasi', function () {
        var id = $(this).data('id');
        var item = rows[id];
        var nama = item ? item.nama : 'konsultasi ini';
        if (!confirm('Hapus konsultasi dari "' + nama + '"?\nTindakan ini tidak dapat dibatalkan.')) return;

        $.ajax({
            url: crudBase + '/' + id,
            method: 'DELETE'
        }).done(function (res) {
            alertify.success(res.message);
            table.ajax.reload(null, false);
            updateStats();
        }).fail(function (xhr) {
            var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Gagal menghapus data.';
            alertify.error(msg);
        });
    });
    @endif

    /* ── UPDATE STATS COUNTER ── */
    function updateStats() {
        $.get(baseUrl, { draw: 1, start: 0, length: 1 }, function (res) {
            $('#stat-total').text(res.recordsTotal);
        });
    }
});
</script>
@endsection
