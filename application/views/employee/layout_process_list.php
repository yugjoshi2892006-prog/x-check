<div class="page-wrapper">
    <div class="page-content">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success xc-alert xc-alert-success">
                <i class="bx bx-check-circle"></i>
                <span><?= $this->session->flashdata('success'); ?></span>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger xc-alert xc-alert-danger">
                <i class="bx bx-error-circle"></i>
                <span><?= $this->session->flashdata('error'); ?></span>
            </div>
        <?php } ?>

        <div class="xc-page-header">
            <div class="xc-page-header-left">
                <div class="xc-page-icon">
                    <i class="bx bx-git-branch"></i>
                </div>
                <div>
                    <h1 class="xc-page-title">Layout Process Management</h1>
                    <p class="xc-page-subtitle">Track and manage layout approvals across all stages</p>
                </div>
            </div>

            <div class="xc-page-header-right">
                <?php
                if ($this->session->userdata('role') === 'customer') {
                    $viewer_label = 'Client';
                    $viewer_icon = 'bx-user';
                } elseif (!empty($layout_role)) {
                    $viewer_label = $layout_role->role;
                    $viewer_icon = 'bx-user-circle';
                } else {
                    $viewer_label = 'Employee';
                    $viewer_icon = 'bx-briefcase';
                }
                ?>
                <div class="xc-role-indicator">
                    <i class="bx <?= $viewer_icon; ?>"></i>
                    <div>
                        <span class="xc-role-label">Viewing as</span>
                        <span class="xc-role-name"><?= html_escape($viewer_label); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="xc-action-bar">
            <div class="xc-action-bar-left">
                <?php if (!empty($plan_options)) { ?>
                    <form method="get" class="xc-filter-form">
                        <div class="xc-filter-group">
                            <i class="bx bx-filter-alt xc-filter-icon"></i>
                            <select id="xc-plan-filter" name="plan" class="xc-select" onchange="this.form.submit()">
                                <option value="">All Plans</option>
                                <?php foreach ($plan_options as $opt) { ?>
                                    <option value="<?= html_escape($opt); ?>" <?= ($plan_filter === $opt) ? 'selected' : ''; ?>>
                                        <?= html_escape($opt); ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (!empty($plan_filter)) { ?>
                                <a href="<?= base_url('employee/layout_process'); ?>" class="xc-clear-filter"
                                    title="Clear filter">
                                    <i class="bx bx-x"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </form>
                <?php } ?>
            </div>

            <div class="xc-action-bar-right">
                <a href="<?= base_url('employee/layout_process_flow'); ?>" class="xc-btn xc-btn-secondary">
                    <i class="bx bx-git-branch"></i>
                    <span>Flow View</span>
                </a>
                <?php if (!empty($layout_role) && in_array($layout_role->role, Layout_member_model::$STAGE_ORDER)) { ?>
                    <a href="<?= base_url('employee/layout_process_add'); ?>" class="xc-btn xc-btn-primary">
                        <i class="bx bx-upload"></i>
                        <span>Upload Plan</span>
                    </a>
                <?php } ?>
            </div>
        </div>

        <div class="xc-card">
            <div class="xc-card-body">
                <div class="xc-table-container">
                    <table class="xc-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 60px;">PDF</th>
                                <th style="min-width: 200px;">Layout Information</th>
<<<<<<< HEAD
                                <th style="min-width: 160px;">Stage & Owner</th>
                                <th style="min-width: 140px;">Customer</th>
                                <th style="width: 120px;">Timeline</th>
=======
                                <th style="min-width: 160px;">Customer</th>
                                <th style="width: 120px;">Start Date</th>
                                <th style="width: 120px;">End Date</th>
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                                <th style="width: 100px;">Schedule</th>
                                <th style="min-width: 180px;">Approval Status</th>
                                <th style="min-width: 280px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($reports)) { ?>
                                <?php
                                $i = 1;
                                $prev_stage_key = null;
                                foreach ($reports as $row) {
                                    $stage_key = $row->customer_id . '|' . $row->stage;
                                    if ($prev_stage_key !== null && $stage_key !== $prev_stage_key) { ?>
                                        <tr class="xc-divider-row">
                                            <td colspan="9">
                                                <div class="xc-divider"></div>
                                            </td>
                                        </tr>
                                    <?php }
                                    $prev_stage_key = $stage_key;
                                    ?>
                                    <tr class="xc-table-row">
                                        <td>
                                            <span class="xc-row-number"><?= $i++; ?></span>
                                        </td>

                                        <td>
                                            <?php if (!empty($row->plan_doc)) { ?>
                                                <a href="<?= base_url('uploads/layout_process/' . $row->plan_doc); ?>"
                                                    target="_blank" class="xc-pdf-badge" title="View PDF">
                                                    <i class="bx bxs-file-pdf"></i>
                                                </a>
                                            <?php } else { ?>
                                                <span class="xc-no-data">—</span>
                                            <?php } ?>
                                        </td>

                                        <td>
                                            <div class="xc-layout-info">
                                                <div class="xc-layout-title"><?= html_escape($row->plan_title); ?></div>
                                                <div class="xc-layout-meta">
                                                    <span class="xc-revision">
                                                        <i class="bx bx-revision"></i>
                                                        Rev. <?= (int) $row->revision_no; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
<<<<<<< HEAD
                                            <div class="xc-stage-info">
                                                <span
                                                    class="xc-stage-badge xc-stage-<?= strtolower(str_replace(' ', '-', $row->stage)); ?>">
                                                    <?= html_escape($row->stage); ?>
                                                </span>
                                                <div class="xc-owner-name">
                                                    <i class="bx bx-user"></i>
                                                    <?= html_escape($row->architect_name); ?>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
=======
>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                                            <div class="xc-customer-name"><?= html_escape($row->customer_name); ?></div>
                                        </td>

                                        <td>
<<<<<<< HEAD
                                            <div class="xc-timeline">
                                                <?php if ($row->start_date) { ?>
                                                    <div class="xc-timeline-item">
                                                        <i class="bx bx-play-circle"></i>
                                                        <span><?= date('d/m/Y', strtotime($row->start_date)); ?></span>
                                                    </div>
                                                <?php } ?>
                                                <?php if ($row->end_date) { ?>
                                                    <div class="xc-timeline-item">
                                                        <i class="bx bx-stop-circle"></i>
                                                        <span><?= date('d/m/Y', strtotime($row->end_date)); ?></span>
                                                    </div>
                                                <?php } ?>
                                                <?php if (!$row->start_date && !$row->end_date) { ?>
                                                    <span class="xc-no-data">—</span>
                                                <?php } ?>
                                            </div>
                                        </td>

                                        <td>
                                            <?php $schedule = $this->Layout_member_model->getScheduleStatus($row); ?>
                                            <span
                                                class="xc-schedule-badge xc-schedule-<?= strtolower(str_replace(' ', '-', $schedule->label)); ?>">
                                                <?= html_escape($schedule->label); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="xc-status-group">
                                                <?php
                                                $status_class = $row->status === 'Approved' ? 'approved' : ($row->status === 'Remarked' ? 'remarked' : 'pending');
                                                ?>
                                                <span class="xc-status-badge xc-status-<?= $status_class; ?>">
                                                    <?= html_escape($row->status); ?>
                                                </span>

                                                <div class="xc-approvals">
                                                    <div class="xc-approval-item xc-approval-<?= strtolower($row->client_status); ?>"
                                                        title="Client: <?= html_escape($row->client_status); ?>">
                                                        <i
                                                            class="bx <?= $row->client_status === 'Approved' ? 'bx-check-circle' : ($row->client_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                                        <span>Client</span>
                                                    </div>

                                                    <div class="xc-approval-item xc-approval-<?= strtolower($row->pmc_status); ?>"
                                                        title="PMC: <?= html_escape($row->pmc_status); ?>">
                                                        <i
                                                            class="bx <?= $row->pmc_status === 'Approved' ? 'bx-check-circle' : ($row->pmc_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                                        <span>PMC</span>
                                                    </div>

                                                    <?php if (Layout_member_model::isArchitectReviewRequired($row->stage)) { ?>
                                                        <div class="xc-approval-item xc-approval-<?= strtolower($row->architect_status); ?>"
                                                            title="Architect: <?= html_escape($row->architect_status); ?>">
                                                            <i
                                                                class="bx <?= $row->architect_status === 'Approved' ? 'bx-check-circle' : ($row->architect_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                                            <span>Architect</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>

=======
                                            <?= $row->start_date ? date('d/m/Y', strtotime($row->start_date)) : '<span class="xc-no-data">—</span>'; ?>
                                        </td>

                                        <td>
                                            <?= $row->end_date ? date('d/m/Y', strtotime($row->end_date)) : '<span class="xc-no-data">—</span>'; ?>
                                        </td>

                                        <td>
                                            <?php $schedule = $this->Layout_member_model->getScheduleStatus($row); ?>
                                            <span
                                                class="xc-schedule-badge xc-schedule-<?= strtolower(str_replace(' ', '-', $schedule->label)); ?>">
                                                <?= html_escape($schedule->label); ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div class="xc-status-group">
                                                <?php
                                                $status_class = $row->status === 'Approved' ? 'approved' : ($row->status === 'Remarked' ? 'remarked' : 'pending');
                                                ?>
                                                <span class="xc-status-badge xc-status-<?= $status_class; ?>">
                                                    <?= html_escape($row->status); ?>
                                                </span>

                                                <div class="xc-approvals">
                                                    <div class="xc-approval-item xc-approval-<?= strtolower($row->client_status); ?>"
                                                        title="Client: <?= html_escape($row->client_status); ?>">
                                                        <i
                                                            class="bx <?= $row->client_status === 'Approved' ? 'bx-check-circle' : ($row->client_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                                        <span>Client</span>
                                                    </div>

                                                    <div class="xc-approval-item xc-approval-<?= strtolower($row->pmc_status); ?>"
                                                        title="PMC: <?= html_escape($row->pmc_status); ?>">
                                                        <i
                                                            class="bx <?= $row->pmc_status === 'Approved' ? 'bx-check-circle' : ($row->pmc_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                                        <span>PMC</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

>>>>>>> 2f8dfd3b0f046064104d1c8f4568951f42a76596
                                        <td>
                                            <div class="xc-actions">
                                                <a href="<?= base_url('employee/layout_process_view/' . $row->id); ?>"
                                                    class="xc-action-btn xc-action-view">
                                                    <i class="bx bx-show"></i>
                                                    <span>View Report</span>
                                                </a>

                                                <?php
                                                $is_client_viewer = $this->session->userdata('role') === 'customer';
                                                $is_pmc_viewer = !empty($layout_role) && $layout_role->role === 'PMC';
                                                $is_architect_reviewer = !empty($layout_role) && $layout_role->role === 'Architect' && Layout_member_model::isArchitectReviewRequired($row->stage);
                                                $my_turn = ($is_client_viewer && $row->client_status === 'Pending') || ($is_pmc_viewer && $row->pmc_status === 'Pending') || ($is_architect_reviewer && $row->architect_status === 'Pending');
                                                ?>

                                                <?php if ($is_client_viewer || $is_pmc_viewer || $is_architect_reviewer) { ?>
                                                    <?php if ($my_turn) { ?>
                                                        <a href="<?= base_url('employee/approve_layout_process/' . $row->id); ?>"
                                                            onclick="return confirm('Are you sure you want to approve this layout report?');"
                                                            class="xc-action-btn xc-action-approve">
                                                            <i class="bx bx-check-circle"></i>
                                                            <span>Approve</span>
                                                        </a>
                                                        <a href="<?= base_url('employee/layout_process_view/' . $row->id . '#remark'); ?>"
                                                            class="xc-action-btn xc-action-remark">
                                                            <i class="bx bx-message-square-detail"></i>
                                                            <span>Remark</span>
                                                        </a>
                                                    <?php } else { ?>
                                                        <span class="xc-action-disabled">
                                                            <i class="bx bx-check"></i>
                                                            You responded
                                                        </span>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if (!empty($layout_role) && $layout_role->role === $row->stage && $row->status === 'Remarked') { ?>
                                                    <a href="<?= base_url('employee/layout_process_add/' . $row->id); ?>"
                                                        class="xc-action-btn xc-action-resubmit">
                                                        <i class="bx bx-revision"></i>
                                                        <span>Resubmit</span>
                                                    </a>
                                                <?php } ?>

                                                <?php
                                                $next_stage_index = array_search($row->stage, Layout_member_model::$STAGE_ORDER);
                                                $next_stage = ($next_stage_index !== false && isset(Layout_member_model::$STAGE_ORDER[$next_stage_index + 1]))
                                                    ? Layout_member_model::$STAGE_ORDER[$next_stage_index + 1]
                                                    : null;

                                                $final_project = null;
                                                $show_submit_to_next_stage = true;
                                                if ($row->stage === 'Architect' && $row->status === 'Approved') {
                                                    $final_project = $this->Layout_member_model->getFinalProjectForCustomer($row->company_id, $row->customer_id);
                                                    $latest_architect = $this->Layout_member_model->getLatestStageReport($row->company_id, $row->customer_id, 'Architect');
                                                    $show_final_project_button = $latest_architect && $latest_architect->id === $row->id;
                                                    $show_submit_to_next_stage = !empty($final_project);
                                                    ?>
                                                    <?php if (!$final_project) { ?>
                                                        <?php if ($show_final_project_button && !empty($layout_role) && $layout_role->role === 'Architect') { ?>
                                                            <a href="<?= base_url('employee/layout_final_project_add/' . (int) $row->id); ?>"
                                                                class="xc-action-btn xc-action-final">
                                                                <i class="bx bx-folder-plus"></i>
                                                                <span>Add Final Project</span>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <span class="xc-action-completed">
                                                            <i class="bx bx-check-double"></i>
                                                            Sent to Structural
                                                        </span>
                                                    <?php } ?>
                                                <?php } elseif ($row->status === 'Approved' && $next_stage && !empty($layout_role) && $layout_role->role === $next_stage && $show_submit_to_next_stage) { ?>
                                                    <a href="<?= base_url('employee/layout_process_add'); ?>"
                                                        class="xc-action-btn xc-action-next">
                                                        <i class="bx bx-right-arrow-alt"></i>
                                                        <span>Submit to <?= html_escape($next_stage); ?></span>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="9">
                                        <div class="xc-empty-state">
                                            <div class="xc-empty-icon">
                                                <i class="bx bx-folder-open"></i>
                                            </div>
                                            <h3>No Layout Reports Found</h3>
                                            <p>There are no layout plan reports to display at this moment.</p>
                                            <?php if (!empty($layout_role) && in_array($layout_role->role, Layout_member_model::$STAGE_ORDER)) { ?>
                                                <a href="<?= base_url('employee/layout_process_add'); ?>"
                                                    class="xc-btn xc-btn-primary">
                                                    <i class="bx bx-plus"></i>
                                                    <span>Upload First Plan</span>
                                                </a>
                                            <?php } ?>
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
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap');

    /* ============================================
       X-CHECK DESIGN SYSTEM — VARIABLES
    ============================================ */
    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0c9484;
        --xc-teal-light: #e5faf6;
        --xc-navy: #1a1a2e;
        --xc-navy-soft: #2b2b45;
        --xc-orange: #f97316;
        --xc-orange-light: #fff2e8;
        --xc-purple: #7c3aed;
        --xc-purple-light: #f4edfe;

        --xc-success: #0fb4a0;
        --xc-success-light: #e5faf6;
        --xc-warning: #f97316;
        --xc-warning-light: #fff2e8;
        --xc-danger: #ef4444;
        --xc-danger-light: #fee2e2;

        --xc-gray-50: #f8f9fb;
        --xc-gray-100: #f1f2f6;
        --xc-gray-200: #e4e6ee;
        --xc-gray-300: #d3d6e0;
        --xc-gray-400: #a4a8ba;
        --xc-gray-500: #7c8093;
        --xc-gray-600: #5a5e70;
        --xc-gray-700: #3f4256;
        --xc-gray-800: #292c3f;
        --xc-gray-900: var(--xc-navy);

        --xc-font-heading: 'Sora', sans-serif;
        --xc-font-body: 'DM Sans', sans-serif;
        --xc-font-mono: 'JetBrains Mono', monospace;

        --xc-glass-bg: rgba(255, 255, 255, 0.72);
        --xc-glass-border: rgba(255, 255, 255, 0.5);

        --xc-shadow-sm: 0 1px 2px rgba(26, 26, 46, 0.06);
        --xc-shadow: 0 4px 14px rgba(26, 26, 46, 0.07);
        --xc-shadow-md: 0 8px 24px rgba(26, 26, 46, 0.09);
        --xc-shadow-lg: 0 16px 40px rgba(26, 26, 46, 0.12);

        --xc-radius: 12px;
        --xc-radius-sm: 8px;
        --xc-radius-lg: 20px;

        --xc-transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        box-sizing: border-box;
    }

    .page-content {
        font-family: var(--xc-font-body);
    }

    /* ============================================
       ALERTS
    ============================================ */
    .xc-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: var(--xc-radius);
        margin-bottom: 20px;
        border: 1px solid transparent;
        font-size: 0.9375rem;
        font-weight: 500;
        font-family: var(--xc-font-body);
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-alert i {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .xc-alert-success {
        background: var(--xc-success-light);
        border-color: rgba(15, 180, 160, 0.25);
        color: #096e62;
    }

    .xc-alert-danger {
        background: var(--xc-danger-light);
        border-color: rgba(239, 68, 68, 0.25);
        color: #991b1b;
    }

    /* ============================================
       PAGE HEADER
    ============================================ */
    .xc-page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .xc-page-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .xc-page-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--xc-radius);
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        box-shadow: 0 8px 20px rgba(15, 180, 160, 0.3);
    }

    .xc-page-title {
        font-family: var(--xc-font-heading);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--xc-navy);
        margin: 0;
        line-height: 1.2;
    }

    .xc-page-subtitle {
        font-size: 0.9375rem;
        color: var(--xc-gray-600);
        margin: 4px 0 0 0;
    }

    .xc-page-header-right {
        display: flex;
        gap: 12px;
    }

    .xc-role-indicator {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--xc-glass-bg);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid var(--xc-glass-border);
        border-radius: var(--xc-radius);
        padding: 10px 16px;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-role-indicator i {
        font-size: 2rem;
        color: var(--xc-teal);
    }

    .xc-role-indicator>div {
        display: flex;
        flex-direction: column;
    }

    .xc-role-label {
        font-size: 0.6875rem;
        color: var(--xc-gray-500);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 600;
    }

    .xc-role-name {
        font-family: var(--xc-font-heading);
        font-size: 0.9375rem;
        color: var(--xc-navy);
        font-weight: 700;
    }

    /* ============================================
       ACTION BAR
    ============================================ */
    .xc-action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .xc-action-bar-left,
    .xc-action-bar-right {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    /* Filter Form */
    .xc-filter-form {
        margin: 0;
    }

    .xc-filter-group {
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
        background: white;
        border: 1px solid var(--xc-gray-200);
        border-radius: var(--xc-radius);
        padding: 0 12px;
        box-shadow: var(--xc-shadow-sm);
        transition: var(--xc-transition);
    }

    .xc-filter-group:focus-within {
        border-color: var(--xc-teal);
        box-shadow: 0 0 0 3px var(--xc-teal-light);
    }

    .xc-filter-icon {
        color: var(--xc-gray-400);
        font-size: 1.25rem;
    }

    .xc-select {
        border: none;
        background: transparent;
        padding: 10px 8px;
        font-family: var(--xc-font-body);
        font-size: 0.9375rem;
        color: var(--xc-navy);
        font-weight: 500;
        min-width: 200px;
        outline: none;
        cursor: pointer;
    }

    .xc-select:focus {
        outline: none;
    }

    .xc-clear-filter {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--xc-gray-200);
        color: var(--xc-gray-600);
        transition: var(--xc-transition);
    }

    .xc-clear-filter:hover {
        background: var(--xc-danger);
        color: white;
    }

    /* Buttons */
    .xc-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: var(--xc-radius);
        font-family: var(--xc-font-body);
        font-size: 0.9375rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: var(--xc-transition);
        white-space: nowrap;
        box-shadow: var(--xc-shadow-sm);
    }

    .xc-btn i {
        font-size: 1.25rem;
    }

    .xc-btn-primary {
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
        color: white;
    }

    .xc-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(15, 180, 160, 0.32);
        color: white;
    }

    .xc-btn-secondary {
        background: white;
        color: var(--xc-navy);
        border: 1px solid var(--xc-gray-300);
    }

    .xc-btn-secondary:hover {
        background: var(--xc-gray-50);
        border-color: var(--xc-teal);
        transform: translateY(-1px);
        box-shadow: var(--xc-shadow-md);
        color: var(--xc-navy);
    }

    /* ============================================
       CARD (glassmorphic)
    ============================================ */
    .xc-card {
        background: var(--xc-glass-bg);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border-radius: var(--xc-radius-lg);
        box-shadow: var(--xc-shadow-md);
        overflow: hidden;
        border: 1px solid var(--xc-glass-border);
    }

    .xc-card-body {
        padding: 0;
    }

    /* ============================================
       TABLE
    ============================================ */
    .xc-table-container {
        overflow-x: auto;
    }

    .xc-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.875rem;
    }

    .xc-table thead {
        background: linear-gradient(135deg, var(--xc-teal) 0%, var(--xc-teal-dark) 100%);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .xc-table th {
        padding: 16px 14px;
        text-align: left;
        font-family: var(--xc-font-heading);
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: rgba(255, 255, 255, 0.92);
        border-bottom: 2px solid var(--xc-teal);
    }

    .xc-table tbody tr {
        transition: var(--xc-transition);
    }

    .xc-table tbody tr:hover {
        background: var(--xc-teal-light);
    }

    .xc-table td {
        padding: 16px 14px;
        border-bottom: 1px solid var(--xc-gray-200);
        vertical-align: middle;
    }

    .xc-row-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--xc-gray-100);
        color: var(--xc-navy);
        font-family: var(--xc-font-mono);
        font-weight: 600;
        font-size: 0.75rem;
    }

    .xc-no-data {
        color: var(--xc-gray-400);
        font-size: 1.125rem;
    }

    /* PDF Badge */
    .xc-pdf-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: var(--xc-radius-sm);
        background: var(--xc-danger-light);
        color: #dc2626;
        font-size: 1.5rem;
        transition: var(--xc-transition);
    }

    .xc-pdf-badge:hover {
        background: #dc2626;
        color: white;
        transform: scale(1.1);
    }

    /* Layout Info */
    .xc-layout-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .xc-layout-title {
        font-family: var(--xc-font-heading);
        font-weight: 600;
        color: var(--xc-navy);
        font-size: 0.9375rem;
    }

    .xc-layout-meta {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .xc-revision {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-family: var(--xc-font-mono);
        font-size: 0.6875rem;
        color: var(--xc-gray-600);
        background: var(--xc-gray-100);
        padding: 2px 8px;
        border-radius: 12px;
        font-weight: 600;
    }

    .xc-revision i {
        font-size: 0.875rem;
        font-family: initial;
    }

    /* Stage Info */
    .xc-stage-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .xc-stage-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-family: var(--xc-font-heading);
        font-size: 0.6875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        width: fit-content;
        background: var(--xc-purple-light);
        color: var(--xc-purple);
    }

    .xc-stage-architect {
        background: var(--xc-purple-light);
        color: var(--xc-purple);
    }

    .xc-stage-structural {
        background: #e5edff;
        color: #3251d4;
    }

    .xc-stage-pmc {
        background: var(--xc-orange-light);
        color: var(--xc-orange);
    }

    .xc-stage-client {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-stage-execution {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-owner-name {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 0.8125rem;
        color: var(--xc-gray-600);
    }

    .xc-owner-name i {
        font-size: 1rem;
        color: var(--xc-gray-400);
    }

    /* Customer Name */
    .xc-customer-name {
        font-weight: 600;
        color: var(--xc-gray-800);
    }

    /* Timeline */
    .xc-timeline {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .xc-timeline-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: var(--xc-font-mono);
        font-size: 0.75rem;
        color: var(--xc-gray-700);
    }

    .xc-timeline-item i {
        font-size: 1rem;
        color: var(--xc-gray-400);
        font-family: initial;
    }

    /* Schedule Badge */
    .xc-schedule-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        text-align: center;
    }

    .xc-schedule-on-time {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-schedule-delayed {
        background: var(--xc-danger-light);
        color: #991b1b;
    }

    .xc-schedule-upcoming {
        background: #e5edff;
        color: #3251d4;
    }

    /* Status Group */
    .xc-status-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .xc-status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-family: var(--xc-font-heading);
        font-size: 0.75rem;
        font-weight: 700;
        width: fit-content;
    }

    .xc-status-approved {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-status-remarked {
        background: var(--xc-orange-light);
        color: var(--xc-orange);
    }

    .xc-status-pending {
        background: var(--xc-purple-light);
        color: var(--xc-purple);
    }

    /* Approvals */
    .xc-approvals {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .xc-approval-item {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .xc-approval-item i {
        font-size: 0.875rem;
    }

    .xc-approval-approved {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-approval-remarked {
        background: var(--xc-danger-light);
        color: #991b1b;
    }

    .xc-approval-pending {
        background: var(--xc-gray-100);
        color: var(--xc-gray-500);
    }

    /* Actions */
    .xc-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .xc-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: var(--xc-radius-sm);
        font-family: var(--xc-font-body);
        font-size: 0.8125rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: var(--xc-transition);
        white-space: nowrap;
    }

    .xc-action-btn i {
        font-size: 1rem;
    }

    .xc-action-view {
        background: var(--xc-teal-dark);
        color: white;
    }

    .xc-action-view:hover {
        background: var(--xc-teal);
        color: white;
        transform: translateY(-1px);
    }

    .xc-action-approve {
        background: var(--xc-teal);
        color: white;
    }

    .xc-action-approve:hover {
        background: var(--xc-teal-dark);
        color: white;
        transform: translateY(-1px);
    }

    .xc-action-remark {
        background: var(--xc-orange);
        color: white;
    }

    .xc-action-remark:hover {
        background: #ea6a0c;
        color: white;
        transform: translateY(-1px);
    }

    .xc-action-resubmit {
        background: var(--xc-purple);
        color: white;
    }

    .xc-action-resubmit:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-1px);
    }

    .xc-action-final {
        background: var(--xc-purple);
        color: white;
    }

    .xc-action-final:hover {
        background: #6d28d9;
        color: white;
        transform: translateY(-1px);
    }

    .xc-action-next {
        background: var(--xc-teal-dark);
        color: white;
    }

    .xc-action-next:hover {
        background: var(--xc-teal);
        color: white;
        transform: translateY(-1px);
    }

    .xc-action-disabled,
    .xc-action-completed {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: var(--xc-radius-sm);
        font-size: 0.8125rem;
        font-weight: 600;
        background: var(--xc-gray-100);
        color: var(--xc-gray-600);
    }

    /* Divider Row */
    .xc-divider-row {
        background: transparent !important;
    }

    .xc-divider-row:hover {
        background: transparent !important;
    }

    .xc-divider-row td {
        padding: 8px 0 !important;
        border: none !important;
    }

    .xc-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, var(--xc-teal) 50%, transparent 100%);
        opacity: 0.35;
    }

    /* Empty State */
    .xc-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        text-align: center;
    }

    .xc-empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--xc-teal-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .xc-empty-icon i {
        font-size: 3rem;
        color: var(--xc-teal);
    }

    .xc-empty-state h3 {
        font-family: var(--xc-font-heading);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--xc-navy);
        margin-bottom: 8px;
    }

    .xc-empty-state p {
        font-size: 0.9375rem;
        color: var(--xc-gray-600);
        margin-bottom: 20px;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1200px) {

        .xc-table th,
        .xc-table td {
            padding: 12px 10px;
        }

        .xc-actions {
            flex-direction: column;
            align-items: flex-start;
        }

        .xc-action-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        .xc-page-header {
            flex-direction: column;
        }

        .xc-page-header-left,
        .xc-page-header-right {
            width: 100%;
        }

        .xc-action-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .xc-action-bar-left,
        .xc-action-bar-right {
            width: 100%;
            flex-direction: column;
        }

        .xc-filter-group {
            width: 100%;
        }

        .xc-select {
            width: 100%;
        }

        .xc-btn {
            width: 100%;
            justify-content: center;
        }

        .xc-table-container {
            overflow-x: scroll;
        }

        .xc-table {
            min-width: 1200px;
        }
    }

    @media (max-width: 480px) {
        .xc-page-title {
            font-size: 1.5rem;
        }

        .xc-page-icon {
            width: 48px;
            height: 48px;
            font-size: 24px;
        }
    }
</style>