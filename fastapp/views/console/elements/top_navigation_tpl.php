<!--<div class="top-nav nav-collapse">
    <ul class="nav">
        <li><a target="_blank" href="<?= base_url() ?>">Visit Site</a></li>
    <li><a target="_blank" href="http://support.logicmystery.com">Support</a></li>
        <li>
            <form class="navbar-search pull-left">
                <input placeholder="Search" class="search-query span2" name="query" type="text">
            </form>
        </li>
    </ul>
</div>-->
<div class="top-nav nav-collapse">
<? 
$nav = null;
//pr($site_menu,1);
function buildTree(array $elements, $parentId = "") {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['menu_parent_id'] == $parentId) {
            $children = buildTree($elements, $element['menu_ID']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}
$nav = buildTree($site_menu);


function generate_html_menus($nav){
?>

<? if (is_array($nav)){ ?>
<ul class=" <? if($nav[0][menu_parent_id]==""){ echo 'nav navbar-nav';}else { echo 'dropdown-menu';}?>">
	<? foreach ($nav as  $value){ ?>
		<? if (empty($value['children'])){ ?>
			<li>
				<a  title="<?=isset($value['menu_hint'])?$value['menu_hint']:''?>" href="<?= console_url($value['menu_link']) ?>"> 
				<i class="<?= $value['menu_icon_class'] ?>"></i> 
				<?= $value['menu_name'] ?>
				</a>
			</li>
		<? } else {?>
		
<li  class="dropdown"><a class="ajax-link dropdown-toggle" data-toggle="dropdown"  href="#"  title="<?=isset($value['menu_hint'])?$value['menu_hint']:''?>"> <i class="<?= $value['menu_icon_class'] ?>"></i> <?= $value['menu_name'] ?><i class="icon-chevron-down"></i></a>
<? generate_html_menus($value['children']); ?>
</li>
		 <?} ?>
	<? } ?>
</ul>
<?}?>

<?
}

if ($current_user_session): ?>
<? generate_html_menus($nav);?>
<? endif; ?>

</div>

<style>
.show-on-hover:hover > ul.dropdown-menu {
    display: block;    
}.open > .dropdown-menu {
    display: block;
    text-align: left;
}
.dropdown >.dropdown-menu {
    display: none;
}
.dropdown.open > .dropdown-menu {
    display: block;
    text-align: left;
}

.navbar .btn-group .btn{
    padding: 12px;
}
@media only screen and (max-width: 500px)
        and (orientation: portrait)
        {
           .top-nav.nav-collapse.in.collapse {
    height: auto!important;
}
.top-nav.nav-collapse.collapse {
    height: 0;
} 
        }
        
         @media only screen and (max-width: 767px)and (min-device-width: 501px)
        and (orientation: landscape)
        {
               .top-nav.nav-collapse.in.collapse {
    height: auto!important;
}
.top-nav.nav-collapse.collapse {
    height: 0;
} 
        }
        
        @media only screen and (max-width: 360px)
        and (orientation: portrait)
        {
             .top-nav.nav-collapse.in.collapse {
    height: auto!important;
}
.top-nav.nav-collapse.collapse {
    height: 0;
} 
        }
        
        @media only screen and (max-width: 640px)and (min-device-width: 361px) 
        and (orientation: landscape)
        {
              .top-nav.nav-collapse.in.collapse {
    height: auto!important;
}
.top-nav.nav-collapse.collapse {
    height: 0;
} 
        }
/*******************submenu************************/
.dropdown-submenu{position:relative;}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
/*.dropdown-submenu:hover>.dropdown-menu{display:block;}*/
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#cccccc;margin-top:5px;margin-right:-10px;}
.dropdown-submenu:hover>a:after{border-left-color:#ffffff;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}
/*******************submenu************************/

    .navbar .dropdown-menu:before{ display: none;}
    .navbar .dropdown-menu:after{ display: none;}
 ul.dropdown-menu >li >a.dropdown-toggle:hover {color: white!important;background:darkcyan!important}
    a.dropdown-toggle {color: #333333!important;}    
</style>
<script>
$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
    // Avoid following the href location when clicking
    event.preventDefault(); 
    // Avoid having the menu to close when clicking
    event.stopPropagation(); 
    // If a menu is already open we close it
    $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
    // opening the one you clicked on
    $(this).parent().addClass('open');

    var menu = $(this).parent().find("ul");
    var menupos = menu.offset();
  
    if ((menupos.left + menu.width()) + 30 > $(window).width()) {
        var newpos = - menu.width();      
    } else {
        var newpos = $(this).parent().width();
    }
    menu.css({ left:newpos });

});
</script>
