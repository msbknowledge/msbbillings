<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="5%" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="15%" style="text-align:center; font-weight:bold;"><b>Name<br/>(Code)</b></td>
        <td width="20%" style="text-align:center; font-weight:bold;"><b>Address</b></td>
        <td width="15%" style="text-align:center; font-weight:bold;"><b>Date</b></td>
        <td width="20%" style="text-align:center; font-weight:bold;"><b>Type</b></td>
        <td width="10%" style="text-align:center; font-weight:bold;"><b>Amount</b></td>
        <td width="10%" style="text-align:center; font-weight:bold;"><b>Note</b></td>
                <td width="10%" style="text-align:center; font-weight:bold;"><b>BY</b></td>

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
                <td style="text-align:center;color:white;background:<?php if($value['member_status']=="INACTIVE"){ echo "red";}else{{ echo "green";}}?>">

                    <?= $value['member_name'] ?> (<?= $value['member_code'] ?>)
                </td>
                <td style="text-align:center;"><?= strip_tags($value['member_address']) ?></td>
                <td style="text-align:center;"><?= $value['transaction_date'] ?></td>
                <td style="text-align:center;"><?= $value['transaction_type'] ?></td>
                <td style="text-align:center;"> ₹ <?php 
                if($value['transaction_type'] =="DEBIT"){
				       $total_subtotal -= $value['transaction_amount'];
				}else{
					$collectedBy[$value['user_firstname']] += $value['transaction_amount'];
                $total_subtotal += $value['transaction_amount'];
				}
                
            echo $value['transaction_amount']; ?></td>
               <td style="text-align:center;"><?= $value['transaction_note'] ?></td>

                <td style="text-align:center;"><?php
                    echo $value['user_firstname'];
                    ?></td>


            </tr>
    <? endforeach; ?>
    <tr style="text-align:center;">
        <td colspan="5">Total</td>
        <td >₹ <?= $total_subtotal ?></td>
        <td colspan="2">&nbsp</td>


    </tr>
</table>
<table class="calculation">
	<caption>Comission</caption>
    <tr >
        <th style="text-align: center">Name</th>
        <th style="text-align: center">Collection Amount</th>
        <th style="text-align: center">Comission Amount(1.5%)</th>

    </tr>
<? foreach ($collectedBy as $key => $value) { ?>
        <tr>
            <td><?= $key ?></td>
            <td>₹ <?= $value ?></td>
            <td>₹ <?= $value*1.5/100 ?></td>

        </tr>           
<? } ?>
</table>
