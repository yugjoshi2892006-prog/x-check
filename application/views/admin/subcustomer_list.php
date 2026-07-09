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
                margin-bottom: 22px;
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

            /* Status badge */
            .xc-badge {
                display: inline-block;
                padding: 3px 14px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 500;
            }

            .xc-badge-active {
                background: #e0f7f4;
                color: #0a7a6b;
            }

            .xc-badge-inactive {
                background: #fde8e8;
                color: #b71c1c;
            }

            /* Action buttons */
            .xc-actions {
                display: flex;
                gap: 6px;
            }

            .btn-xc {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                padding: 5px 14px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: 500;
                text-decoration: none;
                cursor: pointer;
                white-space: nowrap;
                transition: opacity .15s;
                border: 1.5px solid;
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
        </style>


        <div class="xc-content">

            <!-- Header -->
            <div class="xc-header">
                <h2>Users of <?= htmlspecialchars($customer->name) ?></h2>
                <a href="<?= base_url('index.php/customer/add_subcustomer/' . $customer->id) ?>" class="btn-xc-add">
                    + Add User
                </a>
            </div>
            <div class="xc-breadcrumb">
                <a href="<?= base_url('index.php/dashboard') ?>">Masters</a>
                <span>›</span>
                <a href="<?= base_url('index.php/customer') ?>">Customers</a>
                <span>›</span> <?= htmlspecialchars($customer->name) ?>
            </div>
            <div class="xc-wrapper">
                <!-- Table -->
                <div class="xc-table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row->name) ?></td>
                                        <td><?= htmlspecialchars($row->mobile) ?></td>
                                        <td><?= htmlspecialchars($row->email) ?></td>
                                        <td><?= htmlspecialchars($row->type) ?></td>
                                        <td>
                                            <span
                                                class="xc-badge <?= strtolower($row->status) === 'active' ? 'xc-badge-active' : 'xc-badge-inactive' ?>">
                                                <?= $row->status ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="xc-actions">
                                                <a href="<?= base_url('index.php/customer/edit_subcustomer/' . $row->id) ?>"
                                                    class="btn-xc btn-xc-edit">Edit</a>
                                                <a href="<?= base_url('index.php/customer/delete_subcustomer/' . $row->id) ?>"
                                                    class="btn-xc btn-xc-delete"
                                                    onclick="return confirm('Delete User?')">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="xc-empty">
                                    <td colspan="6">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div><!-- /.xc-table-card -->

            </div>
        </div>

    </div>
</div>