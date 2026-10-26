<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Medicine Name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Batch</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b> Quantity</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Purchase Invoice</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Date</b></td>

    </tr>
    <?
     $counter = 1;
    if (!empty($medicine_data))
        foreach ($medicine_data as $key => $value):
            ?>
            <tr>
                   <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;"><?= $value['medicine_name'] ?></td>
                <td style="text-align:center;"><?= $value['purchase_batch'] ?></td>
                <td style="text-align:center;"><?= $value['purchase_quantity'] ?></td>
                <td style="text-align:center;"><?= $value['purchase_invoice'] ?></td>
                <td style="text-align:center;"><?= $value['purchase_date'] ?></td>



            </tr>
        <? endforeach; ?>
</table>
