<form method="post" action="">
<? foreach($this->page_config['use_dropdown_columns_options']['capability_user_type'] as $user_type_ID=>$user_type):
  if($user_type_ID==2){ continue;}  
    ?>
<table class="table table-bordered table-striped">
	<caption><?=$user_type?></caption>
	<thead>
		<tr>
			<th>Controllers</th>
			<th>Method</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?           
        $controller = $this->uri->segment(2);
        $methods = get_class_methods($controller);
	foreach($methods as $method):
          $rc = new ReflectionMethod($controller,$method);
            if( (!$rc->isPublic()) || (!$rc->isUserDefined()) || $method=="__construct"||$method=="get_instance")
		continue;          
            ?>
		<tr>
			<td><?=$controller?></td>
			<td><?=$method?></td>
			<td><input type="checkbox" name="capability[<?=$controller?>][<?=$user_type_ID?>][<?=$method?>]" <? if($choosenData['capability'][$controller][$user_type_ID][$method]=="true"){echo 'checked="checked"';}?> value='true'></td>
		</tr>
		<? endforeach;?>	
	<? endforeach;?>	
	</tbody>
</table>
<input type="submit" value="Save" style="position:fixed;bottom: 0;right: 0;">
</form>