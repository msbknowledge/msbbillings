
<?php
$label = "Create";
$icon="<i class='fa fa-plus-square'></i>&nbsp; {$label}</i>";
	
	?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- For Messages -->
			        <div class="template-alert-block"></div>
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title font-weight-bold">
							<?= $icon ?>
						</h3>
					</div>
	                    
                        <div class="card-body append_place">
                            <div class="row">
                                <div class="col-md-12">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                                        <tbody>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td class="container">
                                                    <div class="content">
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: center;">
                                                                        <div style="height: 70px;width:100%;text-align: center;margin-bottom: 10px;">
                                                                            <a href="<?= base_url(); ?>">
                                                                                </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>    <!-- START CENTERED WHITE CONTAINER -->
                                                        
                                                        <table role="presentation" class="main">
                                                            <!-- START MAIN CONTENT AREA -->
                                                            <tbody>
                                                                <tr>
                                                                    <td class="wrapper">
                                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                            <tbody><tr>
                                                                                <td>
                                                                                    <h1 style="text-decoration: none; font-size: 24px;line-height: 28px;font-weight: bold"><?= $head ?></h1>
                                                                                    <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                                                                                        <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                                                                                            <p><?= $content ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody></table>
                                                                    </td>
                                                                </tr>
                                                            <!-- END MAIN CONTENT AREA -->
                                                            </tbody>
                                                        </table>

                                                        <!-- SOCIAL LINKS -->
                                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin-top: 10px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="content-block" style="text-align: center;width: 100%;">
                                                                        <?php?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <!-- START FOOTER -->
                                                        <div class="footer">
                                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                                <tbody><tr>
                                                                    <td class="content-block powered-by">
                                                                        
                                                                    </td>
                                                                </tr>
                                                            
                                                            </tbody></table>
                                                        </div>
                                                        <!-- END FOOTER -->

                                                    <!-- END CENTERED WHITE CONTAINER -->
                                                    </div>
                                                </td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
	</div>
</section>