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

if (!function_exists('sidebar_resolve_icon')) {
    function sidebar_resolve_icon($menu, $level = 1) {
        $rawIcon = isset($menu['menu_icon_class']) ? trim((string)$menu['menu_icon_class']) : '';
        $name = isset($menu['menu_name']) ? strtolower(trim((string)$menu['menu_name'])) : '';
        $link = isset($menu['menu_link']) ? strtolower(trim((string)$menu['menu_link'])) : '';
        $hint = isset($menu['menu_hint']) ? strtolower(trim((string)$menu['menu_hint'])) : '';

        // Check if rawIcon has an explicit modern FontAwesome / Glyphicon class
        $hasFa = (strpos($rawIcon, 'fa-') !== false || strpos($rawIcon, 'fa ') !== false || strpos($rawIcon, 'glyphicon') !== false);

        // Name or link based matching (semantic icon detection)
        if (strpos($name, 'email') !== false || strpos($link, 'email') !== false || strpos($hint, 'email') !== false || strpos($name, 'mail') !== false) {
            if (strpos($name, 'variable') !== false) {
                return 'fa fa-code';
            } elseif ($level > 1 || strpos($name, 'template') !== false) {
                return 'fa fa-envelope-o';
            }
            return 'fa fa-envelope';
        }

        if (strpos($name, 'dashboard') !== false) {
            return 'fa fa-tachometer';
        }

        if (strpos($name, 'billing') !== false || strpos($name, 'invoice') !== false || strpos($link, 'invoice') !== false) {
            return ($level === 1) ? 'fa fa-calculator' : 'fa fa-file-text-o';
        }

        if (strpos($name, 'collection') !== false) {
            return ($level === 1) ? 'fa fa-folder-open' : 'fa fa-money';
        }

        if (strpos($name, 'customer') !== false || strpos($link, 'customer') !== false) {
            return 'fa fa-users';
        }

        if (strpos($name, 'payment') !== false || strpos($link, 'payment') !== false) {
            return 'fa fa-credit-card';
        }

        if (strpos($name, 'report') !== false || strpos($link, 'report') !== false) {
            return 'fa fa-bar-chart';
        }

        if (strpos($name, 'transaction') !== false) {
            return 'fa fa-exchange';
        }

        if (strpos($name, 'expence') !== false || strpos($name, 'expense') !== false) {
            return 'fa fa-calculator';
        }

        if (strpos($name, 'medicine') !== false || strpos($name, 'stock') !== false) {
            return 'fa fa-medkit';
        }

        if (strpos($name, 'purchase') !== false) {
            return 'fa fa-shopping-cart';
        }

        if (strpos($name, 'sale') !== false) {
            return 'fa fa-line-chart';
        }

        if (strpos($name, 'user') !== false || strpos($name, 'management') !== false) {
            return 'fa fa-user';
        }

        if (strpos($name, 'help') !== false) {
            return 'fa fa-question-circle';
        }

        if (strpos($name, 'entry') !== false) {
            return 'fa fa-edit';
        }

        if (strpos($name, 'setting') !== false || strpos($name, 'config') !== false) {
            return 'fa fa-cogs';
        }

        // If explicitly set with a real FontAwesome class:
        if ($hasFa) {
            return $rawIcon;
        }

        // Legacy Charisma class conversion
        if (strpos($rawIcon, 'icon-') !== false || strpos($rawIcon, 'icon ') !== false) {
            if (strpos($rawIcon, 'envelope') !== false || strpos($rawIcon, 'mail') !== false) {
                return 'fa fa-envelope';
            }
            if (strpos($rawIcon, 'calendar') !== false) {
                return 'fa fa-calendar';
            }
            if (strpos($rawIcon, 'document') !== false || strpos($rawIcon, 'file') !== false) {
                return ($level === 1) ? 'fa fa-folder-open-o' : 'fa fa-file-text-o';
            }
            if (strpos($rawIcon, 'edit') !== false || strpos($rawIcon, 'pencil') !== false) {
                return 'fa fa-pencil-square-o';
            }
            if (strpos($rawIcon, 'user') !== false) {
                return 'fa fa-user';
            }
        }

        // Default fallback based on hierarchy level
        return ($level === 1) ? 'fa fa-folder-o' : 'fa fa-circle-o';
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

            $icon = sidebar_resolve_icon($menu, $level);

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

            echo '<i class="' . $safeIcon . '" style="margin-right: 8px; width: 18px; text-align: center; display: inline-block;"></i>';
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