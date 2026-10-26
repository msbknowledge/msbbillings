
<style>
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
            right center no-repeat;
    }
    div.span3{
        margin: 10px!important;
        background: azure;
        height: 70px;
        float: left;
    }
.chzn-container {
    width: 90%!important;
}

.span3 {
    width: 262px;
}

</style>
<?php

error_reporting(4);

/**
 * add_edit view helper function **
 * 
 *  
 * * */
function field_datepicker($t_key = NULL, $table_meta, $table_td) {
    if (is_array($table_meta['config']['datepicker_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['datepicker_columns']);
        if ($arr_index !== FALSE) {
            ?> 
            <div class="span3">
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>

                            <input type="text" class="datepicker"  name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div>								  <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?
            return true;
        } else {
            return false;
        }
    }
}

function field_date_time_picker($t_key = NULL, $table_meta, $table_td) {

    if (is_array($table_meta['config']['datetimepicker_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['datetimepicker_columns']);
        if ($arr_index !== FALSE) {
            ?>
            <div class="span3">
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>

                            <input type="text" class="datetimepicker"  name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div>								  <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?
            return true;
        } else {
            return false;
        }
    }
}

function field_status($t_key, $table_meta, $table_td) {
    if (is_array($table_meta['config']['use_status_columns'])) {
        if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
            ?>
            <div class="span3">
                <?
                switch (intval($table_td)) {
                    case 1 :
                        echo '<span class="label label-success">On</span>';
                        break;
                    default :
                        echo '<span class="label label-important">Off</span>';
                }
                ?>
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <input name="<?= $t_key ?>" data-no-uniform="true" type="checkbox" class="iphone-toggle" <?php
                if (intval($table_td)) {
                    echo 'checked="checked"';
                }
                ?> value="1">
            </div>
            <?
            return true;
        } else {
            return false;
        }
    }
}

function field_textarea($t_key = NULL, $table_meta, $table_td) {
    if (is_array($table_meta['config']['textarea_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['textarea_columns']);
        if ($arr_index !== FALSE) {
            ?>
            <div class="span3 span8">
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <textarea class="cleditorx" name="<?= $t_key ?>"  id="textarea2" style="width:100%"><?= $table_td ?></textarea>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?
            return true;
        } else {
            return false;
        }
    }
}

function is_primry_key($t_key = NULL, $table_meta) {
    if ($table_meta['config']['tablePrimaryKey'] == $t_key)
        return TRUE;
    else
        return FALSE;
}

function field_image($t_key = NULL, $table_meta, $table_td) {
    if (is_array($table_meta['config']['use_image_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
        if ($arr_index !== FALSE) {
            ?>
            <div class="span3">
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <img id="file_uploader_image<?= $t_key ?>" class="file_uploaded_img" style="max-width: 300px" src='<?= $table_td ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '' ) . $table_td : cdn_url() . 'uploads/noImage.jpg'; ?>' alt="<?= $table_td ?>"/>
                    <div class="controls">
                        <input type="hidden" id="file_uploader_field<?= $t_key ?>"  name="<?= $t_key ?>" value="<?= $table_td ?>" value="<?= $table_td ?>"/>
                        <input type="file" data-no-uniform="true" id="file_uploader<?= $t_key ?>"  />
                        <span class="help-inline"></span>
                    </div>
                </div>

                <script>
                    $('#file_uploader<?= $t_key ?>').uploadify({
                        'swf': '<?= cdn_url() ?>js/uploadify.swf',
                        'uploader': '<?= cdn_url() ?>uploader/',
                        'multi': <?= $table_meta['config']['multi_upload'] ?>,
                        'onUploadSuccess': function (file, data, response) {
                            $('#file_uploader_image<?= $t_key ?>').attr('src', '<?= $table_meta['config']['use_image_columns_path'][0] ?>' + $.trim(data));
                            $('#file_uploader_field<?= $t_key ?>').val($.trim(data));
                        }
                        // Put your options here
                    });
                </script>
            </div>
            <?
            return true;
        } else {
            return false;
        }
    }
}

function field_dropdown($t_key = NULL, $table_meta, $table_td) {
    if (is_array($table_meta['config']['use_dropdown_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['use_dropdown_columns']);
        if ($arr_index !== FALSE) {
            ?>
            <div class="span3">
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <select <?= is_readonly($t_key, $table_meta['config']['readonly_columns']) ? 'disabled = "disabled"' : '' ?>
                            <?= isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key]) ? " multiple name='" . $t_key . "[]'" : " name='$t_key'" ?>    data-placeholder="type here" data-rel="chosen">
                            <option value="">--Choose An Option-- </option>
                            <?php
                            $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$t_key]) ? $table_meta['config']['use_dropdown_columns_options'][$t_key] : $table_meta['config']['use_dropdown_columns_options']);
                            foreach ($optionList as $optkey => $optvalue):
                                ?>
                                <option value="<?= $optkey ?>" <?php
                                if (isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key])) {
                                    if (!empty($table_td) && array_search($optkey, json_decode($table_td, TRUE)) !== FALSE) {
                                        ?>selected="selected"<?php
                                            }
                                        } else {
                                            if ($optkey == $table_td) {
                                                ?>selected="selected"<?php
                                            }
                                        }
                                        ?>><?= $optvalue ?></option>
                                    <?php endforeach; ?>
                        </select>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?
            return true;
        } else {
            return false;
        }
    }
}

function field_text($t_key = NULL, $table_meta, $table_td) {
    if (is_readonly($t_key, $table_meta) || is_primry_key($t_key, $table_meta)) {
        ?>
        <div class="span3">
            <div class="control-group">
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <div class="controls">
                    <input type="text" readonly="readonly" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
        </div>
        <?
    } else {
        
        ?>
        <div class="span3">

            <div class="control-group">
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <div class="controls">
                    <input type="text" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
        </div>
        <?
    }
}
?>
<form id="addEditForm" class="span6 well" method="post" action="save_details" onsubmit="return false">
    <?php foreach ($table_meta['data'] as $t_key => $table_td): ?>
        <?php
        if (!is_array($table_td))
            $field_value = $table_td;

        if (field_status($t_key, $table_meta, $field_value))
            continue;
        if (field_image($t_key, $table_meta, $field_value))
            continue;
        if (field_dropdown($t_key, $table_meta, $field_value))
            continue;

        if (field_textarea($t_key, $table_meta, $field_value))
            continue;
        if (field_datepicker($t_key, $table_meta, $field_value))
            continue;
        if (field_date_time_picker($t_key, $table_meta, $field_value))
            continue;
        field_text($t_key, $table_meta, $field_value);
        ?>
    <?php endforeach; ?> 

<script>
    var validationMeta = $.parseJSON('<?= json_encode($table_meta['config']['validation']); ?>');
    $.each(validationMeta, function (key, value) {
        $('#addEditForm').find('[name=' + key + ']').attr('from-validation', value);
    });
    $('.file_uploader').uploadify({
        'swf': '<?= cdn_url() ?>js/uploadify.swf',
        'uploader': '<?= cdn_url() ?>uploader/',
        'multi': <?= $table_meta['config']['multi_upload'] ?>,
        'onUploadSuccess': function (file, data, response) {
            $('.file_uploaded_img').attr('src', '<?= $table_meta['config']['use_image_columns_path'][0] ?>' + $.trim(data));
            $('#file_uploader_field').val($.trim(data));
        }
        // Put your options here
    });
    $('.cleditor').cleditor();
<?php if (isset($this->page_config['autocomplete'])): ?>
        var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
        $.each(autoComplete, function (targetField, value) {
            $.each(value, function (model, fieldToSearch) {
                $('[name="' + targetField + '"]').autocomplete({
                    source: page_url + "autocomplete/" + model + '/' + fieldToSearch,
                    minLength: 1
                });
            });
        });
<?php endif; ?>
    /*****/
</script>
<div class="form-actions" style="clear: both;/*position:fixed;*/bottom:0">
    <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
<!-------------->
<? 
$customerPackageData = json_decode($table_meta['data']['customer_package'],true);


?>
<div class="span5 container">
    <div class="row">
        <div class="span5">
            <div class="well">
          
                        <div class="form-group">
                            <label for="required">Base Pack</label>
                            <select  id="package" class="chzn-select" name="package_name" data-rel="chosen">
                                <option package_rate="0">choose one</option>>
                                <?php
                                foreach ($this->page_config['channelData']['packages'] as $value) {
                                    $keyx = array_search( $value['package_name'], array_column($customerPackageData['items'], 'name'));
                                    ?>
                                    <option <? if($keyx!==false){echo "selected";}?> package_name="<?= $value['package_name'] ?>" package_rate="<?= $value['package_rate'] ?>" package_channel_count="<?= $value['package_channel_count'] ?>" > 
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

                                    foreach ($this->page_config['channelData']['paychannels'] as $value) {
                                        $key = array_search( $value['channel_name'], array_column($customerPackageData['items'], 'name'));

                                        ?>
                                        <option <? if(!empty($key)){echo "selected";}?> channel_name="<?= $value['channel_name'] ?>" channel_type="<?= $value['channel_type'] ?>" channel_definition="<?= $value['channel_definition'] ?>" channel_price="<?= $value['channel_price'] ?>"> 
                                            <?= $value['channel_name'] ?>(Rs.<?= $value['channel_price'] ?>)  
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>

                        </div>
                </div>
            </div>
            <div class="span5">
                <div class="well">
                        <div class="form-group">
                            <label>INITIAL CHANNEL COUNT :</label>
                            <input class="form-control" type="number" name="initialchannelcount" value="0" readonly style=" width: 97%;">  
                        </div>
                        <div class="form-group">
                            <label>CHANNEL BLOCK :</label>
                            <input class="form-control" type="number" name="block" value="0" readonly style=" width: 97%;">  
                        </div>
                        <div class="form-group">
                            <label>HD CHANNEL :</label>
                            <input class="form-control" type="number" name="hd" value="0" readonly style=" width: 97%;">  
                        </div>
                        <div class="form-group">
                            <label>SD CHANNEL :</label>
                            <input class="form-control" type="number" name="sd" value="0" readonly style=" width: 97%;">  
                        </div>
                        <div class="form-group">
                            <label>TOTAL EXTRA CHANNEL :</label>
                            <input class="form-control" type="number" name="extrachannal" value="0" readonly style=" width: 97%;">  
                        </div>
                        <div class="form-group">
                            <label>TOTAL CHANNEL COUNT:</label>
                            <input class="form-control" type="number" name="totalChannel" value="0" readonly style=" width: 97%;">  
                        </div>
                    </div>
                </div>
        <div class="span5">
            <div class="well" style=" height: 260px;">
                <h4>Calculations</h4>
   

                <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label> BASE PACK CHARGES :</label>
                        <input class="form-control" type="number" name="bpc" value="0" readonly style=" width: 180px;">  
                    </div>
                    <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                            <label> TOTAL PAY CHANNEL COST:</label>
                            <input class="form-control" type="number" name="pcc" value="0" readonly style=" width: 180px;">  
                    </div>
                    <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label> NETWORK CAPACITY FEE :</label>
                        <input class="form-control" type="number" name="ancf" value="0" readonly style=" width: 180px;">  
                    </div>
                    <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label>Total :</label>
                        <input class="form-control" type="number" name="total" value="0.00" readonly style=" width: 180px;">  
                    </div>
                   
                 <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label>Discount :</label>
                       
                        <input class="form-control" id="disValue" type="number" name="discount"  value="<?=$customerPackageData[discount]?>"  style=" width: 180px;"> 
                        
                    </div>
                 <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label>After Discount total :</label>
                        <input class="form-control" type="number" name="discounttotal" value="0.00" readonly  style=" width: 180px;">  
                    </div>
                        <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label>Total with 18% GST :</label>
                        <input class="form-control" type="number" name="totalwithgst" value="0.00" readonly style=" width: 180px;"> 
                        </div>
                 
                    <div class="form-group span2" style=" margin-left: 0; width: 208px;">
                        <label>Payable Roundup :</label>
                        <input class="form-control" type="number" name="roundup" value="0.00" readonly style=" width: 180px;">  
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
        channel_bouquet_list='';
        totalPCC = 0;
        networkCapacityFee=130;
        abc = 0;
        total=0;
        block =0;
        discount=0;
        discounttotal=0;
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
            console.log($(v).attr('channel_definition'));
             if ($(v).attr('channel_definition') == '') {
                channal_sd+= parseInt($(v).attr('channel_type'));
                block+= parseInt($(v).attr('channel_type')) ;
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
     discount = parseFloat($("#disValue").val());
        totalPCC=totalPCC.toFixed(2);
        total = (basePackCharge + parseFloat(totalPCC) + networkCapacityFee).toFixed(2);
        discounttotal=(parseFloat(total)) - discount;
        totalwithgst = (parseFloat(discounttotal)+(parseFloat(discounttotal)*18)/100).toFixed(2);
        $('[name="ancf"]').val(networkCapacityFee);
        $('[name="bpc"]').val(basePackCharge);
        $('[name="extrachannal"]').val(channal);
        $('[name="initialchannelcount"]').val(initialchannelcount);
        $('[name="totalChannel"]').val(channal+initialchannelcount);
        $('[name="hd"]').val(channal_hd);
        $('[name="sd"]').val(channal_sd);
        $('[name="pcc"]').val(totalPCC);
        $('[name="block"]').val(finalBlockCount);
        $('[name="discounttotal"]').val(discounttotal);
        $('[name="discount"]').val(discount);
        $('[name="total"]').val(total);
        $('[name="totalwithgst"]').val(totalwithgst);
        $('[name="roundup"]').val(Math.round(totalwithgst));
        packageData.push({"name":"Network Capacity Fee","price":parseFloat(networkCapacityFee)});
        var invoiceMeta = {"subtotal":totalwithgst,"discount":discount,"total":parseFloat(Math.round(totalwithgst)),"items":packageData};
        $('[name="customer_package"]').val(JSON.stringify(invoiceMeta));
        console.log(invoiceMeta);
    }
    
     $('document').ready(function () {
        $('[name="customer_package"]').parent().parent().parent().hide();
        channel_count();
        $('input').keyup(function(){
            channel_count();
        })
        
        $('.chzn-select').change(function () {
            channel_count();

        });
    });
    
   
    

</script>

