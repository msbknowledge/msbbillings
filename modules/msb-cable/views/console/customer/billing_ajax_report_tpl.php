<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Name<br/>(Code)</b>< Area ></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Address</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Area</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Invoice Date</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Invoice For</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Billed</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Tax Amount<br/>(GST)</b></td>

    </tr>
    <?
    $counter = 1;
    
    $total_subtotal = 0;
    $total_tax = 0;
    
    if (!empty($customer_data))
        foreach ($customer_data as $key => $value):
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;">

                    <?= $value['customer_name'] ?> (<?= $value['customer_code'] ?>)<br/><?= $value['customer_area'] ?>
                </td>
                <td style="text-align:center;"><?= strip_tags($value['customer_address']) ?></td>
                <td style="text-align:center;"><?= strip_tags($value['customer_area']) ?></td>
                <td style="text-align:center;"><?=$value['invoice_date']?></td>
                <td style="text-align:center;"><?= $value['invoice_for']?></td>
                <td style="text-align:center;"><?php $total_subtotal+=$value['invoice_billed_amount']; echo $value['invoice_billed_amount'];  ?></td>
                <td style="text-align:center;"><?php $total_tax+=$value['invoice_tax_amount']; echo $value['invoice_tax_amount'];  ?></td>
                
                
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="6">Total</td>

        <td ><?= round($total_subtotal, 2) ?></td>
        <td><?= round($total_tax, 2) ?></td>
       
        
    </tr>
</table>
