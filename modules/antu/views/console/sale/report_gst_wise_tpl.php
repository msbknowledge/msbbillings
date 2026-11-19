<?php
$taxable_sum = 0;
$cgst_sum = 0;
$sgst_sum = 0;
$total_sum = 0;

if (!empty($customer_data)) {
    foreach ($customer_data as $row) {
        $taxable_sum += (float)(isset($row['sale_taxable']) ? $row['sale_taxable'] : 0);
        $cgst_sum    += (float)(isset($row['sale_cgst']) ? $row['sale_cgst'] : 0);
        $sgst_sum    += (float)(isset($row['sale_sgst']) ? $row['sale_sgst'] : 0);
        $total_sum   += (float)(isset($row['sale_total']) ? $row['sale_total'] : 0);
    }
}

$total_grand_discount = 0;
if (!empty($sale_grand_dis_data) && isset($sale_grand_dis_data[0]['sale_grand_discount'])) {
    $total_grand_discount = round((float)$sale_grand_dis_data[0]['sale_grand_discount'], 2);
}
$final_grand_total = max(0, $total_sum - $total_grand_discount);
$customer_count = !empty($customer_data) ? count($customer_data) : 0;
?>

<!-- KPI Summary Cards Row -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #e0f2fe; color: #0284c7;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title">Taxable Value</div>
                <div class="kpi-value" style="color: #0284c7;">₹ <?= number_format($taxable_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-percent"></i>
            </div>
            <div>
                <div class="kpi-title">Total CGST</div>
                <div class="kpi-value" style="color: #d97706;">₹ <?= number_format($cgst_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #f3e8ff; color: #7c3aed;">
                <i class="fa fa-percent"></i>
            </div>
            <div>
                <div class="kpi-title">Total SGST</div>
                <div class="kpi-value" style="color: #7c3aed;">₹ <?= number_format($sgst_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #dcfce7; color: #16a34a;">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <div class="kpi-title">Total Sales</div>
                <div class="kpi-value" style="color: #16a34a;">₹ <?= number_format($final_grand_total, 2) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Table 1: Customer GSTIN-Wise Summary -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-users text-primary"></i> Customer GSTIN-Wise Sales Summary
            <span class="label label-primary" style="font-size: 11px; margin-left: 6px;"><?= $customer_count ?> Customers</span>
        </h4>
        <div style="font-size: 11px; color: #64748b;">
            Period: <strong><?= !empty($start) ? htmlspecialchars($start) : '-' ?></strong> to <strong><?= !empty($end) ? htmlspecialchars($end) : '-' ?></strong>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">Sl.</th>
                    <th>Customer Name</th>
                    <th style="width: 180px;">Customer GSTIN</th>
                    <th style="width: 120px; text-align: center;">Sale Date</th>
                    <th style="width: 130px; text-align: right;">Taxable (₹)</th>
                    <th style="width: 120px; text-align: right;">CGST (₹)</th>
                    <th style="width: 120px; text-align: right;">SGST (₹)</th>
                    <th style="width: 140px; text-align: right;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customer_data)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($customer_data as $key => $value): ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <span style="font-weight: 600; color: #0284c7;">
                                    <?= htmlspecialchars(isset($value['customer_name']) ? $value['customer_name'] : 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <span class="label label-default" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px;">
                                    <?= !empty($value['customer_gst']) ? htmlspecialchars($value['customer_gst']) : 'UNREGISTERED' ?>
                                </span>
                            </td>
                            <td style="text-align: center;"><?= !empty($value['sale_date']) && $value['sale_date'] != '0000-00-00' ? date('d-m-Y', strtotime($value['sale_date'])) : '-' ?></td>
                            <td style="text-align: right; font-weight: 600;"><?= number_format((float)(isset($value['sale_taxable']) ? $value['sale_taxable'] : 0), 2) ?></td>
                            <td style="text-align: right; color: #d97706;"><?= number_format((float)(isset($value['sale_cgst']) ? $value['sale_cgst'] : 0), 2) ?></td>
                            <td style="text-align: right; color: #7c3aed;"><?= number_format((float)(isset($value['sale_sgst']) ? $value['sale_sgst'] : 0), 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format((float)(isset($value['sale_total']) ? $value['sale_total'] : 0), 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 35px !important; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                            No sales records found for the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($customer_data)): ?>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: 700;">Subtotal:</td>
                        <td style="text-align: right; font-weight: 700;"><?= number_format($taxable_sum, 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($cgst_sum, 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($sgst_sum, 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></td>
                    </tr>
                    <?php if ($total_grand_discount > 0): ?>
                        <tr>
                            <td colspan="7" style="text-align: right; font-weight: 600; color: #dc2626;">Grand Discount:</td>
                            <td style="text-align: right; font-weight: 700; color: #dc2626;">- ₹ <?= number_format($total_grand_discount, 2) ?></td>
                        </tr>
                        <tr style="background: #cbd5e1 !important;">
                            <td colspan="7" style="text-align: right; font-weight: 700; font-size: 13px;">Net Grand Total:</td>
                            <td style="text-align: right; font-weight: 800; font-size: 13px; color: #15803d;">₹ <?= number_format($final_grand_total, 2) ?></td>
                        </tr>
                    <?php endif; ?>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<!-- Table 2 & Table 3 Row: Rate Breakdown & HSN Summary -->
<div class="row">
    <!-- GST Rate Breakdown -->
    <div class="col-md-6 col-sm-12">
        <div class="table-card">
            <div class="table-card-header">
                <h4 class="table-card-title">
                    <i class="fa fa-pie-chart text-warning"></i> GST Rate Breakdown
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">CGST %</th>
                            <th style="text-align: right;">CGST (₹)</th>
                            <th style="text-align: center;">SGST %</th>
                            <th style="text-align: right;">SGST (₹)</th>
                            <th style="text-align: right;">Taxable (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tot_rate_cgst = 0;
                        $tot_rate_sgst = 0;
                        $tot_rate_taxable = 0;
                        if (!empty($daily_gst_data)):
                            foreach ($daily_gst_data as $val):
                                $cg = (float)(isset($val['sale_cgst']) ? $val['sale_cgst'] : 0);
                                $sg = (float)(isset($val['sale_sgst']) ? $val['sale_sgst'] : 0);
                                $tx = (float)(isset($val['sale_taxable']) ? $val['sale_taxable'] : 0);
                                $tot_rate_cgst += $cg;
                                $tot_rate_sgst += $sg;
                                $tot_rate_taxable += $tx;
                        ?>
                            <tr>
                                <td style="text-align: center;"><span class="badge" style="background: #d97706;"><?= htmlspecialchars(isset($val['sale_cgst_percent']) ? $val['sale_cgst_percent'] : '0') ?>%</span></td>
                                <td style="text-align: right; font-weight: 600; color: #d97706;"><?= number_format($cg, 2) ?></td>
                                <td style="text-align: center;"><span class="badge" style="background: #7c3aed;"><?= htmlspecialchars(isset($val['sale_sgst_percent']) ? $val['sale_sgst_percent'] : '0') ?>%</span></td>
                                <td style="text-align: right; font-weight: 600; color: #7c3aed;"><?= number_format($sg, 2) ?></td>
                                <td style="text-align: right; font-weight: 600;"><?= number_format($tx, 2) ?></td>
                            </tr>
                        <?php 
                            endforeach;
                        else:
                        ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #64748b; padding: 20px !important;">No GST rate data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($daily_gst_data)): ?>
                        <tfoot>
                            <tr>
                                <td style="text-align: center; font-weight: 700;">Total</td>
                                <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($tot_rate_cgst, 2) ?></td>
                                <td style="text-align: center; font-weight: 700;">Total</td>
                                <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($tot_rate_sgst, 2) ?></td>
                                <td style="text-align: right; font-weight: 700;"><?= number_format($tot_rate_taxable, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- HSN Summary Breakdown -->
    <div class="col-md-6 col-sm-12">
        <div class="table-card">
            <div class="table-card-header">
                <h4 class="table-card-title">
                    <i class="fa fa-barcode text-info"></i> HSN Code Summary
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>HSN Code</th>
                            <th style="text-align: center;">Strip Qty</th>
                            <th style="text-align: right;">Taxable (₹)</th>
                            <th style="text-align: right;">CGST (₹)</th>
                            <th style="text-align: right;">SGST (₹)</th>
                            <th style="text-align: right;">Total Tax (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tot_hsn_qty = 0;
                        $tot_hsn_taxable = 0;
                        $tot_hsn_cgst = 0;
                        $tot_hsn_sgst = 0;
                        $tot_hsn_tax = 0;
                        if (!empty($hsn_daily_gst_data)):
                            foreach ($hsn_daily_gst_data as $val):
                                $qty = (float)(isset($val['sale_strip_quantity']) ? $val['sale_strip_quantity'] : 0);
                                $tx  = (float)(isset($val['sale_taxable']) ? $val['sale_taxable'] : 0);
                                $cg  = (float)(isset($val['sale_cgst']) ? $val['sale_cgst'] : 0);
                                $sg  = (float)(isset($val['sale_sgst']) ? $val['sale_sgst'] : 0);
                                $tax = $cg + $sg;

                                $tot_hsn_qty += $qty;
                                $tot_hsn_taxable += $tx;
                                $tot_hsn_cgst += $cg;
                                $tot_hsn_sgst += $sg;
                                $tot_hsn_tax += $tax;
                        ?>
                            <tr>
                                <td>
                                    <span class="label label-default" style="font-family: monospace; font-size: 11px;">
                                        <?= !empty($val['medicine_hsn']) ? htmlspecialchars($val['medicine_hsn']) : 'N/A' ?>
                                    </span>
                                </td>
                                <td style="text-align: center;"><?= number_format($qty, 0) ?></td>
                                <td style="text-align: right; font-weight: 600;"><?= number_format($tx, 2) ?></td>
                                <td style="text-align: right; color: #d97706;"><?= number_format($cg, 2) ?></td>
                                <td style="text-align: right; color: #7c3aed;"><?= number_format($sg, 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #16a34a;"><?= number_format($tax, 2) ?></td>
                            </tr>
                        <?php 
                            endforeach;
                        else:
                        ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: #64748b; padding: 20px !important;">No HSN data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($hsn_daily_gst_data)): ?>
                        <tfoot>
                            <tr>
                                <td style="font-weight: 700;">Total</td>
                                <td style="text-align: center; font-weight: 700;"><?= number_format($tot_hsn_qty, 0) ?></td>
                                <td style="text-align: right; font-weight: 700;"><?= number_format($tot_hsn_taxable, 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($tot_hsn_cgst, 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($tot_hsn_sgst, 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #16a34a;"><?= number_format($tot_hsn_tax, 2) ?></td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
