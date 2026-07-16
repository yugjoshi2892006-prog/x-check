<div class="page-wrapper">
    <div class="page-content">


        <div class="xc-page-header">
            <h3 class="xc-page-title"><i class="bx bx-receipt me-2"></i>Payment History</h3>
            <p class="xc-page-subtitle">All your past transactions and subscription payments</p>
        </div>

        <div class="xc-card xc-table-card">

            <div class="xc-table-wrapper">
                <table class="table xc-table">

                    <thead>

                        <tr>

                            <th>#</th>
                            <th>Date</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>


                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        $i = 1;

                        foreach ($payments as $row) {
                            ?>

                            <tr>

                                <td data-label="#">
                                    <?= $i++ ?>
                                </td>

                                <td data-label="Date">
                                    <?= date('d M Y', strtotime($row->created_at)) ?>
                                </td>

                                <td data-label="Plan">
                                    <?= $row->plan_name ?>
                                </td>

                                <td data-label="Amount" class="xc-amount">₹
                                    <?= number_format($row->amount, 2) ?>
                                </td>

                                <!-- <td data-label="Payment ID" class="xc-mono">
                                    <?= $row->razorpay_payment_id ?>
                                </td>

                                <td data-label="Order ID" class="xc-mono">
                                    <?= $row->razorpay_order_id ?>
                                </td> -->

                                <!-- <td data-label="Action">

                                    <a href="<?= base_url('plan/invoice/' . $row->id) ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-receipt"></i> Invoice
                                    </a>

                                </td> -->

                                <td data-label="Status">

                                    <?php
                                    if ($row->payment_status == "Success") {
                                        ?>
                                        <span class="xc-badge xc-badge-success">
                                            <i class="bx bx-check-circle"></i> Success
                                        </span>
                                        <?php
                                    }
                                    ?>

                                </td>

                            </tr>

                            <?php
                        }
                        ?>

                    </tbody>

                </table>
            </div>



        </div>
    </div>
</div>

<style>
    .xc-page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 30px 20px;
    }

    .xc-page-header {
        margin-bottom: 20px;
    }

    .xc-page-title {
        color: #1a1a2e;
        font-weight: 700;
        font-size: 24px;
        margin: 0 0 4px;
        display: flex;
        align-items: center;
    }

    .xc-page-title i {
        color: #0fb4a0;
        font-size: 24px;
    }

    .xc-page-subtitle {
        color: #8a8f98;
        font-size: 14px;
        margin: 0;
    }

    .xc-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(15, 180, 160, 0.15);
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(26, 26, 46, 0.08);
        padding: 22px;
    }

    .xc-table-card {
        border-top: 4px solid #1a1a2e;
    }

    .xc-table-wrapper {
        overflow-x: auto;
    }

    .xc-table.table {
        --bs-table-color: #ffffff;
        --bs-table-bg: transparent;
        --bs-table-striped-bg: rgba(15, 180, 160, 0.04);
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 0;
    }

    .xc-table.table thead,
    .xc-table.table thead tr {
        background-color: #0fb4a0 !important;
        background: linear-gradient(135deg, #0fb4a0, #0d9488) !important;
    }

    .xc-table.table thead tr th,
    .xc-table.table>thead>tr>th {
        color: #ffffff !important;
        -webkit-text-fill-color: #ffffff !important;
        background-color: transparent !important;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.3px;
        padding: 13px 14px;
        border: none !important;
        white-space: nowrap;
    }

    .xc-table.table thead tr th:first-child {
        border-top-left-radius: 10px;
    }

    .xc-table.table thead tr th:last-child {
        border-top-right-radius: 10px;
    }

    .xc-table tbody td {
        padding: 12px 14px;
        font-size: 13.5px;
        color: #1a1a2e;
        border-bottom: 1px solid rgba(15, 180, 160, 0.12);
        background: #fff;
        vertical-align: middle;
    }

    .xc-table tbody tr:nth-child(even) td {
        background: rgba(15, 180, 160, 0.03);
    }

    .xc-table tbody tr:hover td {
        background: rgba(15, 180, 160, 0.07);
    }

    .xc-amount {
        font-weight: 700;
        color: #0d9488;
    }

    .xc-mono {
        font-family: 'Courier New', monospace;
        font-size: 12px;
        color: #6b7280;
    }

    .xc-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .xc-badge i {
        font-size: 14px;
    }

    .xc-badge-success {
        background: rgba(15, 180, 160, 0.12);
        color: #0d9488;
    }

    @media (max-width: 768px) {
        .xc-page-container {
            padding: 20px 14px;
        }

        .xc-card {
            padding: 16px;
            border-radius: 14px;
        }

        .xc-page-title {
            font-size: 20px;
        }
    }

    @media (max-width: 576px) {
        .xc-table thead {
            display: none;
        }

        .xc-table tbody tr {
            display: block;
            margin-bottom: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(26, 26, 46, 0.08);
            overflow: hidden;
        }

        .xc-table tbody tr:nth-child(even) td {
            background: #fff;
        }

        .xc-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(15, 180, 160, 0.1);
            text-align: right;
        }

        .xc-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #0d9488;
            margin-right: 12px;
            text-align: left;
        }

        .xc-table tbody tr td:last-child {
            border-bottom: none;
        }

        .xc-mono {
            word-break: break-all;
            text-align: right;
            max-width: 60%;
        }
    }
</style>
