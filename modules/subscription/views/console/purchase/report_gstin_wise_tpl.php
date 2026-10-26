<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Supplier Name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Supplier GST</b></td>
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
        foreach ($customer_data as $key => $value):
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;">
                    <a href="#"><?= $value['supplier_name'] ?></a>
                </td>
                <td style="text-align:center;"><?= $value['supplier_gst'] ?></td>
                <td style="text-align:center;"><?=
                    $value['purchase_taxable'];
                    $taxable += $value['purchase_taxable'];
                    ?></td>
                <td style="text-align:center;"><?=
                    $value['purchase_cgst'];
                    $total_CGST += $value['purchase_cgst'];
                    ?></td>
                <td style="text-align:center;"><?=
            $value['purchase_sgst'];
            $total_SGST += $value['purchase_sgst'];
                    ?></td>
                <td style="text-align:center;"><?=
            $value['purchase_total'];
            $total_totaled += $value['purchase_total'];
                    ?></td>


            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="3">Total</td>

                                            <!--td ><?= $quantity ?></td-->
        <td><?= $taxable ?></td>
        <td><?= $total_CGST ?></td>
        <td><?= $total_SGST ?></td>
        <td><?= $total_totaled ?></td>

    </tr>
</table>

<table class="calculation" style="width:50%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Purchase CGST Percent</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Purchase CGST</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Purchase SGST Percent</b></td> 
        <td width="" style="text-align:center; font-weight:bold;"><b>Total Purchase SGST</b></td>

    </tr>
    <?
    $total_purchase_cgst = 0;
    $total_purchase_cgst_percent = 0;
    if (!empty($gst_data))
        foreach ($gst_data as $key => $value):
            ?>
            <tr>
                <td style="text-align:center;"><?= $value['purchase_cgst_percent'];
            ?></td> 
                <td style="text-align:center;"><?= $value['purchase_cgst'];
            ?></td> 
                <td style="text-align:center;"><?= $value['purchase_cgst_percent'];
            $total_purchase_cgst_percent += $value['purchase_cgst_percent'];
            ?></td>   
                <td style="text-align:center;"><?= $value['purchase_cgst'];
        $total_purchase_cgst += $value['purchase_cgst'];
        ?></td> 
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">


                                            <!--td ><?= $quantity ?></td-->
        <td>Total cgst</td>
        <td>Total <?= $total_purchase_cgst ?></td>
        <td>Total sgst</td>
        <td>Total <?= $total_purchase_cgst ?></td>


    </tr>
</table>
