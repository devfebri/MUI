<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>MUI Digital — Panel Admin</title>
    <meta content="Panel Admin MUI Digital" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('templateadmin/assets/img/favicon.ico') }}">

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
                <strong style="color:var(--mui-green);">MUI Digital</strong>
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

    <script>
        // Alertify session flash
        @if (Session::has('pesan'))
            alertify.success("{{ Session::get('pesan') }}");
        @endif
        @if (Session::has('error'))
            alertify.error("{{ Session::get('error') }}");
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
