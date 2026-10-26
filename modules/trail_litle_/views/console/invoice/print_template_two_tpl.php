<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    td,h3,h5,h6,h4{
        margin-left:4px;
        margin-right:4px;
        margin-bottom: 2px;
        margin-top: 2px;
    }
    table{
        width: 100%;
    }
    th{
        text-align: center;
        font-size: 13px;
    }
    th{

        font-size: 13px;
    }
    @media print {
        footer {page-break-after: always;}
    }
    td h6 {
        font-size: 10px;
    }
</style>
<? //pr($customerData);?>

<div class="container" style=" height: 790px; overflow: hidden;">
    <table style="width: 100%;">
        <caption><h5 style=" font-size: 17px;text-align: center;"><?= str_ireplace('BILL CUM RECEIPT', 'TAX / INVOICE', get_option('receipt_provider_details')) ?></h5></caption>
        <tr style="border: 1px solid; border-radius: 10px;">
            <?= get_option('invoice_company_details_two'); ?>

            <td style=" text-align: right;">
                <?php if (get_option('invoice_logo')): ?>
                    <img src="<?= base_url() ?>/uploads/<?= get_option('invoice_logo') ?>" style="width: 44%;" alt="no-imgbn   ">
                <?php else: ?>
                    <img src="<?= base_url() ?>/uploads/cablebillings.png" style=" width: 22%;">
                <?php endif; ?>

                <h5></h5>  

            </td>

        </tr>
    </table>  
    <!--h1 style="color:red">this section is under construction .. do not print</h1-->
    <table>

        <tr style=" border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: left;">

            <td style=" font-size: 15px;"><h4><?= strtoupper($customerData['customer_name']); ?></h4></td>
            <td style=" border-left: 1px solid;"><h4><?= $customerData['customer_code']; ?></h4></td>

        </tr>
    </table>
    <table style=" margin-top: 10px;">

        <tr style=" border-left: 1px solid; border-right: 1px solid; border-top: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid;"><h5><?= strtoupper($customerData['customer_address']); ?></h5></td>
            <td style=" border-left: 1px solid;"><h5>Invoice No-<?= $customerData['invoiceNo']; ?></h5></td>

        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid; text-align: left;">

            <td style=" border-left: 1px solid;"><?php if (get_option('flag_address')): ?><h5 style="font-weight: bold;">VILL:-<?= strtoupper($customerData['customer_area']); ?></h5><?php endif; ?></td>
            <td style=" border-left: 1px solid;"><h5>Invoice Date-<?= $customerData['invoice_date']; ?></h5></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid;"><h5>Mobile No-<?= $customerData['customer_contact']; ?></h5></td>
            <td style=" border-left: 1px solid;"><h5>Due Date- <?= $customerData['invoice_due_date']; ?></h5></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: left;">

            <td style=" border-left: 1px solid;"></td>
            <td style=" border-left: 1px solid;"><h5>Invoice Period-<?= $customerData['invoice_period']; ?></h5></td>


        </tr>
    </table>

    <table style=" margin-top: 10px;">
        <tr style=" border: 1px solid; text-align: center; margin-top: 10px;">
            <th>Package</th>
            <th style=" border-left: 1px solid;">A La Carte</th>
            <th style=" border-left: 1px solid;">For the month of</th>
            <th style=" border-left: 1px solid;">Amount</th>
        </tr>
        <? foreach ($customerData['packages'] as $package): ?>
            <tr style=" border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: center;">

                <td style=" border-left: 1px solid;"><?php if (get_option('flag_package')): ?><?= @$package['package_name'] ?><?php else: ?>Subscription Fee<?php endif; ?></td>
                <td style=" border-left: 1px solid;">
                    <?php if (get_option('flag_package')) { ?>
                        <?php
                        foreach ($customerData['adons'] as $adon):
                            $arry[] = strtoupper($adon['channel_name']);
                            ?>
                        <? endforeach; ?>
                        <?php echo implode(',', $arry); ?>
                    <?php } else { ?>
                        --
                    <?php } ?>
                </td>
                <td style=" border-left: 1px solid;"><?= @$customerData['customer_invoice_for_month'] ?></td>
                <td style=" border-left: 1px solid;"><?= $customerData['subtotal'] ?></td>
            </tr>
        <? endforeach; ?>
        <? /* foreach ($customerData['adons'] as $adon): ?>
          <tr style=" border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: center;">

          <td style=" border-left: 1px solid;">Adons: <?= @strtoupper($adon['channel_name']) ?></td>
          <td style=" border-left: 1px solid;"></td>
          <td style=" border-left: 1px solid;"><?= @$customerData['customer_invoice_for_month'] ?></td>
          <td style=" border-left: 1px solid;"><?= @$adon['channel_price'] ?></td>
          </tr>
          <? endforeach; */ ?>
    </table>
    <table>

        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5>Connection No- 1</h5></td>
            <td style=" border-left: 1px solid;"><h4>Summery of Total Charges</h4></td>

        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid; text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5>Cust ID No-<?= $customerData['customer_code']; ?></h5></td>
            <td style=" border-left: 1px solid;"><h5> Subtotal -<p style="float: right"><?= $customerData['subtotal'] ?></p></h5></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5>STB No- <?= $customerData['stb_no']; ?></h5></td>
            <td style=" border-left: 1px solid;"><h5>Rebate / Pre Discount -<p style="float: right"><?php if (isset($customerData['discount'])) {
            echo $customerData['discount'];
        } else {
            echo 0.00;
        } ?></p></h5></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5>VC No- <?= $customerData['vc_no']; ?></h5></td>

            <td style=" border-left: 1px solid;"><?php if (!empty($taxes)) : ?><h5><?= $taxes[0]['tax_name'] ?>@<?= $taxes[0]['tax_value'] ?>% -<p style="float: right"><?= $customerData['tax'][$taxes[0]['tax_name']] ?></p></h5> <? endif; ?></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5>Last Pay Date-<?= $last_data[0]['invoice_date'] ?></h5></td>

            <td style=" border-left: 1px solid;"><?php if (!empty($taxes)): ?><h5><?= $taxes[1]['tax_name'] ?>@<?= $taxes[1]['tax_value'] ?>% -<p style="float: right"><?= $customerData['tax'][$taxes[1]['tax_name']] ?></p></h5> <? endif; ?></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">
            <td style=" border-left: 1px solid; width: 50%;"><h5>Last Paid: <?= $customerData['invoice_already_paid_amount'] ?></h5><h5>Current Paid:-<?= $last_data[0]['invoice_paid_amount'] ?></h5></td>
            <td style=" border-left: 1px solid;"><h5>Previous Dues/Advance -<p style="float: right"><?= number_format((floatval($customerData['invoice_previous_due_amount']))) ?>/<?= number_format((floatval($customerData['invoice_previous_advance_amount']))) ?></p></h5></td>


        </tr>

        <tr style=" border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5></h5></td>
            <td style=" border-left: 1px solid;"><h5>Total Charges(Roundded Off) -<p style="float: right"><?= $customerData['total_with_previous_due'] ?></p></h5></td>


        </tr>
    </table>
<?php if (!empty(get_option('gst'))) { ?>
        <table style=" margin-top: 10px;">
            <tr style=" border: 1px solid; text-align: center; margin-top: 10px;">
                <th style=" text-align: left;"><h5><strong>GST IN :<?= get_option('gst'); ?></strong></h5></th>
            </tr>

        </table>
<?php } ?>
    <table style=" margin-top: 10px;">
        <tr style=" border: 1px solid; text-align: center; margin-top: 10px;">
            <th style=" text-align: left;"><h5><strong>Total Amount Paid :</strong></h5></th>
            <td style="border: 1px solid;"><?= $customerData['total_with_previous_due'] - $customerData['invoice_due_amount'] ?></td>
            <th style=" text-align: left;"><h5><strong>After Payment Due :</strong></h5></th>
            <td style="border: 1px solid;"><?=$customerData['invoice_due_amount']; ?></td>
        </tr>

    </table>
    <table>
        <h5 style=" text-align: center;margin-top: 10px;border-top: 1px dotted;">Office Copy</h5>
        <tr style=" border-left: 1px solid; border-right: 1px solid; border-top: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h6>Connection No- 1</h6></td>
            <td style=" border-left: 1px solid;"><h6>Summery of Total Charges</h6></td>

        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid; text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h6>Cust ID No-<?= $customerData['customer_code']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Name :-<?= $customerData['customer_name']; ?></h6></td>
            <td style=" border-left: 1px solid;"><h6> Subtotal -<p style="float: right"><?= $customerData['subtotal'] ?></p></h6></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h6>STB No- <?= $customerData['stb_no']; ?></h6></td>
            <td style=" border-left: 1px solid;"><h6>Rebate / Pre Discount -<p style="float: right"><?php if (isset($customerData['discount'])) {
    echo $customerData['discount'];
} else {
    echo 0.00;
} ?></p></h6></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h6>VC No- <?= $customerData['vc_no']; ?></h6></td>

            <td style=" border-left: 1px solid;"><?php if (!empty($taxes)) : ?><h6><?= $taxes[0]['tax_name'] ?>@<?= $taxes[0]['tax_value'] ?>% -<p style="float: right"><?= $customerData['tax'][$taxes[0]['tax_name']] ?></p></h6> <? endif; ?></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h6>Last Pay Date-<?= $last_data[0]['invoice_date'] ?></h6></td>

            <td style=" border-left: 1px solid;"><?php if (!empty($taxes)): ?><h6><?= $taxes[1]['tax_name'] ?>@<?= $taxes[1]['tax_value'] ?>% -<p style="float: right"><?= $customerData['tax'][$taxes[1]['tax_name']] ?></p></h6> <? endif; ?></td>


        </tr>
        <tr style=" border-left: 1px solid; border-right: 1px solid;  text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h6>Last paid: <?= $customerData['invoice_already_paid_amount'] ?></h6><h6>Current paid: <?= $last_data[0]['invoice_paid_amount'] ?></h6><h6>Current Due: <?= $customerData['invoice_due_amount'] ?></h6></td>
            <td style=" border-left: 1px solid;"><h6>Previous Dues/Advance -<p style="float: right"><?= number_format((floatval($customerData['invoice_previous_due_amount']))) ?>/<?= number_format((floatval($customerData['invoice_previous_advance_amount']))) ?></p></h6></td>


        </tr>

        <tr style=" border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: left;">

            <td style=" border-left: 1px solid; width: 50%;"><h5></h5></td>
            <td style=" border-left: 1px solid;"><h6>Total Charges(Roundded Off) -<p style="float: right"><?= $customerData['total_with_previous_due'] ?></p></h6></td>


        </tr>
    </table>
<?= get_option('option_footer'); ?>
    <span style="font-size: 14px;width: 100%;display: block;text-align: center;">CableBillings.com&copy2017</span>

</div>
<footer></footer>
