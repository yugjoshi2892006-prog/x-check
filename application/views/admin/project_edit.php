<div class="page-wrapper">
    <div class="page-content">

        <style>
            .xc-wrapper {
                background: #fff;
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
                margin-bottom: 24px;
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
                align-items: center;
                gap: 0;
                margin-bottom: 28px;
            }

            .xc-wizard-step {
                display: flex;
                align-items: center;
                gap: 10px;
                flex: 1;
            }

            .xc-wizard-step:last-child {
                flex: none;
            }

            .xc-wizard-step .step-circle {
                width: 34px;
                height: 34px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 13px;
                font-weight: 600;
                flex-shrink: 0;
                border: 2px solid #dde0e6;
                background: #fff;
                color: #9aa0ac;
                transition: all .2s;
            }

            .xc-wizard-step.active .step-circle {
                background: #0fb4a0;
                border-color: #0fb4a0;
                color: #fff;
            }

            .xc-wizard-step.done .step-circle {
                background: #e0f7f4;
                border-color: #0fb4a0;
                color: #0fb4a0;
            }

            .xc-wizard-step .step-label {
                font-size: 12px;
                font-weight: 500;
                color: #9aa0ac;
            }

            .xc-wizard-step.active .step-label {
                color: #0fb4a0;
                font-weight: 600;
            }

            .xc-wizard-step.done .step-label {
                color: #0fb4a0;
            }

            .xc-wizard-connector {
                flex: 1;
                height: 2px;
                background: #dde0e6;
                margin: 0 8px;
            }

            .xc-wizard-connector.done {
                background: #0fb4a0;
            }

            /* Form card */
            .xc-form-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 28px 28px 24px;
                margin-bottom: 20px;
            }

            .xc-section-label {
                font-size: 11px;
                font-weight: 600;
                letter-spacing: .06em;
                text-transform: uppercase;
                color: #9aa0ac;
                margin-bottom: 18px;
            }

            .xc-section-title {
                font-size: 13px;
                font-weight: 600;
                color: #0fb4a0;
                margin: 4px 0 16px;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .xc-section-title::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #e4e6ea;
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

            /* File input */
            .xc-form-card input[type="file"].form-control {
                padding: 8px 13px;
                height: auto;
            }

            /* Checkbox group */
            .xc-check-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 10px 16px;
                margin-bottom: 4px;
            }

            .xc-check-item {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 13px;
                color: #444;
                cursor: pointer;
            }

            .xc-check-item input[type="checkbox"] {
                width: 16px;
                height: 16px;
                accent-color: #0fb4a0;
                cursor: pointer;
                flex-shrink: 0;
            }

            /* Upload file row */
            .xc-upload-row {
                display: flex;
                align-items: flex-end;
                gap: 12px;
                flex-wrap: wrap;
            }

            .xc-upload-row .xc-upload-select {
                flex: 2;
                min-width: 180px;
            }

            .xc-upload-row .xc-upload-check {
                flex: 1;
                min-width: 140px;
                padding-bottom: 2px;
            }

            .xc-upload-row .xc-upload-btn {
                flex: 1;
                min-width: 140px;
            }

            .btn-xc-upload {
                height: 42px;
                width: 100%;
                background: #fff;
                color: #0fb4a0;
                border: 1.5px solid #0fb4a0;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                transition: background .15s;
            }

            .btn-xc-upload:hover {
                background: #f0faf9;
            }

            /* Divider */
            .xc-divider {
                border: none;
                border-top: 0.5px solid #f0f2f5;
                margin: 22px 0;
            }

            /* Footer */
            .xc-form-footer {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-top: 8px;
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
                background: #fff;
                color: #555;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                font-size: 13.5px;
                font-weight: 500;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                transition: background .15s;
            }

            .btn-xc-cancel:hover {
                background: #f5f5f5;
                color: #333;
                text-decoration: none;
            }

            /* Floor add card */
            .xc-floor-row {
                display: flex;
                gap: 12px;
                align-items: center;
            }

            .xc-floor-row .form-control {
                flex: 1;
            }

            .btn-xc-add-floor {
                height: 42px;
                padding: 0 28px;
                background: #0fb4a0;
                color: #fff;
                border: none;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                white-space: nowrap;
                transition: background .15s;
            }

            .btn-xc-add-floor:hover {
                background: #0d9b89;
            }

            .req {
                color: #ef4444;
                margin-left: 2px;
            }

            /* ============================================
               UPGRADED CUSTOM MULTI-SELECT (replaces select2)
               No external library, no jQuery plugin dependency.
               A hidden native <select multiple> stays in sync so
               POST data (engineer_ids[] / project_manager_ids[])
               is completely unchanged.
               ============================================ */
            .xc-multiselect {
                position: relative;
            }

            .xc-ms-control {
                min-height: 42px;
                border: 1px solid #dde0e6;
                border-radius: 8px;
                background: #fafbfc;
                padding: 6px 36px 6px 10px;
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                align-items: center;
                cursor: pointer;
                position: relative;
                transition: border-color .15s, box-shadow .15s, background .15s;
            }

            .xc-ms-control:hover {
                border-color: #c7ccd4;
            }

            .xc-multiselect.open .xc-ms-control {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
            }

            .xc-ms-placeholder {
                font-size: 13px;
                color: #aab0bb;
                padding: 2px 0;
            }

            .xc-ms-chip {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: #e0f7f4;
                color: #0d9b89;
                font-size: 12.5px;
                font-weight: 500;
                padding: 4px 6px 4px 10px;
                border-radius: 6px;
                line-height: 1.3;
            }

            .xc-ms-chip-remove {
                width: 16px;
                height: 16px;
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: #0d9b89;
                font-size: 13px;
                cursor: pointer;
                transition: background .12s;
            }

            .xc-ms-chip-remove:hover {
                background: rgba(13, 155, 137, .18);
            }

            .xc-ms-arrow {
                position: absolute;
                right: 13px;
                top: 50%;
                width: 9px;
                height: 9px;
                border-right: 2px solid #9aa0ac;
                border-bottom: 2px solid #9aa0ac;
                transform: translateY(-65%) rotate(45deg);
                transition: transform .15s;
                pointer-events: none;
            }

            .xc-multiselect.open .xc-ms-arrow {
                transform: translateY(-35%) rotate(-135deg);
            }

            .xc-ms-panel {
                position: absolute;
                top: calc(100% + 6px);
                left: 0;
                right: 0;
                background: #fff;
                border: 1px solid #e4e6ea;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(20, 25, 40, .12);
                z-index: 40;
                display: none;
                overflow: hidden;
            }

            .xc-multiselect.open .xc-ms-panel {
                display: block;
            }

            .xc-ms-search {
                padding: 8px;
                border-bottom: 1px solid #f0f2f5;
            }

            .xc-ms-search input {
                width: 100%;
                height: 34px;
                border: 1px solid #e4e6ea;
                border-radius: 6px;
                padding: 0 10px;
                font-size: 12.5px;
                outline: none;
                background: #fafbfc;
            }

            .xc-ms-search input:focus {
                border-color: #0fb4a0;
            }

            .xc-ms-options {
                max-height: 190px;
                overflow-y: auto;
                padding: 6px;
            }

            .xc-ms-option {
                display: flex;
                align-items: center;
                gap: 9px;
                padding: 8px 10px;
                border-radius: 6px;
                font-size: 13px;
                color: #333;
                cursor: pointer;
            }

            .xc-ms-option:hover {
                background: #f0faf9;
            }

            .xc-ms-option.selected {
                background: #e0f7f4;
                color: #0d9b89;
                font-weight: 500;
            }

            .xc-ms-option-box {
                width: 16px;
                height: 16px;
                border-radius: 4px;
                border: 1.5px solid #cdd2da;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #fff;
            }

            .xc-ms-option.selected .xc-ms-option-box {
                background: #0fb4a0;
                border-color: #0fb4a0;
            }

            .xc-ms-option.selected .xc-ms-option-box::after {
                content: '';
                width: 4px;
                height: 8px;
                border-right: 2px solid #fff;
                border-bottom: 2px solid #fff;
                transform: rotate(45deg) translate(-1px, -1px);
            }

            .xc-ms-empty {
                padding: 16px 10px;
                text-align: center;
                font-size: 12.5px;
                color: #aab0bb;
            }

            /* The real <select multiple> is kept for form submission only */
            .xc-ms-native {
                position: absolute;
                width: 1px;
                height: 1px;
                opacity: 0;
                pointer-events: none;
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
                    <span>›</span> Add Project
                </div>

                <!-- Wizard -->
                <div class="xc-wizard">
                    <div class="xc-wizard-step active">
                        <div class="step-circle">1</div>
                        <div class="step-label">Project Details</div>
                    </div>
                    <div class="xc-wizard-connector"></div>
                    <div class="xc-wizard-step">
                        <div class="step-circle">2</div>
                        <div class="step-label">Floors</div>
                    </div>
                    <div class="xc-wizard-connector"></div>
                    <div class="xc-wizard-step">
                        <div class="step-circle">3</div>
                        <div class="step-label">Areas</div>
                    </div>
                    <div class="xc-wizard-connector"></div>
                    <div class="xc-wizard-step">
                        <div class="step-circle">4</div>
                        <div class="step-label">Review</div>
                    </div>
                </div>

                <!-- STEP 1 Form card -->
                <div class="xc-form-card">

                    <!-- <form method="post" action="<?= base_url('project/save_step1') ?>"> -->

                    <form method="post" action="<?= base_url('project/update_step1/' . $project->id) ?>">

                        <!-- Customer -->
                        <div class="xc-section-label">Customer Details</div>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Customer <span class="req">*</span></label>
                                <!-- <select name="customer_id" class="form-select" required> -->
                                <select name="customer_id" id="customer_id" class="form-select" required>
                                    <option value="">Select Customer</option>
                                    <?php foreach ($customers as $row): ?>
                                        <option value="<?= $row->id ?>" <?= ($project->customer_id == $row->id) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($row->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Mobile No <span class="req">*</span></label>
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                    value="<?= $project->mobile ?>" placeholder="Auto-filled">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Customer User</label>
                                <select name="customer_user_id" id="customer_user_id" class="form-select">
                                    <option value="">Select User</option>
                                </select>
                            </div>

                        </div>

                        <hr class=" xc-divider">

                        <!-- Project -->
                        <div class="xc-section-label">Project Details</div>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Project Name <span class="req">*</span></label>
                                <input type="text" name="project_name" class="form-control"
                                    value="<?= $project->project_name ?>">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="<?= $project->start_date ?>">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="<?= $project->end_date ?>">
                            </div>

                        </div>

                        <hr class="xc-divider">

                        <!-- Location -->
                        <div class="xc-section-label">Location</div>
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Country</label>

                                <input type="text" name="country_id" id="country_id" class="form-control"
                                    value="<?= $project->country_id ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">State</label>

                                <input type="text" name="state_id" id="state_id" class="form-control"
                                    value="<?= $project->state_id ?>">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">City</label>

                                <input type="text" name="city_id" id="city_id" class="form-control"
                                    value="<?= $project->city_id ?>">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address <span class="req">*</span></label>
                                <textarea name="address" id="address" rows="3"
                                    class="form-control"><?= $project->address ?></textarea>
                            </div>

                        </div>

                        <hr class="xc-divider">

                        <!-- Upload Files -->
                        <div class="xc-section-title">Upload Project Related Files</div>
                        <div class="xc-upload-row">
                            <div class="xc-upload-select">
                                <label class="form-label">Select Folder</label>
                                <select class="form-select">
                                    <option value="">Select Folder</option>
                                    <?php foreach ($folders as $folder): ?>
                                        <option value="<?= $folder->id ?>">
                                            <?= htmlspecialchars($folder->folder_name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="xc-upload-check">
                                <label class="xc-check-item">
                                    <input type="checkbox"> Visible To Customer
                                </label>
                            </div>
                            <div class="xc-upload-btn">
                                <button type="button" class="btn-xc-upload">↑ Upload File</button>
                            </div>
                        </div>

                        <hr class="xc-divider">

                        <!-- Team -->
                        <div class="xc-section-label">Team Assignment</div>
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Engineer <span class="req">*</span></label>

                                <!--
                                    UPGRADED UI: custom multi-select replaces the
                                    plain native listbox. The real <select multiple
                                    name="engineer_ids[]"> below still has the exact
                                    same PHP loop + "selected" logic as before, so
                                    pre-selected engineers on Edit still work and the
                                    POST payload is unchanged. It's just visually
                                    hidden and driven by the styled control above it.
                                -->
                                <div class="xc-multiselect" data-ms-for="engineer_ids_select">
                                    <div class="xc-ms-control" tabindex="0">
                                        <span class="xc-ms-placeholder">Select Engineer</span>
                                        <div class="xc-ms-arrow"></div>
                                    </div>
                                    <div class="xc-ms-panel">
                                        <div class="xc-ms-search">
                                            <input type="text" placeholder="Search engineers...">
                                        </div>
                                        <div class="xc-ms-options"></div>
                                    </div>
                                </div>

                                <select name="engineer_ids[]" id="engineer_ids_select" class="xc-ms-native" multiple>

                                    <?php foreach ($teams as $team): ?>

                                        <option value="<?= $team->id ?>" <?= in_array($team->id, $selected_engineers ?? [])
                                              ? 'selected'
                                              : '' ?>>

                                            <?= $team->name ?>

                                        </option>

                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Monitoring Cycle (Days)</label>
                                <input type="number" name="monitoring_cycle" class="form-control"
                                    value="<?= $project->monitoring_cycle ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Project Manager <span class="req">*</span></label>

                                <div class="xc-multiselect" data-ms-for="project_manager_ids_select">
                                    <div class="xc-ms-control" tabindex="0">
                                        <span class="xc-ms-placeholder">Select Project Manager</span>
                                        <div class="xc-ms-arrow"></div>
                                    </div>
                                    <div class="xc-ms-panel">
                                        <div class="xc-ms-search">
                                            <input type="text" placeholder="Search managers...">
                                        </div>
                                        <div class="xc-ms-options"></div>
                                    </div>
                                </div>

                                <select name="project_manager_ids[]" id="project_manager_ids_select"
                                    class="xc-ms-native" multiple>

                                    <?php foreach ($teams as $team): ?>

                                        <option value="<?= $team->id ?>" <?= in_array($team->id, $selected_managers ?? [])
                                              ? 'selected'
                                              : '' ?>>

                                            <?= $team->name ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status <span class="req">*</span></label>
                                <select name="status" class="form-select">
                                    <option value="Draft" <?= ($project->status == 'Draft') ? 'selected' : '' ?>>
                                        Draft
                                    </option>

                                    <option value="Project Started" <?= ($project->status == 'Project Started') ? 'selected' : '' ?>>
                                        Project Started
                                    </option>

                                    <option value="Running" <?= ($project->status == 'Running') ? 'selected' : '' ?>>
                                        Running
                                    </option>

                                    <option value="Completed" <?= ($project->status == 'Completed') ? 'selected' : '' ?>>
                                        Completed
                                    </option>
                                </select>
                            </div>
                            <!-- <div class="col-md-6">
                                <label class="form-label">Priority Category</label>

                                <select name="priority_category_id" id="priority_category_id" class="form-select">
                                    <option value="">Select Category</option>

                                    <?php foreach ($priority_categories as $cat): ?>
                                        <option value="<?= $cat->id ?>" <?= ($project->priority_category_id == $cat->id) ? 'selected' : '' ?>>
                                            <?= $cat->category_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div> -->

                            <table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <th>Category</th>

                                        <th>Material</th>

                                        <th width="80">Action</th>

                                    </tr>

                                </thead>

                                <tbody id="materialBody">

                                    <?php if (!empty($priority_materials)) { ?>

                                        <?php foreach ($priority_materials as $row) { ?>

                                            <tr>

                                                <td>

                                                    <select name="category_id[]" class="form-select category">

                                                        <option value="">Select Category</option>

                                                        <?php foreach ($priority_categories as $cat) { ?>

                                                            <option value="<?= $cat->id ?>"
                                                                <?= ($cat->id == $row->category_id) ? 'selected' : ''; ?>>

                                                                <?= $cat->category_name ?>

                                                            </option>

                                                        <?php } ?>

                                                    </select>

                                                </td>

                                                <td>

                                                    <select name="subcategory_id[]" class="form-select subcategory"
                                                        data-selected="<?= $row->subcategory_id ?>">

                                                        <option>Loading...</option>

                                                    </select>

                                                </td>

                                                <td>

                                                    <button type="button" class="btn btn-danger removeRow">

                                                        <i class="bx bx-trash"></i>

                                                    </button>

                                                </td>

                                            </tr>

                                        <?php } ?>

                                    <?php } ?>

                                </tbody>

                            </table>

                            <button type="button" id="addRow" class="btn btn-success">

                                + Add Material

                            </button>
                        </div>

                        <hr class="xc-divider">

                        <!-- Watermark -->
                        <div class="xc-section-title">Image Watermark Configuration</div>
                        <div class="xc-check-grid">
                            <label class="xc-check-item"><input type="checkbox" checked> Company
                                Title</label>
                            <label class="xc-check-item"><input type="checkbox" checked> Project
                                Name</label>
                            <label class="xc-check-item"><input type="checkbox" checked> Floor</label>
                            <label class="xc-check-item"><input type="checkbox" checked> Area</label>
                            <label class="xc-check-item"><input type="checkbox" checked> View Angle</label>
                            <label class="xc-check-item"><input type="checkbox" checked> Location</label>
                            <label class="xc-check-item"><input type="checkbox" checked> LatLong</label>
                            <label class="xc-check-item"><input type="checkbox" checked> Datetime</label>
                        </div>

                        <hr class="xc-divider">

                        <!-- Reminder -->
                        <div class="xc-section-title">Project Reminder Configuration</div>
                        <div class="xc-check-grid">
                            <label class="xc-check-item"><input type="checkbox" checked> Email</label>
                            <label class="xc-check-item"><input type="checkbox" checked>
                                Notification</label>
                        </div>

                        <hr class="xc-divider">

                        <div class="xc-form-footer">
                            <a href="<?= base_url('project') ?>" class="btn-xc-cancel">Cancel</a>
                            <button type="submit" class="btn-xc-save">Save & Next →</button>
                        </div>

                    </form>
                </div><!-- /.xc-form-card -->

                <!-- STEP 2 : Floor Form -->

            </div>

         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // ============================================
    // UPGRADED CUSTOM MULTI-SELECT INITIALIZER
    // Reads <option> tags straight from the real
    // <select multiple> (which still carries all of
    // PHP's "selected" logic) and renders the styled
    // dropdown on top of it. No select2 needed.
    // ============================================
    $(document).ready(function () {

        $('.xc-multiselect').each(function () {

            var $root = $(this);
            var nativeId = $root.data('ms-for');
            var $native = $('#' + nativeId);
            var $control = $root.find('.xc-ms-control');
            var $placeholder = $root.find('.xc-ms-placeholder');
            var $panel = $root.find('.xc-ms-panel');
            var $search = $root.find('.xc-ms-search input');
            var $optionsWrap = $root.find('.xc-ms-options');

            // Build the styled option list from the native <option> tags,
            // skipping any empty "Select..." placeholder option.
            $native.find('option').each(function () {
                var value = $(this).val();
                if (value === '' || value === null) {
                    return;
                }
                var label = $(this).text().trim();
                var isSelected = $(this).prop('selected');

                var $opt = $('<div class="xc-ms-option"></div>')
                    .attr('data-value', value)
                    .attr('data-label', label)
                    .append('<div class="xc-ms-option-box"></div>')
                    .append(document.createTextNode(label));

                if (isSelected) {
                    $opt.addClass('selected');
                }

                $optionsWrap.append($opt);
            });

            function renderChips() {
                $control.find('.xc-ms-chip').remove();

                var $selectedOpts = $optionsWrap.find('.xc-ms-option.selected');

                if ($selectedOpts.length === 0) {
                    $placeholder.show();
                } else {
                    $placeholder.hide();
                    $selectedOpts.each(function () {
                        var value = $(this).attr('data-value');
                        var label = $(this).attr('data-label');
                        var $chip = $(
                            '<span class="xc-ms-chip">' + label +
                            '<span class="xc-ms-chip-remove" data-value="' + value + '">&times;</span></span>'
                        );
                        // FIX: insert inside $control (not $root), right before the arrow,
                        // so chips actually render inside the visible box instead of stray.
                        $chip.insertBefore($control.find('.xc-ms-arrow'));
                    });
                }
            }

            function syncNativeSelect() {
                var selectedValues = [];
                $optionsWrap.find('.xc-ms-option.selected').each(function () {
                    selectedValues.push($(this).attr('data-value'));
                });
                $native.find('option').each(function () {
                    $(this).prop('selected', selectedValues.indexOf($(this).val()) > -1);
                });
            }

            function toggleOption($opt) {
                $opt.toggleClass('selected');
                renderChips();
                syncNativeSelect();
            }

            // Initial paint based on whatever PHP marked as selected.
            renderChips();

            $control.on('click', function (e) {
                if ($(e.target).hasClass('xc-ms-chip-remove')) {
                    return;
                }
                $root.toggleClass('open');
                if ($root.hasClass('open')) {
                    $search.val('').trigger('input');
                    setTimeout(function () { $search.focus(); }, 0);
                }
            });

            $control.on('click', '.xc-ms-chip-remove', function (e) {
                e.stopPropagation();
                var value = $(this).data('value');
                var $opt = $optionsWrap.find('.xc-ms-option[data-value="' + value + '"]');
                $opt.removeClass('selected');
                renderChips();
                syncNativeSelect();
            });

            $optionsWrap.on('click', '.xc-ms-option', function (e) {
                e.stopPropagation();
                toggleOption($(this));
            });

            $search.on('click', function (e) {
                e.stopPropagation();
            });

            $search.on('input', function () {
                var term = $(this).val().toLowerCase();
                var anyVisible = false;

                $optionsWrap.find('.xc-ms-option').each(function () {
                    var label = ($(this).attr('data-label') || '').toLowerCase();
                    var match = label.indexOf(term) !== -1;
                    $(this).toggle(match);
                    if (match) { anyVisible = true; }
                });

                $optionsWrap.find('.xc-ms-empty').remove();
                if (!anyVisible) {
                    $optionsWrap.append('<div class="xc-ms-empty">No matches found</div>');
                }
            });

            $(document).on('click', function (e) {
                if (!$root.is(e.target) && $root.has(e.target).length === 0) {
                    $root.removeClass('open');
                }
            });
        });

    });

    // ============================================
    // CUSTOMER CHANGE → AUTOFILL (unchanged from your original)
    // ============================================
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
                $('#country_id').val(res.country);
                $('#state_id').val(res.state);
                $('#city_id').val(res.city);

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

    // ============================================
    // PRIORITY MATERIAL ROWS: Category → Subcategory AJAX
    // FIX: your old code targeted #priority_category_id /
    // #priority_sub_category_id, which don't exist in the
    // material table (it uses class="category" / class="subcategory"
    // with array field names). Rewritten to target the real
    // elements that exist in your markup.
    // ============================================
    function loadSubCategoryForRow($categorySelect, selectedSubId) {

        var category_id = $categorySelect.val();
        var $subSelect = $categorySelect.closest('tr').find('.subcategory');

        if (category_id === '' || category_id === undefined) {
            $subSelect.html('<option value="">Select Material</option>');
            return;
        }

        $.ajax({

            url: "<?= base_url('project/get_priority_subcategories') ?>",

            type: "POST",

            data: { category_id: category_id },

            dataType: "json",

            success: function (res) {

                var html = '<option value="">Select Material</option>';

                $.each(res, function (i, row) {

                    var sel = (selectedSubId !== undefined && selectedSubId !== null && selectedSubId == row.id)
                        ? 'selected'
                        : '';

                    html += '<option value="' + row.id + '" ' + sel + '>'
                        + row.subcategory_name +
                        '</option>';

                });

                $subSelect.html(html);

            }

        });
    }

    $(document).ready(function () {

        // On page load: populate subcategory dropdown for every existing
        // row (handles Edit mode where rows are pre-rendered by PHP).
        $('.category').each(function () {

            var $sub = $(this).closest('tr').find('.subcategory');
            var selected = $sub.data('selected');

            loadSubCategoryForRow($(this), selected);

        });

    });

    // When a category dropdown changes — works for existing rows
    // AND for rows added later via "+ Add Material" (event delegation).
    $(document).on('change', '.category', function () {

        loadSubCategoryForRow($(this), undefined);

    });

    // ============================================
    // ADD / REMOVE MATERIAL ROW
    // FIX: no handler existed for #addRow / .removeRow before.
    // ============================================
    $(document).ready(function () {

        $('#addRow').on('click', function () {

            // Clone the category <option> list from the first existing row.
            // Strip any "selected" attributes so the new row starts blank.
            var categoryOptionsHtml = '';

            if ($('.category').first().length) {
                categoryOptionsHtml = $('.category').first().html()
                    .replace(/\sselected(="selected")?/g, '');
            } else {
                // Fallback: no rows exist yet, build options from PHP data directly.
                categoryOptionsHtml = '<option value="">Select Category</option>';
                <?php foreach ($priority_categories as $cat) { ?>
                    categoryOptionsHtml += '<option value="<?= $cat->id ?>"><?= htmlspecialchars($cat->category_name) ?></option>';
                <?php } ?>
            }

            var newRow =
                '<tr>' +
                    '<td><select name="category_id[]" class="form-select category">' + categoryOptionsHtml + '</select></td>' +
                    '<td><select name="subcategory_id[]" class="form-select subcategory"><option value="">Select Material</option></select></td>' +
                    '<td><button type="button" class="btn btn-danger removeRow"><i class="bx bx-trash"></i></button></td>' +
                '</tr>';

            $('#materialBody').append(newRow);

        });

        $(document).on('click', '.removeRow', function () {

            $(this).closest('tr').remove();

        });

    });
</script>


        </div>
    </div>
</div>
