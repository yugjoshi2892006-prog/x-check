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
        gap: 14px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--xc-border);
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

    .xc-card-body {
        padding: 24px;
    }

    .xc-field-label {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
        color: var(--xc-text-muted);
        margin-bottom: 8px;
        display: block;
    }

    .xc-readonly {
        background: #fafbfc !important;
        border: 1px solid var(--xc-border) !important;
        border-radius: 10px !important;
        font-size: .9rem;
        color: #2b3441;
        padding: 10px 14px;
    }

    .xc-readonly:focus {
        box-shadow: none;
    }

    .xc-thumb-lg {
        width: 100%;
        max-width: 220px;
        border-radius: 10px;
        border: 1px solid var(--xc-border);
        margin-top: 8px;
    }

    .xc-file-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .82rem;
        font-weight: 600;
        padding: 9px 16px;
        border-radius: 10px;
        text-decoration: none;
        margin-top: 8px;
        transition: filter .15s ease;
    }

    .xc-file-btn:hover {
        filter: brightness(.94);
    }

    .xc-file-teal {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-file-blue {
        background: #eaf1ff;
        color: #3766e8;
    }

    .xc-dash {
        color: var(--xc-text-muted);
        font-size: .85rem;
    }

    .xc-divider {
        border: none;
        border-top: 1px solid var(--xc-border);
        margin: 8px 0 20px;
    }

    .xc-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f4f6f9;
        color: #4b5768;
        font-weight: 600;
        font-size: .85rem;
        padding: 9px 18px;
        border-radius: 10px;
        text-decoration: none;
        transition: background .15s ease;
    }

    .xc-back-btn:hover {
        background: #eaeef2;
        color: #4b5768;
    }
</style>

<div class="page-wrapper xc-wrapper">
    <div class="page-content">

        <div class="xc-card">

            <div class="xc-card-header">
                <div class="xc-icon-badge">
                    <i class="bx bx-map-alt"></i>
                </div>
                <div>
                    <p class="xc-title">Layout Plan Details</p>
                    <p class="xc-subtitle">Customer requirement, drawing &amp; soil test records</p>
                </div>
            </div>

            <div class="xc-card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="xc-field-label">Customer</label>
                        <input type="text" class="form-control xc-readonly" value="<?= $plan->customer_name; ?>"
                            readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="xc-field-label">Plan Name</label>
                        <input type="text" class="form-control xc-readonly" value="<?= $plan->plan_name; ?>" readonly>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label class="xc-field-label">Requirement</label>
                        <textarea class="form-control xc-readonly" rows="4"
                            readonly><?= $plan->requirement; ?></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="xc-field-label">Drawing</label>
                        <?php if ($plan->drawing_file) { ?>
                            <br>
                            <a class="xc-file-btn xc-file-teal" target="_blank"
                                href="<?= base_url('uploads/layout_plan/drawing/' . $plan->drawing_file); ?>">
                                <i class="bx bx-file"></i> View Drawing
                            </a>
                        <?php } else { ?>
                            <span class="xc-dash">No drawing uploaded</span>
                        <?php } ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="xc-field-label">Layout Photo</label>
                        <?php if ($plan->layout_photo) { ?>
                            <br>
                            <img src="<?= base_url('uploads/layout_plan/photo/' . $plan->layout_photo); ?>"
                                class="xc-thumb-lg">
                        <?php } else { ?>
                            <span class="xc-dash">No photo uploaded</span>
                        <?php } ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="xc-field-label">Soil Test</label>
                        <?php if ($plan->soil_test_pdf) { ?>
                            <br>
                            <a target="_blank" class="xc-file-btn xc-file-blue"
                                href="<?= base_url('uploads/layout_plan/soil/' . $plan->soil_test_pdf); ?>">
                                <i class="bx bxs-file-pdf"></i> View PDF
                            </a>
                        <?php } else { ?>
                            <span class="xc-dash">No soil test uploaded</span>
                        <?php } ?>
                    </div>

                </div>

                <hr class="xc-divider">

                <a href="<?= base_url('layout_member/layout_plan_list'); ?>" class="xc-back-btn">
                    <i class="bx bx-arrow-back"></i> Back
                </a>

            </div>

        </div>

    </div>
</div>
