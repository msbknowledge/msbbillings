<?php
/**
 * Modern Responsive Sale Invoice Detail View with Purchase Intelligence
 * Module: Antu / Medical POS
 */
if (empty($data) || !is_array($data)) {
    echo '<div class="alert alert-danger">Invoice details not found or invalid invoice identifier.</div>';
    return;
}

$first = $data[0];
$encoded_invoice = base64_encode($first['sale_invoice']);

// Totals calculation
$total_sold_taxable = 0;
$total_cgst = 0;
$total_sgst = 0;
$total_sold_amount = 0;
$total_purchase_cost = 0;
$total_units_sold = 0;

$sold_items = array();
$return_items = array();

foreach ($data as $row) {
    if (!empty($row['sale_return'])) {
        $return_items[] = $row;
    } else {
        $sold_items[] = $row;
        $total_sold_taxable += (float)$row['sale_taxable'];
        $total_cgst += (float)$row['sale_cgst'];
        $total_sgst += (float)$row['sale_sgst'];
        $total_sold_amount += (float)$row['sale_total'];

        $strip_qty = (int)$row['sale_strip_quantity'];
        $loose_qty = (int)$row['sale_loose_quantity'];
        $total_units_sold += $strip_qty;

        // Calculate purchase cost if purchase info exists
        if (!empty($row['purchase']['purchase_rate'])) {
            $p_rate = (float)$row['purchase']['purchase_rate'];
            $line_p_cost = ($p_rate * $strip_qty);
            if (!empty($row['medicine_unit']) && $row['medicine_unit'] > 0 && $loose_qty > 0) {
                $line_p_cost += ($p_rate / $row['medicine_unit']) * $loose_qty;
            }
            $total_purchase_cost += $line_p_cost;
        }
    }
}

$gross_profit = $total_sold_amount - $total_purchase_cost;
$gross_margin_pct = ($total_sold_amount > 0 && $total_purchase_cost > 0) ? (($gross_profit / $total_sold_amount) * 100) : 0;

$saleTotalPayable = ($total_sold_amount + (float)$first['sale_total_previous_due']);
$grand_discount_pct = !empty($first['sale_grand_discount']) ? (float)$first['sale_grand_discount'] : 0;
$saleTotalDiscPayable = ($saleTotalPayable * $grand_discount_pct / 100);
$net_payable = $saleTotalPayable - $saleTotalDiscPayable;
$paid_amount = (float)$first['sale_total_paid'];
$current_due = round((float)$first['sale_total_previous_due'] - $paid_amount + $total_sold_amount - $saleTotalDiscPayable);
$is_paid = ($current_due <= 0);

if (!function_exists('invoice_num_to_words')) {
    function invoice_num_to_words($num) {
        $no = floor($num);
        $point = round($num - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            '0' => '', '1' => 'One', '2' => 'Two', '3' => 'Three', '4' => 'Four', '5' => 'Five',
            '6' => 'Six', '7' => 'Seven', '8' => 'Eight', '9' => 'Nine', '10' => 'Ten',
            '11' => 'Eleven', '12' => 'Twelve', '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen', '18' => 'Eighteen',
            '19' => 'Nineteen', '20' => 'Twenty', '30' => 'Thirty', '40' => 'Forty',
            '50' => 'Fifty', '60' => 'Sixty', '70' => 'Seventy', '80' => 'Eighty', '90' => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . " " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10] . " " . $words[$number % 10] . " " . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        return trim($result) . " Rupees Only";
    }
}
$amount_in_words = invoice_num_to_words(round($net_payable));
?>

<style>
/* Modern Scoped Styling for Sale Detail View */
.inv-detail-wrap {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #1e293b;
    margin-bottom: 40px;
}
.inv-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    margin-bottom: 24px;
    overflow: hidden;
}
.inv-card-header {
    padding: 16px 20px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}
.inv-card-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
}
.inv-card-body {
    padding: 20px;
}

/* Header Action Toolbar */
.inv-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 20px;
}
.inv-title-area h1 {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
    display: flex;
    align-items: center;
    gap: 12px;
}
.inv-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.btn-inv {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    font-size: 13.5px;
    font-weight: 600;
    border-radius: 8px;
    border: 1px solid transparent;
    cursor: pointer;
    text-decoration: none !important;
    transition: all 0.2s ease;
}
.btn-inv-primary { background: #10b981; color: #fff !important; }
.btn-inv-primary:hover { background: #059669; color: #fff !important; }
.btn-inv-dark { background: #0284c7; color: #fff !important; }
.btn-inv-dark:hover { background: #0369a1; color: #fff !important; }
.btn-inv-whatsapp { background: #25d366; color: #fff !important; }
.btn-inv-whatsapp:hover { background: #1eb956; color: #fff !important; }
.btn-inv-outline { background: #fff; color: #334155 !important; border-color: #cbd5e1; }
.btn-inv-outline:hover { background: #f1f5f9; color: #0f172a !important; }

/* Status Badges */
.badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.badge-paid { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
.badge-due { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
.badge-b2c { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }

/* 4-Column Meta Grid */
.inv-meta-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-bottom: 16px;
}
.meta-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 10px 12px;
    position: relative;
}
.meta-box-label {
    font-size: 10.5px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    margin-bottom: 3px;
    display: flex;
    align-items: center;
    gap: 5px;
}
.meta-box-value {
    font-size: 13.5px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.25;
}
.meta-box-sub {
    font-size: 10.5px;
    color: #64748b;
    margin-top: 2px;
    line-height: 1.3;
}

/* Purchase Intelligence Banner */
.profit-banner {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    color: #166534;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 14px 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);
}
.profit-stat {
    display: flex;
    flex-direction: column;
}
.profit-stat-label {
    font-size: 11px;
    font-weight: 700;
    color: #15803d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.profit-stat-val {
    font-size: 18px;
    font-weight: 800;
    color: #14532d;
}
.profit-stat-val.highlight {
    color: #047857;
}

/* Modern Items Table */
.inv-table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.inv-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
    text-align: left;
}
.inv-table thead th {
    background: linear-gradient(180deg, #f0f7ff 0%, #e0eefe 100%) !important;
    color: #1e40af !important;
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    padding: 6px 8px;
    border-top: 1px solid #cbd5e1;
    border-bottom: 2px solid #93c5fd;
    white-space: nowrap;
}
.inv-table tbody td {
    padding: 5px 8px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.inv-table tbody tr:hover {
    background-color: #f8fafc;
}
.purchase-pill {
    display: inline-block;
    padding: 2px 6px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 10.5px;
    color: #334155;
    line-height: 1.3;
}
.margin-badge {
    display: inline-block;
    padding: 1px 5px;
    border-radius: 3px;
    font-size: 10px;
    font-weight: 700;
    background: #dcfce7;
    color: #15803d;
}

/* Financial Summary Footer Grid */
.inv-footer-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 14px;
    margin-top: 14px;
}
.inv-summary-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
}
.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: 14px;
    color: #475569;
    border-bottom: 1px solid #e2e8f0;
}
.summary-row.total-row {
    font-size: 18px;
    font-weight: 800;
    color: #0f172a;
    border-bottom: 2px solid #0f172a;
    padding: 12px 0;
}

@media (max-width: 991px) {
    .inv-meta-grid { grid-template-columns: repeat(2, 1fr); }
    .inv-footer-grid { grid-template-columns: 1fr; }
}
@media (max-width: 576px) {
    .inv-meta-grid { grid-template-columns: 1fr; }
    .inv-toolbar { flex-direction: column; align-items: flex-start; }
    .inv-actions { width: 100%; }
    .btn-inv { flex: 1; justify-content: center; }
}

@media print {
    body { background: #fff !important; }
    .inv-toolbar .inv-actions,
    .main-sidebar, .main-header, .breadcrumb, footer {
        display: none !important;
    }
    .inv-card { border: none !important; box-shadow: none !important; }
}
</style>

<div class="inv-detail-wrap">

    <!-- Top Action Toolbar -->
    <div class="inv-toolbar">
        <div class="inv-title-area">
            <h1>
                Invoice: <?= htmlspecialchars($first['sale_invoice']) ?>
                <?php if ($is_paid): ?>
                    <span class="badge-pill badge-paid">✔ Fully Paid</span>
                <?php else: ?>
                    <span class="badge-pill badge-due">⚠ Due: ₹<?= number_format($current_due, 2) ?></span>
                <?php endif; ?>
                <span class="badge-pill badge-b2c"><?= !empty($first['customer_gst']) ? 'GST B2B' : 'Retail B2C' ?></span>
            </h1>
            <div style="font-size: 13px; color: #64748b;">
                Sale Date: <strong><?= date('d-F-Y', strtotime($first['sale_date'])) ?></strong> &bull;
                Registered Cashier Shift: <strong><?= !empty($first['sale_paid_by']) ? htmlspecialchars($first['sale_paid_by']) : 'Cash' ?></strong>
            </div>
        </div>

        <div class="inv-actions">
            <a href="<?= console_url('sale/view_detail/' . $encoded_invoice . '/print') ?>" target="_blank" class="btn-inv btn-inv-primary">
                🖨️ Print Tax Invoice (A4)
            </a>
            <button onclick="window.print()" class="btn-inv btn-inv-dark">
                🧾 Thermal Receipt
            </button>
            <?php if (!empty($first['customer_contact'])): 
                $wa_msg = urlencode("Hello " . $first['customer_name'] . ", here are your invoice details for Bill #" . $first['sale_invoice'] . ": Total Amount: ₹" . number_format($net_payable, 2) . ". Thank you for your business!");
            ?>
            <a href="https://wa.me/91<?= preg_replace('/[^0-9]/', '', $first['customer_contact']) ?>?text=<?= $wa_msg ?>" target="_blank" class="btn-inv btn-inv-whatsapp">
                💬 WhatsApp Bill
            </a>
            <?php endif; ?>
            <a href="<?= console_url('sale') ?>" class="btn-inv btn-inv-outline">
                ⬅ Back to Sales
            </a>
        </div>
    </div>

    <!-- 4-Column Metadata Grid -->
    <div class="inv-meta-grid">
        <!-- Customer Info -->
        <div class="meta-box">
            <div class="meta-box-label">👤 Customer Details</div>
            <div class="meta-box-value"><?= htmlspecialchars($first['customer_name']) ?></div>
            <div class="meta-box-sub">
                <?php if (!empty($first['customer_contact'])): ?>
                    📞 <?= htmlspecialchars($first['customer_contact']) ?><br>
                <?php endif; ?>
                <?php if (!empty($first['customer_address'])): ?>
                    📍 <?= htmlspecialchars($first['customer_address']) ?><br>
                <?php endif; ?>
                <?php if (!empty($first['customer_gst'])): ?>
                    <strong>GSTIN:</strong> <?= htmlspecialchars($first['customer_gst']) ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Doctor / Prescriber -->
        <div class="meta-box">
            <div class="meta-box-label">🩺 Prescribing Doctor</div>
            <div class="meta-box-value"><?= !empty($first['doctor_name']) ? htmlspecialchars($first['doctor_name']) : 'Over The Counter (OTC)' ?></div>
            <div class="meta-box-sub">
                <?php if (!empty($first['doctor_address'])): ?>
                    📍 <?= htmlspecialchars($first['doctor_address']) ?>
                <?php else: ?>
                    Direct Counter Dispensation
                <?php endif; ?>
            </div>
        </div>

        <!-- Billing Info -->
        <div class="meta-box">
            <div class="meta-box-label">📄 Invoice Reference</div>
            <div class="meta-box-value">#<?= htmlspecialchars($first['sale_invoice']) ?></div>
            <div class="meta-box-sub">
                Date: <strong><?= date('d-m-Y', strtotime($first['sale_date'])) ?></strong><br>
                Time: <?= !empty($first['sale_timestamp']) ? date('h:i A', strtotime($first['sale_timestamp'])) : 'Morning' ?><br>
                Payment: <span style="font-weight: 700; color: #0284c7;"><?= htmlspecialchars($first['sale_paid_by']) ?></span>
            </div>
        </div>

        <!-- Due / Payment Status -->
        <div class="meta-box" style="background: #f8fafc;">
            <div class="meta-box-label">💰 Payment & Dues</div>
            <div class="meta-box-value" style="color: #10b981;">₹<?= number_format($paid_amount, 2) ?></div>
            <div class="meta-box-sub">
                Total Bill: ₹<?= number_format($net_payable, 2) ?><br>
                Previous Due: ₹<?= number_format((float)$first['sale_total_previous_due'], 2) ?><br>
                Current Balance: <strong style="color: <?= $current_due > 0 ? '#dc2626' : '#16a34a' ?>;">₹<?= number_format($current_due, 2) ?></strong>
            </div>
        </div>
    </div>

    <!-- Purchase Intelligence & Profit Margin Banner -->
    <?php if ($total_purchase_cost > 0): ?>
    <div class="profit-banner">
        <div class="profit-stat">
            <span class="profit-stat-label">Total Sale Value</span>
            <span class="profit-stat-val">₹<?= number_format($total_sold_amount, 2) ?></span>
        </div>
        <div class="profit-stat">
            <span class="profit-stat-label">Purchase Cost (COGS)</span>
            <span class="profit-stat-val">₹<?= number_format($total_purchase_cost, 2) ?></span>
        </div>
        <div class="profit-stat">
            <span class="profit-stat-label">Estimated Gross Profit</span>
            <span class="profit-stat-val highlight">₹<?= number_format($gross_profit, 2) ?></span>
        </div>
        <div class="profit-stat">
            <span class="profit-stat-label">Gross Margin</span>
            <span class="profit-stat-val highlight">+<?= number_format($gross_margin_pct, 1) ?>%</span>
        </div>
        <div class="profit-stat">
            <span class="profit-stat-label">GST Tax Collected</span>
            <span class="profit-stat-val">₹<?= number_format($total_cgst + $total_sgst, 2) ?></span>
        </div>
    </div>
    <?php endif; ?>

    <!-- Sold Items Table with Purchase Details -->
    <div class="inv-card">
        <div class="inv-card-header">
            <h3>📦 Sold Items & Associated Purchase Batches (<?= count($sold_items) ?>)</h3>
            <span style="font-size: 13px; color: #64748b;">Includes linked Supplier, Cost Price & Unit Margins</span>
        </div>

        <div class="inv-table-responsive">
            <table class="inv-table">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">#</th>
                        <th>Product / Medicine</th>
                        <th>Batch & Expiry</th>
                        <th style="text-align: center;">Sold Qty</th>
                        <th style="text-align: right;">MRP</th>
                        <th style="text-align: right;">Sale Rate</th>
                        <th style="text-align: right;">Taxable</th>
                        <th style="text-align: center;">GST %</th>
                        <th style="text-align: right;">Net Sale Total</th>
                        <th style="background: #f1f5f9; border-left: 2px solid #cbd5e1;">💼 Linked Purchase Batch & Margin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sr = 0;
                    foreach ($sold_items as $item): 
                        $sr++;
                        $p_info = isset($item['purchase']) ? $item['purchase'] : null;
                        $has_p = !empty($p_info);
                        $p_rate = $has_p ? (float)$p_info['purchase_rate'] : 0;
                        $s_rate = (float)$item['sale_rate'];
                        $unit_diff = $s_rate - $p_rate;
                        $unit_margin_pct = ($p_rate > 0) ? (($unit_diff / $p_rate) * 100) : 0;
                    ?>
                    <tr>
                        <td style="text-align: center; color: #94a3b8; font-weight: 700;"><?= $sr ?></td>
                        <td>
                            <div style="font-weight: 700; color: #0f172a; font-size: 14px;">
                                <?= htmlspecialchars($item['medicine_name']) ?>
                            </div>
                            <div style="font-size: 11.5px; color: #64748b;">
                                Mfg: <?= !empty($item['medicine_manufacturer']) ? htmlspecialchars($item['medicine_manufacturer']) : 'N/A' ?>
                                &bull; HSN: <?= !empty($item['medicine_hsn']) ? htmlspecialchars($item['medicine_hsn']) : '-' ?>
                            </div>
                        </td>
                        <td>
                            <span class="purchase-pill" style="font-weight: 700;">
                                #<?= htmlspecialchars($item['sale_batch']) ?>
                            </span>
                            <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                                Exp: <?= htmlspecialchars($item['sale_expire_month']) ?>/<?= htmlspecialchars($item['sale_expire_year']) ?>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span style="font-weight: 700; color: #0f172a;"><?= (int)$item['sale_strip_quantity'] ?></span> Strip
                            <?php if (!empty($item['sale_loose_quantity']) && (int)$item['sale_loose_quantity'] > 0): ?>
                                <br><span style="font-size: 11.5px; color: #64748b;">+ <?= (int)$item['sale_loose_quantity'] ?> Loose</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right; color: #64748b;">₹<?= number_format((float)$item['sale_mrp'], 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #0f172a;">
                            ₹<?= number_format($s_rate, 2) ?>
                            <?php if (!empty($item['sale_discount_percent']) && (float)$item['sale_discount_percent'] > 0): ?>
                                <div style="font-size: 11px; color: #16a34a; font-weight: 600;">-<?= $item['sale_discount_percent'] ?>%</div>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">₹<?= number_format((float)$item['sale_taxable'], 2) ?></td>
                        <td style="text-align: center;">
                            <span style="font-weight: 600; font-size: 12px; color: #475569;">
                                <?= (float)$item['sale_cgst_percent'] + (float)$item['sale_sgst_percent'] ?>%
                            </span>
                        </td>
                        <td style="text-align: right; font-weight: 800; color: #0f172a; font-size: 14.5px;">
                            ₹<?= number_format((float)$item['sale_total'], 2) ?>
                        </td>

                        <!-- Purchase Intelligence Column -->
                        <td style="background: #f8fafc; border-left: 2px solid #e2e8f0;">
                            <?php if ($has_p): ?>
                                <div style="display: flex; align-items: baseline; justify-content: space-between; gap: 8px;">
                                    <div>
                                        <span style="font-size: 11px; color: #64748b;">Cost Rate:</span>
                                        <strong style="color: #0f172a; font-size: 13.5px;">₹<?= number_format($p_rate, 2) ?></strong>
                                    </div>
                                    <span class="margin-badge">
                                        <?= ($unit_margin_pct >= 0) ? '+' : '' ?><?= number_format($unit_margin_pct, 1) ?>% Profit
                                    </span>
                                </div>
                                <div style="font-size: 11.5px; color: #475569; margin-top: 4px;">
                                    <strong>Supplier:</strong> <?= !empty($p_info['supplier_name']) ? htmlspecialchars($p_info['supplier_name']) : 'Direct Supplier' ?>
                                </div>
                                <div style="font-size: 11px; color: #64748b;">
                                    Purchase Inv: <strong>#<?= htmlspecialchars($p_info['purchase_invoice']) ?></strong>
                                    (<?= date('d-m-Y', strtotime($p_info['purchase_date'])) ?>)
                                </div>
                            <?php else: ?>
                                <span style="font-size: 12px; color: #94a3b8; font-style: italic;">Opening stock / manual entry</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Return Items Section (if any) -->
    <?php if (!empty($return_items)): ?>
    <div class="inv-card" style="border-left: 4px solid #ef4444;">
        <div class="inv-card-header" style="background: #fff5f5;">
            <h3 style="color: #b91c1c;">🔄 Returned Items Against This Invoice (<?= count($return_items) ?>)</h3>
        </div>
        <div class="inv-table-responsive">
            <table class="inv-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Return Date</th>
                        <th>Product</th>
                        <th>Batch</th>
                        <th>Return Qty</th>
                        <th style="text-align: right;">Rate</th>
                        <th style="text-align: right;">CGST</th>
                        <th style="text-align: right;">SGST</th>
                        <th style="text-align: right;">Refund Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rsr = 0;
                    $ret_total = 0;
                    foreach ($return_items as $ritem): 
                        $rsr++;
                        $ret_total += (float)$ritem['sale_total'];
                    ?>
                    <tr>
                        <td><?= $rsr ?></td>
                        <td><?= !empty($ritem['sale_return_date']) ? date('d-m-Y', strtotime($ritem['sale_return_date'])) : '-' ?></td>
                        <td><strong><?= htmlspecialchars($ritem['medicine_name']) ?></strong></td>
                        <td>#<?= htmlspecialchars($ritem['sale_batch']) ?></td>
                        <td><?= (int)$ritem['sale_quantity'] ?></td>
                        <td style="text-align: right;">₹<?= number_format((float)$ritem['sale_rate'], 2) ?></td>
                        <td style="text-align: right;">₹<?= number_format((float)$ritem['sale_cgst'], 2) ?></td>
                        <td style="text-align: right;">₹<?= number_format((float)$ritem['sale_sgst'], 2) ?></td>
                        <td style="text-align: right; font-weight: 700; color: #b91c1c;">-₹<?= number_format((float)$ritem['sale_total'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- Financial Breakdown & Totals -->
    <div class="inv-footer-grid">
        <!-- Notes & Amount in Words -->
        <div class="inv-summary-card">
            <h4 style="margin: 0 0 12px; font-size: 15px; font-weight: 700; color: #0f172a;">
                📝 Terms & Payment Notes
            </h4>
            <p style="font-size: 13.5px; color: #475569; line-height: 1.6; margin-bottom: 16px;">
                <?= !empty($first['sale_note']) ? nl2br(htmlspecialchars($first['sale_note'])) : 'No special notes recorded. Regular sales terms apply.' ?>
            </p>

            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; margin-top: 14px;">
                <span style="font-size: 11.5px; color: #64748b; text-transform: uppercase; font-weight: 700;">Amount in Words:</span>
                <div style="font-weight: 700; color: #0f172a; font-size: 14px; margin-top: 2px;">
                    <?= $amount_in_words ?>
                </div>
            </div>
        </div>

        <!-- Calculated Totals Box -->
        <div class="inv-summary-card">
            <div class="summary-row">
                <span>Total Items / Units</span>
                <strong><?= count($sold_items) ?> items (<?= $total_units_sold ?> units)</strong>
            </div>
            <div class="summary-row">
                <span>Taxable Amount</span>
                <span>₹<?= number_format($total_sold_taxable, 2) ?></span>
            </div>
            <div class="summary-row">
                <span>CGST</span>
                <span>₹<?= number_format($total_cgst, 2) ?></span>
            </div>
            <div class="summary-row">
                <span>SGST</span>
                <span>₹<?= number_format($total_sgst, 2) ?></span>
            </div>
            <?php if ($grand_discount_pct > 0): ?>
            <div class="summary-row" style="color: #16a34a;">
                <span>Special Discount (<?= $grand_discount_pct ?>%)</span>
                <span>-₹<?= number_format($saleTotalDiscPayable, 2) ?></span>
            </div>
            <?php endif; ?>
            <div class="summary-row total-row">
                <span>Net Payable Bill</span>
                <span style="color: #059669;">₹<?= number_format($net_payable, 2) ?></span>
            </div>
            <div class="summary-row">
                <span>Previous Due Balance</span>
                <span>₹<?= number_format((float)$first['sale_total_previous_due'], 2) ?></span>
            </div>
            <div class="summary-row" style="background: #ecfdf5; padding: 8px 10px; border-radius: 6px; font-weight: 700; color: #047857;">
                <span>Amount Paid (<?= htmlspecialchars($first['sale_paid_by']) ?>)</span>
                <span>₹<?= number_format($paid_amount, 2) ?></span>
            </div>
            <div class="summary-row" style="border: none; padding-top: 10px; font-size: 15px; font-weight: 800; color: <?= $current_due > 0 ? '#b91c1c' : '#15803d' ?>;">
                <span>Remaining Due</span>
                <span>₹<?= number_format($current_due, 2) ?></span>
            </div>
        </div>
    </div>

</div>