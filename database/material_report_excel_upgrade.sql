-- Material Report Excel-style upgrade (already applied to the local xcheck DB).
-- This file is retained so the same schema can be deployed to another server.
ALTER TABLE material_report_items
    ADD COLUMN material_brand VARCHAR(255) NULL AFTER subcategory_id,
    ADD COLUMN make_list_status VARCHAR(30) NULL AFTER material_brand,
    ADD COLUMN quality_criteria TEXT NULL AFTER make_list_status,
    ADD COLUMN application_quality TEXT NULL AFTER quality_criteria,
    ADD COLUMN cycle_remark TEXT NULL AFTER application_quality,
    ADD COLUMN bill_photo VARCHAR(255) NULL AFTER invoice_photo,
    ADD COLUMN consumed_cost DECIMAL(12,2) NULL AFTER price;
