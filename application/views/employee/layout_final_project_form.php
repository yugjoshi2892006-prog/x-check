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
                <p class="xc-title">Add Final Project</p>
                <p class="xc-subtitle">Client &amp; PMC have approved the layout. Save this to hand the flow off to
                    Structural.</p>
            </div>

            <div class="xc-card-body">
                <div class="alert alert-success">
                    Architect stage approved for <strong>
                        <?= html_escape($customer->name); ?>
                    </strong>
                    (
                    <?= html_escape($architect_report->plan_title); ?>). Fill this in and submit to send it to the
                    Structure Consultant.
                </div>

                <form action="<?= base_url('employee/save_layout_final_project/' . (int) $architect_report->id); ?>" method="post"
                    enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Client Name</label>
                            <div class="xc-readonly-box">
                                <?= html_escape($customer->name); ?>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Your Name</label>
                            <div class="xc-readonly-box">
                                <?= html_escape($layout_role->member_name); ?>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="xc-label">Project Name</label>
                            <input type="text" name="project_name" class="form-control xc-input" required
                                value="<?= html_escape($architect_report->plan_title); ?>">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="xc-label">Final Documents (PDF)</label>
                            <input type="file" name="final_doc" class="form-control xc-input"
                                accept="application/pdf,.pdf" required>
                            <small class="text-muted">Only PDF files are accepted.</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="xc-label">Notes</label>
                            <textarea name="notes" class="form-control xc-input" rows="4"
                                placeholder="Anything the Structure Consultant should know"></textarea>
                        </div>
                    </div>

                    <button class="xc-btn xc-btn-main" type="submit">Save &amp; Send to Structural</button>
                    <a class="xc-back" href="<?= base_url('employee/layout_process'); ?>">
                        <i class="bx bx-arrow-back"></i> Back
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
