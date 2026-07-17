<style>
    .xc-wrapper {
        --xc-teal: #16b8b3;
        --xc-teal-dark: #0f9a95;
        --xc-teal-light: #e6f9f8;
        --xc-muted: #7c8798;
        --xc-border: #e9edf1;
        --xc-ink: #1e2733;
    }

    .xc-card {
        background: #fff;
        border: 1px solid var(--xc-border);
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(20, 40, 60, .04);
        overflow: hidden;
    }

    .xc-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--xc-border);
        flex-wrap: wrap;
    }

    .xc-title {
        margin: 0;
        font-size: 1.08rem;
        font-weight: 800;
        color: var(--xc-ink);
    }

    .xc-subtitle {
        margin: 3px 0 0;
        font-size: .82rem;
        color: var(--xc-muted);
    }

    .xc-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        padding: 7px 13px;
        font-size: .78rem;
        font-weight: 700;
        white-space: nowrap;
        text-decoration: none;
    }

    .xc-pill-teal {
        background: var(--xc-teal-light);
        color: var(--xc-teal-dark);
    }

    .xc-pill-blue {
        background: #eaf1ff;
        color: #3766e8;
    }

    .xc-pill-orange {
        background: #fff4e0;
        color: #c98a1c;
    }

    .xc-pill-green {
        background: #dcfce7;
        color: #15803d;
    }

    .xc-pill-red {
        background: #fde8e8;
        color: #c93a3a;
    }

    .xc-pill-gray {
        background: #eef1f4;
        color: #7c8798;
    }

    .xc-green {
        background: #dcfce7;
        color: #15803d;
    }

    .xc-red {
        background: #fde8e8;
        color: #c93a3a;
    }

    .xc-blue {
        background: #eaf1ff;
        color: #3766e8;
    }

    .xc-orange {
        background: #fff4e0;
        color: #c98a1c;
    }

    .xc-gray {
        background: #eef1f4;
        color: #7c8798;
    }

    .xc-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .xc-table th {
        background: #fafbfc;
        color: var(--xc-muted);
        text-transform: uppercase;
        font-size: .72rem;
        letter-spacing: .04em;
        padding: 13px 16px;
        border-bottom: 1px solid var(--xc-border);
        white-space: nowrap;
    }

    .xc-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--xc-border);
        color: #2b3441;
        font-size: .86rem;
        vertical-align: middle;
    }

    .xc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .xc-strong {
        color: var(--xc-ink);
        font-weight: 800;
    }

    .xc-empty {
        padding: 36px 16px;
        text-align: center;
        color: var(--xc-muted);
    }

    .xc-pdf-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        width: 42px;
        height: 42px;
        border-radius: 8px;
        background: #fde8e8;
        color: #c93a3a;
        font-size: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
</style>

<div class="page-wrapper xc-wrapper">
    <div class="page-content">
        <div class="xc-card">
            <div class="xc-card-header">
                <div>
                    <p class="xc-title">Layout Process Management</p>
                    <p class="xc-subtitle">Track and manage layout approvals across all stages</p>
                </div>
                <span class="xc-pill xc-pill-teal">
                    <i class="bx bx-list-ul"></i>
                    <?= !empty($reports) ? count($reports) : 0; ?> Reports
                </span>
                <a href="<?= base_url('layout_member/layout_process_flow'); ?>" class="xc-pill"
                    style="background:#ede9fe;color:#7c3aed;">
                    <i class="bx bx-git-branch"></i> Flow View
                </a>
            </div>

            <div class="table-responsive">
                <table class="xc-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>PDF</th>
                            <th>Plan</th>
                            <th>Customer</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Schedule</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reports)) { ?>
                            <?php $i = 1;
                            foreach ($reports as $row) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?php if (!empty($row->plan_doc)) { ?>
                                            <a href="<?= base_url('uploads/layout_process/' . $row->plan_doc); ?>" target="_blank"
                                                class="xc-pdf-link" title="View PDF">
                                                <i class="bx bxs-file-pdf"></i>
                                            </a>
                                        <?php } else { ?>
                                            &mdash;
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span class="xc-strong"><?= html_escape($row->plan_title); ?></span><br>
                                        <small>Revision <?= (int) $row->revision_no; ?></small>
                                    </td>
                                    <td><?= html_escape($row->customer_name); ?></td>
                                    <td><?= $row->start_date ? date('d-m-Y', strtotime($row->start_date)) : '-'; ?></td>
                                    <td><?= $row->end_date ? date('d-m-Y', strtotime($row->end_date)) : '-'; ?></td>
                                    <td>
                                        <?php $schedule = $this->Layout_member_model->getScheduleStatus($row); ?>
                                        <span
                                            class="xc-pill <?= $schedule->class; ?>"><?= html_escape($schedule->label); ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $status_class = $row->status === 'Approved' ? 'xc-pill-green' : ($row->status === 'Remarked' ? 'xc-pill-orange' : 'xc-pill-blue');
                                        ?>
                                        <span class="xc-pill <?= $status_class; ?>"><?= html_escape($row->status); ?></span>
                                        <div style="margin-top:6px;display:flex;gap:4px;flex-wrap:wrap;">
                                            <span class="xc-pill <?= $row->client_status === 'Approved' ? 'xc-pill-green' : ($row->client_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>"
                                                style="font-size:.66rem;padding:4px 9px;">
                                                Client: <?= html_escape($row->client_status); ?>
                                            </span>
                                            <span class="xc-pill <?= $row->pmc_status === 'Approved' ? 'xc-pill-green' : ($row->pmc_status === 'Remarked' ? 'xc-pill-red' : 'xc-pill-gray'); ?>"
                                                style="font-size:.66rem;padding:4px 9px;">
                                                PMC: <?= html_escape($row->pmc_status); ?>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" class="xc-empty">No layout plan reports submitted yet.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
