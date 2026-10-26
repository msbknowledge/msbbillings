<?php

function internet_widget_overview() {

    ?>
    <div class="box span6">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-bell"></i>Internet Overview</h2>
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
                            <a target="_blank" href="<?= console_url('internet_customer/inactive_customer') ?>"><button class="btn btn-info xt"> <i class="icon-ban-circle"></i>Inactive: <?=internet_customer_count(array('customer_status' => 0))?></button></a>
                            <a target="_blank" href="<?= console_url('internet_customer/active_customer') ?>"><button class="btn btn-info xt"> <i class="icon-ok-circle"></i>Active:  <?= internet_customer_count(array('customer_status' => 1)) ?></button></a>
                            <a target="_blank" href="<?= console_url('internet_customer/all_customer') ?>"><button class="btn btn-info xt"> <i class="icon-info-sign"></i>Total: <?=internet_customer_count(null) ?></button></a>
                        </td>
                    </tr>

                    <tr>
                        <td><span class="label label-success">Packages</span></td>
                        <td class="">
                            <?
                            $package_subscriber = internet_package_subscriber();

                            if (!empty($package_subscriber))
                                foreach ($package_subscriber as $key => $value):
                                    ?>
                                    <a class="" target="_blank" href="<?= console_url('internet_customer/package_customer/?package=' . $key) ?>" style="display:block; float: left;margin:2px">
                                        <button class="btn btn-info xt">
                                            <i class="icon-list-alt"></i> 
                                            <?php
                                            $pack = internet_package_name($key);
                                            echo $pack[0]['package_name'];
                                            ?> : <?= $value ?>
                                        </button>
                                    </a>
                                <? endforeach; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="label label-warning">Collection</span></td>
                        <td>Today: Rs <?= internet_totalCollectedToday(); ?>/- | This Month: Rs <?= internet_totalCollectedThisMonth(); ?>/- | This Year: Rs <?= internet_totalCollectedThisYear(); ?>/-</td>
                    </tr>
                     <?php $CI = &get_instance();
                    
                    if($CI->current_user_session['user_login']=='admin'){ ?>
                    <tr>
                        <td><span class="label label-info">Billed</span></td>
                        <td>Today: Rs <?= internet_totalInvoicedToday(); ?>/- | This Month: Rs <?= internet_totalInvoicedThisMonth(); ?>/- | This Year: Rs <?= internet_totalInvoicedThisYear(); ?>/-</td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td><span class="label label-important">Subscription Expiry</span></td>
                        <td><button class="btn btn-info xt"><?php
                                $value = Expiry_date();
                                echo 'Expiry :' . $value['expiry_day'][0]['data_count'];
                                ?></button>

                            <button class="btn btn-info xt"><?php echo 'Extended :' . $value['extended_day'][0]['data_count'] ?></button></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div><!--/span-->

    <?php
}

function internet_totalCollectedToday() {
    $CI = &get_instance();

    /*     * ****** */
    $current_user = $CI->current_user_session['user_firstname'] . ' ' . $CI->current_user_session['user_lastname'];
    if ($CI->current_user_session['user_login'] != 'admin') {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date = "' . date('Y-m-d') . '" and collection_collected_by like "%' . $current_user . '%"')->result_array();
    } else {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date = "' . date('Y-m-d') . '"')->result_array();
    }
    /*     * ****** */


    // $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date = "' . date('Y-m-d') . '"')->result_array();
    return (float) $total[0]['total'];
}

function internet_totalCollectedThisMonth() {
    $CI = &get_instance();

    /*     * ****** */
    $current_user = $CI->current_user_session['user_firstname'] . ' ' . $CI->current_user_session['user_lastname'];
    if ($CI->current_user_session['user_login'] != 'admin') {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date like "' . date('Y-m-') . '%" and collection_collected_by like "%' . $current_user . '%"')->result_array();
    } else {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date like "' . date('Y-m-') . '%"')->result_array();
    }
    /*     * ****** */


    // $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date like "' . date('Y-m-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function internet_totalCollectedThisYear() {
    $CI = &get_instance();

    /*     * ****** */
    $current_user = $CI->current_user_session['user_firstname'] . ' ' . $CI->current_user_session['user_lastname'];
    if ($CI->current_user_session['user_login'] != 'admin') {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date like "' . date('Y-') . '%" and collection_collected_by like "%' . $current_user . '%"')->result_array();
    } else {
        $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date like "' . date('Y-') . '%"')->result_array();
    }
    /*     * ****** */


    // $total = $CI->db->query('SELECT SUM(collection_amount) as total FROM `internet_collections` WHERE collection_date like "' . date('Y-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function internet_totalInvoicedToday() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `internet_invoices` WHERE invoice_date = "' . date('Y-m-d') . '"')->result_array();
    return (float) $total[0]['total'];
}

function internet_totalInvoicedThisMonth() {
    $CI = &get_instance();
    $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `internet_invoices` WHERE invoice_date like "' . date('Y-m-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function internet_totalInvoicedThisYear() {
   $CI = &get_instance();
   $total = $CI->db->query('SELECT SUM(invoice_billed_amount) as total FROM `internet_invoices` WHERE invoice_date like "' . date('Y-') . '%"')->result_array();
    return (float) $total[0]['total'];
}

function internet_customer_count($condition) {
    $CI = &get_instance();
    return $CI->internet_customers_model->count_total($condition);
}

function internet_package_name($id) {
    if ($id != 'Unset') {
        $CI = &get_instance();
        $pack = $CI->db->query('select package_name from internet_packages where package_ID=' . $id)->result_array();
    } else {
        $pack[0]['package_name'] = $id;
    }
    return $pack;
}

function internet_package_subscriber() {
    $CI = &get_instance();
    $subscribed = $CI->db->query('SELECT customer_package,count(*) as count From internet_customers where customer_status = 1 group by customer_package ');
    $subscribedPackages = $subscribed->result_array();
    $packStatus = null;
    foreach ($subscribedPackages as $key => $value) {
        $packageId = $value['customer_package'];
        $packages = $CI->internet_packages_model->get_list_for_dropdown('package_ID', array('package_ID' => $packageId));
        $packages = array_values($packages);
        $packStatus[isset($packages[0]) ? $packages[0] : 'Unset'] = $value['count'];
    }

    /*     * ********unset***** */
    $packages = $CI->internet_packages_model->get_list_for_dropdown('package_ID');
    $packagelist = null;
    $condition = array('customer_status' => 1, 'customer_package' => '');
    foreach ($packages as $package_ID => $pack) {
        $packagelist[] = $package_ID;
    }
    $packagelist = implode(',', $packagelist);
    if (!empty($packagelist)) {
        $sql = $CI->db->query('select count(*) as unset from internet_customers where customer_package not in(' . $packagelist . ')');
        $allData = $sql->result_array();
        if ($allData[0]['unset'] > 0) {
            $packStatus['Unset'] = $allData[0]['unset'];
        }
        return $packStatus;
    }
}

function internet_invoice_pattern($invoice_customer, $invoiceDate) {
    $pattern = get_option('invoice_no_pattern');
    if (empty($pattern)) {
        set_option('invoice_no_pattern', '[{invoice_prefix}]-[{year}]-[{month}]-[{invoice_customer}]');
    }
    $serial = get_option('internet_serial_no');
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

function Expiry_date() {
    $CI = &get_instance();
    $date = $CI->internet_customers_model->expiry();
    return $date;
}

register_hook('internet_widget_overview', 'dashboard');
