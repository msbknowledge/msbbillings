<?php
$taxable_sum = 0;
$cgst_sum    = 0;
$sgst_sum    = 0;
$total_sum   = 0;

if (!empty($customer_data)) {
    foreach ($customer_data as $row) {
        $taxable_sum += (float)(isset($row['sale_taxable']) ? $row['sale_taxable'] : 0);
        $cgst_sum    += (float)(isset($row['sale_cgst']) ? $row['sale_cgst'] : 0);
        $sgst_sum    += (float)(isset($row['sale_sgst']) ? $row['sale_sgst'] : 0);
        $grand_disc   = (float)(isset($row['sale_grand_discount']) ? $row['sale_grand_discount'] : 0);
        $total_sum   += ((float)(isset($row['sale_total']) ? $row['sale_total'] : 0) - $grand_disc);
    }
}
$invoice_count = !empty($customer_data) ? count($customer_data) : 0;
$rate_data     = !empty($daily_gst_data) ? $daily_gst_data : array();
$hsn_data      = !empty($hsn_daily_gst_data) ? $hsn_daily_gst_data : array();
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
                <div class="kpi-value" style="color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Table 1: Daily / Invoice-Wise Sale Summary -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-calendar-check-o text-success"></i> Daily / Invoice-Wise Sale Records
            <span class="label label-success" style="font-size: 11px; margin-left: 6px;"><?= $invoice_count ?> Invoices</span>
        </h4>
        <div style="font-size: 11px; color: #64748b;">
            Period: <strong><?= !empty($start) ? htmlspecialchars($start) : '-' ?></strong> to <strong><?= !empty($end) ? htmlspecialchars($end) : '-' ?></strong>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">Sl.</th>
                    <th style="width: 130px;">Invoice #</th>
                    <th>Customer Name</th>
                    <th style="width: 120px;">Mobile No</th>
                    <th style="width: 150px;">Customer GSTIN</th>
                    <th style="width: 95px; text-align: center;">Sale Date</th>
                    <th style="width: 110px; text-align: right;">Taxable (₹)</th>
                    <th style="width: 100px; text-align: right;">CGST (₹)</th>
                    <th style="width: 100px; text-align: right;">SGST (₹)</th>
                    <th style="width: 120px; text-align: right;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customer_data)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($customer_data as $key => $value): ?>
                        <?php 
                        $grand_disc = (float)(isset($value['sale_grand_discount']) ? $value['sale_grand_discount'] : 0);
                        $final_total = (float)(isset($value['sale_total']) ? $value['sale_total'] : 0) - $grand_disc;
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <span class="label label-info" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px;">
                                    <?= !empty($value['sale_invoice']) ? htmlspecialchars($value['sale_invoice']) : '-' ?>
                                </span>
                            </td>
                            <td>
                                <strong style="color: #0f172a;"><?= !empty($value['customer_name']) ? htmlspecialchars($value['customer_name']) : 'Cash / Walk-in' ?></strong>
                            </td>
                            <td style="font-size: 11px; color: #475569;">
                                <?= !empty($value['customer_contact']) ? htmlspecialchars($value['customer_contact']) : '-' ?>
                            </td>
                            <td>
                                <?php if (!empty($value['customer_gst'])): ?>
                                    <code style="font-size: 11px; color: #0284c7; background: #e0f2fe;"><?= htmlspecialchars($value['customer_gst']) ?></code>
                                <?php else: ?>
                                    <span style="color: #94a3b8; font-size: 11px;">Unregistered</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center; font-size: 11px; white-space: nowrap;">
                                <?= !empty($value['sale_date']) ? date('d-m-Y', strtotime($value['sale_date'])) : '-' ?>
                            </td>
                            <td style="text-align: right; color: #334155;">
                                ₹ <?= number_format((float)(isset($value['sale_taxable']) ? $value['sale_taxable'] : 0), 2) ?>
                            </td>
                            <td style="text-align: right; color: #d97706;">
                                ₹ <?= number_format((float)(isset($value['sale_cgst']) ? $value['sale_cgst'] : 0), 2) ?>
                            </td>
                            <td style="text-align: right; color: #7c3aed;">
                                ₹ <?= number_format((float)(isset($value['sale_sgst']) ? $value['sale_sgst'] : 0), 2) ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">
                                ₹ <?= number_format($final_total, 2) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 45px; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; display: block; margin-bottom: 8px;"></i>
                            <div style="font-size: 14px; font-weight: 600; color: #334155;">No Daily Sale Records Found</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Try adjusting your search criteria or date range.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: right; font-weight: 700; text-transform: uppercase;">Total:</td>
                    <td style="text-align: right; font-weight: 700; color: #0284c7;">₹ <?= number_format($taxable_sum, 2) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #d97706;">₹ <?= number_format($cgst_sum, 2) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #7c3aed;">₹ <?= number_format($sgst_sum, 2) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Lower Section: GST Rate Summary & HSN Breakdown -->
<div class="row">
    <!-- GST Rate Summary Card -->
    <div class="col-md-6 col-sm-12">
        <div class="table-card">
            <div class="table-card-header">
                <h4 class="table-card-title">
                    <i class="fa fa-percent text-warning"></i> GST Rate Breakdown
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="width: 100px; text-align: center;">CGST %</th>
                            <th style="text-align: right;">Total CGST (₹)</th>
                            <th style="width: 100px; text-align: center;">SGST %</th>
                            <th style="text-align: right;">Total SGST (₹)</th>
                            <th style="text-align: right;">Total Tax (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tot_rate_cgst = 0;
                        $tot_rate_sgst = 0;
                        ?>
                        <?php if (!empty($rate_data)): ?>
                            <?php foreach ($rate_data as $val): ?>
                                <?php
                                $cg = (float)(isset($val['sale_cgst']) ? $val['sale_cgst'] : 0);
                                $sg = (float)(isset($val['sale_sgst']) ? $val['sale_sgst'] : $cg);
                                $tot_rate_cgst += $cg;
                                $tot_rate_sgst += $sg;
                                ?>
                                <tr>
                                    <td style="text-align: center; font-weight: 600; color: #475569;">
                                        <?= isset($val['sale_cgst_percent']) ? (float)$val['sale_cgst_percent'] : 0 ?>%
                                    </td>
                                    <td style="text-align: right; color: #d97706;">₹ <?= number_format($cg, 2) ?></td>
                                    <td style="text-align: center; font-weight: 600; color: #475569;">
                                        <?= isset($val['sale_sgst_percent']) ? (float)$val['sale_sgst_percent'] : (isset($val['sale_cgst_percent']) ? (float)$val['sale_cgst_percent'] : 0) ?>%
                                    </td>
                                    <td style="text-align: right; color: #7c3aed;">₹ <?= number_format($sg, 2) ?></td>
                                    <td style="text-align: right; font-weight: 700; color: #0f172a;">₹ <?= number_format($cg + $sg, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 25px; color: #64748b;">No GST rate data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align: center; font-weight: 700;">Total</td>
                            <td style="text-align: right; font-weight: 700; color: #d97706;">₹ <?= number_format($tot_rate_cgst, 2) ?></td>
                            <td style="text-align: center; font-weight: 700;">Total</td>
                            <td style="text-align: right; font-weight: 700; color: #7c3aed;">₹ <?= number_format($tot_rate_sgst, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($tot_rate_cgst + $tot_rate_sgst, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- HSN Breakdown Card -->
    <div class="col-md-6 col-sm-12">
        <div class="table-card">
            <div class="table-card-header">
                <h4 class="table-card-title">
                    <i class="fa fa-barcode text-primary"></i> HSN-wise GST Breakdown
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>HSN Code</th>
                            <th style="text-align: right;">Total CGST (₹)</th>
                            <th style="text-align: right;">Total SGST (₹)</th>
                            <th style="text-align: right;">Total Tax (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tot_hsn_cgst = 0;
                        $tot_hsn_sgst = 0;
                        ?>
                        <?php if (!empty($hsn_data)): ?>
                            <?php foreach ($hsn_data as $val): ?>
                                <?php
                                $cg = (float)(isset($val['sale_cgst']) ? $val['sale_cgst'] : 0);
                                $sg = (float)(isset($val['sale_sgst']) ? $val['sale_sgst'] : $cg);
                                $tot_hsn_cgst += $cg;
                                $tot_hsn_sgst += $sg;
                                ?>
                                <tr>
                                    <td>
                                        <span class="label label-default" style="font-family: monospace; font-size: 11px; background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;">
                                            <?= !empty($val['medicine_hsn']) ? htmlspecialchars($val['medicine_hsn']) : 'N/A' ?>
                                        </span>
                                    </td>
                                    <td style="text-align: right; color: #d97706;">₹ <?= number_format($cg, 2) ?></td>
                                    <td style="text-align: right; color: #7c3aed;">₹ <?= number_format($sg, 2) ?></td>
                                    <td style="text-align: right; font-weight: 700; color: #0f172a;">₹ <?= number_format($cg + $sg, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 25px; color: #64748b;">No HSN breakdown data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="font-weight: 700; text-transform: uppercase;">Total</td>
                            <td style="text-align: right; font-weight: 700; color: #d97706;">₹ <?= number_format($tot_hsn_cgst, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #7c3aed;">₹ <?= number_format($tot_hsn_sgst, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($tot_hsn_cgst + $tot_hsn_sgst, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
