<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35aa47" />
    <title>Forgot Password : <?= isset($site_settings['site_setting_title']) && !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings' ?></title>
    <link href="<?= base_url('img/simplebillingsfav.png') ?>" rel="shortcut icon" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/form-elements.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: #f8fafc;
            font-family: 'Roboto', sans-serif;
        }
        .top-content {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .inner-bg {
            width: 100%;
            padding: 0;
        }
        .bgoffsetbg {
            display: flex;
            min-height: 100vh;
            align-items: stretch;
            background: #fff;
        }
        .loginbg {
            padding: 40px 35px;
            max-width: 440px;
            margin: auto;
            width: 100%;
        }
        .logowidth img {
            max-height: 52px;
            width: auto;
            object-fit: contain;
            margin-bottom: 20px;
        }
        .form-bottom {
            padding: 0;
            background: transparent;
        }
        .font-white.bolds {
            color: #1e293b;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }
        .form-group.has-feedback {
            position: relative;
            margin-bottom: 20px;
        }
        .form-group.has-feedback input.form-control {
            height: 50px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding-left: 18px;
            padding-right: 45px;
            font-size: 15px;
            background: #f8fafc;
            box-shadow: none;
            transition: all 0.25s ease;
        }
        .form-group.has-feedback input.form-control:focus {
            background: #fff;
            border-color: #35aa47;
            box-shadow: 0 0 0 3px rgba(53, 170, 71, 0.15);
        }
        .form-control-feedback {
            line-height: 50px;
            height: 50px;
            width: 45px;
            color: #94a3b8;
            font-size: 17px;
        }
        button.btn-reset {
            height: 50px;
            line-height: 50px;
            padding: 0 20px;
            background: #35aa47;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(53, 170, 71, 0.35);
            transition: all 0.25s ease;
        }
        button.btn-reset:hover {
            background: #2d913c;
            color: #fff;
            transform: translateY(-1px);
        }
        .alert-custom {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }
        .alert-custom.alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-custom.alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        .hero-banner {
            position: relative;
            background: url('<?= base_url("assets/images/login-bg.jpg") ?>') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .hero-banner::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.88) 0%, rgba(30, 41, 59, 0.75) 100%);
        }
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 680px;
            width: 100%;
        }
        .hero-title {
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
        }
        .notice-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 28px;
            color: #fff;
        }
        @media (max-width: 991px) {
            .hero-banner {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="top-content">
    <div class="inner-bg">
        <div class="container-fluid" style="padding: 0;">
            <div class="row" style="margin: 0;">
                <div class="bgoffsetbg">
                    <div class="col-lg-4 col-md-5 col-sm-12 nopadding" style="display: flex; align-items: center;">
                        <div class="loginbg">
                            <div class="form-top-left logowidth text-left">
                                <a href="<?= base_url() ?>">
                                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="MsbBillings" onerror="this.onerror=null; this.src='<?= base_url('msb/msbbillingslogo.png') ?>';">
                                </a>
                            </div>

                            <div class="form-bottom">
                                <h3 class="font-white bolds">Forgot Password</h3>
                                <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">Enter your username or email address and we'll send you recovery details.</p>

                                <div id="alert-box" class="alert-custom"></div>

                                <form action="<?= console_url('user/forgot_password') ?>" method="post" id="forgot_form" onsubmit="return handleForgot(event);">
                                    <div class="form-group has-feedback">
                                        <input type="text" name="username" id="username" placeholder="Username / Email" class="form-control" autocomplete="username" required autofocus>
                                        <span class="fa fa-envelope form-control-feedback"></span>
                                    </div>

                                    <button type="submit" id="submit_btn" class="btn btn-reset">
                                        Reset Password
                                    </button>
                                </form>

                                <p style="margin-top: 25px; text-align: center; font-size: 14px;">
                                    <a href="<?= console_url('user/login') ?>" style="color: #35aa47; text-decoration: none; font-weight: 500;">
                                        <i class="fa fa-arrow-left"></i> Back to Login
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-7 col-sm-12 nopadding-2 hero-banner">
                        <div class="hero-content">
                            <h3 class="hero-title">Account Recovery & Security</h3>
                            <div class="notice-card">
                                <h4><i class="fa fa-shield" style="color: #4ade80;"></i> Secure Identity Verification</h4>
                                <p style="line-height: 1.6; color: #cbd5e1;">Your account is protected by encrypted authentication. If you forgot your password, our automated recovery system will dispatch a secure reset instruction to your registered email address.</p>
                                <p style="margin-top: 15px; color: #94a3b8; font-size: 13px;">If you no longer have access to your email, please reach out to your system super administrator.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script>
    function handleForgot(e) {
        if (e && e.preventDefault) e.preventDefault();
        var form = $('#forgot_form');
        var btn = $('#submit_btn');
        var alertBox = $('#alert-box');

        var username = $('#username').val().trim();
        if (!username) {
            alertBox.removeClass('alert-success').addClass('alert-error').html('Please enter your username.').fadeIn();
            return false;
        }

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        alertBox.hide();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json'
        }).done(function(res) {
            if (res.status === 'success') {
                alertBox.removeClass('alert-error').addClass('alert-success').html('<i class="fa fa-check-circle"></i> ' + res.message).fadeIn();
                btn.prop('disabled', false).html('Reset Password');
            } else {
                btn.prop('disabled', false).html('Reset Password');
                alertBox.removeClass('alert-success').addClass('alert-error').html('<i class="fa fa-exclamation-circle"></i> ' + (res.message || 'No user found.')).fadeIn();
            }
        }).fail(function() {
            btn.prop('disabled', false).html('Reset Password');
            alertBox.removeClass('alert-success').addClass('alert-error').html('<i class="fa fa-warning"></i> An error occurred. Please try again.').fadeIn();
        });

        return false;
    }
</script>

</body>
</html>