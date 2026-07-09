<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="xc-section-title mb-0">
                Manpower Details
            </h5>

            <button type="button" class="xc-btn-add" data-bs-toggle="modal" data-bs-target="#contractorModal">

                <i class="bx bx-plus"></i>
                Add Contractor

            </button>

        </div>
        <div class="modal fade" id="contractorModal" tabindex="-1">

            <div class="modal-dialog">

                <div class="modal-content xc-modal-content">

                    <div class="modal-header xc-modal-header">

                        <h5 class="modal-title xc-modal-title">
                            Add Contractor
                        </h5>

                        <button class="btn-close xc-modal-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body xc-modal-body">

                        <div class="xc-info-field mb-0">

                            <label>Contractor Name</label>

                            <input type="text" id="contractor_name" class="xc-input">

                        </div>

                        <!-- <div class="xc-info-field">

                            <label>Mobile</label>

                            <input type="text" id="contractor_mobile" class="xc-input">

                        </div> -->

                    </div>

                    <div class="modal-footer xc-modal-footer">

                        <button type="button" class="xc-btn-primary" id="saveContractor">

                            Save Contractor

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <div class="xc-card xc-form-card">

            <div class="xc-card-header">
                <div class="xc-header-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h4>Daily Manpower Report</h4>
            </div>

            <div class="xc-card-body">

                <form action="<?= site_url('employee/save_manpower_report'); ?>" method="POST"
                    enctype="multipart/form-data">

                    <input type="hidden" name="project_id" value="<?= $project->id; ?>">

                    <input type="hidden" name="report_date" value="<?= $today; ?>">

                    <div class="xc-info-grid">

                        <div class="xc-info-field">
                            <label>Project Name</label>
                            <input type="text" class="xc-input" value="<?= $project->project_name; ?>" readonly>
                        </div>

                        <div class="xc-info-field">
                            <label>Project ID</label>
                            <input type="text" class="xc-input"
                                value="PRJ-<?= str_pad($project->id, 4, '0', STR_PAD_LEFT); ?>" readonly>
                        </div>

                        <div class="xc-info-field">
                            <label>Date</label>
                            <input type="date" class="xc-input" value="<?= $today; ?>" readonly>
                        </div>

                    </div>

                    <div class="xc-divider"></div>

                    <h5 class="xc-section-title">Manpower Details</h5>

                    <div class="xc-table-wrap">

                        <table class="xc-table">

                            <thead>

                                <tr>

                                    <th>Category</th>
                                    <th width="120">Skilled</th>
                                    <th width="120">Unskilled</th>
                                    <th width="120">Total</th>
                                    <th>Contractor</th>
                                    <th>Work Area</th>
                                    <th>Activity</th>
                                    <th>Remarks</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($categories as $cat) { ?>

                                    <tr>

                                        <td width="180" data-label="Category">

                                            <div class="d-flex align-items-center justify-content-between">

                                                <span><?= $cat->category_name; ?></span>

                                                <button type="button" class="xc-btn-clone cloneRow">
                                                    +
                                                </button>

                                            </div>

                                            <input type="hidden" name="category[]" value="<?= $cat->category_name; ?>">

                                        </td>

                                        <!-- Skilled -->
                                        <td data-label="Skilled">

                                            <input type="number" name="skilled[]" class="xc-input skilled" min="0"
                                                value="0">

                                        </td>

                                        <!-- Unskilled -->
                                        <td data-label="Unskilled">

                                            <input type="number" name="unskilled[]" class="xc-input unskilled" min="0"
                                                value="0">

                                        </td>

                                        <!-- Total -->
                                        <td data-label="Total">

                                            <input type="number" name="workers[]" class="xc-input total" readonly>

                                        </td>

                                        <!-- Contractor -->

                                        <td data-label="Contractor">

                                            <select name="contractor[]" class="xc-select contractor-select">

                                                <option value="">Select Contractor</option>

                                                <?php foreach ($contractors as $c) { ?>
                                                    <option value="<?= $c->contractor_name; ?>">
                                                        <?= $c->contractor_name; ?>
                                                    </option>
                                                <?php } ?>

                                            </select>

                                        </td>

                                        <!-- Area -->

                                        <td data-label="Work Area">

                                            <select name="work_area[]" class="xc-select">

                                                <option value="">Select Area</option>

                                                <?php foreach ($areas as $area) { ?>

                                                    <option value="<?= $area->area_name; ?>">

                                                        <?= $area->area_name; ?>

                                                    </option>

                                                <?php } ?>

                                            </select>

                                        </td>

                                        <!-- Activity -->

                                        <td data-label="Activity">

                                            <select name="activity[]" class="xc-select">

                                                <option value="">Select Activity</option>

                                                <?php foreach ($activities as $act) { ?>

                                                    <option value="<?= $act->activity_name; ?>">

                                                        <?= $act->activity_name; ?>

                                                    </option>

                                                <?php } ?>

                                            </select>

                                        </td>

                                        <td data-label="Remarks">

                                            <input type="text" name="remarks_detail[]" class="xc-input">

                                        </td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <div class="xc-stat-grid">

                        <div class="xc-stat-card xc-stat-skilled">
                            <span class="xc-stat-label">Total Skilled</span>
                            <span class="xc-stat-value" id="grand_skilled">0</span>
                        </div>

                        <div class="xc-stat-card xc-stat-unskilled">
                            <span class="xc-stat-label">Total Unskilled</span>
                            <span class="xc-stat-value" id="grand_unskilled">0</span>
                        </div>

                        <div class="xc-stat-card xc-stat-total">
                            <span class="xc-stat-label">Total Workers</span>
                            <span class="xc-stat-value" id="grand_total">0</span>
                        </div>

                    </div>

                    <div class="xc-divider"></div>

                    <div class="xc-bottom-grid">

                        <div class="xc-info-field">

                            <label>Man-power Photo</label>
                            <input type="file" name="photo" class="xc-input xc-file-input"
                                accept=".jpg,.jpeg,.png,.webp" required>

                        </div>

                        <div class="xc-info-field">

                            <label>Overall Remarks</label>

                            <textarea name="remarks" class="xc-input xc-textarea" rows="4"
                                placeholder="Enter overall manpower remarks..."></textarea>

                        </div>

                    </div>

                    <div class="xc-submit-row">

                        <button type="submit" class="xc-btn-primary">
                            <i class="bx bx-save"></i> Submit Manpower Report
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <script>

            function calculateTotals() {

                let grandSkilled = 0;
                let grandUnskilled = 0;
                let grandTotal = 0;

                document.querySelectorAll("tbody tr").forEach(function (row) {

                    let skilled = parseInt(row.querySelector(".skilled").value) || 0;
                    let unskilled = parseInt(row.querySelector(".unskilled").value) || 0;

                    let total = skilled + unskilled;

                    row.querySelector(".total").value = total;

                    grandSkilled += skilled;
                    grandUnskilled += unskilled;
                    grandTotal += total;

                });

                document.getElementById("grand_skilled").innerHTML = grandSkilled;
                document.getElementById("grand_unskilled").innerHTML = grandUnskilled;
                document.getElementById("grand_total").innerHTML = grandTotal;

            }

            document.addEventListener("input", function (e) {

                if (e.target.classList.contains("skilled") ||
                    e.target.classList.contains("unskilled")) {
                    calculateTotals();
                }

            });

            window.onload = calculateTotals;

        </script>
    </div>

</div>

<style>
    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0c9786;
        --xc-navy: #1a1a2e;
    }

    .page-wrapper {
        padding: 24px;
    }

    .xc-form-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(26, 26, 46, 0.08);
        overflow: hidden;
        border: 1px solid #eef1f4;
    }

    .xc-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 24px;
        background: linear-gradient(120deg, var(--xc-teal), var(--xc-teal-dark));
        color: #fff;
    }

    .xc-card-header h4 {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .xc-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .xc-card-body {
        padding: 24px;
    }

    /* Top info fields */
    .xc-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .xc-info-field label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--xc-navy);
        margin-bottom: 6px;
    }

    .xc-input,
    .xc-select,
    .xc-textarea {
        width: 100%;
        border: 1px solid #e2e6ea;
        border-radius: 10px;
        padding: 9px 12px;
        font-size: 0.88rem;
        color: #333;
        background: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .xc-input:focus,
    .xc-select:focus,
    .xc-textarea:focus {
        outline: none;
        border-color: var(--xc-teal);
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.15);
    }

    .xc-input[readonly] {
        background: #f8f9fb;
        color: #555;
    }

    .xc-textarea {
        resize: vertical;
        line-height: 1.5;
    }

    .xc-file-input {
        padding: 7px 12px;
    }

    .xc-divider {
        height: 1px;
        background: #eef1f4;
        margin: 24px 0;
    }

    .xc-section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--xc-navy);
        margin-bottom: 14px;
    }

    /* Add Contractor button (theme-matched) */
    .xc-btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(120deg, var(--xc-teal), var(--xc-teal-dark));
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 9px 18px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform .15s ease, box-shadow .15s ease;
        box-shadow: 0 4px 14px rgba(15, 180, 160, 0.28);
    }

    .xc-btn-add:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(15, 180, 160, 0.35);
        color: #fff;
    }

    /* Clone (+) button */
    .xc-btn-clone {
        border: 1px solid var(--xc-teal);
        background: rgba(15, 180, 160, 0.08);
        color: var(--xc-teal-dark);
        border-radius: 8px;
        width: 26px;
        height: 26px;
        line-height: 1;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background .15s ease, color .15s ease;
    }

    .xc-btn-clone:hover {
        background: var(--xc-teal);
        color: #fff;
    }

    /* Modal theme */
    .xc-modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(26, 26, 46, 0.2);
    }

    .xc-modal-header {
        background: linear-gradient(120deg, var(--xc-teal), var(--xc-teal-dark));
        border-bottom: none;
        padding: 18px 22px;
    }

    .xc-modal-title {
        color: #fff;
        font-weight: 600;
        font-size: 1.05rem;
        margin: 0;
    }

    .xc-modal-close {
        filter: brightness(0) invert(1);
        opacity: 0.9;
    }

    .xc-modal-close:hover {
        opacity: 1;
    }

    .xc-modal-body {
        padding: 22px;
    }

    .xc-modal-footer {
        border-top: 1px solid #eef1f4;
        padding: 16px 22px;
    }

    /* Table */
    .xc-table-wrap {
        overflow-x: auto;
        border-radius: 14px;
        border: 1px solid #eef1f4;
        margin-bottom: 24px;
        -webkit-overflow-scrolling: touch;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .xc-table thead,
    .xc-table thead tr {
        background-color: var(--xc-teal) !important;
        background-image: linear-gradient(120deg, var(--xc-teal), var(--xc-teal-dark)) !important;
    }

    .xc-table thead th {
        color: #fff;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        padding: 12px 14px;
        white-space: nowrap;
        border: none;
    }

    .xc-table tbody td {
        padding: 10px 12px;
        font-size: 0.88rem;
        color: #333;
        border-bottom: 1px solid #eef1f4;
        vertical-align: middle;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-table tbody tr:hover {
        background: rgba(15, 180, 160, 0.04);
    }

    .xc-table .xc-input,
    .xc-table .xc-select {
        min-width: 90px;
    }

    /* Stat cards */
    .xc-stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 8px;
    }

    .xc-stat-card {
        border-radius: 16px;
        padding: 18px;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .xc-stat-label {
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0.85;
    }

    .xc-stat-value {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .xc-stat-skilled {
        background: rgba(15, 180, 160, 0.1);
        color: var(--xc-teal-dark);
    }

    .xc-stat-unskilled {
        background: #fff4e0;
        color: #b9761f;
    }

    .xc-stat-total {
        background: rgba(26, 26, 46, 0.06);
        color: var(--xc-navy);
    }

    /* Bottom grid */
    .xc-bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Submit */
    .xc-submit-row {
        margin-top: 24px;
    }

    .xc-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(120deg, var(--xc-teal), var(--xc-teal-dark));
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px 26px;
        font-size: 0.92rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform .15s ease, box-shadow .15s ease;
        box-shadow: 0 4px 14px rgba(15, 180, 160, 0.28);
    }

    .xc-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(15, 180, 160, 0.35);
    }

    .xc-btn-primary:active {
        transform: translateY(0);
    }

    /* Responsive breakpoints */
    @media (max-width: 992px) {
        .xc-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-wrapper {
            padding: 14px;
        }

        .xc-card-body {
            padding: 16px;
        }

        .xc-info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .xc-stat-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .xc-stat-value {
            font-size: 1.5rem;
        }

        .xc-bottom-grid {
            grid-template-columns: 1fr;
        }

        .xc-card-header h4 {
            font-size: 1rem;
        }

        .xc-submit-row {
            text-align: center;
        }

        .xc-btn-primary {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .xc-stat-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>

    $('#saveContractor').click(function () {

        var contractor_name = $('#contractor_name').val();

        if (contractor_name == '') {
            alert('Enter Contractor Name');
            return;
        }

        $.ajax({

            url: "<?= site_url('employee/add_contractor'); ?>",
            type: "POST",

            data: {

                contractor_name: contractor_name

            },

            dataType: "json",

            success: function (res) {

                if (res.status == 1) {

                    $('.contractor-select').append(
                        '<option value="' + contractor_name + '">' + contractor_name + '</option>'
                    );

                    $('.contractor-select').val(contractor_name);

                    $('#contractor_name').val('');

                    $('#contractorModal').modal('hide');

                }

            }

        });

    });
    $(document).on('click', '.cloneRow', function () {

        var row = $(this).closest('tr');

        var clone = row.clone();

        clone.find('input[type=number]').val(0);

        clone.find('input[type=text]').val('');

        clone.find('select').prop('selectedIndex', 0);

        clone.find('.total').val(0);

        row.after(clone);

        calculateTotals();

    });
</script>