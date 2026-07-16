
<div class="page-wrapper">
    <div class="page-content">
        <div class="container-fluid py-4 px-4">

            <style>
                :root {
                    --teal:       #41c7cf;
                    --teal-dark:  #2eb5bd;
                    --teal-light: #e1f7f8;
                }

                .breadcrumb-nav { font-size: 12px; color: #888; margin-bottom: 4px; }
                .breadcrumb-nav a { color: var(--teal); text-decoration: none; }

                .page-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 1.5rem;
                }
                .page-header h3 { font-size: 22px; font-weight: 600; color: #2d3436; margin: 0; }

                .btn-back {
                    background: #f0f2f5;
                    color: #555;
                    border: 1px solid #dde1ea;
                    border-radius: 8px;
                    padding: 8px 18px;
                    font-size: 13px;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    text-decoration: none;
                    transition: background 0.2s;
                }
                .btn-back:hover { background: #e2e6ea; color: #333; }

                .form-card {
                    background: #fff;
                    border: 1px solid #e8eaf0;
                    border-radius: 12px;
                    padding: 1.75rem 2rem;
                }

                .section-title {
                    font-size: 12px;
                    font-weight: 600;
                    color: var(--teal);
                    text-transform: uppercase;
                    letter-spacing: 0.06em;
                    margin-bottom: 1rem;
                    padding-bottom: 8px;
                    border-bottom: 1px solid #f0f2f5;
                }

                .form-label {
                    font-size: 13px;
                    font-weight: 500;
                    color: #444;
                    margin-bottom: 5px;
                }

                .form-card .form-control,
                .form-card .form-select {
                    font-size: 13px;
                    height: 40px;
                    border-radius: 8px;
                    border: 1px solid #dde1ea;
                    background: #f8f9fc;
                    color: #2d3436;
                    transition: border 0.15s, box-shadow 0.15s;
                }
                .form-card .form-control:focus,
                .form-card .form-select:focus {
                    border-color: var(--teal);
                    box-shadow: 0 0 0 3px rgba(65,199,207,0.15);
                    background: #fff;
                    outline: none;
                }

                .required-field.is-invalid {
                    border: 1.5px solid #dc3545 !important;
                    background: #fff8f8 !important;
                }
                .field-error {
                    display: none;
                    color: #dc3545;
                    font-size: 11.5px;
                    margin-top: 4px;
                }
                .required-field.is-invalid ~ .field-error { display: block; }

                /* ── Team Type Checkboxes ── */
                .type-check-group {
                    display: flex;
                    gap: 12px;
                    flex-wrap: wrap;
                    margin-top: 4px;
                }
                .type-check-label {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    background: #f8f9fc;
                    border: 1px solid #dde1ea;
                    border-radius: 8px;
                    padding: 9px 16px;
                    font-size: 13px;
                    color: #444;
                    cursor: pointer;
                    transition: all 0.15s;
                    user-select: none;
                }
                .type-check-label:hover { border-color: var(--teal); background: var(--teal-light); }
                .type-check-label input[type="checkbox"] { display: none; }
                .type-check-label .check-box {
                    width: 17px; height: 17px;
                    border: 1.5px solid #bbb;
                    border-radius: 4px;
                    display: flex; align-items: center; justify-content: center;
                    flex-shrink: 0;
                    transition: all 0.15s;
                }
                .type-check-label input:checked ~ .check-box {
                    background: var(--teal); border-color: var(--teal);
                }
                .type-check-label input:checked ~ .check-box::after {
                    content: '';
                    width: 5px; height: 9px;
                    border: 2px solid #fff;
                    border-top: none; border-left: none;
                    transform: rotate(45deg) translateY(-1px);
                    display: block;
                }
                .type-check-label input:checked ~ .check-text { color: var(--teal); font-weight: 500; }
                .type-check-label:has(input:checked) { border-color: var(--teal); background: var(--teal-light); }

                /* ── Status Radio ── */
                .status-toggle-group { display: flex; gap: 8px; margin-top: 4px; }
                .status-radio-label {
                    display: flex; align-items: center; gap: 7px;
                    border: 1px solid #dde1ea;
                    border-radius: 8px;
                    padding: 9px 20px;
                    font-size: 13px;
                    color: #555;
                    cursor: pointer;
                    transition: all 0.15s;
                    background: #f8f9fc;
                }
                .status-radio-label input { display: none; }
                .status-radio-label .dot {
                    width: 9px; height: 9px; border-radius: 50%;
                    background: #ccc; transition: background 0.15s;
                }
                .status-radio-label:has(input[value="Active"]:checked)   { border-color: #1a7a4a; background: #e6f9f0; color: #1a7a4a; }
                .status-radio-label:has(input[value="Active"]:checked) .dot   { background: #1a7a4a; }
                .status-radio-label:has(input[value="Inactive"]:checked) { border-color: #a32d2d; background: #fde8e8; color: #a32d2d; }
                .status-radio-label:has(input[value="Inactive"]:checked) .dot { background: #a32d2d; }

                /* ── Buttons ── */
                .btn-save {
                    background: var(--teal);
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    padding: 10px 28px;
                    font-size: 13px;
                    font-weight: 500;
                    display: inline-flex;
                    align-items: center;
                    gap: 7px;
                    cursor: pointer;
                    transition: background 0.2s;
                }
                .btn-save:hover { background: var(--teal-dark); }

                .btn-cancel {
                    background: #f0f2f5;
                    color: #555;
                    border: 1px solid #dde1ea;
                    border-radius: 8px;
                    padding: 10px 22px;
                    font-size: 13px;
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    text-decoration: none;
                    transition: background 0.2s;
                }
                .btn-cancel:hover { background: #e2e6ea; color: #333; }

                /* ── Member ID badge ── */
                .member-id-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    background: var(--teal-light);
                    color: var(--teal-dark);
                    border: 1px solid #b2eaf0;
                    border-radius: 20px;
                    padding: 4px 14px;
                    font-size: 12px;
                    font-weight: 600;
                }
            </style>

            <!-- Breadcrumb -->
            <div class="breadcrumb-nav mb-1">
                <a href="<?= base_url('dashboard') ?>">Masters</a> &rsaquo;
                <a href="<?= base_url('team') ?>">Team</a> &rsaquo;
                Edit Member
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex align-items-center gap-3">
                    <h3>Edit Team Member</h3>
                    <span class="member-id-badge">
                        <i class="ti ti-id-badge"></i>
                        T<?= str_pad($member->id, 5, '0', STR_PAD_LEFT) ?>
                    </span>
                </div>
                <a href="<?= base_url('team') ?>" class="btn-back">
                    <i class="ti ti-arrow-left"></i> Back to Team
                </a>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <form method="post"
                      action="<?= site_url('team/update/' . $member->id) ?>"
                      autocomplete="off"
                      id="editTeamForm">

                    <!-- Section: Personal Info -->
                    <div class="section-title">Personal Information</div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control required-field"
                                placeholder="Enter full name"
                                value="<?= htmlspecialchars($member->name) ?>"
                                autocomplete="off">
                            <div class="field-error">Name is required.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email ID <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control required-field"
                                placeholder="Enter email address"
                                value="<?= htmlspecialchars($member->email) ?>"
                                autocomplete="off">
                            <div class="field-error">Email is required.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobile"
                                class="form-control required-field"
                                placeholder="Enter mobile number"
                                value="<?= htmlspecialchars($member->mobile) ?>"
                                maxlength="10">
                            <div class="field-error">Mobile number is required.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">
                                New Password
                                <span style="font-size:11px; color:#aaa; font-weight:400;">(leave blank to keep current)</span>
                            </label>
                            <div style="position:relative;">
                                <input type="password" name="password" id="passwordField"
                                    class="form-control"
                                    placeholder="Enter new password"
                                    autocomplete="new-password"
                                    style="padding-right:42px;">
                                <span onclick="togglePass()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#aaa;font-size:16px;">
                                    <i class="ti ti-eye" id="passEyeIcon"></i>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- Section: Location -->
                    <div class="section-title mt-2">Location Details</div>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" name="country"
                                class="form-control required-field"
                                placeholder="Enter country"
                                value="<?= htmlspecialchars($member->country) ?>">
                            <div class="field-error">Country is required.</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" name="state"
                                class="form-control required-field"
                                placeholder="Enter state"
                                value="<?= htmlspecialchars($member->state) ?>">
                            <div class="field-error">State is required.</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" name="city"
                                class="form-control required-field"
                                placeholder="Enter city"
                                value="<?= htmlspecialchars($member->city) ?>">
                            <div class="field-error">City is required.</div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" name="address"
                                class="form-control required-field"
                                placeholder="Enter full address"
                                value="<?= htmlspecialchars($member->address) ?>">
                            <div class="field-error">Address is required.</div>
                        </div>

                    </div>

                    <!-- Section: Role & Status -->
                    <div class="section-title mt-2">Role & Status</div>
                    <div class="row">

                        <div class="col-md-12 mb-4">
                            <label class="form-label d-block">Team Type</label>
                            <div class="type-check-group">

                                <label class="type-check-label">
                                    <input type="checkbox" name="is_senior" value="1"
                                        <?= ($member->is_senior == 1) ? 'checked' : '' ?>>
                                    <span class="check-box"></span>
                                    <span class="check-text">Senior</span>
                                </label>

                                <label class="type-check-label">
                                    <input type="checkbox" name="is_project_manager" value="1"
                                        <?= ($member->is_project_manager == 1) ? 'checked' : '' ?>>
                                    <span class="check-box"></span>
                                    <span class="check-text">Project Manager</span>
                                </label>

                                <label class="type-check-label">
                                    <input type="checkbox" name="is_site_engineer" value="1"
                                        <?= ($member->is_site_engineer == 1) ? 'checked' : '' ?>>
                                    <span class="check-box"></span>
                                    <span class="check-text">Site Engineer</span>
                                </label>

                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label d-block">Status</label>
                            <div class="status-toggle-group">

                                <label class="status-radio-label">
                                    <input type="radio" name="status" value="Active"
                                        <?= ($member->status == 'Active') ? 'checked' : '' ?>>
                                    <span class="dot"></span> Active
                                </label>

                                <label class="status-radio-label">
                                    <input type="radio" name="status" value="Inactive"
                                        <?= ($member->status == 'Inactive') ? 'checked' : '' ?>>
                                    <span class="dot"></span> Inactive
                                </label>

                            </div>
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex gap-3" style="border-top:1px solid #f0f2f5; padding-top:1.25rem;">
                        <button type="submit" class="btn-save">
                            <i class="ti ti-device-floppy"></i> Update Member
                        </button>
                        <a href="<?= base_url('team') ?>" class="btn-cancel">
                            <i class="ti ti-x"></i> Cancel
                        </a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
function togglePass() {
    var f = document.getElementById('passwordField');
    var i = document.getElementById('passEyeIcon');
    if (f.type === 'password') {
        f.type = 'text';
        i.className = 'ti ti-eye-off';
    } else {
        f.type = 'password';
        i.className = 'ti ti-eye';
    }
}

document.getElementById('editTeamForm').addEventListener('submit', function(e) {
    var valid = true;

    document.querySelectorAll('.required-field').forEach(function(field) {
        field.classList.remove('is-invalid');
        if (field.value.trim() === '') {
            field.classList.add('is-invalid');
            valid = false;
        }
    });

    if (!valid) {
        e.preventDefault();
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill all required fields.'
            });
        } else {
            alert('Please fill all required fields.');
        }
    }
});
</script>
