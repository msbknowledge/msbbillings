<table class="calculation" style="width:100%;">
<?php
    $item_details = array();
    foreach ($return_purchase_data as $a => $value) {
    $item_details[] = $value['supplier_name'];
    }
    $result=count(array_unique($item_details)) == 1;
    if($result=='1'){ ?>
        <h4 style="color:black; text-align:center;font-weight: bold;"><?=$value['supplier_name']?></h4><br>
    <?php } ?>
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>supplier name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>medicine</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Type</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Batch</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Exp Date<br/>(MM/YY)</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Quantity</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>MRP</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>reference</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>date</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>total</b></td>
    </tr>
    <?
    //pr($return_purchase_data);
        //pr($return_purchase_data,1);

        foreach ($return_purchase_data as $key => $value){
            ?>
            <tr>
                
                <td style="text-align:center;"><?= $value['supplier_name'] ?><br/></td>
                <td style="text-align:center;"><?= $value['return_purchase_medicine'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_type'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_Batch'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_expire_month'] ?>/<?= $value['return_purchase_expire_year'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_strip'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_mrp'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_ref'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_date'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_total'] ?></td>
                <td<?=$return_purchase_total+=$value['return_purchase_total']; ?>>
                </td>
              </tr>
    <? } ?>
    <tr style="text-align:center;">
        <td colspan="9">Total</td>
        <td ><?= round($return_purchase_total, 1) ?></td>
    </tr>
</table>
