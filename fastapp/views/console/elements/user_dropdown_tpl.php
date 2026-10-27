<?php if ($current_user_session): ?>
<ul class="nav navbar-nav headertopmenu pull-right">
    <!-- Visit Front Site Link -->
    <li>
        <a href="<?= base_url() ?>" target="_blank" title="Visit Front Website" style="color: #fff;">
            <i class="fa fa-globe"></i> <span class="hidden-xs">Front Site</span>
        </a>
    </li>

    <!-- WhatsApp Quick Help -->
    <li>
        <a href="https://wa.me/9189562423934" target="_blank" title="WhatsApp Support" style="color: #fff;">
            <i class="fa fa-whatsapp"></i>
        </a>
    </li>

    <!-- User Account Menu -->
    <li class="dropdown user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 15px 12px; color: #fff;">
            <img src="<?= !empty($current_user_session['user_image']) ? base_url('uploads/'.NODE.'/'.$current_user_session['user_image']) : base_url('assets/backend/dist/img/avatar.png') ?>" class="user-image" alt="User Image" onerror="this.onerror=null; this.src='<?= base_url('assets/backend/dist/img/avatar.png') ?>';" style="width: 26px; height: 26px; border-radius: 50%; object-fit: cover; vertical-align: middle; margin-right: 6px;">
            <span class="hidden-xs"><?= $current_user_session['user_firstname'].' '.$current_user_session['user_lastname'] ?></span>
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-user" style="min-width: 230px; box-shadow: 0 4px 18px rgba(0,0,0,0.15); border-radius: 6px; padding: 10px 0;">
            <li class="user-header text-center" style="padding: 10px 15px 12px; border-bottom: 1px solid #f1f5f9;">
                <p style="margin: 0; font-weight: 700; color: #1e293b; font-size: 15px;">
                    <?= $current_user_session['user_firstname'].' '.$current_user_session['user_lastname'] ?>
                </p>
                <small style="color: #64748b; font-size: 12px; display: block; margin-top: 2px;">
                    <?= !empty($current_user_session['user_email']) ? $current_user_session['user_email'] : 'System Administrator' ?>
                </small>
            </li>
            <li style="padding: 4px 0;"><a href="<?= console_url('user/profile') ?>" style="padding: 8px 18px; color: #334155; font-size: 13px; display: block;"><i class="fa fa-user" style="color: #35aa47; margin-right: 8px;"></i> My Profile</a></li>
            <li style="padding: 4px 0;"><a href="<?= base_url() ?>" target="_blank" style="padding: 8px 18px; color: #334155; font-size: 13px; display: block;"><i class="fa fa-desktop" style="color: #0284c7; margin-right: 8px;"></i> Front Website</a></li>
            <li class="divider" style="margin: 6px 0;"></li>
            <li style="padding: 4px 0;"><a href="<?= console_url('user/logout') ?>" style="padding: 8px 18px; color: #dc2626; font-size: 13px; display: block; font-weight: 600;"><i class="fa fa-sign-out" style="margin-right: 8px;"></i> Logout</a></li>
        </ul>
    </li>
</ul>
<?php endif; ?>