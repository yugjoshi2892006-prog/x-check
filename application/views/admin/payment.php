<!DOCTYPE html>
<html>

<head>
    <title>Processing Payment...</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: radial-gradient(circle at 15% 0%, #eef6f5 0%, #f4f5f8 35%, #f4f5f8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .xc-pay-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e9ebef;
            box-shadow: 0 18px 40px -12px rgba(26, 26, 46, 0.12);
            max-width: 400px;
            width: 100%;
            padding: 44px 36px 38px;
            text-align: center;
        }

        .xc-pay-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: linear-gradient(135deg, #16c5af, #0c9786);
            margin-bottom: 22px;
            box-shadow: 0 8px 20px -6px rgba(15, 180, 160, 0.5);
        }

        .xc-pay-logo svg {
            width: 28px;
            height: 28px;
            color: #fff;
        }

        .xc-pay-spinner {
            width: 38px;
            height: 38px;
            margin: 6px auto 24px;
            border-radius: 50%;
            border: 3px solid #eef0f3;
            border-top-color: #0fb4a0;
            animation: xc-spin 0.85s linear infinite;
        }

        @keyframes xc-spin {
            to {
                transform: rotate(360deg);
            }
        }

        .xc-pay-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .xc-pay-subtitle {
            font-size: 13.5px;
            color: #8a8f98;
            line-height: 1.5;
            margin-bottom: 26px;
        }

        .xc-pay-divider {
            height: 1px;
            background: #eef0f3;
            margin-bottom: 22px;
        }

        .xc-pay-amount-row {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 4px;
            margin-bottom: 4px;
        }

        .xc-pay-amount-row .currency {
            font-size: 16px;
            font-weight: 600;
            color: #2d3436;
        }

        .xc-pay-amount-row .amount {
            font-size: 30px;
            font-weight: 800;
            color: #1a1a2e;
            letter-spacing: -0.02em;
        }

        .xc-pay-amount-label {
            font-size: 12.5px;
            color: #9aa0ac;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .xc-pay-secure {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            color: #0c9786;
            background: rgba(15, 180, 160, 0.08);
            padding: 7px 14px;
            border-radius: 999px;
            font-weight: 600;
        }

        .xc-pay-secure svg {
            width: 13px;
            height: 13px;
        }

        .xc-pay-fallback {
            margin-top: 22px;
            font-size: 12.5px;
            color: #9aa0ac;
        }

        .xc-pay-fallback a {
            color: #0c9786;
            font-weight: 600;
            text-decoration: none;
        }

        .xc-pay-fallback a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="xc-pay-card">

        <div class="xc-pay-logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                <line x1="2" y1="10" x2="22" y2="10"></line>
            </svg>
        </div>

        <div class="xc-pay-spinner"></div>

        <div class="xc-pay-title">Processing Payment</div>
        <div class="xc-pay-subtitle">
            Please wait, we're redirecting you to Razorpay's<br>secure payment window.
        </div>

        <div class="xc-pay-divider"></div>

        <div class="xc-pay-amount-label">Amount Payable</div>
        <div class="xc-pay-amount-row">
            <span class="currency">₹</span>
            <span class="amount" id="xcPayAmount">--</span>
        </div>

        <div style="margin-top:18px;">
            <span class="xc-pay-secure">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                Secured by Razorpay
            </span>
        </div>

        <div class="xc-pay-fallback">
            Window didn't open? <a href="javascript:void(0);" id="xcPayRetry">Click here to pay</a>
        </div>

    </div>

    <script>

        var options = {

            key: "<?= $key ?>",

            amount: "<?= $order['amount'] ?>",

            currency: "INR",

            name: "Construction Monitoring System",

            description: "Plan Purchase",

            image: "",

            order_id: "<?= $order['id'] ?>",

            handler: function (response) {

                window.location =
                    "<?= site_url('plan/payment_success') ?>?payment_id="
                    + response.razorpay_payment_id
                    + "&order_id=" + response.razorpay_order_id
                    + "&signature=" + response.razorpay_signature
                    + "&plan_id=<?= $plan->id ?>";

            },

            theme: {
                color: "#0fb4a0"
            }

        };

        var rzp = new Razorpay(options);

        document.getElementById('xcPayAmount').textContent =
            (Number(options.amount) / 100).toLocaleString('en-IN');

        function xcOpenCheckout() {
            rzp.open();
        }

        document.getElementById('xcPayRetry').addEventListener('click', xcOpenCheckout);

        window.onload = function () {
            xcOpenCheckout();
        };

    </script>

</body>

</html>