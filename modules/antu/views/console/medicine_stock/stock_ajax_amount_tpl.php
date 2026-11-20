<?php
$total_mrp_valuation  = isset($total_mrp_valuation) ? (float)$total_mrp_valuation : 0;
$total_cost_valuation = isset($total_cost_valuation) ? (float)$total_cost_valuation : 0;
$total_in_stock_items = isset($total_in_stock_items) ? (int)$total_in_stock_items : 0;
$total_strips         = isset($total_strips) ? (float)$total_strips : 0;
$total_loose          = isset($total_loose) ? (float)$total_loose : 0;
$total_records        = isset($total_records) ? (int)$total_records : 0;
$total_pages          = isset($total_pages) ? (int)$total_pages : 1;
$page                 = isset($page) ? (int)$page : 1;
$start_record         = isset($start_record) ? (int)$start_record : 0;
$end_record           = isset($end_record) ? (int)$end_record : 0;
?>

<!-- KPI Summary Cards Row -->
<div class="row" style="margin-left: -6px; margin-right: -6px;">
    <!-- Total MRP Valuation -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #ecfdf5; color: #059669;">
                <i class="fa fa-inr"></i>
            </div>
            <div>
                <div class="kpi-title">Stock MRP Valuation</div>
                <div class="kpi-value" style="color: #059669;">
                    &#8377; <?= number_format($total_mrp_valuation, 2) ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">Retail market value</small>
            </div>
        </div>
    </div>

    <!-- Total Cost Valuation -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                <i class="fa fa-tag"></i>
            </div>
            <div>
                <div class="kpi-title">Purchase Cost Value</div>
                <div class="kpi-value" style="color: #2563eb;">
                    &#8377; <?= number_format($total_cost_valuation, 2) ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">Invoice purchase cost</small>
            </div>
        </div>
    </div>

    <!-- In-Stock Medicines Count -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title">In-Stock Medicines</div>
                <div class="kpi-value" style="color: #7c3aed;">
                    <?= number_format($total_in_stock_items) ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">Medicines with stock</small>
            </div>
        </div>
    </div>

    <!-- Total Stock Quantities -->
    <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: #fffbeb; color: #d97706;">
                <i class="fa fa-medkit"></i>
            </div>
            <div>
                <div class="kpi-title">Total Available Quantity</div>
                <div class="kpi-value" style="color: #d97706; font-size: 16px;">
                    <?= number_format($total_strips) ?> <span style="font-size: 12px; font-weight: normal; color: #64748b;">Strips</span> / <?= number_format($total_loose) ?> <span style="font-size: 12px; font-weight: normal; color: #64748b;">Loose</span>
                </div>
                <small style="font-size: 11px; color: #64748b;">Physical stock on hand</small>
            </div>
        </div>
    </div>
</div>

<!-- Main Data Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <h3 class="table-card-title">
            <i class="fa fa-table text-primary"></i>
            Stock Valuation Records
            <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px; font-weight: 600; margin-left: 6px;">
                Showing <?= $start_record ?> to <?= $end_record ?> of <?= number_format($total_records) ?> entries
            </span>
        </h3>
        <div class="no-print" style="font-size: 12px; color: #64748b;">
            Page <?= $page ?> of <?= $total_pages ?>
        </div>
    </div>

    <div class="table-responsive" style="margin: 0; padding: 0;">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">Sl</th>
                    <th style="min-width: 200px;">Medicine Name</th>
                    <th style="min-width: 140px;">Manufacturer</th>
                    <th style="width: 110px; text-align: center;">Storage / Rack</th>
                    <th style="width: 85px; text-align: center;">Unit / Pack</th>
                    <th style="width: 110px; text-align: right;">Available Strips</th>
                    <th style="width: 100px; text-align: right;">Available Loose</th>
                    <th style="width: 105px; text-align: right;">Latest MRP</th>
                    <th style="width: 125px; text-align: right;">Valuation (&#8377;)</th>
                    <th style="width: 85px; text-align: center;" class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alldata)): ?>
                    <?php
                    $counter = $start_record;
                    $page_strips = 0;
                    $page_loose  = 0;
                    $page_val    = 0;
                    ?>
                    <?php foreach ($alldata as $item): ?>
                        <?php
                        $strip_val = (float)$item['left_strip'];
                        $loose_val = (float)$item['left_loose'];
                        $mrp_val   = (float)$item['mrp'];
                        $val_amt   = (float)$item['valuation_amount'];

                        if ($strip_val > 0) $page_strips += $strip_val;
                        if ($loose_val > 0) $page_loose  += $loose_val;
                        $page_val += $val_amt;
                        ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++ ?></td>
                            <td>
                                <strong style="color: #0f172a; font-size: 12.5px;"><?= htmlspecialchars($item['medicine_name']) ?></strong>
                                <?php if (!empty($item['medicine_category'])): ?>
                                    <span class="label label-default" style="font-size: 10px; margin-left: 4px; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-weight: 600;">
                                        <?= htmlspecialchars($item['medicine_category']) ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="color: #475569;">
                                <?= !empty($item['medicine_manufacturer']) ? htmlspecialchars($item['medicine_manufacturer']) : '<span class="text-muted">-</span>' ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if (!empty($item['medicine_storage'])): ?>
                                    <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 600; font-size: 10.5px;">
                                        <i class="fa fa-archive"></i> <?= htmlspecialchars($item['medicine_storage']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center; color: #475569;">
                                <?= !empty($item['medicine_unit']) ? htmlspecialchars($item['medicine_unit']) : '10' ?>
                            </td>
                            <td style="text-align: right;">
                                <?php if ($strip_val > 0): ?>
                                    <strong style="color: #0f172a;"><?= number_format($strip_val) ?></strong>
                                <?php elseif ($strip_val == 0): ?>
                                    <span class="text-muted">0</span>
                                <?php else: ?>
                                    <span class="label label-danger" style="font-size: 10px;"><?= number_format($strip_val) ?></span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;">
                                <?php if ($loose_val > 0): ?>
                                    <span style="font-weight: 600; color: #475569;"><?= number_format($loose_val) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">0</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right; color: #334155;">
                                &#8377; <?= number_format($mrp_val, 2) ?>
                            </td>
                            <td style="text-align: right;">
                                <strong style="color: #059669; font-size: 13px;">
                                    &#8377; <?= number_format($val_amt, 2) ?>
                                </strong>
                            </td>
                            <td style="text-align: center;" class="no-print">
                                <a href="<?= console_url('medicine_stock/medicine_history?medicine_id=' . $item['medicine_id']) ?>"
                                    class="btn btn-xs btn-default"
                                    title="View Stock Movement History"
                                    style="border-color: #cbd5e1; border-radius: 3px; font-weight: 600;">
                                    <i class="fa fa-history text-primary"></i> History
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 36px 12px; color: #64748b;">
                            <div style="font-size: 28px; margin-bottom: 8px; color: #94a3b8;"><i class="fa fa-search"></i></div>
                            <h4 style="font-weight: 600; color: #334155; margin-bottom: 4px;">No Medicine Stock Valuation Records Found</h4>
                            <p style="font-size: 12px; margin-bottom: 12px;">There are no medicine records matching your current filter criteria.</p>
                            <button type="button" onclick="$('#btn_reset_filter').click();" class="btn btn-default btn-sm" style="border-radius: 4px; border-color: #cbd5e1;">
                                <i class="fa fa-refresh"></i> Clear Filters
                            </button>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($alldata)): ?>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right; text-transform: uppercase; letter-spacing: 0.5px;">
                            <strong>Grand Total (All <?= number_format($total_records) ?> Items):</strong>
                        </td>
                        <td style="text-align: right;">
                            <strong><?= number_format($total_strips) ?></strong>
                        </td>
                        <td style="text-align: right;">
                            <strong><?= number_format($total_loose) ?></strong>
                        </td>
                        <td style="text-align: right;">
                            <span class="text-muted">-</span>
                        </td>
                        <td style="text-align: right;">
                            <strong style="color: #059669; font-size: 13.5px;">&#8377; <?= number_format($total_mrp_valuation, 2) ?></strong>
                        </td>
                        <td class="no-print"></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>

    <!-- Pagination Controls -->
    <?php if ($total_pages > 1): ?>
        <div class="no-print" style="padding: 12px 16px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
            <div style="font-size: 12px; color: #64748b;">
                Showing <strong><?= $start_record ?></strong> to <strong><?= $end_record ?></strong> of <strong><?= number_format($total_records) ?></strong> records
            </div>
            <ul class="pagination pagination-sm" id="stock_amount_pagination" style="margin: 0;">
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
                        echo '<li class="disabled"><span style="border-color: #cbd5e1;">...</span></li>';
                    }
                }

                for ($p = $start_p; $p <= $end_p; $p++) {
                    $active = ($p == $page) ? 'active' : '';
                    echo '<li class="' . $active . '"><a href="#" class="page-link" data-page="' . $p . '">' . $p . '</a></li>';
                }

                if ($end_p < $total_pages) {
                    if ($end_p < $total_pages - 1) {
                        echo '<li class="disabled"><span style="border-color: #cbd5e1;">...</span></li>';
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