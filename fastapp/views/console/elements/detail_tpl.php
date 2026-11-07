
<table class="table table-bordered table-striped table-condensed">
    <thead>

        <tr>
            <th>Field Name</th>           
            <th>Data</th> 
        </tr>
    </thead>   
    <tbody>
        <? foreach ($table_meta['data'] as $t_key => $table_td): ?>
            <tr>    
                <td class="center"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></td>                    
                <?
                if (is_array($table_meta['config']['use_status_columns'])) {
                    if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
                        ?> 
                        <td class="center">                                                                                          
                            <?
                            switch (intval($table_td)) {
                                case 1 :
                                    echo '<span class="label label-success">On</span>';
                                    break;
                                default :
                                    echo '<span class="label label-important">Off</span>';
                            }
                            ?>
                        </td> <?
                continue;
            }
        }
        if (is_array($table_meta['config']['use_dropdown_columns_options'])) {
            if (array_key_exists($t_key, $table_meta['config']['use_dropdown_columns_options']) === TRUE) {
                            ?> 
                        <td class="center">    
                            <?php if(isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key])){
                                $table_td = json_decode($table_td, TRUE);
                                foreach ($table_td as $m_key=> $m_value) {
                                   if($m_key>0){
                                        echo ',';
                                    }
                                    echo $table_meta['config']['use_dropdown_columns_options'][$t_key][$m_value];
                                    
                                }
                            } else {
                             echo isset($table_meta['config']['use_dropdown_columns_options'][$t_key][$table_td])?$table_meta['config']['use_dropdown_columns_options'][$t_key][$table_td]:'N/A';

                            }?>
                        </td> <?
                continue;
            }
        }
        
        if (is_array($table_meta['config']['use_image_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
            if ($arr_index !== FALSE) {
                $default_path = isset($table_meta['config']['use_image_columns_path'][0]) ? $table_meta['config']['use_image_columns_path'][0] : (base_url() . 'uploads/' . (defined('NODE') ? NODE : 'node') . '/');
                $img_src = resolve_image_url($table_td, $default_path);
                ?> 
                <td class="center"> 
                    <a href="<?= $img_src ?>" target="_blank" title="Click to view full image">
                        <img style="max-width: 320px; max-height: 250px; object-fit: contain; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.12); border: 1px solid #cbd5e1; padding: 4px; background: #fff;" 
                             src='<?= $img_src ?>' 
                             onerror="this.onerror=null;this.src='<?= base_url() ?>uploads/noImage.jpg';" 
                             alt="<?= htmlspecialchars(strip_tags($table_td)) ?>"/>
                    </a>
                    <div style="margin-top: 6px;">
                        <a href="<?= $img_src ?>" target="_blank" class="btn btn-mini btn-info" style="font-size: 11px;">
                            <i class="fa fa-external-link"></i> View Full Image
                        </a>
                    </div>
                </td> <?php
                continue;
            }
        }
                    ?>
                <td class="center"><?= htmlspecialchars_decode($table_td) ?></td>


            </tr>
        <? endforeach; ?>                          
    </tbody>
</table>  
