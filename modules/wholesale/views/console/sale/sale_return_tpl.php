<style>
    table{
        width: 100%;
        text-align: center;

    }
    .rowline td{text-align: center}
    .rowline input{text-align: center}
    th{
        border: 1px solid black;
        border-bottom: 1px solid black;
    }

    td{
        border: 1px solid black;
    }
    .rowline input:nth-child(2){
        width: 210px;
    }
    .rowline input{
        padding: 0px;
        margin: 0px;
    }
    select:nth-child(1){
        padding: 0px;
        margin: 0px;

    }
    .rowline td{
        font-size: 10px;
    }

    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
            right center no-repeat;
    }
</style>
<?php if (isset($status)): ?>
    <div class="alert alert-<?= $status ?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="" >

    <table style=" text-align: center; border: none;background: lightblue;">
        <tr>
            <th  style=" border: none; ">Invoice No:<input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= generate_invoice_number() ?>" name="sale_invoice"/></th>
            <th  style=" border: none; ">DATE: <input type="text"  required="required" autocomplete="off" value="<?= date('m/d/Y', time()) ?>" name="sale_date"/></th>
        </tr>
    </table>

    <table style=" border: none;background: lightcoral;">
        <tr>

            <th  style=" border: none;">
            <th  style=" border: none;">    <p style="text-align: left;">Contact: <input  type="text" autocomplete="off" name="customer_contact"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">Customer:<input required="required" type="text" autocomplete="off" name="customer_name"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">Address:<input  type="text" autocomplete="off" name="customer_address"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">GSTIN: <input type="text" value="N/A"  autocomplete="off" name="customer_gst"/></p> </th>


            <th  style=" border: none;"></th>
            <th  style=" border: none;"></th>
        </tr>
    </table>
    <table style=" border: none;background: lightgrey;">
        <tr>

            <th  style=" border: none;">
            <th  style=" border: none;">    <p style="text-align: left;">Doctor: Dr.<input required="required" value="N/A" type="text" autocomplete="off" name="doctor_name"/></p> </th>
        </tr>
    </table>
    <br/>
    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
        <caption><h2>Items</h2></caption>
        <tr>
            <th>Sr</th>
            <th>Product Name <br/>[only in stock item will appear]</th>
            <th>HSN</th>
            <th>Strip</th>
            <th>Loose</th>
            <th>Unit</th>
            <th>Batch</th>
            <th>Exp date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Rate</th>
            <th>Disc<br/>%</th>
            <th>Taxable</th>
            <th>CGST<br/>%</th>
            <th>CGST</th>
            <th>SGST<br/>%</th>
            <th>SGST</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody class="appendHere">

        </tbody>
        
    </table>
    <a class="addm" href="javascript:void(0)" onclick="addmore()">Add More</a>
    <!------------->
    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
        <caption><h2>Return Items</h2></caption>
        <tr>
            <th>Sr</th>
            <th>Product Name <br/>[only in stock item will appear]</th>
            <th>HSN</th>
            <th>Strip</th>
            <th>Loose</th>
            <th>Unit</th>
            <th>Batch</th>
            <th>Exp date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Rate</th>
            <th>Disc<br/>%</th>
            <th>Taxable</th>
            <th>CGST<br/>%</th>
            <th>CGST</th>
            <th>SGST<br/>%</th>
            <th>SGST</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody class="appendHere_R">

        </tbody>
    </table>
    <a class="addm_R" href="javascript:void(0)" onclick="addmore_R()">Add More</a>
    <input type="number" value="0" name="total_return">
    <!------------->

     

    <table style="border: 1px solid black;margin-top: 75px;">

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
                <input style="width: 100px;text-align:center" type="text" name="sale_total_previous_due" value="0.00"></td>
            <td class="customer_payable">0.00</td>
            <td class="paid" style="width: 100px;text-align:center">
                <input onkeyup="currentdue()" style="width: 100px;text-align:center" class="sale_total_paid" type="text" name="sale_total_paid" value=""></td>
            <td class="currentdue"><input type="text" name="sale_total_current_due" readonly="readonly"></td>
            <td class="method" style="width: 100px;text-align:center">
                <select name="sale_paid_by" style="width: 100px;text-align:center">
                    <option value="Cash">Cash</option>
                    <option value="Paytm">Paytm</option>
                    <option value="Cheque">Cheque</option>
                    <option value="Mobikwik">Mobikwik</option>
                    <option value="Other">Other</option>
                </select></td>
            <td class="paymentnote">
                <textarea name="sale_note">
                   
                </textarea>
            </td>
        </tr>
    </table>
    <div class="form-actions">
        <input type="checkbox" name="print" checked='checked'> Print After Generate<br/>
        <button type="submit" class="btn btn-primary">Generate Bill</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>

<script>
    var rowcount = 0;
    function addmore() {
        rowcount++;
        var therow = " <tr class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> <i class=\" icon-minus-sign\" style=\"font-size:30px;color:red\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"product_id[]\"> <input required=\"required\" type=\"text\" name=\"product_name[]\"> \n\
Store:<input  readonly=\"readonly\"  type=\"text\" name=\"product_storage[]\" style=\"width:50px;\"><\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"product_hsn[]\" style=\"width:40px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[]\" value=\"1\" onkeyup=\"calculate_the_sale(this)\" style=\"width:30px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"sale_loose_quantity[]\" onkeyup=\"calculate_the_sale(this)\"  value=\"0\" style=\"width:30px;\"><\/td>\r\n    \n\
      <td><input required=\"required\"  type=\"text\" name=\"product_unit[]\" onkeyup=\"calculate_the_sale(this)\" style=\"width:30px;\"><\/td>\r\n    \n\
          <td><input  type=\"text\" onchange=\"calculate_the_sale(this)\"  name=\"sale_batch[]\" style=\"width: 94PX;\"><\/td>\r\n   \n\
     <td><input required=\"required\"  type=\"text\" name=\"sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\"  style=\"width: 20px;margin: 0;padding: 0;float: left;\">\n\
    <span style=\"margin: 0;padding: 0;float: left;\">/<\/span><input   required=\"required\" type=\"text\" name=\"sale_expire_year[]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" style=\"width: 20px;margin: 0;padding: 0;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\"   name=\"sale_mrp[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_rate[]\" onkeyup=\"calculate_the_sale(this)\"  value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n      \n\
  <td><input required=\"required\" type=\"text\" name=\"sale_discount_percent[]\" onkeyup=\"calculate_the_sale(this)\" value=\"0\"  style=\"width: 25px;\"><\/td>\r\n     \n\
    <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_taxable[]\" style=\"width: 50px;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\"  type=\"text\" name=\"sale_cgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_cgst[]\" style=\"width: 50px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" name=\"sale_sgst_percent[]\" value=\"0\" onkeyup=\"calculate_the_sale(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_sgst[]\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_total[]\" style=\"width: 50px;\"><\/td>\r\n    <\/tr>";
        $('.appendHere').append(therow);
<?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1, select: function (event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function (populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '[]"').val('');

                                if (populate_field == 'product_name') {
                                    $.get('/batch.php?product_id=' + ui.item.complete.product_id, function (resp) {
                                        var batchchooser = $('<datalist id="list_' + ui.item.complete.product_id + '"></datalist>');
                                        $.each(resp, function (k, v) {
                                            $(batchchooser).append($('<option value="' + v.value + '" >' + v.label + '</option>'));
                                        });
                                        $(targetRow).find('[name^="sale_batch[]"').removeAttr('list');
                                        $(targetRow).find('[name^="sale_batch[]"').val('');
                                        $(targetRow).find('[name^="sale_batch[]"').parent().find('datalist').remove();
                                        $(targetRow).find('[name^="sale_batch[]"').parent().append(batchchooser);
                                        $(targetRow).find('[name^="sale_batch[]"').attr('list', 'list_' + ui.item.complete.product_id);

                                    }, 'json');
                                }
                                $(targetRow).find('[name^="' + populate_field + '[]"').val(populate_value);
                                $(targetRow).find('[name^="product_manufacturer[]"]').focus(function () {
                                    $(targetRow).find('[name^="sale_strip_quantity[]"]').focus().select();
                                });

                                //calculate_the_sale($(targetRow).find('[name^="' + populate_field + '[]"'));
                            });


                            $(targetRow).find('[name^="sale_batch[]"]').change(function () {
                                targetRow = $(this).parents('tr');
                                $.post('/batch.php?product_id=' + $(targetRow).find('[name^="product_id[]"').val() + '&term=' + $(this).val(), function (resp) {
                                    $.each(resp[0].complete, function (populate_fieldx, populate_valuex) {
                                        console.log(populate_fieldx);
                                        //targetRow = $(this).parents('tr');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[]"').val('');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[]"').val(populate_valuex);
                                        calculate_the_sale($(targetRow).find('[name^="' + populate_valuex + '[]"'));
                                        $(targetRow).find('[name^="sale_discount_percent[]"]').focus().select();
                                    });
                                }, 'json');



                            });
                            $(targetRow).find('[name^="sale_discount_percent[]"]').keydown(function (e) {
                                var keyCode = e.keyCode || e.which;
                                console.log(keyCode);
                                console.log(e.shiftKey);
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
            onClose: function (dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });
        $('[name^="product_manufacturer[]"]').focus(function () {
            $(this).parent('.rowline').find('[name^="sale_strip_quantity[]"]').focus();
        });
        $("[name^='product_name[]']").focus();
    }
    /*******/
    function addmore_R() {
        rowcount++;
        var therow = " <tr class=\"rowline_R\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> <i class=\" icon-minus-sign\" style=\"font-size:30px;color:red\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"product_id[return_item][]\"> <input required=\"required\" type=\"text\" name=\"product_name[return_item][]\"> \n\
Store:<input  readonly=\"readonly\"  type=\"text\" name=\"product_storage[return_item][]\" style=\"width:50px;\"><\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"product_hsn[return_item][]\" style=\"width:40px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[return_item][]\" value=\"1\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width:30px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"sale_loose_quantity[return_item][]\" onkeyup=\"calculate_the_sale_R(this)\"  value=\"0\" style=\"width:30px;\"><\/td>\r\n    \n\
      <td><input required=\"required\"  type=\"text\" name=\"product_unit[return_item][]\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width:30px;\"><\/td>\r\n    \n\
          <td><input  type=\"text\" onchange=\"calculate_the_sale_R(this)\"  name=\"sale_batch[return_item][]\" style=\"width: 94PX;\"><\/td>\r\n   \n\
     <td><input required=\"required\"  type=\"text\" name=\"sale_expire_month[return_item][]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\"  style=\"width: 20px;margin: 0;padding: 0;float: left;\">\n\
    <span style=\"margin: 0;padding: 0;float: left;\">/<\/span><input   required=\"required\" type=\"text\" name=\"sale_expire_year[return_item][]\" onfocusout=\"focusvalidation(this)\" min=\"17\" maxlength=\"99\" maxlength=\"2\" style=\"width: 20px;margin: 0;padding: 0;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\"   name=\"sale_mrp[return_item][]\" onkeyup=\"calculate_the_sale_R(this)\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"sale_rate[return_item][]\" onkeyup=\"calculate_the_sale_R(this)\"  value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n      \n\
  <td><input required=\"required\" type=\"text\" name=\"sale_discount_percent[return_item][]\" onkeyup=\"calculate_the_sale_R(this)\" value=\"0\"  style=\"width: 25px;\"><\/td>\r\n     \n\
    <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_taxable[return_item][]\" style=\"width: 50px;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\"  type=\"text\" name=\"sale_cgst_percent[return_item][]\" value=\"0\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_cgst[return_item][]\" style=\"width: 50px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" name=\"sale_sgst_percent[return_item][]\" value=\"0\" onkeyup=\"calculate_the_sale_R(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_sgst[return_item][]\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\"  type=\"text\" readonly=\"readonly\" name=\"sale_total[return_item][]\" style=\"width: 50px;\"><\/td>\r\n    <\/tr>";
        $('.appendHere_R').append(therow);
<?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('.rowline_R').find('[name^="' + targetField + '[return_item][]"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1, select: function (event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function (populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '[return_item][]"]').val('');

                                if (populate_field == 'product_name') {
                                    $.get('/batch.php?product_id=' + ui.item.complete.product_id, function (resp) {
                                        var batchchooser = $('<datalist id="list_' + ui.item.complete.product_id + '"></datalist>');
                                        $.each(resp, function (k, v) {
                                            $(batchchooser).append($('<option value="' + v.value + '" >' + v.label + '</option>'));
                                        });
                                        $(targetRow).find('[name^="sale_batch[return_item][]"').removeAttr('list');
                                        $(targetRow).find('[name^="sale_batch[return_item][]"').val('');
                                        $(targetRow).find('[name^="sale_batch[return_item][]"').parent().find('datalist').remove();
                                        $(targetRow).find('[name^="sale_batch[return_item][]"').parent().append(batchchooser);
                                        $(targetRow).find('[name^="sale_batch[return_item][]"').attr('list', 'list_' + ui.item.complete.product_id);

                                    }, 'json');
                                }
                                $(targetRow).find('[name^="' + populate_field + '[return_item][]"').val(populate_value);
                                $(targetRow).find('[name^="product_manufacturer[return_item][]"]').focus(function () {
                                    $(targetRow).find('[name^="sale_strip_quantity[return_item][]"]').focus().select();
                                });

                                //calculate_the_sale($(targetRow).find('[name^="' + populate_field + '[]"'));
                            });


                            $(targetRow).find('[name^="sale_batch[return_item][]"]').change(function () {
                                targetRow = $(this).parents('tr');
                                $.post('/batch.php?product_id=' + $(targetRow).find('[name^="product_id[return_item][]"').val() + '&term=' + $(this).val(), function (resp) {
                                    $.each(resp[0].complete, function (populate_fieldx, populate_valuex) {
                                        console.log(populate_fieldx);
                                        //targetRow = $(this).parents('tr');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[return_item][]"').val('');
                                        $(targetRow).find('[name^="' + populate_fieldx + '[return_item][]"').val(populate_valuex);
                                        calculate_the_sale_R($(targetRow).find('[name^="' + populate_valuex + '[return_item][]"'));


                                        $(targetRow).find('[name^="sale_discount_percent[return_item][]"]').focus().select();
                                    });
                                }, 'json');



                            });
                            $(targetRow).find('[name^="sale_discount_percent[return_item][]"]').keydown(function (e) {
                                var keyCode = e.keyCode || e.which;
                                console.log(keyCode);
                                console.log(e.shiftKey);
                                if (keyCode == 9 && !(e.shiftKey)) {
                                    e.preventDefault();
                                    $('.addm_R').click();
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
            onClose: function (dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });
        $('[name^="product_manufacturer[]"]').focus(function () {
            $(this).parent('.rowline').find('[name^="sale_strip_quantity[]"]').focus();
        });
        $("[name^='product_name[]']").focus();
    }







    /*******/






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
        $('.rowline').each(function () {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[]"]').val());
            totalSgst += parseFloat($(this).find('[name="sale_sgst[]"]').val());
            totalTotal += parseFloat($(this).find('[name="sale_total[]"]').val());
        });
        previousDue = parseFloat($(document).find('[name="sale_total_previous_due"]').val());

        $('.totalItem').html(totalItem.toFixed(2));
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
        $('.customer_payable').html(Math.round(previousDue + totalTotal));
        $('.sale_total_paid').val(Math.round(previousDue + totalTotal));
        return_total_tally();
    }
    function calculateTotal_R() {
        var return_total;
        var totalItem = $('.rowline_R').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;
        var totalPayable = 0;
        var previousDue = 0;
        $('.rowline_R').each(function () {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[return_item][]"]').val());
            totalSgst += parseFloat($(this).find('[name="sale_sgst[return_item][]"]').val());
            totalTotal += parseFloat($(this).find('[name="sale_total[return_item][]"]').val());
        });
        previousDue = parseFloat($(document).find('[name="sale_total_previous_due"]').val());
        $('input[name="total_return"]').val(totalTotal);
        return_total_tally();
    }
    function return_total_tally() {
        var final_payable=0;
        var sale_totalTotal=0;
        var return_total =$('input[name="total_return"]').val();
        $('.rowline').each(function () {
            sale_totalTotal +=parseFloat($(this).find('[name="sale_total[]"]').val());
        });
        final_payable=Math.round(sale_totalTotal-return_total);
        
        $('.customer_payable').html(final_payable);
        
    }
    $(document).ready(function () {
        setTimeout(function () {
            $('.alert').remove()
        }, '2000');
        $('[name="customer_contact"]').focus();
        $('.addm').focus(function () {
            $(this).click();
        });
        $("[name='sale_date']").datepicker();
        $("[name='sale_date']").datepicker("option", "dateFormat", 'dd-MM-yy');
<?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('[name="' + targetField + '"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1, select: function (event, ui) {
                            $.each(ui.item.complete, function (populate_field, populate_value) {
                                $('[name="' + populate_field + '"]').val(populate_value);
                                calculateTotal();
                            });
                        }

                    });
                });
            });
<?php endif; ?>
    });

    function saveTheData(targetObj) {
        $.post(page_url + 'add_detail', $(targetObj).serialize(), function (resp) {
            //console.log(resp);
            return false;
        })
        return false;
    }
    function calculate_the_sale(targetObject) {
        var cgst = parseFloat($(targetObject).parents('tr').find('[name="sale_cgst_percent[]"]').val());
        var mrp = parseFloat($(targetObject).parents('tr').find('[name="sale_mrp[]"]').val());
        var unit = parseFloat($(targetObject).parents('tr').find('[name="product_unit[]"]').val());
        var rate = mrp2rate(mrp, cgst);
        $(targetObject).parents('tr').find('[name="sale_rate[]"]').val(rate.toFixed(3));
        $(targetObject).parent().parent().find('[name^="sale_sgst_percent[]"]').val(cgst);// as gst rates are same
        var sgst = parseFloat($(targetObject).parents('tr').find('[name="sale_sgst_percent[]"]').val());
        var sale_strip_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_strip_quantity[]"]').val());
        var sale_loose_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_loose_quantity[]"]').val());

        var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
        var unit = parseFloat($(targetObject).parent().parent().find('[name^="product_unit[]"]').val());
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_discount_percent[]"]').val());

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

    function calculate_the_sale_R(targetObject) {
        var cgst = parseFloat($(targetObject).parents('tr').find('[name="sale_cgst_percent[return_item][]"]').val());
        var mrp = parseFloat($(targetObject).parents('tr').find('[name="sale_mrp[return_item][]"]').val());
        var unit = parseFloat($(targetObject).parents('tr').find('[name="product_unit[return_item][]"]').val());
        var rate = mrp2rate(mrp, cgst);
        $(targetObject).parents('tr').find('[name="sale_rate[return_item][]"]').val(rate.toFixed(3));
        $(targetObject).parent().parent().find('[name^="sale_sgst_percent[return_item][]"]').val(cgst);// as gst rates are same
        var sgst = parseFloat($(targetObject).parents('tr').find('[name="sale_sgst_percent[return_item][]"]').val());
        var sale_strip_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_strip_quantity[return_item][]"]').val());
        var sale_loose_quantity = parseFloat($(targetObject).parent().parent().find('[name^="sale_loose_quantity[return_item][]"]').val());

        var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
        var unit = parseFloat($(targetObject).parent().parent().find('[name^="product_unit[return_item][]"]').val());
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_discount_percent[return_item][]"]').val());

        var total = (rate * qty / unit);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var grandtotal = total_sgst + total_cgst + taxable_cost;
        //console.log(grandtotal);
        $(targetObject).parent().parent().find('[name^="sale_taxable[return_item][]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_cgst[return_item][]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_sgst[return_item][]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_total[return_item][]"]').val(grandtotal.toFixed(2));
        calculateTotal_R();
        //disp_calc_R();

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
        $.each($('.rowline td input[name="sale_mrp[]"]'), function (index, value) {
            total_mrp = parseFloat($(this).val()) + total_mrp;
        });

        $.each($('.rowline td input[name="sale_total[]"]'), function (index, value) {
            total = parseFloat($(this).val()) + total;
        });
        console.log('total mrp' + ':' + total_mrp);
        console.log('total' + ':' + total);
        console.log('total discount' + ':' + (total_mrp - total));
        final = (total_mrp - total);
        $('td.discounttotal').html(final.toFixed(2));
        $('td.mrptotal').html(total_mrp.toFixed(2));
    }

    function disp_calc_R() {
        var total_mrp = 0;
        var total = 0;
        var final = 0;
        $.each($('.rowline td input[name="sale_mrp[]"]'), function (index, value) {
            total_mrp = parseFloat($(this).val()) + total_mrp;
        });

        $.each($('.rowline td input[name="sale_total[]"]'), function (index, value) {
            total = parseFloat($(this).val()) + total;
        });
        console.log('total mrp' + ':' + total_mrp);
        console.log('total' + ':' + total);
        console.log('total discount' + ':' + (total_mrp - total));
        final = (total_mrp - total);

        $('input[name="total_return"]').val(total);
    }
    function fullCalculation() {
        $('.rowline').each(function () {
            var cgst = parseFloat($(this).find('[name="sale_cgst_percent[]"]').val());
            var mrp = parseFloat($(this).find('[name="sale_mrp[]"]').val());
            var unit = parseFloat($(this).find('[name="product_unit[]"]').val());
            var rate = mrp2rate(mrp, cgst);
            $(this).find('[name="sale_rate[]"]').val(rate.toFixed(3));
            $(this).find('[name^="sale_sgst_percent[]"]').val(cgst);// as gst rates are same
            var sgst = parseFloat($(this).find('[name="sale_sgst_percent[]"]').val());
            var sale_strip_quantity = parseFloat($(this).find('[name^="sale_strip_quantity[]"]').val());
            var sale_loose_quantity = parseFloat($(this).find('[name^="sale_loose_quantity[]"]').val());

            var qty = (sale_strip_quantity * unit) + sale_loose_quantity;
            var unit = parseFloat($(this).find('[name^="product_unit[]"]').val());
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

    setInterval(function () {
        //fullCalculation();
    }, 100);
</script>