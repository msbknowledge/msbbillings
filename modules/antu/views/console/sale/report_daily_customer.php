<?php
$records_count = isset($total_items) ? (int)$total_items : (!empty($records) ? count($records) : 0);
$sum_debit     = isset($total_debit) ? (float)$total_debit : 0;
$sum_credit    = isset($total_credit) ? (float)$total_credit : 0;
$net_balance   = isset($balance) ? (float)$balance : ($sum_debit - $sum_credit);

// Fallback if records is empty but alldata exists
if (empty($records) && !empty($alldata)) {
    $records = array();
    foreach ($alldata as $date => $rows) {
        foreach ($rows as $row) {
            $records[] = array(
                'date'             => isset($row['date']) ? $row['date'] : $date,
                'invoice'          => isset($row['number']) ? $row['number'] : '',
                'customer_name'    => isset($row['customer']) ? $row['customer'] : '',
                'customer_contact' => isset($row['customer_contact']) ? $row['customer_contact'] : '',
                'customer_gst'     => isset($row['customer_gst']) ? $row['customer_gst'] : '',
                'type'             => isset($row['type']) ? $row['type'] : ((!empty($row['debit'])) ? 'sale' : 'payment'),
                'debit'            => (float)(isset($row['debit']) ? $row['debit'] : 0),
                'credit'           => (float)(isset($row['credit']) ? $row['credit'] : 0),
                'note'             => isset($row['note']) ? $row['note'] : '',
            );
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
                <div class="kpi-title">Total Sales (Debit)</div>
                <div class="kpi-value" style="color: #0284c7;">₹ <?= number_format($sum_debit, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #dcfce7; color: #16a34a;">
                <i class="fa fa-money"></i>
            </div>
            <div>
                <div class="kpi-title">Total Received (Credit)</div>
                <div class="kpi-value" style="color: #16a34a;">₹ <?= number_format($sum_credit, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: <?= ($net_balance > 0.01) ? '#fee2e2' : '#f0fdf4' ?>; color: <?= ($net_balance > 0.01) ? '#dc2626' : '#16a34a' ?>;">
                <i class="fa <?= ($net_balance > 0.01) ? 'fa-exclamation-circle' : 'fa-check-circle' ?>"></i>
            </div>
            <div>
                <div class="kpi-title">Net Due Balance</div>
                <div class="kpi-value" style="color: <?= ($net_balance > 0.01) ? '#dc2626' : '#16a34a' ?>;">₹ <?= number_format($net_balance, 2) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-exchange"></i>
            </div>
            <div>
                <div class="kpi-title">Total Transactions</div>
                <div class="kpi-value" style="color: #d97706;"><?= number_format($records_count) ?> <span style="font-size: 13px; font-weight: normal; color: #64748b;">Entries</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Customer Payment Records Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <h4 class="table-card-title">
            <i class="fa fa-file-text-o text-primary"></i> Customer Ledger & Payment Transactions
            <span class="label label-primary" style="font-size: 11px; margin-left: 6px;"><?= $records_count ?> Records</span>
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
                    <th style="width: 120px;">Invoice / Ref #</th>
                    <th>Customer Name</th>
                    <th style="width: 100px; text-align: center;">Type</th>
                    <th style="width: 130px; text-align: right;">Debit / Sale (₹)</th>
                    <th style="width: 130px; text-align: right;">Credit / Paid (₹)</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($records)): ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($records as $key => $value): ?>
                        <?php
                        $is_sale = (isset($value['type']) && $value['type'] == 'sale');
                        $debit_amt  = (float)(isset($value['debit']) ? $value['debit'] : 0);
                        $credit_amt = (float)(isset($value['credit']) ? $value['credit'] : 0);
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="text-align: center;">
                                <?= !empty($value['date']) && $value['date'] != '0000-00-00' ? date('d-m-Y', strtotime($value['date'])) : '-' ?>
                            </td>
                            <td>
                                <span style="font-family: monospace; font-weight: 600; color: #0284c7;">
                                    <?= htmlspecialchars(isset($value['invoice']) ? $value['invoice'] : '-') ?>
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 700; color: #334155;">
                                    <?= !empty($value['customer_name']) ? htmlspecialchars($value['customer_name']) : '<span style="color: #94a3b8; font-weight: normal;">Walk-in</span>' ?>
                                </span>
                                <?php if (!empty($value['customer_contact'])): ?>
                                    <div style="font-size: 11px; color: #64748b;"><i class="fa fa-phone text-muted" style="font-size: 10px; margin-right: 4px;"></i><?= htmlspecialchars($value['customer_contact']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if ($is_sale): ?>
                                    <span class="label label-info" style="font-size: 10px; padding: 3px 8px; font-weight: 600;">SALE</span>
                                <?php else: ?>
                                    <span class="label label-success" style="font-size: 10px; padding: 3px 8px; font-weight: 600;">PAYMENT</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: <?= ($debit_amt > 0) ? '#0284c7' : '#94a3b8' ?>;">
                                <?= ($debit_amt > 0) ? number_format($debit_amt, 2) : '-' ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: <?= ($credit_amt > 0) ? '#16a34a' : '#94a3b8' ?>;">
                                <?= ($credit_amt > 0) ? number_format($credit_amt, 2) : '-' ?>
                            </td>
                            <td style="font-size: 11px; color: #64748b;">
                                <?= !empty($value['note']) ? htmlspecialchars($value['note']) : '-' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px !important; color: #64748b;">
                            <i class="fa fa-info-circle fa-2x" style="color: #94a3b8; margin-bottom: 8px; display: block;"></i>
                            No payment or ledger records found for the selected criteria.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($records)): ?>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right; font-weight: 700;">TOTAL:</td>
                        <td style="text-align: right; font-weight: 700; color: #0284c7;">₹ <?= number_format($sum_debit, 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #16a34a;">₹ <?= number_format($sum_credit, 2) ?></td>
                        <td></td>
                    </tr>
                    <tr style="background: #cbd5e1 !important;">
                        <td colspan="5" style="text-align: right; font-weight: 700; font-size: 13px;">NET BALANCE (DEBIT - CREDIT):</td>
                        <td colspan="2" style="text-align: right; font-weight: 800; font-size: 13px; color: <?= ($net_balance > 0.01) ? '#dc2626' : '#16a34a' ?>;">
                            ₹ <?= number_format($net_balance, 2) ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>
