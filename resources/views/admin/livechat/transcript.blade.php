<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Percakapan Live Chat #{{ $session->antrian_nomor }} — MUI Batanghari</title>
    <link rel="icon" type="image/png" href="{{ asset('gambar/mui.png') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <style>
        body {
            background: #ffffff;
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            padding: 30px;
        }
        .header-kop {
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .header-kop img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .kop-text {
            text-align: center;
            flex: 1;
        }
        .kop-text h4 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .kop-text h3 {
            font-size: 20px;
            font-weight: bold;
            margin: 2px 0;
            color: #005f47;
        }
        .kop-text p {
            margin: 0;
            font-size: 12px;
        }
        .transcript-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .transcript-title h5 {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 4px;
        }
        .table-meta td {
            padding: 4px 8px;
            font-size: 13px;
        }
        .chat-log {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 14px;
        }
        .chat-line {
            padding: 8px 0;
            border-bottom: 1px dotted #e5e7eb;
            font-size: 13px;
        }
        .chat-sender {
            font-weight: bold;
            color: #005f47;
        }
        .chat-time {
            font-size: 11px;
            color: #666;
            margin-left: 8px;
        }
        .chat-bubble-text {
            margin-top: 2px;
            line-height: 1.4;
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <div class="no-print text-right mb-4">
        <button onclick="window.print()" class="btn btn-success font-weight-bold">
            <i class="fas fa-print"></i> Cetak Dokumen / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary font-weight-bold ml-2">
            Tutup
        </button>
    </div>

    {{-- KOP SURAT --}}
    <div class="header-kop">
        <img src="{{ asset('gambar/mui.png') }}" alt="Logo MUI">
        <div class="kop-text">
            <h4>Majelis Ulama Indonesia (MUI)</h4>
            <h3>DEWAN PIMPINAN KABUPATEN BATANGHARI</h3>
            <p>Sekretariat: Komplek Islamic Center Muara Bulian, Kab. Batanghari, Jambi</p>
            <p>Telepon: 0812-7483-9201 | Email: sekretariat@muibatanghari.or.id</p>
        </div>
    </div>

    <div class="transcript-title">
        <h5>TRANSKRIP PERCAKAPAN LAYANAN LIVE CHAT</h5>
        <span class="small text-muted">ID Sesi: {{ $session->session_token }}</span>
    </div>

    <table class="table-meta mb-3" style="width: 100%;">
        <tr>
            <td style="width: 25%;"><strong>Nomor Antrian</strong></td>
            <td style="width: 2%;">:</td>
            <td>#{{ $session->antrian_nomor }}</td>
            <td style="width: 25%;"><strong>Waktu Masuk</strong></td>
            <td style="width: 2%;">:</td>
            <td>{{ $session->created_at->translatedFormat('d F Y H:i:s') }} WIB</td>
        </tr>
        <tr>
            <td><strong>Nama Pengunjung</strong></td>
            <td>:</td>
            <td>{{ $session->nama_pengunjung }}</td>
            <td><strong>Waktu Selesai</strong></td>
            <td>:</td>
            <td>{{ $session->closed_at ? $session->closed_at->translatedFormat('d F Y H:i:s') . ' WIB' : 'Sedang Berlangsung' }}</td>
        </tr>
        <tr>
            <td><strong>No. WhatsApp / Telp</strong></td>
            <td>:</td>
            <td>{{ $session->nohp_pengunjung ?: '-' }}</td>
            <td><strong>Petugas Pelayan</strong></td>
            <td>:</td>
            <td>{{ $session->operator ? ($session->operator->name_gelar ?: $session->operator->name) : 'MUI Bot / Asisten Virtual' }}</td>
        </tr>
        <tr>
            <td><strong>Topik Layanan</strong></td>
            <td>:</td>
            <td colspan="4">{{ $session->topik ?: 'Layanan Umum' }}</td>
        </tr>
    </table>

    <div class="chat-log">
        <h6 class="font-weight-bold mb-3">Isi Percakapan:</h6>
        @forelse($session->messages as $msg)
            <div class="chat-line">
                <span class="chat-sender">[{{ $msg->sender_name }}]</span>
                <span class="chat-time">{{ $msg->created_at->format('d/m/Y H:i:s') }}</span>
                <div class="chat-bubble-text">
                    {!! nl2br(e($msg->pesan)) !!}
                </div>
            </div>
        @empty
            <p class="text-muted font-italic">Tidak ada riwayat pesan.</p>
        @endforelse
    </div>

    <div class="mt-5 pt-4 text-right" style="font-size: 13px;">
        <p class="mb-1">Muara Bulian, {{ now()->translatedFormat('d F Y') }}</p>
        <p class="mb-5 font-weight-bold">Petugas / Operator Layanan,</p>
        <p class="font-weight-bold mb-0"><u>{{ $session->operator ? ($session->operator->name_gelar ?: $session->operator->name) : 'Sekretariat MUI Batanghari' }}</u></p>
    </div>

</body>
</html>
