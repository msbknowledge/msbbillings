<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$total_purchase_taxable = isset($total_purchase_taxable) ? (float)$total_purchase_taxable : 0;
$total_purchase_gst     = isset($total_purchase_gst) ? (float)$total_purchase_gst : 0;
$total_purchase_total   = isset($total_purchase_total) ? (float)$total_purchase_total : 0;

$total_sale_taxable     = isset($total_sale_taxable) ? (float)$total_sale_taxable : 0;
$total_sale_gst         = isset($total_sale_gst) ? (float)$total_sale_gst : 0;
$total_sale_discount    = isset($total_sale_discount) ? (float)$total_sale_discount : 0;
$total_sale_net         = isset($total_sale_net) ? (float)$total_sale_net : 0;

$total_govt_gst_payable = isset($total_govt_gst_payable) ? (float)$total_govt_gst_payable : 0;
$net_profit_loss        = isset($net_profit_loss) ? (float)$net_profit_loss : 0;
$overall_margin_pct     = isset($overall_margin_pct) ? (float)$overall_margin_pct : 0;

$paged_daily            = !empty($paged_daily) && is_array($paged_daily) ? $paged_daily : array();
$total_records          = isset($total_records) ? (int)$total_records : count($paged_daily);
$total_pages            = isset($total_pages) ? (int)$total_pages : 1;
$page                   = isset($page) ? (int)$page : 1;
$per_page               = isset($per_page) ? $per_page : 25;
$start_record           = isset($start_record) ? (int)$start_record : 0;
$end_record             = isset($end_record) ? (int)$end_record : 0;
?>

<!-- 4 Smart KPI Summary Cards -->
<div class="row" style="margin-left: -6px; margin-right: -6px; margin-bottom: 6px;">
    <!-- Total Sales Revenue -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card" style="border-left: 4px solid #2563eb;">
            <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                <i class="fa fa-line-chart"></i>
            </div>
            <div>
                <div class="kpi-title">Net Sales Revenue</div>
                <div class="kpi-value" style="color: #2563eb;">
                    &#8377; <?= number_format($total_sale_net, 2) ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">
                    Taxable: &#8377;<?= number_format($total_sale_taxable, 2) ?> | Dis: &#8377;<?= number_format($total_sale_discount, 2) ?>
                </small>
            </div>
        </div>
    </div>

    <!-- Total Purchases Cost -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card" style="border-left: 4px solid #f59e0b;">
            <div class="kpi-icon" style="background: #fffbeb; color: #d97706;">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <div class="kpi-title">Total Purchases (COGS)</div>
                <div class="kpi-value" style="color: #d97706;">
                    &#8377; <?= number_format($total_purchase_total, 2) ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">
                    Taxable: &#8377;<?= number_format($total_purchase_taxable, 2) ?> | GST: &#8377;<?= number_format($total_purchase_gst, 2) ?>
                </small>
            </div>
        </div>
    </div>

    <!-- Net GST Liability -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card" style="border-left: 4px solid #8b5cf6;">
            <div class="kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
                <i class="fa fa-university"></i>
            </div>
            <div>
                <div class="kpi-title">Net GST Payable</div>
                <div class="kpi-value" style="color: #7c3aed;">
                    &#8377; <?= number_format($total_govt_gst_payable, 2) ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">
                    Output GST (&#8377;<?= number_format($total_sale_gst, 2) ?>) - Input GST (&#8377;<?= number_format($total_purchase_gst, 2) ?>)
                </small>
            </div>
        </div>
    </div>

    <!-- Net Profit / Loss -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card" style="border-left: 4px solid <?= ($net_profit_loss >= 0) ? '#059669' : '#dc2626' ?>; background: <?= ($net_profit_loss >= 0) ? '#f0fdf4' : '#fef2f2' ?>;">
            <div class="kpi-icon" style="background: <?= ($net_profit_loss >= 0) ? '#dcfce7' : '#fee2e2' ?>; color: <?= ($net_profit_loss >= 0) ? '#16a34a' : '#dc2626' ?>;">
                <i class="fa <?= ($net_profit_loss >= 0) ? 'fa-arrow-trend-up fa-level-up' : 'fa-arrow-trend-down fa-level-down' ?>"></i>
            </div>
            <div>
                <div class="kpi-title" style="color: <?= ($net_profit_loss >= 0) ? '#166534' : '#991b1b' ?>;">
                    Net <?= ($net_profit_loss >= 0) ? 'Trading Profit' : 'Trading Loss' ?>
                </div>
                <div class="kpi-value" style="color: <?= ($net_profit_loss >= 0) ? '#15803d' : '#b91c1c' ?> !important;">
                    &#8377; <?= number_format(abs($net_profit_loss), 2) ?>
                </div>
                <small style="font-size: 11px; font-weight: 600; color: <?= ($net_profit_loss >= 0) ? '#166534' : '#991b1b' ?>;">
                    Margin: <?= number_format($overall_margin_pct, 2) ?>% <?= ($net_profit_loss >= 0) ? 'Profit' : 'Loss' ?>
                </small>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Statement Summary Table Card -->
<div class="table-card" style="margin-bottom: 18px;">
    <div class="table-card-header">
        <h3 class="table-card-title">
            <i class="fa fa-file-text-o text-primary"></i>
            Executive Profit &amp; Loss Financial Statement
        </h3>
        <span class="no-print" style="font-size: 12px; color: #64748b;">
            Period: <strong><?= !empty($period_start) ? date('d M Y', strtotime($period_start)) : '-' ?></strong> to <strong><?= !empty($period_end) ? date('d M Y', strtotime($period_end)) : '-' ?></strong>
        </span>
    </div>

    <div class="table-responsive" style="margin: 0;">
        <table class="table table-bordered gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 50%;">Expenses &amp; Cost of Goods (Debits)</th>
                    <th style="width: 50%;">Income &amp; Sales Revenue (Credits)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Expenses Column -->
                    <td style="vertical-align: top; padding: 0;">
                        <table class="table table-condensed" style="margin-bottom: 0;">
                            <tbody>
                                <tr>
                                    <td style="padding: 9px 14px; color: #475569;">Total Purchases (Excluding GST)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 600;">&#8377; <?= number_format($total_purchase_taxable, 2) ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; color: #475569;">Total Purchase GST (Input Credit)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 600;">&#8377; <?= number_format($total_purchase_gst, 2) ?></td>
                                </tr>
                                <tr style="background: #f8fafc;">
                                    <td style="padding: 9px 14px; font-weight: 700; color: #0f172a;">Gross Purchases (Invoice Total)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 700; color: #0f172a;">&#8377; <?= number_format($total_purchase_total, 2) ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; color: #475569;">Net Govt GST Liability (Output - Input)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 600; color: <?= ($total_govt_gst_payable > 0) ? '#7c3aed' : '#64748b' ?>;">
                                        &#8377; <?= number_format($total_govt_gst_payable, 2) ?>
                                    </td>
                                </tr>
                                <tr style="background: #f1f5f9; border-top: 2px solid #cbd5e1;">
                                    <td style="padding: 10px 14px; font-weight: 700; color: #0f172a; text-transform: uppercase;">Total Outflow (Purchases + Govt GST)</td>
                                    <td style="padding: 10px 14px; text-align: right; font-weight: 700; color: #0f172a;">
                                        &#8377; <?= number_format($total_purchase_total + max(0, $total_govt_gst_payable), 2) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                    <!-- Income Column -->
                    <td style="vertical-align: top; padding: 0; border-left: 1px solid #cbd5e1;">
                        <table class="table table-condensed" style="margin-bottom: 0;">
                            <tbody>
                                <tr>
                                    <td style="padding: 9px 14px; color: #475569;">Total Sales (Excluding GST)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 600;">&#8377; <?= number_format($total_sale_taxable, 2) ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; color: #475569;">Total Sales GST (Output Tax)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 600;">&#8377; <?= number_format($total_sale_gst, 2) ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 9px 14px; color: #dc2626;">Less: Sales Grand Discount</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 600; color: #dc2626;">- &#8377; <?= number_format($total_sale_discount, 2) ?></td>
                                </tr>
                                <tr style="background: #f8fafc;">
                                    <td style="padding: 9px 14px; font-weight: 700; color: #0f172a;">Net Realized Sales (Invoice Revenue)</td>
                                    <td style="padding: 9px 14px; text-align: right; font-weight: 700; color: #0f172a;">&#8377; <?= number_format($total_sale_net, 2) ?></td>
                                </tr>
                                <tr style="background: <?= ($net_profit_loss >= 0) ? '#ecfdf5' : '#fef2f2' ?>; border-top: 2px solid <?= ($net_profit_loss >= 0) ? '#10b981' : '#ef4444' ?>;">
                                    <td style="padding: 10px 14px; font-weight: 700; text-transform: uppercase; color: <?= ($net_profit_loss >= 0) ? '#059669' : '#b91c1c' ?>;">
                                        Final Net <?= ($net_profit_loss >= 0) ? 'Trading Profit' : 'Trading Loss' ?>
                                    </td>
                                    <td style="padding: 10px 14px; text-align: right; font-weight: 700; font-size: 14px; color: <?= ($net_profit_loss >= 0) ? '#059669' : '#b91c1c' ?>;">
                                        &#8377; <?= number_format(abs($net_profit_loss), 2) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Daily Profit & Loss Audit Ledger with Bottom Pagination -->
<div class="table-card">
    <div class="table-card-header">
        <h3 class="table-card-title">
            <i class="fa fa-calendar-check-o text-primary"></i>
            Daily Profit &amp; Loss Audit Ledger
            <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px; font-weight: 600; margin-left: 6px;">
                Showing <?= $start_record ?> to <?= $end_record ?> of <?= number_format($total_records) ?> days
            </span>
        </h3>
        <div class="no-print" style="font-size: 12px; color: #64748b;">
            Page <strong><?= $page ?></strong> of <strong><?= $total_pages ?></strong>
        </div>
    </div>

    <div class="table-responsive" style="margin: 0; padding: 0;">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">Sl</th>
                    <th style="width: 105px; text-align: center;">Date</th>
                    <th style="text-align: right;">Purchases Excl. GST</th>
                    <th style="text-align: right;">Purchase GST</th>
                    <th style="text-align: right;">Total Purchases</th>
                    <th style="text-align: right;">Sales Excl. GST</th>
                    <th style="text-align: right;">Sales GST</th>
                    <th style="text-align: right;">Net Sales</th>
                    <th style="text-align: right;">Govt GST</th>
                    <th style="text-align: right;">Daily Profit/Loss</th>
                    <th style="width: 85px; text-align: center;">Margin</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($paged_daily)): ?>
                    <?php
                    $counter = $start_record;
                    foreach ($paged_daily as $row):
                        $is_profit = ($row['daily_net_profit'] >= 0);
                        $formatted_date = !empty($row['report_date']) ? date('d-m-Y', strtotime($row['report_date'])) : '-';
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td style="text-align: center; font-weight: 600; color: #0f172a;">
                                <i class="fa fa-calendar-o text-muted" style="margin-right: 3px;"></i> <?= $formatted_date ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                &#8377; <?= number_format($row['purchase_taxable'], 2) ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                &#8377; <?= number_format($row['purchase_gst'], 2) ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #0f172a;">
                                &#8377; <?= number_format($row['purchase_total'], 2) ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                &#8377; <?= number_format($row['sale_taxable'], 2) ?>
                            </td>
                            <td style="text-align: right; color: #475569;">
                                &#8377; <?= number_format($row['sale_gst'], 2) ?>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #2563eb;">
                                &#8377; <?= number_format($row['net_sale_total'], 2) ?>
                            </td>
                            <td style="text-align: right; color: <?= ($row['govt_gst_payable'] > 0) ? '#7c3aed' : '#64748b' ?>; font-weight: 500;">
                                &#8377; <?= number_format($row['govt_gst_payable'], 2) ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: <?= $is_profit ? '#059669' : '#dc2626' ?>;">
                                <?= $is_profit ? '+' : '-' ?> &#8377; <?= number_format(abs($row['daily_net_profit']), 2) ?>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge" style="background: <?= $is_profit ? '#ecfdf5' : '#fef2f2' ?>; color: <?= $is_profit ? '#059669' : '#dc2626' ?>; border: 1px solid <?= $is_profit ? '#a7f3d0' : '#fecaca' ?>; font-weight: 600; font-size: 10.5px;">
                                    <?= number_format($row['margin_pct'], 1) ?>%
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" style="text-align: center; padding: 40px 15px; color: #64748b;">
                            <div style="font-size: 32px; margin-bottom: 8px; color: #94a3b8;"><i class="fa fa-calendar-times-o"></i></div>
                            <h4 style="font-weight: 600; color: #334155; margin-bottom: 4px;">No Transactions Found in Selected Date Range</h4>
                            <p style="font-size: 12px; margin-bottom: 14px;">No purchase or sales activity was recorded between <?= htmlspecialchars($period_start) ?> and <?= htmlspecialchars($period_end) ?>.</p>
                            <button type="button" onclick="$('#btn_preset_fy').click();" class="btn btn-default btn-sm" style="border-radius: 4px; border-color: #cbd5e1; font-weight: 600;">
                                <i class="fa fa-refresh"></i> Reset to Current Financial Year
                            </button>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($paged_daily)): ?>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right; text-transform: uppercase; letter-spacing: 0.5px;">
                            <strong>Grand Total (Period):</strong>
                        </td>
                        <td style="text-align: right;"><strong>&#8377; <?= number_format($total_purchase_taxable, 2) ?></strong></td>
                        <td style="text-align: right;"><strong>&#8377; <?= number_format($total_purchase_gst, 2) ?></strong></td>
                        <td style="text-align: right;"><strong>&#8377; <?= number_format($total_purchase_total, 2) ?></strong></td>
                        <td style="text-align: right;"><strong>&#8377; <?= number_format($total_sale_taxable, 2) ?></strong></td>
                        <td style="text-align: right;"><strong>&#8377; <?= number_format($total_sale_gst, 2) ?></strong></td>
                        <td style="text-align: right; color: #2563eb;"><strong>&#8377; <?= number_format($total_sale_net, 2) ?></strong></td>
                        <td style="text-align: right; color: #7c3aed;"><strong>&#8377; <?= number_format($total_govt_gst_payable, 2) ?></strong></td>
                        <td style="text-align: right; color: <?= ($net_profit_loss >= 0) ? '#059669' : '#dc2626' ?>; font-size: 13.5px;">
                            <strong><?= ($net_profit_loss >= 0) ? '+' : '-' ?> &#8377; <?= number_format(abs($net_profit_loss), 2) ?></strong>
                        </td>
                        <td style="text-align: center;">
                            <span class="badge" style="background: <?= ($net_profit_loss >= 0) ? '#059669' : '#dc2626' ?>; color: #fff; font-weight: 700;">
                                <?= number_format($overall_margin_pct, 1) ?>%
                            </span>
                        </td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>

    <!-- Bottom Pagination & Controls Footer Bar (niche paginate used) -->
    <div id="profit_loss_pagination_container" class="no-print" style="padding: 12px 16px; background: #fafbfc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
            <div style="font-size: 12px; color: #64748b; font-weight: 500;">
                <?php if ($total_records > 0): ?>
                    Showing <strong style="color: #0f172a;"><?= $start_record ?></strong> to <strong style="color: #0f172a;"><?= $end_record ?></strong> of <strong style="color: #0f172a;"><?= number_format($total_records) ?></strong> daily records
                    <?php if ($total_pages > 1): ?>
                        <span style="color: #94a3b8; margin-left: 4px;">(Page <strong style="color: #0f172a;"><?= $page ?></strong> of <strong><?= $total_pages ?></strong>)</span>
                    <?php endif; ?>
                <?php else: ?>
                    Showing <strong style="color: #0f172a;">0</strong> records
                <?php endif; ?>
            </div>

            <!-- Per-Page Selector at Bottom -->
            <div style="display: inline-flex; align-items: center; gap: 6px;">
                <label style="font-size: 11px; color: #64748b; margin: 0; font-weight: 600;">Show:</label>
                <select class="form-control input-sm bottom-per-page-select" style="width: 80px; height: 28px; padding: 2px 6px; font-size: 12px; border-radius: 4px; border-color: #cbd5e1; display: inline-block;">
                    <option value="25" <?= ($per_page == 25) ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= ($per_page == 50) ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= ($per_page == 100) ? 'selected' : '' ?>>100</option>
                    <option value="250" <?= ($per_page == 250) ? 'selected' : '' ?>>250</option>
                    <option value="all" <?= ($per_page === 'all' || $per_page == 0) ? 'selected' : '' ?>>All</option>
                </select>
            </div>
        </div>

        <?php if ($total_pages > 1): ?>
            <div>
                <ul class="pagination pagination-sm" id="profit_loss_pagination" style="margin: 0;">
                    <!-- First Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="1" title="First Page">&laquo; First</a>
                    </li>

                    <!-- Previous Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="<?= max(1, $page - 1) ?>" title="Previous Page">&lsaquo; Prev</a>
                    </li>

                    <!-- Page Window -->
                    <?php
                    $range = 2;
                    $start_p = max(1, $page - $range);
                    $end_p   = min($total_pages, $page + $range);

                    if ($start_p > 1) {
                        echo '<li><a href="#" class="page-link" data-page="1">1</a></li>';
                        if ($start_p > 2) {
                            echo '<li class="disabled"><span>...</span></li>';
                        }
                    }

                    for ($p = $start_p; $p <= $end_p; $p++) {
                        $active = ($p == $page) ? 'active' : '';
                        echo '<li class="' . $active . '"><a href="#" class="page-link" data-page="' . $p . '">' . $p . '</a></li>';
                    }

                    if ($end_p < $total_pages) {
                        if ($end_p < $total_pages - 1) {
                            echo '<li class="disabled"><span>...</span></li>';
                        }
                        echo '<li><a href="#" class="page-link" data-page="' . $total_pages . '">' . $total_pages . '</a></li>';
                    }
                    ?>

                    <!-- Next Page -->
                    <li class="<?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="<?= min($total_pages, $page + 1) ?>" title="Next Page">Next &rsaquo;</a>
                    </li>

                    <!-- Last Page -->
                    <li class="<?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="<?= $total_pages ?>" title="Last Page">Last &raquo;</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
