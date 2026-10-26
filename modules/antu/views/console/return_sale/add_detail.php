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

<form method="post" action="">

    <table style=" border: none;">
        <tr>
            <th style=" border: none;">
                <p style="text-align: left;"> Sale Invoice: <input required="required" type="text" autocomplete="off" name="return_sale_invoice" id="return_sale_invoice" />
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">
                    Customer:
                    <input required="required" type="text" autocomplete="off" name="customer_name" id="customer_name" />
                    <input type="hidden" autocomplete="off" name="customer_ID" id="customer_ID" />
                    <!-- <select name="customer_id">
                        <option>Choose customer</option>
                        <?php

                        //foreach ($customer as $val) { ?>
                            <option value="<? //$val['customer_ID'] ?>"><? //$val['customer_name'] ?></option>
                        <?php // }
                        ?>
                    </select> -->
                </p>
            </th>

            <th style=" border: none;">DATE: <input type="text" required="required" autocomplete="off" name="expiry_date" id="expiry_date" /></th>
        </tr>
    </table>
    <table style=" border: none;">
        <tr>
            <th style=" border: none;">
                <p style="text-align: left;"> Ref: <input required="required" type="text" autocomplete="off" name="return_sale_ref" /></p>
            </th>
            <th style=" border: none; text-align: left;">Entry Number: <input required="required" value="<?= generate_expiry_number() ?>" type="text" name="return_sale_entry_number" /></th>
        </tr>
    </table>


    <table class="sale_return_content" style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
            <caption>
                <h2>Sale Return Items</h2>
            </caption>
            <tr>
                <th>Serial</th>
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
    </table>
     <a href="javascript:void(0)" class="addm" style="display:none;" onclick="addmore()">Add More</a> 

    <div class="form-actions sale_return_content">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<script>
    function calcualteTotal(theObject) {
        var qty = parseFloat($(theObject).parent().parent().find('[name^="return_sale_strip[]"]').val());
        var mrp = parseFloat($(theObject).parent().parent().find('[name^="return_sale_mrp[]"]').val());
        $(theObject).parent().parent().find('[name^="return_sale_total[]"]').val(mrp * qty);

        var total = 0;
        $(".appendHere").find(".rowline").each(function(i, nrElt) {
            var returnTotal = $(nrElt).children('td').find('[name^="return_sale_total[]"]').val();
            total = total + parseFloat(returnTotal);
        });
        $('#totalAmount').html(total);
    }
    var rowcount = 0;

    function addmore() {
        rowcount++;
        var therow = " <tr id=\"rowID" + rowcount + " \" class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\"style=\"width:250px;\"><\/td>\r\n      \n\
<td><input required=\"required\" type=\"number\" name=\"return_sale_HSN[]\"style=\"width:50px;\"><\/td>\r\n      \n\
 <td><input required=\"required\" type=\"text\" name=\"return_sale_Batch[]\" pattern=\"^\\S+$\" style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"number\" name=\"return_sale_strip[]\"style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"text\" name=\"return_sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[0-9]+$\" style=\"width: 20px;margin: 0;padding: 0;\">\n\
    <span style=\"margin: 0;padding: 0;\">/<\/span><input required=\"required\" type=\"text\" name=\"return_sale_expire_year[]\" pattern=\"^[0-9]+$\" style=\"width: 20px;margin: 0;padding: 0;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" onkeyup=\"calcualteTotal(this)\" name=\"return_sale_mrp[]\" value=\"0.00\" style=\"width: 60px;\"><\/td>\r\n \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"return_sale_total[]\" value=\"0.00\" style=\"width: 60px;\"><\/td>\r\n \n\
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
                                console.log(populate_field);
                                console.log(populate_value);
                                $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                                if (populate_field == "medicine_hsn") {
                                    $(targetRow).find('[name^="return_sale_HSN"').val(populate_value);
                                }

                            });
                        }



                    });
                });
            });
        <?php endif; ?>
        console.log(rowcount);
        $(document).find('.return_sale_ref').keydown(function(e) {
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
//######################
    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        var total = 0;
        $(".appendHere").find(".rowline").each(function(i, nrElt) {
            var returnTotal = $(nrElt).children('td').find('[name^="return_sale_total[]"]').val();
            total = total + parseFloat(returnTotal);
        });
        $('#totalAmount').html(total);
    }



    $(document).ready(function() {
        //addmore();
        setTimeout(function() {
            $('.alert').remove()
        }, '2000');

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

        $('[name="return_sale_invoice"]').autocomplete({
            source: '<?= console_url() ?>return_sale/fetch_invoice_details',
            minLength: 1,
            select: function(event, ui) {
                $('.sale_return_content').show();
                console.log(ui);
                $.each(ui.item.complete, function(populate_field, populate_value) {
                    $('[name="' + populate_field + '"]').val(populate_value);
                });
                var totalAmount = 0;
                var therow = "";
                $.each(ui.item.data, function(populate_field, populate_value) {
                    rowcount = populate_field + 1;
                    totalAmount = totalAmount + parseFloat(populate_value.sale_total);
                     therow += " <tr id=\"rowID" + rowcount + " \" class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\" value=\"" + populate_value.medicine_name + "\" style=\"width:250px;\"><\/td>\r\n      \n\
<td><input required=\"required\" type=\"number\" name=\"return_sale_HSN[]\" value=\"" + populate_value.medicine_hsn + "\" style=\"width:50px;\"><\/td>\r\n      \n\
 <td><input required=\"required\" type=\"text\" name=\"return_sale_Batch[]\" pattern=\"^\\S+$\" value=\"" + populate_value.sale_batch + "\" style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"number\" name=\"return_sale_strip[]\" oninput=\"calcualteTotal(this)\" value=\"" + populate_value.sale_strip_quantity + "\" min=\"1\" max=\"" + populate_value.sale_strip_quantity + "\" style=\"width:50px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"return_sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" pattern=\"^[0-9]+$\" value=\"" + populate_value.sale_expire_month + "\" style=\"width: 20px;margin: 0;padding: 0;\">\n\
    <span style=\"margin: 0;padding: 0;\">/<\/span><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"return_sale_expire_year[]\" pattern=\"^[0-9]+$\" value=\"" + populate_value.sale_expire_year + "\" style=\"width: 20px;margin: 0;padding: 0;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" readonly=\"readonly\" name=\"return_sale_mrp[]\" value=\"" + populate_value.sale_mrp + "\" style=\"width: 60px;\"><\/td>\r\n \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"return_sale_total[]\" value=\"" + populate_value.sale_total + "\" style=\"width: 60px;\"><\/td>\r\n \n\
";
                });

                //therow +="<tr><td colspan=\"7\">Total</td><td id=\"totalAmount\">" + totalAmount + "</td></tr>";
                $('.appendHere').html(therow);
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
</script>