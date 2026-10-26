<table class="calculation" style="width:100%;">
                                        <tr class="heading">
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sale Invoice</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>customer Name</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>customer GST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sale Date</b></td>
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
                                                    <td style="text-align:center;"><?= $value['sale_invoice'] ?></td>
                                                    <td style="text-align:center;">

                                                        <a href="#"><?= $value['customer_name'] ?></a>
                                                    </td>
                                                    <td style="text-align:center;"><?= $value['customer_gst'] ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_date'] ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_taxable'];$taxable+= $value['sale_taxable'];?></td>
                                                    <td style="text-align:center;"><?= $value['sale_cgst'];$total_CGST+=$value['sale_cgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_sgst'];$total_SGST+=$value['sale_sgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['sale_total'];$total_totaled+=$value['sale_total']; ?></td>


                                                </tr>
                                            <? endforeach; ?>
                                        <tr style="text-align:center;">
                                            <td colspan="5">Total</td>

                                            <!--td ><?=$quantity ?></td-->
                                            <td><?=$taxable?></td>
                                            <td><?= $total_CGST ?></td>
                                            <td><?= $total_SGST ?></td>
                                            <td><?= $total_totaled ?></td>
                                                                                        
                                        </tr>
                                    </table>