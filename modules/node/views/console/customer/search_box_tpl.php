<style>
.customer-search-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 12px 14px;
    align-items: flex-end;
    padding: 6px 2px;
    margin-bottom: 0;
}
.customer-search-grid .search-field-item {
    flex: 0 0 auto;
    min-width: 175px;
}
.customer-search-grid .search-field-item label.control-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 4px;
}
.customer-search-grid .search-field-item .input-prepend {
    display: flex;
    align-items: center;
    margin-bottom: 0;
}
.customer-search-grid .search-field-item .input-prepend .add-on {
    height: 30px;
    line-height: 28px;
    padding: 0 9px;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-right: none;
    border-radius: 4px 0 0 4px;
    color: #64748b;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
}
.customer-search-grid .search-field-item input[type="text"],
.customer-search-grid .search-field-item .datepicker {
    height: 30px !important;
    line-height: 28px !important;
    font-size: 12px !important;
    padding: 2px 8px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 0 4px 4px 0 !important;
    color: #0f172a !important;
    background: #ffffff !important;
    width: 145px !important;
    box-shadow: none !important;
    box-sizing: border-box !important;
    transition: border-color 0.15s ease;
}
.customer-search-grid .search-field-item input[type="text"]:focus,
.customer-search-grid .search-field-item .datepicker:focus {
    border-color: #35aa47 !important;
    outline: none !important;
    box-shadow: 0 0 0 2px rgba(53, 170, 71, 0.2) !important;
}
.customer-search-grid .search-field-item select {
    height: 30px !important;
    font-size: 12px !important;
    border: 1px solid #cbd5e1 !important;
    border-radius: 4px !important;
    padding: 2px 6px !important;
    background: #ffffff !important;
    color: #0f172a !important;
    min-width: 160px;
}
.customer-search-grid .chzn-container {
    font-size: 11.5px;
    min-width: 160px;
}
</style>

<?php if (isset($searchFields)): ?>
    <div class="row-fluid sortable search_box">	
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-search"></i>Search Filter</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="search-table-form customer-search-grid" action="collect" method="post" onsubmit="return false;">
                    <?php foreach ($searchFields as $searchField): ?>
                        <div class="search-field-item">
                            <div class="control-group">
                                <label class="control-label" for="field_<?= $searchField ?>"><?= ucwords(str_replace('_', ' ', str_replace(array_keys(isset($this->page_config['replace_text']) ? $this->page_config['replace_text'] : array()), array_values(isset($this->page_config['replace_text']) ? $this->page_config['replace_text'] : array()), $searchField))) ?></label>
                                <div class="controls">
                                    <?php
                                    // 1. Status Column (Toggle)
                                    if (is_array($table_meta['config']['use_status_columns'])) {
                                        $arr_index = array_search($searchField, $table_meta['config']['use_status_columns']);
                                        if ($arr_index !== FALSE) {
                                            ?>
                                            <div class="input-prepend">
                                                <input name="<?= $searchField ?>" id="field_<?= $searchField ?>" data-no-uniform="true" type="checkbox" class="iphone-toggle" value="0">
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <?php
                                            continue;
                                        }
                                    }

                                    // 2. Dropdown Column
                                    if (is_array($table_meta['config']['use_dropdown_columns'])) {
                                        $arr_index = array_search($searchField, $table_meta['config']['use_dropdown_columns']);
                                        if ($arr_index !== FALSE) {
                                            $choosenValue = isset($default_search_value[$searchField]) ? $default_search_value[$searchField] : null;
                                            ?>
                                            <div class="input-prepend">
                                                <select name="<?= $searchField ?>" id="field_<?= $searchField ?>" data-placeholder="Choose option..." data-rel="chosen">
                                                    <option value="">-- Choose One --</option>
                                                    <?php
                                                    $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$searchField]) ? $table_meta['config']['use_dropdown_columns_options'][$searchField] : $table_meta['config']['use_dropdown_columns_options']);
                                                    foreach ($optionList as $optkey => $optvalue):
                                                        ?>
                                                        <option <?php if ($optkey === $choosenValue) { echo 'selected="selected"'; } ?> value="<?= $optkey ?>"><?= $optvalue ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <?php
                                            continue;
                                        }
                                    }

                                    // 3. Datepicker Column
                                    if (is_array($table_meta['config']['datepicker_columns'])) {
                                        $arr_index = array_search($searchField, $table_meta['config']['datepicker_columns']);
                                        if ($arr_index !== FALSE) {
                                            ?>
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                                <input type="text" class="datepicker" id="field_<?= $searchField ?>" name="<?= $searchField ?>" placeholder="Select date...">
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <?php
                                            continue;
                                        }
                                    }

                                    // 4. Default Text Input
                                    ?>
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-pencil"></i></span>
                                        <input id="field_<?= $searchField ?>" type="text" name="<?= $searchField ?>" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>   
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
