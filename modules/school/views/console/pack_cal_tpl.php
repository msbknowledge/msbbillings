<div class="container">
    <div class="row">
        <div class="span4">
            <div class="well">
          
                        <div class="form-group">
                            <label for="required">Base Pack</label>
                            <select  id="package" class="chzn-select" name="package_name" data-rel="chosen">
                                <option package_rate="0">choose one</option>>
                                <?php
                                foreach ($packages as $value) {
                                    ?>
                                    <option package_name="<?= $value['package_name'] ?>" package_rate="<?= $value['package_rate'] ?>" package_course_count="<?= $value['package_course_count'] ?>" > 
                                        <?= $value['package_name'] ?> (Rs. <?= $value['package_rate'] ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="required">Extra course</label>
                            <div class="" >

                                <select  id="courselist" class="chzn-select" name="course_name" multiple="multiple" data-rel="chosen">
                                    <?php
                                    foreach ($paycourses as $value) {
                                        ?>
                                        <option course_name="<?= $value['course_name'] ?>" course_definition="<?= $value['course_definition'] ?>" course_price="<?= $value['course_price'] ?>"> 
                                            <?= $value['course_name'] ?>  (Rs.<?= $value['course_price'] ?>)
                                        </option>
                                    <?php } ?>
                                </select>


                            </div>

                        </div>
                </div>
            </div>
            <div class="span4">
                <div class="well">
                        <div class="form-group">
                            <label>INITIAL course COUNT :</label>
                            <input class="form-control" type="number" name="initialcoursecount" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>course BLOCK :</label>
                            <input class="form-control" type="number" name="block" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>HD course :</label>
                            <input class="form-control" type="number" name="hd" value="0" readonly >  
                        </div>
                        <div class="form-group">
                            <label>SD course :</label>
                            <input class="form-control" type="number" name="sd" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>TOTAL EXTRA course :</label>
                            <input class="form-control" type="number" name="extrachannal" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>TOTAL course COUNT:</label>
                            <input class="form-control" type="number" name="totalcourse" value="0" readonly>  
                        </div>
                    </div>
                </div>
        <div class="span4">
            <div class="well">
                <h4>Calculations</h4>
   

                <div class="form-group">
                        <label> BASE PACK CHARGES :</label>
                        <input class="form-control" type="number" name="bpc" value="0" readonly>  
                    </div>
                    <div class="form-group">
                            <label> TOTAL PAY course COST:</label>
                            <input class="form-control" type="number" name="pcc" value="0" readonly>  
                    </div>
                    <div class="form-group">
                        <label> NETWORK CAPACITY FEE :</label>
                        <input class="form-control" type="number" name="ancf" value="0" readonly>  
                    </div>
                    <div class="form-group">
                        <label>Total :</label>
                        <input class="form-control" type="number" name="total" value="0.00" readonly>  
                    </div>
                    <div class="form-group">
                        <label>Total with 18% GST :</label>
                        <input class="form-control" type="number" name="totalwithgst" value="0.00" readonly>  
                    </div>
                    
            </div>
        </div>
    </div>
</div>
<script>
var packageData=[];
    function course_count() {
        packageData=[];
        channal_sd = 0;
        channal_hd = 0;
        totalPCC = 0;
        networkCapacityFee=130;
        abc = 0;
        total=0;
        block =0;
        var initialcoursecount = parseInt($('#package option:selected').attr('package_course_count'));
        //block = initialcoursecount;
        var basePackCharge = parseFloat($('#package option:selected').attr('package_rate'));
        packageData.push({"name":$('#package option:selected').attr('package_name'),"price":parseFloat($('#package option:selected').attr('package_rate'))})
        
        $('#courselist option:selected').each(function (k, v) {
            totalPCC += parseFloat($(v).attr('course_price'));
            if ($(v).attr('course_definition') == 'SD') {
                channal_sd++;
                block++;
            }
            if ($(v).attr('course_definition') == 'HD') {
                channal_hd++;
                block = block + 2;
            }
            packageData.push({"name":$(v).attr('course_name'),"price":parseFloat($(v).attr('course_price'))})
        });
        var channal = channal_hd + channal_sd;
        
        var finalBlockCount =initialcoursecount+block; 
        if(finalBlockCount>100){
            var abc = parseInt((finalBlockCount-100) / 25);
            var remain = ((finalBlockCount-100) % 25);
            if (remain > 0) {
                abc++;
            }
            networkCapacityFee+=(abc*20);
        }
     
        totalPCC=totalPCC.toFixed(2);
        total = (basePackCharge + parseFloat(totalPCC) + networkCapacityFee).toFixed(2);
        totalwithgst = (parseFloat(total)+(parseFloat(total)*18)/100).toFixed(2);
        $('[name="ancf"]').val(networkCapacityFee);
        $('[name="bpc"]').val(basePackCharge);
        $('[name="extrachannal"]').val(channal);
        $('[name="initialcoursecount"]').val(initialcoursecount);
        $('[name="totalcourse"]').val(channal+initialcoursecount);

        $('[name="hd"]').val(channal_hd);
        $('[name="sd"]').val(channal_sd);
        $('[name="pcc"]').val(totalPCC);
        $('[name="block"]').val(finalBlockCount);
        $('[name="total"]').val(total);
        $('[name="totalwithgst"]').val(totalwithgst);
        packageData.push({"name":"Network Capacity Fee","price":parseFloat(networkCapacityFee)});
        var invoiceMeta = {"total":parseFloat(totalwithgst),"items":packageData};
        console.log(invoiceMeta);
    }

    $('document').ready(function () {
        $('input').keyup(function(){
            course_count();

        })
        $('.chzn-select').change(function () {

            course_count();




        });
    });

</script>






