<?php
$records_count   = isset($total_items) ? (int)$total_items : (!empty($medicine_data) ? count($medicine_data) : 0);
$total_sum       = isset($total_amount) ? (float)$total_amount : 0;
$total_qty       = isset($total_quantity) ? (int)$total_quantity : 0;
$invoices_count  = isset($total_invoices) ? (int)$total_invoices : 0;
$medicines_count = isset($total_medicines) ? (int)$total_medicines : 0;
$total_free      = 0;

if (empty($total_sum) && !empty($medicine_data)) {
    foreach ($medicine_data as $row) {
        $total_sum  += (float)(isset($row['purchase_total']) ? $row['purchase_total'] : 0);
        $total_qty  += (int)(isset($row['purchase_quantity']) ? $row['purchase_quantity'] : 0);
        $total_free += (int)(isset($row['purchase_free_quantity']) ? $row['purchase_free_quantity'] : 0);
    }
} else if (!empty($medicine_data)) {
    foreach ($medicine_data as $row) {
        $total_free += (int)(isset($row['purchase_free_quantity']) ? $row['purchase_free_quantity'] : 0);
    }
}
?>

<!-- KPI Summary Cards Row -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #dcfce7; color: #16a34a;">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <div class="kpi-title">Total Purchase Value</div>
                <div class="kpi-value" style="color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #f3e8ff; color: #7c3aed;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title">Total Quantity Purchased</div>
                <div class="kpi-value" style="color: #7c3aed;"><?= number_format($total_qty) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Units</span></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #e0f2fe; color: #0284c7;">
                <i class="fa fa-medkit"></i>
            </div>
            <div>
                <div class="kpi-title">Distinct Medicines</div>
                <div class="kpi-value" style="color: #0284c7;"><?= number_format($medicines_count > 0 ? $medicines_count : $records_count) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Items</span></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-file-text-o"></i>
            </div>
            <div>
                <div class="kpi-title">Total Invoices</div>
                <div class="kpi-value" style="color: #d97706;"><?= number_format($invoices_count > 0 ? $invoices_count : 1) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Invoices</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Purchase Medicine Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-medkit text-primary"></i> Daily Purchase Medicine Records
            <span class="label label-primary" style="font-size: 11px; margin-left: 6px;"><?= $records_count ?> Items</span>
        </h4>
        <div style="font-size: 11px; color: #64748b;">
            Period: <strong><?= !empty($start) ? htmlspecialchars($start) : 'All' ?></strong> to <strong><?= !empty($end) ? htmlspecialchars($end) : 'All' ?></strong>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">Sl.</th>
                    <th style="width: 95px; text-align: center;">Date</th>
                    <th style="width: 130px;">Invoice #</th>
                    <th>Supplier Name</th>
                    <th>Medicine Name</th>
                    <th style="width: 100px;">Batch</th>
                    <th style="width: 85px; text-align: center;">Exp Date</th>
                    <th style="width: 75px; text-align: right;">Qty</th>
                    <th style="width: 70px; text-align: right;">Free</th>
                    <th style="width: 85px; text-align: right;">Rate (₹)</th>
                    <th style="width: 85px; text-align: right;">MRP (₹)</th>
                    <th style="width: 110px; text-align: right;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($medicine_data)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($medicine_data as $key => $row): ?>
                        <?php
                        $exp_month = isset($row['purchase_expire_month']) ? $row['purchase_expire_month'] : '';
                        $exp_year  = isset($row['purchase_expire_year']) ? $row['purchase_expire_year'] : '';
                        $exp_formatted = (!empty($exp_month) || !empty($exp_year)) ? sprintf('%02d/%s', (int)$exp_month, $exp_year) : '-';
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="text-align: center; white-space: nowrap; font-size: 11px;">
                                <?= !empty($row['purchase_date']) ? date('d-m-Y', strtotime($row['purchase_date'])) : '-' ?>
                            </td>
                            <td>
                                <span class="label label-info" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px;">
                                    <?= !empty($row['purchase_invoice']) ? htmlspecialchars($row['purchase_invoice']) : '-' ?>
                                </span>
                            </td>
                            <td>
                                <strong style="color: #0f172a;"><?= !empty($row['supplier_name']) ? htmlspecialchars($row['supplier_name']) : '-' ?></strong>
                                <?php if (!empty($row['supplier_gst'])): ?>
                                    <div style="font-size: 10px; color: #64748b; font-family: monospace;">GSTIN: <?= htmlspecialchars($row['supplier_gst']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong style="color: #1e293b;"><?= !empty($row['medicine_name']) ? htmlspecialchars($row['medicine_name']) : '-' ?></strong>
                                <?php if (!empty($row['medicine_hsn'])): ?>
                                    <span class="label label-default" style="font-size: 9px; padding: 1px 4px; margin-left: 4px; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">HSN: <?= htmlspecialchars($row['medicine_hsn']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty($row['medicine_manufacturer'])): ?>
                                    <div style="font-size: 10px; color: #64748b;"><?= htmlspecialchars($row['medicine_manufacturer']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <code style="font-size: 11px; background: #f8fafc; border: 1px solid #e2e8f0; color: #475569;"><?= !empty($row['purchase_batch']) ? htmlspecialchars($row['purchase_batch']) : '-' ?></code>
                            </td>
                            <td style="text-align: center; font-size: 11px; color: #475569;">
                                <?= $exp_formatted ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #1e293b;">
                                <?= (int)(isset($row['purchase_quantity']) ? $row['purchase_quantity'] : 0) ?>
                            </td>
                            <td style="text-align: right; color: #64748b;">
                                <?= (int)(isset($row['purchase_free_quantity']) ? $row['purchase_free_quantity'] : 0) ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                ₹ <?= number_format((float)(isset($row['purchase_rate']) ? $row['purchase_rate'] : 0), 2) ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                ₹ <?= number_format((float)(isset($row['purchase_mrp']) ? $row['purchase_mrp'] : 0), 2) ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">
                                ₹ <?= number_format((float)(isset($row['purchase_total']) ? $row['purchase_total'] : 0), 2) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 45px; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; display: block; margin-bottom: 8px;"></i>
                            <div style="font-size: 14px; font-weight: 600; color: #334155;">No Purchase Medicine Records Found</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Try adjusting your date range or search filters above.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="text-align: right; font-weight: 700; text-transform: uppercase;">Total:</td>
                    <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($total_qty) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #64748b;"><?= number_format($total_free) ?></td>
                    <td colspan="2"></td>
                    <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
