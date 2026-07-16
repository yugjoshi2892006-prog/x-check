<div class="page-wrapper">
    <div class="page-content">

        <!-- Page title -->
        <div class="row">
            <div class="col-12">
                <div class="xc-page-title d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Edit Layout Member</h4>
                    <ol class="xc-breadcrumb">
                        <li><a href="<?= base_url('layout_member'); ?>">Layout</a></li>
                        <li class="active">Edit Member</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xxl-9 col-lg-10">

                <div class="card xc-card radius-10">

                    <div class="card-header xc-card-header">
                        <h4 class="mb-0">
                            <i class="bx bx-edit"></i>
                            Edit Layout Member
                        </h4>
                    </div>

                    <div class="card-body">

                        <form action="<?= base_url('layout_member/update/' . $member->id); ?>" method="post">

                            <!-- Section: Company & Member -->
                            <div class="xc-section-title">
                                <i class="bx bx-building-house"></i> Company &amp; Member
                            </div>

                            <div class="row mb-2">

                                <!-- Company -->
                                <div class="col-md-6 mb-3">

                                    <label class="xc-label">Company</label>

                                    <select class="form-select xc-input" name="company_id" id="company_id">

                                        <?php foreach ($companies as $company) { ?>

                                            <option value="<?= $company->id; ?>"
                                                <?= ($company->id == $member->company_id) ? 'selected' : ''; ?>>

                                                <?= $company->company_name; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <!-- Member -->
                                <div class="col-md-6 mb-3">

                                    <label class="xc-label">Member</label>

                                    <select class="form-select xc-input" name="member_name" id="member_name">

                                        <?php foreach ($team_members as $row) { ?>

                                            <option value="<?= $row->name; ?>" data-id="<?= $row->id; ?>"
                                                data-email="<?= $row->email; ?>"
                                                data-phone="<?= $row->mobile; ?>" data-address="<?= $row->address; ?>"
                                                data-location="<?= $row->city; ?>"
                                                <?= ($row->name == $member->member_name) ? 'selected' : ''; ?>>

                                                <?= $row->name; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                    <input type="hidden" name="team_member_id" id="team_member_id"
                                        value="<?= $member->team_member_id; ?>">

                                </div>

                                <!-- Role -->
                                <div class="col-md-6 mb-3">

                                    <label class="xc-label">Role</label>

                                    <select class="form-select xc-input" name="role">

                                        <?php

                                        $roles = array(
                                            'PMC',
                                            'Architect',
                                            'Structure Consultant',
                                            'Interior Designer',
                                            'Electrical Consultant',
                                            'PHE Consultant',
                                            'HVAC Consultant',
                                            'Landscape Consultant',
                                            'Liasoning'
                                        );

                                        foreach ($roles as $role) {
                                            ?>

                                            <option value="<?= $role; ?>" <?= ($member->role == $role) ? 'selected' : ''; ?>>

                                                <?= $role; ?>

                                            </option>

                                        <?php } ?>

                                    </select>

                                </div>

                                <!-- Status -->
                                <div class="col-md-6 mb-3">

                                    <label class="xc-label">Status</label>

                                    <div class="xc-switch-wrap">
                                        <label class="xc-switch">
                                            <input type="checkbox" id="statusSwitch"
                                                <?= ($member->status == 1) ? 'checked' : ''; ?>>
                                            <span class="xc-switch-slider"></span>
                                        </label>
                                        <span class="xc-switch-text" id="statusSwitchLabel">
                                            <?= ($member->status == 1) ? 'Active' : 'Inactive'; ?>
                                        </span>
                                    </div>

                                    <input type="hidden" name="status" id="status"
                                        value="<?= ($member->status == 1) ? '1' : '0'; ?>">

                                </div>

                            </div>

                            <!-- Section: Contact Details -->
                            <div class="xc-section-title">
                                <i class="bx bx-id-card"></i> Contact Details
                            </div>

                            <div class="row mb-2">

                                <!-- Location -->
                                <div class="col-md-4 mb-3">

                                    <label class="xc-label">Location</label>

                                    <div class="xc-icon-input">
                                        <i class="bx bx-map"></i>
                                        <input type="text" class="form-control xc-input xc-input-readonly" id="location"
                                            name="location" value="<?= $member->location; ?>" readonly>
                                    </div>

                                </div>

                                <!-- Phone -->
                                <div class="col-md-4 mb-3">

                                    <label class="xc-label">Phone</label>

                                    <div class="xc-icon-input">
                                        <i class="bx bx-phone"></i>
                                        <input type="text" class="form-control xc-input xc-input-readonly" id="phone" name="phone"
                                            value="<?= $member->phone; ?>" readonly>
                                    </div>

                                </div>

                                <!-- Email -->
                                <div class="col-md-4 mb-3">

                                    <label class="xc-label">Email</label>

                                    <div class="xc-icon-input">
                                        <i class="bx bx-envelope"></i>
                                        <input type="email" class="form-control xc-input xc-input-readonly" id="email" name="email"
                                            value="<?= $member->email; ?>" readonly>
                                    </div>

                                </div>

                                <!-- Address -->
                                <div class="col-md-12 mb-3">

                                    <label class="xc-label">Address</label>

                                    <textarea class="form-control xc-input xc-input-readonly" rows="3" id="address"
                                        name="address" readonly><?= $member->address; ?></textarea>

                                </div>

                            </div>

                            <hr class="xc-hr">

                            <div class="text-end">

                                <a href="<?= base_url('layout_member'); ?>" class="btn xc-btn-cancel">

                                    Cancel

                                </a>

                                <button class="btn xc-btn-update">

                                    <i class="bx bx-save"></i>

                                    Update Member

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>jjjjjjjjjjjjjjjjjjjjjjjjjjj

    <style>
        :root {
            --xc-teal: #0fb4a0;
            --xc-teal-dark: #0a8a7a;
            --xc-navy: #1a1a2e;
            --xc-purple: #7c3aed;
            --xc-orange: #f97316;

            --xc-bg: #f8fafc;
            --xc-card-bg: #fff;
            --xc-card-border: #e9edf1;
            --xc-text: var(--xc-navy);
            --xc-text-muted: #64748b;
            --xc-input-border: #e2e8f0;
            --xc-input-bg: #fff;
            --xc-input-readonly-bg: #f8fafc;
            --xc-hr-color: rgba(26, 26, 46, 0.15);
        }

        [data-bs-theme="dark"] {
            --xc-bg: #12131a;
            --xc-card-bg: #1a1c26;
            --xc-card-border: #2a2d3a;
            --xc-text: #e8e9ee;
            --xc-text-muted: #9497a6;
            --xc-input-border: #33364a;
            --xc-input-bg: #22242f;
            --xc-input-readonly-bg: #1e202b;
            --xc-hr-color: rgba(255, 255, 255, 0.1);
        }

        .xc-page-title {
            margin-bottom: 1rem;
        }

        .xc-page-title h4 {
            color: var(--xc-text);
            font-weight: 700;
        }

        .xc-breadcrumb {
            list-style: none;
            display: flex;
            gap: 6px;
            margin: 0;
            padding: 0;
            font-size: 0.85rem;
            color: var(--xc-text-muted);
        }

        .xc-breadcrumb li:not(:last-child)::after {
            content: "/";
            margin-left: 6px;
            color: var(--xc-text-muted);
        }

        .xc-breadcrumb a {
            color: var(--xc-teal);
            text-decoration: none;
        }

        .xc-breadcrumb .active {
            color: var(--xc-text);
        }

        .xc-card {
            background: var(--xc-card-bg);
            border: 1px solid var(--xc-card-border);
            box-shadow: 0 1px 3px rgba(26, 26, 46, 0.05);
            overflow: hidden;
        }

        .xc-card-header {
            background: transparent;
            color: var(--xc-text);
            border-bottom: 1px solid var(--xc-card-border);
            padding: 1.1rem 1.4rem;
        }

        .xc-card-header h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--xc-text);
        }

        .xc-card-header h4 i {
            color: #f59e0b;
        }

        .xc-section-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--xc-teal-dark);
            display: flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1px dashed var(--xc-hr-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .xc-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--xc-text);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.4rem;
        }

        .xc-input {
            border: 1.5px solid var(--xc-input-border);
            border-radius: 8px;
            font-size: 0.92rem;
            transition: all 0.25s ease;
            background: var(--xc-input-bg);
            color: var(--xc-text);
        }

        .xc-input:focus {
            border-color: var(--xc-teal);
            box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.12);
        }

        .xc-input-readonly {
            background: var(--xc-input-readonly-bg);
            color: var(--xc-text-muted);
            cursor: not-allowed;
        }

        /* Icon-prefixed read-only inputs */
        .xc-icon-input {
            position: relative;
        }

        .xc-icon-input i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--xc-text-muted);
            font-size: 1rem;
            pointer-events: none;
        }

        .xc-icon-input .form-control {
            padding-left: 2.2rem;
        }

        /* Custom switch */
        .xc-switch-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            height: 38px;
        }

        .xc-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .xc-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .xc-switch-slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background-color: var(--xc-input-border);
            border-radius: 24px;
            transition: 0.25s ease;
        }

        .xc-switch-slider::before {
            content: "";
            position: absolute;
            height: 18px;
            width: 18px;
            left: 3px;
            top: 3px;
            background-color: #fff;
            border-radius: 50%;
            transition: 0.25s ease;
        }

        .xc-switch input:checked + .xc-switch-slider {
            background-color: var(--xc-teal);
        }

        .xc-switch input:checked + .xc-switch-slider::before {
            transform: translateX(20px);
        }

        .xc-switch-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--xc-text);
        }

        .xc-hr {
            border-top: 1px dashed var(--xc-hr-color);
            margin: 1.5rem 0;
        }

        .xc-btn-cancel {
            background: transparent;
            border: 1.5px solid var(--xc-input-border);
            color: var(--xc-text-muted);
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.4rem;
            transition: all 0.25s ease;
        }

        .xc-btn-cancel:hover {
            background: var(--xc-input-readonly-bg);
            color: var(--xc-text);
        }

        .xc-btn-update {
            background: var(--xc-teal);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.5rem 1.6rem;
            margin-left: 0.6rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.25s ease;
        }

        .xc-btn-update:hover {
            background: var(--xc-teal-dark);
            color: #fff;
            transform: translateY(-1px);
        }
    </style>

    <script>

        $('#company_id').change(function () {

            var company_id = $(this).val();

            $.ajax({

                url: "<?= base_url('layout_member/get_team_members'); ?>",

                type: "POST",

                data: { company_id: company_id },

                dataType: "json",

                success: function (res) {

                    $('#member_name').html('');

                    $.each(res, function (i, row) {

                        $('#member_name').append(

                            '<option value="' + row.name + '" ' +
                            'data-id="' + row.id + '" ' +
                            'data-email="' + row.email + '" ' +
                            'data-phone="' + row.mobile + '" ' +
                            'data-address="' + row.address + '" ' +
                            'data-location="' + row.city + '">' +
                            row.name +
                            '</option>'

                        );

                    });

                    $('#member_name').trigger('change');

                }

            });

        });

        $('#member_name').change(function () {

            var x = $(this).find(':selected');

            $('#email').val(x.data('email'));

            $('#team_member_id').val(x.data('id'));

            $('#phone').val(x.data('phone'));

            $('#location').val(x.data('location'));

            $('#address').val(x.data('address'));

        });

        // Status switch -> hidden input + label text
        $('#statusSwitch').change(function () {

            if ($(this).is(':checked')) {
                $('#status').val('1');
                $('#statusSwitchLabel').text('Active');
            } else {
                $('#status').val('0');
                $('#statusSwitchLabel').text('Inactive');
            }

        });

    </script>
