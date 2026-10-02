@extends('layouts.master')

@section('title', 'Edit Hak Akses Operator - ' . ($user->name_gelar ?: $user->name))

@section('css')
<style>
    :root {
        --green: #007f5f;
        --green-dark: #005f47;
        --green-light: #00a878;
        --radius: 14px;
        --shadow: 0 2px 16px rgba(0,0,0,.06);
    }

    .edit-header {
        background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%);
        border-radius: var(--radius);
        padding: 24px 28px;
        margin-bottom: 24px;
        color: #fff;
    }

    .permission-group-title {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--green-dark);
        margin: 20px 0 12px;
        padding-bottom: 6px;
        border-bottom: 1.5px solid #eef3f1;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .permission-card {
        background: #ffffff;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        padding: 16px 18px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: flex-start;
        gap: 12px;
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
        width: 18px;
        height: 18px;
        margin-top: 3px;
        cursor: pointer;
        accent-color: var(--green);
    }
</style>
@endsection

@section('content')
<div class="container-fluid" style="padding: 24px 30px;">

    <div class="mb-3">
        <a href="{{ route('admin.operator-permissions.index') }}" class="btn btn-outline-secondary btn-sm font-weight-bold">
            <i class="mdi mdi-arrow-left mr-1"></i> Kembali ke Daftar Hak Akses
        </a>
    </div>

    <div class="edit-header">
        <h4 class="font-weight-bold text-white mb-1">
            <i class="mdi mdi-account-key mr-1"></i> Pembagian Tugas: {{ $user->name_gelar ?: $user->name }}
        </h4>
        <p class="mb-0 text-white-50">Username: <strong>{{ $user->username }}</strong> · Email: {{ $user->email }}</p>
    </div>

    <div class="card" style="border-radius: var(--radius); border: none; box-shadow: var(--shadow);">
        <div class="card-body p-4">
            <form action="{{ route('admin.operator-permissions.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                    <span class="font-weight-bold text-muted small">PILIH MENU YANG DIBERIKAN:</span>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-info font-weight-bold mr-1" onclick="applyDefaultPerms()">
                            <i class="mdi mdi-star-outline mr-1"></i> Default (Berita & Layanan)
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-success font-weight-bold mr-1" onclick="$('.permission-checkbox').prop('checked', true); $('.permission-card').addClass('selected');">
                            <i class="mdi mdi-checkbox-multiple-marked mr-1"></i> Pilih Semua
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger font-weight-bold" onclick="$('.permission-checkbox').prop('checked', false); $('.permission-card').removeClass('selected');">
                            <i class="mdi mdi-checkbox-blank-outline mr-1"></i> Kosongkan
                        </button>
                    </div>
                </div>

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
                            @php $isChecked = in_array($key, $assignedPermissions, true); @endphp
                            <div class="col-md-6 mb-2">
                                <label class="permission-card {{ $isChecked ? 'selected' : '' }}" for="chk-{{ $key }}">
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="{{ $key }}"
                                           id="chk-{{ $key }}"
                                           class="permission-checkbox"
                                           {{ $isChecked ? 'checked' : '' }}
                                           onchange="$(this).closest('.permission-card').toggleClass('selected', $(this).is(':checked'))">
                                    <div class="permission-info">
                                        <div class="font-weight-bold text-dark">
                                            <i class="{{ $item['icon'] }} text-success mr-1"></i>
                                            {{ $item['label'] }}
                                        </div>
                                        <p class="text-muted small mb-0">{{ $item['description'] }}</p>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.operator-permissions.index') }}" class="btn btn-secondary font-weight-bold mr-2">Batal</a>
                    <button type="submit" class="btn btn-success font-weight-bold px-4">
                        <i class="mdi mdi-content-save mr-1"></i> Simpan Hak Akses
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('javascript')
<script>
const defaultKeys = @json(\App\Models\User::DEFAULT_OPERATOR_PERMISSIONS);
function applyDefaultPerms() {
    $('.permission-checkbox').prop('checked', false);
    $('.permission-card').removeClass('selected');
    defaultKeys.forEach(function(key) {
        $('#chk-' + key).prop('checked', true);
        $('#chk-' + key).closest('.permission-card').addClass('selected');
    });
}
</script>
@endsection
