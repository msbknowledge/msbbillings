<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>SL NO.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>MEDICINE</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>OPENING STOCK</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>RECEIVE QUANTITY</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>ISSUE QUANTITY</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>CLOSING STOCK</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>EXPIRY STOCK</b></td>
    </tr>
    <?
        $counter=1;
        foreach ($data as $key => $value){
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?><br/></td>
                <td style="text-align:center;"><?= $value['medicine_name'] ?><br/></td>
                <td style="text-align:center;"><?= $value['medicine_manufacturer'] ?><br/></td>
                <td style="text-align:center;"><?= $value['purchase_batch'] ?></td>
                <td style="text-align:center;"><?= $value['left_strip'] ?></td>
                <td style="text-align:center;"><?= $value['purchase_mrp'] ?></td>
                <td style="text-align:center;"><?= $value['purchase_total'] ?></td>
              </tr>
    <? } ?>
    <!-- <tr style="text-align:center;">
        <td colspan="8">Total</td>
        <td ><?= round($total_mrp, 1) ?></td>
    </tr> -->
</table>
