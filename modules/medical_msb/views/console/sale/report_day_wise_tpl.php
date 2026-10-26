<table class="calculation" style="width:100%;">
                                        <tr class="heading">
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sale Invoice</b></td>
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
                                      //print_r($customer_data);
                                        if (!empty($customer_data))
                                            foreach ($customer_data as $key => $value):
                                                ?>
                                                <tr>
                                                    <td style="text-align:center;"><?= $counter++ ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_invoice'] ?></td>
                                                    <td style="text-align:center;">

                                                        <a href="#"><?= $value['customer_name'] ?></a>
                                                    </td>
                                                    <td style="text-align:center;"><?= $value['customer_gst'] ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_date'] ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_taxable'];$taxable+= $value['sale_taxable'];?></td>
                                                    <td style="text-align:center;"><?= $value['sale_cgst'];$total_CGST+=$value['sale_cgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_sgst'];$total_SGST+=$value['sale_sgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_total'];$total_totaled+=$value['sale_total'] - $value['sale_grand_discount']; ?></td>


                                                </tr>
                                            <? endforeach; ?>
                                        <tr style="text-align:center;">
                                            <td colspan="5">Total</td>

                                            <!--td ><?=$quantity ?></td-->
                                            <td><?=$taxable?></td>
                                            <td><?= $total_CGST ?></td>
                                            <td><?= $total_SGST ?></td>
                                            <td><?= round($total_totaled,2)?></td>
                                                                                        
                                        </tr>
                                    </table>

<table class="calculation" style="width:49%; margin: 10px; float: left">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sale CGST Percent</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Sale CGST</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Sale SGST Percent</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Sale SGST</b></td>

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

                <td style="text-align:center;"><?= $value['sale_cgst_percent'];
            $total_sale_cgst_percent += $value['sale_cgst_percent'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_cgst'];
        $total_sale_cgst += $value['sale_cgst'];
        ?></td> 
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">


                                            <!--td ><?= $quantity ?></td-->
        <td>Total cgst</td>
        <td>Total <?= $total_sale_cgst ?></td>
        <td>Total sgst</td>
        <td>Total <?= $total_sale_cgst ?></td>


    </tr>

</table>
<table class="calculation" style="width:49%; margin: 10px; ">
            <tr class="heading">
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
                <td style="text-align:center;"><?= $value['medicine_hsn'];
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_cgst'];
            
            ?></td> 

                <td style="text-align:center;"><?= $value['medicine_hsn'];
           
            ?></td> 

                <td style="text-align:center;"><?= $value['sale_cgst'];
        $total_hsn_cgst += $value['sale_cgst'];
        ?></td> 
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">


                                            <!--td ><?= $quantity ?></td-->
        <td>Total cgst</td>
        <td>Total <?= $total_hsn_cgst ?></td>
        <td>Total sgst</td>
        <td>Total <?= $total_hsn_cgst ?></td>


    </tr>
</table>



