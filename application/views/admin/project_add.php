<div class="page-wrapper">
    <div class="page-content">

        <style>
            .xc-wrapper {
                background: #eef6f5;
                min-height: 100vh;
            }

            .xc-content {
                padding: 28px 32px;
            }

            /* Header */
            .xc-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4px;
            }

            .xc-header h2 {
                font-size: 22px;
                font-weight: 700;
                color: #1a1a2e;
                margin: 0;
            }

            .xc-breadcrumb {
                font-size: 12px;
                color: #9aa0ac;
                margin-bottom: 20px;
            }

            .xc-breadcrumb a {
                color: #0fb4a0;
                text-decoration: none;
            }

            .xc-breadcrumb span {
                margin: 0 5px;
            }

            /* Wizard steps */
            .xc-wizard {
                display: flex;
                align-items: flex-start;
                background: #fff;
                border-radius: 12px;
                padding: 18px 24px;
                margin-bottom: 20px;
                border: 0.5px solid #e4e6ea;
            }

            .xc-wizard-step {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
                flex: 1;
                position: relative;
            }

            .xc-wizard-step:last-child {
                flex: none;
                min-width: 90px;
            }

            .xc-wizard-step .step-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
                font-weight: 600;
                flex-shrink: 0;
                background: #eef0f3;
                color: #9aa0ac;
                transition: all .2s;
            }

            .xc-wizard-step.active .step-circle {
                background: #0fb4a0;
                color: #fff;
            }

            .xc-wizard-step.done .step-circle {
                background: #e0f7f4;
                color: #0fb4a0;
            }

            .xc-wizard-step .step-label {
                font-size: 11.5px;
                font-weight: 500;
                color: #9aa0ac;
                text-align: center;
                line-height: 1.3;
            }

            .xc-wizard-step.active .step-label {
                color: #0fb4a0;
                font-weight: 600;
            }

            .xc-wizard-connector {
                flex: 1;
                height: 2px;
                background: #e4e6ea;
                margin: 19px 4px 0;
            }

            .xc-wizard-connector.done {
                background: #0fb4a0;
            }

            /* Two-column layout */
            .xc-grid {
                display: grid;
                grid-template-columns: 1.4fr 1fr;
                gap: 18px;
                align-items: start;
            }

            @media (max-width: 991px) {
                .xc-grid {
                    grid-template-columns: 1fr;
                }
            }

            /* Form card */
            .xc-form-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 22px 22px 18px;
                margin-bottom: 18px;
            }

            .xc-section-label {
                font-size: 11px;
                font-weight: 600;
                letter-spacing: .06em;
                text-transform: uppercase;
                color: #9aa0ac;
                margin-bottom: 14px;
            }

            .xc-section-title {
                font-size: 13px;
                font-weight: 600;
                color: #fff;
                margin: 0;
                padding: 11px 18px;
                display: flex;
                align-items: center;
                gap: 8px;
                background: #0fb4a0;
                border-radius: 10px 10px 0 0;
            }

            .xc-form-card .form-label {
                font-size: 12.5px;
                font-weight: 500;
                color: #444;
                margin-bottom: 6px;
                display: block;
            }

            .xc-form-card .form-control,
            .xc-form-card .form-select {
                height: 42px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13px;
                color: #333;
                background: #fafbfc;
                padding: 0 13px;
                box-shadow: none;
                width: 100%;
                transition: border-color .15s, box-shadow .15s, background .15s;
            }

            .xc-form-card textarea.form-control {
                height: auto;
                padding: 10px 13px;
                resize: vertical;
            }

            .xc-form-card .form-control:focus,
            .xc-form-card .form-select:focus {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
                outline: none;
            }

            .xc-form-card .form-control::placeholder {
                color: #bbb;
            }

            /* icon-prefixed inputs (Country/State/City) */
            .xc-icon-field {
                position: relative;
            }

            .xc-icon-field .form-control,
            .xc-icon-field .form-select {
                padding-left: 34px;
            }

            .xc-icon-field i {
                position: absolute;
                left: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #0fb4a0;
                font-size: 14px;
                pointer-events: none;
            }

            /* Mobile with country code */
            .xc-mobile-group {
                display: flex;
                gap: 0;
            }

            .xc-mobile-group .xc-cc {
                width: 70px;
                border: 1px solid #dde0e6;
                border-right: none;
                border-radius: 8px 0 0 8px;
                background: #f3f4f6;
                font-size: 13px;
                color: #444;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }

            .xc-mobile-group .form-control {
                border-radius: 0 8px 8px 0;
            }

            /* ---- Right panel: upload card ---- */
            .xc-upload-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                overflow: hidden;
                margin-bottom: 18px;
            }

            .xc-upload-body {
                padding: 18px;
            }

            .xc-upload-body .form-label {
                font-size: 12.5px;
                font-weight: 500;
                color: #444;
                margin-bottom: 6px;
                display: block;
            }

            .xc-dropzone {
                border: 1.5px dashed #b9e4dd;
                border-radius: 10px;
                background: #f3fbfa;
                padding: 26px 16px;
                text-align: center;
                margin: 14px 0 16px;
                cursor: pointer;
                transition: background .15s, border-color .15s;
            }

            .xc-dropzone:hover {
                background: #e9f8f5;
                border-color: #0fb4a0;
            }

            .xc-dropzone .xc-dz-icon {
                font-size: 26px;
                color: #0fb4a0;
                margin-bottom: 8px;
                display: block;
            }

            .xc-dropzone .xc-dz-text {
                font-size: 12.5px;
                color: #6b7280;
            }

            .xc-dropzone input[type="file"] {
                display: none;
            }

            .xc-check-item {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: #444;
                cursor: pointer;
                margin-bottom: 14px;
            }

            .xc-check-item input[type="checkbox"] {
                width: 16px;
                height: 16px;
                accent-color: #0fb4a0;
                cursor: pointer;
                flex-shrink: 0;
            }

            .btn-xc-upload {
                height: 42px;
                width: 100%;
                background: #3cae5e;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                transition: background .15s;
            }

            .btn-xc-upload:hover {
                background: #339951;
            }

            /* ---- Team assignment (right panel, below upload) ---- */
            .xc-team-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 18px;
                margin-bottom: 18px;
            }

            /* ---- Member picker (Engineer / Project Manager) ---- */
            .xc-multiselect {
                position: relative;
            }

            .xc-ms-input-row {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                align-items: center;
                min-height: 42px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                background: #fafbfc;
                padding: 6px 10px;
                cursor: text;
            }

            .xc-ms-input-row:focus-within {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
            }

            .xc-ms-chip {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: #f3f4f6;
                border: 1px solid #e4e6ea;
                color: #333;
                font-size: 12px;
                font-weight: 500;
                padding: 3px 8px 3px 3px;
                border-radius: 20px;
                white-space: nowrap;
            }

            .xc-ms-chip i {
                cursor: pointer;
                font-size: 14px;
                color: #9aa0ac;
            }

            .xc-ms-chip i:hover {
                color: #ef4444;
            }

            .xc-ms-avatar {
                width: 20px;
                height: 20px;
                border-radius: 50%;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 9px;
                font-weight: 700;
            }

            .xc-ms-search {
                flex: 1;
                min-width: 100px;
                border: none;
                outline: none;
                font-size: 13px;
                background: transparent;
                padding: 4px 0;
            }

            .xc-ms-panel {
                display: none;
                position: absolute;
                top: calc(100% + 4px);
                left: 0;
                right: 0;
                background: #fff;
                border: 1px solid #e4e6ea;
                border-radius: 8px;
                max-height: 240px;
                overflow-y: auto;
                box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
                z-index: 20;
            }

            .xc-ms-panel.open {
                display: block;
            }

            .xc-ms-option {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 9px 12px;
                font-size: 13px;
                color: #444;
                cursor: pointer;
            }

            .xc-ms-option:hover,
            .xc-ms-option.selected {
                background: #f3fbfa;
            }

            .xc-ms-option .xc-ms-avatar {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .xc-ms-option-name {
                flex: 1;
            }

            .xc-ms-option .bx-check {
                font-size: 18px;
                color: #0fb4a0;
                visibility: hidden;
            }

            .xc-ms-option.selected .bx-check {
                visibility: visible;
            }

            .xc-ms-empty {
                padding: 12px;
                font-size: 13px;
                color: #9aa0ac;
                text-align: center;
            }

            /* ---- Toggle switches ---- */
            .xc-check-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 4px 18px;
            }

            @media (min-width: 1200px) {
                .xc-check-grid {
                    grid-template-columns: repeat(4, 1fr);
                }
            }

            .xc-toggle-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 10px;
                padding: 10px 4px;
                border-bottom: 0.5px solid #f0f2f5;
            }

            .xc-toggle-item .xc-toggle-label {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: #444;
            }

            .xc-toggle-label i {
                font-size: 15px;
                color: #0fb4a0;
                width: 18px;
                text-align: center;
            }

            /* checkbox styled as a toggle switch, fully functional */
            .xc-switch {
                position: relative;
                display: inline-block;
                width: 38px;
                height: 22px;
                flex-shrink: 0;
            }

            .xc-switch input {
                opacity: 0;
                width: 0;
                height: 0;
                position: absolute;
            }

            .xc-switch .xc-slider {
                position: absolute;
                cursor: pointer;
                inset: 0;
                background-color: #d6dadf;
                border-radius: 22px;
                transition: background-color .15s;
            }

            .xc-switch .xc-slider::before {
                content: "";
                position: absolute;
                height: 16px;
                width: 16px;
                left: 3px;
                top: 3px;
                background-color: #fff;
                border-radius: 50%;
                transition: transform .15s;
            }

            .xc-switch input:checked+.xc-slider {
                background-color: #0fb4a0;
            }

            .xc-switch input:checked+.xc-slider::before {
                transform: translateX(16px);
            }

            .xc-switch input:focus-visible+.xc-slider {
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .25);
            }

            /* Divider */
            .xc-divider {
                border: none;
                border-top: 0.5px solid #f0f2f5;
                margin: 18px 0;
            }

            /* Footer */
            .xc-form-footer {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 16px 22px;
            }

            .btn-xc-save {
                height: 42px;
                padding: 0 32px;
                background: #0fb4a0;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                cursor: pointer;
                transition: background .15s;
            }

            .btn-xc-save:hover {
                background: #0d9b89;
            }

            .btn-xc-cancel {
                height: 42px;
                padding: 0 24px;
                background: #6b7280;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                transition: background .15s;
            }

            .btn-xc-cancel:hover {
                background: #565d66;
                color: #fff;
                text-decoration: none;
            }

            /* Material table */
            .xc-material-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 18px 22px;
                margin-bottom: 18px;
            }

            .xc-material-card table {
                margin-bottom: 12px;
            }

            .req {
                color: #ef4444;
                margin-left: 2px;
            }

            /* ============ RESPONSIVE ============ */
            @media (max-width: 768px) {
                .xc-content {
                    padding: 18px;
                }

                .xc-header h2 {
                    font-size: 19px;
                }

                .xc-wizard {
                    flex-wrap: wrap;
                    gap: 16px 12px;
                    padding: 16px;
                }

                .xc-wizard-connector {
                    display: none;
                }

                .xc-wizard-step,
                .xc-wizard-step:last-child {
                    flex: 0 0 calc(50% - 6px);
                    min-width: 0;
                }

                .xc-form-card,
                .xc-material-card,
                .xc-team-card,
                .xc-upload-body {
                    padding: 16px;
                }
            }

            @media (max-width: 576px) {
                .xc-check-grid {
                    grid-template-columns: 1fr;
                }

                .xc-form-footer {
                    flex-direction: column-reverse;
                }

                .btn-xc-save,
                .btn-xc-cancel {
                    width: 100%;
                    justify-content: center;
                    text-align: center;
                }

                .xc-material-card table {
                    display: block;
                    overflow-x: auto;
                    white-space: nowrap;
                }
            }
        </style>

        <div class="xc-wrapper">
            <div class="xc-content">

                <!-- Header -->
                <div class="xc-header">
                    <h2>Add Project</h2>
                </div>
                <div class="xc-breadcrumb">
                    <a href="<?= base_url('dashboard') ?>">Project Monitoring</a>
                    <span>&rsaquo;</span> Add Project
                </div>

                <!-- Wizard -->
                <div class="xc-wizard">
                    <div class="xc-wizard-step active">
                        <div class="step-circle">1</div>
                        <div class="step-label">Step 1<br>Basic Details</div>
                    </div>
                    <div class="xc-wizard-connector"></div>
                    <div class="xc-wizard-step">
                        <div class="step-circle">2</div>
                        <div class="step-label">Step 2<br>Floor Plan</div>
                    </div>
                    <div class="xc-wizard-connector"></div>
                    <div class="xc-wizard-step">
                        <div class="step-circle">3</div>
                        <div class="step-label">Step 3<br>Floor Area</div>
                    </div>
                    <div class="xc-wizard-connector"></div>
                    <div class="xc-wizard-step">
                        <div class="step-circle">4</div>
                        <div class="step-label">Step 4<br>Set Camera</div>
                    </div>
                </div>

                <form id="projectForm" method="post" action="<?= base_url('project/save_step1') ?>">

                    <!-- Two-column layout: left = customer/project/location, right = upload + team -->
                    <div class="xc-grid">

                        <!-- LEFT COLUMN -->
                        <div>
                            <div class="xc-form-card">

                                <!-- Customer -->
                                <div class="xc-section-label">Customer Details</div>
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Customer <span class="req">*</span></label>
                                        <select name="customer_id" id="customer_id" class="form-select" required>
                                            <option value="">Select Customer</option>
                                            <?php foreach ($customers as $row): ?>
                                                <option value="<?= $row->id ?>"><?= htmlspecialchars($row->name) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Customer User</label>
                                        <select name="customer_user_id" id="customer_user_id" class="form-select">
                                            <option value="">Select User</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Mobile No <span class="req">*</span></label>
                                        <div class="xc-mobile-group">
                                            <span class="xc-cc">+91</span>
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                placeholder="Auto-filled">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Project Name <span class="req">*</span></label>
                                        <input type="text" name="project_name" class="form-control"
                                            placeholder="Enter project name" required>
                                    </div>

                                </div>

                                <hr class="xc-divider">

                                <!-- Project dates -->
                                <div class="xc-section-label">Project Details</div>
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>

                                </div>

                                <hr class="xc-divider">

                                <!-- Location -->
                                <div class="xc-section-label">Location</div>
                                <div class="row g-3">

                                    <div class="col-md-4 xc-icon-field">
                                        <label class="form-label">Country</label>
                                        <i class="bx bx-map"></i>
                                        <input type="text" name="country" id="country" class="form-control">
                                    </div>

                                    <div class="col-md-4 xc-icon-field">
                                        <label class="form-label">State</label>
                                        <i class="bx bx-map"></i>
                                        <input type="text" name="state" id="state" class="form-control">
                                    </div>

                                    <div class="col-md-4 xc-icon-field">
                                        <label class="form-label">City</label>
                                        <i class="bx bx-map-pin"></i>
                                        <input type="text" name="city" id="city" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Address <span class="req">*</span></label>
                                        <textarea name="address" id="address" rows="3" class="form-control"
                                            placeholder="Enter full address"></textarea>
                                    </div>

                                </div>

                            </div><!-- /.xc-form-card -->

                            <!-- Project Materials -->
                            <div class="xc-material-card">
                                <div class="xc-section-label" style="margin-bottom:10px;">Project Materials</div>

                                <table class="table table-bordered" id="materialTable">

                                    <thead>
                                        <tr>
                                            <th width="45%">Category</th>
                                            <th width="45%">Material</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="materialBody">

                                        <tr class="material-row">

                                            <td>
                                                <select name="category_id[]" class="form-select category">

                                                    <option value="">Select Category</option>

                                                    <?php foreach ($priority_categories as $cat) { ?>

                                                        <option value="<?= $cat->id ?>">
                                                            <?= $cat->category_name ?>
                                                        </option>

                                                    <?php } ?>

                                                </select>
                                            </td>

                                            <td>

                                                <select name="subcategory_id[]" class="form-select subcategory">

                                                    <option value="">Select Material</option>

                                                </select>

                                            </td>

                                            <td>

                                                <button type="button" class="btn btn-danger removeRow">

                                                    <i class="bx bx-trash"></i>

                                                </button>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                                <button type="button" id="addRow" class="btn btn-success">

                                    + Add Material

                                </button>
                            </div>

                        </div><!-- /LEFT COLUMN -->

                        <!-- RIGHT COLUMN -->
                        <div>

                            <!-- Upload Files -->
                            <div class="xc-upload-card">
                                <div class="xc-section-title">Upload Project Related Files</div>
                                <div class="xc-upload-body">

                                    <label class="form-label">Select Folder</label>
                                    <select class="form-select">
                                        <option value="">Select Folder</option>
                                        <?php foreach ($folders as $folder): ?>
                                            <option value="<?= $folder->id ?>">
                                                <?= htmlspecialchars($folder->folder_name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <label class="xc-dropzone">
                                        <i class="bx bx-cloud-upload xc-dz-icon"></i>
                                        <div class="xc-dz-text">Drag &amp; drop file or click to browse</div>
                                        <input type="file">
                                    </label>

                                    <label class="xc-check-item">
                                        <input type="checkbox"> Visible To Customer
                                    </label>

                                    <button type="button" class="btn-xc-upload">Upload File</button>

                                </div>
                            </div>

                            <!-- Team -->
                            <div class="xc-team-card">
                                <div class="xc-section-label">Team Assignment</div>
                                <div class="row g-3">

                                    <div class="col-md-12">
                                        <label class="form-label">Engineer <span class="req">*</span></label>
                                        <div class="xc-multiselect" data-placeholder="Search engineer">
                                            <select name="engineer_ids[]" multiple>
                                                <?php foreach ($teams as $team): ?>
                                                    <option value="<?= $team->id ?>"><?= htmlspecialchars($team->name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Project Manager <span class="req">*</span></label>
                                        <div class="xc-multiselect" data-placeholder="Search project manager">
                                            <select name="project_manager_ids[]" multiple>
                                                <?php foreach ($teams as $team): ?>
                                                    <option value="<?= $team->id ?>"><?= htmlspecialchars($team->name) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Monitoring Cycle (Days)</label>
                                        <input type="number" name="monitoring_cycle" class="form-control"
                                            placeholder="e.g. 7">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Status <span class="req">*</span></label>
                                        <select name="status" class="form-select">
                                            <option value="Draft">Draft</option>
                                            <option value="Project Started">Project Started</option>
                                            <option value="Running">Running</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div><!-- /RIGHT COLUMN -->

                    </div><!-- /.xc-grid -->

                    <!-- Watermark + Reminder (full width, toggle switches) -->
                    <div class="xc-form-card">

                        <div class="xc-section-label">Image Watermark Configuration</div>
                        <div class="xc-check-grid" style="margin-bottom: 6px;">

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-buildings"></i>Company Title</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-folder"></i>Project Name</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-layer"></i>Floor</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-grid-alt"></i>Area</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-camera"></i>View Angle</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-map-pin"></i>Location</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-globe"></i>LatLong</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-calendar"></i>Datetime</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                        </div>

                        <hr class="xc-divider">

                        <div class="xc-section-label">Project Reminder Configuration</div>
                        <div class="xc-check-grid">

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-envelope"></i>Email</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                            <label class="xc-toggle-item">
                                <span class="xc-toggle-label"><i class="bx bx-bell"></i>Notification</span>
                                <span class="xc-switch">
                                    <input type="checkbox" checked>
                                    <span class="xc-slider"></span>
                                </span>
                            </label>

                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="xc-form-footer">
                        <a href="<?= base_url('project') ?>" class="btn-xc-cancel">Cancel</a>
                        <button type="submit" class="btn-xc-save">Save &amp; Next &rarr;</button>
                    </div>

                </form>

            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>

                /* ===== Avatar-based member picker (Engineer / Project Manager) ===== */
                var XC_AVATAR_COLORS = [
                    { bg: '#e0f7f4', fg: '#0d9b89' },
                    { bg: '#e6f1fb', fg: '#185fa5' },
                    { bg: '#f4ecfb', fg: '#7c3aed' },
                    { bg: '#faece7', fg: '#c2410c' },
                    { bg: '#fbeaf0', fg: '#be185d' },
                    { bg: '#faeeda', fg: '#92400e' }
                ];

                function xcInitials(name) {
                    var parts = name.trim().split(/\s+/);
                    var initials = parts[0] ? parts[0][0] : '';
                    if (parts.length > 1) initials += parts[1][0];
                    return initials.toUpperCase();
                }

                function xcColorFor(name) {
                    var sum = 0;
                    for (var i = 0; i < name.length; i++) sum += name.charCodeAt(i);
                    return XC_AVATAR_COLORS[sum % XC_AVATAR_COLORS.length];
                }

                function enhanceMemberSelect(wrapper) {
                    var select = wrapper.querySelector('select');
                    select.style.display = 'none';

                    var inputRow = document.createElement('div');
                    inputRow.className = 'xc-ms-input-row';
                    var chipsBox = document.createElement('span');
                    chipsBox.style.display = 'contents';
                    var searchInput = document.createElement('input');
                    searchInput.type = 'text';
                    searchInput.className = 'xc-ms-search';
                    searchInput.placeholder = wrapper.dataset.placeholder || 'Search...';
                    inputRow.appendChild(chipsBox);
                    inputRow.appendChild(searchInput);
                    wrapper.appendChild(inputRow);

                    var panel = document.createElement('div');
                    panel.className = 'xc-ms-panel';
                    wrapper.appendChild(panel);

                    function renderOptions(filter) {
                        panel.innerHTML = '';
                        var matches = 0;
                        Array.from(select.options).forEach(function (opt) {
                            if (filter && opt.text.toLowerCase().indexOf(filter.toLowerCase()) === -1) return;
                            matches++;
                            var c = xcColorFor(opt.text);
                            var item = document.createElement('div');
                            item.className = 'xc-ms-option' + (opt.selected ? ' selected' : '');
                            item.innerHTML =
                                '<span class="xc-ms-avatar" style="background:' + c.bg + ';color:' + c.fg + '">' + xcInitials(opt.text) + '</span>' +
                                '<span class="xc-ms-option-name">' + opt.text + '</span>' +
                                '<i class="bx bx-check"></i>';
                            item.addEventListener('click', function () {
                                opt.selected = !opt.selected;
                                renderChips();
                                renderOptions(searchInput.value);
                            });
                            panel.appendChild(item);
                        });
                        if (!matches) panel.innerHTML = '<div class="xc-ms-empty">No matches</div>';
                    }

                    function renderChips() {
                        chipsBox.innerHTML = '';
                        Array.from(select.selectedOptions).forEach(function (opt) {
                            var c = xcColorFor(opt.text);
                            var chip = document.createElement('span');
                            chip.className = 'xc-ms-chip';
                            chip.innerHTML =
                                '<span class="xc-ms-avatar" style="background:' + c.bg + ';color:' + c.fg + '">' + xcInitials(opt.text) + '</span>' +
                                opt.text + ' <i class="bx bx-x"></i>';
                            chip.querySelector('i').addEventListener('click', function (e) {
                                e.stopPropagation();
                                opt.selected = false;
                                renderChips();
                                renderOptions(searchInput.value);
                            });
                            chipsBox.appendChild(chip);
                        });
                    }

                    inputRow.addEventListener('click', function () {
                        panel.classList.add('open');
                        searchInput.focus();
                        renderOptions(searchInput.value);
                    });
                    searchInput.addEventListener('input', function () { renderOptions(searchInput.value); });
                    document.addEventListener('click', function (e) {
                        if (!wrapper.contains(e.target)) panel.classList.remove('open');
                    });

                    renderChips();
                    renderOptions('');
                }

                document.querySelectorAll('.xc-multiselect').forEach(enhanceMemberSelect);

                $('#customer_id').change(function () {

                    var customer_id = $(this).val();

                    if (customer_id == '') {
                        return;
                    }

                    // CUSTOMER DETAILS

                    $.ajax({

                        url: "<?= base_url('project/get_customer') ?>",

                        type: "POST",

                        data: {
                            customer_id: customer_id
                        },

                        dataType: "json",

                        success: function (res) {

                            console.log(res);

                            $('#mobile').val(res.mobile);

                            $('#address').val(res.address);
                            $('#country').val(res.country);

                            $('#state').val(res.state);

                            $('#city').val(res.city);
                        }

                    });


                    // CUSTOMER USERS

                    $.ajax({

                        url: "<?= base_url('project/get_customer_users') ?>",

                        type: "POST",

                        data: {
                            customer_id: customer_id
                        },

                        dataType: "json",

                        success: function (users) {

                            $('#customer_user_id').html(
                                '<option value="">Select User</option>'
                            );

                            $.each(users, function (index, row) {

                                $('#customer_user_id').append(
                                    '<option value="' + row.id + '">' + row.name + '</option>'
                                );

                            });

                        }

                    });

                });

                $('#projectForm').submit(function (e) {

                    e.preventDefault();

                    $.ajax({

                        url: $(this).attr('action'),

                        type: 'POST',

                        data: $(this).serialize(),

                        dataType: 'json',

                        success: function (res) {

                            if (res.status == 'success') {
                                window.location.href =
                                    "<?= base_url('project/floors/') ?>"
                                    + res.draft_token;
                            }
                            else {
                                alert('Error');
                            }
                        }

                    });

                });
                $(document).on('change', '.category', function () {

                    var category_id = $(this).val();

                    var subcategory = $(this).closest('tr').find('.subcategory');

                    $.ajax({

                        url: "<?= base_url('project/get_priority_subcategories') ?>",

                        type: "POST",

                        data: { category_id: category_id },

                        dataType: "json",

                        success: function (res) {

                            var html = '<option value="">Select Material</option>';

                            $.each(res, function (i, row) {

                                html += '<option value="' + row.id + '">' + row.subcategory_name + '</option>';

                            });

                            subcategory.html(html);

                        }

                    });

                });
                // Add new material row
                $('#addRow').click(function () {

                    var row = `
    <tr class="material-row">

        <td>
            <select name="category_id[]" class="form-select category">

                <option value="">Select Category</option>

                <?php foreach ($priority_categories as $cat) { ?>

                    <option value="<?= $cat->id ?>">
                        <?= $cat->category_name ?>
                    </option>

                <?php } ?>

            </select>
        </td>

        <td>
            <select name="subcategory_id[]" class="form-select subcategory">
                <option value="">Select Material</option>
            </select>
        </td>

        <td>
            <button type="button" class="btn btn-danger removeRow">
                <i class="bx bx-trash"></i>
            </button>
        </td>

    </tr>`;

                    $('#materialBody').append(row);

                });

                $(document).on('click', '.removeRow', function () {

                    if ($('#materialBody tr').length > 1) {
                        $(this).closest('tr').remove();
                    }

                });
            </script>



        </div>
    </div>
