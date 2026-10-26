<div class="index-wrapper">
            <div class="widget-area row-fluid">
                <div class="box span12">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-bullhorn"></i>Subscription Notification</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
 <div class="box span12" >
<marquee  direction="left" style="vertical-align: middle;font-size:20px;padding: 10px;" scrolldelay="150">   
We have updated our system for smoothness and better security. all customers are requested to change the user account password as early as possible!. Please call 9382509991 incase of any issue;  কাজের মসৃণতা এবং উন্নত নিরাপত্তার জন্য আমরা আমাদের সিস্টেম আপডেট করেছি। সমস্ত গ্রাহকদের যত তাড়াতাড়ি সম্ভব ব্যবহারকারীর অ্যাকাউন্টের পাসওয়ার্ড পরিবর্তন করার জন্য অনুরোধ করা হচ্ছে!
</marquee></div>
                <div class="span2"><p style=" border: 1px solid lightgray; padding: 7px;border-radius: 5px; color: #257F0D; font-size: 13px; padding-bottom: 15px;"><b style=" color: black;">Plan Name:</b> <?= PLAN_NAME ?> </p>
<p style=" border: 1px solid lightgray; padding: 7px;border-radius: 5px; color: #257F0D; font-size: 13px; padding-bottom: 15px;"><b style=" color: black;">Services:</b> <?= str_ireplace(",",", ",PLAN_PACKAGES) ?> </p>
</div>
                <div class="span3">
<p style=" border: 1px solid lightgray; padding: 7px;border-radius: 5px; color: #257F0D; font-size: 13px; padding-bottom: 15px;"><b style=" color: black;">
Technical Support:+91938250991 <br/>(12pm TO 6pm ) Whatsapp Only<br/><i>SATURDAY,SUNDAY OFF</i><br/></b>
<small>Please drop a message in whatsapp support, we will try to assist you as early as possible</small>
</p>
</div>
                <div class="span3"><p style=" border: 1px solid lightgray; padding: 7px;border-radius: 5px; color: #257F0D; font-size: 13px; padding-bottom: 15px;"><b style=" color: black;">Subscription Status:</b> <span  class="label label-success">Active</span></p></div>
                <div class="span4"><p style=" border: 1px solid lightgray; padding: 7px;border-radius: 5px; color: #257F0D; font-size: 13px; "><b style=" color: black;">Subscription Expire Date:</b> <span  class="label label-important"><?= DEACTIVATION_DATE ?></span><button class="btn btn-success" id="paynow"  style=" margin-left: 5px;">Renew Subscription</button></p></div>
                <input type="text" id="deactive_date" value="<?= DEACTIVATION_DATE ?>" style="display:none">
            </div>
        </div>
</div>
 <div class="widget-area row-fluid">
               <?= execute_hook('dashboard');?>
            </div>


</div>

<div id="paynowModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="text-align: center;">Payment</h3>


            </div>

            <table style="width:97%;height: 200px;margin:10px">
                <tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                    <!-- <h2>Googlepay QR Code...!!</h2> -->
                    <img src="<?=base_url();?>msb/g-pay4500.jpeg" alt="msbbilings QR code" height="400">
                    </td>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                        <!--<h2>Bank Transaction...!!</h2>-->
                        <!--<p><b>Bank: </b>Bank of Baroda</p>-->
                        <!--<p><b>A/C Name: </b>Logicmystery Technologies LLP</p>-->
                        <!--<p><b>A/C No: </b>36240200000161</p>-->
                        <!--<p><b>IFSC Code: </b>BARB0MEDINI</p>-->
                        <!--<p><b>A/C Type: </b>Current Account</p>-->


                    </td>
                </tr>
                <!--tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">Online Transaction..!!</td>
                    <td style="border: 1px dotted black;text-align: center;">
                <center>
                    <p><a href="https://www.instamojo.com/@logicmystery" target="_blank" class="btn btn-success" style="margin: 20px" >Pay Now</a></p>
                    <p style="font-size: 10px">* Gateway Charges apply...!!</p>
                </center>
                </td>

                </tr-->


            </table>
        </div>

    </div>

</div>
<div id="renewSubscription" class="modal fade" >

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 style="text-align: center;">Your Subscription Will Expire 20/02/2026...!</h3>
            </div>
            <!-- <div class="modal-body">
            <p>Please Renew Your Subscription</p>
            </div> -->
            <script type="text/javascript">
	atOptions = {
		'key' : 'fe2fba551331bbf1ef39fcbf15780b0d',
		'format' : 'iframe',
		'height' : 50,
		'width' : 320,
		'params' : {}
	};
	
</script>
            <table style="width:96%;height: 50px;margin:10px">
                <tr>
                    <td style="border: 1px dotted black;text-align: center;font-weight: bold">
                    <p>Please Renew Your Subscription before expire date</p>
                    <img src="<?=base_url();?>msb/g-pay4500.jpeg" alt="msbbillings QR code" height="400">
                    </td>
                </tr>
            </table>
        </div>

    </div>

</div>
<script>

$(document).ready(function(){
    var nextmonth = "<?= date("Y-m-d", strtotime('+1 months'))?>"
    var deactive_date = $('#deactive_date').val();
    $("#renewSubscription").modal('show');
    $("#renewSubscription").modal('hide');
    if(deactive_date <= nextmonth){
    $("#renewSubscription").modal('show');
    }
    $("#paynowModal").modal('show');
    $("#paynowModal").modal('hide');
    $("#paynow").click(function(){
        $("#paynowModal").modal('show');
    });
});

</script>
