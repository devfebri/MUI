<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#007F5F">
    <meta name="description"
        content="@yield('meta_description', 'MUI Batanghari — Portal berita Islam, fatwa MUI, bimbingan syariah, dan informasi halal terpercaya.')">
    <title>@yield('title', 'MUI Batanghari — Majelis Ulama Indonesia')</title>
    <link rel="icon" type="image/png" href="{{ asset('gambar/mui.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('gambar/mui.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('gambar/mui.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/mui-portal.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @stack('styles')
</head>

<body>

    {{-- ── SECTION HEADER (Topbar, Mainbar, Navbar Desktop & Mobile Drawer) ── --}}
    @section('header')
        @include('layouts._frontend.header')
    @show

    {{-- ── OPTIONAL TICKER ── --}}
    @yield('ticker')

    {{-- ── MAIN CONTENT ── --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- ── SECTION FOOTER (Footer, Scroll-top & Core Scripts) ── --}}
    @section('footer')
        @include('layouts._frontend.footer')
    @show

    @stack('scripts')

</body>

</html>
