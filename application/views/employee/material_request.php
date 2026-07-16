<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h4 class="mb-1" style="color:#1a1a2e; font-weight:700;">Material Report</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="<?= base_url('employee/dashboard') ?>"
                                style="color:#0fb4a0; text-decoration:none;">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color:#6c757d;">Material Report
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Request Form Card -->
        <div class="xc-card mb-4">
            <div class="xc-card-header">
                <i class="bx bx-package"></i>
                <span>Submit Material REPORT</span>
            </div>

            <div class="xc-card-body">

                <form method="post" action="<?= base_url('employee/save_material_request') ?>">

                    <input type="hidden" name="project_id" value="<?= htmlspecialchars($project_id) ?>">

                    <div class="row">

                        <!-- Category -->
                        <div class="col-md-6 mb-3">
                            <label class="xc-label">Category</label>

                            <select class="xc-select" name="category_id" id="category" required>

                                <option value="">Select Category</option>

                                <?php foreach ($categories as $cat) { ?>

                                    <option value="<?= htmlspecialchars($cat->id) ?>">
                                        <?= htmlspecialchars($cat->category_name) ?>
                                    </option>

                                <?php } ?>

                            </select>

                        </div>


                        <!-- Sub Category -->
                        <div class="col-md-6 mb-3">

                            <label class="xc-label">Sub Category</label>

                            <select class="xc-select" name="subcategory_id" id="subcategory" required>
                                <option value="">Select Sub Category</option>
                            </select>

                        </div>


                        <!-- Material -->

                        <!-- <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Material
                            </label>

                            <select class="form-control" name="material_id" id="material" required>

                                <option value="">
                                    Select Material
                                </option>

                            </select>

                        </div> -->


                        <!-- Quantity -->
                        <div class="col-md-3 mb-3">
                            <label class="xc-label">Quantity</label>
                            <input type="number" step="0.01" class="xc-input" name="quantity" required>
                        </div>


                        <!-- Unit -->
                        <div class="col-md-3 mb-3">
                            <label class="xc-label">Unit</label>
                            <input type="text" class="xc-input" name="unit" placeholder="KG / Liter / Nos / Bag"
                                required>
                        </div>


                        <!-- Remarks -->
                        <div class="col-md-12 mb-3">
                            <label class="xc-label">Remarks</label>
                            <textarea class="xc-input" rows="3" name="remarks"
                                placeholder="Write remarks..."></textarea>
                        </div>


                        <div class="col-md-12 text-end">
                            <button class="xc-btn-primary" type="submit">
                                <i class="bx bx-send"></i>
                                Submit Report
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>


        <!-- Request History -->
        <div class="xc-card">

            <div class="xc-card-header">
                <i class="bx bx-history"></i>
                <span>Report History</span>
            </div>

            <div class="xc-card-body">

                <div class="table-responsive">
                    <table class="xc-table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Material</th>
                                <th>Sub Category</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($requests)) { ?>

                                <?php $i = 1;
                                foreach ($requests as $row) { ?>

                                    <tr>

                                        <td><?= $i++ ?></td>

                                        <td><?= htmlspecialchars($row->category_name) ?></td>

                                        <td><?= htmlspecialchars($row->subcategory_name) ?></td>

                                        <td><?= htmlspecialchars($row->quantity) ?></td>

                                        <td><?= htmlspecialchars($row->unit) ?></td>

                                        <td>
                                            <?php if ($row->status == 'Pending') { ?>
                                                <span class="xc-pill xc-pill-warning">Pending</span>
                                            <?php } elseif ($row->status == 'Approved') { ?>
                                                <span class="xc-pill xc-pill-success">Approved</span>
                                            <?php } else { ?>
                                                <span class="xc-pill xc-pill-danger">Rejected</span>
                                            <?php } ?>
                                        </td>

                                        <td><?= htmlspecialchars(date('d-m-Y', strtotime($row->created_at))) ?></td>

                                        <td>

                                            <?php if ($row->status == 'Pending') { ?>

                                                <a href="<?= base_url('employee/delete_material_request/' . $row->id . '/' . $project_id) ?>"
                                                    class="xc-btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this request?')">

                                                    <i class="bx bx-trash"></i> Delete

                                                </a>

                                            <?php } else { ?>

                                                <span class="text-muted">--</span>

                                            <?php } ?>

                                        </td>

                                    </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="8" class="text-center xc-empty-row">
                                        <i class="bx bx-package" style="font-size: 28px; opacity:.4;"></i>
                                        <div>No Material Report Found</div>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

        <style>
            /* ===== X-CHECK Teal/Navy Card ===== */
            .xc-card {
                background: #ffffff;
                border-radius: 14px;
                box-shadow: 0 2px 10px rgba(26, 26, 46, 0.06);
                border: 1px solid #eef1f4;
                overflow: hidden;
            }

            .xc-card-header {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 16px 20px;
                background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
                color: #ffffff;
                font-weight: 600;
                font-size: 15px;
            }

            .xc-card-header i {
                font-size: 18px;
            }

            .xc-card-body {
                padding: 22px;
            }

            /* ===== Form Controls ===== */
            .xc-label {
                display: block;
                font-size: 13px;
                font-weight: 600;
                color: #1a1a2e;
                margin-bottom: 6px;
            }

            .xc-input,
            .xc-select {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #e0e4e8;
                border-radius: 8px;
                font-size: 14px;
                color: #1a1a2e;
                background: #fbfcfd;
                transition: border-color .2s, box-shadow .2s;
            }

            .xc-input:focus,
            .xc-select:focus {
                outline: none;
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.15);
                background: #ffffff;
            }

            textarea.xc-input {
                resize: vertical;
            }

            /* ===== Buttons ===== */
            .xc-btn-primary {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
                color: #ffffff;
                border: none;
                padding: 10px 22px;
                border-radius: 8px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                transition: opacity .2s, transform .15s;
            }

            .xc-btn-primary:hover {
                opacity: 0.9;
                transform: translateY(-1px);
                color: #ffffff;
            }

            .xc-btn-outline-danger {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                background: #ffffff;
                color: #dc3545;
                border: 1px solid #dc3545;
                padding: 5px 12px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                transition: background .2s, color .2s;
            }

            .xc-btn-outline-danger:hover {
                background: #dc3545;
                color: #ffffff;
            }

            /* ===== Table ===== */
            .xc-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .xc-table thead,
            .xc-table thead tr {
                background-color: #0fb4a0 !important;
            }

            .xc-table thead th {
                color: #ffffff !important;
                font-weight: 600;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 0.3px;
                padding: 12px 14px;
                border: none !important;
                white-space: nowrap;
            }

            .xc-table thead th:first-child {
                border-top-left-radius: 8px;
            }

            .xc-table thead th:last-child {
                border-top-right-radius: 8px;
            }

            .xc-table tbody td {
                padding: 12px 14px;
                font-size: 14px;
                color: #1a1a2e;
                border-bottom: 1px solid #f0f2f4;
                vertical-align: middle;
            }

            .xc-table tbody tr:hover {
                background-color: #f7fdfc;
            }

            .xc-empty-row {
                padding: 30px 14px !important;
                color: #9aa3ad;
                font-size: 14px;
            }

            /* ===== Pills ===== */
            .xc-pill {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 50px;
                font-size: 12px;
                font-weight: 600;
            }

            .xc-pill-warning {
                background: #fff3cd;
                color: #92720c;
            }

            .xc-pill-success {
                background: #d4f4ec;
                color: #0d9c8a;
            }

            .xc-pill-danger {
                background: #fde2e4;
                color: #c0293a;
            }
        </style>

        <script>

            $(document).ready(function () {

                $('#category').change(function () {

                    var category_id = $(this).val();

                    if (category_id == '') {
                        $('#subcategory').html('<option value="">Select Sub Category</option>');
                        return;
                    }

                    $.ajax({

                        url: "<?= base_url('employee/get_subcategories'); ?>",

                        type: "POST",

                        data: { category_id: category_id },

                        dataType: "json",

                        success: function (response) {

                            var html = '<option value="">Select Sub Category</option>';

                            $.each(response, function (i, row) {

                                html += '<option value="' + row.id + '">' + row.subcategory_name + '</option>';

                            });

                            $('#subcategory').html(html);

                        }

                    });

                });

            });

        </script>
    </div>
</div>
