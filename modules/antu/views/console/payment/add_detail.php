<style>
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
            right center no-repeat;
    }
    div.span4{
        margin: 10px!important;
        background: azure;
        height: 60px;
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
            <div class="span4">
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
            <div class="span4">
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
            <div class="span4">
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
            <div class="span4 span8">
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
            <div class="span4">
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
            <div class="span4">
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
        <div class="span4">
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
        <div class="span4">

            <div class="control-group">
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <div class="controls">
                    <input type="text" name="<?= $t_key ?>" autocomplete="off" value="<?= html_escape($table_td) ?>" required>
                    <span class="help-inline"></span>
                </div>
            </div>
        </div>
        <?
    }
}
?>
<form id="addEditForm" method="post" action="save_details" onsubmit="return false">
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
    <div class="span11">

        <div class="control-group">
            <label class="control-label" for="payment_paid_amount">payment Invoice List</label>
            <div class="controls" id="payment_invoice_list" style="height:150px;overflow:auto">
            </div>
        </div>
    </div>

    <div class="form-actions" style="clear: both">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>
</form>
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

    /*****/
  $(document).ready(function () {

        <?php if (isset($this->page_config['autocomplete'])): ?>
        
                    var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
                   
                    $.each(autoComplete, function (targetField, value) {
                        $.each(value, function (model, fieldToSearch) {
                              
                            $('[name="' + targetField + '"]').autocomplete({
                                /*source: page_url + "autocomplete/" + model + '/' + fieldToSearch,*/
                                source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                                minLength: 1, select: function (event, ui) {
                                    $.each(ui.item.complete, function (populate_field, populate_value) {
                                        $('[name="' + populate_field + '"]').val('');
                                    });
                                    $.each(ui.item.complete, function (populate_field, populate_value) {
                                        $('[name="' + populate_field + '"]').val(populate_value);
                                    });
                                // Call payment_table_ajax with the selected value
                                
                                        // window.alert(JSON.stringify(ui.item.complete.suplyer_id));
                                var supplier_id = ui.item.complete.supplier_id;
        
                                // Call payment_table_ajax with the supplier_id
                                if (supplier_id) {
                                    payment_table_ajax(supplier_id);
                                }
                                }
        
                            });
                        });
                    });
        <?php endif; ?>

        // payment_table_ajax($('[name="payment_suppliers"]').find('[selected="selected"]').val());
    });

    function payment_table_ajax(targetobj) {
        $.post('/console/payments/add_payment_supplier', {supplier_id: targetobj, pre_payment_invoice: $('[name="payment_invoice"]').val()}, function (resp) {
            $('#payment_invoice_list').html(resp);

            var countChecked = function () {
                var n = $("input:checked").length;
                var tar=$('textarea[name="payment_invoice"]').val();
                var chkArray = [];
                //console.log(tar);
                if (tar != '') {
                    var inc = tar.split(",");
                    $(inc).each(function (k, v) {
                        chkArray.push(v);
                    });

                    //chkArray.push();
                }
                //$('input[name="payment_invoice"]').attr('value') = "";
                $("input:checked").each(function (k, v) {
                  //console.log(v);

                  chkArray.push($(this).val());
                });
                
                $.unique(chkArray);
                var selected;

                selected = chkArray.join(',');
                $('textarea[name="payment_invoice"]').attr('value', selected);
                //console.log(typeof selected);
                /*  if ($('input[name="payment_invoice"]').attr('value') == "") {
                 $('input[name="payment_invoice"]').attr('value', selected);
                 }
                 else{
                 // var list = $.merge([('input[name="payment_invoice"]').attr('value')],('input[name="payment_invoice"]').attr('value', selected) );
                 }*/
                $('input[name="payment_invoice"]').attr('value', selected);
            };
          //  if ($('input[name="payment_invoice"]').attr('value') != "") {
                countChecked();
           // }
            //countChecked();
            $("input[type=checkbox]").on("click", countChecked);


        });
    }
    $('[name="payment_suppliers"]').change(function () {

        //payment_table_ajax($(this).val());
    });
    $(document).ready(function () {
      payment_table_ajax($('[name="payment_suppliers"]').find('[selected="selected"]').val());

    });

</script>


