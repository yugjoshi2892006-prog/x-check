<div class="page-wrapper">
    <div class="page-content">

        <div class="card xc-card radius-10">

            <div class="card-header xc-card-header d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    <i class="bx bx-user"></i>
                    Layout Member List
                </h4>

                <a href="<?= base_url('index.php/layout_member/add'); ?>" class="btn xc-btn-add">

                    <i class="bx bx-plus"></i>
                    Add Layout Member

                </a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover xc-table" id="memberTable">

                        <thead class="xc-thead">

                            <tr>

                                <th>#</th>

                                <th>Company</th>

                                <th>Member</th>

                                <th>Role</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Location</th>

                                <th>Status</th>

                                <th width="120">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php
                            $i = 1;
                            foreach ($members as $row) {
                                ?>

                                <tr>

                                    <td>
                                        <?= $i++; ?>
                                    </td>

                                    <td>
                                        <?= $row->company_name; ?>
                                    </td>

                                    <td>
                                        <?= $row->member_name; ?>
                                    </td>

                                    <td>
                                        <?= $row->role; ?>
                                    </td>

                                    <td>
                                        <?= $row->email; ?>
                                    </td>

                                    <td>
                                        <?= $row->phone; ?>
                                    </td>

                                    <td>
                                        <?= $row->location; ?>
                                    </td>

                                    <td>

                                        <?php if ($row->status == 1) { ?>

                                            <span class="badge xc-badge-active">

                                                Active

                                            </span>

                                        <?php } else { ?>

                                            <span class="badge xc-badge-inactive">

                                                Inactive

                                            </span>

                                        <?php } ?>

                                    </td>

                                    <td>

                                        <a href="<?= base_url('index.php/layout_member/edit/' . $row->id); ?>"
                                            class="btn xc-btn-edit btn-sm">

                                            Edit

                                        </a>

                                        <a href="<?= base_url('index.php/layout_member/delete/' . $row->id); ?>"
                                            onclick="return confirm('Delete this member?')"
                                            class="btn xc-btn-delete btn-sm">

                                            Delete

                                        </a>

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
        backdrop-filter: none;
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

    .xc-card-header h4 {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--xc-navy);
    }

    .xc-card-header h4 i {
        color: var(--xc-teal);
    }

    .xc-btn-add {
        background: var(--xc-teal);
        color: #fff;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        padding: 0.55rem 1.25rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s ease;
    }

    .xc-btn-add:hover {
        background: var(--xc-teal-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* Solid teal table header, matching the reference dashboard.
       Bootstrap 5.3 paints each <th>'s own background via a CSS variable,
       so the color must be forced on the cells themselves, not just the
       parent thead/tr — binding only the parent leaves white-on-white text. */
    .xc-table thead.xc-thead,
    .xc-table thead.xc-thead tr,
    .xc-table thead.xc-thead th {
        background: linear-gradient(90deg, #0d9488 0%, var(--xc-teal) 100%) !important;
        --bs-table-bg: transparent !important;
        --bs-table-color: #ffffff !important;
    }

    .xc-table thead.xc-thead th {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-color: rgba(255, 255, 255, 0.15) !important;
        vertical-align: middle;
        padding: 0.9rem 0.85rem;
    }

    .xc-table tbody tr:nth-child(even) {
        background: #f7fafa;
    }

    .xc-table tbody tr:hover {
        background: rgba(15, 180, 160, 0.08);
    }

    .xc-table td {
        vertical-align: middle;
        font-size: 0.88rem;
        color: var(--xc-navy);
        padding: 0.8rem 0.85rem;
    }

    .xc-badge-active {
        background: #dcfce7;
        color: #15803d;
        font-weight: 600;
        font-size: 0.78rem;
        padding: 0.35em 0.9em;
        border-radius: 20px;
    }

    .xc-badge-inactive {
        background: #fee2e2;
        color: #b91c1c;
        font-weight: 600;
        font-size: 0.78rem;
        padding: 0.35em 0.9em;
        border-radius: 20px;
    }

    .xc-btn-edit {
        background: #fbbf24;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 6px;
        padding: 0.35rem 0.9rem;
        transition: all 0.2s ease;
    }

    .xc-btn-edit:hover {
        background: #f59e0b;
        color: #fff;
    }

    .xc-btn-delete {
        background: #f87171;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 6px;
        padding: 0.35rem 0.9rem;
        margin-left: 6px;
        transition: all 0.2s ease;
    }

    .xc-btn-delete:hover {
        background: #ef4444;
        color: #fff;
    }

    /* ---- DataTables pagination, restyled for x-check ---- */

    #memberTable_wrapper {
        padding-top: 0.25rem;
    }

    /* hide default length/search bar since design doesn't call for it;
       remove this block if you want the search box back */
    #memberTable_filter,
    #memberTable_length {
        display: none;
    }

    #memberTable_info {
        color: #6b7280;
        font-size: 0.82rem;
        padding-top: 1rem;
    }

    #memberTable_paginate {
        display: flex;
        justify-content: flex-end;
        padding-top: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #e9edf1 !important;
        background: #fff !important;
        color: var(--xc-navy) !important;
        border-radius: 6px !important;
        margin-left: 4px;
        padding: 0.4rem 0.75rem !important;
        font-size: 0.82rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(15, 180, 160, 0.1) !important;
        border-color: var(--xc-teal) !important;
        color: var(--xc-teal-dark) !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: linear-gradient(90deg, #0d9488 0%, var(--xc-teal) 100%) !important;
        border-color: var(--xc-teal) !important;
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: #f7fafa !important;
        color: #b7bec7 !important;
        border-color: #e9edf1 !important;
        cursor: not-allowed;
    }

    /* =========================================================
       DARK MODE — [data-bs-theme="dark"] scoped overrides
       Header stays teal-gradient in both modes for brand
       consistency; everything else flips to the navy surface
       scale used across the rest of the dashboard.
       ========================================================= */

    [data-bs-theme="dark"] .xc-card {
        background: #16213a;
        border-color: rgba(255, 255, 255, 0.08);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.35);
    }

    [data-bs-theme="dark"] .xc-card-header {
        border-bottom-color: rgba(255, 255, 255, 0.08);
    }

    [data-bs-theme="dark"] .xc-card-header h4 {
        color: #f1f5f9;
    }

    [data-bs-theme="dark"] .xc-table {
        --bs-table-bg: transparent !important;
        --bs-table-color: #e2e8f0 !important;
        --bs-table-border-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .xc-table td {
        color: #e2e8f0;
        border-color: rgba(255, 255, 255, 0.08) !important;
    }

    [data-bs-theme="dark"] .xc-table tbody tr {
        background: transparent !important;
    }

    [data-bs-theme="dark"] .xc-table tbody tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.03) !important;
    }

    [data-bs-theme="dark"] .xc-table tbody tr:hover {
        background: rgba(15, 180, 160, 0.14) !important;
    }

    /* thead: keep the teal gradient, just soften the border for the dark surface */
    [data-bs-theme="dark"] .xc-table thead.xc-thead th {
        border-color: rgba(255, 255, 255, 0.12) !important;
    }

    [data-bs-theme="dark"] .xc-badge-active {
        background: rgba(34, 197, 94, 0.16);
        color: #4ade80;
    }

    [data-bs-theme="dark"] .xc-badge-inactive {
        background: rgba(239, 68, 68, 0.16);
        color: #f87171;
    }

    [data-bs-theme="dark"] #memberTable_info {
        color: #94a3b8;
    }

    [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button {
        background: #16213a !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        color: #e2e8f0 !important;
    }

    [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: rgba(15, 180, 160, 0.16) !important;
        border-color: var(--xc-teal) !important;
        color: #5eead4 !important;
    }

    [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    [data-bs-theme="dark"] .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: #16213a !important;
        color: #475569 !important;
        border-color: rgba(255, 255, 255, 0.06) !important;
    }
</style>

<script>

    $(document).ready(function () {

        $('#memberTable').DataTable({
            pageLength: 10,       // pagination of 10 rows per page
            lengthChange: false,  // lock the page size at 10 (remove this line to let users change it)
            searching: false,     // remove/set true if you want the search box back
            info: true,
            language: {
                paginate: {
                    previous: '‹',
                    next: '›'
                }
            }
        });

    });

</script>