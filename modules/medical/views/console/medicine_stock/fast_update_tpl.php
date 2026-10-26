<style>
    input[type="text"] {
        width: 90%;
    }
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
            right center no-repeat;
    }
    input{
    width: 100px;}
    input[type="datetime-local"] {
    width: 90%;
}
</style>

    <div class="alert alert-success"  id="svmsg" style="display:none">
        <button type="button" class="close" data-dismiss="alert">×</button>
	<span>Stock Update Successfully!</span>
    </div>

<div class="row-fluid sortable ui-sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-plus"></i>Medicine Stock</h2>

        </div>
        <div class="box-content">
            <div class="scrollgard" style="overflow: auto">
                <form method="post" action="" id="medicine_update" onsubmit="return false"> 
                    <table class="table table-bordered table-striped table-condensed">

                            <div class="medicine_chooser">  
                            Medicine Name:  <input type="text" name="medicine_name" value="<?=$medicine_name?>" required="required" style="width:200px">
                            Medicine Mfg:  <input type="text" name="medicine_manufacturer"  value="<?=$medicine_manufacturer?>"  style="width:200px">
                            Medicine Category:  <input type="text" name="medicine_category"  value="<?=$medicine_category?>"  style="width:200px">
                            Medicine HSN:  <input type="text" name="medicine_hsn" value="<?=$medicine_hsn?>"    style="width:200px">
                            <br/>Medicine Unit:  <input type="text" name="medicine_unit" value="<?=$medicine_unit?>" style="width:200px">
                            Medicine Storage:  <input type="text" name="medicine_storage" value="<?=$medicine_storage?>"   style="width:200px">
                            <input type="hidden" readonly="true" name="medicine_id" value="<?=$medicine_id?>"  style="width:200px">
                        </div>
                        <caption>
							<h3 style>Medicine Stock Information</h3>
							<h6 style="color:red">Only medicine that have real purchase entry will show here.Please do not forget to enter purchase for the medicine which is sold but with no purchase entry 
							</h6>
                        </caption>

                        <thead>
                            <tr>
                                <th>Batch</th>
                                <th>Count Actual</th>
                                <th>Count Balance</th>
                                <th>Loose Actual</th>
                                <th>Loose Balance</th>
                                <th style="display:none">Update date</th>
                                <th>Expire Month</th>
                                <th>Expire Year</th>
                                <th>Mrp</th>
                            </tr>
                        </thead> 
                        <tbody class="rowadd">
                        </tbody>

                    </table>   
                    <!--a href="#" onclick="addrow()">Add + </a-->
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
        // if ($('.rowadd').children().length == 0) {
        //     addrow();
        // }
    })
    function removeRow(targetObj) {
        $(targetObj).parents('tr').remove();
    }
    function addrow() {
        var rowAdd = "<tr>\r\n                            \n\
\r\n                            \n\<td class=\"center\">\r\n                                \n\
<input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"medicine_stock_batch[]\">\r\n   \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n  \n\
<input required=\"true\" type=\"number\" class=\"medicine_strip_stock\" readonly=\"true\">\r\n \n\
<\/td>\r\n       \n\
<td class=\"center\">\r\n  \n\
<input type=\"number\" value=\"\" name=\"medicine_strip_stock[]\">\r\n \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n \n\
<input  type=\"number\" readonly=\"true\" class=\"medicine_loose_stock\">\r\n                            \n\
<\/td>\r\n      \n\
<td class=\"center\">\r\n \n\
<input  type=\"number\" value=\"\" name=\"medicine_loose_stock[]\">\r\n                            \n\
<\/td>\r\n       \n\
<td class=\"center\">\r\n \n\
<input required=\"true\" readonly=\"true\"   type=\"number\" name=\"medicine_expire_month[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<input required=\"true\" readonly=\"true\"  type=\"number\" name=\"medicine_expire_year[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<input required=\"true\" type=\"text\" readonly=\"true\"  name=\"medicine_mrp[]\">\r\n                            \n\
<\/td>\r\n                        \n\
<\/tr>";
        $('.rowadd').append(rowAdd);
    }
    $(document).ready(function () {
        $(document).find('[name^="medicine_name"]').autocomplete({
            source: '/search.php?table=medicines&fieldToSearch=medicine_name',
            search: function (event, ui) {
                $('.medicine_chooser').find('input').not('[name^="medicine_name"]').val('');
		$('.rowadd').html("");
            },
            minLength: 1, select: function (event, ui) {
                targetRow = $(this).parents('.medicine_chooser');
                $.each(ui.item.complete, function (populate_field, populate_value) {
                    $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                });
                currentPostRequest = $.get('<?=console_url()?>/medicine_stock/stock_by_batch/', {medicine_id: $(document).find('[name^="medicine_id"]').val()}, function (resp) {
                         console.log(resp);
                    $('.rowadd').html("");
                    $(resp).each(function (k, v) {

                        addrow();
                        $(v.complete).each(function (k1) {
                            $('.rowadd').children('tr:last').find('[name^="medicine_stock_medicine[]"').val(v.complete.medicine_id);
                            $('.rowadd').children('tr:last').find('[name^="medicine_stock_batch[]"').val(v.value);
                            $('.rowadd').children('tr:last').find('.medicine_loose_stock').val(v.complete.left_loose);
                            $('.rowadd').children('tr:last').find('.medicine_strip_stock').val(v.complete.left_strip);
                            $('.rowadd').children('tr:last').find('[name^="medicine_expire_month[]"').val(v.complete.sale_expire_month);
                            $('.rowadd').children('tr:last').find('[name^="medicine_expire_year[]"').val(v.complete.sale_expire_year);
                            $('.rowadd').children('tr:last').find('[name^="medicine_mrp[]"').val(v.complete.medicine_mrp);
                        });
                        console.log(v);
                    });
                    if ($('.rowadd').children().length == 0) {
                        window.alert("This medicine stock is zero!");
                    }
                }, 'json');
            }



        });
    });
<? if(!empty($medicine_id)){?>
	                
                $.get('<?=console_url()?>/medicine_stock/stock_by_batch/', {medicine_id: <?=$medicine_id?>}, function (resp) {
                    $(resp).each(function (k, v) {
						 addrow();
                        $(v.complete).each(function (k1) {
                            $('.rowadd').children('tr:last').find('[name^="medicine_stock_medicine[]"').val(v.complete.medicine_id);
                            $('.rowadd').children('tr:last').find('[name^="medicine_stock_batch[]"').val(v.value);
                            $('.rowadd').children('tr:last').find('.medicine_loose_stock').val(v.complete.left_loose);
                            $('.rowadd').children('tr:last').find('.medicine_strip_stock').val(v.complete.left_strip);
                            $('.rowadd').children('tr:last').find('[name^="medicine_expire_month[]"').val(v.complete.sale_expire_month);
                            $('.rowadd').children('tr:last').find('[name^="medicine_expire_year[]"').val(v.complete.sale_expire_year);
                            $('.rowadd').children('tr:last').find('[name^="medicine_mrp[]"').val(v.complete.medicine_mrp);
                        });
                        console.log(v);
                    });
                    if ($('.rowadd').children().length == 0) {
                        //addrow();
                        window.alert("This medicine stock is zero!");
                    }
                }, 'json');
<?}?>

$("#medicine_update").on("submit",function(){
    $('button').attr("disable","disable"); 
     currentPostRequest = $.post("<?= base_url() ?>console/medicine_stock/fast_update",$("#medicine_update").serialize(),function(data, status){
	console.log(data);      
	$("#svmsg").show();
	setTimeout(function(){
	$("#svmsg").hide();
        location.reload();
	},1000);              
      //alert("Medicine Fast Update successfully !");
     // location.reload();
      });
})

</script>
