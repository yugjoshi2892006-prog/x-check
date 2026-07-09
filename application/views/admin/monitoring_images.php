<style>
    .xc-gallery-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    .xc-gallery-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
    }

    .xc-gallery-header {
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        padding: 20px 26px;
        position: relative;
        overflow: hidden;
    }

    .xc-gallery-header::after {
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

    .xc-gallery-header h3 {
        color: #ffffff;
        font-weight: 700;
        font-size: 19px;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .xc-gallery-body {
        padding: 24px 26px 28px;
    }

    /* Date divider */
    .xc-date-divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 28px 0 16px;
    }

    .xc-date-divider:first-child {
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

    /* Image grid */
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

    .xc-img-photo-wrap {
        position: relative;
        overflow: hidden;
    }

    .xc-img-photo {
        width: 100%;
        height: 190px;
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
        padding: 50px 20px;
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
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-gallery-wrapper">

            <div class="xc-gallery-card">

                <div class="xc-gallery-header">
                    <h3><?= $project->project_name ?></h3>
                </div>

                <div class="xc-gallery-body">

                    <?php
                    $current_date = '';

                    if (empty($images)) {
                        ?>
                        <div class="xc-gallery-empty">No images captured yet for this project.</div>
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
                                    <?= date('D, F d', strtotime($img->created_at)); ?>
                                </span>
                                <span class="xc-date-line"></span>
                            </div>

                            <div class="xc-img-row">

                            <?php
                        }
                        ?>

                        <div class="xc-img-col">

                            <div class="xc-img-card">

                                <div class="xc-img-photo-wrap">
                                    <img src="<?= base_url('uploads/floor_plan/project_image/' . $img->image) ?>"
                                        class="xc-img-photo">
                                </div>

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