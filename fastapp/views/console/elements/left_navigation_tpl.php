<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Sidebar helpers: unlimited nested menu levels
|--------------------------------------------------------------------------
| Keep the function_exists() guards to prevent redeclaration errors.
*/

if (!function_exists('sidebar_build_tree')) {
    function sidebar_build_tree($siteMenus, $parentId = '')
    {
        $tree = array();

        if (!is_array($siteMenus)) {
            return $tree;
        }

        foreach ($siteMenus as $menu) {
            if (
                !is_array($menu) ||
                !isset($menu['menu_ID']) ||
                !is_scalar($menu['menu_ID'])
            ) {
                continue;
            }

            $menuId = trim((string) $menu['menu_ID']);

            if ($menuId === '') {
                continue;
            }

            $menuParentId = isset($menu['menu_parent_id'])
                && is_scalar($menu['menu_parent_id'])
                ? trim((string) $menu['menu_parent_id'])
                : '';

            if ($menuParentId !== (string) $parentId) {
                continue;
            }

            $menu['_sidebar_id'] = $menuId;
            $menu['child'] = sidebar_build_tree(
                $siteMenus,
                $menuId
            );

            $tree[] = $menu;
        }

        return $tree;
    }
}

if (!function_exists('sidebar_is_active')) {
    function sidebar_is_active(
        $menu,
        $currentSegment,
        $currentUri
    ) {
        $link = isset($menu['menu_link']) &&
            is_scalar($menu['menu_link'])
            ? trim((string) $menu['menu_link'], '/')
            : '';

        if ($link !== '') {
            $link = preg_replace('#^console/#', '', $link);

            if (
                $currentUri === 'console/' . $link ||
                $currentSegment === $link
            ) {
                return true;
            }
        }

        if (!empty($menu['child']) && is_array($menu['child'])) {
            foreach ($menu['child'] as $child) {
                if (
                    sidebar_is_active(
                        $child,
                        $currentSegment,
                        $currentUri
                    )
                ) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (!function_exists('sidebar_render_menus')) {
    function sidebar_render_menus(
        $menus,
        $currentSegment,
        $currentUri,
        $level = 1
    ) {
        if (!is_array($menus) || empty($menus)) {
            return;
        }

        foreach ($menus as $menu) {
            if (!is_array($menu)) {
                continue;
            }

            $name = isset($menu['menu_name'])
                ? (string) $menu['menu_name']
                : 'Menu';

            $hint = isset($menu['menu_hint'])
                ? (string) $menu['menu_hint']
                : $name;

            $icon = isset($menu['menu_icon_class']) &&
                trim((string) $menu['menu_icon_class']) !== ''
                ? (string) $menu['menu_icon_class']
                : 'fa fa-circle-o';

            $link = isset($menu['menu_link']) &&
                is_scalar($menu['menu_link'])
                ? trim((string) $menu['menu_link'])
                : '';

            $link = trim($link, '/');

            // Do not make a clickable URL for a parent with no link.
            $hasChildren = !empty($menu['child']) &&
                is_array($menu['child']);

            $isActive = sidebar_is_active(
                $menu,
                $currentSegment,
                $currentUri
            );

            $safeName = html_escape($name);
            $safeHint = html_escape($hint);
            $safeIcon = html_escape($icon);

            $classes = array();

            if ($hasChildren) {
                $classes[] = 'treeview';
            }

            if ($isActive) {
                $classes[] = 'active';
            }

            $liClass = !empty($classes)
                ? ' class="' . implode(' ', $classes) . '"'
                : '';

            echo '<li' . $liClass . '>';

            if ($link !== '') {
                $url = console_url($link);

                echo '<a href="' . html_escape($url) . '"';
                echo ' title="' . $safeHint . '">';
            } else {
                echo '<a href="javascript:void(0)"';
                echo ' title="' . $safeHint . '">';
            }

            echo '<i class="' . $safeIcon . '"></i>';
            echo '<span>' . $safeName . '</span>';

            if ($hasChildren) {
                echo '<i class="fa fa-angle-left pull-right"></i>';
            }

            echo '</a>';

            if ($hasChildren) {
                $display = $isActive
                    ? 'display:block;'
                    : 'display:none;';

                echo '<ul class="treeview-menu" style="' .
                    $display . '">';

                sidebar_render_menus(
                    $menu['child'],
                    $currentSegment,
                    $currentUri,
                    $level + 1
                );

                echo '</ul>';
            }

            echo '</li>';
        }
    }
}

/*
|--------------------------------------------------------------------------
| Prepare sidebar data
|--------------------------------------------------------------------------
*/

if (
    !empty($current_user_session) &&
    is_array($current_user_session)
) {

    $siteMenus = isset($site_menu) && is_array($site_menu)
        ? $site_menu
        : array();

    // Build the complete hierarchy from the flat menu array.
    $nav = sidebar_build_tree($siteMenus, '');

    $currentSegment = (string) $this->uri->segment(2);
    $currentUri = trim((string) $this->uri->uri_string(), '/');

    $firstName = isset($current_user_session['user_firstname'])
        ? $current_user_session['user_firstname']
        : '';

    $lastName = isset($current_user_session['user_lastname'])
        ? $current_user_session['user_lastname']
        : '';

    $userImage = isset($current_user_session['user_image'])
        ? trim((string) $current_user_session['user_image'])
        : '';

    $avatarUrl = base_url('assets/backend/dist/img/avatar.png');

    if ($userImage !== '') {
        $imageUrl = base_url(
            'uploads/' . NODE . '/' . $userImage
        );
    } else {
        $imageUrl = $avatarUrl;
    }
?>

    <aside class="main-sidebar" id="alert2">
        <section class="sidebar" id="sibe-box">

            <!-- User panel -->
            <div class="user-panel"
                style="padding:14px 12px;border-bottom:1px solid rgba(255,255,255,.08);">

                <div class="pull-left image" style="margin-right:12px;">
                    <img
                        src="<?= html_escape($imageUrl); ?>"
                        class="img-circle"
                        style="width:42px;height:42px;object-fit:cover;border:2px solid #35aa47;"
                        alt="User Image"
                        onerror="this.onerror=null;this.src='<?= html_escape($avatarUrl); ?>';">
                </div>

                <div class="pull-left info">
                    <p style="color:#fff;margin:0;font-weight:600;font-size:14px;">
                        <?= html_escape(trim($firstName . ' ' . $lastName)); ?>
                    </p>

                    <a href="javascript:void(0)"
                        style="font-size:11px;color:#a0aec0;text-decoration:none;">
                        <i class="fa fa-circle text-success"
                            style="color:#22c55e;margin-right:4px;"></i>
                        Online
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="sidebar-menu">

                <li class="header"
                    style="color:#64748b;background:#020617;padding:12px 18px 8px;font-size:11px;font-weight:700;letter-spacing:.8px;">
                    MAIN NAVIGATION
                </li>

                <!-- Dashboard -->
                <li class="<?= (
                                $currentUri === 'console' ||
                                $currentUri === 'console/dashboard' ||
                                $currentSegment === 'dashboard'
                            ) ? 'active' : ''; ?>">
                    <a href="<?= html_escape(console_url('dashboard')); ?>">
                        <i class="fa fa-dashboard" style="color:#35aa47;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Unlimited nested menus -->
                <?php
                sidebar_render_menus(
                    $nav,
                    $currentSegment,
                    $currentUri
                );
                ?>

            </ul>
        </section>
    </aside>

<?php
}
?>