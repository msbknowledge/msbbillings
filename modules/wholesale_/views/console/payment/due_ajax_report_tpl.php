<table class="calculation" style="width:100%;">
    <tr class="heading">
               <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>Supplier name</b></h3></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>Purchase amount</b></h3></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>payment ammount</b></h3></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>due ammount</b></h3></td>
</tr>
<?
//pr($alldata);
     $counter = 1;
         if (!empty($alldata))

     foreach ($alldata as $value){
             if(empty($value))
                 continue;
            // pr($value);
        
        
?>
         <tr>
                      <td style="text-align:center;"><?= $counter++ ?></td>
                 <td style="text-align:center;"><h3><?= $value['supplier_name']?></h3></td>
               <td style="text-align:center;"><h3><?= $value['purchase_total']?></h3></td>
               <td style="text-align:center;"><h3><?= $value['payment_paid_amount']?></h3></td>
               <td style="text-align:center;"><h3><?=  round($value['purchase_total']-$value['payment_paid_amount']) ?></h3></td>
  </tr>
       <?}
       ?>
</table>
