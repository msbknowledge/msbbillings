<style>
#invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  margin: 0 auto;
  width: 80mm;
  background: #FFF;
padding: 2mm;overflow:hidden;
  
}  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-sizex: 1.5em;
}
h2{font-sizex: .9em;}
h3{
  font-sizex: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-sizex: .7em;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}


.info{
  display: block;
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;} 
table{
  width: 100%;
  border-collapse: collapse;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}
.tabletitle{
  padding: 5px;
  font-sizex: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-sizex: .5em;}

#legalcopy{
  margin-top: 5mm;
	text-align:center;
}

</style>

  <div id="invoice-POS">
    
    <center id="top">
      <div class="info"> 
	<h1>Tax Invoice</h1>
        <h2><?=get_option('company_name');?></h2>
        <p> <?=get_option('company_address');?> <br/>GST No: <?=get_option('GST');?></p>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    <h4>Inv# <?= $invoice['invoice_for'] ?></h4>
     <h5> <b>Generated On:</b><?= date('d/M/Y', strtotime($date)); ?>
	<br/>
<b>Renew Date: <?= date('d/M/Y', strtotime($invoice['invoice_due_date'])); ?></b></h5>
    <div id="mid">
      <div class="info">
        <h2>student Info</h2>
        <p> <b><?= strtoupper($data['studentData']['student_name']); ?> (<?= $data['studentData']['student_code']; ?>)</b> <br/><br/>
<b>Address:</b><br/><?= strtoupper($data['studentData']['student_address']); ?><br/><br/>
<b>Mobile No:</b> <?= $data['studentData']['student_contact']; ?><br/><br/>
<b>STB (VC) : </b><?= strtoupper($data['studentData']['student_stb']); ?><br/><br/>
   </p>
      </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

					<div id="table">
						

    <table style=" margin-top: 10px;">
        <p style="text-align: center; font-size: 17px;margin-top: 10px;font-weight: 600;">Invoice For : <?= $invoice['invoice_for'] ?></p>
        <tr class="tabletitle">
            
            <th style="text-align: left;">Package Details</th>
            <th style="text-align: right;">Cost</th>
        </tr>
        <?
        $dataval = json_decode($invoice['invoice_meta'], true);
        $items = $dataval['billings']['items'];

        if (!empty($items))
            foreach ($items as $value) {
                ?>
                <tr style=" ">
                    <td class="tableitem" style="text-align: left;width: 590px"><?= $value['name'] . " " . $note ?></td>
                    <td class="tableitem"  style="text-align: right;"><?= $value['price'] ?></td>
                </tr>

            <? } ?>

            <?php if(($invoice['invoice_tax_amount'])>0){
             ?>
        <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>GST</b></td>
            <td style="text-align: right;"><?= $invoice['invoice_tax_amount']; ?></td>
        </tr>
        <?php } ?>
        
        <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Total </b></td>
            <td style="text-align: right;">
            <?php if(($invoice['invoice_tax_amount'])>0){
            ?>    
            <?= floatval($dataval['billings']['subtotal']) + floatval($dataval['billings']['subtotal']) * 18 / 100; ?>
            <?php }else{
            ?>
                <?= floatval($dataval['billings']['subtotal']);?>
           <?php }
            
            ?>
        </td>
        </tr>
         
        <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Discount</b></td>
            <td style="text-align: right;"><?= $dataval['billings']['discount']; ?></td>
        </tr>
        <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Total Round off</b></td>
            <td style="text-align: right;"><?= $invoice['invoice_billed_amount']; ?></td>
        </tr>
     <?phpif ?>
        <tr class="tabletitle" style=" text-align: right;">
            <td  style="text-align: left;width: 590px"><h5><b>Due amount <?= date('d/M/Y', strtotime($date)); ?></b></h5></td>
            <td style="text-align: right;"><h5><?= (float) (($data['total_invoice_amount_till_date'][0]['invoice_bill'] - $data['total_collection_amount_till_date'][0]['collected_bill'])- $invoice['invoice_billed_amount']) ?></h5></td>
        </tr>
        
        <tr  style=" ">
            <td style="text-align: left;width: 590px"><h5><b>Total with Previous Due Till <?= date('d/M/Y', strtotime($date)); ?></b></h5></td>
            <td style="text-align: right;"><h5><?= (float) ($data['total_invoice_amount_till_date'][0]['invoice_bill'] - $data['total_collection_amount_till_date'][0]['collected_bill']) ?></h5></td>
        </tr> 
        
                <tr style=" ">
                    <td style="text-align: left;width: 590px"><h5><b>Collected Amount Till <?= $data['last_collection_data'][0]['collection_date'] ?></b></h5></td>
                    <td style="text-align: right;"><h5><?= $data['last_collection_data'][0]['collection_amount'] ?></h5></td>
                </tr> 
         
    </table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Thank you!<br/> <small>powered by www.simplebillings.com</small></strong>
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->


