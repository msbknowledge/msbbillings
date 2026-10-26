<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Transaction Date</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transaction Name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transaction Note</b></td>


        <td width="" style="text-align:center; font-weight:bold;"><b> credit</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b> debit</b></td>
    </tr>
    <?php
    $counter = 1;

    $total_credit = 0;
    $total_debit = 0;
    if (!empty($collections)) {

        foreach ($collections as $key => $value):
            ?>
            <tr>
                <td style="text-align:center;"><?= $value['transaction_date'] ?></td>         
                <td style="text-align:center;"><?= $value['transaction_name'] ?></td>
                <td style="text-align:center;"><?= $value['transaction_note'] ?></td>
                <?php if ($value['transaction_type'] == 'credit') {
                    ?>
                    <td><?php $total_debit += $value['transaction_amount'];
            echo $value['transaction_amount'];
                    ?></td>
                    <td></td>

                    <?php
                } else {
                    ?>
                    <td></td>
                    <td><?php $total_credit += $value['transaction_amount'];
                    echo $value['transaction_amount']
                    ?></td>
                    <?php
                }
                ?>

            <?php # $total_credit+=$value['transaction_amount'];  ?>
            <?php #$total_debit+=$value['transaction_amount'];?>
            </tr>
    <? endforeach; ?>
        <tr style="text-align:center;">
            <td colspan="3">Total</td>
            <td ><?= round($total_debit) ?></td>
            <td ><?= round($total_credit) ?></td>

<?php } ?>
</table>
