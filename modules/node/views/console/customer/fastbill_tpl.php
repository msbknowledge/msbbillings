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
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>

            </div>
            <div class="box-content alerts" style="display:block">
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
                                    <td><code><?= $sheetD['type'] ?>
                                            #<?= $sheetD['ID'] ?>
                                        </code>
                                    </td>
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
            <div class="box-content alerts" style="display: block;text-align: justify;background: white;"> 
                <div class="container" style="">


                    <div class="">



                        <div class="clear"></div>	
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#billing"><b>Bill Package</b></a></li>
                            <li><a data-toggle="tab" href="#fastbilling"><b>Bill Other</b></a></li>
                            <li><a data-toggle="tab" href="#collection"><b>Collection / Adjustment</b></a></li>


                        </ul>
                        <div class="tab-content">
                            <div id="billing" class="tab-pane fade in active">
                                <form method="post" action="/console/customer/quick_bill">
                                    <input type="hidden" name="invoice_customer" value="<?= $customerdata['customer_ID'] ?>">

                                    <table class="table table-bordered table-striped">
                                        <caption>Quick</caption>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Channels/Package</th>
                                                <th>Rate</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="itembody">
                                            <? foreach ($billingData as $k => $item): ?>
                                                <tr>
                                                    <td><span class="btn btn-danger" onclick="removeRow(this)"> - Remove Item</span></td>
                                                    <td><input class="item ui-autocomplete-input" value="<?= $item['name'] ?>" type="text" required="required" placeholder="Name" name="item[]" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></td>
                                                    <td><input type="number" step="0.01" required="required" placeholder="Unit Cost" class="rate" onkeyup="calculateTotal()" value="<?= $item['price'] ?>" name="rate[]"></td>
                                                    <td><input type="number" required="required" min="1" max="20" class="qty" onkeyup="calculateTotal()" placeholder="Howmuch" name="qty[]" value="1"></td>
                                                    <td><input readonly="readonly" type="number" min="0" max="20" class="sum" name="sum[]" value="0.00"></td>
                                                </tr>
                                            <? endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><span class="btn btn-info" onclick="addmore()"> + Add Item</span></td>
                                                <td colspan="3"  style="text-align: right">SubTotal</td>
                                                <td><span class="subtotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">GST</td>
                                                <td><span class="gst"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Grand Total</td>
                                                <td><span class="grandTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Round Total</td>
                                                <td><span class="roundTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Discount</td>
                                                <td><input  class="discount" onkeyup="calculateTotal()" name="discount" type="number" min="0"  value="0.00"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Payable</td>
                                                <td><span class="payable"></span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="clear"></div>
                                    Bill Date
                                    <input type="date" required="required" class="adjustment_date" value="<?= date('Y-m-d') ?>" name="invoice_date">
                                    Due Date
                                    <input type="date" required="required" class="adjustment_date" value="<?= date('Y-m-d', strtotime("+1 year", strtotime("-5 days"))) ?>" name="invoice_due_date">
                                    <button type="submit" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span>Update Package & Generate bill</button>
                                <button type="submit" name="package" value="package" class="btn" data-toggle="button"><span class="icon icon-color icon-save"></span>Update Package Only</button>

                                </form>

                            </div>
                            <div id="fastbilling" class="tab-pane fade">
                                <form method="post" action="/console/customer/quick_bill" style="  padding: 22px; padding-left: 0px;">
                                    <input type="hidden" name="invoice_customer" value="<?= $customerdata['customer_ID'] ?>">

                                    <table class="table table-bordered table-striped">
                                        <caption>Quick billing</caption>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Items/Service</th>
                                                <th>Rate</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="itembody">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><span class="btn btn-info" onclick="add()"> + Add Item</span></td>
                                                <td colspan="3">Total</td>
                                                <td><span class="payable"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">GST</td>
                                                <td><span class="gst"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Grand Total</td>
                                                <td><span class="grandTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Round Total</td>
                                                <td><span class="roundTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Discount</td>
                                                <td><input  class="discount" onkeyup="calculateTotal()" name="discount" type="number" min="0"  value="0.00"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3"  style="text-align: right">Payable</td>
                                                <td><span class="payable"></span></td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <div class="clear"></div>
                                    Bill Date
                                    <input type="date" required="required" class="adjustment_date" value="<?= date('Y-m-d') ?>" name="invoice_date">
                                    Due Date
                                    <input type="date" required="required" class="adjustment_date" value="<?= date('Y-m-d', strtotime("+30 days")) ?>" name="invoice_due_date">
                                    <button type="submit" name="otherbill" value="otherbill" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span> Generate bill</button>

                                </form>
                            </div>
                            
                            
                                                <div id="collection" class="tab-pane fade">
                                                    <form action="/console/customer/billing" method="post" id="quick_collect_form">
                                                        <input type="hidden" name="collection_customer" value="<?= $customerdata['customer_ID'] ?>">

                                                            <span class="label"> Collection For:</span>
                                                            <input list="invoices" required="required" type="text" class="collection_for" value="" name="collection_for" autocomplete="off">
                                                                <datalist id="invoices">

                                                                </datalist>
                                                                <div class="clear"></div>
                                                                <span class="label"> Collection Date:</span>
                                                                <input type="date" required="required" class="collection_date" value="<?= date('Y-m-d') ?>" name="collection_date">
                                                                    <div class="clear"></div>
                                                                    <span class="label"> Paid Now :</span>
                                                                    <input type="text" required="required" class="collection_amount"  name="collection_amount" value="0.00" autocomplete="off" >
                                                                        <div class="clear"></div>  
                                                                        <span class="label"> Collected By:</span>
                                                                        <input required="required" readonly="true" type="text" class="" value="<?= $this->current_user_session['user_firstname'] . ' ' . $this->current_user_session['user_lastname'] ?>" name="collection_collected_by">
                                                                            <div class="clear"></div>
                                                                            <span class="label">Note:</span>

                                                                            <textarea style="width:99%" name="collection_note"></textarea>


                                                                            </form>
                                                                            <button class="btn" onclick="quick_collect()"><span class="icon icon-color icon-cart"></span>Quick Collect</button>
                                                                           
                                                                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#billing .itembody').find('.item').autocomplete({
                source: '/console/channel/channel_search_by_name',
                minLength: 1, select: function (event, ui) {
                    $(this).parent().parent().find('.rate').val('');
                    $(this).parent().parent().find('.sum').val('');
                    $(this).parent().parent().find('.rate').val(ui.item.amount);
                    calculateTotal();
                }

            });
        })

        calculateTotal();

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
            $('#billing .itembody').append(rowdata);
            $('#billing .itembody').find('.item:last').autocomplete({
                source: '/console/channel/channel_search_by_name',
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
            $('#billing .itembody').find('tr').each(function () {
                sum += parseFloat($(this).find('.rate').val()) * parseFloat($(this).find('.qty').val());
                $(this).find('.sum').val(parseFloat($(this).find('.rate').val()) * parseFloat($(this).find('.qty').val()));
            });
            console.log("ok");
            var gst_rate = <?php echo $total_tax_rate?>
            /*****set GRAND total*********/
            var gst =  (sum*gst_rate/100);
            var grandTotal = sum + gst;
            $('#billing .subtotal').html(sum);
            $('#billing .gst').html(gst.toFixed(2));
            $('#billing .grandTotal').html(grandTotal.toFixed(2));
            $('#billing .roundTotal').html(Math.round(parseFloat($('#billing .grandTotal').html())));

            var payable = parseFloat($('#billing .roundTotal').html()) - parseFloat($('#billing .discount').val())
            $('#billing .payable').html(payable)


        }
        
        
        
                /**************inventory surch***************88****/


        $(document).ready(function () {
            $('#fastbilling .itembody').find('.item').autocomplete({
                source: '/console/inventory/inventory_search_by_name',
                minLength: 1, select: function (event, ui) {
                    $(this).parent().parent().find('.rate').val('');
                    $(this).parent().parent().find('.sum').val('');
                    $(this).parent().parent().find('.rate').val(ui.item.amount);
                    calTotal();
                }

            });
        })

        function removeRow(targetRow) {
            $(targetRow).parents('tr').remove();
            calTotal();
        }

        function add() {
            var rowdata = "<tr>\r\n <td><span class=\"btn btn-danger\" onclick=\"removeRow(this)\"> - Remove Item<\/span><\/td>\n\
\r\n                                            \n\
<td><input class=\"item\" type=\"text\" required=\"required\" placeholder=\"Name\" name=\"item[]\"><\/td>\r\n \n\
<td><input type=\"number\" step=\"0.01\" required=\"required\" placeholder=\"Unit Cost\" class=\"rate\" onkeyUp=\"calTotal()\" value=\"0.00\" name=\"rate[]\"><\/td>\r\n\n\
<td><input type=\"number\"  required=\"required\" min=\"1\" max=\"20\" class=\"qty\" onkeyUp=\"calTotal()\" placeholder=\"Howmuch\" name=\"qty[]\" value=\"1\"><\/td>\r\n \n\
<td><input readonly=\"readonly\" type=\"number\" min=\"0\" max=\"20\" class=\"sum\" name=\"sum[]\" value=\"0.00\"><\/td>\r\n                                        <\/tr>";
            $('#fastbilling .itembody').append(rowdata);
            $('#fastbilling .itembody').find('.item:last').autocomplete({
                source: '/console/inventory/inventory_search_by_name',
                minLength: 1, select: function (event, ui) {
                    $(this).parent().parent().find('.rate').val('');
                    $(this).parent().parent().find('.sum').val('');
                    $(this).parent().parent().find('.rate').val(ui.item.amount);
                    calTotal();
                }

            });
        }

        function calTotal() {
            var sum = 0.00;
            /*****set individual total*********/
            $('#fastbilling .itembody').find('tr').each(function () {
                sum += parseFloat($(this).find('.rate').val()) * parseFloat($(this).find('.qty').val());
                $(this).find('.sum').val(parseFloat($(this).find('.rate').val()) * parseFloat($(this).find('.qty').val()));
            });
            console.log("ok2");
            /*****set GRAND total*********/
            var gst_rate =  <?php echo $total_tax_rate; ?>;
            var gst =  (sum*gst_rate/100);
            var grandTotal = sum + gst;
            $('#fastbilling .subtotal').html(sum);
            $('#fastbilling .gst').html(gst.toFixed(2));
            $('#fastbilling .grandTotal').html(grandTotal.toFixed(2));
            $('#fastbilling .roundTotal').html(Math.round(parseFloat($('#fastbilling .grandTotal').html())));

            var payable = parseFloat($('#fastbilling .roundTotal').html()) - parseFloat($('#fastbilling .discount').val())
            $('#fastbilling .payable').html(payable)


        }
        

            /**************collection  billing*******************/
            
            
            function quick_collect(){
        $.post('/console/customer/billing',$('#quick_collect_form').serializeArray(),function(resp){
            alert('Collection successfull!!');
                window.location.reload();
         });
        
    }
   

    </script>
</div>
</div>

