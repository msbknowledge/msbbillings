<table class="calculation" style="width:100%;">
    <tr class="heading">  <td width="" style="text-align:center; font-weight:bold;"> <a href="<?=console_url('sale/report_gstin_wise_export');?>?start=<?=$start?>&end=<?=$end?>">Export</a></td></tr>
                                        <tr class="heading">
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>customer Name</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>customer GST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sale Date</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Taxable</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>CGST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>SGST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Total</b></td>

                                        </tr>
                                        <?
                                        $counter = 1;
                                        $quantity = 0;
                                        $taxable = 0;
                                        
                                        $total_discount = 0;
                                        $total_CGST = 0;
                                        $total_SGST = 0;
                                        $total_totaled = 0;
                                        $return = 0;
                                      
                                        if (!empty($customer_data))
                                        //print_r($customer_data);
                                            foreach ($customer_data as $key => $value):
                                                ?>
                                                <tr>
                                                    <td style="text-align:center;"><?= $counter++ ?></td>
                                                    <td style="text-align:center;">

                                                        <a href="#"><?= $value['customer_name'] ?></a>
                                                    </td>
                                                    <td style="text-align:center;"><?= $value['customer_gst'] ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_date']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_taxable'];$taxable+= $value['sale_taxable'];?></td>
                                                    <td style="text-align:center;"><?= $value['sale_cgst'];$total_CGST+=$value['sale_cgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_sgst'];$total_SGST+=$value['sale_sgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_total'];$total_totaled+=$value['sale_total']; ?></td>


                                                </tr>
                                            <? endforeach; 
                                             $total_grand_discount=round($sale_grand_dis_data[0]['sale_grand_discount'],2);
                                             $grand_total=$total_totaled - $total_grand_discount;
                                            ?>
                                        <tr style="text-align:center;">
                                            <td colspan="3">Total</td>
                                            <!--td ><?=$quantity ?></td-->
                                             <td></td>
                                            <td><?=$taxable?></td>
                                            <td><?= $total_CGST ?></td>
                                            <td><?= $total_SGST ?></td>
                                            <!--<td><?= $total_grand_dis ?></td> -->
                                            <td><?= $grand_total ?></td>
                                                                                        
                                        </tr>
                                    </table>

<table class="calculation" style="width:49%; margin: 10px; float: left">
    <tr class="heading">
       
        <td width="" style="text-align:center; font-weight:bold;"><b>Sale CGST Percent</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Sale CGST</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Sale SGST Percent</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Sale SGST</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Sale Taxable</b></td> 

    </tr>
    <?
    $total_sale_cgst = 0;
    $total_sale_cgst_percent = 0;
    if (!empty($daily_gst_data))
        foreach ($daily_gst_data as $key => $value):
            ?>
           
            <tr>
                
                <td style="text-align:center;"><?= $value['sale_cgst_percent'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_cgst'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_sgst_percent'];
            $total_sale_cgst_percent += $value['sale_cgst_percent'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_sgst'];
        $total_sale_cgst += $value['sale_cgst'];
        ?></td> 
        <td style="text-align:center;"><?= $value['sale_taxable'];
        $total_d_sale_taxable += $value['sale_taxable'];
        ?></td> 
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">


                                            <!--td ><?= $quantity ?></td-->
        <td>Total cgst</td>
        <td>Total <?= $total_sale_cgst ?></td>
        <td>Total sgst</td>
        <td>Total <?= $total_sale_cgst ?></td>
         <td>Total <?= $total_d_sale_taxable ?></td>


    </tr>

</table>
<table class="calculation" style="width:49%; margin: 10px; ">
            <tr class="heading">
         <td width="" style="text-align:center; font-weight:bold;"><b>Total Quantity</b></td>
          <td width="" style="text-align:center; font-weight:bold;"><b>Percent GST</b></td>
         <td width="" style="text-align:center; font-weight:bold;"><b>Total Sale Taxable</b></td> 
        
        <td width="" style="text-align:center; font-weight:bold;"><b>HSN NUMBER</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total HSN CGST</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>HSN NUMBER</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total HSN SGST</b></td>

    </tr>
    <?
    $total_hsn_cgst = 0;
    if (!empty($hsn_daily_gst_data))
        foreach ($hsn_daily_gst_data as $key => $value):
            ?>
            <tr>
                 <td style="text-align:center;"><?= $value['sale_strip_quantity'];
                  $total_sale_strip_quantity += $value['sale_strip_quantity'];
            ?></td>
            <td style="text-align:center;"><?= $value['sale_cgst_percent'];
             $total_h_sale_cgst_percent += $value['sale_cgst_percent'];
            ?></td>
            <td style="text-align:center;"><?= $value['sale_taxable'];
             $total_h_sale_taxable += $value['sale_taxable'];
            ?></td>
                <td style="text-align:center;"><?= $value['medicine_hsn'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_cgst'];
            ?></td> 

                <td style="text-align:center;"><?= $value['medicine_hsn'];
                 $total_hsn_cgst += $value['sale_cgst'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_sgst'];
        $total_hsn_sgst += $value['sale_sgst'];
        ?></td> 
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">

         <td>Total <?= $total_sale_strip_quantity ?></td>
          <td>Total Percent sgs</td>
        <td>Total <?= $total_h_sale_taxable ?></td>                                  
        <td>Total cgst</td>
        <td>Total <?= $total_hsn_cgst ?></td>
        <td>Total sgst</td>
        <td>Total <?= $total_hsn_sgst ?></td>
        


    </tr>
</table>
