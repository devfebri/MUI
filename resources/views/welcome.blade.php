<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#007F5F">
    <meta name="description"
        content="MUI Digital — Portal berita Islam, fatwa MUI, bimbingan syariah, dan informasi halal terpercaya.">
    <title>MUI Digital — Majelis Ulama Indonesia</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/assets/img/favicon.ico') }}">

    <!-- CSS Template -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/ticker-style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/animate.min.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        /* =====================================================
       MUI DIGITAL — ISLAMIC PORTAL THEME v2
       Inspired by mui.or.id | Color: #007f5f
    ===================================================== */

        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-pale: #e8f5f1;
            --gold: #c9a84c;
            --gold-light: #f0d080;
            --dark: #1a1a1a;
            --text: #2d2d2d;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f9fafb;
            --white: #ffffff;
            --radius-sm: 6px;
            --radius: 10px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 4px rgba(0, 0, 0, .07);
            --shadow: 0 4px 20px rgba(0, 0, 0, .09);
            --shadow-lg: 0 12px 40px rgba(0, 0, 0, .13);
            --transition: .22s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--white);
            line-height: 1.6;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            display: block;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* ── TOPBAR ───────────────────────────────────────── */
        .vb-topbar {
            background: var(--green-dark);
            padding: 0;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .vb-topbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 7px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            font-size: 12.5px;
            color: rgba(255, 255, 255, .8);
        }

        .vb-topbar-date {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .vb-topbar-date i {
            color: var(--gold);
        }

        .vb-prayer-pills {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .vb-prayer-pill {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 11.5px;
            color: rgba(255, 255, 255, .85);
            white-space: nowrap;
        }

        .vb-prayer-pill b {
            color: var(--gold-light);
        }

        /* ── MAINBAR (Logo + Search + CTA) ───────────────── */
        .vb-mainbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
        }

        .vb-mainbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .vb-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .vb-logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--green-dark), var(--green));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(201, 168, 76, .3);
            flex-shrink: 0;
        }

        .vb-logo-text {
            line-height: 1.15;
        }

        .vb-logo-name {
            font-size: 20px;
            font-weight: 800;
            color: var(--green);
            letter-spacing: -0.4px;
            display: block;
        }

        .vb-logo-name em {
            font-style: normal;
            color: var(--dark);
        }

        .vb-logo-sub {
            font-size: 9.5px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: block;
        }

        .vb-search {
            flex: 1;
            position: relative;
            max-width: 500px;
        }

        .vb-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 14px;
        }

        .vb-search-input {
            width: 100%;
            padding: 10px 16px 10px 38px;
            border: 1.5px solid var(--border);
            border-radius: 24px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            outline: none;
            background: var(--bg);
            color: var(--text);
            transition: border-color var(--transition), box-shadow var(--transition);
        }

        .vb-search-input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(0, 127, 95, .12);
            background: var(--white);
        }

        .vb-search-input::placeholder {
            color: var(--muted);
        }

        .vb-cta {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--green);
            color: var(--white) !important;
            padding: 9px 20px;
            border-radius: 24px;
            font-size: 13.5px;
            font-weight: 700;
            white-space: nowrap;
            transition: background var(--transition);
            flex-shrink: 0;
        }

        .vb-cta:hover {
            background: var(--green-dark);
        }

        .vb-mobile-toggle {
            display: none;
            background: none;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 7px;
            cursor: pointer;
            color: var(--text);
            flex-shrink: 0;
        }

        /* ── NAVBAR ───────────────────────────────────────── */
        .vb-nav {
            background: var(--green);
            border-bottom: 3px solid var(--gold);
        }

        .vb-nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 0;
        }

        .vb-nav-item {
            position: relative;
        }

        .vb-nav-link {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: rgba(255, 255, 255, .9) !important;
            transition: all var(--transition);
            white-space: nowrap;
            border-bottom: 3px solid transparent;
            margin-bottom: -3px;
        }

        .vb-nav-link:hover,
        .vb-nav-link.active {
            color: #fff !important;
            background: rgba(255, 255, 255, .12);
            border-bottom-color: var(--gold);
        }

        .vb-nav-caret {
            display: inline-block;
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid rgba(255, 255, 255, .6);
            margin-left: 2px;
        }

        /* Dropdown submenu */
        .vb-submenu {
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--white);
            border: 1px solid var(--border);
            border-top: 3px solid var(--green);
            border-radius: 0 0 var(--radius) var(--radius);
            box-shadow: var(--shadow-lg);
            min-width: 200px;
            z-index: 999;
            padding: 6px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all var(--transition);
        }

        .vb-nav-item:hover .vb-submenu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .vb-submenu .vb-nav-link {
            color: var(--text) !important;
            padding: 9px 18px;
            font-size: 13px;
            border-bottom: none !important;
            background: none !important;
            margin: 0;
        }

        .vb-submenu .vb-nav-link:hover {
            background: var(--green-pale) !important;
            color: var(--green) !important;
        }

        /* ── TICKER ───────────────────────────────────────── */
        .vb-ticker {
            background: var(--green-pale);
            border-bottom: 1px solid rgba(0, 127, 95, .15);
            padding: 8px 0;
            overflow: hidden;
        }

        .vb-ticker-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .vb-ticker-label {
            background: var(--green);
            color: var(--white);
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 3px 12px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        .vb-ticker-mask {
            flex: 1;
            overflow: hidden;
        }

        .vb-ticker-track {
            display: flex;
            gap: 40px;
            animation: ticker-scroll 30s linear infinite;
        }

        .vb-ticker-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text);
            font-weight: 500;
            white-space: nowrap;
        }

        .vb-ticker-item::before {
            content: '●';
            font-size: 6px;
            color: var(--green);
        }

        .vb-ticker-item:hover {
            color: var(--green);
        }

        @keyframes ticker-scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* ── SHELL (max-width wrapper) ────────────────────── */
        .mui-shell {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ── HERO GRID ────────────────────────────────────── */
        .vb-hero {
            padding: 24px 0 16px;
            background: var(--white);
        }

        .vb-hero-grid {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 280px;
            gap: 20px;
            align-items: start;
        }

        /* Left: featured card + title list */
        .post-card.post-classic {
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--white);
            border: 1px solid var(--border);
            margin-bottom: 16px;
        }

        .post-card.post-classic .post-media img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .post-card.post-classic:hover .post-media img {
            transform: scale(1.04);
        }

        .post-body {
            display: block;
            padding: 14px 16px;
        }

        .post-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 7px;
        }

        .post-category {
            background: var(--green-pale);
            color: var(--green);
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 2px 9px;
            border-radius: 20px;
        }

        .post-date {
            font-size: 11.5px;
            color: var(--muted);
        }

        .post-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.4;
            margin: 0;
        }

        h1.post-title {
            font-size: 18px;
        }

        .post-link:hover .post-title {
            color: var(--green);
        }

        /* Post title list (no image) */
        .post-card.post-title-item {
            padding: 10px 0;
            border-bottom: 1px dashed var(--border);
            display: block;
        }

        .post-card.post-title-item:last-child {
            border-bottom: none;
        }

        .post-card.post-title-item .post-title {
            font-size: 14px;
            font-weight: 700;
        }

        .post-card.post-title-item:hover .post-title {
            color: var(--green);
        }

        /* Middle: overlay big card + list cards */
        .post-card.post-overlay {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            height: 260px;
            margin-bottom: 16px;
        }

        .post-card.post-overlay .post-media {
            position: absolute;
            inset: 0;
        }

        .post-card.post-overlay .post-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .post-card.post-overlay:hover .post-media img {
            transform: scale(1.04);
        }

        .post-card.post-overlay .post-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px;
            background: linear-gradient(to top, rgba(0, 0, 0, .85) 0%, rgba(0, 0, 0, .3) 70%, transparent 100%);
        }

        .post-card.post-overlay .post-category {
            background: var(--green);
            color: #fff;
        }

        .post-card.post-overlay .post-date {
            color: rgba(255, 255, 255, .7);
        }

        .post-card.post-overlay .post-title {
            color: #fff;
            font-size: 15px;
        }

        /* Post list (thumbnail + text) */
        .post-card.post-list {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .post-card.post-list:last-child {
            border-bottom: none;
        }

        .post-card.post-list .post-media {
            width: 84px;
            min-width: 84px;
            height: 68px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            flex-shrink: 0;
        }

        .post-card.post-list .post-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }

        .post-card.post-list:hover .post-media img {
            transform: scale(1.08);
        }

        .post-card.post-list .post-body {
            padding: 0;
        }

        .post-card.post-list .post-title {
            font-size: 13px;
            font-weight: 700;
            line-height: 1.4;
        }

        .post-card.post-list:hover .post-title {
            color: var(--green);
        }

        /* ── POPULAR SIDEBAR ──────────────────────────────── */
        .vb-hero-popular {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
        }

        .vb-hero-popular-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--green);
        }

        .vb-hero-popular-head h2 {
            font-size: 15px;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .vb-hero-popular-head span {
            font-size: 11px;
            color: var(--muted);
            background: var(--green-pale);
            padding: 2px 8px;
            border-radius: 10px;
        }

        .post-rank-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px dashed var(--border);
        }

        .post-rank-item:last-child {
            border-bottom: none;
        }

        .post-rank {
            width: 22px;
            min-width: 22px;
            height: 22px;
            background: var(--green);
            color: #fff;
            border-radius: 50%;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .post-rank-item:nth-child(1) .post-rank {
            background: var(--gold);
            color: #333;
        }

        .post-rank-item:nth-child(2) .post-rank {
            background: #9ca3af;
        }

        .post-rank-item:nth-child(3) .post-rank {
            background: #c97a3a;
        }

        .post-rank-body .post-title {
            font-size: 12.5px;
            font-weight: 700;
            line-height: 1.4;
        }

        .post-rank-body .post-date {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        .post-rank-item:hover .post-title {
            color: var(--green);
        }

        /* ── FEATURED SERVICES ────────────────────────────── */
        .section-featured {
            background: var(--white);
            padding: 20px 0 28px;
            border-bottom: 1px solid var(--border);
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .featured-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: all var(--transition);
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .featured-card:hover {
            background: var(--green-pale);
            border-left-color: var(--green);
            box-shadow: var(--shadow-sm);
            transform: translateY(-2px);
        }

        .featured-card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--green-pale), var(--white));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            border: 1px solid rgba(0, 127, 95, .12);
        }

        .featured-card-body {
            flex: 1;
            min-width: 0;
        }

        .featured-card-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            font-weight: 600;
            display: block;
        }

        .featured-card-title {
            font-size: 14px;
            font-weight: 800;
            color: var(--dark);
            display: block;
        }

        .featured-card:hover .featured-card-title {
            color: var(--green);
        }

        .featured-card-arrow {
            color: var(--muted);
            font-size: 14px;
            flex-shrink: 0;
            transition: transform var(--transition);
        }

        .featured-card:hover .featured-card-arrow {
            transform: translateX(3px);
            color: var(--green);
        }

        /* ── SECTION HEADING ──────────────────────────────── */
        .mui-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            gap: 16px;
        }

        .mui-section-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .mui-section-title::before {
            content: '';
            width: 4px;
            height: 20px;
            background: linear-gradient(180deg, var(--green), var(--gold));
            border-radius: 2px;
            flex-shrink: 0;
        }

        .mui-section-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .mui-section-more {
            font-size: 13px;
            font-weight: 600;
            color: var(--green);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap var(--transition);
        }

        .mui-section-more:hover {
            gap: 8px;
        }

        /* ── BERITA SECTION ───────────────────────────────── */
        .mui-section {
            padding: 36px 0;
        }

        .mui-section.gray {
            background: var(--bg);
        }

        /* News card grid */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .news-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all var(--transition);
        }

        .news-card:hover {
            box-shadow: var(--shadow);
            transform: translateY(-3px);
            border-color: transparent;
        }

        .news-card-thumb {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: var(--bg);
        }

        .news-card-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .news-card:hover .news-card-thumb img {
            transform: scale(1.06);
        }

        .news-card-body {
            padding: 14px;
        }

        .news-cat {
            display: inline-block;
            background: var(--green-pale);
            color: var(--green);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 2px 9px;
            border-radius: 20px;
            margin-bottom: 8px;
        }

        .news-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.45;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-card:hover .news-title {
            color: var(--green);
        }

        .news-meta {
            font-size: 11.5px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .news-meta i {
            color: var(--green);
            font-size: 10px;
        }

        /* ── SIDEBAR SECTION ──────────────────────────────── */
        .with-sidebar {
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 28px;
            align-items: start;
        }

        .sidebar-widget {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            margin-bottom: 20px;
        }

        .widget-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--green);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .widget-title i {
            color: var(--gold);
        }

        /* Fatwa widget */
        .fatwa-item {
            padding: 10px 0;
            border-bottom: 1px dashed var(--border);
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.4;
        }

        .fatwa-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .fatwa-item::before {
            content: '→';
            color: var(--green);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .fatwa-item:hover {
            color: var(--green);
        }

        /* Jadwal sholat widget */
        .sholat-table {
            width: 100%;
            font-size: 13px;
        }

        .sholat-table tr td {
            padding: 7px 0;
        }

        .sholat-table tr td:last-child {
            font-weight: 700;
            color: var(--green);
            text-align: right;
        }

        .sholat-table tr {
            border-bottom: 1px dashed var(--border);
        }

        .sholat-table tr:last-child {
            border-bottom: none;
        }

        /* ── NEWSLETTER BAND ──────────────────────────────── */
        .newsletter-band {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%);
            padding: 40px 0;
            position: relative;
            overflow: hidden;
        }

        .newsletter-band::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(45deg, transparent, transparent 30px, rgba(255, 255, 255, .02) 30px, rgba(255, 255, 255, .02) 60px);
        }

        .newsletter-inner {
            position: relative;
            z-index: 1;
        }

        .newsletter-arabic {
            font-family: 'Amiri', serif;
            font-size: 20px;
            color: rgba(255, 255, 255, .6);
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .newsletter-title {
            font-size: 24px;
            font-weight: 800;
            color: var(--white);
            margin-bottom: 6px;
        }

        .newsletter-sub {
            font-size: 14px;
            color: rgba(255, 255, 255, .75);
            margin-bottom: 24px;
        }

        .newsletter-form {
            display: flex;
            gap: 8px;
            max-width: 440px;
        }

        .newsletter-input {
            flex: 1;
            padding: 11px 18px;
            border: none;
            border-radius: 24px;
            font-size: 13.5px;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .newsletter-btn {
            padding: 11px 24px;
            background: var(--gold);
            color: #333;
            border: none;
            border-radius: 24px;
            font-size: 13.5px;
            font-weight: 800;
            cursor: pointer;
            transition: background var(--transition);
            white-space: nowrap;
        }

        .newsletter-btn:hover {
            background: var(--gold-light);
        }

        /* ── FOOTER ───────────────────────────────────────── */
        .mui-footer {
            background: #111;
            color: rgba(255, 255, 255, .7);
            padding: 48px 0 0;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .footer-brand-icon {
            width: 40px;
            height: 40px;
            background: var(--green);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .footer-brand-name {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
        }

        .footer-brand-name em {
            font-style: normal;
            color: var(--gold-light);
        }

        .footer-brand-sub {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255, 255, 255, .4);
            display: block;
        }

        .footer-desc {
            font-size: 13.5px;
            line-height: 1.7;
            color: rgba(255, 255, 255, .55);
            margin-bottom: 18px;
        }

        .footer-social {
            display: flex;
            gap: 8px;
        }

        .footer-social-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .65);
            font-size: 13px;
            transition: all var(--transition);
        }

        .footer-social-btn:hover {
            background: var(--green);
            border-color: var(--green);
            color: #fff;
        }

        .footer-heading {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--green);
        }

        .footer-links li {
            margin-bottom: 9px;
        }

        .footer-links a {
            font-size: 13.5px;
            color: rgba(255, 255, 255, .55);
            display: flex;
            align-items: center;
            gap: 7px;
            transition: color var(--transition);
        }

        .footer-links a::before {
            content: '›';
            font-size: 14px;
            color: var(--green);
        }

        .footer-links a:hover {
            color: rgba(255, 255, 255, .9);
        }

        .footer-bottom {
            background: rgba(0, 0, 0, .4);
            padding: 14px 0;
            margin-top: 36px;
            font-size: 12.5px;
            color: rgba(255, 255, 255, .35);
            border-top: 1px solid rgba(201, 168, 76, .12);
        }

        .footer-bottom a {
            color: var(--gold-light);
        }

        .footer-bottom a:hover {
            color: #fff;
        }

        /* ── SCROLL TOP ───────────────────────────────────── */
        .scroll-top-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 42px;
            height: 42px;
            background: var(--green);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(0, 127, 95, .4);
            transition: all var(--transition);
            z-index: 9999;
        }

        .scroll-top-btn.show {
            display: flex;
        }

        .scroll-top-btn:hover {
            background: var(--green-dark);
            transform: translateY(-3px);
        }

        /* ── MOBILE ───────────────────────────────────────── */
        @media (max-width: 991px) {
            .vb-hero-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .featured-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .with-sidebar {
                grid-template-columns: 1fr;
            }

            .vb-prayer-pills {
                display: none;
            }

            .vb-cta {
                display: none;
            }

            .vb-search {
                max-width: 100%;
            }

            .vb-mobile-toggle {
                display: flex;
            }

            .vb-nav {
                display: none;
            }

            .vb-mobile-nav {
                display: block;
            }
        }

        @media (max-width: 575px) {
            .featured-grid {
                grid-template-columns: 1fr;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .mui-shell {
                padding: 0 14px;
            }
        }
    </style>
</head>

<body>

    {{-- ── TOPBAR ────────────────────────────────────────────────── --}}
    <div class="vb-topbar">
        <div class="vb-topbar-inner">
            <div class="vb-topbar-date">
                <i class="fas fa-calendar-alt"></i>
                {{-- {{ now()->translatedFormat('l, d F Y') }} / {{ now()->hijri() ?? '' }} --}}
            </div>
            <div class="vb-prayer-pills">
                <span class="vb-prayer-pill"><b>Subuh</b> 04:38</span>
                <span class="vb-prayer-pill"><b>Dzuhur</b> 12:01</span>
                <span class="vb-prayer-pill"><b>Ashar</b> 15:14</span>
                <span class="vb-prayer-pill"><b>Maghrib</b> 18:02</span>
                <span class="vb-prayer-pill"><b>Isya</b> 19:13</span>
            </div>
        </div>
    </div>

    {{-- ── MAINBAR (Logo + Search + CTA) ────────────────────────── --}}
    <div class="vb-mainbar">
        <div class="vb-mainbar-inner">
            <a href="/" class="vb-logo">
                <div class="vb-logo-icon">
                    <svg width="24" height="24" viewBox="0 0 28 28" fill="none">
                        <polygon
                            points="14,2 16.9,10.5 26,10.5 18.6,15.9 21.5,24.4 14,19 6.5,24.4 9.4,15.9 2,10.5 11.1,10.5"
                            fill="#c9a84c" />
                        <polygon
                            points="14,6 15.8,11.5 21.5,11.5 17,14.7 18.8,20.2 14,17 9.2,20.2 11,14.7 6.5,11.5 12.2,11.5"
                            fill="#fff" opacity=".7" />
                    </svg>
                </div>
                <div class="vb-logo-text">
                    <span class="vb-logo-name">MUI<em>Digital</em></span>
                    <span class="vb-logo-sub">Majelis Ulama Indonesia</span>
                </div>
            </a>

            <form class="vb-search" role="search">
                <i class="fas fa-search vb-search-icon"></i>
                <input type="search" class="vb-search-input" placeholder="Cari berita, fatwa, ulama, atau topik..."
                    autocomplete="off">
            </form>

            <a href="#" class="vb-cta">
                <i class="fas fa-comments"></i> Konsultasi
            </a>

            <button class="vb-mobile-toggle" id="mobileMenuBtn" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    {{-- ── NAVBAR ─────────────────────────────────────────────────── --}}
    <nav class="vb-nav" id="mainNav">
        <div class="vb-nav-inner">
            <div class="vb-nav-item has-children">
                <a href="#" class="vb-nav-link active">
                    <span>Tentang Kami</span>
                    <span class="vb-nav-caret"></span>
                </a>
                <div class="vb-submenu">
                    <a href="#" class="vb-nav-link">Profil MUI</a>
                    <a href="#" class="vb-nav-link">Pimpinan</a>
                    <a href="#" class="vb-nav-link">Komisi</a>
                    <a href="#" class="vb-nav-link">Badan/Lembaga</a>
                </div>
            </div>
            <div class="vb-nav-item"><a href="{{ route('berita.list') }}" class="vb-nav-link"><span>Berita</span></a>
            </div>
            <div class="vb-nav-item has-children">
                <a href="#" class="vb-nav-link">
                    <span>Fatwa</span><span class="vb-nav-caret"></span>
                </a>
                <div class="vb-submenu">
                    <a href="#" class="vb-nav-link">Fatwa MUI</a>
                    <a href="#" class="vb-nav-link">Fatwa DSN MUI</a>
                </div>
            </div>
            <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Konsultasi</span></a></div>
            <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Da'i</span></a></div>
            <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Khutbah</span></a></div>
            <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Halal</span></a></div>
            <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Kabar Daerah</span></a></div>
            <div class="vb-nav-item"><a href="#" class="vb-nav-link"><span>Donasi</span></a></div>
        </div>
    </nav>

    {{-- ── LIVE TICKER ─────────────────────────────────────────────── --}}
    <div class="vb-ticker">
        <div class="vb-ticker-inner">
            <span class="vb-ticker-label">Live Update</span>
            <div class="vb-ticker-mask">
                <div class="vb-ticker-track">
                    <a href="#" class="vb-ticker-item"><span>LAKK MUI: Praktisi Pengobatan Syariah Harus
                            Berpendidikan Formal</span></a>
                    <a href="#" class="vb-ticker-item"><span>Pemerintah Pastikan Wajib Halal Oktober 2026
                            Dilakukan Pembinaan</span></a>
                    <a href="#" class="vb-ticker-item"><span>Tata Cara Puasa Ayyamul Bidh, Lengkap dengan Bacaan
                            Niatnya</span></a>
                    <a href="#" class="vb-ticker-item"><span>Konferensi Grand Imam Internasional Dorong
                            Diplomasi Agama</span></a>
                    <a href="#" class="vb-ticker-item"><span>Khutbah Jumat: Amalan Sunnah di Bulan Rabiul
                            Akhir</span></a>
                    {{-- duplicate for seamless loop --}}
                    <a href="#" class="vb-ticker-item"><span>LAKK MUI: Praktisi Pengobatan Syariah Harus
                            Berpendidikan Formal</span></a>
                    <a href="#" class="vb-ticker-item"><span>Pemerintah Pastikan Wajib Halal Oktober 2026
                            Dilakukan Pembinaan</span></a>
                    <a href="#" class="vb-ticker-item"><span>Tata Cara Puasa Ayyamul Bidh, Lengkap dengan Bacaan
                            Niatnya</span></a>
                </div>
            </div>
        </div>
    </div>

    {{-- ── HERO SECTION ────────────────────────────────────────────── --}}
    <section class="vb-hero">
        <div class="vb-hero-grid">

            {{-- LEFT: Featured + list --}}
            <div>
                <a href="#" class="post-card post-classic d-block">
                    <div class="post-media">
                        <img src="{{ asset('template/assets/img/trending/trending_top.jpg') }}" alt="Berita Utama"
                            loading="eager">
                    </div>
                    <div class="post-body">
                        <div class="post-meta">
                            <span class="post-category">Tuntunan Ibadah</span>
                            <time class="post-date"><i class="fas fa-clock me-1"></i>
                                {{ now()->format('d M Y | H.i') }} WIB</time>
                        </div>
                        <h2 class="post-title">Tata Cara Puasa Ayyamul Bidh, Lengkap dengan Bacaan Niatnya</h2>
                    </div>
                </a>

                <div style="padding: 0 2px;">
                    @foreach ([['cat' => 'Opini', 'title' => 'Memahami dan Meyakini Mukjizat Nabi Muhammad SAW'], ['cat' => 'Berita', 'title' => 'LAKK MUI: Praktisi Pengobatan Syariah Harus Berpendidikan Formal'], ['cat' => 'Berita', 'title' => 'Konferensi Grand Imam Internasional Dorong Diplomasi Agama Redam Konflik'], ['cat' => 'Berita', 'title' => 'Bechi Dibebaskan Bersyarat, Ketua MUI Pertanyakan Rasa Keadilan'], ['cat' => 'Halal', 'title' => 'Pemerintah Pastikan Wajib Halal Oktober 2026: Pembinaan Bukan Penalti']] as $item)
                        <a href="#" class="post-card post-title-item d-block">
                            <div class="post-meta">
                                <span class="post-category">{{ $item['cat'] }}</span>
                                <time class="post-date">{{ now()->subMinutes(rand(30, 180))->format('H.i') }}
                                    WIB</time>
                            </div>
                            <h3 class="post-title">{{ $item['title'] }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- MIDDLE: Overlay + thumbnail list --}}
            <div>
                <a href="#" class="post-card post-overlay d-block">
                    <div class="post-media">
                        <img src="{{ asset('template/assets/img/trending/trending_bottom1.jpg') }}" alt="Berita"
                            loading="lazy">
                    </div>
                    <div class="post-body">
                        <div class="post-meta">
                            <span class="post-category">Berita</span>
                            <time class="post-date">{{ now()->format('d M Y | H.i') }} WIB</time>
                        </div>
                        <h3 class="post-title">Hindari Status Anak Tidak Sekolah, Pesantren Didorong Tertib Pendataan
                        </h3>
                    </div>
                </a>

                <div>
                    @foreach ([['img' => 'trending_bottom2.jpg', 'cat' => 'Berita', 'title' => 'LPEU MUI Siapkan Proyeksi Ekonomi 2027 dan UMKM Summit'], ['img' => 'trending_bottom3.jpg', 'cat' => 'Ekonomi', 'title' => 'Pipa East-West Lumpuh, Arab Saudi Siapkan Jalur Alternatif Ekspor'], ['img' => 'right1.jpg', 'cat' => 'Berita', 'title' => 'Menag Luncurkan Rangkaian Hari Santri 2026 Hingga Perkemahan Santri'], ['img' => 'trending_top.jpg', 'cat' => 'Halal', 'title' => 'Apresiasi Perbaikan Tata Kelola MBG, Prof Niam Dorong Sertifikasi Halal']] as $item)
                        <a href="#" class="post-card post-list d-flex">
                            <div class="post-media">
                                <img src="{{ asset('template/assets/img/trending/' . $item['img']) }}" alt=""
                                    loading="lazy">
                            </div>
                            <div class="post-body">
                                <div class="post-meta">
                                    <span class="post-category">{{ $item['cat'] }}</span>
                                </div>
                                <h3 class="post-title">{{ $item['title'] }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- SIDEBAR: Terpopuler --}}
            <aside class="vb-hero-popular">
                <div class="vb-hero-popular-head">
                    <h2>Terpopuler</h2>
                    <span>7 hari</span>
                </div>
                @foreach ([['cat' => 'Berita', 'title' => 'Masjid Berusia 1.300 Tahun dengan Prasasti Islam Awal Ditemukan di Arab Saudi'], ['cat' => 'Opini', 'title' => 'Tadabbur Makna "Maliki Yaumiddin"'], ['cat' => 'Opini', 'title' => 'Catatan Ibadah Haji 2026: Cinta dan Air Mata di Jalur Mina'], ['cat' => 'Khutbah', 'title' => 'Khutbah Jumat: Amalan Sunnah di Bulan Rabiul Akhir'], ['cat' => 'Berita', 'title' => 'Hikmah Kiai Ni\'am: Dzikrullah Kunci Ketenangan Hati']] as $i => $item)
                    <a href="#" class="post-rank-item d-flex">
                        <span class="post-rank">{{ $i + 1 }}</span>
                        <div class="post-rank-body">
                            <div class="post-meta" style="margin-bottom:4px;">
                                <span class="post-category">{{ $item['cat'] }}</span>
                            </div>
                            <div class="post-title">{{ $item['title'] }}</div>
                        </div>
                    </a>
                @endforeach
            </aside>

        </div>
    </section>

    {{-- ── FEATURED SERVICES ────────────────────────────────────────── --}}
    <section class="section-featured">
        <div class="mui-shell">
            <div class="featured-grid">
                <a href="#" class="featured-card">
                    <span class="featured-card-icon">🎓</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Layanan</span>
                        <span class="featured-card-title">Tanya Ulama</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="#" class="featured-card">
                    <span class="featured-card-icon">📜</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Rujukan</span>
                        <span class="featured-card-title">Fatwa</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="#" class="featured-card">
                    <span class="featured-card-icon">✅</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Sertifikasi</span>
                        <span class="featured-card-title">Halal</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="#" class="featured-card">
                    <span class="featured-card-icon">📖</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Materi</span>
                        <span class="featured-card-title">Khutbah</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
                <a href="#" class="featured-card">
                    <span class="featured-card-icon">💚</span>
                    <span class="featured-card-body">
                        <span class="featured-card-label">Sosial</span>
                        <span class="featured-card-title">Donasi</span>
                    </span>
                    <i class="fas fa-arrow-right featured-card-arrow"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ── BERITA TERKINI ───────────────────────────────────────────── --}}
    <section class="mui-section">
        <div class="mui-shell">
            <div class="mui-section-head">
                <h3 class="mui-section-title">Berita Terkini</h3>
                <div class="mui-section-line"></div>
                <a href="#" class="mui-section-more">Lihat semua <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="news-grid">
                @foreach ([['img' => 'whatNews1.jpg', 'cat' => 'Nasional', 'title' => 'Pemerintah Luncurkan Program Digitalisasi UMKM Nasional Skala Besar', 'time' => '1 jam lalu'], ['img' => 'whatNews2.jpg', 'cat' => 'Ekonomi', 'title' => 'Investasi Sektor Hijau Tumbuh Pesat di Kuartal Ketiga 2026', 'time' => '3 jam lalu'], ['img' => 'whatNews3.jpg', 'cat' => 'Teknologi', 'title' => 'Startup AI Indonesia Berhasil Raih Pendanaan Seri B dari Investor', 'time' => '5 jam lalu'], ['img' => 'whatNews4.jpg', 'cat' => 'Pendidikan', 'title' => 'Universitas Terkemuka Buka Program Beasiswa Internasional untuk Mahasiswa', 'time' => '6 jam lalu']] as $n)
                    <div class="news-card">
                        <div class="news-card-thumb">
                            <img src="{{ asset('template/assets/img/news/' . $n['img']) }}"
                                alt="{{ $n['title'] }}" loading="lazy">
                        </div>
                        <div class="news-card-body">
                            <span class="news-cat">{{ $n['cat'] }}</span>
                            <div class="news-title"><a href="#">{{ $n['title'] }}</a></div>
                            <div class="news-meta"><i class="fas fa-clock"></i> {{ $n['time'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── FATWA + JADWAL SHOLAT (with sidebar) ───────────────────── --}}
    <section class="mui-section gray">
        <div class="mui-shell">
            <div class="with-sidebar">
                {{-- Main: Fatwa & Bimbingan --}}
                <div>
                    <div class="mui-section-head">
                        <h3 class="mui-section-title">Fatwa & Bimbingan</h3>
                        <div class="mui-section-line"></div>
                        <a href="#" class="mui-section-more">Selengkapnya <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="news-grid" style="grid-template-columns: repeat(3, 1fr);">
                        @foreach ([['img' => 'whatNews1.jpg', 'cat' => 'Fatwa', 'title' => 'Hukum Penggunaan Dana Zakat untuk Investasi Produktif'], ['img' => 'whatNews2.jpg', 'cat' => 'Bimbingan', 'title' => 'Tata Cara Sholat Jenazah yang Benar Sesuai Sunnah Nabi'], ['img' => 'whatNews3.jpg', 'cat' => 'Fatwa', 'title' => 'Status Hukum Transaksi Digital dan Dompet Elektronik']] as $f)
                            <div class="news-card">
                                <div class="news-card-thumb">
                                    <img src="{{ asset('template/assets/img/news/' . $f['img']) }}" alt=""
                                        loading="lazy">
                                </div>
                                <div class="news-card-body">
                                    <span class="news-cat">{{ $f['cat'] }}</span>
                                    <div class="news-title"><a href="#">{{ $f['title'] }}</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div style="margin-top: 28px;">
                        <div class="mui-section-head">
                            <h3 class="mui-section-title">Khutbah Jumat</h3>
                            <div class="mui-section-line"></div>
                            <a href="#" class="mui-section-more">Selengkapnya <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="news-grid" style="grid-template-columns: repeat(3, 1fr);">
                            @foreach ([['img' => 'whatNews4.jpg', 'title' => 'Amalan Sunnah di Bulan Rabiul Akhir yang Perlu Diketahui Umat'], ['img' => 'whatNews1.jpg', 'title' => 'Meningkatkan Iman dengan Dzikir dan Tadabbur Al-Quran Setiap Hari'], ['img' => 'whatNews2.jpg', 'title' => 'Pentingnya Silaturahmi dalam Mempererat Ukhuwah Islamiyah']] as $k)
                                <div class="news-card">
                                    <div class="news-card-thumb" style="height: 150px;">
                                        <img src="{{ asset('template/assets/img/news/' . $k['img']) }}"
                                            alt="" loading="lazy">
                                    </div>
                                    <div class="news-card-body">
                                        <span class="news-cat">Khutbah</span>
                                        <div class="news-title"><a href="#">{{ $k['title'] }}</a></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside>
                    <div class="sidebar-widget">
                        <div class="widget-title"><i class="fas fa-clock"></i> Jadwal Sholat</div>
                        <div style="font-size:12px;color:var(--muted);margin-bottom:10px;">Jakarta —
                            {{ now()->format('d M Y') }}</div>
                        <table class="sholat-table">
                            <tr>
                                <td>Subuh</td>
                                <td>04:38</td>
                            </tr>
                            <tr>
                                <td>Syuruq</td>
                                <td>05:54</td>
                            </tr>
                            <tr>
                                <td>Dzuhur</td>
                                <td>12:01</td>
                            </tr>
                            <tr>
                                <td>Ashar</td>
                                <td>15:14</td>
                            </tr>
                            <tr>
                                <td>Maghrib</td>
                                <td>18:02</td>
                            </tr>
                            <tr>
                                <td>Isya</td>
                                <td>19:13</td>
                            </tr>
                        </table>
                    </div>

                    <div class="sidebar-widget">
                        <div class="widget-title"><i class="fas fa-file-alt"></i> Fatwa Terbaru</div>
                        @foreach (['Penggunaan Dana Zakat untuk Istitsmar (Investasi)', 'Hukum Sholat Berjamaah via Aplikasi Video Call', 'Status Halal Vaksin dan Penggunaannya', 'Hukum NFT dan Aset Digital dalam Islam', 'Tata Kelola Wakaf Produktif di Era Modern'] as $f)
                            <a href="#" class="fatwa-item">{{ $f }}</a>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- ── NEWSLETTER BAND ──────────────────────────────────────────── --}}
    <section class="newsletter-band">
        <div class="mui-shell newsletter-inner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="newsletter-arabic">بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيم</div>
                    <div class="newsletter-title">Tetap Terhubung dengan MUI Digital</div>
                    <div class="newsletter-sub">Dapatkan berita, fatwa, dan informasi islami terpercaya langsung ke
                        email Anda.</div>
                    <div class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Masukkan alamat email Anda...">
                        <button class="newsletter-btn">Berlangganan</button>
                    </div>
                </div>
                <div class="col-lg-6 text-center d-none d-lg-block">
                    <div style="font-family:'Amiri',serif;font-size:60px;color:rgba(255,255,255,.12);line-height:1;">
                        ﴾ الإسلام ﴿
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── FOOTER ───────────────────────────────────────────────────── --}}
    <footer class="mui-footer">
        <div class="mui-shell">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <div class="footer-brand-icon">
                            <svg width="22" height="22" viewBox="0 0 28 28" fill="none">
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
                        <a href="#" class="footer-social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-btn"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-btn"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="footer-social-btn"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-heading">Kategori</div>
                    <ul class="footer-links">
                        <li><a href="#">Berita</a></li>
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
                        <li><a href="#">Profil MUI</a></li>
                        <li><a href="#">Pimpinan & Pengurus</a></li>
                        <li><a href="#">Komisi & Lembaga</a></li>
                        <li><a href="#">Kontak Kami</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="mui-shell">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <p class="mb-0">Copyright &copy; {{ date('Y') }} <a href="/">MUI Digital</a>. Semua
                        hak dilindungi.</p>
                    <div class="d-flex gap-3">
                        <a href="#">Kebijakan Privasi</a>
                        <a href="#">Syarat & Ketentuan</a>
                        <a href="#">Kontak</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- ── SCROLL TO TOP ────────────────────────────────────────────── --}}
    <button class="scroll-top-btn" id="scrollTopBtn" aria-label="Scroll ke atas">
        <i class="fas fa-chevron-up"></i>
    </button>

    {{-- ── JS ─────────────────────────────────────────────────────────── --}}
    <script src="{{ asset('template/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>

    <script>
        (function() {
            'use strict';

            // ── Scroll to top (single instance, no plugin) ──
            var btn = document.getElementById('scrollTopBtn');
            window.addEventListener('scroll', function() {
                btn.classList.toggle('show', window.scrollY > 300);
            }, {
                passive: true
            });
            btn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // ── Mobile menu toggle ──
            var mobileBtn = document.getElementById('mobileMenuBtn');
            var nav = document.getElementById('mainNav');
            if (mobileBtn && nav) {
                mobileBtn.addEventListener('click', function() {
                    var shown = nav.style.display === 'block';
                    nav.style.display = shown ? '' : 'block';
                });
            }
        })();
    </script>

</body>

</html>
