<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="icon" href="<?= base_url('assets/images/favicon-32x32.png') ?>" type="image/png">

    <!-- plugins -->
    <link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">

    <!-- loader -->
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap-extended.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sass/app.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/sass/dark-theme.css') ?>">
    <link href="<?= base_url('assets/css/icons.css') ?>" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <title>X-CHECK Login</title>

    <style>
        :root {
            --xc-teal: #0fb4a0;
            --xc-teal-light: #14d9c2;
            --xc-teal-dark: #0a8a7a;
            --xc-navy: #1a1a2e;
            --xc-navy-light: #24243e;
            --xc-purple: #7c3aed;
            --xc-orange: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.xc-login-body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--xc-navy) 0%, #20203a 50%, var(--xc-navy-light) 100%);
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient teal/purple glow particles */
        body.xc-login-body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(2px 2px at 20% 30%, rgba(15, 180, 160, 0.35), transparent),
                radial-gradient(2px 2px at 40% 70%, rgba(124, 58, 237, 0.25), transparent),
                radial-gradient(2px 2px at 50% 40%, rgba(15, 180, 160, 0.3), transparent),
                radial-gradient(2px 2px at 60% 80%, rgba(245, 158, 11, 0.15), transparent),
                radial-gradient(2px 2px at 80% 10%, rgba(15, 180, 160, 0.25), transparent),
                radial-gradient(1px 1px at 70% 50%, rgba(124, 58, 237, 0.2), transparent),
                radial-gradient(1px 1px at 90% 20%, rgba(15, 180, 160, 0.3), transparent),
                radial-gradient(1px 1px at 10% 60%, rgba(255, 255, 255, 0.2), transparent),
                radial-gradient(1px 1px at 30% 90%, rgba(255, 255, 255, 0.15), transparent),
                radial-gradient(1px 1px at 15% 15%, rgba(255, 255, 255, 0.25), transparent);
            background-size: 200% 200%;
            animation: xcStarFloat 30s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes xcStarFloat {

            0%,
            100% {
                background-position: 0% 0%;
            }

            25% {
                background-position: 50% 50%;
            }

            50% {
                background-position: 100% 100%;
            }

            75% {
                background-position: 50% 0%;
            }
        }

        /* Floating orbs */
        .xc-floating-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            pointer-events: none;
            z-index: 0;
        }

        .xc-orb-1 {
            width: 420px;
            height: 420px;
            background: var(--xc-teal);
            top: -100px;
            right: -100px;
            animation: xcOrbFloat1 20s ease-in-out infinite;
        }

        .xc-orb-2 {
            width: 300px;
            height: 300px;
            background: var(--xc-purple);
            bottom: -50px;
            left: -50px;
            animation: xcOrbFloat2 25s ease-in-out infinite;
        }

        .xc-orb-3 {
            width: 260px;
            height: 260px;
            background: var(--xc-orange);
            top: 50%;
            left: 50%;
            animation: xcOrbFloat3 18s ease-in-out infinite;
        }

        @keyframes xcOrbFloat1 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(-80px, 80px) scale(1.1);
            }

            66% {
                transform: translate(40px, -40px) scale(0.9);
            }
        }

        @keyframes xcOrbFloat2 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(60px, -60px) scale(1.15);
            }

            66% {
                transform: translate(-30px, 30px) scale(0.85);
            }
        }

        @keyframes xcOrbFloat3 {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
            }

            50% {
                transform: translate(-50%, -50%) scale(1.2);
            }
        }

        .xc-wrapper {
            position: relative;
            z-index: 1;
        }

        .xc-login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .xc-login-card {
            width: 100%;
            max-width: 960px;
            display: flex;
            border-radius: 24px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(12px);
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
            animation: xcCardSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(40px);
        }

        @keyframes xcCardSlideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left brand panel */
        .xc-brand-panel {
            flex: 0 0 380px;
            background: linear-gradient(160deg, var(--xc-teal) 0%, var(--xc-teal-dark) 60%, #086b5e 100%);
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .xc-brand-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: xcPatternMove 40s linear infinite;
        }

        @keyframes xcPatternMove {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(30px, 30px);
            }
        }

        .xc-brand-panel::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(124, 58, 237, 0.18);
        }

        .xc-brand-content {
            position: relative;
            z-index: 1;
        }

        .xc-brand-logo {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.75rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            animation: xcLogoPulse 3s ease-in-out infinite;
        }

        .xc-brand-logo span {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: #fff;
            letter-spacing: -0.5px;
        }

        @keyframes xcLogoPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.2);
            }

            50% {
                box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
            }
        }

        .xc-brand-content h2 {
            font-family: 'Sora', sans-serif;
            color: #fff;
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 0.6rem;
            line-height: 1.2;
        }

        .xc-brand-content>p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 2.25rem;
        }

        .xc-brand-tagline {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.65);
            margin-bottom: 0.35rem;
        }

        .xc-brand-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .xc-brand-features li {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.92);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0;
            animation: xcFeatureSlide 0.5s ease forwards;
        }

        .xc-brand-features li:nth-child(1) {
            animation-delay: 0.3s;
        }

        .xc-brand-features li:nth-child(2) {
            animation-delay: 0.5s;
        }

        .xc-brand-features li:nth-child(3) {
            animation-delay: 0.7s;
        }

        .xc-brand-features li:nth-child(4) {
            animation-delay: 0.9s;
        }

        @keyframes xcFeatureSlide {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .xc-feature-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: #fff;
        }

        /* Right form panel */
        .xc-form-panel {
            flex: 1;
            background: rgba(255, 255, 255, 0.97);
            padding: 3rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .xc-form-header {
            text-align: center;
            margin-bottom: 2.25rem;
        }

        .xc-form-header .xc-mobile-logo {
            display: none;
            width: 50px;
            margin-bottom: 1rem;
        }

        .xc-form-header h4 {
            font-family: 'Sora', sans-serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--xc-navy);
            margin-bottom: 0.3rem;
        }

        .xc-form-header p {
            color: #94a3b8;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Custom alerts */
        .xc-alert-danger {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 12px;
            padding: 0.85rem 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            animation: xcAlertShake 0.5s ease;
        }

        .xc-alert-success {
            background: linear-gradient(135deg, rgba(15, 180, 160, 0.1), rgba(15, 180, 160, 0.18));
            border: 1px solid rgba(15, 180, 160, 0.35);
            color: var(--xc-teal-dark);
            border-radius: 12px;
            padding: 0.85rem 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            animation: xcAlertSlide 0.5s ease;
        }

        @keyframes xcAlertShake {

            0%,
            100% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-8px);
            }

            40% {
                transform: translateX(8px);
            }

            60% {
                transform: translateX(-4px);
            }

            80% {
                transform: translateX(4px);
            }
        }

        @keyframes xcAlertSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .xc-alert-danger .xc-alert-close,
        .xc-alert-success .xc-alert-close {
            margin-left: auto;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
            color: inherit;
            padding: 0 4px;
        }

        .xc-alert-danger .xc-alert-close:hover,
        .xc-alert-success .xc-alert-close:hover {
            opacity: 1;
        }

        /* Form groups */
        .xc-form-group {
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: xcFieldFadeIn 0.5s ease forwards;
        }

        .xc-form-group:nth-child(1) {
            animation-delay: 0.15s;
        }

        .xc-form-group:nth-child(2) {
            animation-delay: 0.3s;
        }

        @keyframes xcFieldFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .xc-form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.45rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .xc-input-wrapper {
            position: relative;
        }

        .xc-input-wrapper .xc-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.15rem;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .xc-input-wrapper input {
            width: 100%;
            padding: 0.85rem 0.85rem 0.85rem 2.85rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-family: 'DM Sans', sans-serif;
            color: var(--xc-navy);
            background: #f8fafc;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .xc-input-wrapper input::placeholder {
            color: #cbd5e1;
        }

        .xc-input-wrapper input:hover {
            border-color: #cbd5e1;
            background: #fff;
        }

        .xc-input-wrapper input:focus {
            border-color: var(--xc-teal);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(15, 180, 160, 0.12);
        }

        .xc-input-wrapper input:focus~.xc-input-icon {
            color: var(--xc-teal);
        }

        /* Password toggle */
        .xc-password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1.15rem;
            padding: 4px;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .xc-password-toggle:hover {
            color: var(--xc-teal);
        }

        /* Submit button */
        .xc-btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-light) 100%);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.3px;
        }

        .xc-btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.5s ease;
        }

        .xc-btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(15, 180, 160, 0.45);
        }

        .xc-btn-login:hover::before {
            left: 100%;
        }

        .xc-btn-login:active {
            transform: translateY(0);
        }

        .xc-btn-login .xc-btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* Divider */
        .xc-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.75rem 0;
            color: #94a3b8;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .xc-divider::before,
        .xc-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* Register link */
        .xc-register-link {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .xc-register-link a {
            color: var(--xc-teal-dark);
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: color 0.3s ease;
        }

        .xc-register-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--xc-teal);
            transition: width 0.3s ease;
            border-radius: 1px;
        }

        .xc-register-link a:hover::after {
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .xc-brand-panel {
                display: none;
            }

            .xc-form-panel {
                padding: 2.5rem 1.75rem;
            }

            .xc-login-card {
                max-width: 440px;
                border-radius: 20px;
            }

            .xc-form-header .xc-mobile-logo {
                display: inline-block;
            }

            .xc-login-container {
                padding: 1rem;
            }
        }

        @media (max-width: 400px) {
            .xc-form-panel {
                padding: 2rem 1.25rem;
            }
        }
    </style>
</head>

<body class="xc-login-body">

    <!-- Floating orbs -->
    <div class="xc-floating-orb xc-orb-1"></div>
    <div class="xc-floating-orb xc-orb-2"></div>
    <div class="xc-floating-orb xc-orb-3"></div>

    <div class="xc-wrapper">
        <div class="xc-login-container">
            <div class="xc-login-card">

                <!-- Left Brand Panel -->
                <div class="xc-brand-panel">
                    <div class="xc-brand-content">
                        <div class="xc-brand-logo">
                            <span>XC</span>
                        </div>

                        <div class="xc-brand-tagline">Digital Site Survey</div>
                        <h2>Welcome Back!</h2>
                        <p>Track Progress. Improve Transparency. Deliver Better Projects.</p>

                        <ul class="xc-brand-features">
                            <li>
                                <span class="xc-feature-icon"><i class="bi bi-camera2"></i></span>
                                Time-lapse site monitoring
                            </li>
                            <li>
                                <span class="xc-feature-icon"><i class="bi bi-graph-up-arrow"></i></span>
                                Project analytics & reports
                            </li>
                            <li>
                                <span class="xc-feature-icon"><i class="bi bi-shield-lock"></i></span>
                                Secure authentication
                            </li>
                            <li>
                                <span class="xc-feature-icon"><i class="bi bi-lightning"></i></span>
                                Fast & reliable performance
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Form Panel -->
                <div class="xc-form-panel">

                    <div class="xc-form-header">
                        <img src="<?= base_url('assets/images/logo-icon.png') ?>" class="xc-mobile-logo" alt="Logo">
                        <h4>X-CHECK</h4>
                        <p>Please log in to your account</p>
                    </div>

                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="xc-alert-success">
                            <i class="bi bi-check-circle-fill"></i>
                            <span><?= $this->session->flashdata('success'); ?></span>
                            <button class="xc-alert-close" onclick="this.parentElement.remove()">&times;</button>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="xc-alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span><?= $this->session->flashdata('error'); ?></span>
                            <button class="xc-alert-close" onclick="this.parentElement.remove()">&times;</button>
                        </div>
                    <?php endif; ?>

                    <form id="loginForm" action="<?= base_url('auth/login') ?>" method="post" novalidate>

                        <div class="xc-form-group">
                            <label>Email Address</label>
                            <div class="xc-input-wrapper">
                                <input type="email" name="email" id="inputEmail" placeholder="Enter your email address"
                                    required>
                                <i class="bi bi-envelope xc-input-icon"></i>
                            </div>
                        </div>

                        <div class="xc-form-group">
                            <label>Password</label>
                            <div class="xc-input-wrapper">
                                <input type="password" name="password" id="inputPassword"
                                    placeholder="Enter your password" required>
                                <i class="bi bi-lock xc-input-icon"></i>
                                <button type="button" class="xc-password-toggle" id="togglePasswordBtn">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>


                        <button type="submit" class="xc-btn-login">
                            <span class="xc-btn-content">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login
                            </span>
                        </button>

                    </form>

                    <div class="xc-divider">or</div>

                    <p class="xc-register-link">
                        Don't have an account? <a href="<?= base_url('auth/register') ?>">Create one</a>
                    </p>

                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/metismenu/js/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>

    <script>
        // Password show/hide toggle
        document.getElementById('togglePasswordBtn').addEventListener('click', function () {
            const passwordInput = document.getElementById('inputPassword');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });

        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.xc-alert-success, .xc-alert-danger').forEach(function (alert) {
            setTimeout(function () {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function () { alert.remove(); }, 500);
            }, 5000);
        });
    </script>

</body>

</html>