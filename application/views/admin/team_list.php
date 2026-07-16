<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid py-4 px-4">

            <?php
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $per_page = 10;
            $total = isset($total) ? $total : 0;
            $total_pages = ceil($total / $per_page);

            $search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
            $state = isset($_GET['state']) ? htmlspecialchars($_GET['state']) : '';
            $city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : '';
            $type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';
            $status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '';

            if (!function_exists('build_query')) {
                function build_query($overrides = [])
                {
                    $params = array_merge([
                        'search' => isset($_GET['search']) ? $_GET['search'] : '',
                        'state' => isset($_GET['state']) ? $_GET['state'] : '',
                        'city' => isset($_GET['city']) ? $_GET['city'] : '',
                        'type' => isset($_GET['type']) ? $_GET['type'] : '',
                        'status' => isset($_GET['status']) ? $_GET['status'] : '',
                        'page' => isset($_GET['page']) ? $_GET['page'] : 1,
                    ], $overrides);
                    return http_build_query(array_filter($params));
                }
            }
            ?>

            <style>
                :root {
                    --xc-teal: #0fb4a0;
                    --xc-teal-dark: #0c9786;
                    --xc-teal-soft: #e6faf7;
                    --xc-navy: #1a1a2e;
                    --xc-ink-soft: #475569;
                    --xc-muted: #94a3b8;
                    --xc-line: #e2e8f0;
                }

                /* ── Breadcrumb ── */
                .xc-tm-breadcrumb {
                    font-size: 12px;
                    color: var(--xc-muted);
                    margin-bottom: 4px;
                }

                .xc-tm-breadcrumb a {
                    color: var(--xc-teal);
                    text-decoration: none;
                }

                .xc-tm-breadcrumb a:hover {
                    text-decoration: underline;
                }

                /* ── Page Header ── */
                .xc-tm-page-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 1.25rem;
                }

                .xc-tm-page-header h3 {
                    font-size: 22px;
                    font-weight: 700;
                    color: var(--xc-navy);
                    margin: 0;
                }

                .xc-tm-btn-add {
                    background: var(--xc-teal);
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    padding: 9px 20px;
                    font-size: 13px;
                    font-weight: 600;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    text-decoration: none;
                    transition: background 0.2s;
                }

                .xc-tm-btn-add:hover {
                    background: var(--xc-teal-dark);
                    color: #fff;
                }

                /* ── Filter Card ── */
                .xc-tm-filter-card {
                    background: rgba(255, 255, 255, 0.75);
                    backdrop-filter: blur(12px);
                    border: 1px solid var(--xc-line);
                    border-radius: 12px;
                    padding: 1rem 1.25rem;
                    margin-bottom: 1.25rem;
                }

                .xc-tm-filter-card .form-control,
                .xc-tm-filter-card .form-select {
                    font-size: 13px;
                    height: 38px;
                    border-radius: 8px;
                    border: 1px solid var(--xc-line);
                    background: #f8f9fc;
                }

                .xc-tm-filter-card .form-control:focus,
                .xc-tm-filter-card .form-select:focus {
                    border-color: var(--xc-teal);
                    box-shadow: 0 0 0 3px var(--xc-teal-soft);
                }

                .xc-tm-btn-search {
                    background: var(--xc-teal);
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    padding: 0 20px;
                    height: 38px;
                    font-size: 13px;
                    font-weight: 600;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    transition: background 0.2s;
                    cursor: pointer;
                }

                .xc-tm-btn-search:hover {
                    background: var(--xc-teal-dark);
                }

                .xc-tm-btn-reset {
                    background: #f0f2f5;
                    color: #555;
                    border: 1px solid var(--xc-line);
                    border-radius: 8px;
                    padding: 0 18px;
                    height: 38px;
                    font-size: 13px;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    text-decoration: none;
                    transition: background 0.2s;
                }

                .xc-tm-btn-reset:hover {
                    background: #e2e6ea;
                    color: #333;
                }

                /* ── Table Card ── */
                .xc-tm-table-card {
                    background: #fff;
                    border: 1px solid var(--xc-line);
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 2px 10px rgba(26, 26, 46, 0.05);
                }

                .xc-tm-table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .xc-tm-table thead,
                .xc-tm-table thead tr {
                    background-color: var(--xc-teal) !important;
                    background: linear-gradient(135deg, #0fb4a0, #0c8f7f) !important;
                }

                .xc-tm-table thead th {
                    color: #fff !important;
                    font-weight: 600;
                    font-size: 13px;
                    text-transform: uppercase;
                    letter-spacing: 0.3px;
                    padding: 13px 15px;
                    border: none !important;
                    white-space: nowrap;
                    text-align: left;
                }

                .xc-tm-table tbody tr {
                    border-bottom: 1px solid #f0f2f5;
                    transition: background 0.15s;
                }

                .xc-tm-table tbody tr:last-child {
                    border-bottom: none;
                }

                .xc-tm-table tbody tr:nth-child(even) {
                    background: #f9fbfc;
                }

                .xc-tm-table tbody tr:hover {
                    background: var(--xc-teal-soft);
                }

                .xc-tm-table tbody td {
                    padding: 13px 15px;
                    vertical-align: middle;
                    font-size: 13px;
                    color: #2b2b40;
                }

                .xc-tm-id {
                    font-weight: 700;
                    color: var(--xc-teal);
                    font-size: 13px;
                }

                .xc-tm-city {
                    font-weight: 500;
                }

                .xc-tm-state {
                    font-size: 11px;
                    color: var(--xc-muted);
                }

                .xc-tm-type-tag {
                    font-size: 11.5px;
                    color: var(--xc-teal-dark);
                    line-height: 1.9;
                }

                .xc-tm-badge-active {
                    background: #e6f9f0;
                    color: #1a7a4a;
                    font-size: 11px;
                    padding: 5px 12px;
                    border-radius: 20px;
                    font-weight: 600;
                    display: inline-block;
                }

                .xc-tm-badge-inactive {
                    background: #fde8e8;
                    color: #a32d2d;
                    font-size: 11px;
                    padding: 5px 12px;
                    border-radius: 20px;
                    font-weight: 600;
                    display: inline-block;
                }

                .xc-tm-proj-count {
                    font-weight: 700;
                    color: var(--xc-navy);
                }

                .xc-tm-proj-link {
                    color: var(--xc-teal);
                    font-size: 13px;
                    text-decoration: none;
                }

                .xc-tm-btn-edit {
                    background: #fff8e1;
                    color: #856404;
                    border: 1px solid #f0c040;
                    border-radius: 6px;
                    padding: 5px 13px;
                    font-size: 12px;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 4px;
                    transition: background 0.15s;
                }

                .xc-tm-btn-edit:hover {
                    background: #ffe69c;
                    color: #856404;
                }

                .xc-tm-btn-delete {
                    background: #fde8e8;
                    color: #a32d2d;
                    border: 1px solid #f0a0a0;
                    border-radius: 6px;
                    padding: 5px 13px;
                    font-size: 12px;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 4px;
                    transition: background 0.15s;
                }

                .xc-tm-btn-delete:hover {
                    background: #f7c1c1;
                    color: #a32d2d;
                }

                /* ── Pagination ── */
                .xc-tm-pagination-wrap {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 14px 16px;
                    border-top: 1px solid #f0f2f5;
                    background: #fafbfc;
                }

                .xc-tm-page-info {
                    font-size: 13px;
                    color: var(--xc-muted);
                }

                .xc-tm-pagination {
                    display: flex;
                    gap: 4px;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                }

                .xc-tm-pagination li a,
                .xc-tm-pagination li span {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-width: 36px;
                    height: 34px;
                    padding: 0 10px;
                    border: 1px solid #e0e0e0;
                    border-radius: 6px;
                    font-size: 13px;
                    color: var(--xc-teal);
                    text-decoration: none;
                    background: #fff;
                    transition: all 0.15s;
                }

                .xc-tm-pagination li a:hover {
                    background: var(--xc-teal-soft);
                    border-color: var(--xc-teal);
                }

                .xc-tm-pagination li.active span {
                    background: var(--xc-teal);
                    border-color: var(--xc-teal);
                    color: #fff;
                }

                .xc-tm-pagination li.disabled span {
                    color: #ccc;
                    cursor: default;
                }

                /* ── Empty State ── */
                .xc-tm-empty {
                    text-align: center;
                    padding: 50px 20px;
                    color: var(--xc-muted);
                }

                .xc-tm-empty i {
                    font-size: 40px;
                    display: block;
                    margin-bottom: 10px;
                    color: var(--xc-line);
                }

                .xc-tm-empty p {
                    font-size: 14px;
                    margin: 0;
                }

                @media (max-width: 768px) {
                    .xc-tm-page-header h3 {
                        font-size: 19px;
                    }

                    .xc-tm-filter-card {
                        padding: 0.85rem 1rem;
                    }
                }
            </style>

            <!-- Breadcrumb -->
            <div class="xc-tm-breadcrumb mb-1">
                <a href="<?= base_url('dashboard') ?>">Masters</a> &rsaquo; Team
            </div>

            <!-- Page Header -->
            <div class="xc-tm-page-header">
                <h3>Team</h3>
                <a href="<?= base_url('team/add') ?>" class="xc-tm-btn-add">
                    <i class="ti ti-plus"></i> Add Team
                </a>
            </div>

            <!-- Filter Card -->
            <div class="xc-tm-filter-card">
                <form method="GET" action="<?= base_url('team') ?>">
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"
                                    style="border-radius:8px 0 0 8px; border:1px solid #dde1ea; height:38px;">
                                    <i class="ti ti-search" style="color:#aaa; font-size:15px;"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0"
                                    placeholder="Search name, ID, email..." value="<?= $search ?>"
                                    style="border-radius:0 8px 8px 0; height:38px;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="state" class="form-select">
                                <option value="">Select State</option>
                                <?php
                                $states = [
                                    'Andhra Pradesh',
                                    'Assam',
                                    'Bihar',
                                    'Delhi',
                                    'Gujarat',
                                    'Haryana',
                                    'Karnataka',
                                    'Kerala',
                                    'Madhya Pradesh',
                                    'Maharashtra',
                                    'Odisha',
                                    'Punjab',
                                    'Rajasthan',
                                    'Tamil Nadu',
                                    'Telangana',
                                    'Uttar Pradesh',
                                    'West Bengal'
                                ];
                                foreach ($states as $s) {
                                    echo '<option value="' . $s . '" ' . ($state == $s ? 'selected' : '') . '>' . $s . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="senior" <?= $type == 'senior' ? 'selected' : '' ?>>Senior</option>
                                <option value="project_manager" <?= $type == 'project_manager' ? 'selected' : '' ?>>Project
                                    Manager</option>
                                <option value="site_engineer" <?= $type == 'site_engineer' ? 'selected' : '' ?>>Site Engineer
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" name="city" class="form-control" placeholder="City" value="<?= $city ?>">
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="Active" <?= $status == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= $status == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="xc-tm-btn-search">
                                <i class="ti ti-search"></i> Search
                            </button>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('team') ?>" class="xc-tm-btn-reset">
                                <i class="ti ti-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Card -->
            <div class="xc-tm-table-card">
                <div class="table-responsive">
                    <table class="xc-tm-table">
                        <thead>
                            <tr>
                                <th>TM ID</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Email ID</th>
                                <th>City/State</th>
                                <th>Type</th>
                                <th>Assigned Project</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($team)) { ?>
                                <?php foreach ($team as $row) { ?>
                                    <tr>
                                        <td>
                                            <span class="xc-tm-id">T<?= str_pad($row->id, 5, '0', STR_PAD_LEFT) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($row->name) ?></td>
                                        <td><?= htmlspecialchars($row->mobile) ?></td>
                                        <td style="font-size:12px;"><?= htmlspecialchars($row->email) ?></td>
                                        <td>
                                            <span class="xc-tm-city"><?= htmlspecialchars($row->city) ?></span><br>
                                            <span class="xc-tm-state"><?= htmlspecialchars($row->state) ?></span>
                                        </td>
                                        <td>
                                            <div class="xc-tm-type-tag">
                                                <?php if ($row->is_senior == 1)
                                                    echo '<div>- Senior</div>'; ?>
                                                <?php if ($row->is_project_manager == 1)
                                                    echo '<div>- Project Manager</div>'; ?>
                                                <?php if ($row->is_site_engineer == 1)
                                                    echo '<div>- Site Engineer</div>'; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="xc-tm-proj-count"><?= isset($row->assigned_projects) ? $row->assigned_projects : 0 ?></span>
                                            <?php if (!empty($row->assigned_projects) && $row->assigned_projects > 0) { ?>
                                                <a href="<?= base_url('team/projects/' . $row->id) ?>"
                                                    class="xc-tm-proj-link"> ›</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (strtolower($row->status) == 'active') { ?>
                                                <span class="xc-tm-badge-active">Active</span>
                                            <?php } else { ?>
                                                <span class="xc-tm-badge-inactive">Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="<?= base_url('team/edit/' . $row->id) ?>"
                                                    class="xc-tm-btn-edit">
                                                    <i class="ti ti-pencil"></i> Edit
                                                </a>
                                                <a href="<?= base_url('team/delete/' . $row->id) ?>"
                                                    class="xc-tm-btn-delete"
                                                    onclick="return confirm('Are you sure you want to delete this team member?')">
                                                    <i class="ti ti-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="9">
                                        <div class="xc-tm-empty">
                                            <i class="ti ti-users-off"></i>
                                            <p>No team members found. <a href="<?= base_url('team/add') ?>"
                                                    style="color:var(--xc-teal);">Add one?</a></p>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($total > 0) { ?>
                    <div class="xc-tm-pagination-wrap">
                        <span class="xc-tm-page-info">
                            Showing <?= min(($page - 1) * $per_page + 1, $total) ?>–<?= min($page * $per_page, $total) ?> of
                            <?= $total ?> members
                        </span>
                        <ul class="xc-tm-pagination">

                            <!-- Prev -->
                            <li class="<?= $page <= 1 ? 'disabled' : '' ?>">
                                <?php if ($page > 1) { ?>
                                    <a href="?<?= build_query(['page' => $page - 1]) ?>"><i class="ti ti-chevron-left"></i></a>
                                <?php } else { ?>
                                    <span><i class="ti ti-chevron-left"></i></span>
                                <?php } ?>
                            </li>

                            <!-- Page Numbers -->
                            <?php
                            $start_page = max(1, $page - 2);
                            $end_page = min($total_pages, $start_page + 4);
                            $start_page = max(1, $end_page - 4);
                            for ($p = $start_page; $p <= $end_page; $p++) { ?>
                                <li class="<?= $p == $page ? 'active' : '' ?>">
                                    <?php if ($p == $page) { ?>
                                        <span><?= $p ?></span>
                                    <?php } else { ?>
                                        <a href="?<?= build_query(['page' => $p]) ?>"><?= $p ?></a>
                                    <?php } ?>
                                </li>
                            <?php } ?>

                            <!-- Next -->
                            <li class="<?= $page >= $total_pages ? 'disabled' : '' ?>">
                                <?php if ($page < $total_pages) { ?>
                                    <a href="?<?= build_query(['page' => $page + 1]) ?>"><i class="ti ti-chevron-right"></i></a>
                                <?php } else { ?>
                                    <span><i class="ti ti-chevron-right"></i></span>
                                <?php } ?>
                            </li>

                        </ul>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>  
