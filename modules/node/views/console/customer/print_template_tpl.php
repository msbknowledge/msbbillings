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
<? //pr($customerData);?>

<div class="container" style="width:21cm; <?
if (count($invoices) == 1) {
    echo 'overflow: hidden;height: 14cm; ';
}
?>">
    <table style="width: 100%;">
        <caption><h5 style=" font-size: 17px;text-align: center;"><?= str_ireplace('BILL CUM RECEIPT', 'TAX / INVOICE', get_option('receipt_provider_details')) ?></h5></caption>
        <tr style="border: 1px solid; border-radius: 10px;">
            <td class="company_details"><?= get_option('company_details'); ?></td>
            <td style=" text-align: right;">
                <?php if (get_option('invoice_logo')): ?>
                    <img src="<?= base_url() ?>/uploads/<?= get_option('invoice_logo') ?>" style="width: 44%;" alt="no-imgbn   ">
                <?php else: ?>
                    <img src="<?= base_url() ?>/img_1/simplebillings.png" style=" width: 22%;">
<?php endif; ?>
                <h5> <b>Generated On:</b><?= strtoupper($invoices[0]['invoice_date']); ?></h5>
                <h5> <b>Due On:</b><?= strtoupper($invoices[0]['invoice_due_date']); ?></h5>
            </td>

        </tr>
    </table>  
    <table>

        <tr style=" border: 1px solid; border-right: 1px solid; border-bottom: 1px solid; text-align: left;">
            <td style=" font-size: 15px;"><h4><?= strtoupper($customerData['customer_name']); ?></h4></td>
            <td style=" border: 1px solid;"><h4><?= $customerData['customer_code']; ?></h4></td>
        </tr>
    </table>
    <table style=" margin-top: 10px;">
        <tr style=" border: 1px solid; text-align: left;">
            <td style=" border: 1px solid;"><h5> <b>Address:</b><?= strtoupper($customerData['customer_address']); ?></h5></td>
            <td style=" border: 1px solid;"><h5><b>Area: </b><?= strtoupper($customerData['customer_area']); ?></h5></td>
            <td style=" border: 1px solid;"><h5><b>Mobile No:</b> <?= $customerData['customer_contact']; ?></h5></td>
        </tr>
        <tr style=" border: 1px solid; text-align: left;">
            <td style=" border: 1px solid;"><h5> <b>Number of Connection:</b> Single</h5></td>
             <td  colspan="2" style=" border: 1px solid;"><h5> <b>STB (VC) : </b><?= strtoupper($customerData['customer_stb']); ?></h5></td>

        </tr>
        <tr style=" border: 1px solid; text-align: left;">
           <td style=" border: 1px solid;"><h5> <b>GST No.  </b><?= strtoupper($customerData['customer_gst_no']); ?></h5></td> 
           <td> </td>
           <td> </td>
        </tr>
    
    </table>
    <?
    $totalBilled = 0;
    if (!empty($invoices)) {
        
        ?>
    <? foreach ($invoices as $invoice) { 
      
       ?>


            <table style=" margin-top: 10px;">
                <tr>
                    <th>Invoice For : <?=$invoice['invoice_for'] ?></th>
                    <th>Cost</th>
                </tr>
                <?
                $billings = json_decode($invoice['invoice_meta'], true);
                if(!empty($billings))
                foreach ($billings['billings']['items'] as $value) {
                    $total+= $value['total']
                    ?>
                    <tr style=" border: 1px solid; ">
                        <td style=" border: 1px solid;text-align: left;width: 590px"><h5><?= $value['name'] ?></h5></td>
                        <td style=" border: 1px solid;text-align: right;"><h5><?= $value['price'] ?></h5></td>
                    </tr>

                            <? } ?>
                            <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Total (with GST)</b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?=$billings['billings']['subtotal'];?></h5></td>
        </tr>
        <tr style=" border: 1px solid; text-align: right;">
            <td style=" border: 1px solid;text-align: left;width: 590px"><h5><b>Payable Total Round off</b></h5></td>
            <td style=" border: 1px solid;text-align: right;"><h5><?=$invoice['invoice_billed_amount'];?></h5></td>
        </tr>
            </table>
    <? } ?>
        <table class="collection" style="margin-top:10px;font-weight: bolder; text-align: right;">
            <tr>
                <td style="text-align: left;width:590px;">&nbsp;Total Billed</td>
              
                 <td style="text-align: right;"><?=$billings['total']?>&nbsp;</td>
            </tr>
        </table>
    <? } else { ?>
        <span >No Bill Generated!!</span>
<? } ?>
    <hr>
<? if (!empty($collections)) { ?>
        <table class="collection" style="">
            <caption  style="font-size: 14px"><b>Collection Against This Invoice</b></caption>
            <tr>
                <th>Date</th>
                <th>For</th>
                <th>Amount</th>
                <th>By</th>
            </tr>
    <?
    $totalCollected = 0;
    foreach ($collections as $value) {
        
        ?>
                <tr>
                    <td><?= $value['collection_date'] ?></td>
                    <td><?= $value['collection_for'] ?></td>
                    <td><?= $value['collection_amount'] ?></td>
                    <td><?= $value['collection_collected_by'];
                $totalCollected += (float) $value['collection_amount'];
                ?></td>
                </tr>

    <? } ?>
        </table>
<? } ?>
    <table class="collection">
        <tr >
            <th style="width:590px;text-align: left;border:1px solid black;border-right: none;background-color:white;color:black">&nbsp;Total Due</th>
            <th style="text-align: right;border:1px solid black;border-right: left;background-color:white;color:red!important"><?=$totalCollected ?>&nbsp;</th>
        </tr>
        <tr>
            
        </tr>
    </table>
</div>
<?= get_option('option_footer'); ?>

<footer>
    <span style="font-size: 10px;width: 100%;display: block;text-align: center;"><b>Msbbillings.com&copy<?php echo date("Y") ?></b></span>

</footer>
