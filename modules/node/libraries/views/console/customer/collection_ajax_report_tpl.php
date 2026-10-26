<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="5%" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="15%" style="text-align:center; font-weight:bold;"><b>Name<br/>(Code)</b>< Area ></td>
        <td width="20%" style="text-align:center; font-weight:bold;"><b>Address</b></td>
        <td width="15%" style="text-align:center; font-weight:bold;"><b>Area</b></td>
        <td width="15%" style="text-align:center; font-weight:bold;"><b>Collection Date</b></td>
        <td width="20%" style="text-align:center; font-weight:bold;"><b>Collection For</b></td>
        <td width="10%" style="text-align:center; font-weight:bold;"><b>Collected Amount</b></td>
        <td width="10%" style="text-align:center; font-weight:bold;"><b>Collected By</b></td>
    </tr>
    <?
    $counter = 1;

    $total_subtotal = 0;
    $total_tax = 0;
    $collectedBy = null;

    if (!empty($customer_data))
        foreach ($customer_data as $key => $value):
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;">

                    <?= $value['customer_name'] ?> (<?= $value['customer_code'] ?>)<br/><?= $value['customer_area'] ?>
                </td>
                <td style="text-align:center;"><?= strip_tags($value['customer_address']) ?></td>
                <td style="text-align:center;"><?= strip_tags($value['customer_area']) ?></td>
                <td style="text-align:center;"><?= $value['collection_date'] ?></td>
                <td style="text-align:center;"><?= $value['collection_for'] ?></td>
                <td style="text-align:center;"><?php $total_subtotal += $value['collection_amount'];
            echo $value['collection_amount']; ?></td>
                <td style="text-align:center;"><?php
                    $collectedBy[$value['collection_collected_by']] += $value['collection_amount'];
                    echo $value['collection_collected_by'];
                    ?></td>


            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="6">Total</td>

        <td ><?= round($total_subtotal, 2) ?></td>
        <td>&nbsp</td>


    </tr>
</table>
<table class="calculation">
    <tr >
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Amount</th>
    </tr>
<? foreach ($collectedBy as $key => $value) { ?>
        <tr>
            <td><?= $key ?></td>
            <td><?= $value ?></td>
        </tr>           
<? } ?>
</table>
