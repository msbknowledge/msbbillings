<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Customer name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>medicine</b></td>
         <td width="" style="text-align:center; font-weight:bold;"><b>Batch</b></td>
         
        <td width="" style="text-align:center; font-weight:bold;"><b>reference</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>date</b></td>
         <td width="" style="text-align:center; font-weight:bold;"><b>total</b></td>
    </tr>
    <?
   
    if (!empty($return_sale_data))
        foreach ($return_sale_data as $key => $value):
            ?>
            <tr>
                
                <td style="text-align:center;"><?= $value['customer_name'] ?><br/></td>
                <td style="text-align:center;"><?= $value['return_sale_medicine'] ?></td>
                 <td style="text-align:center;"><?= $value['return_sale_Batch'] ?></td>
                <td style="text-align:center;"><?= $value['return_sale_ref'] ?></td>
                <td style="text-align:center;"><?= $value['return_sale_date'] ?></td>
                <td style="text-align:center;"><?= $value['return_sale_total'] ?></td>
                <td<?=$return_sale_total+=$value['return_sale_total']; ?>>
                </td>
              </tr>
    <? endforeach; ?>
     <tr style="text-align:center;">
        <td colspan="5">Total</td>

  <td ><?= round($return_sale_total, 1) ?></td>
</tr>
</table>
