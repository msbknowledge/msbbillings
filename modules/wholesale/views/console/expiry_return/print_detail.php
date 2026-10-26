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
                height: 1100px;
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
  top: 945px;
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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="page">
                <table style=" border: none;">
                    <tr>
                        <th  style=" border: none;width:25%;">
                                    <h5><?= $data[0]['supplier_name'] ?><br/><?= $data[0]['supplier_address'] ?><br/></h5>
                               
                               



                        </th>
                        <th  style=" border: none; width: 45%;">
                            <p style=" font-size: 28px; text-align: center; margin: 0px;"><?= strip_tags(get_option('provider_name')) ?></p>
                            <p style=" font-size: 17px; text-align: center; margin: 0px;"><?='CHEMIST & DRUGGIST'?></p>
                            <p style=" font-size: 17px; text-align: center; margin: 0px;"><?= (get_option('provider_address')) ?></p>
                            <p style=" font-size: 17px; text-align: center; margin: 0px;"> 
                                LandLine: <?= strip_tags(get_option('provider_landline')) ?></p>
                            <p style=" font-size: 17px; text-align: center; margin: 0px;"> 
                                Mobile: <?= strip_tags(get_option('provider_mobile')) ?></p>
                            
                        </th>
                        <th style="line-height: 20px;border: none; width:27%; font-size: 20px; text-align: right;">
                            <h5>GSTIN:<?= strip_tags(get_option('provider_gst')) ?><br/>
                                (B.C.D.A. Membership No.<?= strip_tags(get_option('provider_bcda_no')) ?>)<br/>
                                Drug Licence No:<?= strip_tags(get_option('provider_dl')) ?></h5>
                             <h5>Date:<?=$data[0]['expiry_return_date']?></h5> 
                        </th>
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
    <caption><h3 style="text-align: left;float: left;">Entry No:<?=$data[0]['expiry_return_entry_number']?></h3>
    <h3 style="text-align: right;">Items Ref:<?=$data[0]['expiry_return_ref']?></h3> </caption>
        
        <tr>
            <th>Sr</th>
            <th>Product Name</th>
             <th>HSN</th>
              <th>Batch</th>
            <th>Strip</th>
            <th>Exp date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Total</th>

        </tr>
    </tr>
</thead>
<tbody class="appendHere">
    <?php
    $counter = 0;
    $total = 0;
    foreach ($data as $k => $value) {
        if ($value['expiry_return_return'] == true) {
            continue;
        }
        $counter++;
        ?>    

        <tr class="rowline"><td>
                <span><?= $counter ?></span></td>   
            <td ><?= $value['expiry_return_product'] ?></td> 
             <td><?= $value['expiry_return_HSN'] ?></td> 
              <td><?= $value['expiry_return_Batch'] ?></td> 
            <td><?= $value['expiry_return_strip'] ?></td>   
            <td><?= $value['expiry_return_expire_month'] ?>/<?= $value['expiry_return_expire_year'] ?></td>  
            <td><?= $value['expiry_return_mrp'];?></td>    
            <td><?= (float)$value['expiry_return_mrp']*(float)$value['expiry_return_strip'];$total = (float)$value['expiry_return_mrp']*(float)$value['expiry_return_strip']+$total  ?></td>    

             </tr>
    <?php } ?>
             <tr>
            <td colspan="6"></td>
            <td>Total</td>
            <td><?=$total?></td>

        </tr>
</tbody>
</table>




            </div>
        </div>

        <script>
            window.print();
        </script>
    </body>
</html>