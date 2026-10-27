<div class="index-wrapper">
    <!-- Notice Bar / Marquee Banner (Smart School Style) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" style="margin-bottom: 20px; border-left: 4px solid #35aa47;">
                <div class="box-body" style="padding: 12px 18px; display: flex; align-items: center; gap: 15px;">
                    <span class="label label-success" style="font-size: 12px; padding: 6px 12px; border-radius: 4px; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa fa-bullhorn"></i> Notice
                    </span>
                    <marquee direction="left" style="vertical-align: middle; font-size: 14px; font-weight: 500; color: #1e293b;" scrolldelay="120" onmouseover="this.stop();" onmouseout="this.start();">
                        We have updated our system for smoothness and better security. All customers are requested to change the user account password as early as possible! Please call 9382509991 in case of any issue. | কাজের মসৃণতা এবং উন্নত নিরাপত্তার জন্য আমরা আমাদের সিস্টেম আপডেট করেছি। সমস্ত গ্রাহকদের যত তাড়াতাড়ি সম্ভব ব্যবহারকারীর অ্যাকাউন্টের পাসওয়ার্ড পরিবর্তন করার জন্য অনুরোধ করা হচ্ছে!
                    </marquee>
                </div>
            </div>
        </div>
    </div>

    <!-- Smart School Top Metric Cards / Progress Stat Cards -->
    <div class="row">
        <!-- Plan Information -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart">
                <p class="font14">
                    <i class="fa fa-cubes ftlayer"></i> Active Plan
                    <span class="pull-right text-success"><?= PLAN_NAME ?></span>
                </p>
                <div class="progress-group">
                    <div class="progress progress-minibar">
                        <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                    </div>
                </div>
                <div style="margin-top: 10px; font-size: 12px; color: #64748b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <i class="fa fa-check-circle text-success"></i> <?= str_ireplace(",", ", ", PLAN_PACKAGES) ?>
                </div>
            </div>
        </div>

        <!-- Subscription Status -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart">
                <p class="font14">
                    <i class="fa fa-shield ftlayer"></i> System License
                    <span class="pull-right"><span class="label label-success">Active</span></span>
                </p>
                <div class="progress-group">
                    <div class="progress progress-minibar">
                        <div class="progress-bar progress-bar-aqua" style="width: 85%"></div>
                    </div>
                </div>
                <div style="margin-top: 10px; font-size: 12px; color: #64748b;">
                    <i class="fa fa-clock-o"></i> Cloud Sync: <span class="text-success font-weight-bold">Live</span>
                </div>
            </div>
        </div>

        <!-- Subscription Expiry & Renewal -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart">
                <p class="font14">
                    <i class="fa fa-calendar ftlayer"></i> Valid Till
                    <span class="pull-right text-danger font-weight-bold"><?= DEACTIVATION_DATE ?></span>
                </p>
                <div class="progress-group">
                    <div class="progress progress-minibar">
                        <div class="progress-bar progress-bar-yellow" style="width: 65%"></div>
                    </div>
                </div>
                <div style="margin-top: 8px;">
                    <button class="btn btn-xs btn-success" id="paynow" style="font-weight: 600; padding: 2px 10px;">
                        <i class="fa fa-refresh"></i> Renew Subscription
                    </button>
                    <input type="text" id="deactive_date" value="<?= DEACTIVATION_DATE ?>" style="display:none">
                </div>
            </div>
        </div>

        <!-- Technical Support -->
        <div class="col-lg-3 col-md-6 col-sm-6 mb10">
            <div class="topprograssstart">
                <p class="font14">
                    <i class="fa fa-whatsapp ftlayer text-success"></i> Technical Help
                    <span class="pull-right text-primary">+91 9382509991</span>
                </p>
                <div class="progress-group">
                    <div class="progress progress-minibar">
                        <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                    </div>
                </div>
                <div style="margin-top: 10px; font-size: 11px; color: #64748b;">
                    12pm to 6pm (WhatsApp) | Sat-Sun Off
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Modules / Plugins Dashboard Hook -->
    <div class="widget-area row">
        <div class="col-md-12">
            <?= execute_hook('dashboard'); ?>
        </div>
    </div>
</div>

<!-- Payment Modal (Smart School Theme) -->
<div id="paynowModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #1e293b; color: #fff; padding: 14px 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #fff; opacity: 0.8;">&times;</button>
                <h4 class="modal-title" style="font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-credit-card text-success"></i> Instant Subscription Payment
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; text-align: center; background: #f8fafc;">
                <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; display: inline-block;">
                    <p style="font-weight: 600; color: #1e293b; margin-bottom: 12px; font-size: 15px;">
                        Scan QR Code via Google Pay / PhonePe / Paytm / BHIM
                    </p>
                    <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="MsbBillings QR Code" style="max-height: 360px; max-width: 100%; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <div style="margin-top: 15px; font-size: 13px; color: #64748b;">
                        After payment, please send screenshot to WhatsApp <strong>+91 9382509991</strong> for instant renewal activation.
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #fff; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Renew Subscription Notification Modal -->
<div id="renewSubscription" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: #e11d48; color: #fff; padding: 14px 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: #fff; opacity: 0.8;">&times;</button>
                <h4 class="modal-title" style="font-weight: 700; margin: 0;">
                    <i class="fa fa-exclamation-triangle"></i> Subscription Expiring Soon
                </h4>
            </div>
            <div class="modal-body" style="padding: 24px; text-align: center; background: #fff;">
                <div class="alert alert-warning" style="border-radius: 6px; margin-bottom: 18px; font-weight: 600;">
                    Please renew your subscription before the expiry date to avoid service interruption!
                </div>
                <img src="<?= base_url(); ?>msb/g-pay4500.jpeg" alt="MsbBillings QR Code" style="max-height: 320px; max-width: 100%; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                <button type="button" class="btn btn-success" data-dismiss="modal" onclick="$('#paynowModal').modal('show');">
                    <i class="fa fa-qrcode"></i> Pay Now
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Remind Me Later</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    var nextmonth = "<?= date("Y-m-d", strtotime('+1 months')) ?>";
    var deactive_date = $('#deactive_date').val();
    
    if(deactive_date && deactive_date <= nextmonth){
        $("#renewSubscription").modal('show');
    }
    
    $("#paynow").click(function(e){
        e.preventDefault();
        $("#paynowModal").modal('show');
    });
});
</script>
