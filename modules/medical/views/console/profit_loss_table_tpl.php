
                                <h1 style="color:black; text-align:center;border-bottom: none;margin-top: 15px;">Expenses </h1>

<table class="calculation" style="width:100%;">
    <tr class="heading">
        <th width="" style="text-align:center; font-weight:bold;"><b>Statement</b></th>
        <th width="" style="text-align:center; font-weight:bold;"><b>Amount</b></th>
    </tr>
    <tr>
        <td width="" style="text-align:center; font-weight:bold;"><b><h3>Total Purchase(excluding GST)</h3></b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= $purchase_data[0]['purchase_taxable'] ?></h3></b></td>
        
         </tr>
         <tr>
             <td width="" style="text-align:center; font-weight:bold;"><b><h3>Total Purchase GST</h3></b></td>
                <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= $purchase_data[0]['purchase_total']-$purchase_data[0]['purchase_taxable'] ?></h3></b></td>

    </tr>
    
     <tr>
        <td width="" style="text-align:center; font-weight:bold;"><b><h3>Payable Govt GST</h3></b></td>
                                <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= ($sales_data[0]['sale_total']-$sales_data[0]['sale_taxable'])-($purchase_data[0]['purchase_total']-$purchase_data[0]['purchase_taxable'] ) ?></h3></b></td>

    </tr>
    <tr>
             <td width="" style="text-align:center; font-weight:bold;"><b><h3>Total Purchase(Including Purchase  GST + Govt GST)</h3></b></td>
                <? $totalwithgst = $purchase_data[0]['purchase_total'] ;
                    $govtgst = ($sales_data[0]['sale_total']-$sales_data[0]['sale_taxable'])-($purchase_data[0]['purchase_total']-$purchase_data[0]['purchase_taxable'] );
                ?>
                <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= $totalwithgst + $govtgst?></h3></b></td>

    </tr>
</table>
                                <h1 style="color:black; text-align:center;border-bottom: none;margin-top: 15px;">Income </h1>


    <table class="calculation" style="width:100%;">
    <tr class="heading">
        <th width="" style="text-align:center; font-weight:bold;"><b>Statement</b></th>
        <th width="" style="text-align:center; font-weight:bold;"><b>Amount</b></th>
    </tr>
    <tr>
        <td width="" style="text-align:center; font-weight:bold;"><b><h3>Total Sale (excluding GST)<h3></b></td>
                <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= $sales_data[0]['sale_taxable'] ?></h3></b></td>

    </tr>
    <tr>
        <td width="" style="text-align:center; font-weight:bold;"><b><h3>Total Sale GST</h3></b></td>
                        <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= $sales_data[0]['sale_total']-$sales_data[0]['sale_taxable'] ?><h3></b></td>
    </tr>
    <tr>
        <td width="" style="text-align:center; font-weight:bold;"><b><h3>Total Sale( Including GST) </h3></b></td>
                        <td width="" style="text-align:center; font-weight:bold;"><b><h3><?= $sales_data[0]['sale_total'] - round($sale_grand_dis[0]['sale_grand_discount'],2)?><h3></b></td>
    </tr>
   
    </table>

                                <h1 style="color:black; text-align:center;border-bottom: none;"    margin-top: 15px;>Profit</h1>

    <table class="calculation" style="width:100%;">
    <tr class="heading">
        <th width="" style="text-align:center; font-weight:bold;"><b>Statement</b></th>
        <th width="" style="text-align:center; font-weight:bold;"><b>Amount</b></th>
    </tr>
    <tr>
        <?php $amount=$sales_data[0]['sale_total']-round($sale_grand_dis[0]['sale_grand_discount'],2)-($purchase_data[0]['purchase_total']+ (($sales_data[0]['sale_total']-$sales_data[0]['sale_taxable'])-($purchase_data[0]['purchase_total']-$purchase_data[0]['purchase_taxable'])));
        // pr($amount);
        ?>
        <td width="" style="text-align:center; font-weight:bold;"><b><?if($amount<0){echo '<h3 style="color:red">Loss';}else{echo '<h3 style="color:green">NetProfit'; }?></h3></b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b><?php if($amount<0){echo '<h3 style="color:red">'.$amount;}else{echo '<h3 style="color:green">'.$amount;}?></h3></h3></b></td>

    </tr>
  
    
</table>