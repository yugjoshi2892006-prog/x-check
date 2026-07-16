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

                    <button class="xc-btn xc-btn-main" type="submit">Submit</button>
                    <a class="xc-back" href="<?= base_url('employee/layout_process'); ?>">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
