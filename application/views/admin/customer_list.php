<div class="page-wrapper">
    <div class="page-content">
        <?php
        $total_rows    = isset($total_rows)    ? $total_rows    : count($customers);
        $current_page  = isset($current_page)  ? $current_page  : 1;
        $per_page      = isset($per_page)      ? $per_page      : 10;
        ?>

        <style>
            /* ── Page shell ── */
            .xc-wrapper  { background: #fff; min-height: 100vh; }
            .xc-content  { padding: 28px 32px; }

            /* ── Page header ── */
            .xc-header          { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
            .xc-header h2       { font-size: 22px; font-weight: 700; color: #1a1a2e; margin: 0; }
            .xc-breadcrumb      { font-size: 12px; color: #9aa0ac; margin-bottom: 22px; }
            .xc-breadcrumb a    { color: #0fb4a0; text-decoration: none; }
            .xc-breadcrumb span { margin: 0 5px; }

            /* ── Add button ── */
            .btn-xc-add {
                background: #0fb4a0; color: #fff; border: none;
                padding: 9px 22px; border-radius: 8px;
                font-size: 13.5px; font-weight: 500;
                text-decoration: none;
                display: inline-flex; align-items: center; gap: 6px;
                transition: background .15s;
            }
            .btn-xc-add:hover { background: #0d9b89; color: #fff; text-decoration: none; }

            /* ── Filter bar (flat, no card) ── */
            .xc-filter-bar {
                background: #fff;
                border-radius: 12px;
                border: 0.5px solid #e4e6ea;
                padding: 16px 20px;
                margin-bottom: 20px;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                align-items: center;
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
                box-shadow: 0 0 0 3px rgba(15,180,160,.12);
                background: #fff;
                outline: none;
            }

            .btn-xc-search {
                height: 40px; padding: 0 28px;
                background: #0fb4a0; color: #fff;
                border: none; border-radius: 8px;
                font-size: 13px; font-weight: 500;
                cursor: pointer; transition: background .15s;
                white-space: nowrap;
            }
            .btn-xc-search:hover { background: #0d9b89; }

            .btn-xc-reset {
                height: 40px; padding: 0 22px;
                background: #fff; color: #555;
                border: 1px solid #dde0e6; border-radius: 8px;
                font-size: 13px; font-weight: 500;
                text-decoration: none;
                display: inline-flex; align-items: center;
                transition: background .15s, border-color .15s;
                white-space: nowrap;
            }
            .btn-xc-reset:hover { background: #f5f5f5; color: #333; text-decoration: none; }

            /* ── Table card ── */
            .xc-table-card {
                background: #fff;
                border-radius: 12px;
                border: 0.5px solid #e4e6ea;
                overflow: hidden;
            }

            .xc-table-card table {
                width: 100%; margin: 0;
                border-collapse: collapse;
                font-size: 13.5px;
                table-layout: fixed;
            }

            .xc-table-card thead th {
                background: #0fb4a0; color: #fff;
                font-weight: 500; padding: 13px 16px;
                text-align: left; white-space: nowrap; border: none;
            }

            .xc-table-card tbody tr   { border-bottom: 0.5px solid #f0f2f5; }
            .xc-table-card tbody tr:last-child { border-bottom: none; }
            .xc-table-card tbody tr:hover { background: #f0faf9; }
            .xc-table-card tbody td {
                padding: 12px 16px; color: #2d3436;
                vertical-align: middle; border: none;
            }
            .xc-table-card tbody td.muted { color: #0fb4a0; font-weight: 500; }

            /* ── Status badge ── */
            .xc-badge          { display: inline-block; padding: 3px 14px; border-radius: 20px; font-size: 12px; font-weight: 500; }
            .xc-badge-active   { background: #e0f7f4; color: #0a7a6b; }
            .xc-badge-inactive { background: #fde8e8; color: #b71c1c; }

            /* ── Action buttons (outlined like Team page) ── */
            .xc-actions { display: flex; gap: 6px; flex-wrap: nowrap; }

            .btn-xc {
                display: inline-flex; align-items: center; gap: 4px;
                padding: 5px 14px; border-radius: 6px;
                font-size: 12px; font-weight: 500;
                text-decoration: none; cursor: pointer;
                white-space: nowrap; transition: opacity .15s, background .15s;
            }
            .btn-xc:hover { opacity: .85; text-decoration: none; }

            /* Outlined style matching Team page */
            .btn-xc-edit   { background: #fff; color: #f59e0b; border: 1.5px solid #f59e0b; }
            .btn-xc-edit:hover   { background: #fff8ec; }

            .btn-xc-delete { background: #fff; color: #ef4444; border: 1.5px solid #ef4444; }
            .btn-xc-delete:hover { background: #fff0f0; }

            .btn-xc-users  { background: #0ea5e9; color: #fff; border: 1.5px solid #0ea5e9; }
            .btn-xc-users:hover { background: #0b8ec7; border-color: #0b8ec7; }

            /* ── Pagination ── */
            .xc-pagination-bar {
                display: flex; justify-content: space-between; align-items: center;
                padding: 14px 20px; border-top: 0.5px solid #f0f2f5;
                font-size: 13px; color: #9aa0ac;
            }
            .xc-pagination { display: flex; gap: 4px; list-style: none; margin: 0; padding: 0; }
            .xc-pagination li a,
            .xc-pagination li span {
                display: flex; align-items: center; justify-content: center;
                width: 34px; height: 34px; border-radius: 8px;
                border: 0.5px solid #dde0e6; font-size: 13px;
                color: #444; text-decoration: none;
                transition: background .12s, color .12s, border-color .12s;
            }
            .xc-pagination li.active span  { background: #0fb4a0; color: #fff; border-color: #0fb4a0; }
            .xc-pagination li a:hover      { background: #0fb4a0; color: #fff; border-color: #0fb4a0; }
            .xc-pagination li.disabled span { color: #ccc; cursor: default; background: #fafafa; }

            /* ── Empty state ── */
            .xc-empty td { text-align: center; padding: 56px 0 !important; color: #b2bec3; font-size: 14px; }

            /* ── Column widths ── */
            .col-id     { width: 52px; }
            .col-name   { width: 150px; }
            .col-mobile { width: 130px; }
            .col-email  { width: 185px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
            .col-state  { width: 95px; }
            .col-city   { width: 100px; }
            .col-status { width: 95px; }
            .col-action { width: 195px; }
        </style>

        <div class="xc-wrapper">
            <div class="xc-content">

                <!-- Header -->
                <div class="xc-header">
                    <h2>Customers</h2>
                    <a href="<?= base_url('customer/add') ?>" class="btn-xc-add">
                        + Add Customer
                    </a>
                </div>
                <div class="xc-breadcrumb">
                    <a href="<?= base_url('admin/dashboard') ?>">Masters</a>
                    <span>›</span> Customers
                </div>

                <!-- Filter bar (flat row, no card label) -->
                <form method="GET" action="<?= base_url('customer') ?>">
                    <div class="xc-filter-bar">

                        <input type="text" name="search" class="form-control"
                            placeholder="Search name, ID, email…"
                            value="<?= htmlspecialchars($filter['search'] ?? '') ?>">

                        <select name="state" class="form-select" id="filter_state"
                            onchange="loadCities(this.value)">
                            <option value="">Select State</option>
                            <?php foreach ($states as $s): ?>
                                <option value="<?= $s->state ?>"
                                    <?= (($filter['state'] ?? '') == $s->state) ? 'selected' : '' ?>>
                                    <?= $s->state ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="city" class="form-select" id="filter_city">
                            <option value="">Select City</option>
                            <?php foreach ($cities as $c): ?>
                                <option value="<?= $c->city ?>"
                                    <?= (($filter['city'] ?? '') == $c->city) ? 'selected' : '' ?>>
                                    <?= $c->city ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Active"   <?= (($filter['status'] ?? '') == 'Active')   ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= (($filter['status'] ?? '') == 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                        </select>

                        <button type="submit" class="btn-xc-search">Search</button>
                        <a href="<?= base_url('customer') ?>" class="btn-xc-reset">Reset</a>

                    </div>
                </form>

                <!-- Table -->
                <div class="xc-table-card">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-id">ID</th>
                                <th class="col-name">Name</th>
                                <th class="col-mobile">Mobile</th>
                                <th class="col-email">Email</th>
                                <th class="col-state">State</th>
                                <th class="col-city">City</th>
                                <th class="col-status">Status</th>
                                <th class="col-action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($customers)): ?>
                                <?php foreach ($customers as $row): ?>
                                    <tr>
                                        <td class="muted"><?= $row->id ?></td>
                                        <td><?= htmlspecialchars($row->name) ?></td>
                                        <td><?= htmlspecialchars($row->mobile) ?></td>
                                        <td class="col-email" title="<?= htmlspecialchars($row->email) ?>">
                                            <?= htmlspecialchars($row->email) ?>
                                        </td>
                                        <td><?= htmlspecialchars($row->state) ?></td>
                                        <td><?= htmlspecialchars($row->city) ?></td>
                                        <td>
                                            <span class="xc-badge <?= strtolower($row->status) === 'active' ? 'xc-badge-active' : 'xc-badge-inactive' ?>">
                                                <?= $row->status ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="xc-actions">
                                                <a href="<?= base_url('customer/edit/' . $row->id) ?>"
                                                    class="btn-xc btn-xc-edit">Edit</a>
                                                <a href="<?= base_url('customer/delete/' . $row->id) ?>"
                                                    class="btn-xc btn-xc-delete"
                                                    onclick="return confirm('Delete Customer?')">Delete</a>
                                                <a href="<?= base_url('customer/subcustomer_list/' . $row->id) ?>"
                                                    class="btn-xc btn-xc-users">Users</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="xc-empty">
                                    <td colspan="8">No customers found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <?php if ($total_rows > 0):
                        $total_pages  = ceil($total_rows / $per_page);
                        $start_record = ($current_page - 1) * $per_page + 1;
                        $end_record   = min($current_page * $per_page, $total_rows);
                    ?>
                        <div class="xc-pagination-bar">
                            <div>
                                Showing <strong><?= $start_record ?>–<?= $end_record ?></strong>
                                of <strong><?= $total_rows ?></strong> customers
                            </div>
                            <nav>
                                <ul class="xc-pagination">

                                    <li class="<?= $current_page <= 1 ? 'disabled' : '' ?>">
                                        <?php if ($current_page > 1): ?>
                                            <a href="<?= build_pagination_url($current_page - 1, $filter) ?>">&#8249;</a>
                                        <?php else: ?>
                                            <span>&#8249;</span>
                                        <?php endif; ?>
                                    </li>

                                    <?php
                                    $pg_start = max(1, $current_page - 3);
                                    $pg_end   = min($total_pages, $current_page + 3);
                                    ?>

                                    <?php if ($pg_start > 1): ?>
                                        <li><a href="<?= build_pagination_url(1, $filter) ?>">1</a></li>
                                        <?php if ($pg_start > 2): ?><li class="disabled"><span>…</span></li><?php endif; ?>
                                    <?php endif; ?>

                                    <?php for ($i = $pg_start; $i <= $pg_end; $i++): ?>
                                        <li class="<?= $i == $current_page ? 'active' : '' ?>">
                                            <?php if ($i == $current_page): ?>
                                                <span><?= $i ?></span>
                                            <?php else: ?>
                                                <a href="<?= build_pagination_url($i, $filter) ?>"><?= $i ?></a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($pg_end < $total_pages): ?>
                                        <?php if ($pg_end < $total_pages - 1): ?><li class="disabled"><span>…</span></li><?php endif; ?>
                                        <li><a href="<?= build_pagination_url($total_pages, $filter) ?>"><?= $total_pages ?></a></li>
                                    <?php endif; ?>

                                    <li class="<?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                                        <?php if ($current_page < $total_pages): ?>
                                            <a href="<?= build_pagination_url($current_page + 1, $filter) ?>">&#8250;</a>
                                        <?php else: ?>
                                            <span>&#8250;</span>
                                        <?php endif; ?>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>

                </div><!-- /.xc-table-card -->

            </div>
        </div>
    </div>
</div>

<script>
function loadCities(state) {
    const citySelect = document.getElementById('filter_city');
    citySelect.innerHTML = '<option value="">Loading…</option>';
    if (!state) { citySelect.innerHTML = '<option value="">Select City</option>'; return; }
    fetch('<?= base_url('customer/get_cities') ?>?state=' + encodeURIComponent(state))
        .then(r => r.json())
        .then(cities => {
            citySelect.innerHTML = '<option value="">Select City</option>';
            cities.forEach(c => {
                citySelect.innerHTML += `<option value="${c}">${c}</option>`;
            });
        });
}
</script>
