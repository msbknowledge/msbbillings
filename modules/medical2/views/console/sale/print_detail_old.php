<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Print Invoice</title>
        <link rel="stylesheet" type="text/css" media="print" href="mystyle.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                height: 10in;
                    margin-top:0in;
            }
       
 @media print {
     .container{
		 
     }
}

        </style>
    </head>
    <body>
        <div class="container">
        <div class="page">
            <table style=" border: none;">
                <tr>
                    <th  style=" border: none;width:25%;">
                        
                        <p style=" font-size: 20px; text-align: left; margin: 0px; font-weight: bolder;"><i>Invoice No:<?= $data[0]['sale_invoice'] ?></i><br>
                        Date:<?= date('d/m/Y', strtotime($data[0]['sale_date'])) ?></p>
                        
                        
                        
                    </th>
                    <th  style=" border: none; width: 45%;">
                        <p style=" font-size: 28px; text-align: center; margin: 0px;"><?= strip_tags(get_option('provider_name'))?></p>
                        <p style=" font-size: 17px; text-align: center; margin: 0px;"><?= (get_option('provider_address'))?></p>
                        <p style=" font-size: 17px; text-align: center; margin: 0px;"> 
                        LandLine: <?= strip_tags(get_option('provider_landline'))?></p>
                    </th>
                    <th style="line-height: 20px;border: none; width:27%; font-size: 20px; text-align: right;">
                        <h5>GSTIN:<?= strip_tags(get_option('provider_gst'))?><br/>
                            (B.C.D.A. Membership No.<?= strip_tags(get_option('provider_bcda_no'))?>)<br/>
                            Drug Licence No:<?= strip_tags(get_option('provider_dl'))?></h5>
                    </th>
                </tr>
            </table>  
          
            <table style="border-bottom: 1px solid black;">
                <tr>
					<?if(!empty(trim($data[0]['customer_name']))):?>
                    <th  style=" border: none; text-align: left; font-size: 20px"> Name: <?= $data[0]['customer_name'] ?></th>
					<? endif;?>  
				   <?if(!empty(trim($data[0]['doctor_name']))):?>
                   <th  style=" border: none; text-align: center;  font-size: 20px">Dr Name: <?= $data[0]['doctor_name'] ?></th>
					<? endif;?>  
                    
				   <?if(!empty(trim($data[0]['customer_contact']))):?>
                      <th  style=" border: none; text-align: right;  font-size: 20px "> Phone: <?= $data[0]['customer_contact'] ?></th>
					<? endif;?>  
                    
                </tr>
            </table>
            <table>

            </table>
            <?php
            $total = 0;
            $cgst = 0;
            $sgst = 0;
            ?>

            <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
                <thead>
                <caption><h2>GST Invoice</h2></caption>
                <tr>
                    <th>Sr</th>
                    <th>Product Name</th>
                    <th>HSN</th>
					<th>Strip/<br/>Pack</th>
                    <th>Loose</th>
                    <th>Batch</th>
                    <th>Exp date<br/>(MM/YY)</th>
                    <th>MRP</th>
                    <th>Rate</th>
                    <th>Disc<br/>%</th>
                    <th>Taxable</th>
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
                    $counter = 0;
                    foreach ($data as $k => $value) {
                        if ($value['sale_return'] == true) {
                            continue;
                        }
                        $counter++;
                        ?>    

                        <tr class="rowline"><td>
                                <span><?= $counter ?></span></td>   
                            <td><?= $value['medicine_name'] ?><br/>Mfg: <?= $value['medicine_manufacturer'] ?></td>  
                            <td><?= $value['medicine_hsn'] ?></td>      
                            <td><?= $value['sale_strip_quantity'] ?></td>    
                            <td><?= $value['sale_loose_quantity'] ?></td>    
                            <td><?= $value['sale_batch'] ?></td>   
                            <td><?= $value['sale_expire_month'] ?>/<?= $value['sale_expire_year'] ?></td>  
                            <td><?= $value['sale_mrp'] ?></td>    
                            <td><?= $value['sale_rate'] ?></td>      
                            <td><?= $value['sale_discount_percent'] ?></td>     
                            <td><?= $value['sale_taxable'] ?></td>       
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
                            <td><?=
                                $value['sale_total'];
                                $total += $value['sale_total'];
                                ?></td>    
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table style="border:none;margin-top: 10px" class="sold_calc">
                <tr>
                    <th>Items</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>Total Gst</th>
                    <th>Grand Total</th>    
                    <th>Previous Due</th>
                    <th>Payable</th>
                    <th>Paid</th>
                    <th>Current Due</th>
                    <th>Paid By</th>
                    <th>Payment Note</th>
                </tr>
                <tr>
                    <td class="totalItem"><?= $counter?></td>
                    <td class="totalCgst"><?= $cgst ?></td>
                    <td class="totalSgst"><?= $sgst ?></td>
                    <td class="totalgst"><?= $cgst + $sgst ?></td>
                    <td class="totalAmount"><?= $total ?></td>
                    <td class="customer_due" style="width: 100px;text-align:center">
                        <?= $data[0]['sale_total_previous_due'] ?></td>
                    <td class="customer_payable"><?= round($total + $data[0]['sale_total_previous_due']); ?></td>
                    <td class="paid" style="width: 100px;text-align:center">
                        <?= $data[0]['sale_total_paid'] ?></td>
                    <td class="currentdue"><?= round($data[0]['sale_total_previous_due'] - $data[0]['sale_total_paid'] + $total) ?></td>
                    <td class="method" style="width: 100px;text-align:center">
                        <?php echo $data[0]['sale_paid_by']; ?></td>
                    <td class="paymentnote">
                        <?= $data[0]['sale_note']; ?>
                    </td>
                </tr>
            </table>
            <p style="text-align: left;font-size: 15px;
               margin-top: 15px; margin-bottom: 0px;">Computer generated Invoice and requires no signature</p>
            <p style="text-align: right;font-size: 15px; margin-top: -19px;">Powered By Simplebillings.com</p>
            <table>
                <tr>
                    
                </tr>
            </table>
            
            

        </div>
        </div>
		<script>
		window.print();
		</script>
    </body>
</html>
