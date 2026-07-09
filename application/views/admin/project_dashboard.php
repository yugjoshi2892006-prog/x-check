<style>
    .xc-dash-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    /* ---------- Feature Cards Grid ---------- */
    .xc-feature-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .xc-feature-card {
        background: #ffffff;
        border: 1px solid #e4e6ea;
        border-radius: 16px;
        padding: 28px 18px;
        text-align: center;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.05);
        transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    }

    .xc-feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(15, 180, 160, 0.14);
        border-color: #0fb4a0;
    }

    .xc-feature-icon {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: rgba(15, 180, 160, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.18s ease;
    }

    .xc-feature-card:hover .xc-feature-icon {
        background: #0fb4a0;
    }

    .xc-feature-icon i {
        font-size: 26px;
        color: #0fb4a0;
        transition: color 0.18s ease;
    }

    .xc-feature-card:hover .xc-feature-icon i {
        color: #ffffff;
    }

    .xc-feature-card h5 {
        margin: 0;
        font-size: 14.5px;
        font-weight: 600;
        color: #1a1a2e;
        line-height: 1.3;
    }

    /* ---------- Info Summary Card ---------- */
    .xc-info-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
    }

    .xc-info-header {
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .xc-info-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .xc-info-header-icon i {
        font-size: 19px;
        color: #ffffff;
    }

    .xc-info-header h4 {
        color: #ffffff;
        font-weight: 700;
        font-size: 17px;
        margin: 0;
        line-height: 1.2;
    }

    .xc-info-body {
        padding: 22px 24px;
    }

    .xc-info-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .xc-info-row+.xc-info-row {
        margin-top: 22px;
        padding-top: 22px;
        border-top: 1px solid #eef1f3;
        grid-template-columns: repeat(4, 1fr);
    }

    .xc-info-item-label {
        font-size: 11.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #7c8590;
        margin-bottom: 6px;
        display: block;
    }

    .xc-info-item-value {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .xc-engineer-stack {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .xc-engineer-chip {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
    }

    .xc-engineer-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #0fb4a0;
        flex-shrink: 0;
    }

    /* Progress mini bar for the Progress info item */
    .xc-info-progress-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xc-info-progress-track {
        flex: 1;
        max-width: 100px;
        height: 8px;
        background: #eef1f3;
        border-radius: 20px;
        overflow: hidden;
    }

    .xc-info-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #0fb4a0, #15d6bf);
        border-radius: 20px;
    }

    @media (max-width: 992px) {
        .xc-feature-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .xc-info-row,
        .xc-info-row+.xc-info-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .xc-feature-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-dash-wrapper">



            <div class="xc-info-card">

                <div class="xc-info-header">
                    <div class="xc-info-header-icon">
                        <i class="bx bx-building-house"></i>
                    </div>
                    <h4><?= $project->project_name ?></h4>
                </div>

                <div class="xc-info-body">

                    <div class="xc-info-row">

                        <div>
                            <span class="xc-info-item-label">Project Name</span>
                            <div class="xc-info-item-value"><?= $project->project_name ?></div>
                        </div>

                        <div>
                            <span class="xc-info-item-label">Customer Name</span>
                            <div class="xc-info-item-value"><?= $project->customer_name ?></div>
                        </div>

                        <div>
                            <span class="xc-info-item-label">Engineer Name</span>

                            <div class="xc-engineer-stack">

                                <?php foreach ($engineers as $eng) { ?>
                                    <span class="xc-engineer-chip">
                                        <span class="xc-engineer-dot"></span>
                                        <?= $eng->name ?>
                                    </span>
                                <?php } ?>

                            </div>

                        </div>

                    </div>

                    <div class="xc-info-row">

                        <div>
                            <span class="xc-info-item-label">Cycle Days</span>
                            <div class="xc-info-item-value"><?= $project->monitoring_cycle ?></div>
                        </div>

                        <div>
                            <span class="xc-info-item-label">Due Date</span>
                            <div class="xc-info-item-value"><?= date('d/m/Y', strtotime($project->end_date)) ?></div>
                        </div>

                        <div>
                            <span class="xc-info-item-label">Last Capture</span>
                            <div class="xc-info-item-value"><?= $last_capture ?></div>
                        </div>

                        <div>
                            <span class="xc-info-item-label">Progress</span>

                            <div class="xc-info-progress-wrap">
                                <div class="xc-info-progress-track">
                                    <div class="xc-info-progress-fill"
                                        style="width: <?= number_format($progress, 2) ?>%;"></div>
                                </div>
                                <div class="xc-info-item-value"><?= number_format($progress, 2) ?>%</div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="xc-feature-grid">

            <a href="<?= site_url('admin/monitoring_images/' . $project->id) ?>" class="xc-feature-card">
                <div class="xc-feature-icon">
                    <i class="bx bx-detail"></i>
                </div>
                <h5>Project Details</h5>
            </a>
            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-folder"></i></div>
                <h5>Project Documents</h5>
            </a>

            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-map"></i></div>
                <h5>View Floor Plan</h5>
            </a>

            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-image"></i></div>
                <h5>View Images</h5>
            </a>

            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-message-square-detail"></i></div>
                <h5>Comments</h5>
            </a>

            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-video"></i></div>
                <h5>Videos</h5>
            </a>

            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-bar-chart"></i></div>
                <h5>Area Wise Progress</h5>
            </a>

            <a href="#" class="xc-feature-card">
                <div class="xc-feature-icon"><i class="bx bx-file"></i></div>
                <h5>Reports</h5>
            </a>

        </div>
    </div>
</div>