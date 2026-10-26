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
	<span>Data Saved!</span>
    </div>

<div class="row-fluid sortable ui-sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-plus"></i>product Stock</h2>

        </div>
        <div class="box-content">
            <div class="scrollgard" style="overflow: auto">
                <form method="post" action="" id="product_update" onsubmit="return false"> 
                    <table class="table table-bordered table-striped table-condensed">

                            <div class="product_chooser">  
                            product Name:  <input type="text" name="product_name" value="<?=$product_name?>" required="required" style="width:200px">
                            product Mfg:  <input type="text" name="product_manufacturer"  value="<?=$product_manufacturer?>"  style="width:200px">
                            product Category:  <input type="text" name="product_category"  value="<?=$product_category?>"  style="width:200px">
                            product HSN:  <input type="text" name="product_hsn" value="<?=$product_hsn?>"    style="width:200px">
                            <br/>product Unit:  <input type="text" name="product_unit" value="<?=$product_unit?>" style="width:200px">
                            product Storage:  <input type="text" name="product_storage" value="<?=$product_storage?>"   style="width:200px">
                            <input type="hidden" readonly="true" name="product_id" value="<?=$product_id?>"  style="width:200px">
                        </div>
                        <caption>
							<h3 style>product Stock Information</h3>
							<h6 style="color:red">Only product that have real purchase entry will show here.Please do not forget to enter purchase for the product which is sold but with no purchase entry 
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
<input required=\"required\" readonly=\"readonly\"  type=\"text\" name=\"product_stock_batch[]\">\r\n   \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n  \n\
<input required=\"true\" type=\"number\" class=\"product_strip_stock\" readonly=\"true\">\r\n \n\
<\/td>\r\n       \n\
<td class=\"center\">\r\n  \n\
<input type=\"number\" value=\"\" name=\"product_strip_stock[]\">\r\n \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n \n\
<input  type=\"number\" readonly=\"true\" class=\"product_loose_stock\">\r\n                            \n\
<\/td>\r\n      \n\
<td class=\"center\">\r\n \n\
<input  type=\"number\" value=\"\" name=\"product_loose_stock[]\">\r\n                            \n\
<\/td>\r\n       \n\
<td class=\"center\" style=\"display:none\">\r\n               \n\
<input typex=\"text\"  type=\"datetime-local\" value=\"<?=  date('Y-m-d\TH:i:s',time()) ?>\" name=\"product_stock_date[]\">\r\n                                   \n\
<\/td>\r\n            \n\                                           \n\
<td class=\"center\">\r\n \n\
<input required=\"true\" readonly=\"true\"   type=\"number\" name=\"product_expire_month[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<input required=\"true\" readonly=\"true\"  type=\"number\" name=\"product_expire_year[]\">\r\n                            \n\
<\/td>\r\n                            \n\
<td class=\"center\">\r\n                                \n\
<input required=\"true\" type=\"text\" readonly=\"true\"  name=\"product_mrp[]\">\r\n                            \n\
<\/td>\r\n                        \n\
<\/tr>";
        $('.rowadd').append(rowAdd);
    }
    $(document).ready(function () {
        $(document).find('[name^="product_name"]').autocomplete({
            source: '/search.php?table=products&fieldToSearch=product_name',
            search: function (event, ui) {
                $('.product_chooser').find('input').not('[name^="product_name"]').val('');
		$('.rowadd').html("");
            },
            minLength: 1, select: function (event, ui) {
                targetRow = $(this).parents('.product_chooser');
                $.each(ui.item.complete, function (populate_field, populate_value) {
                    $(targetRow).find('[name^="' + populate_field + '"').val(populate_value);
                });
                currentPostRequest = $.get('<?=console_url()?>/product_stock/stock_by_batch/', {product_id: $(document).find('[name^="product_id"]').val()}, function (resp) {
                         console.log(resp);
                    $('.rowadd').html("");
                    $(resp).each(function (k, v) {

                        addrow();
                        $(v.complete).each(function (k1) {
                            $('.rowadd').children('tr:last').find('[name^="product_stock_product[]"').val(v.complete.product_id);
                            $('.rowadd').children('tr:last').find('[name^="product_stock_batch[]"').val(v.value);
                            $('.rowadd').children('tr:last').find('.product_loose_stock').val(v.complete.left_loose);
                            $('.rowadd').children('tr:last').find('.product_strip_stock').val(v.complete.left_strip);
                            $('.rowadd').children('tr:last').find('.product_stock_date').val(v.complete.product_stock_date);
                            $('.rowadd').children('tr:last').find('[name^="product_expire_month[]"').val(v.complete.sale_expire_month);
                            $('.rowadd').children('tr:last').find('[name^="product_expire_year[]"').val(v.complete.sale_expire_year);
                            $('.rowadd').children('tr:last').find('[name^="product_mrp[]"').val(v.complete.product_mrp);
                        });
                        console.log(v);
                    });
                    if ($('.rowadd').children().length == 0) {
                        window.alert("This product stock is zero!");
                    }
                }, 'json');
            }



        });
    });
<? if(!empty($product_id)){?>
	                
                $.get('<?=console_url()?>/product_stock/stock_by_batch/', {product_id: <?=$product_id?>}, function (resp) {
                    $(resp).each(function (k, v) {
						 addrow();
                        $(v.complete).each(function (k1) {
                            $('.rowadd').children('tr:last').find('[name^="product_stock_product[]"').val(v.complete.product_id);
                            $('.rowadd').children('tr:last').find('[name^="product_stock_batch[]"').val(v.value);
                            $('.rowadd').children('tr:last').find('.product_loose_stock').val(v.complete.left_loose);
                            $('.rowadd').children('tr:last').find('.product_strip_stock').val(v.complete.left_strip);
                            $('.rowadd').children('tr:last').find('.product_stock_date').val(v.complete.product_stock_date);
                            $('.rowadd').children('tr:last').find('[name^="product_expire_month[]"').val(v.complete.sale_expire_month);
                            $('.rowadd').children('tr:last').find('[name^="product_expire_year[]"').val(v.complete.sale_expire_year);
                            $('.rowadd').children('tr:last').find('[name^="product_mrp[]"').val(v.complete.product_mrp);
                        });
                        console.log(v);
                    });
                    if ($('.rowadd').children().length == 0) {
                        //addrow();
                        window.alert("This product stock is zero!");
                    }
                }, 'json');
<?}?>

$("#product_update").on("submit",function(){
    $('button').attr("disable","disable"); 
     currentPostRequest = $.post("https://suraksha.simplebillings.com/console/product_stock/fast_update",$("#product_update").serialize(),
  // currentPostRequest =  $.post("https://suraksha.simplebillings.com/console/product_stock/fast_update",
  //   {
  //       data:$("form").serializeArray(),
  //   },
    function(data, status){
	console.log(data);      
	$("#svmsg").show();
	setTimeout(function(){
	$("#svmsg").hide();
location.reload();
	},1000);              
      //alert("product Fast Update successfully !");
     // location.reload();
      });
})

</script>
