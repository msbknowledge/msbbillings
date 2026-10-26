<?if ($current_user_session):?>
<div class="btn-group pull-right" >
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-user"></i><span class="hidden-phone"> <?=$current_user_session['user_firstname'].' '.$current_user_session['user_lastname']?></span>
            <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
            <li><a href="<?=  console_url()?>user/profile">Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?=  console_url()?>user/logout">Logout</a></li>
    </ul>
</div>
<?  endif;?>