<?php
/**
 * Modern Responsive Purchase Invoice Detail View
 * Module: Antu / Medical POS
 * Location: modules/antu/views/console/purchase/view_detail.php
 */

if (empty($data) || !is_array($data)) {
    echo '<div class="alert alert-danger" style="margin:20px; border-radius:8px; padding:15px; background:#fee2e2; border:1px solid #fca5a5; color:#991b1b;">
        <i class="fa fa-exclamation-triangle"></i> Purchase invoice details not found or invalid entry number.
    </div>';
    return;
}

$first = $data[0];
$entry_number = !empty($first['purchase_entry_number']) ? $first['purchase_entry_number'] : '';
$encoded_entry = base64_encode($entry_number);
$invoice_number = !empty($first['purchase_invoice']) ? $first['purchase_invoice'] : 'N/A';
$purchase_date = !empty($first['purchase_date']) && $first['purchase_date'] != '0000-00-00' ? date('d M Y', strtotime($first['purchase_date'])) : 'N/A';
$raw_date = !empty($first['purchase_date']) ? $first['purchase_date'] : '';

// Totals calculation
$total_taxable = 0;
$total_cgst = 0;
$total_sgst = 0;
$total_purchased_amount = 0;
$total_items_count = 0;
$total_qty_count = 0;
$total_free_qty = 0;

$purchased_items = array();
$return_items = array();

// Tax tier aggregation
$gst_tiers = array();

foreach ($data as $row) {
    if (!empty($row['purchase_return']) && $row['purchase_return'] == 1) {
        $return_items[] = $row;
    } else {
        $purchased_items[] = $row;
        $total_items_count++;
        
        $qty = (int)$row['purchase_quantity'];
        $free_qty = !empty($row['purchase_free_quantity']) ? (int)$row['purchase_free_quantity'] : 0;
        $taxable = (float)$row['purchase_taxable'];
        $cgst = (float)$row['purchase_cgst'];
        $sgst = (float)$row['purchase_sgst'];
        $line_total = (float)$row['purchase_total'];

        $total_qty_count += $qty;
        $total_free_qty += $free_qty;
        $total_taxable += $taxable;
        $total_cgst += $cgst;
        $total_sgst += $sgst;
        $total_purchased_amount += $line_total;

        // GST tier grouping
        $cgst_pct = (float)$row['purchase_cgst_percent'];
        $sgst_pct = (float)$row['purchase_sgst_percent'];
        $total_gst_pct = $cgst_pct + $sgst_pct;
        $rate_key = number_format($total_gst_pct, 2) . '%';

        if (!isset($gst_tiers[$rate_key])) {
            $gst_tiers[$rate_key] = array(
                'rate' => $total_gst_pct,
                'cgst_rate' => $cgst_pct,
                'sgst_rate' => $sgst_pct,
                'taxable' => 0,
                'cgst' => 0,
                'sgst' => 0,
                'total_gst' => 0
            );
        }
        $gst_tiers[$rate_key]['taxable'] += $taxable;
        $gst_tiers[$rate_key]['cgst'] += $cgst;
        $gst_tiers[$rate_key]['sgst'] += $sgst;
        $gst_tiers[$rate_key]['total_gst'] += ($cgst + $sgst);
    }
}

$total_gst = $total_cgst + $total_sgst;
$round_total = round($total_purchased_amount);
$round_diff = $round_total - $total_purchased_amount;

// Return totals
$return_taxable = 0;
$return_cgst = 0;
$return_sgst = 0;
$return_total = 0;
$return_qty = 0;
foreach ($return_items as $rrow) {
    $return_taxable += (float)$rrow['purchase_taxable'];
    $return_cgst += (float)$rrow['purchase_cgst'];
    $return_sgst += (float)$rrow['purchase_sgst'];
    $return_total += (float)$rrow['purchase_total'];
    $return_qty += (int)$rrow['purchase_quantity'];
}

// Convert amount to words in Indian numbering system
if (!function_exists('purchase_num_to_words')) {
    function purchase_num_to_words($num) {
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
$amount_in_words = purchase_num_to_words($round_total);
?>

<style>
/* Modern Scoped Styling for Purchase Detail View */
.pv-wrapper {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #1e293b;
    margin: 15px auto 40px auto;
    max-width: 1300px;
}

/* Card Styling */
.pv-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
    margin-bottom: 24px;
    overflow: hidden;
    transition: box-shadow 0.2s ease;
}
.pv-card:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
.pv-card-header {
    padding: 16px 20px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}
.pv-card-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
}
.pv-card-body {
    padding: 20px;
}

/* Top Action Toolbar */
.pv-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e2e8f0;
}
.pv-title-box h1 {
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 6px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: -0.02em;
}
.pv-title-box .pv-subtitle {
    font-size: 13px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.pv-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.pv-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    font-weight: 600;
    padding: 9px 16px;
    border-radius: 8px;
    border: 1px solid transparent;
    cursor: pointer;
    text-decoration: none !important;
    transition: all 0.2s ease;
}
.pv-btn-primary {
    background: #2563eb;
    color: #ffffff !important;
}
.pv-btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
}
.pv-btn-outline {
    background: #ffffff;
    border-color: #cbd5e1;
    color: #334155 !important;
}
.pv-btn-outline:hover {
    background: #f1f5f9;
    border-color: #94a3b8;
    color: #0f172a !important;
}
.pv-btn-warning {
    background: #fef3c7;
    border-color: #fde68a;
    color: #92400e !important;
}
.pv-btn-warning:hover {
    background: #fde68a;
}

/* Badges & Tags */
.pv-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 8px;
    font-size: 11px;
    font-weight: 700;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}
.pv-badge-blue { background: #dbeafe; color: #1e40af; }
.pv-badge-green { background: #dcfce7; color: #166534; }
.pv-badge-amber { background: #fef3c7; color: #92400e; }
.pv-badge-red { background: #fee2e2; color: #991b1b; }
.pv-badge-purple { background: #f3e8ff; color: #6b21a8; }
.pv-badge-gray { background: #f1f5f9; color: #475569; }

/* 4-Column Metadata Grid */
.pv-grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media (max-width: 1024px) {
    .pv-grid-4 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .pv-grid-4 { grid-template-columns: 1fr; }
}
.pv-stat-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px;
    position: relative;
    overflow: hidden;
}
.pv-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
}
.pv-stat-card.blue::before { background: #3b82f6; }
.pv-stat-card.emerald::before { background: #10b981; }
.pv-stat-card.purple::before { background: #8b5cf6; }
.pv-stat-card.amber::before { background: #f59e0b; }

.pv-stat-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #64748b;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.pv-stat-value {
    font-size: 19px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
    margin-bottom: 4px;
}
.pv-stat-sub {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Modern Data Table */
.pv-table-wrap {
    overflow-x: auto;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}
.pv-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
    text-align: left;
    background: #ffffff;
}
.pv-table th {
    background: #f8fafc;
    color: #475569;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 12px 14px;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}
.pv-table td {
    padding: 12px 14px;
    border-bottom: 1px solid #edf2f7;
    vertical-align: middle;
    color: #334155;
}
.pv-table tr:hover td {
    background-color: #f8fafc;
}
.pv-table .num-col {
    text-align: right;
    font-variant-numeric: tabular-nums;
}
.pv-table .center-col {
    text-align: center;
}
.pv-table tfoot td {
    background: #f8fafc;
    font-weight: 700;
    border-top: 2px solid #cbd5e1;
    color: #0f172a;
}

/* Medicine Title & Meta Tags */
.pv-item-name {
    font-weight: 700;
    color: #0f172a;
    font-size: 14px;
    display: block;
    margin-bottom: 3px;
}
.pv-item-meta {
    font-size: 11px;
    color: #64748b;
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    align-items: center;
}
.pv-mono {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 12px;
    font-weight: 600;
}

/* Bottom Split Layout */
.pv-bottom-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 20px;
    margin-top: 24px;
}
@media (max-width: 900px) {
    .pv-bottom-grid { grid-template-columns: 1fr; }
}

/* GST Tier Breakdown Table */
.pv-gst-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    margin-top: 10px;
}
.pv-gst-table th {
    background: #f1f5f9;
    color: #475569;
    padding: 8px 10px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 10px;
    border-bottom: 1px solid #e2e8f0;
}
.pv-gst-table td {
    padding: 8px 10px;
    border-bottom: 1px solid #f1f5f9;
}

/* Financial Total Breakdown Card */
.pv-summary-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
}
.pv-sum-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    font-size: 13px;
    color: #475569;
    border-bottom: 1px dashed #e2e8f0;
}
.pv-sum-row:last-child {
    border-bottom: none;
}
.pv-sum-row.highlight {
    color: #0f172a;
    font-weight: 700;
}
.pv-sum-total {
    margin-top: 14px;
    padding-top: 14px;
    border-top: 2px solid #0f172a;
    display: flex;
    justify-content: space-between;
    align-items: baseline;
}
.pv-sum-total .label {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
}
.pv-sum-total .amount {
    font-size: 26px;
    font-weight: 900;
    color: #1e3a8a;
    letter-spacing: -0.02em;
}

/* Signatures & Notes */
.pv-sign-box {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px dashed #cbd5e1;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
.pv-sign-item {
    text-align: center;
    width: 200px;
}
.pv-sign-line {
    border-top: 1px solid #94a3b8;
    margin-bottom: 6px;
}
.pv-sign-title {
    font-size: 11px;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
}

/* Print Specific Optimizations */
@media print {
    body {
        background: #ffffff !important;
        color: #000000 !important;
        font-size: 11pt;
    }
    .header, .footer, .sidebar, .main-header, .main-sidebar, .pv-actions, .pv-toolbar .pv-btn {
        display: none !important;
    }
    .content-wrapper, .wrapper, .main-content {
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }
    .pv-wrapper {
        margin: 0 !important;
        max-width: 100% !important;
    }
    .pv-card {
        border: 1px solid #000000 !important;
        box-shadow: none !important;
        break-inside: avoid;
    }
    .pv-table th {
        background: #eeeeee !important;
        color: #000000 !important;
        border: 1px solid #000000 !important;
    }
    .pv-table td {
        border: 1px solid #cccccc !important;
        color: #000000 !important;
    }
    .pv-stat-card {
        border: 1px solid #cccccc !important;
    }
}
</style>

<div class="pv-wrapper">
    <!-- Action Toolbar & Header -->
    <div class="pv-toolbar">
        <div class="pv-title-box">
            <h1>
                <i class="fa fa-file-text-o" style="color: #2563eb;"></i>
                Purchase Invoice Details
                <span class="pv-badge pv-badge-blue"><?= htmlspecialchars($invoice_number) ?></span>
                <span class="pv-badge pv-badge-green"><i class="fa fa-check-circle"></i> Stocked</span>
            </h1>
            <div class="pv-subtitle">
                <span><i class="fa fa-hashtag"></i> System Entry #<strong><?= htmlspecialchars($entry_number) ?></strong></span>
                <span>&bull;</span>
                <span><i class="fa fa-calendar"></i> Purchase Date: <strong><?= htmlspecialchars($purchase_date) ?></strong></span>
                <span>&bull;</span>
                <span><i class="fa fa-building-o"></i> Supplier: <strong><?= htmlspecialchars(!empty($first['supplier_name']) ? $first['supplier_name'] : 'N/A') ?></strong></span>
            </div>
        </div>

        <div class="pv-actions">
            <button onclick="window.print();" class="pv-btn pv-btn-primary">
                <i class="fa fa-print"></i> Print Invoice
            </button>
            <a href="<?= site_url('console/purchase') ?>" class="pv-btn pv-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Purchases
            </a>
            <a href="<?= site_url('console/purchase/purchase_return/' . $encoded_entry) ?>" class="pv-btn pv-btn-warning">
                <i class="fa fa-reply"></i> Purchase Return
            </a>
        </div>
    </div>

    <!-- 4-Column Metadata Highlights -->
    <div class="pv-grid-4">
        <!-- Supplier Profile -->
        <div class="pv-stat-card blue">
            <div class="pv-stat-label">
                <span>Supplier / Vendor</span>
                <i class="fa fa-truck" style="color: #3b82f6;"></i>
            </div>
            <div class="pv-stat-value" style="font-size: 16px; margin-bottom: 6px;">
                <?= htmlspecialchars(!empty($first['supplier_name']) ? $first['supplier_name'] : 'Direct Purchase') ?>
            </div>
            <div class="pv-stat-sub">
                <i class="fa fa-id-card-o"></i> GSTIN: <strong><?= !empty($first['supplier_gst']) ? htmlspecialchars($first['supplier_gst']) : 'Unregistered' ?></strong>
            </div>
            <?php if (!empty($first['supplier_contact'])) { ?>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                <i class="fa fa-phone"></i> <?= htmlspecialchars($first['supplier_contact']) ?>
            </div>
            <?php } ?>
            <?php if (!empty($first['supplier_address'])) { ?>
            <div class="pv-stat-sub" style="margin-top: 3px; font-size: 11px;">
                <i class="fa fa-map-marker"></i> <?= htmlspecialchars($first['supplier_address']) ?>
            </div>
            <?php } ?>
        </div>

        <!-- Purchase References -->
        <div class="pv-stat-card emerald">
            <div class="pv-stat-label">
                <span>Invoice & Dates</span>
                <i class="fa fa-receipt" style="color: #10b981;"></i>
            </div>
            <div class="pv-stat-value" style="font-size: 17px; margin-bottom: 6px;">
                <?= htmlspecialchars($invoice_number) ?>
            </div>
            <div class="pv-stat-sub">
                <i class="fa fa-calendar-check-o"></i> Date: <strong><?= htmlspecialchars($purchase_date) ?></strong>
            </div>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                <i class="fa fa-bookmark-o"></i> Entry ID: <strong><?= htmlspecialchars($entry_number) ?></strong>
            </div>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                <span class="pv-badge pv-badge-green" style="font-size: 10px;">Tax Invoice</span>
            </div>
        </div>

        <!-- Tax Intelligence -->
        <div class="pv-stat-card purple">
            <div class="pv-stat-label">
                <span>GST Breakdown</span>
                <i class="fa fa-shield" style="color: #8b5cf6;"></i>
            </div>
            <div class="pv-stat-value">
                ₹<?= number_format($total_gst, 2) ?>
            </div>
            <div class="pv-stat-sub">
                Taxable Base: <strong>₹<?= number_format($total_taxable, 2) ?></strong>
            </div>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                CGST: ₹<?= number_format($total_cgst, 2) ?> | SGST: ₹<?= number_format($total_sgst, 2) ?>
            </div>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                Effective Tax: <strong><?= ($total_taxable > 0) ? number_format(($total_gst / $total_taxable) * 100, 1) : '0.0' ?>%</strong>
            </div>
        </div>

        <!-- Net Total Payable -->
        <div class="pv-stat-card amber">
            <div class="pv-stat-label">
                <span>Net Purchase Value</span>
                <i class="fa fa-inr" style="color: #f59e0b;"></i>
            </div>
            <div class="pv-stat-value" style="color: #b45309;">
                ₹<?= number_format($round_total, 2) ?>
            </div>
            <div class="pv-stat-sub">
                Line Items: <strong><?= $total_items_count ?> items</strong>
            </div>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                Total Units: <strong><?= $total_qty_count ?></strong> <?php if ($total_free_qty > 0) { echo " (+{$total_free_qty} Free)"; } ?>
            </div>
            <div class="pv-stat-sub" style="margin-top: 3px;">
                Round off: <strong><?= ($round_diff >= 0 ? '+' : '') . number_format($round_diff, 2) ?></strong>
            </div>
        </div>
    </div>

    <!-- Main Purchased Items Card -->
    <div class="pv-card">
        <div class="pv-card-header">
            <h3>
                <i class="fa fa-list-ul" style="color: #2563eb;"></i>
                Purchased Medicines & Inventory Items
                <span class="pv-badge pv-badge-blue"><?= count($purchased_items) ?> Items</span>
            </h3>
            <span style="font-size: 12px; color: #64748b;">
                Values in INR (₹) including HSN & GST calculations
            </span>
        </div>
        <div class="pv-card-body" style="padding: 0;">
            <div class="pv-table-wrap">
                <table class="pv-table">
                    <thead>
                        <tr>
                            <th class="center-col" style="width: 40px;">#</th>
                            <th style="min-width: 220px;">Medicine / Product Details</th>
                            <th style="min-width: 100px;">Batch & Expiry</th>
                            <th class="center-col">Packing</th>
                            <th class="center-col">Billed Qty</th>
                            <th class="center-col">Free Qty</th>
                            <th class="num-col">MRP</th>
                            <th class="num-col">Rate</th>
                            <th class="center-col">Disc %</th>
                            <th class="center-col">Bonus %</th>
                            <th class="num-col">Taxable (₹)</th>
                            <th class="center-col">GST %</th>
                            <th class="num-col">CGST (₹)</th>
                            <th class="num-col">SGST (₹)</th>
                            <th class="num-col" style="min-width: 90px;">Total (₹)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 0;
                        foreach ($purchased_items as $item) { 
                            $counter++;
                            
                            // Expiry styling
                            $exp_m = !empty($item['purchase_expire_month']) ? str_pad($item['purchase_expire_month'], 2, '0', STR_PAD_LEFT) : '--';
                            $exp_y = !empty($item['purchase_expire_year']) ? $item['purchase_expire_year'] : '--';
                            $full_year = (strlen($exp_y) == 2) ? '20' . $exp_y : $exp_y;
                            
                            // Check expiry status if valid year
                            $is_expired = false;
                            $is_near_exp = false;
                            if (is_numeric($exp_m) && is_numeric($full_year)) {
                                $exp_timestamp = strtotime("$full_year-$exp_m-01 +1 month -1 day");
                                if ($exp_timestamp < time()) {
                                    $is_expired = true;
                                } elseif ($exp_timestamp < strtotime('+90 days')) {
                                    $is_near_exp = true;
                                }
                            }
                            
                            $pack_unit = !empty($item['purchase_unit']) ? $item['purchase_unit'] : (!empty($item['medicine_unit']) ? $item['medicine_unit'] : '1');
                            $cgst_p = (float)$item['purchase_cgst_percent'];
                            $sgst_p = (float)$item['purchase_sgst_percent'];
                            $tot_gst_p = $cgst_p + $sgst_p;
                        ?>
                        <tr>
                            <td class="center-col" style="color: #64748b; font-weight: 600;"><?= $counter ?></td>
                            <td>
                                <span class="pv-item-name"><?= htmlspecialchars(!empty($item['medicine_name']) ? $item['medicine_name'] : 'Unknown Item') ?></span>
                                <div class="pv-item-meta">
                                    <?php if (!empty($item['medicine_manufacturer'])) { ?>
                                        <span class="pv-badge pv-badge-gray"><i class="fa fa-industry"></i> <?= htmlspecialchars($item['medicine_manufacturer']) ?></span>
                                    <?php } ?>
                                    <?php if (!empty($item['medicine_hsn'])) { ?>
                                        <span class="pv-badge pv-badge-blue">HSN: <?= htmlspecialchars($item['medicine_hsn']) ?></span>
                                    <?php } ?>
                                    <?php if (!empty($item['medicine_category'])) { ?>
                                        <span class="pv-badge pv-badge-purple"><?= htmlspecialchars($item['medicine_category']) ?></span>
                                    <?php } ?>
                                    <?php if (!empty($item['medicine_schedule'])) { ?>
                                        <span class="pv-badge pv-badge-amber"><?= htmlspecialchars($item['medicine_schedule']) ?></span>
                                    <?php } ?>
                                    <?php if (!empty($item['medicine_storage'])) { ?>
                                        <span class="pv-badge pv-badge-gray"><i class="fa fa-archive"></i> <?= htmlspecialchars($item['medicine_storage']) ?></span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <div class="pv-mono" style="color: #0f172a;"><?= !empty($item['purchase_batch']) ? htmlspecialchars($item['purchase_batch']) : 'N/A' ?></div>
                                <div style="margin-top: 3px;">
                                    <?php if ($is_expired) { ?>
                                        <span class="pv-badge pv-badge-red" title="Batch Expired"><i class="fa fa-times-circle"></i> <?= $exp_m ?>/<?= $exp_y ?></span>
                                    <?php } elseif ($is_near_exp) { ?>
                                        <span class="pv-badge pv-badge-amber" title="Near Expiry"><i class="fa fa-clock-o"></i> <?= $exp_m ?>/<?= $exp_y ?></span>
                                    <?php } else { ?>
                                        <span class="pv-badge pv-badge-gray"><i class="fa fa-calendar-o"></i> <?= $exp_m ?>/<?= $exp_y ?></span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td class="center-col">
                                <span class="pv-badge pv-badge-gray"><?= htmlspecialchars($pack_unit) ?></span>
                            </td>
                            <td class="center-col" style="font-weight: 700; color: #0f172a;">
                                <?= (int)$item['purchase_quantity'] ?>
                            </td>
                            <td class="center-col">
                                <?php if (!empty($item['purchase_free_quantity']) && (int)$item['purchase_free_quantity'] > 0) { ?>
                                    <span class="pv-badge pv-badge-green">+<?= (int)$item['purchase_free_quantity'] ?> Free</span>
                                <?php } else { ?>
                                    <span style="color: #94a3b8;">0</span>
                                <?php } ?>
                            </td>
                            <td class="num-col" style="color: #64748b;">
                                <?= number_format((float)$item['purchase_mrp'], 2) ?>
                            </td>
                            <td class="num-col" style="font-weight: 600; color: #0f172a;">
                                <?= number_format((float)$item['purchase_rate'], 2) ?>
                            </td>
                            <td class="center-col">
                                <?php if ((float)$item['purchase_discount_percent'] > 0) { ?>
                                    <span class="pv-badge pv-badge-amber"><?= number_format((float)$item['purchase_discount_percent'], 1) ?>%</span>
                                <?php } else { ?>
                                    <span style="color: #94a3b8;">-</span>
                                <?php } ?>
                            </td>
                            <td class="center-col">
                                <?php if (!empty($item['purchase_bonus']) && (float)$item['purchase_bonus'] > 0) { ?>
                                    <span class="pv-badge pv-badge-green"><?= number_format((float)$item['purchase_bonus'], 1) ?>%</span>
                                <?php } else { ?>
                                    <span style="color: #94a3b8;">-</span>
                                <?php } ?>
                            </td>
                            <td class="num-col" style="font-weight: 600;">
                                <?= number_format((float)$item['purchase_taxable'], 2) ?>
                            </td>
                            <td class="center-col">
                                <span class="pv-badge pv-badge-blue"><?= number_format($tot_gst_p, 0) ?>%</span>
                            </td>
                            <td class="num-col" style="font-size: 12px; color: #475569;">
                                <?= number_format((float)$item['purchase_cgst'], 2) ?>
                            </td>
                            <td class="num-col" style="font-size: 12px; color: #475569;">
                                <?= number_format((float)$item['purchase_sgst'], 2) ?>
                            </td>
                            <td class="num-col" style="font-weight: 700; color: #1e40af; font-size: 14px;">
                                <?= number_format((float)$item['purchase_total'], 2) ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right; text-transform: uppercase;">Totals:</td>
                            <td class="center-col"><?= $total_qty_count ?></td>
                            <td class="center-col"><?= $total_free_qty ?></td>
                            <td colspan="4"></td>
                            <td class="num-col">₹<?= number_format($total_taxable, 2) ?></td>
                            <td></td>
                            <td class="num-col">₹<?= number_format($total_cgst, 2) ?></td>
                            <td class="num-col">₹<?= number_format($total_sgst, 2) ?></td>
                            <td class="num-col" style="font-size: 15px; color: #1e3a8a;">₹<?= number_format($total_purchased_amount, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Return Items Card (Conditionally shown if returns exist) -->
    <?php if (!empty($return_items)) { ?>
    <div class="pv-card" style="border-color: #fde68a;">
        <div class="pv-card-header" style="background: #fffbeb;">
            <h3 style="color: #92400e;">
                <i class="fa fa-reply" style="color: #f59e0b;"></i>
                Purchased Return Items (Credit Deductions)
                <span class="pv-badge pv-badge-amber"><?= count($return_items) ?> Returned</span>
            </h3>
            <span style="font-size: 12px; color: #b45309; font-weight: 600;">
                Total Returned Value: ₹<?= number_format($return_total, 2) ?>
            </span>
        </div>
        <div class="pv-card-body" style="padding: 0;">
            <div class="pv-table-wrap">
                <table class="pv-table">
                    <thead>
                        <tr>
                            <th class="center-col" style="width: 40px;">#</th>
                            <th>Return Date</th>
                            <th>Product Name</th>
                            <th>HSN</th>
                            <th>Manufacturer</th>
                            <th>Batch</th>
                            <th>Expiry</th>
                            <th class="center-col">Qty</th>
                            <th class="center-col">Free Qty</th>
                            <th class="num-col">Rate</th>
                            <th class="num-col">Taxable</th>
                            <th class="num-col">CGST</th>
                            <th class="num-col">SGST</th>
                            <th class="num-col">Total Deducted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $rcounter = 0;
                        foreach ($return_items as $ritem) { 
                            $rcounter++;
                            $r_date = (!empty($ritem['purchase_return_date']) && $ritem['purchase_return_date'] != '0000-00-00') ? date('d M Y', strtotime($ritem['purchase_return_date'])) : 'N/A';
                            $exp_str = (!empty($ritem['purchase_expire_month']) ? str_pad($ritem['purchase_expire_month'], 2, '0', STR_PAD_LEFT) : '--') . '/' . (!empty($ritem['purchase_expire_year']) ? $ritem['purchase_expire_year'] : '--');
                        ?>
                        <tr>
                            <td class="center-col"><?= $rcounter ?></td>
                            <td><?= htmlspecialchars($r_date) ?></td>
                            <td style="font-weight: 600;"><?= htmlspecialchars(!empty($ritem['medicine_name']) ? $ritem['medicine_name'] : 'Unknown') ?></td>
                            <td><?= htmlspecialchars(!empty($ritem['medicine_hsn']) ? $ritem['medicine_hsn'] : '-') ?></td>
                            <td><?= htmlspecialchars(!empty($ritem['medicine_manufacturer']) ? $ritem['medicine_manufacturer'] : '-') ?></td>
                            <td class="pv-mono"><?= htmlspecialchars(!empty($ritem['purchase_batch']) ? $ritem['purchase_batch'] : '-') ?></td>
                            <td><?= $exp_str ?></td>
                            <td class="center-col" style="font-weight: 700; color: #991b1b;"><?= (int)$ritem['purchase_quantity'] ?></td>
                            <td class="center-col"><?= (int)$ritem['purchase_free_quantity'] ?></td>
                            <td class="num-col"><?= number_format((float)$ritem['purchase_rate'], 2) ?></td>
                            <td class="num-col"><?= number_format((float)$ritem['purchase_taxable'], 2) ?></td>
                            <td class="num-col"><?= number_format((float)$ritem['purchase_cgst'], 2) ?></td>
                            <td class="num-col"><?= number_format((float)$ritem['purchase_sgst'], 2) ?></td>
                            <td class="num-col" style="font-weight: 700; color: #991b1b;">-₹<?= number_format((float)$ritem['purchase_total'], 2) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" style="text-align: right; text-transform: uppercase;">Total Returned:</td>
                            <td class="center-col" style="color: #991b1b;"><?= $return_qty ?></td>
                            <td></td>
                            <td></td>
                            <td class="num-col">₹<?= number_format($return_taxable, 2) ?></td>
                            <td class="num-col">₹<?= number_format($return_cgst, 2) ?></td>
                            <td class="num-col">₹<?= number_format($return_sgst, 2) ?></td>
                            <td class="num-col" style="color: #991b1b;">-₹<?= number_format($return_total, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Bottom Split: GST Breakdown & Settlement Card -->
    <div class="pv-bottom-grid">
        <!-- Left Column: Amount in Words & Tax Slabs -->
        <div>
            <!-- Amount In Words Card -->
            <div class="pv-card" style="margin-bottom: 20px;">
                <div class="pv-card-header">
                    <h3><i class="fa fa-quote-left" style="color: #3b82f6;"></i> Total Amount in Words</h3>
                </div>
                <div class="pv-card-body">
                    <p style="font-size: 15px; font-weight: 700; color: #1e3a8a; margin: 0; line-height: 1.5; font-style: italic;">
                        "<?= htmlspecialchars($amount_in_words) ?>"
                    </p>
                </div>
            </div>

            <!-- GST Slabs Summary Card -->
            <div class="pv-card">
                <div class="pv-card-header">
                    <h3><i class="fa fa-percent" style="color: #8b5cf6;"></i> GST Slab Assessment</h3>
                    <span style="font-size: 11px; color: #64748b;">Statutory Tax Incurred</span>
                </div>
                <div class="pv-card-body" style="padding: 12px 16px;">
                    <table class="pv-gst-table">
                        <thead>
                            <tr>
                                <th>GST Slab</th>
                                <th style="text-align: right;">Taxable Base (₹)</th>
                                <th style="text-align: right;">CGST (₹)</th>
                                <th style="text-align: right;">SGST (₹)</th>
                                <th style="text-align: right;">Total Tax (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gst_tiers as $slab_label => $slab_data) { ?>
                            <tr>
                                <td><span class="pv-badge pv-badge-blue"><?= $slab_label ?></span></td>
                                <td style="text-align: right; font-weight: 600;"><?= number_format($slab_data['taxable'], 2) ?></td>
                                <td style="text-align: right;"><?= number_format($slab_data['cgst'], 2) ?></td>
                                <td style="text-align: right;"><?= number_format($slab_data['sgst'], 2) ?></td>
                                <td style="text-align: right; font-weight: 700; color: #1e40af;"><?= number_format($slab_data['total_gst'], 2) ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr style="border-top: 1px solid #cbd5e1; font-weight: 700;">
                                <td>Total:</td>
                                <td style="text-align: right;">₹<?= number_format($total_taxable, 2) ?></td>
                                <td style="text-align: right;">₹<?= number_format($total_cgst, 2) ?></td>
                                <td style="text-align: right;">₹<?= number_format($total_sgst, 2) ?></td>
                                <td style="text-align: right; color: #1e40af;">₹<?= number_format($total_gst, 2) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Verification Signatures (Visible on Print) -->
            <div class="pv-sign-box">
                <div class="pv-sign-item">
                    <div class="pv-sign-line"></div>
                    <div class="pv-sign-title">Store In-Charge / Checked By</div>
                </div>
                <div class="pv-sign-item">
                    <div class="pv-sign-line"></div>
                    <div class="pv-sign-title">Authorized Signatory / Pharmacist</div>
                </div>
            </div>
        </div>

        <!-- Right Column: Settlement & Financial Calculation Breakdown -->
        <div>
            <div class="pv-summary-card">
                <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-calculator" style="color: #2563eb;"></i>
                    Purchase Value Breakdown
                </h3>

                <div class="pv-sum-row">
                    <span>Taxable Goods Value (Subtotal)</span>
                    <span style="font-weight: 600;">₹<?= number_format($total_taxable, 2) ?></span>
                </div>

                <div class="pv-sum-row">
                    <span>Central GST (CGST)</span>
                    <span>₹<?= number_format($total_cgst, 2) ?></span>
                </div>

                <div class="pv-sum-row">
                    <span>State GST (SGST)</span>
                    <span>₹<?= number_format($total_sgst, 2) ?></span>
                </div>

                <div class="pv-sum-row highlight">
                    <span>Total Input Tax Credit (GST)</span>
                    <span style="color: #2563eb;">₹<?= number_format($total_gst, 2) ?></span>
                </div>

                <div class="pv-sum-row">
                    <span>Gross Invoice Subtotal</span>
                    <span style="font-weight: 600;">₹<?= number_format($total_purchased_amount, 2) ?></span>
                </div>

                <?php if (!empty($return_items) && $return_total > 0) { ?>
                <div class="pv-sum-row" style="color: #991b1b;">
                    <span>Less: Returned Goods Credit</span>
                    <span style="font-weight: 700;">-₹<?= number_format($return_total, 2) ?></span>
                </div>
                <?php } ?>

                <div class="pv-sum-row">
                    <span>Round-Off Adjustment</span>
                    <span style="font-family: monospace;"><?= ($round_diff >= 0 ? '+' : '') . number_format($round_diff, 2) ?></span>
                </div>

                <div class="pv-sum-total">
                    <span class="label">Net Payable Amount</span>
                    <span class="amount">₹<?= number_format($round_total, 2) ?></span>
                </div>

                <div style="margin-top: 16px; padding: 12px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 12px; color: #64748b;">
                    <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px; font-weight: 700; color: #334155;">
                        <i class="fa fa-info-circle" style="color: #3b82f6;"></i> Stock Entry Ledger
                    </div>
                    Stock has been received and added to active pharmacy inventory batch records under Purchase Entry #<?= htmlspecialchars($entry_number) ?>.
                </div>
            </div>
        </div>
    </div>
</div>