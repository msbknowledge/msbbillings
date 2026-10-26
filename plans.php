<style>
    .panel
    {
        text-align: center;
    }
    .panel:hover { box-shadow: 0 1px 5px rgba(0, 0, 0, 0.4), 0 1px 5px rgba(130, 130, 130, 0.35); }
    .panel-body
    {
        padding: 0px;
        text-align: center;
    }

    .the-price
    {
        background-color: rgba(220,220,220,.17);
        box-shadow: 0 1px 0 #dcdcdc, inset 0 1px 0 #fff;
        padding: 20px;
        margin: 0;
    }

    .the-price h1
    {
        line-height: 1em;
        padding: 0;
        margin: 0;
    }

    .subscript
    {
        font-size: 25px;
    }

    /* CSS-only ribbon styles    */
    .cnrflash
    {
        /*Position correctly within container*/
        position: absolute;
        top: -9px;
        right: 4px;
        z-index: 1; /*Set overflow to hidden, to mask inner square*/
        overflow: hidden; /*Set size and add subtle rounding  		to soften edges*/
        width: 100px;
        height: 100px;
        border-radius: 3px 5px 3px 0;
    }
    .cnrflash-inner
    {
        /*Set position, make larger then 			container and rotate 45 degrees*/
        position: absolute;
        bottom: 0;
        right: 0;
        width: 145px;
        height: 145px;
        -ms-transform: rotate(45deg); /* IE 9 */
        -o-transform: rotate(45deg); /* Opera */
        -moz-transform: rotate(45deg); /* Firefox */
        -webkit-transform: rotate(45deg); /* Safari and Chrome */
        -webkit-transform-origin: 100% 100%; /*Purely decorative effects to add texture and stuff*/ /* Safari and Chrome */
        -ms-transform-origin: 100% 100%;  /* IE 9 */
        -o-transform-origin: 100% 100%; /* Opera */
        -moz-transform-origin: 100% 100%; /* Firefox */
        background-image: linear-gradient(90deg, transparent 50%, rgba(255,255,255,.1) 50%), linear-gradient(0deg, transparent 0%, rgba(1,1,1,.2) 50%);
        background-size: 4px,auto, auto,auto;
        background-color: #aa0101;
        box-shadow: 0 3px 3px 0 rgba(1,1,1,.5), 0 1px 0 0 rgba(1,1,1,.5), inset 0 -1px 8px 0 rgba(255,255,255,.3), inset 0 -1px 0 0 rgba(255,255,255,.2);
    }
    .cnrflash-inner:before, .cnrflash-inner:after
    {
        /*Use the border triangle trick to make  				it look like the ribbon wraps round it's 				container*/
        content: " ";
        display: block;
        position: absolute;
        bottom: -16px;
        width: 0;
        height: 0;
        border: 8px solid #800000;
    }
    .cnrflash-inner:before
    {
        left: 1px;
        border-bottom-color: transparent;
        border-right-color: transparent;
    }
    .cnrflash-inner:after
    {
        right: 0;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }
    .cnrflash-label
    {
        /*Make the label look nice*/
        position: absolute;
        bottom: 0;
        left: 0;
        display: block;
        width: 100%;
        padding-bottom: 5px;
        color: #fff;
        text-shadow: 0 1px 1px rgba(1,1,1,.8);
        font-size: 0.95em;
        font-weight: bold;
        text-align: center;
    }

</style>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Forever Free</h3>
            </div>
            <div class="panel-body">
                <div class="the-price">
                    <h1>
                        <i class="fa fa-inr"></i> 0<span class="subscript">/month</span></h1>
                    <small>Lifetime Free</small>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            1 Account
                        </td>
                    </tr>
                    <tr class="active">
                        <td>
                            --
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50 Customers Base
                        </td>
                    </tr>
                    <tr class="active">
                        <td>--</td>
                    </tr>
                    <tr>
                        <td> App Support</td>
                    </tr>
                    <tr class="active">
                        <td>
                            Tutorials and Email Support
                        </td>
                    </tr>
                    <tr>
                        <td> Single Cloud App Support</td>
                    </tr>
                    <tr class="active">
                        <td>
                            --
                        </td>
                    <tr>
                        <td> --</td>
                    </tr>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
				<a class="btn btn-success" role="button" href="javascript:void(Tawk_API.toggle())"> Connect With us </a>
            </div>
        </div>
    </div>
   <!-- <div class="col-xs-12 col-md-4">
        <div class="panel panel-success">
            <div class="cnrflash">
                <div class="cnrflash-inner">
                    <span class="cnrflash-label">MOST
                        <br>
                        POPULR</span>
                </div>
            </div>
            <div class="panel-heading">
                <h3 class="panel-title">
                    Silver</h3>
            </div>
            <div class="panel-body">
                <div class="the-price">
                    <h1><i class="fa fa-inr"></i>   375<span class="subscript">/month</span></h1>
                    <small>Billed Annually</small>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            Unlimited Account
                        </td>
                    </tr>
                    <tr class="active">
                        <td>
                          SMS<sup>**</sup> Notification to Customer
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1000 Customer Base
                        </td>
                    </tr>
                    <tr class="active">
                        <td>Custom Invoices</td>
                    </tr>
                    <tr>
                        <td>App Support<sup>++</sup></td>
                    </tr>
                    <tr class="active">
                        <td>
                            Tutorials and Email Support
                        </td>
                    </tr>
                    <tr>
                        <td> Single Cloud App Support</td>
                    </tr>
                    <tr class="active">
                        <td>
                            --
                        </td>
                    </tr>
                    <tr>
                        <td> --</td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <a href="registration/index.php" class="btn btn-success" role="button">Sign Up</a>
            </div>
        </div>
    </div>--->

    <div class="col-xs-12 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Gold</h3>
            </div>
            <div class="panel-body">
                <div class="the-price">
                    <h1>
                        <h1><i class="fa fa-inr"></i>599<span class="subscript">/month</span></h1>
                    <small>Billed Annually</small>
                </div>
                <table class="table">
                    <tr>
                        <td>
                            Unlimited Account
                        </td>
                    </tr>
                    <tr class="active">
                        <td>
                          SMS<sup>**</sup> Notification to Customer
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Unlimited Customer Base
                        </td>
                    </tr>
                    <tr class="active">
                        <td>Custom Invoices</td>
                    </tr>
                    <tr>
                        <td>App Support<sup>++</sup></td>
                    </tr>
                    <tr class="active">
                        <td>
                            Priority Support, Tutorials and Email Support
                        </td>
                    </tr>
                    <tr>
                        <td> Multiple Cloud App Support</td>
                    </tr>
                    <tr class="active">
                        <td>
                            Free DYI Website with Own Domain<sup>**</sup>
                        </td>
                    </tr>
                    <tr>
                        <td> Online Payment Collection</td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
				<a class="btn btn-success" role="button" href="javascript:void(Tawk_API.toggle())"> Connect With us </a>
            </div>
        </div>

    </div>
    <span><sup>**</sup> SMS/Domain Charges Extra, Single Page DIY is available</span><br/>
    <span><sup>++</sup> Coming Soon</span>
</div>
