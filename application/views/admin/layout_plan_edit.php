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

    /* editable fields */
    .xc-input,
    .xc-select,
    .xc-textarea {
        border: 1px solid var(--xc-border) !important;
        border-radius: 10px !important;
        font-size: .9rem;
        color: #2b3441;
        padding: 10px 14px;
        background: #fff;
    }

    .xc-input:focus,
    .xc-select:focus,
    .xc-textarea:focus {
        border-color: var(--xc-teal) !important;
        box-shadow: 0 0 0 3px rgba(22, 184, 179, .12) !important;
    }

    /* readonly / auto-filled fields */
    .xc-readonly {
        background: #fafbfc !important;
        border: 1px solid var(--xc-border) !important;
        border-radius: 10px !important;
        font-size: .9rem;
        color: #5a6473;
        padding: 10px 14px;
    }

    .xc-readonly:focus {
        box-shadow: none !important;
        border-color: var(--xc-border) !important;
    }

    /* file inputs */
    .xc-file-input {
        border: 1px dashed var(--xc-border) !important;
        border-radius: 10px !important;
        background: #fafbfc !important;
        font-size: .85rem;
        padding: 8px 12px;
    }

    .xc-file-input::file-selector-button {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: .8rem;
        padding: 6px 12px;
        margin-right: 12px;
        cursor: pointer;
    }

    .xc-file-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: .8rem;
        font-weight: 600;
        color: var(--xc-teal-dark);
        text-decoration: none;
        margin-top: 8px;
    }

    .xc-file-link:hover {
        text-decoration: underline;
        color: var(--xc-teal-dark);
    }

    .xc-thumb-sm {
        width: 100px;
        border-radius: 10px;
        border: 1px solid var(--xc-border);
        margin-top: 8px;
    }

    .xc-btn-row {
        display: flex;
        gap: 10px;
        margin-top: 8px;
    }

    .xc-submit-btn {
        background: var(--xc-teal);
        border: none;
        color: #fff;
        font-weight: 600;
        font-size: .88rem;
        padding: 10px 22px;
        border-radius: 10px;
        transition: background .15s ease;
    }

    .xc-submit-btn:hover {
        background: var(--xc-teal-dark);
        color: #fff;
    }

    .xc-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f4f6f9;
        color: #4b5768;
        font-weight: 600;
        font-size: .88rem;
        padding: 10px 22px;
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
                    <i class="bx bx-edit"></i>
                </div>
                <div>
                    <p class="xc-title">Edit Layout Plan</p>
                    <p class="xc-subtitle">Update customer details, requirement &amp; uploaded files</p>
                </div>
            </div>

            <div class="xc-card-body">

                <form action="<?= base_url('index.php/layout_member/update_layout_plan/' . $plan->id); ?>" method="post"
                    enctype="multipart/form-data">

                    <div class="row">

                        <!-- Customer -->
                        <div class="col-md-6 mb-3">
                            <label class="xc-field-label">Select Customer</label>

                            <select class="form-control xc-select" name="customer_id" id="customer_id" required>

                                <option value="">Select Customer</option>

                                <?php foreach ($customers as $customer) { ?>

                                    <option value="<?= $customer->id; ?>"
                                        <?= ($customer->id == $plan->customer_id) ? 'selected' : ''; ?>>

                                        <?= $customer->name; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <!-- Customer Name -->
                        <div class="col-md-6 mb-3">
                            <label class="xc-field-label">Customer Name</label>

                            <input type="text" id="customer_name" class="form-control xc-readonly"
                                value="<?= $plan->customer_name; ?>" readonly>

                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Email</label>

                            <input type="text" id="customer_email" class="form-control xc-readonly" readonly>

                        </div>

                        <!-- Mobile -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Mobile</label>

                            <input type="text" id="customer_mobile" class="form-control xc-readonly" readonly>

                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Address</label>

                            <input type="text" id="customer_address" class="form-control xc-readonly" readonly>

                        </div>

                        <!-- Plan Name -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Plan Name</label>

                            <input type="text" name="plan_name" class="form-control xc-input"
                                value="<?= $plan->plan_name; ?>" required>

                        </div>

                        <!-- Drawing -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Store Side Drawing</label>

                            <input type="file" name="drawing_file" class="form-control xc-file-input">

                            <?php if ($plan->drawing_file) { ?>

                                <br>

                                <a target="_blank" class="xc-file-link"
                                    href="<?= base_url('uploads/layout_plan/drawing/' . $plan->drawing_file); ?>">

                                    <i class="bx bx-file"></i> View Current Drawing

                                </a>

                            <?php } ?>

                        </div>

                        <!-- Layout Photo -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Site Layout Photo</label>

                            <input type="file" name="layout_photo" class="form-control xc-file-input">

                            <?php if ($plan->layout_photo) { ?>

                                <br>

                                <img src="<?= base_url('uploads/layout_plan/photo/' . $plan->layout_photo); ?>"
                                    class="xc-thumb-sm">

                            <?php } ?>

                        </div>

                        <!-- Soil -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-field-label">Soil Test PDF</label>

                            <input type="file" name="soil_test_pdf" class="form-control xc-file-input">

                            <?php if ($plan->soil_test_pdf) { ?>

                                <br>

                                <a target="_blank" class="xc-file-link"
                                    href="<?= base_url('uploads/layout_plan/soil/' . $plan->soil_test_pdf); ?>">

                                    <i class="bx bxs-file-pdf"></i> View Current PDF

                                </a>

                            <?php } ?>

                        </div>

                        <!-- Requirement -->

                        <div class="col-md-12 mb-3">

                            <label class="xc-field-label">Requirement</label>

                            <textarea name="requirement" rows="5"
                                class="form-control xc-textarea"><?= $plan->requirement; ?></textarea>

                        </div>

                    </div>

                    <div class="xc-btn-row">

                        <button class="xc-submit-btn">
                            Update Layout Plan
                        </button>

                        <a href="<?= base_url('index.php/layout_member/layout_plan_list'); ?>" class="xc-back-btn">
                            <i class="bx bx-arrow-back"></i> Back
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

<script>

    $(document).ready(function () {

        loadCustomer();

    });

    $("#customer_id").change(function () {

        loadCustomer();

    });

    function loadCustomer() {

        $.ajax({

            url: "<?= base_url('index.php/layout_member/get_customer_details'); ?>",

            type: "POST",

            data: {
                customer_id: $("#customer_id").val()
            },

            dataType: "json",

            success: function (res) {

                $("#customer_name").val(res.name);

                $("#customer_email").val(res.email);

                $("#customer_mobile").val(res.mobile);

                $("#customer_address").val(res.address);

            }

        });

    }

</script>