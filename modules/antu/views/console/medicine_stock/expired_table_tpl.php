<?php
$total_batches            = isset($total_batches) ? (int)$total_batches : 0;
$total_strips             = isset($total_strips) ? (float)$total_strips : 0;
$total_loose              = isset($total_loose) ? (float)$total_loose : 0;
$total_distinct_medicines = isset($total_distinct_medicines) ? (int)$total_distinct_medicines : 0;
$total_expired_value      = isset($total_expired_value) ? (float)$total_expired_value : 0;
$alldata                  = isset($alldata) ? $alldata : array();
$total_records            = isset($total_records) ? (int)$total_records : count($alldata);
$page                     = isset($page) ? (int)$page : 1;
$per_page                 = isset($per_page) ? (int)$per_page : 25;
$total_pages              = isset($total_pages) ? (int)$total_pages : 1;
$start_record             = isset($start_record) ? (int)$start_record : 0;
$end_record               = isset($end_record) ? (int)$end_record : count($alldata);
?>

<!-- KPI Summary Cards -->
<div class="row" style="margin-left: -8px; margin-right: -8px;">
    <!-- Expired Batches -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #ef4444;">
            <div class="kpi-icon" style="background: #fee2e2; color: #dc2626;">
                <i class="fa fa-ban"></i>
            </div>
            <div>
                <div class="kpi-title">Expired Batches</div>
                <div class="kpi-value text-danger" style="color: #dc2626 !important;">
                    <?= number_format($total_batches); ?>
                </div>
                <small style="font-size: 11px; color: #64748b;"><?= number_format($total_distinct_medicines); ?> distinct medicines</small>
            </div>
        </div>
    </div>

    <!-- Expired Strips in Stock -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #f97316;">
            <div class="kpi-icon" style="background: #ffedd5; color: #ea580c;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title">Expired Strips in Stock</div>
                <div class="kpi-value" style="color: #ea580c !important;">
                    <?= number_format($total_strips, 2); ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">Physical strips to write off</small>
            </div>
        </div>
    </div>

    <!-- Expired Loose Units -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #06b6d4;">
            <div class="kpi-icon" style="background: #cffafe; color: #0891b2;">
                <i class="fa fa-flask"></i>
            </div>
            <div>
                <div class="kpi-title">Expired Loose in Stock</div>
                <div class="kpi-value text-info" style="color: #0891b2 !important;">
                    <?= number_format($total_loose, 2); ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">Loose units to dispose</small>
            </div>
        </div>
    </div>

    <!-- Total Expired Valuation Loss -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #8b5cf6;">
            <div class="kpi-icon" style="background: #ede9fe; color: #7c3aed;">
                <i class="fa fa-inr"></i>
            </div>
            <div>
                <div class="kpi-title">Estimated Expired Loss</div>
                <div class="kpi-value" style="color: #7c3aed !important;">
                    &#8377; <?= number_format($total_expired_value, 2); ?>
                </div>
                <small style="font-size: 11px; color: #64748b;">Retail MRP write-off value</small>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fa fa-list text-danger"></i> Expired Batches in Stock
            <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px; margin-left: 6px;">
                Showing <?= $start_record ?> to <?= $end_record ?> of <?= number_format($total_records); ?> <?= ($total_records === 1) ? 'batch' : 'batches'; ?>
            </span>
            <span style="font-size: 12px; color: #dc2626; font-weight: 600; margin-left: 10px;">
                (Immediate quarantine / disposal / return required)
            </span>
        </div>
        <div class="no-print" style="font-size: 12px; color: #64748b;">
            Page <?= $page ?> of <?= $total_pages ?>
        </div>
    </div>

    <div class="table-responsive" style="margin: 0;">
        <table class="table table-bordered table-striped table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">#</th>
                    <th style="min-width: 180px;">Medicine Name</th>
                    <th style="min-width: 140px;">Manufacturer</th>
                    <th style="width: 100px; text-align: center;">Batch #</th>
                    <th style="width: 95px; text-align: center;">Purchase Date</th>
                    <th style="width: 125px; text-align: center;">Expiry Date</th>
                    <th style="width: 100px; text-align: right;">Expired Strips</th>
                    <th style="width: 95px; text-align: right;">Expired Loose</th>
                    <th style="width: 95px; text-align: right;">MRP (&#8377;)</th>
                    <th style="width: 115px; text-align: right;">Expired Value (&#8377;)</th>
                    <th style="width: 100px; text-align: center;">Storage / Rack</th>
                    <th class="no-print" style="width: 75px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alldata)) : ?>
                    <?php
                    $counter = $start_record;
                    $page_strips = 0;
                    $page_loose  = 0;
                    $page_val    = 0;
                    foreach ($alldata as $item) :
                        $months_ago = isset($item['months_ago']) ? (int)$item['months_ago'] : 0;
                        if ($months_ago <= 0) {
                            $badge_bg = '#ef4444';
                            $badge_text = 'Expired this month';
                        } else {
                            $badge_bg = '#b91c1c';
                            $badge_text = 'Expired ' . $months_ago . ' mo ago';
                        }
                        $strip_val = (float)$item['left_strip'];
                        $loose_val = (float)$item['left_loose'];
                        $mrp_val   = (float)$item['purchase_mrp'];
                        $val_amt   = isset($item['expired_value']) ? (float)$item['expired_value'] : 0;

                        $page_strips += $strip_val;
                        $page_loose  += $loose_val;
                        $page_val    += $val_amt;
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $counter++; ?></td>
                            <td>
                                <strong style="color: #0f172a; font-size: 13px;"><?= htmlspecialchars($item['medicine_name']); ?></strong>
                                <?php if (!empty($item['medicine_category'])) : ?>
                                    <span class="badge" style="background: #f1f5f9; color: #475569; font-weight: 500; font-size: 10px; margin-left: 4px;">
                                        <?= htmlspecialchars($item['medicine_category']); ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="color: #475569;">
                                <?= !empty($item['medicine_manufacturer']) ? htmlspecialchars($item['medicine_manufacturer']) : '<span style="color:#94a3b8;">-</span>'; ?>
                            </td>
                            <td style="text-align: center;">
                                <code style="background: #fee2e2; color: #dc2626; padding: 2px 6px; border-radius: 4px; font-weight: 600;">
                                    <?= htmlspecialchars($item['purchase_batch']); ?>
                                </code>
                            </td>
                            <td style="text-align: center; color: #475569;">
                                <?= !empty($item['purchase_date']) ? date('d-m-Y', strtotime($item['purchase_date'])) : '<span style="color:#94a3b8;">-</span>'; ?>
                            </td>
                            <td style="text-align: center;">
                                <div style="font-weight: 700; color: #dc2626; font-size: 12.5px;"><?= htmlspecialchars($item['formatted_expiry']); ?></div>
                                <span class="badge" style="background-color: <?= $badge_bg ?>; color: #ffffff; font-size: 10px; padding: 2px 7px; border-radius: 10px;">
                                    <?= $badge_text ?>
                                </span>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #dc2626; font-size: 13px;">
                                <?= number_format($strip_val, 2); ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #dc2626; font-size: 13px;">
                                <?= number_format($loose_val, 2); ?>
                            </td>
                            <td style="text-align: right; color: #334155;">
                                &#8377; <?= number_format($mrp_val, 2); ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #dc2626; font-size: 13px;">
                                &#8377; <?= number_format($val_amt, 2); ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if (!empty($item['medicine_storage'])) : ?>
                                    <span class="label label-default" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-weight: 600;">
                                        <?= htmlspecialchars($item['medicine_storage']); ?>
                                    </span>
                                <?php else : ?>
                                    <span style="color: #94a3b8;">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="no-print" style="text-align: center;">
                                <a href="<?= console_url('medicine_stock/fast_update/' . $item['medicine_id']); ?>"
                                    target="_blank"
                                    class="btn btn-xs btn-default"
                                    title="Update Stock / Medicine Details"
                                    style="border-color: #cbd5e1; color: #2563eb; font-weight: 600;">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="12" style="text-align: center; padding: 45px 20px;">
                            <div style="max-width: 450px; margin: 0 auto; color: #64748b;">
                                <i class="fa fa-check-circle" style="font-size: 44px; color: #10b981; margin-bottom: 12px; display: inline-block;"></i>
                                <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">No Expired Medicines in Active Stock</h4>
                                <p style="font-size: 12px; margin: 0 0 14px 0; line-height: 1.5;">
                                    There are currently no expired medicines with positive remaining stock matching your filter criteria. All active stocks are within validity!
                                </p>
                                <button type="button" onclick="$('#btn_reset_filter').click();" class="btn btn-default btn-sm" style="border-radius: 4px; border-color: #cbd5e1;">
                                    <i class="fa fa-refresh"></i> Clear Filters
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($alldata)) : ?>
                <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right; font-weight: 700; text-transform: uppercase; font-size: 12px;">Grand Total (All <?= number_format($total_records) ?> Expired Batches):</td>
                        <td style="text-align: right; font-weight: 700; color: #dc2626; font-size: 13px;">
                            <?= number_format($total_strips, 2); ?>
                        </td>
                        <td style="text-align: right; font-weight: 700; color: #dc2626; font-size: 13px;">
                            <?= number_format($total_loose, 2); ?>
                        </td>
                        <td style="text-align: right;">-</td>
                        <td style="text-align: right; font-weight: 700; color: #dc2626; font-size: 13px;">
                            &#8377; <?= number_format($total_expired_value, 2); ?>
                        </td>
                        <td colspan="2" class="no-print"></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>

    <!-- Pagination Controls (Always at the bottom of the table card) -->
    <div id="expired_pagination" class="no-print" style="padding: 12px 18px; border-top: 1px solid #e2e8f0; background: #fafbfc; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div style="font-size: 12px; color: #64748b; font-weight: 500;">
            <?php if ($total_records > 0): ?>
                Showing <strong style="color: #0f172a;"><?= $start_record ?></strong> to <strong style="color: #0f172a;"><?= $end_record ?></strong> of <strong style="color: #0f172a;"><?= number_format($total_records) ?></strong> expired <?= ($total_records === 1) ? 'batch' : 'batches' ?>
                <?php if ($total_pages > 1): ?>
                    <span style="color: #94a3b8; margin-left: 4px;">(Page <?= $page ?> of <?= $total_pages ?>)</span>
                <?php endif; ?>
            <?php else: ?>
                Showing <strong style="color: #0f172a;">0</strong> records
            <?php endif; ?>
        </div>

        <?php if ($total_pages > 1): ?>
            <div>
                <ul class="pagination pagination-sm" style="margin: 0;">
                    <!-- First Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="1" title="First Page">&laquo; First</a>
                    </li>
                    <!-- Prev Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="<?= max(1, $page - 1) ?>" title="Previous Page">&lsaquo; Prev</a>
                    </li>

                    <!-- Page Numbers -->
                    <?php
                    $start_p = max(1, $page - 2);
                    $end_p   = min($total_pages, $page + 2);
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
</div>