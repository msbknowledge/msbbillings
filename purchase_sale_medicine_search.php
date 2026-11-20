<?php
ob_start();
header("Content-Type: text/html; charset=UTF-8");
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once __DIR__ . '/node_db.php';

$medicine_unit = 10;
$purchase_total = 0;
$purchase_free_total = 0;
$sale_total = 0;
$sale_loose_qty = 0;
$medicine_stock_total = 0;
$medicine_stock_loose_total = 0;
$return_purchase_total = 0;
$return_sale_total = 0;
$responce = array();
$final = array();
$fromStrip = 0;
$looseLeft = 0;

$med_id = (!empty($_GET['term']) && is_numeric($_GET['term'])) ? intval($_GET['term']) : 0;

if ($med_id <= 0 && !empty($_GET['term'])) {
    try {
        $db_host_lookup = (defined('DB_SERVER') && DB_SERVER === 'localhost') ? '127.0.0.1' : (defined('DB_SERVER') ? DB_SERVER : '127.0.0.1');
        $conn_lookup = new PDO("mysql:host=" . $db_host_lookup . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ));
        $term_str = trim($_GET['term']);
        $n_stmt = $conn_lookup->prepare('SELECT medicine_id FROM medicines WHERE medicine_name = :n LIMIT 1');
        $n_stmt->execute(array('n' => $term_str));
        if ($n_row = $n_stmt->fetch()) {
            $med_id = intval($n_row['medicine_id']);
        } else {
            $l_stmt = $conn_lookup->prepare('SELECT medicine_id FROM medicines WHERE medicine_name LIKE :n LIMIT 1');
            $l_stmt->execute(array('n' => '%' . $term_str . '%'));
            if ($l_row = $l_stmt->fetch()) {
                $med_id = intval($l_row['medicine_id']);
            }
        }
    } catch (Exception $e) {}
}

if ($med_id > 0) {
    try {
        $db_host = (defined('DB_SERVER') && DB_SERVER === 'localhost') ? '127.0.0.1' : (defined('DB_SERVER') ? DB_SERVER : '127.0.0.1');
        $conn = new PDO("mysql:host=" . $db_host . ";port=3306;dbname=" . DB_NAME, DB_USER, DB_PASSWORD, array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ));

        // 1. Fetch medicine unit
        $medicine_stmt = $conn->prepare('SELECT medicine_unit FROM medicines WHERE medicine_id = :id LIMIT 1');
        $medicine_stmt->execute(array('id' => $med_id));
        if ($m_row = $medicine_stmt->fetch()) {
            if (!empty($m_row['medicine_unit']) && is_numeric($m_row['medicine_unit'])) {
                $medicine_unit = floatval($m_row['medicine_unit']);
            }
        }
        if ($medicine_unit <= 0) {
            $medicine_unit = 10;
        }

        // 2. Fetch purchases (LEFT JOIN suppliers)
        $purchase_stmt = $conn->prepare('SELECT purchases.*, suppliers.supplier_name FROM purchases LEFT JOIN suppliers ON purchases.purchase_supplier = suppliers.supplier_ID WHERE purchases.purchase_medicine_id = :id ORDER BY purchases.purchase_date DESC, purchases.purchase_id DESC');
        $purchase_stmt->execute(array('id' => $med_id));
        while ($row = $purchase_stmt->fetch()) {
            $purchase_total += floatval($row['purchase_quantity']);
            $purchase_free_total += floatval($row['purchase_free_quantity']);
            $responce[] = array('data' => $row);
        }

        // 3. Fetch sales (LEFT JOIN customers so walk-in sales without customer_ID are included)
        $sale_stmt = $conn->prepare('SELECT sales.*, customers.customer_name FROM sales LEFT JOIN customers ON sales.sale_customer = customers.customer_ID WHERE sales.sale_medicine_id = :id ORDER BY sales.sale_date DESC, sales.sale_id DESC');
        $sale_stmt->execute(array('id' => $med_id));
        while ($row = $sale_stmt->fetch()) {
            $sale_total += floatval($row['sale_strip_quantity']);
            $sale_loose_qty += floatval($row['sale_loose_quantity']);
            $responce[] = array('data' => $row);
        }

        // 4. Fetch initial stock / adjustments
        $stock_stmt = $conn->prepare('SELECT * FROM medicine_stocks WHERE medicine_stock_medicine = :id ORDER BY medicine_stock_date DESC, medicine_stock_id DESC');
        $stock_stmt->execute(array('id' => $med_id));
        while ($row = $stock_stmt->fetch()) {
            $medicine_stock_total += floatval($row['medicine_strip_stock']);
            $medicine_stock_loose_total += floatval($row['medicine_loose_stock']);
            $responce[] = array('data' => $row);
        }

        // 5. Fetch return purchases (LEFT JOIN suppliers)
        $ret_pur_stmt = $conn->prepare('SELECT return_purchases.*, suppliers.supplier_name FROM return_purchases LEFT JOIN suppliers ON return_purchases.return_purchase_supplier = suppliers.supplier_ID WHERE return_purchases.return_purchase_medicine_id = :id ORDER BY return_purchases.return_purchase_date DESC, return_purchases.return_purchase_id DESC');
        $ret_pur_stmt->execute(array('id' => $med_id));
        while ($row = $ret_pur_stmt->fetch()) {
            $return_purchase_total += floatval($row['return_purchase_strip']);
            $responce[] = array('data' => $row);
        }

        // 6. Fetch return sales (LEFT JOIN customers)
        $ret_sale_stmt = $conn->prepare('SELECT returns_sales.*, customers.customer_name FROM returns_sales LEFT JOIN customers ON returns_sales.return_sale_customer = customers.customer_ID WHERE returns_sales.return_sale_medicine_id = :id ORDER BY returns_sales.return_sale_date DESC, returns_sales.return_sale_id DESC');
        $ret_sale_stmt->execute(array('id' => $med_id));
        while ($row = $ret_sale_stmt->fetch()) {
            $return_sale_total += floatval($row['return_sale_strip']);
            $responce[] = array('data' => $row);
        }

    } catch (PDOException $e) {
        echo '<div class="alert alert-danger" style="margin: 15px 0;"><i class="fa fa-exclamation-triangle"></i> Database Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }

    if (!empty($responce)) {
        foreach ($responce as $val) {
            $d = isset($val['data']) ? $val['data'] : array();
            $t = 0;
            if (!empty($d['purchase_date'])) {
                $t = strtotime($d['purchase_date']);
                $final[$t][] = array_merge($d, array('type' => 'purchase'));
            } elseif (!empty($d['sale_date'])) {
                $t = strtotime($d['sale_date']);
                $final[$t][] = array_merge($d, array('type' => 'sale'));
            } elseif (!empty($d['return_purchase_date'])) {
                $t = strtotime($d['return_purchase_date']);
                $final[$t][] = array_merge($d, array('type' => 'return_purchase'));
            } elseif (!empty($d['return_sale_date'])) {
                $t = strtotime($d['return_sale_date']);
                $final[$t][] = array_merge($d, array('type' => 'return_sale'));
            } else {
                $t = !empty($d['medicine_stock_date']) ? strtotime($d['medicine_stock_date']) : 0;
                $final[$t][] = array_merge($d, array('type' => 'update'));
            }
        }
        krsort($final);
    }
}

$flat_transactions = array();
if (!empty($final)) {
    foreach ($final as $timestamp => $records) {
        foreach ($records as $val) {
            $flat_transactions[] = $val;
        }
    }
}

// Balance loose stock and strip conversions
$diff_loose = floatval($medicine_stock_loose_total) - floatval($sale_loose_qty);
if ($medicine_unit > 0) {
    if ($diff_loose < 0) {
        $strips_needed = (int)ceil(abs($diff_loose) / $medicine_unit);
        $fromStrip = -$strips_needed;
        $looseLeft = ($strips_needed * $medicine_unit) + $diff_loose;
    } else {
        $extra_strips = (int)floor($diff_loose / $medicine_unit);
        $fromStrip = $extra_strips;
        $looseLeft = fmod($diff_loose, $medicine_unit);
    }
} else {
    $looseLeft = $diff_loose;
}

$net_strip_stock = ($purchase_total + $purchase_free_total - $sale_total + $medicine_stock_total - $return_purchase_total + $return_sale_total + $fromStrip);
$net_loose_stock = $looseLeft;

$total_records = count($flat_transactions);
$page = (!empty($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
$per_page = (!empty($_GET['per_page']) && is_numeric($_GET['per_page']) && $_GET['per_page'] > 0) ? intval($_GET['per_page']) : 50;

$total_pages = ($per_page > 0) ? (int)ceil($total_records / $per_page) : 1;
if ($total_pages < 1) $total_pages = 1;
if ($page > $total_pages) {
    $page = $total_pages;
}

$offset = ($page - 1) * $per_page;
$paged_transactions = ($per_page > 0) ? array_slice($flat_transactions, $offset, $per_page) : $flat_transactions;
$start_record = ($total_records > 0) ? ($offset + 1) : 0;
$end_record   = ($per_page > 0) ? min($offset + $per_page, $total_records) : $total_records;
?>

<!-- Medicine Stock Breakdown KPIs -->
<div class="row" style="margin-left: -8px; margin-right: -8px; margin-top: 15px;">
    <!-- Purchases -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #10b981; margin-bottom: 14px;">
            <div class="kpi-icon" style="background: #d1fae5; color: #059669;">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <div class="kpi-title">Total Purchases</div>
                <div class="kpi-value text-success" style="color: #059669 !important; font-size: 16px;">
                    <?= number_format($purchase_total); ?> <span style="font-size: 11px; color: #64748b;">strips</span>
                </div>
                <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                    + <?= number_format($purchase_free_total); ?> free strips
                </div>
            </div>
        </div>
    </div>

    <!-- Sales -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #3b82f6; margin-bottom: 14px;">
            <div class="kpi-icon" style="background: #dbeafe; color: #2563eb;">
                <i class="fa fa-tag"></i>
            </div>
            <div>
                <div class="kpi-title">Total Sold</div>
                <div class="kpi-value text-primary" style="color: #2563eb !important; font-size: 16px;">
                    <?= number_format($sale_total); ?> <span style="font-size: 11px; color: #64748b;">strips</span>
                </div>
                <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                    + <?= number_format($sale_loose_qty); ?> loose units
                </div>
            </div>
        </div>
    </div>

    <!-- Adjustments & Returns -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #f59e0b; margin-bottom: 14px;">
            <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                <i class="fa fa-exchange"></i>
            </div>
            <div>
                <div class="kpi-title">Returns & Adjustments</div>
                <div class="kpi-value text-warning" style="color: #d97706 !important; font-size: 14px;">
                    <?= number_format($return_purchase_total); ?> <span style="font-size: 10px; color: #64748b;">Ret Pur</span> | 
                    <?= number_format($return_sale_total); ?> <span style="font-size: 10px; color: #64748b;">Ret Sale</span>
                </div>
                <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                    Adj: <?= number_format($medicine_stock_total); ?> strips / <?= number_format($medicine_stock_loose_total); ?> loose
                </div>
            </div>
        </div>
    </div>

    <!-- Current Stock Balance -->
    <div class="col-md-3 col-sm-6" style="padding-left: 8px; padding-right: 8px;">
        <div class="kpi-card" style="border-left: 4px solid #8b5cf6; background: #faf5ff; margin-bottom: 14px;">
            <div class="kpi-icon" style="background: #ede9fe; color: #7c3aed;">
                <i class="fa fa-cubes"></i>
            </div>
            <div>
                <div class="kpi-title" style="color: #6b21a8;">Current Net Stock</div>
                <div class="kpi-value" style="color: #7c3aed !important; font-size: 17px;">
                    <?= number_format($net_strip_stock); ?> <span style="font-size: 12px; color: #6b21a8;">strips</span>
                </div>
                <div style="font-size: 11px; color: #7c3aed; margin-top: 2px; font-weight: 600;">
                    + <?= number_format($net_loose_stock); ?> loose units
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction History Table Card -->
<div class="table-card" style="margin-top: 6px;">
    <div class="table-card-header">
        <div class="table-card-title">
            <i class="fa fa-history text-primary"></i> Stock Movement & Transaction Timeline
        </div>
        <div class="no-print" style="font-size: 12px; color: #64748b;">
            Chronological audit trail of purchases, sales, returns, and adjustments
        </div>
    </div>

    <div class="table-responsive" style="margin: 0;">
        <table class="table table-hover gst-table" style="margin-bottom: 0;">
            <thead>
                <tr>
                    <th style="width: 45px; text-align: center;">#</th>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Transaction Type</th>
                    <th>Supplier / Customer</th>
                    <th style="text-align: center;">Quantity Details</th>
                    <th style="text-align: center;">Batch #</th>
                    <th style="text-align: center;">Expiry</th>
                    <th style="text-align: right;">MRP (₹)</th>
                    <th style="text-align: right;">Rate (₹)</th>
                    <th style="text-align: center;">Invoice / Ref #</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($paged_transactions)) : ?>
                    <?php
                    $i = $start_record;
                    foreach ($paged_transactions as $val) :
                        $type = isset($val['type']) ? $val['type'] : 'update';
                        $date = '-';
                        $party = '-';
                        $party_role = '';
                        $qty_str = '';
                        $batch = '-';
                        $expiry = '-';
                        $mrp = '-';
                        $rate = '-';
                        $invoice = '-';

                        if ($type == 'purchase') {
                            $badge_class = 'label-success';
                            $badge_style = 'background: #10b981; color: #fff;';
                            $badge_icon  = 'fa-arrow-down';
                            $type_label  = 'Purchase';
                            $date        = !empty($val['purchase_date']) ? date('d-m-Y', strtotime($val['purchase_date'])) : '-';
                            $party       = !empty($val['supplier_name']) ? htmlspecialchars($val['supplier_name']) : 'Supplier Ref #' . htmlspecialchars($val['purchase_supplier']);
                            $party_role  = 'Supplier';
                            $qty_str     = '<strong>' . htmlspecialchars($val['purchase_quantity']) . '</strong> strips' . (!empty($val['purchase_free_quantity']) ? ' <span class="text-muted">(+' . htmlspecialchars($val['purchase_free_quantity']) . ' free)</span>' : '');
                            $batch       = !empty($val['purchase_batch']) ? htmlspecialchars($val['purchase_batch']) : '-';
                            $expiry      = (!empty($val['purchase_expire_month']) && !empty($val['purchase_expire_year'])) ? htmlspecialchars($val['purchase_expire_month']) . '/' . htmlspecialchars($val['purchase_expire_year']) : '-';
                            $mrp         = !empty($val['purchase_mrp']) ? number_format((float)$val['purchase_mrp'], 2) : '-';
                            $rate        = !empty($val['purchase_rate']) ? number_format((float)$val['purchase_rate'], 2) : '-';
                            $invoice     = !empty($val['purchase_invoice']) ? htmlspecialchars($val['purchase_invoice']) . (!empty($val['purchase_entry_number']) ? ' (' . htmlspecialchars($val['purchase_entry_number']) . ')' : '') : '-';
                        } elseif ($type == 'sale') {
                            $badge_class = 'label-primary';
                            $badge_style = 'background: #3b82f6; color: #fff;';
                            $badge_icon  = 'fa-arrow-up';
                            $type_label  = 'Sale';
                            $date        = !empty($val['sale_date']) ? date('d-m-Y', strtotime($val['sale_date'])) : '-';
                            $party       = !empty($val['customer_name']) ? htmlspecialchars($val['customer_name']) : 'Retail Customer';
                            $party_role  = 'Customer';
                            $qty_str     = '<strong>' . htmlspecialchars($val['sale_strip_quantity']) . '</strong> strips' . (!empty($val['sale_loose_quantity']) ? ' <span class="text-muted">(+' . htmlspecialchars($val['sale_loose_quantity']) . ' loose)</span>' : '');
                            $batch       = !empty($val['sale_batch']) ? htmlspecialchars($val['sale_batch']) : '-';
                            $expiry      = (!empty($val['sale_expire_month']) && !empty($val['sale_expire_year'])) ? htmlspecialchars($val['sale_expire_month']) . '/' . htmlspecialchars($val['sale_expire_year']) : '-';
                            $mrp         = !empty($val['sale_mrp']) ? number_format((float)$val['sale_mrp'], 2) : '-';
                            $rate        = !empty($val['sale_rate']) ? number_format((float)$val['sale_rate'], 2) : '-';
                            $invoice     = !empty($val['sale_invoice']) ? htmlspecialchars($val['sale_invoice']) : '-';
                        } elseif ($type == 'return_purchase') {
                            $badge_class = 'label-warning';
                            $badge_style = 'background: #f59e0b; color: #fff;';
                            $badge_icon  = 'fa-reply';
                            $type_label  = 'Return Purchase';
                            $date        = !empty($val['return_purchase_date']) ? date('d-m-Y', strtotime($val['return_purchase_date'])) : '-';
                            $party       = !empty($val['supplier_name']) ? htmlspecialchars($val['supplier_name']) : 'Supplier Ref #' . htmlspecialchars($val['return_purchase_supplier']);
                            $party_role  = 'Supplier Return';
                            $qty_str     = '<strong>' . htmlspecialchars($val['return_purchase_strip']) . '</strong> strips';
                            $batch       = !empty($val['return_purchase_Batch']) ? htmlspecialchars($val['return_purchase_Batch']) : '-';
                            $expiry      = (!empty($val['return_purchase_expire_month']) && !empty($val['return_purchase_expire_year'])) ? htmlspecialchars($val['return_purchase_expire_month']) . '/' . htmlspecialchars($val['return_purchase_expire_year']) : '-';
                            $mrp         = !empty($val['return_purchase_mrp']) ? number_format((float)$val['return_purchase_mrp'], 2) : '-';
                            $invoice     = !empty($val['return_purchase_entry_number']) ? htmlspecialchars($val['return_purchase_entry_number']) : '-';
                        } elseif ($type == 'return_sale') {
                            $badge_class = 'label-info';
                            $badge_style = 'background: #06b6d4; color: #fff;';
                            $badge_icon  = 'fa-share';
                            $type_label  = 'Return Sale';
                            $date        = !empty($val['return_sale_date']) ? date('d-m-Y', strtotime($val['return_sale_date'])) : '-';
                            $party       = !empty($val['customer_name']) ? htmlspecialchars($val['customer_name']) : 'Retail Customer';
                            $party_role  = 'Customer Return';
                            $qty_str     = '<strong>' . htmlspecialchars($val['return_sale_strip']) . '</strong> strips';
                            $batch       = !empty($val['return_sale_Batch']) ? htmlspecialchars($val['return_sale_Batch']) : '-';
                            $expiry      = (!empty($val['return_sale_expire_month']) && !empty($val['return_sale_expire_year'])) ? htmlspecialchars($val['return_sale_expire_month']) . '/' . htmlspecialchars($val['return_sale_expire_year']) : '-';
                            $mrp         = !empty($val['return_sale_mrp']) ? number_format((float)$val['return_sale_mrp'], 2) : '-';
                            $rate        = !empty($val['return_sale_total']) ? number_format((float)$val['return_sale_total'], 2) : '-';
                            $invoice     = !empty($val['return_sale_invoice']) ? htmlspecialchars($val['return_sale_invoice']) : '-';
                        } else {
                            $badge_class = 'label-default';
                            $badge_style = 'background: #8b5cf6; color: #fff;';
                            $badge_icon  = 'fa-sliders';
                            $type_label  = 'Stock Adjustment';
                            $date        = !empty($val['medicine_stock_date']) ? date('d-m-Y', strtotime($val['medicine_stock_date'])) : '-';
                            $party       = 'System Adjustment';
                            $party_role  = 'Adjustment';
                            $qty_str     = '<strong>' . (floatval($val['medicine_strip_stock'])) . '</strong> strips (+' . floatval($val['medicine_loose_stock']) . ' loose)';
                            $batch       = !empty($val['medicine_stock_batch']) ? htmlspecialchars($val['medicine_stock_batch']) : '-';
                            $expiry      = (!empty($val['medicine_expire_month']) && !empty($val['medicine_expire_year'])) ? htmlspecialchars($val['medicine_expire_month']) . '/' . htmlspecialchars($val['medicine_expire_year']) : '-';
                            $mrp         = !empty($val['medicine_mrp']) ? number_format((float)$val['medicine_mrp'], 2) : '-';
                        }
                    ?>
                        <tr>
                            <td style="text-align: center; color: #64748b; font-weight: 600;"><?= $i++; ?></td>
                            <td style="text-align: center; font-weight: 600; color: #1e293b;"><?= $date; ?></td>
                            <td style="text-align: center;">
                                <span class="badge" style="<?= $badge_style ?> font-size: 10px; padding: 3px 8px; border-radius: 10px;">
                                    <i class="fa <?= $badge_icon ?>"></i> <?= $type_label ?>
                                </span>
                            </td>
                            <td>
                                <strong style="color: #0f172a;"><?= $party; ?></strong>
                                <?php if (!empty($party_role)) : ?>
                                    <span style="font-size: 10px; color: #64748b; display: block;"><?= $party_role; ?></span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center; font-size: 12px; color: #0f172a;">
                                <?= $qty_str; ?>
                            </td>
                            <td style="text-align: center;">
                                <code style="background: #f1f5f9; color: #0f172a; padding: 2px 6px; border-radius: 4px; font-weight: 600;">
                                    <?= $batch; ?>
                                </code>
                            </td>
                            <td style="text-align: center; color: #475569; font-weight: 600;">
                                <?= $expiry; ?>
                            </td>
                            <td style="text-align: right; color: #475569; font-weight: 600;">
                                <?= $mrp !== '-' ? '₹' . $mrp : '-'; ?>
                            </td>
                            <td style="text-align: right; color: #475569; font-weight: 600;">
                                <?= $rate !== '-' ? '₹' . $rate : '-'; ?>
                            </td>
                            <td style="text-align: center; color: #475569;">
                                <?= $invoice; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 40px 20px;">
                            <div style="max-width: 400px; margin: 0 auto; color: #64748b;">
                                <i class="fa fa-info-circle" style="font-size: 36px; color: #3b82f6; margin-bottom: 10px; display: inline-block;"></i>
                                <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0;">No Transaction Records Found</h4>
                                <p style="font-size: 12px; margin: 0;">No purchase, sale, adjustment, or return transactions have been recorded for this medicine yet.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- History Pagination Controls at Bottom -->
    <div id="history_pagination" class="no-print" style="padding: 12px 16px; border-top: 1px solid #e2e8f0; background: #fafbfc; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
        <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <div style="font-size: 12px; color: #64748b; font-weight: 500;">
                Showing <strong style="color: #0f172a;"><?= $start_record ?></strong> to <strong style="color: #0f172a;"><?= $end_record ?></strong> of <strong style="color: #0f172a;"><?= number_format($total_records) ?></strong> transactions (Page <strong><?= $page ?></strong> of <strong><?= $total_pages ?></strong>)
            </div>
            <div style="display: inline-flex; align-items: center; gap: 6px;">
                <label style="font-size: 11px; color: #64748b; margin: 0; font-weight: 600;">Show:</label>
                <select class="form-control input-sm history-per-page-select" style="width: 75px; height: 28px; padding: 2px 6px; font-size: 12px; border-radius: 4px; border-color: #cbd5e1; display: inline-block;">
                    <option value="25" <?= ($per_page == 25) ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= ($per_page == 50) ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= ($per_page == 100) ? 'selected' : '' ?>>100</option>
                    <option value="250" <?= ($per_page == 250) ? 'selected' : '' ?>>250</option>
                </select>
            </div>
        </div>

        <?php if ($total_pages > 1) : ?>
            <div>
                <ul class="pagination pagination-sm" style="margin: 0;">
                    <!-- First Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="history-page-link" data-page="1" title="First Page">&laquo; First</a>
                    </li>
                    <!-- Prev Page -->
                    <li class="<?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a href="#" class="history-page-link" data-page="<?= max(1, $page - 1) ?>" title="Previous Page">&lsaquo; Prev</a>
                    </li>

                    <!-- Page Numbers -->
                    <?php
                    $start_p = max(1, $page - 2);
                    $end_p   = min($total_pages, $page + 2);
                    if ($start_p > 1) {
                        echo '<li><a href="#" class="history-page-link" data-page="1">1</a></li>';
                        if ($start_p > 2) {
                            echo '<li class="disabled"><span>...</span></li>';
                        }
                    }
                    for ($p = $start_p; $p <= $end_p; $p++) {
                        $active = ($p == $page) ? 'class="active"' : '';
                        echo '<li ' . $active . '><a href="#" class="history-page-link" data-page="' . $p . '">' . $p . '</a></li>';
                    }
                    if ($end_p < $total_pages) {
                        if ($end_p < $total_pages - 1) {
                            echo '<li class="disabled"><span>...</span></li>';
                        }
                        echo '<li><a href="#" class="history-page-link" data-page="' . $total_pages . '">' . $total_pages . '</a></li>';
                    }
                    ?>

                    <!-- Next Page -->
                    <li class="<?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a href="#" class="history-page-link" data-page="<?= min($total_pages, $page + 1) ?>" title="Next Page">Next &rsaquo;</a>
                    </li>
                    <!-- Last Page -->
                    <li class="<?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                        <a href="#" class="history-page-link" data-page="<?= $total_pages ?>" title="Last Page">Last &raquo;</a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$data = ob_get_contents();
ob_end_clean();
echo $data;
?>
