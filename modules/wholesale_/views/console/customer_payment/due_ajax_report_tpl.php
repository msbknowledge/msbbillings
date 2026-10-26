<table class="calculation" style="width:100%;">
    <tr class="heading">
               <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>Customer name</b></h3></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>Sale amount</b></h3></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>payment amount</b></h3></td>
        <td width="" style="text-align:center; font-weight:bold;"><h3><b>due amount</b></h3></td>
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
                 <td style="text-align:center;"><h3><?= $value['customer_name']?></h3></td>
               <td style="text-align:center;"><h3><?= $value['sale_total']?></h3></td>
               <td style="text-align:center;"><h3><?= $value['customer_payment_paid_amount']?></h3></td>
               <td style="text-align:center;"><h3><?=  round($value['sale_total']-$value['customer_payment_paid_amount']) ?></h3></td>
  </tr>
       <?}
       ?>
</table>
