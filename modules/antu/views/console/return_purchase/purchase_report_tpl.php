
                           
                            <script>
                                var reqst = null;
                                $(document).ready(function () {
                                    $('#report_sub').click(function () {
                                        reqst = $.post("<?= base_url() ?>console/return_purchase/purchases_report/", $('form').serialize(), function (resp) {
                                            $(".ajax_resp").html(resp);
                                            console.log(resp);
                                            $('div#container').hide();
                                        });
                                    });
                                    $('div#container').hide();



                                });



                            </script>


        <div class="index-wrapper">
         <div class="row-fluid sortable search_box ui-sortable">
            <div class="box span12">
                <div class="box-header well" data-original-title="">
                    <!--<h2><i class="icon-search"></i>Medicine Shortage</h2>-->
                    <!--<div class="box-icon">-->
                    <!--    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>-->
                    <!--    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>-->
                    <!--</div>-->
                </div>
                <div class="box-content">
                        <h1 style="color:black; text-align:center;">Purchase Return Billing Sheet</h1>
                      
                                <!--<form method="post" onsubmit="return false">-->
                                <!--    <div class="controls controls-row">-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="supplier_name">Supplier:</label>-->
                                <!--        <select name="supplier_name" class="supplier_id form-control">-->
                                <!--            <option value="">--supplier name--</option>-->
                                <!--            <?php foreach ($supplier as $val) { ?>-->
                                <!--                <option value="<?= $val['supplier_name'] ?>"><?= $val['supplier_name'] ?></option> -->
                                <!--            <?php } ?>-->
                                <!--        </select>-->
                                <!--        </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="return_purchase_type">Type:</label>-->
                                <!--        <select name="return_purchase_type" class="return_purchase_type form-control">-->
                                <!--            <option value="">--return purchase type--</option>-->
                                <!--            <option value="expiry">Expiry</option>-->
                                <!--            <option value="extra">Extra</option>-->
                                <!--            <option value="damage">Damage</option> -->
                                <!--        </select>-->
                                <!--        </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="return_purchase_medicine">Medicine:</label>-->
                                <!--        <input type="text" name="return_purchase_medicine" id="return_purchase_medicine" placeholder="medicine name" class="return_purchase_medicine form-control"/>-->
                                <!--        </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="return_purchase_Batch">Batch:</label>-->
                                <!--        <input type="text" name="return_purchase_Batch" id="return_purchase_Batch" placeholder="return purchase batch" class="form-control"/>-->
                                <!--        </div>-->
                                <!--         </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="return_purchase_ref">Reference:</label>-->
                                <!--        <input type="text" name ="return_purchase_ref"id="return_purchase_ref" placeholder="reference" class="form-control"/>-->
                                <!--        </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="datepicker">Start Date:</label>-->
                                <!--        <input typex="text" type="date-local" value="<?=  date('Y-m-d',strtotime("-1 month")) ?>" id="start_date" name="start" class="datepicker form-control">-->
                                <!--        </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <label for="end_date">End Date:</label>-->
                                <!--        <input typex="text" type="date-local" value="<?=  date('Y-m-d') ?>" id="end_date" name="end" class="datepicker form-control">-->
                                <!--        </div>-->
                                <!--        <div class="form-group col-sm-3">-->
                                <!--        <button id="report_sub" class="btn btn-info" style=" margin-top: 9%;">SEARCH</button>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</form>-->
<form method="post" onsubmit="return false">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="supplier_name">Supplier:</label>
        <select name="supplier_name" class="supplier_id form-control">
            <option value="">--supplier name--</option>
            <?php foreach ($supplier as $val) { ?>
                <option value="<?= $val['supplier_name'] ?>"><?= $val['supplier_name'] ?></option> 
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-md-6">
       <label for="return_purchase_type">Type:</label>
        <select name="return_purchase_type" class="return_purchase_type form-control">
            <option value="">--return purchase type--</option>
            <option value="expiry">Expiry</option>
            <option value="extra">Extra</option>
            <option value="damage">Damage</option> 
        </select>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
     <label for="return_purchase_medicine">Medicine:</label>
    <input type="text" name="return_purchase_medicine" id="return_purchase_medicine" placeholder="medicine name" class="return_purchase_medicine form-control"/>
                                       
  </div>
  <div class="form-group col-md-6">
     <label for="return_purchase_Batch">Batch:</label>
    <input type="text" name="return_purchase_Batch" id="return_purchase_Batch" placeholder="return purchase batch" class="form-control"/>
  </div>
    </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="return_purchase_ref">Reference:</label>
        <input type="text" name ="return_purchase_ref"id="return_purchase_ref" placeholder="reference" class="form-control"/>
    </div>
    <div class="form-group col-md-4">
     <label for="datepicker">Start Date:</label>
    <input typex="text" type="date-local" value="<?=  date('Y-m-d',strtotime("-1 month")) ?>" id="start_date" name="start" class="datepicker form-control">
    </div>
    <div class="form-group col-md-4">
      <label for="end_date">End Date:</label>
    <input typex="text" type="date-local" value="<?=  date('Y-m-d') ?>" id="end_date" name="end" class="datepicker form-control">
    </div>
  </div>
 <button id="report_sub" class="btn btn-info">SEARCH</button>
</form>
                        <div class="ajax_resp">Choose Filter To Generate Data</div>
                    </div>   
                      </div>
                        </div>
                        </div>
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script>
                                $(function () {
                               
                            
                             $("[name='start_date']").datepicker();
                            $("[name='start_date']").datepicker("option", "dateFormat", 'dd-MM-yy');
                                });
                            </script>
                <script type="text/javascript">
                $("#site_logo").on("click",function(){
                    window.location.href = "/console/";
                })
                // function googleTranslateElementInit() {
                //   new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                // } 
                </script>

                <!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->
      