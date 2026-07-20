<?php
/**
 * ============================================================================
 *  SUPER ADMIN DASHBOARD — PROFESSIONAL EDITION (FULL)
 * ----------------------------------------------------------------------------
 *  Drop-in replacement view. Required data contract (same as your original
 *  template — no controller changes needed for the core metrics):
 *
 *      $total_companies
 *      $active_companies
 *      $inactive_companies
 *      $total_plans
 *      $active_plans
 *      $total_payments
 *
 *  OPTIONAL data (falls back to tasteful demo content if not supplied, so
 *  the page never breaks — wire these up in your controller whenever
 *  you're ready for real data):
 *
 *      $recent_activities  — array of ['type','title','desc','time']
 *      $avg_revenue        — string, e.g. "$12.4K"
 *      $growth_rate        — string, e.g. "+24%"
 *      $active_users       — int
 *      $satisfaction_rate  — string, e.g. "98.2%"
 * ============================================================================
 */

// ---- Safe casting of the core metrics --------------------------------------
$totalCompanies = (int) ($total_companies ?? 0);
$activeCompanies = (int) ($active_companies ?? 0);
$inactiveCompanies = (int) ($inactive_companies ?? 0);
$totalPlans = (int) ($total_plans ?? 0);
$activePlans = (int) ($active_plans ?? 0);
$totalPayments = (int) ($total_payments ?? 0);

// ---- Derived ratios ----------------------------------------------------------
$companyActivePct = $totalCompanies > 0 ? round(($activeCompanies / $totalCompanies) * 100) : 0;
$companyInactivePct = $totalCompanies > 0 ? (100 - $companyActivePct) : 0;
$planActivePct = $totalPlans > 0 ? round(($activePlans / $totalPlans) * 100) : 0;
$inactivePlans = max(0, $totalPlans - $activePlans);
$avgPaymentsPerCo = $activeCompanies > 0 ? round($totalPayments / $activeCompanies, 1) : 0;

function xc_health_tone($pct)
{
    if ($pct >= 75)
        return ['label' => 'Healthy', 'tone' => 'success'];
    if ($pct >= 45)
        return ['label' => 'Moderate', 'tone' => 'warning'];
    return ['label' => 'Needs Attention', 'tone' => 'danger'];
}
$companyHealth = xc_health_tone($companyActivePct);
$planHealth = xc_health_tone($planActivePct);

// ---- Optional / fallback content -------------------------------------------
$avgRevenue = $avg_revenue ?? null;
$growthRate = $growth_rate ?? null;
$activeUsers = $active_users ?? null;
$satisfactionRate = $satisfaction_rate ?? null;

$activities = $recent_activities ?? [
    ['type' => 'company', 'title' => 'New Company Registered', 'desc' => 'TechCorp Solutions signed up for the Premium plan', 'time' => '2 hours ago'],
    ['type' => 'payment', 'title' => 'Payment Received', 'desc' => 'Payment from Innovate Inc. processed successfully', 'time' => '5 hours ago'],
    ['type' => 'plan', 'title' => 'Plan Updated', 'desc' => 'Enterprise plan features were modified', 'time' => '1 day ago'],
    ['type' => 'activate', 'title' => 'Company Activated', 'desc' => 'Digital Dynamics account has been activated', 'time' => '2 days ago'],
];

$activityStyles = [
    'company' => ['tone' => 'success', 'icon' => 'building'],
    'payment' => ['tone' => 'amber', 'icon' => 'wallet'],
    'plan' => ['tone' => 'indigo', 'icon' => 'package'],
    'activate' => ['tone' => 'info', 'icon' => 'check'],
    'warning' => ['tone' => 'danger', 'icon' => 'alert'],
];

function xc_activity_icon($name)
{
    switch ($name) {
        case 'building':
            return '<svg viewBox="0 0 24 24"><path d="M3 21V8l7-5 7 5v13"/><path d="M13 21v-6h4v6"/><path d="M7 9h2M7 13h2M7 17h2"/></svg>';
        case 'wallet':
            return '<svg viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="14" rx="2"/><path d="M2 10h20"/><path d="M6 15h4"/></svg>';
        case 'package':
            return '<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 9h18"/><circle cx="8" cy="14" r="1.5"/></svg>';
        case 'check':
            return '<svg viewBox="0 0 24 24"><path d="M20 7l-9 10-5-5"/></svg>';
        case 'alert':
            return '<svg viewBox="0 0 24 24"><path d="M12 9v4m0 4h.01M10.3 3.9L2.6 17a2 2 0 0 0 1.7 3h15.4a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/></svg>';
        default:
            return '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/></svg>';
    }
}
?>
<style>
    /* ============================================================
       DESIGN TOKENS
       ============================================================ */
    .sa2-scope {
        --sa2-teal-50: #f0fdfa;
        --sa2-teal-100: #ccfbf1;
        --sa2-teal-200: #99f6e4;
        --sa2-teal-300: #5eead4;
        --sa2-teal-400: #2dd4bf;
        --sa2-teal-500: #14b8a6;
        --sa2-teal-600: #0d9488;
        --sa2-teal-700: #0f766e;
        --sa2-teal-800: #115e59;
        --sa2-teal-900: #134e4a;

        --sa2-ink-900: #0f172a;
        --sa2-ink-800: #1e293b;
        --sa2-ink-700: #334155;
        --sa2-ink-600: #475569;
        --sa2-ink-500: #64748b;
        --sa2-ink-400: #94a3b8;
        --sa2-ink-300: #cbd5e1;
        --sa2-ink-200: #e6eaef;
        --sa2-ink-100: #f1f5f9;
        --sa2-ink-50: #f8fafc;

        --sa2-success-bg: #ecfdf5;
        --sa2-success-fg: #15803d;
        --sa2-success-bd: #a7e8c4;
        --sa2-warning-bg: #fffbeb;
        --sa2-warning-fg: #b45309;
        --sa2-warning-bd: #fde68a;
        --sa2-danger-bg: #fef2f2;
        --sa2-danger-fg: #b02a37;
        --sa2-danger-bd: #f8c9ce;
        --sa2-info-bg: #eff6ff;
        --sa2-info-fg: #2563eb;
        --sa2-info-bd: #bfdbfe;
        --sa2-indigo-bg: #eef2ff;
        --sa2-indigo-fg: #4f46e5;
        --sa2-indigo-bd: #c7d2fe;
        --sa2-amber-bg: #fffbeb;
        --sa2-amber-fg: #b45309;
        --sa2-amber-bd: #fde68a;

        --sa2-radius-xs: 8px;
        --sa2-radius-sm: 12px;
        --sa2-radius-md: 16px;
        --sa2-radius-lg: 20px;
        --sa2-radius-xl: 26px;

        --sa2-shadow-sm: 0 1px 2px rgba(16, 24, 40, 0.05), 0 1px 3px rgba(16, 24, 40, 0.06);
        --sa2-shadow-md: 0 4px 16px rgba(16, 24, 40, 0.08), 0 2px 6px rgba(16, 24, 40, 0.05);
        --sa2-shadow-lg: 0 16px 40px rgba(16, 24, 40, 0.12), 0 4px 12px rgba(16, 24, 40, 0.06);
        --sa2-shadow-teal: 0 12px 28px rgba(13, 148, 136, 0.22);

        --sa2-font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;

        font-family: var(--sa2-font);
        color: var(--sa2-ink-800);
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }

    .sa2-scope * {
        box-sizing: border-box;
    }

    /* ============================================================
       LAYOUT SHELL
       ============================================================ */
    .sa2-wrapper {
        background:
            radial-gradient(circle at 100% 0%, rgba(13, 148, 136, 0.06), transparent 45%),
            radial-gradient(circle at 0% 100%, rgba(13, 148, 136, 0.05), transparent 40%),
            var(--sa2-ink-50);
        min-height: 100%;
        padding: 34px clamp(16px, 4vw, 48px) 60px;
    }

    .sa2-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* ============================================================
       HERO HEADER
       ============================================================ */
    .sa2-hero {
        position: relative;
        border-radius: var(--sa2-radius-xl);
        overflow: hidden;
        background: linear-gradient(135deg, #0f766e 0%, #14b8a6 50%, #2dd4bf 100%);
        box-shadow: var(--sa2-shadow-lg);
        margin-bottom: 28px;
    }

    .sa2-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 12% 15%, rgba(255, 255, 255, 0.10) 0%, transparent 32%),
            radial-gradient(circle at 88% 0%, rgba(255, 255, 255, 0.12) 0%, transparent 40%),
            radial-gradient(circle at 95% 95%, rgba(0, 0, 0, 0.08) 0%, transparent 45%);
        pointer-events: none;
    }

    .sa2-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px);
        background-size: 28px 28px;
        mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6), transparent 75%);
        pointer-events: none;
    }

    .sa2-hero-inner {
        position: relative;
        z-index: 1;
        padding: 34px clamp(20px, 4vw, 44px) 30px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }

    .sa2-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.85);
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.24);
        padding: 6px 12px;
        border-radius: 999px;
        margin-bottom: 14px;
        backdrop-filter: blur(6px);
    }

    .sa2-hero-eyebrow svg {
        width: 14px;
        height: 14px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.4;
    }

    .sa2-hero h1 {
        color: #ffffff;
        font-size: clamp(24px, 3vw, 32px);
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.15;
        margin: 0 0 8px;
    }

    .sa2-hero-sub {
        color: rgba(255, 255, 255, 0.85);
        font-size: 14.5px;
        font-weight: 500;
        max-width: 560px;
        line-height: 1.55;
        margin: 0;
    }

    .sa2-hero-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 14px;
    }

    .sa2-live-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.16);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(6px);
    }

    .sa2-live-pill .sa2-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        animation: sa2-pulse 2s ease-in-out infinite;
        flex-shrink: 0;
    }

    @keyframes sa2-pulse {

        0%,
        100% {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        }

        50% {
            box-shadow: 0 0 0 6px rgba(255, 255, 255, 0.1);
        }
    }

    .sa2-hero-datetime {
        font-size: 12px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.72);
        letter-spacing: 0.02em;
    }

    .sa2-hero-mini-row {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1px;
        background: rgba(255, 255, 255, 0.18);
        border-top: 1px solid rgba(255, 255, 255, 0.18);
    }

    .sa2-hero-mini {
        background: rgba(255, 255, 255, 0.06);
        padding: 18px clamp(20px, 4vw, 44px);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sa2-hero-mini-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.16);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sa2-hero-mini-icon svg {
        width: 18px;
        height: 18px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.2;
    }

    .sa2-hero-mini-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 2px;
    }

    .sa2-hero-mini-value {
        font-size: 18px;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.2px;
    }

    @media (max-width: 720px) {
        .sa2-hero-mini-row {
            grid-template-columns: 1fr;
        }
    }

    /* ============================================================
       SECTION HEADINGS
       ============================================================ */
    .sa2-section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .sa2-section-title {
        font-size: 17px;
        font-weight: 800;
        color: var(--sa2-ink-900);
        letter-spacing: -0.3px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .sa2-section-title .sa2-section-dot {
        width: 8px;
        height: 20px;
        border-radius: 4px;
        background: linear-gradient(180deg, var(--sa2-teal-400), var(--sa2-teal-700));
        display: inline-block;
    }

    .sa2-section-hint {
        font-size: 12.5px;
        font-weight: 500;
        color: var(--sa2-ink-400);
    }

    .sa2-view-all {
        color: var(--sa2-teal-700);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: gap 0.25s ease, color 0.25s ease;
    }

    .sa2-view-all svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.4;
    }

    .sa2-view-all:hover {
        gap: 10px;
        color: var(--sa2-teal-800);
    }

    /* ============================================================
       PRIMARY STAT GRID
       ============================================================ */
    .sa2-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 32px;
    }

    .sa2-stat-card {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--sa2-ink-200);
        border-radius: var(--sa2-radius-lg);
        box-shadow: var(--sa2-shadow-sm);
        padding: 24px 24px 22px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        overflow: hidden;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.25s ease;
        opacity: 0;
        transform: translateY(16px);
        animation: sa2-rise 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .sa2-stat-card:nth-child(1) {
        animation-delay: 0.02s;
    }

    .sa2-stat-card:nth-child(2) {
        animation-delay: 0.07s;
    }

    .sa2-stat-card:nth-child(3) {
        animation-delay: 0.12s;
    }

    .sa2-stat-card:nth-child(4) {
        animation-delay: 0.17s;
    }

    .sa2-stat-card:nth-child(5) {
        animation-delay: 0.22s;
    }

    .sa2-stat-card:nth-child(6) {
        animation-delay: 0.27s;
    }

    @keyframes sa2-rise {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .sa2-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--sa2-accent-400, var(--sa2-teal-400)), var(--sa2-accent-700, var(--sa2-teal-700)));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sa2-stat-card::after {
        content: '';
        position: absolute;
        top: -60%;
        right: -40%;
        width: 220%;
        height: 220%;
        background: radial-gradient(circle, var(--sa2-accent-glow, rgba(20, 184, 166, 0.08)) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
        pointer-events: none;
    }

    .sa2-stat-card:hover {
        transform: translateY(-6px) scale(1.015);
        box-shadow: var(--sa2-shadow-md);
        border-color: var(--sa2-ink-300);
    }

    .sa2-stat-card:hover::before {
        transform: scaleX(1);
    }

    .sa2-stat-card:hover::after {
        opacity: 1;
    }

    .sa2-stat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        position: relative;
        z-index: 1;
    }

    .sa2-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: var(--sa2-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--sa2-accent-400, var(--sa2-teal-400)), var(--sa2-accent-700, var(--sa2-teal-700)));
        box-shadow: 0 10px 22px var(--sa2-accent-glow, rgba(20, 184, 166, 0.28));
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;
    }

    .sa2-stat-card:hover .sa2-stat-icon {
        transform: scale(1.08) rotate(-6deg);
    }

    .sa2-stat-icon svg {
        width: 24px;
        height: 24px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2.1;
    }

    .sa2-trend-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .sa2-stat-label {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: var(--sa2-ink-500);
        margin: 0 0 6px;
        position: relative;
        z-index: 1;
        transition: color 0.3s ease;
    }

    .sa2-stat-card:hover .sa2-stat-label {
        color: var(--sa2-accent-700, var(--sa2-teal-700));
    }

    .sa2-stat-value {
        font-size: 34px;
        font-weight: 800;
        color: var(--sa2-ink-900);
        letter-spacing: -0.7px;
        line-height: 1;
        margin: 0 0 10px;
        position: relative;
        z-index: 1;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sa2-stat-card:hover .sa2-stat-value {
        transform: scale(1.04);
    }

    .sa2-stat-desc {
        font-size: 12.5px;
        font-weight: 500;
        color: var(--sa2-ink-500);
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .sa2-stat-desc .sa2-mini-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sa2-stat-progress-wrap {
        margin-top: 4px;
        position: relative;
        z-index: 1;
    }

    .sa2-stat-progress-track {
        position: relative;
        height: 6px;
        border-radius: 999px;
        background: var(--sa2-ink-100);
        overflow: hidden;
    }

    .sa2-stat-progress-fill {
        position: absolute;
        inset: 0;
        width: var(--sa2-fill, 0%);
        border-radius: 999px;
        background: linear-gradient(90deg, var(--sa2-accent-400, var(--sa2-teal-400)), var(--sa2-accent-700, var(--sa2-teal-700)));
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sa2-tone-success {
        background: var(--sa2-success-bg);
        color: var(--sa2-success-fg);
    }

    .sa2-tone-warning {
        background: var(--sa2-warning-bg);
        color: var(--sa2-warning-fg);
    }

    .sa2-tone-danger {
        background: var(--sa2-danger-bg);
        color: var(--sa2-danger-fg);
    }

    .sa2-tone-info {
        background: var(--sa2-info-bg);
        color: var(--sa2-info-fg);
    }

    .sa2-tone-indigo {
        background: var(--sa2-indigo-bg);
        color: var(--sa2-indigo-fg);
    }

    .sa2-tone-amber {
        background: var(--sa2-amber-bg);
        color: var(--sa2-amber-fg);
    }

    /* ============================================================
       HEALTH / RATIO CARDS
       ============================================================ */
    .sa2-health-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 32px;
    }

    .sa2-health-card {
        background: #ffffff;
        border: 1px solid var(--sa2-ink-200);
        border-radius: var(--sa2-radius-lg);
        box-shadow: var(--sa2-shadow-sm);
        padding: 26px 26px 24px;
        opacity: 0;
        transform: translateY(16px);
        animation: sa2-rise 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .sa2-health-card:nth-child(1) {
        animation-delay: 0.05s;
    }

    .sa2-health-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .sa2-health-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .sa2-health-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sa2-health-title-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: var(--sa2-teal-50);
        color: var(--sa2-teal-700);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sa2-health-title-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.1;
    }

    .sa2-health-title h4 {
        font-size: 15.5px;
        font-weight: 800;
        color: var(--sa2-ink-900);
        margin: 0 0 2px;
    }

    .sa2-health-title span {
        font-size: 12px;
        font-weight: 500;
        color: var(--sa2-ink-400);
    }

    .sa2-health-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 999px;
        border: 1px solid transparent;
    }

    .sa2-health-badge.sa2-tone-success {
        border-color: var(--sa2-success-bd);
    }

    .sa2-health-badge.sa2-tone-warning {
        border-color: var(--sa2-warning-bd);
    }

    .sa2-health-badge.sa2-tone-danger {
        border-color: var(--sa2-danger-bd);
    }

    .sa2-split-bar {
        display: flex;
        width: 100%;
        height: 14px;
        border-radius: 999px;
        overflow: hidden;
        background: var(--sa2-ink-100);
        margin-bottom: 16px;
    }

    .sa2-split-seg {
        height: 100%;
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sa2-split-legend {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
    }

    .sa2-legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sa2-legend-swatch {
        width: 10px;
        height: 10px;
        border-radius: 3px;
        flex-shrink: 0;
    }

    .sa2-legend-text {
        display: flex;
        flex-direction: column;
    }

    .sa2-legend-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--sa2-ink-500);
    }

    .sa2-legend-value {
        font-size: 15px;
        font-weight: 800;
        color: var(--sa2-ink-900);
    }

    /* ============================================================
       TWO-COLUMN LAYOUT (Quick actions + Activity)
       ============================================================ */
    .sa2-columns {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
        align-items: start;
    }

    /* ---- Quick actions ---- */
    .sa2-action-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .sa2-action-card {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--sa2-ink-200);
        border-radius: var(--sa2-radius-md);
        padding: 22px 20px;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.3s ease;
        opacity: 0;
        transform: translateY(16px);
        animation: sa2-rise 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .sa2-action-card:nth-child(1) {
        animation-delay: 0.03s;
    }

    .sa2-action-card:nth-child(2) {
        animation-delay: 0.08s;
    }

    .sa2-action-card:nth-child(3) {
        animation-delay: 0.13s;
    }

    .sa2-action-card:nth-child(4) {
        animation-delay: 0.18s;
    }

    .sa2-action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--sa2-teal-400), var(--sa2-teal-700));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sa2-action-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--sa2-shadow-teal);
        border-color: var(--sa2-teal-200);
    }

    .sa2-action-card:hover::before {
        transform: scaleX(1);
    }

    .sa2-action-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--sa2-radius-sm);
        background: linear-gradient(135deg, var(--sa2-teal-500), var(--sa2-teal-700));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        box-shadow: 0 8px 18px rgba(13, 148, 136, 0.28);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .sa2-action-card:hover .sa2-action-icon {
        transform: scale(1.08) rotate(-4deg);
        box-shadow: 0 12px 26px rgba(13, 148, 136, 0.4);
    }

    .sa2-action-icon svg {
        width: 21px;
        height: 21px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2.1;
    }

    .sa2-action-card h5 {
        font-size: 14.5px;
        font-weight: 800;
        color: var(--sa2-ink-900);
        margin: 0 0 3px;
        letter-spacing: -0.2px;
    }

    .sa2-action-card p {
        font-size: 12px;
        color: var(--sa2-ink-500);
        margin: 0;
        font-weight: 500;
        line-height: 1.4;
    }

    .sa2-action-arrow {
        margin-top: auto;
        align-self: flex-end;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: var(--sa2-ink-100);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .sa2-action-arrow svg {
        width: 12px;
        height: 12px;
        stroke: var(--sa2-ink-500);
        fill: none;
        stroke-width: 2.4;
        transition: stroke 0.3s ease;
    }

    .sa2-action-card:hover .sa2-action-arrow {
        background: var(--sa2-teal-600);
        transform: translateX(3px);
    }

    .sa2-action-card:hover .sa2-action-arrow svg {
        stroke: #ffffff;
    }

    /* ---- Recent activity ---- */
    .sa2-activity-card {
        background: #ffffff;
        border: 1px solid var(--sa2-ink-200);
        border-radius: var(--sa2-radius-lg);
        box-shadow: var(--sa2-shadow-sm);
        padding: 8px 22px 8px;
        opacity: 0;
        transform: translateY(16px);
        animation: sa2-rise 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        animation-delay: 0.1s;
    }

    .sa2-activity-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sa2-activity-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid var(--sa2-ink-100);
        border-radius: var(--sa2-radius-sm);
        transition: background 0.2s ease;
        margin: 0 -10px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .sa2-activity-item:last-child {
        border-bottom: none;
    }

    .sa2-activity-item:hover {
        background: var(--sa2-ink-50);
    }

    .sa2-activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .sa2-activity-icon svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.1;
    }

    .sa2-activity-body {
        flex: 1;
        min-width: 0;
    }

    .sa2-activity-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--sa2-ink-900);
        margin: 0 0 3px;
    }

    .sa2-activity-desc {
        font-size: 12.5px;
        color: var(--sa2-ink-500);
        margin: 0;
        font-weight: 500;
        line-height: 1.4;
    }

    .sa2-activity-time {
        font-size: 11.5px;
        font-weight: 600;
        color: var(--sa2-ink-400);
        white-space: nowrap;
        margin-top: 2px;
        flex-shrink: 0;
    }

    /* ============================================================
       CHARTS SECTION
       ============================================================ */
    .sa2-charts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 32px;
    }

    .sa2-chart-card {
        background: #ffffff;
        border: 1px solid var(--sa2-ink-200);
        border-radius: var(--sa2-radius-lg);
        box-shadow: var(--sa2-shadow-sm);
        padding: 24px;
        opacity: 0;
        transform: translateY(16px);
        animation: sa2-rise 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .sa2-chart-card:nth-child(1) {
        animation-delay: 0.05s;
    }

    .sa2-chart-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .sa2-chart-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .sa2-chart-title {
        font-size: 15.5px;
        font-weight: 800;
        color: var(--sa2-ink-900);
        margin: 0;
    }

    .sa2-chart-filters {
        display: flex;
        gap: 6px;
        background: var(--sa2-ink-100);
        padding: 3px;
        border-radius: 999px;
    }

    .sa2-filter-btn {
        padding: 6px 13px;
        border: none;
        border-radius: 999px;
        background: transparent;
        color: var(--sa2-ink-500);
        font-size: 11.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .sa2-filter-btn.sa2-active,
    .sa2-filter-btn:hover {
        background: #ffffff;
        color: var(--sa2-teal-700);
        box-shadow: var(--sa2-shadow-sm);
    }

    .sa2-chart-placeholder {
        height: 240px;
        border-radius: var(--sa2-radius-md);
        border: 1.5px dashed var(--sa2-ink-200);
        background:
            linear-gradient(180deg, var(--sa2-ink-50), #ffffff);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: var(--sa2-ink-400);
    }

    .sa2-chart-placeholder svg {
        width: 40px;
        height: 40px;
        stroke: var(--sa2-teal-300);
        fill: none;
        stroke-width: 1.6;
    }

    .sa2-chart-placeholder span {
        font-size: 12.5px;
        font-weight: 600;
    }

    /* ============================================================
       FOOTER MINI-STATS
       ============================================================ */
    .sa2-footer-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 8px;
    }

    .sa2-footer-card {
        background: linear-gradient(160deg, #ffffff, var(--sa2-ink-50));
        border: 1px solid var(--sa2-ink-200);
        border-radius: var(--sa2-radius-md);
        padding: 20px 20px 18px;
        text-align: center;
        opacity: 0;
        transform: translateY(14px);
        animation: sa2-rise 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .sa2-footer-card:nth-child(1) {
        animation-delay: 0.02s;
    }

    .sa2-footer-card:nth-child(2) {
        animation-delay: 0.06s;
    }

    .sa2-footer-card:nth-child(3) {
        animation-delay: 0.1s;
    }

    .sa2-footer-card:nth-child(4) {
        animation-delay: 0.14s;
    }

    .sa2-footer-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--sa2-ink-400);
        margin-bottom: 8px;
    }

    .sa2-footer-value {
        font-size: 23px;
        font-weight: 800;
        color: var(--sa2-ink-900);
        letter-spacing: -0.4px;
    }

    .sa2-footer-note {
        display: inline-block;
        margin-top: 6px;
        font-size: 10.5px;
        font-weight: 600;
        color: var(--sa2-teal-700);
        background: var(--sa2-teal-50);
        border: 1px solid var(--sa2-teal-200);
        padding: 2px 8px;
        border-radius: 999px;
    }

    /* ============================================================
       FOOTNOTE
       ============================================================ */
    .sa2-footnote {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
        font-size: 12px;
        font-weight: 500;
        color: var(--sa2-ink-400);
        margin-top: 20px;
    }

    .sa2-footnote svg {
        width: 13px;
        height: 13px;
        stroke: var(--sa2-ink-400);
        fill: none;
        stroke-width: 2.2;
    }

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 1180px) {
        .sa2-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .sa2-health-grid {
            grid-template-columns: 1fr;
        }

        .sa2-columns {
            grid-template-columns: 1fr;
        }

        .sa2-charts-grid {
            grid-template-columns: 1fr;
        }

        .sa2-footer-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .sa2-wrapper {
            padding: 20px 14px 40px;
        }

        .sa2-hero-inner {
            flex-direction: column;
        }

        .sa2-hero-right {
            align-items: flex-start;
        }

        .sa2-stats-grid {
            grid-template-columns: 1fr;
        }

        .sa2-action-grid {
            grid-template-columns: 1fr;
        }

        .sa2-footer-grid {
            grid-template-columns: 1fr;
        }

        .sa2-split-legend {
            gap: 16px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .sa2-scope * {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<div class="page-wrapper sa2-scope">
    <div class="page-content">
        <div class="sa2-wrapper">
            <div class="sa2-container">

                <!-- ============================================
                     HERO HEADER
                     ============================================ -->
                <div class="sa2-hero">
                    <div class="sa2-hero-inner">
                        <div>
                            <div class="sa2-hero-eyebrow">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2l8 4v6c0 5-3.4 8.7-8 10-4.6-1.3-8-5-8-10V6z" />
                                    <path d="M9 12l2 2 4-4" />
                                </svg>
                                Super Admin
                            </div>
                            <h1>Super Admin Dashboard</h1>
                            <p class="sa2-hero-sub">Monitor companies, subscriptions and plan activity from one place.
                                Track key metrics and system performance in real time.</p>
                        </div>

                        <div class="sa2-hero-right">
                            <span class="sa2-live-pill">
                                <span class="sa2-dot"></span>
                                Live overview
                            </span>
                            <span class="sa2-hero-datetime"><?= date('l, d M Y') ?></span>
                        </div>
                    </div>

                    <div class="sa2-hero-mini-row">
                        <div class="sa2-hero-mini">
                            <div class="sa2-hero-mini-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M3 21V8l7-5 7 5v13" />
                                    <path d="M13 21v-6h4v6" />
                                    <path d="M7 9h2M7 13h2M7 17h2" />
                                </svg>
                            </div>
                            <div>
                                <div class="sa2-hero-mini-label">Companies</div>
                                <div class="sa2-hero-mini-value"><?= number_format($totalCompanies) ?></div>
                            </div>
                        </div>
                        <div class="sa2-hero-mini">
                            <div class="sa2-hero-mini-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="14" rx="2" />
                                    <path d="M3 9h18" />
                                    <circle cx="8" cy="14" r="1.5" />
                                </svg>
                            </div>
                            <div>
                                <div class="sa2-hero-mini-label">Plans</div>
                                <div class="sa2-hero-mini-value"><?= number_format($totalPlans) ?></div>
                            </div>
                        </div>
                        <div class="sa2-hero-mini">
                            <div class="sa2-hero-mini-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="2" y="6" width="20" height="14" rx="2" />
                                    <path d="M2 10h20" />
                                    <path d="M6 15h4" />
                                </svg>
                            </div>
                            <div>
                                <div class="sa2-hero-mini-label">Payments</div>
                                <div class="sa2-hero-mini-value"><?= number_format($totalPayments) ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================
                     PRIMARY STAT GRID
                     ============================================ -->
                <div class="sa2-section-head">
                    <h3 class="sa2-section-title"><span class="sa2-section-dot"></span> Platform Metrics</h3>
                    <span class="sa2-section-hint">Real-time figures across all tenants</span>
                </div>

                <div class="sa2-stats-grid">

                    <div class="sa2-stat-card"
                        style="--sa2-accent-400:#2dd4bf; --sa2-accent-700:#0d9488; --sa2-accent-glow:rgba(13,148,136,0.28);">
                        <div class="sa2-stat-top">
                            <div class="sa2-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M3 21V8l7-5 7 5v13" />
                                    <path d="M13 21v-6h4v6" />
                                    <path d="M7 9h2M7 13h2M7 17h2" />
                                </svg>
                            </div>
                            <span class="sa2-trend-chip sa2-tone-success">All time</span>
                        </div>
                        <div>
                            <div class="sa2-stat-label">Total Companies</div>
                            <div class="sa2-stat-value"><?= number_format($totalCompanies) ?></div>
                            <p class="sa2-stat-desc"><span class="sa2-mini-dot"
                                    style="background:#0d9488;"></span>Companies registered in system</p>
                        </div>
                    </div>

                    <div class="sa2-stat-card"
                        style="--sa2-accent-400:#4ade80; --sa2-accent-700:#15803d; --sa2-accent-glow:rgba(21,128,61,0.28);">
                        <div class="sa2-stat-top">
                            <div class="sa2-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M17 11l2 2 4-4" />
                                </svg>
                            </div>
                            <span class="sa2-trend-chip sa2-tone-success"><?= $companyActivePct ?>% of total</span>
                        </div>
                        <div>
                            <div class="sa2-stat-label">Active Companies</div>
                            <div class="sa2-stat-value"><?= number_format($activeCompanies) ?></div>
                            <p class="sa2-stat-desc"><span class="sa2-mini-dot"
                                    style="background:#15803d;"></span>Companies with active access</p>
                        </div>
                        <div class="sa2-stat-progress-wrap">
                            <div class="sa2-stat-progress-track">
                                <div class="sa2-stat-progress-fill" style="--sa2-fill: <?= $companyActivePct ?>%;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sa2-stat-card"
                        style="--sa2-accent-400:#f87171; --sa2-accent-700:#b02a37; --sa2-accent-glow:rgba(176,42,55,0.28);">
                        <div class="sa2-stat-top">
                            <div class="sa2-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M17 8l4 4m0-4l-4 4" />
                                </svg>
                            </div>
                            <span class="sa2-trend-chip sa2-tone-danger"><?= $companyInactivePct ?>% of total</span>
                        </div>
                        <div>
                            <div class="sa2-stat-label">Inactive Companies</div>
                            <div class="sa2-stat-value"><?= number_format($inactiveCompanies) ?></div>
                            <p class="sa2-stat-desc"><span class="sa2-mini-dot"
                                    style="background:#b02a37;"></span>Companies without active access</p>
                        </div>
                        <div class="sa2-stat-progress-wrap">
                            <div class="sa2-stat-progress-track">
                                <div class="sa2-stat-progress-fill" style="--sa2-fill: <?= $companyInactivePct ?>%;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sa2-stat-card"
                        style="--sa2-accent-400:#818cf8; --sa2-accent-700:#4f46e5; --sa2-accent-glow:rgba(79,70,229,0.28);">
                        <div class="sa2-stat-top">
                            <div class="sa2-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="14" rx="2" />
                                    <path d="M3 9h18" />
                                    <circle cx="8" cy="14" r="1.5" />
                                </svg>
                            </div>
                            <span class="sa2-trend-chip sa2-tone-indigo">Catalog</span>
                        </div>
                        <div>
                            <div class="sa2-stat-label">Total Plans</div>
                            <div class="sa2-stat-value"><?= number_format($totalPlans) ?></div>
                            <p class="sa2-stat-desc"><span class="sa2-mini-dot" style="background:#4f46e5;"></span>Plans
                                available to companies</p>
                        </div>
                    </div>

                    <div class="sa2-stat-card"
                        style="--sa2-accent-400:#60a5fa; --sa2-accent-700:#2563eb; --sa2-accent-glow:rgba(37,99,235,0.28);">
                        <div class="sa2-stat-top">
                            <div class="sa2-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20 7l-9 10-5-5" />
                                </svg>
                            </div>
                            <span class="sa2-trend-chip sa2-tone-info"><?= $planActivePct ?>% active</span>
                        </div>
                        <div>
                            <div class="sa2-stat-label">Active Plans</div>
                            <div class="sa2-stat-value"><?= number_format($activePlans) ?></div>
                            <p class="sa2-stat-desc"><span class="sa2-mini-dot"
                                    style="background:#2563eb;"></span>Current active subscriptions</p>
                        </div>
                        <div class="sa2-stat-progress-wrap">
                            <div class="sa2-stat-progress-track">
                                <div class="sa2-stat-progress-fill" style="--sa2-fill: <?= $planActivePct ?>%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="sa2-stat-card"
                        style="--sa2-accent-400:#fbbf24; --sa2-accent-700:#b45309; --sa2-accent-glow:rgba(180,83,9,0.28);">
                        <div class="sa2-stat-top">
                            <div class="sa2-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="2" y="6" width="20" height="14" rx="2" />
                                    <path d="M2 10h20" />
                                    <path d="M6 15h4" />
                                </svg>
                            </div>
                            <span class="sa2-trend-chip sa2-tone-amber">Lifetime</span>
                        </div>
                        <div>
                            <div class="sa2-stat-label">Total Payments</div>
                            <div class="sa2-stat-value"><?= number_format($totalPayments) ?></div>
                            <p class="sa2-stat-desc"><span class="sa2-mini-dot"
                                    style="background:#b45309;"></span>Subscription payments received</p>
                        </div>
                    </div>

                </div>

                <!-- ============================================
                     HEALTH / RATIO SECTION
                     ============================================ -->
                <div class="sa2-section-head">
                    <h3 class="sa2-section-title"><span class="sa2-section-dot"></span> Account &amp; Plan Health</h3>
                    <span class="sa2-section-hint">How active usage compares to totals</span>
                </div>

                <div class="sa2-health-grid">

                    <div class="sa2-health-card">
                        <div class="sa2-health-head">
                            <div class="sa2-health-title">
                                <div class="sa2-health-title-icon"><svg viewBox="0 0 24 24">
                                        <path d="M3 21V8l7-5 7 5v13" />
                                        <path d="M13 21v-6h4v6" />
                                    </svg></div>
                                <div>
                                    <h4>Company Activity Ratio</h4><span>Active vs. inactive companies</span>
                                </div>
                            </div>
                            <span
                                class="sa2-health-badge sa2-tone-<?= $companyHealth['tone'] ?>"><?= $companyHealth['label'] ?></span>
                        </div>
                        <div class="sa2-split-bar">
                            <div class="sa2-split-seg"
                                style="width: <?= $companyActivePct ?>%; background: linear-gradient(90deg,#4ade80,#15803d);">
                            </div>
                            <div class="sa2-split-seg"
                                style="width: <?= $companyInactivePct ?>%; background: linear-gradient(90deg,#f87171,#b02a37);">
                            </div>
                        </div>
                        <div class="sa2-split-legend">
                            <div class="sa2-legend-item">
                                <span class="sa2-legend-swatch" style="background:#15803d;"></span>
                                <div class="sa2-legend-text"><span class="sa2-legend-label">Active</span><span
                                        class="sa2-legend-value"><?= number_format($activeCompanies) ?>
                                        (<?= $companyActivePct ?>%)</span></div>
                            </div>
                            <div class="sa2-legend-item">
                                <span class="sa2-legend-swatch" style="background:#b02a37;"></span>
                                <div class="sa2-legend-text"><span class="sa2-legend-label">Inactive</span><span
                                        class="sa2-legend-value"><?= number_format($inactiveCompanies) ?>
                                        (<?= $companyInactivePct ?>%)</span></div>
                            </div>
                            <div class="sa2-legend-item">
                                <span class="sa2-legend-swatch" style="background:#94a3b8;"></span>
                                <div class="sa2-legend-text"><span class="sa2-legend-label">Avg. payments / active
                                        co.</span><span
                                        class="sa2-legend-value"><?= number_format($avgPaymentsPerCo, 1) ?></span></div>
                            </div>
                        </div>
                    </div>

                    <div class="sa2-health-card">
                        <div class="sa2-health-head">
                            <div class="sa2-health-title">
                                <div class="sa2-health-title-icon"><svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="14" rx="2" />
                                        <path d="M3 9h18" />
                                        <circle cx="8" cy="14" r="1.5" />
                                    </svg></div>
                                <div>
                                    <h4>Plan Utilization</h4><span>Active vs. inactive plans</span>
                                </div>
                            </div>
                            <span
                                class="sa2-health-badge sa2-tone-<?= $planHealth['tone'] ?>"><?= $planHealth['label'] ?></span>
                        </div>
                        <div class="sa2-split-bar">
                            <div class="sa2-split-seg"
                                style="width: <?= $planActivePct ?>%; background: linear-gradient(90deg,#60a5fa,#2563eb);">
                            </div>
                            <div class="sa2-split-seg"
                                style="width: <?= (100 - $planActivePct) ?>%; background: linear-gradient(90deg,#cbd5e1,#94a3b8);">
                            </div>
                        </div>
                        <div class="sa2-split-legend">
                            <div class="sa2-legend-item">
                                <span class="sa2-legend-swatch" style="background:#2563eb;"></span>
                                <div class="sa2-legend-text"><span class="sa2-legend-label">Active Plans</span><span
                                        class="sa2-legend-value"><?= number_format($activePlans) ?>
                                        (<?= $planActivePct ?>%)</span></div>
                            </div>
                            <div class="sa2-legend-item">
                                <span class="sa2-legend-swatch" style="background:#94a3b8;"></span>
                                <div class="sa2-legend-text"><span class="sa2-legend-label">Inactive Plans</span><span
                                        class="sa2-legend-value"><?= number_format($inactivePlans) ?>
                                        (<?= (100 - $planActivePct) ?>%)</span></div>
                            </div>
                            <div class="sa2-legend-item">
                                <span class="sa2-legend-swatch" style="background:#4f46e5;"></span>
                                <div class="sa2-legend-text"><span class="sa2-legend-label">Total Plans</span><span
                                        class="sa2-legend-value"><?= number_format($totalPlans) ?></span></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ============================================
                     QUICK ACTIONS + RECENT ACTIVITY
                     ============================================ -->
                <div class="sa2-columns">

                    <div>
                        <div class="sa2-section-head">
                            <h3 class="sa2-section-title"><span class="sa2-section-dot"></span> Quick Actions</h3>
                        </div>
                        <div class="sa2-action-grid">

                            <a href="<?= function_exists('base_url') ? base_url('superadmin/companies/add') : '#' ?>"
                                class="sa2-action-card">
                                <div class="sa2-action-icon"><svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M12 8v8M8 12h8" />
                                    </svg></div>
                                <h5>Add New Company</h5>
                                <p>Register a new company to the system</p>
                                <div class="sa2-action-arrow"><svg viewBox="0 0 24 24">
                                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                            </a>

                            <a href="<?= function_exists('base_url') ? base_url('superadmin/plans') : '#' ?>"
                                class="sa2-action-card">
                                <div class="sa2-action-icon"><svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="14" rx="2" />
                                        <path d="M3 9h18" />
                                        <circle cx="8" cy="14" r="1.5" />
                                    </svg></div>
                                <h5>Manage Plans</h5>
                                <p>Create and modify subscription plans</p>
                                <div class="sa2-action-arrow"><svg viewBox="0 0 24 24">
                                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                            </a>

                            <a href="<?= function_exists('base_url') ? base_url('superadmin/payments') : '#' ?>"
                                class="sa2-action-card">
                                <div class="sa2-action-icon"><svg viewBox="0 0 24 24">
                                        <rect x="2" y="6" width="20" height="14" rx="2" />
                                        <path d="M2 10h20" />
                                        <path d="M6 15h4" />
                                    </svg></div>
                                <h5>View Payments</h5>
                                <p>Track all payment transactions</p>
                                <div class="sa2-action-arrow"><svg viewBox="0 0 24 24">
                                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                            </a>

                            <a href="<?= function_exists('base_url') ? base_url('superadmin/settings') : '#' ?>"
                                class="sa2-action-card">
                                <div class="sa2-action-icon"><svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="3" />
                                        <path
                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15 1.65 1.65 0 0 0 3.17 14H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
                                    </svg></div>
                                <h5>System Settings</h5>
                                <p>Configure system preferences</p>
                                <div class="sa2-action-arrow"><svg viewBox="0 0 24 24">
                                        <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg></div>
                            </a>

                        </div>
                    </div>

                    <div>
                        <div class="sa2-section-head">
                            <h3 class="sa2-section-title"><span class="sa2-section-dot"></span> Recent Activity</h3>
                            <a href="<?= function_exists('base_url') ? base_url('superadmin/activity') : '#' ?>"
                                class="sa2-view-all">
                                View all
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="sa2-activity-card">
                            <ul class="sa2-activity-list">
                                <?php foreach ($activities as $item):
                                    $style = $activityStyles[$item['type']] ?? $activityStyles['activate'];
                                    ?>
                                    <li class="sa2-activity-item">
                                        <div class="sa2-activity-icon sa2-tone-<?= $style['tone'] ?>">
                                            <?= xc_activity_icon($style['icon']) ?>
                                        </div>
                                        <div class="sa2-activity-body">
                                            <p class="sa2-activity-title"><?= htmlspecialchars($item['title']) ?></p>
                                            <p class="sa2-activity-desc"><?= htmlspecialchars($item['desc']) ?></p>
                                        </div>
                                        <span class="sa2-activity-time"><?= htmlspecialchars($item['time']) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- ============================================
                     FOOTER MINI-STATS
                     ============================================ -->
                <div class="sa2-section-head">
                    <h3 class="sa2-section-title"><span class="sa2-section-dot"></span> At a Glance</h3>
                </div>

                <div class="sa2-footer-grid">
                    <div class="sa2-footer-card">
                        <div class="sa2-footer-label">Avg. Revenue</div>
                        <div class="sa2-footer-value">
                            <?= $avgRevenue !== null ? htmlspecialchars($avgRevenue) : '$' . number_format($avgPaymentsPerCo, 1) . 'K' ?>
                        </div>
                        <?php if ($avgRevenue === null) { ?><span class="sa2-footer-note">Estimated</span><?php } ?>
                    </div>
                    <div class="sa2-footer-card">
                        <div class="sa2-footer-label">Growth Rate</div>
                        <div class="sa2-footer-value"><?= $growthRate !== null ? htmlspecialchars($growthRate) : '—' ?>
                        </div>
                        <?php if ($growthRate === null) { ?><span class="sa2-footer-note">Connect data</span><?php } ?>
                    </div>
                    <div class="sa2-footer-card">
                        <div class="sa2-footer-label">Active Users</div>
                        <div class="sa2-footer-value">
                            <?= $activeUsers !== null ? number_format((int) $activeUsers) : '—' ?>
                        </div>
                        <?php if ($activeUsers === null) { ?><span class="sa2-footer-note">Connect data</span><?php } ?>
                    </div>
                    <div class="sa2-footer-card">
                        <div class="sa2-footer-label">Satisfaction</div>
                        <div class="sa2-footer-value">
                            <?= $satisfactionRate !== null ? htmlspecialchars($satisfactionRate) : '—' ?>
                        </div>
                        <?php if ($satisfactionRate === null) { ?><span class="sa2-footer-note">Connect
                                data</span><?php } ?>
                    </div>
                </div>

                <!-- ============================================
                     FOOTNOTE
                     ============================================ -->
                <div class="sa2-footnote">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 8v4l2 2" />
                    </svg>
                    Platform metrics update automatically; activity, charts, and footer stats can be wired to your live
                    data sources.
                </div>

            </div>
        </div>
    </div>
</div>