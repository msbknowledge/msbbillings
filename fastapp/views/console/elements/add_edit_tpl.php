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
//pr('545444455',1);
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
            $default_path = isset($table_meta['config']['use_image_columns_path'][0]) ? $table_meta['config']['use_image_columns_path'][0] : (base_url() . 'uploads/' . (defined('NODE') ? NODE : 'node') . '/');
            $clean_val = $table_td;
            if (is_string($table_td) && (substr(trim($table_td), 0, 1) === '{' || substr(trim($table_td), 0, 1) === '[')) {
                $dec = json_decode($table_td, true);
                if (is_array($dec)) {
                    if (!empty($dec['filename'])) $clean_val = $dec['filename'];
                    elseif (!empty($dec['link'])) $clean_val = $dec['link'];
                    elseif (!empty($dec['url'])) $clean_val = $dec['url'];
                }
            }
            $clean_val = trim($clean_val);
            $img_src = resolve_image_url($clean_val, $default_path);
            ?>
            <div class="span4">
                <div class="control-group">
                    <label class="control-label" for="<?= $t_key ?>" style="font-weight: 600;"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></label>
                    <div class="controls">
                        <div style="margin-bottom: 8px;">
                            <img id="file_uploader_image<?= $t_key ?>" class="file_uploaded_img" 
                                 style="max-width: 260px; max-height: 180px; display: block; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.15); object-fit: contain; background: #f8fafc; padding: 4px; border: 1px solid #cbd5e1;" 
                                 src="<?= $img_src ?>" 
                                 onerror="this.onerror=null;this.src='<?= base_url() ?>uploads/noImage.jpg';" 
                                 alt="<?= htmlspecialchars($clean_val) ?>"/>
                        </div>
                        <input type="hidden" id="file_uploader_field<?= $t_key ?>" name="<?= $t_key ?>" value="<?= htmlspecialchars($clean_val) ?>"/>
                        <input type="file" id="file_uploader_input_<?= $t_key ?>" accept="image/*" style="display: none;" />
                        <div style="display: flex; align-items: center; gap: 6px; flex-wrap: wrap; margin-top: 6px;">
                            <button type="button" class="btn btn-primary btn-small" onclick="$('#file_uploader_input_<?= $t_key ?>').click();" style="border-radius: 4px;">
                                <i class="fa fa-upload"></i> Choose Image
                            </button>
                            <button type="button" class="btn btn-danger btn-small" id="btn_clear_<?= $t_key ?>" onclick="clearImageUpload_<?= $t_key ?>();" style="border-radius: 4px; <?= empty($clean_val) ? 'display:none;' : '' ?>">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                            <span id="file_upload_status_<?= $t_key ?>" style="font-size: 12px; color: #64748b; font-weight: 600;"></span>
                        </div>
                        <span class="help-inline" style="font-size: 11px; color: #94a3b8; display: block; margin-top: 4px;">JPG, PNG, GIF, WEBP</span>
                    </div>
                </div>

                <script>
                (function() {
                    var fKey = '<?= $t_key ?>';
                    var uUrl = '<?= site_url("uploader") ?>';
                    var defImg = '<?= base_url() ?>uploads/noImage.jpg';
                    var basePath = '<?= rtrim($default_path, "/") ?>/';

                    $('#file_uploader_input_' + fKey).on('change', function(e) {
                        var file = this.files && this.files[0];
                        if (!file) return;

                        if (window.URL && window.URL.createObjectURL) {
                            $('#file_uploader_image' + fKey).attr('src', window.URL.createObjectURL(file));
                        }

                        var fd = new FormData();
                        fd.append('Filedata', file);
                        fd.append('format', 'json');

                        var $st = $('#file_upload_status_' + fKey);
                        $st.html('<span style="color:#0284c7;"><i class="fa fa-spinner fa-spin"></i> Uploading...</span>').show();

                        $.ajax({
                            url: uUrl,
                            type: 'POST',
                            data: fd,
                            processData: false,
                            contentType: false,
                            dataType: 'text',
                            success: function(resp) {
                                var fn = '';
                                var fullU = '';
                                try {
                                    var r = JSON.parse(resp);
                                    if (r && r.status === 'success' && r.filename) {
                                        fn = r.filename;
                                        fullU = r.url || (basePath + fn);
                                    } else if (r && r.filename) {
                                        fn = r.filename;
                                        fullU = r.url || (basePath + fn);
                                    } else if (r && r.message) {
                                        $st.html('<span style="color:#ef4444;"><i class="fa fa-exclamation-triangle"></i> ' + r.message + '</span>');
                                        return;
                                    }
                                } catch(err) {
                                    fn = $.trim(resp);
                                    fullU = basePath + fn;
                                }

                                if (fn) {
                                    $('#file_uploader_field' + fKey).val(fn);
                                    if (fullU) {
                                        $('#file_uploader_image' + fKey).attr('src', fullU);
                                    }
                                    $('#btn_clear_' + fKey).show();
                                    $st.html('<span style="color:#16a34a;"><i class="fa fa-check-circle"></i> Uploaded!</span>');
                                    setTimeout(function() { $st.fadeOut(1000); }, 3500);
                                } else {
                                    $st.html('<span style="color:#ef4444;"><i class="fa fa-times-circle"></i> Upload failed</span>');
                                }
                            },
                            error: function(xhr, status, err) {
                                $st.html('<span style="color:#ef4444;"><i class="fa fa-times-circle"></i> Upload error: ' + err + '</span>');
                            }
                        });
                    });

                    window['clearImageUpload_' + fKey] = function() {
                        $('#file_uploader_field' + fKey).val('');
                        $('#file_uploader_image' + fKey).attr('src', defImg);
                        $('#file_uploader_input_' + fKey).val('');
                        $('#btn_clear_' + fKey).hide();
                        var $st = $('#file_upload_status_' + fKey);
                        $st.html('<span style="color:#64748b;">Image removed</span>').show();
                        setTimeout(function() { $st.fadeOut(1000); }, 2000);
                    };
                })();
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
    if (is_array($table_meta['config']['use_dropdown_columns_options'])) {
        $arr_index = array_key_exists($t_key, $table_meta['config']['use_dropdown_columns_options']);
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
                    <input type="text" readonly="readonly" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>" autocomplete="off">
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
                    <input type="text" name="<?= $t_key ?>" value="<?= html_escape($table_td) ?>">
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
        //  if (field_files($t_key, $table_meta, $field_value))
        //     continue;
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
    <!--<input readonly="readonly" type="text" autocomplete="off" value="" name="cinvoice" />-->
    
<div class="form-actions" style="clear: both">
    <button type="submit" class="btn btn-primary">Save changes</button>
        <button class="btn" onclick="goBack()">Cancel</button>
    </div>    
</form>
<script>
    var validationMeta = $.parseJSON('<?= json_encode($table_meta['config']['validation']); ?>');
    // console.log(validationMeta );
    
    $.each(validationMeta, function (key, value) {
        
        $('#addEditForm').find('[name=' + key + ']').attr('from-validation', value);
    });

   $(document).ready(function() {
        setTimeout(function() {
            if ($.fn.iphoneStyle) {
                $('.iphone-togglex').iphoneStyle();
            }
        }, 200);
    });
    if ($.fn.cleditor) {
        $('.cleditor').cleditor();
    }
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
     $(function () {
          $('[name="payment_invoice"]').val('<?= generate_invoice_number() ?>').prop('readonly', true);
});



</script>
<script>

</script>

