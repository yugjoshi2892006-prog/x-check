<style>
    .xc-card {
        background: #fff;
        border: 1px solid #e9edf1;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(20, 40, 60, .04);
        overflow: hidden;
    }

    .xc-card-header,
    .xc-card-body {
        padding: 22px 24px;
    }

    .xc-card-header {
        border-bottom: 1px solid #e9edf1;
    }

    .xc-title {
        margin: 0;
        color: #1f2937;
        font-size: 18px;
        font-weight: 800;
    }

    .xc-label {
        color: #7c8798;
        display: block;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .04em;
        margin-bottom: 7px;
        text-transform: uppercase;
    }

    .xc-box {
        border: 1px solid #e9edf1;
        border-radius: 10px;
        padding: 11px 13px;
        min-height: 44px;
        color: #2b3441;
        background: #fafbfc;
        white-space: pre-wrap;
    }

    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        padding: 8px 13px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        border: none;
        white-space: nowrap;
    }

    .xc-teal {
        background: #e6f9f8;
        color: #0f9a95;
    }

    .xc-green {
        background: #dcfce7;
        color: #15803d;
    }

    .xc-orange {
        background: #fff4e0;
        color: #c98a1c;
    }

    .xc-red {
        background: #fde8e8;
        color: #c93a3a;
    }

    .xc-blue {
        background: #eaf1ff;
        color: #3766e8;
    }

    .xc-gray {
        background: #eef1f4;
        color: #7c8798;
    }

    .xc-pdf-card {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #e9edf1;
        border-radius: 10px;
        padding: 12px 16px;
        background: #fafbfc;
        text-decoration: none;
        color: #2b3441;
    }

    .xc-pdf-card:hover {
        border-color: #16b8b3;
        color: #2b3441;
    }

    .xc-pdf-card i {
        font-size: 30px;
        color: #c93a3a;
    }

    .xc-pdf-card-text {
        display: flex;
        flex-direction: column;
    }

    .xc-pdf-card-text small {
        color: #7c8798;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-card">
            <div class="xc-card-header">
                <p class="xc-title"><?= html_escape($report->plan_title); ?></p>
                <p class="xc-subtitle" style="margin-top:4px;color:#7c8798;font-size:12px;">Layout Name</p>
                <?php
                if ($this->session->userdata('role') === 'customer') {
                    $viewer_label = 'Client';
                } elseif (!empty($layout_role)) {
                    $viewer_label = $layout_role->role;
                } else {
                    $viewer_label = 'Employee';
                }
                ?>
                <span
                    style="display:inline-flex;align-items:center;gap:4px;background:#eef1f4;color:#475467;font-size:0.72rem;font-weight:600;padding:4px 10px;border-radius:20px;margin-top:8px;">
                    <i class="bx bx-user-circle"></i> Viewing as: <?= html_escape($viewer_label); ?>
                </span>
            </div>

            <div class="xc-card-body">
                <?php if (!empty($report->plan_doc)) { ?>
                    <div class="mb-3">
                        <label class="xc-label">Layout Plan (PDF)</label>
                        <a href="<?= base_url('uploads/layout_process/' . $report->plan_doc); ?>" target="_blank"
                            class="xc-pdf-card">
                            <i class="bx bxs-file-pdf"></i>
                            <span class="xc-pdf-card-text">
                                <strong>View Layout Plan</strong>
                                <small>Opens PDF in a new tab</small>
                            </span>
                        </a>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="xc-label">Client</label>
                        <div class="xc-box"><?= html_escape($report->customer_name); ?></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="xc-label">Architect</label>
                        <div class="xc-box"><?= html_escape($report->architect_name); ?></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="xc-label">Start Date</label>
                        <div class="xc-box">
                            <?= $report->start_date ? date('d-m-Y', strtotime($report->start_date)) : '-'; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="xc-label">End Date</label>
                        <div class="xc-box">
                            <?= $report->end_date ? date('d-m-Y', strtotime($report->end_date)) : '-'; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="xc-label">Status</label>
                        <div class="xc-box"><?= html_escape($report->status); ?>, Revision
                            <?= (int) $report->revision_no; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label
                            class="xc-label"><?= Layout_member_model::isArchitectReviewRequired($report->stage) ? 'Architect / Client / PMC Response' : 'Client / PMC Response'; ?></label>
                        <div class="xc-box" style="display:flex; gap:8px; flex-wrap:wrap;">
                            <?php if (Layout_member_model::isArchitectReviewRequired($report->stage)) { ?>
                                <span
                                    class="xc-pill <?= $report->architect_status === 'Approved' ? 'xc-green' : ($report->architect_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                    Architect: <?= html_escape($report->architect_status); ?>
                                </span>
                            <?php } ?>
                            <span
                                class="xc-pill <?= $report->client_status === 'Approved' ? 'xc-green' : ($report->client_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                Client: <?= html_escape($report->client_status); ?>
                            </span>
                            <span
                                class="xc-pill <?= $report->pmc_status === 'Approved' ? 'xc-green' : ($report->pmc_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                PMC: <?= html_escape($report->pmc_status); ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="xc-label">Schedule</label>
                        <?php $schedule = $this->Layout_member_model->getScheduleStatus($report); ?>
                        <div class="xc-box"><span
                                class="xc-pill <?= $schedule->class; ?>"><?= html_escape($schedule->label); ?></span>
                        </div>
                    </div>
                    <?php if (!empty($report->architect_remark) || !empty($report->client_remark) || !empty($report->pmc_remark)) { ?>
                        <div class="col-md-12 mb-3">
                            <label class="xc-label">Architect / Client / PMC Remark</label>
                            <div class="xc-box">
                                <?= html_escape(trim($report->architect_remark . "\n" . $report->client_remark . "\n" . $report->pmc_remark)); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <?php
                $is_client_viewer = $this->session->userdata('role') === 'customer';
                $is_pmc_viewer = !empty($layout_role) && $layout_role->role === 'PMC';
                $is_architect_reviewer = !empty($layout_role) && $layout_role->role === 'Architect' && Layout_member_model::isArchitectReviewRequired($report->stage);
                $my_turn = ($is_client_viewer && $report->client_status === 'Pending') || ($is_pmc_viewer && $report->pmc_status === 'Pending') || ($is_architect_reviewer && $report->architect_status === 'Pending');
                ?>
                <?php if ($my_turn) { ?>
                    <hr>
                    <a href="<?= base_url('index.php/employee/approve_layout_process/' . $report->id); ?>"
                        onclick="return confirm('Approve this layout report?');" class="xc-pill xc-green">
                        <i class="bx bx-check"></i> Approve
                    </a>

                    <form id="remark" action="<?= base_url('index.php/employee/remark_layout_process/' . $report->id); ?>"
                        method="post" class="mt-3">
                        <label class="xc-label">Remark</label>
                        <textarea name="review_remark" class="form-control" rows="4" required></textarea>
                        <button class="xc-pill xc-orange mt-2" type="submit">
                            <i class="bx bx-message-square-detail"></i> Send Remark
                        </button>
                    </form>
                <?php } elseif ($is_client_viewer || $is_pmc_viewer || $is_architect_reviewer) { ?>
                    <hr>
                    <p class="xc-muted-sm" style="color:#7c8798;">
                        You've already responded to this submission. Waiting on the other reviewer(s).
                    </p>
                <?php } ?>

                <?php if (!empty($layout_role) && $layout_role->role === $report->stage && $report->status === 'Remarked') { ?>
                    <hr>
                    <a href="<?= base_url('index.php/employee/layout_process_add/' . $report->id); ?>"
                        class="xc-pill xc-orange">
                        <i class="bx bx-plus"></i> New Form
                    </a>
                <?php } ?>

                <div class="mt-3">
                    <a href="<?= base_url('index.php/employee/layout_process'); ?>" class="xc-pill xc-teal">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>