@extends('layouts.master')

@section('css')
    <style>
        /* ===== DASHBOARD VARIABLES ===== */
        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-pale: #e8f5f1;
            --yellow: #f0a500;
            --blue: #2563eb;
            --red: #ef4444;
            --text: #1a1a2e;
            --gray: #6b7280;
            --bg: #f4f7f6;
            --white: #ffffff;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(0, 0, 0, .07);
            --shadow-hover: 0 8px 32px rgba(0, 127, 95, .16);
            --transition: .22s cubic-bezier(.4, 0, .2, 1);
        }

        body {
            background: var(--bg) !important;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
            border-radius: var(--radius);
            padding: 28px 30px;
            margin-bottom: 28px;
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
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all var(--transition);
            border: 1px solid transparent;
            margin-bottom: 0;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-3px);
            border-color: var(--green-pale);
        }

        .stat-icon {
            width: 58px;
            height: 58px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
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

        .stat-info {
            flex: 1;
        }

        .stat-info .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--text);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-info .stat-label {
            font-size: 13px;
            color: var(--gray);
            font-weight: 500;
        }

        .stat-info .stat-sub {
            font-size: 11px;
            color: var(--green);
            font-weight: 600;
            margin-top: 4px;
        }

        /* ===== PANEL CARDS ===== */
        .panel-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            height: 100%;
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

        /* ===== WELCOME ALERT ===== */
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
            font-size: 14px;
            color: var(--text);
        }

        .welcome-alert strong {
            color: var(--green);
        }

        /* ===== USER TABLE ===== */
        .user-table {
            width: 100%;
        }

        .user-table th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray);
            padding: 10px 12px;
            border-bottom: 2px solid #f0f4f3;
            background: #fafcfb;
        }

        .user-table td {
            padding: 12px 12px;
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

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-badge.admin {
            background: var(--green-pale);
            color: var(--green);
        }

        .role-badge.operator {
            background: #fff8e6;
            color: var(--yellow);
        }

        /* ===== ACTIVITY ITEM ===== */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f4f3;
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .activity-dot.green {
            background: var(--green);
        }

        .activity-dot.yellow {
            background: var(--yellow);
        }

        .activity-dot.blue {
            background: var(--blue);
        }

        .activity-text {
            flex: 1;
        }

        .activity-text p {
            margin: 0;
            font-size: 13.5px;
            color: var(--text);
        }

        .activity-text span {
            font-size: 11px;
            color: var(--gray);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 24px 30px;">
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="panel-card">
                    <div class="panel-header">
                        <h5><i class="mdi mdi-account-multiple"></i> Daftar Pengguna</h5>
                        <button type="button" class="btn btn-success btn-sm" id="btn-create-user">
                            <i class="mdi mdi-account-plus"></i> Tambah Pengguna
                        </button>
                    </div>
                    <div class="panel-body" style="padding:0;">
                        <div class="table-responsive">
                            <table class="user-table" id="users-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Bergabung</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-modal-title">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="user-form">
                    <div class="modal-body">
                        <div id="user-form-errors" class="alert alert-danger d-none"></div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="user-name">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="user-name" name="name" maxlength="100" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-name-gelar">Nama Gelar</label>
                                <input type="text" class="form-control" id="user-name-gelar" name="name_gelar" maxlength="100">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-username">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="user-username" name="username" maxlength="20" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="user-email" name="email" maxlength="255" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-role">Role <span class="text-danger">*</span></label>
                                <select class="form-control" id="user-role" name="role" required>
                                    <option value="operator">Operator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-jk">Jenis Kelamin</label>
                                <select class="form-control" id="user-jk" name="jk">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-nohp">No. HP</label>
                                <input type="text" class="form-control" id="user-nohp" name="nohp" maxlength="15">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-password">Password <span class="password-required text-danger">*</span></label>
                                <input type="password" class="form-control" id="user-password" name="password" minlength="8" autocomplete="new-password">
                                <small class="form-text text-muted" id="password-help">Minimal 8 karakter.</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user-password-confirmation">Konfirmasi Password <span class="password-required text-danger">*</span></label>
                                <input type="password" class="form-control" id="user-password-confirmation" name="password_confirmation" minlength="8" autocomplete="new-password">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="user-alamat">Alamat</label>
                                <textarea class="form-control" id="user-alamat" name="alamat" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btn-save-user"><i class="mdi mdi-content-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function() {
            var users = {};
            var userUrl = @json(route('admin.users.index'));
            var editingId = null;
            var usersTable;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                }
            });

            function resetForm() {
                editingId = null;
                $('#user-form')[0].reset();
                $('#user-role').val('operator');
                $('#user-form-errors').addClass('d-none').empty();
                $('.password-required').show();
                $('#user-password, #user-password-confirmation').prop('required', true);
                $('#password-help').text('Minimal 8 karakter.');
                $('#user-modal-title').text('Tambah Pengguna');
            }

            function showErrors(xhr) {
                var messages = [];
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(fieldErrors) {
                        messages = messages.concat(fieldErrors);
                    });
                }
                $('#user-form-errors').html(messages.length ? messages.join('<br>') : 'Terjadi kesalahan. Silakan coba lagi.').removeClass('d-none');
            }

            function initializeDataTable() {
                $('#users-table').on('preXhr.dt', function(event, settings, request) {
                    var search = $.trim(request.search.value || '');

                    if (search.length > 0 && search.length < 3) {
                        $(settings.nTableWrapper).find('.dataTables_processing').hide();
                        return false;
                    }
                });

                usersTable = $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: userUrl,
                        data: function(request) {
                            request.search.value = $.trim(request.search.value);
                        },
                        dataSrc: function(response) {
                            users = {};
                            $.each(response.data, function(index, user) {
                                users[user.id] = user;
                            });
                            return response.data;
                        }
                    },
                    pageLength: 10,
                    lengthMenu: [[10, 25, 50], [10, 25, 50]],
                    searchDelay: 500,
                    order: [[5, 'desc']],
                    columns: [
                        { data: null, orderable: false, searchable: false, render: function(data, type, row, meta) {
                            return meta.settings._iDisplayStart + meta.row + 1;
                        }},
                        { data: 'name', render: function(data, type, row) {
                            return '<div style="display:flex;align-items:center;gap:10px;"><div style="width:34px;height:34px;border-radius:10px;background:var(--green-pale);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:var(--green);">' +
                                $('<div>').text(data.charAt(0).toUpperCase()).html() + '</div><span style="font-weight:600;">' + $('<div>').text(data).html() + '</span></div>';
                        }},
                        { data: 'username', render: $.fn.dataTable.render.text() },
                        { data: 'email', render: $.fn.dataTable.render.text() },
                        { data: 'role', render: function(data) {
                            return '<span class="role-badge ' + data + '"><i class="mdi ' +
                                (data === 'admin' ? 'mdi-shield-account' : 'mdi-account-edit') + '"></i> ' + data + '</span>';
                        }},
                        { data: 'created_at', render: function(data, type) {
                            if (type === 'sort' || type === 'type') return new Date(data).getTime();
                            return new Date(data).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                        }},
                        { data: null, orderable: false, searchable: false, render: function(data, type, row) {
                            let actions = '';
                            if (row.role === 'operator') {
                                actions += '<a href="/admin/operator-permissions?search=' + encodeURIComponent(row.username) + '" class="btn btn-outline-info btn-sm mr-1" title="Atur Tugas & Hak Akses"><i class="mdi mdi-shield-account"></i></a> ';
                            }
                            actions += '<button type="button" class="btn btn-outline-primary btn-sm btn-edit-user mr-1" data-user="' + row.id + '" title="Edit Pengguna"><i class="mdi mdi-pencil"></i></button>' +
                                '<button type="button" class="btn btn-outline-danger btn-sm btn-delete-user" data-user="' + row.id + '" title="Hapus Pengguna"><i class="mdi mdi-delete"></i></button>';
                            return actions;
                        }}
                    ],
                    language: {
                        search: 'Cari:',
                        processing: 'Memproses...',
                        lengthMenu: 'Tampilkan _MENU_ data',
                        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ pengguna',
                        infoEmpty: 'Tidak ada pengguna',
                        infoFiltered: '(difilter dari _MAX_ pengguna)',
                        zeroRecords: 'Pengguna tidak ditemukan',
                        emptyTable: 'Belum ada data pengguna',
                        paginate: {
                            first: 'Pertama',
                            last: 'Terakhir',
                            next: 'Berikutnya',
                            previous: 'Sebelumnya'
                        }
                    },
                    responsive: true
                });

                $('#users-table').on('processing.dt', function(event, settings, processing) {
                    var search = $.trim($(settings.nTableWrapper).find('input[type="search"]').val() || '');

                    if (processing && search.length > 0 && search.length < 3) {
                        $(settings.nTableWrapper).find('.dataTables_processing').hide();
                    }
                });

                $('#users-table_filter input').attr('placeholder', 'Minimal 3 huruf');
            }

            function refreshRows() {
                usersTable.ajax.reload(null, false);
            }

            initializeDataTable();

            $('#btn-create-user').on('click', function() {
                resetForm();
                $('#user-modal').modal('show');
            });

            $(document).on('click', '.btn-edit-user', function() {
                var user = users[$(this).data('user')];
                if (!user) return;
                resetForm();
                editingId = user.id;
                $('#user-modal-title').text('Edit Pengguna');
                $('#user-name').val(user.name);
                $('#user-name-gelar').val(user.name_gelar);
                $('#user-username').val(user.username);
                $('#user-email').val(user.email);
                $('#user-role').val(user.role);
                $('#user-jk').val(user.jk);
                $('#user-nohp').val(user.nohp);
                $('#user-alamat').val(user.alamat);
                $('.password-required').hide();
                $('#user-password, #user-password-confirmation').prop('required', false);
                $('#password-help').text('Kosongkan jika password tidak ingin diubah.');
                $('#user-modal').modal('show');
            });

            $('#user-form').on('submit', function(event) {
                event.preventDefault();
                var $button = $('#btn-save-user').prop('disabled', true);
                $.ajax({
                    url: editingId ? userUrl + '/' + editingId : userUrl,
                    method: editingId ? 'PUT' : 'POST',
                    data: $(this).serialize()
                }).done(function(response) {
                    $('#user-modal').modal('hide');
                    alertify.success(response.message);
                    refreshRows();
                }).fail(showErrors).always(function() {
                    $button.prop('disabled', false);
                });
            });

            $(document).on('click', '.btn-delete-user', function() {
                var id = $(this).data('user');
                if (!confirm('Hapus pengguna ini?')) return;
                $.ajax({
                    url: userUrl + '/' + id,
                    method: 'DELETE'
                }).done(function(response) {
                    alertify.success(response.message);
                    refreshRows();
                }).fail(showErrors);
            });
        });
    </script>
@endsection
