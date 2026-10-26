<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>supplier name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>product</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Batch</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>reference</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>date</b></td>
         <td width="" style="text-align:center; font-weight:bold;"><b>total</b></td>
    </tr>
    <?
    //pr($return_purchase_data);
          // pr($return_purchase_data,1);

        foreach ($return_purchase_data as $key => $value){
            ?>
            <tr>
                
                <td style="text-align:center;"><?= $value['supplier_name'] ?><br/></td>
                <td style="text-align:center;"><?= $value['return_purchase_product'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_Batch'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_ref'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_date'] ?></td>
                <td style="text-align:center;"><?= $value['return_purchase_total'] ?></td>
                <td<?=$return_purchase_total+=$value['return_purchase_total']; ?>>
                </td>
              </tr>
    <? } ?>
     <tr style="text-align:center;">
        <td colspan="5">Total</td>

  <td ><?= round($return_purchase_total, 1) ?></td>
</tr>
</table>
