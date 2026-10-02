@extends('layouts.master')

@section('title', 'Ruang Live Chat — ' . $session->nama_pengunjung)

@section('css')
<style>
    :root {
        --green:      #007f5f;
        --green-dark: #005f47;
        --green-light:#00a878;
        --green-pale: #e8f5f1;
        --gold:       #c9a84c;
        --radius:     14px;
        --radius-sm:  9px;
    }

    body { background: #f4f7f6 !important; }

    .chat-room-layout {
        display: flex;
        gap: 20px;
        height: calc(100vh - 160px);
        min-height: 580px;
    }

    /* LEFT: Sidebar Info Pengunjung */
    .chat-sidebar-info {
        width: 320px;
        flex-shrink: 0;
        background: #ffffff;
        border-radius: var(--radius);
        border: 1px solid #eef2f0;
        box-shadow: 0 2px 14px rgba(0,0,0,.06);
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .visitor-profile-header {
        text-align: center;
        padding-bottom: 16px;
        border-bottom: 1px solid #eef2f0;
        margin-bottom: 16px;
    }

    .visitor-avatar-large {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        color: #fff;
        font-size: 26px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        box-shadow: 0 4px 12px rgba(0,127,95,.2);
    }

    /* RIGHT: Chat Conversation Area */
    .chat-main-area {
        flex: 1;
        background: #ffffff;
        border-radius: var(--radius);
        border: 1px solid #eef2f0;
        box-shadow: 0 2px 14px rgba(0,0,0,.06);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .chat-topbar {
        background: #ffffff;
        border-bottom: 1px solid #eef2f0;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chat-messages-area {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Chat Bubbles */
    .chat-bubble-wrap {
        display: flex;
        flex-direction: column;
        max-width: 75%;
    }

    .chat-bubble-wrap.operator {
        align-self: flex-end;
        align-items: flex-end;
    }

    .chat-bubble-wrap.visitor {
        align-self: flex-start;
        align-items: flex-start;
    }

    .bubble-author {
        font-size: 11px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 3px;
        padding: 0 4px;
    }

    .bubble-text {
        padding: 10px 15px;
        border-radius: 14px;
        font-size: 13.5px;
        line-height: 1.5;
        word-break: break-word;
    }

    .chat-bubble-wrap.operator .bubble-text {
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        color: #ffffff;
        border-bottom-right-radius: 2px;
        box-shadow: 0 2px 8px rgba(0,127,95,.2);
    }

    .chat-bubble-wrap.visitor .bubble-text {
        background: #ffffff;
        color: #1f2937;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 2px;
        box-shadow: 0 2px 6px rgba(0,0,0,.04);
    }

    .bubble-system {
        align-self: center;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        color: #4b5563;
        font-size: 12px;
        padding: 6px 14px;
        border-radius: 20px;
        font-style: italic;
    }

    .bubble-time {
        font-size: 10px;
        opacity: 0.75;
        margin-top: 4px;
        display: block;
        text-align: right;
    }

    /* Chat Footer & Templates */
    .chat-footer-area {
        background: #ffffff;
        border-top: 1px solid #eef2f0;
        padding: 12px 18px;
    }

    .canned-templates {
        display: flex;
        gap: 6px;
        overflow-x: auto;
        padding-bottom: 8px;
        margin-bottom: 8px;
    }

    .btn-template {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 12px;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.15s;
    }

    .btn-template:hover {
        background: #166534;
        color: #fff;
    }

    .chat-input-box {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .btn-send-reply {
        background: linear-gradient(135deg, var(--green) 0%, var(--green-light) 100%);
        color: #fff;
        border: none;
        padding: 10px 22px;
        font-weight: 700;
        border-radius: var(--radius-sm);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        box-shadow: 0 3px 10px rgba(0,127,95,.2);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <div class="chat-room-layout">
        {{-- LEFT SIDEBAR: Info Pengunjung & Kontrol --}}
        <div class="chat-sidebar-info">
            <div>
                <div class="mb-3">
                    <a href="{{ route('admin.livechat.index') }}" class="btn btn-outline-secondary btn-sm font-weight-bold">
                        <i class="mdi mdi-arrow-left mr-1"></i> Kembali ke Antrian
                    </a>
                </div>

                <div class="visitor-profile-header">
                    <div class="visitor-avatar-large">
                        {{ strtoupper(substr($session->nama_pengunjung, 0, 1)) }}
                    </div>
                    <h5 class="font-weight-bold mb-1">{{ $session->nama_pengunjung }}</h5>
                    <span class="badge badge-warning font-weight-bold">Nomor Antrian #{{ $session->antrian_nomor }}</span>
                </div>

                <ul class="list-unstyled small mb-0">
                    <li class="py-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">Topik Layanan:</span>
                        <strong class="text-primary">{{ $session->topik ?: 'Layanan Umum' }}</strong>
                    </li>
                    <li class="py-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">No. WhatsApp:</span>
                        <strong>{{ $session->nohp_pengunjung ?: '-' }}</strong>
                    </li>
                    <li class="py-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">Email:</span>
                        <span>{{ $session->email_pengunjung ?: '-' }}</span>
                    </li>
                    <li class="py-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">Waktu Masuk:</span>
                        <span>{{ $session->created_at->format('H:i') }} WIB</span>
                    </li>
                    <li class="py-2 border-bottom d-flex justify-content-between">
                        <span class="text-muted">Status Chat:</span>
                        <span id="badge-session-status" class="badge {{ $session->status === 'aktif' ? 'badge-success' : 'badge-secondary' }}">
                            {{ ucfirst($session->status) }}
                        </span>
                    </li>
                </ul>
            </div>

            <div class="pt-3 border-top">
                @if($session->status !== 'selesai')
                    <form action="{{ route('admin.livechat.close', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan sesi ini?');">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block font-weight-bold">
                            <i class="mdi mdi-check-all mr-1"></i> Selesaikan Chat
                        </button>
                    </form>
                @endif
                <a href="{{ route('admin.livechat.transcript', $session->id) }}" target="_blank" class="btn btn-outline-info btn-block btn-sm mt-2">
                    <i class="mdi mdi-printer mr-1"></i> Cetak Transkrip
                </a>
            </div>
        </div>

        {{-- RIGHT: Area Chat Aktif --}}
        <div class="chat-main-area">
            {{-- Topbar --}}
            <div class="chat-topbar">
                <div class="d-flex align-items-center">
                    <span class="badge badge-success mr-2 font-weight-bold px-2 py-1">LIVE CHAT</span>
                    <span class="font-weight-bold text-dark">Percakapan dengan {{ $session->nama_pengunjung }}</span>
                </div>
                <div>
                    <span class="text-muted small">
                        <i class="mdi mdi-account-tie mr-1 text-success"></i> Petugas: <strong>{{ auth()->user()->name_gelar ?: auth()->user()->name }}</strong>
                    </span>
                </div>
            </div>

            {{-- Messages Stream --}}
            <div class="chat-messages-area" id="chat-messages-area">
                @foreach($session->messages as $msg)
                    @if($msg->sender_type === 'system')
                        <div class="bubble-system" id="msg-{{ $msg->id }}">
                            {{ $msg->pesan }}
                        </div>
                    @else
                        @php $isOperator = ($msg->sender_type === 'operator'); @endphp
                        <div class="chat-bubble-wrap {{ $isOperator ? 'operator' : 'visitor' }}" id="msg-{{ $msg->id }}">
                            <span class="bubble-author">{{ $msg->sender_name }}</span>
                            <div class="bubble-text">
                                {!! nl2br(e($msg->pesan)) !!}
                                <span class="bubble-time">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Footer & Reply Input --}}
            <div class="chat-footer-area">
                {{-- Template Balasan Cepat --}}
                <div class="canned-templates">
                    <span class="btn-template" onclick="insertTemplate('Assalamu\'alaikum Warahmatullahi Wabarakatuh. Ada yang bisa kami bantu?')">Sapaan Pembuka</span>
                    <span class="btn-template" onclick="insertTemplate('Baik bapak/ibu, mohon ditunggu sebentar sedang kami konfirmasikan ke komisi terkait.')">Sedang Dicek</span>
                    <span class="btn-template" onclick="insertTemplate('Silakan melampirkan berkas persyaratan atau mengajukan melalui menu Layanan di portal MUI.')">Syarat Berkas</span>
                    <span class="btn-template" onclick="insertTemplate('Apakah ada hal lain yang ingin bapak/ibu tanyakan sebelum sesi kami akhiri?')">Konfirmasi Akhir</span>
                    <span class="btn-template" onclick="insertTemplate('Sama-sama bapak/ibu. Semoga berkah dan sehat selalu. Wassalamu\'alaikum Warahmatullahi Wabarakatuh.')">Penutup Salam</span>
                </div>

                <form id="form-send-reply" class="chat-input-box">
                    <input type="text"
                           id="input-reply-text"
                           class="form-control"
                           placeholder="Ketik balasan Anda untuk masyarakat..."
                           autocomplete="off"
                           {{ $session->status === 'selesai' ? 'disabled' : '' }}
                           required>
                    <button type="submit" class="btn-send-reply" id="btn-submit-reply" {{ $session->status === 'selesai' ? 'disabled' : '' }}>
                        <i class="mdi mdi-send"></i> Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    let lastMessageId = {{ $session->messages->max('id') ?? 0 }};
    const $messagesContainer = $('#chat-messages-area');
    const $formReply = $('#form-send-reply');
    const $inputReply = $('#input-reply-text');
    const $btnSubmit = $('#btn-submit-reply');
    const csrfToken = $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    function scrollToBottom() {
        const el = $messagesContainer[0];
        if (el) {
            $messagesContainer.stop().animate({ scrollTop: el.scrollHeight }, 200);
        }
    }

    window.insertTemplate = function(text) {
        $inputReply.val(text).focus();
    };

    function playVisitorMessageChime() {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);

            osc.frequency.setValueAtTime(587.33, ctx.currentTime);
            osc.frequency.setValueAtTime(880, ctx.currentTime + 0.1);
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.35);

            osc.start(ctx.currentTime);
            osc.stop(ctx.currentTime + 0.35);
        } catch(e) {}
    }

    scrollToBottom();

    // ── KIRIM PESAN DENGAN JQUERY AJAX ──
    $formReply.on('submit', function(e) {
        e.preventDefault();

        const text = $.trim($inputReply.val());
        if (!text) return;

        // Reset input segera agar responsif
        $inputReply.val('');
        $btnSubmit.prop('disabled', true).html('<i class="mdi mdi-loading mdi-spin"></i>');

        // Optimistic UI Append
        const tempId = 'temp_' + Date.now();
        const nowTime = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace('.', ':');
        appendMessage({
            id: tempId,
            sender_type: 'operator',
            sender_name: '{{ auth()->user()->name_gelar ?: auth()->user()->name }}',
            pesan: text,
            time: nowTime + ' <i class="mdi mdi-clock-outline text-muted"></i>'
        });

        $.ajax({
            url: "{{ route('admin.livechat.send', $session->id) }}",
            type: "POST",
            dataType: "json",
            data: {
                pesan: text,
                _token: csrfToken
            },
            success: function(response) {
                $btnSubmit.prop('disabled', false).html('<i class="mdi mdi-send"></i> Kirim');
                if (response.success && response.message) {
                    // Update temp ID dengan ID resmi database
                    $('#msg-' + tempId).attr('id', 'msg-' + response.message.id)
                        .find('.bubble-time').html(response.message.time + ' <i class="mdi mdi-check text-white"></i>');

                    if (response.message.id > lastMessageId) {
                        lastMessageId = response.message.id;
                    }
                }
            },
            error: function(xhr, status, error) {
                $btnSubmit.prop('disabled', false).html('<i class="mdi mdi-send"></i> Kirim');
                // Kembalikan teks jika gagal
                $inputReply.val(text);
                $('#msg-' + tempId).remove();
                if (typeof window.showToast === 'function') {
                    window.showToast('error', 'Gagal mengirim pesan ke pengunjung. Silakan periksa koneksi Anda.');
                } else {
                    alert('Gagal mengirim pesan: ' + (xhr.responseJSON?.message || error));
                }
            }
        });
    });

    // ── REALTIME POLLING VIA JQUERY AJAX (Setiap 1.2 detik) ──
    let isPolling = false;
    function pollNewMessages() {
        if (isPolling) return;
        isPolling = true;

        $.ajax({
            url: "{{ route('admin.livechat.poll-session', $session->id) }}",
            type: "GET",
            dataType: "json",
            data: {
                last_id: lastMessageId
            },
            success: function(data) {
                isPolling = false;

                if (data.status === 'selesai') {
                    $('#badge-session-status').removeClass('badge-success').addClass('badge-secondary').text('Selesai');
                    $inputReply.prop('disabled', true).attr('placeholder', 'Sesi percakapan telah diselesaikan.');
                    $btnSubmit.prop('disabled', true);
                }

                if (data.messages && data.messages.length > 0) {
                    let hasNewVisitorMsg = false;
                    $.each(data.messages, function(i, msg) {
                        if (appendMessage(msg)) {
                            if (msg.sender_type === 'pengunjung') {
                                hasNewVisitorMsg = true;
                            }
                        }
                    });

                    if (hasNewVisitorMsg) {
                        playVisitorMessageChime();
                    }
                }
            },
            error: function() {
                isPolling = false;
            }
        });
    }

    // Jalankan polling setiap 1200ms
    const realTimeInterval = setInterval(pollNewMessages, 1200);

    // Hentikan interval jika halaman di-unload
    $(window).on('beforeunload', function() {
        clearInterval(realTimeInterval);
    });

    function appendMessage(msg) {
        if ($('#msg-' + msg.id).length > 0) return false;

        if (typeof msg.id === 'number' && msg.id > lastMessageId) {
            lastMessageId = msg.id;
        }

        if (msg.sender_type === 'system') {
            const $div = $('<div>')
                .addClass('bubble-system')
                .attr('id', 'msg-' + msg.id)
                .text(msg.pesan);
            $messagesContainer.append($div);
        } else {
            const isOperator = (msg.sender_type === 'operator');
            const wrapClass = isOperator ? 'operator' : 'visitor';
            const $wrap = $('<div>').addClass('chat-bubble-wrap ' + wrapClass).attr('id', 'msg-' + msg.id);

            let formattedText = escapeHtml(msg.pesan).replace(/\n/g, '<br>');
            formattedText = formattedText.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

            $wrap.html(`
                <span class="bubble-author">${escapeHtml(msg.sender_name)}</span>
                <div class="bubble-text">
                    ${formattedText}
                    <span class="bubble-time">${msg.time || ''}</span>
                </div>
            `);

            $messagesContainer.append($wrap);
        }

        scrollToBottom();
        return true;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return $('<div>').text(str).html();
    }
});
</script>
@endsection
