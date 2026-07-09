<style>
    .xc-monitor-wrapper {
        --xc-bg: #f4f7f8;
        --xc-surface: #ffffff;
        --xc-border: #e4e6ea;
        --xc-border-soft: #eef1f3;
        --xc-text: #1a1a2e;
        --xc-text-muted: #7c8590;
        --xc-text-muted2: #5c6470;
        --xc-text-faint: #9aa3a9;
        --xc-icon-faint: #cfd4d8;
        --xc-table-head-bg: #f8fafa;
        --xc-row-hover: #f8fafa;
        --xc-progress-track: #eef1f3;
        --xc-shadow-soft: rgba(15, 180, 160, 0.06);
        --xc-shadow-card: rgba(15, 180, 160, 0.04);

        background: var(--xc-bg);
        padding: 24px;
        min-height: 100%;
        transition: background-color 0.25s ease, color 0.25s ease;
    }

    /* ---------- Dark mode: driven by the header's data-bs-theme toggle on <html> ---------- */
    [data-bs-theme="dark"] .xc-monitor-wrapper {
        --xc-bg: #10131a;
        --xc-surface: #1b1f27;
        --xc-border: #2b313b;
        --xc-border-soft: #262b33;
        --xc-text: #eef1f3;
        --xc-text-muted: #9aa5b1;
        --xc-text-muted2: #b7c0c9;
        --xc-text-faint: #707a86;
        --xc-icon-faint: #4a525c;
        --xc-table-head-bg: #20252d;
        --xc-row-hover: #232833;
        --xc-progress-track: #2b313b;
        --xc-shadow-soft: rgba(0, 0, 0, 0.35);
        --xc-shadow-card: rgba(0, 0, 0, 0.25);
    }

    .xc-monitor-wrapper * {
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    }

    /* ---------- Page Header ---------- */
    .xc-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 20px;
    }

    .xc-page-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .xc-page-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(15, 180, 160, 0.25);
    }

    .xc-page-icon svg {
        width: 22px;
        height: 22px;
        stroke: #ffffff;
    }

    .xc-page-header h4 {
        color: var(--xc-text);
        font-weight: 700;
        font-size: 19px;
        margin: 0;
        line-height: 1.2;
    }

    .xc-page-header p {
        margin: 2px 0 0;
        color: var(--xc-text-muted);
        font-size: 12.5px;
    }

    .xc-export-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: 40px;
        padding: 0 16px;
        border-radius: 10px;
        border: 1px solid var(--xc-border);
        background: var(--xc-surface);
        color: var(--xc-text);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: border-color 0.15s, color 0.15s;
    }

    .xc-export-btn:hover {
        border-color: #0fb4a0;
        color: #0fb4a0;
    }

    .xc-export-btn svg {
        width: 15px;
        height: 15px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* ---------- Stat Cards ---------- */
    .xc-stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .xc-stat-card {
        background: var(--xc-surface);
        border: 1px solid var(--xc-border);
        border-radius: 14px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 8px var(--xc-shadow-card);
    }

    .xc-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-stat-icon svg {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-stat-icon.xc-stat-total {
        background: rgba(15, 180, 160, 0.1);
        color: #0fb4a0;
    }

    .xc-stat-icon.xc-stat-ontrack {
        background: rgba(15, 180, 160, 0.1);
        color: #0d8a7b;
    }

    .xc-stat-icon.xc-stat-today {
        background: rgba(245, 166, 35, 0.12);
        color: #b8770f;
    }

    .xc-stat-icon.xc-stat-overdue {
        background: rgba(220, 53, 69, 0.1);
        color: #c5293a;
    }

    .xc-stat-value {
        font-size: 21px;
        font-weight: 700;
        color: var(--xc-text);
        line-height: 1.15;
    }

    .xc-stat-label {
        font-size: 12px;
        color: var(--xc-text-muted);
        font-weight: 500;
        margin-top: 1px;
    }

    /* ---------- Main Card ---------- */
    .xc-monitor-card {
        background: var(--xc-surface);
        border-radius: 16px;
        border: 1px solid var(--xc-border);
        box-shadow: 0 2px 10px var(--xc-shadow-soft);
        overflow: hidden;
    }

    .xc-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--xc-border-soft);
    }

    .xc-search-box {
        position: relative;
        flex: 1;
        max-width: 320px;
        min-width: 200px;
    }

    .xc-search-box svg {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        stroke: var(--xc-text-faint);
        fill: none;
        stroke-width: 2;
    }

    .xc-search-box input {
        width: 100%;
        height: 40px;
        border: 1px solid var(--xc-border);
        border-radius: 10px;
        padding: 0 14px 0 36px;
        font-size: 13.5px;
        color: var(--xc-text);
        background: var(--xc-surface);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .xc-search-box input::placeholder {
        color: var(--xc-text-faint);
    }

    .xc-search-box input:focus {
        border-color: #0fb4a0;
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.12);
    }

    .xc-filter-pills {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .xc-filter-pill {
        height: 36px;
        padding: 0 14px;
        border-radius: 20px;
        border: 1px solid var(--xc-border);
        background: var(--xc-surface);
        color: var(--xc-text-muted2);
        font-size: 12.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .xc-filter-pill:hover {
        border-color: #0fb4a0;
        color: #0fb4a0;
    }

    .xc-filter-pill.active {
        background: #0fb4a0;
        border-color: #0fb4a0;
        color: #ffffff;
    }

    .xc-monitor-body {
        padding: 0;
    }

    /* ---------- Table ---------- */
    .xc-table-scroll {
        overflow-x: auto;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
        min-width: 980px;
    }

    .xc-table thead th {
        background: var(--xc-table-head-bg);
        color: var(--xc-text-muted);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid var(--xc-border);
        white-space: nowrap;
    }

    .xc-table tbody td {
        padding: 14px 16px;
        color: var(--xc-text);
        border-bottom: 1px solid var(--xc-border-soft);
        vertical-align: middle;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-table tbody tr {
        transition: background 0.12s;
    }

    .xc-table tbody tr:hover {
        background: var(--xc-row-hover);
    }

    .xc-table tbody tr.xc-empty-row td {
        text-align: center;
        color: var(--xc-text-faint);
        padding: 48px 16px;
    }

    .xc-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .xc-empty-state svg {
        width: 40px;
        height: 40px;
        stroke: var(--xc-icon-faint);
        fill: none;
        stroke-width: 1.6;
    }

    /* Project cell */
    .xc-project-name {
        font-weight: 600;
        color: var(--xc-text);
    }

    /* Engineer chips */
    .xc-engineer-stack {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .xc-engineer-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: var(--xc-text);
    }

    .xc-engineer-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #0fb4a0;
        flex-shrink: 0;
    }

    /* Action buttons */
    .xc-action-group {
        display: flex;
        gap: 6px;
    }

    .xc-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 33px;
        height: 33px;
        border-radius: 9px;
        border: 1px solid var(--xc-border);
        background: var(--xc-surface);
        color: var(--xc-text-muted2);
        text-decoration: none;
        transition: background 0.15s, border-color 0.15s, color 0.15s;
    }

    .xc-action-btn:hover {
        background: #0fb4a0;
        border-color: #0fb4a0;
        color: #ffffff;
    }

    .xc-action-btn svg {
        width: 15px;
        height: 15px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-action-btn.xc-chat-btn svg {
        fill: currentColor;
        stroke: none;
    }

    /* Badges */
    .xc-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .xc-badge::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .xc-badge-success {
        background: rgba(15, 180, 160, 0.12);
        color: #17c9b0;
    }

    .xc-badge-success::before {
        background: #0d8a7b;
    }

    .xc-badge-warning {
        background: rgba(245, 166, 35, 0.14);
        color: #e0a23a;
    }

    .xc-badge-warning::before {
        background: #b8770f;
    }

    .xc-badge-danger {
        background: rgba(220, 53, 69, 0.12);
        color: #e5566a;
    }

    .xc-badge-danger::before {
        background: #c5293a;
    }

    /* Progress */
    .xc-progress-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 110px;
    }

    .xc-progress-track {
        width: 80px;
        height: 7px;
        background: var(--xc-progress-track);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        flex-shrink: 0;
    }

    .xc-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #0fb4a0, #15d6bf);
        border-radius: 20px;
    }

    .xc-progress-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--xc-text);
        min-width: 30px;
    }

    @media (max-width: 768px) {
        .xc-stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-monitor-wrapper">

            <?php

            // ---- Derive summary counts without touching original query/variable logic ----
            $xc_total_count = !empty($projects) ? count($projects) : 0;
            $xc_ontrack_count = 0;
            $xc_today_count = 0;
            $xc_overdue_count = 0;

            if (!empty($projects)) {

                foreach ($projects as $xc_p) {

                    $xc_last_capture = $this->db
                        ->select('created_at')
                        ->from('project_images')
                        ->where('project_id', $xc_p->id)
                        ->order_by('id', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row();

                    if ($xc_last_capture) {
                        $xc_capture_date = strtotime($xc_last_capture->created_at);
                    } else {
                        $xc_capture_date = strtotime($xc_p->start_date);
                    }

                    $xc_cycle_days = (int) $xc_p->monitoring_cycle;

                    $xc_next_capture = strtotime("+{$xc_cycle_days} days", $xc_capture_date);

                    $xc_today = strtotime(date('Y-m-d'));

                    $xc_remaining = ceil(($xc_next_capture - $xc_today) / 86400);

                    if ($xc_remaining > 0) {
                        $xc_ontrack_count++;
                    } elseif ($xc_remaining == 0) {
                        $xc_today_count++;
                    } else {
                        $xc_overdue_count++;
                    }
                }
            }

            ?>

            <div class="xc-page-header">

                <div class="xc-page-header-left">

                    <div class="xc-page-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 3v18h18"></path>
                            <path d="M18 17V9"></path>
                            <path d="M13 17V5"></path>
                            <path d="M8 17v-3"></path>
                        </svg>
                    </div>

                    <div>
                        <h4>Project Monitoring</h4>
                        <p>Track progress, cycles and engineer assignments across all projects</p>
                    </div>

                </div>

                <button class="xc-export-btn" type="button" onclick="window.print()">
                    <svg viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Export
                </button>

            </div>

            <div class="xc-stats-row">

                <div class="xc-stat-card">
                    <div class="xc-stat-icon xc-stat-total">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                        </svg>
                    </div>
                    <div>
                        <div class="xc-stat-value"><?= $xc_total_count ?></div>
                        <div class="xc-stat-label">Total Projects</div>
                    </div>
                </div>

                <div class="xc-stat-card">
                    <div class="xc-stat-icon xc-stat-ontrack">
                        <svg viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div class="xc-stat-value"><?= $xc_ontrack_count ?></div>
                        <div class="xc-stat-label">On Track</div>
                    </div>
                </div>

                <div class="xc-stat-card">
                    <div class="xc-stat-icon xc-stat-today">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div>
                        <div class="xc-stat-value"><?= $xc_today_count ?></div>
                        <div class="xc-stat-label">Due Today</div>
                    </div>
                </div>

                <div class="xc-stat-card">
                    <div class="xc-stat-icon xc-stat-overdue">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                            </path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div>
                        <div class="xc-stat-value"><?= $xc_overdue_count ?></div>
                        <div class="xc-stat-label">Overdue</div>
                    </div>
                </div>

            </div>

            <div class="xc-monitor-card">

                <div class="xc-toolbar">

                    <div class="xc-search-box">
                        <svg viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" id="xc-search-input" placeholder="Search project or customer...">
                    </div>

                    <div class="xc-filter-pills">
                        <div class="xc-filter-pill active" data-filter="all">All</div>
                        <div class="xc-filter-pill" data-filter="ontrack">On Track</div>
                        <div class="xc-filter-pill" data-filter="today">Today</div>
                        <div class="xc-filter-pill" data-filter="overdue">Overdue</div>
                    </div>

                </div>

                <div class="xc-monitor-body">

                    <div class="xc-table-scroll">

                        <table class="xc-table" id="xc-monitor-table">

                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th width="90">Action</th>
                                    <th>Engineer</th>
                                    <th>Customer</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Cycle Days</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if (!empty($projects)) { ?>

                                    <?php foreach ($projects as $project) { ?>

                                        <?php

                                        // Customer
                                        $customer = $this->db
                                            ->where('id', $project->customer_id)
                                            ->get('customers')
                                            ->row();

                                        // Last Capture
                                        $last_capture = $this->db
                                            ->select('created_at')
                                            ->from('project_images')
                                            ->where('project_id', $project->id)
                                            ->order_by('id', 'DESC')
                                            ->limit(1)
                                            ->get()
                                            ->row();

                                        if ($last_capture) {
                                            $capture_date = strtotime($last_capture->created_at);
                                        } else {
                                            $capture_date = strtotime($project->start_date);
                                        }

                                        $cycle_days = (int) $project->monitoring_cycle;

                                        $next_capture =
                                            strtotime("+{$cycle_days} days", $capture_date);

                                        $today = strtotime(date('Y-m-d'));

                                        $remaining =
                                            ceil(($next_capture - $today) / 86400);

                                        // Row-level status flag used only for filter pills (data attribute), no logic change
                                        if ($remaining > 0) {
                                            $xc_row_status = 'ontrack';
                                        } elseif ($remaining == 0) {
                                            $xc_row_status = 'today';
                                        } else {
                                            $xc_row_status = 'overdue';
                                        }

                                        ?>

                                        <tr data-status="<?= $xc_row_status ?>"
                                            data-search="<?= strtolower(($project->project_name ?? '') . ' ' . (!empty($customer) ? $customer->name : '')) ?>">

                                            <td>
                                                <span class="xc-project-name">
                                                    <?= !empty($project->project_name)
                                                        ? $project->project_name
                                                        : '-' ?>
                                                </span>
                                            </td>

                                            <td>

                                                <div class="xc-action-group">

                                                    <a href="<?= base_url('index.php/admin/project_dashboard/' . $project->id) ?>"
                                                        class="xc-action-btn" title="View">

                                                        <svg viewBox="0 0 24 24">
                                                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>

                                                    </a>

                                                    <a href="<?= base_url('index.php/chat/project/' . $project->id) ?>"
                                                        class="xc-action-btn xc-chat-btn" title="Chat">

                                                        <svg viewBox="0 0 24 24">
                                                            <path
                                                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                                            </path>
                                                        </svg>

                                                    </a>
                                                    <a href="<?= base_url('index.php/materials/project_reports/' . $project->id) ?>"
                                                        class="xc-action-btn" title="Materials Report">

                                                        <i class="bx bx-package"></i>

                                                    </a>
                                                </div>

                                            </td>

                                            <td>

                                                <?php

                                                $engineers = $this->db
                                                    ->select('team_members.name')
                                                    ->from('project_team')
                                                    ->join(
                                                        'team_members',
                                                        'team_members.id = project_team.team_member_id'
                                                    )
                                                    ->where(
                                                        'project_team.project_id',
                                                        $project->id
                                                    )
                                                    ->where(
                                                        'project_team.role',
                                                        'engineer'
                                                    )
                                                    ->get()
                                                    ->result();

                                                if (!empty($engineers)) {

                                                    echo '<div class="xc-engineer-stack">';

                                                    foreach ($engineers as $eng) {

                                                        echo '<span class="xc-engineer-chip"><span class="xc-engineer-dot"></span>' .
                                                            $eng->name .
                                                            '</span>';
                                                    }

                                                    echo '</div>';

                                                } else {

                                                    echo '-';
                                                }

                                                ?>

                                            </td>

                                            <td>
                                                <?= !empty($customer)
                                                    ? $customer->name
                                                    : '-' ?>
                                            </td>

                                            <td>
                                                <?= !empty($project->start_date)
                                                    ? date(
                                                        'd-m-Y',
                                                        strtotime(
                                                            $project->start_date
                                                        )
                                                    )
                                                    : '-' ?>
                                            </td>

                                            <td>
                                                <?= !empty($project->end_date)
                                                    ? date(
                                                        'd-m-Y',
                                                        strtotime(
                                                            $project->end_date
                                                        )
                                                    )
                                                    : '-' ?>
                                            </td>

                                            <td>

                                                <?php if ($remaining > 0) { ?>

                                                    <span class="xc-badge xc-badge-success">
                                                        <?= $remaining ?>
                                                        Day<?= $remaining > 1 ? 's' : '' ?> Left
                                                    </span>

                                                <?php } elseif ($remaining == 0) { ?>

                                                    <span class="xc-badge xc-badge-warning">
                                                        Today
                                                    </span>

                                                <?php } else { ?>

                                                    <span class="xc-badge xc-badge-danger">
                                                        Overdue
                                                        <?= abs($remaining) ?>
                                                        Day<?= abs($remaining) > 1 ? 's' : '' ?>
                                                    </span>

                                                <?php } ?>

                                            </td>

                                            <td>

                                                <div class="xc-progress-wrap">
                                                    <div class="xc-progress-track">
                                                        <div class="xc-progress-fill"
                                                            style="width: <?= $project->progress ?>%;">
                                                        </div>
                                                    </div>

                                                    <span class="xc-progress-label">
                                                        <?= $project->progress ?>%
                                                    </span>
                                                </div>

                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr class="xc-empty-row">
                                        <td colspan="8">
                                            <div class="xc-empty-state">
                                                <svg viewBox="0 0 24 24">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                                </svg>
                                                No Projects Found
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

<script>
    // Lightweight client-side search + filter, purely cosmetic, no PHP/AJAX touched
    (function () {

        var searchInput = document.getElementById('xc-search-input');
        var pills = document.querySelectorAll('.xc-filter-pill');
        var rows = document.querySelectorAll('#xc-monitor-table tbody tr[data-status]');
        var activeFilter = 'all';

        function applyFilters() {

            var term = (searchInput.value || '').toLowerCase().trim();

            rows.forEach(function (row) {

                var statusMatch = (activeFilter === 'all' || row.getAttribute('data-status') === activeFilter);
                var searchMatch = (term === '' || (row.getAttribute('data-search') || '').indexOf(term) !== -1);

                row.style.display = (statusMatch && searchMatch) ? '' : 'none';
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        pills.forEach(function (pill) {

            pill.addEventListener('click', function () {

                pills.forEach(function (p) { p.classList.remove('active'); });
                pill.classList.add('active');

                activeFilter = pill.getAttribute('data-filter');

                applyFilters();
            });
        });

    })();
</script>