<style>
  #invoice-POS {
    box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    margin: 0 auto;
    width: 80mm;
    background: #FFF;
    padding: 2mm;
    overflow: hidden;

  }

  ::selection {
    background: #f31544;
    color: #FFF;
  }

  ::moz-selection {
    background: #f31544;
    color: #FFF;
  }

  h1 {
    font-sizex: 1.5em;
  }

  h2 {
    font-sizex: .9em;
  }

  h3 {
    font-sizex: 1.2em;
    font-weight: 300;
    line-height: 2em;
  }

  p {
    font-sizex: .7em;
    line-height: 1.2em;
  }

  #top,
  #mid,
  #bot {
    /* Targets all id with 'col-' */
    border-bottom: 1px solid #EEE;
  }

  #top {
    min-height: 100px;
  }

  #mid {
    min-height: 80px;
  }

  #bot {
    min-height: 50px;
  }


  .info {
    display: block;
    margin-left: 0;
  }

  .title {
    float: right;
  }

  .title p {
    text-align: right;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  td {
    padding: 5px 0 5px 15px;
    border: 1px solid #EEE
  }

  .tabletitle {
    padding: 5px;
    font-sizex: .5em;
    background: #EEE;
  }

  .service {
    border-bottom: 1px solid #EEE;
  }

  .item {
    width: 24mm;
  }

  .itemtext {
    font-sizex: .5em;
  }

  #legalcopy {
    margin-top: 5mm;
    text-align: center;
  }
</style>

<div id="invoice-POS">

  <center id="top">
    <div class="info">
      <h1>Tax Invoice</h1>
      <h2><?= get_option('company_name'); ?></h2>
      <p> <?= get_option('company_address'); ?> <br />GST No: <?= get_option('GST'); ?></p>
    </div>
    <!--End Info-->
  </center>
  <!--End InvoiceTop-->
  <h3>Inv: #<?= $invoice['invoice_ID']; ?> (<?= $invoice['invoice_for']; ?>)</h3>
  <?php 
   date_default_timezone_set('Asia/Kolkata');
  $invoice_generate_time =  date('H:i:s A',strtotime($invoice['invoice_entry_timestamp']. ' GMT')); 
  ?>

  <h4> <b>Generated On: </b><?= date('d/M/Y', strtotime($date)); ?> <?= $invoice_generate_time;?>
    <br />
    <b>Renew Date: <?= date('d/M/Y', strtotime($invoice['invoice_due_date'])); ?></b>
  </h4>
  <div id="mid">
    <div class="info">
      <h1>Customer Info.</h1>
      <p> <b style="font-size: large;"><?= strtoupper($data['customerData']['customer_name']); ?> <?= !empty($data['customerData']['customer_code']) ? ' (' . $data['customerData']['customer_code'] . ')' : '' ?></b> <br /><br />
        <b style="font-size: large;">Address:</b><br /><b style="font-size: 13px;"><?= strtoupper($data['customerData']['customer_address']); ?></b><br /><br />
        <b style="font-size: large;">Mobile No: </b><b style="font-size: 15px;"><?= $data['customerData']['customer_contact']; ?></b><br /><br />
        <b style="font-size: large;">STB(VC): </b><b style="font-size: 15px;"><?= strtoupper($data['customerData']['customer_stb']); ?></b><br /><br />
      </p>
    </div>
  </div>
  <!--End Invoice Mid-->

  <div id="bot">

    <div id="table">


      <table style=" margin-top: 10px;">
        <p style="text-align: center; font-size: 20px;margin-top: 10px;font-weight: 600;">Invoice For: <?= $invoice['invoice_for'] ?></p>
        <tr class="tabletitle">

          <th style="text-align: left;font-size: 19px">Package Details</th>
          <th style="text-align: right;font-size: 19px">Cost</th>
        </tr>
        <?
        $dataval = json_decode($invoice['invoice_meta'], true);
        $items = $dataval['billings']['items'];

        if (!empty($items))
          foreach ($items as $value) {
        ?>
          <tr style=" ">
            <td class="tableitem" style="text-align: left;width: 590px"><b><?= $value['name'] . " " . $note ?></b></td>
            <td class="tableitem" style="text-align: right;"><b>₹<?= $value['price'] ?>/-</b></td>
          </tr>

        <? } ?>

        <?php if (($invoice['invoice_tax_amount']) > 0) {
        ?>
          <tr style=" text-align: right;">
            <td style="text-align: left;width: 590px"><b>GST</b></td>
            <td style="text-align: right;"><b>₹<?= $invoice['invoice_tax_amount']; ?>/-</b></td>
          </tr>
        <?php } ?>

        <tr style=" text-align: right;">
          <td style="text-align: left;width: 590px"><b>Total </b></td>
          <td style="text-align: right;"><b>₹<?php if (($invoice['invoice_tax_amount']) > 0) { ?><?= number_format((floatval($dataval['billings']['subtotal']) + floatval($dataval['billings']['subtotal']) * 18 / 100), 2); ?><?php } else { ?><?= number_format(floatval($dataval['billings']['subtotal']), 2); ?><?php } ?>/-</b>
          </td>
        </tr>

        <tr style=" text-align: right;">
          <td style="text-align: left;width: 590px"><b>Discount</b></td>
          <td style="text-align: right;"><b>₹<?= $dataval['billings']['discount']; ?>/-</b></td>
        </tr>
        <tr style=" text-align: right;">
          <td style="text-align: left;width: 590px"><b>Total Round off</b></td>
          <td style="text-align: right;"><b>₹<?= $invoice['invoice_billed_amount']; ?>/-</b></td>
        </tr>
        <!-- <tr style=" text-align: right;">
          <td style="text-align: left;width: 590px">
            <h3><b>Previous Due</b></h3>
          </td>
          <?php
          $total_due = (float) ($data['previous_invoice_amount'][0]['invoice_amount'] - $data['previous_collect_amount'][0]['collected_amount']); ?>
          <td style="text-align: right;">
            <h3><b>₹<?= $total_due; ?>/-</b></h3>
          </td>
        </tr> -->
        <tr class="tabletitle" style=" text-align: right;">
          <td style="text-align: left;width: 590px">
            <!-- <h3><b>Payable amount<br /> (with previous due)</b></h3> -->
            <h3><b>Payable amount</b></h3>
          </td>
          <td style="text-align: right;">
            <h3><b>₹<?= (float) $invoice['invoice_billed_amount']  ?>/-</b></h3>
          </td>
        </tr>


        <?php if (!empty($data['last_collection_data'][0]['collection_amount'])) { ?>
          <tr>
            <td style="text-align: left"><b>Last Collected ₹<?= $data['last_collection_data'][0]['collection_amount'] ?>/- On <?= date('d/M/Y', strtotime($data['last_collection_data'][0]['collection_date'])) ?></b></td>
            <td style="text-align: right;"></td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <!--End Table-->

    <div id="legalcopy">
      <p class="legal"><strong>Thank you!<br /> <small>powered by <br />www.Msbbillings.in </small></strong>
      </p>
    </div>

  </div>
  <!--End InvoiceBot-->
</div>
<!--End Invoice-->