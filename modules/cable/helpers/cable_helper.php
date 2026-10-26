<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function invoice_period_generate() {
    $month_names = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $years = array('19','18', '17','16');
    $output_array = null;
    foreach ($years as $year) {
        foreach ($month_names as $month) {

            $output_array[$month . '-' . $year] = $month . '-' . $year;
        }
    }
    return $output_array;
}

function cable_widget_overview() {
    ?>

    <div class="box span6">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-bell"></i>Cable Overview</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>
                            <span class="label">Customers</span>
                        </td>
                        <td>
                            <a target="_blank" href="<?= console_url('cable_customer/inactive_customer') ?>"><button class="btn btn-info xt"> <i class="icon-ban-circle"></i>Inactive: <?= boxCount(array('customer_status' => 0)) ?></button></a>
                            <a target="_blank" href="<?= console_url('cable_customer/active_customer') ?>"><button class="btn btn-info xt"> <i class="icon-ok-circle"></i>Active:  <?= boxCount(array('customer_status' => 1)) ?></button></a>
                            <a target="_blank" href="<?= console_url('cable_customer/all_customer') ?>"><button class="btn btn-info xt"> <i class="icon-info-sign"></i>Total: <?= boxCount() ?></button></a>
                        </td>
                    </tr>

                    <tr>
                        <td><span class="label label-success">Packages</span></td>
                        <td class="">
                            <?
                            $package_subscriber = package_subscriber();

                            if (!empty($package_subscriber))
                                foreach ($package_subscriber as $key => $value):
                                    ?>
                                    <a class="" target="_blank" href="<?= console_url('cable_customer/package_customer/?package=' . $key) ?>" style="display:block; float: left;margin:2px">
                                        <button class="btn btn-info xt">
                                            <i class="icon-list-alt"></i> <?php $pack = package_name($key);
                        echo $pack[0]['package_name'];
                        ?> : <?= $value ?>
                                        </button>
                                    </a>
                                <? endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="label label-success">STB Type</span></td>
                        <?
                        $stbs = stb_by_type();
                        ?>
                        <td>
                            <? foreach ($stbs as $value) { ?>
                                <span class="label"><?= $value['stb_type'] ?></span> : <?= $value['total'] ?>

                            <? } ?>
                        </td>

                    </tr>
                    <tr>
                        <td><span class="label label-success">STB MSO</span></td>
                        <td>
                        <?
                            $stbs = stb_by_mso();
                            ?><?
                            foreach ($stbs as $value) {
                                if (empty($value['stb_mso'])) {
                                    $value['stb_mso'] = 'UnSet';
                                }
                                ?>
                                <span class="label"><?= $value['stb_mso'] ?></span> : <?= $value['total'] ?>

                        <? } ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="label label-warning">Collection</span></td>
                        <td>Today: Rs <?= totalCollectedToday(); ?>/- | This Month: Rs <?= totalCollectedThisMonth(); ?>/- | This Year: Rs <?= totalCollectedThisYear(); ?>/-</td>
                    </tr>
                     <tr>
                        <td><span class="label label-info">Billed</span></td>
                        <td>Today: Rs <?= totalInvoicedToday(); ?>/- | This Month: Rs <?= totalInvoicedThisMonth(); ?>/- | This Year: Rs <?= totalInvoicedThisYear(); ?>/-</td>
                    </tr>
                    <tr>
                        <td><span class="label label-info">Complains</span></td>
                        <td> By Service:                         <?
                            $complain = complain_by_service();
                            ?><?
                            foreach ($complain as $value) {
                                if (empty($value['complain_service'])) {
                                    $value['complain_service'] = 'UnSet';
                                }
                                ?>
                                <span class="label"><?= $value['complain_service'] ?></span> : <?= $value['total'] ?>

                        <? } ?>
                        | By Status:
                         <?
                            $complain = complain_by_status();
                            ?><?
                            foreach ($complain as $value) {
                                if (empty($value['complain_status'])) {
                                    $value['complain_status'] = 'UnSet';
                                }
                                ?>
                                <span class="label <? 
                                if($value['complain_status']=='new'){ echo "label-important";}
                                if($value['complain_status']=='assign'){ echo "label-warning";}
                                if($value['complain_status']=='resolved'){ echo "label-success";}
                                
                                ?>"><?= $value['complain_status'] ?></span> : <?= $value['total'] ?>

                        <? } ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

    <?php
}

function boxCount($condition = NULL) {
    $CI = &get_instance();
    return $CI->cable_customers_model->count_total($condition);
}

function totalBilled($invoice_period = NULL) {
    $CI = &get_instance();
    return $CI->cable_invoices_model->total_billed_amount($invoice_period);
}

function stb_by_type() {
    $CI = &get_instance();
    return $CI->db->query('select stb_type,count(*) as total from cable_stbs group by stb_type')->result_array();
}
function complain_by_status() {
    $CI = &get_instance();
    return $CI->db->query('select complain_status,count(*) as total from cable_complains group by complain_status')->result_array();
}
function complain_by_service() {
    $CI = &get_instance();
    return $CI->db->query('select complain_service,count(*) as total from cable_complains group by complain_service')->result_array();
}

function stb_by_mso() {
    $CI = &get_instance();
    return $CI->db->query('select stb_mso,count(*) as total from cable_stbs group by stb_mso')->result_array();
}

function netDue($condition = NULL) {
    $CI = &get_instance();
    return $CI->cable_invoices_model->total_due_amount($condition);
}

function package_name($id) {
    if ($id != 'Unset') {
        $CI = &get_instance();
        $pack = $CI->db->query('select package_name from cable_packages where package_ID=' . $id)->result_array();
    } else {
        $pack[0]['package_name'] = $id;
    }
    return $pack;
}

function package_subscriber() {
    $CI = &get_instance();
    $subscribed = $CI->db->query('SELECT customer_package,count(*) as count FROM cable_customers where customer_status = 1 group by customer_package ');
    $subscribedPackages = $subscribed->result_array();
    $packStatus = null;
    foreach ($subscribedPackages as $key => $value) {
        $packageId = json_decode($value['customer_package'], TRUE);
        $packages = $CI->cable_packages_model->get_list_for_dropdown('package_ID', array('package_ID' => @$packageId[0]));
        $packages = array_values($packages);
        $packStatus[isset($packages[0]) ? $packages[0] : 'Unset'] = $value['count'];
    }

    /*     * ********unset***** */
    $packages = $CI->cable_packages_model->get_list_for_dropdown('package_ID');
    $packagelist = '';
    $condition = array('customer_status' => 1, 'customer_package' => '');
    foreach ($packages as $package_ID => $pack) {
        $packagelist[] = "'[\"$package_ID\"]'";
    }
    $packagelist = implode(',', $packagelist);
    if (!empty($packagelist)) {
        $sql = $CI->db->query('select count(*) as unset from cable_customers where customer_package not in(' . $packagelist . ')');
        $allData = $sql->result_array();
        if ($allData[0]['unset'] > 0) {
            $packStatus['Unset'] = $allData[0]['unset'];
        }
        return $packStatus;
    }
}

function totalCollectedToday() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `cable_collections` WHERE collection_date = "' . date('Y-m-d') . '"')->result_array();
    return (float)$total[0]['total'];
}

function totalCollectedThisMonth() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `cable_collections` WHERE collection_date like "' . date('Y-m-') . '%"')->result_array();
    return (float)$total[0]['total'];
}

function totalCollectedThisYear() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `cable_collections` WHERE collection_date like "' . date('Y-') . '%"')->result_array();
    return (float)$total[0]['total'];
}
function totalInvoicedToday() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `cable_invoices` WHERE invoice_date = "' . date('Y-m-d') . '"')->result_array();
    return (float)$total[0]['total'];
}

function totalInvoicedThisMonth() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `cable_invoices` WHERE invoice_date like "' . date('Y-m-') . '%"')->result_array();
    return (float)$total[0]['total'];
}

function totalInvoicedThisYear() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `cable_invoices` WHERE invoice_date like "' . date('Y-') . '%"')->result_array();
    return (float)$total[0]['total'];
}

function invoice_pattern($invoice_customer, $invoiceDate) {
    $pattern = get_option('invoice_no_pattern');
    if (empty($pattern)) {
        set_option('invoice_no_pattern', '[{invoice_prefix}]-[{year}]-[{month}]-[{invoice_customer}]');
    }
    $serial = get_option('serial_no');
    $num_padded = sprintf("%04d", $serial);
    $prefix = get_option('invoice_prefix');
    #pr($pattern);
    $pattern_data = array('[{invoice_prefix}]' => $prefix,
        '[{year}]' => Date('y', $invoiceDate),
        '[{month}]' => Date('M', $invoiceDate),
        '[{date}]' => Date('d', $invoiceDate),
        '[{invoice_customer}]' => $invoice_customer,
        '[{serial_no}]' => $num_padded);
    return str_ireplace(array_keys($pattern_data), array_values($pattern_data), get_option('invoice_no_pattern'));
}

register_hook('cable_widget_overview', 'dashboard');
