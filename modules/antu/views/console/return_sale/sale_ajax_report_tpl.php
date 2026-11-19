<?php
$records_count   = isset($total_items) ? (int)$total_items : (!empty($return_sale_data) ? count($return_sale_data) : 0);
$total_sum       = isset($total_return_amount) ? (float)$total_return_amount : 0;
$total_qty       = isset($total_quantity) ? (int)$total_quantity : 0;
$customers_count = isset($total_customers) ? (int)$total_customers : 0;
$invoices_count  = isset($total_invoices) ? (int)$total_invoices : 0;
$entries_count   = isset($total_entries) ? (int)$total_entries : 0;

if (empty($total_sum) && !empty($return_sale_data)) {
    foreach ($return_sale_data as $row) {
        $total_sum += (float)(isset($row['return_sale_total']) ? $row['return_sale_total'] : 0);
        $total_qty += (int)(isset($row['return_sale_strip']) ? $row['return_sale_strip'] : 0);
    }
}
?>

<!-- KPI Summary Cards Row -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fee2e2; color: #dc2626;">
                <i class="fa fa-reply"></i>
            </div>
            <div>
                <div class="kpi-title">Total Sale Return</div>
                <div class="kpi-value" style="color: #dc2626;">₹ <?= number_format($total_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #e0f2fe; color: #0284c7;">
                <i class="fa fa-medkit"></i>
            </div>
            <div>
                <div class="kpi-title">Total Items Returned</div>
                <div class="kpi-value" style="color: #0284c7;"><?= number_format($records_count) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Items</span></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #f3e8ff; color: #7c3aed;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title">Total Quantity (Strips)</div>
                <div class="kpi-value" style="color: #7c3aed;"><?= number_format($total_qty) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Strips</span></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #dcfce7; color: #16a34a;">
                <i class="fa fa-users"></i>
            </div>
            <div>
                <div class="kpi-title">Customers Involved</div>
                <div class="kpi-value" style="color: #16a34a;"><?= number_format($customers_count > 0 ? $customers_count : 1) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Customers</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Sale Return Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-reply-all text-danger"></i> Sale Return Records
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
                    <th style="width: 105px; text-align: center;">Return Entry #</th>
                    <th style="width: 120px;">Sale Invoice #</th>
                    <th>Customer Name</th>
                    <th>Medicine Name</th>
                    <th style="width: 100px;">Batch</th>
                    <th style="width: 85px; text-align: center;">Exp Date</th>
                    <th style="width: 80px; text-align: right;">Qty</th>
                    <th style="width: 85px; text-align: right;">MRP (₹)</th>
                    <th style="width: 120px;">Reference</th>
                    <th style="width: 110px; text-align: right;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($return_sale_data)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($return_sale_data as $key => $row): ?>
                        <?php
                        $exp_month = isset($row['return_sale_expire_month']) ? $row['return_sale_expire_month'] : '';
                        $exp_year  = isset($row['return_sale_expire_year']) ? $row['return_sale_expire_year'] : '';
                        $exp_formatted = (!empty($exp_month) || !empty($exp_year)) ? sprintf('%02d/%s', (int)$exp_month, $exp_year) : '-';
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="text-align: center; white-space: nowrap; font-size: 11px;">
                                <?= !empty($row['return_sale_date']) ? date('d-m-Y', strtotime($row['return_sale_date'])) : '-' ?>
                            </td>
                            <td style="text-align: center;">
                                <span class="label label-default" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px; background: #e2e8f0; color: #1e293b;">
                                    <?= !empty($row['return_sale_entry_number']) ? htmlspecialchars($row['return_sale_entry_number']) : '-' ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($row['return_sale_invoice'])): ?>
                                    <span class="label label-info" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px;">
                                        <?= htmlspecialchars($row['return_sale_invoice']) ?>
                                    </span>
                                <?php else: ?>
                                    <span style="color: #94a3b8;">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong style="color: #0f172a;"><?= !empty($row['customer_name']) ? htmlspecialchars($row['customer_name']) : '-' ?></strong>
                                <?php if (!empty($row['customer_contact'])): ?>
                                    <div style="font-size: 10px; color: #64748b;"><i class="fa fa-phone"></i> <?= htmlspecialchars($row['customer_contact']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong style="color: #1e293b;"><?= !empty($row['return_sale_medicine']) ? htmlspecialchars($row['return_sale_medicine']) : '-' ?></strong>
                                <?php if (!empty($row['return_sale_HSN'])): ?>
                                    <span class="label label-default" style="font-size: 9px; padding: 1px 4px; margin-left: 4px; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">HSN: <?= htmlspecialchars($row['return_sale_HSN']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <code style="font-size: 11px; background: #f8fafc; border: 1px solid #e2e8f0; color: #475569;"><?= !empty($row['return_sale_Batch']) ? htmlspecialchars($row['return_sale_Batch']) : '-' ?></code>
                            </td>
                            <td style="text-align: center; font-size: 11px; color: #475569;">
                                <?= $exp_formatted ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #1e293b;">
                                <?= (int)(isset($row['return_sale_strip']) ? $row['return_sale_strip'] : 0) ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                ₹ <?= number_format((float)(isset($row['return_sale_mrp']) ? $row['return_sale_mrp'] : 0), 2) ?>
                            </td>
                            <td style="font-size: 11px; color: #64748b;">
                                <?= !empty($row['return_sale_ref']) ? htmlspecialchars($row['return_sale_ref']) : '-' ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #dc2626;">
                                ₹ <?= number_format((float)(isset($row['return_sale_total']) ? $row['return_sale_total'] : 0), 2) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 45px; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; display: block; margin-bottom: 8px;"></i>
                            <div style="font-size: 14px; font-weight: 600; color: #334155;">No Sale Return Records Found</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Try adjusting your date range or search filters above.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" style="text-align: right; font-weight: 700; text-transform: uppercase;">Total Sale Return:</td>
                    <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($total_qty) ?></td>
                    <td colspan="2"></td>
                    <td style="text-align: right; font-weight: 700; color: #dc2626;">₹ <?= number_format($total_sum, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>