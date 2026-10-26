<style>
    table {
        width: 100%;
        text-align: center;

    }

    .rowline td {
        text-align: center
    }

    .rowline input {
        text-align: center
    }

    th {
        border: 1px solid black;
        border-bottom: 1px solid black;
    }

    td {
        border: 1px solid black;
    }

    .rowline input:nth-child(2) {
        width: 210px;
    }

    .rowline input {
        padding: 0px;
        margin: 0px;
    }

    select:nth-child(1) {
        padding: 0px;
        margin: 0px;

    }

    .rowline td {
        font-size: 10px;
    }

    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==') right center no-repeat;
    }

    #discount {
        min-width: 0px;
        max-width: 110px;
    }
</style>
<?php if (isset($status)) : ?>
    <div class="alert alert-<?= $status ?>">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>
<div id="med_information" style="
    position: fixed;
    width: 96%;
    top: 10px;
    background: wheat;
    left: 2%;
    font-size: 12px;
    ">
</div>
<form method="post" action="" onmouseover="hide_info()">

    <table style=" text-align: center; border: none;background: lightblue;">
        <tr>
            <th style=" border: none; ">Invoice No:<input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= generate_invoice_number() ?>" name="sale_invoice" /></th>
            <th style=" border: none; ">DATE: <input type="text" required="required" autocomplete="off" value="<?= date('d-M-Y H:i:s', time()) ?>" name="sale_date"/></th>
        </tr>
    </table>

    <table style=" border: none;background: lightcoral;">
        <tr>

            <th style=" border: none;">
            <th style=" border: none;">
                <p style="text-align: left;">Contact: <input type="text" autocomplete="off" name="customer_contact" /></p>
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">Customer:<input required="required" type="text" autocomplete="off" name="customer_name" /></p>
            </th>
             <th style=" border: none;">
                <p style="text-align: left;">Email:<input required="required" type="text" autocomplete="off" name="email" /></p>
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">Address:<input type="text" autocomplete="off" name="customer_address" /></p>
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">GSTIN: <input type="text" value="N/A" autocomplete="off" name="customer_gst" /></p>
            </th>


            <th style=" border: none;"></th>
            <th style=" border: none;"></th>
        </tr>
    </table>
    <table style=" border: none;background: lightgrey;">
        <tr>

            <th style=" border: none;">
            <th style=" border: none;">
                <p style="text-align: left;">Doctor: Dr.<input required="required" type="text" value="N/A" autocomplete="off" name="doctor_name" /></p>
            </th>
        </tr>
    </table>
    <br />
    <table id="tableData" style="border-top: 1px solid black; border-bottom: 1px solid black;" onmouseover="hide_info()">
        <thead>
            <caption>
                <h2>Items</h2>
            </caption>
            <tr>
                <th>Sr</th>
                <th>Product Name <br />[only in stock item will appear]</th>
                <th>HSN</th>
               <th>Category</th>
                <th>Schedule</th>
                <th>Strip</th>
                <th>Loose</th>
                <th>Unit</th>
                <th>Batch</th>
                <th>Exp date<br />(MM/YY)</th>
                <th colspan="2">MRP/Old MRP</th>
                <!--<th>Rate</th>-->
                <th>Disc(%)<br /><select id="discount" name="discount">
                        <option value="1">Individual Disc</option>
                        <option value="2">Grand Disc</option>
                    </select></th>
                <th>Taxable</th>
                <th>CGST<br />%</th>
                <th>CGST</th>
                <th>SGST<br />%</th>
                <th>SGST</th>
                <th>Total</th>
                 
            </tr>
        </thead>
        <tbody class="appendHere">

        </tbody>
    </table>
    <a class="addm" href="javascript:void(0)" onclick="addmore()" onmouseover="hide_info()">Add More</a>
    <table style="border: 1px solid black;margin-top: 75px;" onmouseover="hide_info()">

        <tr>
            <th>Items</th>
            <th>CGST</th>
            <th>SGST</th>
            <th>Total Gst</th>
            <th>Grand Total</th>
            <th>MRP Total</th>
            <th>Discount Total</th>
            <th>Previous Due</th>
            <th>Payable</th>
            <th>Paid</th>
            <th>Current Due</th>
            <th>Paid By</th>
            <th>Payment Note</th>

        </tr>
        <tr>
            <td class="totalItem">0</td>
            <td class="totalCgst">0.00</td>
            <td class="totalSgst">0.00</td>
            <td class="totalgst">0.00</td>
            <td class="totalAmount">0.00</td>
            <td class="mrptotal">0.00</td>
            <td class="discounttotal">0.00</td>
            <td class="customer_due" onkeyup="calculateTotal()" style="width: 100px;text-align:center">
                <input style="width: 100px;text-align:center" type="text" name="sale_total_previous_due" value="0.00">
            </td>
            <td class="customer_payable">0.00</td>
            <td class="paid" style="width: 100px;text-align:center">
                <input onkeyup="currentdue()" style="width: 100px;text-align:center" class="sale_total_paid" type="text" autocomplete="off" name="sale_total_paid" value="">
            </td>
            <td class="currentdue"><input type="text" name="sale_total_current_due" style="width: 100px;text-align:center" readonly="readonly"></td>
            <td class="method" style="width: 100px;text-align:center">
                <select name="sale_paid_by" style="width: 100px;text-align:center">
                    <option value="Cash">Cash</option>
                    <option value="Paytm">Paytm</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Mobikwik">Mobikwik</option>
                    <option value="Bank Deposit">Bank Deposit</option>
                    <option value="Other">Other</option>
                </select>
            </td>
            <td class="paymentnote">
                <textarea name="sale_note"></textarea>
            </td>
        </tr>
    </table>
    <div class="form-actions">
        <input type="checkbox" name="print" checked='checked'> Print After Generate<br />
        <button type="submit" id="submit-btn" class="btn btn-primary">Generate Bill</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<script>
    var rowcount = 0;

    function chooseBatch(targetObj) {
        //alert(123);
        var theRow = $(targetObj).parent().parent();
        $(theRow).find("select").nextAll().val("");

        if ($(targetObj).val() != "addnew") {
            $(theRow).find("[name^='sale_batch[]']").val($(targetObj).val());
            $(theRow).find("[name^='sale_batch[]']").attr("readonly", "readonly");
            targetRow = theRow;

            $.post('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + $(targetRow).find('[name^="medicine_id[]"').val() + '&term=' + $(targetObj).val(), function(resp) {
                $(targetRow).find('[name^="sale_strip_quantity[]"').attr({
                    "max": resp[0].complete.left_strip
                });
                //**Remove loose stock sale max limit  */
                // $(targetRow).find('[name^="sale_loose_quantity[]"').attr({
                //     "max": resp[0].complete.left_loose
                // });
                $.each(resp[0].complete, function(populate_fieldx, populate_valuex) {
                    // console.log(populate_fieldx);
                    $(targetRow).find('[name^="' + populate_fieldx + '[]"').val('');
                    $(targetRow).find('[name^="' + populate_fieldx + '[]"').val(populate_valuex);
                    calculate_the_sale($(targetRow).find('[name^="' + populate_valuex + '[]"'));
                    $(targetRow).find('[name^="sale_discount_percent[]"]').focus().select();
                });
            }, 'json');
            /*    $.post('/batch.php?medicine_id=' + $(targetRow).find('[name^="medicine_id[]"').val() + '&term=' + $(targetObj).val(), function (resp) {
                 $.each(resp[0].complete, function (populate_fieldx, populate_valuex) {
                     console.log(populate_fieldx);
                     $(targetRow).find('[name^="' + populate_fieldx + '[]"').val('');
                     $(targetRow).find('[name^="' + populate_fieldx + '[]"').val(populate_valuex);
                     calculate_the_sale($(targetRow).find('[name^="' + populate_valuex + '[]"'));
                     $(targetRow).find('[name^="sale_discount_percent[]"]').focus().select();
                 });
             }, 'json');*/
        } else {
            $(theRow).find("[name^='sale_batch[]']").removeAttr("readonly");
            $(theRow).find("[name^='sale_batch[]']").attr("placeholder", "Enter new batch");
            $(theRow).find("[name^='sale_batch[]']").val("");

        }
    }

    function addmore() {
        rowcount++;
        var therow = " <tr id='deleterow' class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> <i class=\" icon-minus-sign\" style=\"font-size:30px;color:red\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"medicine_id[]\"> <input onkeyup=\"get_info(this)\" onfocus=\"get_info(this)\" onclick=\"get_info(this)\"  onmouseout=\"hide_info()\" required=\"required\" type=\"text\" name=\"medicine_name[]\"> \n\
<\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"medicine_hsn[]\" style=\"width:40px;\"><\/td>\r\n      \n\
       <td><input  readonly=\"readonly\"  type=\"text\" name=\"medicine_category[]\" style=\"width:40px;\"><\/td>\r\n      \n\
        <td><input  readonly=\"readonly\"  type=\"text\" name=\"medicine_schedule[]\" style=\"width:40px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[]\"   value=\"1\" oninput=\"calculate_the_sale(this)\" style=\"width:30px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"number\" name=\"sale_loose_quantity[]\" min=\"0\" max=\"\" oninput=\"calculate_the_sale(this)\"  value=\"0\" style=\"width:30px;\"><\/td>\r\n    \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_unit[]\" onkeyup=\"calculate_the_sale(this)\" style=\"width:30px;\"><\/td>\r\n    \n\
          <td><input  type=\"text\" onchange=\"calculate_the_sale(this)\"  autocomplete=\"off\"  name=\"sale_batch[]\" pattern=\"^\\S+$\" style=\"width: 94PX;\"><\/td>\r\n   \n\
     <td><input required=\"required\"  type=\"text\" name=\"sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[0-9]+$\" style=\"width: 20px;margin: 0;padding: 0;float: left;\">\n\
    <span style=\"margin: 0;padding: 0;float: left;\">/<\/span><input   required=\"required\" type=\"text\" name=\"sale_expire_year[]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" pattern=\"^[0-9]+$\" style=\"width: 20px;margin: 0;padding: 0;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\" type=\"text\"   name=\"sale_new_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 50px;\"><input required=\"required\" type=\"text\"   name=\"sale_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"hidden\" readonly=\"readonly\" name=\"sale_rate[]\" onkeyup=\"calculate_the_sale(this)\"  value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n   \n\
   <td><input required=\"required\" class=\"sale_grand_dis\" type=\"text\" name=\"sale_discount_percent[]\" onkeyup=\"calculate_the_sale(this),calculate_grand_dis()\" value=\"0\"  style=\"width: 25px;\"><\/td>\r\n     \n\
    <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_taxable[]\" style=\"width: 50px;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\"  type=\"text\" name=\"sale_cgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_cgst[]\" style=\"width: 50px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" name=\"sale_sgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_sgst[]\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_total[]\" style=\"width: 50px;\"><\/td>\r\n    <\/tr>";

        $('.appendHere').append(therow);
        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {

                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function(event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function(populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '[]"').val('');

                                if (populate_field == 'medicine_name') {
                                    $.get('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + ui.item.complete.medicine_id, function(resp) {
                                        if (resp !== null) {
                                            $(targetRow).find('.batchchooser').remove();
                                            var batchchooser = $('<select class="batchchooser" onchange="chooseBatch(this)" id="list_' + ui.item.complete.medicine_id + '"></select>');
                                            $(batchchooser).append($('<option value="-" >--CHOOSE BATCH--</option>'));

                                            $.each(resp, function(k, v) {
                                                $(batchchooser).append($('<option value="' + v.value + '" >' + v.label + '</option>'));
                                            });
                                            $(batchchooser).append($('<option value="addnew" >Add New (+)</option>'));

                                            $(targetRow).find('[name^="sale_batch[]"').removeAttr('list');
                                            $(targetRow).find('[name^="sale_batch[]"').val('');
                                            $(targetRow).find('[name^="sale_batch[]"').parent().find('datalist').remove();
                                            $(targetRow).find('[name^="sale_batch[]"').parent().append(batchchooser);
                                            $(targetRow).find('[name^="sale_batch[]"').attr('list', 'list_' + ui.item.complete.medicine_id);
                                        } else {
                                            alert("This medicine stock is zero, please purchase this medicine before sale");
                                            $(targetRow).remove();
                                            calculateTotal();
                                            disp_calc();
                                        }

                                    }, 'json');
                                }
                               
                                $(targetRow).find('[name^="' + populate_field + '[]"').val(populate_value);
                                $(targetRow).find('[name^="medicine_manufacturer[]"]').focus(function() {
                                $(targetRow).find('[name^="sale_strip_quantity[]"]').focus().select();
                                });

                                calculate_the_sale($(targetRow).find('[name^="' + populate_field + '[]"'));
                            });


                            $(targetRow).find('[name^="sale_batch[]"]').change(function() {
                                targetRow = $(this).parents('tr');
                                $.post('<?= console_url() ?>/medicine_stock/stock_by_batch/?medicine_id=' + $(targetRow).find('[name^="medicine_id[]"').val() + '&term=' + $(this).val(), function(resp) {
                                    $.each(resp[0].complete, function(populate_fieldx, populate_valuex) {
                                        // console.log(populate_fieldx);
                                        //targetRow = $(this).parents('tr');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[]"').val('');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[]"').val(populate_valuex);
                                        calculate_the_sale($(targetRow).find('[name^="' + populate_valuex + '[]"'));
                                        $(targetRow).find('[name^="sale_discount_percent[]"]').focus().select();
                                    });
                                }, 'json');



                            });
                            $(targetRow).find('[name^="sale_discount_percent[]"]').keydown(function(e) {
                                var keyCode = e.keyCode || e.which;
                                // console.log(keyCode);
                                // console.log(e.shiftKey);
                                if (keyCode == 9 && !(e.shiftKey)) {
                                    e.preventDefault();
                                    $('.addm').click();
                                    // call custom function here
                                }

                            });


                        }



                    });
                });
            });
        <?php endif; ?>

        $('.date-picker').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });
        $('[name^="medicine_manufacturer[]"]').focus(function() {
            $(this).parent('.rowline').find('[name^="sale_strip_quantity[]"]').focus();
        });
        $("[name^='medicine_name[]']").focus();
    }

    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
        disp_calc();
    }

    function currentdue() {
        paid = parseFloat($(document).find('[name="sale_total_paid"]').val());
        $('[name="sale_total_current_due"]').val(Math.round(parseFloat($('.customer_payable').html()) - paid));

    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;
        var totalPayable = 0;
        var previousDue = 0;
        //var grandDiscount = 0;
        $('.rowline').each(function() {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[]"]').val());
            totalSgst += parseFloat($(this).find('[name="sale_sgst[]"]').val());
            totalTotal += parseFloat($(this).find('[name="sale_total[]"]').val());
        });
        previousDue = parseFloat($(document).find('[name="sale_total_previous_due"]').val());
        var totalPayableAmount = (previousDue + totalTotal);

        $('.totalItem').html(totalItem.toFixed(2));
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
        var total_cur_amount = price_in_words(Math.round(totalPayableAmount));
        $('.customer_payable').html(Math.round(totalPayableAmount) + " /- <br>" + total_cur_amount);
        $('.sale_total_paid').val(Math.round(totalPayableAmount));
    }
    $(document).ready(function() {
        //  var total_cur_amount=$('.totalAmount').html();
        $('#discount').change(function() {
            var select_dis = $('#discount').val();
            if (select_dis == 2) {
                var first_enter_value = $(".sale_grand_dis").val();
                $('.sale_grand_dis').val(first_enter_value);
            } else {
                $('.sale_grand_dis').val(0.00);
            }
        });


        setTimeout(function() {
            $('.alert').remove()
        }, '2000');
        $('[name="customer_contact"]').focus();
        $('.addm').focus(function() {
            $(this).click();
        });
        $("[name='sale_date']").datetimepicker();
        //datepicker("option", "dateFormat", "yy-mm-dd");
        $("[name='sale_date']").datetimepicker({format: 'd-M-Y H:i:s'});
        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {
                    $('[name="' + targetField + '"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function(event, ui) {
                            $.each(ui.item.complete, function(populate_field, populate_value) {
                                $('[name="' + populate_field + '"]').val(populate_value);
                                calculateTotal();
                            });
                        }

                    });
                });
            });
        <?php endif; ?>
    });

    function calculate_grand_dis() {
        var select_dis_val = $('#discount').val();
        if (select_dis_val == 2) {
            var first_enter_value = $(".sale_grand_dis").val();
            $('.sale_grand_dis').val(first_enter_value);
        }
    }

    function saveTheData(targetObj) {
        $.post(page_url + 'add_detail', $(targetObj).serialize(), function(resp) {
            //console.log(resp);
            return false;
        })
        return false;
    }
    
    
function calculate_the_sale(targetObject) {
    const $row = $(targetObject).closest('tr');

    // 🔹 Read old and new MRP
    let old_mrp = parseFloat($row.find('[name="sale_mrp[]"]').val()) || 0;
    let old_gst = parseFloat($row.find('[name="sale_cgst_percent[]"]').val()) * 2 || 0;
    let new_mrp = parseFloat($row.find('[name="sale_new_mrp[]"]').val()) || 0;

    // ✅ Step 1: Auto-calculate New MRP if empty or GST changed
    if (old_mrp && (!new_mrp || new_mrp === old_mrp)) {
        if (old_gst === 12) {
            new_mrp = (old_mrp * 0.9375).toFixed(2); // 6.25% reduction
        } else if (old_gst === 18) {
            new_mrp = (old_mrp * 0.8898).toFixed(2); // 11.02% reduction
        } else {
            new_mrp = old_mrp.toFixed(2);
        }
        $row.find('[name="sale_new_mrp[]"]').val(new_mrp);
    }

    // ✅ Step 2: Set GST to 5% (2.5% + 2.5%)
    const cgst_percent = 2.5;
    const sgst_percent = 2.5;
    $row.find('[name="sale_cgst_percent[]"]').val(cgst_percent);
    $row.find('[name="sale_sgst_percent[]"]').val(sgst_percent);

    // ✅ Step 3: Calculate Rate
    //const rateMultiplier = 0.7619;
    let rate = parseFloat(new_mrp ).toFixed(2);
    $row.find('[name="sale_rate[]"]').val(rate);

    // ✅ Step 4: Quantities and Discount
    const unit = parseFloat($row.find('[name="medicine_unit[]"]').val()) || 1;
    const strip_qty = parseFloat($row.find('[name="sale_strip_quantity[]"]').val()) || 0;
    const loose_qty = parseFloat($row.find('[name="sale_loose_quantity[]"]').val()) || 0;
    const discount_percent = parseFloat($row.find('[name="sale_discount_percent[]"]').val()) || 0;
    const qty = (strip_qty * unit) + loose_qty;

    // ✅ Step 5: Tax Calculations
    const total = (rate * qty / unit);
    const total_discount = total * discount_percent / 100;
    const taxable = total - total_discount;
    const cgst_amt = taxable * cgst_percent / 100;
    const sgst_amt = taxable * sgst_percent / 100;
    const grand_total = taxable + cgst_amt + sgst_amt;

    // ✅ Step 6: Update UI
    $row.find('[name="sale_taxable[]"]').val(taxable.toFixed(2));
    $row.find('[name="sale_cgst[]"]').val(cgst_amt.toFixed(2));
    $row.find('[name="sale_sgst[]"]').val(sgst_amt.toFixed(2));
    $row.find('[name="sale_total[]"]').val(grand_total.toFixed(2));

    // ✅ Step 7: Update Totals
    calculateTotal();
    disp_calc();
}

    function calculate_the_sale_old(targetObject) {
        var cgst = parseFloat($(targetObject).parents('tr').find('[name="sale_cgst_percent[]"]').val());
        var mrp = parseFloat($(targetObject).parents('tr').find('[name="sale_mrp[]"]').val());
        var unit = parseFloat($(targetObject).parents('tr').find('[name="medicine_unit[]"]').val());
        var rate = mrp2rate(mrp, cgst);
        $(targetObject).parents('tr').find('[name="sale_rate[]"]').val(rate.toFixed(3));
        $(targetObject).parent().parent().find('[name^="sale_sgst_percent[]"]').val(cgst); // as gst rates are same
        var sgst = parseFloat($(targetObject).parents('tr').find('[name="sale_sgst_percent[]"]').val());
        var sale_strip_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_strip_quantity[]"]').val());
        var sale_loose_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_loose_quantity[]"]').val());
       
        var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
        var unit = parseFloat($(targetObject).parent().parent().find('[name^="medicine_unit[]"]').val());
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_discount_percent[]"]').val());
        // var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_grand_discount_percent[]"]').val());

        var total = (rate * qty / unit);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var grandtotal = total_sgst + total_cgst + taxable_cost;
        //console.log(grandtotal);
        $(targetObject).parent().parent().find('[name^="sale_taxable[]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_cgst[]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_sgst[]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_total[]"]').val(grandtotal.toFixed(2));

        calculateTotal();
        disp_calc();
    }

    function mrp2rate(mrp, cgst) {
        return mrp * 50 / (50 + cgst);
    }

    function focusvalidation(obg) {
        //alert($(obg).val());
        if ($(obg).val() > 31) {
            alert('value is more than 31');
            $(obg).val('');
            $(obg).focus();
            return false;
        }
    }

    function disp_calc() {
        var total_mrp = 0;
        var total = 0;
        var final = 0;
        $.each($('.rowline td input[name="sale_new_mrp[]"]'), function(index, value) {
            total_mrp = parseFloat($(this).val()) + total_mrp;
        });

        $.each($('.rowline td input[name="sale_total[]"]'), function(index, value) {
            total = parseFloat($(this).val()) + total;
        });
        // console.log('total mrp' + ':' + total_mrp);
        // console.log('total' + ':' + total);
        // console.log('total discount' + ':' + (total_mrp - total));
        final = (total_mrp - total);
        $('td.discounttotal').html(final.toFixed(2));
        $('td.mrptotal').html(total_mrp.toFixed(2));
    }


    function fullCalculation() {
        $('.rowline').each(function() {
            var cgst = parseFloat($(this).find('[name="sale_cgst_percent[]"]').val());
            var mrp = parseFloat($(this).find('[name="sale_new_mrp[]"]').val());
            var unit = parseFloat($(this).find('[name="medicine_unit[]"]').val());
            var rate = mrp2rate(mrp, cgst);//old
            // const rateMultiplier = 0.7619;
            // var rate = parseFloat((mrp * rateMultiplier).toFixed(2));
            $(this).find('[name="sale_rate[]"]').val(rate.toFixed(3));
            $(this).find('[name^="sale_sgst_percent[]"]').val(cgst); // as gst rates are same
            var sgst = parseFloat($(this).find('[name="sale_sgst_percent[]"]').val());
            var sale_strip_quantity = parseFloat($(this).find('[name^="sale_strip_quantity[]"]').val());
            var sale_loose_quantity = parseFloat($(this).find('[name^="sale_loose_quantity[]"]').val());

            var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
            var unit = parseFloat($(this).find('[name^="medicine_unit[]"]').val());
            var discount_percent = parseFloat($(this).find('[name^="sale_discount_percent[]"]').val());

            var total = (rate * qty / unit);
            var total_discount = (total * discount_percent / 100);
            var taxable_cost = (total - total_discount);
            var total_cgst = (taxable_cost * cgst / 100);
            var total_sgst = (taxable_cost * sgst / 100);
            var grandtotal = total_sgst + total_cgst + taxable_cost;
            //console.log(grandtotal);
            $(this).find('[name^="sale_taxable[]"]').val(taxable_cost.toFixed(2));
            $(this).find('[name^="sale_cgst[]"]').val(total_cgst.toFixed(2));
            $(this).find('[name^="sale_sgst[]"]').val(total_sgst.toFixed(2));
            $(this).find('[name^="sale_total[]"]').val(grandtotal.toFixed(2));
        });

        calculateTotal();
        disp_calc();
        currentdue();
        /***********get the ************/
    }
    setInterval(function() {
        fullCalculation();
    }, 100);

    function get_info(targetObj) {
        $.post('/console/medicine_stock/get_info', {
            medicine: $(targetObj).parents('.rowline').find('[name^="medicine_name[]"]').val()
        }, function(resp) {
            $('#med_information').html('');
            $('#med_information').html(resp);
        });
    }

    function hide_info() {
        $('#med_information').html('');
    }

    function get_stock_info(targetObj) {
        $.post('/console/medicine_stock/get_stock_info', {
            medicine: $(targetObj).parents('.rowline').find('[name^="medicine_name[]"]').val()
        }, function(resp) {
            var current_val = $(targetObj).val();
            if (current_val > resp.left_strip) {
                alert("You have enter more than stock quantity");
                $(targetObj).val(resp.left_strip);
            }
        });
    }

    function price_in_words(price) {
        var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
            dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
            tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
            handle_tens = function(dgt, prevDgt) {
                return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt])
            },
            handle_utlc = function(dgt, nxtDgt, denom) {
                return (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") + (0 != nxtDgt || dgt > 0 ? " " + denom : "")
            };

        var str = "",
            digitIdx = 0,
            digit = 0,
            nxtDigit = 0,
            words = [];
        if (price += "", isNaN(parseInt(price))) str = "";
        else if (parseInt(price) > 0 && price.length <= 10) {
            for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--) switch (digit = price[digitIdx] - 0, nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0, price.length - digitIdx - 1) {
                case 0:
                    words.push(handle_utlc(digit, nxtDigit, ""));
                    break;
                case 1:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 2:
                    words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2] ? " and" : "") : "");
                    break;
                case 3:
                    words.push(handle_utlc(digit, nxtDigit, "Thousand"));
                    break;
                case 4:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 5:
                    words.push(handle_utlc(digit, nxtDigit, "Lakh"));
                    break;
                case 6:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 7:
                    words.push(handle_utlc(digit, nxtDigit, "Crore"));
                    break;
                case 8:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 9:
                    words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2] ? " and" : " Crore") : "")
            }
            str = words.reverse().join("") + "Rupees Only"
        } else str = "";
        return str

    }
</script>