<style>
    .address input{float:right}
    span.label {
        text-align: center;
        vertical-align: middle;
        line-height: 24px;
    }
</style>
<form action="/console/customer/billing" method="post">
    <div class="main" style="font-size:14px">
        <div style="">
            <h1 style="color:black; text-align:center;">Collect Bill</h1>

            <table class="address table table-bordered table-striped">

                <tr>
                    <td >
                        <span class="label span4">Customer Code:<?= $customerdata['customer_code'] ?></span>
                        <span class="label span4">Name :<?= $customerdata['customer_name'] ?></span>
                        <span class="label span4">Activation Date :<?= $customerdata['customer_activation_date'] ?></span>
                        <input type="hidden" name="collection_customer" value="<?= $customerdata['customer_ID'] ?>">
                    </td>
                    <td >
                        <span class="label span4">Area :<?= $customerdata['customer_area'] ?></span>
                        <span class="label span4">Address :<?= $customerdata['customer_address'] ?></span>
                        <span class="label span4">Contact :<?= $customerdata['customer_contact'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="label span6">STB Serial No:<?= $customerdata['stb_no'] ?></span></td>
                    <td> <span class="label span6">Vc:<?= $customerdata['stb_vc'] ?></span>
                    </td>
                </tr>
            </table>


            <div class="box span12" style="clear:both;margin: 0 auto">
                <div class="box-header well">
                    <h2><i class="icon-bullhorn"></i> Balance Sheet</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content alerts">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Bill</th>
                                <th>Paid</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center">
                            <?
                            $totalCollected = 0;
                            $totalBilled = 0;
                            foreach ($sheetData as $sheetD):
                                ?>
                                <tr>
                                    <td><span class="label"><?= $sheetD['date'] ?></span></td>
                                    <td><code><?= $sheetD['type'] ?></code></td>
                                    <td><?=
                                        $sheetD['bill'];
                                        $totalBilled += (float) $sheetD['bill']
                                        ?></td>
                                    <td><?=
                                        $sheetD['paid'];
                                        $totalCollected += (float) $sheetD['paid']
                                        ?></td>
                                    <td><i><?= $sheetD['note'] ?></i></td>
                                </tr>
                            <? endforeach; ?>
                            <tr >
                                <td colspan="2"></td>
                                <td style="background-color: buttontext;color:white">Total Billed: <span class="label  label-info"><?= $totalBilled ?></span></td>
                                <td style="background-color: buttontext;color:white">Total Paid: <span class="label  label-warning"><?= $totalCollected ?></span></td>
                                <td style="background-color: buttontext;color:white">Due: <span class="label label-important"><?= $totalBilled - $totalCollected ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="box span12" style="clear:both;margin: 0 auto">
                <div class="box-header well">
                    <h2><i class="icon-bullhorn"></i>Current month's Billing Details</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content alerts" style="display: block">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Name</th>
                                <th>Cost</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center">
                            <? foreach ($billingData as $k => $item): ?>
                                <tr>
                                <tr>
                                    <td><?= $k + 1 ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['cost'] ?></td>
                                </tr>
                                </tr>
                            <? endforeach; ?>
                            <tr >
                                <td colspan="2"></td>
                                <td style="background-color: buttontext;color:white">Total Billed: <span class="label  label-info"><?= $total ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



            <table class="address table table-bordered table-striped">
                <tr align="center" style="text-align:right;">
                    <td>
                        <span class="label"> Collected By:</span>
                        <input required="required" type="text" class="" value="Office" name="collection_collected_by">
                        <div class="clear"></div>
                        <span class="label"> Collection For:</span>
                        <input list="invoices" required="required" type="text" class="collection_for" value="" name="collection_for">
                        <datalist id="invoices">
                            <? foreach ($invoices as $key => $value) { ?>
                                <option value="<?= $value['invoice_for'] ?>">
                                <? } ?>
                        </datalist>
                        <div class="clear"></div>
                        <span class="label"> Collection Date:</span>
                        <input required="required" type="date" class="collection_date" value="<?= date('Y-m-d') ?>" name="collection_date">
                        <div class="clear"></div>
                       
                    
                        <span class="label"> Previous Due :</span>
                        <input type="number" type="number" min="0" max="10000" step="1" required="required" class="invoice_previous_due" name="invoice_previous_due" value="0.00" autocomplete="off" onkeyup="recalculate()">
                        <div class="clear"></div>
                        <span class="label"> Paid Now :</span>
                        <input type="text" required="required" class="collection_amount"  name="collection_amount" value="0.00" autocomplete="off" onkeyup="recalculate()">
                        <div class="clear"></div>
                        <span class="label">Current Due Amount:</span>
                        <input readonly="readonly" type="text" class="invoice_due_amount" value="0.00" >
                        <div class="clear"></div>	
                        <span class="label">Current Advance Amount:</span>
                        <input readonly="readonly" type="text" class="invoice_advance_amount" value="0.00">
                        <div class="clear"></div>	
                         <span class="label">Note:</span>
                        <textarea style="width:99%" name="collection_note"></textarea>
                    </td>
                </tr>

            </table>
            <script>

                /*******************/

                /*******************/

                function recalculate() {

                    if (parseFloat($('.collection_amount').val()) == 'NaN')
                        $('.collection_amount').val(0.00);

                    var amountPending = <?= $totalBilled - $totalCollected ?> - parseFloat($('.collection_amount').val()) + parseFloat($('.invoice_previous_due').val());
                    $('.invoice_advance_amount').val(0.00);
                    $('.invoice_due_amount').val(0.00);

                    if (amountPending > 0) {
                        $('.invoice_due_amount').val(amountPending);
                        $('.invoice_advance_amount').val(0.00);
                    } else {
                        $('.invoice_advance_amount').val((-1) * amountPending);
                        $('.invoice_due_amount').val(0.00);
                    }
                }
                recalculate();
            </script>
        </div>
    </div>
    <input type="checkbox" name="print" value="print">  <span class="label">Print Reciept After Save</span>
    <button type="submit" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span> Generate Bill</button>
</form>
