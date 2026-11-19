<?php
$records_count   = isset($total_items) ? (int)$total_items : (!empty($medicine_data) ? count($medicine_data) : 0);
$total_sum       = isset($total_amount) ? (float)$total_amount : 0;
$total_strip     = isset($total_strip_quantity) ? (float)$total_strip_quantity : 0;
$total_loose     = isset($total_loose_quantity) ? (float)$total_loose_quantity : 0;
$invoices_count  = isset($total_invoices) ? (int)$total_invoices : 0;
$medicines_count = isset($total_medicines) ? (int)$total_medicines : 0;

if (empty($total_sum) && !empty($medicine_data)) {
    foreach ($medicine_data as $row) {
        $total_sum   += (float)(isset($row['sale_total']) ? $row['sale_total'] : 0);
        $total_strip += (float)(isset($row['sale_strip_quantity']) ? $row['sale_strip_quantity'] : 0);
        $total_loose += (float)(isset($row['sale_loose_quantity']) ? $row['sale_loose_quantity'] : 0);
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
                <div class="kpi-title">Total Sales Value</div>
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
                <div class="kpi-title">Strip Quantity Sold</div>
                <div class="kpi-value" style="color: #7c3aed;"><?= number_format($total_strip) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Strips</span></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-pie-chart"></i>
            </div>
            <div>
                <div class="kpi-title">Loose Quantity Sold</div>
                <div class="kpi-value" style="color: #d97706;"><?= number_format($total_loose) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Units</span></div>
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
</div>

<!-- Medicine Sale Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-medkit text-primary"></i> Daily Sale Medicine Records
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
                    <th>Customer Name</th>
                    <th>Medicine Name</th>
                    <th style="width: 100px;">Batch</th>
                    <th style="width: 85px; text-align: center;">Expiry</th>
                    <th style="width: 80px; text-align: right;">Strip Qty</th>
                    <th style="width: 80px; text-align: right;">Loose Qty</th>
                    <th style="width: 85px; text-align: right;">Rate (₹)</th>
                    <th style="width: 85px; text-align: right;">MRP (₹)</th>
                    <th style="width: 110px; text-align: right;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($medicine_data)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($medicine_data as $key => $value): ?>
                        <?php
                        $expiry = '-';
                        if (!empty($value['sale_expire_month']) || !empty($value['sale_expire_year'])) {
                            $expiry = htmlspecialchars($value['sale_expire_month'] . '/' . $value['sale_expire_year']);
                        }
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="text-align: center;">
                                <?= !empty($value['sale_date']) && $value['sale_date'] != '0000-00-00' ? date('d-m-Y', strtotime($value['sale_date'])) : '-' ?>
                            </td>
                            <td>
                                <span style="font-family: monospace; font-weight: 600; color: #0284c7;">
                                    <?= htmlspecialchars(isset($value['sale_invoice']) ? $value['sale_invoice'] : '-') ?>
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #334155;">
                                    <?= !empty($value['customer_name']) ? htmlspecialchars($value['customer_name']) : '<span style="color: #94a3b8; font-weight: normal;">Walk-in</span>' ?>
                                </span>
                                <?php if (!empty($value['customer_contact'])): ?>
                                    <div style="font-size: 11px; color: #64748b;"><i class="fa fa-phone" style="font-size: 10px;"></i> <?= htmlspecialchars($value['customer_contact']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: #0f172a;">
                                    <?= htmlspecialchars(isset($value['medicine_name']) ? $value['medicine_name'] : 'N/A') ?>
                                </span>
                                <?php if (!empty($value['medicine_manufacturer'])): ?>
                                    <div style="font-size: 11px; color: #64748b;"><?= htmlspecialchars($value['medicine_manufacturer']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="label label-default" style="font-family: monospace; font-size: 11px;">
                                    <?= !empty($value['sale_batch']) ? htmlspecialchars($value['sale_batch']) : '-' ?>
                                </span>
                            </td>
                            <td style="text-align: center; font-size: 11px; color: #475569;"><?= $expiry ?></td>
                            <td style="text-align: right; font-weight: 600;"><?= number_format((float)(isset($value['sale_strip_quantity']) ? $value['sale_strip_quantity'] : 0)) ?></td>
                            <td style="text-align: right; color: #64748b;"><?= number_format((float)(isset($value['sale_loose_quantity']) ? $value['sale_loose_quantity'] : 0)) ?></td>
                            <td style="text-align: right;"><?= number_format((float)(isset($value['sale_rate']) ? $value['sale_rate'] : 0), 2) ?></td>
                            <td style="text-align: right; color: #64748b;"><?= number_format((float)(isset($value['sale_mrp']) ? $value['sale_mrp'] : 0), 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format((float)(isset($value['sale_total']) ? $value['sale_total'] : 0), 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 40px !important; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                            No medicine sales records found for the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($medicine_data)): ?>
                <tfoot>
                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: 700;">TOTAL:</td>
                        <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($total_strip) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($total_loose) ?></td>
                        <td colspan="2" style="text-align: right; font-weight: 700;">Total Sales:</td>
                        <td style="text-align: right; font-weight: 800; color: #16a34a; font-size: 13px;">₹ <?= number_format($total_sum, 2) ?></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>
