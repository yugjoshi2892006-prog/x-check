<?php defined('BASEPATH') OR exit('No direct script access allowed');
$running = [];
$grand_received_cost = 0;
$grand_consumed_cost = 0;
$grand_received_qty = 0;
$grand_used_qty = 0;
$material_set = [];

foreach ($reports as $r) {
    $key = (int) $r->subcategory_id;
    if (!isset($running[$key]))
        $running[$key] = ['received' => 0, 'cost' => 0];
    $received = (float) $r->invoice_quantity;
    $at_site = (float) $r->site_quantity;
    $price = (float) $r->price;
    $running[$key]['received'] += $received;
    $used = max(0, $running[$key]['received'] - $at_site);
    $received_cost = $received * $price;
    $consumed_cost = $used * $price;
    $running[$key]['cost'] += $consumed_cost;
    $r->_total_received = $running[$key]['received'];
    $r->_used = $used;
    $r->_received_cost = $received_cost;
    $r->_consumed_cost = $consumed_cost;
    $r->_cumulative_consumed_cost = $running[$key]['cost'];

    $grand_received_cost += $received_cost;
    $grand_consumed_cost += $consumed_cost;
    $grand_received_qty += $received;
    $grand_used_qty += $used;
    $material_set[$key] = true;
}

$material_count = count($material_set);
$record_count = count($reports);
$balance_cost = $grand_received_cost - $grand_consumed_cost;
$balance_positive = $balance_cost >= 0;
?>
<style>
    * {
        box-sizing: border-box;
    }

    .mrx {
        --x-teal: #14b8b3;
        --x-teal-dark: #0e938f;
        --x-teal-light: #e3fbfa;
        --x-navy: #0f172a;
        --x-gray: #64748b;
        --x-gray-light: #94a3b8;
        --x-bg: #eef2f6;
        --x-border: #e5e9ef;
        --x-green: #16a34a;
        --x-green-light: #dcfce7;
        --x-amber: #d97706;
        --x-amber-light: #fef3c7;
        --x-red: #dc2626;
        --x-red-light: #fee2e2;
        --x-blue: #2563eb;
        --x-blue-light: #dbeafe;

        padding: 28px;
        background: var(--x-bg);
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        color: var(--x-navy);
    }

    /* ---------- Header ---------- */
    .mrx-header {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
    }

    .mrx-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .mrx-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--x-teal-light);
        color: var(--x-teal-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .mrx-project-title {
        font-size: 19px;
        font-weight: 700;
        color: var(--x-navy);
        line-height: 1.3;
    }

    .mrx-project-meta {
        color: var(--x-gray);
        font-size: 13px;
        margin-top: 2px;
    }

    .mrx-header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mrx-btn-outline {
        border: 1px solid var(--x-border);
        background: #fff;
        color: var(--x-gray);
        border-radius: 10px;
        padding: 9px 16px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: all 0.15s ease;
    }

    .mrx-btn-outline:hover {
        border-color: var(--x-teal);
        color: var(--x-teal-dark);
        background: var(--x-teal-light);
    }

    .mrx-btn-outline.disabled {
        opacity: 0.45;
        pointer-events: none;
    }

    /* ---------- Stat cards ---------- */
    .mrx-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        gap: 14px;
        margin-bottom: 20px;
    }

    .mrx-stat {
        background: #fff;
        border-radius: 16px;
        padding: 18px 20px;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.04);
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .mrx-stat-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .mrx-stat.received .mrx-stat-icon {
        background: var(--x-teal-light);
        color: var(--x-teal-dark);
    }

    .mrx-stat.consumed .mrx-stat-icon {
        background: var(--x-amber-light);
        color: var(--x-amber);
    }

    .mrx-stat.balance.pos .mrx-stat-icon {
        background: var(--x-green-light);
        color: var(--x-green);
    }

    .mrx-stat.balance.neg .mrx-stat-icon {
        background: var(--x-red-light);
        color: var(--x-red);
    }

    .mrx-stat.materials .mrx-stat-icon {
        background: var(--x-blue-light);
        color: var(--x-blue);
    }

    .mrx-stat-value {
        font-size: 22px;
        font-weight: 800;
        color: var(--x-navy);
        line-height: 1.2;
        font-variant-numeric: tabular-nums;
    }

    .mrx-stat-label {
        font-size: 12px;
        color: var(--x-gray);
        margin-top: 2px;
    }

    /* ---------- Cards ---------- */
    .mrx-card {
        background: #fff;
        border: none;
        border-radius: 16px;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04), 0 4px 12px rgba(15, 23, 42, 0.04);
    }

    .mrx-title {
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        border-bottom: 1px solid var(--x-border);
    }

    .mrx-title-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mrx-title-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: var(--x-teal-light);
        color: var(--x-teal-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .mrx-title-text {
        font-size: 15px;
        font-weight: 700;
        color: var(--x-navy);
    }

    .mrx-title-sub {
        font-size: 12px;
        color: var(--x-gray);
        margin-top: 1px;
    }

    .mrx-title-badge {
        background: var(--x-bg);
        color: var(--x-gray);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .mrx-body {
        padding: 22px;
    }

    /* ---------- Filters ---------- */
    .mrx-filter {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 14px;
        align-items: flex-end;
    }

    .mrx-field {
        display: flex;
        flex-direction: column;
    }

    .mrx-field label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 7px;
        color: var(--x-gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .mrx-field input,
    .mrx-field select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--x-border);
        border-radius: 10px;
        font-size: 13px;
        background: var(--x-bg);
        color: var(--x-navy);
        transition: all 0.15s ease;
    }

    .mrx-field input:focus,
    .mrx-field select:focus {
        outline: none;
        border-color: var(--x-teal);
        background: white;
        box-shadow: 0 0 0 3px rgba(20, 184, 179, 0.12);
    }

    .mrx-button-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mrx-btn {
        border: 0;
        border-radius: 10px;
        background: var(--x-teal);
        color: #fff;
        padding: 10px 20px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 40px;
    }

    .mrx-btn:hover {
        background: var(--x-teal-dark);
    }

    .mrx-reset {
        background: #fff;
        border: 1px solid var(--x-border);
        color: var(--x-gray);
    }

    .mrx-reset:hover {
        border-color: var(--x-red);
        color: var(--x-red);
        background: var(--x-red-light);
    }

    /* ---------- Toolbar ---------- */
    .mrx-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        padding: 16px 22px;
        border-bottom: 1px solid var(--x-border);
    }

    .mrx-toolbar-left,
    .mrx-toolbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .mrx-search-wrap {
        position: relative;
        min-width: 240px;
        max-width: 340px;
    }

    .mrx-search-wrap input {
        width: 100%;
        padding: 9px 14px 9px 36px;
        border: 1px solid var(--x-border);
        border-radius: 999px;
        font-size: 13px;
        background: var(--x-bg);
        color: var(--x-navy);
    }

    .mrx-search-wrap input:focus {
        outline: none;
        border-color: var(--x-teal);
        background: white;
        box-shadow: 0 0 0 3px rgba(20, 184, 179, 0.12);
    }

    .mrx-search-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 13px;
        opacity: 0.5;
        pointer-events: none;
    }

    .mrx-kbd {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 10px;
        color: var(--x-gray-light);
        background: #fff;
        border: 1px solid var(--x-border);
        border-radius: 4px;
        padding: 1px 5px;
        pointer-events: none;
    }

    .mrx-pill-group {
        display: inline-flex;
        background: var(--x-bg);
        border-radius: 999px;
        padding: 3px;
        gap: 2px;
    }

    .mrx-pill {
        border: 0;
        background: transparent;
        color: var(--x-gray);
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .mrx-pill.active {
        background: var(--x-teal);
        color: white;
    }

    .mrx-col-toggle {
        position: relative;
    }

    .mrx-col-panel {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        background: white;
        border: 1px solid var(--x-border);
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
        padding: 10px;
        z-index: 30;
        min-width: 210px;
        max-height: 320px;
        overflow-y: auto;
    }

    .mrx-col-panel.open {
        display: block;
    }

    .mrx-col-panel-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--x-gray-light);
        padding: 4px 6px 8px;
    }

    .mrx-col-panel label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--x-navy);
        padding: 7px 6px;
        cursor: pointer;
        border-radius: 8px;
    }

    .mrx-col-panel label:hover {
        background: var(--x-bg);
    }

    /* ---------- Table ---------- */
    .mrx-scroll {
        overflow-x: auto;
    }

    .mrx-table {
        border-collapse: collapse;
        width: 100%;
        font-size: 13px;
        background: white;
    }

    .mrx-table thead {
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .mrx-table th {
        background: #fff;
        color: var(--x-gray);
        font-weight: 700;
        white-space: nowrap;
        padding: 13px 14px;
        text-align: left;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        user-select: none;
        border-bottom: 1px solid var(--x-border);
    }

    .mrx-table th.no-sort {
        cursor: default;
    }

    .mrx-table th .mrx-sort-arrow {
        display: inline-block;
        margin-left: 4px;
        opacity: 0.35;
        font-size: 10px;
    }

    .mrx-table th.sorted-asc,
    .mrx-table th.sorted-desc {
        color: var(--x-teal-dark);
    }

    .mrx-table th.sorted-asc .mrx-sort-arrow,
    .mrx-table th.sorted-desc .mrx-sort-arrow {
        opacity: 1;
    }

    .mrx-table td {
        border-bottom: 1px solid var(--x-border);
        padding: 13px 14px;
        color: #334155;
        transition: padding 0.15s ease;
    }

    .mrx-table.compact td {
        padding: 7px 14px;
    }

    .mrx-table.compact th {
        padding: 9px 14px;
    }

    .mrx-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .mrx-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .mrx-table tbody tr.mrx-row-selected {
        background-color: var(--x-teal-light);
    }

    .mrx-table tbody tr.mrx-hidden-row {
        display: none;
    }

    .mrx-checkbox-cell {
        width: 36px;
    }

    .mrx-checkbox-cell input,
    th.mrx-checkbox-cell input {
        width: 15px;
        height: 15px;
        accent-color: var(--x-teal);
        cursor: pointer;
    }

    /* Sticky columns */
    .mrx-table th.mrx-sticky,
    .mrx-table td.mrx-sticky {
        position: sticky;
        background: white;
        z-index: 5;
    }

    .mrx-table th.mrx-sticky {
        z-index: 15;
        background: #fff;
    }

    .mrx-table td.mrx-sticky-1,
    .mrx-table th.mrx-sticky-1 {
        left: 0;
        min-width: 36px;
    }

    .mrx-table td.mrx-sticky-2,
    .mrx-table th.mrx-sticky-2 {
        left: 36px;
        min-width: 50px;
    }

    .mrx-table td.mrx-sticky-3,
    .mrx-table th.mrx-sticky-3 {
        left: 86px;
        min-width: 160px;
        box-shadow: 2px 0 4px rgba(15, 23, 42, 0.04);
    }

    .mrx-table tbody tr:hover td.mrx-sticky,
    .mrx-table tbody tr.mrx-row-selected td.mrx-sticky {
        background: #f8fafc;
    }

    .mrx-table tbody tr.mrx-row-selected td.mrx-sticky {
        background: var(--x-teal-light);
    }

    /* Footer totals row */
    .mrx-table tfoot td {
        background: var(--x-bg);
        font-weight: 800;
        color: var(--x-navy);
        border-top: 2px solid var(--x-border);
        border-bottom: none;
        position: sticky;
        bottom: 0;
    }

    .mrx-table tfoot td.mrx-sticky {
        background: var(--x-bg);
        z-index: 6;
    }

    /* ---------- Status pills ---------- */
    .mrx-yes {
        color: var(--x-green);
        font-weight: 700;
        padding: 4px 10px;
        background: var(--x-green-light);
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
    }

    .mrx-no {
        color: var(--x-red);
        font-weight: 700;
        padding: 4px 10px;
        background: var(--x-red-light);
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
    }

    .mrx-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        display: inline-block;
    }

    .mrx-cycle-pill {
        background: var(--x-teal-light);
        padding: 4px 10px;
        border-radius: 999px;
        font-weight: 700;
        color: var(--x-teal-dark);
        font-size: 11px;
    }

    /* File Links */
    .mrx-icon-action {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: var(--x-bg);
        color: var(--x-gray);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 13px;
        transition: all 0.15s ease;
    }

    .mrx-icon-action:hover {
        background: var(--x-teal);
        color: white;
    }

    .mrx-icon-row {
        display: flex;
        gap: 6px;
    }

    /* Currency */
    .mrx-currency {
        font-weight: 700;
        color: var(--x-teal-dark);
    }

    .mrx-consumed-val {
        color: var(--x-amber);
        font-weight: 700;
    }

    /* Empty State */
    .mrx-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--x-gray-light);
    }

    .mrx-empty-icon {
        font-size: 44px;
        margin-bottom: 14px;
    }

    .mrx-empty-text {
        font-size: 15px;
        margin-bottom: 6px;
        color: var(--x-gray);
        font-weight: 600;
    }

    .mrx-empty-subtext {
        font-size: 13px;
        color: var(--x-gray-light);
    }

    /* Number Formatting */
    .mrx-number {
        text-align: right;
        font-variant-numeric: tabular-nums;
        font-weight: 600;
    }

    mark.mrx-mark {
        background: #fde68a;
        color: inherit;
        border-radius: 3px;
        padding: 0 1px;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .mrx {
            padding: 20px;
        }

        .mrx-filter {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .mrx-table {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .mrx {
            padding: 16px;
        }

        .mrx-filter {
            grid-template-columns: 1fr;
        }

        .mrx-button-group {
            width: 100%;
        }

        .mrx-btn,
        .mrx-reset {
            flex: 1;
            justify-content: center;
        }

        .mrx-table {
            font-size: 11px;
        }

        .mrx-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .mrx-toolbar-left,
        .mrx-toolbar-right {
            width: 100%;
        }

        .mrx-search-wrap {
            max-width: none;
            flex: 1;
        }

        .mrx-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .mrx-header-actions {
            width: 100%;
        }

        .mrx-header-actions .mrx-btn-outline {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .mrx-table {
            font-size: 10px;
            min-width: 1300px;
        }

        .mrx-stats {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Print Styles */
    @media print {
        .mrx {
            background: white;
        }

        .mrx-card {
            box-shadow: none;
            page-break-inside: avoid;
        }

        .mrx-filter,
        .mrx-toolbar,
        .mrx-header-actions,
        .mrx-checkbox-cell {
            display: none;
        }

        .mrx-table tbody tr:hover {
            background-color: white;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="mrx" id="mrxRoot">
            <!-- Header -->
            <div class="mrx-header">
                <div class="mrx-header-left">
                    <div class="mrx-header-icon">📦</div>
                    <div>
                        <div class="mrx-project-title"><?= html_escape($project->project_name ?? 'Project'); ?></div>
                        <div class="mrx-project-meta">Material Report • <?= $record_count; ?> records •
                            <?= $material_count; ?> materials
                        </div>
                    </div>
                </div>
                <div class="mrx-header-actions">
                    <button class="mrx-btn-outline" type="button" id="mrxExportBtn">⬇️ Export CSV</button>
                    <button class="mrx-btn-outline" type="button" onclick="window.print()">🖨️ Print</button>
                </div>
            </div>

            <!-- Stat Dashboard -->
            <div class="mrx-stats">
                <div class="mrx-stat received">
                    <div class="mrx-stat-icon">📥</div>
                    <div>
                        <div class="mrx-stat-value">₹<?= number_format($grand_received_cost, 0); ?></div>
                        <div class="mrx-stat-label">Total Received · <?= number_format($grand_received_qty, 2); ?> units
                        </div>
                    </div>
                </div>
                <div class="mrx-stat consumed">
                    <div class="mrx-stat-icon">🔧</div>
                    <div>
                        <div class="mrx-stat-value">₹<?= number_format($grand_consumed_cost, 0); ?></div>
                        <div class="mrx-stat-label">Total Consumed · <?= number_format($grand_used_qty, 2); ?> units
                        </div>
                    </div>
                </div>
                <div class="mrx-stat balance <?= $balance_positive ? 'pos' : 'neg'; ?>">
                    <div class="mrx-stat-icon"><?= $balance_positive ? '✅' : '⚠️'; ?></div>
                    <div>
                        <div class="mrx-stat-value">₹<?= number_format($balance_cost, 0); ?></div>
                        <div class="mrx-stat-label">Balance Value</div>
                    </div>
                </div>
                <div class="mrx-stat materials">
                    <div class="mrx-stat-icon">🧱</div>
                    <div>
                        <div class="mrx-stat-value"><?= $material_count; ?></div>
                        <div class="mrx-stat-label">Materials Tracked</div>
                    </div>
                </div>
            </div>

            <!-- Filter Card -->
            <div class="mrx-card">
                <div class="mrx-title">
                    <div class="mrx-title-left">
                        <div class="mrx-title-icon">🔍</div>
                        <div>
                            <div class="mrx-title-text">Filters</div>
                            <div class="mrx-title-sub">Narrow the report by cycle, category or material</div>
                        </div>
                    </div>
                </div>
                <div class="mrx-body">
                    <form method="get" class="mrx-filter">
                        <div class="mrx-field">
                            <label>Cycle Date</label>
                            <input type="date" name="cycle_date"
                                value="<?= html_escape($this->input->get('cycle_date')); ?>">
                        </div>

                        <div class="mrx-field">
                            <label>Category</label>
                            <select name="category_id">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= (int) $c->id; ?>" <?= $this->input->get('category_id') == $c->id ? 'selected' : ''; ?>>
                                        <?= html_escape($c->category_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mrx-field">
                            <label>Material</label>
                            <select name="subcategory_id">
                                <option value="">All Materials</option>
                                <?php foreach ($subcategories as $s): ?>
                                    <option value="<?= (int) $s->id; ?>" <?= $this->input->get('subcategory_id') == $s->id ? 'selected' : ''; ?>>
                                        <?= html_escape($s->subcategory_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mrx-button-group">
                            <button class="mrx-btn" type="submit">🔎 Search</button>
                            <a class="mrx-btn mrx-reset"
                                href="<?= base_url('materials/project_reports/' . $project->id); ?>">↺ Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Card -->
            <div class="mrx-card">
                <div class="mrx-title">
                    <div class="mrx-title-left">
                        <div class="mrx-title-icon">📋</div>
                        <div>
                            <div class="mrx-title-text">Material Report</div>
                            <div class="mrx-title-sub">Received vs. consumed, cost tracked per cycle</div>
                        </div>
                    </div>
                    <span class="mrx-title-badge">☰ <span id="mrxVisibleCount"><?= count($reports); ?>
                            Records</span></span>
                </div>

                <div class="mrx-toolbar">
                    <div class="mrx-toolbar-left">
                        <div class="mrx-search-wrap">
                            <span class="mrx-search-icon">🔎</span>
                            <input type="text" id="mrxQuickSearch" placeholder="Search item, brand, remark…">
                            <span class="mrx-kbd">/</span>
                        </div>
                        <div class="mrx-pill-group" id="mrxDensityGroup">
                            <button type="button" class="mrx-pill active"
                                data-density="comfortable">Comfortable</button>
                            <button type="button" class="mrx-pill" data-density="compact">Compact</button>
                        </div>
                    </div>
                    <div class="mrx-toolbar-right">
                        <span class="mrx-title-badge" id="mrxSelectedBadge" style="display:none;">0 selected</span>
                        <div class="mrx-col-toggle">
                            <button type="button" class="mrx-btn-outline" id="mrxColToggleBtn">🧩 Columns</button>
                            <div class="mrx-col-panel" id="mrxColPanel">
                                <div class="mrx-col-panel-title">Toggle columns</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mrx-scroll">
                    <table class="mrx-table" id="mrxTable">
                        <thead>
                            <tr>
                                <th class="mrx-sticky mrx-sticky-1 no-sort mrx-checkbox-cell">
                                    <input type="checkbox" id="mrxSelectAll" title="Select all visible rows">
                                </th>
                                <th class="mrx-sticky mrx-sticky-2 no-sort" style="width: 50px;">Sr. No.</th>
                                <th class="mrx-sticky mrx-sticky-3" data-col="item" data-type="text">Item<span
                                        class="mrx-sort-arrow">↕</span></th>
                                <th data-col="quality" data-type="text">Quality Criteria<span
                                        class="mrx-sort-arrow">↕</span></th>
                                <th data-col="cycle" data-type="num">Cycle<span class="mrx-sort-arrow">↕</span></th>
                                <th data-col="date" data-type="text">Date<span class="mrx-sort-arrow">↕</span></th>
                                <th class="no-sort" data-col="photo">Photo</th>
                                <th data-col="brand" data-type="text">Brand<span class="mrx-sort-arrow">↕</span></th>
                                <th data-col="makelist" data-type="text">In Make List<span
                                        class="mrx-sort-arrow">↕</span></th>
                                <th class="no-sort" data-col="quality2">Quality</th>
                                <th class="no-sort" data-col="application">Application</th>
                                <th class="no-sort" data-col="remark">Remark</th>
                                <th class="mrx-number" data-col="received" data-type="num" style="text-align: right;">
                                    Total Received<span class="mrx-sort-arrow">↕</span></th>
                                <th class="mrx-number" data-col="atsite" data-type="num" style="text-align: right;">At
                                    Site<span class="mrx-sort-arrow">↕</span></th>
                                <th class="mrx-number" data-col="used" data-type="num" style="text-align: right;">
                                    Used<span class="mrx-sort-arrow">↕</span></th>
                                <th class="no-sort" data-col="unit">Unit</th>
                                <th class="no-sort" data-col="challan">Challan</th>
                                <th class="no-sort" data-col="bill">Bill</th>
                                <th class="mrx-number" data-col="price" data-type="num" style="text-align: right;">
                                    Price<span class="mrx-sort-arrow">↕</span></th>
                                <th class="mrx-number" data-col="costreceived" data-type="num"
                                    style="text-align: right;">Cost Received<span class="mrx-sort-arrow">↕</span></th>
                                <th class="mrx-number" data-col="costconsumed" data-type="num"
                                    style="text-align: right;">Cost Consumed<span class="mrx-sort-arrow">↕</span></th>
                                <th class="mrx-number" data-col="cumulative" data-type="num" style="text-align: right;">
                                    Cumulative Cost<span class="mrx-sort-arrow">↕</span></th>
                                <th class="no-sort" data-col="notes">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($reports)): ?>
                                <tr>
                                    <td colspan="22">
                                        <div class="mrx-empty">
                                            <div class="mrx-empty-icon">📦</div>
                                            <div class="mrx-empty-text">No material reports found</div>
                                            <div class="mrx-empty-subtext">Try adjusting your filters</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php else:
                                $i = 1;
                                foreach ($reports as $r): ?>
                                    <tr>
                                        <td class="mrx-sticky mrx-sticky-1 mrx-checkbox-cell">
                                            <input type="checkbox" class="mrx-row-check">
                                        </td>
                                        <td class="mrx-sticky mrx-sticky-2"><?= $i++; ?></td>
                                        <td class="mrx-sticky mrx-sticky-3">
                                            <strong><?= html_escape($r->subcategory_name); ?></strong>
                                        </td>
                                        <td><?= html_escape($r->quality_criteria); ?></td>
                                        <td data-sort-value="<?= (int) $r->cycle_id; ?>"><span class="mrx-cycle-pill">Cycle
                                                <?= (int) $r->cycle_id; ?></span></td>
                                        <td data-sort-value="<?= $r->report_date ? strtotime($r->report_date) : 0; ?>">
                                            <?= $r->report_date ? date('d-m-Y', strtotime($r->report_date)) : '—'; ?>
                                        </td>
                                        <td>
                                            <?php if ($r->site_photo): ?>
                                                <a class="mrx-icon-action" target="_blank" title="View site photo"
                                                    href="<?= base_url('uploads/materials/' . $r->site_photo); ?>">👁️</a>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?>
                                        </td>
                                        <td><?= html_escape($r->material_brand ?: $r->other_brand); ?></td>
                                        <td>
                                            <?php if (strtolower($r->make_list_status) === 'no'): ?>
                                                <span class="mrx-no"><span class="mrx-dot"></span>No</span>
                                            <?php elseif (strtolower($r->make_list_status) === 'yes'): ?>
                                                <span class="mrx-yes"><span class="mrx-dot"></span>Yes</span>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?>
                                        </td>
                                        <td><?= html_escape($r->quality_criteria); ?></td>
                                        <td><?= html_escape($r->application_quality); ?></td>
                                        <td><?= html_escape($r->cycle_remark ?: $r->site_remark); ?></td>
                                        <td class="mrx-number" data-sort-value="<?= $r->_total_received; ?>">
                                            <?= number_format($r->_total_received, 2); ?>
                                        </td>
                                        <td class="mrx-number" data-sort-value="<?= (float) $r->site_quantity; ?>">
                                            <?= number_format((float) $r->site_quantity, 2); ?>
                                        </td>
                                        <td class="mrx-number" data-sort-value="<?= $r->_used; ?>">
                                            <?= number_format($r->_used, 2); ?>
                                        </td>
                                        <td><?= html_escape($r->site_unit ?: $r->invoice_unit); ?></td>
                                        <td>
                                            <?php if ($r->invoice_photo): ?>
                                                <a class="mrx-icon-action" target="_blank" title="View challan"
                                                    href="<?= base_url('uploads/materials/' . $r->invoice_photo); ?>">📄</a>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($r->bill_photo): ?>
                                                <a class="mrx-icon-action" target="_blank" title="View bill"
                                                    href="<?= base_url('uploads/materials/' . $r->bill_photo); ?>">💳</a>
                                            <?php else: ?>
                                                —
                                            <?php endif; ?>
                                        </td>
                                        <td class="mrx-number" data-sort-value="<?= (float) $r->price; ?>"><span
                                                class="mrx-currency">₹</span><?= number_format((float) $r->price, 2); ?></td>
                                        <td class="mrx-number" data-sort-value="<?= $r->_received_cost; ?>"><span
                                                class="mrx-currency">₹</span><?= number_format($r->_received_cost, 2); ?></td>
                                        <td class="mrx-number" data-sort-value="<?= $r->_consumed_cost; ?>"><span
                                                class="mrx-consumed-val">₹<?= number_format($r->_consumed_cost, 2); ?></span>
                                        </td>
                                        <td class="mrx-number" data-sort-value="<?= $r->_cumulative_consumed_cost; ?>">
                                            <strong><span
                                                    class="mrx-currency">₹</span><?= number_format($r->_cumulative_consumed_cost, 2); ?></strong>
                                        </td>
                                        <td><?= html_escape($r->remarks); ?></td>
                                    </tr>
                                <?php endforeach; endif; ?>
                        </tbody>
                        <?php if (!empty($reports)): ?>
                            <tfoot>
                                <tr id="mrxTotalsRow">
                                    <td class="mrx-sticky mrx-sticky-1"></td>
                                    <td class="mrx-sticky mrx-sticky-2"></td>
                                    <td class="mrx-sticky mrx-sticky-3">Totals</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="mrx-number" data-total="received">—</td>
                                    <td class="mrx-number" data-total="atsite">—</td>
                                    <td class="mrx-number" data-total="used">—</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="mrx-number" data-total="costreceived">—</td>
                                    <td class="mrx-number" data-total="costconsumed">—</td>
                                    <td class="mrx-number" data-total="cumulative">—</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        var root = document.getElementById('mrxRoot');
        if (!root) return;

        var table = document.getElementById('mrxTable');
        var tbody = table.querySelector('tbody');
        var headerRow = table.querySelector('thead tr');
        var searchInput = document.getElementById('mrxQuickSearch');
        var visibleCount = document.getElementById('mrxVisibleCount');
        var colToggleBtn = document.getElementById('mrxColToggleBtn');
        var colPanel = document.getElementById('mrxColPanel');
        var densityGroup = document.getElementById('mrxDensityGroup');
        var selectAllBox = document.getElementById('mrxSelectAll');
        var selectedBadge = document.getElementById('mrxSelectedBadge');
        var exportBtn = document.getElementById('mrxExportBtn');
        var totalsRow = document.getElementById('mrxTotalsRow');

        var dataRows = Array.prototype.slice.call(tbody.querySelectorAll('tr')).filter(function (tr) {
            return !tr.querySelector('.mrx-empty');
        });
        var headerCells = Array.prototype.slice.call(headerRow.querySelectorAll('th'));
        var SEARCHABLE_COLS_START = 2; // skip checkbox + sr.no columns from text search noise (still fine either way)

        var STORE_KEY = 'mrx_material_report_prefs';
        function loadPrefs() {
            try {
                return JSON.parse(localStorage.getItem(STORE_KEY)) || {};
            } catch (e) { return {}; }
        }
        function savePrefs(p) {
            try { localStorage.setItem(STORE_KEY, JSON.stringify(p)); } catch (e) { }
        }
        var prefs = loadPrefs();

        /* ---------- Highlight helper ---------- */
        function clearHighlights(tr) {
            Array.prototype.slice.call(tr.querySelectorAll('mark.mrx-mark')).forEach(function (m) {
                var parent = m.parentNode;
                parent.replaceChild(document.createTextNode(m.textContent), m);
                parent.normalize();
            });
        }

        function highlightText(tr, q) {
            if (!q) return;
            Array.prototype.slice.call(tr.children).forEach(function (td) {
                if (td.classList.contains('mrx-checkbox-cell') || td.classList.contains('mrx-sticky-2')) return;
                Array.prototype.slice.call(td.childNodes).forEach(function (node) {
                    if (node.nodeType === 3 && node.textContent.toLowerCase().indexOf(q) !== -1) {
                        var idx = node.textContent.toLowerCase().indexOf(q);
                        var before = node.textContent.slice(0, idx);
                        var match = node.textContent.slice(idx, idx + q.length);
                        var after = node.textContent.slice(idx + q.length);
                        var frag = document.createDocumentFragment();
                        frag.appendChild(document.createTextNode(before));
                        var mark = document.createElement('mark');
                        mark.className = 'mrx-mark';
                        mark.textContent = match;
                        frag.appendChild(mark);
                        frag.appendChild(document.createTextNode(after));
                        node.parentNode.replaceChild(frag, node);
                    }
                });
            });
        }

        /* ---------- Totals ---------- */
        function recalcTotals() {
            if (!totalsRow) return;
            var totals = { received: 0, atsite: 0, used: 0, costreceived: 0, costconsumed: 0, cumulative: 0 };
            var colIndexByKey = {};
            headerCells.forEach(function (th, idx) {
                var col = th.getAttribute('data-col');
                if (col) colIndexByKey[col] = idx;
            });
            dataRows.forEach(function (tr) {
                if (tr.classList.contains('mrx-hidden-row')) return;
                Object.keys(totals).forEach(function (key) {
                    var idx = colIndexByKey[key === 'atsite' ? 'atsite' : key];
                    if (idx === undefined) return;
                    var td = tr.children[idx];
                    if (!td) return;
                    var v = parseFloat(td.getAttribute('data-sort-value'));
                    if (!isNaN(v)) totals[key] += v;
                });
            });
            Object.keys(totals).forEach(function (key) {
                var cell = totalsRow.querySelector('[data-total="' + key + '"]');
                if (!cell) return;
                if (key === 'received' || key === 'atsite' || key === 'used') {
                    cell.textContent = totals[key].toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                } else {
                    cell.textContent = '₹' + totals[key].toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            });
        }

        /* ---------- Quick search ---------- */
        function applySearch() {
            var q = (searchInput.value || '').trim().toLowerCase();
            var shown = 0;
            dataRows.forEach(function (tr) {
                clearHighlights(tr);
                var text = tr.textContent.toLowerCase();
                var match = !q || text.indexOf(q) !== -1;
                tr.classList.toggle('mrx-hidden-row', !match);
                if (match) {
                    shown++;
                    highlightText(tr, q);
                }
            });
            if (visibleCount) visibleCount.textContent = shown + ' Records';
            recalcTotals();
            updateSelectedBadge();
        }
        if (searchInput) searchInput.addEventListener('input', applySearch);

        document.addEventListener('keydown', function (e) {
            if (e.key === '/' && document.activeElement !== searchInput) {
                var tag = (document.activeElement && document.activeElement.tagName) || '';
                if (tag === 'INPUT' || tag === 'SELECT' || tag === 'TEXTAREA') return;
                e.preventDefault();
                searchInput.focus();
            }
        });

        /* ---------- Sorting ---------- */
        var sortState = { col: null, dir: 1 };

        function cellValue(tr, idx, type) {
            var td = tr.children[idx];
            if (!td) return '';
            if (td.hasAttribute('data-sort-value')) {
                var v = parseFloat(td.getAttribute('data-sort-value'));
                return isNaN(v) ? 0 : v;
            }
            var text = td.textContent.trim();
            if (type === 'num') {
                var num = parseFloat(text.replace(/[^0-9.\-]/g, ''));
                return isNaN(num) ? 0 : num;
            }
            return text.toLowerCase();
        }

        headerCells.forEach(function (th, idx) {
            if (th.classList.contains('no-sort')) return;
            th.addEventListener('click', function () {
                var type = th.getAttribute('data-type') || 'text';
                if (sortState.col === idx) {
                    sortState.dir *= -1;
                } else {
                    sortState.col = idx;
                    sortState.dir = 1;
                }
                headerCells.forEach(function (h) { h.classList.remove('sorted-asc', 'sorted-desc'); });
                th.classList.add(sortState.dir === 1 ? 'sorted-asc' : 'sorted-desc');

                var sorted = dataRows.slice().sort(function (a, b) {
                    var va = cellValue(a, idx, type);
                    var vb = cellValue(b, idx, type);
                    if (va < vb) return -1 * sortState.dir;
                    if (va > vb) return 1 * sortState.dir;
                    return 0;
                });
                sorted.forEach(function (tr) { tbody.insertBefore(tr, totalsRow ? null : null); tbody.appendChild(tr); });
                dataRows = sorted;
            });
        });

        /* ---------- Row selection ---------- */
        function updateSelectedBadge() {
            var checked = dataRows.filter(function (tr) {
                var cb = tr.querySelector('.mrx-row-check');
                return cb && cb.checked && !tr.classList.contains('mrx-hidden-row');
            });
            if (checked.length > 0) {
                selectedBadge.style.display = 'inline-flex';
                selectedBadge.querySelector ? null : null;
                selectedBadge.textContent = checked.length + ' selected';
            } else {
                selectedBadge.style.display = 'none';
            }
            exportBtn.textContent = checked.length > 0 ? ('⬇️ Export Selected (' + checked.length + ')') : '⬇️ Export CSV';
        }

        dataRows.forEach(function (tr) {
            var cb = tr.querySelector('.mrx-row-check');
            if (!cb) return;
            cb.addEventListener('change', function () {
                tr.classList.toggle('mrx-row-selected', cb.checked);
                updateSelectedBadge();
            });
        });

        if (selectAllBox) {
            selectAllBox.addEventListener('change', function () {
                dataRows.forEach(function (tr) {
                    if (tr.classList.contains('mrx-hidden-row')) return;
                    var cb = tr.querySelector('.mrx-row-check');
                    if (cb) {
                        cb.checked = selectAllBox.checked;
                        tr.classList.toggle('mrx-row-selected', cb.checked);
                    }
                });
                updateSelectedBadge();
            });
        }

        /* ---------- Density toggle ---------- */
        function setDensity(density) {
            table.classList.toggle('compact', density === 'compact');
            Array.prototype.slice.call(densityGroup.querySelectorAll('.mrx-pill')).forEach(function (p) {
                p.classList.toggle('active', p.getAttribute('data-density') === density);
            });
            prefs.density = density;
            savePrefs(prefs);
        }
        if (densityGroup) {
            densityGroup.addEventListener('click', function (e) {
                var btn = e.target.closest('.mrx-pill');
                if (!btn) return;
                setDensity(btn.getAttribute('data-density'));
            });
        }
        if (prefs.density) setDensity(prefs.density);

        /* ---------- Column visibility ---------- */
        var toggleable = headerCells.filter(function (th) {
            return th.hasAttribute('data-col') && !th.classList.contains('mrx-sticky');
        });

        toggleable.forEach(function (th) {
            var col = th.getAttribute('data-col');
            var idx = headerCells.indexOf(th);
            var hidden = prefs.hiddenCols && prefs.hiddenCols.indexOf(col) !== -1;

            var label = document.createElement('label');
            var cb = document.createElement('input');
            cb.type = 'checkbox';
            cb.checked = !hidden;
            cb.dataset.col = col;
            label.appendChild(cb);
            label.appendChild(document.createTextNode(th.textContent.replace('↕', '').trim()));
            colPanel.appendChild(label);

            function applyVisibility(show) {
                th.style.display = show ? '' : 'none';
                dataRows.forEach(function (tr) {
                    var td = tr.children[idx];
                    if (td) td.style.display = show ? '' : 'none';
                });
                if (totalsRow) {
                    var tf = totalsRow.children[idx];
                    if (tf) tf.style.display = show ? '' : 'none';
                }
            }

            if (hidden) applyVisibility(false);

            cb.addEventListener('change', function () {
                applyVisibility(cb.checked);
                var hiddenCols = prefs.hiddenCols || [];
                if (cb.checked) {
                    hiddenCols = hiddenCols.filter(function (c) { return c !== col; });
                } else if (hiddenCols.indexOf(col) === -1) {
                    hiddenCols.push(col);
                }
                prefs.hiddenCols = hiddenCols;
                savePrefs(prefs);
            });
        });

        if (colToggleBtn) {
            colToggleBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                colPanel.classList.toggle('open');
            });
            document.addEventListener('click', function (e) {
                if (!colPanel.contains(e.target) && e.target !== colToggleBtn) {
                    colPanel.classList.remove('open');
                }
            });
        }

        /* ---------- CSV export (respects search filter, hidden columns, and selection) ---------- */
        function exportCsv() {
            var selectedRows = dataRows.filter(function (tr) {
                var cb = tr.querySelector('.mrx-row-check');
                return cb && cb.checked && !tr.classList.contains('mrx-hidden-row');
            });
            var rowsToExport = selectedRows.length > 0
                ? selectedRows
                : dataRows.filter(function (tr) { return !tr.classList.contains('mrx-hidden-row'); });

            var visibleHeaderCells = headerCells.filter(function (th) {
                return th.style.display !== 'none' && !th.classList.contains('mrx-checkbox-cell') && th.getAttribute('data-col') !== undefined;
            });

            var rows = [];
            var headers = headerCells
                .filter(function (th) { return th.style.display !== 'none' && !th.classList.contains('mrx-checkbox-cell'); })
                .map(function (th) { return '"' + th.textContent.replace('↕', '').trim().replace(/"/g, '""') + '"'; });
            rows.push(headers.join(','));

            rowsToExport.forEach(function (tr) {
                var cells = Array.prototype.slice.call(tr.children)
                    .filter(function (td) { return td.style.display !== 'none' && !td.classList.contains('mrx-checkbox-cell'); })
                    .map(function (td) {
                        var text = td.textContent.trim().replace(/\s+/g, ' ');
                        return '"' + text.replace(/"/g, '""') + '"';
                    });
                rows.push(cells.join(','));
            });

            var csv = rows.join('\n');
            var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'material_report.csv';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        if (exportBtn) exportBtn.addEventListener('click', exportCsv);

        /* ---------- Init ---------- */
        recalcTotals();
        updateSelectedBadge();
    })();
</script>