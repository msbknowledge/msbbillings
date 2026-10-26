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
   
    if (!empty($expiry_return_data))
        foreach ($expiry_return_data as $key => $value):
            ?>
            <tr>
                
                <td style="text-align:center;"><?= $value['supplier_name'] ?><br/></td>
                <td style="text-align:center;"><?= $value['expiry_return_product'] ?></td>
                 <td style="text-align:center;"><?= $value['expiry_return_Batch'] ?></td>
                <td style="text-align:center;"><?= $value['expiry_return_ref'] ?></td>
                <td style="text-align:center;"><?= $value['expiry_return_date'] ?></td>
                <td style="text-align:center;"><?= $value['expiry_return_total'] ?></td>
                <td<?=$expiry_return_total+=$value['expiry_return_total']; ?>>
                </td>
              </tr>
    <? endforeach; ?>
     <tr style="text-align:center;">
        <td colspan="5">Total</td>

  <td ><?= round($expiry_return_total, 1) ?></td>
</tr>
</table>
