<style>
    .xc-dash-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    /* Stat card */
    .xc-stat-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 24px;
    }

    .xc-stat-card {
        flex: 0 0 280px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        padding: 22px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        overflow: hidden;
    }

    .xc-stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 13px;
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-stat-icon svg {
        width: 26px;
        height: 26px;
        stroke: #ffffff;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #8a929a;
        margin: 0 0 4px;
    }

    .xc-stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
        line-height: 1;
    }

    /* Projects card */
    .xc-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
    }

    .xc-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #e4e6ea;
        font-size: 15.5px;
        font-weight: 700;
        color: #1a1a2e;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xc-card-header svg {
        width: 18px;
        height: 18px;
        stroke: #0fb4a0;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-card-body {
        padding: 8px 24px 22px;
    }

    /* Table */
    .xc-table-wrap {
        overflow-x: auto;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .xc-table thead th {
        background: #f0fbf9;
        color: #0d9c8a;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-align: left;
        padding: 13px 16px;
        border-bottom: 1px solid #e4e6ea;
        white-space: nowrap;
    }

    .xc-table tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid #eef0f2;
        color: #1a1a2e;
        vertical-align: middle;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-table tbody tr {
        transition: background 0.15s;
    }

    .xc-table tbody tr:hover {
        background: #f8fcfb;
    }

    .xc-id-cell {
        color: #8a929a;
        font-weight: 600;
        font-size: 13px;
    }

    .xc-project-name {
        font-weight: 600;
        color: #1a1a2e;
    }

    /* Status pills */
    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 13px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .xc-pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .xc-pill-active,
    .xc-pill-ongoing {
        background: rgba(46, 230, 168, 0.14);
        color: #0d9c8a;
    }

    .xc-pill-active::before,
    .xc-pill-ongoing::before {
        background: #0d9c8a;
    }

    .xc-pill-pending {
        background: rgba(255, 176, 32, 0.14);
        color: #c98a00;
    }

    .xc-pill-pending::before {
        background: #f0a500;
    }

    .xc-pill-completed {
        background: rgba(99, 102, 241, 0.12);
        color: #4f46e5;
    }

    .xc-pill-completed::before {
        background: #6366f1;
    }

    .xc-pill-on_hold,
    .xc-pill-hold {
        background: rgba(239, 68, 68, 0.12);
        color: #dc2626;
    }

    .xc-pill-on_hold::before,
    .xc-pill-hold::before {
        background: #ef4444;
    }

    .xc-pill-default {
        background: #eef0f2;
        color: #5a6169;
    }

    .xc-pill-default::before {
        background: #9aa3a9;
    }

    /* Action buttons */
    .xc-actions {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .xc-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid transparent;
        transition: background 0.15s, color 0.15s, border-color 0.15s;
        white-space: nowrap;
    }

    .xc-btn svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-btn-view {
        background: #0fb4a0;
        color: #ffffff;
    }

    .xc-btn-view:hover {
        background: #0d9c8a;
        color: #ffffff;
    }

    .xc-btn-chat {
        background: transparent;
        color: #0fb4a0;
        border-color: #0fb4a0;
    }

    .xc-btn-chat:hover {
        background: rgba(15, 180, 160, 0.08);
        color: #0d9c8a;
    }

    .xc-empty-row td {
        text-align: center;
        color: #9aa3a9;
        padding: 32px 16px;
        font-size: 13.5px;
    }

    @media (max-width: 575px) {
        .xc-stat-card {
            flex: 1 1 100%;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-dash-wrapper">

            <div class="xc-stat-row">

                <div class="xc-stat-card">

                    <div class="xc-stat-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 21h18"></path>
                            <path d="M5 21V7l8-4v18"></path>
                            <path d="M19 21V11l-6-4"></path>
                        </svg>
                    </div>

                    <div>
                        <p class="xc-stat-label">Asigned Projects</p>
                        <h2 class="xc-stat-value"><?= count($projects); ?></h2>
                    </div>

                </div>

            </div>

            <div class="xc-card">

                <div class="xc-card-header">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                        <path d="M3 9h18"></path>
                        <path d="M9 21V9"></path>
                    </svg>
                    My Projects
                </div>

                <div class="xc-card-body">

                    <div class="xc-table-wrap">

                        <table class="xc-table">

                            <thead>

                                <tr>
                                    <th>ID</th>
                                    <th>Project</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if (empty($projects)) { ?>

                                    <tr class="xc-empty-row">
                                        <td colspan="4">No projects assigned yet.</td>
                                    </tr>

                                <?php } else {
                                    foreach ($projects as $row) {

                                        $xc_status_key = strtolower(str_replace(' ', '_', (string) $row->status));

                                        ?>

                                        <tr>

                                            <td>
                                                <span class="xc-id-cell">#<?= $row->id ?></span>
                                            </td>

                                            <td>
                                                <span class="xc-project-name">
                                                    <?= $row->project_name ?>
                                                </span>
                                            </td>

                                            <td>
                                                <span class="xc-pill xc-pill-<?= $xc_status_key ?: 'default' ?>">
                                                    <?= $row->status ?>
                                                </span>
                                            </td>

                                            <td>
                                                <div class="xc-actions">

                                                    <a href="<?= base_url('employee/project/' . $row->id) ?>"
                                                        class="xc-btn xc-btn-view">
                                                        <svg viewBox="0 0 24 24">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                        View
                                                    </a>

                                                    <a href="<?= base_url('chat/project/' . $row->id) ?>"
                                                        class="xc-btn xc-btn-chat">
                                                        <svg viewBox="0 0 24 24">
                                                            <path
                                                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                                            </path>
                                                        </svg>
                                                        Chat
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>

                                    <?php }
                                } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
