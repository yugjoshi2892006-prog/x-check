<style>
    .xc-emr-wrap {
        padding: 24px;
    }

    .xc-emr-breadcrumb {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 16px;
    }

    .xc-emr-breadcrumb span {
        color: #1a1a2e;
        font-weight: 600;
    }

    .xc-emr-card {
        background: #ffffff;
        border: 1px solid #e4e6ea;
        border-radius: 10px;
        margin-bottom: 24px;
        overflow: hidden;
    }

    .xc-emr-card-header {
        background-color: #1a1a2e;
        padding: 14px 20px;
    }

    .xc-emr-card-header.xc-emr-header-warning {
        background-color: #0d9c8a;
    }

    .xc-emr-card-header h4,
    .xc-emr-card-header h5 {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
    }

    .xc-emr-card-body {
        padding: 20px;
    }

    .xc-emr-section-title {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 18px;
    }

    .xc-emr-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
    }

    .xc-emr-row:last-child {
        margin-bottom: 0;
    }

    .xc-emr-col-6 {
        flex: 1 1 280px;
    }

    .xc-emr-col-4 {
        flex: 1 1 220px;
    }

    .xc-emr-col-3 {
        flex: 1 1 180px;
    }

    .xc-emr-col-2 {
        flex: 1 1 140px;
    }

    .xc-emr-col-12 {
        flex: 1 1 100%;
    }

    .xc-emr-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 6px;
    }

    .xc-emr-group .form-control {
        border: 1px solid #e4e6ea;
        border-radius: 6px;
        padding: 9px 12px;
        font-size: 14px;
        width: 100%;
        height: auto;
        color: #1a1a2e;
        background-color: #ffffff;
        transition: border-color .15s ease;
    }

    .xc-emr-group .form-control:focus {
        outline: none;
        border-color: #0fb4a0;
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.12);
    }

    .xc-emr-group textarea.form-control {
        resize: vertical;
    }

    .xc-emr-group input[type="file"].form-control {
        padding: 7px 12px;
    }

    .xc-emr-divider {
        border: none;
        border-top: 1px solid #e4e6ea;
        margin: 28px 0;
    }

    .xc-emr-other-block {
        background-color: #f4fbfa;
        border: 1px solid #d6f0eb;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 16px;
    }

    .xc-emr-submit-row {
        text-align: right;
        margin-bottom: 28px;
    }

    .xc-emr-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #0fb4a0;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 11px 22px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color .15s ease;
    }

    .xc-emr-btn-save:hover {
        background-color: #0d9c8a;
    }

    .xc-emr-table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .xc-emr-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .xc-emr-table thead,
    .xc-emr-table thead tr {
        background-color: #0fb4a0 !important;
    }

    .xc-emr-table thead th {
        color: #ffffff !important;
        padding: 12px 14px;
        font-weight: 600;
        text-align: left;
        white-space: nowrap;
        border: none;
    }

    .xc-emr-table tbody td {
        padding: 11px 14px;
        border-bottom: 1px solid #e4e6ea;
        color: #1a1a2e;
        vertical-align: middle;
        white-space: nowrap;
    }

    .xc-emr-table tbody tr:hover {
        background-color: #f4fbfa;
    }

    .xc-emr-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-emr-btn-pdf {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border: 1px solid #0fb4a0;
        color: #0fb4a0;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 5px;
        text-decoration: none;
        transition: all .15s ease;
    }

    .xc-emr-btn-pdf:hover {
        background-color: #0fb4a0;
        color: #ffffff;
    }

    /* ---------- Tablet (≤ 991px) ---------- */
    @media (max-width: 991px) {
        .xc-emr-wrap {
            padding: 18px;
        }

        .xc-emr-col-6 {
            flex: 1 1 calc(50% - 8px);
        }

        .xc-emr-col-4,
        .xc-emr-col-3 {
            flex: 1 1 calc(33.333% - 11px);
        }

        .xc-emr-col-2 {
            flex: 1 1 calc(50% - 8px);
        }
    }

    /* ---------- Mobile (≤ 600px) ---------- */
    @media (max-width: 600px) {
        .xc-emr-wrap {
            padding: 12px;
        }

        .xc-emr-breadcrumb {
            font-size: 12px;
            margin-bottom: 12px;
        }

        .xc-emr-card {
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .xc-emr-card-header {
            padding: 12px 16px;
        }

        .xc-emr-card-header h4 {
            font-size: 15px;
        }

        .xc-emr-card-header h5 {
            font-size: 14px;
        }

        .xc-emr-card-body {
            padding: 14px;
        }

        .xc-emr-section-title {
            font-size: 14px;
            margin-bottom: 14px;
        }

        .xc-emr-row {
            gap: 12px;
            margin-bottom: 12px;
        }

        /* All fields stack full-width on phones */
        .xc-emr-col-6,
        .xc-emr-col-4,
        .xc-emr-col-3,
        .xc-emr-col-2,
        .xc-emr-col-12 {
            flex: 1 1 100%;
        }

        .xc-emr-group label {
            font-size: 12.5px;
        }

        .xc-emr-group .form-control {
            font-size: 16px;
            /* prevents iOS auto-zoom on focus */
            padding: 10px 12px;
        }

        .xc-emr-divider {
            margin: 20px 0;
        }

        .xc-emr-other-block {
            padding: 14px;
        }

        .xc-emr-submit-row {
            text-align: center;
            position: sticky;
            bottom: 0;
            background: linear-gradient(to top, #ffffff 70%, rgba(255, 255, 255, 0));
            padding: 10px 0 4px;
            margin-bottom: 16px;
            z-index: 2;
        }

        .xc-emr-btn-save {
            width: 100%;
            justify-content: center;
            padding: 13px 18px;
            font-size: 15px;
        }

        .xc-emr-table {
            font-size: 13px;
        }

        .xc-emr-table thead th,
        .xc-emr-table tbody td {
            padding: 9px 10px;
        }

        .xc-emr-btn-pdf {
            padding: 6px 10px;
            font-size: 11.5px;
        }
    }

    /* ---------- Small phones (≤ 380px) ---------- */
    @media (max-width: 380px) {
        .xc-emr-wrap {
            padding: 8px;
        }

        .xc-emr-card-body {
            padding: 12px;
        }

        .xc-emr-table {
            font-size: 12px;
        }
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        <form action="<?= base_url('index.php/employee/save_material_report'); ?>" method="post"
            enctype="multipart/form-data">

            <input type="hidden" name="project_id" value="<?= $project_id ?>">

            <div class="xc-emr-wrap">

                <div class="xc-emr-breadcrumb">
                    Materials &rsaquo; <span>Materials Report</span>
                </div>

                <div class="xc-emr-card">

                    <div class="xc-emr-card-header">
                        <h4>Materials Report</h4>
                    </div>

                    <div class="xc-emr-card-body">

                        <p class="xc-emr-section-title">Existing Material At Site</p>

                        <div class="xc-emr-row">

                            <div class="xc-emr-col-6 xc-emr-group">

                                <label><b>Material</b></label>

                                <select class="form-control" id="material_select" name="material_id">

                                    <option value="">Select Material</option>

                                    <?php foreach ($materials as $m) { ?>

                                        <option value="<?= $m->subcategory_id; ?>" data-category="<?= $m->category_name; ?>"
                                            data-brand="<?= $m->subcategory_name; ?>">

                                            <?= $m->category_name; ?> - <?= $m->subcategory_name; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <!-- <div class="col-md-3">

                    <label><b>Category</b></label>

                    <input type="text" id="category_name" class="form-control" readonly>

                </div>

                <div class="col-md-3">

                    <label><b>Brand</b></label>

                    <input type="text" id="brand_name" class="form-control" readonly>

                </div> -->

                        </div>

                        <div class="xc-emr-row">

                            <div class="xc-emr-col-4 xc-emr-group">

                                <label><b>Material Photo</b></label>

                                <input type="file" class="form-control" name="site_photo" accept=".pdf">

                            </div>

                            <div class="xc-emr-col-2 xc-emr-group">

                                <label><b>Quantity</b></label>

                                <input type="number" class="form-control" name="site_quantity">

                            </div>

                            <div class="xc-emr-col-2 xc-emr-group">

                                <label><b>Unit</b></label>

                                <input type="text" class="form-control" name="site_unit">

                            </div>

                            <div class="xc-emr-col-2 xc-emr-group">

                                <label><b>Size</b></label>

                                <input type="text" class="form-control" name="site_size">

                            </div>

                        </div>

                        <!-- Existing Material Remark -->

                        <div class="xc-emr-row">

                            <div class="xc-emr-col-12 xc-emr-group">

                                <label><b>Remark</b></label>

                                <textarea name="site_remark" class="form-control" rows="3" placeholder=""></textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <hr class="xc-emr-divider">

                <div class="xc-emr-card">

                    <div class="xc-emr-card-header xc-emr-header-warning">
                        <h5>New Material (Invoice / Challan)</h5>
                    </div>

                    <div class="xc-emr-card-body">

                        <div class="xc-emr-row">

                            <div class="xc-emr-col-6 xc-emr-group">

                                <label><b>Material</b></label>

                                <select class="form-control" id="invoice_material" name="invoice_material">

                                    <option value="">Select Material</option>

                                    <?php foreach ($materials as $m) { ?>

                                        <option value="<?= $m->subcategory_id; ?>" data-category="<?= $m->category_name; ?>"
                                            data-brand="<?= $m->subcategory_name; ?>">

                                            <?= $m->category_name; ?> - <?= $m->subcategory_name; ?>

                                        </option>

                                    <?php } ?>

                                    <option value="other">Other</option>

                                </select>

                            </div>

                            <div class="xc-emr-col-3 xc-emr-group">

                                <label><b>Invoice Date</b></label>

                                <input type="date" class="form-control" name="invoice_date"
                                    value="<?= date('Y-m-d'); ?>">

                            </div>

                        </div>

                        <!-- <div class="col-md-4" id="invoice_category_div">

                <label><b>Category</b></label>

                <input type="text" id="invoice_category" class="form-control" readonly>

            </div>

            <div class="col-md-4" id="invoice_brand_div">

                <label><b>Brand</b></label>

                <input type="text" id="invoice_brand" class="form-control" readonly>

            </div> -->

                        <div class="xc-emr-row xc-emr-other-block" id="other_brand_div" style="display:none;">

                            <div class="xc-emr-col-6 xc-emr-group">

                                <label><b>Other Brand Name</b></label>

                                <input type="text" name="other_brand" class="form-control">

                            </div>

                            <div class="xc-emr-col-6 xc-emr-group">

                                <label><b>Remarks</b></label>

                                <textarea name="remarks" rows="2" class="form-control"
                                    placeholder="Why is another brand being used?"></textarea>

                            </div>

                        </div>

                        <div class="xc-emr-row">

                            <div class="xc-emr-col-4 xc-emr-group">

                                <label><b>Invoice / Challan Photo</b></label>

                                <input type="file" class="form-control" name="invoice_photo" accept=".pdf">

                            </div>

                            <div class="xc-emr-col-2 xc-emr-group">

                                <label><b>Quantity</b></label>

                                <input type="number" class="form-control" name="invoice_quantity">

                            </div>

                            <div class="xc-emr-col-2 xc-emr-group">

                                <label><b>Unit</b></label>

                                <input type="text" class="form-control" name="invoice_unit">

                            </div>

                            <div class="xc-emr-col-2 xc-emr-group">

                                <label><b>Size</b></label>

                                <input type="text" class="form-control" name="invoice_size">

                            </div>

                        </div>

                    </div>

                </div>

                <div class="xc-emr-submit-row">

                    <button type="submit" class="xc-emr-btn-save">

                        <i class="bx bx-save"></i>

                        Save Materials Report

                    </button>

                </div>

                <div class="xc-emr-card">

                    <div class="xc-emr-card-header">
                        <h5>Existing Material History</h5>
                    </div>

                    <div class="xc-emr-card-body">

                        <div class="xc-emr-table-wrap">

                            <table class="xc-emr-table">

                                <thead>

                                    <tr>

                                        <th>Cycle date </th>
                                        <th>Material</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Size</th>
                                        <th>Remark</th>
                                        <th>Photo</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php foreach ($reports as $r) { ?>

                                        <tr>

                                            <td>

                                                <?= date('d-m-Y', strtotime($r->attendance_date)); ?>

                                            </td>

                                            <td>
                                                <?= $r->subcategory_name ?>
                                            </td>

                                            <td>
                                                <?= $r->site_quantity ?>
                                            </td>

                                            <td>
                                                <?= $r->site_unit ?>
                                            </td>

                                            <td>
                                                <?= $r->site_size ?>
                                            </td>

                                            <td>
                                                <?= $r->site_remark ?>
                                            </td>

                                            <td>

                                                <?php if ($r->site_photo != '') { ?>

                                                    <a href="<?= base_url('uploads/materials/' . $r->site_photo) ?>"
                                                        target="_blank" class="xc-emr-btn-pdf">

                                                        PDF

                                                    </a>

                                                <?php } else { ?>

                                                    -

                                                <?php } ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <div class="xc-emr-card">

                    <div class="xc-emr-card-header xc-emr-header-warning">
                        <h5>Invoice / Challan History</h5>
                    </div>

                    <div class="xc-emr-card-body">

                        <div class="xc-emr-table-wrap">

                            <table class="xc-emr-table">

                                <thead>

                                    <tr>

                                        <th>Cycle date </th>
                                        <th>Invoice Date</th>
                                        <th>Material</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Size</th>
                                        <th>Photo</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php foreach ($reports as $r) { ?>

                                        <tr>

                                            <td>

                                                <?= date('d-m-Y', strtotime($r->attendance_date)); ?>

                                            </td>

                                            <td>
                                                <?= date('d-m-Y', strtotime($r->invoice_date)) ?>
                                            </td>

                                            <td>
                                                <?= $r->subcategory_name ?>
                                            </td>

                                            <td>
                                                <?= $r->invoice_quantity ?>
                                            </td>

                                            <td>
                                                <?= $r->invoice_unit ?>
                                            </td>

                                            <td>
                                                <?= $r->invoice_size ?>
                                            </td>

                                            <td>

                                                <?php if ($r->invoice_photo != '') { ?>

                                                    <a href="<?= base_url('uploads/materials/' . $r->invoice_photo) ?>"
                                                        target="_blank" class="xc-emr-btn-pdf">

                                                        PDF

                                                    </a>

                                                <?php } else { ?>

                                                    -

                                                <?php } ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>
<script>

    $('#invoice_material').change(function () {

        var value = $(this).val();

        if (value == 'other') {

            $('#invoice_category_div').hide();
            $('#invoice_brand_div').hide();

            $('#other_brand_div').slideDown();

            $('#invoice_category').val('');
            $('#invoice_brand').val('');

        } else {

            $('#invoice_category_div').show();
            $('#invoice_brand_div').show();

            $('#other_brand_div').slideUp();

            var option = $(this).find(':selected');

            $('#invoice_category').val(option.data('category'));
            $('#invoice_brand').val(option.data('brand'));
        }

    });


    $('#material_select').change(function () {

        var option = $(this).find(':selected');

        $('#category_name').val(option.data('category'));

        $('#brand_name').val(option.data('brand'));

    });

</script>