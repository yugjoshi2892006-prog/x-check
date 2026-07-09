<style>
    .xc-pinfo-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    .xc-pinfo-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
    }

    .xc-pinfo-header {
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        padding: 22px 26px;
        position: relative;
        overflow: hidden;
    }

    .xc-pinfo-header::after {
        content: '';
        position: absolute;
        right: -50px;
        top: -60px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        pointer-events: none;
    }

    .xc-pinfo-header h2 {
        color: #ffffff;
        font-weight: 700;
        font-size: 21px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .xc-pinfo-body {
        padding: 24px 26px 28px;
    }

    /* Project info grid */
    .xc-info-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .xc-info-item {
        flex: 1 1 180px;
        min-width: 160px;
    }

    .xc-info-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #8a929a;
        margin-bottom: 6px;
    }

    .xc-info-label svg {
        width: 13px;
        height: 13px;
        stroke: #0fb4a0;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-info-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 13px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 600;
        background: rgba(46, 230, 168, 0.14);
        color: #0d9c8a;
    }

    .xc-pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #0d9c8a;
        flex-shrink: 0;
    }

    /* Section headings */
    .xc-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 16.5px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 16px;
    }

    .xc-section-title svg {
        width: 18px;
        height: 18px;
        stroke: #0fb4a0;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-section-divider {
        border: none;
        border-top: 1px solid #e4e6ea;
        margin: 28px 0;
    }

    /* Area table */
    .xc-table-wrap {
        overflow-x: auto;
        border: 1px solid #e4e6ea;
        border-radius: 12px;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    .xc-table thead th {
        background: #f0fbf9;
        color: #0d9c8a;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        text-align: left;
        padding: 12px 16px;
        border-bottom: 1px solid #e4e6ea;
        white-space: nowrap;
    }

    .xc-table tbody td {
        padding: 12px 16px;
        border-bottom: 1px solid #eef0f2;
        color: #1a1a2e;
        vertical-align: middle;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-table tbody tr:nth-child(even) {
        background: #fafbfc;
    }

    .xc-table tbody tr:hover {
        background: #f3fbf9;
    }

    .xc-weighted-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        background: rgba(15, 180, 160, 0.1);
        color: #0d9c8a;
        font-weight: 700;
        font-size: 12.5px;
    }

    .xc-empty-row td {
        text-align: center;
        color: #9aa3a9;
        padding: 28px 16px;
        font-size: 13.5px;
    }

    /* Monitoring images */
    .xc-date-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 24px 0 16px;
    }

    .xc-date-divider:first-of-type {
        margin-top: 0;
    }

    .xc-date-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 16px;
        border-radius: 999px;
        background: rgba(15, 180, 160, 0.1);
        color: #0d9c8a;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .xc-date-pill svg {
        width: 14px;
        height: 14px;
        stroke: #0d9c8a;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-date-line {
        flex: 1;
        height: 1px;
        background: #e4e6ea;
    }

    .xc-img-row {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
    }

    .xc-img-col {
        flex: 0 0 calc(25% - 13.5px);
        min-width: 220px;
    }

    .xc-img-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e4e6ea;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .xc-img-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(15, 180, 160, 0.14);
        border-color: #b9ece4;
    }

    .xc-img-photo {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    .xc-img-body {
        padding: 14px 16px 16px;
    }

    .xc-img-employee {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .xc-img-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-img-employee-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .xc-img-remarks {
        margin-top: 10px;
        font-size: 13px;
        color: #5a6169;
        line-height: 1.5;
        padding: 8px 10px;
        background: #f8fafa;
        border-radius: 8px;
        border-left: 2px solid #0fb4a0;
    }

    .xc-img-time {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 10px;
        font-size: 11.5px;
        color: #9aa3a9;
    }

    .xc-img-time svg {
        width: 12px;
        height: 12px;
        stroke: #9aa3a9;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .xc-gallery-empty {
        text-align: center;
        padding: 40px 20px;
        color: #9aa3a9;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .xc-img-col {
            flex: 0 0 calc(50% - 9px);
        }
    }

    @media (max-width: 575px) {
        .xc-img-col {
            flex: 0 0 100%;
        }

        .xc-table-wrap {
            border: none;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-pinfo-wrapper">

            <div class="xc-pinfo-card">

                <div class="xc-pinfo-header">
                    <h2><?= $project->project_name ?></h2>
                </div>

                <div class="xc-pinfo-body">

                    <!-- Project Information -->
                    <div class="xc-info-grid">

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="4"></circle>
                                    <path d="M4 21c0-4 4-6 8-6s8 2 8 6"></path>
                                </svg>
                                Customer
                            </div>
                            <div class="xc-info-value">
                                <?= $project->customer_name ?? '-' ?>
                            </div>
                        </div>

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <path d="M12 7v5l3 3"></path>
                                </svg>
                                Status
                            </div>
                            <div class="xc-info-value">
                                <span class="xc-pill">
                                    Running
                                </span>
                            </div>
                        </div>

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                    <path d="M3 9h18"></path>
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                </svg>
                                Start Date
                            </div>
                            <div class="xc-info-value">
                                <?= $project->start_date ?>
                            </div>
                        </div>

                        <div class="xc-info-item">
                            <div class="xc-info-label">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                    <path d="M3 9h18"></path>
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                </svg>
                                End Date
                            </div>
                            <div class="xc-info-value">
                                <?= $project->end_date ?>
                            </div>
                        </div>

                    </div>

                    <!-- Area Details -->
                    <div class="xc-section-title">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <path d="M3 9h18"></path>
                            <path d="M9 21V9"></path>
                        </svg>
                        Area Details
                    </div>

                    <div class="xc-table-wrap">

                        <table class="xc-table">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Floor</th>
                                    <th>Area Name</th>
                                    <th>Sq Ft</th>
                                    <th>Width × Length</th>
                                    <th>Weighted %</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if (!empty($areas)) { ?>

                                    <?php $i = 1;
                                    foreach ($areas as $area) { ?>

                                        <tr>

                                            <td><?= $i++ ?></td>

                                            <td><?= $area->floor_name ?></td>

                                            <td><?= $area->area_name ?></td>

                                            <td><?= $area->sq_ft ?></td>

                                            <td>
                                                <?= $area->width ?>
                                                ×
                                                <?= $area->length ?>
                                            </td>

                                            <td>
                                                <span class="xc-weighted-pill">
                                                    <?= !empty($area->weighted_percent) ? $area->weighted_percent . '%' : '0%' ?>
                                                </span>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr class="xc-empty-row">
                                        <td colspan="6">
                                            No Area Found
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <hr class="xc-section-divider">

                    <!-- Monitoring Images -->
                    <div class="xc-section-title">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <path d="M21 15l-5-5L5 21"></path>
                        </svg>
                        Monitoring Images
                    </div>

                    <?php
                    $current_date = '';

                    if (empty($images)) {
                        ?>
                        <div class="xc-gallery-empty">No monitoring images captured yet.</div>
                        <?php
                    }

                    foreach ($images as $img) {
                        $img_date = date('Y-m-d', strtotime($img->created_at));

                        if ($current_date != $img_date) {
                            if ($current_date != '') {
                                echo '</div>'; // close xc-img-row
                            }

                            $current_date = $img_date;
                            ?>

                            <div class="xc-date-divider">
                                <span class="xc-date-pill">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                        <path d="M3 9h18"></path>
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                    </svg>
                                    <?= date('D, M d', strtotime($img->created_at)); ?>
                                </span>
                                <span class="xc-date-line"></span>
                            </div>

                            <div class="xc-img-row">

                            <?php } ?>

                            <div class="xc-img-col">

                                <div class="xc-img-card">

                                    <img src="<?= base_url('uploads/floor_plan/project_image/' . $img->image) ?>"
                                        class="xc-img-photo">

                                    <div class="xc-img-body">

                                        <div class="xc-img-employee">
                                            <span class="xc-img-avatar">
                                                <?= strtoupper(substr($img->employee_name, 0, 1)) ?>
                                            </span>
                                            <span class="xc-img-employee-name">
                                                <?= $img->employee_name ?>
                                            </span>
                                        </div>

                                        <?php if (!empty($img->remarks)) { ?>
                                            <div class="xc-img-remarks">
                                                <?= $img->remarks ?>
                                            </div>
                                        <?php } ?>

                                        <div class="xc-img-time">
                                            <svg viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <path d="M12 7v5l3 3"></path>
                                            </svg>
                                            <?= date('d-m-Y H:i', strtotime($img->created_at)) ?>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <?php
                    }

                    if (!empty($images)) {
                        echo '</div>'; // close final xc-img-row
                    }
                    ?>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>