<style>
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBEATLEEDeKjC0TAQCgw4AoFAkhM6Co0A8Eg0EQgC6aB4KBYGB8BgaGIViAEEgGBiFA6HhMBQSDEaBAEQgLg35Q07gBwEAOw==')
        right center no-repeat;
    }
    #addEditForm {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        padding: 18px 20px !important;
        margin-left: 0 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    #addEditForm .form-fields-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 16px;
        align-items: flex-start;
    }
    #addEditForm .span3 {
        flex: 1 1 calc(33.333% - 16px);
        min-width: 240px;
        max-width: 100%;
        margin: 0 !important;
        background: transparent !important;
        height: auto !important;
        float: none !important;
    }
    #addEditForm .span3.span8 {
        flex: 1 1 100%;
        min-width: 100%;
    }
    #addEditForm .control-group {
        margin-bottom: 0 !important;
    }
    #addEditForm label.control-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.3px;
        margin-bottom: 4px !important;
        display: block;
    }
    #addEditForm input[type="text"],
    #addEditForm select {
        width: 100% !important;
        height: 32px !important;
        line-height: 28px !important;
        font-size: 12px !important;
        padding: 4px 10px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-shadow: none !important;
        box-sizing: border-box !important;
        transition: border-color 0.15s ease;
    }
    #addEditForm input[type="text"]:focus,
    #addEditForm select:focus,
    #addEditForm textarea:focus {
        border-color: #35aa47 !important;
        outline: none !important;
        box-shadow: 0 0 0 2px rgba(53, 170, 71, 0.2) !important;
    }
    #addEditForm .input-prepend {
        display: flex;
        align-items: center;
        width: 100%;
        margin-bottom: 0;
    }
    #addEditForm .input-prepend .add-on {
        height: 32px;
        line-height: 30px;
        padding: 0 10px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-right: none;
        border-radius: 4px 0 0 4px;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    #addEditForm .input-prepend input {
        border-radius: 0 4px 4px 0 !important;
    }
    #addEditForm .chzn-container {
        width: 100% !important;
    }
    #addEditForm .chzn-container-single .chzn-single {
        height: 32px !important;
        line-height: 30px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 4px !important;
        background: #ffffff !important;
    }
    #addEditForm .form-actions {
        clear: both;
        margin-top: 20px;
        margin-bottom: 0;
        padding: 14px 0 4px 0;
        background: transparent !important;
        border-top: 1px solid #e2e8f0;
        display: flex;
        gap: 8px;
        align-items: center;
    }
</style>

<?php
error_reporting(4);

/**
 * add_edit view helper functions
 */
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
                            <input type="text" class="datepicker" id="<?= $t_key ?>" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?php
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
                            <input type="text" class="datetimepicker" id="<?= $t_key ?>" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                        </div>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?php
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
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls" style="margin-top: 4px;">
                        <input name="<?= $t_key ?>" id="<?= $t_key ?>" data-no-uniform="true" type="checkbox" class="iphone-toggle" <?php
                        if (intval($table_td)) {
                            echo 'checked="checked"';
                        }
                        ?> value="1">
                        <?php
                        switch (intval($table_td)) {
                            case 1 :
                                echo ' <span class="label label-success" style="margin-left: 6px;">On</span>';
                                break;
                            default :
                                echo ' <span class="label label-important" style="margin-left: 6px;">Off</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
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
                        <textarea class="cleditorx" name="<?= $t_key ?>" id="textarea_<?= $t_key ?>" style="width:100%; min-height: 80px;"><?= $table_td ?></textarea>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?php
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
                    <img id="file_uploader_image<?= $t_key ?>" class="file_uploaded_img" style="max-width: 180px; max-height: 120px; border-radius: 4px; margin-bottom: 6px;" src='<?= $table_td ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '' ) . $table_td : cdn_url() . 'uploads/noImage.jpg'; ?>' alt="<?= $table_td ?>"/>
                    <div class="controls">
                        <input type="hidden" id="file_uploader_field<?= $t_key ?>" name="<?= $t_key ?>" value="<?= $table_td ?>"/>
                        <input type="file" data-no-uniform="true" id="file_uploader<?= $t_key ?>" />
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
                    });
                </script>
            </div>
            <?php
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
                        <?php if ($t_key == 'customer_stb') { ?>
                            <input type="text" list="customer_stb_list" name="<?= $t_key ?>" id="<?= $t_key ?>" value="<?= html_escape($table_td) ?>" placeholder="Customer STB (VC)">
                            <datalist id="customer_stb_list">
                                <?php
                                $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$t_key]) ? $table_meta['config']['use_dropdown_columns_options'][$t_key] : $table_meta['config']['use_dropdown_columns_options']);
                                foreach ($optionList as $optkey => $optvalue):
                                    ?>
                                    <option value="<?= $optvalue ?>"><?= $optvalue ?></option>
                                <?php endforeach; ?>
                            </datalist>
                        <?php } else { ?>
                            <select <?= is_readonly($t_key, $table_meta['config']['readonly_columns']) ? 'disabled="disabled"' : '' ?>
                                <?= isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key]) ? " multiple name='" . $t_key . "[]'" : " name='$t_key' id='$t_key'" ?> data-placeholder="Choose option..." data-rel="chosen">
                                <option value="">-- Choose An Option --</option>
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
                        <?php } ?>
                        <span class="help-inline"></span>
                    </div>
                </div>
            </div>
            <?php
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
                    <input type="text" readonly="readonly" id="<?= $t_key ?>" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="span3">
            <div class="control-group">
                <label class="control-label" for="<?= $t_key ?>"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                <div class="controls">
                    <input type="text" id="<?= $t_key ?>" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
                    <span class="help-inline"></span>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

<form id="addEditForm" class="span6 well" method="post" action="save_details" onsubmit="return false">
    <div class="form-fields-wrapper">
        <?php foreach ($table_meta['data'] as $t_key => $table_td): ?>
            <?php
            $field_value = is_array($table_td) ? '' : $table_td;

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
    </div>

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
    </script>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary" title="Save Changes"><i class="fa fa-save"></i> Save Changes</button>
        <button type="button" class="btn btn-default" onclick="goBack()" title="Cancel"><i class="fa fa-times"></i> Cancel</button>
    </div>
</form>

<script>
    var packageData = [];
    $(document).ready(function () {
        $('[name="customer_package"]').parent().parent().parent().hide();
    });
</script>
