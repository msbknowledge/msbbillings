
<style>
    table{
        width: 100%;
        text-align: center;

    }

    th{
        border: 1px solid black;
        border-bottom: 1px solid black;
    }

    td{
        border: 1px solid black;
    }

    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
            right center no-repeat;
    }
</style>
<div id="history" style="
    position: fixed;
    width: 96%;
    top: 10px;
    background: wheat;
    left: 2%;
    font-size: 12px;
    ">
</div>
<?php if (isset($status)): ?>
    <div class="alert alert-<?= $status ?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="" enctype="multipart/form-data">
    <table style=" border: none;" onmouseover="hide_history()">
        <tr>
<th  style=" border: none;">DATE: <input type="text" value="<?= date('m/d/Y', strtotime($data[0]['purchase_date'])) ?>"  required="required" autocomplete="off" name="purchase_date"/></th>
            <th  style=" border: none;">
                <p style="text-align: left;">Supplier:<input required="required" value="<?= $data[0]['supplier_name'] ?>" type="text" autocomplete="off" name="supplier_name"/>
                </p>
                 <th  style=" border: none;">GSTIN : <input type="text" value="<?= $data[0]['supplier_gst'] ?>"  required="required" autocomplete="off" name="supplier_gst"/></th>
                <p style="text-align: left;">Address:<input  required="required" value="<?= $data[0]['supplier_address'] ?>" type="text" autocomplete="off" name="supplier_address"/></p>
            </th>
           
            
        </tr>
    </table>  
    
    <table style=" border: none;" onmouseover="hide_history()">
        <tr>
            <th  style=" border: none; text-align: left;">Invoice No:<input value="<?= $data[0]['purchase_invoice'] ?>" required="required" type="text" autocomplete="off" name="purchase_invoice"/></th>
            <th  style=" border: none; text-align: left;">Contact: <input value="<?= $data[0]['supplier_contact'] ?>" required="required" type="text" autocomplete="off" name="supplier_contact"/></th>
            <th  style=" border: none; text-align: left;">Entry Number: <input readonly="readonly" required="required" value="<?= $data[0]['purchase_entry_number']?>" type="text"  name="purchase_entry_number"/></th>

        </tr>
    </table>


    <table style="border-top: 1px solid black; border-bottom: 1px solid black;" onmouseover="hide_history()">
        <thead>
        <caption><h2>Purchased Items1</h2></caption>
        <tr>
            <th>Sr</th>
            <th>Product Name</th>
            <th>HSN</th>
            <th>Storage</th>
            <th>Category</th>
            <th>Schedule</th>
            <th>Manufacturer</th>
            <th>Qty</th>
            <th>Free Qty</th>
            <th>Unit</th>
            <th>Batch</th>
            <th>Exp date<br/>(MM/YY)</th>
            <th>MRP</th>
            <th>Rate</th>
            <th>Disc<br/>%</th>
            <th>Bonus<br/>%</th>
            <th>Taxable</th>
            <th>CGST<br/>%</th>
            <th>CGST</th>
            <th>SGST<br/>%</th>
            <th>SGST</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody class="appendHere">
            <?php foreach ($data as $k => $value) { ?>
            <tr class="rowline" onkeyup="get_history(this)" onfocus="get_history(this)" onclick="get_history(this)"  onmouseout="hide_history()">
                    <td><span><?= $k + 1 ?></span>
                        <a href="javascript:void(0)" onclick="removeRow(this);"> Remove </a></td>
                    <td><input required="required" type="text" value="<?= $value['medicine_name'] ?>" name="medicine_name[]" style="width:200px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['medicine_hsn'] ?>" name="medicine_hsn[]" style="width:40px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['medicine_storage'] ?>" name="medicine_storage[]" style="width:60px;"></td>
                     <td><input   type="text" value="<?= $value['medicine_category'] ?>" name="medicine_category[]" style="width:40px;"></td>
                    <td><input  type="text" value="<?= $value['medicine_schedule'] ?>" name="medicine_schedule[]" style="width:60px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['medicine_manufacturer'] ?>" name="medicine_manufacturer[]" style="width:80px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['purchase_quantity'] ?>" name="purchase_quantity[]" onkeyup="gst_calculation(this)" style="width:30px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['purchase_free_quantity'] ?>" name="purchase_free_quantity[]"  style="width:30px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['purchase_unit'] ?>" name="purchase_unit[]" style="width:30px;"></td>
                    <td><input required="required" type="text" value="<?= $value['purchase_batch'] ?>"  name="purchase_batch[]" pattern="^\S+$" style="width: 90px;"></td>
                    <td><input required="required" type="text" value="<?= $value['purchase_expire_month'] ?>" name="purchase_expire_month[]" pattern="^[0-9]+$" style="width: 20px;margin: 0;padding: 0;float: left;">
                        <span style="margin: 0;padding: 0;float: left;">/</span>
                        <input required="required" value="<?= $value['purchase_expire_year'] ?>" type="text" name="purchase_expire_year[]" pattern="^[0-9]+$" style="width: 20px;margin: 0;padding: 0;float: left;"> </td>
                    <td><input required="required" value="<?= $value['purchase_mrp'] ?>" type="text" name="purchase_mrp[]"  style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['purchase_rate'] ?>" type="text" name="purchase_rate[]" onkeyup="gst_calculation(this)"  style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['purchase_discount_percent'] ?>" type="text" name="purchase_discount_percent[]" onkeyup="gst_calculation(this)"  style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['purchase_bonus'] ?>" type="text" name="purchase_bonus[]" step="0.01" onkeyup="gst_calculation(this)"  style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['purchase_taxable'] ?>" readonly="readonly" type="text" name="purchase_taxable[]" style="width: 50px;"> </td>
                    <td><input required="required" value="<?= $value['purchase_cgst_percent'] ?>" type="text" name="purchase_cgst_percent[]"  onkeyup="gst_calculation(this)" style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['purchase_cgst'] ?>" readonly="readonly" type="text" name="purchase_cgst[]" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['purchase_sgst_percent'] ?>" readonly="readonly" type="text" name="purchase_sgst_percent[]"  onkeyup="gst_calculation(this)" style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['purchase_sgst'] ?>" readonly="readonly" type="text" name="purchase_sgst[]" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['purchase_total'] ?>" readonly="readonly" type="text" name="purchase_total[]" style="width: 50px;"></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <a href="javascript:void(0)" onclick="addmore()" onmouseover="hide_history()">Add More</a>
    <table style="border: 1px solid black;margin-top: 75px;" onmouseover="hide_history()">

        <tr>
            <th>Items</th>
            <th>CGST</th>
            <th>SGST</th>
            <th>Total Gst</th>
            <th>Grand Total</th>
        </tr>
        <tr>
            <td class="totalItem">0</td>
            <td class="totalCgst">0</td>
            <td class="totalSgst">0</td>
            <td class="totalgst">0</td>
            <td class="totalAmount">0.00</td>
        </tr>
    </table>
    <div class="form-actions" onmouseover="hide_history()">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<script>
    var rowcount = <?= count($data) ?>;
    function addmore() {
        rowcount++;
        var therow = " <tr class=\"rowline\" onkeyup=\"get_history(this)\" onfocus=\"get_history(this)\" onclick=\"get_history(this)\" onmouseout=\"hide_history()\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"medicine_name[]\"><\/td>\r\n  \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_hsn[]\" style=\"width:40px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_storage[]\" style=\"width:60px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_category[]\" style=\"width:60px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_schedule[]\" style=\"width:60px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_manufacturer[]\" style=\"width:80px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"number\" name=\"purchase_quantity[]\" onkeyup=\"gst_calculation(this)\" value=\"1\" style=\"width:40px;\"><\/td>\r\n    \n\
      <td><input required=\"required\"  type=\"number\" name=\"purchase_free_quantity[]\"  value=\"0\" style=\"width:40px;\"><\/td>\r\n    \n\
    <td><input required=\"required\"  type=\"number\" name=\"purchase_unit[]\" style=\"width:40px;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"purchase_batch[]\" style=\"width: 90px;\"><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"text\" name=\"purchase_expire_month[]\" style=\"width: 20px;margin: 0;padding: 0;float: left;\">\n\
    <span style=\"margin: 0;padding: 0;float: left;\">/<\/span><input required=\"required\" type=\"text\" name=\"purchase_expire_year[]\" style=\"width: 20px;margin: 0;padding: 0;float: left;\"> <\/td>\r\n  \n\
      <td><input required=\"required\" type=\"text\" name=\"purchase_mrp[]\" value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" type=\"text\" name=\"purchase_rate[]\" onkeyup=\"gst_calculation(this)\"  value=\"0.00\" style=\"width: 50px;\"><\/td>\r\n      \n\
  <td><input required=\"required\" type=\"text\" name=\"purchase_discount_percent[]\" onkeyup=\"gst_calculation(this)\" value=\"0\"  style=\"width: 25px;\"><\/td>\r\n     \n\
   <td><input required=\"required\"  type=\"text\" name=\"purchase_bonus[]\" style=\"width:60px;\"><\/td>\r\n      \n\
    <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_taxable[]\" style=\"width: 50px;\"> <\/td>\r\n    \n\   \n\
<td><input required=\"required\" type=\"text\" name=\"purchase_cgst_percent[]\" value=\"0\" onkeyup=\"gst_calculation(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_cgst[]\" style=\"width: 50px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_sgst_percent[]\" value=\"0\" onkeyup=\"gst_calculation(this)\" style=\"width: 25px;\"><\/td>\r\n    \n\
   <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_sgst[]\" style=\"width: 50px;\"><\/td>\r\n    \n\
    <td><input required=\"required\" readonly=\"readonly\" type=\"text\" name=\"purchase_total[]\" style=\"width: 50px;\"><\/td>\r\n    <\/tr>";
        $('.appendHere').append(therow);
<?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('.rowline').find('[name^="' + targetField + '[]"]').autocomplete({
                        /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1, select: function (event, ui) {
                            targetRow = $(this).parents('tr');
                            $.each(ui.item.complete, function (populate_field, populate_value) { //console.log(populate_field);
                                $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                            });
                        }



                    });
                });
            });
<?php endif; ?>
        $("[name^='purchase_total[]']").focus(function () {
            addmore();
        });
        $(".rowline:last").find('[name^="medicine_name[]"]').focus();

    }
    $("[name^='purchase_total[]']").focus(function () {
        addmore();
    });
    $(".rowline:last").find('[name^="medicine_name[]"]').focus();
    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
    }

    function gst_calculation(targetObject) {
        var cgst = parseFloat($(targetObject).parent().parent().find('[name^="purchase_cgst_percent[]"]').val());
        $(targetObject).parent().parent().find('[name^="purchase_sgst_percent[]"]').val(cgst);// as gst rates are same
        var sgst = parseFloat($(targetObject).parent().parent().find('[name^="purchase_sgst_percent[]"]').val());
        var rate = parseFloat($(targetObject).parent().parent().find('[name^="purchase_rate[]"]').val());
        var qty = parseFloat($(targetObject).parent().parent().find('[name^="purchase_quantity[]"]').val());
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="purchase_discount_percent[]"]').val());
        var purchase_bonus = parseFloat($(targetObject).parent().parent().find('[name^="purchase_bonus[]"]').val());
        var total = (rate * qty);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var bonous_total=(total_sgst + total_cgst + taxable_cost)*(purchase_bonus/100);
        var grandtotal = (total_sgst + total_cgst + taxable_cost)-bonous_total;
        //var grandtotal = total_sgst + total_cgst + taxable_cost;
        console.log(grandtotal);
       // $(targetObject).parent().parent().find('[name^="purchase_bonus[]"]').val(purchase_bonus.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_taxable[]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_cgst[]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_sgst[]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="purchase_total[]"]').val(grandtotal.toFixed(2));
        calculateTotal();
    }
    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;
        $('.rowline').each(function () {
            totalCgst += parseFloat($(this).find('[name="purchase_cgst[]"]').val());
            totalSgst += parseFloat($(this).find('[name="purchase_sgst[]"]').val());
            totalTotal += parseFloat($(this).find('[name="purchase_total[]"]').val());
        });
        $('.totalItem').html(totalItem.toFixed(2));
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
    }

    $(document).ready(function () {
        calculateTotal();
        setTimeout(function () {
            $('.alert').remove()
        }, '2000');
        $("[name='purchase_date']").datepicker();
        $("[name='purchase_date']").datepicker("option", "dateFormat", 'dd-MM-yy');
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
                            });
                        }

                    });
                });
            });
<?php endif; ?>
    });
    function get_history(targetObj){
               
        $.post('/console/purchase/purchase_history',{medicine:$(targetObj).find('[name^="medicine_name[]"]').val()},function(resp){
             $('#history').html('');
        $('#history').html(resp);
        });
    }
    function hide_history(){
           $('#history').html('');
    }
    function saveTheData(targetObj) {
        $.post(page_url + 'edit_detail', $(targetObj).serialize(), function (resp) {
            console.log(resp);
            return false;
        })
        return false;
    }    
    
</script>