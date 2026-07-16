<style>
    .xc-profile-wrapper {
        background: #f4f7f8;
        padding: 24px;
        min-height: 100%;
    }

    .xc-profile-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .xc-profile-top h3 {
        color: #1a1a2e;
        font-weight: 700;
        font-size: 22px;
        margin: 0;
    }

    .xc-edit-btn {
        height: 42px;
        padding: 0 20px;
        border: none;
        border-radius: 10px;
        background: #0fb4a0;
        color: #ffffff;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }

    .xc-edit-btn:hover {
        background: #0d9c8a;
    }

    .xc-edit-btn:active {
        transform: scale(0.97);
    }

    .xc-edit-btn i {
        font-size: 16px;
    }

    .xc-row {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
    }

    .xc-col-photo {
        flex: 0 0 320px;
        max-width: 320px;
    }

    .xc-col-details {
        flex: 1;
        min-width: 320px;
    }

    .xc-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e4e6ea;
        box-shadow: 0 2px 10px rgba(15, 180, 160, 0.06);
        overflow: hidden;
    }

    .xc-card-body {
        padding: 28px 24px;
    }

    /* Photo card */
    .xc-photo-card .xc-card-body {
        text-align: center;
    }

    .xc-avatar-frame {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        padding: 4px;
        background: linear-gradient(135deg, #0fb4a0, #0d9c8a);
    }

    .xc-avatar-frame img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        border: 3px solid #ffffff;
    }

    .xc-profile-name {
        margin-top: 18px;
        font-size: 18px;
        font-weight: 700;
        color: #1a1a2e;
    }

    .xc-profile-company {
        font-size: 13.5px;
        color: #8a929a;
        margin-top: 2px;
    }

    .xc-divider {
        border: none;
        border-top: 1px solid #e4e6ea;
        margin: 20px 0;
    }

    .xc-upload-input {
        width: 100%;
        border: 1px solid #e4e6ea;
        border-radius: 10px;
        padding: 9px 12px;
        font-size: 13px;
        color: #1a1a2e;
        background: #f8fafa;
        margin-bottom: 12px;
        outline: none;
    }

    .xc-upload-input:focus {
        border-color: #0fb4a0;
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.12);
    }

    .xc-upload-btn {
        width: 100%;
        height: 42px;
        border: none;
        border-radius: 10px;
        background: #1a1a2e;
        color: #ffffff;
        font-weight: 600;
        font-size: 13.5px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .xc-upload-btn:hover {
        background: #11111f;
    }

    /* Details card */
    .xc-detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .xc-detail-table tr {
        border-bottom: 1px solid #eef0f2;
    }

    .xc-detail-table tr:last-child {
        border-bottom: none;
    }

    .xc-detail-table th {
        text-align: left;
        padding: 14px 14px 14px 0;
        width: 30%;
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
        vertical-align: middle;
        white-space: nowrap;
    }

    .xc-detail-table td {
        padding: 10px 0;
        vertical-align: middle;
    }

    .xc-field {
        width: 100%;
        border: 1px solid transparent;
        border-radius: 8px;
        padding: 9px 12px;
        font-size: 14px;
        color: #1a1a2e;
        background: transparent;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
    }

    .xc-field[readonly] {
        background: transparent;
        cursor: default;
    }

    .xc-field:not([readonly]) {
        background: #ffffff;
        border-color: #e4e6ea;
        box-shadow: 0 0 0 3px rgba(15, 180, 160, 0.1);
    }

    .xc-field:not([readonly]):focus {
        border-color: #0fb4a0;
    }

    textarea.xc-field {
        resize: vertical;
        font-family: inherit;
    }

    .xc-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        background: rgba(46, 230, 168, 0.14);
        color: #0d9c8a;
    }

    .xc-status-pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #0d9c8a;
    }

    .xc-static-value {
        font-size: 14px;
        color: #1a1a2e;
        padding: 9px 12px;
    }

    .xc-save-row {
        text-align: right;
        margin-top: 20px;
    }

    .xc-save-btn {
        height: 44px;
        padding: 0 24px;
        border: none;
        border-radius: 10px;
        background: #0fb4a0;
        color: #ffffff;
        font-weight: 600;
        font-size: 14px;
        display: none;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        margin-left: auto;
    }

    .xc-save-btn:hover {
        background: #0d9c8a;
    }

    .xc-save-btn:active {
        transform: scale(0.97);
    }

    @media (max-width: 767px) {
        .xc-col-photo {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .xc-col-details {
            min-width: 0;
        }

        .xc-detail-table th {
            white-space: normal;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <div class="xc-profile-wrapper">

            <div class="xc-profile-top">
                <h3>My Profile</h3>

                <button type="button" id="editBtn" class="xc-edit-btn">
                    <i class="bx bx-edit"></i> Edit Profile
                </button>
            </div>

            <div class="xc-row">

                <!-- Profile Photo Card -->
                <div class="xc-col-photo">

                    <div class="xc-card xc-photo-card">
                        <div class="xc-card-body">

                            <div class="xc-avatar-frame">
                                <?php if (!empty($employee->profile_photo)) { ?>

                                    <img src="<?= base_url('uploads/profile/' . $employee->profile_photo) ?>">

                                <?php } else { ?>

                                    <img src="<?= base_url('assets/images/user.png') ?>">

                                <?php } ?>
                            </div>

                            <div class="xc-profile-name">
                                <?= $employee->name ?>
                            </div>

                            <div class="xc-profile-company">
                                <?= $employee->company_name ?>
                            </div>

                            <hr class="xc-divider">

                            <!-- Upload Photo -->
                            <form action="<?= base_url('employee/upload_profile_photo') ?>" method="post"
                                enctype="multipart/form-data">

                                <input type="file" name="profile_photo" class="xc-upload-input" required>

                                <button type="submit" class="xc-upload-btn">
                                    Upload Photo
                                </button>

                            </form>

                        </div>
                    </div>

                </div>

                <!-- Profile Details -->
                <div class="xc-col-details">

                    <div class="xc-card">
                        <div class="xc-card-body">

                            <form method="post" action="<?= base_url('employee/update_profile') ?>">

                                <table class="xc-detail-table">

                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            <input type="text" name="name" value="<?= $employee->name ?>"
                                                class="xc-field edit-field" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>
                                            <input type="email" name="email" value="<?= $employee->email ?>"
                                                class="xc-field edit-field" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Mobile</th>
                                        <td>
                                            <input type="text" name="mobile" value="<?= $employee->mobile ?>"
                                                class="xc-field edit-field" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Country</th>
                                        <td>
                                            <input type="text" name="country" value="<?= $employee->country ?>"
                                                class="xc-field edit-field" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>State</th>
                                        <td>
                                            <input type="text" name="state" value="<?= $employee->state ?>"
                                                class="xc-field edit-field" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>City</th>
                                        <td>
                                            <input type="text" name="city" value="<?= $employee->city ?>"
                                                class="xc-field edit-field" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Address</th>
                                        <td>
                                            <textarea name="address" class="xc-field edit-field" rows="3"
                                                readonly><?= $employee->address ?></textarea>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="xc-status-pill">
                                                <?= $employee->status ?>
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Company</th>
                                        <td>
                                            <div class="xc-static-value">
                                                <?= $employee->company_name ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Created On</th>
                                        <td>
                                            <div class="xc-static-value">
                                                <?= date('d M Y h:i A', strtotime($employee->created_at)) ?>
                                            </div>
                                        </td>
                                    </tr>

                                </table>

                                <div class="xc-save-row">

                                    <button type="submit" id="saveBtn" class="xc-save-btn">
                                        <i class="bx bx-save"></i>
                                        Save Changes
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#editBtn').click(function () {

            $('.edit-field').prop('readonly', false);

            $('#saveBtn').show().css('display', 'inline-flex');

            $('#editBtn').hide();

        });

    });
</script>
