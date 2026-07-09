<div class="page-wrapper">
    <div class="page-content">
        <!-- <div class="xc-wizard-container"> -->

            <div class="xc-wizard-header">
                <h3 class="xc-wizard-title">Step 3 : Areas</h3>
                <p class="xc-wizard-subtitle">Define area dimensions for each floor</p>
            </div>

            <div class="xc-card xc-form-card">

                <form method="post" action="<?= base_url('index.php/project/save_area') ?>">

                    <input type="hidden" name="draft_token" value="<?= $draft_token ?>">

                    <div class="xc-form-group mb-3">
                        <label class="xc-label">Floor</label>
                        <select name="floor_id" class="form-control xc-input">

                            <?php foreach ($floors as $floor): ?>

                                <option value="<?= $floor->id ?>">

                                    <?= $floor->floor_name ?>

                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="xc-form-group mb-3">
                        <label class="xc-label">Area Name</label>
                        <input type="text" name="area_name" placeholder="Area Name" class="form-control xc-input">
                    </div>

                    <div class="xc-row-group mb-3">

                        <div class="xc-form-group">
                            <label class="xc-label">Width</label>
                            <input type="number" id="width" name="width" placeholder="Width"
                                class="form-control xc-input">
                        </div>

                        <div class="xc-form-group">
                            <label class="xc-label">Length</label>
                            <input type="number" id="length" name="length" placeholder="Length"
                                class="form-control xc-input">
                        </div>

                        <div class="xc-form-group">
                            <label class="xc-label">Sq.Ft</label>
                            <input type="text" id="sqft" readonly class="form-control xc-input xc-input-readonly">
                        </div>

                    </div>

                    <button class="btn xc-btn-success">
                        <i class="fa fa-plus me-1"></i> Add Area
                    </button>

                </form>

            </div>

            <div class="xc-card xc-table-card">

                <h5 class="xc-floor-list-title">Added Areas</h5>

                <div class="xc-table-wrapper">
                    <table class="table xc-table">

                        <thead>
                            <tr>
                                <th>Floor</th>
                                <th>Area</th>
                                <th>Width</th>
                                <th>Length</th>
                                <th>Sq.Ft</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($areas as $row): ?>

                                <tr>

                                    <td data-label="Floor">
                                        <?= $row->floor_temp_id ?>
                                    </td>

                                    <td data-label="Area">
                                        <?= $row->area_name ?>
                                    </td>

                                    <td data-label="Width">
                                        <?= $row->width ?>
                                    </td>

                                    <td data-label="Length">
                                        <?= $row->length ?>
                                    </td>

                                    <td data-label="Sq.Ft">
                                        <?= $row->sq_ft ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>

            </div>

            <div class="xc-wizard-actions">

                <a href="<?= base_url('index.php/project/camera/' . $draft_token) ?>" class="btn xc-btn-next">
                    Save & Next <i class="fa fa-arrow-right ms-1"></i>
                </a>

            </div>

        <!-- </div> -->
    </div>
</div>

<style>
    .xc-wizard-container {
        max-width: 820px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    .xc-wizard-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .xc-wizard-title {
        color: #1a1a2e;
        font-weight: 700;
        font-size: 26px;
        margin-bottom: 6px;
    }

    .xc-wizard-subtitle {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 0;
    }

    .xc-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(15, 180, 160, 0.15);
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(26, 26, 46, 0.08);
        padding: 28px;
        margin-bottom: 24px;
    }

    .xc-form-card {
        border-top: 4px solid #0fb4a0;
    }

    .xc-table-card {
        border-top: 4px solid #1a1a2e;
    }

    .xc-label {
        display: block;
        font-weight: 600;
        font-size: 13px;
        color: #1a1a2e;
        margin-bottom: 6px;
        letter-spacing: 0.3px;
    }

    .xc-row-group {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 14px;
    }

    .xc-input {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
        background: #ffffff;
        width: 100%;
    }

    .xc-input:focus {
        border-color: #0fb4a0;
        box-shadow: 0 0 0 4px rgba(15, 180, 160, 0.12);
        outline: none;
    }

    .xc-input-readonly {
        background: rgba(15, 180, 160, 0.06);
        font-weight: 600;
        color: #0d9488;
        cursor: not-allowed;
    }

    .xc-btn-success {
        background: linear-gradient(135deg, #0fb4a0, #0d9488);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 14px rgba(15, 180, 160, 0.3);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .xc-btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 180, 160, 0.4);
        color: #fff;
    }

    .xc-floor-list-title {
        color: #1a1a2e;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 16px;
    }

    .xc-table-wrapper {
        overflow-x: auto;
    }

    /* ===== TABLE HEADER FIX ===== */
    /* Bootstrap sets --bs-table-color which overrides plain color rules,
       so we reset that variable AND force color with high-specificity
       selectors + !important on every relevant state. */

    .xc-table.table {
        --bs-table-color: #ffffff;
        --bs-table-bg: transparent;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .xc-table.table thead,
    .xc-table.table thead tr {
        background-color: #0fb4a0 !important;
        background: linear-gradient(135deg, #0fb4a0, #0d9488) !important;
        --bs-table-color: #ffffff;
    }

    .xc-table.table thead tr th,
    .xc-table.table>thead>tr>th,
    .xc-table thead th {
        color: #ffffff !important;
        -webkit-text-fill-color: #ffffff !important;
        background-color: transparent !important;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.3px;
        padding: 12px 14px;
        border: none !important;
        text-shadow: none;
    }

    .xc-table.table thead tr th:first-child {
        border-top-left-radius: 10px;
    }

    .xc-table.table thead tr th:last-child {
        border-top-right-radius: 10px;
    }

    .xc-table tbody td {
        padding: 12px 14px;
        font-size: 14px;
        color: #1a1a2e;
        border-bottom: 1px solid rgba(15, 180, 160, 0.12);
        background: #fff;
    }

    .xc-table tbody tr:hover td {
        background: rgba(15, 180, 160, 0.05);
    }

    /* ===== END TABLE HEADER FIX ===== */

    .xc-wizard-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .xc-btn-next {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 11px 28px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 14px rgba(26, 26, 46, 0.25);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .xc-btn-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26, 26, 46, 0.35);
        color: #fff;
    }

    @media (max-width: 768px) {
        .xc-wizard-container {
            padding: 20px 14px;
        }

        .xc-card {
            padding: 20px;
            border-radius: 14px;
        }

        .xc-wizard-title {
            font-size: 22px;
        }

        .xc-row-group {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .xc-btn-success,
        .xc-btn-next {
            width: 100%;
            text-align: center;
        }

        .xc-wizard-actions {
            justify-content: center;
        }

        .xc-table thead {
            display: none;
        }

        .xc-table tbody tr {
            display: block;
            margin-bottom: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(26, 26, 46, 0.08);
            overflow: hidden;
        }

        .xc-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(15, 180, 160, 0.1);
        }

        .xc-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #0d9488;
            margin-right: 12px;
        }

        .xc-table tbody tr td:last-child {
            border-bottom: none;
        }
    }
</style>

<script>
    (function () {
        var widthInput = document.getElementById('width');
        var lengthInput = document.getElementById('length');
        var sqftInput = document.getElementById('sqft');

        function calcSqft() {
            var w = parseFloat(widthInput.value) || 0;
            var l = parseFloat(lengthInput.value) || 0;
            sqftInput.value = (w * l) ? (w * l).toFixed(2) : '';
        }

        if (widthInput && lengthInput && sqftInput) {
            widthInput.addEventListener('input', calcSqft);
            lengthInput.addEventListener('input', calcSqft);
        }
    })();
</script>