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
    .address input{float:right}
</style>
<form action="fast_bill" method="post">
    <div class="main" style="font-size:14px">
        <div style="">
            <h1 style="color:black; text-align:center;">Collect Bill</h1>
            <h3 style="color:black; text-align:center;">Search Customer By Name or Account No.</h3>

            <table class="address table table-bordered table-striped">

                <tr>
                    <td >
                        <span class="label">Customer A/c No. :</span>
                        <input type="text" name="customer_code" class="customer_code">
                        <input type="hidden" name="invoice_customer" class="invoice_customer">
                    </td>
                    <td><span class="label">Bill No. :</span><input type="text" readonly="readonly" name="invoiceNo" class="invoiceNo"></td>
                </tr>
                <tr>
                    <td>
                        <span class="label">STB Serial No. :</span>
                        <input type="text" readonly="readonly" name="stb_no" class="stb_no">
                        <div class="clear"></div>
                        <span class="label">VC Card No. :</span>
                        <input type="text" readonly="readonly" name="vc_no" class="vc_no">
                    </td>
                    <td><span class="label">Bill Date :</span>
                        <input type="text" name="invoice_date" class="invoice_date">
                        <div class="clear"></div>
                        <span class="label">Due Date :</span>
                        <input type="text" name="invoice_due_date" class="invoice_date">
                    </td>
                </tr>
                <tr>
                    <td >
                        <span class="label">Name :</span>
                        <input type="text" name="customer_name" class="customer_name" required="required">
                    </td>
                    <td><span class="label">Billed Amount :</span>
                        <input readonly="readonly" type="text" name="invoice_billed_amount" class="invoice_billed_amount">
                    </td>
                </tr>
                <tr>
                    <td style=""><span class="label">Address :</span>
                        <input readonly="readonly" style="width: 98%;" type="text" name="customer_address" class="customer_address">
                    </td>
                    <td>
                        <span class="label">Contact No. :</span>
                        <input readonly="readonly" type="text" name="customer_contact" class="customer_contact">
                    </td>
                </tr>
            </table>

            <table class="calculation table table-bordered table-striped" style="width:100%;">
                <caption><b>SUMMARY OF CHARGES</b><br/><small>You can choose invoice period to change billing period</small></caption>
                <tr class="heading" >
                    <td width="25%"  style="border-left: none;text-align:center; font-weight:bold;"><span class="label">Package / A La Carte</span></td>
                    <td width="25%" style="text-align:center; font-weight:bold;"><span class="label">For the month of</span></td>
                    <td width="25%" style="text-align:center; font-weight:bold;"><span class="label">Rate</span></td>
                    <td width="25%" style="text-align:center; font-weight:bold;"><span class="label">Amount</span></td>
                </tr>
                <tr class="addmore">
                    <td style="text-align:center;border-left: none;">
                        <input type="text" name="package_name" class="package_name">
                    </td>
                    <td style="text-align:center;" >

                        <div class="id_100">
                            <select name="customer_invoice_for_month">
                                <?php
                                $MonthArray = invoice_period_generate();

                                foreach ($MonthArray as $value) {
                                    ?>
                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <input type="text" name="package_rate" readonly="readonly" class="package_rate">
                    </td>
                    <td style="text-align:center;">
                        <input type="text" name="package_rate" readonly="readonly" class="package_rate">
                    </td>
                </tr>
                <tr class="">
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;"><span class="label">Sub Total:</span></td>
                    <td style="text-align:center;"><input readonly="readonly" type="text" name="subtotal"  class="subtotal"></td>
                </tr>
                <tr class="discount pre_taxes">
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;"><span class="label">Discount:</span></td>
                    <td style="text-align:center;"><input type="text" name="discount" class="discount" value="0.00"></td>
                </tr>


                <tr class="">
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;"><span class="label">Total Amount:</span></td>
                    <td style="text-align:center;"><input type="text" readonly="readonly" name="total" class="total"></td>
                </tr>
                <tr>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border-bottom: none"><span class="label">Round Amount:</span></td>
                    <td style="text-align:center;border-bottom: none"><input readonly="readonly" type="text" name="round" class="round"></td>
                </tr>
                <tr>
                    <td style="text-align:center; border:none;"></td>
                    <td style="text-align:center; border:none;"></td>
                    <td style="text-align:center;"><span class="label">Previous Due:</span></td>
                    <td style="text-align:center;">
                        <input type="text" name="invoice_previous_due_amount" value="0.00" class="invoice_previous_due_amount">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center; border:none;"></td>
                    <td style="text-align:center; border:none;"></td>
                    <td style="text-align:center;"><span class="label">Previous Advance:</span></td>
                    <td style="text-align:center;">
                        <input type="text" name="invoice_previous_advance_amount" value="0.00" class="invoice_previous_advance_amount">
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border:none;"></td>
                    <td style="text-align:center;border-bottom: none"><span class="label">Payable Amount</span></td>
                    <td style="text-align:center;border-bottom: none"><input type="text" name="invoice_payable_amount" class="invoice_payable_amount" readonly></td>
                </tr>
                <tr align="center" style="text-align:right;">
                    <td colspan="1"></td>
                    <td colspan="3">
                        <div class="input-prepend input-append" style="text-align:right">
                            <span class="add-on">Rs</span><input style="width: 60%;" type="text" readonly="readonly" name="round_word" class="round_word"><span class="add-on">only</span>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="address table table-bordered table-striped">
                <tr align="center" style="text-align:right;">
                    <td>
                        <span class="label"> Collected By:</span>
                        <input required="required" type="text" class="" value="Office" name="invoice_collected_by">
                        <div class="clear"></div>
                        <span class="label"> Collection Date:</span>
                        <input required="required" type="text" class="invoice_collection_date" name="invoice_collection_date">
                        <div class="clear"></div>
                        <span class="label">Invoice Note:</span>
                        <textarea style="width:90%" name="invoice_note"></textarea>
                    </td>
                    <td>
                        <span class="label"> Paid Now :</span>
                        <input type="text" required="required" class="invoice_paid_amount" name="invoice_paid_amount">
                        <div class="clear"></div>
                        <span class="label"> Already Paid Amount:</span>
                        <input type="text" required="required" readonly class="invoice_already_paid_amount" name="invoice_already_paid_amount">
                        <div class="clear"></div>
                        <span class="label">Current Due Amount:</span>
                        <input readonly="readonly" type="text" class="invoice_due_amount" name="invoice_due_amount">
                        <div class="clear"></div>	
                        <span class="label">Current Advance Amount:</span>
                        <input readonly="readonly" type="text" class="invoice_advance_amount" name="invoice_advance_amount">
                    </td>
                </tr>

            </table>
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
                            console.log(resp);
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
                                var htmlSTR = "<tr class=\"addmore_adon\">\r\n                \n\
                                                <td style=\"text-align:center;border-left: none;\">\r\n \n\
                                                   <input    type=\"text\" name=\"channel_name[]\" class=\"channel_name\" value=\"" + v.channel_name + "\">\r\n      \n\
                                              <\/td>\r\n  \n\
                                              <td style=\"text-align:center;\" >\r\n      \n\
                                              -do-<\/td>\r\n      \n\
                                             <td style=\"text-align:center;\" >\r\n   \n\
                                                 <input    type=\"text\" name=\"channel_rate\" class=\"channel_price\" value=\"" + v.channel_price + "\">\r\n                <\/td>\r\n       \n\
                                            <td style=\"text-align:center;\" >\r\n          \n\
                                                <input    type=\"text\" name=\"channel_price[]\" class=\"channel_price\" value=\"" + v.channel_price + "\">\r\n               \n\
                                             <\/td>\r\n  \n\
                                          <\/tr>";
                                $(htmlSTR).insertAfter('.addmore');
                            });
                            $("div.id_100 select").val(v.customer_invoice_for_month);
                            $('.total').val(v.total);
                            $('.subtotal').val(v.subtotal);
                            $(v.taxes).each(function (k, vi) {
                                var tax_html = "  <tr class=\"taxables\">\r\n                    \n\
                   <td style=\"text-align:center;border:none;\"><\/td>\r\n \n\
                   <td style=\"text-align:center;border:none;\"><\/td>\r\n \n\
                   <td style=\"text-align:center;\"><span class=\"label\">" + vi.tax_name + '(' + vi.tax_value + '%)' + "<\/span><\/td>\r\n\n\
                    <td style=\"text-align:center;\">\r\n   \n\
                     <input type=\"text\" readonly=\"readonly\" name=\"tax[" + vi.tax_name + "]\"  rel=\"" + vi.tax_value + "\"    class=\"tax\" value=\"" + v[vi.tax_name] + "\">\r\n     \n\
                    <\/td>\r\n                <\/tr>";
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
                            console.log($(this).attr('name'));
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
                            var htmlSTR = "<tr class=\"addmore_adon\">\r\n                \n\
                                                <td style=\"text-align:center;border-left: none;\">\r\n \n\
                                                   <input    type=\"text\" name=\"channel_name[]\" class=\"channel_name\" value=\"" + v.channel_name + "\">\r\n      \n\
                                              <\/td>\r\n  \n\
                                              <td style=\"text-align:center;\" >\r\n      \n\
                                              -do-<\/td>\r\n      \n\
                                             <td style=\"text-align:center;\" >\r\n   \n\
                                                 <input    type=\"text\" name=\"channel_rate\" class=\"channel_price\" value=\"" + v.channel_price + "\">\r\n                <\/td>\r\n       \n\
                                            <td style=\"text-align:center;\" >\r\n          \n\
                                                <input    type=\"text\" name=\"channel_price[]\" class=\"channel_price\" value=\"" + v.channel_price + "\">\r\n               \n\
                                             <\/td>\r\n  \n\
                                          <\/tr>";
                            $(htmlSTR).insertAfter('.addmore');
                        });
                        $("div.id_100 select").val(ui.item.customer_invoice_for_month);


                        $('.total').val(ui.item.total);
                        $('.subtotal').val(ui.item.subtotal);
                        $(ui.item.taxes).each(function (k, v) {
                            var tax_html = "  <tr class=\"taxables\">\r\n                    \n\
                   <td style=\"text-align:center;border:none;\"><\/td>\r\n \n\
                   <td style=\"text-align:center;border:none;\"><\/td>\r\n \n\
                   <td style=\"text-align:center;\"><span class=\"label\">" + v.tax_name + '(' + v.tax_value + '%)' + "<\/span><\/td>\r\n\n\
                    <td style=\"text-align:center;\">\r\n   \n\
                     <input type=\"text\" readonly=\"readonly\" name=\"tax[" + v.tax_name + "]\" rel=\"" + v.tax_value + "\"    class=\"tax\" value=\"" + ui.item[v.tax_name] + "\">\r\n     \n\
                    <\/td>\r\n                <\/tr>";
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
                            console.log($(this).attr('name'));
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
                            var htmlSTR = "<tr class=\"addmore_adon\">\r\n                \n\
                                                <td style=\"text-align:center;border-left: none;\">\r\n \n\
                                                   <input type=\"text\"    name=\"channel_name[]\" class=\"channel_name\" value=\"" + v.channel_name + "\">\r\n      \n\
                                              <\/td>\r\n  \n\
                                              <td style=\"text-align:center;\" >\r\n      \n\
                                              -do-<\/td>\r\n      \n\
                                             <td style=\"text-align:center;\" >\r\n   \n\
                                                 <input    type=\"text\" name=\"channel_rate\" class=\"channel_price\" value=\"" + v.channel_price + "\">\r\n                <\/td>\r\n       \n\
                                            <td style=\"text-align:center;\" >\r\n          \n\
                                                <input     type=\"text\" name=\"channel_price[]\" class=\"channel_price\" value=\"" + v.channel_price + "\">\r\n               \n\
                                             <\/td>\r\n  \n\
                                          <\/tr>";
                            $(htmlSTR).insertAfter('.addmore');
                        });
                        $("div.id_100 select").val(ui.item.customer_invoice_for_month);
                        $('.total').val(ui.item.total);
                        $('.subtotal').val(ui.item.subtotal);
                        $(ui.item.taxes).each(function (k, v) {
                            var tax_html = "  <tr class=\"taxables\">\r\n                    \n\
                   <td style=\"text-align:center;border:none;\"><\/td>\r\n \n\
                   <td style=\"text-align:center;border:none;\"><\/td>\r\n \n\
                   <td style=\"text-align:center;\"><span class=\"label\">" + v.tax_name + '(' + v.tax_value + '%)' + "<\/span><\/td>\r\n\n\
                    <td style=\"text-align:center;\">\r\n   \n\
                     <input type=\"text\" name=\"tax[" + v.tax_name + "]\" readonly=\"readonly\" rel=\"" + v.tax_value + "\"   class=\"tax\" value=\"" + ui.item[v.tax_name] + "\">\r\n     \n\
                    <\/td>\r\n                <\/tr>";
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
					if(parseFloat($('.invoice_already_paid_amount').val())==parseFloat($('.invoice_payable_amount').val())){
						$('.invoice_paid_amount').attr('readonly','readonly');
					} else{
						$('.invoice_paid_amount').removeAttr('readonly');
					}

                }







                $('input.invoice_previous_due_amount').keyup(function () {

                    recalculate();

                })
                $('input.invoice_previous_advance_amount').keyup(function () {
                    recalculate();
                })

               



               /* $('.invoice_paid_amount').keyup(function () {
                    var values = parseFloat($('.total_with_previous_due').val()) - parseFloat($('.invoice_paid_amount').val()) - parseFloat($('.invoice_already_paid_amount').val());
					console.log('v'+values);
                    if (values == 0) {
                        $('.invoice_due_amount').val(0.00);
                        $('.invoice_advance_amount').val(0.00);
                    }
                    if (values > 0) {
                        $('.invoice_due_amount').val(values);
                        $('.invoice_advance_amount').val(0.00);
                    }
                    if (values < 0) {
                        $('.invoice_due_amount').val(0.00);
                        $('.invoice_advance_amount').val(values * -1);
                    }

                });*/
               
                $(function () {
                    $(".invoice_date").datepicker();
                    $(".invoice_date").datepicker("option", "dateFormat", 'd-MM-yy');
                    $(".invoice_collection_date").datepicker();
                    $(".invoice_collection_date").datepicker("option", "dateFormat", 'd-MM-yy');
                });
            </script>
        </div>
    </div>
    <button type="submit" class="btn" data-toggle="button"><span class="icon icon-color icon-cart"></span> Generate Bill</button>
    <!--<h3 style="color:red">[do not generate any bills , our system is under construction now]</h3-->
</form>
