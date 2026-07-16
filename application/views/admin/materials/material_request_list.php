<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-card">
            <div class="xc-card-body">

                <h4 class="mb-4" style="color:#1a1a2e; font-weight:700;">
                    Material Report
                </h4>

                <div class="table-responsive">
                    <table class="xc-table">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Project</th>

                                <th>Employee</th>

                                <th>Category</th>

                                <th>Sub Category</th>

                                <th>Qty</th>

                                <th>Unit</th>

                                <th>Remarks</th>

                                <th>Status</th>

                                <th width="170">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $i = 1;
                            foreach ($requests as $row) { ?>

                                <tr>

                                    <td>
                                        <?= $i++ ?>
                                    </td>

                                    <td>
                                        <?= $row->project_name ?>
                                    </td>

                                    <td>
                                        <?= $row->employee_name ?>
                                    </td>

                                    <td>
                                        <?= $row->category_name ?>
                                    </td>

                                    <td>
                                        <?= $row->subcategory_name ?>
                                    </td>

                                    <td>
                                        <?= $row->quantity ?>
                                    </td>

                                    <td>
                                        <?= $row->unit ?>
                                    </td>

                                    <td>
                                        <?= $row->remarks ?>
                                    </td>

                                    <td>

                                        <?php

                                        if ($row->status == "Pending") {
                                            echo '<span class="xc-pill xc-pill-warning">Pending</span>';
                                        } elseif ($row->status == "Approved") {
                                            echo '<span class="xc-pill xc-pill-success">Approved</span>';
                                        } else {
                                            echo '<span class="xc-pill xc-pill-danger">Rejected</span>';
                                        }

                                        ?>

                                    </td>

                                    <td>

                                        <?php if ($row->status == "Pending") { ?>

                                            <a href="<?= base_url('materials/approve_request/' . $row->id) ?>"
                                                class="xc-btn-outline-success">

                                                Approve

                                            </a>

                                            <a href="<?= base_url('materials/reject_request/' . $row->id) ?>"
                                                class="xc-btn-outline-danger">

                                                Reject

                                            </a>

                                        <?php } else { ?>

                                            --

                                        <?php } ?>

                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <style>
            .xc-card {
                background: #ffffff;
                border-radius: 14px;
                box-shadow: 0 2px 10px rgba(26, 26, 46, 0.06);
                border: 1px solid #eef1f4;
                overflow: hidden;
            }

            .xc-card-body {
                padding: 22px;
            }

            /* ===== Buttons ===== */
            .xc-btn-outline-success {
                display: inline-block;
                background: #ffffff;
                color: #0d9c8a;
                border: 1px solid #0fb4a0;
                padding: 5px 12px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                transition: background .2s, color .2s;
                margin-right: 4px;
            }

            .xc-btn-outline-success:hover {
                background: #0fb4a0;
                color: #ffffff;
            }

            .xc-btn-outline-danger {
                display: inline-block;
                background: #ffffff;
                color: #dc3545;
                border: 1px solid #dc3545;
                padding: 5px 12px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                transition: background .2s, color .2s;
            }

            .xc-btn-outline-danger:hover {
                background: #dc3545;
                color: #ffffff;
            }

            /* ===== Table ===== */
            .xc-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .xc-table thead,
            .xc-table thead tr {
                background-color: #0fb4a0 !important;
            }

            .xc-table thead th {
                color: #ffffff !important;
                font-weight: 600;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.3px;
                padding: 12px 14px;
                border: none !important;
                white-space: nowrap;
            }

            .xc-table thead th:first-child {
                border-top-left-radius: 8px;
            }

            .xc-table thead th:last-child {
                border-top-right-radius: 8px;
            }

            .xc-table tbody td {
                padding: 12px 14px;
                font-size: 14px;
                color: #1a1a2e;
                border-bottom: 1px solid #f0f2f4;
                vertical-align: middle;
            }

            .xc-table tbody tr:hover {
                background-color: #f7fdfc;
            }

            /* ===== Pills ===== */
            .xc-pill {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 50px;
                font-size: 12px;
                font-weight: 600;
            }

            .xc-pill-warning {
                background: #fff3cd;
                color: #92720c;
            }

            .xc-pill-success {
                background: #d4f4ec;
                color: #0d9c8a;
            }

            .xc-pill-danger {
                background: #fde2e4;
                color: #c0293a;
            }
        </style>

    </div>
</div>
