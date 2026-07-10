<div class="page-wrapper">
    <div class="page-content">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php } ?>

        <?php if (!empty($layout_plans)) { ?>
            <div class="card xc-card radius-10 xc-plans-card">
                <div class="card-header xc-card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bx bx-map-alt"></i>
                        Layout Plans
                    </h4>
                    <a href="<?= base_url('index.php/employee/layout_plans'); ?>" class="btn xc-btn-add">
                        <i class="bx bx-map-alt"></i> View All Plans
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover xc-table">
                            <thead class="xc-thead">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Plan Name</th>
                                    <th>Site Drawing</th>
                                    <th>Layout Photo</th>
                                    <th>Soil Test</th>
                                    <th>Requirement</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $p = 1;
                                foreach ($layout_plans as $plan) { ?>
                                    <tr>
                                        <td><?= $p++; ?></td>
                                        <td><?= html_escape($plan->customer_name); ?></td>
                                        <td class="xc-strong"><?= html_escape($plan->plan_name); ?></td>
                                        <td>
                                            <?php if (!empty($plan->drawing_file)) { ?>
                                                <a href="<?= base_url('uploads/layout_plan/drawing/' . $plan->drawing_file); ?>"
                                                    target="_blank" class="xc-plan-link">
                                                    <i class="bx bx-file"></i> View
                                                </a>
                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($plan->layout_photo)) { ?>
                                                <a href="<?= base_url('uploads/layout_plan/photo/' . $plan->layout_photo); ?>"
                                                    target="_blank" class="xc-plan-link">
                                                    <i class="bx bx-image"></i> View
                                                </a>
                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($plan->soil_test_pdf)) { ?>
                                                <a href="<?= base_url('uploads/layout_plan/soil/' . $plan->soil_test_pdf); ?>"
                                                    target="_blank" class="xc-plan-link">
                                                    <i class="bx bxs-file-pdf"></i> PDF
                                                </a>
                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>
                                        </td>
                                        <td><?= !empty($plan->requirement) ? html_escape($plan->requirement) : '&mdash;'; ?>
                                        </td>
                                        <td><?= date('d-m-Y', strtotime($plan->created_at)); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="card xc-card radius-10">
            <div class="card-header xc-card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="bx bx-git-branch"></i>
                    Layout Process
                    <?php
                    if ($this->session->userdata('role') === 'customer') {
                        $viewer_label = 'Client';
                    } elseif (!empty($layout_role)) {
                        $viewer_label = $layout_role->role;
                    } else {
                        $viewer_label = 'Employee';
                    }
                    ?>
                    <span class="xc-role-badge">
                        <i class="bx bx-user-circle"></i> Viewing as: <?= html_escape($viewer_label); ?>
                    </span>
                </h4>

                <?php if (!empty($layout_role) && in_array($layout_role->role, Layout_member_model::$STAGE_ORDER)) { ?>
                    <a href="<?= base_url('index.php/employee/layout_process_add'); ?>" class="btn xc-btn-add">
                        <i class="bx bx-upload"></i> Upload Plan
                    </a>
                <?php } ?>
                <a href="<?= base_url('index.php/employee/layout_process_flow'); ?>" class="btn xc-btn-add"
                    style="background:#7c3aed;">
                    <i class="bx bx-git-branch"></i> Flow View
                </a>
            </div>

            <div class="card-body">
                <?php if (!empty($layout_plans)) { ?>
                    <form method="get" class="xc-filter-row">
                        <label class="xc-label" style="margin:0;">Filter by Plan Name</label>
                        <select name="plan" class="form-control xc-input xc-filter-select" onchange="this.form.submit()">
                            <option value="">All Plans</option>
                            <?php
                            $seen_plans = [];
                            foreach ($layout_plans as $plan) {
                                if (in_array($plan->plan_name, $seen_plans)) {
                                    continue;
                                }
                                $seen_plans[] = $plan->plan_name;
                                ?>
                                <option value="<?= html_escape($plan->plan_name); ?>" <?= (isset($plan_filter) && $plan_filter === $plan->plan_name) ? 'selected' : ''; ?>>
                                    <?= html_escape($plan->plan_name); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php if (!empty($plan_filter)) { ?>
                            <a href="<?= base_url('index.php/employee/layout_process'); ?>" class="xc-filter-clear">
                                <i class="bx bx-x"></i> Clear
                            </a>
                        <?php } ?>
                    </form>
                <?php } ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover xc-table">
                        <thead class="xc-thead">
                            <tr>
                                <th>#</th>
                                <th>PDF</th>
                                <th>Layout Name</th>
                                <th>Stage / Role</th>
                                <th>Customer</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th width="220">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reports)) { ?>
                                <?php $i = 1;
                                foreach ($reports as $row) { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td>
                                            <?php if (!empty($row->plan_doc)) { ?>
                                                <a href="<?= base_url('uploads/layout_process/' . $row->plan_doc); ?>"
                                                    target="_blank" class="xc-pdf-link" title="View PDF">
                                                    <i class="bx bxs-file-pdf"></i>
                                                </a>
                                            <?php } else { ?>
                                                &mdash;
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span class="xc-strong"><?= html_escape($row->plan_title); ?></span><br>
                                            <small class="xc-muted-sm">Revision <?= (int) $row->revision_no; ?></small>
                                        </td>
                                        <td>
                                            <span class="badge xc-stage-badge"><?= html_escape($row->stage); ?></span><br>
                                            <small class="xc-muted-sm">by <?= html_escape($row->architect_name); ?></small>
                                        </td>
                                        <td><?= html_escape($row->customer_name); ?></td>
                                        <td><?= $row->start_date ? date('d-m-Y', strtotime($row->start_date)) : '-'; ?></td>
                                        <td><?= $row->end_date ? date('d-m-Y', strtotime($row->end_date)) : '-'; ?></td>
                                        <td>
                                            <?php $schedule = $this->Layout_member_model->getScheduleStatus($row); ?>
                                            <span
                                                class="badge <?= $schedule->class; ?>"><?= html_escape($schedule->label); ?></span>
                                        </td>
                                        <td>
                                            <?php $status_key = $row->status === 'Approved' ? 'xc-green' : ($row->status === 'Remarked' ? 'xc-orange' : 'xc-blue'); ?>
                                            <span class="badge <?= $status_key; ?>"><?= html_escape($row->status); ?></span>
                                            <br>
                                            <div class="xc-mini-pills">
                                                <span
                                                    class="xc-mini-pill <?= $row->client_status === 'Approved' ? 'xc-green' : ($row->client_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                                    Client: <?= html_escape($row->client_status); ?>
                                                </span>
                                                <span
                                                    class="xc-mini-pill <?= $row->pmc_status === 'Approved' ? 'xc-green' : ($row->pmc_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                                    PMC: <?= html_escape($row->pmc_status); ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="xc-actions">
                                                <a href="<?= base_url('index.php/employee/layout_process_view/' . $row->id); ?>"
                                                    class="btn xc-btn-view btn-sm">
                                                    <i class="bx bx-show"></i> See Report
                                                </a>

                                                <?php
                                                $is_client_viewer = $this->session->userdata('role') === 'customer';
                                                $is_pmc_viewer = !empty($layout_role) && $layout_role->role === 'PMC';
                                                $my_turn = ($is_client_viewer && $row->client_status === 'Pending') || ($is_pmc_viewer && $row->pmc_status === 'Pending');
                                                ?>
                                                <?php if ($is_client_viewer || $is_pmc_viewer) { ?>
                                                    <?php if ($my_turn) { ?>
                                                        <a href="<?= base_url('index.php/employee/approve_layout_process/' . $row->id); ?>"
                                                            onclick="return confirm('Approve this layout report?');"
                                                            class="btn xc-btn-approve btn-sm">
                                                            <i class="bx bx-check"></i> Approve
                                                        </a>
                                                        <a href="<?= base_url('index.php/employee/layout_process_view/' . $row->id . '#remark'); ?>"
                                                            class="btn xc-btn-remark btn-sm">
                                                            <i class="bx bx-message-square-detail"></i> Remark
                                                        </a>
                                                    <?php } else { ?>
                                                        <span class="xc-muted-sm">You already responded</span>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if (!empty($layout_role) && $layout_role->role === 'Architect' && $row->status === 'Remarked') { ?>
                                                    <a href="<?= base_url('index.php/employee/layout_process_add/' . $row->id); ?>"
                                                        class="btn xc-btn-remark btn-sm">
                                                        <i class="bx bx-plus"></i> New Form
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="10" class="xc-empty">
                                        <?= !empty($plan_filter) ? 'No reports found for "' . html_escape($plan_filter) . '".' : 'No layout plan reports found.'; ?>
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

<style>
    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0a8a7a;
        --xc-navy: #1a1a2e;
    }

    .xc-card {
        background: #fff;
        border: 1px solid #e9edf1;
        box-shadow: 0 1px 3px rgba(26, 26, 46, 0.05);
        overflow: hidden;
    }

    .xc-card-header {
        background: transparent;
        color: var(--xc-navy);
        border-bottom: 1px solid #e9edf1;
        padding: 1.1rem 1.4rem;
        flex-wrap: wrap;
        gap: 10px;
    }

    .xc-card-header h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--xc-navy);
    }

    .xc-card-header h4 i {
        color: var(--xc-teal);
    }

    .xc-btn-add {
        background: var(--xc-teal);
        color: #fff;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.55rem 1.25rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .xc-btn-add:hover {
        background: var(--xc-teal-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .xc-table thead.xc-thead,
    .xc-table thead.xc-thead tr,
    .xc-table thead.xc-thead th {
        background: linear-gradient(90deg, #0d9488 0%, var(--xc-teal) 100%) !important;
        --bs-table-bg: transparent !important;
        --bs-table-color: #ffffff !important;
    }

    .xc-table thead.xc-thead th {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-color: rgba(255, 255, 255, 0.15) !important;
        vertical-align: middle;
        padding: 0.9rem 0.85rem;
        white-space: nowrap;
    }

    .xc-table tbody tr:nth-child(even) {
        background: #f7fafa;
    }

    .xc-table tbody tr:hover {
        background: rgba(15, 180, 160, 0.08);
    }

    .xc-table td {
        vertical-align: middle;
        font-size: 0.88rem;
        color: var(--xc-navy);
        padding: 0.8rem 0.85rem;
    }

    .xc-strong {
        font-weight: 700;
        color: var(--xc-navy);
    }

    .xc-muted-sm {
        color: #94a0ad;
    }

    .xc-pdf-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #fde8e8;
        color: #c93a3a;
        font-size: 18px;
    }

    .badge {
        font-weight: 600;
        font-size: 0.78rem;
        padding: 0.35em 0.9em;
        border-radius: 20px;
    }

    .xc-green {
        background: #dcfce7;
        color: #15803d;
    }

    .xc-blue {
        background: #eaf1ff;
        color: #3766e8;
    }

    .xc-orange {
        background: #fff4e0;
        color: #c98a1c;
    }

    .xc-red {
        background: #fde8e8;
        color: #c93a3a;
    }

    .xc-gray {
        background: #eef1f4;
        color: #7c8798;
    }

    .xc-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .xc-btn-view,
    .xc-btn-approve,
    .xc-btn-remark {
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 6px;
        padding: 0.35rem 0.8rem;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s ease;
    }

    .xc-btn-view {
        background: #0fb4a0;
    }

    .xc-btn-view:hover {
        background: #0a8a7a;
        color: #fff;
    }

    .xc-btn-approve {
        background: #22c55e;
    }

    .xc-btn-approve:hover {
        background: #16a34a;
        color: #fff;
    }

    .xc-btn-remark {
        background: #f59e0b;
    }

    .xc-btn-remark:hover {
        background: #d97706;
        color: #fff;
    }

    .xc-empty {
        text-align: center;
        padding: 40px 12px;
        color: #94a0ad;
    }

    .xc-stage-badge {
        background: #ede9fe;
        color: #6d28d9;
        font-weight: 600;
        font-size: 0.78rem;
        padding: 0.35em 0.9em;
        border-radius: 20px;
        white-space: nowrap;
    }

    .xc-filter-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .xc-filter-select {
        max-width: 260px;
        display: inline-block;
    }

    .xc-filter-clear {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        color: #c93a3a;
        font-weight: 600;
        font-size: 0.82rem;
        text-decoration: none;
    }

    .xc-filter-clear:hover {
        text-decoration: underline;
    }

    .xc-plans-card {
        margin-bottom: 20px;
    }

    .xc-plan-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: #0fb4a0;
        font-weight: 600;
        font-size: 0.82rem;
        text-decoration: none;
    }

    .xc-plan-link:hover {
        color: #0a8a7a;
        text-decoration: underline;
    }

    .xc-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #eef1f4;
        color: #475467;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: none;
        letter-spacing: 0;
        padding: 4px 10px;
        border-radius: 20px;
        margin-left: 10px;
        vertical-align: middle;
    }

    .xc-mini-pills {
        display: flex;
        gap: 4px;
        margin-top: 6px;
        flex-wrap: wrap;
    }

    .xc-mini-pill {
        font-size: 0.68rem;
        font-weight: 600;
        padding: 0.2em 0.55em;
        border-radius: 12px;
        white-space: nowrap;
    }
</style>