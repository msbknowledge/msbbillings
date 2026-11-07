<style>
    .invoice-box {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        color: #333;
        font-size: 12px;
        line-height: 1.4;
        width: 100%;
        max-width: 800px;
        margin: auto;
        padding: 10px;
    }
    .invoice-box table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 8px;
    }
    .invoice-box table.table-bordered {
        border: 1px solid #999;
    }
    .invoice-box table.table-bordered th, 
    .invoice-box table.table-bordered td {
        border: 1px solid #999;
        padding: 4px 6px;
    }
    .invoice-box th {
        background-color: #f5f5f5;
        font-weight: bold;
        font-size: 11.5px;
    }
    .invoice-box .text-left { text-align: left; }
    .invoice-box .text-right { text-align: right; }
    .invoice-box .text-center { text-align: center; }
    .invoice-box h4, .invoice-box h5 { margin: 2px 0; }
    .invoice-box h4 { font-size: 14px; }
    .invoice-box h5 { font-size: 12px; font-weight: normal; }
    .invoice-box .company_details { font-size: 11px; }
    .invoice-box .company_details h5 { font-size: 11px; }
    @media print {
        footer { page-break-after: always; }
    }
</style>

<?php
$cust = isset($data['customerData']) ? $data['customerData'] : array();
$cust_name = isset($cust['customer_name']) ? strtoupper($cust['customer_name']) : '';
$cust_code = isset($cust['customer_code']) ? $cust['customer_code'] : '';
$cust_addr = isset($cust['customer_address']) ? strtoupper($cust['customer_address']) : '';
$cust_area = isset($cust['customer_area']) ? strtoupper($cust['customer_area']) : '';
$cust_contact = isset($cust['customer_contact']) ? $cust['customer_contact'] : '';
$cust_stb = isset($cust['customer_stb']) ? strtoupper($cust['customer_stb']) : '';
$cust_mso = isset($cust['customer_mso_account']) ? $cust['customer_mso_account'] : '';

$logo_path = '';
if (function_exists('get_option') && get_option('invoice_logo')) {
    $custom_logo = FCPATH . 'uploads/' . get_option('invoice_logo');
    if (file_exists($custom_logo)) {
        $logo_path = $custom_logo;
    }
}
if (!$logo_path && file_exists(FCPATH . 'img_1/simplebillings.png')) {
    $logo_path = FCPATH . 'img_1/simplebillings.png';
}

$dataval = !empty($invoice['invoice_meta']) ? json_decode($invoice['invoice_meta'], true) : array();
$items = array();
if (isset($dataval['billings']['items']) && is_array($dataval['billings']['items'])) {
    $items = $dataval['billings']['items'];
} elseif (isset($dataval['billings']) && is_array($dataval['billings']) && isset($dataval['billings'][0])) {
    $items = $dataval['billings'];
} elseif (isset($dataval['items']) && is_array($dataval['items'])) {
    $items = $dataval['items'];
}

$tot_invoice = isset($data['total_invoice_amount_till_date'][0]['invoice_bill']) ? floatval($data['total_invoice_amount_till_date'][0]['invoice_bill']) : 0;
$tot_collected = isset($data['total_collection_amount_till_date'][0]['collected_bill']) ? floatval($data['total_collection_amount_till_date'][0]['collected_bill']) : 0;
$current_billed = isset($invoice['invoice_billed_amount']) ? floatval($invoice['invoice_billed_amount']) : 0;
$due_till_date = $tot_invoice - $tot_collected;
$payable_due = $due_till_date - $current_billed;

$last_col_date = !empty($data['last_collection_data'][0]['collection_date']) ? date('d/M/Y', strtotime($data['last_collection_data'][0]['collection_date'])) : 'N/A';
$last_col_amount = !empty($data['last_collection_data'][0]['collection_amount']) ? number_format(floatval($data['last_collection_data'][0]['collection_amount']), 2, '.', '') : '0.00';
?>

<div class="invoice-box">
    <table>
        <tr>
            <td colspan="2" class="text-center">
                <h3 style="margin: 0 0 6px 0; font-size: 20px; font-weight: bold;">Tax Invoice</h3>
            </td>
        </tr>
        <tr style="border: 1px solid #999;">
            <td class="company_details" style="padding: 6px; vertical-align: top; width: 60%;">
                <?= function_exists('get_option') ? get_option('company_details') : ''; ?>
            </td>
            <td class="text-right" style="padding: 6px; vertical-align: top; width: 40%;">
                <?php if ($logo_path): ?>
                    <img src="<?= $logo_path ?>" style="max-width: 140px; max-height: 55px;" alt="Logo"><br>
                <?php endif; ?>
                <h5><b>Generated On:</b> <?= date('d/M/Y', strtotime($date)); ?></h5>
                <h5><b>Renew Date:</b> <?= !empty($invoice['invoice_due_date']) ? date('d/M/Y', strtotime($invoice['invoice_due_date'])) : date('d/M/Y', strtotime($date)); ?></h5>
            </td>
        </tr>
    </table>

    <table class="table-bordered" style="margin-top: 6px;">
        <tr>
            <td style="width: 70%;"><h4><b>Customer Name:</b> <?= $cust_name; ?></h4></td>
            <td style="width: 30%;"><h4><b>Code:</b> <?= $cust_code; ?></h4></td>
        </tr>
    </table>

    <table class="table-bordered" style="margin-top: 6px;">
        <tr>
            <td style="width: 40%;"><h5><b>Address:</b> <?= $cust_addr; ?></h5></td>
            <td style="width: 30%;"><h5><b>Area:</b> <?= $cust_area; ?></h5></td>
            <td style="width: 30%;"><h5><b>Mobile No:</b> <?= $cust_contact; ?></h5></td>
        </tr>
        <tr>
            <td style="width: 40%;"><h5><b>Connection:</b> Single</h5></td>
            <td style="width: 30%;"><h5><b>STB (VC):</b> <?= $cust_stb; ?></h5></td>
            <td style="width: 30%;"><h5><b>MSO Account:</b> <?= $cust_mso ? $cust_mso : 'N/A'; ?></h5></td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 14px; margin: 8px 0; font-weight: bold;">
        Invoice For: <?= isset($invoice['invoice_for']) ? $invoice['invoice_for'] : ''; ?>
    </div>

    <table class="table-bordered">
        <thead>
            <tr>
                <th class="text-left" style="width: 70%;">Package / Item Details</th>
                <th class="text-right" style="width: 30%;">Cost (INR)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $val): 
                    $itemName = isset($val['name']) ? $val['name'] : (isset($val['item_name']) ? $val['item_name'] : 'Package');
                    $itemPrice = isset($val['price']) ? $val['price'] : (isset($val['cost']) ? $val['cost'] : (isset($val['rate']) ? $val['rate'] : '0.00'));
                ?>
                    <tr>
                        <td class="text-left"><h5><?= htmlspecialchars($itemName) ?></h5></td>
                        <td class="text-right"><h5><?= number_format(floatval($itemPrice), 2, '.', '') ?></h5></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td class="text-left"><h5><?= isset($invoice['invoice_for']) ? $invoice['invoice_for'] : 'Monthly Subscription'; ?></h5></td>
                    <td class="text-right"><h5><?= number_format(floatval($invoice['invoice_billed_amount']), 2, '.', ''); ?></h5></td>
                </tr>
            <?php endif; ?>

            <?php if (isset($invoice['invoice_tax_amount']) && floatval($invoice['invoice_tax_amount']) > 0): ?>
                <tr>
                    <td class="text-left"><h5><b>GST</b></h5></td>
                    <td class="text-right"><h5><?= number_format(floatval($invoice['invoice_tax_amount']), 2, '.', ''); ?></h5></td>
                </tr>
            <?php endif; ?>

            <tr>
                <td class="text-left"><h5><b>Subtotal / Total</b></h5></td>
                <td class="text-right"><h5>
                    <?php
                    $subtotal = isset($dataval['billings']['subtotal']) ? floatval($dataval['billings']['subtotal']) : floatval($invoice['invoice_billed_amount']);
                    echo number_format($subtotal, 2, '.', '');
                    ?>
                </h5></td>
            </tr>

            <?php if (isset($dataval['billings']['discount']) && floatval($dataval['billings']['discount']) > 0): ?>
                <tr>
                    <td class="text-left"><h5><b>Discount</b></h5></td>
                    <td class="text-right"><h5><?= number_format(floatval($dataval['billings']['discount']), 2, '.', ''); ?></h5></td>
                </tr>
            <?php endif; ?>

            <tr style="background-color: #f9f9f9;">
                <td class="text-left"><h5><b>Total Billed Amount (Round off)</b></h5></td>
                <td class="text-right"><h5><b><?= number_format(floatval($invoice['invoice_billed_amount']), 2, '.', ''); ?></b></h5></td>
            </tr>

            <tr>
                <td class="text-left"><h5><b>Total Payable Due Amount as of <?= date('d/M/Y', strtotime($date)); ?></b></h5></td>
                <td class="text-right"><h5><?= number_format($payable_due, 2, '.', ''); ?></h5></td>
            </tr>

            <tr>
                <td class="text-left"><h5><b>Total Previous Due Amount Till <?= date('d/M/Y', strtotime($date)); ?></b></h5></td>
                <td class="text-right"><h5><?= number_format($due_till_date, 2, '.', ''); ?></h5></td>
            </tr>

            <tr>
                <td class="text-left"><h5><b>Last Collected Amount Till <?= $last_col_date; ?></b></h5></td>
                <td class="text-right"><h5><?= $last_col_amount; ?></h5></td>
            </tr>
        </tbody>
    </table>

    <?php if (function_exists('get_option') && get_option('counter_part') == 'true'): ?>
        <div style="margin-top: 15px;">
            <h4 class="text-center" style="font-size: 13px; font-weight: bold; margin-bottom: 6px;">Summary</h4>
            <table class="table-bordered">
                <tr>
                    <td><b>Customer Name:</b> <?= $cust_name; ?></td>
                    <td><b>Customer Code:</b> <?= $cust_code; ?></td>
                </tr>
                <tr>
                    <td><h5>Total Invoice Amount Till <?= date('d/M/Y', strtotime($date)); ?></h5></td>
                    <td class="text-right"><h5><?= number_format($tot_invoice, 2, '.', ''); ?></h5></td>
                </tr>
                <tr>
                    <td><h5>Total Collected Amount Till <?= date('d/M/Y', strtotime($date)); ?></h5></td>
                    <td class="text-right"><h5><?= number_format($tot_collected, 2, '.', ''); ?></h5></td>
                </tr>
                <tr>
                    <td><h5>Total Due Amount Till <?= date('d/M/Y', strtotime($date)); ?></h5></td>
                    <td class="text-right"><h5><?= number_format($due_till_date, 2, '.', ''); ?></h5></td>
                </tr>
            </table>
            <table style="margin-top: 30px;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <span style="font-size: 11px; display: block;">
                            <b><?= function_exists('get_option') ? get_option('signature') : ''; ?></b><br>
                            <b>Signature of Collection Executive</b>
                        </span>
                    </td>
                    <td style="width: 50%; text-align: right; vertical-align: top;">
                        <span style="font-size: 11px; display: block;">
                            <b>Customer Signature</b>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    <?php endif; ?>

    <?= function_exists('get_option') ? get_option('option_footer') : ''; ?>

    <div style="text-align: center; font-size: 9px; color: #777; margin-top: 12px; border-top: 1px dotted #ccc; padding-top: 4px;">
        <b>Msbbillings.com &copy; <?= date("Y") ?></b>
    </div>
</div>
