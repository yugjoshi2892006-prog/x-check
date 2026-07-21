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

    .xc-subtitle {
        margin: 4px 0 0;
        color: #7c8798;
        font-size: 13px;
    }

    .xc-label {
        color: #7c8798;
        display: block;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .04em;
        margin-bottom: 8px;
        text-transform: uppercase;
    }

    .xc-input {
        border: 1px solid #e9edf1 !important;
        border-radius: 10px !important;
        padding: 10px 13px;
    }

    .xc-input:focus {
        border-color: #16b8b3 !important;
        box-shadow: 0 0 0 3px rgba(22, 184, 179, .12) !important;
    }

    .xc-readonly-box {
        border: 1px solid #e9edf1;
        border-radius: 10px;
        padding: 10px 13px;
        background: #fafbfc;
        color: #2b3441;
        font-weight: 700;
    }

    .xc-btn {
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 800;
    }

    .xc-btn-main {
        background: #16b8b3;
        color: #fff;
    }

    .xc-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f4f6f9;
        color: #4b5768;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 800;
        text-decoration: none;
    }

    /* ---- Reviewer picker (Main / Suggestion) ---- */
    .xc-rev-panel {
        border: 1px solid #e9edf1;
        border-radius: 12px;
        padding: 16px;
        height: 100%;
        background: #fbfcfd;
    }

    .xc-rev-panel-head {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
    }

    .xc-rev-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .xc-rev-panel.is-main .xc-rev-icon {
        background: rgba(22, 184, 179, .12);
        color: #0f948f;
    }

    .xc-rev-panel.is-suggestion .xc-rev-icon {
        background: rgba(124, 135, 152, .14);
        color: #5b6472;
    }

    .xc-rev-panel-title {
        margin: 0;
        font-size: 13.5px;
        font-weight: 800;
        color: #1f2937;
    }

    .xc-rev-badge {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .03em;
        text-transform: uppercase;
        padding: 3px 8px;
        border-radius: 20px;
        margin-left: auto;
    }

    .xc-rev-panel.is-main .xc-rev-badge {
        background: rgba(22, 184, 179, .12);
        color: #0f948f;
    }

    .xc-rev-panel.is-suggestion .xc-rev-badge {
        background: rgba(124, 135, 152, .14);
        color: #4b5768;
    }

    .xc-rev-hint {
        margin: 4px 0 12px;
        font-size: 12px;
        color: #8b95a3;
        line-height: 1.4;
    }

    .xc-rev-list {
        max-height: 230px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding-right: 2px;
    }

    .xc-rev-list::-webkit-scrollbar {
        width: 6px;
    }

    .xc-rev-list::-webkit-scrollbar-thumb {
        background: #dbe1e8;
        border-radius: 10px;
    }

    .xc-rev-empty {
        font-size: 12.5px;
        color: #9aa4b2;
        padding: 10px 2px;
    }

    .xc-rev-chip {
        position: relative;
        display: block;
    }

    .xc-rev-chip input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .xc-rev-chip label {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1.5px solid #e9edf1;
        background: #fff;
        border-radius: 10px;
        padding: 9px 12px;
        cursor: pointer;
        margin: 0;
        transition: border-color .15s ease, background .15s ease;
    }

    .xc-rev-chip label:hover {
        border-color: #c9d2db;
    }

    .xc-rev-chip .xc-rev-check {
        width: 17px;
        height: 17px;
        border-radius: 5px;
        border: 1.5px solid #c9d2db;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 11px;
        transition: all .15s ease;
    }

    .xc-rev-chip .xc-rev-name {
        font-size: 13px;
        font-weight: 700;
        color: #2b3441;
    }

    .xc-rev-chip .xc-rev-role {
        font-size: 11.5px;
        color: #9aa4b2;
        font-weight: 500;
    }

    .xc-rev-panel.is-main .xc-rev-chip input:checked+label {
        border-color: #16b8b3;
        background: rgba(22, 184, 179, .06);
    }

    .xc-rev-panel.is-main .xc-rev-chip input:checked+label .xc-rev-check {
        background: #16b8b3;
        border-color: #16b8b3;
    }

    .xc-rev-panel.is-suggestion .xc-rev-chip input:checked+label {
        border-color: #7c8798;
        background: rgba(124, 135, 152, .08);
    }

    .xc-rev-panel.is-suggestion .xc-rev-chip input:checked+label .xc-rev-check {
        background: #7c8798;
        border-color: #7c8798;
    }

    .xc-rev-chip input:checked+label .xc-rev-check::after {
        content: "\2713";
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-card">
            <div class="xc-card-header">
                <p class="xc-title"><?= !empty($parent_report) ? 'Resubmit Layout Plan' : 'Add Layout Plan'; ?></p>
                <p class="xc-subtitle">Client, your name, plan and dates</p>
            </div>

            <div class="xc-card-body">
                <?php if (!empty($parent_report) && ($parent_report->client_remark || $parent_report->pmc_remark)) { ?>
                    <div class="alert alert-warning">
                        Previous remark:
                        <?= html_escape($parent_report->client_remark ?: $parent_report->pmc_remark); ?>
                    </div>
                <?php } ?>

                <form action="<?= base_url('employee/save_layout_process'); ?>" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="parent_report_id"
                        value="<?= !empty($parent_report) ? (int) $parent_report->id : 0; ?>">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Client Name</label>
                            <div class="xc-readonly-box"><?= html_escape($customer->name); ?></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Your Name</label>
                            <div class="xc-readonly-box"><?= html_escape($layout_role->member_name); ?></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Select Plan Name</label>
                            <?php if (!empty($plans)) { ?>
                                <select name="layout_name" class="form-control xc-input" required>
                                    <option value="">-- Select a Layout Plan --</option>
                                    <?php foreach ($plans as $plan) { ?>
                                        <option value="<?= html_escape($plan->plan_name); ?>"
                                            <?= (!empty($parent_report) && $parent_report->plan_title === $plan->plan_name) ? 'selected' : ''; ?>>
                                            <?= html_escape($plan->plan_name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small class="text-muted">Pick from the Layout Plans already added for this
                                    client.</small>
                            <?php } else { ?>
                                <input type="text" name="layout_name" class="form-control xc-input" required
                                    value="<?= !empty($parent_report) ? html_escape($parent_report->plan_title) : ''; ?>">
                                <small class="text-danger">No Layout Plans found for this client yet — type a name,
                                    or add one under Layout Plan first.</small>
                            <?php } ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control xc-input" required
                                value="<?= !empty($parent_report) ? $parent_report->start_date : ''; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="xc-label">End Date</label>
                            <input type="date" name="end_date" class="form-control xc-input" required
                                value="<?= !empty($parent_report) ? $parent_report->end_date : ''; ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Layout Plan (PDF)</label>
                            <input type="file" name="layout_doc" class="form-control xc-input"
                                accept="application/pdf,.pdf" required>
                            <small class="text-muted">Only PDF files are accepted.</small>
                        </div>
                    </div>

                    <?php if (!empty($selectable_reviewers)) { ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="xc-rev-panel is-main">
                                    <div class="xc-rev-panel-head">
                                        <div class="xc-rev-icon"><i class="bx bx-shield-quarter"></i></div>
                                        <p class="xc-rev-panel-title">Add More Member</p>
                                        <span class="xc-rev-badge">Mandatory</span>
                                    </div>
                                    <p class="xc-rev-hint">Selected members must also Approve or Remark - the
                                        submission stays Pending until they respond.</p>
                                    <div class="xc-rev-list">
                                        <?php foreach ($selectable_reviewers as $rev) { ?>
                                            <div class="xc-rev-chip">
                                                <input type="checkbox" name="main_members[]"
                                                    value="<?= (int) $rev->id; ?>" id="main_<?= (int) $rev->id; ?>">
                                                <label for="main_<?= (int) $rev->id; ?>">
                                                    <span class="xc-rev-check"></span>
                                                    <span>
                                                        <span class="xc-rev-name"><?= html_escape($rev->member_name); ?></span><br>
                                                        <span class="xc-rev-role"><?= html_escape($rev->role); ?></span>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="xc-rev-panel is-suggestion">
                                    <div class="xc-rev-panel-head">
                                        <div class="xc-rev-icon"><i class="bx bx-comment-dots"></i></div>
                                        <p class="xc-rev-panel-title">Suggestion Member</p>
                                        <span class="xc-rev-badge">Optional</span>
                                    </div>
                                    <p class="xc-rev-hint">Selected members can only view this submission and leave a
                                        comment - it never blocks or changes approval.</p>
                                    <div class="xc-rev-list">
                                        <?php foreach ($selectable_reviewers as $rev) { ?>
                                            <div class="xc-rev-chip">
                                                <input type="checkbox" name="suggestion_members[]"
                                                    value="<?= (int) $rev->id; ?>" id="sugg_<?= (int) $rev->id; ?>">
                                                <label for="sugg_<?= (int) $rev->id; ?>">
                                                    <span class="xc-rev-check"></span>
                                                    <span>
                                                        <span class="xc-rev-name"><?= html_escape($rev->member_name); ?></span><br>
                                                        <span class="xc-rev-role"><?= html_escape($rev->role); ?></span>
                                                    </span>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <button class="xc-btn xc-btn-main" type="submit">Submit</button>
                    <a class="xc-back" href="<?= base_url('employee/layout_process'); ?>">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // A member can only be one thing per submission - ticking them as a
    // Mandatory ("Main") reviewer un-ticks them from the optional
    // ("Suggestion") list, and vice-versa.
    document.querySelectorAll('.xc-rev-panel.is-main input[type=checkbox]').forEach(function (box) {
        box.addEventListener('change', function () {
            if (this.checked) {
                var pair = document.getElementById('sugg_' + this.value);
                if (pair) pair.checked = false;
            }
        });
    });

    document.querySelectorAll('.xc-rev-panel.is-suggestion input[type=checkbox]').forEach(function (box) {
        box.addEventListener('change', function () {
            if (this.checked) {
                var pair = document.getElementById('main_' + this.value);
                if (pair) pair.checked = false;
            }
        });
    });
</script>
