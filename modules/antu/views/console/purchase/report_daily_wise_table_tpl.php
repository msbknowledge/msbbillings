<?php
$taxable_sum = 0;
$cgst_sum = 0;
$sgst_sum = 0;
$total_sum = 0;

if (!empty($customer_data)) {
    foreach ($customer_data as $row) {
        $taxable_sum += (float)(isset($row['purchase_taxable']) ? $row['purchase_taxable'] : 0);
        $cgst_sum    += (float)(isset($row['purchase_cgst']) ? $row['purchase_cgst'] : 0);
        $sgst_sum    += (float)(isset($row['purchase_sgst']) ? $row['purchase_sgst'] : 0);
        $total_sum   += (float)(isset($row['purchase_total']) ? $row['purchase_total'] : 0);
    }
}
$invoice_count = !empty($customer_data) ? count($customer_data) : 0;
$rate_data = !empty($daily_gst_data) ? $daily_gst_data : (!empty($gst_data) ? $gst_data : array());
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
                <div class="kpi-title">Total Purchase</div>
                <div class="kpi-value" style="color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Table 1: Daily / Invoice-Wise Purchase Summary -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-calendar-check-o text-primary"></i> Daily / Invoice-Wise Purchase Records
            <span class="label label-primary" style="font-size: 11px; margin-left: 6px;"><?= $invoice_count ?> Invoices</span>
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
                    <th style="width: 140px;">Invoice #</th>
                    <th>Supplier Name</th>
                    <th style="width: 160px;">Supplier GSTIN</th>
                    <th style="width: 110px; text-align: center;">Purchase Date</th>
                    <th style="width: 120px; text-align: right;">Taxable (₹)</th>
                    <th style="width: 110px; text-align: right;">CGST (₹)</th>
                    <th style="width: 110px; text-align: right;">SGST (₹)</th>
                    <th style="width: 130px; text-align: right;">Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($customer_data)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($customer_data as $key => $value): ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <span class="label label-info" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px;">
                                    <?= !empty($value['purchase_invoice']) ? htmlspecialchars($value['purchase_invoice']) : 'N/A' ?>
                                </span>
                            </td>
                            <td>
                                <strong style="color: #1e293b;"><?= htmlspecialchars(isset($value['supplier_name']) ? $value['supplier_name'] : 'N/A') ?></strong>
                            </td>
                            <td>
                                <span class="label label-default" style="font-family: monospace; font-size: 11px; letter-spacing: 0.5px;">
                                    <?= !empty($value['supplier_gst']) ? htmlspecialchars($value['supplier_gst']) : 'UNREGISTERED' ?>
                                </span>
                            </td>
                            <td style="text-align: center;"><?= !empty($value['purchase_date']) && $value['purchase_date'] != '0000-00-00' ? date('d-m-Y', strtotime($value['purchase_date'])) : '-' ?></td>
                            <td style="text-align: right; font-weight: 600;"><?= number_format((float)(isset($value['purchase_taxable']) ? $value['purchase_taxable'] : 0), 2) ?></td>
                            <td style="text-align: right; color: #d97706;"><?= number_format((float)(isset($value['purchase_cgst']) ? $value['purchase_cgst'] : 0), 2) ?></td>
                            <td style="text-align: right; color: #7c3aed;"><?= number_format((float)(isset($value['purchase_sgst']) ? $value['purchase_sgst'] : 0), 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format((float)(isset($value['purchase_total']) ? $value['purchase_total'] : 0), 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 35px !important; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                            No daily purchase records found for the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($customer_data)): ?>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: 700; text-transform: uppercase;">Total Daily Summary</td>
                    <td style="text-align: right; font-weight: 700;"><?= number_format($taxable_sum, 2) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($cgst_sum, 2) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($sgst_sum, 2) ?></td>
                    <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($total_sum, 2) ?></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<!-- Two Bottom Cards: GST Rate Summary & HSN Summary -->
<div class="row">
    <!-- Purchase GST Rate Summary -->
    <div class="col-md-6 col-sm-12">
        <div class="table-card">
            <div class="table-card-header">
                <h4 class="table-card-title">
                    <i class="fa fa-pie-chart text-info"></i> Purchase GST Rate Breakdown
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Rate (%)</th>
                            <th style="text-align: right;">Total CGST (₹)</th>
                            <th style="text-align: center;">Rate (%)</th>
                            <th style="text-align: right;">Total SGST (₹)</th>
                            <th style="text-align: right;">Total Tax (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $rate_cgst_total = 0;
                        $rate_sgst_total = 0;
                        if (!empty($rate_data)):
                            foreach ($rate_data as $val):
                                $rc = (float)(isset($val['purchase_cgst']) ? $val['purchase_cgst'] : 0);
                                $rs = (float)(isset($val['purchase_sgst']) ? $val['purchase_sgst'] : $rc);
                                $rate_cgst_total += $rc;
                                $rate_sgst_total += $rs;
                        ?>
                            <tr>
                                <td style="text-align: center; font-weight: 600;">
                                    <span class="label label-info"><?= htmlspecialchars(isset($val['purchase_cgst_percent']) ? $val['purchase_cgst_percent'] : '0') ?>%</span>
                                </td>
                                <td style="text-align: right; color: #d97706;"><?= number_format($rc, 2) ?></td>
                                <td style="text-align: center; font-weight: 600;">
                                    <span class="label label-info"><?= htmlspecialchars(isset($val['purchase_sgst_percent']) ? $val['purchase_sgst_percent'] : (isset($val['purchase_cgst_percent']) ? $val['purchase_cgst_percent'] : '0')) ?>%</span>
                                </td>
                                <td style="text-align: right; color: #7c3aed;"><?= number_format($rs, 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($rc + $rs, 2) ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="5" style="text-align: center; color: #64748b; padding: 20px !important;">No GST rate data found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($rate_data)): ?>
                    <tfoot>
                        <tr>
                            <td style="text-align: center; font-weight: 700;">Total</td>
                            <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($rate_cgst_total, 2) ?></td>
                            <td style="text-align: center; font-weight: 700;">Total</td>
                            <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($rate_sgst_total, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($rate_cgst_total + $rate_sgst_total, 2) ?></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- HSN Code Summary -->
    <div class="col-md-6 col-sm-12">
        <div class="table-card">
            <div class="table-card-header">
                <h4 class="table-card-title">
                    <i class="fa fa-barcode text-warning"></i> HSN-Wise GST Summary
                </h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">HSN Code</th>
                            <th style="text-align: right;">HSN CGST (₹)</th>
                            <th style="text-align: right;">HSN SGST (₹)</th>
                            <th style="text-align: right;">Total Tax (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $hsn_cgst_total = 0;
                        $hsn_sgst_total = 0;
                        if (!empty($hsn_daily_gst_data)):
                            foreach ($hsn_daily_gst_data as $val):
                                $hc = (float)(isset($val['purchase_cgst']) ? $val['purchase_cgst'] : 0);
                                $hs = (float)(isset($val['purchase_sgst']) ? $val['purchase_sgst'] : $hc);
                                $hsn_cgst_total += $hc;
                                $hsn_sgst_total += $hs;
                        ?>
                            <tr>
                                <td style="text-align: center; font-family: monospace; font-weight: 600;">
                                    <span class="label label-warning"><?= !empty($val['medicine_hsn']) ? htmlspecialchars($val['medicine_hsn']) : 'N/A' ?></span>
                                </td>
                                <td style="text-align: right; color: #d97706;"><?= number_format($hc, 2) ?></td>
                                <td style="text-align: right; color: #7c3aed;"><?= number_format($hs, 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($hc + $hs, 2) ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="4" style="text-align: center; color: #64748b; padding: 20px !important;">No HSN data found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if (!empty($hsn_daily_gst_data)): ?>
                    <tfoot>
                        <tr>
                            <td style="text-align: center; font-weight: 700;">Total</td>
                            <td style="text-align: right; font-weight: 700; color: #d97706;"><?= number_format($hsn_cgst_total, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #7c3aed;"><?= number_format($hsn_sgst_total, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($hsn_cgst_total + $hsn_sgst_total, 2) ?></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
