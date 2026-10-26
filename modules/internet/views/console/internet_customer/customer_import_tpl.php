<div class="box span10">
    <div class="box-header well" data-original-title="">
        <h2><i class="icon-edit"></i>IMPORT CUSTOMERS</h2>
        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
        <?php //echo $error;?>
        <?php echo form_open_multipart('console/customer/customer_import'); ?>


        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>upload your file to see the missing data</legend>

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

