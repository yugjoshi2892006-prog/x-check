<div class="page-wrapper">
    <div class="page-content">
        <style>
            :root {
                --xc-ink: #0f172a;
                --xc-ink-soft: #475569;
                --xc-muted: #94a3b8;
                --xc-line: #e2e8f0;
                --xc-surface: #ffffff;
                --xc-bg: #f8fafc;
                --xc-accent: #0fb4a0;
                --xc-accent-dark: #0c9786;
                --xc-accent-soft: #e6faf7;
                --xc-danger: #d64545;
                --xc-danger-soft: #fdecec;
            }

            * {
                box-sizing: border-box;
            }

            .xc-mr-wrap {
                padding: 28px;
                background: var(--xc-bg);
                min-height: 100vh;
                transition: background .2s ease;
            }

            .xc-mr-breadcrumb {
                font-size: 13px;
                color: var(--xc-muted);
                margin-bottom: 18px;
                display: flex;
                align-items: center;
                gap: 6px;
            }

            .xc-mr-breadcrumb span {
                color: var(--xc-ink);
                font-weight: 600;
            }

            /* ── Card shell ── */
            .xc-mr-card {
                background: var(--xc-surface);
                border: 1px solid var(--xc-line);
                border-radius: 12px;
                margin-bottom: 20px;
                overflow: hidden;
                transition: background .2s ease, border-color .2s ease;
            }

            .xc-mr-card-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                padding: 15px 20px;
                background: var(--xc-surface);
                border-bottom: 1px solid var(--xc-line);
            }

            .xc-mr-card-header h4,
            .xc-mr-card-header h5 {
                margin: 0;
                color: var(--xc-ink);
                font-size: 15.5px;
                font-weight: 700;
                display: flex;
                align-items: center;
                gap: 9px;
            }

            .xc-mr-card-header .xc-mr-icon {
                width: 30px;
                height: 30px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--xc-accent-soft);
                color: var(--xc-accent-dark);
                flex-shrink: 0;
            }

            .xc-mr-card-header.xc-mr-header-secondary .xc-mr-icon {
                background: #ede9fe;
                color: #6d28d9;
            }

            .xc-mr-card-header.xc-mr-header-warning .xc-mr-icon {
                background: var(--xc-danger-soft);
                color: var(--xc-danger);
            }

            .xc-mr-icon svg {
                width: 16px;
                height: 16px;
            }

            .xc-mr-badge-count {
                font-size: 12px;
                font-weight: 700;
                color: var(--xc-ink-soft);
                background: var(--xc-bg);
                border: 1px solid var(--xc-line);
                padding: 4px 10px;
                border-radius: 999px;
            }

            .xc-mr-card-body {
                padding: 20px;
            }

            /* ── Info stat row ── */
            .xc-mr-info-row {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
            }

            .xc-mr-info-col {
                flex: 1 1 200px;
                background: var(--xc-bg);
                border: 1px solid var(--xc-line);
                border-radius: 10px;
                padding: 14px 16px;
            }

            .xc-mr-info-col b {
                display: block;
                font-size: 11.5px;
                text-transform: uppercase;
                letter-spacing: .05em;
                color: var(--xc-muted);
                margin-bottom: 6px;
                font-weight: 700;
            }

            .xc-mr-info-col .xc-mr-info-value {
                font-size: 16px;
                color: var(--xc-ink);
                font-weight: 700;
                letter-spacing: -0.01em;
            }

            /* ── Filters ── */
            .xc-mr-filter-row {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                align-items: flex-end;
            }

            .xc-mr-filter-group {
                flex: 1 1 220px;
                min-width: 200px;
            }

            .xc-mr-filter-group label {
                display: block;
                font-size: 12.5px;
                font-weight: 700;
                color: var(--xc-ink-soft);
                margin-bottom: 7px;
                text-transform: uppercase;
                letter-spacing: .03em;
            }

            .xc-mr-filter-group .form-control {
                border: 1px solid var(--xc-line);
                border-radius: 8px;
                padding: 9px 12px;
                font-size: 14px;
                width: 100%;
                height: auto;
                color: var(--xc-ink);
                background: var(--xc-surface);
                transition: border-color .15s ease, box-shadow .15s ease;
            }

            .xc-mr-filter-group .form-control:focus {
                outline: none;
                border-color: var(--xc-accent);
                box-shadow: 0 0 0 3px var(--xc-accent-soft);
            }

            .xc-mr-filter-actions {
                flex: 1 1 220px;
                min-width: 200px;
                display: flex;
                gap: 10px;
            }

            .xc-mr-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 7px;
                padding: 9px 18px;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                border: 1px solid transparent;
                cursor: pointer;
                text-decoration: none;
                transition: all .15s ease;
                white-space: nowrap;
            }

            .xc-mr-btn-search {
                background-color: var(--xc-accent);
                border-color: var(--xc-accent);
                color: #ffffff;
            }

            .xc-mr-btn-search:hover {
                background-color: var(--xc-accent-dark);
                border-color: var(--xc-accent-dark);
                color: #ffffff;
            }

            .xc-mr-btn-reset {
                background-color: var(--xc-surface);
                color: var(--xc-danger);
                border-color: var(--xc-danger);
            }

            .xc-mr-btn-reset:hover {
                background-color: var(--xc-danger);
                color: #ffffff;
            }

            .xc-mr-btn-pdf {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                background-color: var(--xc-accent-soft);
                border: 1px solid transparent;
                color: var(--xc-accent-dark);
                padding: 5px 12px;
                font-size: 12px;
                font-weight: 700;
                border-radius: 6px;
                text-decoration: none;
                transition: all .15s ease;
            }

            .xc-mr-btn-pdf:hover {
                background-color: var(--xc-accent);
                color: #ffffff;
            }

            .xc-mr-btn-pdf svg {
                width: 12px;
                height: 12px;
            }

            .xc-mr-empty-cell {
                color: var(--xc-muted);
            }

            .xc-mr-export-row {
                display: flex;
                justify-content: flex-end;
                margin-bottom: 20px;
            }

            .xc-mr-btn-export {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background-color: var(--xc-danger);
                color: #ffffff;
                border: 1px solid var(--xc-danger);
                border-radius: 8px;
                padding: 10px 20px;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                transition: all .15s ease;
                white-space: nowrap;
            }

            .xc-mr-btn-export:hover {
                background-color: #b53636;
                border-color: #b53636;
                color: #ffffff;
                transform: translateY(-1px);
            }

            .xc-mr-btn-export i {
                font-size: 16px;
            }

            /* ── Table ── */
            .xc-mr-table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .xc-mr-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 13.5px;
            }

            .xc-mr-table thead tr {
                background-color: var(--xc-bg);
            }

            .xc-mr-table thead th {
                color: var(--xc-ink-soft) !important;
                padding: 11px 14px;
                font-weight: 700;
                text-align: left;
                white-space: nowrap;
                border-bottom: 1px solid var(--xc-line);
                font-size: 11.5px;
                text-transform: uppercase;
                letter-spacing: .04em;
            }

            .xc-mr-table tbody td {
                padding: 12px 14px;
                border-bottom: 1px solid var(--xc-line);
                color: var(--xc-ink);
                vertical-align: middle;
                white-space: nowrap;
            }

            .xc-mr-table tbody tr {
                transition: background .12s ease;
            }

            .xc-mr-table tbody tr:hover {
                background-color: var(--xc-accent-soft);
            }

            .xc-mr-table tbody tr:last-child td {
                border-bottom: none;
            }

            .xc-mr-table-empty {
                text-align: center;
                padding: 40px 20px;
                color: var(--xc-muted);
                font-size: 14px;
            }

            /* ---------- Tablet (≤ 991px) ---------- */
            @media (max-width: 991px) {
                .xc-mr-wrap {
                    padding: 20px;
                }

                .xc-mr-info-row {
                    gap: 14px;
                }

                .xc-mr-info-col {
                    flex: 1 1 calc(50% - 7px);
                }

                .xc-mr-filter-group {
                    flex: 1 1 calc(50% - 8px);
                }

                .xc-mr-filter-actions {
                    flex: 1 1 100%;
                }
            }

            /* ---------- Mobile (≤ 600px) ---------- */
            @media (max-width: 600px) {
                .xc-mr-wrap {
                    padding: 12px;
                }

                .xc-mr-breadcrumb {
                    font-size: 12px;
                    margin-bottom: 12px;
                }

                .xc-mr-card {
                    border-radius: 10px;
                    margin-bottom: 16px;
                }

                .xc-mr-card-header {
                    padding: 12px 16px;
                }

                .xc-mr-card-header h4 {
                    font-size: 14.5px;
                }

                .xc-mr-card-header h5 {
                    font-size: 13.5px;
                }

                .xc-mr-card-body {
                    padding: 14px;
                }

                .xc-mr-info-row {
                    gap: 12px;
                }

                .xc-mr-info-col {
                    flex: 1 1 100%;
                    padding: 12px 14px;
                }

                .xc-mr-filter-row {
                    gap: 12px;
                }

                .xc-mr-filter-group {
                    flex: 1 1 100%;
                    min-width: 0;
                }

                .xc-mr-filter-group .form-control {
                    font-size: 16px;
                    /* prevents iOS auto-zoom on focus */
                    padding: 9px 12px;
                }

                .xc-mr-filter-actions {
                    flex: 1 1 100%;
                    flex-direction: column;
                }

                .xc-mr-btn {
                    width: 100%;
                    padding: 11px 16px;
                }

                .xc-mr-export-row {
                    margin-bottom: 14px;
                }

                .xc-mr-btn-export {
                    width: 100%;
                    justify-content: center;
                    padding: 12px 16px;
                }

                .xc-mr-table {
                    font-size: 12.5px;
                }

                .xc-mr-table thead th,
                .xc-mr-table tbody td {
                    padding: 9px 10px;
                }

                .xc-mr-btn-pdf {
                    padding: 6px 10px;
                    font-size: 11.5px;
                }
            }

            /* ---------- Small phones (≤ 380px) ---------- */
            @media (max-width: 380px) {
                .xc-mr-wrap {
                    padding: 8px;
                }

                .xc-mr-card-body {
                    padding: 12px;
                }

                .xc-mr-table {
                    font-size: 12px;
                }
            }

            /* ================================================================
               DARK MODE — scoped to html.xc-dark
               ================================================================ */
            html.xc-dark {
                --xc-ink: #f1f5f9;
                --xc-ink-soft: #cbd5e1;
                --xc-muted: #64748b;
                --xc-line: #263043;
                --xc-surface: #161b26;
                --xc-bg: #0e1219;
                --xc-accent-soft: rgba(15, 180, 160, 0.14);
                --xc-danger-soft: rgba(214, 69, 69, 0.14);
            }

            html.xc-dark .xc-mr-table thead tr {
                background-color: #10141d;
            }

            html.xc-dark .xc-mr-btn-reset:hover,
            html.xc-dark .xc-mr-btn-search:hover {
                color: #ffffff;
            }
        </style>

        <div class="xc-mr-wrap">

            <!-- <div class="xc-mr-breadcrumb">
                Materials <i class='bx bx-chevron-right'></i> <span>Project Material Report</span>
            </div> -->

            <!-- Project Info -->
            <div class="xc-mr-card">

                <div class="xc-mr-card-header">
                    <h4>
                        <span class="xc-mr-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 21h18"></path>
                                <path d="M5 21V7l8-4v18"></path>
                                <path d="M19 21V11l-6-4"></path>
                            </svg>
                        </span>
                        Project Material Report
                    </h4>
                </div>

                <div class="xc-mr-card-body">

                    <div class="xc-mr-info-row">

                        <div class="xc-mr-info-col">
                            <b>Project</b>
                            <div class="xc-mr-info-value"><?= $project->project_name ?></div>
                        </div>

                        <div class="xc-mr-info-col">
                            <b>Start Date</b>
                            <div class="xc-mr-info-value"><?= date('d-m-Y', strtotime($project->start_date)); ?></div>
                        </div>

                        <div class="xc-mr-info-col">
                            <b>End Date</b>
                            <div class="xc-mr-info-value"><?= date('d-m-Y', strtotime($project->end_date)); ?></div>
                        </div>

                        <div class="xc-mr-info-col">
                            <b>Total Reports</b>
                            <div class="xc-mr-info-value"><?= count($reports); ?></div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Filters -->
            <div class="xc-mr-card">

                <div class="xc-mr-card-header xc-mr-header-secondary">
                    <h5>
                        <span class="xc-mr-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                        </span>
                        Filter Reports
                    </h5>
                </div>

                <div class="xc-mr-card-body">

                    <form method="get">

                        <div class="xc-mr-filter-row">

                            <div class="xc-mr-filter-group">

                                <label>Cycle Date</label>

                                <input type="date" name="cycle_date" class="form-control"
                                    value="<?= $this->input->get('cycle_date') ?>">

                            </div>

                            <div class="xc-mr-filter-group">

                                <label>Category</label>

                                <select name="category_id" class="form-control">

                                    <option value="">All Category</option>

                                    <?php foreach ($categories as $c) { ?>

                                        <option value="<?= $c->id ?>" <?= ($this->input->get('category_id') == $c->id) ? 'selected' : ''; ?>>

                                            <?= $c->category_name ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="xc-mr-filter-group">

                                <label>Sub Category</label>

                                <select name="subcategory_id" class="form-control">

                                    <option value="">All Sub Category</option>

                                    <?php foreach ($subcategories as $s) { ?>

                                        <option value="<?= $s->id ?>" <?= ($this->input->get('subcategory_id') == $s->id) ? 'selected' : ''; ?>>

                                            <?= $s->subcategory_name ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="xc-mr-filter-actions">

                                <button class="xc-mr-btn xc-mr-btn-search">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    Search
                                </button>

                                <a href="<?= base_url('materials/project_reports/' . $project->id); ?>"
                                    class="xc-mr-btn xc-mr-btn-reset">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="1 4 1 10 7 10"></polyline>
                                        <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                                    </svg>
                                    Reset
                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Material history table -->
            <div class="xc-mr-card">

                <div class="xc-mr-card-header">
                    <h5>
                        <span class="xc-mr-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 8v13H3V8"></path>
                                <path d="M1 3h22v5H1z"></path>
                                <path d="M10 12h4"></path>
                            </svg>
                        </span>
                        Existing Material History
                    </h5>
                    <span class="xc-mr-badge-count"><?= count($reports); ?> Records</span>
                </div>

                <div class="xc-mr-card-body">

                    <div class="xc-mr-table-wrap">

                        <table class="xc-mr-table">

                            <thead>

                                <tr>

                                    <th>Cycle Date</th>
                                    <th>Employee</th>
                                    <th>Material</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Size</th>
                                    <th>Remark</th>
                                    <th>Photo</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (count($reports) > 0) { ?>

                                    <?php foreach ($reports as $r) { ?>

                                        <tr>

                                            <td>
                                                <?= date('d-m-Y', strtotime($r->attendance_date)); ?>
                                            </td>

                                            <td>
                                                <?= $r->employee_name; ?>
                                            </td>

                                            <td>
                                                <?= $r->subcategory_name; ?>
                                            </td>

                                            <td>
                                                <?= $r->site_quantity; ?>
                                            </td>

                                            <td>
                                                <?= $r->site_unit; ?>
                                            </td>

                                            <td>
                                                <?= $r->site_size; ?>
                                            </td>

                                            <td>
                                                <?= $r->site_remark; ?>
                                            </td>

                                            <td>

                                                <?php if ($r->site_photo != '') { ?>

                                                    <a href="<?= base_url('uploads/materials/' . $r->site_photo); ?>"
                                                        target="_blank" class="xc-mr-btn-pdf">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                            </path>
                                                            <polyline points="14 2 14 8 20 8"></polyline>
                                                        </svg>
                                                        PDF
                                                    </a>

                                                <?php } else { ?>

                                                    <span class="xc-mr-empty-cell">—</span>

                                                <?php } ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="8" class="xc-mr-table-empty">No material reports found.</td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="xc-mr-export-row">

                <a href="<?= base_url('materials/export_invoice/' . $project->id); ?>"
                    class="xc-mr-btn-export">

                    <i class='bx bxs-file-pdf'></i>
                    Export Invoice PDF

                </a>

            </div>

            <!-- Invoice history table -->
            <div class="xc-mr-card">

                <div class="xc-mr-card-header xc-mr-header-warning">
                    <h5>
                        <span class="xc-mr-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2 18 2 22 6 22 22 2 22 2 6z"></path>
                                <path d="M14 2v6h6"></path>
                                <line x1="8" y1="13" x2="16" y2="13"></line>
                                <line x1="8" y1="17" x2="16" y2="17"></line>
                            </svg>
                        </span>
                        Invoice / Challan History
                    </h5>
                    <span class="xc-mr-badge-count"><?= count($reports); ?> Records</span>
                </div>

                <div class="xc-mr-card-body">

                    <div class="xc-mr-table-wrap">

                        <table class="xc-mr-table">

                            <thead>

                                <tr>

                                    <th>Cycle Date</th>
                                    <th>Employee</th>
                                    <th>Invoice Date</th>
                                    <th>Material</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Size</th>
                                    <th>Photo</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (count($reports) > 0) { ?>

                                    <?php foreach ($reports as $r) { ?>

                                        <tr>

                                            <td>
                                                <?= date('d-m-Y', strtotime($r->attendance_date)); ?>
                                            </td>

                                            <td>
                                                <?= $r->employee_name; ?>
                                            </td>

                                            <td>
                                                <?= date('d-m-Y', strtotime($r->invoice_date)); ?>
                                            </td>

                                            <td>
                                                <?= $r->subcategory_name; ?>
                                            </td>

                                            <td>
                                                <?= $r->invoice_quantity; ?>
                                            </td>

                                            <td>
                                                <?= $r->invoice_unit; ?>
                                            </td>

                                            <td>
                                                <?= $r->invoice_size; ?>
                                            </td>

                                            <td>

                                                <?php if ($r->invoice_photo != '') { ?>

                                                    <a href="<?= base_url('uploads/materials/' . $r->invoice_photo); ?>"
                                                        target="_blank" class="xc-mr-btn-pdf">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                            </path>
                                                            <polyline points="14 2 14 8 20 8"></polyline>
                                                        </svg>
                                                        PDF
                                                    </a>

                                                <?php } else { ?>

                                                    <span class="xc-mr-empty-cell">—</span>

                                                <?php } ?>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="8" class="xc-mr-table-empty">No invoice records found.</td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
