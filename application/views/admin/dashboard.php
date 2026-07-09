<?php
// dashboard.php - CodeIgniter View
// Controller must pass: $current_plan, $project_count, $team_count, $customer_count, $folder_count
?>

<div class="page-wrapper">
    <div class="page-content xc-dash-content">

        <!-- Welcome Header -->
        <div class="xc-welcome-banner mb-4">
            <div class="xc-banner-grid">
                <div class="xc-banner-glow xc-glow-one"></div>
                <div class="xc-banner-glow xc-glow-two"></div>

                <div class="xc-brand-row">
                    <div class="xc-brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="18" width="18" height="26" rx="4" fill="#f97316" />
                            <rect x="14" y="8" width="18" height="26" rx="4" fill="#0fb4a0" />
                            <rect x="24" y="18" width="18" height="26" rx="4" fill="#1a1a2e" />
                        </svg>
                    </div>
                    <span class="xc-brand-word">ADMIN Console</span>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="xc-dashboard-title">
                            <span class="xc-wave-emoji">👋</span> Welcome back,
                            <span class="xc-user-name"><?= $this->session->userdata('name') ?? 'Admin' ?></span>
                        </h2>
                        <p class="xc-dashboard-subtitle">
                            <i class="ti ti-chart-line me-2"></i>
                            Here's your construction monitoring overview for today
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                        <div class="xc-current-date">
                            <i class="ti ti-calendar-event me-2"></i>
                            <span id="currentDate"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Row: Plan + Quick Actions + Activity -->
        <div class="row g-4 mb-4">

            <!-- Current Plan Card -->
            <div class="col-lg-4 col-md-6">
                <div class="xc-currentplan-card">
                    <div class="xc-card-watermark xc-watermark-light" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="18" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="14" y="8" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="24" y="18" width="18" height="26" rx="4" fill="currentColor" />
                        </svg>
                    </div>

                    <div class="xc-currentplan-header">
                        <div class="xc-currentplan-icon">
                            <i class="ti ti-crown"></i>
                        </div>
                        <div>
                            <p class="xc-currentplan-label">Current Plan</p>
                            <h3 class="xc-currentplan-name">
                                <?php if (!empty($current_plan)): ?>
                                    <?= htmlspecialchars($current_plan->plan_name) ?>
                                <?php else: ?>
                                    Free Trial
                                <?php endif; ?>
                            </h3>
                        </div>
                    </div>

                    <div class="xc-currentplan-divider"></div>

                    <div class="xc-currentplan-details">
                        <div class="xc-currentplan-info-row">
                            <div class="xc-info-icon">
                                <i class="ti ti-calendar"></i>
                            </div>
                            <div>
                                <p class="xc-info-label">Expiry Date</p>
                                <p class="xc-info-value">
                                    <?= !empty($current_plan) ? date('d M Y', strtotime($current_plan->expiry_date)) : '—' ?>
                                </p>
                            </div>
                        </div>

                        <?php
                        $days = !empty($current_plan)
                            ? floor((strtotime($current_plan->expiry_date) - time()) / 86400)
                            : 14;
                        $badge_class = $days > 30 ? 'success' : ($days > 7 ? 'warning' : 'danger');
                        $progress_pct = min(100, max(0, ($days / 30) * 100));
                        ?>

                        <div class="xc-days-remaining">
                            <div class="xc-days-circle xc-<?= $badge_class ?>">
                                <span class="xc-days-number"><?= $days ?></span>
                                <span class="xc-days-text">days left</span>
                            </div>
                        </div>

                        <div class="xc-progress-bar-container">
                            <div class="xc-progress-bar-track">
                                <div class="xc-progress-bar-fill xc-<?= $badge_class ?>"
                                    style="width: <?= $progress_pct ?>%">
                                </div>
                            </div>
                            <div class="xc-progress-label">
                                <span><?= $progress_pct ?>% time remaining</span>
                            </div>
                        </div>
                    </div>

                    <a href="<?= base_url('index.php/plan') ?>" class="xc-currentplan-upgrade-btn">
                        <i class="ti ti-rocket me-2"></i>
                        Upgrade Plan
                        <i class="ti ti-arrow-right ms-auto"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="col-lg-4 col-md-6">
                <div class="xc-quickactions-card">
                    <div class="xc-card-header">
                        <h4 class="xc-card-title">
                            <i class="ti ti-bolt me-2"></i>
                            Quick Actions
                        </h4>
                        <span class="xc-header-badge">6 actions</span>
                    </div>
                    <div class="xc-actions-grid">
                        <a href="<?= base_url('index.php/project/add') ?>" class="xc-action-item xc-action-primary"
                            data-tooltip="Create new project">
                            <div class="xc-action-icon">
                                <i class="ti ti-plus"></i>
                            </div>
                            <span class="xc-action-label">New Project</span>
                            <div class="xc-action-shine"></div>
                        </a>
                        <a href="<?= base_url('index.php/team/add') ?>" class="xc-action-item xc-action-navy"
                            data-tooltip="Add team member">
                            <div class="xc-action-icon">
                                <i class="ti ti-user-plus"></i>
                            </div>
                            <span class="xc-action-label">Add Member</span>
                            <div class="xc-action-shine"></div>
                        </a>
                        <a href="<?= base_url('index.php/customer/add') ?>"
                            class="xc-action-item xc-action-purple-light" data-tooltip="Register new customer">
                            <div class="xc-action-icon">
                                <i class="ti ti-user-check"></i>
                            </div>
                            <span class="xc-action-label">New Customer</span>
                            <div class="xc-action-shine"></div>
                        </a>
                        <a href="<?= base_url('index.php/folder') ?>" class="xc-action-item xc-action-orange"
                            data-tooltip="Organize files">
                            <div class="xc-action-icon">
                                <i class="ti ti-folder-plus"></i>
                            </div>
                            <span class="xc-action-label">Create Folder</span>
                            <div class="xc-action-shine"></div>
                        </a>
                        <a href="<?= base_url('index.php/admin/manpower_report_list') ?>"
                            class="xc-action-item xc-action-purple" data-tooltip="Analytics & insights">
                            <div class="xc-action-icon">
                                <i class="ti ti-chart-bar"></i>
                            </div>
                            <span class="xc-action-label">View Reports</span>
                            <div class="xc-action-shine"></div>
                        </a>
                        <a href="<?= base_url('index.php/profile') ?>" class="xc-action-item xc-action-dark"
                            data-tooltip="Configure settings">
                            <div class="xc-action-icon">
                                <i class="ti ti-settings"></i>
                            </div>
                            <span class="xc-action-label">Settings</span>
                            <div class="xc-action-shine"></div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="col-lg-4 col-md-12">
                <div class="xc-activity-card">
                    <div class="xc-card-header">
                        <h4 class="xc-card-title">
                            <i class="ti ti-clock me-2"></i>
                            Recent Activity
                        </h4>
                        <a href="<?= base_url('index.php/activity') ?>" class="xc-view-all-link">
                            View All
                            <i class="ti ti-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="xc-activity-list">
                        <div class="xc-activity-item">
                            <div class="xc-activity-icon-wrap xc-bg-teal-subtle">
                                <i class="ti ti-file-plus xc-text-teal"></i>
                            </div>
                            <div class="xc-activity-content">
                                <p class="xc-activity-text">New project <strong>"Website Redesign"</strong> created</p>
                                <span class="xc-activity-time">
                                    <i class="ti ti-clock-hour-4"></i> 2 hours ago
                                </span>
                            </div>
                            <div class="xc-activity-indicator xc-new"></div>
                        </div>
                        <div class="xc-activity-item">
                            <div class="xc-activity-icon-wrap xc-bg-success-subtle">
                                <i class="ti ti-user-check xc-text-success"></i>
                            </div>
                            <div class="xc-activity-content">
                                <p class="xc-activity-text"><strong>Sarah Johnson</strong> joined the team</p>
                                <span class="xc-activity-time">
                                    <i class="ti ti-clock-hour-4"></i> 5 hours ago
                                </span>
                            </div>
                        </div>
                        <div class="xc-activity-item">
                            <div class="xc-activity-icon-wrap xc-bg-purple-subtle">
                                <i class="ti ti-upload xc-text-purple"></i>
                            </div>
                            <div class="xc-activity-content">
                                <p class="xc-activity-text">Document uploaded to <strong>"Design Assets"</strong></p>
                                <span class="xc-activity-time">
                                    <i class="ti ti-clock-hour-4"></i> Yesterday
                                </span>
                            </div>
                        </div>
                        <div class="xc-activity-item">
                            <div class="xc-activity-icon-wrap xc-bg-orange-subtle">
                                <i class="ti ti-star xc-text-orange"></i>
                            </div>
                            <div class="xc-activity-content">
                                <p class="xc-activity-text">Plan upgraded to <strong>Premium</strong></p>
                                <span class="xc-activity-time">
                                    <i class="ti ti-clock-hour-4"></i> 2 days ago
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-4">

            <!-- Projects -->
            <div class="col-lg-3 col-md-6">
                <div class="xc-stat-card xc-stat-teal">
                    <div class="xc-card-watermark xc-watermark-dark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="18" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="14" y="8" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="24" y="18" width="18" height="26" rx="4" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="xc-stat-icon-wrap">
                        <div class="xc-icon-wrapper">
                            <i class="ti ti-building-skyscraper"></i>
                        </div>
                    </div>
                    <div class="xc-stat-content">
                        <p class="xc-stat-label">Total Projects</p>
                        <h2 class="xc-stat-value">
                            <span class="counter" data-target="<?= (int) $project_count ?>">0</span>
                        </h2>
                        <div class="xc-stat-footer">
                            <span class="xc-trend xc-trend-up">
                                <i class="ti ti-trending-up"></i> 12% this month
                            </span>
                        </div>
                    </div>
                    <a href="<?= base_url('index.php/project/project_list') ?>" class="xc-stat-link">
                        <span>View all projects</span>
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Team -->
            <div class="col-lg-3 col-md-6">
                <div class="xc-stat-card xc-stat-navy">
                    <div class="xc-card-watermark xc-watermark-dark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="18" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="14" y="8" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="24" y="18" width="18" height="26" rx="4" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="xc-stat-icon-wrap">
                        <div class="xc-icon-wrapper">
                            <i class="ti ti-users-group"></i>
                        </div>
                    </div>
                    <div class="xc-stat-content">
                        <p class="xc-stat-label">Team Members</p>
                        <h2 class="xc-stat-value">
                            <span class="counter" data-target="<?= (int) $team_count ?>">0</span>
                        </h2>
                        <div class="xc-stat-footer">
                            <span class="xc-trend xc-trend-up">
                                <i class="ti ti-trending-up"></i> 3 new members
                            </span>
                        </div>
                    </div>
                    <a href="<?= base_url('index.php/team') ?>" class="xc-stat-link">
                        <span>View all members</span>
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Customers -->
            <div class="col-lg-3 col-md-6">
                <div class="xc-stat-card xc-stat-purple">
                    <div class="xc-card-watermark xc-watermark-dark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="18" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="14" y="8" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="24" y="18" width="18" height="26" rx="4" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="xc-stat-icon-wrap">
                        <div class="xc-icon-wrapper">
                            <i class="ti ti-user-star"></i>
                        </div>
                    </div>
                    <div class="xc-stat-content">
                        <p class="xc-stat-label">Total Customers</p>
                        <h2 class="xc-stat-value">
                            <span class="counter" data-target="<?= (int) $customer_count ?>">0</span>
                        </h2>
                        <div class="xc-stat-footer">
                            <span class="xc-trend xc-trend-up">
                                <i class="ti ti-trending-up"></i> 8% growth
                            </span>
                        </div>
                    </div>
                    <a href="<?= base_url('index.php/customer') ?>" class="xc-stat-link">
                        <span>View all customers</span>
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Folders -->
            <div class="col-lg-3 col-md-6">
                <div class="xc-stat-card xc-stat-orange">
                    <div class="xc-card-watermark xc-watermark-dark" aria-hidden="true">
                        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="18" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="14" y="8" width="18" height="26" rx="4" fill="currentColor" />
                            <rect x="24" y="18" width="18" height="26" rx="4" fill="currentColor" />
                        </svg>
                    </div>
                    <div class="xc-stat-icon-wrap">
                        <div class="xc-icon-wrapper">
                            <i class="ti ti-folders"></i>
                        </div>
                    </div>
                    <div class="xc-stat-content">
                        <p class="xc-stat-label">Total Folders</p>
                        <h2 class="xc-stat-value">
                            <span class="counter" data-target="<?= (int) $folder_count ?>">0</span>
                        </h2>
                        <div class="xc-stat-footer">
                            <span class="xc-trend xc-trend-neutral">
                                <i class="ti ti-minus"></i> No change
                            </span>
                        </div>
                    </div>
                    <a href="<?= base_url('index.php/folder') ?>" class="xc-stat-link">
                        <span>View all folders</span>
                        <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Row: Charts & Additional Info -->
        <div class="row g-4">

            <!-- Project Progress Chart -->
            <div class="col-lg-8">
                <div class="xc-chart-card">
                    <div class="xc-card-header">
                        <div>
                            <h4 class="xc-card-title">
                                <i class="ti ti-chart-line me-2"></i>
                                Project Progress Overview
                            </h4>
                            <p class="xc-card-subtitle">
                                <i class="ti ti-calendar me-1"></i>
                                Last 6 months performance tracking
                            </p>
                        </div>
                        <div class="xc-chart-filters">
                            <button class="xc-filter-btn active" data-filter="6months">6M</button>
                            <button class="xc-filter-btn" data-filter="3months">3M</button>
                            <button class="xc-filter-btn" data-filter="1month">1M</button>
                        </div>
                    </div>
                    <div class="xc-chart-container">
                        <canvas id="projectProgressChart"></canvas>
                    </div>
                    <div class="xc-chart-legend">
                        <div class="xc-legend-item">
                            <span class="xc-legend-color"
                                style="background: linear-gradient(135deg, #0fb4a0, #0c9786);"></span>
                            <span class="xc-legend-label">Completed Projects</span>
                            <span class="xc-legend-value">30</span>
                        </div>
                        <div class="xc-legend-item">
                            <span class="xc-legend-color"
                                style="background: linear-gradient(135deg, #7c3aed, #6d28d9);"></span>
                            <span class="xc-legend-label">In Progress</span>
                            <span class="xc-legend-value">20</span>
                        </div>
                        <div class="xc-legend-item">
                            <span class="xc-legend-color"
                                style="background: linear-gradient(135deg, #f97316, #ea580c);"></span>
                            <span class="xc-legend-label">Pending</span>
                            <span class="xc-legend-value">5</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Performance -->
            <div class="col-lg-4">
                <div class="xc-teamperf-card">
                    <div class="xc-card-header">
                        <h4 class="xc-card-title">
                            <i class="ti ti-trophy me-2"></i>
                            Top Performers
                        </h4>
                        <span class="xc-header-badge">This Month</span>
                    </div>
                    <div class="xc-performers-list">
                        <div class="xc-performer-item">
                            <div class="xc-performer-avatar">
                                <img src="<?= base_url('assets/images/avatars/1.png') ?>" alt="User"
                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%230fb4a0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-size=%2240%22 fill=%22white%22%3EJS%3C/text%3E%3C/svg%3E'">
                                <span class="xc-rank-badge xc-gold">
                                    <i class="ti ti-trophy"></i>
                                </span>
                            </div>
                            <div class="xc-performer-info">
                                <h5 class="xc-performer-name">John Smith</h5>
                                <p class="xc-performer-role">
                                    <i class="ti ti-briefcase me-1"></i>
                                    Project Manager
                                </p>
                            </div>
                            <div class="xc-performer-score">
                                <span class="xc-score">98</span>
                                <div class="xc-score-bar">
                                    <div class="xc-score-fill xc-gold" style="width: 98%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="xc-performer-item">
                            <div class="xc-performer-avatar">
                                <img src="<?= base_url('assets/images/avatars/2.png') ?>" alt="User"
                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%237c3aed%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-size=%2240%22 fill=%22white%22%3EEW%3C/text%3E%3C/svg%3E'">
                                <span class="xc-rank-badge xc-silver">
                                    <i class="ti ti-medal"></i>
                                </span>
                            </div>
                            <div class="xc-performer-info">
                                <h5 class="xc-performer-name">Emma Wilson</h5>
                                <p class="xc-performer-role">
                                    <i class="ti ti-code me-1"></i>
                                    Developer
                                </p>
                            </div>
                            <div class="xc-performer-score">
                                <span class="xc-score">95</span>
                                <div class="xc-score-bar">
                                    <div class="xc-score-fill xc-silver" style="width: 95%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="xc-performer-item">
                            <div class="xc-performer-avatar">
                                <img src="<?= base_url('assets/images/avatars/3.png') ?>" alt="User"
                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%23f97316%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-size=%2240%22 fill=%22white%22%3EMB%3C/text%3E%3C/svg%3E'">
                                <span class="xc-rank-badge xc-bronze">
                                    <i class="ti ti-award"></i>
                                </span>
                            </div>
                            <div class="xc-performer-info">
                                <h5 class="xc-performer-name">Michael Brown</h5>
                                <p class="xc-performer-role">
                                    <i class="ti ti-palette me-1"></i>
                                    Designer
                                </p>
                            </div>
                            <div class="xc-performer-score">
                                <span class="xc-score">92</span>
                                <div class="xc-score-bar">
                                    <div class="xc-score-fill xc-bronze" style="width: 92%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="xc-performer-item">
                            <div class="xc-performer-avatar">
                                <img src="<?= base_url('assets/images/avatars/4.png') ?>" alt="User"
                                    onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Crect fill=%22%238a8f98%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22Arial%22 font-size=%2240%22 fill=%22white%22%3ESD%3C/text%3E%3C/svg%3E'">
                                <span class="xc-rank-badge">4</span>
                            </div>
                            <div class="xc-performer-info">
                                <h5 class="xc-performer-name">Sarah Davis</h5>
                                <p class="xc-performer-role">
                                    <i class="ti ti-chart-line me-1"></i>
                                    Marketing
                                </p>
                            </div>
                            <div class="xc-performer-score">
                                <span class="xc-score">88</span>
                                <div class="xc-score-bar">
                                    <div class="xc-score-fill" style="width: 88%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('index.php/team/performance') ?>" class="xc-view-all-performance">
                        <i class="ti ti-users me-2"></i>
                        View All Team Performance
                        <i class="ti ti-arrow-right ms-auto"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link
    href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&display=swap"
    rel="stylesheet">

<style>
    /* ==================== Design Tokens (X-CHECK theme) ==================== */
    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0c9786;
        --xc-teal-light: #16c5af;
        --xc-navy: #1a1a2e;
        --xc-navy-soft: #2a2f55;
        --xc-purple: #7c3aed;
        --xc-purple-dark: #6d28d9;
        --xc-purple-light: #8b5cf6;
        --xc-orange: #f97316;
        --xc-orange-dark: #ea580c;
        --xc-orange-light: #fb923c;
        --xc-danger: #ef4444;
        --xc-success: #10b981;
        --xc-surface: #ffffff;
        --xc-bg: #f3f5fa;
        --xc-border: #e6e9f2;
        --xc-muted: #8a8f98;
        --xc-shadow: 0 4px 20px rgba(26, 26, 46, 0.08);
        --xc-shadow-lg: 0 10px 40px rgba(26, 26, 46, 0.12);
        --xc-shadow-xl: 0 20px 60px rgba(26, 26, 46, 0.15);

        --xc-font-display: 'Sora', 'Segoe UI', sans-serif;
        --xc-font-body: 'Inter', 'Segoe UI', sans-serif;
        --xc-font-mono: 'JetBrains Mono', 'SFMono-Regular', monospace;
    }

    /* ==================== General ==================== */
    .xc-dash-content {
        background: linear-gradient(135deg, #f8fbfa 0%, #f3f5fa 100%);
        padding: 2rem;
        font-family: var(--xc-font-body);
        min-height: 100vh;
    }

    .xc-dash-content h2,
    .xc-dash-content h3,
    .xc-dash-content h4,
    .xc-dash-content h5 {
        font-family: var(--xc-font-display);
    }

    /* ==================== Welcome Banner ==================== */
    .xc-welcome-banner {
        border-radius: 24px;
        box-shadow: var(--xc-shadow-xl), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        position: relative;
        overflow: hidden;
    }

    .xc-welcome-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('data:image/svg+xml,%3Csvg width="60" height="60" xmlns="http://www.w3.org/2000/svg"%3E%3Cdefs%3E%3Cpattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"%3E%3Cpath d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="1"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width="100%25" height="100%25" fill="url(%23grid)" /%3E%3C/svg%3E');
        opacity: 0.5;
        pointer-events: none;
    }

    .xc-banner-grid {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        padding: 2.5rem;
        z-index: 1;
        background: linear-gradient(135deg, #0d3d3a 0%, var(--xc-teal) 55%, var(--xc-teal-light) 100%);
        color: #ffffff;
    }

    .xc-banner-glow {
        position: absolute;
        pointer-events: none;
        filter: blur(50px);
        animation: xcFloat 8s ease-in-out infinite;
    }

    .xc-banner-glow.xc-glow-one {
        top: -60%;
        right: -10%;
        width: 60%;
        height: 220%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 65%);
    }

    .xc-banner-glow.xc-glow-two {
        bottom: -40%;
        left: -5%;
        width: 50%;
        height: 180%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 60%);
        animation-duration: 10s;
        animation-direction: reverse;
    }

    @keyframes xcFloat {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        33% {
            transform: translate(30px, -30px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    .xc-brand-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        opacity: 0.95;
        position: relative;
        z-index: 1;
    }

    .xc-brand-mark {
        width: 32px;
        height: 32px;
        display: inline-flex;
        filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
    }

    .xc-brand-mark svg {
        width: 100%;
        height: 100%;
    }

    .xc-brand-word {
        font-family: var(--xc-font-display);
        font-weight: 700;
        letter-spacing: 0.5px;
        font-size: 1.05rem;
        text-transform: uppercase;
        color: #ffffff;
    }

    .xc-dashboard-title {
        position: relative;
        z-index: 1;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        line-height: 1.2;
        color: #ffffff;
    }

    .xc-wave-emoji {
        display: inline-block;
        animation: xcWave 2s ease-in-out infinite;
        font-size: 2rem;
    }

    @keyframes xcWave {

        0%,
        100% {
            transform: rotate(0deg);
        }

        10%,
        30% {
            transform: rotate(14deg);
        }

        20% {
            transform: rotate(-8deg);
        }

        40% {
            transform: rotate(-4deg);
        }

        50% {
            transform: rotate(10deg);
        }
    }

    .xc-user-name {
        background: rgba(255, 255, 255, 0.18);
        padding: 0.3rem 1.2rem;
        border-radius: 50px;
        font-size: 1.9rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        color: #ffffff;
    }

    .xc-dashboard-subtitle {
        position: relative;
        z-index: 1;
        font-size: 1.05rem;
        opacity: 0.9;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #ffffff;
    }

    .xc-current-date {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.25);
        padding: 0.85rem 1.75rem;
        border-radius: 50px;
        backdrop-filter: blur(15px);
        display: inline-flex;
        align-items: center;
        font-weight: 600;
        font-size: 0.92rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        color: #ffffff;
    }

    /* ==================== Watermark ==================== */
    .xc-card-watermark {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        width: 32px;
        height: 32px;
        z-index: 1;
        pointer-events: none;
    }

    .xc-card-watermark svg {
        width: 100%;
        height: 100%;
    }

    .xc-watermark-light {
        color: var(--xc-teal);
        opacity: 0.08;
    }

    .xc-watermark-dark {
        color: var(--xc-navy);
        opacity: 0.04;
    }

    /* ==================== Current Plan Card ==================== */
    .xc-currentplan-card {
        position: relative;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e6f7f5;
        border-radius: 24px;
        padding: 2.25rem;
        color: #1a1a2e;
        height: 100%;
        box-shadow: var(--xc-shadow);
    }

    .xc-currentplan-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(15, 180, 160, 0.06) 0%, transparent 60%);
        animation: xcPulse 5s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes xcPulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.5;
        }

        50% {
            transform: scale(1.15);
            opacity: 0.3;
        }
    }

    .xc-currentplan-header {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        position: relative;
        z-index: 2;
        margin-bottom: 0.5rem;
    }

    .xc-currentplan-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--xc-teal), var(--xc-teal-light));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(15, 180, 160, 0.3);
        flex-shrink: 0;
    }

    .xc-currentplan-label {
        font-size: 0.78rem;
        color: #6b7280;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 700;
    }

    .xc-currentplan-name {
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0.3rem 0 0;
        font-family: var(--xc-font-display);
        letter-spacing: -0.3px;
        color: #1a1a2e;
    }

    .xc-currentplan-divider {
        height: 1px;
        background: linear-gradient(90deg, #e6f7f5, transparent);
        margin: 1.5rem 0;
        position: relative;
        z-index: 2;
    }

    .xc-currentplan-details {
        position: relative;
        z-index: 2;
    }

    .xc-currentplan-info-row {
        display: flex;
        align-items: center;
        gap: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .xc-info-icon {
        width: 44px;
        height: 44px;
        background: #e6f7f5;
        color: var(--xc-teal);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .xc-info-label {
        font-size: 0.78rem;
        color: #9ca3af;
        margin: 0;
        font-weight: 600;
    }

    .xc-info-value {
        font-size: 1.05rem;
        font-weight: 700;
        margin: 0.25rem 0 0;
        font-family: var(--xc-font-mono);
        color: #1a1a2e;
    }

    .xc-days-remaining {
        display: flex;
        justify-content: center;
        margin: 1.75rem 0;
    }

    .xc-days-circle {
        width: 120px;
        height: 120px;
        background: #ffffff;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 5px solid;
        box-shadow: var(--xc-shadow), 0 0 0 8px rgba(15, 180, 160, 0.05);
    }

    .xc-days-number {
        font-size: 2.4rem;
        font-weight: 800;
        line-height: 1;
        font-family: var(--xc-font-mono);
    }

    .xc-days-text {
        font-size: 0.78rem;
        color: #6b7280;
        margin-top: 0.35rem;
        font-weight: 600;
    }

    .xc-days-circle.xc-success {
        border-color: var(--xc-teal);
    }

    .xc-days-circle.xc-success .xc-days-number {
        color: var(--xc-teal);
    }

    .xc-days-circle.xc-warning {
        border-color: var(--xc-orange);
    }

    .xc-days-circle.xc-warning .xc-days-number {
        color: var(--xc-orange);
    }

    .xc-days-circle.xc-danger {
        border-color: var(--xc-danger);
    }

    .xc-days-circle.xc-danger .xc-days-number {
        color: var(--xc-danger);
    }

    .xc-progress-bar-container {
        margin-top: 1.75rem;
    }

    .xc-progress-bar-track {
        height: 10px;
        background: #eef2f5;
        border-radius: 12px;
        overflow: hidden;
    }

    .xc-progress-bar-fill {
        height: 100%;
        border-radius: 12px;
        transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .xc-progress-bar-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5), transparent);
        animation: xcShimmer 2s infinite;
    }

    @keyframes xcShimmer {
        to {
            left: 100%;
        }
    }

    .xc-progress-bar-fill.xc-success {
        background: linear-gradient(90deg, var(--xc-teal), var(--xc-teal-light));
    }

    .xc-progress-bar-fill.xc-warning {
        background: linear-gradient(90deg, var(--xc-orange), var(--xc-orange-light));
    }

    .xc-progress-bar-fill.xc-danger {
        background: linear-gradient(90deg, var(--xc-danger), #f87171);
    }

    .xc-progress-label {
        display: flex;
        justify-content: flex-end;
        margin-top: 0.75rem;
        font-size: 0.8rem;
        color: #9ca3af;
        font-weight: 600;
    }

    .xc-currentplan-upgrade-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--xc-teal), var(--xc-teal-light));
        color: #ffffff;
        text-align: center;
        padding: 1.05rem 1.5rem;
        border-radius: 14px;
        font-weight: 700;
        margin-top: 1.75rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 20px rgba(15, 180, 160, 0.3);
    }

    .xc-currentplan-upgrade-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(15, 180, 160, 0.4);
        color: #ffffff;
        background: linear-gradient(135deg, var(--xc-teal-light), var(--xc-teal));
    }

    /* ==================== Quick Actions Card ==================== */
    .xc-quickactions-card {
        background: var(--xc-surface);
        border-radius: 24px;
        padding: 2.25rem;
        height: 100%;
        box-shadow: var(--xc-shadow);
        border: 1px solid var(--xc-border);
    }

    .xc-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .xc-card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--xc-navy);
        margin: 0;
        display: flex;
        align-items: center;
    }

    .xc-card-title i {
        color: var(--xc-teal);
    }

    .xc-header-badge {
        background: linear-gradient(135deg, rgba(15, 180, 160, 0.1), rgba(15, 180, 160, 0.05));
        color: var(--xc-teal-dark);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        border: 1px solid rgba(15, 180, 160, 0.2);
    }

    .xc-card-subtitle {
        font-size: 0.88rem;
        color: var(--xc-muted);
        margin: 0.4rem 0 0;
        display: flex;
        align-items: center;
    }

    .xc-view-all-link {
        color: var(--xc-teal-dark);
        font-size: 0.88rem;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .xc-view-all-link:hover {
        color: var(--xc-navy);
        gap: 0.5rem;
    }

    .xc-actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }

    .xc-action-item {
        padding: 1.6rem 1.2rem;
        border-radius: 18px;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .xc-action-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(26, 26, 46, 0.18);
    }

    .xc-action-shine {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.15) 50%, transparent 70%);
        transform: rotate(45deg);
        transition: all 0.6s;
        opacity: 0;
    }

    .xc-action-item:hover .xc-action-shine {
        animation: xcShine 1s;
    }

    @keyframes xcShine {
        to {
            left: 100%;
            opacity: 1;
        }
    }

    .xc-action-primary {
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
    }

    .xc-action-navy {
        background: linear-gradient(135deg, var(--xc-navy-soft) 0%, var(--xc-navy) 100%);
    }

    .xc-action-purple-light {
        background: linear-gradient(135deg, #9d8cf1 0%, var(--xc-purple-light) 100%);
    }

    .xc-action-orange {
        background: linear-gradient(135deg, var(--xc-orange-light) 0%, var(--xc-orange) 100%);
    }

    .xc-action-purple {
        background: linear-gradient(135deg, var(--xc-purple-light) 0%, var(--xc-purple-dark) 100%);
    }

    .xc-action-dark {
        background: linear-gradient(135deg, #23274a 0%, var(--xc-navy) 100%);
    }

    .xc-action-icon {
        width: 52px;
        height: 52px;
        background: rgba(255, 255, 255, 0.25);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .xc-action-label {
        color: white;
        font-weight: 700;
        font-size: 0.92rem;
    }

    /* ==================== Activity Card ==================== */
    .xc-activity-card {
        background: var(--xc-surface);
        border-radius: 24px;
        padding: 2.25rem;
        height: 100%;
        box-shadow: var(--xc-shadow);
        border: 1px solid var(--xc-border);
    }

    .xc-activity-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        max-height: 420px;
        overflow-y: auto;
        padding-right: 0.75rem;
    }

    .xc-activity-list::-webkit-scrollbar {
        width: 6px;
    }

    .xc-activity-list::-webkit-scrollbar-track {
        background: #f1f3f8;
        border-radius: 10px;
    }

    .xc-activity-list::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }

    .xc-activity-list::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    .xc-activity-item {
        display: flex;
        gap: 1.25rem;
        padding: 1.25rem;
        border-radius: 16px;
        background: var(--xc-bg);
        border: 1px solid transparent;
        transition: all 0.3s;
        position: relative;
    }

    .xc-activity-item:hover {
        border-color: var(--xc-border);
        background: white;
        box-shadow: var(--xc-shadow);
        transform: translateX(4px);
    }

    .xc-activity-indicator {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--xc-teal);
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.2);
    }

    .xc-activity-indicator.xc-new {
        display: block;
        animation: xcPulseDot 2s infinite;
    }

    @keyframes xcPulseDot {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.2);
            opacity: 0.7;
        }
    }

    .xc-activity-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.3rem;
    }

    .xc-bg-teal-subtle {
        background: linear-gradient(135deg, rgba(15, 180, 160, 0.15), rgba(15, 180, 160, 0.08));
        border: 1px solid rgba(15, 180, 160, 0.2);
    }

    .xc-bg-success-subtle {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.08));
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .xc-bg-purple-subtle {
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(124, 58, 237, 0.08));
        border: 1px solid rgba(124, 58, 237, 0.2);
    }

    .xc-bg-orange-subtle {
        background: linear-gradient(135deg, rgba(249, 115, 22, 0.15), rgba(249, 115, 22, 0.08));
        border: 1px solid rgba(249, 115, 22, 0.2);
    }

    .xc-text-teal {
        color: var(--xc-teal-dark);
    }

    .xc-text-success {
        color: #059669;
    }

    .xc-text-purple {
        color: var(--xc-purple);
    }

    .xc-text-orange {
        color: var(--xc-orange-dark);
    }

    .xc-activity-content {
        flex: 1;
    }

    .xc-activity-text {
        color: #33384f;
        margin: 0 0 0.5rem;
        font-size: 0.95rem;
        line-height: 1.5;
        font-weight: 500;
    }

    .xc-activity-text strong {
        color: var(--xc-navy);
        font-weight: 700;
    }

    .xc-activity-time {
        color: var(--xc-muted);
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        font-weight: 600;
    }

    /* ==================== Stat Cards ==================== */
    .xc-stat-card {
        background: var(--xc-surface);
        border-radius: 24px;
        padding: 2.25rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--xc-border);
        box-shadow: var(--xc-shadow);
    }

    .xc-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--xc-teal), var(--xc-teal-dark));
        opacity: 0;
        transition: opacity 0.3s;
    }

    .xc-stat-card:hover::before {
        opacity: 1;
    }

    .xc-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--xc-shadow-lg);
    }

    .xc-stat-icon-wrap {
        position: relative;
        margin-bottom: 1.75rem;
    }

    .xc-icon-wrapper {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        position: relative;
        z-index: 2;
        color: white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .xc-stat-teal .xc-icon-wrapper {
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
    }

    .xc-stat-navy .xc-icon-wrapper {
        background: linear-gradient(135deg, var(--xc-navy-soft) 0%, var(--xc-navy) 100%);
    }

    .xc-stat-purple .xc-icon-wrapper {
        background: linear-gradient(135deg, var(--xc-purple-light) 0%, var(--xc-purple) 100%);
    }

    .xc-stat-orange .xc-icon-wrapper {
        background: linear-gradient(135deg, var(--xc-orange-light) 0%, var(--xc-orange) 100%);
    }

    .xc-stat-label {
        color: var(--xc-muted);
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .xc-stat-value {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--xc-navy);
        margin: 0 0 1.25rem;
        font-family: var(--xc-font-mono);
        line-height: 1;
    }

    .xc-stat-footer {
        margin-top: 1rem;
    }

    .xc-trend {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
    }

    .xc-trend-up {
        background: linear-gradient(135deg, rgba(15, 180, 160, 0.12), rgba(15, 180, 160, 0.06));
        color: var(--xc-teal-dark);
        border: 1px solid rgba(15, 180, 160, 0.2);
    }

    .xc-trend-neutral {
        background: linear-gradient(135deg, rgba(138, 143, 152, 0.12), rgba(138, 143, 152, 0.06));
        color: var(--xc-muted);
        border: 1px solid rgba(138, 143, 152, 0.2);
    }

    .xc-stat-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1.75rem;
        padding-top: 1.75rem;
        border-top: 1px solid var(--xc-border);
        color: var(--xc-teal-dark);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.92rem;
        transition: all 0.3s;
    }

    .xc-stat-link:hover {
        color: var(--xc-navy);
        padding-left: 0.5rem;
    }

    .xc-stat-link i {
        transition: transform 0.3s;
    }

    .xc-stat-link:hover i {
        transform: translateX(5px);
    }

    /* ==================== Chart Card ==================== */
    .xc-chart-card {
        background: var(--xc-surface);
        border-radius: 24px;
        padding: 2.25rem;
        box-shadow: var(--xc-shadow);
        border: 1px solid var(--xc-border);
    }

    .xc-chart-filters {
        display: flex;
        gap: 0.5rem;
        background: var(--xc-bg);
        padding: 0.35rem;
        border-radius: 12px;
        border: 1px solid var(--xc-border);
    }

    .xc-filter-btn {
        padding: 0.55rem 1.1rem;
        border: none;
        background: transparent;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--xc-muted);
        cursor: pointer;
        transition: all 0.3s;
    }

    .xc-filter-btn.active,
    .xc-filter-btn:hover {
        background: white;
        color: var(--xc-teal-dark);
        box-shadow: 0 2px 10px rgba(26, 26, 46, 0.08);
    }

    .xc-chart-container {
        margin-top: 2rem;
        position: relative;
        height: 320px;
    }

    .xc-chart-legend {
        display: flex;
        gap: 2rem;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--xc-border);
        flex-wrap: wrap;
    }

    .xc-legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .xc-legend-color {
        width: 32px;
        height: 12px;
        border-radius: 6px;
    }

    .xc-legend-label {
        font-size: 0.88rem;
        color: var(--xc-muted);
        font-weight: 600;
    }

    .xc-legend-value {
        font-size: 1rem;
        color: var(--xc-navy);
        font-weight: 800;
        font-family: var(--xc-font-mono);
    }

    /* ==================== Team Performance Card ==================== */
    .xc-teamperf-card {
        background: var(--xc-surface);
        border-radius: 24px;
        padding: 2.25rem;
        height: 100%;
        box-shadow: var(--xc-shadow);
        border: 1px solid var(--xc-border);
        display: flex;
        flex-direction: column;
    }

    .xc-performers-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        flex: 1;
    }

    .xc-performer-item {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1.1rem;
        background: var(--xc-bg);
        border-radius: 18px;
        transition: all 0.3s;
        border: 1px solid transparent;
    }

    .xc-performer-item:hover {
        background: white;
        transform: translateX(6px);
        border-color: var(--xc-border);
        box-shadow: var(--xc-shadow);
    }

    .xc-performer-avatar {
        position: relative;
        flex-shrink: 0;
    }

    .xc-performer-avatar img {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .xc-rank-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #cbd5e0;
        color: white;
        font-size: 0.7rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .xc-rank-badge.xc-gold {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: #8b6508;
    }

    .xc-rank-badge.xc-silver {
        background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%);
        color: #6b6b6b;
    }

    .xc-rank-badge.xc-bronze {
        background: linear-gradient(135deg, #cd7f32 0%, #d4af37 100%);
        color: #5c3c1a;
    }

    .xc-performer-info {
        flex: 1;
        min-width: 0;
    }

    .xc-performer-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--xc-navy);
        margin: 0 0 0.25rem;
    }

    .xc-performer-role {
        font-size: 0.8rem;
        color: var(--xc-muted);
        margin: 0;
        display: flex;
        align-items: center;
        font-weight: 600;
    }

    .xc-performer-score {
        text-align: right;
        flex-shrink: 0;
    }

    .xc-score {
        display: block;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--xc-teal-dark);
        margin-bottom: 0.4rem;
        font-family: var(--xc-font-mono);
    }

    .xc-score-bar {
        width: 64px;
        height: 7px;
        background: rgba(15, 180, 160, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .xc-score-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--xc-teal), var(--xc-teal-dark));
        border-radius: 10px;
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .xc-score-fill::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        animation: xcShimmer 2s infinite;
    }

    .xc-score-fill.xc-gold {
        background: linear-gradient(90deg, #ffd700, #ffed4e);
    }

    .xc-score-fill.xc-silver {
        background: linear-gradient(90deg, #c0c0c0, #e8e8e8);
    }

    .xc-score-fill.xc-bronze {
        background: linear-gradient(90deg, #cd7f32, #d4af37);
    }

    .xc-view-all-performance {
        margin-top: 1.75rem;
        padding: 1.1rem 1.5rem;
        background: linear-gradient(135deg, var(--xc-bg), white);
        border: 1px solid var(--xc-border);
        border-radius: 14px;
        color: var(--xc-teal-dark);
        text-decoration: none;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        text-align: center;
        justify-content: center;
    }

    .xc-view-all-performance:hover {
        background: white;
        box-shadow: var(--xc-shadow);
        color: var(--xc-navy);
        transform: translateY(-2px);
    }

    /* ==================== Responsive ==================== */
    @media (max-width: 1199px) {
        .xc-chart-container {
            height: 280px;
        }
    }

    @media (max-width: 991px) {
        .xc-dashboard-title {
            font-size: 1.8rem;
        }

        .xc-user-name {
            font-size: 1.6rem;
        }

        .xc-actions-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .xc-stat-value {
            font-size: 2.4rem;
        }
    }

    @media (max-width: 767px) {
        .xc-dash-content {
            padding: 1.25rem;
        }

        .xc-banner-grid {
            padding: 1.75rem;
            text-align: center;
        }

        .xc-brand-row {
            justify-content: center;
        }

        .xc-dashboard-title {
            justify-content: center;
        }

        .xc-current-date {
            margin-top: 1rem;
        }

        .xc-actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .xc-stat-value {
            font-size: 2.2rem;
        }

        .xc-chart-filters {
            flex-wrap: wrap;
        }

        .xc-chart-legend {
            gap: 1rem;
        }

        .xc-performer-avatar img {
            width: 44px;
            height: 44px;
        }
    }

    @media (max-width: 575px) {
        .xc-dashboard-title {
            font-size: 1.4rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .xc-user-name {
            font-size: 1.4rem;
        }

        .xc-currentplan-card,
        .xc-quickactions-card,
        .xc-activity-card,
        .xc-chart-card,
        .xc-teamperf-card {
            padding: 1.75rem;
        }

        .xc-days-circle {
            width: 110px;
            height: 110px;
        }

        .xc-days-number {
            font-size: 2.4rem;
        }

        .xc-stat-value {
            font-size: 2rem;
        }

        .xc-chart-container {
            height: 240px;
        }
    }

    /* ==================== DARK MODE (X-CHECK Dashboard) ==================== */

    [data-bs-theme="dark"] .xc-dash-content {
        background: linear-gradient(135deg, #12141f 0%, #181a2b 100%);
    }

    [data-bs-theme="dark"] .xc-banner-grid {
        background: linear-gradient(135deg, #052e2b 0%, #0a6f63 55%, #0c9786 100%);
    }

    /* Surface cards -> dark surface */
    [data-bs-theme="dark"] .xc-currentplan-card,
    [data-bs-theme="dark"] .xc-quickactions-card,
    [data-bs-theme="dark"] .xc-activity-card,
    [data-bs-theme="dark"] .xc-chart-card,
    [data-bs-theme="dark"] .xc-teamperf-card,
    [data-bs-theme="dark"] .xc-stat-card {
        background: #1e2136;
        border-color: rgba(255, 255, 255, 0.06);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    }

    [data-bs-theme="dark"] .xc-currentplan-card {
        border-color: rgba(15, 180, 160, 0.18);
    }

    [data-bs-theme="dark"] .xc-currentplan-card::before {
        background: radial-gradient(circle, rgba(15, 180, 160, 0.1) 0%, transparent 60%);
    }

    /* Headline / value text -> light */
    [data-bs-theme="dark"] .xc-currentplan-name,
    [data-bs-theme="dark"] .xc-info-value,
    [data-bs-theme="dark"] .xc-card-title,
    [data-bs-theme="dark"] .xc-stat-value,
    [data-bs-theme="dark"] .xc-performer-name,
    [data-bs-theme="dark"] .xc-legend-value,
    [data-bs-theme="dark"] .xc-activity-text strong {
        color: #f1f5f9;
    }

    /* Muted / label text -> soft gray */
    [data-bs-theme="dark"] .xc-currentplan-label,
    [data-bs-theme="dark"] .xc-info-label,
    [data-bs-theme="dark"] .xc-days-text,
    [data-bs-theme="dark"] .xc-progress-label,
    [data-bs-theme="dark"] .xc-card-subtitle,
    [data-bs-theme="dark"] .xc-stat-label,
    [data-bs-theme="dark"] .xc-activity-time,
    [data-bs-theme="dark"] .xc-performer-role,
    [data-bs-theme="dark"] .xc-legend-label {
        color: #94a3b8;
    }

    [data-bs-theme="dark"] .xc-activity-text {
        color: #cbd5e1;
    }

    /* Icon / circle / progress backgrounds */
    [data-bs-theme="dark"] .xc-info-icon {
        background: rgba(15, 180, 160, 0.14);
    }

    [data-bs-theme="dark"] .xc-days-circle {
        background: #181a2b;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35), 0 0 0 8px rgba(15, 180, 160, 0.08);
    }

    [data-bs-theme="dark"] .xc-progress-bar-track {
        background: #2a2e45;
    }

    [data-bs-theme="dark"] .xc-currentplan-divider {
        background: linear-gradient(90deg, rgba(15, 180, 160, 0.3), transparent);
    }

    /* Activity + performer rows */
    [data-bs-theme="dark"] .xc-activity-item,
    [data-bs-theme="dark"] .xc-performer-item {
        background: #181a2b;
    }

    [data-bs-theme="dark"] .xc-activity-item:hover,
    [data-bs-theme="dark"] .xc-performer-item:hover {
        background: #20243a;
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .xc-activity-list::-webkit-scrollbar-track {
        background: #181a2b;
    }

    [data-bs-theme="dark"] .xc-activity-list::-webkit-scrollbar-thumb {
        background: #3a3f5c;
    }

    /* Badges / filters / footer buttons that used hardcoded white */
    [data-bs-theme="dark"] .xc-header-badge {
        background: linear-gradient(135deg, rgba(15, 180, 160, 0.2), rgba(15, 180, 160, 0.08));
        border-color: rgba(15, 180, 160, 0.3);
    }

    [data-bs-theme="dark"] .xc-chart-filters {
        background: #181a2b;
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .xc-filter-btn.active,
    [data-bs-theme="dark"] .xc-filter-btn:hover {
        background: #2a2e45;
        color: #5eead4;
        box-shadow: none;
    }

    [data-bs-theme="dark"] .xc-view-all-performance {
        background: linear-gradient(135deg, #181a2b, #1e2136);
        border-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .xc-view-all-performance:hover {
        background: #20243a;
    }

    /* Borders/dividers driven by var(--xc-border), pin to translucent white */
    [data-bs-theme="dark"] .xc-stat-link,
    [data-bs-theme="dark"] .xc-chart-legend {
        border-color: rgba(255, 255, 255, 0.08);
    }

    /* Watermark svgs should stay faint but visible on dark surfaces */
    [data-bs-theme="dark"] .xc-watermark-dark {
        color: #ffffff;
        opacity: 0.05;
    }

    /* Avatar / days-circle white borders -> match dark surface */
    [data-bs-theme="dark"] .xc-performer-avatar img {
        border-color: #1e2136;
    }

    [data-bs-theme="dark"] .xc-rank-badge {
        border-color: #1e2136;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Current Date Display
    function updateCurrentDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
    }
    updateCurrentDate();

    // Counter Animation with Intersection Observer
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 1800;
        const increment = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }

    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter');
                counters.forEach(counter => {
                    if (!counter.classList.contains('animated')) {
                        animateCounter(counter);
                        counter.classList.add('animated');
                    }
                });
            }
        });
    }, observerOptions);

    document.querySelectorAll('.xc-stat-card').forEach(card => {
        observer.observe(card);
    });

    // ---- Theme-aware Chart.js colors ----
    function xcGetChartTheme() {
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        return {
            isDark,
            tick: isDark ? '#94a3b8' : '#8a8f98',
            grid: isDark ? 'rgba(255, 255, 255, 0.06)' : 'rgba(26, 26, 46, 0.06)',
            tooltipBg: isDark ? 'rgba(15, 17, 30, 0.95)' : 'rgba(26, 26, 46, 0.95)'
        };
    }

    // Chart.js - Project Progress Chart
    const ctx = document.getElementById('projectProgressChart');
    let xcProjectChart = null;

    if (ctx) {
        const gradient1 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient1.addColorStop(0, 'rgba(15, 180, 160, 0.3)');
        gradient1.addColorStop(1, 'rgba(15, 180, 160, 0.01)');

        const gradient2 = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient2.addColorStop(0, 'rgba(124, 58, 237, 0.25)');
        gradient2.addColorStop(1, 'rgba(124, 58, 237, 0.01)');

        const xcTheme = xcGetChartTheme();

        xcProjectChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Completed Projects',
                    data: [12, 19, 15, 25, 22, 30],
                    borderColor: '#0fb4a0',
                    backgroundColor: gradient1,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#0fb4a0',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#0fb4a0',
                    pointHoverBorderWidth: 3,
                    borderWidth: 3
                }, {
                    label: 'In Progress',
                    data: [8, 12, 10, 15, 18, 20],
                    borderColor: '#7c3aed',
                    backgroundColor: gradient2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#7c3aed',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#7c3aed',
                    pointHoverBorderWidth: 3,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: xcTheme.tooltipBg,
                        padding: 16,
                        borderRadius: 12,
                        titleFont: {
                            size: 14,
                            weight: 700,
                            family: "'Sora', sans-serif"
                        },
                        bodyFont: {
                            size: 13,
                            family: "'Inter', sans-serif"
                        },
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        displayColors: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        boxPadding: 6
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: xcTheme.grid,
                            drawBorder: false,
                            lineWidth: 1
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 600
                            },
                            color: xcTheme.tick,
                            padding: 12
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12,
                                weight: 600
                            },
                            color: xcTheme.tick,
                            padding: 12
                        }
                    }
                }
            }
        });
    }

    // Keep the chart in sync when dark mode is toggled anywhere on the page
    // (app.js flips html[data-bs-theme] — this just watches for that change)
    if (xcProjectChart) {
        const xcThemeObserver = new MutationObserver(function (mutations) {
            mutations.forEach(function (m) {
                if (m.attributeName === 'data-bs-theme') {
                    const t = xcGetChartTheme();
                    xcProjectChart.options.scales.y.ticks.color = t.tick;
                    xcProjectChart.options.scales.x.ticks.color = t.tick;
                    xcProjectChart.options.scales.y.grid.color = t.grid;
                    xcProjectChart.options.plugins.tooltip.backgroundColor = t.tooltipBg;
                    xcProjectChart.update();
                }
            });
        });
        xcThemeObserver.observe(document.documentElement, { attributes: true });
    }

    // Chart Filter Buttons
    document.querySelectorAll('.xc-filter-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.xc-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            console.log('Filter changed to:', this.getAttribute('data-filter'));
        });
    });

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>