<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Print Invoice</title>
        <link rel="stylesheet" type="text/css" media="print" href="mystyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
        <style>

            body{
                font-family: 'courier new';
                font-size: 16px;
            }
            table{
                width: 100%;
                text-align: center;

            }

            th{
                border-left: 1px solid black;
                border-bottom: 1px solid black;
            }
            td{
                border-left: 1px solid black;
            }
            table{
                width: 100%;
                text-align: center;
            }

            th{
                border: 1px solid black;
                border-bottom: 1px solid black;
            }

            td{
                border: 1px solid black;
            }

            .page{
                height: 510px;
                margin-top:0in;
                background-color: transparant;

            }
            hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
                color:black;
            }

            .footer {
                position: absolute;
                right: 0;
                bottom: 0;
                left: 0;
                padding: 1rem;
                text-align: center;
                font-size: 18px;
            } 
            body {
                position: relative;
                margin: 0;
                padding-bottom: 6rem;
                min-height: 100%;
                font-family: "Helvetica Neue", Arial, sans-serif;
            }
            @media print {
                footer {page-break-after: auto; margin-top: 0px;}
            }
            @media print {
                footer {page-break-after: always;}
            }
            th{font-size:12px;}
            td{font-size:10px;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="page">
                <table style=" border: none;">
                    <tr>
                        <th  style=" border: none;width:25%;">
                            <?php $last_key = key(array_slice($data, -1, 1, TRUE)); ?>

                    <p style=" font-size: 12px; text-align: left; margin: 0px; "><i>Invoice No:<?= $data[$last_key]['sale_invoice'] ?></i><br>
                        Date:<?= date('d/m/Y', strtotime($data[$last_key]['sale_date'])) ?></p>



                    </th>
                    <th style="border:none;"> <img src="/img/medical.png"></th>
                    <th  style=" border: none; width: 45%;">
                    <p style=" font-size: 12px; text-align: center; margin: 0px;"><?= strip_tags(get_option('provider_name')) ?></p>
                    <p style=" font-size: 12px; text-align: center; margin: 0px;"><?= 'CHEMIST & DRUGGIST' ?></p>
                    <p style=" font-size: 12px; text-align: center; margin: 0px;"><?= (get_option('provider_address')) ?></p>
                    <p style=" font-size: 12px; text-align: center; margin: 0px;"> 
                        LandLine: <?= strip_tags(get_option('provider_landline')) ?></p>
                    <p style=" font-size: 12px; text-align: center; margin: 0px;"> 
                        Mobile: <?= strip_tags(get_option('provider_mobile')) ?></p>
                    </th>
                    <th style="border:none;"> <img src="/img/medical.png"></th>
                    <th style="line-height: 20px;border: none; width:27%; font-size: 12px; text-align: right;">
                    <h5>GSTIN:<?= strip_tags(get_option('provider_gst')) ?><br/>
                        (B.C.D.A. Membership No.<?= strip_tags(get_option('provider_bcda_no')) ?>)<br/>
                        Drug Licence No:<?= strip_tags(get_option('provider_dl')) ?></h5>
                    </th>
                    </tr>
                </table>  

                <table style="border-bottom: 1px solid black;">
                    <tr>

                        <? if (!empty(trim($data[0]['customer_name']))): ?>
                            <th  style=" border: none; text-align: left; font-size: 12px"> Name: <?= $data[0]['customer_name'] ?><br>Address:<?= $data[0]['customer_address'] ?></th>
                        <? endif; ?>  
                        <? if (!empty(trim($data[0]['doctor_name']))): ?>
                            <th  style=" border: none; text-align: center;  font-size: 12px">Dr Name: <?= $data[0]['doctor_name'] ?></th>
                        <? endif; ?>  

                        <? if (!empty(trim($data[0]['customer_contact']))): ?>
                            <th  style=" border: none; text-align: right;  font-size: 12px "> Phone: <?= $data[0]['customer_contact'] ?></th>
                        <? endif; ?>  

                    </tr>
                </table>
                <table>

                </table>
                <?php
                $hasreturn = false;
                $total_return = 0.00;
                $total = 0;
                $cgst = 0;
                $sgst = 0;
                ?>

                <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
                    <thead>
                    <h3 style=" text-align: center; margin: 0">GST Invoice</h3>
                    <tr>
                        <th>Sr</th>
                        <th>Product Name</th>
                        <th>Mfg/HSN</th>
                        <th>Strip/<br/>Pack</th>
                        <th>Loose</th>
                        <th>Unit</th>
                        <th>Batch</th>
                        <th>Exp date<br/>(MM/YY)</th>
                        <th>MRP</th>
                        <!--th>Rate</th-->
                        <th>Disc<br/>%</th>
                        <!--th>Taxable</th-->
                        <th>CGST<br/>%</th>
                        <th>CGST</th>
                        <th>SGST<br/>%</th>
                        <th>SGST</th>
                        <th>Total</th>
                    </tr>
                    </tr>
                    </thead>
                    <tbody class="appendHere">
                        <?php
                        //$counter = 0;
                        //pr($data);
                        foreach ($data as $k => $value) {#pr($value);
                            if ((int) $value['sale_strip_quantity'] <= -1) {
                                $hasreturn = true;
                                continue;
                            }
                            $counter++;
                            //echo $counter;
                            ?>    

                            <tr class="rowline"><td>
                                    <span><?= $counter ?></span></td>   
                                <td><?= $value['medicine_name'] ?></td> 
                                <td> <?= $value['medicine_manufacturer'] ?> / <?= $value['medicine_hsn'] ?></td>
                                <td><b><?= $value['sale_strip_quantity'] ?></b></td>    
                                <td><b><?= $value['sale_loose_quantity'] ?></b></td>
                                <td><b><?= $value['medicine_unit'] ?></b></td>     
                                <td><?= $value['sale_batch'] ?></td>   
                                <td><b><?= $value['sale_expire_month'] ?>/<?= $value['sale_expire_year'] ?></b></td>  
                                <td><b><?=
                                        $value['sale_mrp'];
                                        ?></b></td>    
                                <!--td><?= $value['sale_rate'] ?></td-->      
                                <td><?= $value['sale_discount_percent'] ?></td>     
                                <!--td><?= $value['sale_taxable'] ?></td-->       
                                <td><?= $value['sale_cgst_percent'] ?></td>    
                                <td><?=
                                    $value['sale_cgst'];
                                    $cgst += $value['sale_cgst'];
                                    ?></td>    
                                <td><?= $value['sale_sgst_percent'] ?></td>    
                                <td><?=
                                    $value['sale_sgst'];
                                    $sgst += $value['sale_sgst'];
                                    ?></td>    
                                <td><?php
                                    $full_mrp_price = ($value['sale_mrp'] * $value['sale_strip_quantity']) + (($value['sale_mrp'] / $value['medicine_unit']) * $value['sale_loose_quantity']);
                                    //$full_discount_price = ($full_mrp_price * $value['sale_discount_percent']) / 100;
                                    // $final_total = $full_mrp_price - $full_discount_price;
                                    printf('%.2f', $value['sale_total']);
                                    // $total += $final_total;
                                    //$total_dist += $full_discount_price;
                                    //$total_mrp += $full_mrp_price;
                                    ?></td>    
                            </tr>
                            <?php
                            #$total_dist += ($value['sale_mrp'] * $value['sale_discount_percent']) / 100;
                        }

                        $data_count = count($fulldata);
                        ?>
                    </tbody>
                </table>





                <?php
                if ($hasreturn) {
                    $total_return = 0;
                    $cgst_return = 0;
                    $sgst_return = 0;
                    ?>

                    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
                        <thead>
                        <caption><h2>Sale Return</h2></caption>
                        <tr>
                            <th>Sr</th>
                            <th>Product Name</th>
                            <th> Mfg/HSN </th>
                            <th>Strip/<br/>Pack</th>
                            <th>Loose</th>
                            <th>Unit</th>
                            <th>Batch</th>
                            <th>Exp date<br/>(MM/YY)</th>
                            <th>MRP</th>
                            <!--th>Rate</th-->
                            <th>Disc<br/>%</th>
                            <!--th>Taxable</th-->
                            <th>CGST<br/>%</th>
                            <th>CGST</th>
                            <th>SGST<br/>%</th>
                            <th>SGST</th>
                            <th>Total</th>
                        </tr>
                        </tr>
                        </thead>
                        <tbody class="appendHere">
                            <?php
                            //pr($fulldata);
                            $counter = 0;
                            foreach ($data as $k => $value) { #pr($value);
                                if ((int) $value['sale_strip_quantity'] > 0 || (int) $value['sale_loose_quantity'] > 0) {
                                    continue;
                                }
                                $counter++;
                                ?>    

                                <tr class="rowline"><td>
                                        <span><?= $counter ?></span></td>   
                                    <td><?= $value['medicine_name'] ?></td> 
                                    <td>Mfg: <?= $value['medicine_manufacturer'] ?>,HSN:<?= $value['medicine_hsn'] ?></td>
                                    <td><b><?= $value['sale_strip_quantity'] ?></b></td>    
                                    <td><b><?= $value['sale_loose_quantity'] ?></b></td>
                                    <td><b><?= $value['medicine_unit'] ?></b></td>     
                                    <td><?= $value['sale_batch'] ?></td>   
                                    <td><b><?= $value['sale_expire_month'] ?>/<?= $value['sale_expire_year'] ?></b></td>  
                                    <td><b><?=
                                            $value['sale_mrp'];
                                            ?></b></td>    
                                    <!--td><?= $value['sale_rate'] ?></td-->      
                                    <td><?= $value['sale_discount_percent'] ?></td>     
                                    <!--td><?= $value['sale_taxable'] ?></td-->       
                                    <td><?= $value['sale_cgst_percent'] ?></td>    
                                    <td><?=
                                        $value['sale_cgst'];
                                        $cgst += $value['sale_cgst'];
                                        ?></td>    
                                    <td><?= $value['sale_sgst_percent'] ?></td>    
                                    <td><?=
                                        $value['sale_sgst'];
                                        $sgst += $value['sale_sgst'];
                                        ?></td>    
                                    <td><?php
                                        $full_mrp_price = ($value['sale_mrp'] * $value['sale_strip_quantity']) + (($value['sale_mrp'] / $value['medicine_unit']) * $value['sale_loose_quantity']);
                                        $full_discount_price = ($full_mrp_price * $value['sale_discount_percent']) / 100;
                                        $final_total = $full_mrp_price - $full_discount_price;
                                        printf('%.2f', $final_total);
                                        // $total_mrp += $full_mrp_price;

                                        $total_return += $value['sale_total'];
                                        ?></td>    
                                </tr>
                                <?php
                             }
                            $data_count = count($data);
                            ?>
                        </tbody>
                    </table>

                <?php } ?>
                <?php
                if ($count != $nthPage) {
                    ?>
                    <footer>
                        <hr>
                        <p align="right">Continue to Next Page <?= $nthPage ?>/<?= $count ?></p>
                        <hr>
                    </footer>
                <?php } else { ?>
                  
                    <!-- <div class="footer"> -->
                        <!-- <footer> -->
                            <hr>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Total MRP Amount</th>
                                        <th>Total Discount Amount</th>
                                        <th>Grand Discount (%)</th>
                                        <th>Grand Discount Amount</th>
                                        <th>Total Sale Amount</th>
                                        <th>Total Return Amount</th>
                                        <th>Total Payable Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="totalAmount" colspan="1"><b><? printf('%.2f', ($fullDataArray['total_sale_mrp'])) ?></b></td>

                                        <td><b><? printf('%.2f', ($fullDataArray['total_sale_dist'])) ?></b></td>
                                        <td><b><? printf('%.2f', ($data[0]['sale_grand_discount'])) ?></b></td>
                                        <td><b><? printf('%.2f', ($fullDataArray['total_grand_sale_dist'])) ?></b></td>
                                        <td>
                                            <? printf('%.2f', $fullDataArray['total_sale_total']) ?></b>
                                        </td>
                                        <td><b><? printf('%.2f', ($total_return)) ?></b></td>
                                        <td><b><? printf('%.2f', round($fullDataArray['total_payable_total'] + $total_return)) ?></b></td>
                                        <!--td class="paid"><b>
                                        <?= number_format($data[0]['sale_total_paid'], 2) ?></b>
                                        </td-->
                                    </tr>
                                </tbody>
                            </table>
                            <p style="text-align: left;font-size: 15px;
                               margin-top: 15px; margin-bottom: 0px;">Computer generated Invoice and requires no signature</p>
                            <p style="text-align: right;font-size: 15px; margin-top: -19px;">Powered By Simplebillings.com</p>
                            <table>
                                <tr>

                                </tr>
                            </table>
                        <!-- </footer> -->
                    <!-- </div> -->

                <?php } ?>



            </div>
        </div>

        <script>
              window.onafterprint = function (e) {
             $(window).off('mousemove', window.onafterprint);
             window.location='/console/sale/add_detail';
             };

           window.print();

               setTimeout(function () {
             $(window).one('mousemove', window.onafterprint);
             }, 1);
        </script>
    </body>
</html>