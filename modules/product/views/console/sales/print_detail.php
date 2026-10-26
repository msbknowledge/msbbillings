<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Print Invoice</title>
    <link rel="stylesheet" type="text/css" media="print" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'courier new';
            font-size: 16px;
        }

        table {
            width: 100%;
            text-align: center;

        }

        th {
            border-left: 1px solid black;
            border-bottom: 1px solid black;
        }

        td {
            border-left: 1px solid black;
        }

        table {
            width: 100%;
            text-align: center;
            border-spacing: 0;
            border-collapse: collapse;
        }

        th {
            border: 1px solid black;
            border-bottom: 1px solid black;
            padding: 3px;
        }

        td {
            border: 1px solid black;
            padding: 3px;
        }

        .page {
            height: 1100px;
            margin-top: 0in;
            background-color: transparant;

        }

        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
            color: black;
        }

        .footer {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            text-align: center;
            font-size: 18px;
        }

        .txt-dec {
            font-weight: 100;
        }

        .p-dec {
            margin: 3px 0px;
        }

        body {
            position: relative;
            margin: 0;
            padding-bottom: 6rem;
            min-height: 100%;
            font-family: "Helvetica Neue", Arial, sans-serif;
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            margin-top: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            font-size: 14px;
        }

        page[size="A4"] {
            width: 21cm;
            max-height: 29.7cm;
        }

        /* @media print {
            footer {
                page-break-after: auto;
                margin-top: 0px;
            }
        }

        @media print {
            footer {
                page-break-after: always;
            }
        } */

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <?php
    //pr($data);
    ?>
    <page size="A4">
        <table style="padding: 15px;">
            <tr>
                <th style="border:none;">
                    <div style="text-align: right;">
                        <img src="/img/<?= strip_tags(get_option('company_logo'));?>" width="100">
                    </div>
                </th>
                <th style="border:none;">
                    <div style="text-align: left;">
                        <h1 style="margin: 0;font-size: xxx-large;"><?= strip_tags(get_option('company_name')) ?></h1>
                        <div style="border: 2px solid #ccc;border-radius: 15px;padding: 5px;text-align:center;">
                            <?= strip_tags(get_option('company_service')) ?>
                        </div>
                        <div style="text-align: center;font-weight: 100;padding: 3px;">
                            <span><?= strip_tags(get_option('company_address')) ?></span>
                        </div>
                        <div style="text-align: center;padding: 3px;"><span><?= strip_tags(get_option('company_phone')) ?> </span><i class="fa fa-circle" style="font-size:15px;"></i><span> <?= strip_tags(get_option('company_email')) ?></span></div>
                    </div>
                </th>
            </tr>
        </table>
       
        <table style="font-size: 11px">
            <thead>
                <tr>
                    <th style="font-weight: bold;" colspan="12">TAX INVOICE</th>
                </tr>
                <tr>
                    <th class="txt-dec" colspan="6">BYER'S</th>
                    <th class="txt-dec" colspan="6">ORIGINAL/DUPLICATE/TRIPLICATE</th>
                </tr>
                <tr style="text-align: left;">
                    <th class="txt-dec" colspan="6">
                        <div>
                            <p class="p-dec">Name : <?= $data[0]['customer_name'] ?></p>
                            <p class="p-dec">Address : <?= $data[0]['customer_address'] ?></p>
                            <p class="p-dec">Phone No. : <?= $data[0]['customer_contact'] ?></p>
                            <p class="p-dec">GSTIN : <?= $data[0]['customer_gst'] ?></p>
                        </div>
                    </th>
                    <th class="txt-dec" colspan="6">
                        <div>
                            <p class="p-dec">Tax Invoice No. : <?= $data[0]['sale_invoice'] ?></p>
                            <p class="p-dec">Invoice Date : <?= date('Y-m-d', strtotime($data[0]['sale_date'])) ?></p>
                            <p class="p-dec">Order No. : <?= !empty($data[0]['sale_order_no']) ? $data[0]['sale_order_no'] : "N/A" ?></p>
                            <p class="p-dec">State : West Bengal</p>
                            <p class="p-dec">State Code : 19</p>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th rowspan="2">Sl No.</th>
                    <th rowspan="2">Description of Goods</th>
                    <th rowspan="2">HSN</th>
                    <th rowspan="2">Qty</th>
                    <th rowspan="2">Unit Rate(Rs.)</th>
                    <th rowspan="2">Taxable Value</th>
                    <th colspan="2">CGST</th>
                    <th colspan="2">SGST</th>
                    <th rowspan="2">Dis(Rs.)</th>
                    <th rowspan="2">Amount</th>
                </tr>
                <tr>
                    <th scope="col">Rate</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
               // pr($data);
                $total_rs = 0;
                $total_taxable = 0;
                $total_cgst = 0;
                $total_sgst = 0;
                $total_discount = 0;
                $total_amount = 0;
                $total = 0;
                foreach ($data as $key => $value) { ?>
                    <tr>
                        <td><?= ++$i; ?></td>
                        <td><?= $value['product_name']; ?></br><?= $value['sale_batch']?></td>
                        <td><?= $value['product_hsn']; ?></td>
                        <td><?= $value['sale_strip_quantity']; ?></td>
                        <td><?= round($value['sale_rate'], 2); ?></td>
                        <td><?= $value['sale_taxable']; ?></td>
                        <td><?= $value['sale_cgst_percent']; ?>%</td>
                        <td><?= $value['sale_cgst']; ?></td>
                        <td><?= $value['sale_sgst_percent']; ?>%</td>
                        <td><?= $value['sale_sgst']; ?></td>
                        <td><?= $value['sale_discount']; ?></td>
                        <td>
                            <?php
                            echo $value['sale_total'];
                            $total_rs += $value['sale_rate'];
                            $total_taxable += $value['sale_taxable'];
                            $total_cgst += $value['sale_cgst'];
                            $total_sgst += $value['sale_sgst'];
                            $total_discount += $value['sale_discount'];
                            $total_amount += $value['sale_rate'];
                            $total += $value['sale_total'];
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4">Total</td>
                    <td><?= round($total_amount, 2); ?></td>
                    <td><?= $total_taxable; ?></td>
                    <td></td>
                    <td><?= $total_cgst; ?></td>
                    <td></td>
                    <td><?= $total_sgst; ?></td>
                    <td><?= $total_discount; ?></td>
                    <td><?= $total; ?></td>
                </tr>
                <tr style="text-align: right;">
                    <td colspan="11">Discount</td>
                    <td><?= $total_discount; ?></td>
                </tr>
                <tr style="text-align: right;">
                    <td colspan="11">Rounded Off</td>
                    <td><?php
                        $grand_total = round($total - $total_discount);
                        echo $grand_total;
                        ?></td>
                </tr>
                <tr style="text-align: right;">
                    <td colspan="11">Grand Total</td>
                    <td><?= $grand_total; ?></td>
                </tr>
                <tr style="text-align: left;">
                    <td colspan="12">Total Invoice Amount In Words: <?= ucwords(convert_number_to_words($grand_total)); ?> Only!</td>
                </tr>
            </tbody>
        </table>
        <div style="font-size: 11px;">
            <table style="width: 30%;float: right;">
                <tr style="text-align: left;"><td>Total Amount Before Tax</td><td><?= $total_taxable; ?></td></tr>
                <tr style="text-align: left;"><td>CGST</td><td><?= $total_cgst; ?></td></tr>
                <tr style="text-align: left;"><td>SGST</td><td><?= $total_sgst; ?></td></tr>
                <tr style="text-align: left;"><td>Tax Amount GST</td><td><?= $total_cgst + $total_sgst ?></td></tr>
                <tr style="text-align: left;"><td>Total Amount After Tax</td><td><?= round($total)?></td></tr>
            </table>
            <p><?= strip_tags(get_option('company_gstin')); ?></p>
            <p><?= strip_tags(get_option('company_pan')); ?></p>
            <p><?= get_option('company_bank_details'); ?></p>
            <p style="margin-left: 25px;"><?= get_option('company_terms'); ?></p>
        </div>
        <div style="text-align: right;">
            <p><?= get_option('company_signature_text'); ?></p><br><br><br>
            <p>Authorised Signatory</p>
        </div>
        <div>
            <p style="text-align: center;">This is a computer generated Invoice</p>
            <p style="text-align: center;font-size: 15px;">Powered By Simplebillings.com</p>
        </div>
    </page>
    <script>
          window.onafterprint = function (e) {
         $(window).off('mousemove', window.onafterprint);
         window.location='/console/sale/add_detail';
         };

        window.print();

        setTimeout(function() {
            $(window).one('mousemove', window.onafterprint);
        }, 1);
    </script>
</body>

</html>