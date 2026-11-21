<?php
/**
 * AdminLTE Smart UI Help & Knowledge Base
 * Interactive Visual Guides, Step-by-Step Manuals & POS Shortcuts
 */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$active_plan = isset($active_plan) ? $active_plan : (defined('NODETYPE') ? NODETYPE : 'medical');
$node_name   = isset($node_name) ? $node_name : (defined('NODE') ? NODE : 'antu');
$help_data   = isset($help_data) && is_array($help_data) ? $help_data : array();

// Helper function to resolve media URL
if (!function_exists('resolve_help_media')) {
    function resolve_help_media($link) {
        if (empty($link)) return '';
        $link = trim($link);
        
        // Handle JSON link
        if (strpos($link, '{') === 0) {
            $json = json_decode($link, true);
            if ($json && !empty($json['filename'])) {
                return base_url('uploads/' . $json['filename']);
            }
            if ($json && !empty($json['thumbnail'])) {
                return $json['thumbnail'];
            }
        }
        
        // Handle external URL
        if (strpos($link, 'http://') === 0 || strpos($link, 'https://') === 0) {
            return $link;
        }
        
        return base_url('uploads/' . ltrim($link, '/'));
    }
}

// Helper to determine guide category and action URL
if (!function_exists('classify_help_guide')) {
    function classify_help_guide($title, $type) {
        $t = strtolower($title);
        
        if (strpos($t, 'sale') !== false || strpos($t, 'bill') !== false || strpos($t, 'invoice') !== false) {
            return [
                'category' => 'billing',
                'badge'    => 'POS & Billing',
                'badge_cls'=> 'label-success',
                'color'    => '#16a34a',
                'icon'     => 'fa-shopping-cart',
                'action_url'=> console_url('sale/add'),
                'action_txt'=> 'New Sale Invoice'
            ];
        }
        if (strpos($t, 'purchase') !== false) {
            return [
                'category' => 'inventory',
                'badge'    => 'Purchases',
                'badge_cls'=> 'label-info',
                'color'    => '#0284c7',
                'icon'     => 'fa-truck',
                'action_url'=> console_url('purchase/add'),
                'action_txt'=> 'New Purchase Entry'
            ];
        }
        if (strpos($t, 'medicine') !== false || strpos($t, 'category') !== false || strpos($t, 'rack') !== false) {
            return [
                'category' => 'inventory',
                'badge'    => 'Medicine & Stock',
                'badge_cls'=> 'label-primary',
                'color'    => '#2563eb',
                'icon'     => 'fa-medkit',
                'action_url'=> (strpos($t, 'category') !== false) ? console_url('medicine_category') : console_url('medicine/add'),
                'action_txt'=> (strpos($t, 'category') !== false) ? 'Medicine Categories' : 'Add Medicine Master'
            ];
        }
        if (strpos($t, 'doctor') !== false) {
            return [
                'category' => 'masters',
                'badge'    => 'Doctors',
                'badge_cls'=> 'label-warning',
                'color'    => '#d97706',
                'icon'     => 'fa-user-md',
                'action_url'=> console_url('doctor/add'),
                'action_txt'=> 'Add Doctor'
            ];
        }
        if (strpos($t, 'customer') !== false || strpos($t, 'patient') !== false) {
            return [
                'category' => 'masters',
                'badge'    => 'Customers / Patients',
                'badge_cls'=> 'label-info',
                'color'    => '#0891b2',
                'icon'     => 'fa-user',
                'action_url'=> console_url('customer/add'),
                'action_txt'=> 'Add Customer'
            ];
        }
        if (strpos($t, 'supplier') !== false) {
            return [
                'category' => 'masters',
                'badge'    => 'Suppliers',
                'badge_cls'=> 'label-primary',
                'color'    => '#4f46e5',
                'icon'     => 'fa-building',
                'action_url'=> console_url('supplier/add'),
                'action_txt'=> 'Add Supplier'
            ];
        }
        if (strpos($t, 'manufacturer') !== false) {
            return [
                'category' => 'masters',
                'badge'    => 'Manufacturers',
                'badge_cls'=> 'label-default',
                'color'    => '#64748b',
                'icon'     => 'fa-flask',
                'action_url'=> console_url('manufacturer/add'),
                'action_txt'=> 'Add Manufacturer'
            ];
        }
        if (strpos($t, 'payment') !== false || strpos($t, 'collection') !== false) {
            return [
                'category' => 'billing',
                'badge'    => 'Payments & Ledger',
                'badge_cls'=> 'label-success',
                'color'    => '#059669',
                'icon'     => 'fa-money',
                'action_url'=> console_url('payments'),
                'action_txt'=> 'Payments Ledger'
            ];
        }
        if (strpos($t, 'dashboard') !== false || strpos($t, 'report') !== false) {
            return [
                'category' => 'overview',
                'badge'    => 'Analytics & Reports',
                'badge_cls'=> 'label-danger',
                'color'    => '#dc2626',
                'icon'     => 'fa-line-chart',
                'action_url'=> console_url('dashboard'),
                'action_txt'=> 'Dashboard'
            ];
        }
        
        return [
            'category' => 'general',
            'badge'    => ucfirst($type),
            'badge_cls'=> 'label-default',
            'color'    => '#475569',
            'icon'     => 'fa-book',
            'action_url'=> '',
            'action_txt'=> ''
        ];
    }
}

// Filter relevant guides: prioritize active plan
$current_plan_guides = array();
$other_guides = array();

foreach ($help_data as $h) {
    if ($h['help_type'] === $active_plan) {
        $current_plan_guides[] = $h;
    } else {
        $other_guides[] = $h;
    }
}

// If active plan has guides, show them first, else show all
$active_guides = !empty($current_plan_guides) ? $current_plan_guides : $help_data;
$total_active_guides = count($active_guides);
?>

<style>
/* Smart UI Knowledge Base & Help Center Styling */
.help-wrapper {
    margin-bottom: 30px;
}
.report-header-card {
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    margin-bottom: 16px;
    border: 1px solid #e2e8f0;
    padding: 14px 18px;
}
.report-title {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #0f172a;
    margin: 0 0 4px 0 !important;
    display: flex;
    align-items: center;
    gap: 8px;
}
.kpi-card {
    background: #fff;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    padding: 12px 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    transition: transform 0.2s, box-shadow 0.2s;
}
.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.kpi-icon {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-right: 12px;
    flex-shrink: 0;
}
.kpi-title {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}
.kpi-value {
    font-size: 17px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
}

/* Filter & Search Bar */
.help-filter-bar {
    background: #f8fafc;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    padding: 12px 16px;
    margin-bottom: 16px;
}
.category-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fff;
    border: 1px solid #cbd5e1;
    color: #334155;
    padding: 4px 12px;
    border-radius: 14px;
    font-size: 11.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
    margin-right: 5px;
    margin-bottom: 4px;
}
.category-tab-btn:hover {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #2563eb;
    transform: translateY(-1px);
}
.category-tab-btn.active {
    background: #2563eb;
    border-color: #1d4ed8;
    color: #fff;
}
.category-tab-btn .badge {
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    background: #e2e8f0;
    color: #334155;
}
.category-tab-btn.active .badge {
    background: rgba(255, 255, 255, 0.25);
    color: #fff;
}

/* Guide Cards */
.guide-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    margin-bottom: 14px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    overflow: hidden;
    transition: box-shadow 0.2s, border-color 0.2s;
}
.guide-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    border-color: #cbd5e1;
}
.guide-card-header {
    background: #fff;
    padding: 12px 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    user-select: none;
    transition: background-color 0.15s;
    border-left: 4px solid #3b82f6;
}
.guide-card-header:hover {
    background: #f8fafc;
}
.guide-title-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 260px;
}
.guide-title {
    font-size: 13.5px !important;
    font-weight: 700 !important;
    color: #0f172a;
    margin: 0 !important;
    line-height: 1.4;
}
.guide-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}
.guide-card-body {
    padding: 16px;
    background: #fff;
    border-top: 1px solid #f1f5f9;
}
.guide-desc-text {
    font-size: 12.5px;
    line-height: 1.6;
    color: #334155;
    margin-bottom: 14px;
    background: #f8fafc;
    padding: 10px 14px;
    border-radius: 6px;
    border-left: 3px solid #3b82f6;
}
.guide-media-frame {
    position: relative;
    background: #0f172a;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    text-align: center;
}
.guide-media-img {
    max-width: 100%;
    height: auto;
    display: inline-block;
    vertical-align: middle;
    cursor: zoom-in;
    transition: opacity 0.2s;
}
.guide-media-overlay {
    position: absolute;
    bottom: 8px;
    right: 8px;
    display: flex;
    gap: 6px;
    z-index: 10;
}
.guide-media-btn {
    background: rgba(15, 23, 42, 0.75);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 3px 8px;
    font-size: 11px;
    border-radius: 4px;
    backdrop-filter: blur(2px);
    transition: background 0.15s;
    text-decoration: none !important;
}
.guide-media-btn:hover {
    background: rgba(15, 23, 42, 0.95);
    color: #38bdf8;
}

/* Bottom Pagination & Footer Bar (niche paginate used) */
#help_pagination_container {
    padding: 12px 16px;
    background: #fafbfc;
    border-top: 1px solid #e2e8f0;
    border-radius: 0 0 6px 6px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

/* Modal Styling */
.modal-header-custom {
    background: #0f172a;
    color: #fff;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    padding: 12px 18px;
}
.modal-header-custom .modal-title {
    color: #fff !important;
    font-weight: 700;
    font-size: 14px;
}
.modal-header-custom .close {
    color: #fff;
    opacity: 0.8;
}
.modal-header-custom .close:hover {
    opacity: 1;
}
</style>

<div class="help-wrapper">
    <!-- Top Header Card -->
    <div class="report-header-card">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 class="report-title">
                    <i class="fa fa-question-circle text-primary"></i> Help &amp; Knowledge Base
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Interactive animated tutorials, step-by-step operational manuals, and POS keyboard shortcuts for pharmacy management.
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                <button type="button" class="btn btn-default btn-sm" id="btn_toggle_all" style="font-weight: 600; border-radius: 4px; border-color: #cbd5e1;">
                    <i class="fa fa-expand"></i> <span id="toggle_all_text">Expand All</span>
                </button>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#keyboardShortcutsModal" style="font-weight: 600; border-radius: 4px;">
                    <i class="fa fa-keyboard-o"></i> POS Shortcuts
                </button>
                <a href="#support_desk_section" class="btn btn-success btn-sm" style="font-weight: 600; border-radius: 4px;">
                    <i class="fa fa-phone"></i> Support Desk
                </a>
            </div>
        </div>
    </div>

    <!-- Quick KPI Stats Cards -->
    <div class="row" style="margin-left: -6px; margin-right: -6px;">
        <!-- Card 1: Total Guides -->
        <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
            <div class="kpi-card" style="border-left: 4px solid #3b82f6;">
                <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                    <i class="fa fa-book"></i>
                </div>
                <div>
                    <div class="kpi-title">Active Tutorials</div>
                    <div class="kpi-value" id="kpi_total_guides"><?= $total_active_guides ?> Guides</div>
                </div>
            </div>
        </div>

        <!-- Card 2: Plan & Node -->
        <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
            <div class="kpi-card" style="border-left: 4px solid #10b981;">
                <div class="kpi-icon" style="background: #ecfdf5; color: #059669;">
                    <i class="fa fa-heartbeat"></i>
                </div>
                <div>
                    <div class="kpi-title">System Module</div>
                    <div class="kpi-value" style="font-size: 15px; text-transform: capitalize;">
                        <?= htmlspecialchars($active_plan) ?> <small style="font-size: 11px; color: #64748b;">(<?= htmlspecialchars($node_name) ?>)</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Visual Animations -->
        <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
            <div class="kpi-card" style="border-left: 4px solid #f59e0b;">
                <div class="kpi-icon" style="background: #fffbeb; color: #d97706;">
                    <i class="fa fa-play-circle"></i>
                </div>
                <div>
                    <div class="kpi-title">Interactive Media</div>
                    <div class="kpi-value" style="font-size: 15px;">Step-by-Step GIFs</div>
                </div>
            </div>
        </div>

        <!-- Card 4: Support Status -->
        <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px;">
            <div class="kpi-card" style="border-left: 4px solid #8b5cf6;">
                <div class="kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
                    <i class="fa fa-headset fa-headphones"></i>
                </div>
                <div>
                    <div class="kpi-title">Helpdesk Hotline</div>
                    <div class="kpi-value" style="font-size: 14px; color: #4338ca;">Mon-Sat 10am-8pm</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Live Search Bar -->
    <div class="help-filter-bar">
        <div class="row" style="margin-left: -6px; margin-right: -6px;">
            <!-- Live Search Input -->
            <div class="col-md-5 col-sm-12" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;">
                        <i class="fa fa-search text-muted"></i>
                    </span>
                    <input type="text" id="helpSearchInput" class="form-control" placeholder="Search guides by title, module or keywords (e.g. sale, medicine, purchase)..." style="border-color: #cbd5e1; font-weight: 500;">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="btn_clear_search" title="Clear Search" style="border-color: #cbd5e1;">
                            <i class="fa fa-times text-muted"></i>
                        </button>
                    </span>
                </div>
            </div>

            <!-- Per-Page Selector at Top -->
            <div class="col-md-2 col-sm-4" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                <div class="input-group input-group-sm" style="width: 100%;">
                    <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1; font-size: 11px; font-weight: 600;">Show:</span>
                    <select id="helpPerPageSelect" class="form-control" style="border-color: #cbd5e1; font-weight: 600;">
                        <option value="6" selected>6 per page</option>
                        <option value="12">12 per page</option>
                        <option value="24">24 per page</option>
                        <option value="all">All guides</option>
                    </select>
                </div>
            </div>

            <!-- Category Filter Pills -->
            <div class="col-md-5 col-sm-8" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 4px; justify-content: flex-end;">
                    <button type="button" class="category-tab-btn active" data-category="all">
                        All <span class="badge" id="badge_cat_all"><?= $total_active_guides ?></span>
                    </button>
                    <button type="button" class="category-tab-btn" data-category="billing">
                        Billing <span class="badge" id="badge_cat_billing">0</span>
                    </button>
                    <button type="button" class="category-tab-btn" data-category="inventory">
                        Stock <span class="badge" id="badge_cat_inventory">0</span>
                    </button>
                    <button type="button" class="category-tab-btn" data-category="masters">
                        Masters <span class="badge" id="badge_cat_masters">0</span>
                    </button>
                    <button type="button" class="category-tab-btn" data-category="overview">
                        Dashboard <span class="badge" id="badge_cat_overview">0</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Guides Container -->
    <div id="guides_list_container">
        <?php if (!empty($active_guides)): ?>
            <?php foreach ($active_guides as $index => $item): 
                $info = classify_help_guide($item['help_title'], $item['help_type']);
                $media_url = resolve_help_media($item['link']);
                $has_media = !empty($media_url);
                $guide_id = 'guide_' . $item['help_id'];
            ?>
                <div class="guide-card" 
                     id="<?= $guide_id ?>"
                     data-id="<?= $item['help_id'] ?>"
                     data-category="<?= $info['category'] ?>"
                     data-title="<?= strtolower(htmlspecialchars($item['help_title'])) ?>"
                     data-desc="<?= strtolower(htmlspecialchars($item['help_description'])) ?>"
                     data-index="<?= $index ?>">
                    
                    <!-- Guide Header -->
                    <div class="guide-card-header" style="border-left-color: <?= $info['color'] ?>;" onclick="toggleGuide('<?= $guide_id ?>')">
                        <div class="guide-title-wrap">
                            <span class="label <?= $info['badge_cls'] ?>" style="font-size: 10.5px; padding: 3px 8px; border-radius: 4px;">
                                <i class="fa <?= $info['icon'] ?>"></i> <?= $info['badge'] ?>
                            </span>
                            <h3 class="guide-title">
                                <?= htmlspecialchars(trim($item['help_title'])) ?>
                            </h3>
                            <?php if ($has_media): ?>
                                <span class="label label-default" style="font-size: 9.5px; background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                                    <i class="fa fa-file-video-o"></i> GIF Tutorial
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="guide-actions" onclick="event.stopPropagation();">
                            <?php if (!empty($info['action_url'])): ?>
                                <a href="<?= $info['action_url'] ?>" target="_blank" class="btn btn-xs btn-default" style="font-weight: 600; border-color: #cbd5e1; color: #0f172a;" title="Open feature in new tab">
                                    <i class="fa fa-external-link text-primary"></i> <?= $info['action_txt'] ?>
                                </a>
                            <?php endif; ?>

                            <button type="button" class="btn btn-xs btn-default btn-guide-chevron" style="border-radius: 50%; width: 24px; height: 24px; padding: 0; line-height: 22px; border-color: #cbd5e1;" onclick="toggleGuide('<?= $guide_id ?>')">
                                <i class="fa fa-chevron-down text-muted" id="<?= $guide_id ?>_chevron"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Guide Body (Collapsible) -->
                    <div class="guide-card-body" id="<?= $guide_id ?>_body" style="display: <?= ($index === 0) ? 'block' : 'none' ?>;">
                        <?php if (!empty($item['help_description'])): ?>
                            <div class="guide-desc-text" style="border-left-color: <?= $info['color'] ?>;">
                                <i class="fa fa-info-circle text-primary" style="margin-right: 4px;"></i>
                                <?= nl2br(htmlspecialchars($item['help_description'])) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($has_media): ?>
                            <div class="guide-media-frame">
                                <img src="<?= $media_url ?>" 
                                     alt="<?= htmlspecialchars($item['help_title']) ?>" 
                                     class="guide-media-img" 
                                     loading="lazy"
                                     onclick="openMediaModal('<?= $media_url ?>', '<?= addslashes(htmlspecialchars(trim($item['help_title']))) ?>')"
                                     title="Click to view full size" />
                                
                                <div class="guide-media-overlay">
                                    <button type="button" class="guide-media-btn" onclick="openMediaModal('<?= $media_url ?>', '<?= addslashes(htmlspecialchars(trim($item['help_title']))) ?>')">
                                        <i class="fa fa-search-plus"></i> Zoom
                                    </button>
                                    <a href="<?= $media_url ?>" target="_blank" download class="guide-media-btn">
                                        <i class="fa fa-download"></i> Open Raw
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info" style="margin: 0; font-size: 12px; background: #f0f9ff; border-color: #bae6fd; color: #0369a1;">
                                <i class="fa fa-info-circle"></i> Visual walkthrough animation is being generated for this topic. Please follow the instructions above.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="well text-center" style="background: #fff; border-color: #e2e8f0; padding: 40px 20px;">
                <i class="fa fa-question-circle text-muted" style="font-size: 48px; margin-bottom: 12px;"></i>
                <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">No Help Guides Found</h4>
                <p style="color: #64748b; font-size: 13px;">No documentation guides are currently configured for this module.</p>
            </div>
        <?php endif; ?>

        <!-- Empty search results placeholder -->
        <div id="no_search_results" style="display: none;" class="well text-center">
            <i class="fa fa-search text-muted" style="font-size: 40px; margin-bottom: 12px;"></i>
            <h4 style="font-weight: 700; color: #1e293b; margin-bottom: 6px;">No Matching Guides Found</h4>
            <p style="color: #64748b; font-size: 13px;">No guides match your current search query or category filter.</p>
            <button type="button" class="btn btn-sm btn-primary" onclick="resetHelpFilters()">
                <i class="fa fa-refresh"></i> Reset All Filters
            </button>
        </div>
    </div>

    <!-- Bottom Pagination & Controls Footer Bar (niche paginate used) -->
    <div id="help_pagination_container" class="no-print">
        <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
            <div id="help_records_info" style="font-size: 12px; color: #64748b; font-weight: 500;">
                Showing <strong style="color: #0f172a;" id="help_start_rec">1</strong> to <strong style="color: #0f172a;" id="help_end_rec">6</strong> of <strong style="color: #0f172a;" id="help_total_rec"><?= $total_active_guides ?></strong> guides
                <span id="help_page_info" style="color: #94a3b8; margin-left: 4px;">(Page <strong style="color: #0f172a;" id="help_cur_page">1</strong> of <strong id="help_tot_pages">2</strong>)</span>
            </div>

            <!-- Per-Page Selector at Bottom -->
            <div style="display: inline-flex; align-items: center; gap: 6px;">
                <label style="font-size: 11px; color: #64748b; margin: 0; font-weight: 600;">Show:</label>
                <select id="bottomHelpPerPageSelect" class="form-control input-sm" style="width: 90px; height: 28px; padding: 2px 6px; font-size: 12px; border-radius: 4px; border-color: #cbd5e1; display: inline-block;">
                    <option value="6" selected>6</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="all">All</option>
                </select>
            </div>
        </div>

        <div>
            <ul class="pagination pagination-sm" id="help_pagination_ul" style="margin: 0;">
                <!-- Populated dynamically via JS -->
            </ul>
        </div>
    </div>

    <!-- Support Desk & System Diagnostics Card -->
    <div id="support_desk_section" class="report-header-card" style="margin-top: 20px; background: #f8fafc; border: 1px solid #e2e8f0;">
        <div class="row">
            <div class="col-md-7">
                <h4 style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 6px;">
                    <i class="fa fa-life-ring text-primary"></i> Need Immediate Assistance?
                </h4>
                <p style="font-size: 12px; color: #475569; margin-bottom: 12px;">
                    Our specialized technical support desk is available to assist you with pharmacy setup, printer configuration, GST tax filings, or data migration.
                </p>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="tel:917001479802" class="btn btn-sm btn-default" style="border-color: #cbd5e1; font-weight: 600; color: #0f172a;">
                        <i class="fa fa-phone text-success"></i> +91 70014 79802
                    </a>
                    <a href="https://wa.me/917001479802?text=Hello%20Support,%20I%20need%20help%20with%20my%20Medical%20Billing%20Software" target="_blank" class="btn btn-sm btn-success" style="font-weight: 600;">
                        <i class="fa fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                    <a href="mailto:support@msbbillings.in" class="btn btn-sm btn-default" style="border-color: #cbd5e1; font-weight: 600; color: #0f172a;">
                        <i class="fa fa-envelope text-info"></i> support@msbbillings.in
                    </a>
                </div>
            </div>
            <div class="col-md-5" style="border-left: 1px solid #e2e8f0;">
                <h5 style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-top: 0; margin-bottom: 8px;">
                    <i class="fa fa-server text-muted"></i> System Environment
                </h5>
                <ul class="list-unstyled" style="font-size: 11.5px; color: #475569; margin: 0; line-height: 1.8;">
                    <li><strong>Account Node:</strong> <?= htmlspecialchars($node_name) ?></li>
                    <li><strong>License Plan:</strong> <?= htmlspecialchars(strtoupper($active_plan)) ?></li>
                    <li><strong>Cloud Platform:</strong> AdminLTE 2.4 / Smart POS v2.0</li>
                    <li><strong>Database Engine:</strong> MySQL 5.7 / 8.0 with InnoDB</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal: POS Keyboard Shortcuts Cheatsheet -->
<div class="modal fade" id="keyboardShortcutsModal" tabindex="-1" role="dialog" aria-labelledby="shortcutsModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 6px; overflow: hidden; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div class="modal-header modal-header-custom">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="shortcutsModalLabel">
                    <i class="fa fa-keyboard-o"></i> Fast POS Billing Keyboard Shortcuts
                </h4>
            </div>
            <div class="modal-body" style="padding: 16px;">
                <p style="font-size: 12px; color: #64748b; margin-bottom: 12px;">
                    Use these fast keyboard shortcuts on the retail billing counter for lightning-speed medicine sales:
                </p>
                <table class="table table-bordered table-striped" style="margin-bottom: 0; font-size: 12px;">
                    <thead>
                        <tr style="background: #f1f5f9;">
                            <th style="width: 35%; color: #1e40af;">Shortcut Key</th>
                            <th style="color: #1e40af;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">F1</kbd></td>
                            <td><strong>Focus Medicine Search / Barcode</strong> - Jump cursor to search input</td>
                        </tr>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">F2</kbd></td>
                            <td><strong>New Invoice</strong> - Reset form and start a fresh customer bill</td>
                        </tr>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">F4</kbd></td>
                            <td><strong>Select Customer / Patient</strong> - Quick select regular patient</td>
                        </tr>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">Alt + S</kbd></td>
                            <td><strong>Save &amp; Print Bill</strong> - Finalize invoice and trigger printer</td>
                        </tr>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">Alt + P</kbd></td>
                            <td><strong>Reprint Last Invoice</strong> - Quick duplicate print</td>
                        </tr>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">Enter</kbd></td>
                            <td><strong>Add Line Item</strong> - Confirm medicine batch and add to bill</td>
                        </tr>
                        <tr>
                            <td><kbd style="background: #0f172a; padding: 3px 6px;">Esc</kbd></td>
                            <td><strong>Cancel / Close</strong> - Dismiss dialog or cancel input</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="padding: 10px 16px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-weight: 600;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: High-Definition Media Zoom Viewer -->
<div class="modal fade" id="helpMediaModal" tabindex="-1" role="dialog" aria-labelledby="helpMediaModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="width: 90%; max-width: 1200px;">
        <div class="modal-content" style="border-radius: 6px; overflow: hidden; border: none; box-shadow: 0 10px 35px rgba(0,0,0,0.3);">
            <div class="modal-header modal-header-custom" style="display: flex; align-items: center; justify-content: space-between;">
                <h4 class="modal-title" id="helpMediaModalLabel">
                    <i class="fa fa-play-circle"></i> Visual Tutorial Walkthrough
                </h4>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <a href="#" id="modal_raw_link" target="_blank" class="btn btn-xs btn-primary" style="font-weight: 600;">
                        <i class="fa fa-external-link"></i> Full Resolution
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff; margin-top: -2px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body" style="padding: 0; background: #0b0f19; text-align: center; min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <img src="" id="modal_media_img" alt="Tutorial Preview" style="max-width: 100%; max-height: 80vh; object-fit: contain; box-shadow: 0 4px 20px rgba(0,0,0,0.5);" />
            </div>
            <div class="modal-footer" style="padding: 8px 16px; background: #0f172a; border-top: 1px solid #1e293b; color: #94a3b8; font-size: 11.5px; display: flex; justify-content: space-between; align-items: center;">
                <span id="modal_guide_subtitle">Use keyboard Escape key to close.</span>
                <button type="button" class="btn btn-default btn-xs" data-dismiss="modal" style="font-weight: 600;">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Smart UI Knowledge Base Engine -->
<script>
var helpState = {
    category: 'all',
    search: '',
    page: 1,
    perPage: 6,
    totalRecords: 0,
    filteredCards: []
};

// Toggle single guide collapse
function toggleGuide(guideId) {
    var $body = $('#' + guideId + '_body');
    var $chevron = $('#' + guideId + '_chevron');
    
    if ($body.is(':visible')) {
        $body.slideUp(180);
        $chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
    } else {
        $body.slideDown(180);
        $chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }
}

// Open Media Preview Modal
function openMediaModal(url, title) {
    $('#modal_media_img').attr('src', url);
    $('#modal_raw_link').attr('href', url);
    $('#helpMediaModalLabel').html('<i class="fa fa-play-circle text-primary"></i> ' + title);
    $('#modal_guide_subtitle').text('Animated Tutorial Walkthrough for: ' + title);
    $('#helpMediaModal').modal('show');
}

// Reset all filters
function resetHelpFilters() {
    $('#helpSearchInput').val('');
    helpState.search = '';
    helpState.category = 'all';
    $('.category-tab-btn').removeClass('active');
    $('.category-tab-btn[data-category="all"]').addClass('active');
    helpState.page = 1;
    applyHelpFilters();
}

// Update category badges count
function updateCategoryBadges() {
    var counts = { all: 0, billing: 0, inventory: 0, masters: 0, overview: 0 };
    $('.guide-card').each(function() {
        var cat = $(this).data('category');
        counts.all++;
        if (counts[cat] !== undefined) {
            counts[cat]++;
        }
    });
    $('#badge_cat_all').text(counts.all);
    $('#badge_cat_billing').text(counts.billing);
    $('#badge_cat_inventory').text(counts.inventory);
    $('#badge_cat_masters').text(counts.masters);
    $('#badge_cat_overview').text(counts.overview);
}

// Filter and paginate guides
function applyHelpFilters() {
    var cat = helpState.category;
    var search = helpState.search.trim().toLowerCase();
    var matchedCards = [];

    $('.guide-card').each(function() {
        var $card = $(this);
        var cardCat = $card.data('category');
        var cardTitle = String($card.data('title') || '');
        var cardDesc = String($card.data('desc') || '');

        var matchesCat = (cat === 'all' || cardCat === cat);
        var matchesSearch = (search === '' || cardTitle.indexOf(search) !== -1 || cardDesc.indexOf(search) !== -1);

        if (matchesCat && matchesSearch) {
            matchedCards.push($card);
        } else {
            $card.hide();
        }
    });

    helpState.filteredCards = matchedCards;
    helpState.totalRecords = matchedCards.length;

    if (matchedCards.length === 0) {
        $('#no_search_results').show();
        $('#help_pagination_container').hide();
        return;
    }

    $('#no_search_results').hide();
    $('#help_pagination_container').show();

    // Calculate pagination
    var perPage = (helpState.perPage === 'all') ? matchedCards.length : parseInt(helpState.perPage, 10);
    var totalPages = Math.max(1, Math.ceil(matchedCards.length / perPage));

    if (helpState.page > totalPages) {
        helpState.page = totalPages;
    }
    if (helpState.page < 1) {
        helpState.page = 1;
    }

    var startIdx = (helpState.page - 1) * perPage;
    var endIdx = (helpState.perPage === 'all') ? matchedCards.length : Math.min(startIdx + perPage, matchedCards.length);

    // Show/hide cards according to page slice
    for (var i = 0; i < matchedCards.length; i++) {
        if (i >= startIdx && i < endIdx) {
            matchedCards[i].show();
        } else {
            matchedCards[i].hide();
        }
    }

    // Update bottom pagination text & records counter
    $('#help_start_rec').text(matchedCards.length > 0 ? (startIdx + 1) : 0);
    $('#help_end_rec').text(endIdx);
    $('#help_total_rec').text(matchedCards.length);
    $('#help_cur_page').text(helpState.page);
    $('#help_tot_pages').text(totalPages);

    if (totalPages <= 1) {
        $('#help_page_info').hide();
    } else {
        $('#help_page_info').show();
    }

    // Render pagination buttons
    renderPaginationButtons(helpState.page, totalPages);
}

// Render bottom pagination buttons (niche paginate used)
function renderPaginationButtons(curPage, totalPages) {
    var $ul = $('#help_pagination_ul');
    $ul.empty();

    if (totalPages <= 1) {
        return;
    }

    // First button
    var firstCls = (curPage <= 1) ? 'disabled' : '';
    $ul.append('<li class="' + firstCls + '"><a href="#" class="help-page-btn" data-page="1" title="First Page">&laquo; First</a></li>');

    // Prev button
    var prevCls = (curPage <= 1) ? 'disabled' : '';
    $ul.append('<li class="' + prevCls + '"><a href="#" class="help-page-btn" data-page="' + Math.max(1, curPage - 1) + '" title="Previous Page">&lsaquo; Prev</a></li>');

    // Numbered pages with window
    var range = 2;
    var startP = Math.max(1, curPage - range);
    var endP = Math.min(totalPages, curPage + range);

    if (startP > 1) {
        $ul.append('<li><a href="#" class="help-page-btn" data-page="1">1</a></li>');
        if (startP > 2) {
            $ul.append('<li class="disabled"><span>...</span></li>');
        }
    }

    for (var p = startP; p <= endP; p++) {
        var activeCls = (p === curPage) ? 'active' : '';
        $ul.append('<li class="' + activeCls + '"><a href="#" class="help-page-btn" data-page="' + p + '">' + p + '</a></li>');
    }

    if (endP < totalPages) {
        if (endP < totalPages - 1) {
            $ul.append('<li class="disabled"><span>...</span></li>');
        }
        $ul.append('<li><a href="#" class="help-page-btn" data-page="' + totalPages + '">' + totalPages + '</a></li>');
    }

    // Next button
    var nextCls = (curPage >= totalPages) ? 'disabled' : '';
    $ul.append('<li class="' + nextCls + '"><a href="#" class="help-page-btn" data-page="' + Math.min(totalPages, curPage + 1) + '" title="Next Page">Next &rsaquo;</a></li>');

    // Last button
    var lastCls = (curPage >= totalPages) ? 'disabled' : '';
    $ul.append('<li class="' + lastCls + '"><a href="#" class="help-page-btn" data-page="' + totalPages + '" title="Last Page">Last &raquo;</a></li>');
}

$(document).ready(function() {
    updateCategoryBadges();
    applyHelpFilters();

    // Live search typing with debouncing
    var searchTimer = null;
    $('#helpSearchInput').on('keyup input', function() {
        var val = $(this).val();
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            helpState.search = val;
            helpState.page = 1;
            applyHelpFilters();
        }, 150);
    });

    // Clear search button
    $('#btn_clear_search').on('click', function() {
        $('#helpSearchInput').val('');
        helpState.search = '';
        helpState.page = 1;
        applyHelpFilters();
    });

    // Category pill click
    $('.category-tab-btn').on('click', function(e) {
        e.preventDefault();
        $('.category-tab-btn').removeClass('active');
        $(this).addClass('active');
        helpState.category = $(this).data('category');
        helpState.page = 1;
        applyHelpFilters();
    });

    // Synchronized Per-Page selectors (Top & Bottom)
    $('#helpPerPageSelect, #bottomHelpPerPageSelect').on('change', function() {
        var val = $(this).val();
        $('#helpPerPageSelect').val(val);
        $('#bottomHelpPerPageSelect').val(val);
        helpState.perPage = val;
        helpState.page = 1;
        applyHelpFilters();
    });

    // Pagination button delegation
    $(document).on('click', '.help-page-btn', function(e) {
        e.preventDefault();
        var targetPage = parseInt($(this).data('page'), 10);
        if (!isNaN(targetPage) && targetPage > 0 && targetPage !== helpState.page) {
            helpState.page = targetPage;
            applyHelpFilters();
            // Smooth scroll to top of guides
            $('html, body').animate({
                scrollTop: $('.help-filter-bar').offset().top - 20
            }, 200);
        }
    });

    // Toggle All (Expand / Collapse All)
    var allExpanded = false;
    $('#btn_toggle_all').on('click', function() {
        allExpanded = !allExpanded;
        if (allExpanded) {
            $('.guide-card:visible .guide-card-body').slideDown(180);
            $('.guide-card:visible .btn-guide-chevron i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            $('#toggle_all_text').text('Collapse All');
            $(this).find('i').removeClass('fa-expand').addClass('fa-compress');
        } else {
            $('.guide-card:visible .guide-card-body').slideUp(180);
            $('.guide-card:visible .btn-guide-chevron i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $('#toggle_all_text').text('Expand All');
            $(this).find('i').removeClass('fa-compress').addClass('fa-expand');
        }
    });
});
</script>
