<?php
$supplier_count  = isset($total_suppliers) ? (int)$total_suppliers : (!empty($alldata) ? count($alldata) : 0);
$total_purch_sum = isset($total_purchases) ? (float)$total_purchases : 0;
$total_paid_sum  = isset($total_paid) ? (float)$total_paid : 0;
$total_due_sum   = isset($total_due) ? (float)$total_due : 0;
$due_count       = isset($due_suppliers_count) ? (int)$due_suppliers_count : 0;

if (empty($total_purch_sum) && empty($total_paid_sum) && !empty($alldata)) {
    foreach ($alldata as $row) {
        $total_purch_sum += (float)(isset($row['purchase_total']) ? $row['purchase_total'] : 0);
        $total_paid_sum  += (float)(isset($row['payment_paid_amount']) ? $row['payment_paid_amount'] : 0);
        $total_due_sum   += (float)(isset($row['due_amount']) ? $row['due_amount'] : 0);
        if (isset($row['due_amount']) && $row['due_amount'] > 0.01) {
            $due_count++;
        }
    }
}
?>

<!-- KPI Summary Cards Row -->
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #e0f2fe; color: #0284c7;">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <div class="kpi-title">Total Purchases</div>
                <div class="kpi-value" style="color: #0284c7;">₹ <?= number_format($total_purch_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #dcfce7; color: #16a34a;">
                <i class="fa fa-check-circle"></i>
            </div>
            <div>
                <div class="kpi-title">Total Paid</div>
                <div class="kpi-value" style="color: #16a34a;">₹ <?= number_format($total_paid_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fee2e2; color: #dc2626;">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div>
                <div class="kpi-title">Total Outstanding Due</div>
                <div class="kpi-value" style="color: #dc2626;">₹ <?= number_format($total_due_sum, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-building"></i>
            </div>
            <div>
                <div class="kpi-title">Suppliers with Dues</div>
                <div class="kpi-value" style="color: #d97706;"><?= number_format($due_count) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">of <?= $supplier_count ?></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Supplier Due Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-list-alt text-primary"></i> Supplier Due Amount Details
            <span class="label label-primary" style="font-size: 11px; margin-left: 6px;"><?= $supplier_count ?> Suppliers</span>
        </h4>
        <div style="font-size: 11px; color: #64748b;">
            Period: <strong><?= !empty($start) ? htmlspecialchars($start) : 'All' ?></strong> to <strong><?= !empty($end) ? htmlspecialchars($end) : 'All' ?></strong>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">Sl.</th>
                    <th>Supplier Name</th>
                    <th style="width: 140px;">Contact #</th>
                    <th style="width: 170px;">GSTIN</th>
                    <th style="width: 140px; text-align: right;">Purchase Amount (₹)</th>
                    <th style="width: 140px; text-align: right;">Paid Amount (₹)</th>
                    <th style="width: 150px; text-align: right;">Due Amount (₹)</th>
                    <th style="width: 100px; text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alldata)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($alldata as $key => $value): ?>
                        <?php
                        if (empty($value)) continue;
                        $purch_amt = (float)(isset($value['purchase_total']) ? $value['purchase_total'] : 0);
                        $paid_amt  = (float)(isset($value['payment_paid_amount']) ? $value['payment_paid_amount'] : 0);
                        $due_amt   = isset($value['due_amount']) ? (float)$value['due_amount'] : ($purch_amt - $paid_amt);
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <span style="font-weight: 700; color: #0284c7;">
                                    <?= htmlspecialchars(isset($value['supplier_name']) ? $value['supplier_name'] : 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($value['supplier_contact'])): ?>
                                    <span style="font-size: 12px; color: #475569;"><i class="fa fa-phone text-muted" style="font-size: 10px; margin-right: 4px;"></i><?= htmlspecialchars($value['supplier_contact']) ?></span>
                                <?php else: ?>
                                    <span style="color: #94a3b8;">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="label label-default" style="font-family: monospace; font-size: 11px;">
                                    <?= !empty($value['supplier_gst']) ? htmlspecialchars($value['supplier_gst']) : 'UNREGISTERED' ?>
                                </span>
                            </td>
                            <td style="text-align: right; font-weight: 600;"><?= number_format($purch_amt, 2) ?></td>
                            <td style="text-align: right; font-weight: 600; color: #16a34a;"><?= number_format($paid_amt, 2) ?></td>
                            <td style="text-align: right; font-weight: 700; color: <?= ($due_amt > 0.01) ? '#dc2626' : (($due_amt < -0.01) ? '#0284c7' : '#16a34a') ?>;">
                                ₹ <?= number_format($due_amt, 2) ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if ($due_amt > 0.01): ?>
                                    <span class="label label-danger" style="font-size: 10px; padding: 3px 8px; font-weight: 600;">DUE</span>
                                <?php elseif ($due_amt < -0.01): ?>
                                    <span class="label label-info" style="font-size: 10px; padding: 3px 8px; font-weight: 600;">ADVANCE</span>
                                <?php else: ?>
                                    <span class="label label-success" style="font-size: 10px; padding: 3px 8px; font-weight: 600;">CLEARED</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px !important; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                            No supplier due records found for the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($alldata)): ?>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: 700;">TOTAL:</td>
                        <td style="text-align: right; font-weight: 700;"><?= number_format($total_purch_sum, 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #16a34a;"><?= number_format($total_paid_sum, 2) ?></td>
                        <td style="text-align: right; font-weight: 800; font-size: 13px; color: <?= ($total_due_sum > 0.01) ? '#dc2626' : '#16a34a' ?>;">
                            ₹ <?= number_format($total_due_sum, 2) ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>