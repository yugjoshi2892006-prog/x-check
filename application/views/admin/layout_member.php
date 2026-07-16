<div class="page-wrapper">
    <div class="page-content">

        <div class="card xc-card radius-10">
            <div class="card-header xc-card-header">
                <h5 class="mb-0">
                    <i class="bx bx-buildings"></i>
                    Add Layout Member
                </h5>
            </div>

            <div class="card-body">

                <!-- Bootstrap alerts removed in favor of SweetAlert2 popups below -->

                <form action="<?= base_url('layout_member/save'); ?>" method="post" id="memberForm">

                    <div class="row">

                        <!-- Company -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label xc-label">
                                Company <span class="text-danger">*</span>
                            </label>

                            <select name="company_id" id="company_id" class="form-select xc-input" required>
                                <option value="">Select Company</option>

                                <?php foreach ($companies as $company) { ?>
                                    <option value="<?= $company->id; ?>">
                                        <?= $company->company_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Member -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label xc-label">
                                Member Name <span class="text-danger">*</span>
                            </label>

                            <select name="member_name" id="member_name" class="form-select xc-input" required>

                                <option value="">Select Member</option>

                            </select>

                            <input type="hidden" name="team_member_id" id="team_member_id">
                        </div>

                        <!-- Location -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label xc-label">Location</label>

                            <input type="text" class="form-control xc-input xc-input-readonly" id="location"
                                name="location" readonly>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label xc-label">Phone</label>

                            <input type="text" class="form-control xc-input xc-input-readonly" id="phone" name="phone"
                                readonly>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label xc-label">Email</label>

                            <input type="email" class="form-control xc-input xc-input-readonly" id="email" name="email"
                                readonly>
                        </div>

                        <!-- Role -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label xc-label">
                                Role <span class="text-danger">*</span>
                            </label>

                            <select name="role" id="role" class="form-select xc-input" required>

                                <option value="">Select Role</option>

                                <option value="PMC">
                                    PMC (Project Management Consultant)
                                </option>

                                <option value="Architect">
                                    Architect
                                </option>

                                <option value="Structure Consultant">
                                    Structure Consultant
                                </option>

                                <option value="Interior Designer">
                                    Interior Designer
                                </option>

                                <option value="Electrical Consultant">
                                    Electrical Consultant
                                </option>

                                <option value="PHE Consultant">
                                    PHE Consultant
                                </option>

                                <option value="HVAC Consultant">
                                    HVAC Consultant
                                </option>

                                <option value="Landscape Consultant">
                                    Landscape Consultant
                                </option>

                                <option value="Liasoning">
                                    Liasoning
                                </option>

                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label xc-label">Address</label>

                            <textarea class="form-control xc-input xc-input-readonly" rows="3" id="address"
                                name="address" readonly></textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-12 mb-3">

                            <label class="form-label xc-label">Status</label>

                            <select name="status" class="form-select xc-input">

                                <option value="1">Active</option>
                                <option value="0">Inactive</option>

                            </select>

                        </div>

                    </div>

                    <hr class="xc-hr">

                    <div class="text-end">

                        <button type="reset" class="btn xc-btn-reset">

                            Reset

                        </button>

                        <button type="submit" class="btn xc-btn-save" id="saveBtn">

                            Save Layout Member

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.all.min.js"></script>

<style>
    :root {
        --xc-teal: #0fb4a0;
        --xc-teal-dark: #0a8a7a;
        --xc-navy: #1a1a2e;
        --xc-purple: #7c3aed;
        --xc-orange: #f97316;
    }

    .xc-card {
        background: #fff;
        border: 1px solid #e9edf1;
        box-shadow: 0 1px 3px rgba(26, 26, 46, 0.05);
        overflow: hidden;
    }

    .xc-card-header {
        background: transparent;
        color: var(--xc-navy);
        border-bottom: 1px solid #e9edf1;
        padding: 1.1rem 1.4rem;
    }

    .xc-card-header h5 {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: var(--xc-navy);
    }

    .xc-card-header h5 i {
        color: var(--xc-teal);
    }

    .xc-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--xc-navy);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.4rem;
    }

    .xc-input {
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.92rem;
        transition: all 0.25s ease;
        background: #fff;
    }

    .xc-input:focus {
        border-color: var(--xc-teal);
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.12);
    }

    .xc-input-readonly {
        background: #f8fafc;
        color: #64748b;
        cursor: not-allowed;
    }

    .xc-hr {
        border-top: 1px dashed rgba(26, 26, 46, 0.15);
        margin: 1.5rem 0;
    }

    .xc-btn-reset {
        background: transparent;
        border: 1.5px solid var(--xc-orange);
        color: var(--xc-orange);
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.4rem;
        transition: all 0.25s ease;
    }

    .xc-btn-reset:hover {
        background: var(--xc-orange);
        color: #fff;
    }

    .xc-btn-save {
        background: var(--xc-teal);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.5rem 1.6rem;
        margin-left: 0.6rem;
        transition: all 0.25s ease;
    }

    .xc-btn-save:hover {
        background: var(--xc-teal-dark);
        transform: translateY(-1px);
        color: #fff;
    }

    .xc-input-warning {
        border-color: var(--xc-orange) !important;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.12) !important;
    }
</style>

<script>

    // x-check SweetAlert2 theme defaults, reused for every popup below
    const xcSwal = Swal.mixin({
        confirmButtonColor: '#0fb4a0',
        cancelButtonColor: '#f97316',
        customClass: {
            popup: 'xc-swal-popup'
        }
    });

    $(document).ready(function () {

        // ---- Flashdata -> SweetAlert (replaces the old Bootstrap alert divs) ----

        <?php if ($this->session->flashdata('error')) { ?>
            xcSwal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "<?= addslashes($this->session->flashdata('error')); ?>",
                confirmButtonText: 'OK'
            });
        <?php } ?>

        <?php if ($this->session->flashdata('success')) { ?>
            xcSwal.fire({
                icon: 'success',
                title: 'Success',
                text: "<?= addslashes($this->session->flashdata('success')); ?>",
                confirmButtonText: 'OK'
            });
        <?php } ?>

        $('#company_id').change(function () {

            var company_id = $(this).val();

            if (company_id == "") {

                $('#member_name').html('<option value="">Select Member</option>');

                return;

            }

            $.ajax({

                url: "<?= base_url('layout_member/get_team_members'); ?>",

                type: "POST",

                data: { company_id: company_id },

                dataType: "json",

                success: function (res) {

                    $('#member_name').html('<option value="">Select Member</option>');

                    $.each(res, function (i, row) {

                        $('#member_name').append(

                            '<option ' +
                            'value="' + row.name + '" ' +
                            'data-id="' + row.id + '" ' +
                            'data-email="' + row.email + '" ' +
                            'data-phone="' + row.mobile + '" ' +
                            'data-address="' + row.address + '" ' +
                            'data-location="' + row.city + '">' +
                            row.name +
                            '</option>'

                        );

                    });

                }

            });

            // re-run the duplicate-role check if a role is already picked
            checkRoleExists();

        });


        $('#member_name').change(function () {

            var selected = $(this).find(':selected');

            $('#email').val(selected.data('email'));

            $('#team_member_id').val(selected.data('id'));
            $('#phone').val(selected.data('phone'));

            $('#address').val(selected.data('address'));

            $('#location').val(selected.data('location'));

        });

        // ---- Role-already-exists check ----

        $('#role').change(function () {
            checkRoleExists();
        });

        function checkRoleExists() {

            var company_id = $('#company_id').val();
            var role = $('#role').val();

            if (!company_id || !role) {
                $('#role').removeClass('xc-input-warning');
                return;
            }

            $.ajax({

                url: "<?= base_url('layout_member/check_role_exists'); ?>",

                type: "POST",

                data: { company_id: company_id, role: role },

                dataType: "json",

                success: function (res) {

                    if (res.exists) {

                        $('#role').addClass('xc-input-warning');

                        xcSwal.fire({
                            icon: 'warning',
                            title: 'Role Already Exists',
                            text: 'A member with the role "' + role + '" already exists for this company. Please choose a different role or edit the existing member.',
                            confirmButtonText: 'OK'
                        });

                    } else {

                        $('#role').removeClass('xc-input-warning');

                    }

                }

            });

        }

        // ---- Final guard on submit, in case checkRoleExists hasn't resolved yet ----

        $('#memberForm').on('submit', function (e) {

            var company_id = $('#company_id').val();
            var role = $('#role').val();

            if (!company_id || !role) {
                return true; // let native "required" validation handle it
            }

            e.preventDefault();

            var form = this;

            $.ajax({

                url: "<?= base_url('layout_member/check_role_exists'); ?>",

                type: "POST",

                data: { company_id: company_id, role: role },

                dataType: "json",

                success: function (res) {

                    if (res.exists) {

                        xcSwal.fire({
                            icon: 'warning',
                            title: 'Role Already Exists',
                            text: 'A member with the role "' + role + '" already exists for this company.',
                            confirmButtonText: 'OK'
                        });

                    } else {

                        form.submit();

                    }

                }

            });

        });

    });

</script>
