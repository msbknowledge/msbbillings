<div class="row-fluid sortable search_box ui-sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
            <h2><i class="icon-search"></i>Generate Full Bill</h2>
        </div>
        <div class="box-content">
            <form action="" style="display:table;margin-bottom: 0px" method="post" onsubmit="return false">
                <div style="float: left;margin: 11px;min-width:200px;min-height:61px">
                    <div class="alert alert-success" style="display:none">
                        <button class="close" data-close="alert"></button>
                        <span>Bill Generate successfully.</span>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputIcon">Bill Date</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-pencil"></i></span>
                                <input id="inputIcon" required type="date" name="invoice_bill_date">

                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputIcon1">Due Date</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-pencil"></i></span>
                                <input id="inputIcon1" required type="date" name="invoice_due_date">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right" style=" margin-left: 10px;">Generate Bill</button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>

    $('form').submit(function() {
        var url = window.location.href;
        $.post(url, $(this).serialize(), function(resp) {
           
            if (resp.status == "success") {
                $(".alert").find("span").html(resp.msg);
                $(".alert").show();
                // setTimeout(function(){
                // 	window.location="login.php"
                // }, 2000);
            }else{
            alert("Please Add The Customer");
            }
        });

    })
    // 	});
</script>