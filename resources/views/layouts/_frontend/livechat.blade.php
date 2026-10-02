{{-- ============================================================
     MUI BATANGHARI — FLOATING LIVE CHAT & CHATBOT WIDGET
     ============================================================ --}}

@php
    $chatIsEnabled = \App\Models\Setting::get('chat_is_enabled', '1') !== '0';
@endphp

@if($chatIsEnabled)
<div id="mui-livechat-container">
    {{-- Trigger Floating Button Pill Tooltip --}}
    <div id="mui-livechat-pill" class="mui-chat-pill" onclick="document.getElementById('mui-livechat-trigger').click()">
        <span class="mui-pill-pulse"></span>
        <span class="mui-pill-text">Butuh Bantuan? <strong>Chat MUI</strong></span>
        <button type="button" class="mui-pill-close" onclick="dismissChatPill(event)" aria-label="Tutup pesan">&times;</button>
    </div>

    {{-- Main Circular Trigger Button with Official MUI Logo --}}
    <button id="mui-livechat-trigger" class="mui-chat-trigger" aria-label="Buka Live Chat MUI" title="Layanan Live Chat MUI Batanghari">
        {{-- State 1: Chat Sedang Tertutup (Logo MUI + Icon Chat) --}}
        <div class="mui-icon-open-state">
            <img src="{{ asset('gambar/mui.png') }}" alt="Logo MUI" class="mui-trigger-logo">
            <span class="mui-trigger-chat-badge" title="Live Chat">
                <svg viewBox="0 0 24 24" width="13" height="13" fill="#ffffff">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
            </span>
        </div>

        {{-- State 2: Chat Terbuka (Icon Silang Tutup) --}}
        <div class="mui-icon-close-state">
            <svg viewBox="0 0 24 24" width="22" height="22" stroke="#ffffff" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </div>

        {{-- Status Kehadiran Petugas --}}
        <span id="mui-chat-status-dot" class="mui-status-dot offline" title="Status Petugas"></span>
    </button>

    {{-- Chat Box Window --}}
    <div id="mui-livechat-window" class="mui-chat-window">
        {{-- Header --}}
        <div class="mui-chat-header">
            <div class="mui-header-avatar">
                <img src="{{ asset('gambar/mui.png') }}" alt="MUI">
            </div>
            <div class="mui-header-info">
                <h6 class="mui-header-title">Live Chat MUI Batanghari</h6>
                <div class="mui-header-status" id="mui-header-status-text">
                    <span class="status-indicator"></span>
                    <span id="mui-status-label">Memeriksa status...</span>
                </div>
            </div>
            <div class="mui-header-actions">
                <button type="button" class="mui-btn-icon" id="mui-btn-minimize" title="Tutup Chat">
                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2.5" fill="none">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Body --}}
        <div class="mui-chat-body">
            {{-- VIEW 1: Form Registrasi Masuk / Mulai Chat --}}
            <div id="mui-chat-view-start" class="mui-chat-view">
                <div class="mui-welcome-card">
                    <div class="mui-welcome-icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="#007f5f">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                        </svg>
                    </div>
                    <h6>Layanan Interaktif Masyarakat</h6>
                    <p id="mui-welcome-desc">Sampaikan pertanyaan seputar fatwa, konsultasi syariah, atau layanan MUI Batanghari secara langsung.</p>
                    <div class="mui-hours-badge" id="mui-hours-badge">
                        <svg viewBox="0 0 24 24" width="12" height="12" fill="currentColor" class="mr-1" style="vertical-align: -1px;">
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm4.2 14.2L11 13V7h1.5v5.2l4.5 2.7-.8 1.3z"/>
                        </svg>
                        <span id="mui-hours-text">Senin – Jumat, 08:00 – 16:00 WIB</span>
                    </div>
                </div>

                <form id="mui-chat-start-form" class="mui-start-form">
                    <div class="form-group mb-2">
                        <label for="chat_input_nama">Nama Anda <span class="text-danger">*</span></label>
                        <input type="text" id="chat_input_nama" class="form-control form-control-sm" placeholder="Contoh: Ahmad Fauzi" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="chat_input_nohp">No. WhatsApp / Telepon</label>
                        <input type="text" id="chat_input_nohp" class="form-control form-control-sm" placeholder="Contoh: 081234567890">
                    </div>

                    <div class="form-group mb-2">
                        <label for="chat_input_topik">Topik Pertanyaan</label>
                        <select id="chat_input_topik" class="form-control form-control-sm">
                            <option value="Konsultasi Syariah">Konsultasi Syariah & Keagamaan</option>
                            <option value="Fatwa & Sertifikasi Halal">Fatwa & Rekomendasi Halal</option>
                            <option value="Surat Rekomendasi">Layanan Surat & Rekomendasi</option>
                            <option value="Informasi Umum">Informasi & Bantuan Umum</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="chat_input_pesan">Pesan / Pertanyaan Awal</label>
                        <textarea id="chat_input_pesan" class="form-control form-control-sm" rows="2" placeholder="Tuliskan pertanyaan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" id="mui-btn-start-chat" class="btn btn-success btn-block mui-btn-submit">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor" class="mr-1" style="vertical-align: -2px;">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                        Mulai Percakapan
                    </button>
                </form>

                {{-- FAQ Cepat di Awal --}}
                <div class="mui-quick-faqs mt-3">
                    <div class="mui-quick-faq-title">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="#f59e0b" class="mr-1" style="vertical-align: -2px;">
                            <path d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-19C8.14 2 5 5.14 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.86-3.14-7-7-7z"/>
                        </svg>
                        Pertanyaan Sering Diajukan (FAQ):
                    </div>
                    <div id="mui-start-faq-list" class="mui-faq-chips"></div>
                </div>
            </div>

            {{-- VIEW 2: Antrian Menunggu Petugas --}}
            <div id="mui-chat-view-queue" class="mui-chat-view d-none">
                <div class="mui-queue-box">
                    <div class="mui-queue-spinner">
                        <div class="spinner-border text-success" role="status"></div>
                    </div>
                    <h5 class="mui-queue-title">Menghubungkan ke Petugas</h5>
                    <div class="mui-queue-badge">
                        Nomor Antrian: <strong id="mui-queue-number">#0</strong>
                    </div>

                    <div class="mui-queue-meta">
                        <div class="meta-item">
                            <span class="label">Posisi Antrian:</span>
                            <span class="value" id="mui-queue-pos">Urutan ke-1</span>
                        </div>
                        <div class="meta-item">
                            <span class="label">Estimasi Waktu Tunggu:</span>
                            <span class="value" id="mui-queue-est">~2 menit</span>
                        </div>
                    </div>

                    <p class="mui-queue-note">
                        Petugas kami sedang melayani antrian sebelumnya. Mohon tetap buka jendela ini, pesan Anda akan segera dibalas.
                    </p>

                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-danger btn-sm" id="mui-btn-cancel-queue">
                            Batalkan Antrian
                        </button>
                    </div>
                </div>
            </div>

            {{-- VIEW 3: Ruang Percakapan Chat Interaktif --}}
            <div id="mui-chat-view-room" class="mui-chat-view d-none">
                {{-- Banner Petugas / Bot --}}
                <div class="mui-room-banner" id="mui-room-banner">
                    <div class="d-flex align-items-center">
                        <div class="mui-operator-avatar" id="mui-room-avatar">M</div>
                        <div class="ml-2">
                            <div class="font-weight-bold" id="mui-room-operator-name">Petugas MUI</div>
                            <small class="text-muted" id="mui-room-operator-role">Customer Care & Layanan</small>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-danger btn-xs py-1 px-2" id="mui-btn-end-chat" title="Akhiri sesi percakapan">
                            Akhiri
                        </button>
                    </div>
                </div>

                {{-- Area Pesan --}}
                <div class="mui-messages-container" id="mui-messages-container"></div>

                {{-- Typing Indicator --}}
                <div id="mui-typing-indicator" class="mui-typing d-none">
                    <span></span><span></span><span></span>
                </div>

                {{-- FAQ Quick Chips Inside Room --}}
                <div id="mui-room-faqs" class="mui-room-faqs-area d-none">
                    <div class="mui-room-faq-header">Pilih FAQ Cepat:</div>
                    <div class="mui-room-faq-chips" id="mui-room-faq-list"></div>
                </div>

                {{-- Form Input Pesan --}}
                <div class="mui-chat-input-box">
                    <form id="mui-chat-send-form" class="d-flex align-items-center">
                        <input type="text"
                               id="mui-input-message"
                               class="form-control form-control-sm mui-chat-input"
                               placeholder="Ketik pesan Anda..."
                               autocomplete="off"
                               maxlength="2000"
                               required>
                        <button type="submit" class="btn btn-success mui-btn-send" id="mui-btn-send" title="Kirim">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CSS WIDGET LIVE CHAT & FLEXIBLE SCROLL-TOP --}}
<style>
/* === CONTAINER & FLOATING BUTTON === */
#mui-livechat-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 99999;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Horizontal pill tooltip positioned nicely to the left of the button */
.mui-chat-pill {
    position: absolute;
    bottom: 12px;
    right: 76px;
    background: #ffffff;
    color: #1a2e25;
    padding: 9px 15px 9px 13px;
    border-radius: 24px;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
    border: 1px solid #d1ebe1;
    font-size: 13px;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    z-index: 99998;
    transition: all 0.2s ease;
    animation: pillFadeIn 0.3s ease;
}

@keyframes pillFadeIn {
    from { opacity: 0; transform: translateX(8px); }
    to { opacity: 1; transform: translateX(0); }
}

.mui-chat-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 127, 95, 0.2);
}

.mui-chat-pill::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -6px;
    transform: translateY(-50%);
    border-width: 6px 0 6px 6px;
    border-style: solid;
    border-color: transparent transparent transparent #ffffff;
}

.mui-pill-pulse {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: pulseRing 1.8s infinite;
}

@keyframes pulseRing {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.mui-pill-close {
    background: none;
    border: none;
    color: #9ca3af;
    font-size: 16px;
    line-height: 1;
    cursor: pointer;
    padding: 0 0 0 4px;
}

.mui-pill-close:hover { color: #374151; }

/* Circular Button with Logo MUI */
.mui-chat-trigger {
    width: 62px;
    height: 62px;
    border-radius: 50%;
    background: #ffffff;
    border: 3px solid #007f5f;
    box-shadow: 0 6px 20px rgba(0, 127, 95, 0.35);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none !important;
    padding: 0;
}

.mui-chat-trigger:hover {
    transform: scale(1.06);
    box-shadow: 0 10px 26px rgba(0, 127, 95, 0.45);
}

.mui-icon-open-state {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    position: relative;
}

.mui-trigger-logo {
    width: 38px;
    height: 38px;
    object-fit: contain;
    display: block;
    filter: drop-shadow(0 1px 2px rgba(0,0,0,0.12));
}

.mui-trigger-chat-badge {
    position: absolute;
    bottom: 0px;
    right: 0px;
    background: #007f5f;
    color: #ffffff;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #ffffff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.25);
}

.mui-icon-close-state {
    display: none;
    color: #ffffff;
}

#mui-livechat-container.open .mui-chat-trigger {
    background: #ef4444;
    border-color: #ffffff;
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

#mui-livechat-container.open .mui-icon-open-state {
    display: none;
}

#mui-livechat-container.open .mui-icon-close-state {
    display: flex;
    align-items: center;
    justify-content: center;
}

.mui-status-dot {
    position: absolute;
    top: 1px;
    right: 1px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    border: 2px solid #fff;
}
.mui-status-dot.online { background: #10b981; }
.mui-status-dot.offline { background: #f59e0b; }

/* === FLEXIBLE INTEGRATION WITH SCROLL TOP BUTTON === */
.scroll-top-btn {
    position: fixed !important;
    bottom: 98px !important; /* Stacked harmoniously right above live chat button */
    right: 33px !important;  /* Centers with 62px livechat button (24 + 31 - 22 = 33px) */
    width: 44px !important;
    height: 44px !important;
    z-index: 99990 !important;
    border-radius: 50% !important;
    background: #007f5f !important;
    box-shadow: 0 4px 14px rgba(0, 127, 95, 0.35) !important;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.scroll-top-btn:hover {
    background: #005f47 !important;
    transform: translateY(-3px) scale(1.05) !important;
}

/* When chat window is open on screen, ensure scroll-top stays clean */
#mui-livechat-container.open ~ .scroll-top-btn {
    opacity: 0.3 !important;
    pointer-events: none !important;
}

@media (max-width: 576px) {
    #mui-livechat-container {
        bottom: 16px !important;
        right: 16px !important;
    }
    .mui-chat-trigger {
        width: 54px !important;
        height: 54px !important;
    }
    .mui-trigger-logo {
        width: 32px !important;
        height: 32px !important;
    }
    .mui-trigger-chat-badge {
        width: 19px !important;
        height: 19px !important;
    }
    .mui-chat-pill {
        display: none !important;
    }
    .scroll-top-btn {
        bottom: 80px !important;
        right: 23px !important;
        width: 40px !important;
        height: 40px !important;
    }
}

/* === CHAT WINDOW === */
.mui-chat-window {
    display: none;
    position: absolute;
    bottom: 74px;
    right: 0;
    width: 375px;
    max-width: calc(100vw - 32px);
    height: 570px;
    max-height: calc(100vh - 110px);
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
    border: 1px solid rgba(0, 127, 95, 0.15);
    flex-direction: column;
    overflow: hidden;
    animation: windowFadeIn 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

#mui-livechat-container.open .mui-chat-window {
    display: flex;
}

@keyframes windowFadeIn {
    from { opacity: 0; transform: translateY(12px) scale(0.96); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

/* Header */
.mui-chat-header {
    background: linear-gradient(135deg, #005f47 0%, #007f5f 100%);
    padding: 14px 16px;
    color: #ffffff;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 2px solid rgba(201, 168, 76, 0.4);
}

.mui-header-avatar {
    width: 38px;
    height: 38px;
    background: #ffffff;
    border-radius: 50%;
    padding: 3px;
    flex-shrink: 0;
}

.mui-header-avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.mui-header-info {
    flex: 1;
    min-width: 0;
}

.mui-header-title {
    font-size: 14.5px;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #ffffff;
}

.mui-header-status {
    font-size: 11px;
    color: rgba(255, 255, 255, 0.85);
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 2px;
}

.status-indicator {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #f59e0b;
    display: inline-block;
}
.status-indicator.online { background: #10b981; }

.mui-header-actions .mui-btn-icon {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #fff;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 12px;
    transition: background 0.15s;
}

.mui-header-actions .mui-btn-icon:hover { background: rgba(255, 255, 255, 0.25); }

/* Body */
.mui-chat-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    background: #f8faf9;
    position: relative;
}

.mui-chat-view {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    padding: 16px;
}

/* VIEW 1: Start */
.mui-welcome-card {
    background: #ffffff;
    border: 1px solid #e5ebe8;
    border-radius: 12px;
    padding: 14px;
    text-align: center;
    margin-bottom: 14px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
}

.mui-welcome-icon {
    font-size: 26px;
    color: #007f5f;
    margin-bottom: 6px;
}

.mui-welcome-card h6 {
    font-size: 13.5px;
    font-weight: 700;
    margin-bottom: 4px;
    color: #004a36;
}

.mui-welcome-card p {
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 8px;
    line-height: 1.4;
}

.mui-hours-badge {
    display: inline-block;
    background: #e8f5f1;
    color: #007f5f;
    border: 1px solid #cce8de;
    border-radius: 20px;
    padding: 3px 10px;
    font-size: 10.5px;
    font-weight: 600;
}

.mui-start-form label {
    font-size: 11.5px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 3px;
}

.mui-btn-submit {
    background: linear-gradient(135deg, #007f5f 0%, #00a878 100%);
    border: none;
    font-size: 13px;
    font-weight: 700;
    padding: 9px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 127, 95, 0.25);
    color: #fff;
}

.mui-quick-faqs {
    border-top: 1px dashed #d1d5db;
    padding-top: 12px;
}

.mui-quick-faq-title {
    font-size: 11.5px;
    font-weight: 700;
    color: #4b5563;
    margin-bottom: 8px;
}

.mui-faq-chips {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.mui-faq-chip-btn {
    background: #ffffff;
    border: 1px solid #d1ebe1;
    color: #00664d;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 600;
    text-align: left;
    cursor: pointer;
    transition: all 0.15s;
    line-height: 1.3;
}

.mui-faq-chip-btn:hover {
    background: #e8f5f1;
    border-color: #007f5f;
    color: #004a36;
}

/* VIEW 2: Queue */
.mui-queue-box {
    margin: auto 0;
    text-align: center;
    background: #ffffff;
    border: 1px solid #d4e8df;
    border-radius: 14px;
    padding: 24px 16px;
    box-shadow: 0 4px 14px rgba(0, 127, 95, 0.08);
}

.mui-queue-spinner { margin-bottom: 12px; }

.mui-queue-title {
    font-size: 16px;
    font-weight: 800;
    color: #004a36;
    margin-bottom: 10px;
}

.mui-queue-badge {
    display: inline-block;
    background: #f0f9f5;
    border: 2px dashed #00a878;
    color: #007f5f;
    font-size: 14px;
    padding: 6px 14px;
    border-radius: 10px;
    margin-bottom: 16px;
}

.mui-queue-meta {
    background: #f8faf9;
    border-radius: 8px;
    padding: 10px 14px;
    margin-bottom: 14px;
    text-align: left;
    font-size: 12px;
}

.mui-queue-meta .meta-item {
    display: flex;
    justify-content: space-between;
    padding: 4px 0;
}

.mui-queue-meta .label { color: #6b7280; }
.mui-queue-meta .value { font-weight: 700; color: #111827; }

.mui-queue-note {
    font-size: 11.5px;
    color: #6b7280;
    margin-bottom: 0;
    line-height: 1.4;
}

/* VIEW 3: Room */
#mui-chat-view-room {
    padding: 0;
}

.mui-room-banner {
    background: #ffffff;
    padding: 10px 14px;
    border-bottom: 1px solid #e5ebe8;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.mui-operator-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #c9a84c, #f0d080);
    color: #004a36;
    font-weight: 800;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.mui-operator-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.mui-messages-container {
    flex: 1;
    overflow-y: auto;
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Bubbles */
.mui-msg-bubble-wrap {
    display: flex;
    flex-direction: column;
    max-width: 82%;
}

.mui-msg-bubble-wrap.me {
    align-self: flex-end;
    align-items: flex-end;
}

.mui-msg-bubble-wrap.other {
    align-self: flex-start;
    align-items: flex-start;
}

.mui-msg-sender {
    font-size: 10px;
    color: #6b7280;
    margin-bottom: 2px;
    padding: 0 4px;
    font-weight: 600;
}

.mui-msg-bubble {
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 12.5px;
    line-height: 1.45;
    word-break: break-word;
    position: relative;
}

.mui-msg-bubble-wrap.me .mui-msg-bubble {
    background: linear-gradient(135deg, #007f5f 0%, #00a878 100%);
    color: #ffffff;
    border-bottom-right-radius: 2px;
}

.mui-msg-bubble-wrap.other .mui-msg-bubble {
    background: #ffffff;
    color: #1f2937;
    border: 1px solid #e5e7eb;
    border-bottom-left-radius: 2px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
}

.mui-msg-bubble.bot {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #064e3b;
}

.mui-msg-bubble.system {
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    color: #4b5563;
    font-style: italic;
    font-size: 11.5px;
    text-align: center;
    border-radius: 8px;
}

.mui-msg-time {
    font-size: 9.5px;
    margin-top: 3px;
    opacity: 0.7;
    text-align: right;
    display: block;
}

/* Room FAQs */
.mui-room-faqs-area {
    background: #ffffff;
    border-top: 1px solid #e5ebe8;
    padding: 8px 12px;
    max-height: 110px;
    overflow-y: auto;
}

.mui-room-faq-header {
    font-size: 10.5px;
    font-weight: 700;
    color: #6b7280;
    margin-bottom: 4px;
}

.mui-room-faq-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}

.mui-room-faq-chip {
    background: #e8f5f1;
    border: 1px solid #cce8de;
    color: #007f5f;
    border-radius: 12px;
    font-size: 10.5px;
    padding: 3px 8px;
    cursor: pointer;
}

.mui-room-faq-chip:hover {
    background: #007f5f;
    color: #fff;
}

/* Typing */
.mui-typing {
    padding: 6px 14px;
    display: flex;
    gap: 4px;
    align-items: center;
}

.mui-typing span {
    width: 6px;
    height: 6px;
    background: #007f5f;
    border-radius: 50%;
    animation: typingBounce 1.2s infinite ease-in-out;
}

.mui-typing span:nth-child(2) { animation-delay: 0.2s; }
.mui-typing span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typingBounce {
    0%, 80%, 100% { transform: translateY(0); opacity: 0.4; }
    40% { transform: translateY(-5px); opacity: 1; }
}

/* Input Area */
.mui-chat-input-box {
    background: #ffffff;
    border-top: 1px solid #e5ebe8;
    padding: 10px 12px;
}

.mui-chat-input {
    border-radius: 20px;
    padding: 8px 14px;
    font-size: 12.5px;
    border: 1px solid #d1d5db;
}

.mui-chat-input:focus {
    border-color: #007f5f;
    box-shadow: 0 0 0 2px rgba(0, 127, 95, 0.15);
}

.mui-btn-send {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 8px;
    flex-shrink: 0;
    padding: 0;
    background: #007f5f;
    border-color: #007f5f;
}

.mui-btn-send:hover {
    background: #005f47;
    border-color: #005f47;
}
</style>

{{-- JAVASCRIPT LOGIC CLIENT LIVE CHAT --}}
<script>
(function() {
    let chatState = {
        token: localStorage.getItem('mui_livechat_token') || null,
        status: null, // 'bot', 'menunggu', 'aktif', 'selesai'
        isOperational: false,
        faqs: [],
        lastMessageId: 0,
        pollingTimer: null,
        sseSource: null
    };

    const container = document.getElementById('mui-livechat-container');
    const trigger = document.getElementById('mui-livechat-trigger');
    const pill = document.getElementById('mui-livechat-pill');
    const btnMinimize = document.getElementById('mui-btn-minimize');
    const statusDot = document.getElementById('mui-chat-status-dot');
    const statusTextLabel = document.getElementById('mui-status-label');
    const statusIndicator = document.querySelector('.status-indicator');
    const hoursText = document.getElementById('mui-hours-text');
    const startFaqList = document.getElementById('mui-start-faq-list');
    const roomFaqList = document.getElementById('mui-room-faq-list');

    // Views
    const viewStart = document.getElementById('mui-chat-view-start');
    const viewQueue = document.getElementById('mui-chat-view-queue');
    const viewRoom = document.getElementById('mui-chat-view-room');

    // Forms
    const startForm = document.getElementById('mui-chat-start-form');
    const sendForm = document.getElementById('mui-chat-send-form');
    const inputMessage = document.getElementById('mui-input-message');
    const messagesContainer = document.getElementById('mui-messages-container');

    // Queue Elements
    const queueNumber = document.getElementById('mui-queue-number');
    const queuePos = document.getElementById('mui-queue-pos');
    const queueEst = document.getElementById('mui-queue-est');
    const btnCancelQueue = document.getElementById('mui-btn-cancel-queue');
    const btnEndChat = document.getElementById('mui-btn-end-chat');

    // Audio chime generator using Web Audio API
    function playChime(type = 'message') {
        try {
            const ctx = new (window.AudioContext || window.webkitAudioContext)();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);

            if (type === 'message') {
                osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
                osc.frequency.setValueAtTime(880, ctx.currentTime + 0.1); // A5
                gain.gain.setValueAtTime(0.15, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.35);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.35);
            } else if (type === 'connected') {
                osc.frequency.setValueAtTime(523.25, ctx.currentTime); // C5
                osc.frequency.setValueAtTime(659.25, ctx.currentTime + 0.12); // E5
                osc.frequency.setValueAtTime(783.99, ctx.currentTime + 0.24); // G5
                gain.gain.setValueAtTime(0.2, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);
                osc.start(ctx.currentTime);
                osc.stop(ctx.currentTime + 0.5);
            }
        } catch(e) {}
    }

    window.dismissChatPill = function(e) {
        e.stopPropagation();
        if (pill) pill.style.display = 'none';
    };

    // Toggle window
    trigger.addEventListener('click', function() {
        container.classList.toggle('open');
        if (container.classList.contains('open')) {
            if (pill) pill.style.display = 'none';
            scrollToBottom();
        }
    });

    btnMinimize.addEventListener('click', function() {
        container.classList.remove('open');
    });

    // 1. Initial Load
    function initLiveChat() {
        const url = '{{ route('livechat.init') }}' + (chatState.token ? '?token=' + encodeURIComponent(chatState.token) : '');

        fetch(url)
            .then(res => res.json())
            .then(data => {
                chatState.isOperational = data.is_operational;
                chatState.faqs = data.faqs || [];

                // Status text & indicator
                if (data.is_operational) {
                    statusDot.className = 'mui-status-dot online';
                    statusIndicator.className = 'status-indicator online';
                    statusTextLabel.textContent = 'Petugas Online (Jam Kerja)';
                } else {
                    statusDot.className = 'mui-status-dot offline';
                    statusIndicator.className = 'status-indicator offline';
                    statusTextLabel.textContent = 'Di Luar Jam Kerja (MUI Bot)';
                }

                if (hoursText) hoursText.textContent = data.schedule_text;

                renderFaqChips(chatState.faqs);

                // Handle existing session
                if (data.session) {
                    chatState.status = data.session.status;
                    handleSessionState(data.session);

                    if (data.messages && data.messages.length > 0) {
                        data.messages.forEach(msg => appendMessage(msg));
                    }

                    startRealtimeSync();
                } else {
                    switchView('start');
                }
            })
            .catch(err => {
                console.error('LiveChat init failed', err);
                statusTextLabel.textContent = 'Asisten Layanan MUI';
            });
    }

    function renderFaqChips(faqs) {
        if (!faqs || faqs.length === 0) return;

        let startHtml = '';
        let roomHtml = '';

        faqs.forEach(f => {
            startHtml += `<button type="button" class="mui-faq-chip-btn" data-faq-id="${f.id}">${escapeHtml(f.pertanyaan)}</button>`;
            roomHtml += `<button type="button" class="mui-room-faq-chip" data-faq-id="${f.id}">${escapeHtml(f.pertanyaan)}</button>`;
        });

        if (startFaqList) startFaqList.innerHTML = startHtml;
        if (roomFaqList) roomFaqList.innerHTML = roomHtml;

        // Attach clicks
        document.querySelectorAll('[data-faq-id]').forEach(btn => {
            btn.addEventListener('click', function() {
                const faqId = this.getAttribute('data-faq-id');
                triggerFaqQuestion(faqId);
            });
        });
    }

    function switchView(viewName) {
        viewStart.classList.add('d-none');
        viewQueue.classList.add('d-none');
        viewRoom.classList.add('d-none');

        if (viewName === 'start') viewStart.classList.remove('d-none');
        else if (viewName === 'queue') viewQueue.classList.remove('d-none');
        else if (viewName === 'room') viewRoom.classList.remove('d-none');
    }

    function handleSessionState(session) {
        chatState.status = session.status;

        if (session.status === 'menunggu') {
            queueNumber.textContent = '#' + session.antrian_nomor;
            queuePos.textContent = 'Urutan ke-' + (session.antrian_position || 1);
            queueEst.textContent = '~' + (session.estimasi_tunggu || 2) + ' menit';
            switchView('queue');
        } else if (session.status === 'aktif' || session.status === 'bot' || session.status === 'selesai') {
            switchView('room');

            const opName = document.getElementById('mui-room-operator-name');
            const opRole = document.getElementById('mui-room-operator-role');
            const opAvatar = document.getElementById('mui-room-avatar');
            const roomFaqs = document.getElementById('mui-room-faqs');

            if (session.status === 'bot') {
                opName.textContent = 'MUI Bot (Asisten Otomatis)';
                opRole.textContent = 'Tanya Jawab FAQ 24 Jam';
                opAvatar.innerHTML = '<span style="font-size: 15px;">🤖</span>';
                if (roomFaqs) roomFaqs.classList.remove('d-none');
            } else if (session.status === 'aktif') {
                opName.textContent = session.operator_name || 'Petugas MUI';
                opRole.textContent = 'Petugas Layanan Aktif';
                if (session.operator_avatar) {
                    opAvatar.innerHTML = `<img src="${session.operator_avatar}" alt="Petugas">`;
                } else {
                    opAvatar.textContent = (session.operator_name || 'P').charAt(0).toUpperCase();
                }
                if (roomFaqs) roomFaqs.classList.add('d-none');
            } else if (session.status === 'selesai') {
                opName.textContent = 'Sesi Telah Selesai';
                opRole.textContent = 'Terima kasih telah berkonsultasi';
                if (inputMessage) {
                    inputMessage.disabled = true;
                    inputMessage.placeholder = 'Sesi chat ini telah diakhiri.';
                }
            }
        }
    }

    // 2. Start Chat Session
    startForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = document.getElementById('mui-btn-start-chat');
        btn.disabled = true;
        btn.textContent = 'Menghubungkan...';

        const payload = {
            nama_pengunjung: document.getElementById('chat_input_nama').value.trim(),
            nohp_pengunjung: document.getElementById('chat_input_nohp').value.trim(),
            topik: document.getElementById('chat_input_topik').value,
            pesan_awal: document.getElementById('chat_input_pesan').value.trim(),
            is_bot: !chatState.isOperational,
            _token: '{{ csrf_token() }}'
        };

        fetch('{{ route('livechat.start') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            btn.disabled = false;
            btn.textContent = 'Mulai Percakapan';

            if (data.success) {
                chatState.token = data.session.token;
                localStorage.setItem('mui_livechat_token', chatState.token);
                messagesContainer.innerHTML = '';

                handleSessionState(data.session);

                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(msg => appendMessage(msg));
                }

                startRealtimeSync();
                playChime('message');
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.textContent = 'Mulai Percakapan';
            alert('Gagal menghubungkan sesi chat. Silakan coba kembali.');
        });
    });

    // 3. Send Message
    sendForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const text = inputMessage.value.trim();
        if (!text || !chatState.token) return;

        inputMessage.value = '';

        // Optimistic append
        const tempMsg = {
            id: 'temp_' + Date.now(),
            sender_type: 'pengunjung',
            sender_name: 'Saya',
            pesan: text,
            time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
        };
        appendMessage(tempMsg);

        fetch('{{ route('livechat.send') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                token: chatState.token,
                pesan: text
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.bot_reply) {
                setTimeout(() => {
                    appendMessage(data.bot_reply);
                    playChime('message');
                }, 400);
            }
        });
    });

    // 4. Trigger FAQ
    function triggerFaqQuestion(faqId) {
        if (!chatState.token) {
            // Jika belum punya token, buat sesi bot kilat
            const payload = {
                nama_pengunjung: 'Pengunjung Web',
                topik: 'Pertanyaan FAQ',
                is_bot: true,
                _token: '{{ csrf_token() }}'
            };

            fetch('{{ route('livechat.start') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                chatState.token = data.session.token;
                localStorage.setItem('mui_livechat_token', chatState.token);
                messagesContainer.innerHTML = '';
                handleSessionState(data.session);
                startRealtimeSync();

                sendFaqRequest(faqId);
            });
        } else {
            sendFaqRequest(faqId);
        }
    }

    function sendFaqRequest(faqId) {
        fetch('{{ route('livechat.ask-faq') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ token: chatState.token, faq_id: faqId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.bot_reply) {
                const faq = chatState.faqs.find(f => f.id == faqId);
                if (faq) {
                    appendMessage({
                        id: 'temp_q_' + Date.now(),
                        sender_type: 'pengunjung',
                        sender_name: 'Saya',
                        pesan: faq.pertanyaan,
                        time: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})
                    });
                }
                setTimeout(() => {
                    appendMessage(data.bot_reply);
                    playChime('message');
                }, 300);
            }
        });
    }

    // 5. Cancel / End Chat
    if (btnCancelQueue) {
        btnCancelQueue.addEventListener('click', endChatSession);
    }
    if (btnEndChat) {
        btnEndChat.addEventListener('click', endChatSession);
    }

    function endChatSession() {
        if (!confirm('Apakah Anda yakin ingin mengakhiri sesi percakapan ini?')) return;

        fetch('{{ route('livechat.close') }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ token: chatState.token })
        })
        .finally(() => {
            chatState.token = null;
            chatState.status = null;
            localStorage.removeItem('mui_livechat_token');
            if (chatState.pollingTimer) clearInterval(chatState.pollingTimer);
            if (chatState.sseSource) chatState.sseSource.close();
            switchView('start');
        });
    }

    // 6. Real-time synchronization (SSE with fast polling fallback)
    function startRealtimeSync() {
        if (chatState.pollingTimer) clearInterval(chatState.pollingTimer);
        if (chatState.sseSource) chatState.sseSource.close();

        if (window.EventSource) {
            try {
                const sseUrl = '{{ route('livechat.stream') }}?token=' + encodeURIComponent(chatState.token) + '&last_id=' + chatState.lastMessageId;
                chatState.sseSource = new EventSource(sseUrl);

                chatState.sseSource.addEventListener('message', function(e) {
                    const data = JSON.parse(e.data);
                    processSyncData(data);
                });

                chatState.sseSource.onerror = function() {
                    if (chatState.sseSource) {
                        chatState.sseSource.close();
                        chatState.sseSource = null;
                    }
                    startPollingFallback();
                };
                return;
            } catch(e) {
                startPollingFallback();
            }
        } else {
            startPollingFallback();
        }
    }

    function startPollingFallback() {
        if (chatState.pollingTimer) clearInterval(chatState.pollingTimer);

        chatState.pollingTimer = setInterval(function() {
            if (!chatState.token) return;

            const pollUrl = '{{ route('livechat.poll') }}?token=' + encodeURIComponent(chatState.token) + '&last_id=' + chatState.lastMessageId;
            fetch(pollUrl)
                .then(res => res.json())
                .then(data => {
                    processSyncData(data);
                })
                .catch(() => {});
        }, 2500);
    }

    function processSyncData(data) {
        if (!data) return;

        if (chatState.status === 'menunggu' && data.status === 'aktif') {
            playChime('connected');
        }

        if (data.status) {
            chatState.status = data.status;
            handleSessionState(data);
        }

        if (data.messages && data.messages.length > 0) {
            let hasIncoming = false;
            data.messages.forEach(msg => {
                if (appendMessage(msg)) {
                    hasIncoming = true;
                }
            });
            if (hasIncoming) {
                playChime('message');
            }
        }
    }

    function appendMessage(msg) {
        const existing = document.getElementById('msg_' + msg.id);
        if (existing) return false;

        if (typeof msg.id === 'number' && msg.id > chatState.lastMessageId) {
            chatState.lastMessageId = msg.id;
        }

        const isMe = (msg.sender_type === 'pengunjung');
        const wrapClass = isMe ? 'me' : 'other';
        const bubbleTypeClass = (msg.sender_type === 'bot') ? 'bot' : ((msg.sender_type === 'system') ? 'system' : '');

        const wrap = document.createElement('div');
        wrap.className = 'mui-msg-bubble-wrap ' + wrapClass;
        wrap.id = 'msg_' + msg.id;

        let formattedPesan = escapeHtml(msg.pesan).replace(/\n/g, '<br>');
        formattedPesan = formattedPesan.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        wrap.innerHTML = `
            ${!isMe ? `<span class="mui-msg-sender">${escapeHtml(msg.sender_name)}</span>` : ''}
            <div class="mui-msg-bubble ${bubbleTypeClass}">
                ${formattedPesan}
                <span class="mui-msg-time">${escapeHtml(msg.time || '')}</span>
            </div>
        `;

        messagesContainer.appendChild(wrap);
        scrollToBottom();
        return !isMe;
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    document.addEventListener('DOMContentLoaded', initLiveChat);
})();
</script>
@endif
