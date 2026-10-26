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

<form method="post" action="">
    <input type="hidden" name="invoice_number" value="<?= $data[0]['sale_invoice'] ?>">
    <table style=" border: none;background: lightcoral;">
        <tr>

            <th style=" border: none;">
            <th style=" border: none;">
                <p style="text-align: left;">Contact: <input required="required" type="text" autocomplete="off" name="customer_contact" value="<?= $data[0]['customer_contact'] ?>" /></p>
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">Customer:<input onchange="calculateTotal()" value="<?= $data[0]['customer_name'] ?>" required="required" type="text" autocomplete="off" name="customer_name" /></p>
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">Address:<input type="text" autocomplete="off" name="customer_address" value="<?= $data[0]['customer_address'] ?>" /></p>
            </th>
            <th style=" border: none;">
                <p style="text-align: left;">GSTIN : <input type="text" autocomplete="off" name="customer_gst" value="<?= $data[0]['customer_gst'] ?>" /></p>
            </th>


            <th style=" border: none;"></th>
            <th style=" border: none;"></th>
        </tr>
    </table>
    <br />
    <table style=" border: none;background: lightgrey;">
        <tr>

            <th style=" border: none;">
            <th style=" border: none;">
                <p style="text-align: left;">Doctor:<input required="required" type="text" autocomplete="off" value="<?= $data[0]['doctor_name'] ?>" name="doctor_name" /></p>
            </th>
        </tr>
    </table>
    <br />
    <table style=" text-align: center; border: none;background: lightblue;">
        <tr>
            <th style=" border: none; ">Invoice No:<input readonly="readonly" required="required" type="text" autocomplete="off" readonly="readonly" value="<?= $data[0]['sale_invoice'] ?>" name="sale_invoice" /></th>
            <th style=" border: none; ">DATE: <input type="text" required="required" autocomplete="off" name="sale_date" value="<?= date('d-M-Y H:i:s', strtotime($data[0]['sale_date'])) ?>" /></th>
        </tr>
    </table>

    <table style="border-top: 1px solid black; border-bottom: 1px solid black;">
        <thead>
            <caption>
                <h2>Items</h2>
            </caption>
            <tr>
                <th>Sr</th>
                <th>Product Name <br />[only in stock item will appear]</th>
                <th>HSN</th>
                <th>Strip</th>
                <th>Loose</th>
                <th>Unit</th>
                <th>Batch</th>
                <th>Exp date<br />(MM/YY)</th>
                <th>MRP</th>
                <th>Rate</th>
                <th>Disc(%)<br />
                    <?php
                    $item_details = array();
                    foreach ($data as $a => $value) {
                        $item_details[] = $value['sale_discount_percent'];
                    }
                    $result = count(array_unique($item_details));
                    ?>
                    <select id="discount" name="discount">
                        <option value='2' <?= $result == 1 ? ' selected="selected"' : ''; ?>>Grand Disc</option>
                        <option value='1' <?= $result > 1  ? ' selected="selected"' : ''; ?>>Individual Disc</option>
                    </select>
                </th>
                <th>Taxable</th>
                <th>CGST<br />%</th>
                <th>CGST</th>
                <th>SGST<br />%</th>
                <th>SGST</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody class="appendHere center">
            <?php foreach ($data as $k => $value) { ?>
                <tr class="rowline" style="text-align: center">
                    <td><span><?= $k + 1 ?></span>
                        <a href="javascript:void(0)" onclick="removeRow(this);"> <i class=" icon-minus-sign" style="font-size:30px;color:red"></i> </a>
                    </td>
                    <td>
                        <input required="required" type="hidden" name="medicine_id[]" value="<?= $value['medicine_id'] ?>">
                        <input required="required" type="text" name="medicine_name[]" value="<?= $value['medicine_name'] ?>" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                        Store:<input readonly="readonly" value="<?= $value['medicine_storage'] ?>" type="text" name="medicine_storage[]" style="width:50px;">
                    </td>

                    <td><input required="required" readonly="readonly" type="text" value="<?= $value['medicine_hsn'] ?>" name="medicine_hsn[]" style="width:40px;"></td>
                    <td><input required="required" type="text" value="<?= $value['sale_strip_quantity'] ?>" name="sale_strip_quantity[]" onkeyup="calculate_the_sale(this)" style="width:30px;"></td>
                    <td><input required="required" type="text" value="<?= $value['sale_loose_quantity'] ?>" name="sale_loose_quantity[]" onkeyup="calculate_the_sale(this)" style="width:30px;"></td>
                    <td><input required="required" type="text" value="<?= $value['medicine_unit'] ?>" name="medicine_unit[]" style="width:30px;" onkeyup="calculate_the_sale(this)"></td>
                    <td><input required="required" type="text" value="<?= $value['sale_batch'] ?>" autocomplete="off" name="sale_batch[]" pattern="^\S+$" style="width: 90px;" onkeyup="calculate_the_sale(this)"></td>
                    <td><input required="required" type="text" value="<?= $value['sale_expire_month'] ?>" name="sale_expire_month[]" onkeyup="calculate_the_sale(this)" pattern="^[0-9]+$" style="width: 20px;margin: 0;padding: 0;float: left;">
                        <span style="margin: 0;padding: 0;float: left;">/</span>
                        <input readonly="readonly" required="required" value="<?= $value['sale_expire_year'] ?>" type="text" onkeyup="calculate_the_sale(this)" name="sale_expire_year[]" pattern="^[0-9]+$" style="width: 20px;margin: 0;padding: 0;float: left;">
                    </td>
                    <td><input required="required" readonly="readonly" value="<?= $value['sale_mrp'] ?>" type="text" onkeyup="calculate_the_sale(this)" name="sale_mrp[]" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['sale_rate'] ?>" type="text" name="sale_rate[]" onkeyup="calculate_the_sale(this)" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['sale_discount_percent'] ?>" class="sale_grand_dis" type="text" name="sale_discount_percent[]" onkeyup="calculate_the_sale(this),calculate_grand_dis()" style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['sale_taxable'] ?>" readonly="readonly" type="text" name="sale_taxable[]" style="width: 50px;"> </td>
                    <td><input required="required" value="<?= $value['sale_cgst_percent'] ?>" readonly="readonly" type="text" name="sale_cgst_percent[]" onkeyup="calculate_the_sale(this)" style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['sale_cgst'] ?>" readonly="readonly" type="text" name="sale_cgst[]" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['sale_sgst_percent'] ?>" readonly="readonly" type="text" name="sale_sgst_percent[]" onkeyup="calculate_the_sale(this)" style="width: 25px;"></td>
                    <td><input required="required" value="<?= $value['sale_sgst'] ?>" readonly="readonly" type="text" name="sale_sgst[]" style="width: 50px;"></td>
                    <td><input required="required" value="<?= $value['sale_total'] ?>" readonly="readonly" type="text" name="sale_total[]" style="width: 50px;"></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <a href="javascript:void(0)" onclick="addmore()" class="addm">Add More</a>
    <table style="border: 1px solid black;margin-top: 75px;">

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
                <input style="width: 100px;text-align:center" type="text" name="sale_total_previous_due" value="<?= $data[0]['sale_total_previous_due'] ?>">
            </td>
            <td class="customer_payable">0.00</td>
            <td class="paid" style="width: 100px;text-align:center">
                <input onkeyup="currentdue()" style="width: 100px;text-align:center" type="text" autocomplete="off" name="sale_total_paid" value="<?= $data[0]['sale_total_paid'] ?>">
            </td>
            <td class="currentdue"><input type="text" name="sale_total_current_due" style="width: 100px;text-align:center" value="<?= $data[0]['sale_total_current_due'] ?>"></td>
            <td class="method" style="width: 100px;text-align:center">
                <select name="sale_paid_by" style="width: 100px;text-align:center">
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

                    <option value="Bank Deposit" <?php
                                                    if ($data[0]['sale_paid_by'] == 'Bank Deposit') {
                                                        echo 'selected';
                                                    }
                                                    ?>>Bank Deposit</option>
                    <option value="Other" <?php
                                            if ($data[0]['sale_paid_by'] == 'Other') {
                                                echo 'selected';
                                            }
                                            ?>>Other</option>
                </select>
            </td>
            <td class="paymentnote">
                <textarea name="sale_note">
                    <?= $data[0]['sale_note']; ?>
                </textarea>
            </td>

        </tr>
    </table>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>

<script>
    var rowcount = <?= count($data) ?>;

    function addmore() {
        rowcount++;
        var therow = " <tr class=\"rowline\">\r\n<td><span>" + rowcount + "<\/span>\n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> <i class=\" icon-minus-sign\" style=\"font-size:30px;color:red\"></i> <\/a><\/td>\r\n   \n\
     <td><input required=\"required\" type=\"hidden\" name=\"medicine_id[]\"> <input required=\"required\" type=\"text\" name=\"medicine_name[]\"> Store:<input  readonly=\"readonly\"  type=\"text\" name=\"medicine_storage[]\" style=\"width:50px;\"><\/td>\r\n  \n\
      <td><input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"medicine_hsn[]\" style=\"width:40px;\"><\/td>\r\n      \n\
      <td><input required=\"required\" type=\"text\" name=\"sale_strip_quantity[]\" value=\"1\" onkeyup=\"calculate_the_sale(this)\" style=\"width:30px;\"><\/td>\r\n      \n\
      <td><input required=\"required\"  type=\"text\" name=\"sale_loose_quantity[]\" onkeyup=\"calculate_the_sale(this)\"  value=\"0\" style=\"width:30px;\"><\/td>\r\n    \n\
      <td><input required=\"required\"  type=\"text\" name=\"medicine_unit[]\" onkeyup=\"calculate_the_sale(this)\" style=\"width:30px;\"><\/td>\r\n    \n\
          <td><input onchange=\"calculate_the_sale(this)\"  autocomplete=\"off\"   type=\"text\" list name=\"sale_batch[]\" style=\"width: 90