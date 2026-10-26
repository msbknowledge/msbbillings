
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <div class="index-wrapper">
         <div class="row-fluid sortable search_box ui-sortable">
            <div class="box span12">
                <div class="box-header well" data-original-title="">
                    <h2><i class="icon-search"></i>Expired Sheet</h2>
                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <!--<a href="/console/">-->
                    <!--    <img src="/msb/msbbillingslogo.png" style="position: absolute;top: 0;background-color: white; height: 50px">-->
                    <!--</a>-->
                    <div class="display_print">
                        <p style="text-align: center;color:red">*** There show only for purchase medicine expired details ***</p><br>
                        <!-- <div class="form_div form-group" style="margin-bottom: 10px;text-align: center;"> -->
                        <div class="container">
                <form action="<?= base_url() ?>console/medicine_stock/expired" id="searchform" role="form" method="post" onsubmit="return false">
    <div class="row">
        <!-- Medicine Input -->
        <div class="col-sm-3">
            <div class="form-group">
                <label for="medicine_name">Medicine:</label>
                <input type="text" name="medicine_name" id="medicine_name" placeholder="Medicine name" class="form-control" />
            </div>
        </div>

        <!-- Search Button -->
        <div class="col-sm-2">
            <div class="form-group">
                <label>&nbsp;</label> <!-- empty label for spacing -->
                <button type="submit" id="search" class="btn btn-info btn-block">SEARCH</button>
            </div>
        </div>
    </div>
</form>


                        </div>
                        <!--<div class="ajax_resp">Choose Filter To Generate Data</div>-->
                    </div>
                    <br>
           
           
                        
                    <div class="row" style=" margin: 0px; overflow-x: scroll;">
                        <table class="table table-bordered table-striped table-condensed css-serial">
                            <!--  <caption><h3>Expire List</h3></caption> -->
                    
                            <tr>
                                <th>Sl No.</th>
                                <th>Medicine Name</th>
                                <th>Batch</th>
                                <th>Purchase Date</th>
                                <th>Stock strip</th>
                                <th>Stock loose</th>
                                <th>Mfg</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Storage</th>
                            </tr>
                            <tbody id="searchResult">
                    
                            </tbody>
                            <tfoot class="tfoot">
                                <tr>
                                    <!-- <td colspan=9></td> -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
 </div> 

<script>
    function myFunction(current_month) {
        var month = new Array();
        month[1] = "January";
        month[2] = "February";
        month[3] = "March";
        month[4] = "April";
        month[5] = "May";
        month[6] = "June";
        month[7] = "July";
        month[8] = "August";
        month[9] = "September";
        month[10] = "October";
        month[11] = "November";
        month[12] = "December";
        var n = month[current_month];
        return n;
    }

    var pageCount = 1;

    function search() {
        if (pageCount == 1) {
            $('#searchResult').html("<tr><td colspan=10>Searching Results...</td></tr>");
        }

        $.post($('#searchform').attr("action") + "?page=" + pageCount, $('#searchform').serialize(), function(resp) {
            // console.log(resp.status);

            if (resp.status == "found") {
                if (Object.keys(resp.result).length > 0) {
                    if (pageCount == 1) {
                        $('#searchResult').html("");
                    }
                    // if (objresp.result.length < 600) {
                    //     $('tfoot').html("<tr><td colspan=10 class=\"coveo-result-row\"> No More Result Found </td></tr>");
                    //     } else {
                    $('tfoot').html("<tr><td colspan=10><button class='btn btn-block' onclick='search()' id='loadmore'>Load More</button></td></tr>");
                    //}
                    //var perpage = objresp.count;
                    if (pageCount == 1) {
                        var counter = pageCount;
                    } else {
                        $getper = localStorage.getItem("previousCount");
                        var counter = parseInt($getper);
                    }

                    $.each(resp.result, function(k, v) {

                        var medicine_id = btoa(v.medicine_id);

                        var tr_des = $("<tr/>");

                        var count_td = $("<td/>").append(counter);
                        $(tr_des).append(count_td);

                        var name_td = $("<td/>").append("<a id='link_remove' href='<?= console_url(); ?>medicine_stock/fast_update/" + v.medicine_id + "' target='_blank' class='btn btn-info'>" + v.medicine_name + "</a>");
                        $(tr_des).append(name_td);

                        var batch_td = $("<td/>").append(v.purchase_batch);
                        $(tr_des).append(batch_td);

                        var date_td = $("<td/>").append(v.purchase_date);
                        $(tr_des).append(date_td);

                        var left_strip_td = $("<td/>").append(v.left_strip);
                        $(tr_des).append(left_strip_td);

                        var left_loose_td = $("<td/>").append(v.left_loose);
                        $(tr_des).append(left_loose_td);

                        var manufacturer_td = $("<td/>").append(v.medicine_manufacturer);
                        $(tr_des).append(manufacturer_td);

                        var getmonth = myFunction(v.purchase_expire_month);

                        var month_td = $("<td/>").append(getmonth);
                        $(tr_des).append(month_td);

                        var year_td = $("<td/>").append(20, v.purchase_expire_year);
                        $(tr_des).append(year_td);

                        var storage_td = $("<td/>").append(v.medicine_storage);
                        $(tr_des).append(storage_td);

                        $('#searchResult').append(tr_des);

                        counter++;
                        localStorage.setItem("previousCount", counter);
                    })
                    pageCount = pageCount + 1;
                } else {
                    pageCount = pageCount + 1;
                    search();
                }
            } else {
                $('#searchResult').hide();
                $('tfoot').html("<tr><td colspan=10 class=\"coveo-result-row\">No Result Found</td></tr>");
            }
        });
    }

    $(document).ready(function() {
        $("#searchform").submit(function() {
            pageCount = 1;
            search();
        });
        $('#searchform').trigger(search());
    });
</script>

<div class="container-fluid" style="padding-right: 20px; padding-left: 20px;">
    <hr style="border-top: 1px solid #f5f5f5; border-bottom: 1px solid #cccccc;">
   
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