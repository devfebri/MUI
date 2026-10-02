<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>MUI Batanghari — Panel Admin</title>
    <meta content="Panel Admin MUI Batanghari" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('gambar/mui.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('gambar/mui.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('gambar/mui.png') }}">

    <!-- Google Fonts — Amiri (arabic feel) + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link href="{{ asset('templateadmin/assets/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templateadmin/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templateadmin/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templateadmin/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('templateadmin/assets/plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templateadmin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('templateadmin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('templateadmin/assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- ============================================================ -->
    <!-- MUI DIGITAL — ISLAMIC GREEN THEME                            -->
    <!-- ============================================================ -->
    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --mui-green:       #007f5f;
            --mui-green-dark:  #005f47;
            --mui-green-light: #009e77;
            --mui-green-pale:  #e6f4f0;
            --mui-green-muted: rgba(0,127,95,.12);
            --mui-gold:        #c9a84c;
            --mui-gold-light:  #f0d080;
            --mui-cream:       #fdf8f0;
            --mui-text:        #1a2e25;
            --mui-gray:        #6b7280;
            --mui-white:       #ffffff;
            --sidebar-w:       240px;
            --topbar-h:        60px;
            --radius:          10px;
            --transition:      .22s cubic-bezier(.4,0,.2,1);
            --shadow-sm:       0 1px 4px rgba(0,0,0,.08);
            --shadow:          0 4px 16px rgba(0,0,0,.10);
        }

        /* ===== GLOBAL ===== */
        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif !important;
            background: #f0f4f2 !important;
            color: var(--mui-text) !important;
        }

        /* ===== ISLAMIC PATTERN ORNAMENT (SVG inline via CSS) ===== */
        .islamic-ornament {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'%3E%3Cpath fill='%23c9a84c' opacity='.5' d='M20 0l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            vertical-align: middle;
        }

        /* ===== SIDEBAR ===== */
        .left.side-menu {
            background: linear-gradient(180deg, var(--mui-green-dark) 0%, var(--mui-green) 40%, #006b50 100%) !important;
            width: var(--sidebar-w) !important;
            box-shadow: 3px 0 20px rgba(0,0,0,.18) !important;
            position: relative;
            z-index: 100;
        }

        /* Islamic top border di sidebar */
        .left.side-menu::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--mui-gold), var(--mui-gold-light), var(--mui-gold));
        }

        /* Sidebar layout — flex column so footer sticks bottom */
        .left.side-menu {
            display: flex !important;
            flex-direction: column !important;
        }

        /* Hide default topbar-left — sidebar has its own brand */
        .topbar-left { display: none !important; }

        /* Sidebar inner = takes remaining space */
        .sidebar-inner {
            flex: 1 !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
            padding-top: 0 !important;
        }

        /* Nav scrolls independently */
        .mui-nav {
            flex: 1 !important;
            overflow-y: auto !important;
        }

        /* Footer always at bottom */
        .mui-sidebar-footer {
            flex-shrink: 0 !important;
        }

        /* Sidebar menu items */
        #sidebar-menu ul li a {
            color: rgba(255,255,255,.82) !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            padding: 11px 20px !important;
            border-radius: 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            transition: all var(--transition) !important;
            border-left: 3px solid transparent !important;
            letter-spacing: 0.1px;
        }

        #sidebar-menu ul li a:hover,
        #sidebar-menu ul li a.active {
            color: #fff !important;
            background: rgba(255,255,255,.12) !important;
            border-left-color: var(--mui-gold) !important;
        }

        #sidebar-menu ul li a i {
            font-size: 17px !important;
            width: 22px !important;
            text-align: center !important;
            flex-shrink: 0 !important;
            opacity: .85;
        }

        #sidebar-menu ul li a:hover i,
        #sidebar-menu ul li a.active i {
            opacity: 1;
            color: var(--mui-gold-light) !important;
        }

        /* Section label di sidebar */
        .sidebar-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(201,168,76,.7);
            padding: 14px 20px 6px;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: var(--mui-white) !important;
            border-bottom: 2px solid var(--mui-green-pale) !important;
            box-shadow: var(--shadow-sm) !important;
            min-height: var(--topbar-h) !important;
        }

        .navbar-custom {
            background: transparent !important;
        }

        /* ===== CONTENT PAGE ===== */
        .content-page {
            margin-left: var(--sidebar-w) !important;
        }

        .content {
            padding: 0 !important;
            background: #f0f4f2 !important;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: var(--mui-white) !important;
            border-top: 1px solid var(--mui-green-pale) !important;
            color: var(--mui-gray) !important;
            font-size: 13px !important;
            text-align: center !important;
            padding: 14px 20px !important;
        }

        /* ===== CARD OVERRIDES ===== */
        .card {
            border: none !important;
            border-radius: var(--radius) !important;
            box-shadow: var(--shadow-sm) !important;
        }

        .card-header {
            background: linear-gradient(90deg, var(--mui-green-pale), #fff) !important;
            border-bottom: 1px solid var(--mui-green-pale) !important;
            color: var(--mui-green) !important;
            font-weight: 700 !important;
        }

        /* ===== BUTTON OVERRIDES ===== */
        .btn-primary {
            background: var(--mui-green) !important;
            border-color: var(--mui-green) !important;
        }

        .btn-primary:hover {
            background: var(--mui-green-dark) !important;
            border-color: var(--mui-green-dark) !important;
        }

        /* ===== TABLE OVERRIDES ===== */
        .table thead th {
            background: var(--mui-green-pale) !important;
            color: var(--mui-green-dark) !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.8px !important;
            border-bottom: 2px solid var(--mui-green) !important;
        }

        /* ===== LOADER ===== */
        #preloader {
            background: var(--mui-green-dark) !important;
        }

        .spinner {
            border-top-color: var(--mui-gold) !important;
        }

        /* ===== MODAL ===== */
        .modal-backdrop { opacity: 0 !important; }

        .modal-header {
            background: linear-gradient(135deg, var(--mui-green), var(--mui-green-light)) !important;
            color: #fff !important;
        }

        .modal-header .modal-title { color: #fff !important; }
        .modal-header .close { color: #fff !important; opacity: 1 !important; }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: var(--mui-green-pale); }
        ::-webkit-scrollbar-thumb { background: var(--mui-green); border-radius: 10px; }

        /* ===== MODERN TOAST NOTIFICATIONS (TOP RIGHT) ===== */
        .alertify-logs { display: none !important; }

        #mui-toast-container {
            position: fixed !important;
            top: 24px !important;
            right: 24px !important;
            left: auto !important;
            bottom: auto !important;
            z-index: 9999999 !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 12px !important;
            pointer-events: none !important;
            max-width: 420px !important;
            width: calc(100% - 48px) !important;
        }

        .mui-toast {
            position: relative;
            pointer-events: auto;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: #ffffff;
            border-radius: 14px;
            padding: 16px 18px;
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.14), 0 3px 10px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            animation: muiToastSlideIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .mui-toast.toast-hiding {
            animation: muiToastSlideOut 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
        }

        @keyframes muiToastSlideIn {
            from {
                opacity: 0;
                transform: translateX(120%) scale(0.92);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes muiToastSlideOut {
            from {
                opacity: 1;
                transform: translateX(0) scale(1);
                max-height: 140px;
                margin-bottom: 0;
            }
            to {
                opacity: 0;
                transform: translateX(120%) scale(0.92);
                max-height: 0;
                padding-top: 0;
                padding-bottom: 0;
                margin-bottom: -12px;
            }
        }

        .mui-toast-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .mui-toast-body {
            flex: 1;
            min-width: 0;
            padding-right: 18px;
        }

        .mui-toast-title {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 3px;
        }

        .mui-toast-text {
            font-size: 13px;
            color: #475569;
            line-height: 1.45;
            word-break: break-word;
        }

        .mui-toast-close {
            position: absolute;
            top: 12px;
            right: 12px;
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            font-size: 16px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .mui-toast-close:hover {
            color: #1e293b;
            background: #f1f5f9;
        }

        .mui-toast-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3.5px;
            width: 100%;
            transform-origin: left;
            animation: muiToastProgress 4.5s linear forwards;
        }

        @keyframes muiToastProgress {
            from { transform: scaleX(1); }
            to { transform: scaleX(0); }
        }

        /* Success variant */
        .mui-toast-success {
            border-left: 5px solid #007f5f;
        }
        .mui-toast-success .mui-toast-icon {
            background: #e6f4f0;
            color: #007f5f;
        }
        .mui-toast-success .mui-toast-title {
            color: #007f5f;
        }
        .mui-toast-success .mui-toast-bar {
            background: #007f5f;
        }

        /* Error variant */
        .mui-toast-error {
            border-left: 5px solid #ef4444;
        }
        .mui-toast-error .mui-toast-icon {
            background: #fee2e2;
            color: #ef4444;
        }
        .mui-toast-error .mui-toast-title {
            color: #b91c1c;
        }
        .mui-toast-error .mui-toast-bar {
            background: #ef4444;
        }

        /* Warning variant */
        .mui-toast-warning {
            border-left: 5px solid #f59e0b;
        }
        .mui-toast-warning .mui-toast-icon {
            background: #fef3c7;
            color: #d97706;
        }
        .mui-toast-warning .mui-toast-title {
            color: #b45309;
        }
        .mui-toast-warning .mui-toast-bar {
            background: #f59e0b;
        }

        /* Info variant */
        .mui-toast-info {
            border-left: 5px solid #2563eb;
        }
        .mui-toast-info .mui-toast-icon {
            background: #dbeafe;
            color: #2563eb;
        }
        .mui-toast-info .mui-toast-title {
            color: #1d4ed8;
        }
        .mui-toast-info .mui-toast-bar {
            background: #2563eb;
        }
    </style>

    @yield('css')
</head>

<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect"
                style="color:rgba(255,255,255,.7);">
                <i class="ion-close"></i>
            </button>
            @include('layouts._include.sidebar')
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content -->
        <div class="content-page">
            <div class="content">
                <!-- Top Bar -->
                @include('layouts._include.header')
                <!-- Top Bar End -->

                @yield('content')
            </div>

            <footer class="footer">
                <span style="font-family:'Amiri',serif;color:var(--mui-gold);font-size:15px;letter-spacing:1px;">
                    ﷽
                </span>
                &nbsp;
                &copy; {{ date('Y') }}
                <strong style="color:var(--mui-green);">MUI Batanghari</strong>
                — Majelis Ulama Indonesia. Semua hak dilindungi.
            </footer>
        </div>
        <!-- End Right content -->

    </div>
    <!-- END wrapper -->

    <!-- jQuery & scripts -->
    <script src="{{ asset('templateadmin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/detect.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/waves.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/js/jquery.scrollTo.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('templateadmin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Alertify -->
    <script src="{{ asset('templateadmin/assets/plugins/alertify/js/alertify.js') }}"></script>
    <script src="{{ asset('templateadmin/assets/pages/alertify-init.js') }}"></script>

    <!-- App -->
    <script src="{{ asset('templateadmin/assets/js/app.js') }}"></script>

    @yield('javascript')

    <!-- Modern Toast Container -->
    <div id="mui-toast-container" aria-live="polite"></div>

    <script>
        // ========================================================
        // MODERN TOAST NOTIFICATION ENGINE (TOP-RIGHT)
        // ========================================================
        window.showToast = function(type, message, title) {
            if (!message) return;
            var container = document.getElementById('mui-toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'mui-toast-container';
                document.body.appendChild(container);
            }

            var typeConfig = {
                success: {
                    title: title || 'Berhasil',
                    icon: 'mdi-check-circle-outline',
                    class: 'mui-toast-success'
                },
                error: {
                    title: title || 'Gagal',
                    icon: 'mdi-alert-circle-outline',
                    class: 'mui-toast-error'
                },
                warning: {
                    title: title || 'Perhatian',
                    icon: 'mdi-alert-outline',
                    class: 'mui-toast-warning'
                },
                info: {
                    title: title || 'Informasi',
                    icon: 'mdi-information-outline',
                    class: 'mui-toast-info'
                }
            };

            var cfg = typeConfig[type] || typeConfig.info;

            var toast = document.createElement('div');
            toast.className = 'mui-toast ' + cfg.class;
            toast.innerHTML = 
                '<div class="mui-toast-icon"><i class="mdi ' + cfg.icon + '"></i></div>' +
                '<div class="mui-toast-body">' +
                    '<div class="mui-toast-title">' + cfg.title + '</div>' +
                    '<div class="mui-toast-text">' + message + '</div>' +
                '</div>' +
                '<button type="button" class="mui-toast-close" title="Tutup"><i class="mdi mdi-close"></i></button>' +
                '<div class="mui-toast-bar"></div>';

            container.appendChild(toast);

            var autoDismissTimer = setTimeout(dismiss, 4500);

            function dismiss() {
                if (toast.classList.contains('toast-hiding')) return;
                toast.classList.add('toast-hiding');
                setTimeout(function() {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 320);
            }

            var closeBtn = toast.querySelector('.mui-toast-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    clearTimeout(autoDismissTimer);
                    dismiss();
                });
            }

            var bar = toast.querySelector('.mui-toast-bar');
            toast.addEventListener('mouseenter', function() {
                clearTimeout(autoDismissTimer);
                if (bar) bar.style.animationPlayState = 'paused';
            });

            toast.addEventListener('mouseleave', function() {
                autoDismissTimer = setTimeout(dismiss, 2000);
                if (bar) bar.style.animationPlayState = 'running';
            });
        };

        // Bridge Alertify API so all AJAX calls (create, edit, delete) use modern toast
        if (typeof alertify !== 'undefined') {
            alertify.success = function(msg) { window.showToast('success', msg); return alertify; };
            alertify.error = function(msg) { window.showToast('error', msg); return alertify; };
            alertify.log = function(msg) { window.showToast('info', msg); return alertify; };
        }

        // Global notify helper
        window.notify = {
            success: function(msg, title) { window.showToast('success', msg, title); },
            error: function(msg, title) { window.showToast('error', msg, title); },
            warning: function(msg, title) { window.showToast('warning', msg, title); },
            info: function(msg, title) { window.showToast('info', msg, title); }
        };

        // Flash Session Handlers
        @if (Session::has('success'))
            window.showToast('success', {!! json_encode(Session::get('success')) !!});
        @endif
        @if (Session::has('pesan'))
            window.showToast('success', {!! json_encode(Session::get('pesan')) !!});
        @endif
        @if (Session::has('status'))
            window.showToast('info', {!! json_encode(Session::get('status')) !!});
        @endif
        @if (Session::has('warning'))
            window.showToast('warning', {!! json_encode(Session::get('warning')) !!});
        @endif
        @if (Session::has('error'))
            window.showToast('error', {!! json_encode(Session::get('error')) !!});
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                window.showToast('error', {!! json_encode($error) !!}, 'Perhatian');
            @endforeach
        @endif

        // Real-time clock
        (function tick() {
            var el = document.getElementById('time');
            if (el) {
                el.innerHTML = new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' })
                    .replace(', ', ' — ');
            }
            setTimeout(tick, 1000);
        })();
    </script>

</body>
</html>
