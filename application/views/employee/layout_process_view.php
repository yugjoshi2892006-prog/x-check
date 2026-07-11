<style>
    :root {
        --primary: #0f9a95;
        --primary-light: #e6f9f8;
        --success: #15803d;
        --success-light: #dcfce7;
        --warning: #c98a1c;
        --warning-light: #fff4e0;
        --danger: #c93a3a;
        --danger-light: #fde8e8;
        --info: #3766e8;
        --info-light: #eaf1ff;
        --gray-50: #fafbfc;
        --gray-100: #eef1f4;
        --gray-200: #e9edf1;
        --gray-600: #7c8798;
        --gray-700: #475467;
        --gray-900: #1f2937;
        --text-dark: #2b3441;
    }

    .xc-view-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    .xc-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 24px;
        font-size: 14px;
        color: var(--gray-600);
    }

    .xc-breadcrumb a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .xc-breadcrumb a:hover {
        text-decoration: underline;
    }

    .xc-card {
        background: #fff;
        border: 1px solid var(--gray-200);
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(20, 40, 60, .06);
        overflow: hidden;
        margin-bottom: 24px;
        animation: fadeInUp 0.4s ease-out;
    }

    .xc-card-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0d7d79 100%);
        padding: 32px 28px;
        border-bottom: none;
        position: relative;
        overflow: hidden;
    }

    .xc-card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .xc-card-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .xc-header-content {
        position: relative;
        z-index: 1;
    }

    .xc-title {
        margin: 0;
        color: white;
        font-size: 26px;
        font-weight: 800;
        line-height: 1.3;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .xc-subtitle {
        margin: 8px 0 0 0;
        color: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .xc-viewer-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        color: white;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 24px;
        margin-top: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .xc-viewer-badge i {
        font-size: 18px;
    }

    .xc-card-body {
        padding: 32px 28px;
    }

    .xc-section {
        margin-bottom: 32px;
    }

    .xc-section:last-child {
        margin-bottom: 0;
    }

    .xc-section-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xc-section-title i {
        font-size: 22px;
        color: var(--primary);
    }

    .xc-label {
        color: var(--gray-600);
        display: block;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .04em;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .xc-box {
        border: 2px solid var(--gray-200);
        border-radius: 12px;
        padding: 14px 16px;
        min-height: 50px;
        color: var(--text-dark);
        background: var(--gray-50);
        white-space: pre-wrap;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
    }

    .xc-box:hover {
        border-color: var(--primary);
        background: white;
    }

    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 24px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        border: none;
        white-space: nowrap;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .xc-pill i {
        font-size: 16px;
    }

    .xc-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .xc-teal {
        background: var(--primary-light);
        color: var(--primary);
    }

    .xc-teal:hover {
        background: var(--primary);
        color: white;
    }

    .xc-green {
        background: var(--success-light);
        color: var(--success);
    }

    .xc-green:hover {
        background: var(--success);
        color: white;
    }

    .xc-orange {
        background: var(--warning-light);
        color: var(--warning);
    }

    .xc-orange:hover {
        background: var(--warning);
        color: white;
    }

    .xc-red {
        background: var(--danger-light);
        color: var(--danger);
    }

    .xc-red:hover {
        background: var(--danger);
        color: white;
    }

    .xc-blue {
        background: var(--info-light);
        color: var(--info);
    }

    .xc-gray {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .xc-pdf-card {
        display: inline-flex;
        align-items: center;
        gap: 16px;
        border: 2px solid var(--gray-200);
        border-radius: 14px;
        padding: 20px 24px;
        background: linear-gradient(135deg, #fff 0%, var(--gray-50) 100%);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .xc-pdf-card:hover {
        border-color: var(--danger);
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(201, 58, 58, 0.2);
        color: var(--text-dark);
    }

    .xc-pdf-icon-wrapper {
        width: 56px;
        height: 56px;
        background: var(--danger-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-pdf-icon-wrapper i {
        font-size: 32px;
        color: var(--danger);
    }

    .xc-pdf-card-text {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .xc-pdf-card-text strong {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .xc-pdf-card-text small {
        color: var(--gray-600);
        font-size: 12px;
    }

    .xc-status-grid {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .xc-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, var(--gray-200) 50%, transparent 100%);
        margin: 32px 0;
    }

    .xc-action-section {
        background: var(--gray-50);
        border-radius: 12px;
        padding: 24px;
        border: 2px dashed var(--gray-200);
    }

    .xc-action-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .xc-action-title i {
        font-size: 20px;
        color: var(--primary);
    }

    .xc-form-group {
        margin-bottom: 16px;
    }

    .xc-form-control {
        width: 100%;
        border: 2px solid var(--gray-200);
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s ease;
        resize: vertical;
    }

    .xc-form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .xc-btn-group {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .xc-info-box {
        background: var(--info-light);
        border-left: 4px solid var(--info);
        border-radius: 8px;
        padding: 16px 20px;
        color: var(--info);
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .xc-info-box i {
        font-size: 22px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .xc-card-header {
            padding: 24px 20px;
        }

        .xc-card-body {
            padding: 24px 20px;
        }

        .xc-title {
            font-size: 20px;
        }

        .xc-pdf-card {
            flex-direction: column;
            text-align: center;
        }

        .xc-btn-group {
            flex-direction: column;
        }

        .xc-pill {
            justify-content: center;
            width: 100%;
        }

        .xc-status-grid {
            flex-direction: column;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!-- <div class="xc-view-wrapper"> -->
            <!-- Breadcrumb -->
            <div class="xc-breadcrumb">
                <i class="bx bx-home-alt"></i>
                <a href="<?= base_url('index.php/employee/layout_process'); ?>">Layout Process</a>
                <i class="bx bx-chevron-right"></i>
                <span>View Details</span>
            </div>

            <div class="xc-card">
                <!-- Enhanced Header -->
                <div class="xc-card-header">
                    <div class="xc-header-content">
                        <p class="xc-title"><?= html_escape($report->plan_title); ?></p>
                        <p class="xc-subtitle">Layout Plan Details</p>
                        <?php
                        if ($this->session->userdata('role') === 'customer') {
                            $viewer_label = 'Client';
                            $viewer_icon = 'bx-briefcase';
                        } elseif (!empty($layout_role)) {
                            $viewer_label = $layout_role->role;
                            $viewer_icon = 'bx-user-check';
                        } else {
                            $viewer_label = 'Employee';
                            $viewer_icon = 'bx-user';
                        }
                        ?>
                        <span class="xc-viewer-badge">
                            <i class="bx <?= $viewer_icon; ?>"></i>
                            Viewing as: <?= html_escape($viewer_label); ?>
                        </span>
                    </div>
                </div>

                <div class="xc-card-body">
                    <!-- PDF Section -->
                    <?php if (!empty($report->plan_doc)) { ?>
                        <div class="xc-section">
                            <div class="xc-section-title">
                                <i class="bx bxs-file-pdf"></i>
                                Document
                            </div>
                            <a href="<?= base_url('uploads/layout_process/' . $report->plan_doc); ?>" target="_blank"
                                class="xc-pdf-card">
                                <div class="xc-pdf-icon-wrapper">
                                    <i class="bx bxs-file-pdf"></i>
                                </div>
                                <span class="xc-pdf-card-text">
                                    <strong>View Layout Plan</strong>
                                    <small>Click to open PDF in a new tab</small>
                                </span>
                            </a>
                        </div>
                    <?php } ?>

                    <!-- Project Information -->
                    <div class="xc-section">
                        <div class="xc-section-title">
                            <i class="bx bx-info-circle"></i>
                            Project Information
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="xc-label">Client Name</label>
                                <div class="xc-box">
                                    <i class="bx bx-user" style="color: var(--primary); margin-right: 8px;"></i>
                                    <?= html_escape($report->customer_name); ?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="xc-label">Architect</label>
                                <div class="xc-box">
                                    <i class="bx bx-hard-hat" style="color: var(--primary); margin-right: 8px;"></i>
                                    <?= html_escape($report->architect_name); ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="xc-label">Start Date</label>
                                <div class="xc-box">
                                    <i class="bx bx-calendar-check"
                                        style="color: var(--success); margin-right: 8px;"></i>
                                    <?= $report->start_date ? date('d M Y', strtotime($report->start_date)) : '-'; ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="xc-label">End Date</label>
                                <div class="xc-box">
                                    <i class="bx bx-calendar-x" style="color: var(--danger); margin-right: 8px;"></i>
                                    <?= $report->end_date ? date('d M Y', strtotime($report->end_date)) : '-'; ?>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="xc-label">Status & Revision</label>
                                <div class="xc-box">
                                    <i class="bx bx-git-branch" style="color: var(--info); margin-right: 8px;"></i>
                                    <?= html_escape($report->status); ?>, Rev. <?= (int) $report->revision_no; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Approval Status -->
                    <div class="xc-section">
                        <div class="xc-section-title">
                            <i class="bx bx-check-shield"></i>
                            Approval Status
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="xc-label">
                                    <?= Layout_member_model::isArchitectReviewRequired($report->stage)
                                        ? 'Architect / Client / PMC Response'
                                        : 'Client / PMC Response'; ?>
                                </label>
                                <div class="xc-status-grid">
                                    <?php if (Layout_member_model::isArchitectReviewRequired($report->stage)) { ?>
                                        <span
                                            class="xc-pill <?= $report->architect_status === 'Approved' ? 'xc-green' : ($report->architect_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                            <i
                                                class="bx <?= $report->architect_status === 'Approved' ? 'bx-check-circle' : ($report->architect_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                            Architect: <?= html_escape($report->architect_status); ?>
                                        </span>
                                    <?php } ?>
                                    <span
                                        class="xc-pill <?= $report->client_status === 'Approved' ? 'xc-green' : ($report->client_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                        <i
                                            class="bx <?= $report->client_status === 'Approved' ? 'bx-check-circle' : ($report->client_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                        Client: <?= html_escape($report->client_status); ?>
                                    </span>
                                    <span
                                        class="xc-pill <?= $report->pmc_status === 'Approved' ? 'xc-green' : ($report->pmc_status === 'Remarked' ? 'xc-red' : 'xc-gray'); ?>">
                                        <i
                                            class="bx <?= $report->pmc_status === 'Approved' ? 'bx-check-circle' : ($report->pmc_status === 'Remarked' ? 'bx-x-circle' : 'bx-time-five'); ?>"></i>
                                        PMC: <?= html_escape($report->pmc_status); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="xc-label">Schedule Status</label>
                                <?php $schedule = $this->Layout_member_model->getScheduleStatus($report); ?>
                                <div class="xc-box">
                                    <span class="xc-pill <?= $schedule->class; ?>">
                                        <i
                                            class="bx <?= $schedule->class === 'xc-green' ? 'bx-check-circle' : ($schedule->class === 'xc-red' ? 'bx-error-circle' : 'bx-time-five'); ?>"></i>
                                        <?= html_escape($schedule->label); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Remarks Section -->
                    <?php if (!empty($report->architect_remark) || !empty($report->client_remark) || !empty($report->pmc_remark)) { ?>
                        <div class="xc-section">
                            <div class="xc-section-title">
                                <i class="bx bx-message-square-detail"></i>
                                Remarks & Feedback
                            </div>
                            <div class="xc-box" style="background: white; border-color: var(--warning);">
                                <?= nl2br(html_escape(trim($report->architect_remark . "\n" . $report->client_remark . "\n" . $report->pmc_remark))); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="xc-divider"></div>

                    <!-- Action Section -->
                    <?php
                    $is_client_viewer = $this->session->userdata('role') === 'customer';
                    $is_pmc_viewer = !empty($layout_role) && $layout_role->role === 'PMC';
                    $is_architect_reviewer = !empty($layout_role) && $layout_role->role === 'Architect' && Layout_member_model::isArchitectReviewRequired($report->stage);
                    $my_turn = ($is_client_viewer && $report->client_status === 'Pending')
                        || ($is_pmc_viewer && $report->pmc_status === 'Pending')
                        || ($is_architect_reviewer && $report->architect_status === 'Pending');
                    ?>

                    <?php if ($my_turn) { ?>
                        <div class="xc-action-section">
                            <div class="xc-action-title">
                                <i class="bx bx-edit"></i>
                                Your Review Required
                            </div>

                            <div class="xc-btn-group">
                                <a href="<?= base_url('index.php/employee/approve_layout_process/' . $report->id); ?>"
                                    onclick="return confirm('Are you sure you want to approve this layout report?');"
                                    class="xc-pill xc-green">
                                    <i class="bx bx-check-double"></i> Approve Layout
                                </a>
                            </div>

                            <form id="remark"
                                action="<?= base_url('index.php/employee/remark_layout_process/' . $report->id); ?>"
                                method="post" class="mt-4">
                                <div class="xc-form-group">
                                    <label class="xc-label">Add Remark (Optional)</label>
                                    <textarea name="review_remark" class="xc-form-control" rows="4"
                                        placeholder="Enter your feedback or concerns here..." required></textarea>
                                </div>
                                <button class="xc-pill xc-orange" type="submit">
                                    <i class="bx bx-message-square-x"></i> Submit Remark & Request Changes
                                </button>
                            </form>
                        </div>
                    <?php } elseif ($is_client_viewer || $is_pmc_viewer || $is_architect_reviewer) { ?>
                        <div class="xc-info-box">
                            <i class="bx bx-check-circle"></i>
                            <span>You've already responded to this submission. Waiting for other reviewers to complete their
                                review.</span>
                        </div>
                    <?php } ?>

                    <!-- Resubmit Section -->
                    <?php if (!empty($layout_role) && $layout_role->role === $report->stage && $report->status === 'Remarked') { ?>
                        <div class="xc-action-section" style="border-color: var(--warning);">
                            <div class="xc-action-title">
                                <i class="bx bx-revision"></i>
                                Resubmission Required
                            </div>
                            <p style="color: var(--gray-600); margin-bottom: 16px; font-size: 14px;">
                                This layout has been remarked. Please review the feedback and submit a revised version.
                            </p>
                            <a href="<?= base_url('index.php/employee/layout_process_add/' . $report->id); ?>"
                                class="xc-pill xc-orange">
                                <i class="bx bx-upload"></i> Submit Revised Layout
                            </a>
                        </div>
                    <?php } ?>

                    <!-- Back Button -->
                    <div class="mt-4">
                        <a href="<?= base_url('index.php/employee/layout_process'); ?>" class="xc-pill xc-teal">
                            <i class="bx bx-arrow-back"></i> Back to Layout Process
                        </a>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </div>
</div>