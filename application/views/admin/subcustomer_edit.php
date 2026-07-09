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

            .xc-form-card {
                background: #fff;
                border: 0.5px solid #e4e6ea;
                border-radius: 12px;
                padding: 28px 28px 24px;
            }

            .xc-section-label {
                font-size: 11px;
                font-weight: 600;
                letter-spacing: .06em;
                text-transform: uppercase;
                color: #9aa0ac;
                margin-bottom: 18px;
            }

            .xc-form-card .form-label {
                font-size: 12.5px;
                font-weight: 500;
                color: #444;
                margin-bottom: 6px;
                display: block;
            }

            .xc-form-card .form-control {
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

            .xc-form-card .form-control:focus {
                border-color: #0fb4a0;
                box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
                background: #fff;
                outline: none;
            }

            .xc-divider {
                border: none;
                border-top: 0.5px solid #f0f2f5;
                margin: 22px 0;
            }

            .xc-form-footer {
                display: flex;
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

            .req {
                color: #ef4444;
                margin-left: 2px;
            }
        </style>

        <div class="xc-wrapper">
            <div class="xc-content">

                <!-- Header -->
                <div class="xc-header">
                    <h2>Edit User</h2>
                </div>
                <div class="xc-breadcrumb">
                    <a href="<?= base_url('index.php/dashboard') ?>">Masters</a>
                    <span>›</span>
                    <a href="<?= base_url('index.php/customer') ?>">Customers</a>
                    <span>›</span>
                    <a href="<?= base_url('index.php/customer/subcustomer_list/' . $user->customer_id) ?>">Users</a>
                    <span>›</span> Edit User
                </div>

                <!-- Form card -->
                <div class="xc-form-card">

                    <div class="xc-section-label">User Information</div>

                    <form method="post" action="<?= base_url('index.php/customer/update_subcustomer/' . $user->id) ?>">

                        <input type="hidden" name="customer_id" value="<?= $user->customer_id ?>">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Name <span class="req">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="<?= htmlspecialchars($user->name) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mobile <span class="req">*</span></label>
                                <input type="text" name="mobile" class="form-control"
                                    value="<?= htmlspecialchars($user->mobile) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email <span class="req">*</span></label>
                                <input type="email" name="email" class="form-control"
                                    value="<?= htmlspecialchars($user->email) ?>" required>
                            </div>

                        </div>

                        <hr class="xc-divider">

                        <div class="xc-form-footer">
                            <button type="submit" class="btn-xc-save">Update User</button>
                            <a href="<?= base_url('index.php/customer/subcustomer_list/' . $user->customer_id) ?>"
                                class="btn-xc-cancel">Cancel</a>
                        </div>

                    </form>
                </div><!-- /.xc-form-card -->

            </div>
        </div>

    </div>
</div>