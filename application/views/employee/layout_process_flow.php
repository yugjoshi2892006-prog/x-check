<style>
    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0a8a7a;
        --xc-navy: #1a1a2e;
        --xc-orange: #f97316;
        --xc-purple: #7c3aed;
        --xc-border: #e9edf1;
    }

    .xc-flow-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }

    .xc-flow-head h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 800;
        font-size: 1.2rem;
        color: var(--xc-navy);
        margin: 0;
    }

    .xc-flow-head h4 i { color: var(--xc-teal); }

    .xc-flow-sub { color: #7c8798; font-size: .82rem; margin: 4px 0 0; }

    .xc-scope-select {
        border: 1px solid var(--xc-border);
        border-radius: 8px;
        padding: 8px 12px;
        font-weight: 600;
        color: var(--xc-navy);
        background: #fff;
    }

    .xc-flow-list {
        list-style: none;
        margin: 0;
        padding: 0;
        max-width: 720px;
    }

    .xc-flow-item {
        position: relative;
        display: flex;
        gap: 18px;
        padding-bottom: 26px;
    }

    .xc-flow-item:last-child { padding-bottom: 0; }

    .xc-flow-rail {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }

    .xc-flow-dot {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
        background: #cbd3db;
        z-index: 1;
    }

    .xc-flow-dot.st-locked { background: #cbd3db; }
    .xc-flow-dot.st-not-started { background: #94a0ad; }
    .xc-flow-dot.st-pending { background: linear-gradient(135deg, #f97316, #fb923c); }
    .xc-flow-dot.st-remarked { background: linear-gradient(135deg, #c93a3a, #e05252); }
    .xc-flow-dot.st-approved { background: linear-gradient(135deg, #0fb4a0, #0a8a7a); }

    .xc-flow-line {
        width: 3px;
        flex: 1;
        background: var(--xc-border);
        margin-top: 4px;
    }

    .xc-flow-item.done .xc-flow-line { background: var(--xc-teal); }

    .xc-flow-card {
        flex: 1;
        background: #fff;
        border: 1px solid var(--xc-border);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(20, 40, 60, .04);
        padding: 16px 18px;
    }

    .xc-flow-card.locked { opacity: .55; }

    .xc-flow-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
        flex-wrap: wrap;
    }

    .xc-flow-stage {
        font-weight: 800;
        color: var(--xc-navy);
        font-size: 1rem;
    }

    .xc-flow-member {
        color: #7c8798;
        font-size: .8rem;
        margin-top: 2px;
    }

    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 999px;
        padding: 5px 11px;
        font-size: .74rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .xc-pill-gray { background: #eef1f4; color: #7c8798; }
    .xc-pill-blue { background: #eaf1ff; color: #3766e8; }
    .xc-pill-orange { background: #fff4e0; color: #c98a1c; }
    .xc-pill-red { background: #fde8e8; color: #c93a3a; }
    .xc-pill-green { background: #dcfce7; color: #15803d; }

    .xc-approval-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px dashed var(--xc-border);
        flex-wrap: wrap;
        font-size: .78rem;
        color: #7c8798;
        font-weight: 700;
    }

    .xc-approval-row i { color: var(--xc-purple); }

    .xc-flow-actions {
        margin-top: 12px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .xc-btn-sm {
        border: none;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: .8rem;
        font-weight: 700;
        color: #fff;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-decoration: none;
    }

    .xc-btn-teal { background: var(--xc-teal); }
    .xc-btn-teal:hover { background: var(--xc-teal-dark); color: #fff; }
    .xc-btn-orange { background: var(--xc-orange); }
    .xc-btn-orange:hover { background: #ea670c; color: #fff; }
    .xc-btn-outline {
        background: #f4f6f9;
        color: #4b5768 !important;
    }

    .xc-empty-flow {
        text-align: center;
        padding: 50px 16px;
        color: #94a0ad;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php } ?>

        <div class="xc-flow-head">
            <div>
                <h4><i class="bx bx-git-branch"></i> Layout Process Flow</h4>
                <p class="xc-flow-sub">Architect &rarr; Client/PMC approval &rarr; next consultant, stage by stage.</p>
            </div>

            <div style="display:flex; gap:10px; align-items:center;">
                <?php if (!empty($scopes)) { ?>
                    <select class="xc-scope-select" onchange="window.location='<?= base_url('index.php/employee/layout_process_flow/'); ?>' + this.value">
                        <?php foreach ($scopes as $s) { ?>
                            <option value="<?= (int) $s->customer_id; ?>" <?= $s->customer_id == $customer_id ? 'selected' : ''; ?>>
                                <?= html_escape($s->customer_name ?: ('Client #' . $s->customer_id)); ?>
                            </option>
                        <?php } ?>
                    </select>
                <?php } ?>

                <a href="<?= base_url('index.php/employee/layout_process'); ?>" class="xc-btn-sm xc-btn-outline">
                    <i class="bx bx-list-ul"></i> Table View
                </a>
            </div>
        </div>

        <?php if (empty($flow)) { ?>
            <div class="xc-empty-flow">
                No client selected yet, or no layout flow has started for this client.
            </div>
        <?php } else { ?>
            <ul class="xc-flow-list">
                <?php foreach ($flow as $index => $card) {
                    $state = $card->state;

                    $dot_class = 'st-not-started';
                    $pill_class = 'xc-pill-gray';
                    $icon = 'bx-time-five';

                    if ($state === 'Locked') { $dot_class = 'st-locked'; $pill_class = 'xc-pill-gray'; $icon = 'bx-lock-alt'; }
                    elseif ($state === 'Not Started') { $dot_class = 'st-not-started'; $pill_class = 'xc-pill-gray'; $icon = 'bx-hourglass'; }
                    elseif ($state === 'Pending Review') { $dot_class = 'st-pending'; $pill_class = 'xc-pill-orange'; $icon = 'bx-time-five'; }
                    elseif ($state === 'Remarked') { $dot_class = 'st-remarked'; $pill_class = 'xc-pill-red'; $icon = 'bx-message-square-edit'; }
                    elseif ($state === 'Approved') { $dot_class = 'st-approved'; $pill_class = 'xc-pill-green'; $icon = 'bx-check-double'; }

                    $is_last = $index === count($flow) - 1;
                    $line_done = $state === 'Approved';

                    // Can the person looking at this screen act right now?
                    $can_submit_this_stage = !empty($layout_role) && $layout_role->role === $card->stage && $card->can_submit;
                    $can_review_this_stage = $card->report && in_array($state, ['Pending Review']) && (
                        ($role === 'customer' && $card->report->client_status === 'Pending') ||
                        (!empty($layout_role) && $layout_role->role === 'PMC' && $card->report->pmc_status === 'Pending')
                    );
                ?>
                    <li class="xc-flow-item <?= $line_done ? 'done' : ''; ?>">
                        <div class="xc-flow-rail">
                            <div class="xc-flow-dot <?= $dot_class; ?>"><i class="bx <?= $icon; ?>"></i></div>
                            <?php if (!$is_last) { ?><div class="xc-flow-line"></div><?php } ?>
                        </div>

                        <div class="xc-flow-card <?= $state === 'Locked' ? 'locked' : ''; ?>">
                            <div class="xc-flow-card-top">
                                <div>
                                    <div class="xc-flow-stage"><?= html_escape($card->stage); ?></div>
                                    <div class="xc-flow-member">
                                        <?= $card->member ? html_escape($card->member->member_name) : 'No member assigned yet'; ?>
                                    </div>
                                </div>
                                <span class="xc-pill <?= $pill_class; ?>"><?= html_escape($state); ?></span>
                            </div>

                            <?php if ($card->report) { ?>
                                <div class="xc-approval-row">
                                    <i class="bx bx-right-arrow-alt"></i> Approval &rarr;

                                    <span class="xc-pill <?= $card->report->client_status === 'Approved' ? 'xc-pill-green' : ($card->report->client_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                        Client: <?= html_escape($card->report->client_status); ?>
                                    </span>

                                    <span class="xc-pill <?= $card->report->pmc_status === 'Approved' ? 'xc-pill-green' : ($card->report->pmc_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>">
                                        PMC: <?= html_escape($card->report->pmc_status); ?>
                                    </span>
                                </div>
                            <?php } ?>

                            <div class="xc-flow-actions">
                                <?php if ($card->report) { ?>
                                    <a href="<?= base_url('index.php/employee/layout_process_view/' . $card->report->id); ?>" class="xc-btn-sm xc-btn-outline">
                                        <i class="bx bx-show"></i> View
                                    </a>
                                <?php } ?>

                                <?php if ($can_review_this_stage) { ?>
                                    <a href="<?= base_url('index.php/employee/layout_process_view/' . $card->report->id); ?>" class="xc-btn-sm xc-btn-orange">
                                        <i class="bx bx-message-square-detail"></i> Review Now
                                    </a>
                                <?php } ?>

                                <?php if ($can_submit_this_stage) { ?>
                                    <a href="<?= base_url('index.php/employee/layout_process_add' . ($state === 'Remarked' ? '/' . $card->report->id : '')); ?>" class="xc-btn-sm xc-btn-teal">
                                        <i class="bx bx-upload"></i> <?= $state === 'Remarked' ? 'Resubmit' : 'Submit'; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>