<table id="tblsearch" class="calculation" style="width:100%;">
    <tr class="heading">
    <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Name<br/>(Code)</b>< Area ></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Stb Vc</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Stb No</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Stb Type</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Stb Status</td>
    </tr>
    <?
    $counter = 1;
    
    $total_subtotal = 0;
    $total_tax = 0;
    
    if (!empty($lco_data))
        foreach ($lco_data as $key => $value):
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;">
                    <?= $value['lco_name'] ?> (<?= $value['lco_code'] ?>)<br/><?= $value['lco_area'] ?>
                </td>  
                <td style="text-align:center;"><?= strip_tags($value['stb_vc']) ?></td>
                <td style="text-align:center;"><?= $value['stb_no']?></td>
                <td style="text-align:center;"><?= $value['stb_type']?></td>
                <td style="text-align:center;"><?= $value['stb_status']?></td>
                <!-- <td style="text-align:center;"><?php //$total_subtotal+=$value['invoice_billed_amount']; echo $value['invoice_billed_amount'];  ?></td>
                <td style="text-align:center;"><?php //$total_tax+=$value['invoice_tax_amount']; echo $value['invoice_tax_amount'];  ?></td>
                 -->
                
            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="4">Total</td>
       
        
        <td id="stb_type_count"></td>
        <td id="stb_status_count"></td> 
        
    </tr>
</table>
<script>
 $(function () {
            var totalRowCount = $("#tblsearch tr").length;
            var rowCount = $("#tblsearch td").closest("tr").length;
            var count = parseInt(rowCount)-2;
            $('#stb_type_count').html(count);
            $('#stb_status_count').html(count);
            // alert(count);
    });
</script>
