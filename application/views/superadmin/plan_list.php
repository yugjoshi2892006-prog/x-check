<style>
    .plan-manager { max-width: 1440px; margin: 0 auto; }
    .plan-manager-head { display:flex; align-items:flex-end; justify-content:space-between; gap:18px; margin-bottom:28px; }
    .plan-manager-head h1 { margin:0 0 6px; font-size:30px; color:#24344a; font-weight:700; }
    .plan-manager-head p { margin:0; color:#8491a3; }
    .plan-add-btn { display:inline-flex; gap:8px; align-items:center; padding:11px 16px; border-radius:8px; color:#fff; background:#5243df; font-weight:600; text-decoration:none; box-shadow:0 5px 12px rgba(82,67,223,.22); }
    .plan-add-btn:hover { color:#fff; background:#4336c8; }
    .plan-alert { border-radius:9px; margin-bottom:20px; }
    .plan-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(265px, 1fr)); gap:24px; align-items:start; }
    .plan-editor { --plan-color:#4385ed; background:#fff; overflow:hidden; border:1px solid #e8ebf0; border-top:5px solid var(--plan-color); border-radius:15px; box-shadow:0 4px 10px rgba(36,52,74,.08); }
    .plan-editor:nth-child(4n+2) { --plan-color:#12b982; } .plan-editor:nth-child(4n+3) { --plan-color:#8955e9; } .plan-editor:nth-child(4n+4) { --plan-color:#f6a007; }
    .plan-card-top { display:flex; align-items:center; justify-content:space-between; padding:16px 18px; border-bottom:1px solid #edf0f4; }
    .plan-kind { padding:5px 10px; border-radius:15px; font-size:10px; color:#657286; letter-spacing:.08em; font-weight:700; background:#f4f6f9; }
    .plan-state { font-size:11px; font-weight:600; padding:5px 10px; border-radius:15px; }
    .plan-state.active { color:#008c68; background:#e9fbf5; } .plan-state.inactive { color:#d14444; background:#fff0f0; }
    .plan-fields { padding:18px; } .plan-fields label { display:block; color:#8490a1; font-size:10px; letter-spacing:.05em; font-weight:700; margin:0 0 6px; text-transform:uppercase; }
    .plan-fields .form-control, .plan-fields .form-select { border:1px solid #dfe4eb; border-radius:8px; color:#344054; font-size:13px; min-height:39px; box-shadow:none; }
    .plan-fields .form-control:focus, .plan-fields .form-select:focus { border-color:var(--plan-color); box-shadow:0 0 0 3px color-mix(in srgb, var(--plan-color) 15%, transparent); }
    .plan-field { margin-bottom:14px; } .plan-row { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
    .plan-features { background:#f7f9fc; border-radius:9px; padding:12px; margin:3px 0 17px; }
    .plan-feature { display:flex; align-items:center; gap:8px; color:#536071; font-size:12px; margin:7px 0; } .plan-feature i { color:var(--plan-color); font-size:16px; }
    .plan-actions { display:flex; gap:9px; padding-top:3px; } .plan-save { flex:1; border:0; border-radius:8px; padding:10px; color:#fff; background:var(--plan-color); font-size:13px; font-weight:600; } .plan-delete { width:42px; border:1px solid #ffd7d7; border-radius:8px; background:#fff8f8; color:#e25252; }
    .plan-empty { grid-column:1/-1; text-align:center; padding:55px 20px; border:1px dashed #cfd7e2; border-radius:14px; color:#7d8999; background:#fff; } .plan-empty i { display:block; font-size:35px; margin-bottom:10px; color:#a2adba; }
    @media (max-width:767px) { .plan-manager-head { align-items:flex-start; flex-direction:column; } .plan-manager-head h1 { font-size:25px; } }
</style>

<div class="page-wrapper"><div class="page-content"><div class="plan-manager">
    <div class="plan-manager-head"><div><span class="dashboard-eyebrow"><i class='bx bxs-credit-card'></i> PLAN MANAGEMENT</span><h1>Subscription Plans</h1><p>Create, price, and control plans available to your companies.</p></div><a class="plan-add-btn" href="<?= base_url('superadmin/plan/add') ?>"><i class='bx bx-plus'></i> Add Plan</a></div>
    <?php if ($this->session->flashdata('success')): ?><div class="alert alert-success plan-alert"><?= html_escape($this->session->flashdata('success')) ?></div><?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?><div class="alert alert-danger plan-alert"><?= html_escape($this->session->flashdata('error')) ?></div><?php endif; ?>
    <div class="plan-grid">
    <?php if (empty($plans)): ?><div class="plan-empty"><i class='bx bx-credit-card'></i>No plans created yet.<br><a href="<?= base_url('superadmin/plan/add') ?>">Create your first plan</a></div><?php endif; ?>
    <?php foreach ($plans as $plan): ?>
        <form class="plan-editor" method="post" action="<?= base_url('superadmin/plan/update/' . (int) $plan->id) ?>">
            <div class="plan-card-top"><span class="plan-kind"><?= (int) $plan->duration_days ?> DAYS</span><span class="plan-state <?= $plan->status === 'Active' ? 'active' : 'inactive' ?>"><?= html_escape($plan->status) ?></span></div>
            <div class="plan-fields"><div class="plan-field"><label>Plan name</label><input class="form-control" name="plan_name" required value="<?= html_escape($plan->plan_name) ?>"></div>
                <div class="plan-row"><div class="plan-field"><label>Duration (days)</label><input class="form-control" type="number" min="1" name="duration_days" required value="<?= (int) $plan->duration_days ?>"></div><div class="plan-field"><label>Price (₹)</label><input class="form-control" type="number" min="0" step="0.01" name="amount" required value="<?= (float) $plan->amount ?>"></div></div>
                <label>Included limits</label><div class="plan-features"><div class="plan-feature"><i class='bx bx-user'></i><input class="form-control form-control-sm" type="number" min="0" name="customer_limit" value="<?= (int) $plan->customer_limit ?>"><span>Customers</span></div><div class="plan-feature"><i class='bx bx-group'></i><input class="form-control form-control-sm" type="number" min="0" name="team_limit" value="<?= (int) $plan->team_limit ?>"><span>Team</span></div><div class="plan-feature"><i class='bx bx-briefcase'></i><input class="form-control form-control-sm" type="number" min="0" name="project_limit" value="<?= (int) $plan->project_limit ?>"><span>Projects</span></div></div>
                <div class="plan-field"><label>Availability</label><select class="form-select" name="status"><option value="Active" <?= $plan->status === 'Active' ? 'selected' : '' ?>>Active — purchasable</option><option value="Inactive" <?= $plan->status === 'Inactive' ? 'selected' : '' ?>>Inactive — hidden from companies</option></select></div>
                <div class="plan-actions"><button class="plan-save" type="submit"><i class='bx bx-save'></i> Save Changes</button><a class="plan-delete d-flex align-items-center justify-content-center" onclick="return confirm('Delete this plan? Existing payment history will remain.');" href="<?= base_url('superadmin/plan/delete/' . (int) $plan->id) ?>" title="Delete plan"><i class='bx bx-trash'></i></a></div>
            </div>
        </form>
    <?php endforeach; ?></div>
</div></div></div>
