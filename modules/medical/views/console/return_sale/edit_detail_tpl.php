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
            <p style="text-align: left;"> Sale Invoice: <input required="required" readonly="readonly" type="text" autocomplete="off" name="return_sale_invoice" id="return_sale_invoice" value="<?= $data[0]['return_sale_invoice'] ?>" />
        </th>
            <th style=" border: none;">
                <p style="text-align: left;">
                    Supplier:
                    <select name="customer_ID">
                        <?php
                        foreach ($customer as $val) { ?>
                            <option value="<?= $val['customer_ID'] ?>" <?php if ($data[0]['return_sale_customer'] == $val['customer_ID']) {
                                                                            echo 'selected';
                                                                        } ?>><?= $val['customer_name'] ?></option>
                        <?php }
                        ?>
                    </select>
                </p>
               
            </th>
            <th style=" border: none;">DATE: <input type="text" value="<?= date('m/d/Y', strtotime($data[0]['return_sale_date'])) ?>" required="required" autocomplete="off" name="expiry_date" /></th>
        </tr>
    </table>
    <table style=" border: none;">
        <tr>
        <th style=" border: none; text-align: left;"> <p style="text-align: left;"> Ref:<input value="<?= $data[0]['return_sale_ref'] ?>" required="required" type="text" autocomplete="off" name="return_sale_ref" />
                </p></th>
            <th style=" border: none; text-align: left;">Entry Number: <input required="required" value="<?= $data[0]['return_sale_entry_number'] ?>" type="text" name="return_sale_entry_number" /></th>
        </tr>
    </table>

    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
            <caption>
                <h2>Sale Return Items</h2>
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
            <?php 
            $totalAmount = 0;
            foreach ($data as $k => $value) { 
                $totalAmount = $totalAmount + $value['return_sale_total'];
                ?>
                <tr class="rowline">
                    <td><span><?= $k + 1 ?></span>
                        <a href="javascript:void(0)" onclick="removeRow(this);"> Remove </a>
                    </td>
                    <td><input required="required" type="text" value="<?= $value['return_sale_medicine'] ?>" name="medicine_name[]"></td>
                    <td><input required="required" type="text" value="<?= $value['return_sale_HSN'] ?>" name="return_sale_HSN[]"></td>
                    <td><input required="required" type="text" value="<?= $value['return_sale_Batch'] ?>" name="return_sale_Batch[]" pattern="^\S+$"></td>
                    <td><input required="required" type="number" value="<?= $value['return_sale_strip'] ?>" oninput="calcualteTotal(this)" name="return_sale_strip[]" min="1" max="<?= $value['max_strip_limit'] ?>" style="width:80px;"></td>
                    <td><input required="required" type="text" value="<?= $value['return_sale_expire_month'] ?>" readonly="readonly" name="return_sale_expire_month[]" pattern="^[0-9]+$" style="width: 20px;margin: 0;padding: 0;float: left;">
                        <span style="margin: 0;padding: 0;float: left;">/</span>
                        <input required="required" value="<?= $value['return_sale_expire_year'] ?>" readonly="readonly" type="text" name="return_sale_expire_year[]" pattern="^[0-9]+$" style="width: 20px;margin: 0;padding: 0;float: left;">
                    </td>
                    <td><input required="required" value="<?= $value['return_sale_mrp'] ?>" readonly="readonly" type="text" name="return_sale_mrp[]" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['return_sale_total'] ?>" readonly="readonly" type="text" name="return_sale_total[]" style="width: 50px;"></td>
                </tr>
            <?php } ?>
                <tr><td colspan="7">Total Amount</td><td id="totalAmount"><?= $totalAmount ?></td></tr>
        </tbody>
    </table>
    <!-- <a href="javascript:void(0)" onclick="addmore()">Add More</a> -->

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<script>
    var lenOF = $('.appendHere').children('tr').length;

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
    var rowcount = lenOF;

    function addmore() {
        rowcount++;
        var therow = " <tr id=\"rowID" + rowcount + " \" class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\"style=\"width:210px;\"><\/td>\r\n      \n\
<td><input required=\"required\" type=\"number\" name=\"return_sale_HSN[]\"style=\"width:210px;\"><\/td>\r\n      \n\
 <td><input required=\"required\" type=\"text\" name=\"return_sale_Batch[]\"style=\"width:210px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"number\" name=\"return_sale_strip[]\"style=\"width:80px;\"><\/td>\r\n      \n\
     <td><input required=\"required\" type=\"text\" name=\"return_sale_expire_month[]\" max=\"31\" min=\"1\" maxlength=\"2\" onfocusout=\"focusvalidation(this)\" style=\"width: 20px;margin: 0;padding: 0;\">\n\
    <span style=\"margin: 0;padding: 0;\">/<\/span><input required=\"required\" type=\"text\" name=\"return_sale_expire_year[]\" style=\"width: 20px;margin: 0;padding: 0;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" onkeyup=\"calcualteTotal(this)\" name=\"return_sale_mrp[]\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"return_sale_total[]\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n \n\
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
                                console.log(ui.item.complete);
                                $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
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

        setTimeout(function() {
            $('.alert').remove()
        }, '2000');
       // addmore();
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