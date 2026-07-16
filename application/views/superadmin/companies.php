<div class="page-wrapper company-listing">
    <style>
        .company-listing {
            --cl-primary: 79, 70, 229;
            --cl-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --cl-shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.04);
            --cl-shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
            --cl-shadow-lg: 0 12px 32px rgba(0, 0, 0, 0.12);
            --cl-radius: 16px;
            --cl-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Header Section with Gradient */
        .company-listing .page-header {
            background: var(--cl-gradient);
            border-radius: var(--cl-radius);
            padding: 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .company-listing .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .company-listing .page-header h4 {
            color: #fff;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .company-listing .page-header p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            font-size: 1rem;
        }

        .company-listing .page-header .header-actions {
            margin-top: 1.5rem;
        }

        .company-listing .page-header .btn-light {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            backdrop-filter: blur(10px);
            font-weight: 500;
            transition: var(--cl-transition);
        }

        .company-listing .page-header .btn-light:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Enhanced Stat Cards */
        .company-listing .stat-card {
            border: none;
            border-radius: var(--cl-radius);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #fff;
            box-shadow: var(--cl-shadow-sm);
            transition: var(--cl-transition);
            position: relative;
            overflow: hidden;
        }

        .company-listing .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--card-color), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .company-listing .stat-card:hover::before {
            opacity: 1;
        }

        .company-listing .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--cl-shadow-lg);
        }

        .company-listing .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            position: relative;
        }

        .company-listing .stat-icon::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 16px;
            padding: 4px;
            background: linear-gradient(135deg, currentColor, transparent);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .company-listing .stat-card:hover .stat-icon::after {
            opacity: 0.3;
        }

        .company-listing .stat-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .company-listing .stat-label {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .company-listing .stat-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            margin-top: 0.5rem;
            font-weight: 600;
        }

        .company-listing .stat-trend.up {
            color: #198754;
        }

        .company-listing .stat-trend.down {
            color: #dc3545;
        }

        /* Advanced Filter Bar */
        .company-listing .filter-bar {
            background: #fff;
            border-radius: var(--cl-radius);
            padding: 1.5rem;
            box-shadow: var(--cl-shadow-sm);
            margin-bottom: 1.5rem;
        }

        .company-listing .chip {
            border: 2px solid #e9ecef;
            background: #fff;
            color: #495057;
            border-radius: 999px;
            padding: 0.5rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: var(--cl-transition);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .company-listing .chip::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(var(--cl-primary), 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }

        .company-listing .chip:hover::before {
            width: 300px;
            height: 300px;
        }

        .company-listing .chip.active {
            background: rgb(var(--cl-primary));
            border-color: rgb(var(--cl-primary));
            color: #fff;
            box-shadow: 0 4px 12px rgba(var(--cl-primary), 0.3);
        }

        .company-listing .chip:not(.active):hover {
            background: #f8f9fa;
            border-color: #dee2e6;
            transform: translateY(-2px);
        }

        /* Advanced Search Box */
        .company-listing .search-box {
            max-width: 280px;
            position: relative;
        }

        .company-listing .search-box .input-group {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--cl-shadow-sm);
            transition: var(--cl-transition);
        }

        .company-listing .search-box .input-group:focus-within {
            box-shadow: 0 0 0 4px rgba(var(--cl-primary), 0.1);
        }

        .company-listing .search-box input {
            border: none;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
        }

        .company-listing .search-box .input-group-text {
            border: none;
            background: #fff;
            color: #6c757d;
        }

        /* Enhanced Select and View Toggle */
        .company-listing .form-select {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: var(--cl-transition);
            cursor: pointer;
        }

        .company-listing .form-select:focus {
            border-color: rgb(var(--cl-primary));
            box-shadow: 0 0 0 4px rgba(var(--cl-primary), 0.1);
        }

        .company-listing .view-toggle {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--cl-shadow-sm);
        }

        .company-listing .view-toggle .btn {
            border: none;
            padding: 0.5rem 1rem;
            transition: var(--cl-transition);
        }

        .company-listing .view-toggle .btn.active {
            background: rgb(var(--cl-primary));
            color: #fff;
        }

        .company-listing .view-toggle .btn:not(.active):hover {
            background: #f8f9fa;
        }

        /* Premium Company Card */
        .company-listing .company-row {
            border: none !important;
            border-radius: var(--cl-radius);
            background: #fff;
            box-shadow: var(--cl-shadow-sm);
            transition: var(--cl-transition);
            position: relative;
            overflow: hidden;
        }

        .company-listing .company-row::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--company-color), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .company-listing .company-row:hover::before {
            opacity: 1;
        }

        .company-listing .company-row:hover {
            transform: translateY(-2px);
            box-shadow: var(--cl-shadow-lg);
        }

        .company-listing .avatar-circle {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .company-listing .avatar-circle::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 16px;
            background: linear-gradient(135deg, currentColor, transparent);
            opacity: 0.1;
            z-index: -1;
        }

        .company-listing .company-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.25rem;
            transition: color 0.2s;
        }

        .company-listing .company-row:hover .company-name {
            color: rgb(var(--cl-primary));
        }

        .company-listing .company-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .company-listing .info-block {
            position: relative;
            padding-left: 1.5rem;
        }

        .company-listing .info-block::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: linear-gradient(180deg, rgb(var(--cl-primary)), transparent);
            border-radius: 2px;
        }

        .company-listing .info-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .company-listing .info-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: #212529;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Enhanced Status Badge */
        .company-listing .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: var(--cl-shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .company-listing .status-badge::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .company-listing .status-badge:hover::before {
            opacity: 1;
        }

        .company-listing .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 currentColor;
            }

            50% {
                box-shadow: 0 0 0 4px transparent;
            }
        }

        /* Premium Action Buttons */
        .company-listing .action-btn {
            border-radius: 10px;
            padding: 0.5rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: var(--cl-transition);
            border-width: 2px;
            position: relative;
            overflow: hidden;
        }

        .company-listing .action-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.4s, height 0.4s;
        }

        .company-listing .action-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .company-listing .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        /* Grid View Enhancements */
        .company-listing #companyList.grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .company-listing #companyList.grid-view .company-row {
            margin-bottom: 0 !important;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .company-listing #companyList.grid-view .row {
            flex-direction: column;
            align-items: flex-start !important;
            flex: 1;
        }

        .company-listing #companyList.grid-view .col-md-4,
        .company-listing #companyList.grid-view .col-md-2 {
            width: 100%;
            max-width: 100%;
            text-align: left !important;
        }

        .company-listing #companyList.grid-view .info-block::before {
            display: none;
        }

        /* Loading Skeleton */
        .company-listing .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Enhanced Animations */
        .company-listing .fade-row {
            animation: clFadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1) backwards;
        }

        .company-listing .fade-row:nth-child(1) {
            animation-delay: 0.05s;
        }

        .company-listing .fade-row:nth-child(2) {
            animation-delay: 0.1s;
        }

        .company-listing .fade-row:nth-child(3) {
            animation-delay: 0.15s;
        }

        .company-listing .fade-row:nth-child(4) {
            animation-delay: 0.2s;
        }

        .company-listing .fade-row:nth-child(5) {
            animation-delay: 0.25s;
        }

        @keyframes clFadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Empty State */
        .company-listing .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .company-listing .empty-state-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #fff;
            box-shadow: 0 12px 32px rgba(102, 126, 234, 0.3);
        }

        /* Results Counter */
        .company-listing .results-counter {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, rgba(var(--cl-primary), 0.1), rgba(var(--cl-primary), 0.05));
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            color: rgb(var(--cl-primary));
            margin-bottom: 1rem;
        }

        /* Premium Modal */
        .company-listing .modal-content {
            border: none;
            border-radius: var(--cl-radius);
            box-shadow: var(--cl-shadow-lg);
        }

        .company-listing .modal-header {
            border-bottom: 1px solid #f0f0f0;
            padding: 1.5rem;
        }

        .company-listing .modal-title {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .company-listing .modal-body {
            padding: 2rem 1.5rem;
            font-size: 1rem;
            color: #495057;
        }

        .company-listing .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 1rem 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .company-listing .page-header {
                padding: 1.5rem;
            }

            .company-listing .stat-card {
                padding: 1rem;
            }

            .company-listing .stat-icon {
                width: 48px;
                height: 48px;
            }

            .company-listing .stat-value {
                font-size: 1.5rem;
            }

            .company-listing #companyList.grid-view {
                grid-template-columns: 1fr;
            }

            .company-listing .filter-bar {
                padding: 1rem;
            }

            .company-listing .search-box {
                max-width: 100%;
            }
        }

        /* Tooltip */
        .company-listing [data-bs-toggle="tooltip"] {
            cursor: help;
        }

        /* Quick Actions Menu */
        .company-listing .quick-actions {
            position: relative;
        }

        .company-listing .quick-actions-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: var(--cl-shadow-lg);
            padding: 0.5rem;
            margin-top: 0.5rem;
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--cl-transition);
            z-index: 1000;
        }

        .company-listing .quick-actions:hover .quick-actions-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .company-listing .quick-actions-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            border-radius: 8px;
            color: #495057;
            text-decoration: none;
            transition: var(--cl-transition);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .company-listing .quick-actions-item:hover {
            background: #f8f9fa;
            color: rgb(var(--cl-primary));
        }
    </style>

    <div class="page-content">
        <!-- Premium Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                <div>
                    <h4 class="mb-2">
                        <i class="bi bi-buildings me-2"></i>Company Management
                    </h4>
                    <p class="mb-0">Manage and monitor all registered companies in your system</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-light me-2" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i>Export Report
                    </button>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#bulkActionsModal">
                        <i class="bi bi-lightning-charge me-2"></i>Bulk Actions
                    </button>
                </div>
            </div>
        </div>

        <?php
        $total = count($companies ?? []);
        $active_count = 0;
        if (!empty($companies)) {
            foreach ($companies as $c) {
                if (isset($c->status) && $c->status == 1)
                    $active_count++;
            }
        }
        $inactive_count = $total - $active_count;
        $active_percentage = $total > 0 ? round(($active_count / $total) * 100) : 0;
        ?>

        <?php if (!empty($companies)): ?>
            <!-- Enhanced Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="stat-card" style="--card-color: #4f46e5; --card-color-light: #6366f1;">
                        <div class="stat-icon" style="background:rgba(79,70,229,.1); color:#4f46e5;">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-value"><?= $total ?></div>
                            <div class="stat-label">Total Companies</div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up-short"></i>
                                <span>12% from last month</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="--card-color: #198754; --card-color-light: #20c997;">
                        <div class="stat-icon" style="background:rgba(25,135,84,.1); color:#198754;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-value"><?= $active_count ?></div>
                            <div class="stat-label">Active Companies</div>
                            <div class="stat-trend up">
                                <i class="bi bi-arrow-up-short"></i>
                                <span><?= $active_percentage ?>% of total</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="--card-color: #dc3545; --card-color-light: #e35d6a;">
                        <div class="stat-icon" style="background:rgba(220,53,69,.1); color:#dc3545;">
                            <i class="bi bi-pause-circle-fill"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="stat-value"><?= $inactive_count ?></div>
                            <div class="stat-label">Inactive Companies</div>
                            <div class="stat-trend down">
                                <i class="bi bi-arrow-down-short"></i>
                                <span><?= 100 - $active_percentage ?>% of total</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Filter Bar -->
         
        <?php endif; ?>

        <!-- Main Content Card -->
        <div class="card" style="border: none; border-radius: var(--cl-radius); box-shadow: var(--cl-shadow-sm);">
            <div class="card-body p-4">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show"
                        style="border-radius: 12px; border: none; box-shadow: var(--cl-shadow-sm);">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (!empty($companies)): ?>
                    <div class="results-counter mb-3">
                        <i class="bi bi-funnel-fill"></i>
                        <span id="resultsCount"><?= $total ?> compan<?= $total == 1 ? 'y' : 'ies' ?></span>
                    </div>

                    <div class="list-group" id="companyList">
                        <?php foreach ($companies as $index => $company): ?>
                            <?php
                            $is_active = isset($company->status) && $company->status == 1;
                            $name_parts = explode(' ', trim($company->company_name));
                            $initials = strtoupper(
                                (isset($name_parts[0]) ? substr($name_parts[0], 0, 1) : '') .
                                (isset($name_parts[1]) ? substr($name_parts[1], 0, 1) :
                                    (isset($name_parts[0]) && strlen($name_parts[0]) > 1 ? substr($name_parts[0], 1, 1) : ''))
                            );
                            $search_blob = strtolower($company->company_name . ' ' . $company->email . ' ' . $company->phone);
                            $hue = crc32($company->company_name) % 360;
                            ?>
                            <div class="list-group-item rounded-3 mb-3 company-row fade-row"
                                style="--company-color: hsl(<?= $hue ?>, 60%, 50%);"
                                data-search="<?= htmlspecialchars($search_blob) ?>"
                                data-status="<?= $is_active ? 'active' : 'inactive' ?>"
                                data-name="<?= htmlspecialchars(strtolower($company->company_name)) ?>">
                                <div class="row align-items-center gy-3">
                                    <!-- Company Info -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-circle"
                                                style="background: hsl(<?= $hue ?>, 70%, 93%); color: hsl(<?= $hue ?>, 60%, 35%);">
                                                <?= htmlspecialchars($initials ?: '?') ?>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="company-name mb-1">
                                                    <?= htmlspecialchars($company->company_name) ?>
                                                </h6>
                                                <div class="company-meta">
                                                    <i class="bi bi-envelope-fill"></i>
                                                    <span><?= htmlspecialchars($company->email) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact Info -->
                                    <div class="col-md-2">
                                        <div class="info-block">
                                            <div class="info-label">Phone</div>
                                            <div class="info-value">
                                                <i class="bi bi-telephone-fill text-primary"></i>
                                                <span><?= htmlspecialchars($company->phone) ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address Info -->
                                    <div class="col-md-2">
                                        <div class="info-block">
                                            <div class="info-label">Location</div>
                                            <div class="info-value">
                                                <i class="bi bi-geo-alt-fill text-danger"></i>
                                                <span class="text-truncate" data-bs-toggle="tooltip"
                                                    title="<?= htmlspecialchars($company->address) ?>">
                                                    <?= htmlspecialchars(substr($company->address, 0, 20)) ?>...
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-2 text-center">
                                        <span
                                            class="status-badge <?= $is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' ?>">
                                            <span class="status-dot"
                                                style="background: <?= $is_active ? '#198754' : '#dc3545' ?>;"></span>
                                            <?= $is_active ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </div>

                                    <!-- Actions -->
                                    <div class="col-md-2 text-md-end">
                                        <div class="quick-actions d-inline-block">
                                            <?php if ($is_active): ?>
                                                <a href="<?= base_url('superadmin/company_status/' . $company->id . '/0'); ?>"
                                                    class="btn btn-sm btn-outline-danger action-btn confirm-toggle"
                                                    data-name="<?= htmlspecialchars($company->company_name) ?>"
                                                    data-action="deactivate">
                                                    <i class="bi bi-pause-circle me-1"></i>Deactivate
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url('superadmin/company_status/' . $company->id . '/1'); ?>"
                                                    class="btn btn-sm btn-outline-success action-btn confirm-toggle"
                                                    data-name="<?= htmlspecialchars($company->company_name) ?>"
                                                    data-action="activate">
                                                    <i class="bi bi-play-circle me-1"></i>Activate
                                                </a>
                                            <?php endif; ?>

                                            <!-- Quick Actions Dropdown -->
                                            <div class="quick-actions-menu">
                                                <a href="#" class="quick-actions-item">
                                                    <i class="bi bi-eye"></i>View Details
                                                </a>
                                                <a href="#" class="quick-actions-item">
                                                    <i class="bi bi-pencil"></i>Edit Company
                                                </a>
                                                <a href="#" class="quick-actions-item text-danger">
                                                    <i class="bi bi-trash"></i>Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- No Results State -->
                    <div id="noResults" class="d-none">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5>No companies found</h5>
                            <p class="text-muted mb-0">Try adjusting your filters or search query</p>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h5>No companies yet</h5>
                        <p class="text-muted mb-3">Start by adding your first company to the system</p>
                        <button class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Add Company
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Premium Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="confirmModalTitle">
                        <i class="bi bi-exclamation-circle me-2"></i>Confirm Action
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="confirmModalBody">
                    Are you sure you want to proceed?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <a href="#" id="confirmModalAction" class="btn btn-sm btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Confirm
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Modal -->
    <div class="modal fade" id="bulkActionsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        <i class="bi bi-lightning-charge me-2"></i>Bulk Actions
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Select an action to apply to multiple companies:</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success">
                            <i class="bi bi-check-all me-2"></i>Activate Selected
                        </button>
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-pause me-2"></i>Deactivate Selected
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-download me-2"></i>Export Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        const list = document.getElementById('companyList');
        if (!list) return;

        const rows = Array.from(document.querySelectorAll('.company-row'));
        const noResults = document.getElementById('noResults');
        const resultsCount = document.getElementById('resultsCount');
        const searchInput = document.getElementById('companySearch');
        const sortSelect = document.getElementById('sortSelect');
        let activeFilter = 'all';

        // Apply filters with smooth animation
        function applyFilters() {
            const term = (searchInput?.value || '').trim().toLowerCase();
            let visible = 0;

            rows.forEach((row, index) => {
                const matchesSearch = row.dataset.search.includes(term);
                const matchesFilter = activeFilter === 'all' || row.dataset.status === activeFilter;
                const show = matchesSearch && matchesFilter;

                if (show) {
                    row.style.animationDelay = `${index * 0.05}s`;
                    row.classList.remove('d-none');
                    visible++;
                } else {
                    row.classList.add('d-none');
                }
            });

            noResults.classList.toggle('d-none', visible !== 0);
            if (resultsCount) {
                resultsCount.innerHTML = `<i class="bi bi-funnel-fill me-2"></i>${visible} compan${visible === 1 ? 'y' : 'ies'}`;
            }
        }

        // Search with debounce
        let searchTimeout;
        searchInput?.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 300);
        });

        // Filter chips
        document.querySelectorAll('.chip').forEach(chip => {
            chip.addEventListener('click', function () {
                document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                activeFilter = this.dataset.filter;
                applyFilters();
            });
        });

        // Sort
        sortSelect?.addEventListener('change', function () {
            const value = this.value;
            const sorted = [...rows].sort((a, b) => {
                if (value === 'name_asc') return a.dataset.name.localeCompare(b.dataset.name);
                if (value === 'name_desc') return b.dataset.name.localeCompare(a.dataset.name);
                if (value === 'status') return a.dataset.status.localeCompare(b.dataset.status);
                return 0;
            });
            sorted.forEach(row => list.appendChild(row));
        });

        // View toggle
        document.querySelectorAll('.view-toggle button').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.view-toggle button').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                list.classList.toggle('grid-view', this.dataset.view === 'grid');
            });
        });

        // Confirm modal
        const confirmModalEl = document.getElementById('confirmModal');
        const confirmModal = confirmModalEl ? new bootstrap.Modal(confirmModalEl) : null;
        const confirmBody = document.getElementById('confirmModalBody');
        const confirmAction = document.getElementById('confirmModalAction');

        document.querySelectorAll('.confirm-toggle').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const name = this.dataset.name;
                const action = this.dataset.action;
                const href = this.getAttribute('href');

                if (action === 'deactivate') {
                    confirmBody.innerHTML = `
                        <div class="text-center">
                            <i class="bi bi-exclamation-triangle text-warning fs-1 mb-3 d-block"></i>
                            <p class="mb-0">Are you sure you want to <strong>deactivate</strong> <strong>"${name}"</strong>?</p>
                            <p class="text-muted small mt-2">They will lose access immediately.</p>
                        </div>
                    `;
                    confirmAction.className = 'btn btn-sm btn-danger action-btn';
                    confirmAction.innerHTML = '<i class="bi bi-pause-circle me-1"></i>Deactivate';
                } else {
                    confirmBody.innerHTML = `
                        <div class="text-center">
                            <i class="bi bi-check-circle text-success fs-1 mb-3 d-block"></i>
                            <p class="mb-0">Activate <strong>"${name}"</strong>?</p>
                            <p class="text-muted small mt-2">They will regain full access.</p>
                        </div>
                    `;
                    confirmAction.className = 'btn btn-sm btn-success action-btn';
                    confirmAction.innerHTML = '<i class="bi bi-play-circle me-1"></i>Activate';
                }

                confirmAction.href = href;
                confirmModal.show();
            });
        });
    });
</script>