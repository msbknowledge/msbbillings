<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    td,h3,h5,h6,h4{
        margin-left:4px;
        margin-right:4px;
        margin-bottom: 2px;
        margin-top: 2px;

    }
    .collection td:first-child{width: 590px}
    table{
        width: 100%;
    }
    th{
        text-align: center;
        font-size: 18px;
        background-color: white;
        color: black;
    }
    th{

        font-size: 13px;
    }
    @media print {
        footer {page-break-after: always;}
    }
    td h6 {
        font-size: 10px;
    }
    h5{font-size: 12px}
    .company_details h5{font-size: 10px;}
    .collection  td{border:1px solid black;font-size: 12px;text-align: center}
</style>
<? //pr($data);?>

<div class="container" style="width:21cm; <?
if (count($invoices) == 1) {
    echo 'overflow: hidden;height: 14cm; ';
}
?>">
    <table style="width: 100%;">
        <caption><h5 style="font-size: 20px;font-weight: 900;text-align: center;">Tax Invoice</h5></caption>
        <tr style="border: 1px solid; border-radius: 10px;">
            <td class="company_details"><?= get_option('company_details'); ?></td>
            <td style=" text-align: right;">
                <?php if (get_option('invoice_logo')): ?>
                    <img src="<?= base_url() ?>/uploads/<?= get_option('invoice_logo') ?>" style="width: 44%;" alt="no-imgbn   ">
                <?php else: ?>
                    <img src="<?= base_url() ?>/img_1/simplebillings.png" style=" width: 22%;">
                <?php endif; ?>
                <h5> <b>Generated On:</b><?= date('d/M/Y', strtotime($date)); ?></h5>
                <h5 style=" font-size: 15px;"> <b>Renew Date: <?= date('d/M/Y', strtotime($invoice['invoice_due_date'])); ?></b></h5>

            </td>

        </tr>
    </table>  
    <table>

        <tr style=" border: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: left;">
            <td style=" font-size: 15px;"><h4><?= strtoupper($data['customerData']['customer_name']); ?></h4></td>
            <td style=" border: 1px solid;"><h4><?= $data['customerData']['customer_code']; ?></h4></td>
        </tr>
    </table>
    <table style=" margin-top: 10px;">
        <tr style=" border: 1px solid; text-align: left;">
            <td style=" border: 1px solid;"><h5> <b>Address:</b><?= strtoupper($data['customerData']['customer_address']); ?></h5></td>
            <td style=" border: 1px solid;"><h5><b>Area: </b><?= strtoupper($data['customerData']['customer_area']); ?></h5></td>
            <td style=" border: 1px solid;"><h5><b>Mobile No:</b> <?= $data['customerData']['customer_contact']; ?></h5></td>

        </tr>
        <tr style=" border: 1px solid; text-align: left;">
            <?php if (!empty($data['customerData']['customer_mso_account'])) { ?>
                <td style=" border: 1px solid;"><h5> <b>Number of Connection:</b> Single</h5></td>
                <td  colspan="" style=" border: 1px solid;"><h5> <b>STB (VC) : </b><?= strtoupper($data['customerData']['customer_stb']); ?></h5></td>
                <td style=" border: 1px solid;"><h4><b>Mso account:</b> <?= $data['customerData']['customer_mso_account']; ?></h4></td>

            <? } else { ?>
                <td style=" border: 1px solid;"><h5> <b>Number of Connection:</b> Single</h5></td>
                <td  colspan="2" style=" border: 1px solid;"><h5> <b>STB (VC) : </b><?= strtoupper($data['customerData']['customer_stb']); ?></h5></td>
            <? } ?>
        </tr>
    </table>
    <table style=" margin-top: 10px;">
        <p style="text-align: center; font-size: 17px;margin-top: 10px;font-weight: 600;">Invoice For : <?= $invoice['invoice_for'] ?></p>
        <tr>
            
            <th style="text-align: left;">Package Details</th>
            <th style="text-align: right;">Cost</th>
        </tr>
        <?
        $dataval = json_decode($invoice['invoice_meta'], true);
        $items = $dataval['billings']['items'];

        if (!empty($items))
            foreach ($items as $value) {
                ?>
                <tr style=" border: 1px solid; ">
                    <td style=" border: 1px solid;text-align: left;width: 590px"><h5><?= $value['name'] . " " . $note ?></h5></td>
                    <td style=" border: 1px solid;text-align: right;"><h5><?= $value['price'] ?></h5></td>
                </tr>

            <? } ?>

            <?php if(($invoice['invoice_tax_amount'])>0){
             ?>
        <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>GST</b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?= $invoice['invoice_tax_amount']; ?></h5></td>
        </tr>
        <?php } ?>
        
        <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Total </b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5>
            <?php if(($invoice['invoice_tax_amount'])>0){
            ?>    
            <?= floatval($dataval['billings']['subtotal']) + floatval($dataval['billings']['subtotal']) * 18 / 100; ?>
            <?php }else{
            ?>
                <?= floatval($dataval['billings']['subtotal']);?>
           <?php }
            
            ?>
        </h5></td>
        </tr>
         
        <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Discount</b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?= $dataval['billings']['discount']; ?></h5></td>
        </tr>
        <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Total Round off</b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?= $invoice['invoice_billed_amount']; ?></h5></td>
        </tr>
     <?phpif ?>
        <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Total Payable Due amount <?= date('d/M/Y', strtotime($date)); ?></b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?= (float) (($data['total_invoice_amount_till_date'][0]['invoice_bill'] - $data['total_collection_amount_till_date'][0]['collected_bill'])- $invoice['invoice_billed_amount']) ?></h5></td>
        </tr>
        
        <tr style=" border: 1px solid; ">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Total Previous Due Amount Till <?= date('d/M/Y', strtotime($date)); ?></b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?= (float) ($data['total_invoice_amount_till_date'][0]['invoice_bill'] - $data['total_collection_amount_till_date'][0]['collected_bill']) ?></h5></td>
        </tr> 
        
                <tr style=" border: 1px solid; ">
                    <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Collected Amount Till <?= $data['last_collection_data'][0]['collection_date'] ?></b></h5></td>
                    <td style=" border: 1px solid;text-align: right;"><h5><?= $data['last_collection_data'][0]['collection_amount'] ?></h5></td>
                </tr> 
         
    </table>

    <!---?php if (count($data['last_collection_data'])) { ?>
    
            <center><h4>Last Collections</h4></center>
            <table style=" margin-top: 10px;">
                <tr>
                    <th style="text-align: left;">Collection Date</th>
                    <th style="text-align: right;">Collection Amount</th>
                </tr>
    <!--?php foreach ($data['last_collection_data'] as $val) { ?>
                <tr style=" border: 1px solid; ">

                    <td style=" border: 1px solid;text-align: left;"><h5><date('d/M/Y', strtotime($val['collection_date'])); ?></h5></td>
                    <td style=" border: 1px solid;text-align: right;"><h5>< $val['collection_amount'] ?></h5></td>
                </tr>
   
        </table---->

    <?php if (get_option('counter_part') == 'true') { ?>
        <br> </br>
        <center><h4>Summery</h4></center>
        <table style=" margin-top: 10px;">

            <td style=" font-size: 12px; font-weight: 700;">Customer Name:<?= strtoupper($data['customerData']['customer_name']); ?></td>
            <td style=" font-size: 12px;font-weight: 700;">Customer Code:<?= strtoupper($data['customerData']['customer_code']); ?></td>


            <tr style=" border: 1px solid; ">
                <td style=" border: 1px solid;text-align: left;width: 590px"><h5>Total Invoice Amount Till <?= date('d/M/Y', strtotime($date)); ?></h5></td>
                <td style=" border: 1px solid;text-align: right;"><h5><?= (float) $data['total_invoice_amount_till_date'][0]['invoice_bill'] ?></h5></td>
            </tr>

            <tr style=" border: 1px solid; ">
                <td style=" border: 1px solid;text-align: left;width: 590px"><h5>Total collected Amount Till <?= date('d/M/Y', strtotime($date)); ?></h5></td>
                <td style=" border: 1px solid;text-align: right;"><h5><?= (float) $data['total_collection_amount_till_date'][0]['collected_bill'] ?></h5></td>
            </tr>
            <tr style=" border: 1px solid; ">
                <td style=" border: 1px solid;text-align: left;width: 590px"><h5>Total Due Amount Till <?= date('d/M/Y', strtotime($date)); ?></h5></td>
                <td style=" border: 1px solid;text-align: right;"><h5><?= (float) ($data['total_invoice_amount_till_date'][0]['invoice_bill'] - $data['total_collection_amount_till_date'][0]['collected_bill']) ?></h5></td>
            </tr>                     

            <tr style=" border: 1px solid; ">
                <td style=" border: 1px solid;text-align: left;width: 590px"><h5>Collected Amount </h5></td>
                <td style=" border: 1px solid;text-align: right;"><h5> </h5></td>
            </tr>   
            <tr style=" border: 1px solid; ">
                <td style=" border: 1px solid;text-align: left;width: 590px"><h5>Collection Date </h5></td>
                <td style=" border: 1px solid;text-align: right;"><h5> </h5></td>
            </tr>  
            <tr>
                <td>  <span style="font-size: 15px;width: 100%;display: block;text-align: left; margin-top: 35px;"><b><?= get_option('signature'); ?></b><br><b>Signature of Collection Executive</b></span></td>

                <td> <span style="font-size: 15px;width: 100%;display: block;text-align: right; margin-top: 35px;"><b><?= get_option('signature'); ?></b><br><b>Customer Signature</b></span></td>
            </tr>
        </table>
    <? } ?>
</div>
<?= get_option('option_footer'); ?>

<footer>
    <span style="font-size: 10px;width: 100%;display: block;text-align: center;"><b>Msbbillings.com&copy<?php echo date("Y") ?></b></span>

</footer>
