<!DOCTYPE html>
<html>

<head>
    <title>Register - X-CHECK</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
        :root {
            --xc-teal: #0fb4a0;
            --xc-teal-dark: #0d9b89;
            --xc-navy: #1a1a2e;
            --xc-border: #e4e6ea;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
            background: linear-gradient(160deg, #f4fbfa 0%, #eef6f5 45%, #fdfdfd 100%);
            min-height: 100vh;
        }

        .xc-register-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .xc-register-grid {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(20, 40, 50, .12);
            background: #fff;
        }

        /* Left brand panel */
        .xc-brand-panel {
            background: linear-gradient(150deg, var(--xc-teal) 0%, #0c8f80 100%);
            color: #fff;
            padding: 48px 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .xc-brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .xc-brand-logo .mark {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(255, 255, 255, .18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 15px;
        }

        .xc-brand-copy h2 {
            font-size: 26px;
            font-weight: 700;
            line-height: 1.3;
            margin: 28px 0 14px;
        }

        .xc-brand-copy p {
            font-size: 14px;
            line-height: 1.7;
            color: rgba(255, 255, 255, .88);
            margin: 0;
        }

        .xc-brand-points {
            list-style: none;
            padding: 0;
            margin: 26px 0 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .xc-brand-points li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
            color: rgba(255, 255, 255, .92);
        }

        .xc-brand-points li::before {
            content: '✓';
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, .2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }

        .xc-brand-foot {
            font-size: 12px;
            color: rgba(255, 255, 255, .65);
            margin-top: 32px;
        }

        /* Right form panel */
        .xc-form-panel {
            padding: 44px 42px;
        }

        .xc-form-panel h4 {
            font-size: 22px;
            font-weight: 700;
            color: var(--xc-navy);
            margin: 0 0 4px;
        }

        .xc-form-sub {
            font-size: 13px;
            color: #9aa0ac;
            margin: 0 0 26px;
        }

        .xc-form-panel label {
            font-size: 12.5px;
            font-weight: 500;
            color: #444;
            margin-bottom: 6px;
            display: block;
        }

        .xc-form-panel .form-control,
        .xc-form-panel textarea.form-control {
            height: 44px;
            border: 1px solid var(--xc-border);
            border-radius: 9px;
            font-size: 13.5px;
            color: #333;
            background: #fafbfc;
            padding: 0 14px;
            box-shadow: none;
            width: 100%;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }

        .xc-form-panel textarea.form-control {
            height: auto;
            padding: 10px 14px;
            resize: vertical;
        }

        .xc-form-panel .form-control:focus {
            border-color: var(--xc-teal);
            box-shadow: 0 0 0 3px rgba(15, 180, 160, .12);
            background: #fff;
            outline: none;
        }

        .xc-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .xc-mb {
            margin-bottom: 17px;
        }

        .btn-xc-register {
            height: 46px;
            width: 100%;
            background: var(--xc-teal);
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: 14.5px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 6px;
            transition: background .15s;
        }

        .btn-xc-register:hover {
            background: var(--xc-teal-dark);
        }

        .xc-divider-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0 18px;
        }

        .xc-divider-row hr {
            flex: 1;
            margin: 0;
            border-top: 1px solid var(--xc-border);
        }

        .xc-divider-row span {
            font-size: 12px;
            color: #aab0bb;
        }

        .xc-login-text {
            text-align: center;
            font-size: 13.5px;
            color: #555;
        }

        .xc-login-text a {
            color: var(--xc-teal);
            font-weight: 600;
            text-decoration: none;
        }

        .xc-login-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 860px) {
            .xc-register-grid {
                grid-template-columns: 1fr;
            }

            .xc-brand-panel {
                display: none;
            }

            .xc-form-panel {
                padding: 36px 26px;
            }
        }

        @media (max-width: 480px) {
            .xc-row-2 {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>

    <div class="xc-register-wrap">
        <div class="xc-register-grid">

            <!-- Left brand panel -->
            <div class="xc-brand-panel">
                <div>
                    <div class="xc-brand-logo">
                        <span class="mark">XC</span>
                        X-CHECK
                    </div>

                    <div class="xc-brand-copy">
                        <h2>Smart construction site monitoring, made simple.</h2>
                        <p>Create your company account and get instant access to live project tracking, floor-by-floor
                            progress, and automated reminders.</p>
                    </div>

                    <ul class="xc-brand-points">
                        <li>Real-time photo &amp; floor monitoring</li>
                        <li>Multi-vendor project dashboards</li>
                        <li>Automated email &amp; notification reminders</li>
                    </ul>
                </div>

                <div class="xc-brand-foot">
                    &copy; <?= date('Y') ?> X-CHECK Services. All rights reserved.
                </div>
            </div>

            <!-- Right form panel -->
            <div class="xc-form-panel">

                <h4>Create your account</h4>
                <p class="xc-form-sub">Fill in your details to get started with X-CHECK.</p>

                <form method="post" action="<?= base_url('save-register') ?>">

                    <div class="xc-mb">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control" required>
                    </div>

                    <div class="xc-row-2">
                        <div class="xc-mb">
                            <label>Owner Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="xc-mb">
                            <label>Mobile Number</label>
                            <input type="text" name="phone" class="form-control" maxlength="10" required>
                        </div>
                    </div>

                    <div class="xc-mb">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="xc-mb">
                        <label>Address</label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="xc-row-2">
                        <div class="xc-mb">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="xc-mb">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-xc-register">
                        Create Account
                    </button>

                </form>

                <div class="xc-divider-row">
                    <hr><span>OR</span>
                    <hr>
                </div>

                <div class="xc-login-text">
                    Already have an account?
                    <a href="<?= base_url('auth') ?>">Login here</a>
                </div>

            </div>

        </div>
    </div>

</body>

</html>
