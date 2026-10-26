<style>
    .address input{float:right}
    span.label {
        text-align: center;
        vertical-align: middle;
        line-height: 24px;
    }
</style>
<div class="main" style="font-size:14px">
    <div style="">
        <h1 style="color:black; text-align:center;">Collect Bill</h1>

        <table class="address table table-bordered table-striped">

            <tr>
                <td >
                    <span class="label span4">Customer Code:<?= $customerdata['customer_code'] ?></span>
                    <span class="label span4">Name :<?= $customerdata['customer_name'] ?></span>
                    <span class="label span4">Activation Date :<?= $customerdata['customer_activation_date'] ?></span>
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
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-down"></i></a>
                </div>
            </div>
            <div class="box-content alerts" style="display:none">
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
                        foreach ($sheetData as $sheetX):
                            foreach ($sheetX as $sheetD):
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
                <h2><i class="icon-bullhorn"></i>Accounting</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content alerts" style="display: block;text-align: justify">
                <div class="container">
                    <h2>Easy Billing Section</h2>
                    <p>Choose What you want to do.For Account based Adjustment Use <b>Adjustment</b><br>
                        <span class="label label-warning">** Do not put Adjustment On Collection,May Result Error. Use Proper Section For Proper Accounting</span></p>
                    <span class="label label-warning">*** This System Do not Support Discounting On A particular bill.</span></p>
                    <div class="clear"></div>	

                    <span class="label">Current Due Amount:</span>
                    <input readonly="readonly" type="text" class="invoice_due_amount" value="0.00" >
                    <div class="clear"></div>	
                    <span class="label">Current Advance Amount:</span>
                    <input readonly="readonly" type="text" class="invoice_advance_amount" value="0.00">
                    <div class="clear"></div>	

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#collection">Collection</a></li>
                        <li><a data-toggle="tab" href="#adjustment">Adjustment</a></li>
                        <li><a data-toggle="tab" href="#billing">Billing</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="collection" class="tab-pane fade in active">
                            <form action="/console/customer/billing" method="post">
                                <input type="hidden" name="collection_customer" value="<?= $customerdata['customer_ID'] ?>">
                                <h3>Collection</h3>
                                <span class="label"> Collection For:</span>
                                <input list="invoices" required="required" type="text" class="collection_for" value="" name="collection_for">
                                <datalist id="invoices">
                                    <? foreach ($invoices as $key => $value) { ?>
                                        <option value="<?= $value['invoice_for'] ?>">
                                        <? } ?>
                                </datalist>
                                <div class="clear"></div>
                                <span class="label"> Collection Date:</span>
                                <input type="date" required="required" class="collection_date" value="<?= date('Y-m-d') ?>" name="collection_date">
                                <div class="clear"></div>
                                <span class="label"> Paid Now :</span>
                                <input type="text" required="required" class="collection_amount"  name="collection_amount" value="0.00" autocomplete="off" onkeyup="recalculate()">
                                <div class="clear"></div>  
                                <span class="label"> Collected By:</span>
                                <input required="required" readonly="true" type="text" class="" value="<?= $this->current_user_session['user_firstname'] . ' ' . $this->current_user_session['user_lastname'] ?>" name="collection_collected_by">
                                <div class="clear"></div>
                                <span class="label">Note:</span>

                                <textarea style="width:99%" name="collection_note"></textarea>

                                <input type="checkbox" name="print" value="print">  <span class="label">Print Reciept After Save</span>
                                <button type="submit" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span> Generate Bill</button>
                            </form>
                        </div>
                        <div id="adjustment" class="tab-pane fade">
                            <form action="/console/customer/billing" method="post">
                                <input type="hidden" name="collection_customer" value="<?= $customerdata['customer_ID'] ?>">
                                <h3>Adjustment on Account</h3>
                                <p>You can Add Amount (even in negative) to Adjust The balance sheet
                                    <span class="label label-info">i.e -300 For Decreasing Value, or 300 For Adding Value</span></p>

                                </p>
                                <div class="clear"></div>
                                <span class="label"> Adjustment Done By:</span>
                                <input required="required" readonly="true" type="text" class="" value="<?= $this->current_user_session['user_firstname'] . ' ' . $this->current_user_session['user_lastname'] ?>" name="collection_collected_by">
                                <div class="clear"></div>
                                <span class="label">Date:</span>
                                <input type="date" required="required" class="adjustment_date" value="<?= date('Y-m-d') ?>" name="adjustment_date">
                                <div class="clear"></div>
                                <span class="label">Adjust Amount:</span>
                                <input type="number" type="number" min="-100000" max="10000" required="required" class="invoice_adjustment" name="invoice_adjustment" value="0.00" autocomplete="off" onkeyup="recalculate()">
                                <div class="clear"></div>
                                <button type="submit" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span> Settel Amount</button>
                            </form>
                        </div>
                        <div id="billing" class="tab-pane fade">
                            <form method="post" action="/console/customer/quick_bill">
                                <input type="hidden" name="collection_customer" value="<?= $customerdata['customer_ID'] ?>">

                                <table class="table table-bordered table-striped">
                                    <caption>Quick billing</caption>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Item/Service Package</th>
                                            <th>Rate</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="itembody">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><span class="btn btn-info" onclick="addmore()"> + Add Item</span></td>
                                            <td colspan="3">Total</td>
                                            <td><input readonly="readonly" class="grandTotal" name="grandTotal" type="number" min="0" max="20" value="0.00"></td>
                                        </tr>

                                    </tfoot>

                                </table>
                                <div class="clear"></div>
                                <button type="submit" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span> Generate bill</button>

                            </form>
                        </div>
                    </div>
                </div>

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
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center">
                        <? 
                        foreach ($billingData as $k => $item): ?>
                            <tr>
                            <tr>
                                <td style=" width: 250px;"><?= $k + 1 ?></td>
                                <td style=" width: 250px;"><?= $item['name'] ?></td>
                                <td style=" width: 250px;"><?= $item['price'] ?></td>
                            </tr>
                            </tr>
                        <? endforeach; ?>
                        <tr >
                            <td colspan="2" style="text-align:right">Total with GST:</td>
                            <td><span class="label  label-info"><? if($sub_total==0){echo "0";}else{ echo "$sub_total";} ?></span>
                            </td>
                        </tr>
                        <tr >
                            <td colspan="2" style="text-align:right">Payable Roundoff:</td>
                            <td style="background-color: buttontext;color:white; float: left; width: 96%;"><span class="label  label-info" style=" float: left; "><?if($total==0){echo "0";}else{ echo "$total";} ?></span>
                                <form method="post" action="<?=console_url('customer/create_bill/')?>" style="    float: right;">
                                        <input type="hidden"  value="<?=$customerdata['customer_ID'] ?>" name="customer_ID">
                                        <input type="date" required="required" class="adjustment_date" value="<?= date('Y-m-d') ?>" name="invoice_date">
                                        <button type="submit" class="btn btn-info pull-right" style=" margin-left: 10px;">Generate Bill</button></form>
                            
                            
                            </td>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function removeRow(targetRow) {
                $(targetRow).parents('tr').remove();
                calculateTotal();
            }
            function addmore() {
                var rowdata = "<tr>\r\n <td><span class=\"btn btn-danger\" onclick=\"removeRow(this)\"> - Remove Item<\/span><\/td>\n\
        \r\n                                            \n\
<td><input class=\"item\" type=\"text\" required=\"required\" placeholder=\"Name\" name=\"item[]\"><\/td>\r\n \n\
<td><input type=\"number\" step=\"0.01\" required=\"required\" placeholder=\"Unit Cost\" class=\"rate\" onkeyUp=\"calculateTotal()\" value=\"0.00\" name=\"rate[]\"><\/td>\r\n\n\
<td><input type=\"number\"  required=\"required\" min=\"1\" max=\"20\" class=\"qty\" onkeyUp=\"calculateTotal()\" placeholder=\"Howmuch\" name=\"qty[]\" value=\"1\"><\/td>\r\n \n\
<td><input readonly=\"readonly\" type=\"number\" min=\"0\" max=\"20\" class=\"sum\" name=\"sum[]\" value=\"0.00\"><\/td>\r\n                                        <\/tr>";
                $('.itembody').append(rowdata);
                $('.itembody').find('.item:last').autocomplete({
                    source: '/console/inventory/inventory_search_by_name',
                    minLength: 1, select: function (event, ui) {
                         $(this).parent().parent().find('.rate').val('');
                         $(this).parent().parent().find('.sum').val('');
                        $(this).parent().parent().find('.rate').val(ui.item.amount);
                        calculateTotal();
                    }

                });
            }
            /*******************/

            /*******************/
            //addmore();
            function calculateTotal() {
                var sum = 0.00;
                /*****set individual total*********/
                $('.itembody').find('tr').each(function () {
                    sum += parseFloat($(this).find('.rate').val()) * parseFloat($(this).find('.qty').val());
                    $(this).find('.sum').val(parseFloat($(this).find('.rate').val()) * parseFloat($(this).find('.qty').val()));
                });
                /*****set GRAND total*********/
                $('.grandTotal').val(sum);

            }
            function recalculate() {

                if (parseFloat($('.collection_amount').val()) == 'NaN')
                    $('.collection_amount').val(0.00);

                var amountPending = <?= $totalBilled - $totalCollected ?> - parseFloat($('.collection_amount').val()) + parseFloat($('.invoice_adjustment').val());
              amountPending=amountPending.toFixed(2);
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
            $('.nav').find('a').click(function () {
                $('.invoice_adjustment').val(0.00);
                $('.collection_amount').val(0.00);
                recalculate();

            })
        </script>
    </div>
</div>

