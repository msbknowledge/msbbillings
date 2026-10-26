<style>
    table {
        width: 100%;
        text-align: center;
    }

    th {
        border: 1px solid black;
        border-bottom: 1px solid black;
    }

    td {
        border: 1px solid black;
    }

    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==') right center no-repeat;
    }

    td input {
        height: 25px !important;
        padding: 0px !important;
        margin-bottom: 0px !important;
    }
</style>
<?php if (isset($status)) : ?>
    <div class="alert alert-<?= $status ?>">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="" onmouseover="hide_history()">
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-list"></i><?= $table_meta['config']['title'] ?></h2>

            </div>

            <div class="box-content">
                <table style=" border: none;">
                    <tr>
                        <th style=" border: none;">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon"> Purchase Invoice:</label>
                                <input required="required" type="text" autocomplete="off" name="return_purchase_invoice" id="return_purchase_invoice" />
                            </div>
                        </th>
                        <th style=" border: none;">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon">
                                    Supplier</label>
                                <select name="suplier_id" id="supplier_id">
                                    <option>Choose one</option>
                                    <?php
                                    foreach ($supplier as $val) { ?>
                                        <option value="<?= $val['supplier_id'] ?>"><?= $val['supplier_name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                        </th>
                        <th style=" border: none;">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon">Entry Number:</label> 
                                <input required="required" value="<?= generate_expiry_number() ?>" type="text" name="return_purchase_entry_number" /></th< /div>

                    </tr>
                    <tr>
                        <th style=" border: none;">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon">Ref:</label>
                                <input required="required" type="text" autocomplete="off" name="return_purchase_ref" id="return_purchase_ref" />
                            </div>
                        </th>
                        <th style=" border: none;">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon">DATE: </label>
                                <input type="text" required="required" autocomplete="off" name="expiry_date" />
                            </div>
                        </th>
                        <th style=" border: none;">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon">Return Type:</label>
                                <select required="required" name="return_purchase_type">
                                    <option value="">Choose one</option>
                                    <?php
                                    foreach ($return_purchase_type as $key => $val) { ?>
                                        <option value="<?= $key ?>"><?= $val ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </th>
                    </tr>

                </table>
            
        <table style=" border: none;">
            <tr>
            </tr>
        </table>


        <table class="purchase_return_content" style="border-top: 1px solid black; border-bottom: 1px solid black;" onmouseover="hide_history()">
            <thead>
                <caption>
                    <h2>Purchase Return Items</h2>
                </caption>
                <tr>
                    <th>Sr</th>
                    <th>Product Name</th>
                    <th>HSN</th>
                    <th>Batch</th>
                    <th>Strip</th>
                    <th>Exp date<br />(MM/YY)</th>
                    <th>MRP</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="appendHere">

            </tbody>
            <tbody id="history">

            </tbody>
        </table>
        <a href="javascript:void(0)" class="addm" style="display:none;" onclick="addmore()" onmouseover="hide_history()">Add More</a>
     
        <table style="border: 1px solid black;margin-top: 75px;" onmouseover="hide_history()">
            <tr>
                <th>Items</th>
                <th>Grand Total</th>
            </tr>
            <tr>
                <td class="totalItem">0</td>
                <td class="totalAmount">0.00</td>
            </tr>
        </table>

        <div class="form-actions purchase_return_content" onmouseover="hide_history()">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button class="btn" onclick="goBack()">Cancel</button>
        </div>
        </div>
        </div>
</form>
<script>
    function calcualteTotal(theObject) {
        var qty = parseFloat($(theObject).parent().parent().find('[name^="return_purchase_strip[]"]').val());
        var mrp = parseFloat($(theObject).parent().parent().find('[name^="return_purchase_mrp[]"]').val());
        var total = (mrp * qty);
        $(theObject).parent().parent().find('[name^="return_purchase_total[]"]').val(total.toFixed(2));
        calculate_amount();
    }

    function calculate_amount() {
        var totalItem = $('.rowline').length;
        var totalTotal = 0;
        $('.rowline').each(function() {
            totalTotal += parseFloat($(this).find('[name="return_purchase_total[]"]').val());
        });
        $('.totalItem').html(totalItem.toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
    }
    var rowcount = 0;

    function addmore() {
        rowcount++;
        var therow = " <tr class=\"rowline\" onkeyup=\"get_history(this)\" onfocus=\"get_history(this)\" onclick=\"get_history(this)\"  onmouseout=\"hide_history()\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\" onblur=\"fetch_medicine_return()\" style=\"width:250px;\"><\/td>\r\n      \n\
   <td><input required=\"required\" type=\"number\" name=\"medicine_hsn[]\"style=\"width:50px;\"><\/td>\r\n      \n\
 <td><input required=\"required\" type=\"text\" name=\"return_purchase_Batch[]\" onblur=\"fetch_medicine_return()\" pattern=\"^\\S+$\" style=\"width:100px;\"><\/td>\r\n      \n\
 <td><input required=\"required\" type=\"number\" name=\"return_purchase_strip[]\"style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"text\" name=\"return_purchase_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[a-zA-Z0-9]+$\" style=\"width: 20px;margin: 0;padding: 0;\">\n\
    <span style=\"margin: 0;padding: 0;\">/<\/span><input required=\"required\" type=\"text\" name=\"return_purchase_expire_year[]\" pattern=\"^[a-zA-Z0-9]+$\" style=\"width: 20px;margin: 0;padding: 0;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" onkeyup=\"calcualteTotal(this)\" name=\"return_purchase_mrp[]\" value=\"0.00\" style=\"width: 60px;\"><\/td>\r\n \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"return_purchase_total[]\" value=\"0.00\" style=\"width: 60px;\"><\/td>\r\n \n\
";
        $('.appendHere').append(therow);
        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {
                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        select: function(event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function(populate_field, populate_value) {
                                $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                            });
                        }
                    });
                });
            });
        <?php endif; ?>
        console.log(rowcount);
        $(document).find('.return_purchase_ref').keydown(function(e) {
            console.log(12121);

            var keyCode = e.keyCode || e.which;
            console.log(keyCode);
            console.log(e.shiftKey);
            if (keyCode == 9 && !(e.shiftKey)) {
                e.preventDefault();
                $('.addm').click();
                // call custom function here
            }

        });
        $(".rowline:last").find('[name^="medicine_name[]"]').focus();
    }
    //###########################
    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        var total = 0;
        $(".appendHere").find(".rowline").each(function(i, nrElt) {
            var returnTotal = $(nrElt).children('td').find('[name^="return_purchase_total[]"]').val();
            total = total + parseFloat(returnTotal);
        });
        $('#totalAmount').html(total);
        calculate_amount();
    }



    $(document).ready(function() {

        setTimeout(function() {
            $('.alert').remove()
        }, '2000');
        addmore();
        $("[name='expiry_date']").datepicker();
        $("[name='expiry_date']").datepicker("option", "dateFormat", 'dd-MM-yy');
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
                                $('[name="' + populate_field + '"]').val('');
                            });
                            $.each(ui.item.complete, function(populate_field, populate_value) {
                                $('[name="' + populate_field + '"]').val(populate_value);
                            });

                        }

                    });
                });
            });
        <?php endif; ?>
        //#####################
          //$('[name="return_purchase_invoice"]').autocomplete({
        $('[name="return_purchase_Batch[]"]').autocomplete({
            source: '<?= console_url() ?>return_purchase/fetch_invoice_details',
            minLength: 1,
            select: function(event, ui) {
                $('.purchase_return_content').show();
                console.log(ui);
                $.each(ui.item.complete, function(populate_field, populate_value) {
                    $('[name="' + populate_field + '"]').val(populate_value);
                });
                // Set the supplier_id dropdown based on the selected item
                if (ui.item.complete.supplier_id) {
                    $('#supplier_id').val(ui.item.complete.supplier_id).trigger('change');
                    //$('#supplier_name').val(ui.item.complete.supplier_id).trigger('change');
                    // supplier_id=ui.item.complete.supplier_id;

                }
                var totalAmount = 0;
                var therow = "";
                $.each(ui.item.data, function(populate_field, populate_value) {
                    rowcount = populate_field + 1;
                    totalAmount = totalAmount + parseFloat(populate_value.purchase_total);
                    therow += " <tr id=\"rowID" + rowcount + " \" class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\" value=\"" + populate_value.medicine_name + "\" style=\"width:250px;\"><\/td>\r\n      \n\
<td><input required=\"required\" type=\"number\" name=\"return_purchase_HSN[]\" value=\"" + populate_value.medicine_hsn + "\" style=\"width:50px;\"><\/td>\r\n      \n\
 <td><input required=\"required\" type=\"text\" name=\"return_purchase_Batch[]\" pattern=\"^\\S+$\" value=\"" + populate_value.purchase_batch + "\" style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"number\" name=\"return_purchase_strip[]\" oninput=\"calcualteTotal(this)\" value=\"" + populate_value.purchase_quantity + "\" min=\"1\" max=\"" + populate_value.purchase_quantity + "\" style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"return_purchase_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[0-9]+$\" value=\"" + populate_value.purchase_expire_month + "\" style=\"width: 20px;margin: 0;padding: 0;\">\n\
    <span style=\"margin: 0;padding: 0;\">/<\/span><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"return_purchase_expire_year[]\" pattern=\"^[0-9]+$\" value=\"" + populate_value.purchase_expire_year + "\" style=\"width: 20px;margin: 0;padding: 0;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"return_purchase_mrp[]\" value=\"" + populate_value.purchase_mrp + "\" style=\"width: 60px;\"><\/td>\r\n \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"return_purchase_total[]\" value=\"" + populate_value.purchase_total + "\" style=\"width: 60px;\"><\/td>\r\n \n\
";
                });

                // therow +="<tr><td colspan=\"7\">Total</td><td id=\"totalAmount\">" + totalAmount + "</td></tr>";
                $('.appendHere').html(therow);
                calculate_amount();
                $('.addm').css('display', 'block');
            }

        });
    });

    function saveTheData(targetObj) {
        $.post(page_url + 'add_detail', $(targetObj).serialize(), function(resp) {
            console.log(resp);
            return false;
        })
        return false;
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
    function fetch_medicine_return() {
         $.post('/console/return_purchase/fetch_medicine_return', {
              medicine: $('[name="medicine_name[]"]').val(),
             // purchase_Batch: $('[name="return_purchase_Batch[]"]').val()
            // medicine: $(targetObj).find('[name^="medicine_name[]"]').val()
             
         }, function (resp) {
           if (resp.medicine_count==0) {
               //alert('Selected medicine Detected');
                $('[name="medicine_name[]"]').css('color', 'red');
                $('[name="medicine_name[]"]').focus();
                 return false;
            }else{
                $('[name="medicine_name[]"]').css('color', 'black');
            }
        } );
       
    }
    function get_history(targetObj) {

        $.post('/console/purchase/purchase_history', {
            medicine: $(targetObj).find('[name^="medicine_name[]"]').val()
        }, function(resp) {
            $('#history').html('');
            $('#history').html(resp);
        });
    }

    function hide_history() {
        $('#history').html('');
    }
</script>