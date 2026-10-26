<style>
    input[type="text"] {
        width: 90%;
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
<div class="row-fluid sortable ui-sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-plus"></i>Product Stock</h2>

        </div>
        <div class="box-content">
            <div class="scrollgard" style="overflow: auto">
                <form method="post" action=""> 
                    <table class="table table-bordered table-striped table-condensed">


                        <div class="product_chooser">  
                            Product Name:  <input type="text" name="product_name" required="required" style="width:200px">
                            Product Mfg:  <input type="text" name="product_manufacturer"  style="width:200px">
                            Product Category:  <input type="text" name="product_category"  style="width:200px">
                            Product HSN:  <input type="text" name="product_hsn"  style="width:200px">
                            <br/>Product Unit:  <input type="text" name="product_unit"  style="width:200px">
                            Product Storage:  <input type="text" name="product_storage"  style="width:200px">
                            <input type="hidden" readonly="true" name="product_id" style="width:200px">
                        </div>
                        <caption><h3>Product Stock Information</h3></caption>

                        <thead>
                            <tr>

                                <th> </th>
                                <th>Product Stock Batch</th>
                                <th>Product Stock Count</th>
                                <th>Product Stock Loose</th>
                                <th>Product Expire Month</th>
                                <th>Product Expire Year</th>
                                <th>Product Mrp</th>
                            </tr>
                        </thead> 
                        <tbody class="rowadd">

                        </tbody>

                    </table>   
                    <a href="#" onclick="addrow()">Add + </a>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button class="btn" onclick="goBack()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!--/span-->

</div>
<script>

    $(document).ready(function () {
        if ($('.rowadd').children().length == 0) {
            addrow();
        }
    })
    function removeRow(targetObj) {
        $(targetObj).parents('tr').remove();
    }
    function addrow() {
        var rowAdd = "<tr>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<a href=\"javascript:void(0)\" onclick=\"removeRow(this);\"> Remove <\/a><\/td>\r\n                            \n\<td class=\"center\">\r\n                                \n\
<input required=\"true\" type=\"text\" name=\"product_stock_batch[]\">\r\n   \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n  \n\
<input required=\"true\" type=\"number\" name=\"product_strip_stock[]\">\r\n \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n \n\
<input required=\"true\" type=\"number\" name=\"product_loose_stock[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n \n\
<input required=\"true\" type=\"number\" name=\"product_expire_month[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<input required=\"true\" type=\"number\" name=\"product_expire_year[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<input required=\"true\" type=\"text\" name=\"product_mrp[]\">\r\n                            \n\
<\/td>\r\n                        \n\
<\/tr>";
        $('.rowadd').append(rowAdd);
    }
    $(document).ready(function () {
        $(document).find('[name^="product_name"]').autocomplete({
            source: '/search.php?table=products&fieldToSearch=product_name',
            search: function (event, ui) {
                $('.product_chooser').find('input').not('[name^="product_name"]').val('');
            },
            minLength: 1, select: function (event, ui) {
                targetRow = $(this).parents('.product_chooser');
                $.each(ui.item.complete, function (populate_field, populate_value) {
                    $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                });
                $('.rowadd').html('');
                $.get('/stocksearch.php?table=product_stocks&fieldToSearch=product_stock_product', {term: $(document).find('[name^="product_id"]').val()}, function (resp) {
                    $(resp).each(function (k, v) {
                        addrow();
                        $(v.complete).each(function (k1) {
                            $('.rowadd').children('tr:last').find('[name^="product_stock_product[]"').val(v.complete.product_stock_product);
                            $('.rowadd').children('tr:last').find('[name^="product_stock_batch[]"').val(v.complete.product_stock_batch);
                            $('.rowadd').children('tr:last').find('[name^="product_loose_stock[]"').val(v.complete.product_loose_stock);
                            $('.rowadd').children('tr:last').find('[name^="product_strip_stock[]"').val(v.complete.product_strip_stock);
                            $('.rowadd').children('tr:last').find('[name^="product_expire_month[]"').val(v.complete.product_expire_month);
                            $('.rowadd').children('tr:last').find('[name^="product_expire_year[]"').val(v.complete.product_expire_year);
                            $('.rowadd').children('tr:last').find('[name^="product_mrp[]"').val(v.complete.product_mrp);
                        });
                        //console.log(v);
                    });
                    if ($('.rowadd').children().length == 0) {
                        addrow();
                    }
                }, 'json');
            }



        });
    });

</script>