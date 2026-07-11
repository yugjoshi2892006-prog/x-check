<div class="page-wrapper">
    <div class="page-content">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-modern">
                <i class="bx bx-check-circle"></i>
                <span><?= $this->session->flashdata('success'); ?></span>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger alert-modern">
                <i class="bx bx-error-circle"></i>
                <span><?= $this->session->flashdata('error'); ?></span>
            </div>
        <?php } ?>

        <div class="xc-flow-head">
            <div class="xc-flow-head-content">
                <div class="xc-flow-title-wrapper">
                    <div class="xc-flow-icon-wrapper">
                        <i class="bx bx-git-branch"></i>
                    </div>
                    <div>
                        <h4 class="xc-flow-title">Layout Process Flow</h4>
                        <p class="xc-flow-sub">
                            <span class="xc-flow-badge">Architect</span>
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="xc-flow-badge">Structural</span>
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="xc-flow-badge">All Consultants</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="xc-flow-head-actions">
                <?php if (!empty($scopes)) { ?>
                    <div class="xc-select-wrapper">
                        <i class="bx bx-building"></i>
                        <select class="xc-scope-select"
                            onchange="window.location='<?= base_url('index.php/employee/layout_process_flow/'); ?>' + this.value">
                            <?php foreach ($scopes as $s) { ?>
                                <option value="<?= (int) $s->customer_id; ?>" <?= $s->customer_id == $customer_id ? 'selected' : ''; ?>>
                                    <?= html_escape($s->customer_name ?: ('Client #' . $s->customer_id)); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>

                <a href="<?= base_url('index.php/employee/layout_process'); ?>" class="xc-btn-sm xc-btn-outline">
                    <i class="bx bx-list-ul"></i>
                    <span>Table View</span>
                </a>
            </div>
        </div>

        <?php
        $render_flow_card_inner = function ($card) use ($layout_role, $role) {
            $state = $card->state;

            $pill_class = 'xc-pill-gray';
            $pill_icon = 'bx-time-five';
            if ($state === 'Pending Review') {
                $pill_class = 'xc-pill-orange';
                $pill_icon = 'bx-time-five';
            } elseif ($state === 'Remarked') {
                $pill_class = 'xc-pill-red';
                $pill_icon = 'bx-message-square-x';
            } elseif ($state === 'Approved') {
                $pill_class = 'xc-pill-green';
                $pill_icon = 'bx-check-circle';
            } elseif ($state === 'Locked') {
                $pill_class = 'xc-pill-gray';
                $pill_icon = 'bx-lock-alt';
            }

            $can_submit_this_stage = !empty($layout_role) && $layout_role->role === $card->stage && $card->can_submit;
            $architect_review_required = $card->report && Layout_member_model::isArchitectReviewRequired($card->report->stage);
            $can_review_this_stage = $card->report && $state === 'Pending Review' && (
                ($role === 'customer' && $card->report->client_status === 'Pending') ||
                (!empty($layout_role) && $layout_role->role === 'PMC' && $card->report->pmc_status === 'Pending') ||
                ($architect_review_required && !empty($layout_role) && $layout_role->role === 'Architect' && $card->report->architect_status === 'Pending')
            );
            ?>
            <div
                class="xc-flow-card <?= $state === 'Locked' ? 'locked' : ''; ?> <?= $state === 'Approved' ? 'approved' : ''; ?>">
                <div class="xc-flow-card-header">
                    <div class="xc-flow-card-info">
                        <div class="xc-flow-stage-wrapper">
                            <div class="xc-stage-icon">
                                <?php
                                $stage_icons = [
                                    'Architect' => 'bx-pen',
                                    'Structure Consultant' => 'bx-building-house',
                                    'MEP Consultant' => 'bx-bolt',
                                    'HVAC Consultant' => 'bx-wind',
                                    'Plumbing Consultant' => 'bx-droplet',
                                    'Fire Fighting Consultant' => 'bx-water',
                                ];
                                $icon = $stage_icons[$card->stage] ?? 'bx-file';
                                ?>
                                <i class="bx <?= $icon; ?>"></i>
                            </div>
                            <div>
                                <div class="xc-flow-stage"><?= html_escape($card->stage); ?></div>
                                <div class="xc-flow-member">
                                    <i class="bx bx-user-circle"></i>
                                    <?= $card->member ? html_escape($card->member->member_name) : '<span class="text-muted">No member assigned</span>'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="xc-pill <?= $pill_class; ?>">
                        <i class="bx <?= $pill_icon; ?>"></i>
                        <?= html_escape($state); ?>
                    </span>
                </div>

                <?php if ($card->report) { ?>
                    <div class="xc-approval-section">
                        <div class="xc-approval-title">
                            <i class="bx bx-git-pull-request"></i>
                            <span>Approval Status</span>
                        </div>
                        <div class="xc-approval-grid">
                            <?php if ($architect_review_required) { ?>
                                <div class="xc-approval-item">
                                    <span class="xc-approval-label">Architect</span>
                                    <span
                                        class="xc-pill xc-pill-sm <?= $card->report->architect_status === 'Approved' ? 'xc-pill-green' : ($card->report->architect_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                        <i
                                            class="bx <?= $card->report->architect_status === 'Approved' ? 'bx-check' : ($card->report->architect_status === 'Remarked' ? 'bx-x' : 'bx-time'); ?>"></i>
                                        <?= html_escape($card->report->architect_status); ?>
                                    </span>
                                </div>
                            <?php } ?>

                            <div class="xc-approval-item">
                                <span class="xc-approval-label">Client</span>
                                <span
                                    class="xc-pill xc-pill-sm <?= $card->report->client_status === 'Approved' ? 'xc-pill-green' : ($card->report->client_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                    <i
                                        class="bx <?= $card->report->client_status === 'Approved' ? 'bx-check' : ($card->report->client_status === 'Remarked' ? 'bx-x' : 'bx-time'); ?>"></i>
                                    <?= html_escape($card->report->client_status); ?>
                                </span>
                            </div>

                            <div class="xc-approval-item">
                                <span class="xc-approval-label">PMC</span>
                                <span
                                    class="xc-pill xc-pill-sm <?= $card->report->pmc_status === 'Approved' ? 'xc-pill-green' : ($card->report->pmc_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                    <i
                                        class="bx <?= $card->report->pmc_status === 'Approved' ? 'bx-check' : ($card->report->pmc_status === 'Remarked' ? 'bx-x' : 'bx-time'); ?>"></i>
                                    <?= html_escape($card->report->pmc_status); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="xc-flow-actions">
                    <?php if ($card->report) { ?>
                        <a href="<?= base_url('index.php/employee/layout_process_view/' . $card->report->id); ?>"
                            class="xc-btn-sm xc-btn-outline">
                            <i class="bx bx-show"></i>
                            <span>View Details</span>
                        </a>
                    <?php } ?>

                    <?php if ($can_review_this_stage) { ?>
                        <a href="<?= base_url('index.php/employee/layout_process_view/' . $card->report->id); ?>"
                            class="xc-btn-sm xc-btn-orange xc-btn-pulse">
                            <i class="bx bx-message-square-detail"></i>
                            <span>Review Now</span>
                        </a>
                    <?php } ?>

                    <?php if ($can_submit_this_stage) { ?>
                        <a href="<?= base_url('index.php/employee/layout_process_add' . ($state === 'Remarked' ? '/' . $card->report->id : '')); ?>"
                            class="xc-btn-sm xc-btn-teal">
                            <i class="bx <?= $state === 'Remarked' ? 'bx-revision' : 'bx-upload'; ?>"></i>
                            <span><?= $state === 'Remarked' ? 'Resubmit' : 'Submit Report'; ?></span>
                        </a>
                    <?php } ?>

                    <?php if ($card->stage === 'Architect' && $state === 'Approved') { ?>
                        <?php if (empty($card->final_project)) { ?>
                            <?php if (!empty($layout_role) && $layout_role->role === 'Architect') { ?>
                                <a href="<?= base_url('index.php/employee/layout_final_project_add'); ?>" class="xc-btn-sm xc-btn-teal">
                                    <i class="bx bx-plus-circle"></i>
                                    <span>Add Final Project</span>
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="xc-success-badge">
                                <i class="bx bx-check-double"></i>
                                <span>Sent to Structural</span>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php
        };

        $sequential_cards = array_values(array_filter($flow, function ($c) {
            return empty($c->parallel); }));
        $parallel_cards = array_values(array_filter($flow, function ($c) {
            return !empty($c->parallel); }));
        ?>

        <?php if (empty($flow)) { ?>
            <div class="xc-empty-flow">
                <div class="xc-empty-icon">
                    <i class="bx bx-folder-open"></i>
                </div>
                <h5>No Layout Flow Found</h5>
                <p>No client selected yet, or no layout flow has started for this client.</p>
            </div>
        <?php } else { ?>
            <div class="xc-flow-container">
                <ul class="xc-flow-list">
                    <?php foreach ($sequential_cards as $index => $card) {
                        $state = $card->state;

                        $dot_class = 'st-not-started';
                        $icon = 'bx-time-five';

                        if ($state === 'Locked') {
                            $dot_class = 'st-locked';
                            $icon = 'bx-lock-alt';
                        } elseif ($state === 'Not Started') {
                            $dot_class = 'st-not-started';
                            $icon = 'bx-hourglass';
                        } elseif ($state === 'Pending Review') {
                            $dot_class = 'st-pending';
                            $icon = 'bx-time-five';
                        } elseif ($state === 'Remarked') {
                            $dot_class = 'st-remarked';
                            $icon = 'bx-message-square-edit';
                        } elseif ($state === 'Approved') {
                            $dot_class = 'st-approved';
                            $icon = 'bx-check-double';
                        }

                        $line_done = $state === 'Approved';
                        ?>
                        <li class="xc-flow-item <?= $line_done ? 'done' : ''; ?>"
                            data-state="<?= strtolower(str_replace(' ', '-', $state)); ?>">
                            <div class="xc-flow-rail">
                                <div class="xc-flow-dot <?= $dot_class; ?>">
                                    <i class="bx <?= $icon; ?>"></i>
                                </div>
                                <?php if ($index < count($sequential_cards) - 1) { ?>
                                    <div class="xc-flow-line"></div>
                                <?php } ?>
                            </div>
                            <?php $render_flow_card_inner($card); ?>
                        </li>
                    <?php } ?>
                </ul>

                <?php if (!empty($parallel_cards)) { ?>
                    <div class="xc-parallel-section">
                        <div class="xc-parallel-heading">
                            <div class="xc-parallel-icon">
                                <i class="bx bx-git-merge"></i>
                            </div>
                            <div>
                                <h5>Parallel Consultants</h5>
                                <p>All consultants unlock together once Structural is approved</p>
                            </div>
                        </div>
                        <div class="xc-parallel-grid">
                            <?php foreach ($parallel_cards as $card) {
                                echo '<div class="xc-parallel-card-wrapper">';
                                $render_flow_card_inner($card);
                                echo '</div>';
                            } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<style>
    :root {
        --primary-color: #4f46e5;
        --primary-dark: #4338ca;
        --primary-light: #eef2ff;
        --success-color: #10b981;
        --success-light: #d1fae5;
        --warning-color: #f59e0b;
        --warning-light: #fef3c7;
        --danger-color: #ef4444;
        --danger-light: #fee2e2;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    /* Alert Styles */
    .alert-modern {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-radius: 12px;
        border: none;
        font-weight: 500;
        margin-bottom: 24px;
        box-shadow: var(--shadow-md);
        animation: slideInDown 0.4s ease-out;
    }

    .alert-modern i {
        font-size: 24px;
    }

    .alert-success {
        background: linear-gradient(135deg, var(--success-light) 0%, #fff 100%);
        color: #047857;
        border-left: 4px solid var(--success-color);
    }

    .alert-danger {
        background: linear-gradient(135deg, var(--danger-light) 0%, #fff 100%);
        color: #b91c1c;
        border-left: 4px solid var(--danger-color);
    }

    /* Header Styles */
    .xc-flow-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        padding: 24px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 16px;
        color: white;
        box-shadow: var(--shadow-xl);
        flex-wrap: wrap;
        gap: 20px;
    }

    .xc-flow-head-content {
        flex: 1;
        min-width: 300px;
    }

    .xc-flow-title-wrapper {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .xc-flow-icon-wrapper {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .xc-flow-icon-wrapper i {
        font-size: 28px;
        color: white;
    }

    .xc-flow-title {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: white;
    }

    .xc-flow-sub {
        margin: 8px 0 0 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        opacity: 0.95;
    }

    .xc-flow-badge {
        background: rgba(255, 255, 255, 0.25);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .xc-flow-sub i {
        font-size: 18px;
    }

    .xc-flow-head-actions {
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Select Wrapper */
    .xc-select-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .xc-select-wrapper i {
        position: absolute;
        left: 14px;
        font-size: 18px;
        color: var(--gray-500);
        pointer-events: none;
        z-index: 1;
    }

    .xc-scope-select {
        padding: 10px 16px 10px 42px;
        border: 2px solid var(--gray-200);
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 200px;
        box-shadow: var(--shadow-sm);
    }

    .xc-scope-select:hover {
        border-color: var(--primary-color);
    }

    .xc-scope-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    /* Button Styles */
    .xc-btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        white-space: nowrap;
        box-shadow: var(--shadow-sm);
    }

    .xc-btn-sm i {
        font-size: 18px;
    }

    .xc-btn-outline {
        background: white;
        color: var(--primary-color);
        border-color: white;
    }

    .xc-btn-outline:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .xc-btn-teal {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        color: white;
    }

    .xc-btn-teal:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .xc-btn-orange {
        background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
        color: white;
    }

    .xc-btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .xc-btn-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Flow Container */
    .xc-flow-container {
        background: var(--gray-50);
        border-radius: 16px;
        padding: 24px;
    }

    /* Flow List */
    .xc-flow-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .xc-flow-item {
        display: flex;
        gap: 24px;
        position: relative;
        margin-bottom: 24px;
        animation: fadeInUp 0.5s ease-out backwards;
    }

    .xc-flow-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .xc-flow-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .xc-flow-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .xc-flow-item.done .xc-flow-line {
        background: linear-gradient(180deg, var(--success-color) 0%, var(--success-color) 100%);
    }

    /* Flow Rail */
    .xc-flow-rail {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .xc-flow-dot {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        z-index: 2;
        box-shadow: var(--shadow-lg);
        transition: all 0.3s ease;
    }

    .xc-flow-dot i {
        color: white;
    }

    .xc-flow-dot.st-locked {
        background: linear-gradient(135deg, var(--gray-400) 0%, var(--gray-500) 100%);
    }

    .xc-flow-dot.st-not-started {
        background: linear-gradient(135deg, var(--gray-300) 0%, var(--gray-400) 100%);
    }

    .xc-flow-dot.st-pending {
        background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .xc-flow-dot.st-remarked {
        background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    }

    .xc-flow-dot.st-approved {
        background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    }

    .xc-flow-line {
        width: 4px;
        flex: 1;
        min-height: 60px;
        background: var(--gray-200);
        margin-top: 8px;
        border-radius: 2px;
        transition: all 0.5s ease;
    }

    /* Flow Card */
    .xc-flow-card {
        flex: 1;
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .xc-flow-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary-light);
    }

    .xc-flow-card.locked {
        opacity: 0.6;
        background: var(--gray-50);
    }

    .xc-flow-card.approved {
        border-color: var(--success-light);
        background: linear-gradient(135deg, #fff 0%, #f0fdf4 100%);
    }

    .xc-flow-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 16px;
    }

    .xc-flow-stage-wrapper {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .xc-stage-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary-light) 0%, #fff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-stage-icon i {
        font-size: 22px;
        color: var(--primary-color);
    }

    .xc-flow-stage {
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 4px;
    }

    .xc-flow-member {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: var(--gray-600);
    }

    .xc-flow-member i {
        font-size: 16px;
    }

    .text-muted {
        color: var(--gray-400);
        font-style: italic;
    }

    /* Pills */
    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: var(--shadow-sm);
    }

    .xc-pill-sm {
        padding: 4px 12px;
        font-size: 12px;
    }

    .xc-pill i {
        font-size: 14px;
    }

    .xc-pill-gray {
        background: var(--gray-100);
        color: var(--gray-700);
    }

    .xc-pill-green {
        background: var(--success-light);
        color: #065f46;
    }

    .xc-pill-orange {
        background: var(--warning-light);
        color: #92400e;
    }

    .xc-pill-red {
        background: var(--danger-light);
        color: #991b1b;
    }

    /* Approval Section */
    .xc-approval-section {
        background: var(--gray-50);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 20px;
    }

    .xc-approval-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 12px;
    }

    .xc-approval-title i {
        font-size: 18px;
        color: var(--primary-color);
    }

    .xc-approval-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 12px;
    }

    .xc-approval-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .xc-approval-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Actions */
    .xc-flow-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .xc-success-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: var(--success-light);
        color: #065f46;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
    }

    .xc-success-badge i {
        font-size: 18px;
    }

    /* Parallel Section */
    .xc-parallel-section {
        margin-top: 40px;
        animation: fadeInUp 0.5s ease-out 0.4s backwards;
    }

    .xc-parallel-heading {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        background: linear-gradient(135deg, #fff 0%, var(--primary-light) 100%);
        border-radius: 12px;
        margin-bottom: 24px;
        border-left: 4px solid var(--primary-color);
        box-shadow: var(--shadow-md);
    }

    .xc-parallel-icon {
        width: 48px;
        height: 48px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-sm);
    }

    .xc-parallel-icon i {
        font-size: 24px;
        color: var(--primary-color);
    }

    .xc-parallel-heading h5 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--gray-800);
    }

    .xc-parallel-heading p {
        margin: 4px 0 0 0;
        font-size: 14px;
        color: var(--gray-600);
    }

    .xc-parallel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }

    .xc-parallel-card-wrapper {
        animation: fadeInUp 0.5s ease-out backwards;
    }

    .xc-parallel-card-wrapper:nth-child(1) {
        animation-delay: 0.5s;
    }

    .xc-parallel-card-wrapper:nth-child(2) {
        animation-delay: 0.6s;
    }

    .xc-parallel-card-wrapper:nth-child(3) {
        animation-delay: 0.7s;
    }

    .xc-parallel-card-wrapper:nth-child(4) {
        animation-delay: 0.8s;
    }

    /* Empty State */
    .xc-empty-flow {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow-md);
    }

    .xc-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .xc-empty-icon i {
        font-size: 40px;
        color: var(--gray-400);
    }

    .xc-empty-flow h5 {
        font-size: 20px;
        font-weight: 700;
        color: var(--gray-800);
        margin: 0 0 8px 0;
    }

    .xc-empty-flow p {
        font-size: 14px;
        color: var(--gray-600);
        margin: 0;
    }

    /* Animations */
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

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .xc-parallel-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .xc-flow-head {
            flex-direction: column;
            align-items: stretch;
        }

        .xc-flow-head-actions {
            justify-content: stretch;
            flex-direction: column;
        }

        .xc-scope-select {
            width: 100%;
        }

        .xc-flow-item {
            gap: 16px;
        }

        .xc-flow-dot {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .xc-flow-card {
            padding: 16px;
        }

        .xc-parallel-grid {
            grid-template-columns: 1fr;
        }

        .xc-approval-grid {
            grid-template-columns: 1fr;
        }

        .xc-flow-actions {
            flex-direction: column;
        }

        .xc-flow-actions .xc-btn-sm {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .xc-flow-title {
            font-size: 20px;
        }

        .xc-flow-sub {
            font-size: 12px;
        }

        .xc-flow-badge {
            font-size: 11px;
            padding: 3px 10px;
        }

        .xc-parallel-heading {
            flex-direction: column;
            text-align: center;
        }
    }
</style>