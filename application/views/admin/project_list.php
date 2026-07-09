<div class="page-wrapper">
    <div class="page-content">

        <style>
            .xc-wrapper {
                background: #fff;
                min-height: 100vh;
            }

            .xc-content {
                padding: 28px 32px;
            }

            .xc-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4px;
            }

            .xc-header h2 {
                font-size: 22px;
                font-weight: 700;
                color: #1a1a2e;
                margin: 0;
            }

            .xc-breadcrumb {
                font-size: 12px;
                color: #9aa0ac;
                margin-bottom: 20px;
            }

            .xc-breadcrumb a {
                color: #0fb4a0;
                text-decoration: none;
            }

            .xc-breadcrumb span {
                margin: 0 5px;
            }

            .btn-xc-add {
                background: #0fb4a0;
                color: #fff;
                border: none;
                padding: 9px 22px;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                transition: background .15s;
            }

            .btn-xc-add:hover {
                background: #0d9b89;
                color: #fff;
                text-decoration: none;
            }

            /* Filter bar */
            .xc-filter-bar {
                background: #fff;
                border-radius: 12px;
                border: 0.5px solid #e4e6ea;
                padding: 18px 20px;
                margin-bottom: 20px;
            }

            .xc-filter-row {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                align-items: flex-end;
            }

            .xc-filter-row+.xc-filter-row {
                margin-top: 12px;
            }

            .xc-filter-bar .form-control,
            .xc-filter-bar .form-select {
                height: 40px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13px;
                color: #333;
                background: #fafbfc;
                padding: 0 12px;
                box-shadow: none;
                flex: 1 1 160px;
                min-width: 140px;
            }

            .xc-filter-bar .form-control:focus,
            .xc-filter-bar .form-select:focus {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
                outline: none;
            }

            .xc-filter-bar .form-control::placeholder {
                color: #bbb;
            }

            .btn-xc-search {
                height: 40px;
                padding: 0 28px;
                background: #0fb4a0;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                transition: background .15s;
                white-space: nowrap;
                flex: 1 1 120px;
            }

            .btn-xc-search:hover {
                background: #0d9b89;
            }

            .btn-xc-reset {
                height: 40px;
                padding: 0 22px;
                background: #fff;
                color: #555;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                white-space: nowrap;
                flex: 1 1 120px;
                transition: background .15s;
            }

            .btn-xc-reset:hover {
                background: #f5f5f5;
                color: #333;
            }

            /* Table card */
            .xc-table-card {
                background: #fff;
                border-radius: 12px;
                border: 0.5px solid #e4e6ea;
                overflow: hidden;
            }

            .xc-table-card table {
                width: 100%;
                margin: 0;
                border-collapse: collapse;
                font-size: 13.5px;
                min-width: 960px;
            }

            .xc-table-scroll {
                overflow-x: auto;
            }

            .xc-table-card thead th {
                background: #0fb4a0;
                color: #fff;
                font-weight: 500;
                padding: 13px 16px;
                text-align: left;
                white-space: nowrap;
                border: none;
            }

            .xc-table-card tbody tr {
                border-bottom: 0.5px solid #f0f2f5;
            }

            .xc-table-card tbody tr:last-child {
                border-bottom: none;
            }

            .xc-table-card tbody tr:hover {
                background: #f0faf9;
            }

            .xc-table-card tbody td {
                padding: 12px 16px;
                color: #2d3436;
                vertical-align: middle;
                border: none;
            }

            .xc-table-card tbody td.muted {
                color: #9aa0ac;
                font-size: 12.5px;
                white-space: nowrap;
            }

            .col-project {
                width: 150px;
            }

            .col-person {
                width: 130px;
            }

            .col-dates {
                width: 160px;
            }

            .col-progress {
                width: 140px;
            }

            .col-status {
                width: 130px;
            }

            .col-action {
                width: 160px;
            }

            /* Progress bar */
            .xc-progress-wrap {
                width: 110px;
            }

            .xc-progress-bar-bg {
                width: 100%;
                height: 7px;
                background: #f0f2f5;
                border-radius: 20px;
                overflow: hidden;
            }

            .xc-progress-bar-fill {
                height: 100%;
                background: #0fb4a0;
                border-radius: 20px;
                transition: width .3s;
            }

            .xc-progress-text {
                font-size: 11px;
                color: #0fb4a0;
                font-weight: 600;
                margin-top: 4px;
            }

            /* Status badge */
            .xc-badge {
                display: inline-block;
                padding: 3px 14px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
            }

            .xc-badge-draft {
                background: #f0f2f5;
                color: #636e72;
            }

            .xc-badge-started {
                background: #e0f7f4;
                color: #0a7a6b;
            }

            .xc-badge-running {
                background: #fff4e0;
                color: #b9770e;
            }

            .xc-badge-completed {
                background: #e8eaf6;
                color: #283593;
            }

            /* Action buttons */
            .xc-actions {
                display: flex;
                gap: 6px;
            }

            .btn-xc {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 4px;
                padding: 5px 14px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 500;
                text-decoration: none;
                cursor: pointer;
                transition: opacity .15s, background .15s;
                border: 1.5px solid;
                white-space: nowrap;
            }

            .btn-xc:hover {
                opacity: .85;
                text-decoration: none;
            }

            .btn-xc-edit {
                background: #fff;
                color: #f59e0b;
                border-color: #f59e0b;
            }

            .btn-xc-edit:hover {
                background: #fff8ec;
            }

            .btn-xc-delete {
                background: #fff;
                color: #ef4444;
                border-color: #ef4444;
            }

            .btn-xc-delete:hover {
                background: #fff0f0;
            }

            /* Empty state */
            .xc-empty td {
                text-align: center;
                padding: 56px 0 !important;
                color: #b2bec3;
                font-size: 14px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .xc-content {
                    padding: 18px 14px;
                }

                .xc-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 12px;
                }

                .xc-header h2 {
                    font-size: 19px;
                }

                .xc-filter-row {
                    flex-direction: column;
                    align-items: stretch;
                }

                .xc-filter-bar .form-control,
                .xc-filter-bar .form-select,
                .btn-xc-search,
                .btn-xc-reset {
                    flex: 1 1 100%;
                    width: 100%;
                }

                .xc-table-card table {
                    min-width: 760px;
                }
            }
        </style>

        <div class="xc-wrapper">
            <div class="xc-content">

                <!-- Header -->
                <div class="xc-header">
                    <h2>Projects</h2>
                    <a href="<?= base_url('index.php/project/add') ?>" class="btn-xc-add">
                        + Add Project
                    </a>
                </div>
                <div class="xc-breadcrumb">
                    <a href="<?= base_url('index.php/dashboard') ?>">Project Monitoring</a>
                    <span>›</span> Projects
                </div>

                <!-- Filter bar -->
                <form method="GET" action="<?= base_url('index.php/project') ?>">
                    <div class="xc-filter-bar">

                        <div class="xc-filter-row">
                            <input type="text" name="search" class="form-control" placeholder="Search project name…">
                            <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                            <input type="date" name="end_date" class="form-control" placeholder="End Date">
                            <select name="engineer_id" class="form-select">
                                <option value="">Select Engineer</option>
                                <?php foreach ($engineers as $eng): ?>
                                    <option value="<?= $eng->id ?>"><?= htmlspecialchars($eng->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="xc-filter-row">
                            <select name="customer_id" class="form-select">
                                <option value="">Select Customer</option>
                                <?php foreach ($customers as $c): ?>
                                    <option value="<?= $c->id ?>"><?= htmlspecialchars($c->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select name="status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="Draft">Draft</option>
                                <option value="Project Started">Project Started</option>
                                <option value="Running">Running</option>
                                <option value="Completed">Completed</option>
                            </select>
                            <button type="submit" class="btn-xc-search">Search</button>
                            <button type="button" class="btn-xc-reset"
                                onclick="window.location='<?= base_url('index.php/project') ?>'">Reset</button>
                        </div>

                    </div>
                </form>

                <!-- Table -->
                <div class="xc-table-card">
                    <div class="xc-table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th class="col-project">Project Name</th>
                                    <th class="col-person">Engineer Name</th>
                                    <th class="col-person">Customer Name</th>
                                    <th class="col-person">Project Manager</th>
                                    <th class="col-dates">Start / End Date</th>
                                    <th class="col-progress">Progress</th>
                                    <th class="col-status">Status</th>
                                    <th class="col-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($projects)): ?>
                                    <?php foreach ($projects as $row): ?>
                                        <?php
                                        $statusValue = $row->status ?? 'Draft';
                                        $statusLower = strtolower(trim($statusValue));

                                        if ($statusLower === 'completed') {
                                            $statusClass = 'xc-badge-completed';
                                        } elseif ($statusLower === 'running') {
                                            $statusClass = 'xc-badge-running';
                                        } elseif ($statusLower === 'project started' || $statusLower === 'started') {
                                            $statusClass = 'xc-badge-started';
                                        } else {
                                            $statusClass = 'xc-badge-draft';
                                        }

                                        $progress = isset($row->progress) ? (int) $row->progress : 0;
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row->project_name) ?></td>
                                            <!-- <td><?= htmlspecialchars($row->engineer_name) ?></td> -->
                                            <td><?= htmlspecialchars($row->engineers) ?></td>
                                            <td><?= htmlspecialchars($row->customer_name) ?></td>
                                            <!-- <td><?= htmlspecialchars($row->manager_name) ?></td> -->
                                            <td>
                                                <?= htmlspecialchars($row->managers) ?>
                                            </td>
                                            <td class="muted">
                                                <?= !empty($row->start_date) ? date('d/m/Y', strtotime($row->start_date)) : '-' ?>
                                                &nbsp;–&nbsp;
                                                <?= !empty($row->end_date) ? date('d/m/Y', strtotime($row->end_date)) : '-' ?>
                                            </td>
                                            <td>
                                                <div class="xc-progress-wrap">
                                                    <div class="xc-progress-bar-bg">
                                                        <div class="xc-progress-bar-fill" style="width:<?= $progress ?>%"></div>
                                                    </div>
                                                    <div class="xc-progress-text"><?= $progress ?>%</div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="xc-badge <?= $statusClass ?>"><?= htmlspecialchars($statusValue) ?></span>
                                            </td>
                                            <td>
                                                <div class="xc-actions">
                                                    <a href="<?= base_url('index.php/project/edit/' . $row->id) ?>"
                                                        class="btn-xc btn-xc-edit">Edit</a>
                                                    <a href="<?= base_url('index.php/project/delete/' . $row->id) ?>"
                                                        class="btn-xc btn-xc-delete"
                                                        onclick="return confirm('Delete this project?')">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="xc-empty">
                                        <td colspan="8">No projects found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.xc-table-card -->

            </div>
        </div>

    </div>
</div>