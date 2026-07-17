<div class="page-wrapper xc-dashboard">
    <style>
        .xc-dashboard {
            --xc-primary: 20, 184, 166;
            --xc-primary-dark: #0d9488;
            --xc-primary-solid: #14b8a6;
            --xc-text: #1f2937;
            --xc-muted: #8a94a6;
            --xc-border: #eef1f4;
            --xc-radius: 12px;
            --xc-shadow: 0 1px 2px rgba(16, 24, 40, .04), 0 1px 3px rgba(16, 24, 40, .06);
            color: var(--xc-text);
        }

        /* Eyebrow + heading */
        .xc-dashboard .xc-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: rgba(var(--xc-primary), .12);
            color: var(--xc-primary-dark);
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: .35rem .8rem;
            border-radius: 999px;
        }

        .xc-dashboard .xc-dash-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--xc-text);
            margin: .7rem 0 .25rem;
        }

        .xc-dashboard .xc-dash-subtitle {
            font-size: .875rem;
            color: var(--xc-muted);
            margin: 0 0 1.75rem;
        }

        /* Stat grid — real CSS grid, no column-math bugs */
        .xc-dashboard .xc-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.1rem;
        }

        .xc-dashboard .xc-stat-card {
            background: #fff;
            border: 1px solid var(--xc-border);
            border-radius: var(--xc-radius);
            box-shadow: var(--xc-shadow);
            padding: 1.25rem 1.4rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: box-shadow .15s, border-color .15s;
        }

        .xc-dashboard .xc-stat-card:hover {
            border-color: rgba(var(--accent), .35);
            box-shadow: 0 4px 14px rgba(16, 24, 40, .07);
        }

        .xc-dashboard .xc-stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(var(--accent), .12);
            color: var(--accent-solid);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .xc-dashboard .xc-stat-body h6 {
            font-size: .74rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--xc-muted);
            margin: 0 0 .4rem;
        }

        .xc-dashboard .xc-stat-body strong {
            display: block;
            font-size: 1.75rem;
            font-weight: 800;
            line-height: 1;
            color: var(--xc-text);
            margin-bottom: .5rem;
        }

        .xc-dashboard .xc-stat-body p {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .78rem;
            color: var(--xc-muted);
            margin: 0;
        }

        .xc-dashboard .xc-stat-body p .dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent-solid);
            flex-shrink: 0;
        }

        @media (max-width: 576px) {
            .xc-dashboard .xc-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="page-content">
        <div class="dashboard-heading">
            <span class="xc-eyebrow"><i class='bx bxs-shield-alt-2'></i> Super Admin</span>
            <h1 class="xc-dash-title">Super Admin Dashboard</h1>
            <p class="xc-dash-subtitle">Monitor companies, subscriptions and plan activity from one place.</p>
        </div>

        <div class="xc-stats-grid">

            <div class="xc-stat-card" style="--accent:20,184,166; --accent-solid:#0d9488;">
                <div class="xc-stat-icon"><i class='bx bx-buildings'></i></div>
                <div class="xc-stat-body">
                    <h6>Total Companies</h6>
                    <strong><?= number_format((int) $total_companies) ?></strong>
                    <p><span class="dot"></span>Companies registered in system</p>
                </div>
            </div>

            <div class="xc-stat-card" style="--accent:22,163,74; --accent-solid:#15803d;">
                <div class="xc-stat-icon"><i class='bx bx-user-check'></i></div>
                <div class="xc-stat-body">
                    <h6>Active Companies</h6>
                    <strong><?= number_format((int) $active_companies) ?></strong>
                    <p><span class="dot"></span>Companies with active access</p>
                </div>
            </div>

            <div class="xc-stat-card" style="--accent:220,53,69; --accent-solid:#b02a37;">
                <div class="xc-stat-icon"><i class='bx bx-user-x'></i></div>
                <div class="xc-stat-body">
                    <h6>Inactive Companies</h6>
                    <strong><?= number_format((int) $inactive_companies) ?></strong>
                    <p><span class="dot"></span>Companies without active access</p>
                </div>
            </div>

            <div class="xc-stat-card" style="--accent:99,102,241; --accent-solid:#4f46e5;">
                <div class="xc-stat-icon"><i class='bx bx-credit-card'></i></div>
                <div class="xc-stat-body">
                    <h6>Total Plans</h6>
                    <strong><?= number_format((int) $total_plans) ?></strong>
                    <p><span class="dot"></span>Plans available to companies</p>
                </div>
            </div>

            <div class="xc-stat-card" style="--accent:59,130,246; --accent-solid:#2563eb;">
                <div class="xc-stat-icon"><i class='bx bx-briefcase-alt-2'></i></div>
                <div class="xc-stat-body">
                    <h6>Active Plans</h6>
                    <strong><?= number_format((int) $active_plans) ?></strong>
                    <p><span class="dot"></span>Current active subscriptions</p>
                </div>
            </div>

            <div class="xc-stat-card" style="--accent:245,158,11; --accent-solid:#b45309;">
                <div class="xc-stat-icon"><i class='bx bx-wallet'></i></div>
                <div class="xc-stat-body">
                    <h6>Total Payments</h6>
                    <strong><?= number_format((int) $total_payments) ?></strong>
                    <p><span class="dot"></span>Subscription payments received</p>
                </div>
            </div>

        </div>
    </div>
</div>