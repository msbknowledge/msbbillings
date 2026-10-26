<table class="calculation" style="width:100%;">
                                        <tr class="heading">
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Sl.</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Purchase Invoice</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Supplier Name</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Supplier GST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Purchase Date</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Return Date</b></td>
                                            <!--td width="" style="text-align:center; font-weight:bold;"><b>Batch</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Quantity</b></td-->
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Taxable</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Discount</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>CGST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>SGST</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Total</b></td>
                                            <td width="" style="text-align:center; font-weight:bold;"><b>Return</b></td>

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
                                                    <td style="text-align:center;"><?= $value['purchase_invoice'] ?></td>
                                                    <td style="text-align:center;">

                                                        <a href="#"><?= $value['supplier_name'] ?></a>
                                                    </td>
                                                    <td style="text-align:center;"><?= $value['supplier_gst'] ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_date'] ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_return_date']; ?></td>
                                                    <!--td style="text-align:center;"><?= $value['purchase_batch']; ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_quantity'];$quantity += $value['purchase_quantity'];?></td-->
                                                    <td style="text-align:center;"><?= $value['purchase_taxable'];$taxable+= $value['purchase_taxable'];?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_discount'];$total_discount+=$value['purchase_discount']; ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_cgst'];$total_CGST+=$value['purchase_cgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_sgst'];$total_SGST+=$value['purchase_sgst']; ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_total'];$total_totaled+=$value['purchase_total']; ?></td>
                                                    <td style="text-align:center;"><?= $value['purchase_return'];$return+= $value['purchase_return']; ?></td>


                                                </tr>
                                            <? endforeach; ?>
                                        <tr style="text-align:center;">
                                            <td colspan="6">Total</td>

                                            <!--td ><?=$quantity ?></td-->
                                            <td><?=$taxable?></td>
                                            <td><?=$total_discount?></td>
                                            <td><?= $total_CGST ?></td>
                                            <td><?= $total_SGST ?></td>
                                            <td><?= $total_totaled ?></td>
                                            
                                            <td><?=$return ?></td>
                                            
                                        </tr>
                                    </table>