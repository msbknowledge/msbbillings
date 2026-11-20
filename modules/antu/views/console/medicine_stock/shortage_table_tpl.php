<?php
$total_shortage_items   = isset($total_shortage_items) ? $total_shortage_items : 0;
$total_out_of_stock     = isset($total_out_of_stock) ? $total_out_of_stock : 0;
$total_critical_low     = isset($total_critical_low) ? $total_critical_low : 0;
$total_remaining_strips = isset($total_remaining_strips) ? $total_remaining_strips : 0;
$total_remaining_loose  = isset($total_remaining_loose) ? $total_remaining_loose : 0;
$threshold              = isset($threshold) ? $threshold : 2;
$alldata                = isset($alldata) ? $alldata : array();
$total_records          = isset($total_records) ? $total_records : count($alldata);
$page                   = isset($page) ? (int)$page : 1;
$per_page               = isset($per_page) ? (int)$per_page : 25;
$total_pages            = isset($total_pages) ? (int)$total_pages : 1;
$start_record           = isset($start_record) ? (int)$start_record : 1;
$end_record             = isset($end_record) ? (int)$end_record : count($alldata);
?>

<!-- KPI Summary Cards -->
<div class="row" style="margin-left: -8px; margin-right: -8px;">
    <!-- Total Shortage Items -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #f59e0b;">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div>
                <div class="kpi-title">Shortage Items</div>
                <div class="kpi-value text-warning" style="color: #d97706 !important;">
                    <?= number_format($total_shortage_items); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Out of Stock -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #ef4444;">
            <div class="kpi-icon" style="background: #fee2e2; color: #dc2626;">
                <i class="fa fa-times-circle"></i>
            </div>
            <div>
                <div class="kpi-title">Out of Stock (≤ 0)</div>
                <div class="kpi-value text-danger" style="color: #dc2626 !important;">
                    <?= number_format($total_out_of_stock); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Critical Low Stock -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #f97316;">
            <div class="kpi-icon" style="background: #ffedd5; color: #ea580c;">
                <i class="fa fa-battery-quarter"></i>
            </div>
            <div>
                <div class="kpi-title">Critical Low (1-<?= (int)$threshold ?> Strips)</div>
                <div class="kpi-value" style="color: #ea580c !important;">
                    <?= number_format($total_critical_low); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Remaining Strips -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #3b82f6;">
            <div class="kpi-icon" style="background: #dbeafe; color: #2563eb;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title">Remaining Strips</div>
                <div class="kpi-value text-primary" style="color: #2563eb !important;">
                    <?= number_format($total_remaining_strips, 2); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fa fa-list text-primary"></i> Shortage & Low Stock Medicine List
            <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px; margin-left: 6px;">
                <?= count($alldata); ?> <?= count($alldata) === 1 ? 'item' : 'items'; ?>
            </span>
            <span style="font-size: 12px; color: #64748b; font-weight: normal; margin-left: 10px;">
                (Stock threshold: &le; <?= (int)$threshold ?> strips)
            </span>
        </div>
        <div class="no-print" style="font-size: 12px; color: #64748b;">
            Prioritized by lowest remaining stock
        </div>
    </div>

    <div class="table-responsive" style="margin: 0;">
        <table class="table table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">#</th>
                    <th>Medicine Name</th>
                    <th>Manufacturer</th>
                    <th style="text-align: center;">Unit / Pack</th>
                    <th style="text-align: right;">Current Stock (Strips)</th>
                    <th style="text-align: right;">Current Stock (Loose)</th>
                    <th style="text-align: center;">Stock Status</th>
                    <th style="text-align: center;">Storage / Rack</th>
                    <th class="no-print" style="width: 80px; text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($alldata)) : ?>
                    <?php
                    $counter = $start_record;
                    foreach ($alldata as $item) :
                        $left_strip = floatval($item['left_strip']);
                        if ($left_strip <= 0) {
                            $badge_bg = '#ef4444';
                            $badge_text = 'Out of Stock';
                            $stock_color = '#dc2626';
                        } elseif ($left_strip <= 1) {
                            $badge_bg = '#f97316';
                            $badge_text = 'Critical (≤1)';
                            $stock_color = '#ea580c';
                        } else {
                            $badge_bg = '#f59e0b';
                            $badge_text = 'Low Stock';
                            $stock_color = '#d97706';
                        }
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
                            <td style="text-align: center; color: #475569; font-weight: 600;">
                                <?= !empty($item['medicine_unit']) ? htmlspecialchars($item['medicine_unit']) : '10'; ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: <?= $stock_color ?>; font-size: 13px;">
                                <?= number_format($item['left_strip'], 2); ?>
                            </td>
                            <td style="text-align: right; font-weight: 700; color: #0f172a;">
                                <?= number_format($item['left_loose'], 2); ?>
                            </td>
                            <td style="text-align: center;">
                                <span class="badge" style="background-color: <?= $badge_bg ?>; color: #ffffff; font-size: 10px; padding: 2px 7px; border-radius: 10px;">
                                    <?= $badge_text ?>
                                </span>
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
                        <td colspan="9" style="text-align: center; padding: 45px 20px;">
                            <div style="max-width: 450px; margin: 0 auto; color: #64748b;">
                                <i class="fa fa-check-circle" style="font-size: 44px; color: #10b981; margin-bottom: 12px; display: inline-block;"></i>
                                <h4 style="font-size: 15px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">No Stock Shortages Found</h4>
                                <p style="font-size: 12px; margin: 0; line-height: 1.5;">
                                    No medicines were found with stock &le; <?= (int)$threshold ?> strips. All current inventory levels are sufficient!
                                </p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if (!empty($alldata)) : ?>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: 700; text-transform: uppercase; font-size: 12px;">Total Remaining Shortage Stock:</td>
                        <td style="text-align: right; font-weight: 700; color: #2563eb; font-size: 13px;">
                            <?= number_format($total_remaining_strips, 2); ?>
                        </td>
                        <td style="text-align: right; font-weight: 700; color: #0891b2; font-size: 13px;">
                            <?= number_format($total_remaining_loose, 2); ?>
                        </td>
                        <td colspan="3" class="no-print"></td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>

    <!-- Pagination Controls -->
    <?php if (!empty($total_pages) && $total_pages > 1) : ?>
        <div id="shortage_pagination" class="no-print" style="padding: 12px 16px; border-top: 1px solid #e2e8f0; background: #fafbfc; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div style="font-size: 12px; color: #64748b; font-weight: 500;">
                Showing <strong style="color: #0f172a;"><?= $start_record ?></strong> to <strong style="color: #0f172a;"><?= $end_record ?></strong> of <strong style="color: #0f172a;"><?= number_format($total_records) ?></strong> shortage items
            </div>
            <div>
                <ul class="pagination pagination-sm" style="margin: 0;">
                    <!-- First Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="1" title="First Page">&laquo;</a>
                    </li>
                    <!-- Prev Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="<?= max(1, $page - 1) ?>" title="Previous Page">&lsaquo;</a>
                    </li>

                    <!-- Page Numbers -->
                    <?php
                    $start_p = max(1, $page - 2);
                    $end_p   = min($total_pages, $page + 2);
                    if ($start_p > 1) {
                        echo '<li><a href="#" class="page-link" data-page="1">1</a></li>';
                        if ($start_p > 2) {
                            echo '<li class="disabled"><span>...</span></li>';
                        }
                    }
                    for ($p = $start_p; $p <= $end_p; $p++) {
                        $active = ($p == $page) ? 'class="active"' : '';
                        echo '<li ' . $active . '><a href="#" class="page-link" data-page="' . $p . '">' . $p . '</a></li>';
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
                        <a href="#" class="page-link" data-page="<?= min($total_pages, $page + 1) ?>" title="Next Page">&rsaquo;</a>
                    </li>
                    <!-- Last Page -->
                    <li class="<?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a href="#" class="page-link" data-page="<?= $total_pages ?>" title="Last Page">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
    <?php elseif (!empty($total_records)) : ?>
        <div class="no-print" style="padding: 10px 16px; border-top: 1px solid #e2e8f0; background: #fafbfc; font-size: 12px; color: #64748b;">
            Showing all <strong style="color: #0f172a;"><?= number_format($total_records) ?></strong> <?= ($total_records === 1) ? 'item' : 'items' ?>
        </div>
    <?php endif; ?>
</div>
