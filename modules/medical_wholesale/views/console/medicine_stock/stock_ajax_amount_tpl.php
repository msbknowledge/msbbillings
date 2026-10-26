<table style="width:100%;">
    <? foreach ($data as $key => $value){ ?>
        <tr>
            <td<?=$total_mrp+=$value['purchase_total']; ?>>
                </td>
        </tr>
    <? } ?>
    <tr class="total">
    <td><h1 style="text-align: center;background-color: green;font-family: initial;color: white">Total Stock MRP Amount: <?= round($total_mrp) ?></h1></td>
    </tr>

</table>
<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl No.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Medicine</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Batch</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Stock Qty</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>MRP</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Total</b></td>
    </tr>
    <?
        $counter=1;
        foreach ($data as $key => $value){
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?><br/></td>
                <td style="text-align:center;"><?= $value['medicine_name'] ?><br/></td>
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
