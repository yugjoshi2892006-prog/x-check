<style>
    /* ===== X-CHECK theme tokens (scoped to this page) ===== */
    .xc-wrapper {
        --xc-teal: #16b8b3;
        --xc-teal-dark: #0f9a95;
        --xc-teal-light: #e6f9f8;
        --xc-text-muted: #8a94a6;
        --xc-border: #eef1f4;
    }

    .xc-card {
        background: #fff;
        border: 1px solid var(--xc-border);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(20, 40, 60, .04);
        overflow: hidden;
    }

    .xc-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px;
        border-bottom: 1px solid var(--xc-border);
        flex-wrap: wrap;
        gap: 12px;
    }

    .xc-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .xc-icon-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .xc-title {
        font-weight: 700;
        font-size: 1.05rem;
        color: #1e2733;
        margin: 0;
    }

    .xc-subtitle {
        font-size: .82rem;
        color: var(--xc-text-muted);
        margin: 0;
    }

    .xc-count-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f4f6f9;
        color: #4b5768;
        font-weight: 600;
        font-size: .82rem;
        padding: 7px 16px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .xc-add-btn {
        background: var(--xc-teal);
        border: none;
        color: #fff;
        font-weight: 600;
        font-size: .85rem;
        padding: 9px 18px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: background .15s ease;
    }

    .xc-add-btn:hover {
        background: var(--xc-teal-dark);
        color: #fff;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .xc-table thead th {
        text-transform: uppercase;
        font-size: .72rem;
        letter-spacing: .04em;
        font-weight: 700;
        color: var(--xc-text-muted);
        background: #fafbfc;
        padding: 14px 20px;
        border-bottom: 1px solid var(--xc-border);
        white-space: nowrap;
    }

    .xc-table tbody td {
        padding: 14px 20px;
        font-size: .88rem;
        color: #2b3441;
        border-bottom: 1px solid var(--xc-border);
        vertical-align: middle;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-table tbody tr:hover {
        background: #f9fdfd;
    }

    .xc-cell-strong {
        font-weight: 600;
        color: #1e2733;
    }

    .xc-thumb {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--xc-border);
    }

    .xc-dash {
        color: var(--xc-text-muted);
    }

    /* pill-style file / status links, matching the badge look in the theme */
    .xc-pill-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .76rem;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 999px;
        text-decoration: none;
        white-space: nowrap;
    }

    .xc-pill-link.pill-teal {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-pill-link.pill-blue {
        background: #eaf1ff;
        color: #3766e8;
    }

    .xc-pill-link:hover {
        opacity: .85;
    }

    /* circular icon action buttons, matching the eye / print / download icons */
    .xc-action-group {
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
        font-size: 15px;
        border: none;
        text-decoration: none;
        transition: filter .15s ease;
    }

    .xc-icon-btn:hover {
        filter: brightness(.94);
    }

    .xc-icon-view {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-icon-edit {
        background: #fff4e0;
        color: #c98a1c;
    }

    .xc-icon-delete {
        background: #fdeaea;
        color: #d9534f;
    }

    .xc-alert {
        border-radius: 10px;
        border: none;
        font-size: .88rem;
        padding: 12px 16px;
    }
</style>

<div class="page-wrapper xc-wrapper">
    <div class="page-content">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- <h4 class="mb-0">Layout Plan List</h4> -->

            <a href="<?= base_url('layout_member/layout_plan_add'); ?>" class="xc-add-btn">
                <i class="bx bx-plus"></i> Add Layout Plan
            </a>
        </div>

        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success xc-alert">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger xc-alert">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

        <div class="xc-card">

            <div class="xc-card-header">
                <div class="xc-header-left">
                    <div class="xc-icon-badge">
                        <i class="bx bx-map-alt"></i>
                    </div>
                    <div>
                        <p class="xc-title">Layout Plan List</p>
                        <p class="xc-subtitle">Site drawings, layout photos &amp; soil test records</p>
                    </div>
                </div>

                <span class="xc-count-pill">
                    <i class="bx bx-list-ul"></i>
                    <?= count($plans); ?> Plans
                </span>
            </div>

            <div class="table-responsive">

                <table class="xc-table" id="example">

                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Customer</th>
                            <th>Plan Name</th>
                            <th>Site Drawing</th>
                            <th>Layout Photo</th>
                            <th>Soil Test</th>
                            <th>Requirement</th>
                            <th>Created</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $i = 1;
                        foreach ($plans as $row) {
                            ?>

                            <tr>

                                <td><?= $i++; ?></td>

                                <td class="xc-cell-strong"><?= $row->customer_name; ?></td>

                                <td><?= $row->plan_name; ?></td>

                                <td>
                                    <?php if (!empty($row->drawing_file)) { ?>
                                        <a href="<?= base_url('uploads/layout_plan/drawing/' . $row->drawing_file); ?>"
                                            target="_blank" class="xc-pill-link pill-teal">
                                            <i class="bx bx-file"></i> View
                                        </a>
                                    <?php } else { ?>
                                        <span class="xc-dash">-</span>
                                    <?php } ?>
                                </td>

                                <td>
                                    <?php if (!empty($row->layout_photo)) { ?>
                                        <img src="<?= base_url('uploads/layout_plan/photo/' . $row->layout_photo); ?>"
                                            class="xc-thumb">
                                    <?php } else { ?>
                                        <span class="xc-dash">-</span>
                                    <?php } ?>
                                </td>

                                <td>
                                    <?php if (!empty($row->soil_test_pdf)) { ?>
                                        <a href="<?= base_url('uploads/layout_plan/soil/' . $row->soil_test_pdf); ?>"
                                            target="_blank" class="xc-pill-link pill-blue">
                                            <i class="bx bxs-file-pdf"></i> PDF
                                        </a>
                                    <?php } else { ?>
                                        <span class="xc-dash">-</span>
                                    <?php } ?>
                                </td>

                                <td><?= $row->requirement; ?></td>

                                <td><?= date('d-m-Y', strtotime($row->created_at)); ?></td>

                                <td>
                                    <div class="xc-action-group">

                                        <a href="<?= base_url('layout_member/layout_plan_view/' . $row->id); ?>"
                                            class="xc-icon-btn xc-icon    -view" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a href="<?= base_url('layout_member/layout_plan_edit/' . $row->id); ?>"
                                            class="xc-icon-btn xc-icon-edit" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>

                                        <a href="<?= base_url('layout_member/delete_layout_plan/' . $row->id); ?>"
                                            onclick="return confirm('Are you sure?')" class="xc-icon-btn xc-icon-delete"
                                            title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>  
