<div class="page-wrapper">
    <div class="page-content">


        <div class="xc-card xc-password-card">

            <div class="xc-card-header">
                <span class="xc-header-icon"><i class="bx bx-lock-alt"></i></span>
                <div>
                    <h4 class="xc-card-title">Change Password</h4>
                    <p class="xc-card-subtitle">Update your account password securely</p>
                </div>
            </div>

            <?php if ($this->session->flashdata('success')) { ?>
                <div class="xc-alert xc-alert-success">
                    <i class="bx bx-check-circle"></i>
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="xc-alert xc-alert-error">
                    <i class="bx bx-error-circle"></i>
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>

            <form method="post" action="<?= base_url('auth/update_password') ?>">

                <div class="xc-form-group mb-3">
                    <label class="xc-label">Current Password</label>
                    <div class="xc-password-field">
                        <input type="password" name="old_password" class="form-control xc-input" required>
                        <i class="bx bx-hide xc-toggle-eye"></i>
                    </div>
                </div>

                <div class="xc-form-group mb-3">
                    <label class="xc-label">New Password</label>
                    <div class="xc-password-field">
                        <input type="password" name="new_password" class="form-control xc-input" required>
                        <i class="bx bx-hide xc-toggle-eye"></i>
                    </div>
                </div>

                <div class="xc-form-group mb-4">
                    <label class="xc-label">Confirm Password</label>
                    <div class="xc-password-field">
                        <input type="password" name="confirm_password" class="form-control xc-input" required>
                        <i class="bx bx-hide xc-toggle-eye"></i>
                    </div>
                </div>

                <button type="submit" class="btn xc-btn-primary w-100">
                    <i class="bx bx-lock-alt me-1"></i> Update Password
                </button>

            </form>

        </div>

    </div>
</div>


<style>
    .xc-page-container {
        max-width: 480px;
        margin: 0 auto;
        padding: 50px 20px;
    }

    .xc-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(15, 180, 160, 0.15);
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(26, 26, 46, 0.08);
        padding: 30px;
    }

    .xc-password-card {
        border-top: 4px solid #0fb4a0;
    }

    .xc-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 22px;
    }

    .xc-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(15, 180, 160, 0.12);
        color: #0c9786;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 0 0 5px rgba(15, 180, 160, 0.06);
    }

    .xc-header-icon i {
        font-size: 22px;
    }

    .xc-card-title {
        color: #1a1a2e;
        font-weight: 700;
        font-size: 19px;
        margin: 0 0 2px;
    }

    .xc-card-subtitle {
        color: #8a8f98;
        font-size: 13px;
        margin: 0;
    }

    .xc-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 18px;
    }

    .xc-alert i {
        font-size: 18px;
        flex-shrink: 0;
    }

    .xc-alert-success {
        background: rgba(15, 180, 160, 0.1);
        color: #0d9488;
        border: 1px solid rgba(15, 180, 160, 0.25);
    }

    .xc-alert-error {
        background: rgba(239, 68, 68, 0.08);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .xc-label {
        display: block;
        font-weight: 600;
        font-size: 13px;
        color: #1a1a2e;
        margin-bottom: 6px;
        letter-spacing: 0.3px;
    }

    .xc-password-field {
        position: relative;
    }

    .xc-input {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 42px 10px 14px;
        font-size: 14px;
        height: 44px;
        width: 100%;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
        background: #ffffff;
    }

    .xc-input:focus {
        border-color: #0fb4a0;
        box-shadow: 0 0 0 4px rgba(15, 180, 160, 0.12);
        outline: none;
    }

    .xc-toggle-eye {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa0ac;
        font-size: 18px;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .xc-toggle-eye:hover {
        color: #0fb4a0;
    }

    .xc-btn-primary {
        background: linear-gradient(135deg, #0fb4a0, #0d9488);
        color: #fff;
        border: none;
        border-radius: 10px;
        height: 46px;
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

    @media (max-width: 480px) {
        .xc-page-container {
            padding: 30px 14px;
        }

        .xc-card {
            padding: 22px;
            border-radius: 14px;
        }

        .xc-card-header {
            gap: 10px;
        }

        .xc-header-icon {
            width: 40px;
            height: 40px;
        }

        .xc-card-title {
            font-size: 17px;
        }
    }
</style>

<script>
    document.querySelectorAll('.xc-toggle-eye').forEach(function (icon) {
        icon.addEventListener('click', function () {
            var input = icon.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                input.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }
        });
    });
</script>