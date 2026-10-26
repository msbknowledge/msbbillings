<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>date</b></td>
                <td width="" style="text-align:center; font-weight:bold;"><b>Supplier Name</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Debit</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Credit</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Note</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Invoice/Ref No</b></td>

    </tr>
    <?
     $counter = 1;
     $total_debit = 0;
      $total_credit = 0;
    if (!empty($alldata))
        foreach ($alldata as $key => $val):
        foreach($val as $key=> $value):
       pr($value);
            ?>
            <tr>
                   <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;"><?= $value['date'] ?></td>
                <td style="text-align:center;"><?= $value['supplier'] ?></td>
                <td style="text-align:center;"><?= $value['debit'];$total_debit+=$value['debit'];?></td>
                <td style="text-align:center;"><?= $value['credit'];$total_credit+=$value['credit']; ?></td>
                <td style="text-align:center;"><?= $value['note'] ?></td>
                  <td style="text-align:center;"><?= $value['number'] ?></td> 



            </tr>
                 <? endforeach; ?>
                 <? endforeach; ?>

            <tr style="text-align:center;">
                                            <td colspan="3">Total</td>

                                            <td><?= $total_debit?></td>
                                            <td><?= $total_credit ?></td>
                                           <td colspan="1">Balance</td>

                                            <td><?= $total_debit-$total_credit?></td>
                                                                           
                                        </tr>
</table>
