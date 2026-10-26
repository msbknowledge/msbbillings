<div class="box span10">
					<div class="box-header well" data-original-title="">
						<h2><i class="icon-edit"></i>COMPARE FORM</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content">
					   <?php//echo $error;?>
                       <?php echo form_open_multipart('console/customer/live_portal_compare');?>


						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
							<legend>upload your file to see the missing data</legend>
							<div class="span4" style="float:letft">
							<div class="control-group">
								<label class="control-label" style="width:auto" for="selectmso">Select Portal</label>
								<div class="controls">
								  <select id="selectmso" data-rel="chosen" name="mso">
									<option value="mn">SMS MediaNucleus</option>
								  </select>
								</div>
							  </div>
							 <div class="control-group">
								<label class="control-label" style="width:auto" for="selectpkg">Select Compare Filter</label>
								<div class="controls">
								  <select id="selectFilter" data-rel="chosen" name="filter">
									<option value="">--choose Filter Type--</option>
									<?foreach($filter as $filterType=>$filter_name){?>
									<option value='<?=$filterType;?>'><?=$filter_name;?></option>
									<?}?>
								  </select>
								</div>
							  </div>
							</div>
							<div class="span4" style="float:left">
								<div class="control-group">
								  <label class="control-label" style="width:auto"  for="fileInput">Choose File <br/>(Export By Portal Panel)</label>
								  <div class="controls">
									<div class="uploader" id="uniform-fileInput"><input class="input-file uniform_on" id="fileInput" name="userfile" type="file"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div>
								  </div>
								</div>

							</div>

							<div class="form-actions" style="clear:both">
							  <button type="submit" class="btn btn-primary">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>

					</div>
				</div>

<!---------------------------------------console to csv result section------------------------------------------------------>
				<div class="box span10">
					<div class="box-header well" data-original-title="">
						<h2><i class="icon-edit"></i>Data which IN CONSOLE NOT IN CSV</h2>
					<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
						</div>

					<div class="box-content">
					<?php if(!empty($notincsv)){ ?>

						<table class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th>Sl</th>
								<th><?=$choosenfilter?></th>
							  </tr>
							</thead>
							<tbody>
						<?php
						$counter = 1;

						foreach($notincsv as $val){?>
						<tr>
						<td><?=$counter++?></td>
								<td>
								  <span class="label label-success"><?=$val;?></span>
								</td>

							  </tr>
						<?php } ?>
							</tbody>
						  </table>

						  <?php }else{ ?>
						  NO RECORD
						    <?php } ?>
					</div>
				</div>
<!---------------------------------------console to csv result section end------------------------------------------------------>

<!---------------------------------------csv to console result section------------------------------------------------------>
<div class="box span10">
					<div class="box-header well" data-original-title="">
						<h2><i class="icon-edit"></i>Data which is :IN CSV NOT IN CONSOLE</h2>
<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>					</div>

					<div class="box-content">
					<?php if(!empty($notinconsole)){ ?>

						<table class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th>Sl</th>
								<th><?=$choosenfilter?></th>
							  </tr>
							</thead>
							<tbody>
					<?php

				//	pr($csvdata);
				$counter = 1;
					foreach($notinconsole as $val){?>
					<tr>
								<td><?=$counter++?></td>
								<td>
								  <span class="label label-warning"><?=$val?></span>
								</td>
							  </tr>
					<?php } ?>
							</tbody>
						  </table>

						<?php }else{ ?>
						  NO RECORD
						    <?php } ?>
					</div>
				</div>
