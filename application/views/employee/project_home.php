<style>
    .xc-proj-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    /* Header info card */
    .xc-info-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .xc-info-top {
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        padding: 22px 26px;
        position: relative;
        overflow: hidden;
    }

    .xc-info-top::after {
        content: '';
        position: absolute;
        right: -50px;
        top: -60px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        pointer-events: none;
    }

    .xc-info-top h4 {
        color: #ffffff;
        font-weight: 700;
        font-size: 20px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .xc-info-body {
        padding: 20px 26px 24px;
    }

    .xc-info-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .xc-info-item {
        flex: 1 1 180px;
        min-width: 160px;
    }

    .xc-info-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #8a929a;
        margin-bottom: 6px;
    }

    .xc-info-label svg {
        width: 13px;
        height: 13px;
        stroke: #0fb4a0;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
    }

    /* Status pill */
    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 13px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 600;
        background: rgba(46, 230, 168, 0.14);
        color: #0d9c8a;
    }

    .xc-pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #0d9c8a;
        flex-shrink: 0;
    }

    /* Feature cards */
    .xc-feature-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .xc-feature-card {
        flex: 1 1 220px;
        min-width: 200px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        padding: 28px 20px;
        text-align: center;
        text-decoration: none;
        display: block;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        opacity: 0;
        transform: translateY(14px);
        animation: xc-card-rise 0.5s ease forwards;
    }

    .xc-feature-card:nth-child(1) {
        animation-delay: 0.03s;
    }

    .xc-feature-card:nth-child(2) {
        animation-delay: 0.10s;
    }

    .xc-feature-card:nth-child(3) {
        animation-delay: 0.17s;
    }

    .xc-feature-card:nth-child(4) {
        animation-delay: 0.24s;
    }

    .xc-feature-card:nth-child(5) {
        animation-delay: 0.31s;
    }

    @keyframes xc-card-rise {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .xc-feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(15, 180, 160, 0.16);
        border-color: #b9ece4;
    }

    .xc-feature-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 16px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
    }

    .xc-feature-icon svg {
        width: 26px;
        height: 26px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-feature-card h5 {
        font-size: 15px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .xc-feature-card .xc-feature-sub {
        font-size: 12.5px;
        color: #9aa3a9;
        margin-top: 4px;
    }

    .xc-feature-card .xc-feature-sub.text-danger {
        color: #dc2626;
        font-weight: 600;
    }

    /* Disabled state */
    .xc-feature-card.xc-disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .xc-feature-card.xc-disabled:hover {
        transform: none;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        border-color: #e4e6ea;
    }

    .xc-feature-card.xc-disabled .xc-feature-icon {
        background: #c7cbce;
    }

    /* Standalone quick-action button (the original btn-primary link) */
    .xc-quick-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0;
        width: 100%;
        height: 100%;
        min-height: 100%;
        padding: 28px 20px;
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        color: #1a1a2e;
        font-weight: 700;
        font-size: 15px;
        text-decoration: none;
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .xc-quick-btn:hover {
        background: #ffffff;
        color: #1a1a2e;
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(15, 180, 160, 0.16);
        border-color: #b9ece4;
    }

    .xc-quick-btn .xc-feature-icon {
        margin-bottom: 16px;
    }

    .xc-quick-btn svg {
        width: 18px;
        height: 18px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-quick-btn .xc-quick-sub {
        font-size: 12.5px;
        font-weight: 400;
        color: #9aa3a9;
        margin-top: 4px;
    }

    @media (max-width: 575px) {

        .xc-feature-card,
        .xc-feature-row>div {
            flex: 1 1 100%;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-proj-wrapper">

            <div class="xc-info-card">

                <div class="xc-info-top">
                    <h4><?= $project->project_name ?></h4>
                </div>

                <div class="xc-info-body">

                    <div class="xc-info-grid">

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="4"></circle>
                                    <path d="M4 21c0-4 4-6 8-6s8 2 8 6"></path>
                                </svg>
                                Customer
                            </div>
                            <div class="xc-info-value">
                                <?= $project->customer_name ?>
                            </div>
                        </div>

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <path d="M12 7v5l3 3"></path>
                                </svg>
                                Status
                            </div>
                            <div class="xc-info-value">
                                <span class="xc-pill">
                                    <?= $project->status ?>
                                </span>
                            </div>
                        </div>

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                    <path d="M3 9h18"></path>
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                </svg>
                                Start Date
                            </div>
                            <div class="xc-info-value">
                                <?= $project->start_date ?>
                            </div>
                        </div>

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                    <path d="M3 9h18"></path>
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                </svg>
                                End Date
                            </div>
                            <div class="xc-info-value">
                                <?= $project->end_date ?>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="xc-feature-row">

                <?php
                $locked = empty($attendance_today);
                ?><div style="flex:1 1 220px;min-width:200px;">

<a href="<?= base_url('index.php/employee/add_attendance/'.$project->id) ?>"
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
                    <a href="<?= base_url('index.php/employee/attendance_list/' . $project->id) ?>"
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
                    <a href="<?= base_url('index.php/employee/project_info/' . $project->id) ?>"
                        class="xc-feature-card">
                        <div class="xc-feature-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <path d="M14 2v6h6"></path>
                                <path d="M9 13h6"></path>
                                <path d="M9 17h6"></path>
                            </svg>
                        </div>
                        <h5>Project Details</h5>
                        <div class="xc-feature-sub">View full information</div>
                    </a>
                </div>

                <!-- Capture Images (quick action) -->
                <!-- <div style="flex: 1 1 220px; min-width: 200px;">
                        <a href="<?= base_url('index.php/employee/capture_images/' . $project->id) ?>"
                            class="xc-quick-btn">
                            <div class="xc-feature-icon">
                                <svg viewBox="0 0 24 24">
                                    <path
                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                    </path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>
                            </div>
                            <h5>Capture Images</h5>
                            <div class="xc-quick-sub">Quick capture</div>
                        </a>
                    </div> -->

                <!-- Capture Images (conditional on attendance) -->
                <div style="flex:1 1 220px;min-width:200px;">

                    <?php if (!$locked) { ?>

                        <a href="<?= base_url('employee/capture_images/' . $project->id) ?>" class="xc-feature-card">

                            <div class="xc-feature-icon">📷</div>

                            <h5>Capture Images</h5>

                            <div class="xc-feature-sub">
                                Quick Capture
                            </div>

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

                        <a href="<?= base_url('index.php/employee/materials_report/' . $project->id) ?>" class="xc-feature-card">

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

                        <a href="<?= base_url('index.php/employee/view_images/' . $project->id) ?>" class="xc-feature-card">

                        <?php } else { ?>

                            <div class="xc-feature-card xc-disabled">

                            <?php } ?>
                            <div class="xc-feature-icon">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <path d="M21 15l-5-5L5 21"></path>
                                </svg>
                            </div>
                            <h5>View Images</h5>
                            <div class="xc-feature-sub">Browse captured photos</div>
                    </a>
                </div>
                <!-- Material Request -->

                <div style="flex: 1 1 220px; min-width: 200px;">

                    <a href="<?= base_url('index.php/employee/material_request/' . $project->id) ?>"
                        class="xc-feature-card">

                        <div class="xc-feature-icon">
                            📦
                        </div>

                        <h5>Material Request</h5>

                        <div class="xc-feature-sub">
                            Request Materials
                        </div>

                    </a>

                </div>
            </div>

        </div>
    </div>
</div>