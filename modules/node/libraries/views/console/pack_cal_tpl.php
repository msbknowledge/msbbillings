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
                                    <option package_name="<?= $value['package_name'] ?>" package_rate="<?= $value['package_rate'] ?>" package_channel_count="<?= $value['package_channel_count'] ?>" > 
                                        <?= $value['package_name'] ?> (Rs. <?= $value['package_rate'] ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="required">Extra Channel</label>
                            <div class="" >

                                <select  id="channellist" class="chzn-select" name="channel_name" multiple="multiple" data-rel="chosen">
                                    <?php
                                    foreach ($paychannels as $value) {
                                        ?>
                                        <option channel_name="<?= $value['channel_name'] ?>" channel_definition="<?= $value['channel_definition'] ?>" channel_price="<?= $value['channel_price'] ?>"> 
                                            <?= $value['channel_name'] ?>  (Rs.<?= $value['channel_price'] ?>)
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
                            <label>INITIAL CHANNEL COUNT :</label>
                            <input class="form-control" type="number" name="initialchannelcount" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>CHANNEL BLOCK :</label>
                            <input class="form-control" type="number" name="block" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>HD CHANNEL :</label>
                            <input class="form-control" type="number" name="hd" value="0" readonly >  
                        </div>
                        <div class="form-group">
                            <label>SD CHANNEL :</label>
                            <input class="form-control" type="number" name="sd" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>TOTAL EXTRA CHANNEL :</label>
                            <input class="form-control" type="number" name="extrachannal" value="0" readonly>  
                        </div>
                        <div class="form-group">
                            <label>TOTAL CHANNEL COUNT:</label>
                            <input class="form-control" type="number" name="totalChannel" value="0" readonly>  
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
                            <label> TOTAL PAY CHANNEL COST:</label>
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
    function channel_count() {
        packageData=[];
        channal_sd = 0;
        channal_hd = 0;
        totalPCC = 0;
        networkCapacityFee=130;
        abc = 0;
        total=0;
        block =0;
        var initialchannelcount = parseInt($('#package option:selected').attr('package_channel_count'));
        //block = initialchannelcount;
        var basePackCharge = parseFloat($('#package option:selected').attr('package_rate'));
        packageData.push({"name":$('#package option:selected').attr('package_name'),"price":parseFloat($('#package option:selected').attr('package_rate'))})
        
        $('#channellist option:selected').each(function (k, v) {
            totalPCC += parseFloat($(v).attr('channel_price'));
            if ($(v).attr('channel_definition') == 'SD') {
                channal_sd++;
                block++;
            }
            if ($(v).attr('channel_definition') == 'HD') {
                channal_hd++;
                block = block + 2;
            }
            packageData.push({"name":$(v).attr('channel_name'),"price":parseFloat($(v).attr('channel_price'))})
        });
        var channal = channal_hd + channal_sd;
        
        var finalBlockCount =initialchannelcount+block; 
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
        $('[name="initialchannelcount"]').val(initialchannelcount);
        $('[name="totalChannel"]').val(channal+initialchannelcount);

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
            channel_count();

        })
        $('.chzn-select').change(function () {

            channel_count();




        });
    });

</script>






