<style>
    .xc-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .xc-card .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border-bottom: 1px solid #f0f2f5;
        padding: 20px 24px;
    }

    .xc-card .card-header .xc-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .xc-card .card-header .xc-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #e3f9f6;
        color: #14b8a6;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .xc-card .card-header h4 {
        margin: 0;
        font-weight: 700;
        color: #1f2937;
        font-size: 18px;
    }

    .xc-card .card-header small {
        color: #9aa3af;
        font-size: 13px;
    }

    .xc-count-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f1f3f9;
        color: #4b5563;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 16px;
        border-radius: 30px;
        white-space: nowrap;
    }

    .xc-card .card-body {
        padding: 8px 24px 24px;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
    }

    .xc-table thead th {
        text-transform: uppercase;
        font-size: 11.5px;
        letter-spacing: 0.5px;
        color: #9aa3af;
        font-weight: 700;
        border: none;
        border-bottom: 1px solid #f0f2f5;
        padding: 14px 12px;
        white-space: nowrap;
    }

    .xc-table tbody td {
        border: none;
        border-bottom: 1px solid #f5f6f8;
        padding: 14px 12px;
        vertical-align: middle;
        color: #374151;
        font-size: 14.5px;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-table tbody tr:hover {
        background: #fbfdfd;
    }

    .xc-table td strong {
        color: #1f2937;
        font-weight: 700;
    }

    /* pill link buttons (View / PDF) */
    .xc-pill-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        padding: 7px 14px;
        border-radius: 30px;
        text-decoration: none;
        border: none;
        white-space: nowrap;
    }

    .xc-pill-view {
        background: #e3f9f6;
        color: #0d9488;
    }

    .xc-pill-view:hover {
        background: #cdf3ee;
        color: #0d9488;
    }

    .xc-pill-pdf {
        background: #eee9fd;
        color: #6d4dea;
    }

    .xc-pill-pdf:hover {
        background: #e1d9fc;
        color: #6d4dea;
    }

    .xc-thumb {
        width: 46px;
        height: 46px;
        border-radius: 10px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    /* circular action buttons */
    .xc-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .xc-icon-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        text-decoration: none;
        font-size: 15px;
        transition: transform .15s ease;
    }

    .xc-icon-btn:hover {
        transform: translateY(-1px);
    }

    .xc-icon-view {
        background: #e3f9f6;
        color: #14b8a6;
    }

    .xc-icon-edit {
        background: #fef1e0;
        color: #f5a524;
    }

    .xc-icon-delete {
        background: #fde9ea;
        color: #ef4444;
    }

    .xc-empty {
        text-align: center;
        padding: 40px 0;
        color: #9aa3af;
        font-size: 14.5px;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <div class="card xc-card">

            <div class="card-header">
                <div class="xc-title-wrap">
                    <div class="xc-icon-box">
                        <i class="bx bx-map"></i>
                    </div>
                    <div>
                        <h4>Layout Plan List</h4>
                        <small>Site drawings, layout photos &amp; soil test records</small>
                    </div>
                </div>

                <span class="xc-count-pill">
                    <i class="bx bx-list-ul"></i>
                    <?= !empty($plans) ? count($plans) : 0; ?> Plans
                </span>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="xc-table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Plan Name</th>
                                <th>Site Drawing</th>
                                <th>Layout Photo</th>
                                <th>Soil Test</th>
                                <th>Requirement</th>
                                <th>Created</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($plans)) { ?>

                                <?php $i = 1;
                                foreach ($plans as $row) { ?>

                                    <tr>

                                        <td><?= $i++; ?></td>

                                        <td><strong><?= $row->customer_name; ?></strong></td>

                                        <td><?= $row->plan_name; ?></td>

                                        <td>
                                            <?php if ($row->drawing_file != '') { ?>

                                                <a href="<?= base_url('uploads/layout_plan/drawing/' . $row->drawing_file); ?>"
                                                    target="_blank" class="xc-pill-btn xc-pill-view">
                                                    <i class="bx bx-file"></i> View
                                                </a>

                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>
                                        </td>

                                        <td>

                                            <?php if ($row->layout_photo != '') { ?>

                                                <img src="<?= base_url('uploads/layout_plan/photo/' . $row->layout_photo); ?>"
                                                    class="xc-thumb">

                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>

                                        </td>

                                        <td>

                                            <?php if ($row->soil_test_pdf != '') { ?>

                                                <a href="<?= base_url('uploads/layout_plan/soil/' . $row->soil_test_pdf); ?>"
                                                    target="_blank" class="xc-pill-btn xc-pill-pdf">
                                                    <i class="bx bxs-file-pdf"></i> PDF
                                                </a>

                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>

                                        </td>

                                        <td><?= $row->requirement; ?></td>

                                        <td><?= date('d-m-Y', strtotime($row->created_at)); ?></td>

                                        <td>
                                            <div class="xc-actions">

                                                <a href="<?= base_url('employee/layout_plan_details/' . $row->id); ?>"
                                                    class="xc-icon-btn xc-icon-view" title="View">
                                                    <i class="bx bx-show"></i>
                                                </a>

                                                <!-- <a href="<?= base_url('employee/layout_plan_edit/' . $row->id); ?>"
                                                    class="xc-icon-btn xc-icon-edit" title="Edit">
                                                    <i class="bx bx-edit"></i>
                                                </a>

                                                <a href="<?= base_url('employee/layout_plan_delete/' . $row->id); ?>"
                                                    class="xc-icon-btn xc-icon-delete" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this layout plan?');">
                                                    <i class="bx bx-trash"></i>
                                                </a> -->

                                            </div>
                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="9" class="xc-empty">
                                        <i class="bx bx-map-pin"
                                            style="font-size:28px;display:block;margin-bottom:8px;"></i>
                                        No Layout Plans Found
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>
