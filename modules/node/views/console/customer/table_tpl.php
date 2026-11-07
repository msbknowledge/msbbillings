 <style>
    /* Customer Table Responsive & Card Boundary Guarantees */
    .table_view_wrapper {
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
    }
    .table_view_wrapper .row-fluid,
    .table_view_wrapper .row-fluid.sortable {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        box-sizing: border-box !important;
    }
    .table_view_wrapper .box.span12 {
        width: 100% !important;
        max-width: 100% !important;
        float: none !important;
        margin: 0 0 20px 0 !important;
        padding: 0 !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        background: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
    }
    .table_view_wrapper .box-content {
        width: 100% !important;
        max-width: 100% !important;
        padding: 14px 16px !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
    }
    .table_view_wrapper .choose_entry_form {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        box-sizing: border-box !important;
    }
    .table_view_wrapper .scrollgard {
        width: 100% !important;
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
        min-width: 1050px;
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
        max-width: 240px;
        word-break: break-word !important;
    }
    .table_view_wrapper .scrollgard::-webkit-scrollbar {
        height: 6px;
    }
    .table_view_wrapper .scrollgard::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    .table_view_wrapper .scrollgard::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .table_view_wrapper .scrollgard::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    .customer-quick-edit:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        text-decoration: underline dotted #94a3b8;
    }
</style>
<div class="table_view_wrapper" style="width: 100%; max-width: 100%; box-sizing: border-box; font-size: 12px;">

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
    $this->pagination->initialize($config);
    if (count($table_meta['data'])) {
        $table_headers = array_keys($table_meta['data'][0]);
    }
    $table_allowed_header = is_array($config['list_columns']) ? 1000 : 4;
    ?>
    <div class="row-fluid sortable" style="width: 100%; max-width: 100%; margin: 0; box-sizing: border-box;">	
        <div class="box span12" style="width: 100% !important; max-width: 100% !important; float: none !important; margin: 0 0 20px 0 !important; padding: 0 !important; box-sizing: border-box !important; overflow: hidden !important; border: 1px solid #e2e8f0 !important; border-radius: 8px !important; background: #ffffff !important;">
            <div class="box-header well" data-original-title style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 10px 16px; border-radius: 8px 8px 0 0;">
                <h2><i class="icon-list" style="color: #35aa47; margin-right: 6px;"></i><?= $table_meta['config']['title'] ?></h2>
                <div class="box-icon" style="float: right;">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>

            <div class="box-content" style="width: 100%; max-width: 100%; padding: 14px 16px; box-sizing: border-box; overflow: hidden;">
                <!-- Modern Medical Action Toolbar -->
                <div class="table-toolbar" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-bottom: 12px; padding: 4px 0 10px 0; border-bottom: 1px solid #e2e8f0;">
                    <div class="toolbar-left" style="display: flex; align-items: center; flex-wrap: wrap; gap: 6px;">
                        <?php if (count($table_meta['data'])): ?>
                            <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                <a href="#" class="btn btn_select_all" title="Select All Entries" data-rel="tooltip"><i class="fa fa-check-square-o"></i> Select All</a>
                                <a href="#" class="btn btn_deselect_all" title="Clear Selected Entries" data-rel="tooltip"><i class="fa fa-square-o"></i> Clear Selected</a>
                                <a href="javascript:void(0);" onclick="popupDeleteAll(); return false;" class="btn search_remove btn-danger" title="Delete Selected Entries" data-rel="tooltip"><i class="fa fa-trash"></i> Delete Selected</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="<?= console_url('customer/import_customer') ?>" class="btn btn-info" title="Import Customers"><i class="fa fa-upload"></i> Import</a>
                    </div>
                    <div class="toolbar-right" style="display: flex; align-items: center; gap: 6px;">
                        <?php if (is_array($config['allowed_action']) && in_array('add_detail', $config['allowed_action']) !== FALSE): ?>
                            <a href="javascript:void(0);" onclick="popupAddNew(); return false;" class="btn btn-success" title="Add Customer"><i class="fa fa-plus-circle"></i> Add Customer</a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (count($table_meta['data'])): ?>
                    <form method="post" action="" class="choose_entry_form" style="width: 100%; max-width: 100%; margin: 0; padding: 0; display: block; box-sizing: border-box;">
                        <div class="scrollgard table-responsive" style="width: 100%; max-width: 100%; overflow-x: auto; overflow-y: hidden; -webkit-overflow-scrolling: touch; display: block; box-sizing: border-box; margin-bottom: 12px; border: 1px solid #e2e8f0; border-radius: 6px; background: #ffffff;">
                            <table class="table table-bordered table-striped table-condensed" style="width: 100%; min-width: 1050px; max-width: none; margin-bottom: 0; border-collapse: separate; border-spacing: 0;">
                                <thead>
                                    <tr>
                                        <?php if ($config['enable_ordering']): ?>
                                            <th style="white-space: nowrap; width: 40px; text-align: center;">Drag To Order</th>
                                        <?php endif; ?>
                                        <?php $th_key = 0; ?>
                                        <?php if ($config['tablePrimaryKey']): ?>
                                            <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                <th style="white-space: nowrap; width: 55px; text-align: center;">Choose</th>
                                            <?php endif; ?>
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
                                            <th style="white-space: nowrap;"><?= ucwords(str_replace('_', ' ', (str_replace(array_keys($this->page_config['replace_text']), array_values($this->page_config['replace_text']), $table_th)))) ?><i data-rel="<?= $table_th ?>" class="icon icon-black icon-triangle-ns shorter" style="cursor: pointer; margin-left: 4px;"></i></th>
                                        <?php endforeach; ?>
                                        <th style="text-align: center; width: 140px; white-space: nowrap;">Action</th> 
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
                                                <td class="center" style="text-align: center; vertical-align: middle;"><span class="center icon32 icon icon-arrow-nesw"></span></td>    
                                            <?php endif; ?>
                                            <?php $td_key = 0; ?>
                                            <?php if ($config['tablePrimaryKey']): ?>
                                                <?php if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE): ?>
                                                    <td class="center" style="text-align: center; vertical-align: middle;">
                                                        <input class="selectedItem" type="checkbox" value="<?= $table_tr[$config['tablePrimaryKey']] ?>" name="selectedItem[]">
                                                    </td> 
                                                <?php endif; ?>
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
                                                            <td class="center" style="vertical-align: middle; text-align: center; white-space: nowrap;">                                                                                          
                                                                <?php
                                                                switch (intval($table_td)) {
                                                                    case 1 :
                                                                        echo '<span class="label label-success">On</span>';
                                                                        break;
                                                                    default :
                                                                        echo '<span class="label label-important">Off</span>';
                                                                }
                                                                ?>
                                                            </td> 
                                                            <?php
                                                            continue;
                                                        }
                                                    }
                                                    if (is_array($config['use_dropdown_columns_options'])) {
                                                        if (array_key_exists($t_key, $config['use_dropdown_columns_options']) === TRUE) {
                                                            ?> 
                                                            <td class="center" style="vertical-align: middle; white-space: nowrap;">                                                                                          
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
                                                                    echo isset($config['use_dropdown_columns_options'][$t_key][$table_td]) ? $config['use_dropdown_columns_options'][$t_key][$table_td] : $table_td;
                                                                }
                                                                ?>                                                        
                                                            </td> 
                                                            <?php
                                                            continue;
                                                        }
                                                    }

                                                    if (is_array($config['use_image_columns'])) {
                                                        $arr_index = array_search($t_key, $config['use_image_columns']);
                                                        if ($arr_index !== FALSE) {
                                                            ?> 
                                                            <td class="center" style="vertical-align: middle; text-align: center; white-space: nowrap;">                                                                                          
                                                                <img style="width:64px; border-radius: 4px;" src='<?= $table_td ? $table_meta['config']['use_image_columns_path'][0] . $table_td : cdn_url() . 'uploads/noImage.jpg' ?>' alt="<?= $table_td ?>" />
                                                            </td> 
                                                            <?php
                                                            continue;
                                                        }
                                                    }
                                                }

                                                $is_text_heavy = in_array($t_key, array('customer_address', 'customer_referer', 'customer_proof', 'first_time'));
                                                ?>
                                                <td class="center <?= $is_text_heavy ? 'col-wrap-text' : '' ?>" style="vertical-align: middle; <?= $is_text_heavy ? 'white-space: normal; min-width: 140px; max-width: 240px; word-break: break-word;' : 'white-space: nowrap;' ?>">
                                                    <?php
                                                    if (is_array($config['allowed_action']) && in_array('quick_edit', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <span class="customer-quick-edit" relId="<?= $table_tr[$config['tablePrimaryKey']]; ?>" relfield="<?= $t_key ?>" onclick="quickEdit(this)" id="<?= $t_key . '-' . $table_tr[$config['tablePrimaryKey']] ?>" title="Click To Quick Edit" style="cursor: pointer; display: inline-block; padding: 2px 6px; border-radius: 4px; color: inherit; transition: all 0.15s ease;">
                                                            <?= strip_tags($table_td) ?>
                                                        </span>
                                                    <?php } else { ?>
                                                        <?= strip_tags($table_td); ?>
                                                    <?php } ?>
                                                </td>

                                            <?php endforeach; ?>

                                            <td class="center" style="text-align: center; vertical-align: middle; white-space: nowrap;">
                                                <div style="display: inline-flex; align-items: center; justify-content: center; gap: 3px; white-space: nowrap;">
                                                    <?php
                                                    if (is_array($config['allowed_action']) && in_array('view_detail', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <a class="btn btn-success" title="View" data-rel="tooltip" href="javascript:void(0);" onclick="popupViewSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                            <i class="fa fa-eye"></i>  
                                                        </a>
                                                        <?php
                                                    }

                                                    if (is_array($config['allowed_action']) && in_array('billing', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <a class="btn btn-warning" title="Billing Collection" data-rel="tooltip" href="<?= console_url('customer/fastbill/' . $table_tr[$config['tablePrimaryKey']]) ?>">
                                                            <i class="fa fa-calculator"></i>  
                                                        </a>
                                                        <?php
                                                    }

                                                    if (is_array($config['allowed_action']) && in_array('print_statement', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <a class="btn btn-default" style="background-color: #6366f1; color: #fff; border-color: #6366f1;" title="Print Statement" data-rel="tooltip" target="_blank" href="<?= console_url('customer/print_statement/' . $table_tr[$config['tablePrimaryKey']]) ?>">
                                                            <i class="fa fa-print"></i>  
                                                        </a>
                                                        <?php
                                                    }

                                                    if (is_array($config['allowed_action']) && in_array('edit_detail', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <a class="btn btn-info" title="Edit" data-rel="tooltip" href="javascript:void(0);" onclick="popupEditSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                            <i class="fa fa-pencil"></i>  
                                                        </a>
                                                        <?php
                                                    }

                                                    if (is_array($config['allowed_action']) && in_array('delete', $config['allowed_action']) !== FALSE) {
                                                        ?>
                                                        <a class="btn btn-danger" title="Delete" data-rel="tooltip" href="javascript:void(0);" onclick="popupDeleteSingle(<?= $table_tr[$config['tablePrimaryKey']] ?>); return false;">
                                                            <i class="fa fa-trash-o"></i> 
                                                        </a>
                                                        <?php
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
                    <div class="pagination pagination-centered" style="margin: 12px 0 4px 0;">
                        <?= $this->pagination->create_links(); ?>
                    </div>  
                <?php else: ?>
                    <div class="alert alert-info" style="margin-top: 15px; background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 6px; padding: 12px 16px;">
                        <i class="fa fa-info-circle"></i> No Customer Records Found
                    </div>
                <?php endif; ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->
    <script>
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
            };
        <?php endif; ?>
    </script>
</div>
