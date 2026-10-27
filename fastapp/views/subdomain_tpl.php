<?php
/**
 * Dynamic Subdomain & Client Node Portal Template
 * Adapts in real-time to active modules (Cable TV, Internet, Pharmacy, Retail, Wholesale)
 */

// 1. Resolve Company Details & Identity
$raw_company = isset($options['company_details']) ? $options['company_details'] : '';
$raw_provider = isset($options['provider_name']) ? $options['provider_name'] : '';

$business_name = '';
$business_address = '';
$business_gst = '';
$business_phones = array();

if (!empty($raw_provider)) {
    $business_name = trim(strip_tags($raw_provider));
}

if (!empty($raw_company)) {
    // Extract first H3 or header for name
    if (preg_match('/<h3>(.*?)<\/h3>/is', $raw_company, $m)) {
        if (empty($business_name)) $business_name = trim(strip_tags($m[1]));
    }
    // Extract GST
    if (preg_match('/GST\s*(?:No\.?|:)?\s*([0-9A-Z]{15})/i', $raw_company, $gm)) {
        $business_gst = trim($gm[1]);
    }
    // Extract Phones
    if (preg_match_all('/(?:[6-9][0-9]{9})/s', $raw_company, $pm)) {
        $business_phones = array_unique($pm[0]);
    }
    // Address is general stripped text
    $cleaned_text = trim(strip_tags(str_replace(array('<h3>', '</h3>', '<h5>', '</h5>', '<br>', '<br/>', '<BR>'), "\n", $raw_company)));
    $lines = array_filter(explode("\n", $cleaned_text));
    $addr_lines = array();
    foreach ($lines as $line) {
        $l = trim($line);
        if (!empty($l) && strpos($l, $business_name) === false && strpos(strtoupper($l), 'GST') === false && strpos(strtoupper($l), 'PHONE') === false) {
            $addr_lines[] = $l;
        }
    }
    $business_address = implode(', ', $addr_lines);
}

if (isset($options['provider_address']) && empty($business_address)) {
    $business_address = trim(strip_tags(str_replace(array('<br>', '<br/>', '<BR>'), ', ', $options['provider_address'])));
}
if (isset($options['provider_gst']) && empty($business_gst)) {
    if (preg_match('/([0-9A-Z]{15})/', $options['provider_gst'], $gm)) {
        $business_gst = $gm[1];
    }
}

if (empty($business_name)) {
    $business_name = ucwords(str_replace('-', ' ', $node_name)) . ' Services & Digital Network';
}

$primary_phone = !empty($business_phones) ? reset($business_phones) : '9674300642';
$ajax_search_url = function_exists('base_url') ? base_url('landing/check_subscriber') : 'landing/check_subscriber';
if (isset($_GET['node']) && !empty($_GET['node'])) {
    $ajax_search_url .= '?node=' . urlencode($_GET['node']);
}

// 2. Identify Active Modules
$node_modules_clean = is_array($node_modules) ? $node_modules : array();
$has_cable = in_array('trai-cable', $node_modules_clean) || in_array('trai_lite', $node_modules_clean) || in_array('msb-cable', $node_modules_clean) || strpos($node_plan, 'cable') !== false;
$has_internet = in_array('internet', $node_modules_clean) || in_array('msb-internet', $node_modules_clean) || strpos($node_plan, 'internet') !== false;
$has_medical = in_array('medical', $node_modules_clean) || in_array('medical_wholesale', $node_modules_clean) || in_array('antu', $node_modules_clean) || strpos($node_plan, 'medical') !== false;
$has_retail = in_array('node', $node_modules_clean) || in_array('product', $node_modules_clean) || in_array('wholesale', $node_modules_clean);
$has_milk = in_array('milk', $node_modules_clean);

// If no module matched specifically, infer from plan
if (!$has_cable && !$has_internet && !$has_medical && !$has_retail && !$has_milk) {
    if (strpos($node_plan, 'cable') !== false) $has_cable = true;
    elseif (strpos($node_plan, 'medical') !== false) $has_medical = true;
    else $has_retail = true;
}

// Service Badges
$service_tags = array();
if ($has_cable) $service_tags[] = '📺 Digital Cable TV';
if ($has_internet) $service_tags[] = '🚀 High-Speed Fiber Internet';
if ($has_medical) $service_tags[] = '💊 Pharmacy & Healthcare';
if ($has_retail) $service_tags[] = '🛒 Retail & Invoicing';
if ($has_milk) $service_tags[] = '🥛 Dairy Distribution';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#10b981">
    
    <title><?= htmlspecialchars($business_name) ?> | Official Customer Self-Care & Services Portal</title>
    <meta name="description" content="Welcome to <?= htmlspecialchars($business_name) ?> official subscriber portal. Check monthly bills, renew subscriptions, pay via UPI QR, and view latest plans.">
    <link rel="shortcut icon" href="<?= base_url('img/simplebillingsfav.png') ?>" type="image/png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Modern Shared Design System -->
    <link rel="stylesheet" href="<?= base_url('assets/css/frontend-modern.css') ?>">

    <style>
        .sub-hero {
            background: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.08) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(2, 132, 199, 0.08) 0%, transparent 40%),
                        #0f172a;
            color: #ffffff;
            padding: 70px 0 90px;
            position: relative;
            overflow: hidden;
        }
        .sub-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 24px 24px;
            pointer-events: none;
        }
        .sub-tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(52, 211, 153, 0.3);
            border-radius: 9999px;
            padding: 4px 14px;
            font-size: 12.5px;
            font-weight: 700;
            margin-right: 8px;
            margin-bottom: 12px;
        }
        .sub-search-card {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .sub-badge-gst {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 6px;
            padding: 2px 8px;
            font-size: 11.5px;
            font-weight: 700;
        }
        .pkg-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px 24px;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        .pkg-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
            border-color: #10b981;
        }
        .pkg-rate {
            font-size: 38px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1;
            margin: 14px 0 20px;
        }
        .pkg-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #e0f2fe;
            color: #0369a1;
            font-size: 11px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
        }
        /* Result Box */
        .subscriber-result-box {
            display: none;
            margin-top: 20px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 12px;
            padding: 18px;
            color: #fff;
        }
        .subscriber-result-box.error {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        /* Modal */
        .upi-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(6px);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .upi-modal-overlay.active {
            display: flex;
        }
        .upi-modal {
            background: #ffffff;
            border-radius: 20px;
            max-width: 440px;
            width: 100%;
            padding: 32px 28px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            text-align: center;
            position: relative;
            color: #0f172a;
        }
        .upi-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: #f1f5f9;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
        }
    </style>
</head>
<body>

    <!-- Top Announcement Bar with Node Phone & Address -->
    <div class="msb-topbar">
        <div class="msb-container">
            <div class="msb-topbar-inner">
                <div class="msb-topbar-left">
                    <span class="msb-badge-live">
                        <span class="msb-pulse-dot"></span>
                        Subscriber Portal
                    </span>
                    <span class="msb-topbar-ticker">
                        Welcome to <?= htmlspecialchars($business_name) ?> &bull; Pay bills instantly via UPI QR!
                    </span>
                </div>
                <div class="msb-topbar-right">
                    <a href="tel:<?= $primary_phone ?>" class="msb-topbar-link">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <?= $primary_phone ?>
                    </a>
                    <?php if (!empty($business_gst)): ?>
                    <span class="sub-badge-gst">GSTIN: <?= htmlspecialchars($business_gst) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Header & Navigation -->
    <header class="msb-header" id="subHeader">
        <div class="msb-container">
            <div class="msb-header-inner">
                <a href="<?= base_url() ?>" class="msb-logo" style="gap: 10px;">
                    <div class="msb-logo-mark" style="background: linear-gradient(135deg, #0284c7 0%, #10b981 100%);">
                        <?= strtoupper(substr($node_name, 0, 1)) ?>
                    </div>
                    <div>
                        <div style="font-weight: 800; font-size: 18px; color: #0f172a; line-height: 1.2;">
                            <?= htmlspecialchars($business_name) ?>
                        </div>
                        <div style="font-size: 11.5px; color: #64748b; font-weight: 500;">
                            <?= htmlspecialchars(substr($business_address, 0, 40)) ?>...
                        </div>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <nav class="msb-nav-desktop">
                    <a href="#self-care" class="msb-nav-link">Check Dues & Pay</a>
                    <?php if ($has_cable): ?>
                    <a href="#cable-plans" class="msb-nav-link">Cable TV Plans</a>
                    <?php endif; ?>
                    <?php if ($has_internet): ?>
                    <a href="#internet-plans" class="msb-nav-link">Fiber Broadband</a>
                    <?php endif; ?>
                    <?php if ($has_medical): ?>
                    <a href="#pharmacy" class="msb-nav-link">Pharmacy Care</a>
                    <?php endif; ?>
                    <a href="#quick-pay" class="msb-nav-link">Pay Via UPI</a>
                    <a href="#contact" class="msb-nav-link">Contact</a>
                </nav>

                <!-- Actions -->
                <div class="msb-header-actions">
                    <button onclick="openUpiModal()" class="msb-btn msb-btn-primary hide-mobile">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                        Quick Pay UPI
                    </button>
                    <a href="<?= $login_url ?>" target="_blank" class="msb-btn msb-btn-login">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Operator Login
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ==========================================================================
       SUBDOMAIN DYNAMIC HERO SECTION
       ========================================================================== -->
    <section class="sub-hero" id="self-care">
        <div class="msb-container">
            <div class="msb-hero-grid">
                <div>
                    <div>
                        <?php foreach ($service_tags as $tag): ?>
                        <span class="sub-tag-pill"><?= $tag ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h1 style="font-size: 42px; font-weight: 800; line-height: 1.2; margin-bottom: 18px; letter-spacing: -0.01em;">
                        <?= htmlspecialchars($business_name) ?>
                    </h1>
                    <p style="font-size: 16.5px; color: #94a3b8; line-height: 1.65; margin-bottom: 28px; max-width: 560px;">
                        <?php if ($has_cable && $has_internet): ?>
                        High-definition Digital Cable TV & Ultra-fast Fiber Internet connectivity. Pay monthly renewals seamlessly online and manage your subscriber account 24/7.
                        <?php elseif ($has_medical): ?>
                        Your authorized neighborhood healthcare provider. 100% genuine medicines, verified batch and expiry dates, prescription fulfillment, and home delivery.
                        <?php else: ?>
                        Premium retail shopping and wholesale services. Transparent digital GST invoicing, instant account ledger settlements, and prompt customer assistance.
                        <?php endif; ?>
                    </p>

                    <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                        <button onclick="openUpiModal()" class="msb-btn msb-btn-primary msb-btn-lg">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                            Instant UPI Bill Pay
                        </button>
                        <a href="https://wa.me/91<?= $primary_phone ?>?text=Hello%20<?= urlencode($business_name) ?>%2C%20I%20need%20assistance" target="_blank" class="msb-btn msb-btn-whatsapp msb-btn-lg">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2"/></svg>
                            WhatsApp Helpline
                        </a>
                    </div>
                </div>

                <!-- Right Column: Interactive Subscriber Dues & Lookup Box -->
                <div>
                    <div class="sub-search-card">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                            <span style="font-size: 16px; font-weight: 700; color: #fff;">
                                🔍 Subscriber Self-Care Lookup
                            </span>
                            <span style="color: #34d399; font-size: 12px; font-weight: 600;">Live Search</span>
                        </div>
                        <p style="font-size: 13.5px; color: #94a3b8; margin-bottom: 18px;">
                            Enter your registered Mobile Number, Customer ID, or STB Number to check your active package and renewal dues:
                        </p>

                        <form id="subscriberSearchForm" onsubmit="searchSubscriber(event)">
                            <div style="display: flex; gap: 10px; margin-bottom: 12px;">
                                <input type="text" id="subQueryInput" class="msb-form-input" placeholder="e.g. 9830057484 or Customer ID" required style="background: #0f172a; color: #fff; border-color: #334155;">
                                <button type="submit" id="subSearchBtn" class="msb-btn msb-btn-primary" style="padding: 0 20px;">
                                    Find Account
                                </button>
                            </div>
                        </form>

                        <!-- Dynamic Result Card -->
                        <div id="subscriberResult" class="subscriber-result-box">
                            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 8px;">
                                <h4 id="resName" style="font-size: 17px; font-weight: 800; color: #fff;">-</h4>
                                <span id="resBadge" class="sub-tag-pill" style="margin: 0;">-</span>
                            </div>
                            <div style="font-size: 13px; color: #cbd5e1; margin-bottom: 6px;">
                                <strong>STB / Acc:</strong> <span id="resStb">-</span>
                            </div>
                            <div style="font-size: 13px; color: #cbd5e1; margin-bottom: 14px;">
                                <strong>Address:</strong> <span id="resAddr">-</span>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: space-between; background: rgba(0,0,0,0.25); padding: 12px; border-radius: 8px;">
                                <div>
                                    <span style="font-size: 11.5px; color: #94a3b8;">Renewal Amount</span>
                                    <div id="resAmount" style="font-size: 22px; font-weight: 800; color: #34d399;">₹0.00</div>
                                </div>
                                <button onclick="openUpiModalWithDetails()" class="msb-btn msb-btn-primary" style="padding: 8px 16px; font-size: 13px;">
                                    Pay Now via UPI &rarr;
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
       MODULE SECTION: CABLE TV PACKAGES
       ========================================================================== -->
    <?php if ($has_cable && !empty($cable_packages)): ?>
    <section class="msb-section" id="cable-plans">
        <div class="msb-container">
            <div class="msb-section-header">
                <span class="msb-section-eyebrow">Digital Entertainment</span>
                <h2 class="msb-section-title">Digital Cable TV Packages</h2>
                <p class="msb-section-desc">
                    TRAI compliant channel bouquets and packs. Crystal-clear 1080p Full HD video quality and Dolby Digital sound.
                </p>
            </div>

            <div class="msb-features-grid">
                <?php foreach ($cable_packages as $pkg): ?>
                <div class="pkg-card">
                    <span class="pkg-badge">
                        <?= !empty($pkg['package_subscription_days']) ? $pkg['package_subscription_days'] . ' Days' : 'Monthly' ?>
                    </span>
                    <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">
                        <?= htmlspecialchars($pkg['package_name']) ?>
                    </h3>
                    <div style="font-size: 13px; color: #64748b;">
                        <?= !empty($pkg['package_channel_count']) ? $pkg['package_channel_count'] . '+ Channels Included' : 'Base Pack Bouquet' ?>
                    </div>
                    <div class="pkg-rate">
                        <span style="font-size: 20px; vertical-align: super; font-weight: 600;">₹</span><?= number_format($pkg['package_rate'], 0) ?>
                        <span style="font-size: 14px; color: #64748b; font-weight: 500;">/ mo</span>
                    </div>
                    <ul class="msb-solution-bullets" style="margin-bottom: 24px; flex: 1;">
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            High Definition (HD) & SD Channels
                        </li>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Electronic Program Guide (EPG)
                        </li>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Instant Online Recharge & Activation
                        </li>
                    </ul>
                    <button onclick="selectPackageForPayment('<?= addslashes($pkg['package_name']) ?>', <?= $pkg['package_rate'] ?>)" class="msb-btn msb-btn-outline" style="width: 100%;">
                        Select & Pay Online &rarr;
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ==========================================================================
       MODULE SECTION: INTERNET BROADBAND PACKAGES
       ========================================================================== -->
    <?php if ($has_internet && !empty($internet_packages)): ?>
    <section class="msb-section msb-section-alt" id="internet-plans">
        <div class="msb-container">
            <div class="msb-section-header">
                <span class="msb-section-eyebrow">Ultra-Fast Fiber</span>
                <h2 class="msb-section-title">High-Speed Fiber Broadband Plans</h2>
                <p class="msb-section-desc">
                    Buffering-free streaming, low-latency online gaming, and uninterrupted work from home with symmetric upload and download speeds.
                </p>
            </div>

            <div class="msb-features-grid">
                <?php foreach ($internet_packages as $ipkg): ?>
                <div class="pkg-card" style="border-top: 4px solid #0284c7;">
                    <span class="pkg-badge" style="background: #e0f2fe; color: #0284c7;">
                        <?= !empty($ipkg['normal_bandwidth']) ? htmlspecialchars($ipkg['normal_bandwidth']) : 'Fiber Speed' ?>
                    </span>
                    <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">
                        <?= htmlspecialchars($ipkg['package_name']) ?>
                    </h3>
                    <div style="font-size: 13px; color: #64748b;">
                        Unlimited High-Speed Data &bull; 30 Days
                    </div>
                    <div class="pkg-rate" style="color: #0284c7;">
                        <span style="font-size: 20px; vertical-align: super; font-weight: 600;">₹</span><?= number_format(!empty($ipkg['package_cost_inclusive_tax']) ? $ipkg['package_cost_inclusive_tax'] : $ipkg['package_rate'], 0) ?>
                        <span style="font-size: 14px; color: #64748b; font-weight: 500;">/ mo (incl. tax)</span>
                    </div>
                    <ul class="msb-solution-bullets" style="margin-bottom: 24px; flex: 1;">
                        <li>
                            <svg fill="none" stroke="#0284c7" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Symmetric High-Speed Fiber Connectivity
                        </li>
                        <li>
                            <svg fill="none" stroke="#0284c7" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            Zero Data Throttling & Unlimited Usage
                        </li>
                        <li>
                            <svg fill="none" stroke="#0284c7" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            24/7 Priority Optical Fiber Line Monitoring
                        </li>
                    </ul>
                    <button onclick="selectPackageForPayment('<?= addslashes($ipkg['package_name']) ?>', <?= !empty($ipkg['package_cost_inclusive_tax']) ? $ipkg['package_cost_inclusive_tax'] : $ipkg['package_rate'] ?>)" class="msb-btn msb-btn-primary" style="width: 100%; background: #0284c7;">
                        Recharge Broadband &rarr;
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ==========================================================================
       MODULE SECTION: PHARMACY HEALTHCARE
       ========================================================================== -->
    <?php if ($has_medical): ?>
    <section class="msb-section" id="pharmacy">
        <div class="msb-container">
            <div class="msb-section-header">
                <span class="msb-section-eyebrow">Trusted Chemist</span>
                <h2 class="msb-section-title">Certified Medicine & Healthcare Services</h2>
                <p class="msb-section-desc">
                    Stocked with all prescribed medications, surgical disposables, pediatric care, and generic salt formulations.
                </p>
            </div>

            <div class="msb-features-grid">
                <div class="msb-feature-card">
                    <div class="msb-feature-icon" style="background:#dcfce7; color:#15803d;">💊</div>
                    <h3>100% Genuine Medicines</h3>
                    <p>All stock sourced directly from verified pharmaceutical distributors with complete batch numbers and expiry tracking.</p>
                </div>

                <div class="msb-feature-card">
                    <div class="msb-feature-icon" style="background:#e0f2fe; color:#0369a1;">📝</div>
                    <h3>Send Prescription via WhatsApp</h3>
                    <p>Simply take a photo of your doctor's prescription and send it directly to our pharmacist for rapid packing and pickup.</p>
                </div>

                <div class="msb-feature-card">
                    <div class="msb-feature-icon" style="background:#fef3c7; color:#b45309;">🚚</div>
                    <h3>Emergency Home Delivery</h3>
                    <p>Elderly and chronic patients in our locality can receive their essential medications at their doorstep with zero hassle.</p>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ==========================================================================
       UPI PAYMENT & QR CODE SECTION
       ========================================================================== -->
    <section class="msb-section msb-section-dark" id="quick-pay">
        <div class="msb-container">
            <div class="msb-cta-card" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                <div class="msb-cta-grid">
                    <div>
                        <span class="msb-section-eyebrow" style="color: #34d399;">Instant Payment Desk</span>
                        <h2>Pay Any Bill Instantly Via UPI</h2>
                        <p style="color: #cbd5e1; margin-bottom: 24px;">
                            Scan with Google Pay, PhonePe, Paytm, or BHIM UPI. Once paid, send us the transaction UTR number or screenshot for instant renewal confirmation.
                        </p>
                        <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                            <button onclick="openUpiModal()" class="msb-btn msb-btn-primary msb-btn-lg">
                                Open UPI QR Scanner
                            </button>
                            <a href="https://wa.me/91<?= $primary_phone ?>?text=I%20have%20sent%20the%20UPI%20payment%20for%20my%20account" target="_blank" class="msb-btn msb-btn-whatsapp msb-btn-lg">
                                Send Payment Proof on WhatsApp
                            </a>
                        </div>
                    </div>

                    <div style="background: rgba(255,255,255,0.06); padding: 24px; border-radius: 16px; text-align: center; border: 1px solid rgba(255,255,255,0.1);">
                        <div style="font-weight: 700; color: #fff; margin-bottom: 12px;">Merchant Payment QR</div>
                        <img id="qrCodePreview" src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=upi://pay?pa=<?= $primary_phone ?>@upi&pn=<?= urlencode($business_name) ?>&cu=INR" alt="UPI QR" style="margin: 0 auto; background: #fff; padding: 10px; border-radius: 12px; width: 180px; height: 180px;">
                        <div style="font-size: 13px; color: #94a3b8; margin-top: 10px;">
                            UPI ID: <strong style="color: #fff;"><?= $primary_phone ?>@upi</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
       CONTACT & LOCATION
       ========================================================================== -->
    <section class="msb-section" id="contact">
        <div class="msb-container">
            <div class="msb-section-header">
                <span class="msb-section-eyebrow">Customer Support</span>
                <h2 class="msb-section-title">Get In Touch With Our Office</h2>
                <p class="msb-section-desc">Visit our local service center or reach out via phone, email, and WhatsApp.</p>
            </div>

            <div class="msb-hardware-grid" style="grid-template-columns: repeat(3, 1fr);">
                <div class="msb-hw-card" style="background:#fff; border-color:#e2e8f0; color:#0f172a;">
                    <div class="msb-hw-icon" style="background:#dcfce7; color:#15803d;">📞</div>
                    <h4 style="color:#0f172a;">Helpline Phone</h4>
                    <p style="color:#64748b; font-weight:600; font-size:16px; margin-top:6px;">
                        <a href="tel:<?= $primary_phone ?>" style="color:#10b981;"><?= $primary_phone ?></a>
                    </p>
                </div>

                <div class="msb-hw-card" style="background:#fff; border-color:#e2e8f0; color:#0f172a;">
                    <div class="msb-hw-icon" style="background:#e0f2fe; color:#0369a1;">📍</div>
                    <h4 style="color:#0f172a;">Service Location</h4>
                    <p style="color:#64748b; font-size:14px; margin-top:6px;">
                        <?= htmlspecialchars($business_address) ?>
                    </p>
                </div>

                <div class="msb-hw-card" style="background:#fff; border-color:#e2e8f0; color:#0f172a;">
                    <div class="msb-hw-icon" style="background:#fef3c7; color:#b45309;">💬</div>
                    <h4 style="color:#0f172a;">Direct WhatsApp</h4>
                    <p style="color:#64748b; font-size:14px; margin-top:6px;">
                        <a href="https://wa.me/91<?= $primary_phone ?>" target="_blank" style="color:#25d366; font-weight:700;">Chat with Support &rarr;</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="msb-footer">
        <div class="msb-container">
            <div class="msb-footer-bottom" style="border: none; padding-top: 0;">
                <div>
                    &copy; <?= date('Y') ?> <?= htmlspecialchars($business_name) ?>. All Rights Reserved.
                </div>
                <div>
                    Powered by <a href="<?= base_url() ?>" style="color:#10b981; font-weight:700;">MsbBillings Cloud Engine</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive UPI Modal Dialog -->
    <div class="upi-modal-overlay" id="upiModalOverlay">
        <div class="upi-modal">
            <button class="upi-close" onclick="closeUpiModal()">&times;</button>
            <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 6px;">Pay via UPI QR</h3>
            <p style="font-size: 13px; color: #64748b; margin-bottom: 18px;" id="modalPayDesc">
                Pay to <?= htmlspecialchars($business_name) ?>
            </p>

            <img id="modalQrImg" src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=<?= $primary_phone ?>@upi&pn=<?= urlencode($business_name) ?>&cu=INR" alt="QR" style="margin: 0 auto 16px; border-radius: 12px; border: 1px solid #e2e8f0; padding: 8px;">

            <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                Amount: <span id="modalPayAmount" style="color: #10b981; font-size: 18px;">Enter Amount</span>
            </div>
            <div style="font-size: 12px; color: #64748b; margin-bottom: 20px;">
                UPI ID: <strong><?= $primary_phone ?>@upi</strong>
            </div>

            <a id="btnSendWhatsappProof" href="https://wa.me/91<?= $primary_phone ?>?text=I%20have%20paid%20via%20UPI" target="_blank" class="msb-btn msb-btn-whatsapp" style="width: 100%;">
                Send Screenshot on WhatsApp
            </a>
        </div>
    </div>

    <!-- Interactive JavaScript -->
    <script>
        function openUpiModal() {
            document.getElementById('upiModalOverlay').classList.add('active');
        }
        function closeUpiModal() {
            document.getElementById('upiModalOverlay').classList.remove('active');
        }

        let currentSelectedAmount = 0;
        let currentSelectedPkg = '';

        function selectPackageForPayment(pkgName, rate) {
            currentSelectedPkg = pkgName;
            currentSelectedAmount = rate;
            document.getElementById('modalPayDesc').innerText = 'Package: ' + pkgName;
            document.getElementById('modalPayAmount').innerText = '₹' + rate.toFixed(2);
            
            const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent('upi://pay?pa=<?= $primary_phone ?>@upi&pn=<?= urlencode($business_name) ?>&am=' + rate + '&cu=INR');
            document.getElementById('modalQrImg').src = qrUrl;

            const waText = encodeURIComponent('Hello, I want to pay ₹' + rate + ' for package ' + pkgName);
            document.getElementById('btnSendWhatsappProof').href = 'https://wa.me/91<?= $primary_phone ?>?text=' + waText;

            openUpiModal();
        }

        function openUpiModalWithDetails() {
            if (currentSelectedAmount > 0) {
                selectPackageForPayment(currentSelectedPkg, currentSelectedAmount);
            } else {
                openUpiModal();
            }
        }

        // Live Subscriber Search AJAX
        function searchSubscriber(e) {
            e.preventDefault();
            const query = document.getElementById('subQueryInput').value.trim();
            const btn = document.getElementById('subSearchBtn');
            const resultBox = document.getElementById('subscriberResult');

            if (!query) return;

            btn.disabled = true;
            btn.innerText = 'Searching...';

            const sep = '<?= strpos($ajax_search_url, "?") !== false ? "&" : "?" ?>';
            fetch('<?= $ajax_search_url ?>' + sep + 'query=' + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    btn.disabled = false;
                    btn.innerText = 'Find Account';

                    resultBox.style.display = 'block';

                    if (data.status && data.data) {
                        resultBox.classList.remove('error');
                        document.getElementById('resName').innerText = data.data.name;
                        document.getElementById('resBadge').innerText = data.data.type;
                        document.getElementById('resStb').innerText = data.data.stb || data.data.id;
                        document.getElementById('resAddr').innerText = data.data.address || 'Registered Customer';
                        document.getElementById('resAmount').innerText = '₹' + parseFloat(data.data.package_total).toFixed(2);

                        currentSelectedAmount = parseFloat(data.data.package_total);
                        currentSelectedPkg = data.data.name + ' (' + data.data.stb + ')';
                    } else {
                        resultBox.classList.add('error');
                        document.getElementById('resName').innerText = 'Not Found';
                        document.getElementById('resBadge').innerText = 'Notice';
                        document.getElementById('resStb').innerText = '-';
                        document.getElementById('resAddr').innerText = data.message || 'No subscriber record matched.';
                        document.getElementById('resAmount').innerText = '₹0.00';
                    }
                })
                .catch(err => {
                    btn.disabled = false;
                    btn.innerText = 'Find Account';
                    resultBox.style.display = 'block';
                    resultBox.classList.add('error');
                    document.getElementById('resAddr').innerText = 'Connection error. Please try again.';
                });
        }
    </script>

</body>
</html>
