<style>
    .xc-al-wrap {
        padding: 24px;
    }

    .xc-al-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e7eaf0;
        box-shadow: 0 2px 10px rgba(26, 26, 46, 0.05);
        overflow: hidden;
    }

    .xc-al-card-body {
        padding: 28px;
    }

    .xc-al-breadcrumb {
        font-size: 13px;
        color: #8a8fa3;
        margin-bottom: 10px;
    }

    .xc-al-breadcrumb a {
        color: #0fb4a0;
        text-decoration: none;
    }

    .xc-al-breadcrumb a:hover {
        text-decoration: underline;
    }

    .xc-al-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .xc-al-title .xc-al-project {
        color: #0fb4a0;
        font-weight: 600;
    }

    .xc-al-table-wrap {
        border-radius: 10px;
        border: 1px solid #edf0f5;
        overflow: hidden;
    }

    .xc-al-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    .xc-al-table thead,
    .xc-al-table thead tr {
        background-color: #0fb4a0 !important;
        background: linear-gradient(135deg, #0fb4a0, #0c8f7f) !important;
    }

    .xc-al-table thead th {
        color: #fff !important;
        font-weight: 600;
        font-size: 13.5px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 14px 16px;
        border: none !important;
        text-align: left;
    }

    .xc-al-table tbody td {
        padding: 13px 16px;
        font-size: 14px;
        color: #2b2b40;
        border-bottom: 1px solid #f0f2f6;
        vertical-align: middle;
    }

    .xc-al-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-al-table tbody tr:nth-child(even) {
        background: #f9fbfc;
    }

    .xc-al-table tbody tr:hover {
        background: #eefcfb;
    }

    .xc-al-empty {
        text-align: center;
        padding: 40px 16px;
        color: #9aa0b2;
        font-size: 14px;
    }

    .xc-al-pill {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
        letter-spacing: 0.2px;
    }

    .xc-al-pill-present {
        background: #e3faf6;
        color: #0c8f7f;
    }

    .xc-al-pill-absent {
        background: #fde8e8;
        color: #c0392b;
    }

    .xc-al-pill-leave {
        background: #fff4e0;
        color: #b8860b;
    }

    .xc-al-pill-late {
        background: #eaeefc;
        color: #3a4ed5;
    }

    .xc-al-pill-default {
        background: #eef0f4;
        color: #1a1a2e;
    }

    @media (max-width: 991px) {
        .xc-al-wrap {
            padding: 16px;
        }

        .xc-al-card-body {
            padding: 18px;
        }
    }

    @media (max-width: 600px) {
        .xc-al-card-body {
            padding: 14px;
        }

        .xc-al-title {
            font-size: 18px;
        }

        .xc-al-table thead th,
        .xc-al-table tbody td {
            padding: 10px 10px;
            font-size: 13px;
        }
    }

    @media (max-width: 380px) {
        .xc-al-table-wrap {
            overflow-x: auto;
        }

        .xc-al-table {
            min-width: 560px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-al-wrap">
            <div class="card xc-al-card">
                <div class="card-body xc-al-card-body">

                    <div class="xc-al-breadcrumb">
                        <a href="<?= base_url('index.php/admin/dashboard') ?>">Dashboard</a> /
                        <?php if (!empty($project)): ?>
                            <a
                                href="<?= base_url('index.php/admin/attendance_projects') ?>"><?= htmlspecialchars($project->project_name) ?></a>
                            /
                        <?php endif; ?>
                        Attendance List
                    </div>

                    <h4 class="xc-al-title">
                        Attendance List
                        <?php if (!empty($project)): ?>
                            <span class="xc-al-project">- <?= htmlspecialchars($project->project_name) ?></span>
                        <?php endif; ?>
                    </h4>

                    <div class="xc-al-table-wrap">
                        <table class="xc-al-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Check In</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($attendance)): ?>
                                    <?php foreach ($attendance as $row): ?>
                                        <?php
                                        $statusClass = 'xc-al-pill-default';
                                        $statusLower = strtolower($row->status);
                                        if (strpos($statusLower, 'present') !== false)
                                            $statusClass = 'xc-al-pill-present';
                                        elseif (strpos($statusLower, 'absent') !== false)
                                            $statusClass = 'xc-al-pill-absent';
                                        elseif (strpos($statusLower, 'leave') !== false)
                                            $statusClass = 'xc-al-pill-leave';
                                        elseif (strpos($statusLower, 'late') !== false)
                                            $statusClass = 'xc-al-pill-late';
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row->attendance_date ?>
                                            </td>
                                            <td>
                                                <?= $row->employee_name ?>
                                            </td>
                                            <td>
                                                <?= $row->check_in_time ?>
                                            </td>
                                            <td>
                                                <span class="xc-al-pill <?= $statusClass ?>"><?= $row->status ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="xc-al-empty">
                                            No Attendance Found
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>