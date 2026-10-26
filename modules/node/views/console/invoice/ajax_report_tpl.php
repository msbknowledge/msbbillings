  <table class="calculation" style="width:100%;">
                                                                <tr class="heading">
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Name<br/>(Code)</b>< Area ></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Address</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Package</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Month</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Collection Date</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Collected By</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Sub Total</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Discount</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>CGST</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>SGST</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Total</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Billed</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Paid</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Due</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Advance</b></td>

                                                                </tr>
                                                                <?
                                                                $counter = 1;
                                                                $due = 0;
                                                                $advanced = 0;
                                                                $billed = 0;
                                                                $collected = 0;
                                                                $total_subtotal = 0;
                                                                $total_discount = 0;
                                                                $total_CGST = 0;
                                                                $total_SGST = 0;
                                                                $total_totaled = 0;
                                                                $total_due = 0;
                                                                $total_advanced = 0;
                                                                if (!empty($customer_data))
                                                                    foreach ($customer_data as $key => $value):
                                                                        ?>
                                                                        <tr>
                                                                            <td style="text-align:center;"><?= $counter++ ?></td>
                                                                            <td style="text-align:center;">

                                                                               <?= $value['customer_name'] ?> (<?= $value['customer_code'] ?>)<br/><?= $value['customer_area'] ?>
                                                                            </td>
                                                                            <td style="text-align:center;"><?= strip_tags($value['customer_address']) ?></td>
                                                                            <td style="text-align:center;"><?= $value['packages'][0]['package_name'] ?></td>
                                                                            <td style="text-align:center;"><?= $value['customer_invoice_for_month'] ?></td>
                                                                            <td style="text-align:center;"><?= $value['invoice_collection_date']; ?></td>
                                                                            <td style="text-align:center;"><?= $value['invoice_collected_by']; ?></td>
                                                                            <td style="text-align:center;"><?= round($value['subtotal'],2);
                                                                $total_subtotal += round($value['subtotal'],2); ?></td>
                                                                            <td style="text-align:center;"><?= $value['discount'];
                                                                $total_discount += $value['discount']; ?></td>
                                                                            <td style="text-align:center;"><?= round($value['tax']['CGST'],2);
                                                                $total_CGST += $value['tax']['CGST']; ?></td>
                                                                            <td style="text-align:center;"><?= round($value['tax']['SGST'],2);
                                                                $total_SGST += $value['tax']['SGST']; ?></td>
                                                                            <td style="text-align:center;"><?= round($value['total'],2);
                                                                        $total_totaled += $value['total']; ?></td>
                                                                            <td style="text-align:center;"><?= $value['invoice_billed_amount'];
                                                                        $billed += $value['invoice_billed_amount'];
                                                                        ?></td>
                                                                            <td style="text-align:center;"><?= $value['invoice_paid_amount'];
                                                                        $collected += $value['invoice_paid_amount'];
                                                                        ?></td>
                                                                            <td style="text-align:center;"><?= $value['invoice_due_amount'];
                                                                        $due += $value['invoice_due_amount'];
                                                                        ?></td>
                                                                            <td style="text-align:center;"><?= $value['invoice_advance_amount'];
                                                                        $advanced += $value['invoice_advance_amount'];
                                                                        ?></td>

                                                                        </tr>
    <? endforeach; ?>
                                                                <tr style="text-align:center;">
                                                                    <td colspan="7">Total</td>

                                                                    <td ><?= round($total_subtotal,2) ?></td>
                                                                    <td><?= round($total_discount,2) ?></td>
                                                                    <td><?= round($total_CGST,2) ?></td>
                                                                    <td><?= round($total_SGST,2) ?></td>
                                                                    <td><?= round($total_totaled,2) ?></td>
                                                                    <td><?= round($billed,2); ?></td>
                                                                    <td><?= round($collected,2); ?></td>
                                                                    <td><?= round($due,2); ?></td>
                                                                    <td><?= round($advanced,2); ?></td>
                                                                </tr>
                                                            </table>
<table class="calculation" style="width:50%;">
                                                                <tr class="heading">
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Collected By</b></td>
                                                                    <td width="" style="text-align:center; font-weight:bold;"><b>Collected amount</b></td>
                                                                    
                                                                </tr>
                                                                <?php foreach ($collected_data as $key=>$val): ?>
                                                                <tr>
                                                                    <td><?
																	if($key=='Not Collected'){?>
																		<span style="color:red"><?=$key?></span>
																	<?php } else { ?>
																     <span style="color:green"><?=$key?></span>
																
																	<?php }?></td>
                                                                    <td><?=$val?></td>
                                                                </tr>
                                                                    
                                                                    <? endforeach; ?>
                                                                
</table>