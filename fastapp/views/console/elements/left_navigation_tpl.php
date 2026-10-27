<?php
if ($current_user_session):
    // Organize flat $site_menu into hierarchical tree
    $nav = array();
    if (!empty($site_menu) && is_array($site_menu)) {
        foreach ($site_menu as $menu) {
            if (empty($menu['menu_parent_id'])) {
                $nav[$menu['menu_ID']] = $menu;
            } else {
                $nav[$menu['menu_parent_id']]['child'][$menu['menu_ID']] = $menu;
            }
        }
    }
    $current_segment = $this->uri->segment(2);
?>
<aside class="main-sidebar" id="alert2">
    <section class="sidebar" id="sibe-box">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="padding: 14px 12px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <div class="pull-left image" style="margin-right: 12px;">
                <img src="<?= !empty($current_user_session['user_image']) ? base_url('uploads/'.NODE.'/'.$current_user_session['user_image']) : base_url('assets/backend/dist/img/avatar.png') ?>" class="img-circle" style="width: 42px; height: 42px; object-fit: cover; border-radius: 50%; border: 2px solid #35aa47;" alt="User Image" onerror="this.onerror=null; this.src='<?= base_url('assets/backend/dist/img/avatar.png') ?>';">
            </div>
            <div class="pull-left info">
                <p style="color: #fff; margin: 0; font-weight: 600; font-size: 14px;"><?= $current_user_session['user_firstname'].' '.$current_user_session['user_lastname'] ?></p>
                <a href="#" style="font-size: 11px; color: #a0aec0; text-decoration: none;"><i class="fa fa-circle text-success" style="color: #22c55e; margin-right: 4px;"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Navigation Menu -->
        <ul class="sidebar-menu">
            <li class="header" style="color: #64748b; background: #020617; padding: 12px 18px 8px; font-size: 11px; font-weight: 700; letter-spacing: 0.8px;">MAIN NAVIGATION</li>

            <li class="<?= (empty($current_segment) || $current_segment == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= console_url('dashboard') ?>">
                    <i class="fa fa-dashboard" style="color: #35aa47;"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if (!empty($nav)): ?>
                <?php foreach ($nav as $key => $value): ?>
                    <?php if (empty($value['child'])): ?>
                        <?php 
                            $is_active = ($current_segment == $value['menu_link'] || $this->uri->uri_string() == 'console/'.$value['menu_link']);
                        ?>
                        <li class="<?= $is_active ? 'active' : '' ?>">
                            <a href="<?= console_url($value['menu_link']) ?>" title="<?= isset($value['menu_hint']) ? $value['menu_hint'] : '' ?>">
                                <i class="<?= !empty($value['menu_icon_class']) ? $value['menu_icon_class'] : 'fa fa-circle-o' ?>"></i>
                                <span><?= $value['menu_name'] ?></span>
                            </a>
                        </li>
                    <?php else: ?>
                        <?php
                            $is_parent_active = false;
                            foreach ($value['child'] as $c) {
                                if ($current_segment == $c['menu_link']) {
                                    $is_parent_active = true;
                                    break;
                                }
                            }
                        ?>
                        <li class="treeview <?= $is_parent_active ? 'active' : '' ?>">
                            <a href="javascript:void(0)" title="<?= isset($value['menu_hint']) ? $value['menu_hint'] : '' ?>">
                                <i class="<?= !empty($value['menu_icon_class']) ? $value['menu_icon_class'] : 'fa fa-folder' ?>"></i>
                                <span><?= $value['menu_name'] ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" style="<?= $is_parent_active ? 'display:block;' : 'display:none;' ?>">
                                <?php foreach ($value['child'] as $ckey => $cvalue): ?>
                                    <li class="<?= ($current_segment == $cvalue['menu_link']) ? 'active' : '' ?>">
                                        <a href="<?= console_url($cvalue['menu_link']) ?>" title="<?= isset($cvalue['menu_hint']) ? $cvalue['menu_hint'] : '' ?>">
                                            <i class="<?= !empty($cvalue['menu_icon_class']) ? $cvalue['menu_icon_class'] : 'fa fa-angle-right' ?>"></i>
                                            <?= $cvalue['menu_name'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </section>
</aside>
<?php endif; ?>
