@extends('layouts.master')

@section('title', 'Hak Akses & Tugas Operator')

@section('css')
<style>
    :root {
        --green: #007f5f;
        --green-dark: #005f47;
        --green-light: #00a878;
        --green-pale: #e8f5f1;
        --yellow: #f0a500;
        --yellow-pale: #fffbeb;
        --blue: #2563eb;
        --blue-pale: #eff6ff;
        --red: #ef4444;
        --red-pale: #fef2f2;
        --text: #1a1a2e;
        --gray: #6b7280;
        --bg: #f4f7f6;
        --white: #ffffff;
        --radius: 14px;
        --radius-sm: 8px;
        --shadow: 0 2px 16px rgba(0,0,0,.07);
        --shadow-hover: 0 8px 32px rgba(0,127,95,.16);
        --transition: .22s cubic-bezier(.4,0,.2,1);
    }

    body { background: var(--bg) !important; }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        border-radius: var(--radius);
        padding: 26px 30px;
        margin-bottom: 24px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .page-header h4 {
        font-size: 22px;
        font-weight: 800;
        margin: 0;
        color: #fff;
    }

    .page-header p {
        margin: 4px 0 0;
        font-size: 13px;
        opacity: .85;
        color: #fff;
    }

    .page-header .badge-role {
        background: rgba(255, 255, 255, .2);
        border: 1px solid rgba(255, 255, 255, .35);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 16px;
        border-radius: 20px;
        letter-spacing: 0.5px;
    }

    /* Panel Card */
    .panel-card {
        background: var(--white);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .panel-card .panel-header {
        padding: 18px 22px;
        border-bottom: 1px solid #f0f4f3;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-card .panel-header h5 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .panel-card .panel-header h5 i {
        color: var(--green);
        font-size: 18px;
    }

    .panel-card .panel-body {
        padding: 20px 22px;
    }

    /* Info Alert */
    .welcome-alert {
        background: var(--green-pale);
        border-left: 4px solid var(--green);
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .welcome-alert i {
        font-size: 22px;
        color: var(--green);
        flex-shrink: 0;
    }

    .welcome-alert p {
        margin: 0;
        font-size: 13.5px;
        color: var(--text);
    }

    .welcome-alert strong {
        color: var(--green);
    }

    /* Table Styling (Identical to user.blade.php) */
    .user-table {
        width: 100% !important;
    }

    .user-table th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gray);
        padding: 12px 14px;
        border-bottom: 2px solid #f0f4f3;
        background: #fafcfb;
        white-space: nowrap;
    }

    .user-table td {
        padding: 14px 14px;
        border-bottom: 1px solid #f4f6f5;
        font-size: 13.5px;
        color: var(--text);
        vertical-align: middle;
    }

    .user-table tr:last-child td {
        border-bottom: none;
    }

    .user-table tr:hover td {
        background: #fafcfb;
    }

    /* Badges */
    .task-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 600;
        margin: 2px;
        white-space: nowrap;
    }

    .task-badge.berita { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; }
    .task-badge.kategori { background: #f5f3ff; color: #5b21b6; border: 1px solid #ddd6fe; }
    .task-badge.surat { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .task-badge.fatwa { background: #fff7ed; color: #9a3412; border: 1px solid #fed7aa; }
    .task-badge.kategori-fatwa { background: #fdf2f8; color: #9d174d; border: 1px solid #fbcfe8; }
    .task-badge.livechat { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .task-badge.konsultasi { background: #fefce8; color: #854d0e; border: 1px solid #fef08a; }

    .task-badge.empty {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
        font-style: italic;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge.full { background: #dcfce7; color: #166534; }
    .status-badge.partial { background: #e0f2fe; color: #0369a1; }
    .status-badge.none { background: #fee2e2; color: #991b1b; }

    /* Modal Permissions Styling */
    .permission-group-title {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--green-dark);
        margin: 16px 0 8px;
        padding-bottom: 5px;
        border-bottom: 1.5px solid #eef3f1;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .permission-card {
        background: #ffffff;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .permission-card:hover {
        border-color: #86efac;
        background: #fcfdfd;
    }

    .permission-card.selected {
        border-color: var(--green);
        background: #f0fdf4;
    }

    .permission-checkbox {
        width: 17px;
        height: 17px;
        margin-top: 2px;
        cursor: pointer;
        accent-color: var(--green);
    }

    .permission-info { flex: 1; }

    .perm-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 2px;
    }

    .perm-desc {
        font-size: 11.5px;
        color: var(--gray);
        margin: 0;
        line-height: 1.3;
    }

    .quick-selector-bar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 14px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 24px 30px;">

    {{-- ===== PAGE HEADER ===== --}}
    <div class="page-header">
        <div>
            <h4><i class="mdi mdi-shield-account mr-1"></i> Hak Akses & Tugas Operator</h4>
            <p>Kelola pembagian tugas dan menu akses operator secara realtime via DataTables AJAX.</p>
        </div>
        <span class="badge-role">
            <i class="mdi mdi-account-group mr-1"></i> Total: <span id="header-total-operators">{{ $totalOperators }}</span> Operator
        </span>
    </div>

    {{-- ===== WELCOME TIP ===== --}}
    <div class="welcome-alert">
        <i class="mdi mdi-information-outline"></i>
        <p>
            <strong>Pencarian DataTables Cerdas:</strong> Ketik minimal <strong>3 huruf</strong> untuk mencari operator berdasarkan Nama, Username, Email, atau No. WhatsApp. Pembagian hak akses langsung diperbarui tanpa reload halaman.
        </p>
    </div>

    {{-- ===== TABLE PANEL CARD ===== --}}
    <div class="panel-card">
        <div class="panel-header">
            <h5><i class="mdi mdi-format-list-checks"></i> Daftar Pembagian Tugas Operator</h5>
            <div>
                <button type="button" class="btn btn-success btn-sm font-weight-bold" id="btn-create-operator">
                    <i class="mdi mdi-account-plus mr-1"></i> Tambah Operator
                </button>
            </div>
        </div>
        <div class="panel-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="user-table" id="operators-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama Operator</th>
                            <th>Username</th>
                            <th>Kontak</th>
                            <th>Tugas & Menu Aktif</th>
                            <th style="width: 130px;">Status</th>
                            <th style="width: 140px; text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ===== MODAL ATUR HAK AKSES ===== --}}
<div class="modal fade" id="modalPermission" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.18);">
            <form id="form-update-permission" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header" style="background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%); color: #fff; padding: 20px 24px;">
                    <div>
                        <h5 class="modal-title font-weight-bold text-white mb-1" id="modalOpTitle">
                            <i class="mdi mdi-account-key mr-1"></i> Atur Hak Akses Operator
                        </h5>
                        <p class="mb-0 text-white-50 small" id="modalOpSubtitle">Tentukan menu operasional yang aktif untuk akun ini.</p>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: .9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 24px; max-height: 70vh; overflow-y: auto;">
                    {{-- Quick Action Bar --}}
                    <div class="quick-selector-bar">
                        <span class="small font-weight-bold text-muted">Aksi Cepat:</span>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="button" class="btn btn-sm btn-outline-info font-weight-bold" onclick="selectDefaultPerms()">
                                <i class="mdi mdi-star-outline mr-1"></i> Default (Berita & Layanan)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success font-weight-bold ml-1" onclick="selectAllPerms(true)">
                                <i class="mdi mdi-checkbox-multiple-marked mr-1"></i> Pilih Semua (Full)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger font-weight-bold ml-1" onclick="selectAllPerms(false)">
                                <i class="mdi mdi-checkbox-blank-outline mr-1"></i> Hapus Semua
                            </button>
                        </div>
                    </div>

                    {{-- Grouped Permissions --}}
                    @php
                        $groupedPerms = [];
                        foreach ($allPermissions as $key => $details) {
                            $groupedPerms[$details['group']][$key] = $details;
                        }
                    @endphp

                    @foreach($groupedPerms as $groupName => $perms)
                        <div class="permission-group-title">
                            <i class="mdi {{ $groupName === 'Konten' ? 'mdi-file-document-edit-outline' : ($groupName === 'Arsip' ? 'mdi-archive-outline' : 'mdi-face-agent') }}"></i>
                            Bidang {{ $groupName }}
                        </div>

                        <div class="row">
                            @foreach($perms as $key => $item)
                                <div class="col-md-6 mb-2">
                                    <label class="permission-card" id="card-perm-{{ $key }}" for="chk-{{ $key }}">
                                        <input type="checkbox"
                                               name="permissions[]"
                                               value="{{ $key }}"
                                               id="chk-{{ $key }}"
                                               class="permission-checkbox"
                                               onchange="togglePermCardVisual('{{ $key }}')">
                                        <div class="permission-info">
                                            <div class="perm-title">
                                                <i class="{{ $item['icon'] }} text-success"></i>
                                                {{ $item['label'] }}
                                            </div>
                                            <p class="perm-desc">{{ $item['description'] }}</p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="modal-footer" style="background: #f8fafc; padding: 16px 24px; border-top: 1px solid #eef2f0;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold" id="btn-save-permission">
                        <i class="mdi mdi-content-save mr-1"></i> Simpan Hak Akses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL TAMBAH OPERATOR BARU ===== --}}
<div class="modal fade" id="modalCreateOperator" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.18);">
            <form id="form-create-operator" method="POST">
                @csrf
                <input type="hidden" name="role" value="operator">
                <div class="modal-header" style="background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%); color: #fff; padding: 20px 24px;">
                    <div>
                        <h5 class="modal-title font-weight-bold text-white mb-1">
                            <i class="mdi mdi-account-plus mr-1"></i> Tambah Akun Operator Baru
                        </h5>
                        <p class="mb-0 text-white-50 small">Buat akun operator dan tetapkan pembagian tugas awalnya.</p>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: .9;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 24px; max-height: 70vh; overflow-y: auto;">
                    <div id="create-error-alert" class="alert alert-danger d-none" style="border-radius: 8px;"></div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Ahmad Fauzi" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Nama & Gelar</label>
                            <input type="text" name="name_gelar" class="form-control" placeholder="Contoh: Ahmad Fauzi, S.Pd.I">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="Username login" maxlength="20" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="alamat@email.com" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">No. WhatsApp / HP</label>
                            <input type="text" name="nohp" class="form-control" placeholder="0812xxxxxxxx">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Jenis Kelamin</label>
                            <select name="jk" class="form-control">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold small text-muted">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                        </div>
                    </div>

                    {{-- Default Hak Akses Checklist --}}
                    <div class="mt-2 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="font-weight-bold text-dark small"><i class="mdi mdi-shield-check mr-1 text-success"></i> Pembagian Tugas Awal:</span>
                            <span class="badge badge-info small font-weight-bold">Default: Berita & Layanan</span>
                        </div>

                        <div class="row">
                            @foreach($allPermissions as $permKey => $perm)
                                @php
                                    $isDefault = in_array($permKey, \App\Models\User::DEFAULT_OPERATOR_PERMISSIONS, true);
                                @endphp
                                <div class="col-md-6 mb-2">
                                    <label class="permission-card {{ $isDefault ? 'selected' : '' }}" for="create-chk-{{ $permKey }}" style="padding: 10px 14px;">
                                        <input type="checkbox"
                                               name="menu_permissions[]"
                                               value="{{ $permKey }}"
                                               id="create-chk-{{ $permKey }}"
                                               class="permission-checkbox"
                                               {{ $isDefault ? 'checked' : '' }}
                                               onchange="$(this).closest('.permission-card').toggleClass('selected', $(this).is(':checked'))">
                                        <div class="permission-info">
                                            <div class="font-weight-bold text-dark" style="font-size: 13px;">
                                                <i class="{{ $perm['icon'] }} text-success mr-1"></i> {{ $perm['label'] }}
                                            </div>
                                            <small class="text-muted d-block" style="font-size: 11px;">{{ $perm['description'] }}</small>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background: #f8fafc; padding: 16px 24px; border-top: 1px solid #eef2f0;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success font-weight-bold" id="btn-save-new-op">
                        <i class="mdi mdi-check-circle mr-1"></i> Simpan Operator
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
    let operatorsTable = null;
    let operatorsCache = {};
    const allPermissionsData = @json($allPermissions);
    const defaultPermissionKeys = @json(\App\Models\User::DEFAULT_OPERATOR_PERMISSIONS);
    const totalPermissionsCount = Object.keys(allPermissionsData).length;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
        }
    });

    // ── DATATABLES INITIALIZATION (IDENTICAL TO user.blade.php) ──
    operatorsTable = $('#operators-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.operator-permissions.index') }}",
            data: function(request) {
                request.search.value = $.trim(request.search.value);
            },
            dataSrc: function(response) {
                operatorsCache = {};
                $.each(response.data, function(index, op) {
                    operatorsCache[op.id] = op;
                });
                $('#header-total-operators').text(response.recordsTotal);
                return response.data;
            }
        },
        pageLength: 10,
        lengthMenu: [[10, 25, 50], [10, 25, 50]],
        searchDelay: 500,
        order: [[1, 'asc']],
        columns: [
            // 0. Number
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.settings._iDisplayStart + meta.row + 1;
                }
            },
            // 1. Nama Operator & Gelar
            {
                data: 'name',
                render: function(data, type, row) {
                    let avatarHtml = '';
                    if (row.foto_url) {
                        avatarHtml = `<img src="${row.foto_url}" alt="${$('<div>').text(data).html()}" style="width:100%;height:100%;object-fit:cover;">`;
                    } else {
                        avatarHtml = $('<div>').text(data.charAt(0).toUpperCase()).html();
                    }

                    const displayName = row.name_gelar ? $('<div>').text(row.name_gelar).html() : $('<div>').text(data).html();

                    return `
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:36px;height:36px;border-radius:10px;background:var(--green-pale);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:var(--green);overflow:hidden;flex-shrink:0;">
                                ${avatarHtml}
                            </div>
                            <div>
                                <span style="font-weight:700;color:var(--text);display:block;">${displayName}</span>
                                <small style="color:var(--gray);font-size:11.5px;">Operator</small>
                            </div>
                        </div>
                    `;
                }
            },
            // 2. Username
            {
                data: 'username',
                render: function(data) {
                    return `<code>@${$('<div>').text(data).html()}</code>`;
                }
            },
            // 3. Kontak
            {
                data: 'email',
                render: function(data, type, row) {
                    let contactHtml = `<div style="font-size:12.5px;"><i class="mdi mdi-email-outline mr-1 text-muted"></i>${$('<div>').text(data).html()}</div>`;
                    if (row.nohp) {
                        contactHtml += `<div style="font-size:12px;color:var(--gray);margin-top:2px;"><i class="mdi mdi-whatsapp mr-1 text-success"></i>${$('<div>').text(row.nohp).html()}</div>`;
                    }
                    return contactHtml;
                }
            },
            // 4. Tugas & Hak Akses Badges
            {
                data: 'assigned_permissions',
                orderable: false,
                searchable: false,
                render: function(permissions, type, row) {
                    if (!permissions || permissions.length === 0) {
                        return '<span class="task-badge empty"><i class="mdi mdi-alert-circle-outline"></i> Belum ada tugas</span>';
                    }

                    let badgesHtml = '<div style="display:flex;flex-wrap:wrap;gap:4px;">';
                    permissions.forEach(function(key) {
                        if (allPermissionsData[key]) {
                            const p = allPermissionsData[key];
                            badgesHtml += `<span class="task-badge ${key}"><i class="${p.icon}"></i> ${p.label}</span>`;
                        }
                    });
                    badgesHtml += '</div>';
                    return badgesHtml;
                }
            },
            // 5. Status Tugas
            {
                data: 'assigned_permissions',
                orderable: false,
                searchable: false,
                render: function(permissions) {
                    const count = (permissions || []).length;
                    if (count >= totalPermissionsCount) {
                        return '<span class="status-badge full"><i class="mdi mdi-check-all mr-1"></i> Akses Penuh</span>';
                    } else if (count === 0) {
                        return '<span class="status-badge none"><i class="mdi mdi-close mr-1"></i> Belum Ada</span>';
                    } else {
                        return `<span class="status-badge partial"><i class="mdi mdi-tune mr-1"></i> ${count}/${totalPermissionsCount} Menu</span>`;
                    }
                }
            },
            // 6. Aksi
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-right',
                render: function(data, type, row) {
                    const safeName = $('<div>').text(row.name_gelar || row.name).html().replace(/'/g, "\\'");
                    const safeUsername = $('<div>').text(row.username).html().replace(/'/g, "\\'");

                    return `
                        <button type="button" class="btn btn-outline-primary btn-sm mr-1" title="Atur Hak Akses" onclick="openPermissionModal(${row.id}, '${safeName}', '${safeUsername}')">
                            <i class="mdi mdi-tune-vertical"></i>
                        </button>
                        <button type="button" class="btn btn-outline-success btn-sm mr-1" title="Beri Akses Penuh" onclick="quickGrantAll(${row.id}, '${safeName}')">
                            <i class="mdi mdi-check-all"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm" title="Cabut Semua Akses" onclick="quickRevokeAll(${row.id}, '${safeName}')">
                            <i class="mdi mdi-close-octagon"></i>
                        </button>
                    `;
                }
            }
        ],
        language: {
            search: 'Cari:',
            processing: 'Memproses data operator...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ operator',
            infoEmpty: 'Tidak ada operator',
            infoFiltered: '(difilter dari _MAX_ total operator)',
            zeroRecords: 'Operator tidak ditemukan',
            emptyTable: 'Belum ada data operator',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Berikutnya',
                previous: 'Sebelumnya'
            }
        },
        responsive: true
    });

    // ── SEARCH MINIMAL 3 HURUF ATURAN (IDENTICAL TO user.blade.php) ──
    $('#operators-table').on('processing.dt', function(event, settings, processing) {
        var search = $.trim($(settings.nTableWrapper).find('input[type="search"]').val() || '');

        if (processing && search.length > 0 && search.length < 3) {
            $(settings.nTableWrapper).find('.dataTables_processing').hide();
        }
    });

    // ── BUKA MODAL PERMISSION ──
    window.openPermissionModal = function(operatorId, operatorName, operatorUsername) {
        const op = operatorsCache[operatorId];
        const assignedPermissions = op ? op.assigned_permissions : [];

        $('#modalOpTitle').html('<i class="mdi mdi-account-key mr-1"></i> Atur Hak Akses: ' + operatorName);
        $('#modalOpSubtitle').text('Username: @' + operatorUsername + ' — Tentukan menu operasional yang aktif.');
        $('#form-update-permission').attr('action', '/admin/operator-permissions/' + operatorId);

        // Reset all checkboxes
        $('#modalPermission .permission-checkbox').prop('checked', false);
        $('#modalPermission .permission-card').removeClass('selected');

        if (Array.isArray(assignedPermissions)) {
            assignedPermissions.forEach(function(key) {
                $('#chk-' + key).prop('checked', true);
                $('#card-perm-' + key).addClass('selected');
            });
        }

        $('#modalPermission').modal('show');
    };

    window.togglePermCardVisual = function(key) {
        const isChecked = $('#chk-' + key).is(':checked');
        if (isChecked) {
            $('#card-perm-' + key).addClass('selected');
        } else {
            $('#card-perm-' + key).removeClass('selected');
        }
    };

    window.selectAllPerms = function(check) {
        $('#modalPermission .permission-checkbox').prop('checked', check);
        if (check) {
            $('#modalPermission .permission-card').addClass('selected');
        } else {
            $('#modalPermission .permission-card').removeClass('selected');
        }
    };

    window.selectDefaultPerms = function() {
        $('#modalPermission .permission-checkbox').prop('checked', false);
        $('#modalPermission .permission-card').removeClass('selected');
        defaultPermissionKeys.forEach(function(key) {
            $('#chk-' + key).prop('checked', true);
            $('#card-perm-' + key).addClass('selected');
        });
    };

    // ── SUBMIT UPDATE PERMISSION VIA JQUERY AJAX ──
    $('#form-update-permission').on('submit', function(e) {
        e.preventDefault();

        const formAction = $(this).attr('action');
        const formData = $(this).serialize();
        const $btn = $('#btn-save-permission');

        $btn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin mr-1"></i> Menyimpan...');

        $.ajax({
            url: formAction,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                $btn.prop('disabled', false).html('<i class="mdi mdi-content-save mr-1"></i> Simpan Hak Akses');
                $('#modalPermission').modal('hide');

                if (res.success) {
                    operatorsTable.ajax.reload(null, false);

                    if (typeof window.showToast === 'function') {
                        window.showToast('success', res.message);
                    } else {
                        alert(res.message);
                    }
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).html('<i class="mdi mdi-content-save mr-1"></i> Simpan Hak Akses');
                const errMsg = xhr.responseJSON?.message || 'Gagal menyimpan hak akses operator.';
                if (typeof window.showToast === 'function') {
                    window.showToast('error', errMsg);
                } else {
                    alert('Error: ' + errMsg);
                }
            }
        });
    });

    // ── QUICK ACTION: BERI SEMUA AKSES VIA JQUERY AJAX ──
    window.quickGrantAll = function(opId, opName) {
        if (!confirm('Berikan akses penuh ke semua menu untuk operator "' + opName + '"?')) return;

        $.ajax({
            url: '/admin/operator-permissions/' + opId + '/grant-all',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    operatorsTable.ajax.reload(null, false);
                    if (typeof window.showToast === 'function') {
                        window.showToast('success', res.message);
                    }
                }
            },
            error: function() {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', 'Gagal memberikan semua hak akses.');
                }
            }
        });
    };

    // ── QUICK ACTION: CABUT SEMUA AKSES VIA JQUERY AJAX ──
    window.quickRevokeAll = function(opId, opName) {
        if (!confirm('Cabut semua hak akses menu untuk operator "' + opName + '"?')) return;

        $.ajax({
            url: '/admin/operator-permissions/' + opId + '/revoke-all',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    operatorsTable.ajax.reload(null, false);
                    if (typeof window.showToast === 'function') {
                        window.showToast('warning', res.message);
                    }
                }
            },
            error: function() {
                if (typeof window.showToast === 'function') {
                    window.showToast('error', 'Gagal mencabut hak akses.');
                }
            }
        });
    };

    // ── TAMBAH OPERATOR BARU MODAL (AJAX) ──
    $('#btn-create-operator').on('click', function() {
        $('#create-error-alert').addClass('d-none').empty();
        $('#form-create-operator')[0].reset();

        // Set default checklist (Berita & Layanan)
        $('#form-create-operator .permission-checkbox').each(function() {
            const val = $(this).val();
            const isDef = defaultPermissionKeys.includes(val);
            $(this).prop('checked', isDef);
            $(this).closest('.permission-card').toggleClass('selected', isDef);
        });

        $('#modalCreateOperator').modal('show');
    });

    $('#form-create-operator').on('submit', function(e) {
        e.preventDefault();

        const $btn = $('#btn-save-new-op');
        const $alert = $('#create-error-alert');
        $alert.addClass('d-none').empty();
        $btn.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin mr-1"></i> Menyimpan...');

        $.ajax({
            url: "{{ route('admin.users.store') }}",
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                $btn.prop('disabled', false).html('<i class="mdi mdi-check-circle mr-1"></i> Simpan Operator');
                $('#modalCreateOperator').modal('hide');

                if (typeof window.showToast === 'function') {
                    window.showToast('success', res.message || 'Operator baru berhasil ditambahkan.');
                }

                operatorsTable.ajax.reload(null, false);
            },
            error: function(xhr) {
                $btn.prop('disabled', false).html('<i class="mdi mdi-check-circle mr-1"></i> Simpan Operator');
                let errHtml = '';
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    errHtml = '<ul class="mb-0 pl-3">';
                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        errHtml += '<li>' + messages.join(', ') + '</li>';
                    });
                    errHtml += '</ul>';
                } else {
                    errHtml = xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan operator.';
                }

                $alert.removeClass('d-none').html(errHtml);
            }
        });
    });
});
</script>
@endsection
