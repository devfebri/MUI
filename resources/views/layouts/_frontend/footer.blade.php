{{-- ── FOOTER ───────────────────────────────────────────────────── --}}
<footer class="mui-footer">
    <div class="mui-shell">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <div class="footer-brand-icon">
                        <svg width="20" height="20" viewBox="0 0 28 28" fill="none">
                            <polygon
                                points="14,2 16.9,10.5 26,10.5 18.6,15.9 21.5,24.4 14,19 6.5,24.4 9.4,15.9 2,10.5 11.1,10.5"
                                fill="#c9a84c" />
                        </svg>
                    </div>
                    <div>
                        <div class="footer-brand-name">MUI<em>Digital</em></div>
                        <span class="footer-brand-sub">Majelis Ulama Indonesia</span>
                    </div>
                </div>
                <p class="footer-desc">Situs resmi MUI Digital. Menyajikan berita umat Islam, fatwa MUI, informasi
                    halal, bimbingan syariah, dan referensi keagamaan terpercaya.</p>
                <div class="footer-social">
                    <a href="#" class="footer-social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="footer-social-btn" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="footer-social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social-btn" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="footer-social-btn" title="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="footer-heading">Kategori</div>
                <ul class="footer-links">
                    <li><a href="{{ route('berita.list') }}">Berita</a></li>
                    <li><a href="#">Fatwa</a></li>
                    <li><a href="#">Bimbingan</a></li>
                    <li><a href="#">Khutbah</a></li>
                    <li><a href="#">Halal</a></li>
                    <li><a href="#">Opini</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 col-6">
                <div class="footer-heading">Layanan</div>
                <ul class="footer-links">
                    <li><a href="#">Tanya Ulama</a></li>
                    <li><a href="#">Sertifikasi Halal</a></li>
                    <li><a href="#">Da'i MUI</a></li>
                    <li><a href="#">Kabar Daerah</a></li>
                    <li><a href="#">Donasi</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer-heading">Tentang MUI</div>
                <ul class="footer-links">
                    <li><a href="{{ route('profilemui') }}">Profil MUI</a></li>
                    <li><a href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                    <li><a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
                    <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="mui-shell">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <p class="mb-0">Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">MUI Digital</a>.
                    Semua hak dilindungi.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Ketentuan</a>
                    <a href="{{ route('kontak') }}">Kontak</a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- ── SCROLL TOP ────────────────────────────────────────────────── --}}
<button class="scroll-top-btn" id="scrollTopBtn" aria-label="Scroll ke atas">
    <i class="fas fa-chevron-up"></i>
</button>

<!-- JS -->
<script src="{{ asset('template/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>

<script>
    (function() {
        'use strict';

        /* ── Tanggal topbar ── */
        var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];
        var now = new Date();
        var el = document.getElementById('topbar-date');
        if (el) el.textContent = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' +
            now.getFullYear();

        /* ── Mobile Drawer ── */
        var hamburger = document.getElementById('hamburgerBtn');
        var drawer = document.getElementById('mobileDrawer');
        var overlay = document.getElementById('drawerOverlay');
        var drawerClose = document.getElementById('drawerClose');

        function openDrawer() {
            if (drawer) drawer.classList.add('open');
            if (overlay) overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
            if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
        }

        function closeDrawer() {
            if (drawer) drawer.classList.remove('open');
            if (overlay) overlay.classList.remove('open');
            document.body.style.overflow = '';
            if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
        }

        if (hamburger) hamburger.addEventListener('click', openDrawer);
        if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);

        /* Escape key closes drawer */
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDrawer();
        });

        /* ── Drawer accordion (sub-menu) ── */
        var hasSubs = document.querySelectorAll('.vb-drawer-item.has-sub .vb-drawer-link[role="button"]');
        hasSubs.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var parent = this.closest('.vb-drawer-item');
                var isOpen = parent.classList.contains('expanded');
                document.querySelectorAll('.vb-drawer-item.expanded').forEach(function(el) {
                    el.classList.remove('expanded');
                });
                if (!isOpen) parent.classList.add('expanded');
            });
            btn.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        /* ── Scroll to top ── */
        var scrollBtn = document.getElementById('scrollTopBtn');
        window.addEventListener('scroll', function() {
            if (scrollBtn) scrollBtn.classList.toggle('show', window.scrollY > 350);
        }, {
            passive: true
        });
        if (scrollBtn) scrollBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        /* ── Ticker pause on hover ── */
        var tickerTrack = document.querySelector('.vb-ticker-track');
        if (tickerTrack) {
            tickerTrack.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
            });
            tickerTrack.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
            });
        }

        /* ── Responsive: 3-col news grids inside section collapse on mobile ── */
        function fixInlineGrids() {
            var inlineGrids = document.querySelectorAll('.news-grid[style*="grid-template-columns"]');
            inlineGrids.forEach(function(g) {
                if (window.innerWidth <= 575) {
                    g.style.gridTemplateColumns = '1fr';
                } else if (window.innerWidth <= 767) {
                    g.style.gridTemplateColumns = 'repeat(2, 1fr)';
                } else {
                    g.style.gridTemplateColumns = 'repeat(3, 1fr)';
                }
            });
        }
        fixInlineGrids();
        window.addEventListener('resize', fixInlineGrids, {
            passive: true
        });

    })();
</script>
