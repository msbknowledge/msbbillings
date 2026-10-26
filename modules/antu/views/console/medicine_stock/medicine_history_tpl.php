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
<div class="row-fluid">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-plus"></i>Medicine history</h2>

        </div>
        <div class="box-content">
            <div class="scrollgard" style="overflow: auto">
                <form method="post" action=""> 
                    <table class="table table-bordered table-striped table-condensed">


                        <div class="medicine_chooser">  
                            Medicine Name:  <input type="text" name="medicine_name" required="required" style="width:200px">
                            Medicine Mfg:  <input type="text" name="medicine_manufacturer"  style="width:200px">
                            Medicine Category:  <input type="text" name="medicine_category"  style="width:200px">
                            Medicine HSN:  <input type="text" name="medicine_hsn"  style="width:200px">
                            <br/>Medicine Unit:  <input type="text" name="medicine_unit"  style="width:200px">
                            Medicine Storage:  <input type="text" name="medicine_storage"  style="width:200px">
                            <input type="hidden" readonly="true" name="medicine_id" style="width:200px">
                        </div>
                        <caption><h3>Medicine history</h3></caption>

                        

                    </table>   
                   
                    <div class="form-actions">
                       
                    </div>
                </form>
            </div>
        </div>
    </div><!--/span-->

</div>
<script>

   
    $(document).ready(function () {
        $(document).find('[name^="medicine_name"]').autocomplete({
            source: '/search.php?table=medicines&fieldToSearch=medicine_name',
            search: function (event, ui) {
                $('.medicine_chooser').find('input').not('[name^="medicine_name"]').val('');
            },
            minLength: 1, select: function (event, ui) {
                targetRow = $(this).parents('.medicine_chooser');
                $.each(ui.item.complete, function (populate_field, populate_value) {
                    $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                });
                $('.rowadd').html('');
                $.get('/purchase_sale_medicine_search.php?table_purchase=purchases&table_sale=sales&table_medicine_stock=medicine_stocks&table_return_sale=returns_sales&table_return_purchase=return_purchases', {term: $(document).find('[name^="medicine_id"]').val()}, function (resp) {
                   
        $('.form-actions').html(resp);
                  //console.log(resp);
                   
                });
            }



        });
    });

</script>