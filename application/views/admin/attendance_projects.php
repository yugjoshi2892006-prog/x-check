<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-pa-wrap">

            <div class="xc-pa-breadcrumb">
                Dashboard <i class='bx bx-chevron-right'></i> <span>Project Attendance</span>
            </div>

            <div class="xc-pa-card">

                <div class="xc-pa-card-header">
                    <h4>
                        <span class="xc-pa-icon">
                            <i class="bx bx-calendar-check"></i>
                        </span>
                        Project Attendance
                    </h4>
                    <?php if (!empty($projects)) { ?>
                            <span class="xc-pa-count-pill"><?= count($projects) ?> Projects</span>
                    <?php } ?>
                </div>

                <div class="xc-pa-card-body">

                    <div class="xc-pa-table-wrapper">
                        <table class="table xc-pa-table">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Name</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($projects)) { ?>
                                        <?php foreach ($projects as $project) { ?>
                                                <tr>
                                                    <td data-label="ID">
                                                        <span class="xc-pa-id">#<?= $project->id ?></span>
                                                    </td>
                                                    <td data-label="Project Name">
                                                        <?= htmlspecialchars($project->project_name) ?>
                                                    </td>
                                                    <td data-label="Action">
                                                        <a href="<?= base_url('admin/attendance_list/' . $project->id) ?>"
                                                            class="xc-pa-btn">
                                                            <i class='bx bx-show'></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php } ?>
                                <?php } else { ?>
                                        <tr>
                                            <td colspan="3" style="padding:0; border:none;">
                                                <div class="xc-pa-empty">
                                                    <i class='bx bx-calendar-x'></i>
                                                    <p>No Projects Found</p>
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
    }

    * {
        box-sizing: border-box;
    }

    .xc-pa-wrap {
        padding: 4px;
    }

    .xc-pa-breadcrumb {
        font-size: 13px;
        color: var(--xc-muted);
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .xc-pa-breadcrumb span {
        color: var(--xc-ink);
        font-weight: 600;
    }

    /* ── Card shell ── */
    .xc-pa-card {
        background: var(--xc-surface);
        border: 1px solid var(--xc-line);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: background .2s ease, border-color .2s ease;
    }

    .xc-pa-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 22px;
        background: var(--xc-surface);
        border-bottom: 1px solid var(--xc-line);
    }

    .xc-pa-card-header h4 {
        margin: 0;
        color: var(--xc-ink);
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xc-pa-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
        flex-shrink: 0;
        font-size: 16px;
    }

    .xc-pa-count-pill {
        font-size: 12px;
        font-weight: 700;
        color: var(--xc-ink-soft);
        background: var(--xc-bg);
        border: 1px solid var(--xc-line);
        padding: 5px 12px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .xc-pa-card-body {
        padding: 22px;
    }

    /* ── Table ── */
    .xc-pa-table-wrapper {
        overflow-x: auto;
        border: 1px solid var(--xc-line);
        border-radius: 10px;
    }

    .xc-pa-table.table {
        --bs-table-color: initial;
        --bs-table-bg: transparent;
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        font-size: 13.5px;
    }

    .xc-pa-table.table thead tr {
        background-color: var(--xc-bg) !important;
    }

    .xc-pa-table.table thead tr th,
    .xc-pa-table.table>thead>tr>th {
        color: var(--xc-ink-soft) !important;
        -webkit-text-fill-color: var(--xc-ink-soft) !important;
        background-color: transparent !important;
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 12px 16px;
        border: none !important;
        border-bottom: 1px solid var(--xc-line) !important;
        white-space: nowrap;
        text-align: left;
    }

    .xc-pa-table tbody td {
        padding: 12px 16px;
        color: var(--xc-ink);
        border-bottom: 1px solid var(--xc-line);
        background: var(--xc-surface);
        vertical-align: middle;
    }

    .xc-pa-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-pa-table tbody tr:hover td {
        background: var(--xc-accent-soft);
    }

    .xc-pa-id {
        color: var(--xc-muted);
        font-weight: 600;
        font-size: 13px;
    }

    .xc-pa-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 7px;
        border: 1.5px solid var(--xc-accent);
        background: transparent;
        color: var(--xc-accent-dark);
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .xc-pa-btn:hover {
        background: var(--xc-accent);
        color: #fff;
        text-decoration: none;
    }

    .xc-pa-empty {
        text-align: center;
        padding: 40px 20px;
        color: var(--xc-muted);
    }

    .xc-pa-empty i {
        font-size: 36px;
        color: var(--xc-line);
        display: block;
        margin-bottom: 10px;
    }

    .xc-pa-empty p {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .xc-pa-card {
            border-radius: 10px;
        }

        .xc-pa-card-header {
            padding: 14px 16px;
        }

        .xc-pa-card-header h4 {
            font-size: 15px;
        }

        .xc-pa-card-body {
            padding: 16px;
        }
    }

    @media (max-width: 576px) {
        .xc-pa-table-wrapper {
            border: none;
        }

        .xc-pa-table thead {
            display: none;
        }

        .xc-pa-table tbody tr {
            display: block;
            margin-bottom: 12px;
            border: 1px solid var(--xc-line);
            border-radius: 10px;
            overflow: hidden;
        }

        .xc-pa-table tbody tr:hover td {
            background: var(--xc-surface);
        }

        .xc-pa-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px dashed var(--xc-line);
        }

        .xc-pa-table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--xc-muted);
            margin-right: 12px;
        }

        .xc-pa-table tbody tr td:last-child {
            border-bottom: none;
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
    }

    html.xc-dark .xc-pa-table.table thead tr {
        background-color: #10141d !important;
    }
</style>
