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
                        <div class="footer-brand-name">MUI<em>Batanghari</em></div>
                        <span class="footer-brand-sub">Majelis Ulama Indonesia</span>
                    </div>
                </div>
                <p class="footer-desc">Situs resmi MUI Batanghari. Menyajikan berita umat Islam, fatwa MUI, informasi
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
                <p class="mb-0">Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">MUI Batanghari</a>.
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

        /* ── Jadwal Sholat Dinamis Mengikuti Lokasi & Highlight Mendekati Sholat ── */
        var defaultCoords = { lat: -1.7241, lng: 103.2562, name: 'Batanghari' };
        var activeCoords = defaultCoords;

        function calcPrayerTimes(date, lat, lng) {
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var a = Math.floor((14 - month) / 12);
            var yr = year + 4800 - a;
            var mo = month + 12 * a - 3;
            var jd = day + Math.floor((153 * mo + 2) / 5) + 365 * yr + Math.floor(yr / 4) - Math.floor(yr / 100) + Math.floor(yr / 400) - 32045;
            var t = jd - 2451545.0;
            var g = ((357.529 + 0.98560028 * t) % 360 + 360) % 360;
            var q = ((280.459 + 0.98564736 * t) % 360 + 360) % 360;
            var L = ((q + 1.915 * Math.sin(g * Math.PI / 180) + 0.020 * Math.sin(2 * g * Math.PI / 180)) % 360 + 360) % 360;
            var e = 23.439 - 0.00000036 * t;
            var sinDec = Math.sin(e * Math.PI / 180) * Math.sin(L * Math.PI / 180);
            var dec = Math.asin(sinDec);
            var cosDec = Math.cos(dec);
            var ra = (Math.atan2(Math.cos(e * Math.PI / 180) * Math.sin(L * Math.PI / 180), Math.cos(L * Math.PI / 180)) * 180 / Math.PI) / 15;
            ra = (ra % 24 + 24) % 24;
            var eqt = (q / 15) - ra;
            if (eqt > 12) eqt -= 24;
            if (eqt < -12) eqt += 24;

            var tz = -date.getTimezoneOffset() / 60;
            var noon = 12 + tz - (lng / 15) - eqt;

            function ha(alt) {
                var lRad = lat * Math.PI / 180, aRad = alt * Math.PI / 180;
                var c = (Math.sin(aRad) - Math.sin(lRad) * sinDec) / (Math.cos(lRad) * cosDec);
                if (c > 1) c = 1;
                if (c < -1) c = -1;
                return (Math.acos(c) * 180 / Math.PI) / 15;
            }

            var haSubuh = ha(-20);
            var haSyuruq = ha(-0.8333);
            var haMaghrib = ha(-0.8333);
            var haIsya = ha(-18);
            var altAshar = Math.atan(1 / (1 + Math.tan(Math.abs((lat * Math.PI / 180) - dec)))) * 180 / Math.PI;
            var haAshar = ha(altAshar);

            var ikhtiyat = 2 / 60; // 2 menit standar ikhtiyat Kemenag RI

            function toTimeObj(hours) {
                hours = (hours % 24 + 24) % 24;
                var hr = Math.floor(hours);
                var mn = Math.floor((hours - hr) * 60);
                return {
                    string: String(hr).padStart(2, '0') + ':' + String(mn).padStart(2, '0'),
                    minutes: hr * 60 + mn
                };
            }

            return {
                Subuh: toTimeObj(noon - haSubuh + ikhtiyat),
                Syuruq: toTimeObj(noon - haSyuruq - ikhtiyat),
                Dzuhur: toTimeObj(noon + ikhtiyat),
                Ashar: toTimeObj(noon + haAshar + ikhtiyat),
                Maghrib: toTimeObj(noon + haMaghrib + ikhtiyat),
                Isya: toTimeObj(noon + haIsya + ikhtiyat)
            };
        }

        function updatePrayerUI() {
            var currentDate = new Date();
            var prayers = calcPrayerTimes(currentDate, activeCoords.lat, activeCoords.lng);
            var currentMinutes = currentDate.getHours() * 60 + currentDate.getMinutes();

            var pillContainer = document.getElementById('headerPrayerPills');
            if (pillContainer) {
                pillContainer.title = 'Jadwal Sholat (' + activeCoords.name + ' - Lokasi Otomatis)';
            }

            var locationLabel = document.getElementById('sholat-location-label');
            if (locationLabel) {
                var monthsIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                locationLabel.textContent = activeCoords.name + ' — ' + currentDate.getDate() + ' ' + monthsIndo[currentDate.getMonth()] + ' ' + currentDate.getFullYear();
            }

            var prayerNames = ['Subuh', 'Dzuhur', 'Ashar', 'Maghrib', 'Isya'];

            // Update waktu di pill header & tabel sidebar
            prayerNames.forEach(function(name) {
                var timeObj = prayers[name];
                if (!timeObj) return;

                var pill = document.querySelector('.vb-prayer-pill[data-prayer="' + name + '"]');
                if (pill) {
                    var span = pill.querySelector('.prayer-time');
                    if (span) span.textContent = timeObj.string;
                }

                var row = document.querySelector('#sidebarSholatTable tr[data-prayer="' + name + '"]');
                if (row) {
                    var cell = row.querySelector('.prayer-time');
                    if (cell) cell.textContent = timeObj.string;
                }
            });

            if (prayers.Syuruq) {
                var rowSyuruq = document.querySelector('#sidebarSholatTable tr[data-prayer="Syuruq"]');
                if (rowSyuruq) {
                    var cellSyuruq = rowSyuruq.querySelector('.prayer-time');
                    if (cellSyuruq) cellSyuruq.textContent = prayers.Syuruq.string;
                }
            }

            // Bersihkan highlight lama
            document.querySelectorAll('.vb-prayer-pill').forEach(function(p) {
                p.classList.remove('is-approaching', 'is-active');
            });
            document.querySelectorAll('#sidebarSholatTable tr').forEach(function(r) {
                r.classList.remove('is-approaching');
            });

            var approachingPrayer = null;
            var nextPrayer = null;

            for (var i = 0; i < prayerNames.length; i++) {
                var pName = prayerNames[i];
                var pMinutes = prayers[pName].minutes;
                var diff = pMinutes - currentMinutes;

                // Sedang masuk waktu sholat (0 - 15 menit setelah azan)
                if (currentMinutes >= pMinutes && currentMinutes <= pMinutes + 15) {
                    approachingPrayer = { name: pName, time: prayers[pName].string, state: 'entered', remaining: 0 };
                    break;
                }

                // Waktu sholat mendatang hari ini
                if (diff > 0) {
                    if (!nextPrayer) {
                        nextPrayer = { name: pName, time: prayers[pName].string, remaining: diff };
                    }
                    // Mendekati waktu sholat (<= 30 menit)
                    if (diff <= 30 && !approachingPrayer) {
                        approachingPrayer = { name: pName, time: prayers[pName].string, state: 'approaching', remaining: diff };
                        break;
                    }
                }
            }

            // Jika semua waktu sholat hari ini telah lewat, sholat berikutnya adalah Subuh besok
            if (!nextPrayer && !approachingPrayer) {
                var subuhTomorrowMinutes = (24 * 60) - currentMinutes + prayers.Subuh.minutes;
                nextPrayer = { name: 'Subuh', time: prayers.Subuh.string, remaining: subuhTomorrowMinutes };
                if (subuhTomorrowMinutes <= 30) {
                    approachingPrayer = { name: 'Subuh', time: prayers.Subuh.string, state: 'approaching', remaining: subuhTomorrowMinutes };
                }
            }

            // Berikan penanda visual
            if (approachingPrayer) {
                var targetPill = document.querySelector('.vb-prayer-pill[data-prayer="' + approachingPrayer.name + '"]');
                if (targetPill) {
                    targetPill.classList.add('is-approaching');
                    if (approachingPrayer.state === 'entered') {
                        targetPill.title = 'Waktu sholat ' + approachingPrayer.name + ' sedang berlangsung!';
                    } else {
                        targetPill.title = 'Mendekati waktu ' + approachingPrayer.name + ' (' + approachingPrayer.remaining + ' menit lagi)';
                    }
                }
                var targetRow = document.querySelector('#sidebarSholatTable tr[data-prayer="' + approachingPrayer.name + '"]');
                if (targetRow) {
                    targetRow.classList.add('is-approaching');
                }
            } else if (nextPrayer) {
                var nextPill = document.querySelector('.vb-prayer-pill[data-prayer="' + nextPrayer.name + '"]');
                if (nextPill) {
                    nextPill.classList.add('is-active');
                    nextPill.title = 'Sholat berikutnya: ' + nextPrayer.name + ' (' + nextPrayer.time + ')';
                }
            }
        }

        // Cek cache koordinat lokasi
        try {
            var cachedCoords = localStorage.getItem('mui_user_coords');
            if (cachedCoords) {
                var parsed = JSON.parse(cachedCoords);
                if (parsed.lat && parsed.lng) {
                    activeCoords = { lat: parsed.lat, lng: parsed.lng, name: parsed.name || 'Lokasi Perangkat' };
                }
            }
        } catch(e) {}

        // Inisialisasi awal
        updatePrayerUI();

        // Minta izin lokasi perangkat jika didukung
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    activeCoords = {
                        lat: pos.coords.latitude,
                        lng: pos.coords.longitude,
                        name: 'Lokasi Anda'
                    };
                    try {
                        localStorage.setItem('mui_user_coords', JSON.stringify(activeCoords));
                    } catch(e) {}
                    updatePrayerUI();
                },
                function(err) {
                    // Fallback tenang tetap menggunakan default Batanghari
                },
                { enableHighAccuracy: false, timeout: 8000, maximumAge: 3600000 }
            );
        }

        // Perbarui setiap 60 detik otomatis
        setInterval(updatePrayerUI, 60000);

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
