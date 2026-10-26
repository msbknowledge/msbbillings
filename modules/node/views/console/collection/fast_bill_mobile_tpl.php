<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    // Convert numbers to words
    // copyright 25th July 2006, by Stephen Chapman http://javascript.about.com
    // permission to use this Javascript on your web page is granted
    // provided that all of the code (including this copyright notice) is
    // used exactly as shown (you can change the numbering system if you wish)

    // American Numbering System
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];
    // uncomment this line for English Number System
    // var th = ['','thousand','million', 'milliard','billion'];

    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    function toWords(s) {
        s = s.toString();
        s = s.replace(/[\, ]/g, '');
        if (s != parseFloat(s))
            return 'not a number';
        var x = s.indexOf('.');
        if (x == -1)
            x = s.length;
        if (x > 15)
            return 'too big';
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0)
                    str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk)
                    str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            var y = s.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++)
                str += dg[n[i]] + ' ';
        }
        return str.replace(/\s+/g, ' ').toUpperCase();

    }
</script>
<style>
    .addmore_adon{ background-color: gainsboro}
</style>
<?php if (isset($success['message'])) { ?>
    <div class="box-content alerts">
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Well done!</strong> Bill Created.
        </div>
    </div>
<?php }
?>
<form action="fast_bill_mobile" method="post">
    <div class="main" style="font-size:14px">
        <div style="">
            <h1 style="color:black; ">Collect Bill</h1>
            <h3 style="color:black; ">Search Customer By Name or Account No.</h3>
            <div class="address table table-bordered table-striped span12">
                <div class="span12"  style="background-color: antiquewhite">
                    <div class="control-group">
                        <label class=" control-label">Customer A/c No. :</label>
                        <div class="controls">
                            <input type="text" name="customer_code" class="customer_code input-xlarge">
                            <input type="hidden" name="invoice_customer" class="invoice_customer">
                        </div>
                    </div>
                    <div class="control-group">

                        <label class=" control-label">Name :</label>
                        <div class="controls">
                            <input type="text" name="customer_name" class="customer_name input-xlarge" required="required">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class=" control-label">Bill No. :</label>
                        <input type="text" readonly="readonly" name="invoiceNo" class="invoiceNo input-xlarge">
                    </div>
                    <div class="control-group">
                        <label class=" control-label">STB Serial No. :</label>
                        <input type="text" readonly="readonly" name="stb_no" class="stb_no input-xlarge">
                    </div>
                    <div class="control-group">
                        <label class=" control-label">VC Card No. :</label>
                        <input type="text" readonly="readonly" name="vc_no" class="vc_no input-xlarge">
                    </div>
                    <div class="control-group">
                        <label class=" control-label">Bill Date :</label>
                        <input type="text" name="invoice_date" class="invoice_date input-xlarge">
                    </div>
                    <div class="control-group">
                        <label class=" control-label">Due Date :</label>
                        <input type="text" name="invoice_due_date" class="invoice_date input-xlarge">
                    </div>

                    <div class="control-group">
                        <label class=" control-label">Billed Amount :</label>
                        <input readonly="readonly" type="text" name="invoice_billed_amount" class="invoice_billed_amount input-xlarge">
                    </div>
                    <div class="control-group">
                        <label class=" control-label">Address :</label>
                        <input readonly="readonly"  type="text" name="customer_address" class="customer_address  input-xlarge">
                    </div>
                    <div class="control-group">
                        <label class=" control-label">Contact No. :</label>
                        <input readonly="readonly" type="text" name="customer_contact" class="customer_contact  input-xlarge">
                    </div>
                </div>
            </div>

            <div class="calculation span12" style="width:100%;">
                <h3><b>SUMMARY OF CHARGES</b><br/><small>You can choose invoice period to change billing period</small></h3>
                <div class="addmore"  style="background-color: aliceblue">
                    <div class="control-group"><label class=" control-label">Package :</label>
                        <input type="text" name="package_name" readonly="readonly" class="package_name input-xlarge">
                    </div>
                    <div class="control-group"><label class=" control-label">Invoice For Month:</label>
                        <select name="customer_invoice_for_month" class="input-xlarge">
                            <?php
                            $MonthArray = invoice_period_generate();
                            foreach ($MonthArray as $value) {
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="control-group"><label class=" control-label">Rate :</label>
                        <input type="text" name="package_rate" readonly="readonly" class="package_rate input-xlarge">
                    </div>
                    <div class="control-group"><label class=" control-label">Price :</label>
                        <input type="text" name="package_price[]" readonly="readonly" class="package_rate input-xlarge">
                    </div>
                </div>
                <div class="control-group"><label class=" control-label">Sub Total:</label>
                    <input readonly="readonly" type="text" name="subtotal"  class="subtotal input-xlarge">
                </div>
                <div class="discount pre_taxes">
                    <div class="control-group"><label class=" control-label">Discount:</label>
                        <input type="text" name="discount" class="discount input-xlarge" value="0.00">
                    </div>
                </div>
                <div class="control-group"><label class=" control-label">Total Amount:</label>
                    <input type="text" readonly="readonly" name="total" class="total input-xlarge">
                </div>
                <div class="control-group"><label class=" control-label">Round Amount:</label>
                    <input readonly="readonly" type="text" name="round" class="round input-xlarge">
                </div>
                <div class="control-group"><label class=" control-label">Previous Due:</label>
                    <input type="text" name="invoice_previous_due_amount" value="0.00" class="invoice_previous_due_amount input-xlarge">
                </div>
                <div class="control-group"><label class=" control-label">Previous Advance:</label></div>
                <div style="">
                    <input type="text" name="invoice_previous_advance_amount" value="0.00" class="invoice_previous_advance_amount input-xlarge">
                </div>
                <div class="control-group">
                    <label class=" control-label">Payable Amount</label>
                    <input type="text" name="invoice_payable_amount" class="invoice_payable_amount input-xlarge" readonly>
                </div>
                <div class="control-group">
                    <label class=" control-label">Payable Amount</label>
                    <div class="controls">
                        <div class="input-prepend input-append" >
                            <span class="add-on">Rs</span>
                            <input type="text" readonly="readonly" name="round_word" class="round_word input-xlarge">
                            <span class="add-on">only</span>
                        </div>
                    </div>
                </div>
                <div class="address table table-bordered table-striped">
                    <div>
                        <div>
                            <label class=" control-label"> Collected By:</label>
                            <input required="required" readonly="true" type="text" class="input-xlarge" value="<?= $this->current_user_session['user_firstname'] . ' ' . $this->current_user_session['user_lastname'] ?>" name="invoice_collected_by">
                            <div class="clear"></div>
                            <label class=" control-label"> Collection Date:</label>
                            <input required="required" type="text" readonly="readonly" value="<?= date('d-M-y') ?>" class="invoice_collection_date input-xlarge" name="invoice_collection_date">
                            <div class="clear"></div>
                            <label class=" control-label"> Already Paid Amount:</label>
                            <input type="text" required="required" readonly class="invoice_already_paid_amount input-xlarge" name="invoice_already_paid_amount">
                            <div class="clear"></div>
                        </div>
                        <div>
                            <label class=" control-label"> Paid Now :</label>
                            <input type="text" required="required" class="invoice_paid_amount input-xlarge" name="invoice_paid_amount">
                            <div class="clear"></div>

                            <label class=" control-label">Current Due Amount:</label>
                            <input readonly="readonly" type="text" class="invoice_due_amount input-xlarge" name="invoice_due_amount">
                            <div class="clear"></div>	
                            <label class=" control-label">Current Advance Amount:</label>
                            <input readonly="readonly" type="text" class="invoice_advance_amount input-xlarge" name="invoice_advance_amount">
                            <label class=" control-label">Invoice Note:</label>
                            <input type="text" class=" input-xlarge"  name="invoice_note">
                        </div>
                    </div>

                </div>
                <script>

                    $('input').keyup(function () {
                        recalculate();
                    })

                    var objR = null;
                    $(document).ready(function () {


                        $('input').keyup(function () {
                            recalculate();
                        })

                        $("[name='customer_invoice_for_month']").change(function () {
                            currentPostRequest = $.get('/console/customer/customer_search_by_id/', {term: $('.invoice_customer').val(), invoice_date: $(this).val()}, function (resp) {
                               // console.log(resp);
                                var v = null;
                                $.each(resp, function (index, value) {
                                    if (typeof value != 'undefined') {
                                        v = value;
                                    }
                                });
                                $('.addmore_adon').remove();
                                $('.taxables').remove();
                                $('.invoice_paid_amount').val(0.0);
                                $('.invoice_already_paid_amount').val(v.invoice_already_paid_amount);
                                $('.invoice_due_amount').val(v.invoice_due_amount);
                                $('.invoice_date').val(v.invoice_date);
                                $('.invoice_collection_date').val(v.invoice_date);
                                $('.customer_name').val(v.customer_name);
                                $('.invoice_customer').val(v.customer_ID);
                                $('.invoice_date').val(v.invoice_date);
                                $('.invoiceNo').val(v.invoiceNo);
                                $('.channel_name').val(v.channel_name);
                                //$('.customer_invoice_for_month').val(v.customer_invoice_for_month);
                                //$('.customer_invoice_for_month_select').val(v.customer_invoice_for_month);
                                $('.invoice_previous_due_amount').val(parseFloat(v.invoice_previous_due_amount));
                                $('.invoice_previous_advance_amount').val(parseFloat(v.invoice_previous_advance_amount));
                                $('.discount').val(parseFloat(v.discount) * 1);
                                $('.invoice_billed_amount').val(v.invoice_billed_amount);
                                $('.invoice_payable_amount').val(v.invoice_payable_amount);
                                $('.round_word').val(toWords(v.invoice_payable_amount));
                                $('.round').val(v.round);
                                $('.invoice_due_amount').val(v.invoice_due_amount);
                                $('.customer_code').val(v.customer_code);

                                $('.stb_no').val(v.stb_no);
                                $('.vc_no').val(v.vc_no);
                                $('.customer_address').val(v.customer_address);
                                $('.customer_contact').val(v.customer_contact);

                                $('.package_name').val(v.packages[0].package_name);
                                $('.package_rate').val(v.packages[0].package_rate);
                                $('.channel_price').val(parseFloat(v.adon_price));

                                $(v.adons).each(function (k, v) {
                                    var htmlSTR = "<div class=\"addmore_adon\">\r\n                \n\
                                                    <div class=\"control-group\">\n\
                                                        <label class=\" control-label\">A La Carte :</label>\r\n \n\
                                                       <input    type=\"text\" name=\"channel_name[]\"  readonly=\"readonly\"  class=\"input-xlarge channel_name\" value=\"" + v.channel_name + "\">\r\n      \n\
                                                  <\/div>\r\n  \n\
                                                    <div class=\"control-group\">\n\
                                                    <label class=\" control-label\">Invoice For Month:</label>  \n\
                                                          <select class=\"input-xlarge\"    name=\"customer_invoice_for_month\" readonly=\"readonly\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t  <option value=\"January-17\">January-17<\/option>\r\n                                    <option value=\"February-17\">February-17<\/option>\r\n                                    <option value=\"March-17\">March-17<\/option>\r\n                                    <option value=\"April-17\">April-17<\/option>\r\n                                    <option value=\"May-17\">May-17<\/option>\r\n                                    <option value=\"June-17\">June-17<\/option>\r\n                                    <option value=\"July-17\">July-17<\/option>\r\n                                    <option value=\"August-17\">August-17<\/option>\r\n                                    <option value=\"September-17\">September-17<\/option>\r\n                                    <option value=\"October-17\">October-17<\/option>\r\n                                    <option value=\"November-17\">November-17<\/option>\r\n                                    <option value=\"December-17\">December-17<\/option>\r\n                                    <option value=\"January-18\">January-18<\/option>\r\n                                    <option value=\"February-18\">February-18<\/option>\r\n                                    <option value=\"March-18\">March-18<\/option>\r\n                                    <option value=\"April-18\">April-18<\/option>\r\n                                    <option value=\"May-18\">May-18<\/option>\r\n                                    <option value=\"June-18\">June-18<\/option>\r\n                                    <option value=\"July-18\">July-18<\/option>\r\n                                    <option value=\"August-18\">August-18<\/option>\r\n                                    <option value=\"September-18\">September-18<\/option>\r\n                                    <option value=\"October-18\">October-18<\/option>\r\n                                    <option value=\"November-18\">November-18<\/option>\r\n                                    <option value=\"December-18\">December-18<\/option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<\/select>\n\
                                                    </div\r\n     \n\
                                                        <div class=\"control-group\">\n\
                                                    <label class=\" control-label\">Rate:</label>  \n\
                                                    <input    type=\"text\"   name=\"channel_rate\" readonly=\"readonly\"   class=\"channel_price input-xlarge\" value=\"" + v.channel_price + "\">\r\n                \n\
                                                <\/div>\r\n       \n\
                                                 <div class=\"control-group\">\n\
                                                    <label class=\" control-label\">Price:</label>      \n\
                                               <input    type=\"text\"  name=\"channel_price[]\" readonly=\"readonly\"   class=\"channel_price input-xlarge\" value=\"" + v.channel_price + "\">\r\n               \n\
                                                 <\/div>\r\n  \n\
                                              <\/div>";
                                    $(htmlSTR).insertAfter('.addmore');
                                });
                                $("select[name=customer_invoice_for_month]").val(v.customer_invoice_for_month);
                                $('.total').val(v.total);
                                $('.subtotal').val(v.subtotal);
                                $(v.taxes).each(function (k, vi) {
                                    var tax_html = "  <div class=\"taxables\">\r\n                    \n\
                       <div style=\"border:none;\"><\/div>\r\n \n\
                       <div style=\"border:none;\"><\/div>\r\n \n\
                       <div style=\"\"><span class=\"label\">" + vi.tax_name + '(' + vi.tax_value + '%)' + "<\/span><\/div>\r\n\n\
                        <div style=\"\">\r\n   \n\
                         <input type=\"text\" readonly=\"readonly\" name=\"tax[" + vi.tax_name + "]\"  rel=\"" + vi.tax_value + "\"    class=\"tax\" value=\"" + v[vi.tax_name] + "\">\r\n     \n\
                        <\/div>\r\n                <\/div>";
                                    $('.pre_taxes').after(tax_html);
                                });
                                $('.invoice_due_amount').val(parseFloat($('.total_with_previous_due').val()) - parseFloat($('.invoice_paid_amount').val()));

                                recalculate();


                            }, 'json');
                        })
                    });
                    currentPostRequest = $(".customer_name").autocomplete({
                        source: "/console/customer/customer_search_by_name/",
                        minLength: 2,
                        select: function (event, ui) {
                            $(document).find('input').each(function () {
                               // console.log($(this).attr('name'));
                            });


                            $('.addmore_adon').remove();
                            $('.taxables').remove();
                            $('.invoice_paid_amount').val(0.0);
                            $('.invoice_already_paid_amount').val(ui.item.invoice_already_paid_amount);
                            $('.invoice_date').val(ui.item.invoice_date);
                            $('.invoice_collection_date').val(ui.item.invoice_date);
                            $('.customer_name').val(ui.item.customer_name);
                            $('.invoice_customer').val(ui.item.customer_ID);
                            $('.invoice_date').val(ui.item.invoice_date);
                            $('.invoiceNo').val(ui.item.invoiceNo);
                            $('.channel_name').val(ui.item.channel_name);
                            //$('.customer_invoice_for_month').val(ui.item.customer_invoice_for_month);
                            //$('.customer_invoice_for_month_select').val(ui.item.customer_invoice_for_month);
                            $('.invoice_previous_due_amount').val(parseFloat(ui.item.invoice_previous_due_amount));
                            $('.invoice_previous_advance_amount').val(parseFloat(ui.item.invoice_previous_advance_amount));
                            $('.invoice_billed_amount').val(ui.item.invoice_billed_amount);
                            $('.invoice_payable_amount').val(ui.item.invoice_payable_amount);
                            $('.round_word').val(toWords(ui.item.invoice_payable_amount));
                            $('.round').val(ui.item.round);
                            $('.invoice_due_amount').val(ui.item.invoice_due_amount);
                            $('.customer_code').val(ui.item.customer_code);
                            $('.discount').val(parseFloat(ui.item.discount) * 1);

                            $('.stb_no').val(ui.item.stb_no);
                            $('.vc_no').val(ui.item.vc_no);
                            $('.customer_address').val(ui.item.customer_address);
                            $('.customer_contact').val(ui.item.customer_contact);

                            $('.package_name').val(ui.item.packages[0].package_name);
                            $('.package_rate').val(ui.item.packages[0].package_rate);
                            $('.channel_price').val(parseFloat(ui.item.adon_price));

                            $(ui.item.adons).each(function (k, v) {
                                var htmlSTR = "<div class=\"addmore_adon\">\r\n                \n\
                                                        <div class=\"control-group\"><label class=\" control-label\">A La Carte :</label>\r\n \n\
                                                           <input    type=\"text\" name=\"channel_name[]\"  readonly=\"readonly\"  class=\"input-xlarge channel_name\" value=\"" + v.channel_name + "\">\r\n      \n\
                                                      <\/div>\r\n  \n\
                                                    <div class=\"control-group\"><label class=\" control-label\">Invoice For Month:</label>  <select class=\"input-xlarge\"    name=\"customer_invoice_for_month\" readonly=\"readonly\">\r\n\t\t\t\t\t\t\t\t\t\t\t\t  <option value=\"January-17\">January-17<\/option>\r\n                                    <option value=\"February-17\">February-17<\/option>\r\n                                    <option value=\"March-17\">March-17<\/option>\r\n                                    <option value=\"April-17\">April-17<\/option>\r\n                                    <option value=\"May-17\">May-17<\/option>\r\n                                    <option value=\"June-17\">June-17<\/option>\r\n                                    <option value=\"July-17\">July-17<\/option>\r\n                                    <option value=\"August-17\">August-17<\/option>\r\n                                    <option value=\"September-17\">September-17<\/option>\r\n                                    <option value=\"October-17\">October-17<\/option>\r\n                                    <option value=\"November-17\">November-17<\/option>\r\n                                    <option value=\"December-17\">December-17<\/option>\r\n                                    <option value=\"January-18\">January-18<\/option>\r\n                                    <option value=\"February-18\">February-18<\/option>\r\n                                    <option value=\"March-18\">March-18<\/option>\r\n                                    <option value=\"April-18\">April-18<\/option>\r\n                                    <option value=\"May-18\">May-18<\/option>\r\n                                    <option value=\"June-18\">June-18<\/option>\r\n                                    <option value=\"July-18\">July-18<\/option>\r\n                                    <option value=\"August-18\">August-18<\/option>\r\n                                    <option value=\"September-18\">September-18<\/option>\r\n                                    <option value=\"October-18\">October-18<\/option>\r\n                                    <option value=\"November-18\">November-18<\/option>\r\n                                    <option value=\"December-18\">December-18<\/option>\r\n\t\t\t\t\t\t\t\t\t\t\t\t<\/select>\n\
                                                    <\/div>\r\n      \n\
                                                    <div class=\"control-group\">\n\
                                                       <label class=\" control-label\">Rate:</label>  \n\
                                                       <input    type=\"text\"  name=\"channel_rate\" readonly=\"readonly\"   class=\"channel_price input-xlarge\" value=\"" + v.channel_price + "\">\r\n                \n\
                                                    <\/div>\r\n       \n\
                                                    <div class=\"control-group\">\n\
                                                       <label class=\" control-label\">Price:</label>      \n\                 \n\
                                                       <input    type=\"text\"  name=\"channel_price[]\" readonly=\"readonly\"   class=\"channel_price input-xlarge\" value=\"" + v.channel_price + "\">\r\n               \n\
                                                    <\/div>\r\n  \n\
                                              <\/div>";
                                $(htmlSTR).insertAfter('.addmore');
                            });
                            $("select[name=customer_invoice_for_month]").val(ui.item.customer_invoice_for_month);


                            $('.total').val(ui.item.total);
                            $('.subtotal').val(ui.item.subtotal);
                            $(ui.item.taxes).each(function (k, v) {
                                var tax_html = "  <div class=\"taxables\">\r\n                    \n\
                       <div style=\"border:none;\"><\/div>\r\n \n\
                       <div style=\"border:none;\"><\/div>\r\n \n\
                       <div style=\"\"><span class=\"label\">" + v.tax_name + '(' + v.tax_value + '%)' + "<\/span><\/div>\r\n\n\
                        <div style=\"\">\r\n   \n\
                         <input type=\"text\" readonly=\"readonly\" name=\"tax[" + v.tax_name + "]\" rel=\"" + v.tax_value + "\"    class=\"tax\" value=\"" + ui.item[v.tax_name] + "\">\r\n     \n\
                        <\/div>\r\n                <\/div>";
                                $('.pre_taxes').after(tax_html);
                            });
                            $('.amusement_tax').val(10);
                            $('.service_tax').val(parseFloat((ui.item.subtotal * 15 / 100)));


                            $('.invoice_due_amount').val(parseFloat($('.total_with_previous_due').val()) - parseFloat($('.invoice_paid_amount').val()));
                            recalculate();
                        }
                    });
                    $(".customer_code").autocomplete({
                        source: "/console/customer/customer_search_by_code/",
                        minLength: 2,
                        select: function (event, ui) {
                            $(document).find('input').each(function () {
                               // console.log($(this).attr('name'));
                            });

                            $('.addmore_adon').remove();
                            $('.taxables').remove();
                            $('.invoice_paid_amount').val(0.0);
                            $('.invoice_already_paid_amount').val(ui.item.invoice_already_paid_amount);
                            $('.invoice_date').val(ui.item.invoice_date);
                            $('.invoice_collection_date').val(ui.item.invoice_date);
                            $('.customer_name').val(ui.item.customer_name);
                            $('.invoice_customer').val(ui.item.customer_ID);
                            $('.invoice_date').val(ui.item.invoice_date);
                            $('.invoiceNo').val(ui.item.invoiceNo);
                            $('.channel_name').val(ui.item.channel_name);
                            $('.customer_invoice_for_month').val(ui.item.customer_invoice_for_month);
                            $('.invoice_previous_due_amount').val(ui.item.invoice_previous_due_amount);
                            $('.invoice_previous_advance_amount').val(ui.item.invoice_previous_advance_amount);
                            $('.invoice_billed_amount').val(ui.item.invoice_billed_amount);
                            $('.invoice_payable_amount').val(ui.item.invoice_payable_amount);
                            $('.round_word').val(toWords(ui.item.invoice_payable_amount));
                            $('.round').val(ui.item.round);
                            $('.invoice_due_amount').val(ui.item.invoice_due_amount);
                            $('.customer_code').val(ui.item.customer_code);
                            $('.discount').val(parseFloat(ui.item.discount) * 1);
                            $('.stb_no').val(ui.item.stb_no);
                            $('.vc_no').val(ui.item.vc_no);
                            $('.customer_address').val(ui.item.customer_address);
                            $('.customer_contact').val(ui.item.customer_contact);

                            $('.package_name').val(ui.item.packages[0].package_name);
                            $('.package_rate').val(ui.item.packages[0].package_rate);
                            $('.channel_price').val(parseFloat(ui.item.adon_price));
                            $(ui.item.adons).each(function (k, v) {
                                var htmlSTR = "<div class=\"addmore_adon\">\r\n                \n\
                                                    <div class=\"control-group\"><label class=\" control-label\">A La Carte :</label>\r\n \n\
                                                       <input type=\"text\"    name=\"channel_name[]\"  readonly=\"readonly\"  class=\"channel_name input-xlarge\" value=\"" + v.channel_name + "\">\r\n      \n\
                                                  <\/div>\r\n  \n\
                                                   <div class=\"control-group\">\n\
                                                       <label class=\" control-label\">Rate:</label>      \n\                 \n\
                                                     <input    type=\"text\"  name=\"channel_rate\" readonly=\"readonly\"   class=\"channel_price input-xlarge\" value=\"" + v.channel_price + "\">\r\n                \n\
                                                    <\/div>\r\n       \n\
                                                <div class=\"control-group\">\n\
                                                    <label class=\" control-label\">Price:</label>      \n\
                                                    <input     type=\"text\"  name=\"channel_price[]\" readonly=\"readonly\"   class=\"channel_price input-xlarge\" value=\"" + v.channel_price + "\">\r\n               \n\
                                                 <\/div>\r\n  \n\
                                              <\/div>";
                                $(htmlSTR).insertAfter('.addmore');
                            });
                            $("select[name=customer_invoice_for_month]").val(ui.item.customer_invoice_for_month);
                            $('.total').val(ui.item.total);
                            $('.subtotal').val(ui.item.subtotal);
                            $(ui.item.taxes).each(function (k, v) {
                                var tax_html = "  <div class=\"taxables\">\r\n                    \n\
                       <div style=\"border:none;\"><\/div>\r\n \n\
                       <div style=\"border:none;\"><\/div>\r\n \n\
                       <div style=\"\"><span class=\"label\">" + v.tax_name + '(' + v.tax_value + '%)' + "<\/span><\/div>\r\n\n\
                        <div style=\"\">\r\n   \n\
                         <input type=\"text\" name=\"tax[" + v.tax_name + "]\" readonly=\"readonly\" rel=\"" + v.tax_value + "\"   class=\"tax\" value=\"" + ui.item[v.tax_name] + "\">\r\n     \n\
                        <\/div>\r\n                <\/div>";
                                $('.pre_taxes').after(tax_html);
                            });
                            $('.invoice_due_amount').val(parseFloat($('.total_with_previous_due').val()) - parseFloat($('.invoice_paid_amount').val()));
                            recalculate();
                        }
                    });
                    /*******************/

                    /*******************/
                    $('.invoice_previous_due_amount,.invoice_previous_advance_amount,.invoice_paid_amount').keyup(function () {

                        recalculate();
                    });

                    function recalculate() {

                        var subtotal = parseFloat($('.subtotal').val());/**including alacarta + package*/
                        var discount = parseFloat($('.discount input').val());
                        var afterDiscount = subtotal - discount;
                        var taxsum = 0;

                        $('.tax').each(function () {
                            $(this).val(parseFloat($(this).attr('rel')) * afterDiscount / 100);/**as gst only tax as percent**/
                            taxsum += parseFloat($(this).attr('rel')) * afterDiscount / 100;
                        });
                        var total = taxsum + afterDiscount;
                        $('.total').val(total);
                        $('.round').val(Math.round(total, 2));
                        var payable = parseFloat($('.invoice_previous_due_amount').val()) - parseFloat($('.invoice_previous_advance_amount').val()) + parseFloat($('.round').val());
                        $('.invoice_payable_amount').val(payable);
                        $('.invoice_billed_amount').val(payable);
                        $('.round_word').val(toWords(payable));


                        var amountPending = parseFloat($('.invoice_payable_amount').val()) - parseFloat($('.invoice_paid_amount').val()) - parseFloat($('.invoice_already_paid_amount').val());
                        // var amountPending = parseFloat($('.invoice_payable_amount').val()) - parseFloat($('.invoice_already_paid_amount').val());
                        $('.invoice_advance_amount').val(0.00);
                        $('.invoice_due_amount').val(0.00);

                        if (amountPending > 0) {
                            $('.invoice_due_amount').val(amountPending);
                            $('.invoice_advance_amount').val(0.00);
                        } else {
                            $('.invoice_advance_amount').val((-1) * amountPending);
                            $('.invoice_due_amount').val(0.00);
                        }
                        if (parseFloat($('.invoice_already_paid_amount').val()) == parseFloat($('.invoice_payable_amount').val())) {
                            $('.invoice_paid_amount').attr('readonly', 'readonly');
                        } else {
                            $('.invoice_paid_amount').removeAttr('readonly');
                        }

                    }







                    $('input.invoice_previous_due_amount').keyup(function () {

                        recalculate();

                    })
                    $('input.invoice_previous_advance_amount').keyup(function () {
                        recalculate();
                    })

                    $(function () {
                        $(".invoice_date").datepicker();
                        $(".invoice_date").datepicker("option", "dateFormat", 'd-MM-yy');
                        $(".invoice_collection_date").datepicker();
                        $(".invoice_collection_date").datepicker("option", "dateFormat", 'd-MM-yy');
                        $(".invoice_collection_date").datepicker('setDate', new Date());

                    });
                </script>
            </div>
        </div>
        <!--button type="submit" class="btn" data-toggle="button" onclick="btn_hide()"><span class="icon icon-color icon-cart"></span> Generate</button-->
        <div class="clear:both"></div><br/>
        <div class="clear:both"></div><br/>
        <div class="clear:both"></div><br/>
        <div class="clear:both"></div><br/>
    </div>
    <!--<h3 style="color:red">[do not generate any bills , our system is under construction now]</h3-->
</form>
        <button type="submit" class="btn" data-toggle="button" onclick="btn_hide()"><span class="icon icon-color icon-cart"></span> Generate</button>

<script>
function btn_hide(){
    /*$('button[type="submit"]').hide();
    setTimeout(function(){
        location.reload();
    },3000);
    
}*/
       
       $.post('<?=base_url()?>console/invoice/fast_bill_mobile',{post_data:$('form').serializeArray()},function(resp){
           $('button[type="submit"]').hide();
           alert('Data Added Successfully!!!');
           $("form").trigger('reset');
           location.reload();
       });
   }

</script> 