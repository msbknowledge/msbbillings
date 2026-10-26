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
    <div class="row-fluid sortable">	
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-list"></i><?= $table_meta['config']['title'] ?></h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>

            <div class="box-content" >
                <?php if (count($table_meta['data'])) { ?>
                    <form method="post"  action="" class="choose_entry_form">

                        <?php if (is_array($config['allowed_action'])) { ?>
                            <?php if (in_array('delete', $config['allowed_action']) !== FALSE) {
                                ?>
                                <hr/> 
                                <a href="#" class="btn btn_select_all" title="Select the Entry of current list." data-rel="tooltip">Select All</a>
                                <a href="#" class="btn btn_deselect_all" title="Clear the Selected Iteams." data-rel="tooltip">Clear Selected</a>
                               <?php 
                                $user_login=$this->session->userdata('current_user_session');
                             ?>
                                <a href="#" onclick="popupDeleteAll()" class="btn search_remove btn-danger" title="Select and Delete Entry." data-rel="tooltip">Delete Selected</a>
                                <?php 
                            }
                        }
                        ?>
                    <?php } ?>       
                    <?php
                    if (is_array($config['allowed_action'])) {
                        if (in_array('add_detail', $config['allowed_action']) !== FALSE) {
                            ?>
                            <a href="./sale_return/add_detail"  style="float: right"  class="btn btn-info" >Create Sale</a>
                            <br/><hr/>
                        <?php }
                        ?>
                        <?php
                    }
                    ?>


                    <?php if (count($table_meta['data'])): ?>
                        <div class="scrollgard" style="overflow: auto">
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
                                            ?>
                                            <th><?= ucwords(str_replace('_', ' ', (str_replace(array_keys($this->page_config['replace_text']), array_values($this->page_config['replace_text']), $table_th)))) ?><i data-rel="<?= $table_th ?>" class="icon icon-black icon-triangle-ns shorter" style="cursor: pointer"></i></th>
                                        <?php endforeach; ?>
                                        <th>Action</th> 
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
                                                            <input  class="selectedItem" type="checkbox" value="<?= base64_encode($table_tr['sale_invoice']); ?>" name="selectedItem[]">
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
                                                <td class="center">
                                                    <?php if (is_array($config['allowed_action'])) {
                                                    if (in_array('quick_edit', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                    <span style="cursor: pointer; width: 100%; display: block; min-height: 32px; border-radius: 4px; vertical-align: middle; background-color: wheat;" relId="<?= $table_tr[$config['tablePrimaryKey']]; ?>" relfield = "<?= $t_key ?>" onclick="quickEdit(this)" id="<?= $t_key . '-' . $table_tr[$config['tablePrimaryKey']] ?>" title="Click To Quick Edit"   style="cursor: pointer">
                                                        <?= strip_tags($table_td) ?>
                                                    </span>
                                                    <? } else{?>
                                                         <?= strip_tags($table_td); ?>
                                                    <?}
                                                    
                                                    } ?>
                                                </td>

            <!--                                                        <td class="center"><?= strip_tags($table_td); ?></td>-->
                                            <?php endforeach; ?>

                                            <td class="center">
                                                <?php
                                                if (is_array($config['allowed_action'])) {
                                                    if (in_array('view_detail', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                <a class="btn btn-success" title="View" data-rel="tooltip" href="./sale/view_detail/<?= base64_encode($table_tr['sale_invoice']) ?>" >
                                                            <i class="icon-zoom-in icon-white"></i>  
                                                        </a>
                                                        <?php
                                                    }
                                                }
                                                if (is_array($config['allowed_action'])) {
                                                    if (in_array('edit_detail', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <a class="btn btn-info" title="Edit" data-rel="tooltip" href="./sale/edit_detail/<?= base64_encode($table_tr['sale_invoice']) ?>" >
                                                            <i class="icon-edit icon-white"></i>  
                                                        </a>
                                                        <?php
                                                    }
                                                }

                                                if (is_array($config['allowed_action'])) {
                                                    if (in_array('delete', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                               
                                                        <a class="btn btn-danger" title="Delete" data-rel="tooltip" href="#" onclick="popupDeleteSingle('<?= base64_encode($table_tr['sale_invoice']) ?>')">
                                                            <i class="icon-trash icon-white"></i> 

                                                        </a>
                                                <?php 
                                                    }
                                                }
                                                
                                                
                                                if (is_array($config['allowed_action'])) {
                                                    if (in_array('sale_return', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                              
                                                        <a class="btn btn-warning" title="Return" data-rel="tooltip" href="./sale/sale_return/<?= base64_encode($table_tr['sale_invoice']) ?>">
                                                            <i class="icon-repeat  icon-white"></i> 

                                                        </a>
                                                <?php 
                                                    }
                                                }
                                               /* if (is_array($config['allowed_action'])) {
                                                    if (in_array('print', $config['allowed_action']) !== FALSE) {
                                                        */?>
                                                
                                                        <a class="btn btn-info" title="Print" data-rel="tooltip" href="./sale/view_detail/<?= base64_encode($table_tr['sale_invoice']) ?>/print">
                                                            <i class="icon-print  icon-white"></i> 

                                                        </a>
                                                <?php /* 
                                                    }
                                                }
                                                */?>
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
        
        
    </script>

</div>