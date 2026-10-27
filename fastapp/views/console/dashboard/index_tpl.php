<?php
/**
 * Modern Executive Dashboard View
 * Retains all existing license, plan, subscription modals, and dynamic hooks
 * Adds module-specific real-time KPI metrics, quick actions toolbar, and interactive Chart.js graphs
 */

$CI = get_instance();
$has_sales       = $CI->db->table_exists('sales');
$has_purchases   = $CI->db->table_exists('purchases');
$has_medicines   = $CI->db->table_exists('medicines');
$has_collections = $CI->db->table_exists('collections');
$has_customers   = $CI->db->table_exists('customers');

// Initialize module statistics
$today_sales_amount = 0.00;
$today_sales_invoices = 0;
$today_purchases_amount = 0.00;
$today_purchases_invoices = 0;
$total_medicines_count = 0;
$expired_count = 0;
$expiring_soon_count = 0;
$unassigned_count = 0;

$chart_labels = [];
$chart_sales = [];
$chart_purchases = [];
$total_7d_sales = 0.00;
$total_7d_purchases = 0.00;

if ($has_sales) {
    // 1. Today's Sales
    $ts_q = $CI->db->query("SELECT SUM(sale_total) as total, COUNT(DISTINCT sale_invoice) as invoices FROM sales WHERE DATE_FORMAT(sale_date, '%Y-%m-%d') = CURRENT_DATE")->result_array();
    if (!empty($ts_q[0]['total'])) {
        $today_sales_amount = (float)$ts_q[0]['total'];
        $today_sales_invoices = (int)$ts_q[0]['invoices'];
    }

    // 2. Today's Purchases
    if ($has_purchases) {
        $tp_q = $CI->db->query("SELECT SUM(purchase_total) as total, COUNT(DISTINCT purchase_invoice) as invoices FROM purchases WHERE DATE_FORMAT(purchase_date, '%Y-%m-%d') = CURRENT_DATE")->result_array();
        if (!empty($tp_q[0]['total'])) {
            $today_purchases_amount = (float)$tp_q[0]['total'];
            $today_purchases_invoices = (int)$tp_q[0]['invoices'];
        }
    }

    // 3. Medicines Inventory Count
    if ($has_medicines) {
        $tm_q = $CI->db->query("SELECT COUNT(*) as count FROM medicines")->result_array();
        if (!empty($tm_q[0]['count'])) {
            $total_medicines_count = (int)$tm_q[0]['count'];
        }

        $ua_q = $CI->db->query("SELECT COUNT(*) as count FROM medicines WHERE medicine_storage = '' OR medicine_storage IS NULL")->result_array();
        if (!empty($ua_q[0]['count'])) {
            $unassigned_count = (int)$ua_q[0]['count'];
        }
    }

    // 4. Expiry Statistics
    if ($has_purchases) {
        $curr_ym = date('ym');
        $next_6m = date('ym', strtotime('+6 months'));

        $exp_q = $CI->db->query("SELECT COUNT(DISTINCT purchase_medicine_id) as count FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month,2,'0')) <= '$curr_ym'")->result_array();
        if (!empty($exp_q[0]['count'])) {
            $expired_count = (int)$exp_q[0]['count'];
        }

        $exp_s_q = $CI->db->query("SELECT COUNT(DISTINCT purchase_medicine_id) as count FROM purchases WHERE CONCAT(purchase_expire_year, LPAD(purchase_expire_month,2,'0')) > '$curr_ym' AND CONCAT(purchase_expire_year, LPAD(purchase_expire_month,2,'0')) <= '$next_6m'")->result_array();
        if (!empty($exp_s_q[0]['count'])) {
            $expiring_soon_count = (int)$exp_s_q[0]['count'];
        }
    }

    // 5. Adaptive 7-Day Performance Analytics for Graphs
    $chart_days = [];
    for ($i = 6; $i >= 0; $i--) {
        $d = date('Y-m-d', strtotime("-$i days"));
        $chart_days[$d] = [
            'date' => $d,
            'label' => date('D, M j', strtotime("-$i days")),
            'sales' => 0.0,
            'purchases' => 0.0
        ];
    }

    $start_d = date('Y-m-d', strtotime('-6 days'));
    $end_d   = date('Y-m-d');

    $s7_q = $CI->db->query("SELECT sale_date, SUM(sale_total) as total FROM sales WHERE sale_date BETWEEN '$start_d' AND '$end_d' GROUP BY sale_date")->result_array();
    if (!empty($s7_q)) {
        foreach ($s7_q as $row) {
            if (isset($chart_days[$row['sale_date']])) {
                $chart_days[$row['sale_date']]['sales'] = (float)$row['total'];
            }
        }
    }

    if ($has_purchases) {
        $p7_q = $CI->db->query("SELECT purchase_date, SUM(purchase_total) as total FROM purchases WHERE purchase_date BETWEEN '$start_d' AND '$end_d' GROUP BY purchase_date")->result_array();
        if (!empty($p7_q)) {
            foreach ($p7_q as $row) {
                if (isset($chart_days[$row['purchase_date']])) {
                    $chart_days[$row['purchase_date']]['purchases'] = (float)$row['total'];
                }
            }
        }
    }

    // Check if recent window has data, else use latest active record window
    $has_recent_data = false;
    foreach ($chart_days as $cd) {
        if ($cd['sales'] > 0 || $cd['purchases'] > 0) {
            $has_recent_data = true;
            break;
        }
    }

    if (!$has_recent_data) {
        $max_s_q = $CI->db->query("SELECT MAX(sale_date) as max_d FROM sales")->result_array();
        $max_s = !empty($max_s_q[0]['max_d']) ? $max_s_q[0]['max_d'] : '';
        $max_p = '';
        if ($has_purchases) {
            $max_p_q = $CI->db->query("SELECT MAX(purchase_date) as max_d FROM purchases")->result_array();
            $max_p = !empty($max_p_q[0]['max_d']) ? $max_p_q[0]['max_d'] : '';
        }
        $latest = max($max_s, $max_p);
        if ($latest) {
            $chart_days = [];
            for ($i = 6; $i >= 0; $i--) {
                $d = date('Y-m-d', strtotime("$latest -$i days"));
                $chart_days[$d] = [
                    'date' => $d,
                    'label' => date('D, M j', strtotime("$latest -$i days")),
                    'sales' => 0.0,
                    'purchases' => 0.0
                ];
            }
            $start_l = date('Y-m-d', strtotime("$latest -6 days"));
            $s7_q = $CI->db->query("SELECT sale_date, SUM(sale_total) as total FROM sales WHERE sale_date BETWEEN '$start_l' AND '$latest' GROUP BY sale_date")->result_array();
            if (!empty($s7_q)) {
                foreach ($s7_q as $row) {
                    if (isset($chart_days[$row['sale_date']])) {
                        $chart_days[$row['sale_date']]['sales'] = (float)$row['total'];
                    }
                }
            }
            if ($has_purchases) {
                $p7_q = $CI->db->query("SELECT purchase_date, SUM(purchase_total) as total FROM purchases WHERE purchase_date BETWEEN '$start_l' AND '$latest' GROUP BY purchase_date")->result_array();
                if (!empty($p7_q)) {
                    foreach ($p7_q as $row) {
                        if (isset($chart_days[$row['purchase_date']])) {
                            $chart_days[$row['purchase_date']]['purchases'] = (float)$row['total'];
                        }
                    }
                }
            }
        }
    }

    $chart_labels = array_column($chart_days, 'label');
    $chart_sales  = array_column($chart_days, 'sales');
    $chart_purchases = array_column($chart_days, 'purchases');
    $total_7d_sales = array_sum($chart_sales);
    $total_7d_purchases = array_sum($chart_purchases);
}
?>

<div class="index-wrapper" style="padding-bottom: 30px;">
    <!-- Welcome Header & Quick Action Shortcuts Toolbar -->
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-7 col-sm-12">
            <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, #059669 0%, #10b981 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                    <i class="fa fa-tachometer"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-weight: 800; font-size: 22px; color: #0f172a; letter-spacing: -0.02em;">
                        Dashboard Overview
                    </h3>
                    <div style="font-size: 13px; color: #64748b; margin-top: 3px; display: flex; align-items: center; gap: 10px;">
                        <span><i class="fa fa-calendar-check-o text-success"></i> <?= date('l, d F Y') ?></span>
                        <span style="display: inline-block; width: 4px; height: 4px; border-radius: 50%; background: #cbd5e1;"></span>
                        <span class="badge" style="background: #ecfdf5; color: #059669; font-weight: 600; border: 1px solid #a7f3d0; padding: 3px 8px;">
                            <i class="fa fa-circle text-success" style="font-size: 8px;"></i> Live Cloud Sync
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="col-md-5 col-sm-12" style="margin-top: 10px; text-align: right;">
            <div style="display: inline-flex; gap: 8px; flex-wrap: wrap; justify-content: flex-end;">
                <?php if ($has_sales): ?>
                    <a href="<?= console_url('sale') ?>" class="btn btn-sm" style="background: #059669; color: #fff; font-weight: 600; border-radius: 6px; padding: 7px 14px; box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);">
                        <i class="fa fa-plus-circle"></i> New Sale
                    </a>
                    <?php if ($has_purchases): ?>
                        <a href="<?= console_url('purchase') ?>" class="btn btn-sm" style="background: #0284c7; color: #fff; font-weight: 600; border-radius: 6px; padding: 7px 14px; box-shadow: 0 2px 6px rgba(2, 132, 199, 0.25);">
                            <i class="fa fa-shopping-cart"></i> New Purchase
                        </a>
                    <?php endif; ?>
                    <?php if ($has_medicines): ?>
                        <a href="<?= console_url('medicine_stock/expiring_view') ?>" class="btn btn-sm btn-default" style="background: #fff; color: #475569; font-weight: 600; border-radius: 6px; padding: 7px 12px; border: 1px solid #cbd5e1;">
                            <i class="fa fa-clock-o text-warning"></i> Expiry Alert
                        </a>
                    <?php endif; ?>
                <?php elseif ($has_collections): ?>
                    <a href="<?= console_url('collection/add') ?>" class="btn btn-sm" style="background: #059669; color: #fff; font-weight: 600; border-radius: 6px; padding: 7px 14px;">
                        <i class="fa fa-plus-circle"></i> New Collection
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Notice Bar / Marquee Banner (Retained & Sleek) -->
    <div class="row">
        <div class="col-md-12">
            <div style="background: #ffffff; border-radius: 8px; border: 1px solid #e2e8f0; border-left: 4px solid #10b981; padding: 12px 18px; margin-bottom: 22px; display: flex; align-items: center; gap: 15px; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
                <span class="label label-success" style="font-size: 12px; padding: 5px 12px; border-radius: 20px; display: inline-flex; align-items: center; gap: 6px; background-color: #059669 !important; font-weight: 700; flex-shrink: 0;">
                    <i class="fa fa-bullhorn"></i> NOTICE
                </span>
                <marquee direction="left" style="vertical-align: middle; font-size: 13px; font-weight: 600; color: #1e293b;" scrolldelay="100" onmouseover="this.stop();" onmouseout="this.start();">
                    We have updated our system for smoothness and better security. All customers are requested to change the user account password as early as possible! Please call 9382509991 in case of any issue. | কাজের মসৃণতা এবং উন্নত নিরাপত্তার জন্য আমরা আমাদের সিস্টেম আপডেট করেছি। সমস্ত গ্রাহকদের যত তাড়াতাড়ি সম্ভব ব্যবহারকারীর অ্যাকাউন্টের পাসওয়ার্ড পরিবর্তন করার জন্য অনুরোধ করা হচ্ছে!
                </marquee>
            </div>
        </div>
    </div>

    <!-- Existing 4 Stat Cards (Active Plan, License, Valid Till, Help) - Modernized & Retained -->
    <div class="row">
        <!-- Plan Information -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart" style="border-top: 3px solid #10b981; border-radius: 10px; background: #fff; padding: 18px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); transition: transform 0.2s ease;">
                <p class="font14" style="margin-bottom: 12px; font-weight: 700; color: #1e293b;">
                    <i class="fa fa-cubes ftlayer" style="color: #10b981;"></i> Active Plan
                    <span class="pull-right" style="color: #059669; font-weight: 800;"><?= PLAN_NAME ?></span>
                </p>
                <div class="progress-group" style="margin-bottom: 10px;">
                    <div class="progress progress-minibar" style="height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden; margin-bottom: 0;">
                        <div class="progress-bar progress-bar-green" style="width: 100%; background: #10b981;"></div>
                    </div>
                </div>
                <div style="font-size: 12px; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <i class="fa fa-check-circle" style="color: #10b981;"></i> <?= str_ireplace(",", ", ", PLAN_PACKAGES) ?>
                </div>
            </div>
        </div>

        <!-- Subscription Status -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart" style="border-top: 3px solid #0284c7; border-radius: 10px; background: #fff; padding: 18px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); transition: transform 0.2s ease;">
                <p class="font14" style="margin-bottom: 12px; font-weight: 700; color: #1e293b;">
                    <i class="fa fa-shield ftlayer" style="color: #0284c7;"></i> System License
                    <span class="pull-right"><span class="label label-success" style="background-color: #059669 !important; font-weight: 700; font-size: 11px;">Active</span></span>
                </p>
                <div class="progress-group" style="margin-bottom: 10px;">
                    <div class="progress progress-minibar" style="height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden; margin-bottom: 0;">
                        <div class="progress-bar progress-bar-aqua" style="width: 85%; background: #0284c7;"></div>
                    </div>
                </div>
                <div style="font-size: 12px; color: #64748b;">
                    <i class="fa fa-cloud" style="color: #0284c7;"></i> Cloud Sync: <span style="color: #059669; font-weight: 700;">Live & Secure</span>
                </div>
            </div>
        </div>

        <!-- Subscription Expiry & Renewal -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart" style="border-top: 3px solid #f59e0b; border-radius: 10px; background: #fff; padding: 18px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); transition: transform 0.2s ease;">
                <p class="font14" style="margin-bottom: 12px; font-weight: 700; color: #1e293b;">
                    <i class="fa fa-calendar ftlayer" style="color: #f59e0b;"></i> Valid Till
                    <span class="pull-right text-danger" style="font-weight: 800;"><?= DEACTIVATION_DATE ?></span>
                </p>
                <div class="progress-group" style="margin-bottom: 10px;">
                    <div class="progress progress-minibar" style="height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden; margin-bottom: 0;">
                        <div class="progress-bar progress-bar-yellow" style="width: 65%; background: #f59e0b;"></div>
                    </div>
                </div>
                <div style="margin-top: 4px;">
                    <button class="btn btn-xs btn-success" id="paynow" style="font-weight: 700; padding: 4px 12px; border-radius: 4px; background-color: #059669; border: none;">
                        <i class="fa fa-refresh"></i> Renew Subscription
                    </button>
                    <input type="text" id="deactive_date" value="<?= DEACTIVATION_DATE ?>" style="display:none">
                </div>
            </div>
        </div>

        <!-- Technical Support -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart" style="border-top: 3px solid #6366f1; border-radius: 10px; background: #fff; padding: 18px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); transition: transform 0.2s ease;">
                <p class="font14" style="margin-bottom: 12px; font-weight: 700; color: #1e293b;">
                    <i class="fa fa-whatsapp ftlayer" style="color: #25D366;"></i> Technical Help
                    <span class="pull-right">
                        <a href="https://wa.me/919382509991" target="_blank" style="color: #4f46e5; font-weight: 700; text-decoration: none;">
                            +91 9382509991
                        </a>
                    </span>
                </p>
                <div class="progress-group" style="margin-bottom: 10px;">
                    <div class="progress progress-minibar" style="height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden; margin-bottom: 0;">
                        <div class="progress-bar progress-bar-green" style="width: 100%; background: #6366f1;"></div>
                    </div>
                </div>
                <div style="font-size: 11px; color: #64748b;">
                    12pm to 6pm (WhatsApp) | Sat-Sun Off
                </div>
            </div>
        </div>
    </div>

    <?php if ($has_sales): ?>
    <!-- Module Real-Time KPI Summary Deck -->
    <div class="row" style="margin-top: 6px; margin-bottom: 14px;">
        <!-- KPI 1: Today's Sales -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb15">
            <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">
                            Today's Sales
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: #047857; margin-top: 6px;">
                            Rs: <?= number_format($today_sales_amount, 2) ?>
                        </div>
                        <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                            <i class="fa fa-file-text-o text-success"></i> <strong><?= $today_sales_invoices ?></strong> Invoices Today
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-line-chart"></i>
                    </div>
                </div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: #10b981;"></div>
            </div>
        </div>

        <!-- KPI 2: Today's Purchases -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb15">
            <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">
                            Today's Purchases
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: #0369a1; margin-top: 6px;">
                            Rs: <?= number_format($today_purchases_amount, 2) ?>
                        </div>
                        <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                            <i class="fa fa-shopping-bag text-info"></i> <strong><?= $today_purchases_invoices ?></strong> Purchases Today
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #f0f9ff; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-truck"></i>
                    </div>
                </div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: #0284c7;"></div>
            </div>
        </div>

        <!-- KPI 3: Total Medicines in Store -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb15">
            <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">
                            Active Catalog
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 6px;">
                            <?= number_format($total_medicines_count) ?> <span style="font-size: 14px; font-weight: 600; color: #64748b;">Items</span>
                        </div>
                        <div style="font-size: 12px; color: #64748b; margin-top: 4px;">
                            <i class="fa fa-database text-primary"></i> 4 Lakh+ msbbillings DB
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-medkit"></i>
                    </div>
                </div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: #6366f1;"></div>
            </div>
        </div>

        <!-- KPI 4: Stock Expiry & Alerts -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb15">
            <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; padding: 18px 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">
                            Stock Attention
                        </div>
                        <div style="font-size: 24px; font-weight: 800; color: #dc2626; margin-top: 6px;">
                            <?= number_format($expiring_soon_count) ?> <span style="font-size: 13px; font-weight: 600; color: #b45309;">Expiring</span>
                        </div>
                        <div style="font-size: 12px; color: #dc2626; margin-top: 4px;">
                            <i class="fa fa-exclamation-triangle"></i> <?= number_format($expired_count) ?> Expired | Check Stock
                        </div>
                    </div>
                    <div style="width: 44px; height: 44px; border-radius: 10px; background: #fff1f2; color: #e11d48; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa fa-bell"></i>
                    </div>
                </div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 3px; background: #e11d48;"></div>
            </div>
        </div>
    </div>

    <!-- Interactive Module Graphs (Chart.js) -->
    <div class="row" style="margin-bottom: 22px;">
        <!-- Graph 1: 7-Day Performance Trend (Sales vs. Purchases) -->
        <div class="col-lg-8 col-md-7 col-sm-12 mb20">
            <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h4 style="margin: 0; font-weight: 700; font-size: 16px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                            <i class="fa fa-area-chart text-success"></i> Sales vs Purchase Performance Trend
                        </h4>
                        <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                            Daily aggregate turnover analysis (Last 7 Active Days)
                        </div>
                    </div>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <span class="badge" style="background: #ecfdf5; color: #059669; font-weight: 700; padding: 4px 10px; border: 1px solid #a7f3d0;">
                            7D Sales: Rs <?= number_format($total_7d_sales, 0) ?>
                        </span>
                        <span class="badge" style="background: #f0f9ff; color: #0284c7; font-weight: 700; padding: 4px 10px; border: 1px solid #bae6fd;">
                            7D Purchases: Rs <?= number_format($total_7d_purchases, 0) ?>
                        </span>
                    </div>
                </div>
                <div style="position: relative; height: 280px; width: 100%;">
                    <canvas id="salesPurchaseChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Graph 2: Stock & Expiry Health Distribution (Doughnut) -->
        <div class="col-lg-4 col-md-5 col-sm-12 mb20">
            <div style="background: #fff; border-radius: 10px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.04); padding: 20px; height: 100%;">
                <div style="margin-bottom: 14px;">
                    <h4 style="margin: 0; font-weight: 700; font-size: 16px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-pie-chart text-primary"></i> Inventory Health Status
                    </h4>
                    <div style="font-size: 12px; color: #64748b; margin-top: 2px;">
                        Breakdown of catalog readiness & validity
                    </div>
                </div>

                <div style="position: relative; height: 200px; width: 100%;">
                    <canvas id="inventoryHealthChart"></canvas>
                </div>

                <!-- Custom Legend Chips -->
                <div style="margin-top: 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 11px;">
                    <div style="background: #f8fafc; padding: 6px 10px; border-radius: 6px; border-left: 3px solid #10b981;">
                        <div style="color: #64748b; font-weight: 600;">Active In-Stock</div>
                        <div style="font-weight: 700; color: #0f172a; font-size: 13px;">
                            <?= number_format(max(0, $total_medicines_count - $expired_count - $expiring_soon_count)) ?>
                        </div>
                    </div>
                    <div style="background: #f8fafc; padding: 6px 10px; border-radius: 6px; border-left: 3px solid #f59e0b;">
                        <div style="color: #64748b; font-weight: 600;">Expiring (<6 Mo)</div>
                        <div style="font-weight: 700; color: #b45309; font-size: 13px;">
                            <?= number_format($expiring_soon_count) ?>
                        </div>
                    </div>
                    <div style="background: #f8fafc; padding: 6px 10px; border-radius: 6px; border-left: 3px solid #f43f5e;">
                        <div style="color: #64748b; font-weight: 600;">Expired Stock</div>
                        <div style="font-weight: 700; color: #dc2626; font-size: 13px;">
                            <?= number_format($expired_count) ?>
                        </div>
                    </div>
                    <div style="background: #f8fafc; padding: 6px 10px; border-radius: 6px; border-left: 3px solid #6366f1;">
                        <div style="color: #64748b; font-weight: 600;">Unassigned Rack</div>
                        <div style="font-weight: 700; color: #4338ca; font-size: 13px;">
                            <?= number_format($unassigned_count) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Dynamic Modules / Plugins Dashboard Hook (Retained & Elevated) -->
    <div class="widget-area row">
        <div class="col-md-12">
            <?= execute_hook('dashboard'); ?>
        </div>
    </div>
</div>

<!-- Payment Modal (Retained & Intact) -->
<div id="paynowModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #1e293b; color: #fff; padding: 14px 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #fff; opacity: 0.8;">&times;</button>
                <h4 class="modal-title" style="font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-credit-card text-success"></i> Instant Subscription Payment
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; text-align: center; background: #f8fafc;">
                <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; display: inline-block;">
                    <p style="font-weight: 600; color: #1e293b; margin-bottom: 12px; font-size: 15px;">
                        Scan QR Code via Google Pay / PhonePe / Paytm / BHIM
                    </p>
                    <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="MsbBillings QR Code" style="max-height: 360px; max-width: 100%; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <div style="margin-top: 15px; font-size: 13px; color: #64748b;">
                        After payment, please send screenshot to WhatsApp <strong>+91 9382509991</strong> for instant renewal activation.
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #fff; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Renew Subscription Notification Modal (Retained & Intact) -->
<div id="renewSubscription" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #e11d48; color: #fff; padding: 14px 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #fff; opacity: 0.8;">&times;</button>
                <h4 class="modal-title" style="font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle"></i> Subscription Expiring Soon
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; text-align: center; background: #fff;">
                <div class="alert alert-warning" style="border-radius: 6px; margin-bottom: 18px; font-weight: 600;">
                    Please renew your subscription before the expiry date to avoid service interruption!
                </div>
                <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="MsbBillings QR Code" style="max-height: 320px; max-width: 100%; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="$('#paynowModal').modal('show');">
                    <i class="fa fa-qrcode"></i> Pay Now
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Remind Me Later</button>
            </div>
        </div>
    </div>
</div>

<!-- Load Chart.js if not already present -->
<script src="<?= base_url(); ?>assets/backend/js/Chart.min.js"></script>

<script>
$(document).ready(function(){
    // Subscription modals logic (exact existing behavior)
    var nextmonth = "<?= date("Y-m-d", strtotime('+1 months')) ?>";
    var deactive_date = $('#deactive_date').val();
    
    if(deactive_date && deactive_date <= nextmonth){
        $("#renewSubscription").modal('show');
    }
    
    $("#paynow").click(function(e){
        e.preventDefault();
        $("#paynowModal").modal('show');
    });

    <?php if ($has_sales && !empty($chart_labels)): ?>
    // 1. Sales vs Purchase Performance Line / Area Chart
    var salesCtx = document.getElementById('salesPurchaseChart');
    if (salesCtx) {
        var ctx = salesCtx.getContext('2d');
        
        var gradientSales = ctx.createLinearGradient(0, 0, 0, 260);
        gradientSales.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
        gradientSales.addColorStop(1, 'rgba(16, 185, 129, 0.01)');

        var gradientPurchase = ctx.createLinearGradient(0, 0, 0, 260);
        gradientPurchase.addColorStop(0, 'rgba(2, 132, 199, 0.25)');
        gradientPurchase.addColorStop(1, 'rgba(2, 132, 199, 0.01)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($chart_labels) ?>,
                datasets: [
                    {
                        label: 'Sales (Rs)',
                        data: <?= json_encode($chart_sales) ?>,
                        backgroundColor: gradientSales,
                        borderColor: '#10b981',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.35,
                        fill: true
                    },
                    {
                        label: 'Purchases (Rs)',
                        data: <?= json_encode($chart_purchases) ?>,
                        backgroundColor: gradientPurchase,
                        borderColor: '#0284c7',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0284c7',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.35,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        fontColor: '#475569',
                        fontStyle: '600',
                        fontSize: 12,
                        padding: 15
                    }
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFontColor: '#ffffff',
                    bodyFontColor: '#f1f5f9',
                    bodySpacing: 6,
                    xPadding: 12,
                    yPadding: 10,
                    cornerRadius: 6,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rs ' + Number(tooltipItem.yLabel).toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: '#e2e8f0'
                        },
                        ticks: {
                            fontColor: '#64748b',
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#f1f5f9',
                            borderDash: [3, 3]
                        },
                        ticks: {
                            fontColor: '#64748b',
                            fontSize: 11,
                            callback: function(value) {
                                return 'Rs ' + (value >= 1000 ? (value / 1000).toFixed(1) + 'k' : value);
                            }
                        }
                    }]
                }
            }
        });
    }

    // 2. Inventory Health Doughnut Chart
    var invCtx = document.getElementById('inventoryHealthChart');
    if (invCtx) {
        var activeStock = <?= max(0, $total_medicines_count - $expired_count - $expiring_soon_count) ?>;
        var expSoon = <?= $expiring_soon_count ?>;
        var expiredStock = <?= $expired_count ?>;
        var unassigned = <?= $unassigned_count ?>;

        new Chart(invCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Active In-Stock', 'Expiring (<6 Mo)', 'Expired Stock', 'Unassigned Rack'],
                datasets: [{
                    data: [activeStock, expSoon, expiredStock, unassigned],
                    backgroundColor: ['#10b981', '#f59e0b', '#f43f5e', '#6366f1'],
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverBorderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 68,
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFontColor: '#ffffff',
                    bodyFontColor: '#f1f5f9',
                    bodySpacing: 6,
                    xPadding: 12,
                    yPadding: 10,
                    cornerRadius: 6,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index] || '';
                            var value = data.datasets[0].data[tooltipItem.index];
                            return label + ': ' + Number(value).toLocaleString('en-IN') + ' items';
                        }
                    }
                }
            }
        });
    }
    <?php endif; ?>
});
</script>
