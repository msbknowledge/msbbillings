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
	<h1>Money Receipt</h1>
        <h2><?=get_option('company_name');?></h2>
        <p> <?=get_option('company_address');?> <br/>GST No: <?=get_option('GST');?></p>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    <h3>Inv: #<?= $data['last_collection_data'][0]['collection_ID']; ?> (<?= $data['last_collection_data'][0]['collection_for']; ?>)</h3>
    <?php 
      date_default_timezone_set('Asia/Kolkata');
      $invoice_generate_time =  date('H:i:s A',strtotime($data['last_collection_data'][0]['collection_entry_timestamp']. ' GMT'));
    ?>
     <h4><b>Generated On: </b><?= date('d/M/Y', strtotime($date)); ?> <?= $invoice_generate_time;?>
	<br/>
  <b>Renew Date: <?= date('d/M/Y', strtotime($invoice['invoice_due_date'])); ?></b></h4>
    <div id="mid">
      <div class="info">
        <h1>Customer Info</h1>
        <p> <b style="font-size: large;"><?= strtoupper($data['customerData']['customer_name']); ?> (<?= $data['customerData']['customer_code']; ?>)</b> <br/><br/>         
<b style="font-size: large;">Address: </b><br/><b style="font-size: 13px;"><?= strtoupper($data['customerData']['customer_address']); ?></b><br/><br/>
<b style="font-size: large;">Mobile No: </b><b style="font-size: 15px;"><?= $data['customerData']['customer_contact']; ?></b><br/><br/>
<b style="font-size: large;">Customer IP: </b><b style="font-size: 13px;"><?= strtoupper($data['customerData']['customer_ip']); ?></b><br/><br/>
<b style="font-size: large;">User name: </b><b style="font-size: 15px;"><?= strtoupper($data['customerData']['customer_user_name']); ?></b><br/><br/>
<b style="font-size: large;">Number of Connection: </b><b style="font-size: 15px;">Single</b><br/><br/>
   </p>
      </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

					<div id="table">
						

    <table style=" margin-top: 10px;">
        <p style="text-align: center; font-size: 20px;margin-top: 10px;font-weight: 600;">Collections For : <?= $data['last_collection_data'][0]['collection_for'] ?></p>
        <tr class="tabletitle">
            
            <th style="text-align: left;font-size: 19px">Collection Details</th>
            <th style="text-align: right;font-size: 19px">Amount</th>
        </tr>
        
                <tr style="text-align: right;">
                    <td class="tableitem" style="text-align: left;width: 590px"><b>Total Invoice Amount<br>(with GST)</b></td>
                    <td class="tableitem"  style="text-align: right;"><b>₹<?=(float)$data['total_invoice_amount_till_date'][0]['invoice_bill']?>/-</b></td>
                </tr>

        <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Total Paid Amount</b></td>
            <td style="text-align: right;"><b>₹<?=(float)$data['total_collection_amount_till_date'][0]['collected_bill']?>/-</b></td>
        </tr>
  
        
        <!-- <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Total </b></td>
            <td style="text-align: right;">₹<?=
                    $invoice['invoice_billed_amount'];
                    $totalBilled += (float) $invoice['invoice_billed_amount'];
                    ?>/-
            </td>
        </tr> -->
         
        <!-- <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Discount</b></td>
            <td style="text-align: right;">₹<?= $dataval['billings']['discount']; ?>/-</td>
        </tr> -->
        <!-- <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>Total Round off</b></td>
            <td style="text-align: right;">₹<?= $invoice['invoice_billed_amount']; ?>/-</td>
        </tr> -->
     <?phpif ?>
        <tr class="tabletitle" style=" text-align: right;">
            <td  style="text-align: left;width: 590px"><h3><b>Total Due Amount:</b></h3></td>
            <td style="text-align: right;"><h3><b>₹<?=($data['total_invoice_amount_till_date'][0]['invoice_bill']-$data['total_collection_amount_till_date'][0]['collected_bill'])?>/-</b></h3></td>
        </tr>
        
              <?php if (!empty($data['last_collection_data'][0]['collection_amount'])) { ?>
                <tr style=" ">
                    <td colspan="2" style="text-align: left"><b>Last Collected: ₹<?= $data['last_collection_data'][0]['collection_amount'] ?>/- On <?=  date('d/M/Y', strtotime($data['last_collection_data'][0]['collection_date'])) ?></b></td>
                    <!-- <td style="text-align: right;"></td> -->
                </tr> 
              <?php } ?>
         
    </table>
					</div><!--End Table-->

					<div id="legalcopy">
						<p class="legal"><strong>Thank you!<br/> <small>powered by <br/>www.simplebillings.comee</small></strong>
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->


