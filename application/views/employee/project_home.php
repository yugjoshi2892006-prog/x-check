<?php
/**
 * ============================================================================
 *  PROJECT DASHBOARD — PROFESSIONAL EDITION
 * ----------------------------------------------------------------------------
 *  Drop-in replacement view. Keeps the exact same data contract as the
 *  original template:
 *
 *      $project->id
 *      $project->project_name
 *      $project->customer_name
 *      $project->status
 *      $project->start_date
 *      $project->end_date
 *      $attendance_today   (array/collection — empty means "not marked yet")
 *
 *  Everything else (routes, base_url() calls, the "locked until attendance
 *  is marked" business rule) is preserved 1:1 so you can swap this file in
 *  without touching your controller.
 * ============================================================================
 */

// ---- Derived / helper values (pure PHP, no external deps) -----------------
$locked = empty($attendance_today);

// Normalize status for styling (planning / active / on-hold / completed / delayed)
$rawStatus = isset($project->status) ? strtolower(trim($project->status)) : 'active';
$statusMap = [
    'completed' => ['label' => 'Completed', 'tone' => 'success'],
    'complete' => ['label' => 'Completed', 'tone' => 'success'],
    'active' => ['label' => 'Active', 'tone' => 'brand'],
    'in progress' => ['label' => 'In Progress', 'tone' => 'brand'],
    'ongoing' => ['label' => 'Ongoing', 'tone' => 'brand'],
    'planning' => ['label' => 'Planning', 'tone' => 'info'],
    'on hold' => ['label' => 'On Hold', 'tone' => 'warning'],
    'on-hold' => ['label' => 'On Hold', 'tone' => 'warning'],
    'delayed' => ['label' => 'Delayed', 'tone' => 'danger'],
    'cancelled' => ['label' => 'Cancelled', 'tone' => 'danger'],
    'canceled' => ['label' => 'Cancelled', 'tone' => 'danger'],
];
$statusInfo = $statusMap[$rawStatus] ?? ['label' => isset($project->status) ? $project->status : 'Active', 'tone' => 'brand'];

// Timeline progress (best-effort — falls back gracefully if dates are missing/invalid)
$progressPct = null;
$daysLeft = null;
$daysTotal = null;
$daysElapsed = null;
if (!empty($project->start_date) && !empty($project->end_date)) {
    $start = strtotime($project->start_date);
    $end = strtotime($project->end_date);
    $today = strtotime(date('Y-m-d'));
    if ($start && $end && $end > $start) {
        $daysTotal = round(($end - $start) / 86400);
        $daysElapsed = round(($today - $start) / 86400);
        $daysElapsed = max(0, min($daysElapsed, $daysTotal));
        $progressPct = $daysTotal > 0 ? round(($daysElapsed / $daysTotal) * 100) : 0;
        $daysLeft = max(0, round(($end - $today) / 86400));
    }
}

// Initials for the customer avatar chip
$customerInitials = 'CU';
if (!empty($project->customer_name)) {
    $parts = preg_split('/\s+/', trim($project->customer_name));
    $letters = array_map(function ($p) {
        return mb_strtoupper(mb_substr($p, 0, 1));
    }, array_slice($parts, 0, 2));
    $customerInitials = implode('', $letters);
}
?>
<style>
    /* ============================================================
       DESIGN TOKENS
       ============================================================ */
    .page-wrapper {
        --pd-brand-50: #eefdfb;
        --pd-brand-100: #d5f6f0;
        --pd-brand-200: #aeecdf;
        --pd-brand-300: #78dcc9;
        --pd-brand-400: #3ec4ac;
        --pd-brand-500: #0fb4a0;
        --pd-brand-600: #0d9c8a;
        --pd-brand-700: #0b7d70;
        --pd-brand-800: #0a655b;
        --pd-brand-900: #08514a;

        --pd-ink-900: #0f172a;
        --pd-ink-800: #1e293b;
        --pd-ink-700: #334155;
        --pd-ink-600: #475569;
        --pd-ink-500: #64748b;
        --pd-ink-400: #94a3b8;
        --pd-ink-300: #cbd5e1;
        --pd-ink-200: #e2e8f0;
        --pd-ink-100: #f1f5f9;
        --pd-ink-50: #f8fafc;

        --pd-success-bg: #ecfdf5;
        --pd-success-fg: #047857;
        --pd-success-bd: #a7f3d0;
        --pd-warning-bg: #fffbeb;
        --pd-warning-fg: #b45309;
        --pd-warning-bd: #fde68a;
        --pd-danger-bg: #fef2f2;
        --pd-danger-fg: #b91c1c;
        --pd-danger-bd: #fecaca;
        --pd-info-bg: #eff6ff;
        --pd-info-fg: #1d4ed8;
        --pd-info-bd: #bfdbfe;
        --pd-brand-bg: #eefdfb;
        --pd-brand-fg: #0b7d70;
        --pd-brand-bd: #aeecdf;

        --pd-radius-xs: 8px;
        --pd-radius-sm: 12px;
        --pd-radius-md: 16px;
        --pd-radius-lg: 22px;
        --pd-radius-xl: 28px;

        --pd-shadow-sm: 0 1px 2px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.04);
        --pd-shadow-md: 0 4px 16px rgba(15, 23, 42, 0.07), 0 2px 6px rgba(15, 23, 42, 0.05);
        --pd-shadow-lg: 0 16px 40px rgba(15, 23, 42, 0.12), 0 4px 12px rgba(15, 23, 42, 0.06);
        --pd-shadow-brand: 0 12px 28px rgba(15, 180, 160, 0.22);

        --pd-font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;

        font-family: var(--pd-font);
        color: var(--pd-ink-800);
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }

    .page-wrapper * {
        box-sizing: border-box;
    }

    /* ============================================================
       LAYOUT SHELL
       ============================================================ */
    .pd-wrapper {
        background:
            radial-gradient(circle at 100% 0%, rgba(15, 180, 160, 0.06), transparent 45%),
            radial-gradient(circle at 0% 100%, rgba(15, 180, 160, 0.05), transparent 40%),
            var(--pd-ink-50);
        min-height: 100%;
        padding: 36px clamp(16px, 4vw, 48px) 64px;
    }

    .pd-container {
        max-width: 1280px;
        margin: 0 auto;
    }

    /* ============================================================
       BREADCRUMB
       ============================================================ */
    .pd-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 500;
        color: var(--pd-ink-500);
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .pd-breadcrumb a {
        color: var(--pd-ink-500);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .pd-breadcrumb a:hover {
        color: var(--pd-brand-600);
    }

    .pd-breadcrumb .pd-crumb-sep {
        color: var(--pd-ink-300);
        display: inline-flex;
    }

    .pd-breadcrumb .pd-crumb-current {
        color: var(--pd-ink-800);
        font-weight: 600;
    }

    /* ============================================================
       HERO / HEADER CARD
       ============================================================ */
    .pd-hero {
        position: relative;
        border-radius: var(--pd-radius-xl);
        overflow: hidden;
        background: linear-gradient(135deg, #0d9c8a 0%, #0fb4a0 45%, #14c9b3 100%);
        box-shadow: var(--pd-shadow-lg);
        margin-bottom: 28px;
    }

    .pd-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 15% 20%, rgba(255, 255, 255, 0.10) 0%, transparent 32%),
            radial-gradient(circle at 85% 0%, rgba(255, 255, 255, 0.12) 0%, transparent 40%),
            radial-gradient(circle at 95% 90%, rgba(0, 0, 0, 0.08) 0%, transparent 45%);
        pointer-events: none;
    }

    .pd-hero::after {
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

    .pd-hero-inner {
        position: relative;
        z-index: 1;
        padding: 36px clamp(20px, 4vw, 44px) 30px;
    }

    .pd-hero-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .pd-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.82);
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.22);
        padding: 6px 12px;
        border-radius: 999px;
        margin-bottom: 14px;
        backdrop-filter: blur(6px);
    }

    .pd-hero-eyebrow svg {
        width: 13px;
        height: 13px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.4;
    }

    .pd-hero h1 {
        color: #ffffff;
        font-size: clamp(24px, 3vw, 34px);
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.15;
        margin: 0 0 8px;
    }

    .pd-hero-sub {
        color: rgba(255, 255, 255, 0.85);
        font-size: 14.5px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pd-hero-sub svg {
        width: 15px;
        height: 15px;
        stroke: rgba(255, 255, 255, 0.85);
        fill: none;
        stroke-width: 2.2;
    }

    .pd-hero-status {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    .pd-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.02em;
        background: rgba(255, 255, 255, 0.16);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(6px);
    }

    .pd-status-pill .pd-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        animation: pd-pulse 2s ease-in-out infinite;
        flex-shrink: 0;
    }

    @keyframes pd-pulse {

        0%,
        100% {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25);
        }

        50% {
            box-shadow: 0 0 0 6px rgba(255, 255, 255, 0.1);
        }
    }

    .pd-project-id {
        font-size: 12px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.7);
        letter-spacing: 0.04em;
    }

    /* ---- Progress bar within hero ---- */
    .pd-hero-progress {
        margin-top: 26px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--pd-radius-md);
        padding: 16px 20px;
        backdrop-filter: blur(6px);
    }

    .pd-hero-progress-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
        flex-wrap: wrap;
        gap: 6px;
    }

    .pd-hero-progress-label {
        font-size: 12.5px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.9);
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }

    .pd-hero-progress-value {
        font-size: 13px;
        font-weight: 700;
        color: #ffffff;
    }

    .pd-progress-track {
        position: relative;
        height: 9px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.22);
        overflow: hidden;
    }

    .pd-progress-fill {
        position: absolute;
        inset: 0;
        width: var(--pd-progress, 0%);
        border-radius: 999px;
        background: linear-gradient(90deg, #ffffff 0%, #eafff9 100%);
        box-shadow: 0 0 12px rgba(255, 255, 255, 0.55);
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .pd-hero-progress-foot {
        display: flex;
        justify-content: space-between;
        margin-top: 8px;
        font-size: 11.5px;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.75);
    }

    /* ============================================================
       INFO STAT GRID
       ============================================================ */
    .pd-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 30px;
    }

    .pd-stat-card {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--pd-ink-200);
        border-radius: var(--pd-radius-lg);
        box-shadow: var(--pd-shadow-sm);
        padding: 20px 20px 18px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.25s ease;
        opacity: 0;
        transform: translateY(14px);
        animation: pd-rise 0.55s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .pd-stat-card:nth-child(1) {
        animation-delay: 0.02s;
    }

    .pd-stat-card:nth-child(2) {
        animation-delay: 0.08s;
    }

    .pd-stat-card:nth-child(3) {
        animation-delay: 0.14s;
    }

    .pd-stat-card:nth-child(4) {
        animation-delay: 0.2s;
    }

    @keyframes pd-rise {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .pd-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--pd-shadow-md);
        border-color: var(--pd-brand-200);
    }

    .pd-stat-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pd-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--pd-radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--pd-brand-50);
        color: var(--pd-brand-600);
        flex-shrink: 0;
    }

    .pd-stat-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.1;
    }

    .pd-stat-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: var(--pd-ink-500);
    }

    .pd-stat-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--pd-ink-900);
        letter-spacing: -0.2px;
        line-height: 1.3;
        word-break: break-word;
    }

    .pd-stat-foot {
        font-size: 12px;
        font-weight: 600;
        color: var(--pd-ink-400);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .pd-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
    }

    .pd-chip svg {
        width: 12px;
        height: 12px;
    }

    .pd-tone-success {
        background: var(--pd-success-bg);
        color: var(--pd-success-fg);
        border: 1px solid var(--pd-success-bd);
    }

    .pd-tone-warning {
        background: var(--pd-warning-bg);
        color: var(--pd-warning-fg);
        border: 1px solid var(--pd-warning-bd);
    }

    .pd-tone-danger {
        background: var(--pd-danger-bg);
        color: var(--pd-danger-fg);
        border: 1px solid var(--pd-danger-bd);
    }

    .pd-tone-info {
        background: var(--pd-info-bg);
        color: var(--pd-info-fg);
        border: 1px solid var(--pd-info-bd);
    }

    .pd-tone-brand {
        background: var(--pd-brand-bg);
        color: var(--pd-brand-fg);
        border: 1px solid var(--pd-brand-bd);
    }

    /* Avatar chip for the customer stat */
    .pd-avatar {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--pd-brand-500), var(--pd-brand-700));
        color: #fff;
        font-size: 12.5px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0.02em;
        box-shadow: 0 6px 14px rgba(15, 180, 160, 0.3);
        flex-shrink: 0;
    }

    /* ============================================================
       LOCKED-STATE BANNER
       ============================================================ */
    .pd-alert {
        display: flex;
        align-items: center;
        gap: 14px;
        background: linear-gradient(135deg, #fffbeb, #fff7e6);
        border: 1px solid var(--pd-warning-bd);
        border-radius: var(--pd-radius-md);
        padding: 16px 20px;
        margin-bottom: 26px;
        box-shadow: var(--pd-shadow-sm);
    }

    .pd-alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--pd-warning-fg);
        background: linear-gradient(135deg, #f59e0b, #d97706);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 6px 16px rgba(217, 119, 6, 0.3);
    }

    .pd-alert-icon svg {
        width: 20px;
        height: 20px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.3;
    }

    .pd-alert-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #92400e;
        margin: 0 0 2px;
    }

    .pd-alert-text {
        font-size: 13px;
        font-weight: 500;
        color: #a16207;
        margin: 0;
    }

    .pd-alert-cta {
        margin-left: auto;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        border: 1px solid var(--pd-warning-bd);
        color: #92400e;
        font-weight: 700;
        font-size: 13px;
        padding: 9px 16px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .pd-alert-cta:hover {
        background: #92400e;
        color: #ffffff;
        border-color: #92400e;
    }

    /* ============================================================
       SECTION HEADINGS
       ============================================================ */
    .pd-section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pd-section-title {
        font-size: 17px;
        font-weight: 800;
        color: var(--pd-ink-900);
        letter-spacing: -0.3px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }

    .pd-section-title .pd-section-dot {
        width: 8px;
        height: 20px;
        border-radius: 4px;
        background: linear-gradient(180deg, var(--pd-brand-400), var(--pd-brand-700));
        display: inline-block;
    }

    .pd-section-hint {
        font-size: 12.5px;
        font-weight: 500;
        color: var(--pd-ink-400);
    }

    /* ============================================================
       ACTION / FEATURE CARDS
       ============================================================ */
    .pd-action-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 34px;
    }

    .pd-action-card {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--pd-ink-200);
        border-radius: var(--pd-radius-lg);
        box-shadow: var(--pd-shadow-sm);
        padding: 26px 22px;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.3s ease;
        opacity: 0;
        transform: translateY(18px);
        animation: pd-rise 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .pd-action-card:nth-child(1) {
        animation-delay: 0.03s;
    }

    .pd-action-card:nth-child(2) {
        animation-delay: 0.08s;
    }

    .pd-action-card:nth-child(3) {
        animation-delay: 0.13s;
    }

    .pd-action-card:nth-child(4) {
        animation-delay: 0.18s;
    }

    .pd-action-card:nth-child(5) {
        animation-delay: 0.23s;
    }

    .pd-action-card:nth-child(6) {
        animation-delay: 0.28s;
    }

    .pd-action-card:nth-child(7) {
        animation-delay: 0.33s;
    }

    .pd-action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--pd-brand-400), var(--pd-brand-700));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .pd-action-card::after {
        content: '';
        position: absolute;
        right: -30px;
        bottom: -30px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--pd-brand-50);
        opacity: 0;
        transition: opacity 0.35s ease, transform 0.35s ease;
        transform: scale(0.7);
        z-index: 0;
    }

    .pd-action-card:hover {
        transform: translateY(-7px);
        box-shadow: var(--pd-shadow-brand);
        border-color: var(--pd-brand-200);
    }

    .pd-action-card:hover::before {
        transform: scaleX(1);
    }

    .pd-action-card:hover::after {
        opacity: 1;
        transform: scale(1);
    }

    .pd-action-icon {
        position: relative;
        z-index: 1;
        width: 54px;
        height: 54px;
        border-radius: var(--pd-radius-md);
        background: linear-gradient(135deg, var(--pd-brand-500), var(--pd-brand-700));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        box-shadow: 0 10px 22px rgba(15, 180, 160, 0.28);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pd-action-card:hover .pd-action-icon {
        transform: scale(1.08) rotate(-4deg);
        box-shadow: 0 14px 30px rgba(15, 180, 160, 0.4);
    }

    .pd-action-icon svg {
        width: 26px;
        height: 26px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2.1;
    }

    .pd-action-body {
        position: relative;
        z-index: 1;
    }

    .pd-action-card h5 {
        font-size: 15.5px;
        font-weight: 800;
        color: var(--pd-ink-900);
        margin: 0 0 5px;
        letter-spacing: -0.2px;
    }

    .pd-action-sub {
        font-size: 12.5px;
        color: var(--pd-ink-500);
        margin: 0;
        font-weight: 500;
        line-height: 1.4;
    }

    .pd-action-sub.pd-danger-text {
        color: var(--pd-danger-fg);
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pd-action-sub.pd-danger-text svg {
        width: 13px;
        height: 13px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.4;
        flex-shrink: 0;
    }

    .pd-action-arrow {
        position: relative;
        z-index: 1;
        margin-top: auto;
        align-self: flex-end;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--pd-ink-100);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .pd-action-arrow svg {
        width: 14px;
        height: 14px;
        stroke: var(--pd-ink-500);
        fill: none;
        stroke-width: 2.4;
        transition: stroke 0.3s ease;
    }

    .pd-action-card:hover .pd-action-arrow {
        background: var(--pd-brand-600);
        transform: translateX(3px);
    }

    .pd-action-card:hover .pd-action-arrow svg {
        stroke: #ffffff;
    }

    .pd-action-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 1;
        font-size: 10.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 4px 9px;
        border-radius: 999px;
        background: var(--pd-brand-50);
        color: var(--pd-brand-700);
        border: 1px solid var(--pd-brand-200);
    }

    /* ---- Disabled / locked card variant ---- */
    .pd-action-card.pd-locked {
        cursor: not-allowed;
        background: linear-gradient(180deg, #fafbfc, #f6f7f9);
        pointer-events: none;
    }

    .pd-action-card.pd-locked::before {
        display: none;
    }

    .pd-action-card.pd-locked::after {
        display: none;
    }

    .pd-action-card.pd-locked .pd-action-icon {
        background: linear-gradient(135deg, #b6bfc9, #98a3ae);
        box-shadow: 0 6px 14px rgba(15, 23, 42, 0.12);
    }

    .pd-action-card.pd-locked h5 {
        color: var(--pd-ink-500);
    }

    .pd-action-card.pd-locked .pd-action-arrow {
        background: var(--pd-ink-100);
    }

    .pd-action-card.pd-locked .pd-action-arrow svg {
        stroke: var(--pd-ink-300);
    }

    .pd-lock-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid var(--pd-ink-200);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .pd-lock-badge svg {
        width: 13px;
        height: 13px;
        stroke: var(--pd-ink-400);
        fill: none;
        stroke-width: 2.3;
    }

    /* ============================================================
       FOOTER NOTE
       ============================================================ */
    .pd-footnote {
        display: flex;
        align-items: center;
        gap: 8px;
        justify-content: center;
        font-size: 12px;
        font-weight: 500;
        color: var(--pd-ink-400);
        margin-top: 8px;
    }

    .pd-footnote svg {
        width: 13px;
        height: 13px;
        stroke: var(--pd-ink-400);
        fill: none;
        stroke-width: 2.2;
    }

    /* ============================================================
       RESPONSIVE
       ============================================================ */
    @media (max-width: 1180px) {
        .pd-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .pd-action-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .pd-wrapper {
            padding: 22px 14px 44px;
        }

        .pd-hero-inner {
            padding: 26px 18px 22px;
        }

        .pd-hero-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .pd-hero-status {
            align-items: flex-start;
        }

        .pd-stats-grid {
            grid-template-columns: 1fr;
        }

        .pd-action-grid {
            grid-template-columns: 1fr;
        }

        .pd-alert {
            flex-wrap: wrap;
        }

        .pd-alert-cta {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .page-wrapper * {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<div class="page-wrapper ">
    <div class="page-content">
        <div class="pd-wrapper">
            <div class="pd-container">

                <!-- ============================================
                     BREADCRUMB
                     ============================================ -->
                <nav class="pd-breadcrumb" aria-label="Breadcrumb">
                    <a href="<?= base_url('employee/dashboard') ?>">Dashboard</a>
                    <span class="pd-crumb-sep">
                        <svg viewBox="0 0 24 24" width="12" height="12">
                            <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <a href="<?= base_url('employee/projects') ?>">Projects</a>
                    <span class="pd-crumb-sep">
                        <svg viewBox="0 0 24 24" width="12" height="12">
                            <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span class="pd-crumb-current"><?= $project->project_name ?></span>
                </nav>

                <!-- ============================================
                     HERO HEADER
                     ============================================ -->
                <div class="pd-hero">
                    <div class="pd-hero-inner">

                        <div class="pd-hero-top">
                            <div>
                                <div class="pd-hero-eyebrow">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <path d="M14 2v6h6" />
                                    </svg>
                                    Project Overview
                                </div>

                                <h1><?= $project->project_name ?></h1>

                                <div class="pd-hero-sub">
                                    <svg viewBox="0 0 24 24">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
                                    </svg>
                                    <?= $project->customer_name ?>
                                </div>
                            </div>

                            <div class="pd-hero-status">
                                <span class="pd-status-pill">
                                    <span class="pd-dot"></span>
                                    <?= $statusInfo['label'] ?>
                                </span>
                                <span class="pd-project-id">PROJECT
                                    #<?= isset($project->id) ? str_pad($project->id, 4, '0', STR_PAD_LEFT) : '----' ?></span>
                            </div>
                        </div>

                        <?php if ($progressPct !== null) { ?>
                            <div class="pd-hero-progress" style="--pd-progress: <?= $progressPct ?>%;">
                                <div class="pd-hero-progress-top">
                                    <span class="pd-hero-progress-label">Timeline Progress</span>
                                    <span class="pd-hero-progress-value"><?= $progressPct ?>%</span>
                                </div>
                                <div class="pd-progress-track">
                                    <div class="pd-progress-fill"></div>
                                </div>
                                <div class="pd-hero-progress-foot">
                                    <span><?= $project->start_date ?></span>
                                    <span>
                                        <?php if ($daysLeft !== null) { ?>
                                            <?= $daysLeft > 0 ? $daysLeft . ' day' . ($daysLeft == 1 ? '' : 's') . ' remaining' : 'Due today' ?>
                                        <?php } ?>
                                    </span>
                                    <span><?= $project->end_date ?></span>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>

                <!-- ============================================
                     LOCKED-STATE ALERT (only when attendance not yet marked)
                     ============================================ -->
                <?php if ($locked) { ?>
                    <div class="pd-alert" role="alert">
                        <div class="pd-alert-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="4" y="10" width="16" height="10" rx="2" />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                            </svg>
                        </div>
                        <div>
                            <p class="pd-alert-title">Attendance not marked yet today</p>
                            <p class="pd-alert-text">Some tools are locked until you check in for today's site attendance.
                            </p>
                        </div>
                        <a href="<?= base_url('employee/add_attendance/' . $project->id) ?>" class="pd-alert-cta">
                            Mark Attendance
                            <svg viewBox="0 0 24 24" width="13" height="13">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.3" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                <?php } ?>

                <!-- ============================================
                     QUICK STATS GRID
                     ============================================ -->
                <div class="pd-section-head">
                    <h3 class="pd-section-title"><span class="pd-section-dot"></span> Project Snapshot</h3>
                    <span class="pd-section-hint">Key details at a glance</span>
                </div>

                <div class="pd-stats-grid">

                    <!-- Customer -->
                    <div class="pd-stat-card">
                        <div class="pd-stat-head">
                            <div class="pd-avatar"><?= $customerInitials ?></div>
                        </div>
                        <div>
                            <div class="pd-stat-label">Customer</div>
                            <div class="pd-stat-value"><?= $project->customer_name ?></div>
                        </div>
                        <div class="pd-stat-foot">
                            <svg viewBox="0 0 24 24" width="12" height="12">
                                <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2.4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Primary stakeholder
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="pd-stat-card">
                        <div class="pd-stat-head">
                            <div class="pd-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M12 7v5l3 3" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="pd-stat-label">Current Status</div>
                            <div class="pd-stat-value">
                                <span class="pd-chip pd-tone-<?= $statusInfo['tone'] ?>">
                                    <?= $statusInfo['label'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="pd-stat-foot">
                            <svg viewBox="0 0 24 24" width="12" height="12">
                                <path d="M12 8v4l3 2" stroke="currentColor" stroke-width="2.2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2.2" fill="none" />
                            </svg>
                            Updated automatically
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="pd-stat-card">
                        <div class="pd-stat-head">
                            <div class="pd-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M3 9h18" />
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="pd-stat-label">Start Date</div>
                            <div class="pd-stat-value"><?= $project->start_date ?></div>
                        </div>
                        <div class="pd-stat-foot">
                            <svg viewBox="0 0 24 24" width="12" height="12">
                                <path d="M5 12h14M5 12l4-4M5 12l4 4" stroke="currentColor" stroke-width="2.2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Kickoff milestone
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="pd-stat-card">
                        <div class="pd-stat-head">
                            <div class="pd-stat-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M3 9h18" />
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="pd-stat-label">End Date</div>
                            <div class="pd-stat-value"><?= $project->end_date ?></div>
                        </div>
                        <div class="pd-stat-foot">
                            <svg viewBox="0 0 24 24" width="12" height="12">
                                <path d="M19 12H5m0 0l4-4m-4 4l4 4" stroke="currentColor" stroke-width="2.2" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <?php if ($daysLeft !== null) { ?>
                                Target completion
                            <?php } else { ?>
                                Scheduled finish
                            <?php } ?>
                        </div>
                    </div>

                </div>

<<<<<<< HEAD
                <!-- ============================================
                     ACTIONS / FEATURE CARDS
                     ============================================ -->
                <div class="pd-section-head">
                    <h3 class="pd-section-title"><span class="pd-section-dot"></span> Site Tools</h3>
                    <span
                        class="pd-section-hint"><?= $locked ? 'Mark attendance to unlock all tools' : 'All tools unlocked for today' ?></span>
                </div>

                <div class="pd-action-grid">

                    <!-- Add Attendance -->
                    <a href="<?= base_url('employee/add_attendance/' . $project->id) ?>" class="pd-action-card">
                        <?php if (!$locked) { ?><span class="pd-action-badge">Done</span><?php } ?>
                        <div class="pd-action-icon">
=======
            </div>

            <div class="xc-feature-row">

                <?php
                $locked = empty($attendance_today);
                ?><div style="flex:1 1 220px;min-width:200px;">

<a href="<?= base_url('employee/add_attendance/'.$project->id) ?>"
class="xc-feature-card">

<div class="xc-feature-icon">
✓
</div>

<h5>Add Attendance</h5>

<div class="xc-feature-sub">
Mark Today's Attendance
</div>

</a>

</div>

                <div style="flex: 1 1 220px; min-width: 200px;">
                    <a href="<?= base_url('employee/attendance_list/' . $project->id) ?>"
                        class="xc-feature-card">

                        <div class="xc-feature-icon">📋</div>

                        <h5>Attendance List</h5>

                        <div class="xc-feature-sub">
                            View attendance history
                        </div>

                    </a>
                </div>

                <!-- Project Details -->
                <div style="flex: 1 1 220px; min-width: 200px;">
                    <a href="<?= base_url('employee/project_info/' . $project->id) ?>"
                        class="xc-feature-card">
                        <div class="xc-feature-icon">
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                            <svg viewBox="0 0 24 24">
                                <path d="M20 6L9 17l-5-5" stroke="#fff" stroke-width="2.4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="pd-action-body">
                            <h5>Add Attendance</h5>
                            <p class="pd-action-sub">Mark today's attendance</p>
                        </div>
                        <div class="pd-action-arrow">
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>

<<<<<<< HEAD
                    <!-- Attendance List -->
                    <a href="<?= base_url('employee/attendance_list/' . $project->id) ?>" class="pd-action-card">
                        <div class="pd-action-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M9 6h11M9 12h11M9 18h11" stroke="#fff" stroke-width="2.2" fill="none"
                                    stroke-linecap="round" />
                                <circle cx="4.5" cy="6" r="1.6" fill="#fff" />
                                <circle cx="4.5" cy="12" r="1.6" fill="#fff" />
                                <circle cx="4.5" cy="18" r="1.6" fill="#fff" />
                            </svg>
                        </div>
                        <div class="pd-action-body">
                            <h5>Attendance List</h5>
                            <p class="pd-action-sub">View attendance history</p>
                        </div>
                        <div class="pd-action-arrow">
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>

                    <!-- Project Details -->
                    <a href="<?= base_url('employee/project_info/' . $project->id) ?>" class="pd-action-card">
                        <div class="pd-action-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <path d="M14 2v6h6" />
                                <path d="M9 13h6" />
                                <path d="M9 17h6" />
                            </svg>
                        </div>
                        <div class="pd-action-body">
                            <h5>Project Details</h5>
                            <p class="pd-action-sub">View full information</p>
                        </div>
                        <div class="pd-action-arrow">
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>

                    <!-- Manpower Report (always available) -->
                    <a href="<?= base_url('employee/manpower_report/' . $project->id) ?>" class="pd-action-card">
                        <div class="pd-action-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="9" cy="7" r="3" />
                                <path d="M2 20c0-3.3 3-5 7-5s7 1.7 7 5" />
                                <circle cx="17" cy="8" r="2.4" />
                                <path d="M22 20c0-2.5-1.8-4-4-4.4" />
                            </svg>
                        </div>
                        <div class="pd-action-body">
                            <h5>Manpower Report</h5>
                            <p class="pd-action-sub">View manpower deployment</p>
                        </div>
                        <div class="pd-action-arrow">
                            <svg viewBox="0 0 24 24">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>

                    <!-- Capture Images -->
                    <?php if (!$locked) { ?>
                        <a href="<?= base_url('employee/capture_images/' . $project->id) ?>" class="pd-action-card">
                            <div class="pd-action-icon">
=======
                <!-- Capture Images (quick action) -->
                <!-- <div style="flex: 1 1 220px; min-width: 200px;">
                        <a href="<?= base_url('employee/capture_images/' . $project->id) ?>"
                            class="xc-quick-btn">
                            <div class="xc-feature-icon">
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                                <svg viewBox="0 0 24 24">
                                    <path
                                        d="M4 8a2 2 0 0 1 2-2h1.5l1-1.5h7l1 1.5H18a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                                    <circle cx="12" cy="13" r="3.5" />
                                </svg>
                            </div>
                            <div class="pd-action-body">
                                <h5>Capture Images</h5>
                                <p class="pd-action-sub">Quick site capture</p>
                            </div>
<<<<<<< HEAD
                            <div class="pd-action-arrow">
=======

                        </a>

                    <?php } else { ?>

                        <div class="xc-feature-card xc-disabled">

                            <div class="xc-feature-icon">📷</div>

                            <h5>Capture Images</h5>

                            <div class="xc-feature-sub text-danger">
                                Mark Attendance First
                            </div>

                        </div>

                    <?php } ?>

                </div>

                <!-- Summary of Project -->
                <div style="flex:1 1 220px;min-width:200px;">

                    <?php if (!$locked) { ?>

                        <a href="<?= base_url('employee/materials_report/' . $project->id) ?>" class="xc-feature-card">

                            <div class="xc-feature-icon">
                                📑
                            </div>

                            <h5>Material Report</h5>

                            <div class="xc-feature-sub">
                                View Material Report
                            </div>

                        </a>

                    <?php } else { ?>

                        <div class="xc-feature-card xc-disabled">

                            <div class="xc-feature-icon">
                                📑
                            </div>

                            <h5>Material Report</h5>

                            <div class="xc-feature-sub text-danger">
                                Mark Attendance First
                            </div>

                        </div>

                    <?php } ?>

                </div>

                <!-- View Images -->
                <div style="flex: 1 1 220px; min-width: 200px;">

                    <?php if (!$locked) { ?>

                        <a href="<?= base_url('employee/view_images/' . $project->id) ?>" class="xc-feature-card">

                        <?php } else { ?>

                            <div class="xc-feature-card xc-disabled">

                            <?php } ?>
                            <div class="xc-feature-icon">
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
<<<<<<< HEAD
                        </a>
                    <?php } else { ?>
                        <div class="pd-action-card pd-locked">
                            <span class="pd-lock-badge">
                                <svg viewBox="0 0 24 24">
                                    <rect x="4" y="10" width="16" height="10" rx="2" />
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                </svg>
                            </span>
                            <div class="pd-action-icon">
                                <svg viewBox="0 0 24 24">
                                    <path
                                        d="M4 8a2 2 0 0 1 2-2h1.5l1-1.5h7l1 1.5H18a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z" />
                                    <circle cx="12" cy="13" r="3.5" />
                                </svg>
                            </div>
                            <div class="pd-action-body">
                                <h5>Capture Images</h5>
                                <p class="pd-action-sub pd-danger-text">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="4" y="10" width="16" height="10" rx="2" />
                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                    </svg>
                                    Mark attendance first
                                </p>
                            </div>
=======
                            <h5>View Images</h5>
                            <div class="xc-feature-sub">Browse captured photos</div>
                    </a>
                </div>
                <!-- Material Request -->

                <div style="flex: 1 1 220px; min-width: 200px;">

                    <a href="<?= base_url('employee/material_request/' . $project->id) ?>"
                        class="xc-feature-card">

                        <div class="xc-feature-icon">
                            📦
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                        </div>
                    <?php } ?>

                    <!-- Material Report -->
                    <?php if (!$locked) { ?>
                        <a href="<?= base_url('employee/materials_report/' . $project->id) ?>" class="pd-action-card">
                            <div class="pd-action-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M8 2h8l4 4v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" />
                                    <path d="M16 2v4h4" />
                                    <path d="M9 13h6M9 17h6M9 9h2" />
                                </svg>
                            </div>
                            <div class="pd-action-body">
                                <h5>Material Report</h5>
                                <p class="pd-action-sub">View material usage report</p>
                            </div>
                            <div class="pd-action-arrow">
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="pd-action-card pd-locked">
                            <span class="pd-lock-badge">
                                <svg viewBox="0 0 24 24">
                                    <rect x="4" y="10" width="16" height="10" rx="2" />
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                </svg>
                            </span>
                            <div class="pd-action-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M8 2h8l4 4v14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" />
                                    <path d="M16 2v4h4" />
                                    <path d="M9 13h6M9 17h6M9 9h2" />
                                </svg>
                            </div>
                            <div class="pd-action-body">
                                <h5>Material Report</h5>
                                <p class="pd-action-sub pd-danger-text">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="4" y="10" width="16" height="10" rx="2" />
                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                    </svg>
                                    Mark attendance first
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- View Images -->
                    <?php if (!$locked) { ?>
                        <a href="<?= base_url('employee/view_images/' . $project->id) ?>" class="pd-action-card">
                            <div class="pd-action-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="M21 15l-5-5L5 21" />
                                </svg>
                            </div>
                            <div class="pd-action-body">
                                <h5>View Images</h5>
                                <p class="pd-action-sub">Browse captured photos</p>
                            </div>
                            <div class="pd-action-arrow">
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2.4" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="pd-action-card pd-locked">
                            <span class="pd-lock-badge">
                                <svg viewBox="0 0 24 24">
                                    <rect x="4" y="10" width="16" height="10" rx="2" />
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                </svg>
                            </span>
                            <div class="pd-action-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="M21 15l-5-5L5 21" />
                                </svg>
                            </div>
                            <div class="pd-action-body">
                                <h5>View Images</h5>
                                <p class="pd-action-sub pd-danger-text">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="4" y="10" width="16" height="10" rx="2" />
                                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                                    </svg>
                                    Mark attendance first
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                </div>



            </div>
        </div>
    </div>
</div>
