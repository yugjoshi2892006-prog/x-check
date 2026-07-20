<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .mr-page {
        padding: 24px;
        background: #f7fafc;
        min-height: 100vh
    }

    .mr-card {
        background: #fff;
        border: 1px solid #dce5ee;
        border-radius: 12px;
        margin-bottom: 20px;
        overflow: hidden
    }

    .mr-head {
        padding: 15px 20px;
        background: #0fb4a0;
        color: #fff;
        font-size: 16px;
        font-weight: 700
    }

    .mr-body {
        padding: 20px
    }

    .mr-grid {
        display: grid;
        grid-template-columns: repeat(12, minmax(0, 1fr));
        gap: 15px
    }

    .mr-field {
        grid-column: span 3
    }

    .mr-field.wide {
        grid-column: span 6
    }

    .mr-field.full {
        grid-column: 1/-1
    }

    .mr-field label {
        display: block;
        font-weight: 700;
        font-size: 12px;
        margin-bottom: 6px;
        color: #334155
    }

    .mr-field input,
    .mr-field select,
    .mr-field textarea {
        width: 100%;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 9px 10px;
        font-size: 14px
    }

    .mr-field textarea {
        min-height: 78px;
        resize: vertical
    }

    .mr-submit {
        border: 0;
        background: #0f766e;
        color: #fff;
        border-radius: 6px;
        padding: 11px 20px;
        font-weight: 700
    }

    .mr-table-wrap {
        overflow: auto
    }

    .mr-table {
        border-collapse: collapse;
        width: 100%;
        min-width: 1450px;
        font-size: 12px
    }

    .mr-table th {
        background: #dff5f1;
        color: #134e4a;
        white-space: nowrap
    }

    .mr-table th,
    .mr-table td {
        border: 1px solid #dce5ee;
        padding: 8px;
        vertical-align: top
    }

    .mr-table td {
        white-space: normal
    }

    .mr-ok {
        color: #15803d;
        font-weight: 700
    }

    .mr-no {
        color: #dc2626;
        font-weight: 700
    }

    .mr-file {
        color: #0f766e;
        font-weight: 700;
        text-decoration: none
    }

    @media(max-width:900px) {

        .mr-field,
        .mr-field.wide {
            grid-column: span 6
        }
    }

    @media(max-width:600px) {
        .mr-page {
            padding: 12px
        }

        .mr-field,
        .mr-field.wide {
            grid-column: 1/-1
        }
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        <div class="mr-page">
            <div class="mr-card">
                <div class="mr-head">Material Report — Challan, Bill &amp; Visual Information</div>
                <div class="mr-body">
                    <form action="<?= base_url('employee/save_material_report'); ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="project_id" value="<?= (int) $project_id; ?>">
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="mr-grid">
                            <div class="mr-field"><label>Cycle Number *</label><input type="number" min="1"
                                    name="cycle_no" value="<?= (int) $next_cycle_no; ?>" required></div>
                            <div class="mr-field"><label>Cycle Date *</label><input type="date" name="cycle_date"
                                    value="<?= date('Y-m-d'); ?>" required></div>
                            <div class="mr-field wide"><label>Material *</label><select name="material_id"
                                    id="material_id" required>
                                    <option value="">Select material</option><?php foreach ($materials as $m): ?>
                                        <option value="<?= (int) $m->subcategory_id; ?>"
                                            data-category="<?= (int) $m->category_id; ?>"
                                            data-material-name="<?= html_escape($m->subcategory_name); ?>">
                                            <?= html_escape($m->category_name . ' — ' . $m->subcategory_name); ?></option>
                                    <?php endforeach; ?>
                                    <option value="other">Other Material</option>
                                </select></div>
                            <div class="mr-field"><label>Material Brand / Make *</label><input id="material_brand" name="material_brand"
                                    placeholder="Select a material first" readonly required></div>
                            <div class="mr-field"><label>As Per Approved Make List</label><select id="make_list_status"
                                    name="make_list_status" required>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select></div>
                            <div class="mr-field wide"><label>Material Quality Criteria</label><input
                                    name="quality_criteria" placeholder="e.g. 53 grade / fine grain"></div>
                            <div class="mr-field wide"><label>Material Application Quality</label><input
                                    name="application_quality" placeholder="Where / how material is used"></div>
                            <div class="mr-field wide"><label>Cycle Remark</label><textarea name="cycle_remark"
                                    placeholder="Site inspection observation"></textarea></div>
                            <div class="mr-field"><label>Material Photo</label><input type="file" name="site_photo"
                                    accept=".jpg,.jpeg,.png,.webp,.pdf"></div>
                            <div class="mr-field"><label>Challan / Bill Upload</label><input type="file" name="invoice_photo"
                                    accept=".jpg,.jpeg,.png,.webp,.pdf"></div>
                            <div class="mr-field"><label>Quantity Received *</label><input type="number" step="0.01"
                                    min="0" name="invoice_quantity" required></div>
                            <div class="mr-field"><label>Quantity at Site *</label><input type="number" step="0.01"
                                    min="0" name="site_quantity" required></div>
                            <div class="mr-field"><label>Unit *</label><input name="site_unit" required
                                    placeholder="bags, kg, nos."></div>
                            <div class="mr-field"><label>Size / Specification</label><input name="site_size"></div>
                            <div class="mr-field"><label>Invoice / Challan Date</label><input type="date"
                                    name="invoice_date" value="<?= date('Y-m-d'); ?>"></div>
                            <div class="mr-field"><label>Price per Unit (₹)</label><input type="number" step="0.01"
                                    min="0" name="price"></div>
                            <div class="mr-field wide"><label>Notes</label><textarea name="remarks"
                                    placeholder="For example, different price or approval note"></textarea></div>
                        </div>
                        <p style="margin:16px 0;color:#64748b;font-size:12px">Used quantity and all cost totals are
                            calculated automatically in the report from received quantity and quantity currently at
                            site.</p>
                        <button class="mr-submit" type="submit">Save Cycle Material Report</button>
                    </form>
                </div>
            </div>
            <div class="mr-card">
                <div class="mr-head">Saved Cycle History</div>
                <div class="mr-body mr-table-wrap">
                    <table class="mr-table">
                        <thead>
                            <tr>
                                <th>Cycle</th>
                                <th>Date</th>
                                <th>Material</th>
                                <th>Brand</th>
                                <th>Received</th>
                                <th>At Site</th>
                                <th>Make List</th>
                                <th>Price</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($reports)): ?>
                                <tr>
                                    <td colspan="9">No material reports found.</td>
                                </tr><?php else:
                                foreach ($reports as $r): ?>
                                    <tr>
                                        <td><?= (int) $r->cycle_id; ?></td>
                                        <td><?= $r->report_date ? date('d-m-Y', strtotime($r->report_date)) : '—'; ?></td>
                                        <td><?= html_escape($r->subcategory_name ?: 'Other Material'); ?></td>
                                        <td><?= html_escape($r->material_brand ?: $r->other_brand); ?></td>
                                        <td><?= number_format((float) $r->invoice_quantity, 2); ?>
                                            <?= html_escape($r->invoice_unit ?: $r->site_unit); ?></td>
                                        <td><?= number_format((float) $r->site_quantity, 2); ?></td>
                                        <td class="<?= strtolower($r->make_list_status) === 'no' ? 'mr-no' : 'mr-ok'; ?>">
                                            <?= html_escape($r->make_list_status ?: '—'); ?></td>
                                        <td><?= $r->price !== null ? '₹' . number_format((float) $r->price, 2) : '—'; ?></td>
                                        <td><?= html_escape($r->cycle_remark ?: $r->site_remark); ?></td>
                                    </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function () {
        const material = document.getElementById('material_id');
        const category = document.getElementById('category_id');
        const brand = document.getElementById('material_brand');
        const approved = document.getElementById('make_list_status');
        function updateMaterialDetails() {
            const option = material.options[material.selectedIndex];
            const isOther = material.value === 'other';
            const isExisting = material.value !== '' && !isOther;
            category.value = isExisting ? (option.dataset.category || '') : '';
            brand.readOnly = !isOther;
            brand.value = isExisting ? (option.dataset.materialName || '') : '';
            brand.placeholder = isOther ? 'Enter material brand / name' : 'Select a material first';
            approved.value = isOther ? 'No' : 'Yes';
            approved.disabled = !isOther;
        }
        material.addEventListener('change', updateMaterialDetails);
        updateMaterialDetails();
    }());
</script>
