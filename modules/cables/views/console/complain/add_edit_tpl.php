<?php

/**
 * add_edit view helper function **
 * 
 *  
 * * */
function is_dropdown($t_key = NULL, $table_meta) {

    if (is_array($table_meta['config']['use_dropdown_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['use_dropdown_columns']);
        if ($arr_index !== FALSE)
            return TRUE;
        else
            return FALSE;
    }
}

function is_datepicker($t_key = NULL, $table_meta) {

    if (is_array($table_meta['config']['datepicker_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['datepicker_columns']);
        if ($arr_index !== FALSE)
            return TRUE;
        else
            return FALSE;
    }
}

function is_date_time_picker($t_key = NULL, $table_meta) {

    if (is_array($table_meta['config']['datetimepicker_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['datetimepicker_columns']);
        if ($arr_index !== FALSE)
            return TRUE;
        else
            return FALSE;
    }
}

function is_status($t_key, $table_meta) {
    /*     * */
}

function is_textarea($t_key = NULL, $table_meta) {

    if (is_array($table_meta['config']['textarea_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['textarea_columns']);
        if ($arr_index !== FALSE)
            return TRUE;
        else
            return FALSE;
    }
}

function is_image($t_key = NULL, $table_meta) {
    if (is_array($table_meta['config']['use_image_columns'])) {
        $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
        return $arr_index;
    } else {
        return FALSE;
    }
}

function is_primry_key($t_key = NUL, $table_meta) {
    if ($table_meta['config']['tablePrimaryKey'] == $t_key)
        return TRUE;
    else
        return FALSE;
}
?>
<form id="addEditForm" method="post" action="save_details" onsubmit="return false">
    <table class="table table-bordered table-striped table-condensed">
        <thead>

            <tr>
                <th>Field Name</th>           
                <th>Data</th> 
            </tr>
        </thead>   
        <tbody>
            <?php foreach ($table_meta['data'] as $t_key => $table_td): ?>
                <?php
                if (is_array($table_td)) {
                    $table_td = '';
                }
                ?><?php /*             * need to change the * */ ?>
                <tr>    
                    <td class="center"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></td> 

                    <?php
                    if (is_array($table_meta['config']['use_status_columns'])) {
                        if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
                            ?> 
                            <td class="center">                                                                                          
                                <?php
                                switch (intval($table_td)) {
                                    case 1 :
                                        echo '<span class="label label-success">On</span>';
                                        break;
                                    default :
                                        echo '<span class="label label-important">Off</span>';
                                }
                                ?>
                                <input name="<?= $t_key ?>" data-no-uniform="true" type="checkbox" class="iphone-toggle" <?php
                                if (intval($table_td)) {
                                    echo 'checked="checked"';
                                }
                                ?> value="1">
                            </td> <?php
                            continue;
                        }
                    }

                    $arr_index = is_image($t_key, $table_meta);
                    if ($arr_index !== FALSE) {
                        ?> 
                        <td class="center">       
                            <div class="control-group">
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
                        </td> <?php
                        continue;
                    }

                    if (is_dropdown($t_key, $table_meta)) {
                        ?> 
                        <td class="center">   
                            <div class="control-group">
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


                        </td> <?php
                        continue;
                    }

                    if (is_readonly($t_key, $table_meta)) {
                        ?> 
                        <td class="center">    
                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" readonly="readonly" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                                    <span class="help-inline"></span>
                                </div>
                            </div>
                        </td> <?php
                        continue;
                    }

                    if (is_textarea($t_key, $table_meta)) {
                        ?> 
                        <td class="center">   
                            <div class="control-group error">
                                <div class="controls">
                                    <textarea class="cleditor" name="<?= $t_key ?>"  id="textarea2" rows="3"><?= $table_td ?></textarea>
                                    <span class="help-inline"></span>
                                </div>
                            </div>
                        </td> <?php
                        continue;
                    }

                    if (is_datepicker($t_key, $table_meta)) {
                        ?> 
                        <td class="center">
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-calendar"></i></span>

                                        <input type="text" class="datepicker"  name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                                    </div>								  <span class="help-inline"></span>
                                </div>
                            </div>

                        </td> <?php
                        continue;
                    }



                    if (is_date_time_picker($t_key, $table_meta)) {
                        ?> 
                        <td class="center">
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-calendar"></i></span>

                                        <input type="text" class="datetimepicker"  name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                                    </div>								  <span class="help-inline"></span>
                                </div>
                            </div>

                        </td> <?php
                        continue;
                    }
                    ?>
                    <td class="center">
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" <?php
                                if (is_primry_key($t_key, $table_meta)) {
                                    echo 'readonly="readonly"';
                                }
                                ?>name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                                <span class="help-inline"></span>
                            </div>
                        </div>
                    </td>


                </tr>
            <?php endforeach; ?>                          
        </tbody>
    </table>  
    <div class="form-actions">
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

</script>
<script>
    var  choosed =null;
    $('[name="complain_service"]').change(function(){
        choosed = $(this).val();
        
   
   
    
        $(function () {
            function log(message) {
                $("<div>").text(message).prependTo("input[name='complain_from_customer']");
                $("input[name='complain_from_customer']").scrollTop(0);
            }
            $("input[name='complain_from_customer']").autocomplete({
                source: "/console/complain/customer_search/"+choosed+"/",
                minLength: 2,
                select: function (event, ui) {
                    log("Selected: " + ui.item.value + " aka " + ui.item.id);
                }


            });
        }
        );
  
 });

</script>