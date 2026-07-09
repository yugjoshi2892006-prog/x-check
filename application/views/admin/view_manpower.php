<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-mp-wrap">

            <div class="xc-mp-breadcrumb">
                Reports <i class='bx bx-chevron-right'></i> <span>Manpower Report Details</span>
            </div>

            <div class="xc-mp-card">

                <div class="xc-mp-card-header">
                    <h4>
                        <span class="xc-mp-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                            </svg>
                        </span>
                        Manpower Report Details
                    </h4>
                </div>

                <div class="xc-mp-card-body">

                    <!-- Info fields -->
                    <div class="xc-mp-info-grid">

                        <div class="xc-mp-info-field">
                            <label>Project</label>
                            <input class="xc-mp-input" value="<?= $report->project_name; ?>" readonly>
                        </div>

                        <div class="xc-mp-info-field">
                            <label>Engineer</label>
                            <input class="xc-mp-input" value="<?= $report->engineer; ?>" readonly>
                        </div>

                        <div class="xc-mp-info-field">
                            <label>Date</label>
                            <input class="xc-mp-input" value="<?= date('d-m-Y', strtotime($report->report_date)); ?>"
                                readonly>
                        </div>

                    </div>

                    <!-- Stat cards -->
                    <div class="xc-mp-stat-grid">

                        <div class="xc-mp-stat-card">
                            <span class="xc-mp-stat-icon teal">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </span>
                            <div>
                                <span class="xc-mp-stat-label">Total Skilled</span>
                                <span class="xc-mp-stat-value"><?= $report->skilled_workers; ?></span>
                            </div>
                        </div>

                        <div class="xc-mp-stat-card">
                            <span class="xc-mp-stat-icon amber">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4"></circle>
                                    <path d="M4 21v-1a8 8 0 0 1 16 0v1"></path>
                                </svg>
                            </span>
                            <div>
                                <span class="xc-mp-stat-label">Total Unskilled</span>
                                <span class="xc-mp-stat-value"><?= $report->unskilled_workers; ?></span>
                            </div>
                        </div>

                        <div class="xc-mp-stat-card">
                            <span class="xc-mp-stat-icon ink">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </span>
                            <div>
                                <span class="xc-mp-stat-label">Total Workers</span>
                                <span class="xc-mp-stat-value"><?= $report->total_workers; ?></span>
                            </div>
                        </div>

                    </div>

                    <!-- Category breakdown table -->
                    <div class="xc-mp-table-wrap">

                        <table class="xc-mp-table">

                            <thead>

                                <tr>

                                    <th>Category</th>
                                    <th>Skilled</th>
                                    <th>Unskilled</th>
                                    <th>Total</th>
                                    <th>Contractor</th>
                                    <th>Area</th>
                                    <th>Activity</th>
                                    <th>Remarks</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (count($details) > 0) { ?>

                                    <?php foreach ($details as $d) { ?>

                                        <tr>

                                            <td data-label="Category"><?= $d->category_name; ?></td>

                                            <td data-label="Skilled"><?= $d->skilled_workers; ?></td>

                                            <td data-label="Unskilled"><?= $d->unskilled_workers; ?></td>

                                            <td data-label="Total"><?= $d->workers; ?></td>

                                            <td data-label="Contractor"><?= $d->contractor; ?></td>

                                            <td data-label="Area"><?= $d->work_area; ?></td>

                                            <td data-label="Activity"><?= $d->activity; ?></td>

                                            <td data-label="Remarks"><?= $d->remarks; ?></td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="8" class="xc-mp-table-empty">No category breakdown available.
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <!-- Photo + remarks -->
                    <div class="xc-mp-bottom-grid">

                        <div class="xc-mp-photo-field">

                            <label>Photo</label>

                            <div class="xc-mp-photo-frame">
                                <img src="<?= base_url('uploads/manpower/' . $report->photo); ?>" alt="Report photo">
                            </div>

                        </div>

                        <div class="xc-mp-remarks-field">

                            <label>Overall Remarks</label>

                            <textarea class="xc-mp-textarea" rows="8" readonly><?= $report->remarks; ?></textarea>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

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
        --xc-amber: #d97706;
        --xc-amber-soft: #fef3e2;
    }

    * {
        box-sizing: border-box;
    }

    .xc-mp-wrap {
        padding: 28px;
        background: var(--xc-bg);
        min-height: 100vh;
        transition: background .2s ease;
    }

    .xc-mp-breadcrumb {
        font-size: 13px;
        color: var(--xc-muted);
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .xc-mp-breadcrumb span {
        color: var(--xc-ink);
        font-weight: 600;
    }

    /* ── Card shell ── */
    .xc-mp-card {
        background: var(--xc-surface);
        border: 1px solid var(--xc-line);
        border-radius: 12px;
        overflow: hidden;
        transition: background .2s ease, border-color .2s ease;
    }

    .xc-mp-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 22px;
        background: var(--xc-surface);
        border-bottom: 1px solid var(--xc-line);
    }

    .xc-mp-card-header h4 {
        margin: 0;
        color: var(--xc-ink);
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xc-mp-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
        flex-shrink: 0;
    }

    .xc-mp-icon svg {
        width: 16px;
        height: 16px;
    }

    .xc-mp-card-body {
        padding: 22px;
    }

    /* ── Info fields ── */
    .xc-mp-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .xc-mp-info-field label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: var(--xc-ink-soft);
        margin-bottom: 7px;
    }

    .xc-mp-input,
    .xc-mp-textarea {
        width: 100%;
        border: 1px solid var(--xc-line);
        border-radius: 8px;
        padding: 10px 13px;
        font-size: 14px;
        color: var(--xc-ink);
        background: var(--xc-bg);
        font-weight: 500;
    }

    .xc-mp-textarea {
        resize: none;
        line-height: 1.6;
    }

    /* ── Stat cards ── */
    .xc-mp-stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .xc-mp-stat-card {
        border: 1px solid var(--xc-line);
        border-radius: 10px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--xc-surface);
    }

    .xc-mp-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-mp-stat-icon svg {
        width: 20px;
        height: 20px;
    }

    .xc-mp-stat-icon.teal {
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
    }

    .xc-mp-stat-icon.amber {
        background: var(--xc-amber-soft);
        color: var(--xc-amber);
    }

    .xc-mp-stat-icon.ink {
        background: var(--xc-bg);
        color: var(--xc-ink-soft);
        border: 1px solid var(--xc-line);
    }

    .xc-mp-stat-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: var(--xc-muted);
        margin-bottom: 2px;
    }

    .xc-mp-stat-value {
        display: block;
        font-size: 22px;
        font-weight: 700;
        color: var(--xc-ink);
        letter-spacing: -0.01em;
    }

    /* ── Table ── */
    .xc-mp-table-wrap {
        overflow-x: auto;
        border: 1px solid var(--xc-line);
        border-radius: 10px;
        margin-bottom: 28px;
        -webkit-overflow-scrolling: touch;
    }

    .xc-mp-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 720px;
        font-size: 13.5px;
    }

    .xc-mp-table thead tr {
        background-color: var(--xc-bg);
    }

    .xc-mp-table thead th {
        color: var(--xc-ink-soft);
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 12px 16px;
        white-space: nowrap;
        border-bottom: 1px solid var(--xc-line);
        text-align: left;
    }

    .xc-mp-table tbody td {
        padding: 12px 16px;
        color: var(--xc-ink);
        border-bottom: 1px solid var(--xc-line);
        background: var(--xc-surface);
    }

    .xc-mp-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-mp-table tbody tr:hover td {
        background: var(--xc-accent-soft);
    }

    .xc-mp-table-empty {
        text-align: center;
        padding: 32px 16px;
        color: var(--xc-muted);
    }

    /* ── Bottom grid ── */
    .xc-mp-bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .xc-mp-photo-field label,
    .xc-mp-remarks-field label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: var(--xc-ink-soft);
        margin-bottom: 8px;
    }

    .xc-mp-photo-frame {
        border: 1px solid var(--xc-line);
        border-radius: 10px;
        padding: 8px;
        background: var(--xc-bg);
        display: inline-block;
        max-width: 100%;
    }

    .xc-mp-photo-frame img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
        display: block;
    }

    /* ── Responsive ── */
    @media (max-width: 992px) {
        .xc-mp-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .xc-mp-wrap {
            padding: 16px;
        }

        .xc-mp-card-body {
            padding: 16px;
        }

        .xc-mp-info-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .xc-mp-stat-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .xc-mp-bottom-grid {
            grid-template-columns: 1fr;
        }

        .xc-mp-card-header h4 {
            font-size: 14.5px;
        }
    }

    @media (max-width: 480px) {
        .xc-mp-stat-value {
            font-size: 19px;
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
        --xc-amber-soft: rgba(217, 119, 6, 0.14);
    }

    html.xc-dark .xc-mp-table thead tr {
        background-color: #10141d;
    }
</style>