<div class="page-wrapper company-listing">
    <style>
        .company-listing {
            --cl-primary: #4f46e5;
            --cl-primary-light: #eef2ff;
            --cl-success: #059669;
            --cl-success-light: #ecfdf5;
            --cl-danger: #dc2626;
            --cl-danger-light: #fef2f2;
            --cl-gray-50: #f9fafb;
            --cl-gray-100: #f3f4f6;
            --cl-gray-200: #e5e7eb;
            --cl-gray-300: #d1d5db;
            --cl-gray-400: #9ca3af;
            --cl-gray-500: #6b7280;
            --cl-gray-600: #4b5563;
            --cl-gray-700: #374151;
            --cl-gray-900: #111827;
            --cl-radius: 8px;
            --cl-radius-lg: 12px;
            --cl-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --cl-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        }

        /* Breadcrumb */
        .company-listing .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }

        .company-listing .breadcrumb-nav a {
            color: var(--cl-gray-500);
            text-decoration: none;
            transition: color 0.15s;
        }

        .company-listing .breadcrumb-nav a:hover {
            color: var(--cl-primary);
        }

        .company-listing .breadcrumb-nav .separator {
            color: var(--cl-gray-300);
        }

        .company-listing .breadcrumb-nav .current {
            color: var(--cl-gray-900);
            font-weight: 500;
        }

        /* Page Header */
        .company-listing .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .company-listing .page-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--cl-gray-900);
            margin: 0 0 0.25rem;
        }

        .company-listing .page-header p {
            color: var(--cl-gray-500);
            margin: 0;
            font-size: 0.875rem;
        }

        .company-listing .header-actions {
            display: flex;
            gap: 0.5rem;
        }

        .company-listing .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--cl-primary);
            color: #fff;
            border: none;
            border-radius: var(--cl-radius);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
            text-decoration: none;
        }

        .company-listing .btn-primary:hover {
            background: #4338ca;
        }

        .company-listing .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #fff;
            color: var(--cl-gray-700);
            border: 1px solid var(--cl-gray-300);
            border-radius: var(--cl-radius);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
        }

        .company-listing .btn-secondary:hover {
            background: var(--cl-gray-50);
            border-color: var(--cl-gray-400);
        }

        /* Stats Cards */
        .company-listing .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .company-listing .stat-card {
            background: #fff;
            border: 1px solid var(--cl-gray-200);
            border-radius: var(--cl-radius-lg);
            padding: 1.25rem;
            transition: border-color 0.15s;
        }

        .company-listing .stat-card:hover {
            border-color: var(--cl-gray-300);
        }

        .company-listing .stat-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--cl-gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .company-listing .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--cl-gray-900);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .company-listing .stat-meta {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .company-listing .stat-meta.positive {
            color: var(--cl-success);
        }

        .company-listing .stat-meta.neutral {
            color: var(--cl-gray-500);
        }

        /* Main Card */
        .company-listing .main-card {
            background: #fff;
            border: 1px solid var(--cl-gray-200);
            border-radius: var(--cl-radius-lg);
            overflow: hidden;
        }

        /* Card Toolbar */
        .company-listing .card-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--cl-gray-200);
            gap: 1rem;
            flex-wrap: wrap;
        }

        .company-listing .toolbar-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
            min-width: 0;
        }

        .company-listing .search-input {
            position: relative;
            flex: 1;
            max-width: 300px;
        }

        .company-listing .search-input i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--cl-gray-400);
            font-size: 0.875rem;
        }

        .company-listing .search-input input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2.25rem;
            border: 1px solid var(--cl-gray-300);
            border-radius: var(--cl-radius);
            font-size: 0.875rem;
            color: var(--cl-gray-900);
            background: #fff;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .company-listing .search-input input:focus {
            outline: none;
            border-color: var(--cl-primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .company-listing .search-input input::placeholder {
            color: var(--cl-gray-400);
        }

        .company-listing .toolbar-right {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .company-listing .filter-select {
            padding: 0.5rem 2rem 0.5rem 0.75rem;
            border: 1px solid var(--cl-gray-300);
            border-radius: var(--cl-radius);
            font-size: 0.875rem;
            color: var(--cl-gray-700);
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M2 4l4 4 4-4'/%3E%3C/svg%3E") no-repeat right 0.5rem center;
            background-size: 12px;
            cursor: pointer;
            appearance: none;
            transition: border-color 0.15s;
        }

        .company-listing .filter-select:focus {
            outline: none;
            border-color: var(--cl-primary);
        }

        /* Filter Tabs */
        .company-listing .filter-tabs {
            display: flex;
            align-items: center;
            gap: 0;
            border-bottom: 1px solid var(--cl-gray-200);
            padding: 0 1.5rem;
        }

        .company-listing .filter-tab {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--cl-gray-500);
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.15s;
            margin-bottom: -1px;
        }

        .company-listing .filter-tab:hover {
            color: var(--cl-gray-700);
        }

        .company-listing .filter-tab.active {
            color: var(--cl-primary);
            border-bottom-color: var(--cl-primary);
        }

        .company-listing .filter-tab .count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 1.25rem;
            height: 1.25rem;
            padding: 0 0.375rem;
            margin-left: 0.375rem;
            background: var(--cl-gray-100);
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .company-listing .filter-tab.active .count {
            background: var(--cl-primary-light);
            color: var(--cl-primary);
        }

        /* Table */
        .company-listing .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .company-listing .data-table thead th {
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--cl-gray-500);
            text-align: left;
            background: var(--cl-gray-50);
            border-bottom: 1px solid var(--cl-gray-200);
            white-space: nowrap;
        }

        .company-listing .data-table thead th.text-center {
            text-align: center;
        }

        .company-listing .data-table thead th.text-right {
            text-align: right;
        }

        .company-listing .data-table tbody tr {
            transition: background 0.1s;
        }

        .company-listing .data-table tbody tr:hover {
            background: var(--cl-gray-50);
        }

        .company-listing .data-table tbody td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            color: var(--cl-gray-900);
            border-bottom: 1px solid var(--cl-gray-100);
            vertical-align: middle;
        }

        .company-listing .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Company Cell */
        .company-listing .company-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .company-listing .company-avatar {
            width: 36px;
            height: 36px;
            border-radius: var(--cl-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .company-listing .company-details {
            min-width: 0;
        }

        .company-listing .company-name {
            font-weight: 500;
            color: var(--cl-gray-900);
            margin: 0;
            line-height: 1.4;
        }

        .company-listing .company-email {
            font-size: 0.8125rem;
            color: var(--cl-gray-500);
            margin: 0;
        }

        /* Status Badge */
        .company-listing .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.25rem 0.625rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 999px;
        }

        .company-listing .status-badge.active {
            background: var(--cl-success-light);
            color: var(--cl-success);
        }

        .company-listing .status-badge.inactive {
            background: var(--cl-danger-light);
            color: var(--cl-danger);
        }

        .company-listing .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .company-listing .status-badge.active .status-dot {
            background: var(--cl-success);
        }

        .company-listing .status-badge.inactive .status-dot {
            background: var(--cl-danger);
        }

        /* Action Buttons */
        .company-listing .action-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .company-listing .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: var(--cl-radius);
            border: 1px solid;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
            white-space: nowrap;
        }

        .company-listing .btn-action-success {
            border-color: var(--cl-success);
            color: var(--cl-success);
            background: #fff;
        }

        .company-listing .btn-action-success:hover {
            background: var(--cl-success);
            color: #fff;
        }

        .company-listing .btn-action-danger {
            border-color: var(--cl-danger);
            color: var(--cl-danger);
            background: #fff;
        }

        .company-listing .btn-action-danger:hover {
            background: var(--cl-danger);
            color: #fff;
        }

        .company-listing .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: 1px solid var(--cl-gray-200);
            border-radius: var(--cl-radius);
            background: #fff;
            color: var(--cl-gray-500);
            cursor: pointer;
            transition: all 0.15s;
        }

        .company-listing .btn-icon:hover {
            background: var(--cl-gray-50);
            color: var(--cl-gray-700);
            border-color: var(--cl-gray-300);
        }

        /* Empty State */
        .company-listing .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .company-listing .empty-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            background: var(--cl-gray-100);
            border-radius: var(--cl-radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--cl-gray-400);
        }

        .company-listing .empty-state h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--cl-gray-900);
            margin: 0 0 0.25rem;
        }

        .company-listing .empty-state p {
            font-size: 0.875rem;
            color: var(--cl-gray-500);
            margin: 0 0 1.5rem;
        }

        /* Alert */
        .company-listing .alert-banner {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            background: var(--cl-success-light);
            border-bottom: 1px solid #d1fae5;
            font-size: 0.875rem;
            color: var(--cl-success);
        }

        .company-listing .alert-banner i {
            font-size: 1rem;
        }

        .company-listing .alert-banner .btn-close {
            margin-left: auto;
            background: none;
            border: none;
            color: var(--cl-success);
            opacity: 0.6;
            cursor: pointer;
            padding: 0;
            font-size: 1.25rem;
        }

        .company-listing .alert-banner .btn-close:hover {
            opacity: 1;
        }

        /* Results Info */
        .company-listing .results-info {
            padding: 0.75rem 1.5rem;
            font-size: 0.8125rem;
            color: var(--cl-gray-500);
            border-bottom: 1px solid var(--cl-gray-100);
            background: var(--cl-gray-50);
        }

        /* Modal */
        .company-listing .modal-content {
            border: none;
            border-radius: var(--cl-radius-lg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .company-listing .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--cl-gray-200);
        }

        .company-listing .modal-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--cl-gray-900);
        }

        .company-listing .modal-body {
            padding: 1.5rem;
            font-size: 0.875rem;
            color: var(--cl-gray-600);
            line-height: 1.6;
        }

        .company-listing .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--cl-gray-200);
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .company-listing .modal-footer .btn-cancel {
            padding: 0.5rem 1rem;
            background: #fff;
            border: 1px solid var(--cl-gray-300);
            border-radius: var(--cl-radius);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--cl-gray-700);
            cursor: pointer;
            transition: all 0.15s;
        }

        .company-listing .modal-footer .btn-cancel:hover {
            background: var(--cl-gray-50);
        }

        .company-listing .modal-footer .btn-confirm {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--cl-radius);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .company-listing .modal-footer .btn-confirm-danger {
            background: var(--cl-danger);
            color: #fff;
        }

        .company-listing .modal-footer .btn-confirm-danger:hover {
            background: #b91c1c;
        }

        .company-listing .modal-footer .btn-confirm-success {
            background: var(--cl-success);
            color: #fff;
        }

        .company-listing .modal-footer .btn-confirm-success:hover {
            background: #047857;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .company-listing .page-header {
                flex-direction: column;
            }

            .company-listing .stats-grid {
                grid-template-columns: 1fr;
            }

            .company-listing .card-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .company-listing .toolbar-left,
            .company-listing .toolbar-right {
                width: 100%;
            }

            .company-listing .search-input {
                max-width: none;
            }

            .company-listing .data-table thead {
                display: none;
            }

            .company-listing .data-table,
            .company-listing .data-table tbody,
            .company-listing .data-table tr,
            .company-listing .data-table td {
                display: block;
                width: 100%;
            }

            .company-listing .data-table tbody tr {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid var(--cl-gray-200);
            }

            .company-listing .data-table tbody td {
                padding: 0.375rem 0;
                border: none;
            }

            .company-listing .action-group {
                justify-content: flex-start;
                margin-top: 0.5rem;
            }
        }

        /* Text utilities */
        .company-listing .text-muted {
            color: var(--cl-gray-500);
        }

        .company-listing .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 180px;
            display: inline-block;
            vertical-align: middle;
        }
    </style>

    <div class="page-content">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav">
            <a href="<?= base_url('superadmin/dashboard'); ?>">Dashboard</a>
            <span class="separator">/</span>
            <span class="current">Companies</span>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Companies</h1>
                <p>Manage all registered companies in your system.</p>
            </div>
            <div class="header-actions">
                <button class="btn-secondary" onclick="window.print()">
                    <i class="bi bi-download"></i>
                    Export
                </button>
                <a href="#" class="btn-primary">
                    <i class="bi bi-plus"></i>
                    Add Company
                </a>
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
        ?>

        <!-- Stats -->
        <?php if (!empty($companies)): ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Companies</div>
                    <div class="stat-value"><?= $total ?></div>
                    <div class="stat-meta neutral">
                        <span>All registered</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Active</div>
                    <div class="stat-value"><?= $active_count ?></div>
                    <div class="stat-meta positive">
                        <i class="bi bi-check-circle"></i>
                        <span><?= $total > 0 ? round(($active_count / $total) * 100) : 0 ?>% of total</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Inactive</div>
                    <div class="stat-value"><?= $inactive_count ?></div>
                    <div class="stat-meta neutral">
                        <span><?= $total > 0 ? round(($inactive_count / $total) * 100) : 0 ?>% of total</span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Main Card -->
        <div class="main-card">
            <!-- Success Alert -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert-banner">
                    <i class="bi bi-check-circle-fill"></i>
                    <span><?= $this->session->flashdata('success'); ?></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert">×</button>
                </div>
            <?php endif; ?>

            <?php if (!empty($companies)): ?>
                <!-- Filter Tabs -->
                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">
                        All <span class="count"><?= $total ?></span>
                    </button>
                    <button class="filter-tab" data-filter="active">
                        Active <span class="count"><?= $active_count ?></span>
                    </button>
                    <button class="filter-tab" data-filter="inactive">
                        Inactive <span class="count"><?= $inactive_count ?></span>
                    </button>
                </div>

                <!-- Toolbar -->
                <div class="card-toolbar">
                    <div class="toolbar-left">
                        <div class="search-input">
                            <i class="bi bi-search"></i>
                            <input type="text" id="companySearch" placeholder="Search companies...">
                        </div>
                    </div>
                    <div class="toolbar-right">
                        <select id="sortSelect" class="filter-select">
                            <option value="name_asc">Name A–Z</option>
                            <option value="name_desc">Name Z–A</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                </div>

                <!-- Results Info -->
                <div class="results-info">
                    Showing <strong id="resultsCount"><?= $total ?></strong> of <strong><?= $total ?></strong> companies
                </div>

                <!-- Table -->
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="companyList">
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
                            <tr class="company-row" data-search="<?= htmlspecialchars($search_blob) ?>"
                                data-status="<?= $is_active ? 'active' : 'inactive' ?>"
                                data-name="<?= htmlspecialchars(strtolower($company->company_name)) ?>">
                                <td>
                                    <div class="company-cell">
                                        <div class="company-avatar"
                                            style="background: hsl(<?= $hue ?>, 70%, 93%); color: hsl(<?= $hue ?>, 60%, 35%);">
                                            <?= htmlspecialchars($initials ?: '?') ?>
                                        </div>
                                        <div class="company-details">
                                            <p class="company-name"><?= htmlspecialchars($company->company_name) ?></p>
                                            <p class="company-email"><?= htmlspecialchars($company->email) ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted"><?= htmlspecialchars($company->phone) ?></span>
                                </td>
                                <td>
                                    <span class="text-muted text-truncate" title="<?= htmlspecialchars($company->address) ?>">
                                        <?= htmlspecialchars($company->address) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="status-badge <?= $is_active ? 'active' : 'inactive' ?>">
                                        <span class="status-dot"></span>
                                        <?= $is_active ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-group">
                                        <?php if ($is_active): ?>
                                            <a href="<?= base_url('superadmin/company_status/' . $company->id . '/0'); ?>"
                                                class="btn-action btn-action-danger confirm-toggle"
                                                data-name="<?= htmlspecialchars($company->company_name) ?>"
                                                data-action="deactivate">
                                                <i class="bi bi-pause-circle"></i>
                                                Deactivate
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= base_url('superadmin/company_status/' . $company->id . '/1'); ?>"
                                                class="btn-action btn-action-success confirm-toggle"
                                                data-name="<?= htmlspecialchars($company->company_name) ?>" data-action="activate">
                                                <i class="bi bi-play-circle"></i>
                                                Activate
                                            </a>
                                        <?php endif; ?>
                                        <button class="btn-icon" title="More options">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- No Results -->
                <div id="noResults" class="empty-state d-none">
                    <div class="empty-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3>No companies found</h3>
                    <p>Try adjusting your search or filter criteria.</p>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <h3>No companies yet</h3>
                    <p>Get started by adding your first company.</p>
                    <a href="#" class="btn-primary">
                        <i class="bi bi-plus"></i>
                        Add Company
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalTitle">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="confirmModalBody">
                    Are you sure you want to proceed?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmModalAction" class="btn-confirm">Confirm</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = Array.from(document.querySelectorAll('.company-row'));
        const list = document.getElementById('companyList');
        const noResults = document.getElementById('noResults');
        const resultsCount = document.getElementById('resultsCount');
        const searchInput = document.getElementById('companySearch');
        const sortSelect = document.getElementById('sortSelect');
        let activeFilter = 'all';

        function applyFilters() {
            const term = (searchInput?.value || '').trim().toLowerCase();
            let visible = 0;

            rows.forEach(row => {
                const matchesSearch = row.dataset.search.includes(term);
                const matchesFilter = activeFilter === 'all' || row.dataset.status === activeFilter;
                const show = matchesSearch && matchesFilter;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            if (noResults) noResults.classList.toggle('d-none', visible !== 0);
            if (resultsCount) resultsCount.textContent = visible;
        }

        // Search
        let searchTimeout;
        searchInput?.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 200);
        });

        // Filter tabs
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function () {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
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
                    confirmBody.innerHTML = `Are you sure you want to deactivate <strong>"${name}"</strong>? They will lose access immediately.`;
                    confirmAction.className = 'btn-confirm btn-confirm-danger';
                    confirmAction.innerHTML = '<i class="bi bi-pause-circle"></i> Deactivate';
                } else {
                    confirmBody.innerHTML = `Are you sure you want to activate <strong>"${name}"</strong>?`;
                    confirmAction.className = 'btn-confirm btn-confirm-success';
                    confirmAction.innerHTML = '<i class="bi bi-play-circle"></i> Activate';
                }

                confirmAction.href = href;
                confirmModal.show();
            });
        });
    });
</script>