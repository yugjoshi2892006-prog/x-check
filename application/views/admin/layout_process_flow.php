<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap');

    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0c9484;
        --xc-teal-light: #e5faf6;
        --xc-navy: #1a1a2e;
        --xc-navy-soft: #2b2b45;
        --xc-orange: #f97316;
        --xc-orange-dark: #ea6a0c;
        --xc-orange-light: #fff2e8;
        --xc-purple: #7c3aed;
        --xc-purple-dark: #6d28d9;
        --xc-purple-light: #f4edfe;

        --xc-success: #0fb4a0;
        --xc-success-light: #e5faf6;
        --xc-warning: #f97316;
        --xc-warning-light: #fff2e8;
        --xc-danger: #ef4444;
        --xc-danger-light: #fee2e2;

        --xc-gray-50: #f8f9fb;
        --xc-gray-100: #f1f2f6;
        --xc-gray-200: #e4e6ee;
        --xc-gray-300: #d3d6e0;
        --xc-gray-400: #a4a8ba;
        --xc-gray-500: #7c8093;
        --xc-gray-600: #5a5e70;
        --xc-gray-700: #3f4256;
        --xc-gray-800: #292c3f;
        --xc-gray-900: var(--xc-navy);

        --xc-font-heading: 'Sora', sans-serif;
        --xc-font-body: 'DM Sans', sans-serif;
        --xc-font-mono: 'JetBrains Mono', monospace;

        --xc-shadow-sm: 0 1px 2px rgba(26, 26, 46, 0.06);
        --xc-shadow: 0 4px 14px rgba(26, 26, 46, 0.07);
        --xc-shadow-md: 0 8px 24px rgba(26, 26, 46, 0.09);
        --xc-shadow-lg: 0 16px 40px rgba(26, 26, 46, 0.12);
        --xc-shadow-xl: 0 20px 50px rgba(26, 26, 46, 0.16);
    }

    .page-content {
        font-family: var(--xc-font-body);
    }

    /* Alerts */
    .alert-modern {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-radius: 12px;
        border: none;
        font-weight: 500;
        margin-bottom: 24px;
        box-shadow: var(--xc-shadow-md);
        animation: slideInDown 0.4s ease-out;
    }

    .alert-modern i {
        font-size: 24px;
    }

    .alert-success {
        background: linear-gradient(135deg, var(--xc-success-light) 0%, #fff 100%);
        color: #096e62;
        border-left: 4px solid var(--xc-success);
    }

    .alert-danger {
        background: linear-gradient(135deg, var(--xc-danger-light) 0%, #fff 100%);
        color: #b91c1c;
        border-left: 4px solid var(--xc-danger);
    }

    /* Header */
    .xc-flow-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        padding: 24px;
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
        border-radius: 16px;
        color: white;
        box-shadow: 0 16px 40px rgba(15, 180, 160, 0.24);
        flex-wrap: wrap;
        gap: 20px;
    }

    .xc-flow-head-content {
        flex: 1;
        min-width: 300px;
    }

    .xc-flow-title-wrapper {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .xc-flow-icon-wrapper {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
        flex-shrink: 0;
    }

    .xc-flow-icon-wrapper i {
        font-size: 28px;
        color: white;
    }

    .xc-flow-title {
        margin: 0;
        font-family: var(--xc-font-heading);
        font-size: 24px;
        font-weight: 700;
        color: white;
    }

    .xc-flow-sub {
        margin: 8px 0 0 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        opacity: 0.95;
    }

    .xc-flow-badge {
        background: rgba(255, 255, 255, 0.25);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .xc-flow-sub i {
        font-size: 18px;
        opacity: .85;
    }

    .xc-flow-count {
        margin: 10px 0 0 0;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        opacity: .9;
    }

    .xc-flow-count i {
        font-size: 16px;
    }

    .xc-flow-head-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Select */
    .xc-select-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .xc-select-wrapper i {
        position: absolute;
        left: 14px;
        font-size: 18px;
        color: var(--xc-gray-500);
        pointer-events: none;
        z-index: 1;
    }

    .xc-scope-select {
        padding: 10px 16px 10px 42px;
        border: 2px solid var(--xc-gray-200);
        border-radius: 10px;
        font-family: var(--xc-font-body);
        font-size: 14px;
        font-weight: 500;
        color: var(--xc-navy);
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 200px;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-scope-select:hover {
        border-color: var(--xc-teal);
    }

    .xc-scope-select:focus,
    .xc-scope-select:focus-visible {
        outline: none;
        border-color: var(--xc-teal);
        box-shadow: 0 0 0 3px var(--xc-teal-light);
    }

    /* Buttons */
    .xc-btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-family: var(--xc-font-body);
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        border: 2px solid transparent;
        cursor: pointer;
        white-space: nowrap;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-btn-sm i {
        font-size: 18px;
    }

    .xc-btn-sm:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px var(--xc-teal-light), var(--xc-shadow-sm);
    }

    /* On the gradient header, outline = white pill */
    .xc-flow-head-actions .xc-btn-outline {
        background: white;
        color: var(--xc-teal-dark);
        border-color: white;
    }

    .xc-flow-head-actions .xc-btn-outline:hover {
        background: var(--xc-teal-light);
        transform: translateY(-2px);
        box-shadow: var(--xc-shadow-md);
        color: var(--xc-teal-dark);
    }

    /* On white cards, outline = teal-bordered ghost */
    .xc-flow-card .xc-btn-outline {
        background: white;
        color: var(--xc-teal-dark);
        border-color: var(--xc-teal-light);
        box-shadow: none;
    }

    .xc-flow-card .xc-btn-outline:hover {
        background: var(--xc-teal-light);
        border-color: var(--xc-teal);
        transform: translateY(-2px);
    }

    .xc-btn-ghost {
        background: transparent;
        color: var(--xc-gray-600);
        border-color: var(--xc-gray-200);
        box-shadow: none;
    }

    .xc-btn-ghost:hover {
        color: var(--xc-navy);
        border-color: var(--xc-gray-300);
        background: var(--xc-gray-50);
    }

    /* Stats row */
    .xc-stats-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .xc-stat-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        background: white;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-stat-chip i {
        font-size: 16px;
    }

    .xc-stat-chip.is-green {
        color: #096e62;
    }

    .xc-stat-chip.is-green i {
        color: var(--xc-teal);
    }

    .xc-stat-chip.is-orange {
        color: var(--xc-orange-dark);
    }

    .xc-stat-chip.is-orange i {
        color: var(--xc-orange);
    }

    .xc-stat-chip.is-red {
        color: #991b1b;
    }

    .xc-stat-chip.is-red i {
        color: var(--xc-danger);
    }

    .xc-stat-chip.is-gray {
        color: var(--xc-gray-600);
    }

    .xc-stat-chip.is-gray i {
        color: var(--xc-gray-400);
    }

    /* Progress */
    .xc-progress-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .xc-progress-wrap {
        background: white;
        border-radius: 12px;
        padding: 14px 18px;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-progress-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        color: var(--xc-gray-500);
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 8px;
    }

    .xc-progress-top b {
        font-family: var(--xc-font-heading);
        font-size: 13px;
        color: var(--xc-navy);
        text-transform: none;
        letter-spacing: normal;
    }

    .xc-progress-track {
        height: 8px;
        border-radius: 999px;
        background: var(--xc-gray-100);
        overflow: hidden;
    }

    .xc-progress-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--xc-teal), var(--xc-teal-dark));
        transition: width .5s ease;
    }

    .xc-progress-fill.is-purple {
        background: linear-gradient(90deg, var(--xc-purple), var(--xc-purple-dark));
    }

    /* Flow container */
    .xc-flow-container {
        background: var(--xc-gray-50);
        border-radius: 16px;
        padding: 24px;
    }

    .xc-flow-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .xc-flow-item {
        display: flex;
        gap: 24px;
        position: relative;
        margin-bottom: 24px;
        animation: fadeInUp 0.5s ease-out backwards;
    }

    .xc-flow-item:last-child {
        margin-bottom: 0;
    }

    .xc-flow-item.done .xc-flow-line {
        background: linear-gradient(180deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
    }

    /* Rail */
    .xc-flow-rail {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex-shrink: 0;
    }

    .xc-flow-dot {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        z-index: 2;
        box-shadow: var(--xc-shadow-lg);
        transition: transform 0.2s ease;
    }

    .xc-flow-dot i {
        color: white;
    }

    .xc-flow-dot.st-locked {
        background: linear-gradient(135deg, var(--xc-purple) 0%, var(--xc-purple-dark) 100%);
    }

    .xc-flow-dot.st-not-started {
        background: linear-gradient(135deg, var(--xc-gray-300) 0%, var(--xc-gray-400) 100%);
    }

    .xc-flow-dot.st-pending {
        background: linear-gradient(135deg, var(--xc-orange) 0%, var(--xc-orange-dark) 100%);
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .xc-flow-dot.st-remarked {
        background: linear-gradient(135deg, var(--xc-danger) 0%, #dc2626 100%);
    }

    .xc-flow-dot.st-approved {
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
    }

    .xc-flow-line {
        width: 4px;
        flex: 1;
        min-height: 60px;
        background: var(--xc-gray-200);
        margin-top: 8px;
        border-radius: 2px;
        transition: background 0.5s ease;
    }

    /* Card */
    .xc-flow-card {
        flex: 1;
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--xc-shadow-md);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        border: 2px solid transparent;
    }

    .xc-flow-card:not(.locked):hover {
        transform: translateY(-4px);
        box-shadow: var(--xc-shadow-xl);
        border-color: var(--xc-teal-light);
    }

    .xc-flow-card.locked {
        opacity: 0.6;
        background: var(--xc-gray-50);
    }

    .xc-flow-card.approved {
        border-color: var(--xc-teal-light);
        background: linear-gradient(135deg, #fff 0%, var(--xc-teal-light) 100%);
    }

    .xc-flow-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 16px;
    }

    .xc-flow-stage-wrapper {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .xc-stage-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--xc-teal-light) 0%, #fff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-stage-icon i {
        font-size: 22px;
        color: var(--xc-teal-dark);
    }

    .xc-flow-stage {
        font-family: var(--xc-font-heading);
        font-size: 18px;
        font-weight: 700;
        color: var(--xc-navy);
        margin-bottom: 6px;
    }

    .xc-flow-member {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: var(--xc-gray-600);
    }

    .xc-avatar {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 800;
        color: #fff;
        background: linear-gradient(135deg, var(--xc-purple), var(--xc-purple-dark));
    }

    .xc-avatar.unassigned {
        background: white;
        border: 1.5px dashed var(--xc-gray-300);
        color: var(--xc-gray-400);
        font-size: 13px;
    }

    .text-muted {
        color: var(--xc-gray-400);
        font-style: italic;
    }

    /* Pills */
    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-pill-sm {
        padding: 4px 12px;
        font-size: 12px;
    }

    .xc-pill i {
        font-size: 14px;
    }

    .xc-pill-gray {
        background: var(--xc-gray-100);
        color: var(--xc-gray-700);
    }

    .xc-pill-green {
        background: var(--xc-teal-light);
        color: #096e62;
    }

    .xc-pill-orange {
        background: var(--xc-orange-light);
        color: var(--xc-orange-dark);
    }

    .xc-pill-red {
        background: var(--xc-danger-light);
        color: #991b1b;
    }

    /* Approval section */
    .xc-approval-section {
        background: var(--xc-gray-50);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .xc-approval-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: var(--xc-gray-700);
        margin-bottom: 12px;
    }

    .xc-approval-title i {
        font-size: 18px;
        color: var(--xc-teal);
    }

    .xc-approval-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
    }

    .xc-approval-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .xc-approval-label {
        font-family: var(--xc-font-mono);
        font-size: 11px;
        font-weight: 600;
        color: var(--xc-gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Wait / handoff notes */
    .xc-wait-note,
    .xc-handoff-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.5;
        background: var(--xc-gray-50);
        color: var(--xc-gray-600);
        margin-bottom: 4px;
    }

    .xc-wait-note i,
    .xc-handoff-note i {
        font-size: 16px;
        margin-top: 1px;
        color: var(--xc-gray-400);
        flex-shrink: 0;
    }

    .xc-handoff-note {
        margin-top: 4px;
        margin-bottom: 16px;
        background: var(--xc-orange-light);
        color: var(--xc-orange-dark);
    }

    .xc-handoff-note i {
        color: var(--xc-orange);
    }

    .xc-handoff-note.is-done {
        background: var(--xc-teal-light);
        color: #096e62;
    }

    .xc-handoff-note.is-done i {
        color: var(--xc-teal);
    }

    .xc-handoff-note a {
        color: inherit;
        font-weight: 700;
        text-decoration: underline;
    }

    /* Actions */
    .xc-flow-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    /* Parallel section */
    .xc-parallel-section {
        margin-top: 32px;
    }

    .xc-parallel-heading {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        background: linear-gradient(135deg, #fff 0%, var(--xc-purple-light) 100%);
        border-radius: 12px;
        margin-bottom: 24px;
        border-left: 4px solid var(--xc-purple);
        box-shadow: var(--xc-shadow-md);
    }

    .xc-parallel-icon {
        width: 48px;
        height: 48px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--xc-shadow-sm);
        flex-shrink: 0;
    }

    .xc-parallel-icon i {
        font-size: 24px;
        color: var(--xc-purple);
    }

    .xc-parallel-heading h5 {
        margin: 0;
        font-family: var(--xc-font-heading);
        font-size: 18px;
        font-weight: 700;
        color: var(--xc-navy);
    }

    .xc-parallel-heading p {
        margin: 4px 0 0 0;
        font-size: 14px;
        color: var(--xc-gray-600);
    }

    .xc-parallel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 20px;
    }

    .xc-parallel-card-wrapper {
        animation: fadeInUp 0.5s ease-out backwards;
    }

    /* Empty state */
    .xc-empty-flow {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: var(--xc-shadow-md);
    }

    .xc-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--xc-gray-100) 0%, var(--xc-gray-200) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .xc-empty-icon i {
        font-size: 40px;
        color: var(--xc-gray-400);
    }

    .xc-empty-flow h5 {
        font-family: var(--xc-font-heading);
        font-size: 20px;
        font-weight: 700;
        color: var(--xc-navy);
        margin: 0 0 8px 0;
    }

    .xc-empty-flow p {
        font-size: 14px;
        color: var(--xc-gray-600);
        margin: 0;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .xc-flow-item,
        .xc-parallel-card-wrapper,
        .alert-modern,
        .xc-flow-dot.st-pending {
            animation: none !important;
        }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .xc-parallel-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .xc-flow-head {
            flex-direction: column;
            align-items: stretch;
        }

        .xc-flow-head-actions {
            justify-content: stretch;
            flex-direction: column;
        }

        .xc-scope-select {
            width: 100%;
        }

        .xc-progress-grid {
            grid-template-columns: 1fr;
        }

        .xc-flow-item {
            gap: 16px;
        }

        .xc-flow-dot {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .xc-flow-card {
            padding: 16px;
        }

        .xc-parallel-grid {
            grid-template-columns: 1fr;
        }

        .xc-approval-grid {
            grid-template-columns: 1fr;
        }

        .xc-flow-actions {
            flex-direction: column;
        }

        .xc-flow-actions .xc-btn-sm {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .xc-flow-title {
            font-size: 20px;
        }

        .xc-flow-sub {
            font-size: 12px;
        }

        .xc-flow-badge {
            font-size: 11px;
            padding: 3px 10px;
        }

        .xc-parallel-heading {
            flex-direction: column;
            text-align: center;
        }

        .xc-stats-row {
            gap: 8px;
        }

        .xc-stat-chip {
            font-size: 12px;
            padding: 8px 12px;
        }
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-modern">
                <i class="bx bx-check-circle"></i>
                <span><?= $this->session->flashdata('success'); ?></span>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-modern">
                <i class="bx bx-error-circle"></i>
                <span><?= $this->session->flashdata('error'); ?></span>
            </div>
        <?php } ?>

        <div class="xc-flow-head">
            <div class="xc-flow-head-content">
                <div class="xc-flow-title-wrapper">
                    <div class="xc-flow-icon-wrapper">
                        <i class="bx bx-git-branch"></i>
                    </div>
                    <div>
                        <h4 class="xc-flow-title">Layout Process Flow</h4>
                        <p class="xc-flow-sub">
                            <span class="xc-flow-badge">Architect</span>
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="xc-flow-badge">Structural</span>
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="xc-flow-badge">All Consultants</span>
                        </p>
                        <?php if (!empty($scopes)) { ?>
                            <p class="xc-flow-count">
                                <i class="bx bx-buildings"></i>
                                Tracking <?= count($scopes); ?> client <?= count($scopes) === 1 ? 'flow' : 'flows'; ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="xc-flow-head-actions">
                <?php if (!empty($scopes)) { ?>
                    <div class="xc-select-wrapper">
                        <i class="bx bx-building"></i>
                        <select class="xc-scope-select"
                            onchange="window.location='<?= base_url('index.php/layout_member/layout_process_flow/'); ?>' + this.value">
                            <?php foreach ($scopes as $s) { ?>
                                <option value="<?= (int) $s->customer_id; ?>" <?= $s->customer_id == $customer_id ? 'selected' : ''; ?>>
                                    <?= html_escape($s->customer_name ?: ('Client #' . $s->customer_id)); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>

                <a href="<?= base_url('index.php/layout_member/layout_process'); ?>" class="xc-btn-sm xc-btn-outline">
                    <i class="bx bx-list-ul"></i>
                    <span>Table View</span>
                </a>
            </div>
        </div>

        <?php
        // Admin is an overseer of the flow, not a stage participant - there
        // is no logged-in "layout_role" here like there is for employees,
        // so this card renderer never shows Submit / Review / Add Final
        // Project actions. It only ever shows read-only links: the PDF (if
        // one was submitted) and a jump back to the full table.
        $render_flow_card_inner = function ($card) {
            $state = $card->state;

            $pill_class = 'xc-pill-gray';
            $pill_icon = 'bx-time-five';
            if ($state === 'Pending Review') {
                $pill_class = 'xc-pill-orange';
                $pill_icon = 'bx-time-five';
            } elseif ($state === 'Remarked') {
                $pill_class = 'xc-pill-red';
                $pill_icon = 'bx-message-square-x';
            } elseif ($state === 'Approved') {
                $pill_class = 'xc-pill-green';
                $pill_icon = 'bx-check-circle';
            } elseif ($state === 'Locked') {
                $pill_class = 'xc-pill-gray';
                $pill_icon = 'bx-lock-alt';
            }

            $architect_review_required = $card->report && Layout_member_model::isArchitectReviewRequired($card->report->stage);

            $member_initials = '';
            if ($card->member) {
                $name_parts = preg_split('/\s+/', trim($card->member->member_name));
                $member_initials = strtoupper(substr($name_parts[0], 0, 1) . (isset($name_parts[1]) ? substr($name_parts[1], 0, 1) : ''));
            }

            // Real stage names from Layout_member_model::$STAGE_ORDER, each
            // mapped to something that reads at a glance in the timeline.
            $stage_icons = [
                'Architect' => 'bx-pen',
                'Structure Consultant' => 'bx-building-house',
                'Interior Designer' => 'bx-home-smile',
                'Electrical Consultant' => 'bx-bolt',
                'PHE Consultant' => 'bx-droplet',
                'Landscape Consultant' => 'bx-leaf',
                'HVAC Consultant' => 'bx-wind',
                'Liasoning' => 'bx-link',
            ];
            $icon = $stage_icons[$card->stage] ?? 'bx-file';
            ?>
            <div
                class="xc-flow-card <?= $state === 'Locked' ? 'locked' : ''; ?> <?= $state === 'Approved' ? 'approved' : ''; ?>">
                <div class="xc-flow-card-header">
                    <div class="xc-flow-card-info">
                        <div class="xc-flow-stage-wrapper">
                            <div class="xc-stage-icon">
                                <i class="bx <?= $icon; ?>"></i>
                            </div>
                            <div>
                                <div class="xc-flow-stage"><?= html_escape($card->stage); ?></div>
                                <div class="xc-flow-member">
                                    <?php if ($card->member) { ?>
                                        <span class="xc-avatar"><?= html_escape($member_initials); ?></span>
                                        <span><?= html_escape($card->member->member_name); ?></span>
                                    <?php } else { ?>
                                        <span class="xc-avatar unassigned"><i class="bx bx-user-plus"></i></span>
                                        <span class="text-muted">No member assigned</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="xc-pill <?= $pill_class; ?>">
                        <i class="bx <?= $pill_icon; ?>"></i>
                        <?= html_escape($state); ?>
                    </span>
                </div>

                <?php if (!$card->report) { ?>
                    <?php
                    // No submission exists yet for this stage - tell the
                    // admin why, in plain terms, instead of leaving a blank
                    // card. Locked cards explain what has to happen first;
                    // unlocked-but-empty ones just say nobody has started.
                    $wait_note = '';
                    if ($state === 'Locked') {
                        if ($card->stage === 'Structure Consultant') {
                            $wait_note = 'Waiting on the Architect\'s Final Project handoff.';
                        } elseif (!empty($card->parallel)) {
                            $wait_note = 'Unlocks once Structure Consultant is approved.';
                        }
                    }
                    ?>
                    <?php if ($wait_note) { ?>
                        <div class="xc-wait-note">
                            <i class="bx bx-info-circle"></i>
                            <span><?= html_escape($wait_note); ?></span>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="xc-approval-section">
                        <div class="xc-approval-title">
                            <i class="bx bx-git-pull-request"></i>
                            <span>Approval Status</span>
                        </div>
                        <div class="xc-approval-grid">
                            <?php if ($architect_review_required) { ?>
                                <div class="xc-approval-item">
                                    <span class="xc-approval-label">Architect</span>
                                    <span
                                        class="xc-pill xc-pill-sm <?= $card->report->architect_status === 'Approved' ? 'xc-pill-green' : ($card->report->architect_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                        <i
                                            class="bx <?= $card->report->architect_status === 'Approved' ? 'bx-check' : ($card->report->architect_status === 'Remarked' ? 'bx-x' : 'bx-time'); ?>"></i>
                                        <?= html_escape($card->report->architect_status); ?>
                                    </span>
                                </div>
                            <?php } ?>

                            <div class="xc-approval-item">
                                <span class="xc-approval-label">Client</span>
                                <span
                                    class="xc-pill xc-pill-sm <?= $card->report->client_status === 'Approved' ? 'xc-pill-green' : ($card->report->client_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                    <i
                                        class="bx <?= $card->report->client_status === 'Approved' ? 'bx-check' : ($card->report->client_status === 'Remarked' ? 'bx-x' : 'bx-time'); ?>"></i>
                                    <?= html_escape($card->report->client_status); ?>
                                </span>
                            </div>

                            <div class="xc-approval-item">
                                <span class="xc-approval-label">PMC</span>
                                <span
                                    class="xc-pill xc-pill-sm <?= $card->report->pmc_status === 'Approved' ? 'xc-pill-green' : ($card->report->pmc_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                    <i
                                        class="bx <?= $card->report->pmc_status === 'Approved' ? 'bx-check' : ($card->report->pmc_status === 'Remarked' ? 'bx-x' : 'bx-time'); ?>"></i>
                                    <?= html_escape($card->report->pmc_status); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($card->stage === 'Architect' && $state === 'Approved') { ?>
                    <?php if (!empty($card->final_project)) { ?>
                        <div class="xc-handoff-note is-done">
                            <i class="bx bx-check-double"></i>
                            <span>
                                Final Project <strong><?= html_escape($card->final_project->project_name); ?></strong>
                                sent to Structural.
                                <?php if (!empty($card->final_project->final_doc)) { ?>
                                    <a href="<?= base_url('uploads/layout_final_projects/' . $card->final_project->final_doc); ?>"
                                        target="_blank">View doc</a>
                                <?php } ?>
                            </span>
                        </div>
                    <?php } else { ?>
                        <div class="xc-handoff-note">
                            <i class="bx bx-time-five"></i>
                            <span>Awaiting the Architect to hand off the Final Project to Structural.</span>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php if ($card->report) { ?>
                    <div class="xc-flow-actions">
                        <?php if (!empty($card->report->plan_doc)) { ?>
                            <a href="<?= base_url('uploads/layout_process/' . $card->report->plan_doc); ?>" target="_blank"
                                class="xc-btn-sm xc-btn-outline">
                                <i class="bx bxs-file-pdf"></i>
                                <span>View PDF</span>
                            </a>
                        <?php } ?>
                        <a href="<?= base_url('index.php/layout_member/layout_process'); ?>" class="xc-btn-sm xc-btn-ghost">
                            <i class="bx bx-show"></i>
                            <span>View in Table</span>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <?php
        };

        $sequential_cards = array_values(array_filter($flow, function ($c) {
            return empty($c->parallel);
        }));
        $parallel_cards = array_values(array_filter($flow, function ($c) {
            return !empty($c->parallel);
        }));

        $sequential_total = count($sequential_cards);
        $sequential_approved = 0;
        foreach ($sequential_cards as $c) {
            if ($c->state === 'Approved') {
                $sequential_approved++;
            }
        }
        $sequential_pct = $sequential_total > 0 ? round(($sequential_approved / $sequential_total) * 100) : 0;

        $parallel_total = count($parallel_cards);
        $parallel_approved = 0;
        foreach ($parallel_cards as $c) {
            if ($c->state === 'Approved') {
                $parallel_approved++;
            }
        }
        $parallel_pct = $parallel_total > 0 ? round(($parallel_approved / $parallel_total) * 100) : 0;

        // Quick state breakdown across the whole flow, so the admin can
        // see at a glance whether anything needs attention (Remarked,
        // Pending Review) without reading every card.
        $state_counts = ['Approved' => 0, 'Pending Review' => 0, 'Remarked' => 0, 'Not Started' => 0, 'Locked' => 0];
        foreach ($flow as $c) {
            if (isset($state_counts[$c->state])) {
                $state_counts[$c->state]++;
            }
        }
        ?>

        <?php if (empty($flow)) { ?>
            <div class="xc-empty-flow">
                <div class="xc-empty-icon">
                    <i class="bx bx-folder-open"></i>
                </div>
                <h5>No Layout Flow Found</h5>
                <p>No layout process flow has started for any client yet.</p>
            </div>
        <?php } else { ?>

            <div class="xc-stats-row">
                <?php if ($state_counts['Approved'] > 0) { ?>
                    <div class="xc-stat-chip is-green"><i class="bx bx-check-circle"></i> <?= $state_counts['Approved']; ?>
                        Approved</div>
                <?php } ?>
                <?php if ($state_counts['Pending Review'] > 0) { ?>
                    <div class="xc-stat-chip is-orange"><i class="bx bx-time-five"></i> <?= $state_counts['Pending Review']; ?>
                        Pending Review</div>
                <?php } ?>
                <?php if ($state_counts['Remarked'] > 0) { ?>
                    <div class="xc-stat-chip is-red"><i class="bx bx-message-square-x"></i> <?= $state_counts['Remarked']; ?>
                        Needs Revision</div>
                <?php } ?>
                <?php if ($state_counts['Not Started'] > 0) { ?>
                    <div class="xc-stat-chip is-gray"><i class="bx bx-hourglass"></i> <?= $state_counts['Not Started']; ?> Not
                        Started</div>
                <?php } ?>
                <?php if ($state_counts['Locked'] > 0) { ?>
                    <div class="xc-stat-chip is-gray"><i class="bx bx-lock-alt"></i> <?= $state_counts['Locked']; ?> Locked
                    </div>
                <?php } ?>
            </div>

            <div class="xc-progress-grid">
                <?php if ($sequential_total > 0) { ?>
                    <div class="xc-progress-wrap">
                        <div class="xc-progress-top">
                            <span>Core Process</span>
                            <b><?= (int) $sequential_approved; ?> / <?= (int) $sequential_total; ?></b>
                        </div>
                        <div class="xc-progress-track">
                            <div class="xc-progress-fill" style="width: <?= (int) $sequential_pct; ?>%;"></div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($parallel_total > 0) { ?>
                    <div class="xc-progress-wrap">
                        <div class="xc-progress-top">
                            <span>Parallel Consultants</span>
                            <b><?= (int) $parallel_approved; ?> / <?= (int) $parallel_total; ?></b>
                        </div>
                        <div class="xc-progress-track">
                            <div class="xc-progress-fill is-purple" style="width: <?= (int) $parallel_pct; ?>%;"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="xc-flow-container">
                <ul class="xc-flow-list">
                    <?php foreach ($sequential_cards as $index => $card) {
                        $state = $card->state;

                        $dot_class = 'st-not-started';
                        $icon = 'bx-time-five';

                        if ($state === 'Locked') {
                            $dot_class = 'st-locked';
                            $icon = 'bx-lock-alt';
                        } elseif ($state === 'Not Started') {
                            $dot_class = 'st-not-started';
                            $icon = 'bx-hourglass';
                        } elseif ($state === 'Pending Review') {
                            $dot_class = 'st-pending';
                            $icon = 'bx-time-five';
                        } elseif ($state === 'Remarked') {
                            $dot_class = 'st-remarked';
                            $icon = 'bx-message-square-edit';
                        } elseif ($state === 'Approved') {
                            $dot_class = 'st-approved';
                            $icon = 'bx-check-double';
                        }

                        $line_done = $state === 'Approved';
                        ?>
                        <li class="xc-flow-item <?= $line_done ? 'done' : ''; ?>"
                            data-state="<?= strtolower(str_replace(' ', '-', $state)); ?>"
                            style="animation-delay: <?= min($index * 0.08, 0.5); ?>s;">
                            <div class="xc-flow-rail">
                                <div class="xc-flow-dot <?= $dot_class; ?>">
                                    <i class="bx <?= $icon; ?>"></i>
                                </div>
                                <?php if ($index < count($sequential_cards) - 1) { ?>
                                    <div class="xc-flow-line"></div>
                                <?php } ?>
                            </div>
                            <?php $render_flow_card_inner($card); ?>
                        </li>
                    <?php } ?>
                </ul>

                <?php if (!empty($parallel_cards)) { ?>
                    <div class="xc-parallel-section">
                        <div class="xc-parallel-heading">
                            <div class="xc-parallel-icon">
                                <i class="bx bx-git-merge"></i>
                            </div>
                            <div>
                                <h5>Parallel Consultants</h5>
                                <p>All consultants unlock together once Structural is approved</p>
                            </div>
                        </div>
                        <div class="xc-parallel-grid">
                            <?php foreach ($parallel_cards as $index => $card) {
                                echo '<div class="xc-parallel-card-wrapper" style="animation-delay: ' . min(0.5 + $index * 0.08, 1) . 's;">';
                                $render_flow_card_inner($card);
                                echo '</div>';
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>