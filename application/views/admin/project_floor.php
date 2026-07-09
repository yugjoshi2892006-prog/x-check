<div class="page-wrapper">
        <div class="page-content">
            <!-- <div class="xc-wizard-container"> -->

                <div class="xc-wizard-header">
                    <h3 class="xc-wizard-title">Step 2 : Floors</h3>
                    <p class="xc-wizard-subtitle">Add floor details and upload floor plans</p>
                </div>

                <div class="xc-card xc-form-card">

                    <form method="post" enctype="multipart/form-data" action="<?= base_url('index.php/project/save_floor') ?>">

                        <input type="hidden" name="draft_token" value="<?= $draft_token ?>">

                        <div class="xc-form-group mb-3">

                            <label class="xc-label">Floor Name</label>

                            <input type="text" name="floor_name" class="form-control xc-input">

                        </div>

                        <div class="xc-form-group mb-3">

                            <label class="xc-label">Floor Plan</label>

                            <input type="file" name="floor_plan" class="form-control xc-input xc-file-input">

                        </div>

                        <button class="btn xc-btn-primary">
                            <i class="fa fa-plus me-1"></i> Add Floor
                        </button>

                    </form>

                </div>

                <?php if (!empty($floors)): ?>
                <div class="xc-card xc-floor-list-card">

                    <h5 class="xc-floor-list-title">Added Floors</h5>

                    <div class="xc-floor-list">

                        <?php foreach ($floors as $floor): ?>

                            <div class="xc-floor-item">
                                <i class="fa fa-building xc-floor-icon"></i>
                                <span class="xc-floor-name"><?= $floor->floor_name ?></span>
                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>
                <?php endif; ?>

                <div class="xc-wizard-actions">

                    <a href="<?= base_url('index.php/project/areas/' . $draft_token) ?>" class="btn xc-btn-next">
                        Next <i class="fa fa-arrow-right ms-1"></i>
                    </a>

                </div>

            <!-- </div> -->
        </div>
    </div>

    <style>
        .xc-wizard-container {
            max-width: 720px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .xc-wizard-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .xc-wizard-title {
            color: #1a1a2e;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 6px;
        }

        .xc-wizard-subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 0;
        }

        .xc-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(15, 180, 160, 0.15);
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(26, 26, 46, 0.08);
            padding: 28px;
            margin-bottom: 24px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .xc-card:hover {
            box-shadow: 0 12px 36px rgba(15, 180, 160, 0.15);
        }

        .xc-form-card {
            border-top: 4px solid #0fb4a0;
        }

        .xc-label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #1a1a2e;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .xc-input {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
            background: #ffffff;
        }

        .xc-input:focus {
            border-color: #0fb4a0;
            box-shadow: 0 0 0 4px rgba(15, 180, 160, 0.12);
            outline: none;
        }

        .xc-file-input {
            padding: 8px 14px;
            cursor: pointer;
        }

        .xc-btn-primary {
            background: linear-gradient(135deg, #0fb4a0, #0d9488);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 14px rgba(15, 180, 160, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .xc-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 180, 160, 0.4);
            color: #fff;
        }

        .xc-floor-list-card {
            border-top: 4px solid #1a1a2e;
        }

        .xc-floor-list-title {
            color: #1a1a2e;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .xc-floor-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .xc-floor-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(15, 180, 160, 0.06);
            border: 1px solid rgba(15, 180, 160, 0.15);
            border-radius: 12px;
            padding: 12px 16px;
            transition: background 0.25s ease, transform 0.2s ease;
        }

        .xc-floor-item:hover {
            background: rgba(15, 180, 160, 0.12);
            transform: translateX(4px);
        }

        .xc-floor-icon {
            color: #0fb4a0;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .xc-floor-name {
            font-weight: 600;
            color: #1a1a2e;
            font-size: 14px;
        }

        .xc-wizard-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .xc-btn-next {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px 28px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 14px rgba(26, 26, 46, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .xc-btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 26, 46, 0.35);
            color: #fff;
        }

        @media (max-width: 768px) {
            .xc-wizard-container {
                padding: 20px 14px;
            }

            .xc-card {
                padding: 20px;
                border-radius: 14px;
            }

            .xc-wizard-title {
                font-size: 22px;
            }

            .xc-btn-primary,
            .xc-btn-next {
                width: 100%;
                text-align: center;
            }

            .xc-wizard-actions {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .xc-floor-item {
                padding: 10px 12px;
            }
        }
    </style>