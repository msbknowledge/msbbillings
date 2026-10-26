
<div class="box-content" >

                  
                        <a href="/uploads/internet_customer_template.xls" class="btn btn-primary" download>Download Xls </a>
                        <?php echo $error; ?>
                        <?php echo form_open_multipart('console/internet_customer/do_upload'); ?>
                        <input type="file" name="userfile" size="20" />
                        <input type="submit" value="upload" />
                       
</div>