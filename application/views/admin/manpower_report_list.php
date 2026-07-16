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
        --xc-navy: #1a1a2e;
        --xc-purple: #7c3aed;
        --xc-purple-soft: #ede9fe;
    }

    * {
        box-sizing: border-box;
    }

    .xc-mp-wrapper {
        padding: 4px;
    }

    /* ── Card shell ── */
    .xc-mp-card {
        background: var(--xc-surface);
        border: 1px solid var(--xc-line);
        border-radius: 12px;
        overflow: hidden;
        transition: background .2s ease, border-color .2s ease;
    }

    /* ── Header ── */
    .xc-mp-card .card-header {
        background: var(--xc-surface) !important;
        border: none !important;
        border-bottom: 1px solid var(--xc-line);
        padding: 16px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .xc-mp-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .xc-mp-header-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-mp-header-icon i {
        font-size: 18px;
    }

    .xc-mp-card .card-header h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--xc-ink);
        letter-spacing: -0.01em;
    }

    .xc-mp-header-sub {
        margin: 2px 0 0;
        font-size: 12.5px;
        color: var(--xc-muted);
    }

    .xc-mp-count-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--xc-bg);
        border: 1px solid var(--xc-line);
        color: var(--xc-ink-soft);
        font-size: 12.5px;
        font-weight: 700;
        padding: 6px 13px;
        border-radius: 999px;
        white-space: nowrap;
    }

    /* ── Body ── */
    .xc-mp-card .card-body {
        padding: 20px;
    }

    .xc-mp-table-scroll {
        width: 100%;
        overflow-x: auto;
        border-radius: 10px;
        border: 1px solid var(--xc-line);
    }

    .xc-mp-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        min-width: 760px;
    }

    .xc-mp-table thead,
    .xc-mp-table thead tr,
    .xc-mp-table thead th {
        background-color: var(--xc-bg) !important;
        background: var(--xc-bg) !important;
    }

    .xc-mp-table thead th {
        color: var(--xc-ink-soft) !important;
        -webkit-text-fill-color: var(--xc-ink-soft) !important;
        font-size: 11.5px;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: .05em;
        padding: 12px 16px;
        border: none !important;
        border-bottom: 1px solid var(--xc-line) !important;
        white-space: nowrap;
        text-align: left;
        text-shadow: none !important;
    }

    .xc-mp-table tbody tr {
        border-bottom: 1px solid var(--xc-line);
        transition: background-color .15s ease;
    }

    .xc-mp-table tbody tr:last-child {
        border-bottom: none;
    }

    .xc-mp-table tbody tr:hover {
        background-color: var(--xc-accent-soft);
    }

    .xc-mp-table tbody td {
        padding: 13px 16px;
        font-size: 13.5px;
        color: var(--xc-ink);
        border: none;
        vertical-align: middle;
        background: var(--xc-surface);
    }

    .xc-mp-date {
        font-weight: 600;
        color: var(--xc-ink);
        white-space: nowrap;
    }

    .xc-mp-project {
        font-weight: 600;
        color: var(--xc-ink);
    }

    .xc-mp-figure {
        font-weight: 700;
        color: var(--xc-accent-dark);
    }

    /* ── Status badge ── */
    .xc-mp-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
        border: 1px solid transparent;
    }

    .xc-mp-status::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--xc-accent);
        flex-shrink: 0;
    }

    /* ── Action buttons ── */
    .xc-mp-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .xc-mp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 7px;
        border: 1px solid var(--xc-line);
        background: var(--xc-surface);
        text-decoration: none;
        transition: all .15s ease;
        flex-shrink: 0;
        color: var(--xc-ink-soft);
    }

    .xc-mp-btn i {
        font-size: 15px;
    }

    .xc-mp-btn:hover {
        text-decoration: none;
    }

    .xc-mp-btn.view:hover {
        background: var(--xc-accent);
        border-color: var(--xc-accent);
        color: #fff;
    }

    .xc-mp-btn.print:hover {
        background: var(--xc-navy);
        border-color: var(--xc-navy);
        color: #fff;
    }

    .xc-mp-btn.download:hover {
        background: var(--xc-purple);
        border-color: var(--xc-purple);
        color: #fff;
    }

    /* ── Empty state ── */
    .xc-mp-empty {
        text-align: center;
        padding: 44px 20px;
        color: var(--xc-muted);
    }

    .xc-mp-empty i {
        font-size: 36px;
        color: var(--xc-line);
        display: block;
        margin-bottom: 10px;
    }

    .xc-mp-empty p {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
    }

    /* ── Responsive: card-stacked rows ── */
    @media (max-width: 768px) {
        .xc-mp-card .card-header {
            padding: 14px 16px;
        }

        .xc-mp-card .card-header h4 {
            font-size: 15px;
        }

        .xc-mp-card .card-body {
            padding: 14px;
        }

        .xc-mp-table-scroll {
            border: none;
        }

        .xc-mp-table {
            min-width: 0;
        }

        .xc-mp-table thead {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            clip: rect(0 0 0 0);
        }

        .xc-mp-table,
        .xc-mp-table tbody,
        .xc-mp-table tbody tr,
        .xc-mp-table tbody td {
            display: block;
            width: 100%;
        }

        .xc-mp-table tbody tr {
            border: 1px solid var(--xc-line);
            border-radius: 10px;
            margin-bottom: 12px;
            padding: 4px;
            background: var(--xc-surface);
        }

        .xc-mp-table tbody tr:hover {
            background-color: var(--xc-surface);
        }

        .xc-mp-table tbody td {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 14px;
            border-bottom: 1px dashed var(--xc-line);
            text-align: right;
        }

        .xc-mp-table tbody td:last-child {
            border-bottom: none;
        }

        .xc-mp-table tbody td::before {
            content: attr(data-label);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--xc-muted);
            text-align: left;
        }

        .xc-mp-actions {
            justify-content: flex-end;
        }
    }

    @media (max-width: 480px) {
        .xc-mp-header-sub {
            display: none;
        }

        .xc-mp-count-pill {
            font-size: 11px;
            padding: 5px 10px;
        }

        .xc-mp-table tbody td {
            font-size: 13px;
            padding: 9px 12px;
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
        --xc-purple-soft: rgba(124, 58, 237, 0.14);
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-mp-wrapper">
            <div class="card xc-mp-card">

                <div class="card-header">
                    <div class="xc-mp-header-left">
                        <span class="xc-mp-header-icon">
                            <i class='bx bx-group'></i>
                        </span>
                        <div>
                            <h4>Manpower Report List</h4>
                            <p class="xc-mp-header-sub">Daily workforce reports across all projects</p>
                        </div>
                    </div>
                    <span class="xc-mp-count-pill">
                        <i class='bx bx-list-ul'></i>
                        <?= count($reports); ?> Reports
                    </span>
                </div>

                <div class="card-body">

                    <div class="xc-mp-table-scroll">

                        <table class="table xc-mp-table">

                            <thead>

                                <tr>

                                    <th>Date</th>
                                    <th>Project</th>
                                    <th>Total</th>
                                    <th>Skilled</th>
                                    <th>Unskilled</th>
                                    <th>Engineer</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (count($reports) > 0) { ?>

                                    <?php foreach ($reports as $row) { ?>

                                        <tr>

                                            <td data-label="Date" class="xc-mp-date">
                                                <?= date('d-m-Y', strtotime($row->report_date)); ?>
                                            </td>

                                            <td data-label="Project" class="xc-mp-project">
                                                <?= $row->project_name; ?>
                                            </td>

                                            <td data-label="Total" class="xc-mp-figure">
                                                <?= $row->total_workers; ?>
                                            </td>

                                            <td data-label="Skilled"><?= $row->skilled_workers; ?></td>

                                            <td data-label="Unskilled"><?= $row->unskilled_workers; ?></td>

                                            <td data-label="Engineer"><?= $row->engineer; ?></td>

                                            <td data-label="Status">

                                                <span class="xc-mp-status">
                                                    <?= $row->status; ?>
                                                </span>

                                            </td>

                                            <td data-label="Action">

                                                <div class="xc-mp-actions">

                                                    <a href="<?= base_url('admin/view_manpower/' . $row->id); ?>"
                                                        class="xc-mp-btn view" title="View">
                                                        <i class="bx bx-show"></i>
                                                    </a>

                                                    <a href="<?= base_url('employee/print_manpower/' . $row->id); ?>"
                                                        class="xc-mp-btn print" title="Print">
                                                        <i class="bx bx-printer"></i>
                                                    </a>

                                                    <a href="<?= base_url('employee/download_manpower/' . $row->id); ?>"
                                                        class="xc-mp-btn download" title="Download">
                                                        <i class="bx bx-download"></i>
                                                    </a>

                                                </div>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="8" style="padding:0; border:none;">
                                            <div class="xc-mp-empty">
                                                <i class='bx bx-file-blank'></i>
                                                <p>No manpower reports found.</p>
                                            </div>
                                        </td>
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
