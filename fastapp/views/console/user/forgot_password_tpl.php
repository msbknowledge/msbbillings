<div class="row-fluid">
    <div class="span12 center login-header">
        <h2>Welcome to <?= $site_settings['site_setting_title'] ?></h2>
    </div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
    <div class="well span5 center login-box">
        <div class="alert alert-info">
            <div>Please enter your Username.</div>
        </div>
        <form class="form-horizontal" id="signin_form" action="<?= console_url() ?>user/forgot_password" onsubmit="return validate_signin_form(this);" method="post">
            <fieldset>
                <div class="input-prepend" title="Username" data-rel="tooltip">
                    <span class="add-on"><i class="icon-user"></i></span>
                    <input autofocus class="input-large span10" from-validation="required" name="username" id="username" type="text" value="" />
                    <span class="help-inline" style="display:none">Please Enter Username</span>
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend">
                    <label class="remember" for="remember"><a href='<?= console_url('user/login'); ?>'>Login Here</a></label>
                </div>
                <div class="clearfix"></div>

                <p class="center span5">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </p>
            </fieldset>
        </form>
    </div><!--/span-->
</div><!--/row-->
<script>
    function validate_signin_form(targetForm){
        if(validate_form(targetForm,
        {
            beforeValidation : function(targetObject){
                $(targetObject).parent().children('.help-inline').hide().css('color','#333333');
            },
            onValidationError : function (targetObject){
                $(targetObject).parent().children('.help-inline').show().css('color','red');
            },
            captchaValidator :function (targetObject){return validate_captcha(targetObject);},
            duplicateValidator :function (targetObject){return duplicate_check(targetObject);}
                
        })){
            ajax_signin_form_submit(targetForm);
        }
        return false;
    }
    
    function ajax_signin_form_submit(targetForm){
        $.post($(targetForm).attr('action'), $(targetForm).serialize(), function(respData){
            //console.log($(targetForm).attr('action'));
            if(respData.status =='success'){
                $('.alert').removeClass('alert-info alert alert-error')
                .addClass('progress progress-striped progress-success active')
                .children('div').addClass('bar').css({'width':'100%','height':'200px'})
                .html(respData.message);
                setTimeout(function(){
                    window.location = '<?= console_url() ?>';
                }, 1000);
               
            } else {
                $('.alert').removeClass('alert-info').addClass('alert-error').children('div').html(respData.message);
            }
        }, 'json');
    }
    
    function validate_captcha(targetObject){
        var success=false;
        $.ajax({
            type: "POST",
            async: false,
            url: "captcha_check",
            dataType:'json',
            data: { captcha: $(targetObject).val()}
        })
        .done(function( respData ) {
            console.log(respData);
            if(respData.status=='success')
                success =  true;
            else
                success =  false;
        });
        return success;
        // return false;
    }
    
    function refresh_captcha(){
        $.post('refresh_captcha', {data:'refresh'}, function(respData){
            $('.captchaContainer').html(respData);
        }, 'html');
    }
    
    function duplicate_check(targetObject){
        var success=false;
        $.ajax({
            type: "POST",
            async: false,
            url: "duplicate_check",
            dataType:'json',
            data: { duplicate: $(targetObject).val()}
        })
        .done(function( respData ) {
            console.log(respData);
            if(respData.status=='success')
                success =  true;
            else{
                alert(respData.message);
                success =  false;
            }
            
        });
        return success;
        // return false;
    }
</script>