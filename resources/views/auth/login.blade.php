<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUI Digital — Login</title>
    <meta name="description" content="Login Panel MUI Digital">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('templateadmin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">

    <style>
        /* ========================================================
       MUI DIGITAL — LOGIN PAGE
       Islamic + Particles Theme | #007f5f
    ======================================================== */

        :root {
            --green: #007f5f;
            --green-dark: #005f47;
            --green-light: #00a878;
            --green-glow: rgba(0, 127, 95, .35);
            --gold: #c9a84c;
            --gold-light: #f0d080;
            --white: #ffffff;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }

        /* ── BACKGROUND + PARTICLES ── */
        .login-bg {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg,
                    #002a1e 0%,
                    #004030 30%,
                    var(--green-dark) 55%,
                    #004a38 75%,
                    #002a1e 100%);
            z-index: 0;
        }

        /* Subtle geometric pattern overlay */
        .login-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 20%, rgba(201, 168, 76, .08) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(0, 127, 95, .15) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(201, 168, 76, .04) 0%, transparent 70%);
            pointer-events: none;
        }

        #particles-js {
            position: fixed;
            inset: 0;
            z-index: 1;
        }

        /* ── PAGE LAYOUT ── */
        .login-page {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* ── CARD ── */
        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, .06);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow:
                0 24px 60px rgba(0, 0, 0, .4),
                0 0 0 1px rgba(201, 168, 76, .12) inset,
                0 1px 0 rgba(255, 255, 255, .1) inset;
            animation: cardIn .6s cubic-bezier(.4, 0, .2, 1) both;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* ── GOLD TOP BORDER ── */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 24px;
            right: 24px;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-light), var(--gold), transparent);
            border-radius: 2px;
        }

        .login-card {
            position: relative;
        }

        /* ── LOGO AREA ── */
        .login-logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--green-dark), var(--green));
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            border: 2px solid rgba(201, 168, 76, .4);
            box-shadow:
                0 8px 32px rgba(0, 0, 0, .3),
                0 0 0 6px rgba(0, 127, 95, .15);
            animation: iconPulse 3s ease-in-out infinite;
        }

        @keyframes iconPulse {

            0%,
            100% {
                box-shadow: 0 8px 32px rgba(0, 0, 0, .3), 0 0 0 6px rgba(0, 127, 95, .15);
            }

            50% {
                box-shadow: 0 8px 32px rgba(0, 0, 0, .3), 0 0 0 10px rgba(0, 127, 95, .08);
            }
        }

        .login-brand-name {
            font-size: 22px;
            font-weight: 800;
            color: var(--white);
            letter-spacing: -0.3px;
            display: block;
            line-height: 1;
        }

        .login-brand-name em {
            font-style: normal;
            color: var(--gold-light);
        }

        .login-brand-sub {
            font-size: 11px;
            font-weight: 500;
            color: rgba(255, 255, 255, .5);
            text-transform: uppercase;
            letter-spacing: 2px;
            display: block;
            margin-top: 4px;
        }

        /* ── GOLD DIVIDER ── */
        .login-divider {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 28px;
        }

        .login-divider span:not(.ornament) {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 168, 76, .4), transparent);
        }

        .login-divider .ornament {
            font-family: 'Amiri', serif;
            font-size: 13px;
            color: rgba(201, 168, 76, .7);
            letter-spacing: 3px;
        }

        /* ── WELCOME TEXT ── */
        .login-welcome {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-welcome h4 {
            font-size: 20px;
            font-weight: 800;
            color: var(--white);
            margin: 0 0 4px;
        }

        .login-welcome p {
            font-size: 13px;
            color: rgba(255, 255, 255, .5);
            margin: 0;
        }

        /* ── FORM ── */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .form-group {
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, .65);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: rgba(255, 255, 255, .3);
            transition: color .2s;
            z-index: 1;
            pointer-events: none;
        }

        .input-wrap input:focus~i,
        .input-wrap input:not(:placeholder-shown)~i {
            color: var(--gold);
        }

        .login-input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            background: rgba(255, 255, 255, .07);
            border: 1.5px solid rgba(255, 255, 255, .1);
            border-radius: 12px;
            color: var(--white);
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all .22s ease;
        }

        .login-input::placeholder {
            color: rgba(255, 255, 255, .3);
        }

        .login-input:focus {
            border-color: var(--green-light);
            background: rgba(255, 255, 255, .1);
            box-shadow: 0 0 0 3px rgba(0, 127, 95, .25);
        }

        .login-input:focus::placeholder {
            color: rgba(255, 255, 255, .15);
        }

        /* password toggle */
        .pwd-toggle {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, .3);
            cursor: pointer;
            font-size: 15px;
            transition: color .2s;
            background: none;
            border: none;
            padding: 0;
            z-index: 2;
        }

        .pwd-toggle:hover {
            color: rgba(255, 255, 255, .7);
        }

        /* ── ERROR MESSAGES ── */
        .login-errors {
            background: rgba(239, 68, 68, .15);
            border: 1px solid rgba(239, 68, 68, .3);
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13px;
            color: #fca5a5;
        }

        .login-errors ul {
            padding-left: 18px;
            margin: 0;
        }

        /* ── REMEMBER + FORGOT ── */
        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: rgba(255, 255, 255, .6);
            user-select: none;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--green);
            cursor: pointer;
        }

        /* ── SUBMIT BUTTON ── */
        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--green), var(--green-light));
            color: var(--white);
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all .22s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 20px rgba(0, 127, 95, .4);
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .15), transparent);
            opacity: 0;
            transition: opacity .22s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0, 127, 95, .5);
        }

        .login-btn:hover::before {
            opacity: 1;
        }

        .login-btn:active {
            transform: translateY(0);
        }

        /* ── BACK LINK ── */
        .login-back {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
            color: rgba(255, 255, 255, .4);
        }

        .login-back a {
            color: var(--gold-light);
            font-weight: 600;
            text-decoration: none;
            transition: color .2s;
        }

        .login-back a:hover {
            color: var(--gold);
        }

        /* ── FOOTER TEXT ── */
        .login-footer-text {
            text-align: center;
            margin-top: 24px;
            font-family: 'Amiri', serif;
            font-size: 14px;
            color: rgba(201, 168, 76, .5);
            letter-spacing: 2px;
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar {
            width: 0;
        }

        /* ── ERROR FIELD STYLE ── */
        .login-input.is-error {
            border-color: rgba(239, 68, 68, .5);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 22px;
                border-radius: 18px;
            }

            .login-brand-name {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>

    <!-- Background -->
    <div class="login-bg"></div>

    <!-- Particles Canvas -->
    <div id="particles-js"></div>

    <!-- Login Page -->
    <div class="login-page">
        <div class="login-card">

            <!-- Logo -->
            <div class="login-logo">
                <div class="login-logo-icon">
                    <svg width="34" height="34" viewBox="0 0 28 28" fill="none">
                        <polygon
                            points="14,2 16.9,10.5 26,10.5 18.6,15.9 21.5,24.4 14,19 6.5,24.4 9.4,15.9 2,10.5 11.1,10.5"
                            fill="#c9a84c" opacity=".95" />
                        <polygon
                            points="14,6 15.8,11.5 21.5,11.5 17,14.7 18.8,20.2 14,17 9.2,20.2 11,14.7 6.5,11.5 12.2,11.5"
                            fill="#fff" opacity=".7" />
                    </svg>
                </div>
                <span class="login-brand-name">MUI<em>Digital</em></span>
                <span class="login-brand-sub">Majelis Ulama Indonesia</span>
            </div>

            <!-- Ornament divider -->
            <div class="login-divider">
                <span></span>
                <span class="ornament">❖ ❖ ❖</span>
                <span></span>
            </div>

            <!-- Welcome -->
            <div class="login-welcome">
                <h4>Selamat Datang</h4>
                <p>Masuk ke Panel Admin MUI Digital</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="login-errors" style="margin-bottom: 14px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="login-errors" style="margin-bottom: 14px;">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form class="login-form" action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <input id="username" type="text" name="username"
                            class="login-input {{ $errors->has('username') ? 'is-error' : '' }}"
                            value="{{ old('username') }}" placeholder="username" required autofocus
                            autocomplete="username">
                        <i class="mdi mdi-username-outline"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input id="password" type="password" name="password"
                            class="login-input {{ $errors->has('password') ? 'is-error' : '' }}" placeholder="••••••••"
                            required autocomplete="current-password">
                        <i class="mdi mdi-lock-outline"></i>
                        <button type="button" class="pwd-toggle" id="pwdToggle" aria-label="Tampilkan password">
                            <i class="mdi mdi-eye-outline" id="pwdIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="login-options">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="login-btn">
                    <i class="mdi mdi-login-variant"></i>
                    Masuk ke Panel
                </button>
            </form>

            <!-- Back to site -->
            <div class="login-back">
                <a href="{{ route('home.public') }}">
                    ← Kembali ke MUI Digital
                </a>
            </div>

            <!-- Footer arabic -->
            <div class="login-footer-text">بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيم</div>

        </div>
    </div>

    <!-- particles.js CDN (reliable, no dependency issues) -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <script>
        // ── PARTICLES CONFIG (Islamic-themed: green + gold dots) ──
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 70,
                    density: {
                        enable: true,
                        value_area: 900
                    }
                },
                color: {
                    value: ['#c9a84c', '#007f5f', '#00a878', '#f0d080', '#ffffff']
                },
                shape: {
                    type: ['circle', 'polygon'],
                    polygon: {
                        nb_sides: 6
                    }
                },
                opacity: {
                    value: 0.45,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 0.8,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 3.5,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 2,
                        size_min: 0.5,
                        sync: false
                    }
                },
                line_linked: {
                    enable: true,
                    distance: 130,
                    color: '#007f5f',
                    opacity: 0.2,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1.2,
                    direction: 'none',
                    random: true,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 160,
                        line_linked: {
                            opacity: 0.5
                        }
                    },
                    push: {
                        particles_nb: 4
                    }
                }
            },
            retina_detect: true
        });

        // ── PASSWORD TOGGLE ──
        (function() {
            var toggle = document.getElementById('pwdToggle');
            var input = document.getElementById('password');
            var icon = document.getElementById('pwdIcon');
            if (!toggle) return;
            toggle.addEventListener('click', function() {
                var shown = input.type === 'text';
                input.type = shown ? 'password' : 'text';
                icon.className = shown ? 'mdi mdi-eye-outline' : 'mdi mdi-eye-off-outline';
            });
        })();
    </script>

</body>

</html>
