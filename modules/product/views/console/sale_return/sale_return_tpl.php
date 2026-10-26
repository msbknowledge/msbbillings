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
<?php if (isset($status)): ?>
    <div class="alert alert-<?= $status ?>" >
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post" action="" >
    <input readonly="readonly" type="hidden" name="invoice_number" value="<?= $data[0]['sale_invoice'] ?>">
    <table style=" border: none;background: lightcoral;">
        <tr>

            <th  style=" border: none;">
            <th  style=" border: none;">    
                <p style="text-align: left;">Customer:<input readonly="readonly" onchange="calculateTotal()" value="<?= $data[0]['customer_name'] ?>" required="required" type="text" autocomplete="off" name="customer_name"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">Address:<input  readonly="readonly" required="required" type="text" autocomplete="off" name="customer_address" value="<?= $data[0]['customer_address'] ?>"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">Contact: <input readonly="readonly" required="required" type="text" autocomplete="off" name="customer_contact" value="<?= $data[0]['customer_contact'] ?>"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">GSTIN : <input readonly="readonly" type="text"  autocomplete="off" name="customer_gst" value="<?= $data[0]['customer_gst'] ?>"/></p> </th>


            <th  style=" border: none;"></th>
            <th  style=" border: none;"></th>
        </tr>
    </table>
    <br/>
    <table style=" border: none;background: lightgrey;">
        <tr>

            <th  style=" border: none;">
            <th  style=" border: none;">    <p style="text-align: left;">Doctor:<input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= $data[0]['doctor_name'] ?>" name="doctor_name"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">Address:<input  readonly="readonly" required="required" type="text" autocomplete="off" value="<?= $data[0]['doctor_address'] ?>" name="doctor_address"/></p> </th>
            <th  style=" border: none;">    <p style="text-align: left;">Contact: <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= $data[0]['doctor_contact'] ?>" name="doctor_contact"/></p> </th>
        </tr>
    </table>
    <br/>
    <table style=" text-align: center; border: none;background: lightblue;">
        <tr>
            <th  style=" border: none; ">Invoice No:<input readonly="readonly" required="required" type="text" autocomplete="off" readonly="readonly" value="<?= $data[0]['sale_invoice'] ?>" name="sale_invoice"/></th>
            <th  style=" border: none; ">DATE Sold: <input readonly="readonly"  type="text"  required="required" autocomplete="off" name="sale_date" value="<?= date('m/d/Y', strtotime($data[0]['sale_date'])) ?>"/></th>
            <th  style=" border: none; ">DATE Return: <input type="text"  required="required" autocomplete="off" name="sale_return_date" value="<?= date('m/d/Y') ?>"/></th>
        </tr>
    </table>

    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
        <caption><h2>Return Sold Items</h2></caption>
        <tr>
            <th>Sr</th>
            <th>Product Name</th>
            <th>HSN</th>
            <th>Qty</th>
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
            <?php
            $counter = 0;
            foreach ($data as $k => $value) {
                if ($value['sale_return'] == true || $value['sale_quantity'] < 1) {
                    continue;
                }
                $counter++;
                ?>
                <tr class="rowline">
                    <td><span><?= $counter ?></span>
                        <a href="javascript:void(0)" onclick="removeRow(this);"> Remove </a></td>
                    <td>
                        <input   type="hidden" value="false" name="sale_returned[]">
                        <input required="required" readonly="readonly"  type="text" value="<?= $value['product_name'] ?>" name="product_name[]">
                        Mfg:<input required="required" readonly="readonly"   type="text" value="<?= $value['product_manufacturer'] ?>" name="product_manufacturer[]" style="width:80px;">
                    </td>
                    <td><input required="required" readonly="readonly"  type="text" value="<?= $value['product_hsn'] ?>" name="product_hsn[]" style="width:80px;"></td>
                    <td><input required="required"  type="text" value="<?= $value['sale_quantity'] ?>" name="sale_quantity[]" onkeyup="gst_calculation(this)" style="width:30px;"></td>
                    <td><input required="required" readonly="readonly" type="text" value="<?= $value['sale_batch'] ?>"  name="sale_batch[]" style="width: 90px;"></td>
                    <td><input required="required" readonly="readonly"  type="text" value="<?= $value['sale_expire_month'] ?>" name="sale_expire_month[]" style="width: 20px;margin: 0;padding: 0;float: left;">
                        <span style="margin: 0;padding: 0;float: left;">/</span>
                        <input required="required" readonly="readonly" value="<?= $value['sale_expire_year'] ?>" type="text" name="sale_expire_year[]" style="width: 20px;margin: 0;padding: 0;float: left;"> </td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_mrp'] ?>" type="text" name="sale_mrp[]"  style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_rate'] ?>" type="text" name="sale_rate[]" onkeyup="gst_calculation(this)"  style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_discount_percent'] ?>" type="text" name="sale_discount_percent[]" onkeyup="gst_calculation(this)"  style="width: 25px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_taxable'] ?>" readonly="readonly" type="text" name="sale_taxable[]" style="width: 50px;"> </td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_cgst_percent'] ?>" type="text" name="sale_cgst_percent[]"  onkeyup="gst_calculation(this)" style="width: 25px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_cgst'] ?>" readonly="readonly" type="text" name="sale_cgst[]" style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_sgst_percent'] ?>" readonly="readonly" type="text" name="sale_sgst_percent[]"  onkeyup="gst_calculation(this)" style="width: 25px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_sgst'] ?>" readonly="readonly" type="text" name="sale_sgst[]" style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_total'] ?>" readonly="readonly" type="text" name="sale_total[]" style="width: 50px;"></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    
    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
        <caption><h2>Returned Items</h2>
            <a href="javascript:void(0)" onclick="removeRowReturn();"> Remove All Return </a></td>
        </caption>
        <tr>
            <th>Sr</th>
            <th>Product Name</th>
            <th>HSN</th>
            <th>Qty</th>
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
            <?php
            $counter = 0;
            foreach ($data as $k => $value) {
                if ($value['sale_return'] != true) {
                    continue;
                }
                $counter++;
                ?>
                <tr class="rowline_return">
                    <td><span><?= $counter ?></span>
                    <td>
                        <input   type="hidden" value="true" name="sale_returned[]">
                        <input required="required" readonly="readonly"  type="text" value="<?= $value['product_name'] ?>" name="product_name[]">
                        Mfg:<input required="required" readonly="readonly"   type="text" value="<?= $value['product_manufacturer'] ?>" name="product_manufacturer[]" style="width:80px;">
                    </td>
                    <td><input required="required" readonly="readonly"  type="text" value="<?= $value['product_hsn'] ?>" name="product_hsn[]" style="width:80px;"></td>
                    <td><input required="required" readonly="readonly"  type="text" value="<?= $value['sale_quantity'] ?>" name="sale_quantity[]" onkeyup="gst_calculation(this)" style="width:30px;"></td>
                    <td><input required="required" readonly="readonly" type="text" value="<?= $value['sale_batch'] ?>"  name="sale_batch[]" style="width: 90px;"></td>
                    <td><input required="required" readonly="readonly"  type="text" value="<?= $value['sale_expire_month'] ?>" name="sale_expire_month[]" style="width: 20px;margin: 0;padding: 0;float: left;">
                        <span style="margin: 0;padding: 0;float: left;">/</span>
                        <input required="required" readonly="readonly" value="<?= $value['sale_expire_year'] ?>" type="text" name="sale_expire_year[]" style="width: 20px;margin: 0;padding: 0;float: left;"> </td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_mrp'] ?>" type="text" name="sale_mrp[]"  style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_rate'] ?>" type="text" name="sale_rate[]" onkeyup="gst_calculation(this)"  style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_discount_percent'] ?>" type="text" name="sale_discount_percent[]" onkeyup="gst_calculation(this)"  style="width: 25px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_taxable'] ?>" readonly="readonly" type="text" name="sale_taxable[]" style="width: 50px;"> </td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_cgst_percent'] ?>" type="text" name="sale_cgst_percent[]"  onkeyup="gst_calculation(this)" style="width: 25px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_cgst'] ?>" readonly="readonly" type="text" name="sale_cgst[]" style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_sgst_percent'] ?>" readonly="readonly" type="text" name="sale_sgst_percent[]"  onkeyup="gst_calculation(this)" style="width: 25px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_sgst'] ?>" readonly="readonly" type="text" name="sale_sgst[]" style="width: 50px;"></td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_total'] ?>" readonly="readonly" type="text" name="sale_total[]" style="width: 50px;"></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
   
    <table style="border: 1px solid black;margin-top: 75px;" class="sold_calc">

        <tr>
            <th>Items</th>
            <th>CGST</th>
            <th>SGST</th>
            <th>Total Gst</th>
            <th>Grand Total</th>    
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
            <td class="customer_due" onkeyup="calculateTotal()" style="width: 100px;text-align:center">
                <input readonly="readonly" style="width: 100px;text-align:center" type="text" name="sale_total_previous_due" value="<?= $data[0]['sale_total_previous_due'] ?>"></td>
            <td class="customer_payable">0.00</td>
            <td class="paid" style="width: 100px;text-align:center">
                <input  readonly="readonly" onkeyup="calculateTotal()" style="width: 100px;text-align:center" type="text" name="sale_total_paid" value="<?= $data[0]['sale_total_paid'] ?>"></td>
            <td class="currentdue"><input type="text" name="sale_total_current_due" value="<?= $data[0]['sale_total_current_due'] ?>"></td>
            <td class="method" style="width: 100px;text-align:center">
                <select readonly="readonly" name="sale_paid_by" style="width: 100px;text-align:center" >
                    <option value="Cash" <?php
                    if ($data[0]['sale_paid_by'] == 'Cash') {
                        echo 'selected';
                    }
                    ?>>Cash</option>
                    <option value="Paytm" <?php
                    if ($data[0]['sale_paid_by'] == 'Paytm') {
                        echo 'selected';
                    }
                    ?>>Paytm</option>
                    <option value="Cheque" <?php
                    if ($data[0]['sale_paid_by'] == 'Cheque') {
                        echo 'selected';
                    }
                    ?>>Cheque</option>
                    <option value="Mobikwik" <?php
                    if ($data[0]['sale_paid_by'] == 'Mobikwik') {
                        echo 'selected';
                    }
                    ?>>Mobikwik</option>
                    <option value="Other" <?php
                    if ($data[0]['sale_paid_by'] == 'Other') {
                        echo 'selected';
                    }
                    ?>>Other</option>
                </select></td>
            <td class="paymentnote">
                <textarea readonly="readonly" name="sale_note">
                    <?= $data[0]['sale_note']; ?>
                </textarea>
            </td>

        </tr>
    </table>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<script>
    var rowcount = <?= count($data) ?>;
    function removeRow(targetObj) {
        $(targetObj).parents('.rowline').remove();
        calculateTotal();
    }
    function removeRowReturn() {
        $('.rowline_return').remove();
        calculateTotal_return();
    }
    function calculateTotal_return() {
        var totalItem = $('.rowline_return').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;
        var totalPayable = 0;
        var previousDue = 0;
        $('.rowline_return').each(function () {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[]"]').val());
            totalSgst += parseFloat($(this).find('[name="sale_sgst[]"]').val());
            totalTotal += parseFloat($(this).find('[name="sale_total[]"]').val());
        });
        previousDue = parseFloat($('.return_calc').find('[name="sale_total_previous_due"]').val());
        paid = parseFloat($('.return_calc').find('[name="sale_total_paid"]').val());

        $('.return_calc').find('.totalItem').html(totalItem.toFixed(2));
        $('.return_calc').find('.totalCgst').html(totalCgst.toFixed(2));
        $('.return_calc').find('.totalSgst').html(totalSgst.toFixed(2));
        $('.return_calc').find('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.return_calc').find('.totalAmount').html(totalTotal.toFixed(2));
        $('.return_calc').find('.customer_payable').html(previousDue + totalTotal);
        $('.return_calc').find('.currentdue').html(previousDue + totalTotal - paid);
    }


    function gst_calculation(targetObject) {
        var cgst = parseFloat($(targetObject).parent().parent().find('[name^="sale_cgst_percent[]"]').val());
        $(targetObject).parent().parent().find('[name^="sale_sgst_percent[]"]').val(cgst);// as gst rates are same
        var sgst = parseFloat($(targetObject).parent().parent().find('[name^="sale_sgst_percent[]"]').val());
        var rate = parseFloat($(targetObject).parent().parent().find('[name^="sale_rate[]"]').val());
        var qty = parseFloat($(targetObject).parent().parent().find('[name^="sale_quantity[]"]').val());
        var discount_percent = parseFloat($(targetObject).parent().parent().find('[name^="sale_discount_percent[]"]').val());
        var total = (rate * qty);
        var total_discount = (total * discount_percent / 100);
        var taxable_cost = (total - total_discount);
        var total_cgst = (taxable_cost * cgst / 100);
        var total_sgst = (taxable_cost * sgst / 100);
        var grandtotal = total_sgst + total_cgst + taxable_cost;
        console.log(grandtotal);
        $(targetObject).parent().parent().find('[name^="sale_taxable[]"]').val(taxable_cost.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_cgst[]"]').val(total_cgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_sgst[]"]').val(total_sgst.toFixed(2));
        $(targetObject).parent().parent().find('[name^="sale_total[]"]').val(grandtotal.toFixed(2));
        calculateTotal();
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
        previousDue = parseFloat($('.sold_calc').find('[name="sale_total_previous_due"]').val());
        paid = parseFloat($('.sold_calc').find('[name="sale_total_paid"]').val());

        $('.sold_calc').find('.totalItem').html(totalItem.toFixed(2));
        $('.sold_calc').find('.totalCgst').html(totalCgst.toFixed(2));
        $('.sold_calc').find('.totalSgst').html(totalSgst.toFixed(2));
        $('.sold_calc').find('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.sold_calc').find('.totalAmount').html(totalTotal.toFixed(2));
        $('.sold_calc').find('.customer_payable').html(previousDue + totalTotal);
        $('.sold_calc').find('.currentdue').html(previousDue + totalTotal - paid);
    }

    $(document).ready(function () {
        calculateTotal();
        setTimeout(function () {
            $('.alert').remove()
        }, '2000');
        $("[name='sale_date']").datepicker();
        $("[name='sale_date']").datepicker("option", "dateFormat", 'dd-MM-yy');
        $("[name='sale_return_date']").datepicker();
        $("[name='sale_return_date']").datepicker("option", "dateFormat", 'dd-MM-yy');
<?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    $('[name="' + targetField + '"]').autocomplete({
                        source: page_url + "autocomplete/" + model + '/' + fieldToSearch,
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
        $.post(page_url + 'edit_detail', $(targetObj).serialize(), function (resp) {
            console.log(resp);
            return false;
        })
        return false;
    }
    function calculate_the_sale(targetObject) {
        var cgst = parseFloat($(targetObject).find('[name="sale_cgst_percent[]"]').val());
        var mrp = parseFloat($(targetObject).find('[name="sale_mrp[]"]').val());
        console.log(mrp2rate(mrp, cgst));
        $(targetObject).find('[name="sale_rate[]"]').val(mrp2rate(mrp, cgst));
        gst_calculation(targetObject);
        calculateTotal();

    }
    function mrp2rate(mrp, cgst) {
        return mrp * 50 / (50 + cgst);
    }
</script>