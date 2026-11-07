<style>
.table_view_wrapper {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    overflow: hidden !important;
}
.table_view_wrapper .scrollgard {
    max-width: 100% !important;
    overflow-x: auto !important;
    overflow-y: hidden !important;
    -webkit-overflow-scrolling: touch !important;
    display: block !important;
    box-sizing: border-box !important;
    margin-bottom: 12px !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 6px !important;
    background: #ffffff !important;
}
.table_view_wrapper .scrollgard > .table {
    width: 100% !important;
    min-width: 900px;
    max-width: none !important;
    margin-bottom: 0 !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
}
.table_view_wrapper .scrollgard table th {
    white-space: nowrap !important;
    padding: 8px 10px !important;
    background: linear-gradient(180deg, #f0f7ff 0%, #e0eefe 100%) !important;
    color: #1e40af !important;
    border: 1px solid #cbd5e1 !important;
    border-bottom: 2px solid #93c5fd !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.3px;
}
.table_view_wrapper .scrollgard table td {
    white-space: nowrap;
    padding: 8px 10px !important;
    font-size: 11.5px !important;
    color: #334155 !important;
    border-color: #e2e8f0 !important;
    vertical-align: middle !important;
}
.table_view_wrapper .scrollgard table td.col-wrap-text {
    white-space: normal !important;
    min-width: 140px;
    max-width: 280px;
    word-break: break-word !important;
}
</style>
<div class="table_view_wrapper">

    <?php
    $config['num_links'] = 2;

    $config['cur_tag_open'] = '<li><a class="active" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['prev_link'] = '&lsaquo; Previous';

    $config['next_link'] = 'Next &rsaquo;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';


    $config['last_link'] = 'Last &raquo;';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['first_link'] = '&laquo; First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['full_tag_open'] = '<ul>';
    $config['full_tag_close'] = '</ul>';

    $config = array_merge($config, $table_meta['config']);
    //$config['base_url'] = pr
    $this->pagination->initialize($config);
    if (count($table_meta['data'])) {
        $table_headers = array_keys($table_meta['data'][0]);
    }
//pr($table_meta['config']);
    $table_allowed_header = is_array($config['list_columns']) ? 1000 : 4;
    ?>
    <div class="row-fluid sortable" style="width: 100%; max-width: 100%; margin: 0; box-sizing: border-box;">	
        <div class="box span12" style="width: 100% !important; max-width: 100% !important; float: none !important; margin: 0 0 20px 0 !important; padding: 0 !important; box-sizing: border-box !important; overflow: hidden !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; background: #ffffff !important;">
            <div class="box-header well" data-original-title style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 10px 16px; border-radius: 8px 8px 0 0;">
                <h2><i class="fa fa-envelope" style="color: #35aa47; margin-right: 6px;"></i><?= $table_meta['config']['title'] ?></h2>
                <div class="box-icon" style="float: right;">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>

            <div class="box-content" style="width: 100%; max-width: 100%; padding: 14px 16px; box-sizing: border-box; overflow: hidden;">
                <!-- Modern Action Toolbar -->
                <div class="table-toolbar" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; padding: 4px 0 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <div class="toolbar-left" style="display: flex; align-items: center; flex-wrap: wrap; gap: 6px;">
                        <?php if (count($table_meta['data'])): ?>
                            <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                <a href="#" class="btn btn_select_all" title="Select All Entries" data-rel="tooltip"><i class="fa fa-check-square-o"></i> Select All</a>
                                <a href="#" class="btn btn_deselect_all" title="Clear Selected Entries" data-rel="tooltip"><i class="fa fa-square-o"></i> Clear Selected</a>
                                <a href="javascript:void(0);" onclick="popupDeleteAll(); return false;" class="btn search_remove btn-danger" title="Delete Selected Entries" data-rel="tooltip"><i class="fa fa-trash"></i> Delete Selected</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="toolbar-right" style="display: flex; align-items: center; gap: 6px;">
                        <?php if (is_array($config['allowed_action']) && in_array('add_detail', $config['allowed_action']) !== FALSE): ?>
                            <a href="javascript:void(0);" onclick="generateAddView(); return false;" class="btn btn-success" title="Add"><i class="fa fa-plus-circle"></i> Add</a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (count($table_meta['data'])): ?>
                    <form method="post" action="" class="choose_entry_form" style="width: 100%; max-width: 100%; margin: 0; padding: 0; display: block; box-sizing: border-box;">
                        <div class="scrollgard table-responsive">
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>

                                    <tr>
                                        <?php if ($config['enable_ordering']): ?>
                                            <th>Drag To Order</th>
                                        <?php endif; ?>
                                        <?php $th_key = 0; ?>
                                        <?php if ($config['tablePrimaryKey']): ?>
                                            <?php
                                            if (is_array($config['allowed_action'])) {
                                                if (in_array('delete', $config['allowed_action']) !== FALSE) {
                                                    ?>
                                                    <th>Choose</th>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        <?php endif; ?>
                                        <?php foreach ($table_headers as $table_th): ?>
                                            <?php
                                            if ($table_allowed_header < ++$th_key) {
                                                break;
                                            } else {
                                                if (is_array($config['list_columns'])) {
                                                    if (in_array($table_th, $config['list_columns']) === FALSE) {
                                                        continue;
                                                    }
                                                }
                                            }
                                            $header_title = $table_th;
                                            if (!empty($config['list_column_aliases'][$table_th])) {
                                                $header_title = $config['list_column_aliases'][$table_th];
                                            } elseif (!empty($this->page_config['replace_text']) && is_array($this->page_config['replace_text'])) {
                                                $header_title = str_replace(array_keys($this->page_config['replace_text']), array_values($this->page_config['replace_text']), $table_th);
                                            }
                                            ?>
                                            <th style="white-space: nowrap;"><?= ucwords(str_replace('_', ' ', $header_title)) ?><i data-rel="<?= $table_th ?>" class="icon icon-black icon-triangle-ns shorter" style="cursor: pointer; margin-left: 4px;"></i></th>
                                        <?php endforeach; ?>
                                        <th style="text-align: center; width: 140px; min-width: 140px; white-space: nowrap;">Action</th> 
                                    </tr>
                                </thead> 
                                <?php if ($config['enable_ordering']): ?>
                                    <tbody class='orderable'>
                                    <?php else: ?>
                                    <tbody>
                                    <?php endif; ?>
                                    <?php foreach ($table_meta['data'] as $table_tr): ?>
                                        <?php if ($config['tablePrimaryKey']): ?>    
                                            <tr id='row_<?= $table_tr[$config['tablePrimaryKey']] ?>'>
                                            <?php else: ?>
                                            <tr>
                                            <?php endif; ?>
                                            <?php if ($config['enable_ordering']): ?>
                                                <td class="center"><span class="center icon32 icon icon-arrow-nesw"></span></td>    
                                            <?php endif; ?>
                                            <?php $td_key = 0; ?>
                                            <?php if ($config['tablePrimaryKey']): ?>
                                                <?php
                                                if (is_array($config['allowed_action'])) {
                                                    if (in_array('delete', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <td class="center">
                                                            <input  class="selectedItem" type="checkbox" value="<?= $table_tr[$config['tablePrimaryKey']] ?>" name="selectedItem[]">
                                                        </td> 
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php endif; ?>
                                            <?php foreach ($table_tr as $t_key => $table_td): ?>

                                                <?php
                                                if ($table_allowed_header < ++$td_key) {
                                                    break;
                                                } else {
                                                    if (is_array($config['list_columns'])) {
                                                        if (in_array($t_key, $config['list_columns']) === FALSE) {
                                                            continue;
                                                        }
                                                    }

                                                    if (is_array($config['use_status_columns'])) {
                                                        if (in_array($t_key, $config['use_status_columns']) === TRUE) {
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
                                                            </td> <?php
                                                            continue;
                                                        }
                                                    }
                                                    if (is_array($config['use_dropdown_columns_options'])) {
                                                        if (array_key_exists($t_key, $config['use_dropdown_columns_options']) === TRUE) {
                                                            ?> 
                                                            <td class="center">                                                                                          
                                                                <?php
                                                                if (isset($config['use_dropdown_columns_options']['multi'][$t_key])) {
                                                                    $table_td = json_decode($table_td, TRUE);
                                                                    foreach ($table_td as $m_key => $m_value) {
                                                                        if ($m_key > 0) {
                                                                            echo ',';
                                                                        }
                                                                        echo $config['use_dropdown_columns_options'][$t_key][$m_value];
                                                                    }
                                                                } else {
                                                                    echo isset($config['use_dropdown_columns_options'][$t_key][$table_td]) ? $config['use_dropdown_columns_options'][$t_key][$table_td] : 'N/A';
                                                                }
                                                                ?>                                                        </td> <?php
                                                            continue;
                                                        }
                                                    }

                                                    if (is_array($config['use_image_columns'])) {
                                                        $arr_index = array_search($t_key, $config['use_image_columns']);
                                                        if ($arr_index !== FALSE) {
                                                            ?> 
                                                            <td class="center">                                                                                          
                                                                <img style="width:64px" src='<?= $table_td ? $table_meta['config']['use_image_columns_path'][0] . $table_td : cdn_url() . 'uploads/noImage.jpg' ?>' alt="<?= $table_td ?>" />
                                                            </td> <?php
                                                            continue;
                                                        }
                                                    }
                                                }
                                                ?>
                                                <td class="center<?= ($t_key === 'body' || $t_key === 'subject') ? ' col-wrap-text' : '' ?>" style="vertical-align: middle;">
                                                    
                                                    <?php if (is_array($config['allowed_action'])) {
                                                    if (in_array('quick_edit', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                    <span style="cursor: pointer; width: 100%; display: block; min-height: 32px; border-radius: 4px; vertical-align: middle; background-color: #fef3c7;" relId="<?= $table_tr[$config['tablePrimaryKey']]; ?>" relfield = "<?= $t_key ?>" onclick="quickEdit(this)" id="<?= $t_key . '-' . $table_tr[$config['tablePrimaryKey']] ?>" title="Click To Quick Edit">
                                                        <?= strip_tags($table_td) ?>
                                                    </span>
                                                    <?php } else { ?>
                                                         <?= strip_tags($table_td); ?>
                                                    <?php }
                                                    
                                                    } ?>
                                                </td>

            <!--                                                        <td class="center"><?= strip_tags($table_td); ?></td>-->
                                            <?php endforeach; ?>

                                            <td class="center" style="white-space: nowrap !important; text-align: center; vertical-align: middle;">
                                                <div style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; white-space: nowrap;">
                                                    <a class="btn btn-warning" title="Mail" data-rel="tooltip" href="javascript:void(0);" onclick="sentMail(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                        <i class="fa fa-envelope"></i>  
                                                    </a>
                                                    <?php
                                                    if (is_array($config['allowed_action'])) {
                                                        if (in_array('view_detail', $config['allowed_action']) !== FALSE) {
                                                            ?>
                                                            <a class="btn btn-success" title="View" data-rel="tooltip" href="javascript:void(0);" onclick="generateDetailedView(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                                <i class="fa fa-eye"></i>  
                                                            </a>
                                                            <?php
                                                        }
                                                    }
                                                    if (is_array($config['allowed_action'])) {
                                                        if (in_array('edit_detail', $config['allowed_action']) !== FALSE) {
                                                            ?>
                                                            <a class="btn btn-info" title="Edit" data-rel="tooltip" href="javascript:void(0);" onclick="generateEditView(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                                <i class="fa fa-pencil"></i>  
                                                            </a>
                                                            <?php
                                                        }
                                                    }

                                                    if (is_array($config['allowed_action'])) {
                                                        if (in_array('delete', $config['allowed_action']) !== FALSE) {
                                                            ?>
                                                            <a class="btn btn-danger" title="Delete" data-rel="tooltip" href="javascript:void(0);" onclick="popupDeleteSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                                <i class="fa fa-trash-o"></i> 
                                                            </a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>                          
                                </tbody>
                            </table>  
                        </div>
                    </form>    
                    <div class="pagination pagination-centered">
                        <?= $this->pagination->create_links(); ?>
                    </div>  
                <?php else: ?>
                    No Result
                <?php endif; ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->

    <script>

        /**********************************************view operation***************************/
        /**
         *Preview single operations
         **/
        generateDetailedView = function (targetItem) {
            var viewSingleOperation = function (targetItem) {
                currentPostRequest = $.post(page_url + 'view_detail', {
                    entry: targetItem
                }, function (respData) {
                    if (respData != '') {

                        $('.index-wrapper').html(respData);
                        if ($('.br_det').length == 0)
                            $('.breadcrumb').append('<li class="br_det"><a href="javascript:void(0);">Details</a></li>');
                        postDetailLoad();
                    }
                }, 'html');
            }
            viewSingleOperation(targetItem);

        }

        /**********************************************view operation***************************/

        /**********************************************Edit operation***************************/
        /**
         *Edit single operations
         **/
        generateEditView = function (targetItem) {
            var loadEditForm = function (targetItem) {
                currentPostRequest = $.post(page_url + 'edit_detail', {
                    'load_edit_entry': targetItem
                }, function (respData) {
                    if (respData != '') {
                        $('.index-wrapper').html(respData);
                        if ($('.br_edt').length == 0)
                            $('.breadcrumb').append('<li class="br_edt"><a href="javascript:void(0);">Edit Detail</a></li>');
                        if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                            $('.form-actions button.btn-primary').attr('onclick', "saveOperation('edit')");
                        }
                        setTimeout(function () {
                            $('.iphone-toggle').iphoneStyle();
                            $('[data-rel="chosen"],[rel="chosen"]').chosen();
                            $('.datepicker').each(function () {

                                dateVal = $(this).val();
                                $(this).datepicker();
                                $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                                $(this).datepicker("setDate", dateVal);
                            });

                            $('.datetimepicker').each(function () {
                                $(this).datetimepicker({format: 'Y-m-d H:i:s'});
                            });
                        }, 300);
                    }
                }, 'html');
            }

            loadEditForm(targetItem);
        }


        /**********************************************Edit operation***************************/

        /**********************************************add operation***************************/
        /**
         *Add single operations
         **/
        generateAddView = function (targetItem) {
            var loadAddForm = function () {
                currentPostRequest = $.post(page_url + 'add_detail', {
                    'load_add_entry': 'yes'
                }, function (respData) {
                    if (respData != '') {
                        $('.index-wrapper').html(respData);
                        if ($('.br_add').length == 0)
                            $('.breadcrumb').append('<li class="br_add"><a href="javascript:void(0);">Add Detail</a></li>');
                        if (typeof $('.form-actions button.btn-primary').attr('onclick') == 'undefined') {
                            $('.form-actions button.btn-primary').attr('onclick', "saveOperation('add')");
                        }
                        setTimeout(function () {
                            $('.iphone-toggle').iphoneStyle();
                            $('.chosen-select-deselect').chosen({
                                allow_single_deselect: true
                            });
                            $('[data-rel="chosen"],[rel="chosen"]').chosen();
                            $('.datepicker').each(function () {
                                dateVal = $(this).val();
                                $(this).datepicker();
                                $(this).datepicker("option", "dateFormat", "yy-mm-dd");
                                $(this).datepicker("setDate", dateVal);
                            });
                            $('.datetimepicker').each(function () {
                                $(this).datetimepicker({format: 'Y-m-d H:i:s'});
                            });
                        }, 300);
                    }
                }, 'html');
            }
            loadAddForm(targetItem);
        }

        /**********************************************Add operation***************************/



        /*save operation
         **/
        var saveOperation = function (method) {
            if (validate_form($('#addEditForm'),
                    {
                        beforeValidation: function (targetObject) {
                            $(targetObject).parent().parent('.control-group').removeClass('error');
                            $(targetObject).parent().parent('.control-group').find('.help-inline').html('');

                        },
                        onValidationError: function (targetObject, validationType) {
                            $(targetObject).parent().parent('.control-group').addClass('error');
                            switch (validationType) {
                                case 'required':
                                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('This is Required!!');
                                    break;
                                default:
                                    $(targetObject).parent().parent('.control-group').find('.help-inline').html('Please Enter A valid Data');
                            }
                        },
                        captchaValidator: function (targetObject) {
                            return validate_captcha(targetObject);
                        },
                        duplicateValidator: function (targetObject) {
                            return duplicate_check(targetObject);
                        }

                    })) {
                var postUrl = '';
                if (method == 'add') {
                    postUrl = page_url + 'add_detail';
                }
                if (method == 'edit') {
                    postUrl = page_url + 'edit_detail';
                }
                currentPostRequest = $.post(postUrl, $('#addEditForm').serialize(), function (respData) {
                    if (respData.status = 'success') {

                        $('.modal-body p').html(respData.message);
                        $('#myModal').modal('show');
                        $('.modal-footer .btn-primary').removeClass('btn-danger btn-success').addClass('btn-success').attr('onclick', 'goBack();');

                        setTimeout(function () {
                            goBack();
                        }, 1000);
                        //
                    }
                }, 'json');
            }

        }

        /*****/


        /**
         *for pagination
         **/
<?php if ($config['is_ajax']): ?>
            var loadAjaxPagination = setInterval(function () {
                if (typeof ajaxPagination == 'function') {
                    initAjaxPagination();
                }

            }, 100);
            initAjaxPagination = function () {
                ajaxPagination();
                clearInterval(loadAjaxPagination);
            }
<?php endif; ?>


        var reorderTable = function () {

            $(".orderable").sortable({
                update: function (event, ui) {
                    var orderElements = [];
                    $(".orderable").children().each(function () {
                        orderElements.push($(this).attr('id').substring(4));
                    });

                    currentPostRequest = $.post(page_url + 'order_table', {
                        orderElements: orderElements
                    }, function (responce) {
                        console.log(responce);
                    }, 'json');
                }
            });
        }
        /**QUICK EDIT**/
        var quickEdit = function (targetItem) {
            $(targetItem).hide();
            $(targetItem).parent().append('<input type="text" value="' + $.trim($(targetItem).html()) + '">');
            var targetElement = $(targetItem).parent().find('input');
            $(targetElement).blur(function () {
                $(targetItem).html($(targetElement).val());
                currentPostRequest = $.post(page_url + 'quick_edit', {
                    targetItem: $(targetItem).attr('relfield')+'-'+$(targetItem).attr('relId'),
                    targetValue: $(targetElement).val(),
                }, function (respData) {
                   $(targetElement).remove();
                   $(targetItem).show();
                    console.log(respData);
                }, 'json');
            });
        }
        /**quickEdit***/
        
         /*sentMail*/
        	var sentMail = function(targetObject){
			currentPostRequest = $.post(page_url + 'mailInvoice', {invoice_id:targetObject}, function (responce) {		
				alert(responce.status);					
            },'json');
		}
		 /**sentMail***/
    </script>

</div>