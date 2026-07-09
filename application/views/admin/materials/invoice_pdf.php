<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        @page {
            margin: 30px 28px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans;
            font-size: 13px;
            margin: 0;
            color: #1a1a2e;
        }

        /* ---------- HEADER BAND ---------- */
        .xc-header {
            width: 100%;
            border-bottom: 3px solid #0fb4a0;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }

        .xc-header table {
            width: 100%;
            border: none;
        }

        .xc-header td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .xc-brand {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a2e;
            letter-spacing: 0.5px;
        }

        .xc-brand span {
            color: #0fb4a0;
        }

        .xc-tagline {
            font-size: 10px;
            color: #6b7280;
            margin-top: 2px;
        }

        .xc-doc-title {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            color: #0fb4a0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .xc-doc-meta {
            text-align: right;
            font-size: 11px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* ---------- PROJECT INFO BLOCK ---------- */
        .xc-info-box {
            width: 100%;
            background: #f4fbfa;
            border: 1px solid #e4e6ea;
            border-left: 4px solid #0fb4a0;
            border-radius: 4px;
            padding: 10px 14px;
            margin-bottom: 18px;
        }

        .xc-info-box table {
            width: 100%;
            border: none;
        }

        .xc-info-box td {
            border: none;
            padding: 2px 0;
            font-size: 12px;
            vertical-align: top;
        }

        .xc-info-label {
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 1px;
        }

        .xc-info-value {
            font-size: 13px;
            font-weight: bold;
            color: #1a1a2e;
        }

        /* ---------- TABLE ---------- */
        table.xc-report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            table-layout: fixed;
        }

        table.xc-report-table thead,
        table.xc-report-table thead tr {
            background-color: #0fb4a0 !important;
        }

        table.xc-report-table th {
            background-color: #0fb4a0 !important;
            color: #ffffff !important;
            padding: 9px 8px;
            border: 1px solid #0d9c8a;
            text-align: left;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        table.xc-report-table td {
            padding: 8px;
            border: 1px solid #e4e6ea;
            font-size: 12px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        table.xc-report-table tbody tr:nth-child(even) {
            background-color: #f7f9fa;
        }

        table.xc-report-table tr {
            page-break-inside: avoid;
        }

        table.xc-report-table thead {
            display: table-header-group;
        }

        /* column widths */
        table.xc-report-table th:nth-child(1),
        table.xc-report-table td:nth-child(1) {
            width: 24%;
        }

        table.xc-report-table th:nth-child(2),
        table.xc-report-table td:nth-child(2) {
            width: 30%;
        }

        table.xc-report-table th:nth-child(3),
        table.xc-report-table td:nth-child(3) {
            width: 14%;
            text-align: center;
        }

        table.xc-report-table td:nth-child(3) {
            text-align: center;
        }

        table.xc-report-table th:nth-child(4),
        table.xc-report-table td:nth-child(4) {
            width: 14%;
        }

        table.xc-report-table th:nth-child(5),
        table.xc-report-table td:nth-child(5) {
            width: 18%;
        }

        /* ---------- SUMMARY ROW ---------- */
        .xc-summary {
            width: 100%;
            margin-top: 14px;
        }

        .xc-summary table {
            width: 100%;
            border: none;
        }

        .xc-summary td {
            border: none;
            padding: 0;
        }

        .xc-summary-box {
            float: right;
            width: 220px;
            border: 1px solid #e4e6ea;
            border-radius: 4px;
            overflow: hidden;
        }

        .xc-summary-box table {
            width: 100%;
        }

        .xc-summary-box td {
            border: none;
            padding: 7px 12px;
            font-size: 12px;
        }

        .xc-summary-box tr:not(:last-child) td {
            border-bottom: 1px solid #e4e6ea;
        }

        .xc-summary-box .xc-summary-total {
            background-color: #0fb4a0 !important;
            color: #ffffff !important;
            font-weight: bold;
        }

        .xc-summary-label {
            color: #6b7280;
        }

        .xc-summary-value {
            text-align: right;
            font-weight: bold;
        }

        /* ---------- FOOTER ---------- */
        .xc-footer {
            margin-top: 40px;
            border-top: 1px solid #e4e6ea;
            padding-top: 10px;
            font-size: 10px;
            color: #9aa0a6;
            text-align: center;
        }

        .xc-footer b {
            color: #0fb4a0;
        }

        .xc-clear {
            clear: both;
        }
    </style>

</head>

<body>

    <!-- HEADER -->
    <div class="xc-header">
        <table>
            <tr>
                <td style="width: 60%;">
                    <div class="xc-brand">X<span>-CHECK</span></div>
                    <div class="xc-tagline">Construction Site Project Monitoring</div>
                </td>
                <td style="width: 40%;">
                    <div class="xc-doc-title">Material Report</div>
                    <div class="xc-doc-meta">
                        Generated on: <?= date('d M Y, h:i A') ?><br>
                        Report ID: #<?= isset($project->id) ? $project->id : '—' ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- PROJECT INFO -->
    <div class="xc-info-box">
        <table>
            <tr>
                <td style="width: 50%;">
                    <div class="xc-info-label">Project Name</div>
                    <div class="xc-info-value"><?= $project->project_name ?></div>
                </td>
                <td style="width: 50%;">
                    <div class="xc-info-label">Total Material Entries</div>
                    <div class="xc-info-value"><?= count($reports) ?></div>
                </td>
            </tr>
        </table>
    </div>

    <!-- TABLE -->
    <table class="xc-report-table">

        <thead>
            <tr>
                <th>Employee</th>
                <th>Material</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Size</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($reports as $r) { ?>
                <tr>
                    <td><?= $r->employee_name ?></td>
                    <td><?= $r->subcategory_name ?></td>
                    <td><?= $r->site_quantity ?></td>
                    <td><?= $r->site_unit ?></td>
                    <td><?= $r->site_size ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>

    <!-- FOOTER -->
    <div class="xc-footer">
        This is a system-generated report from <b>X-CHECK</b> &mdash; Construction Site Project Monitoring System.
    </div>

</body>

</html>