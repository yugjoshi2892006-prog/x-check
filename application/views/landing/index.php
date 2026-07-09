<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= base_url(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-CHECK – Smart Construction Monitoring Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #14b8a6;
            --primary-dark: #0d9488;
            --primary-darker: #0a7e73;
            --primary-light: #ccfbf1;
            --primary-glow: rgba(20, 184, 166, 0.4);
            --accent: #f97316;
            --accent-light: #fff7ed;
            --dark: #0f172a;
            --mid: #334155;
            --muted: #64748b;
            --light: #f8fafc;
            --border: #e2e8f0;
            --white: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gradient: linear-gradient(135deg, #14b8a6 0%, #2dd4bf 50%, #67e8f9 100%);
            --gradient-warm: linear-gradient(135deg, #f97316 0%, #fb923c 50%, #fbbf24 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
            --gradient-mesh: linear-gradient(160deg, #f0fdfa 0%, #ecfdf5 25%, #f0f9ff 50%, #faf5ff 75%, #fff7ed 100%);
            --shadow-sm: 0 1px 3px rgba(20, 184, 166, 0.08), 0 1px 2px rgba(20, 184, 166, 0.06);
            --shadow: 0 4px 24px rgba(20, 184, 166, 0.12), 0 2px 8px rgba(20, 184, 166, 0.08);
            --shadow-lg: 0 20px 60px rgba(20, 184, 166, 0.18), 0 8px 24px rgba(20, 184, 166, 0.12);
            --shadow-xl: 0 30px 80px rgba(20, 184, 166, 0.22), 0 12px 32px rgba(20, 184, 166, 0.16);
            --shadow-glow: 0 0 40px rgba(27, 123, 112, 0.3), 0 0 80px rgba(20, 184, 166, 0.1);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-lg: 24px;
            --radius-xl: 32px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            background: var(--white);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Sora', sans-serif;
        }

        /* ─── ANIMATED BG PARTICLES ─── */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            animation: particleFloat linear infinite;
            opacity: 0;
        }

        @keyframes particleFloat {
            0% {
                opacity: 0;
                transform: translateY(100vh) rotate(0deg);
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateY(-10vh) rotate(720deg);
            }
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar.scrolled {
            padding: 8px 0;
            box-shadow: 0 4px 30px rgba(20, 184, 166, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }

        .navbar-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
            text-decoration: none;
            transition: transform 0.3s;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .navbar-brand img {
            width: 38px;
            height: 38px;
            object-fit: contain;
            flex-shrink: 0;
            filter: drop-shadow(0 2px 4px rgba(20, 184, 166, 0.3));
        }

        .navbar-brand span {
            color: var(--dark);
        }

        .nav-link {
            color: var(--mid) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 8px 16px !important;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gradient);
            border-radius: 2px;
            transition: all 0.3s;
            transform: translateX(-50%);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 60%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary) !important;
            background: rgba(20, 184, 166, 0.06);
        }

        .btn-nav {
            background: var(--gradient);
            color: white !important;
            border-radius: 12px;
            padding: 10px 24px !important;
            font-weight: 700;
            font-size: 0.88rem;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-nav:hover::before {
            left: 100%;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
        }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--gradient-mesh);
            position: relative;
            overflow: hidden;
            padding: 100px 0 80px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.15) 0%, transparent 60%);
            border-radius: 50%;
            pointer-events: none;
            animation: heroGlow1 8s ease-in-out infinite;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -150px;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 60%);
            border-radius: 50%;
            pointer-events: none;
            animation: heroGlow2 10s ease-in-out infinite;
        }

        @keyframes heroGlow1 {

            0%,
            100% {
                transform: scale(1) translate(0, 0);
                opacity: 0.6;
            }

            50% {
                transform: scale(1.15) translate(-30px, 20px);
                opacity: 1;
            }
        }

        @keyframes heroGlow2 {

            0%,
            100% {
                transform: scale(1) translate(0, 0);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.1) translate(20px, -20px);
                opacity: 0.8;
            }
        }

        /* Grid pattern overlay */
        .hero-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(20, 184, 166, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(20, 184, 166, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: var(--primary-dark);
            border: 1px solid rgba(20, 184, 166, 0.2);
            border-radius: 50px;
            padding: 8px 20px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
            animation: fadeInUp 0.8s ease;
            box-shadow: 0 2px 12px rgba(20, 184, 166, 0.1);
        }

        .hero-badge .dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            animation: pulse 1.8s infinite;
            box-shadow: 0 0 8px rgba(20, 184, 166, 0.6);
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
                box-shadow: 0 0 8px rgba(20, 184, 166, 0.6);
            }

            50% {
                opacity: .6;
                transform: scale(1.4);
                box-shadow: 0 0 16px rgba(20, 184, 166, 0.8);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero h1 {
            font-size: clamp(2.6rem, 5.5vw, 4.2rem);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -2px;
            color: var(--dark);
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease 0.1s both;
        }

        .hero h1 .highlight {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .hero h1 .highlight::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 8px;
            background: var(--gradient);
            opacity: 0.15;
            border-radius: 4px;
            z-index: -1;
        }

        .hero p.lead {
            font-size: 1.15rem;
            color: var(--muted);
            line-height: 1.75;
            max-width: 520px;
            margin-bottom: 40px;
            font-weight: 400;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-cta-group {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 56px;
            animation: fadeInUp 0.8s ease 0.3s both;
        }

        .btn-primary-hero {
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px 36px;
            font-weight: 700;
            font-size: 1rem;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 24px rgba(20, 184, 166, 0.35);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-hero::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            transform: translate(-50%, -50%);
            transition: all 0.5s;
        }

        .btn-primary-hero:hover::before {
            width: 400px;
            height: 400px;
        }

        .btn-primary-hero:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 36px rgba(20, 184, 166, 0.45);
            color: white;
        }

        .btn-primary-hero:active {
            transform: translateY(-1px) scale(0.98);
        }

        .btn-secondary-hero {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            color: var(--dark);
            border: 2px solid rgba(226, 232, 240, 0.8);
            border-radius: 14px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-secondary-hero:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(20, 184, 166, 0.15);
            background: white;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-stat {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .hero-stat::after {
            content: '';
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 30px;
            background: var(--border);
        }

        .hero-stat:last-child::after {
            display: none;
        }

        .hero-stat .num {
            font-family: 'Sora', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-stat .label {
            font-size: 0.78rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 6px;
        }

        /* Dashboard mockup */
        .hero-visual {
            position: relative;
            animation: fadeInRight 1s ease 0.3s both;
        }

        .dashboard-mockup {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(226, 232, 240, 0.6);
            overflow: hidden;
            position: relative;
            z-index: 1;
            animation: float 5s ease-in-out infinite;
            transition: transform 0.3s;
        }

        .dashboard-mockup:hover {
            transform: translateY(-6px);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateY(-8px) rotate(0.5deg);
            }

            75% {
                transform: translateY(-4px) rotate(-0.3deg);
            }
        }

        .mockup-header {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mockup-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .mockup-title {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
            margin-left: 8px;
        }

        .mockup-body {
            padding: 20px;
            background: linear-gradient(180deg, #f8fafc, #ffffff);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 14px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 14px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            text-align: center;
            transition: all 0.3s;
            cursor: default;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
            border-color: rgba(20, 184, 166, 0.2);
        }

        .stat-card .s-icon {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .stat-card .s-num {
            font-family: 'Sora', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .stat-card .s-lbl {
            font-size: 0.6rem;
            color: var(--muted);
            font-weight: 500;
            margin-top: 2px;
        }

        .mockup-chart {
            background: white;
            border-radius: 14px;
            padding: 16px;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .chart-bar-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
            height: 60px;
            margin-top: 10px;
        }

        .chart-bar {
            flex: 1;
            border-radius: 8px 8px 0 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }

        .chart-bar:hover {
            filter: brightness(0.9);
            transform: scaleY(1.05);
            transform-origin: bottom;
        }

        .floating-badge {
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border-radius: 16px;
            padding: 12px 18px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(226, 232, 240, 0.6);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            z-index: 2;
            animation: floatBadge 3s ease-in-out infinite;
            transition: transform 0.3s;
        }

        .floating-badge:hover {
            transform: translateY(-4px) scale(1.05) !important;
        }

        @keyframes floatBadge {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .badge-1 {
            top: 12%;
            left: -16%;
            animation-delay: 0.5s;
        }

        .badge-2 {
            bottom: 15%;
            right: -10%;
            animation-delay: 1s;
        }

        .badge-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* ─── SECTION COMMONS ─── */
        section {
            padding: 100px 0;
            position: relative;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(20, 184, 166, 0.08);
            color: var(--primary-dark);
            border: 1px solid rgba(20, 184, 166, 0.15);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -1.5px;
            color: var(--dark);
            margin-bottom: 16px;
            line-height: 1.15;
        }

        .section-sub {
            font-size: 1.08rem;
            color: var(--muted);
            line-height: 1.7;
            max-width: 560px;
            margin: 0 auto 60px;
        }

        /* ─── FEATURES ─── */
        #features {
            background: linear-gradient(180deg, #f8fafc 0%, #f0fdfa 50%, #f8fafc 100%);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 20px;
            padding: 36px 30px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .feature-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.04) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.4s;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(20, 184, 166, 0.15);
            border-color: rgba(20, 184, 166, 0.25);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:hover::after {
            opacity: 1;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 22px;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-card h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .feature-card p {
            font-size: 0.9rem;
            color: var(--muted);
            line-height: 1.7;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .feature-tag {
            display: inline-block;
            background: rgba(20, 184, 166, 0.08);
            color: var(--primary);
            border: 1px solid rgba(20, 184, 166, 0.15);
            border-radius: 8px;
            padding: 4px 12px;
            font-size: 0.72rem;
            font-weight: 700;
            margin-top: 16px;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 1;
        }

        /* ─── DASHBOARD PREVIEW ─── */
        #dashboard {
            background: white;
        }

        .dash-sidebar {
            background: var(--gradient-dark);
            border-radius: 20px;
            padding: 24px 16px;
            height: 100%;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.2);
        }

        .dash-nav-item {
            padding: 11px 16px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.82rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .dash-nav-item.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.4);
        }

        .dash-nav-item:hover:not(.active) {
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.8);
        }

        .dash-logo {
            color: white;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.05rem;
            padding: 0 16px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 18px;
        }

        .dash-main {
            padding: 0 0 0 20px;
        }

        .dash-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .dash-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--dark);
        }

        .dash-date {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 18px;
        }

        .kpi-card {
            background: white;
            border-radius: 16px;
            padding: 18px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.3s;
        }

        .kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
            border-color: rgba(20, 184, 166, 0.2);
        }

        .kpi-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .kpi-info .num {
            font-family: 'Sora', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--dark);
        }

        .kpi-info .lbl {
            font-size: 0.72rem;
            color: var(--muted);
            font-weight: 500;
        }

        .recent-list {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            overflow: hidden;
        }

        .recent-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--border);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dark);
        }

        .recent-item {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: background 0.2s;
        }

        .recent-item:hover {
            background: #f8fafc;
        }

        .recent-item:last-child {
            border-bottom: none;
        }

        .r-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .r-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--dark);
        }

        .r-sub {
            font-size: 0.72rem;
            color: var(--muted);
        }

        .r-badge {
            margin-left: auto;
            font-size: 0.68rem;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ─── HOW IT WORKS ─── */
        #how {
            background: var(--gradient-mesh);
        }

        .step-box {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 32px 26px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            text-align: center;
            transition: all 0.4s;
            flex: 1;
        }

        .step-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(20, 184, 166, 0.15);
            border-color: rgba(20, 184, 166, 0.2);
        }

        .step-num {
            width: 44px;
            height: 44px;
            background: var(--gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 0.95rem;
            margin: 0 auto 18px;
            box-shadow: 0 6px 18px rgba(20, 184, 166, 0.35);
        }

        .step-arrow {
            color: var(--border);
            font-size: 1.5rem;
            padding: 0 10px;
            flex-shrink: 0;
        }

        .step-icon {
            font-size: 2rem;
            margin-bottom: 14px;
        }

        .step-box h6 {
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .step-box p {
            font-size: 0.84rem;
            color: var(--muted);
            margin: 0;
            line-height: 1.65;
        }

        /* ─── MOBILE APP ─── */
        #app {
            background: white;
        }

        .phone-frame {
            width: 230px;
            background: var(--gradient-dark);
            border-radius: 40px;
            padding: 14px;
            box-shadow: 0 40px 100px rgba(15, 23, 42, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
            position: relative;
            margin: 0 auto;
        }

        .phone-screen {
            background: #f8fafc;
            border-radius: 28px;
            overflow: hidden;
            min-height: 400px;
        }

        .phone-notch {
            width: 80px;
            height: 26px;
            background: var(--dark);
            border-radius: 0 0 18px 18px;
            margin: 0 auto;
        }

        .phone-content {
            padding: 14px;
        }

        .app-header {
            background: var(--gradient);
            padding: 16px 14px 22px;
            border-radius: 0 0 22px 22px;
            margin: -14px -14px 14px;
            color: white;
        }

        .app-header h6 {
            font-size: 0.75rem;
            font-weight: 700;
            margin: 0 0 2px;
            opacity: 0.8;
        }

        .app-header p {
            font-size: 1.05rem;
            font-weight: 800;
            font-family: 'Sora', sans-serif;
            margin: 0;
        }

        .app-card {
            background: white;
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 10px;
            border: 1px solid rgba(226, 232, 240, 0.6);
        }

        .app-card-title {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .app-list-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .app-list-item:last-child {
            border-bottom: none;
        }

        .app-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .app-text {
            font-size: 0.68rem;
            color: var(--dark);
            font-weight: 500;
        }

        .app-time {
            font-size: 0.62rem;
            color: var(--muted);
            margin-left: auto;
        }

        .app-feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .app-feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
            transition: all 0.3s;
        }

        .app-feature-list li:hover {
            padding-left: 6px;
        }

        .app-feature-list li:last-child {
            border-bottom: none;
        }

        .app-feat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: transform 0.3s;
        }

        .app-feature-list li:hover .app-feat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .app-feat-title {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--dark);
        }

        .app-feat-desc {
            font-size: 0.82rem;
            color: var(--muted);
            margin-top: 3px;
            line-height: 1.5;
        }

        /* ─── NOTIFICATIONS ─── */
        #notifications {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .notif-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.6);
            border-radius: 18px;
            padding: 22px 26px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 14px;
            position: relative;
            overflow: hidden;
        }

        .notif-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            border-radius: 0 4px 4px 0;
        }

        .notif-card.photo::before {
            background: var(--gradient);
        }

        .notif-card.progress::before {
            background: var(--gradient-warm);
        }

        .notif-card.alert::before {
            background: linear-gradient(180deg, #ef4444, #f87171);
        }

        .notif-card.approved::before {
            background: linear-gradient(180deg, #10b981, #34d399);
        }

        .notif-card:hover {
            transform: translateX(6px);
            box-shadow: 0 12px 36px rgba(20, 184, 166, 0.12);
            border-color: rgba(20, 184, 166, 0.2);
        }

        .notif-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .notif-content h6 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0 0 4px;
        }

        .notif-content p {
            font-size: 0.82rem;
            color: var(--muted);
            margin: 0;
            line-height: 1.5;
        }

        .notif-time {
            margin-left: auto;
            font-size: 0.75rem;
            color: var(--muted);
            white-space: nowrap;
            font-weight: 500;
        }

        .notif-badge {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            right: 20px;
            box-shadow: 0 0 8px currentColor;
        }

        /* ─── TESTIMONIALS ─── */
        #testimonials {
            background: var(--gradient-mesh);
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 32px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            height: 100%;
            transition: all 0.4s;
        }

        .testimonial-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(20, 184, 166, 0.12);
            border-color: rgba(20, 184, 166, 0.2);
        }

        .quote-icon {
            font-size: 2.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0.4;
            margin-bottom: 12px;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 0.95rem;
            color: var(--mid);
            line-height: 1.75;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .author-name {
            font-size: 0.92rem;
            font-weight: 700;
            color: var(--dark);
        }

        .author-role {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .stars {
            color: #f59e0b;
            font-size: 0.9rem;
            margin-bottom: 14px;
            letter-spacing: 3px;
        }

        /* ─── PRICING ─── */
        #pricing {
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        }

        .pricing-card {
            background: white;
            border: 2px solid rgba(226, 232, 240, 0.6);
            border-radius: var(--radius-lg);
            padding: 40px 34px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .pricing-card.featured {
            background: var(--gradient-dark);
            border-color: var(--primary);
            transform: scale(1.05);
            box-shadow: var(--shadow-xl), 0 0 60px rgba(20, 184, 166, 0.15);
        }

        .pricing-card.featured:hover {
            transform: scale(1.07) translateY(-4px);
        }

        .pricing-card.featured::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
        }

        .pricing-badge {
            position: absolute;
            top: 22px;
            right: 22px;
            background: var(--gradient);
            color: white;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .price-plan {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .price-val {
            font-family: 'Sora', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1;
            margin-bottom: 4px;
        }

        .price-period {
            font-size: 0.85rem;
            color: var(--muted);
        }

        .price-divider {
            border-color: var(--border);
            margin: 26px 0;
        }

        .price-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.88rem;
            color: var(--dark);
            margin-bottom: 14px;
        }

        .price-feature i {
            color: var(--success);
            font-size: 1rem;
        }

        .pricing-card.featured .price-plan,
        .pricing-card.featured .price-val,
        .pricing-card.featured .price-period,
        .pricing-card.featured .price-feature {
            color: white;
        }

        .pricing-card.featured .price-period,
        .pricing-card.featured .price-plan {
            color: rgba(255, 255, 255, 0.6);
        }

        .pricing-card.featured .price-feature i {
            color: #34d399;
        }

        .pricing-card.featured .price-divider {
            border-color: rgba(255, 255, 255, 0.12);
        }

        .btn-price {
            width: 100%;
            padding: 15px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Sora', sans-serif;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 28px;
            text-decoration: none;
            display: block;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn-price-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-price-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(20, 184, 166, 0.3);
        }

        .btn-price-filled {
            background: var(--gradient);
            color: white;
            box-shadow: 0 6px 24px rgba(20, 184, 166, 0.4);
        }

        .btn-price-filled:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(20, 184, 166, 0.5);
            color: white;
        }

        /* ─── CTA BAND ─── */
        .cta-band {
            background: var(--gradient-dark);
            padding: 90px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-band::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.15) 0%, transparent 60%);
            border-radius: 50%;
            animation: heroGlow1 8s ease-in-out infinite;
        }

        .cta-band::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.08) 0%, transparent 60%);
            border-radius: 50%;
        }

        .cta-band .container {
            position: relative;
            z-index: 2;
        }

        .cta-band h2 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 800;
            color: white;
            margin-bottom: 18px;
            letter-spacing: -1px;
        }

        .cta-band p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.08rem;
            margin-bottom: 40px;
        }

        .btn-cta-white {
            background: white;
            color: var(--primary-dark);
            border: none;
            border-radius: 14px;
            padding: 16px 36px;
            font-weight: 700;
            font-size: 1rem;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.15);
        }

        .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.2);
            color: var(--primary-dark);
        }

        .btn-cta-ghost {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.25);
            border-radius: 14px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cta-ghost:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        /* ─── CONTACT ─── */
        #contact {
            background: var(--gradient-mesh);
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 44px;
            border: 1px solid rgba(226, 232, 240, 0.6);
            box-shadow: var(--shadow-lg);
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 2px solid rgba(226, 232, 240, 0.8);
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 0.9rem;
            color: var(--dark);
            transition: all 0.3s;
            background: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.1);
            outline: none;
        }

        .btn-submit {
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px 36px;
            font-weight: 700;
            font-size: 1rem;
            font-family: 'Sora', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 6px 24px rgba(20, 184, 166, 0.35);
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(20, 184, 166, 0.45);
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
            padding: 16px;
            border-radius: 16px;
            transition: all 0.3s;
        }

        .contact-info-item:hover {
            background: rgba(20, 184, 166, 0.04);
        }

        .ci-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(20, 184, 166, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            flex-shrink: 0;
            transition: all 0.3s;
        }

        .contact-info-item:hover .ci-icon {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
        }

        .ci-label {
            font-size: 0.75rem;
            color: var(--muted);
            font-weight: 500;
        }

        .ci-val {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
        }

        /* ─── FOOTER ─── */
        footer {
            background: var(--gradient-dark);
            color: rgba(255, 255, 255, 0.75);
            padding: 70px 0 35px;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient);
        }

        .footer-logo {
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 16px;
        }

        .footer-logo span {
            color: var(--primary);
        }

        .footer-desc {
            font-size: 0.87rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.75;
            max-width: 300px;
        }

        .footer-heading {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
            margin-bottom: 18px;
        }

        .footer-link {
            display: block;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.88rem;
            text-decoration: none;
            margin-bottom: 12px;
            transition: all 0.3s;
        }

        .footer-link:hover {
            color: var(--primary);
            transform: translateX(3px);
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.08);
            margin: 44px 0 26px;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .footer-copy {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.35);
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.06);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 1rem;
        }

        .social-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(20, 184, 166, 0.4);
        }

        /* ─── MISC COLOR HELPERS ─── */
        .bg-teal {
            background: rgba(20, 184, 166, 0.1);
        }

        .bg-orange {
            background: rgba(249, 115, 22, 0.1);
        }

        .bg-green {
            background: rgba(16, 185, 129, 0.1);
        }

        .bg-purple {
            background: rgba(139, 92, 246, 0.1);
        }

        .bg-yellow {
            background: rgba(245, 158, 11, 0.1);
        }

        .bg-red {
            background: rgba(239, 68, 68, 0.1);
        }

        .text-teal {
            color: var(--primary);
        }

        .text-orange {
            color: var(--accent);
        }

        .text-green {
            color: var(--success);
        }

        .text-purple {
            color: #8b5cf6;
        }

        .text-yellow {
            color: var(--warning);
        }

        .text-red {
            color: var(--danger);
        }

        /* ─── SCROLL ANIMATIONS ─── */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* ─── BACK TO TOP ─── */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--gradient);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s;
            box-shadow: 0 8px 24px rgba(20, 184, 166, 0.35);
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(20, 184, 166, 0.45);
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 991px) {
            .dash-main {
                padding: 20px 0 0;
            }
        }

        @media (max-width: 768px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                border-radius: 18px;
                padding: 18px;
                margin-top: 12px;
                box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(226, 232, 240, 0.6);
                animation: slideDown 0.3s ease;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .navbar-nav {
                gap: 6px;
            }

            .nav-link {
                padding: 12px 16px !important;
                border-radius: 12px;
                font-size: 0.95rem;
            }

            .nav-link::after {
                display: none;
            }

            .btn-nav {
                margin-top: 10px;
                width: 100%;
                text-align: center;
                padding: 14px !important;
                border-radius: 14px;
            }

            section {
                padding: 60px 0;
            }

            .hero {
                text-align: center;
                padding: 60px 0 40px;
                min-height: auto;
            }

            .hero p.lead {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-cta-group {
                justify-content: center;
            }

            .hero-stats {
                justify-content: center;
            }

            .hero-stat::after {
                display: none;
            }

            .floating-badge {
                display: none;
            }

            .step-arrow {
                transform: rotate(90deg);
                margin: 10px 0;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: clamp(2rem, 10vw, 2.6rem);
                letter-spacing: -0.8px;
            }

            .hero p.lead {
                font-size: 0.96rem;
            }

            .btn-primary-hero,
            .btn-secondary-hero {
                width: 100%;
                justify-content: center;
            }

            .hero-stats {
                grid-template-columns: repeat(2, 1fr);
                display: grid;
                gap: 12px;
            }

            .hero-stat {
                align-items: center;
                text-align: center;
                padding: 14px;
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(226, 232, 240, 0.6);
                border-radius: 16px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .stat-grid,
            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .d-flex.flex-md-row {
                flex-direction: column !important;
            }

            .contact-card {
                padding: 24px 20px;
            }

            .cta-band {
                padding: 60px 0;
            }
        }

        @media (max-width: 420px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .section-title {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url(); ?>">
                <img src="<?= base_url('assets/images/small_logo.png'); ?>" alt="X-CHECK Logo">
                <span>CHECK</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-label="Toggle navigation">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#app">Mobile App</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn-nav" href="<?= site_url('auth/register'); ?>">
                            <i class="bi bi-rocket-takeoff-fill me-1"></i> Start Free Trial
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn-nav" href="<?= site_url('auth'); ?>">
                            <i class="bi bi-rocket-takeoff-fill me-1"></i> login 
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO ==================== -->
    <section class="hero" id="home">
        <div class="hero-grid"></div>
        <div class="particles" id="particles"></div>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Trusted by 100+ Construction Teams Across India
                    </div>
                    <h1>Smart <span class="highlight">Construction Site</span> Monitoring Solution</h1>
                    <p class="lead">X-CHECK captures real-time photo updates from your construction site, giving
                        architects, contractors, and clients complete transparency. Track progress. Manage changes.
                        Reduce disputes.</p>
                    <div class="hero-cta-group">
                        <a href="<?= site_url('auth/register'); ?>" class="btn-primary-hero">
                            <i class="bi bi-rocket-takeoff-fill"></i>
                            Start Free Trial
                        </a>
                        <a href="#demo" class="btn-secondary-hero">
                            <i class="  " style="color:var(--primary);"></i>



                            manual
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat"><span class="num counter" data-target="100">0</span><span
                                class="num">+</span><span class="label">Active Projects</span></div>
                        <div class="hero-stat"><span class="num">500K+</span><span class="label">Photos Tracked</span>
                        </div>
                        <div class="hero-stat"><span class="num">99.9%</span><span class="label">Uptime SLA</span></div>
                        <div class="hero-stat"><span class="num">4.9 ★</span><span class="label">App Rating</span></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                        <div class="floating-badge badge-1">
                            <div class="badge-icon bg-green text-green"><i class="bi bi-check-circle-fill"></i></div>
                            <div>
                                <div style="font-size:0.75rem;color:#334155;">Photo Uploaded</div>
                                <div style="font-size:0.68rem;color:#64748b;">Foundation • Just now</div>
                            </div>
                        </div>
                        <div class="floating-badge badge-2">
                            <div class="badge-icon bg-orange text-orange"><i class="bi bi-camera-fill"></i></div>
                            <div>
                                <div style="font-size:0.75rem;color:#334155;">12 Sites Active</div>
                                <div style="font-size:0.68rem;color:#64748b;">Real-time monitoring</div>
                            </div>
                        </div>
                        <div class="dashboard-mockup">
                            <div class="mockup-header">
                                <div class="mockup-dot" style="background:#ef4444;"></div>
                                <div class="mockup-dot" style="background:#f59e0b;"></div>
                                <div class="mockup-dot" style="background:#10b981;"></div>
                                <span class="mockup-title">X-CHECK Dashboard</span>
                            </div>
                            <div class="mockup-body">
                                <div class="stat-grid">
                                    <div class="stat-card">
                                        <div class="s-icon">📸</div>
                                        <div class="s-num" style="color:#14b8a6;">847</div>
                                        <div class="s-lbl">Total Photos</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="s-icon">🏗️</div>
                                        <div class="s-num" style="color:#8b5cf6;">12</div>
                                        <div class="s-lbl">Active Sites</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="s-icon">👥</div>
                                        <div class="s-num" style="color:#f59e0b;">34</div>
                                        <div class="s-lbl">Team Members</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="s-icon">📅</div>
                                        <div class="s-num" style="color:#14b8a6;">156</div>
                                        <div class="s-lbl">Days Tracked</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="s-icon">✓</div>
                                        <div class="s-num" style="color:#10b981;">92%</div>
                                        <div class="s-lbl">Progress</div>
                                    </div>
                                    <div class="stat-card">
                                        <div class="s-icon">🔔</div>
                                        <div class="s-num" style="color:#f97316;">8</div>
                                        <div class="s-lbl">Updates Today</div>
                                    </div>
                                </div>
                                <div class="mockup-chart">
                                    <div style="font-size:0.72rem;font-weight:700;color:#334155;">Photo Updates (Last 7
                                        Days)</div>
                                    <div class="chart-bar-row">
                                        <div class="chart-bar"
                                            style="height:40%;background:linear-gradient(180deg,#ccfbf1,#99f6e4);">
                                        </div>
                                        <div class="chart-bar"
                                            style="height:65%;background:linear-gradient(180deg,#99f6e4,#5eead4);">
                                        </div>
                                        <div class="chart-bar"
                                            style="height:50%;background:linear-gradient(180deg,#ccfbf1,#99f6e4);">
                                        </div>
                                        <div class="chart-bar"
                                            style="height:80%;background:linear-gradient(180deg,#5eead4,#2dd4bf);">
                                        </div>
                                        <div class="chart-bar"
                                            style="height:70%;background:linear-gradient(180deg,#2dd4bf,#14b8a6);">
                                        </div>
                                        <div class="chart-bar"
                                            style="height:95%;background:linear-gradient(180deg,#14b8a6,#0d9488);">
                                        </div>
                                        <div class="chart-bar" style="height:100%;background:var(--gradient);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">⚡ Features</span>
                <h2 class="section-title">Everything for Construction Monitoring</h2>
                <p class="section-sub">From real-time photo tracking to floor plan markers and team collaboration —
                    X-CHECK gives you complete site visibility.</p>
            </div>
            <div class="row g-4">

                <!-- 1 -->
                <div class="col-md-6 col-lg-4 reveal">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-camera-fill text-green"></i>
                        </div>
                        <h5>On-Site Photo Capture</h5>
                        <p>Capture project site photographs directly from the mobile app at scheduled intervals. Ensure
                            real-time visual documentation of work progress without manual follow-up.</p>
                        <span class="feature-tag">Core Feature</span>
                    </div>
                </div>

                <!-- 2 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.1s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-geo-alt-fill text-green"></i>
                        </div>
                        <h5>Automatic Time & Location Stamp</h5>
                        <p>Every uploaded image is automatically tagged with the exact date, time, and location,
                            providing authenticated proof of site activities and progress.</p>
                        <span class="feature-tag">Visual Clarity</span>
                    </div>
                </div>

                <!-- 3 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.2s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-images text-green"></i>
                        </div>
                        <h5>Image Processing & Management</h5>
                        <p>Images are automatically organized, optimized, and stored securely, making it easy to track
                            project milestones and retrieve records whenever required.</p>
                        <span class="feature-tag">Image Management</span>
                    </div>
                </div>

                <!-- 4 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.1s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-chat-dots-fill text-green"></i>
                        </div>
                        <h5>Image Comments & Collaboration</h5>
                        <p>Team members can add comments, observations, and instructions directly on project images,
                            improving communication and reducing misunderstandings.</p>
                        <span class="feature-tag">Collaboration</span>
                    </div>
                </div>

                <!-- 5 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.2s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-file-earmark-bar-graph-fill text-green"></i>
                        </div>
                        <h5>Automated Progress Reports</h5>
                        <p>Generate periodic project progress reports automatically from collected site images and
                            updates, saving valuable reporting time.</p>
                        <span class="feature-tag">Smart Reporting</span>
                    </div>
                </div>

                <!-- 6 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.3s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-graph-up-arrow text-green"></i>
                        </div>
                        <h5>Enhanced Progress Tracking</h5>
                        <p>Monitor construction and project development through visual timelines, helping stakeholders
                            understand progress at every stage.</p>
                        <span class="feature-tag">Progress Monitoring</span>
                    </div>
                </div>

                <!-- 7 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.3s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-clock-history text-green"></i>
                        </div>
                        <h5>Historical Record Management</h5>
                        <p>Maintain a complete visual history of the project for future reference, audits, quality
                            checks, and dispute resolution.</p>
                        <span class="feature-tag">History Tracking</span>
                    </div>
                </div>

                <!-- 8 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.3s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-diagram-3-fill text-green"></i>
                        </div>
                        <h5>Improved Project Workflow</h5>
                        <p>Streamline project management by centralizing site updates, photographs, comments, and
                            reports into a single platform.</p>
                        <span class="feature-tag">Workflow Automation</span>
                    </div>
                </div>

                <!-- 9 -->
                <div class="col-md-6 col-lg-4 reveal" style="transition-delay:0.3s">
                    <div class="feature-card">
                        <div class="feature-icon bg-green">
                            <i class="bi bi-people-fill text-green"></i>
                        </div>
                        <h5>Better Team Communication</h5>
                        <p>Enable seamless communication between project managers, contractors, consultants, and clients
                            through shared visual updates.</p>
                        <span class="feature-tag">Team Collaboration</span>
                    </div>
                </div>

            </div>
    </section>

    <!-- DASHBOARD PREVIEW -->
    <section id="dashboard">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">📊 Dashboard</span>
                <h2 class="section-title">Your Project Command Center</h2>
                <p class="section-sub">Monitor all your construction projects from one unified dashboard. Track photos,
                    manage teams, view progress charts, and share updates in real-time.</p>
            </div>
            <div class="row g-4 reveal">
                <div class="col-lg-3">
                    <div class="dash-sidebar h-100">
                        <div class="dash-logo">📌 X-CHECK</div>
                        <div class="dash-nav-item active"><i class="bi bi-speedometer2"></i> Dashboard</div>
                        <div class="dash-nav-item"><i class="bi bi-images"></i> Projects</div>
                        <div class="dash-nav-item"><i class="bi bi-image"></i> Photos</div>
                        <div class="dash-nav-item"><i class="bi bi-map"></i> Floor Plans</div>
                        <div class="dash-nav-item"><i class="bi bi-people"></i> Team</div>
                        <div class="dash-nav-item"><i class="bi bi-bar-chart"></i> Reports</div>
                        <div class="dash-nav-item"><i class="bi bi-bell"></i> Notifications <span
                                class="badge bg-danger ms-auto" style="font-size:0.65rem;">5</span></div>
                        <div style="padding-top:20px;border-top:1px solid rgba(255,255,255,0.06);margin-top:16px;">
                            <div class="dash-nav-item"><i class="bi bi-gear"></i> Settings</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="dash-main">
                        <div class="dash-header">
                            <div>
                                <div class="dash-title">Welcome back, Project Manager! 👋</div>
                                <div class="dash-date">Thursday, June 18, 2026</div>
                            </div>
                            <div class="d-flex gap-2 d-none d-md-flex">
                                <button class="btn btn-sm"
                                    style="background:rgba(20,184,166,0.1);color:#0d9488;border:none;border-radius:10px;font-size:0.78rem;font-weight:600;padding:8px 16px;"><i
                                        class="bi bi-plus"></i> New Project</button>
                                <button class="btn btn-sm"
                                    style="background:rgba(16,185,129,0.1);color:#059669;border:none;border-radius:10px;font-size:0.78rem;font-weight:600;padding:8px 16px;"><i
                                        class="bi bi-download"></i> Export</button>
                            </div>
                        </div>
                        <div class="kpi-grid mb-3">
                            <div class="kpi-card">
                                <div class="kpi-icon bg-teal"><i class="bi bi-images text-teal"></i></div>
                                <div class="kpi-info">
                                    <div class="num">847</div>
                                    <div class="lbl">Total Photos</div>
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-icon bg-purple"><i class="bi bi-building text-purple"></i></div>
                                <div class="kpi-info">
                                    <div class="num">12</div>
                                    <div class="lbl">Active Projects</div>
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-icon bg-yellow"><i class="bi bi-percent text-yellow"></i></div>
                                <div class="kpi-info">
                                    <div class="num">92%</div>
                                    <div class="lbl">Avg Progress</div>
                                </div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-icon bg-green"><i class="bi bi-people-fill text-green"></i></div>
                                <div class="kpi-info">
                                    <div class="num">34</div>
                                    <div class="lbl">Team Members</div>
                                </div>
                            </div>
                        </div>
                        <div class="recent-list">
                            <div class="recent-header">📷 Recent Photo Uploads</div>
                            <div class="recent-item">
                                <div class="r-avatar" style="background:linear-gradient(135deg,#14b8a6,#2dd4bf);">RK
                                </div>
                                <div>
                                    <div class="r-name">Rajesh Kumar</div>
                                    <div class="r-sub">Foundation excavation photos • Site A</div>
                                </div><span class="r-badge bg-success text-white">Today</span>
                            </div>
                            <div class="recent-item">
                                <div class="r-avatar" style="background:linear-gradient(135deg,#8b5cf6,#a78bfa);">PS
                                </div>
                                <div>
                                    <div class="r-name">Priya Sharma</div>
                                    <div class="r-sub">Wall construction photos • Site B</div>
                                </div><span class="r-badge bg-primary text-white">Yesterday</span>
                            </div>
                            <div class="recent-item">
                                <div class="r-avatar" style="background:linear-gradient(135deg,#10b981,#34d399);">AM
                                </div>
                                <div>
                                    <div class="r-name">Amit Mehta</div>
                                    <div class="r-sub">Roof work progress • Site C</div>
                                </div><span class="r-badge bg-info text-white">2 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">🚀 How It Works</span>
                <h2 class="section-title">Get Started in 4 Simple Steps</h2>
                <p class="section-sub">X-CHECK is built for construction professionals. No complex training — just sign
                    up, create a project, and start capturing progress.</p>
            </div>
            <div class="d-flex flex-column flex-md-row gap-2 align-items-stretch reveal">
                <div class="step-box">
                    <div class="step-num">1</div>
                    <div class="step-icon">🏢</div>
                    <h6>Create Your Project</h6>
                    <p>Register your construction project, add project details, location, and team members in under 5
                        minutes.</p>
                </div>
                <div class="step-arrow d-none d-md-flex align-items-center"><i class="bi bi-arrow-right-circle-fill"
                        style="color:#cbd5e1;"></i></div>
                <div class="step-box">
                    <div class="step-num">2</div>
                    <div class="step-icon">📸</div>
                    <h6>Upload Photos Daily</h6>
                    <p>Capture site photos daily. Our mobile app automatically tags photos with date, time, and GPS
                        location.</p>
                </div>
                <div class="step-arrow d-none d-md-flex align-items-center"><i class="bi bi-arrow-right-circle-fill"
                        style="color:#cbd5e1;"></i></div>
                <div class="step-box">
                    <div class="step-num">3</div>
                    <div class="step-icon">🗺️</div>
                    <h6>Map to Floor Plans</h6>
                    <p>Upload floor plans and drag photos onto map locations. Organize your visual timeline by area and
                        phase.</p>
                </div>
                <div class="step-arrow d-none d-md-flex align-items-center"><i class="bi bi-arrow-right-circle-fill"
                        style="color:#cbd5e1;"></i></div>
                <div class="step-box">
                    <div class="step-num">4</div>
                    <div class="step-icon">👁️</div>
                    <h6>Share & Monitor</h6>
                    <p>Share real-time updates with all stakeholders. Track progress, reduce delays, build transparency
                        and trust.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- MOBILE APP -->
    <section id="app">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal-left">
                    <span class="section-label">📱 Mobile App</span>
                    <h2 class="section-title">Site Monitoring On The Go</h2>
                    <p style="color:var(--muted);line-height:1.75;margin-bottom:34px;">Capture, organize, and share site
                        photos from your mobile device. Full-featured X-CHECK app for iOS and Android with offline photo
                        storage and GPS tagging.</p>
                    <ul class="app-feature-list">
                        <li>
                            <div class="app-feat-icon bg-teal"><i class="bi bi-camera-fill text-teal"></i></div>
                            <div>
                                <div class="app-feat-title">One-Tap Photo Upload</div>
                                <div class="app-feat-desc">Instantly capture and upload photos directly from
                                    construction site with automatic timestamp and GPS location.</div>
                            </div>
                        </li>
                        <li>
                            <div class="app-feat-icon bg-green"><i class="bi bi-map-fill text-green"></i></div>
                            <div>
                                <div class="app-feat-title">Floor Plan Markers</div>
                                <div class="app-feat-desc">View floor plans and drag photos onto locations. Organize
                                    photos by area, building, or phase in real-time.</div>
                            </div>
                        </li>
                        <li>
                            <div class="app-feat-icon bg-orange"><i class="bi bi-share-fill text-orange"></i></div>
                            <div>
                                <div class="app-feat-title">Instant Sharing</div>
                                <div class="app-feat-desc">Share daily photo summaries with architects, contractors, and
                                    clients via email or link — zero friction.</div>
                            </div>
                        </li>
                        <li>
                            <div class="app-feat-icon bg-purple"><i class="bi bi-graph-up-arrow text-purple"></i></div>
                            <div>
                                <div class="app-feat-title">Progress Reports</div>
                                <div class="app-feat-desc">View visual progress timelines, compare photos across dates,
                                    and generate completion reports automatically.</div>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="btn btn-dark d-flex align-items-center gap-2"
                            style="border-radius:14px;padding:12px 22px;box-shadow:0 4px 15px rgba(0,0,0,0.15);"><i
                                class="bi bi-google-play fs-5"></i>
                            <div style="text-align:left;">
                                <div style="font-size:0.6rem;opacity:0.7;">Get it on</div>
                                <div style="font-size:0.85rem;font-weight:700;">Google Play</div>
                            </div>
                        </a>
                        <a href="#" class="btn btn-dark d-flex align-items-center gap-2"
                            style="border-radius:14px;padding:12px 22px;box-shadow:0 4px 15px rgba(0,0,0,0.15);"><i
                                class="bi bi-apple fs-5"></i>
                            <div style="text-align:left;">
                                <div style="font-size:0.6rem;opacity:0.7;">Download on</div>
                                <div style="font-size:0.85rem;font-weight:700;">App Store</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 reveal-right">
                    <div class="row g-3 justify-content-center">
                        <div class="col-auto">
                            <div class="phone-frame">
                                <div class="phone-screen">
                                    <div class="phone-notch"></div>
                                    <div class="phone-content">
                                        <div class="app-header">
                                            <h6>Today's Uploads</h6>
                                            <p>12 photos</p>
                                        </div>
                                        <div class="app-card">
                                            <div class="app-card-title">ACTIVE PROJECTS</div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#14b8a6;"></div>
                                                <div class="app-text">Lotus Gardens – Phase 2</div>
                                                <div class="app-time">6 photos</div>
                                            </div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#f59e0b;"></div>
                                                <div class="app-text">Metro Plaza Tower – Frame</div>
                                                <div class="app-time">4 photos</div>
                                            </div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#10b981;"></div>
                                                <div class="app-text">Riverside Mall – Roof</div>
                                                <div class="app-time">2 photos</div>
                                            </div>
                                        </div>
                                        <div class="app-card">
                                            <div class="app-card-title">RECENT UPLOADS</div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#ef4444;"></div>
                                                <div class="app-text">Foundation work</div>
                                                <div class="app-time">2h ago</div>
                                            </div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#14b8a6;"></div>
                                                <div class="app-text">Plumbing layout</div>
                                                <div class="app-time">5h ago</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto d-none d-sm-block" style="margin-top:50px;">
                            <div class="phone-frame" style="width:200px;">
                                <div class="phone-screen" style="min-height:360px;">
                                    <div class="phone-notch"></div>
                                    <div class="phone-content">
                                        <div class="app-header"
                                            style="background:linear-gradient(135deg,#8b5cf6,#a78bfa);">
                                            <h6>Floor Plans</h6>
                                            <p>3 sites</p>
                                        </div>
                                        <div class="app-card">
                                            <div class="app-card-title">LATEST MARKERS</div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#14b8a6;"></div>
                                                <div class="app-text">Area A – Ground Floor</div>
                                                <div class="app-time">12</div>
                                            </div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#f59e0b;"></div>
                                                <div class="app-text">Area B – First Floor</div>
                                                <div class="app-time">8</div>
                                            </div>
                                            <div class="app-list-item">
                                                <div class="app-dot" style="background:#10b981;"></div>
                                                <div class="app-text">Roof – Complete</div>
                                                <div class="app-time">5</div>
                                            </div>
                                        </div>
                                        <div style="text-align:center;padding:14px 0;">
                                            <div
                                                style="width:80px;height:80px;background:rgba(139,92,246,0.06);border:2px solid rgba(139,92,246,0.15);border-radius:14px;margin:0 auto;display:flex;align-items:center;justify-content:center;font-size:2.2rem;">
                                                <i class="bi bi-map" style="color:#8b5cf6;"></i>
                                            </div>
                                            <div style="font-size:0.7rem;color:#64748b;margin-top:8px;font-weight:600;">
                                                Drag Photos to Map</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NOTIFICATIONS -->
    <section id="notifications">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 reveal-left">
                    <span class="section-label">🔔 Smart Alerts</span>
                    <h2 class="section-title">Stay Updated on Every Change</h2>
                    <p style="color:var(--muted);line-height:1.75;margin-bottom:30px;">Get instant notifications for new
                        photo uploads, team updates, and project milestones. Share real-time progress with stakeholders
                        automatically.</p>
                    <div class="d-flex align-items-center gap-3 mb-4 p-4"
                        style="background:rgba(20,184,166,0.06);border-radius:18px;border:1px solid rgba(20,184,166,0.12);">
                        <div style="font-size:2rem;">📊</div>
                        <div>
                            <div style="font-size:0.9rem;font-weight:700;color:var(--dark);">Construction teams using
                                X-CHECK report</div>
                            <div
                                style="font-size:1.4rem;font-weight:800;background:var(--gradient);-webkit-background-clip:text;-webkit-text-fill-color:transparent;font-family:'Sora',sans-serif;">
                                60% faster project tracking</div>
                        </div>
                    </div>
                    <ul style="list-style:none;padding:0;margin:0;">
                        <li
                            style="display:flex;align-items:center;gap:12px;margin-bottom:12px;font-size:0.9rem;color:var(--mid);">
                            <i class="bi bi-check-circle-fill text-green"></i> Photo upload alerts with GPS location
                        </li>
                        <li
                            style="display:flex;align-items:center;gap:12px;margin-bottom:12px;font-size:0.9rem;color:var(--mid);">
                            <i class="bi bi-check-circle-fill text-green"></i> Daily/Weekly progress summaries
                        </li>
                        <li style="display:flex;align-items:center;gap:12px;font-size:0.9rem;color:var(--mid);"><i
                                class="bi bi-check-circle-fill text-green"></i> Team activity tracking and timestamps
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 reveal-right">
                    <div class="notif-card photo">
                        <div class="notif-badge" style="background:var(--primary);"></div>
                        <div class="notif-icon bg-teal"><i class="bi bi-camera-fill text-teal"></i></div>
                        <div class="notif-content">
                            <h6>New Photos Uploaded</h6>
                            <p>Foundation excavation • Lotus Gardens • 6 photos | Rajesh Kumar</p>
                        </div>
                        <div class="notif-time">Today, 2 PM</div>
                    </div>
                    <div class="notif-card progress">
                        <div class="notif-badge" style="background:var(--warning);"></div>
                        <div class="notif-icon bg-yellow"><i class="bi bi-percent text-yellow"></i></div>
                        <div class="notif-content">
                            <h6>Project 50% Complete</h6>
                            <p>Metro Plaza Tower has reached 50% completion milestone | Phase 1 Done</p>
                        </div>
                        <div class="notif-time">Yesterday</div>
                    </div>
                    <div class="notif-card alert">
                        <div class="notif-badge" style="background:var(--danger);"></div>
                        <div class="notif-icon bg-red"><i class="bi bi-exclamation-triangle-fill text-red"></i></div>
                        <div class="notif-content">
                            <h6>Photo Upload Missing</h6>
                            <p>No photos from Riverside Mall for 3 days • Check in required</p>
                        </div>
                        <div class="notif-time">2 days ago</div>
                    </div>
                    <div class="notif-card approved">
                        <div class="notif-badge" style="background:var(--success);"></div>
                        <div class="notif-icon bg-green"><i class="bi bi-check-circle-fill text-green"></i></div>
                        <div class="notif-content">
                            <h6>Phase Approved</h6>
                            <p>Architect approved Phase 1 completion • Ready for Phase 2</p>
                        </div>
                        <div class="notif-time">3 days ago</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section id="testimonials">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">⭐ Testimonials</span>
                <h2 class="section-title">Loved by Construction Professionals</h2>
                <p class="section-sub">Real stories from architects, contractors, and project managers who transformed
                    their site monitoring with X-CHECK.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 reveal">
                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">X-CHECK eliminated the confusion around site progress. Instead of
                            calling the contractor daily, I now see real-time photos. My clients are amazed by the
                            transparency!</p>
                        <div class="testimonial-author">
                            <div class="author-avatar" style="background:linear-gradient(135deg,#14b8a6,#2dd4bf);">SK
                            </div>
                            <div>
                                <div class="author-name">Suraj Kumar</div>
                                <div class="author-role">Architect, Delhi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="transition-delay:0.1s">
                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">Managing 5 construction sites was a nightmare before X-CHECK. Now I
                            can check progress from home, share updates with stakeholders, and handle disputes with
                            photo evidence.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar" style="background:linear-gradient(135deg,#8b5cf6,#a78bfa);">RP
                            </div>
                            <div>
                                <div class="author-name">Rajesh Patel</div>
                                <div class="author-role">Construction Contractor, Mumbai</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="transition-delay:0.2s">
                    <div class="testimonial-card">
                        <div class="stars">★★★★★</div>
                        <div class="quote-icon">"</div>
                        <p class="testimonial-text">The floor plan feature is brilliant. Mapping photos directly onto
                            floor plans gives us instant clarity on which areas need attention. Saves hours of manual
                            organization.</p>
                        <div class="testimonial-author">
                            <div class="author-avatar" style="background:linear-gradient(135deg,#10b981,#34d399);">AJ
                            </div>
                            <div>
                                <div class="author-name">Anjali Joshi</div>
                                <div class="author-role">Project Manager, Bangalore</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section id="pricing">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">💰 Pricing</span>
                <h2 class="section-title">Simple, Transparent Pricing</h2>
                <p class="section-sub">Start free, upgrade when you're ready. No hidden charges. Cancel anytime.</p>
            </div>
            <div class="row g-4 justify-content-center align-items-stretch">
                <div class="col-md-4 reveal">
                    <div class="pricing-card">
                        <div class="price-plan">Starter</div>
                        <div class="price-val">Free</div>
                        <div class="price-period">Forever, up to 1 project</div>
                        <hr class="price-divider">
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> 1 Active Project</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Up to 100 Photos</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Basic Dashboard</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Mobile App Access</div>
                        <div class="price-feature" style="opacity:0.3;"><i class="bi bi-x-circle-fill"
                                style="color:var(--muted)!important;"></i> Floor Plan Markers</div>
                        <div class="price-feature" style="opacity:0.3;"><i class="bi bi-x-circle-fill"
                                style="color:var(--muted)!important;"></i> Team Collaboration</div>
                        <div class="price-feature" style="opacity:0.3;"><i class="bi bi-x-circle-fill"
                                style="color:var(--muted)!important;"></i> Advanced Reports</div>
                        <a href="<?= site_url('auth/register'); ?>" class="btn-price btn-price-outline">Get
                            Started
                            Free</a>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="transition-delay:0.1s">
                    <div class="pricing-card featured">
                        <div class="pricing-badge">Most Popular</div>
                        <div class="price-plan">Professional</div>
                        <div class="price-val">₹499 <span style="font-size:1rem;font-weight:400;">/mo</span></div>
                        <div class="price-period">Up to 5 projects</div>
                        <hr class="price-divider">
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Up to 5 Projects</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Unlimited Photos</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Floor Plan Markers</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Full Dashboard & Analytics
                        </div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Team Collaboration</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Daily Report Summaries</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Mobile App (iOS & Android)
                        </div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Priority Support</div>
                        <a href="<?= site_url('auth/register'); ?>" class="btn-price btn-price-filled">Start
                            14-Day Free
                            Trial</a>
                    </div>
                </div>
                <div class="col-md-4 reveal" style="transition-delay:0.2s">
                    <div class="pricing-card">
                        <div class="price-plan">Enterprise</div>
                        <div class="price-val">₹1,999</div>
                        <div class="price-period">For large construction firms</div>
                        <hr class="price-divider">
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Everything in Pro</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Unlimited Projects</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Multi-Team Support</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Custom Branding</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Advanced Integrations</div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> Dedicated Account Manager
                        </div>
                        <div class="price-feature"><i class="bi bi-check-circle-fill"></i> API Access</div>
                        <a href="<?= site_url('auth/register'); ?>" class="btn-price btn-price-outline">Contact
                            Sales</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 reveal">
                <p style="font-size:0.85rem;color:var(--muted);"><i class="bi bi-shield-check text-green"></i> 14-day
                    free trial &nbsp;•&nbsp;<i class="bi bi-arrow-counterclockwise" style="color:var(--primary);"></i>
                    No credit card required &nbsp;•&nbsp;<i class="bi bi-x-circle text-orange"></i> Cancel anytime</p>
            </div>
        </div>
    </section>

    <!-- CTA BAND -->
    <div class="cta-band">
        <div class="container text-center">
            <h2 class="reveal">Ready to Monitor Your Construction Site Like Never Before?</h2>
            <p class="reveal">Join 100+ construction teams already using X-CHECK. Start your free trial today — no
                credit card needed.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap reveal">
                <a href="<?= site_url('auth/register'); ?>" class="btn-cta-white"><i
                        class="bi bi-rocket-takeoff-fill"></i> Start Free Trial</a>
                <a href="tel:+919904300073" class="btn-cta-ghost"><i class="bi bi-telephone-fill"></i> Call Us: +91
                    99043 00073</a>
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <section id="contact">
        <div class="container">
            <div class="text-center reveal">
                <span class="section-label">📬 Get In Touch</span>
                <h2 class="section-title">Contact Us</h2>
                <p class="section-sub">Have questions? Want a demo? Our team is ready to help you get started.</p>
            </div>
            <div class="row g-5 align-items-start">
                <div class="col-lg-7 reveal-left">
                    <div class="contact-card">
                        <h5 style="font-weight:700;margin-bottom:28px;font-size:1.1rem;">✉️ Send Us a Message</h5>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Your Name</label><input type="text"
                                    class="form-control" placeholder="Rajesh Kumar"></div>
                            <div class="col-md-6"><label class="form-label">Phone Number</label><input type="tel"
                                    class="form-control" placeholder="+91 9904300073"></div>
                            <div class="col-12"><label class="form-label">Email Address</label><input type="email"
                                    class="form-control" placeholder="rajesh@construction.com"></div>
                            <div class="col-md-6"><label class="form-label">Business Type</label><select
                                    class="form-select">
                                    <option>Architect</option>
                                    <option>Contractor</option>
                                    <option>Project Manager</option>
                                    <option>Construction Firm</option>
                                    <option>Other</option>
                                </select></div>
                            <div class="col-md-6"><label class="form-label">Number of Projects</label><select
                                    class="form-select">
                                    <option>1-2 Projects</option>
                                    <option>3-5 Projects</option>
                                    <option>5-10 Projects</option>
                                    <option>10+ Projects</option>
                                </select></div>
                            <div class="col-12"><label class="form-label">Message (Optional)</label><textarea
                                    class="form-control" rows="4"
                                    placeholder="Tell us about your construction project or ask any question..."></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn-submit"
                                    onclick="alert('Thank you! We will contact you within 24 hours.')"><i
                                        class="bi bi-send-fill me-2"></i>Send Message & Get Free Demo</button>
                                <p
                                    style="font-size:0.78rem;color:var(--muted);text-align:center;margin-top:14px;margin-bottom:0;">
                                    We respond within 24 hours · No spam, ever</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 reveal-right">
                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="ci-label">Call / WhatsApp</div>
                            <div class="ci-val">+91 99043 00073</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="ci-label">Email Us</div>
                            <div class="ci-val">info@sthapatigroup.com</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="ci-label">Office</div>
                            <div class="ci-val">302, Silver Radiance, Ahmedabad, bodakdev,Ahemedabad</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <div class="ci-label">Support Hours</div>
                            <div class="ci-val">Mon–Sat, 10 AM – 6 PM</div>
                        </div>
                    </div>
                    <div
                        style="background:rgba(20,184,166,0.06);border-radius:20px;padding:28px;border:1px solid rgba(20,184,166,0.12);margin-top:8px;">
                        <div style="font-size:1.5rem;margin-bottom:14px;">💬</div>
                        <h6 style="font-weight:700;color:var(--dark);margin-bottom:10px;">Prefer WhatsApp?</h6>
                        <p style="font-size:0.85rem;color:var(--muted);margin-bottom:18px;line-height:1.6;">Chat with us
                            instantly on WhatsApp. Quick demos, technical support, and onboarding help.</p>
                        <a href="https://wa.me/919904300073" target="_blank" class="btn-primary-hero"
                            style="font-size:0.88rem;padding:12px 24px;"><i class="bi bi-whatsapp"></i> Chat on
                            WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">X<span>CHECK</span></div>
                    <p class="footer-desc">Smart construction site monitoring with real-time photo tracking, floor plan
                        markers, and team collaboration. Complete transparency for architects, contractors, and project
                        managers.</p>
                    <div class="d-flex gap-2 mt-3"><a href="#" class="social-link"><i class="bi bi-facebook"></i></a><a
                            href="#" class="social-link"><i class="bi bi-instagram"></i></a><a href="#"
                            class="social-link"><i class="bi bi-youtube"></i></a><a href="#" class="social-link"><i
                                class="bi bi-whatsapp"></i></a><a href="#" class="social-link"><i
                                class="bi bi-linkedin"></i></a></div>
                </div>
                <div class="col-sm-4 col-lg-2">
                    <div class="footer-heading">Product</div><a class="footer-link" href="#features">Features</a><a
                        class="footer-link" href="#dashboard">Dashboard</a><a class="footer-link" href="#app">Mobile
                        App</a><a class="footer-link" href="#how">How It Works</a><a class="footer-link"
                        href="#pricing">Pricing</a>
                </div>
                <div class="col-sm-4 col-lg-2">
                    <div class="footer-heading">Company</div><a class="footer-link" href="#">About Us</a><a
                        class="footer-link" href="#">Blog</a><a class="footer-link" href="#">Careers</a><a
                        class="footer-link" href="#">Press</a><a class="footer-link" href="#contact">Contact</a>
                </div>
                <div class="col-lg-2">
                    <div class="footer-heading">Download App</div><a href="#"
                        class="footer-link d-flex align-items-center gap-2 mb-3"><i class="bi bi-google-play"
                            style="font-size:1.1rem;color:var(--primary);"></i> Google Play</a><a href="#"
                        class="footer-link d-flex align-items-center gap-2"><i class="bi bi-apple"
                            style="font-size:1.1rem;color:white;"></i> App Store</a>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <div class="footer-copy">© 2026 X-CHECK. All rights reserved. Made with ❤️ in India.</div>
                <div class="d-flex gap-3"><a class="footer-link mb-0" href="<?= site_url('privacy-policy'); ?>"
                        style="font-size:0.78rem;">Privacy Policy</a><a class="footer-link mb-0"
                        href="<?= site_url('terms-and-conditions'); ?>" style="font-size:0.78rem;">Terms &
                        Conditions</a><a class="footer-link mb-0" href="<?= site_url('refund-policy'); ?>"
                        style="font-size:0.78rem;">Refund Policy</a></div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ─── Scroll Reveal ───
        const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        revealEls.forEach(el => observer.observe(el));

        // ─── Navbar Scroll Effect ───
        const navbar = document.querySelector('.navbar');
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            if (scrollY > 80) { navbar.classList.add('scrolled'); } else { navbar.classList.remove('scrolled'); }
            if (scrollY > 600) { backToTop.classList.add('visible'); } else { backToTop.classList.remove('visible'); }
        });

        // ─── Active Nav ───
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(s => { if (window.scrollY >= s.offsetTop - 120) current = s.id; });
            navLinks.forEach(l => { l.classList.remove('active'); if (l.getAttribute('href') === '#' + current) l.classList.add('active'); });
        });

        // ─── Mobile Menu Close ───
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const nav = document.getElementById('nav');
                if (nav.classList.contains('show')) document.querySelector('.navbar-toggler').click();
            });
        });

        // ─── Floating Particles ───
        const particlesContainer = document.getElementById('particles');
        if (particlesContainer) {
            const colors = ['rgba(20,184,166,0.15)', 'rgba(45,212,191,0.12)', 'rgba(103,232,249,0.1)', 'rgba(249,115,22,0.08)'];
            for (let i = 0; i < 20; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                p.style.left = Math.random() * 100 + '%';
                p.style.width = p.style.height = (Math.random() * 8 + 3) + 'px';
                p.style.background = colors[Math.floor(Math.random() * colors.length)];
                p.style.animationDuration = (Math.random() * 15 + 10) + 's';
                p.style.animationDelay = (Math.random() * 10) + 's';
                particlesContainer.appendChild(p);
            }
        }

        // ─── Counter Animation ───
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-target'));
                    if (target && !el.classList.contains('counted')) {
                        el.classList.add('counted');
                        let current = 0;
                        const increment = target / 60;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) { el.textContent = target; clearInterval(timer); }
                            else { el.textContent = Math.floor(current); }
                        }, 25);
                    }
                }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

        // ─── Smooth Parallax for Hero ───
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroVisual = document.querySelector('.hero-visual');
            if (heroVisual && scrolled < window.innerHeight) {
                heroVisual.style.transform = `translateY(${scrolled * 0.08}px)`;
            }
        });
    </script>
</body>

</html>