                <style>
                    :root {
                        --xc-teal: #0fb4a0;
                        --xc-teal-dark: #0c9786;
                        --xc-teal-light: #16c5af;
                        --xc-navy: #1a1a2e;
                        --xc-purple: #7c3aed;
                        --xc-purple-dark: #6d28d9;
                        --xc-purple-light: #8b5cf6;
                        --xc-orange: #f97316;
                        --xc-orange-dark: #ea580c;
                        --xc-orange-light: #fb923c;
                        --xc-muted: #8a8f98;
                    }

                    * {
                        box-sizing: border-box;
                    }

                    .xc-plans-wrapper {
                        position: relative;
                        min-height: 100vh;
                        background: #f4f5f8;
                        overflow: hidden;
                        isolation: isolate;
                    }

                    /* ── Ambient background mesh ── */
                    .xc-bg-mesh {
                        position: absolute;
                        inset: 0;
                        z-index: 0;
                        pointer-events: none;
                        background:
                            radial-gradient(600px 420px at 12% -5%, rgba(249, 115, 22, 0.14), transparent 60%),
                            radial-gradient(560px 420px at 92% 8%, rgba(124, 58, 237, 0.13), transparent 60%),
                            radial-gradient(500px 500px at 50% 105%, rgba(15, 180, 160, 0.08), transparent 65%),
                            linear-gradient(180deg, #eef6f5 0%, #f4f5f8 30%, #f4f5f8 100%);
                    }

                    .xc-bg-grid {
                        position: absolute;
                        inset: 0;
                        z-index: 0;
                        pointer-events: none;
                        opacity: .5;
                        background-image:
                            linear-gradient(rgba(26, 26, 46, 0.035) 1px, transparent 1px),
                            linear-gradient(90deg, rgba(26, 26, 46, 0.035) 1px, transparent 1px);
                        background-size: 42px 42px;
                        -webkit-mask-image: radial-gradient(ellipse 70% 55% at 50% 8%, #000 0%, transparent 75%);
                        mask-image: radial-gradient(ellipse 70% 55% at 50% 8%, #000 0%, transparent 75%);
                    }

                    .xc-orb {
                        position: absolute;
                        border-radius: 50%;
                        filter: blur(60px);
                        z-index: 0;
                        pointer-events: none;
                        opacity: .55;
                        animation: xcFloat 14s ease-in-out infinite;
                    }

                    .xc-orb.one {
                        width: 260px;
                        height: 260px;
                        background: radial-gradient(circle, rgba(249, 115, 22, 0.32), transparent 70%);
                        top: -60px;
                        left: -60px;
                    }

                    .xc-orb.two {
                        width: 320px;
                        height: 320px;
                        background: radial-gradient(circle, rgba(124, 58, 237, 0.28), transparent 70%);
                        top: 10%;
                        right: -100px;
                        animation-delay: -6s;
                    }

                    @keyframes xcFloat {

                        0%,
                        100% {
                            transform: translate(0, 0) scale(1);
                        }

                        50% {
                            transform: translate(18px, 26px) scale(1.06);
                        }
                    }

                    .xc-plans-content {
                        position: relative;
                        z-index: 1;
                        max-width: 1180px;
                        margin: 0 auto;
                        padding: 48px 32px 64px;
                    }

                    /* ── Top active-plan strip ── */
                    .xc-plan-status-bar {
                        position: relative;
                        z-index: 2;
                        display: flex;
                        justify-content: flex-end;
                        max-width: 1180px;
                        margin: 0 auto;
                        padding: 24px 32px 0;
                    }

                    .xc-plan-status-pill {
                        display: inline-flex;
                        align-items: center;
                        gap: 9px;
                        padding: 10px 20px;
                        border-radius: 999px;
                        font-size: 13px;
                        font-weight: 600;
                        text-decoration: none;
                        border: 1.5px solid #dfe3e8;
                        background: rgba(255, 255, 255, 0.75);
                        backdrop-filter: blur(10px);
                        -webkit-backdrop-filter: blur(10px);
                        color: #1a1a2e;
                        box-shadow: 0 4px 14px rgba(26, 26, 46, 0.06);
                        transition: all .18s ease;
                    }

                    .xc-plan-status-pill.active-state {
                        cursor: default;
                        color: #0c9786;
                        border-color: rgba(15, 180, 160, 0.35);
                        background: rgba(15, 180, 160, 0.1);
                    }

                    .xc-plan-status-pill.cta-state:hover {
                        border-color: #0fb4a0;
                        color: #0c9786;
                        transform: translateY(-1px);
                        box-shadow: 0 8px 20px -4px rgba(15, 180, 160, 0.3);
                    }

                    .xc-plan-status-dot {
                        width: 8px;
                        height: 8px;
                        border-radius: 50%;
                        background: #0fb4a0;
                        flex-shrink: 0;
                        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.18);
                    }

                    .xc-plan-status-pill.active-state .xc-plan-status-dot {
                        animation: xcPulseDot 2s ease-in-out infinite;
                    }

                    @keyframes xcPulseDot {

                        0%,
                        100% {
                            box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.18);
                        }

                        50% {
                            box-shadow: 0 0 0 6px rgba(15, 180, 160, 0.06);
                        }
                    }

                    /* ── Header ── */
                    .xc-plans-header {
                        text-align: center;
                        margin-bottom: 48px;
                    }

                    .xc-plans-eyebrow {
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        font-size: 12px;
                        font-weight: 700;
                        letter-spacing: .1em;
                        text-transform: uppercase;
                        color: #0c9786;
                        background: rgba(15, 180, 160, 0.1);
                        border: 1px solid rgba(15, 180, 160, 0.18);
                        padding: 7px 16px;
                        border-radius: 999px;
                        margin-bottom: 18px;
                    }

                    .xc-plans-eyebrow svg {
                        width: 13px;
                        height: 13px;
                    }

                    .xc-plans-header h2 {
                        font-size: 36px;
                        font-weight: 800;
                        color: #1a1a2e;
                        margin: 0 0 12px;
                        letter-spacing: -0.02em;
                    }

                    .xc-plans-header h2 span {
                        background: linear-gradient(90deg, #0fb4a0, #7c3aed);
                        -webkit-background-clip: text;
                        background-clip: text;
                        color: transparent;
                    }

                    .xc-plans-header p {
                        font-size: 15.5px;
                        color: #8a8f98;
                        margin: 0;
                        max-width: 460px;
                        margin: 0 auto;
                    }

                    .xc-plans-grid {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 28px;
                        align-items: stretch;
                    }

                    /* ── Base card ── */
                    .xc-plan-card {
                        background: rgba(255, 255, 255, 0.9);
                        backdrop-filter: blur(6px);
                        -webkit-backdrop-filter: blur(6px);
                        border-radius: 22px;
                        border: 1.5px solid #e9ebef;
                        overflow: hidden;
                        display: flex;
                        flex-direction: column;
                        box-shadow: 0 1px 3px rgba(26, 26, 46, 0.05);
                        transition: transform .25s cubic-bezier(.2, .8, .2, 1), box-shadow .25s ease, border-color .25s ease;
                        position: relative;
                    }

                    .xc-plan-card::before {
                        content: "";
                        position: absolute;
                        inset: 0;
                        border-radius: inherit;
                        padding: 1.5px;
                        background: linear-gradient(135deg, rgba(15, 180, 160, 0), rgba(15, 180, 160, 0));
                        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                        -webkit-mask-composite: xor;
                        mask-composite: exclude;
                        pointer-events: none;
                        transition: background .25s ease;
                    }

                    .xc-plan-card:hover {
                        transform: translateY(-8px);
                        box-shadow: 0 22px 46px -14px rgba(26, 26, 46, 0.18);
                    }

                    /* ── Starter card accent (orange) ── */
                    .xc-plan-card.starter {
                        border-color: rgba(249, 115, 22, 0.35);
                    }

                    .xc-plan-card.starter::before {
                        background: linear-gradient(135deg, rgba(249, 115, 22, 0.45), rgba(249, 115, 22, 0));
                    }

                    /* ── Popular card accent (teal) ── */
                    .xc-plan-card.popular {
                        border-color: rgba(15, 180, 160, 0.4);
                        box-shadow: 0 14px 36px -12px rgba(15, 180, 160, 0.4);
                        transform: scale(1.045);
                        z-index: 2;
                    }

                    .xc-plan-card.popular::before {
                        background: linear-gradient(135deg, rgba(15, 180, 160, 0.5), rgba(15, 180, 160, 0));
                    }

                    .xc-plan-card.popular:hover {
                        transform: scale(1.045) translateY(-8px);
                    }

                    /* ── Best value card accent (purple) ── */
                    .xc-plan-card.best {
                        border-color: rgba(124, 58, 237, 0.35);
                    }

                    .xc-plan-card.best::before {
                        background: linear-gradient(135deg, rgba(124, 58, 237, 0.45), rgba(124, 58, 237, 0));
                    }

                    /* ── Badge strip ── */
                    .xc-plan-badge {
                        position: relative;
                        padding: 11px 0;
                        text-align: center;
                        font-size: 11.5px;
                        font-weight: 700;
                        letter-spacing: .08em;
                        text-transform: uppercase;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 6px;
                        overflow: hidden;
                    }

                    .xc-plan-badge svg {
                        width: 13px;
                        height: 13px;
                        position: relative;
                        z-index: 1;
                    }

                    .xc-plan-badge span {
                        position: relative;
                        z-index: 1;
                    }

                    .xc-plan-badge.orange {
                        background: linear-gradient(90deg, #fb923c, #ea580c);
                        color: #fff;
                    }

                    .xc-plan-badge.teal {
                        background: linear-gradient(90deg, #0fb4a0, #0c9786);
                        color: #fff;
                    }

                    .xc-plan-badge.purple {
                        background: linear-gradient(90deg, #8b5cf6, #7c3aed);
                        color: #fff;
                    }

                    /* animated sheen sweep across badge */
                    .xc-plan-badge.orange::after,
                    .xc-plan-badge.teal::after,
                    .xc-plan-badge.purple::after {
                        content: "";
                        position: absolute;
                        top: 0;
                        left: -40%;
                        width: 40%;
                        height: 100%;
                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
                        animation: xcSheen 3.2s ease-in-out infinite;
                    }

                    @keyframes xcSheen {
                        0% {
                            left: -40%;
                        }

                        60%,
                        100% {
                            left: 120%;
                        }
                    }

                    /* ── Card body ── */
                    .xc-plan-body {
                        padding: 34px 30px 30px;
                        display: flex;
                        flex-direction: column;
                        flex: 1;
                    }

                    .xc-plan-name-row {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        margin-bottom: 20px;
                    }

                    .xc-plan-name {
                        font-size: 13px;
                        font-weight: 700;
                        letter-spacing: .08em;
                        text-transform: uppercase;
                        color: #9aa0ac;
                        margin: 0;
                    }

                    .xc-plan-card.starter .xc-plan-name {
                        color: #ea580c;
                    }

                    .xc-plan-card.popular .xc-plan-name {
                        color: #0c9786;
                    }

                    .xc-plan-card.best .xc-plan-name {
                        color: #7c3aed;
                    }

                    .xc-plan-icon {
                        width: 38px;
                        height: 38px;
                        border-radius: 11px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                        transition: transform .25s ease;
                    }

                    .xc-plan-card:hover .xc-plan-icon {
                        transform: rotate(-6deg) scale(1.08);
                    }

                    .xc-plan-icon.orange {
                        background: rgba(249, 115, 22, 0.12);
                        color: #ea580c;
                        box-shadow: 0 0 0 5px rgba(249, 115, 22, 0.06);
                    }

                    .xc-plan-icon.teal {
                        background: rgba(15, 180, 160, 0.12);
                        color: #0c9786;
                        box-shadow: 0 0 0 5px rgba(15, 180, 160, 0.06);
                    }

                    .xc-plan-icon.purple {
                        background: rgba(124, 58, 237, 0.12);
                        color: #7c3aed;
                        box-shadow: 0 0 0 5px rgba(124, 58, 237, 0.06);
                    }

                    .xc-plan-icon svg {
                        width: 19px;
                        height: 19px;
                    }

                    .xc-plan-price {
                        display: flex;
                        align-items: baseline;
                        gap: 4px;
                        margin-bottom: 4px;
                    }

                    .xc-plan-price .currency {
                        font-size: 20px;
                        font-weight: 700;
                        color: #2d3436;
                        margin-top: 6px;
                    }

                    .xc-plan-price .amount {
                        font-size: 48px;
                        font-weight: 800;
                        color: #1a1a2e;
                        line-height: 1;
                        letter-spacing: -0.02em;
                    }

                    .xc-plan-duration {
                        font-size: 13px;
                        color: #9aa0ac;
                        margin-bottom: 24px;
                    }

                    .xc-plan-divider {
                        height: 1px;
                        background: linear-gradient(90deg, transparent, #eef0f3 15%, #eef0f3 85%, transparent);
                        margin-bottom: 24px;
                    }

                    /* ── Features ── */
                    .xc-plan-features {
                        list-style: none;
                        margin: 0 0 28px;
                        padding: 0;
                        display: flex;
                        flex-direction: column;
                        gap: 14px;
                        flex: 1;
                    }

                    .xc-plan-features li {
                        display: flex;
                        align-items: center;
                        gap: 11px;
                        font-size: 14px;
                        font-weight: 500;
                        color: #2d3436;
                    }

                    .xc-feat-icon {
                        width: 22px;
                        height: 22px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    }

                    .xc-feat-icon svg {
                        width: 12px;
                        height: 12px;
                    }

                    .xc-feat-icon.orange {
                        background: #fff1e6;
                        color: #c2410c;
                    }

                    .xc-feat-icon.teal {
                        background: #e0f7f4;
                        color: #0a7a6b;
                    }

                    .xc-feat-icon.purple {
                        background: #ede9fe;
                        color: #5b21b6;
                    }

                    /* ── Buy button ── */
                    .btn-xc-buy {
                        position: relative;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 6px;
                        width: 100%;
                        padding: 14px 0;
                        border-radius: 13px;
                        font-size: 14px;
                        font-weight: 700;
                        text-align: center;
                        text-decoration: none;
                        border: none;
                        cursor: pointer;
                        overflow: hidden;
                        transition: opacity .15s, transform .12s, box-shadow .15s;
                    }

                    .btn-xc-buy svg {
                        width: 14px;
                        height: 14px;
                        position: relative;
                        z-index: 1;
                        transition: transform .15s ease;
                    }

                    .btn-xc-buy span {
                        position: relative;
                        z-index: 1;
                    }

                    .btn-xc-buy::after {
                        content: "";
                        position: absolute;
                        top: 0;
                        left: -60%;
                        width: 40%;
                        height: 100%;
                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                        transform: skewX(-18deg);
                        transition: left .5s ease;
                    }

                    .btn-xc-buy:hover::after {
                        left: 130%;
                    }

                    .btn-xc-buy:hover {
                        opacity: .95;
                        transform: translateY(-2px);
                        text-decoration: none;
                    }

                    .btn-xc-buy:hover svg {
                        transform: translateX(2px);
                    }

                    .btn-xc-buy.orange-solid {
                        background: linear-gradient(135deg, #fb923c, #ea580c);
                        color: #fff;
                        box-shadow: 0 10px 24px -6px rgba(249, 115, 22, 0.55);
                    }

                    .btn-xc-buy.teal-solid {
                        background: linear-gradient(135deg, #16c5af, #0c9786);
                        color: #fff;
                        box-shadow: 0 10px 24px -6px rgba(15, 180, 160, 0.55);
                    }

                    .btn-xc-buy.purple-solid {
                        background: linear-gradient(135deg, #8b5cf6, #6d28d9);
                        color: #fff;
                        box-shadow: 0 10px 24px -6px rgba(124, 58, 237, 0.5);
                    }

                    /* ── Trust footer ── */
                    .xc-plans-footer {
                        text-align: center;
                        margin-top: 44px;
                        font-size: 13px;
                        color: #9aa0ac;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                        flex-wrap: wrap;
                    }

                    .xc-plans-footer span {
                        display: inline-flex;
                        align-items: center;
                        gap: 7px;
                        background: rgba(255, 255, 255, 0.7);
                        border: 1px solid #e9ebef;
                        padding: 8px 14px;
                        border-radius: 999px;
                        font-weight: 600;
                        color: #636e72;
                    }

                    .xc-plans-footer svg {
                        width: 14px;
                        height: 14px;
                        color: #0fb4a0;
                    }

                    @media(max-width:992px) {
                        .xc-plans-grid {
                            grid-template-columns: 1fr;
                            max-width: 460px;
                            margin: 0 auto;
                        }

                        .xc-plan-card.popular {
                            transform: none;
                        }

                        .xc-plan-card.popular:hover {
                            transform: translateY(-8px);
                        }
                    }

                    @media(max-width:768px) {
                        .xc-plans-header h2 {
                            font-size: 28px;
                        }

                        .xc-plans-content {
                            padding: 36px 24px 56px;
                        }
                    }

                    @media(max-width:480px) {
                        .xc-plans-content {
                            padding: 28px 16px 48px;
                        }

                        .xc-plan-status-bar {
                            padding: 16px 16px 0;
                        }

                        .xc-plans-header h2 {
                            font-size: 23px;
                        }

                        .xc-plans-header p {
                            font-size: 14px;
                        }

                        .xc-plan-body {
                            padding: 26px 20px 22px;
                        }

                        .xc-plan-price .amount {
                            font-size: 38px;
                        }

                        .xc-plans-footer {
                            gap: 8px;
                        }

                        .xc-plans-footer span {
                            font-size: 12px;
                            padding: 7px 11px;
                        }
                    }
                </style>

                <div class="page-wrapper">

                    <div class="xc-plan-status-bar">

                        <?php if ($active_plan) { ?>

                            <span class="xc-plan-status-pill active-state">
                                <span class="xc-plan-status-dot"></span>
                                Active Until <?= date('d M Y', strtotime($active_plan->expiry_date)); ?>
                            </span>

                        <?php } else { ?>

<<<<<<< HEAD
                            <?php if (!empty($first_plan)): ?>
                            <a href="<?= base_url('plan/buy/' . (int) $first_plan->id) ?>" class="xc-plan-status-pill cta-state">
=======
                            <a href="<?= base_url('plan/buy/1') ?>" class="xc-plan-status-pill cta-state">
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                                <span class="xc-plan-status-dot"></span>
                                Get Started
                            </a>
                            <?php endif; ?>

                        <?php } ?>

                    </div>

                    <div class="xc-plans-wrapper">
                        <div class="xc-bg-mesh"></div>
                        <div class="xc-bg-grid"></div>
                        <div class="xc-orb one"></div>
                        <div class="xc-orb two"></div>

                        <div class="xc-plans-content">

                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <h2>Choose Your Plan</h2>

                                <a href="<?= base_url('plan/payment_history') ?>" class="btn btn-dark">
                                    <i class="fa fa-history"></i>
                                    View Payment History
                                </a>

                            </div>
                            <div class="xc-plans-header">
                                <span class="xc-plans-eyebrow">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2l2.9 6.26L21 9.27l-4.5 4.39L17.8 21 12 17.77 6.2 21l1.3-7.34L3 9.27l6.1-1.01z">
                                        </path>
                                    </svg>
                                    Pricing
                                </span>
                                <h2>Choose Your <span>Plan</span></h2>
                                <p>Select a subscription plan that fits your company.</p>
                            </div>

                            <div class="xc-plans-grid">

                                <?php if (false): ?>
                                <!-- Legacy hard-coded plan cards retained only as a design reference. -->
                                <div class="xc-plan-card starter">
                                    <div class="xc-plan-badge orange">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                                        </svg>
                                        <span>Starter</span>
                                    </div>
                                    <div class="xc-plan-body">
                                        <div class="xc-plan-name-row">
                                            <p class="xc-plan-name">Monthly</p>
                                            <span class="xc-plan-icon orange">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="xc-plan-price">
                                            <span class="currency">₹</span>
                                            <span class="amount">1</span>
                                        </div>
                                        <div class="xc-plan-duration">Billed every 30 days</div>
                                        <div class="xc-plan-divider"></div>
                                        <ul class="xc-plan-features">
                                            <li>
                                                <span class="xc-feat-icon orange">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                100 Customers
                                            </li>
                                            <li>
                                                <span class="xc-feat-icon orange">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                10 Team Members
                                            </li>
                                            <li>
                                                <span class="xc-feat-icon orange">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                20 Projects
                                            </li>
                                        </ul>
                                        <a href="<?= base_url('plan/buy/1') ?>" class="btn-xc-buy orange-solid">
                                            <span>Get Started</span>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Quarterly (Popular) -->
                                <div class="xc-plan-card popular">
                                    <div class="xc-plan-badge teal">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M12 2l2.9 6.26L21 9.27l-4.5 4.39L17.8 21 12 17.77 6.2 21l1.3-7.34L3 9.27l6.1-1.01z">
                                            </path>
                                        </svg>
                                        <span>Most Popular</span>
                                    </div>
                                    <div class="xc-plan-body">
                                        <div class="xc-plan-name-row">
                                            <p class="xc-plan-name">Quarterly</p>
                                            <span class="xc-plan-icon teal">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="xc-plan-price">
                                            <span class="currency">₹</span>
                                            <span class="amount">1299</span>
                                        </div>
                                        <div class="xc-plan-duration">Billed every 90 days</div>
                                        <div class="xc-plan-divider"></div>
                                        <ul class="xc-plan-features">
                                            <li>
                                                <span class="xc-feat-icon teal">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                500 Customers
                                            </li>
                                            <li>
                                                <span class="xc-feat-icon teal">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                50 Team Members
                                            </li>
                                            <li>
                                                <span class="xc-feat-icon teal">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                100 Projects
                                            </li>
                                        </ul>
                                        <a href="<?= base_url('plan/buy/2') ?>" class="btn-xc-buy teal-solid">
                                            <span>Buy Now</span>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Yearly (Best Value) -->
                                <div class="xc-plan-card best">
                                    <div class="xc-plan-badge purple">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M5 4h14v3.5a7 7 0 0 1-5 6.71V17h2a1 1 0 0 1 0 2H8a1 1 0 0 1 0-2h2v-2.79A7 7 0 0 1 5 7.5V4zm2 2v1.5a5 5 0 0 0 5 5 5 5 0 0 0 5-5V6H7z">
                                            </path>
                                        </svg>
                                        <span>Best Value</span>
                                    </div>
                                    <div class="xc-plan-body">
                                        <div class="xc-plan-name-row">
                                            <p class="xc-plan-name">Yearly</p>
                                            <span class="xc-plan-icon purple">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 2l3 7h7l-5.5 4.5L18.5 21 12 16.5 5.5 21l2-7.5L2 9h7z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="xc-plan-price">
                                            <span class="currency">₹</span>
                                            <span class="amount">4999</span>
                                        </div>
                                        <div class="xc-plan-duration">Billed every 365 days</div>
                                        <div class="xc-plan-divider"></div>
                                        <ul class="xc-plan-features">
                                            <li>
                                                <span class="xc-feat-icon purple">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                Unlimited Customers
                                            </li>
                                            <li>
                                                <span class="xc-feat-icon purple">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                Unlimited Team Members
                                            </li>
                                            <li>
                                                <span class="xc-feat-icon purple">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </span>
                                                Unlimited Projects
                                            </li>
                                        </ul>
                                        <a href="<?= base_url('plan/buy/3') ?>" class="btn-xc-buy purple-solid">
                                            <span>Buy Now</span>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <?php endif; ?>

                                <?php
                                $card_styles = [
                                    ['card' => 'starter', 'color' => 'orange', 'badge' => 'Starter', 'button' => 'Get Started'],
                                    ['card' => 'popular', 'color' => 'teal', 'badge' => 'Most Popular', 'button' => 'Buy Now'],
                                    ['card' => 'best', 'color' => 'purple', 'badge' => 'Best Value', 'button' => 'Buy Now']
                                ];
                                ?>
                                <?php foreach ($plans as $index => $plan): ?>
                                    <?php
                                    $style = $card_styles[$index % count($card_styles)];
                                    $display_limit = function ($limit) {
                                        return (int) $limit >= 999999 ? 'Unlimited' : number_format((int) $limit);
                                    };
                                    ?>
                                    <div class="xc-plan-card <?= $style['card'] ?>">
                                        <div class="xc-plan-badge <?= $style['color'] ?>">
                                            <i class="bx <?= $index === 0 ? 'bx-bolt-circle' : ($index === 1 ? 'bx-star' : 'bx-trophy') ?>"></i>
                                            <span><?= $style['badge'] ?></span>
                                        </div>
                                        <div class="xc-plan-body">
                                            <div class="xc-plan-name-row">
                                                <p class="xc-plan-name"><?= html_escape($plan->plan_name) ?></p>
                                                <span class="xc-plan-icon <?= $style['color'] ?>"><i class="bx <?= $index === 0 ? 'bx-calendar' : ($index === 1 ? 'bx-bolt-circle' : 'bx-star') ?>"></i></span>
                                            </div>
                                            <div class="xc-plan-price"><span class="currency">₹</span><span class="amount"><?= number_format((float) $plan->amount, 0) ?></span></div>
                                            <div class="xc-plan-duration">Billed every <?= (int) $plan->duration_days ?> days</div>
                                            <div class="xc-plan-divider"></div>
                                            <ul class="xc-plan-features">
                                                <li><span class="xc-feat-icon <?= $style['color'] ?>"><i class='bx bx-check'></i></span><?= $display_limit($plan->customer_limit) ?> Customers</li>
                                                <li><span class="xc-feat-icon <?= $style['color'] ?>"><i class='bx bx-check'></i></span><?= $display_limit($plan->team_limit) ?> Team Members</li>
                                                <li><span class="xc-feat-icon <?= $style['color'] ?>"><i class='bx bx-check'></i></span><?= $display_limit($plan->project_limit) ?> Projects</li>
                                            </ul>
                                            <a href="<?= base_url('plan/buy/' . (int) $plan->id) ?>" class="btn-xc-buy <?= $style['color'] ?>-solid"><span><?= $style['button'] ?></span><i class='bx bx-right-arrow-alt'></i></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php if (empty($plans)): ?><p class="text-center text-muted w-100">No subscription plans are currently available.</p><?php endif; ?>
                            </div><!-- /.xc-plans-grid -->

                            <div class="xc-plans-footer">
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    Secure checkout
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                    Cancel anytime
                                </span>
                                <span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    Instant activation
                                </span>
                            </div>

                        </div>

                        <?php if ($this->session->flashdata('plan_error')) { ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {

                                    Swal.fire({
                                        icon: "warning",
                                        title: "Subscription Active",

                                        html: `
                                            <div style="text-align:center;">

                                                <div style="font-size:15px; margin-bottom:15px;">
                                                    <strong>Your current subscription is still active.</strong>
                                                </div>

                                                <div style="
                                                    background:#f8f9fa;
                                                    border-left:4px solid #0fb4a0;
                                                    border-radius:10px;
                                                    padding:15px;
                                                    margin-bottom:15px;
                                                    color:#444;
                                                    line-height:1.6;
                                                ">
                                                    <?= htmlspecialchars($this->session->flashdata('plan_error')); ?>
                                                </div>

                                                <div style="font-size:13px;color:#777;">
                                                    You can purchase another subscription after your current plan expires.
                                                </div>

                                            </div>
                                        `,

                                        iconColor: "#f39c12",
                                        confirmButtonColor: "#0fb4a0",
                                        confirmButtonText: "Understood",
                                        allowOutsideClick: false,
                                        allowEscapeKey: false
                                    });

                                });
                            </script>

                        <?php } ?>

                    </div>
                </div>
