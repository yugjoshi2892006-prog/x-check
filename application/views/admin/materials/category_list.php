<div class="page-wrapper">
    <div class="page-content">

        <div class="xc-mc-wrap">

            <div class="xc-mc-breadcrumb">
                Materials <i class='bx bx-chevron-right'></i> <span>Material Categories</span>
            </div>

            <div class="xc-mc-card">

                <div class="xc-mc-card-header">
                    <h4>
                        <span class="xc-mc-icon">
                            <i class="bx bx-category"></i>
                        </span>
                        Material Categories
                    </h4>
                </div>

                <div class="xc-mc-card-body">

                    <?php if ($this->session->flashdata('success')) { ?>

                        <div class="xc-mc-alert xc-mc-alert-success">
                            <i class="bx bx-check-circle"></i>
                            <?= $this->session->flashdata('success'); ?>
                        </div>

                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>

                        <div class="xc-mc-alert xc-mc-alert-error">
                            <i class="bx bx-error-circle"></i>
                            <?= $this->session->flashdata('error'); ?>
                        </div>

                    <?php } ?>

                    <form method="post" action="<?= base_url('materials/add_category') ?>"
                        class="xc-mc-add-form">

                        <div class="row g-2">

                            <div class="col-md-10">
                                <input type="text" class="form-control xc-mc-input" name="category_name"
                                    placeholder="Enter Category Name" required>
                            </div>

                            <div class="col-md-2">
                                <button class="btn xc-mc-btn-primary w-100">
                                    <i class="bx bx-plus"></i> Add Category
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <div class="xc-mc-card">

                <div class="xc-mc-card-header">
                    <h5>
                        <span class="xc-mc-icon">
                            <i class="bx bx-list-ul"></i>
                        </span>
                        All Categories
                    </h5>
                    <span class="xc-mc-count-pill"><?= count($categories); ?> Categories</span>
                </div>

                <div class="xc-mc-card-body">

                    <div class="xc-mc-table-wrapper">
                        <table class="table xc-mc-table">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php if (count($categories) > 0) { ?>

                                    <?php $i = 1;
                                    foreach ($categories as $row) { ?>

                                        <tr>
                                            <td data-label="#"><?= $i++ ?></td>
                                            <td data-label="Category" class="xc-mc-cat-name">
                                                <?= $row->category_name ?>
                                            </td>
                                            <td data-label="Date">
                                                <?= date('d-m-Y', strtotime($row->created_at)) ?>
                                            </td>
                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="3" style="padding:0; border:none;">
                                            <div class="xc-mc-empty">
                                                <i class='bx bx-folder-open'></i>
                                                <p>No categories added yet.</p>
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<style>
    :root {
        --xc-ink: #0f172a;
        --xc-ink-soft: #475569;
        --xc-muted: #94a3b8;
        --xc-line: #e2e8f0;
        --xc-surface: #ffffff;
        --xc-bg: #f8fafc;
        --xc-accent: #0fb4a0;
        --xc-accent-dark: #0c9786;
        --xc-accent-soft: #e6faf7;
        --xc-danger: #d64545;
        --xc-danger-soft: #fdecec;
    }

    * {
        box-sizing: border-box;
    }

    .xc-mc-wrap {
        padding: 4px;
    }

    .xc-mc-breadcrumb {
        font-size: 13px;
        color: var(--xc-muted);
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .xc-mc-breadcrumb span {
        color: var(--xc-ink);
        font-weight: 600;
    }

    /* ── Card shell ── */
    .xc-mc-card {
        background: var(--xc-surface);
        border: 1px solid var(--xc-line);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
        transition: background .2s ease, border-color .2s ease;
    }

    .xc-mc-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 22px;
        background: var(--xc-surface);
        border-bottom: 1px solid var(--xc-line);
    }

    .xc-mc-card-header h4,
    .xc-mc-card-header h5 {
        margin: 0;
        color: var(--xc-ink);
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .xc-mc-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
        flex-shrink: 0;
        font-size: 16px;
    }

    .xc-mc-count-pill {
        font-size: 12px;
        font-weight: 700;
        color: var(--xc-ink-soft);
        background: var(--xc-bg);
        border: 1px solid var(--xc-line);
        padding: 5px 12px;
        border-radius: 999px;
        white-space: nowrap;
    }

    .xc-mc-card-body {
        padding: 22px;
    }

    /* ── Alerts ── */
    .xc-mc-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 15px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 500;
        margin-bottom: 16px;
        border: 1px solid transparent;
    }

    .xc-mc-alert i {
        font-size: 17px;
        flex-shrink: 0;
    }

    .xc-mc-alert-success {
        background: var(--xc-accent-soft);
        color: var(--xc-accent-dark);
        border-color: #b7ece3;
    }

    .xc-mc-alert-error {
        background: var(--xc-danger-soft);
        color: var(--xc-danger);
        border-color: #f3c9c9;
    }

    /* ── Add form ── */
    .xc-mc-input {
        border: 1px solid var(--xc-line);
        border-radius: 8px;
        padding: 9px 13px;
        font-size: 14px;
        height: 42px;
        color: var(--xc-ink);
        background: var(--xc-surface);
        transition: border-color .15s ease, box-shadow .15s ease;
        width: 100%;
    }

    .xc-mc-input:focus {
        border-color: var(--xc-accent);
        box-shadow: 0 0 0 3px var(--xc-accent-soft);
        outline: none;
    }

    .xc-mc-btn-primary {
        background: var(--xc-accent);
        color: #fff;
        border: 1px solid var(--xc-accent);
        border-radius: 8px;
        height: 42px;
        font-weight: 600;
        font-size: 14px;
        transition: background .15s ease, border-color .15s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .xc-mc-btn-primary:hover {
        background: var(--xc-accent-dark);
        border-color: var(--xc-accent-dark);
        color: #fff;
    }

    /* ── Table ── */
    .xc-mc-table-wrapper {
        overflow-x: auto;
        border: 1px solid var(--xc-line);
        border-radius: 10px;
    }

    .xc-mc-table.table {
        --bs-table-color: initial;
        --bs-table-bg: transparent;
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        font-size: 13.5px;
    }

    .xc-mc-table.table thead tr {
        background-color: var(--xc-bg) !important;
    }

    .xc-mc-table.table thead tr th,
    .xc-mc-table.table>thead>tr>th {
        color: var(--xc-ink-soft) !important;
        -webkit-text-fill-color: var(--xc-ink-soft) !important;
        background-color: transparent !important;
        font-weight: 700;
        font-size: 11.5px;
        text-transform: uppercase;
        letter-spacing: .04em;
        padding: 12px 16px;
        border: none !important;
        border-bottom: 1px solid var(--xc-line) !important;
        white-space: nowrap;
        text-align: left;
    }

    .xc-mc-table tbody td {
        padding: 12px 16px;
        color: var(--xc-ink);
        border-bottom: 1px solid var(--xc-line);
        background: var(--xc-surface);
    }

    .xc-mc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-mc-table tbody tr:hover td {
        background: var(--xc-accent-soft);
    }

    .xc-mc-cat-name {
        font-weight: 600;
    }

    .xc-mc-empty {
        text-align: center;
        padding: 40px 20px;
        color: var(--xc-muted);
    }

    .xc-mc-empty i {
        font-size: 36px;
        color: var(--xc-line);
        display: block;
        margin-bottom: 10px;
    }

    .xc-mc-empty p {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .xc-mc-card {
            border-radius: 10px;
        }

        .xc-mc-card-header {
            padding: 14px 16px;
        }

        .xc-mc-card-header h4,
        .xc-mc-card-header h5 {
            font-size: 15px;
        }

        .xc-mc-card-body {
            padding: 16px;
        }

        .xc-mc-add-form .col-md-2 {
            margin-top: 8px;
        }
    }

    @media (max-width: 576px) {
        .xc-mc-table-wrapper {
            border: none;
        }

        .xc-mc-table thead {
            display: none;
        }

        .xc-mc-table tbody tr {
            display: block;
            margin-bottom: 12px;
            border: 1px solid var(--xc-line);
            border-radius: 10px;
            overflow: hidden;
        }

        .xc-mc-table tbody tr:hover td {
            background: var(--xc-surface);
        }

        .xc-mc-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px dashed var(--xc-line);
        }

        .xc-mc-table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--xc-muted);
            margin-right: 12px;
        }

        .xc-mc-table tbody tr td:last-child {
            border-bottom: none;
        }
    }

    /* ================================================================
       DARK MODE — scoped to html.xc-dark
       ================================================================ */
    html.xc-dark {
        --xc-ink: #f1f5f9;
        --xc-ink-soft: #cbd5e1;
        --xc-muted: #64748b;
        --xc-line: #263043;
        --xc-surface: #161b26;
        --xc-bg: #0e1219;
        --xc-accent-soft: rgba(15, 180, 160, 0.14);
        --xc-danger-soft: rgba(214, 69, 69, 0.14);
    }

    html.xc-dark .xc-mc-table.table thead tr {
        background-color: #10141d !important;
    }
</style>
