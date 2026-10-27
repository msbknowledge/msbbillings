<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#424242" />
    <title>Login : <?= isset($site_settings['site_setting_title']) && !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings' ?></title>
    <link href="<?= base_url('img/simplebillingsfav.png') ?>" rel="shortcut icon" type="image/x-icon">

    <!-- Official Smart School UserTemplate CSS from assets/backend/ -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="<?= base_url('assets/backend/usertemplate/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/usertemplate/assets/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/usertemplate/assets/css/form-elements.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/usertemplate/assets/css/style.css') ?>">

    <style>
        .top-content {
            min-height: 100vh;
            display: flex;
            align-items: center;
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
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        .form-group.has-feedback {
            position: relative;
            margin-bottom: 20px;
        }
        .form-group.has-feedback input.form-control {
            height: 50px;
            border: 1.5px solid #cbd5e1;
            border-radius: 6px;
            padding-left: 18px;
            padding-right: 45px;
            font-size: 15px;
            font-weight: 500;
            color: #0f172a !important;
            background: #ffffff !important;
            box-shadow: 0px 2px 10px rgba(0,0,0,0.04);
            transition: all 0.25s ease;
        }
        .form-group.has-feedback input.form-control::placeholder {
            color: #94a3b8 !important;
            opacity: 1 !important;
        }
        .form-group.has-feedback input.form-control:focus {
            background: #ffffff !important;
            color: #0f172a !important;
            border-color: #35aa47 !important;
            box-shadow: 0 0 0 3px rgba(53, 170, 71, 0.2);
        }
        .form-control-feedback {
            line-height: 50px;
            height: 50px;
            width: 45px;
            color: #94a3b8;
            font-size: 17px;
        }
        button.btn-signin {
            height: 50px;
            line-height: 50px;
            padding: 0 20px;
            background: #35aa47;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(53, 170, 71, 0.35);
            transition: all 0.25s ease;
        }
        button.btn-signin:hover, button.btn-signin:focus {
            background: #2d913c;
            color: #fff;
            transform: translateY(-1px);
        }
        .demo-roles {
            margin-top: 18px;
        }
        .demo-roles .btn {
            font-size: 12px;
            padding: 8px 10px;
            border-radius: 4px;
            margin: 2px;
            border: none;
            font-weight: 500;
        }
        .login-links {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }
        .login-links a {
            color: #35aa47;
            text-decoration: none;
            font-weight: 500;
        }
        .login-links a:hover {
            text-decoration: underline;
        }
        .alert-custom {
            padding: 12px 16px;
            border-radius: 4px;
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
            background: url('<?= base_url("assets/backend/images/login_bg3.jpg") ?>') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
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
            letter-spacing: -0.5px;
        }
        .notice-card {
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 28px;
            color: #fff;
            max-height: 480px;
            overflow-y: auto;
        }
        .notice-card h4 {
            font-size: 17px;
            font-weight: 600;
            color: #fff;
            margin-top: 0;
            margin-bottom: 8px;
        }
        .notice-card p {
            font-size: 14px;
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 0;
        }
        .notice-card .divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.15);
            margin: 18px 0;
        }
        .notice-card a.more-link {
            color: #35aa47;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin-top: 4px;
        }
        .notice-card a.more-link:hover {
            color: #4ade80;
            text-decoration: underline;
        }
        @media (max-width: 991px) {
            .hero-banner {
                display: none;
            }
            .bgoffsetbg {
                min-height: 100vh;
            }
            .loginbg {
                padding: 30px 20px;
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
                    <!-- Left Side: Login Form -->
                    <div class="col-lg-4 col-md-5 col-sm-12 nopadding" style="display: flex; align-items: center;">
                        <div class="loginbg">
                            <div class="form-top-left logowidth text-left" style="margin-bottom: 25px;">
                                <a href="<?= base_url() ?>">
                                    <img src="<?= base_url('msb/msbbillingslogo.png') ?>" alt="MsbBillings" style="max-height: 48px; width: auto;">
                                </a>
                            </div>

                            <div class="form-bottom">
                                <h3 class="font-white bolds">Admin Login</h3>

                                <div id="alert-box" class="alert-custom"></div>

                                <form action="<?= console_url('user/login') ?>" method="post" id="signin_form" onsubmit="return handleLogin(event);">
                                    <div class="form-group has-feedback">
                                        <input type="text" name="username" id="username" placeholder="Username" class="form-control" autocomplete="username" required autofocus>
                                        <span class="fa fa-envelope form-control-feedback"></span>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="current-password" required>
                                        <span class="fa fa-lock form-control-feedback"></span>
                                    </div>

                                    <div class="form-group clearfix" style="margin-bottom: 18px;">
                                        <label style="font-weight: normal; font-size: 13px; color: #64748b; cursor: pointer; float: left; margin: 0;">
                                            <input type="checkbox" name="remember" id="remember" style="vertical-align: middle; margin-top: -2px; margin-right: 6px;"> Remember Me
                                        </label>
                                        <a href="<?= console_url('user/forgot_password') ?>" class="pull-right" style="font-size: 13px; color: #35aa47; text-decoration: none;">
                                            <i class="fa fa-key"></i> Forgot Password?
                                        </a>
                                    </div>

                                    <button type="submit" id="submit_btn" class="btn btn-signin">
                                        Sign In
                                    </button>
                                </form>

                                <!-- Role Quick Fill Buttons (same as demo.smart-school.in) -->
                                <div class="demo-roles">
                                    <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; font-weight: 600; margin-bottom: 6px; text-align: center;">Demo Credentials</div>
                                    <div class="btn-group btn-group-justified" style="width: 100%;">
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="copyCredentials('admin', 'admin')" style="background:#0084B4;" title="Copy Super Admin Login">
                                            <i class="fa fa-user-secret"></i> Super Admin
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="copyCredentials('manager', 'password')" style="background:#1bbed3;" title="Copy Manager Login">
                                            <i class="fa fa-user"></i> Manager
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-primary" onclick="copyCredentials('cashier', 'password')" style="background:#4aa64e;" title="Copy Cashier Login">
                                            <i class="fa fa-calculator"></i> Cashier
                                        </a>
                                    </div>
                                </div>

                                <div class="login-links">
                                    <a href="<?= base_url() ?>" style="color: #64748b;">
                                        <i class="fa fa-globe"></i> Front Site
                                    </a>
                                    <span style="color: #cbd5e1;">|</span>
                                    <a href="mailto:admin@msbbillings.in" style="color: #64748b;">
                                        <i class="fa fa-question-circle"></i> Need Support?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Smart School Hero Banner & Features -->
                    <div class="col-lg-8 col-md-7 col-sm-12 nopadding-2 hero-banner">
                        <div class="hero-content">
                            <h3 class="hero-title">What's New In MsbBillings Cloud POS</h3>
                            <div class="notice-card">
                                <div>
                                    <h4><i class="fa fa-bolt" style="color: #4ade80;"></i> High-Speed Point of Sale & Thermal Invoicing</h4>
                                    <p>Engineered for speed and precision. Generate GST tax invoices in milliseconds, supporting 2-inch and 3-inch thermal printers, barcode scanners, and custom invoice header designs.</p>
                                    <a href="<?= base_url() ?>" class="more-link">Explore Features &rarr;</a>
                                </div>
                                <div class="divider"></div>
                                <div>
                                    <h4><i class="fa fa-cubes" style="color: #38bdf8;"></i> Batch Tracking & Automated Expiry Alerts</h4>
                                    <p>Designed for retail, supermarkets, and pharmacies. Live inventory levels with color-coded batch expiry warnings and automated stock replenishment reminders.</p>
                                    <a href="<?= base_url() ?>" class="more-link">Learn More &rarr;</a>
                                </div>
                                <div class="divider"></div>
                                <div>
                                    <h4><i class="fa fa-line-chart" style="color: #facc15;"></i> Complete GST Returns & Financial Ledger</h4>
                                    <p>One-click export for GSTR-1, GSTR-3B summaries, customer debit/credit ledgers, daily cashier register closures, and real-time profit & loss reporting.</p>
                                    <a href="<?= base_url() ?>" class="more-link">View Reports &rarr;</a>
                                </div>
                                <div class="divider"></div>
                                <div>
                                    <h4><i class="fa fa-shield" style="color: #f472b6;"></i> Multi-Branch & Role-Based Permissions</h4>
                                    <p>Grant specific access levels to cashiers, accountants, and branch managers while keeping central administration fully in your control.</p>
                                    <a href="<?= base_url() ?>" class="more-link">Security Overview &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.bgoffsetbg -->
            </div>
        </div>
    </div>
</div>

<!-- Javascript -->
<script src="<?= base_url('assets/backend/usertemplate/assets/js/jquery-1.11.1.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/usertemplate/assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<script>
    function copyCredentials(u, p) {
        document.getElementById("username").value = u;
        document.getElementById("password").value = p;
        $('#username').focus();
    }

    function handleLogin(e) {
        if (e && e.preventDefault) e.preventDefault();
        var form = $('#signin_form');
        var btn = $('#submit_btn');
        var alertBox = $('#alert-box');

        var username = $('#username').val().trim();
        var password = $('#password').val().trim();

        if (!username || !password) {
            alertBox.removeClass('alert-success').addClass('alert-error')
                .html('<i class="fa fa-exclamation-circle"></i> Please enter both Username and Password.').fadeIn();
            return false;
        }

        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Signing in...');
        alertBox.hide();

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json'
        }).done(function(res) {
            if (res.status === 'success') {
                alertBox.removeClass('alert-error').addClass('alert-success')
                    .html('<i class="fa fa-check-circle"></i> ' + (res.message || 'Login Success! Redirecting...')).fadeIn();
                setTimeout(function() {
                    window.location.href = '<?= console_url() ?>';
                }, 750);
            } else {
                btn.prop('disabled', false).html('Sign In');
                alertBox.removeClass('alert-success').addClass('alert-error')
                    .html('<i class="fa fa-exclamation-circle"></i> ' + (res.message || 'Login Failed. Invalid credentials.')).fadeIn();
            }
        }).fail(function(xhr, status, error) {
            btn.prop('disabled', false).html('Sign In');
            alertBox.removeClass('alert-success').addClass('alert-error')
                .html('<i class="fa fa-warning"></i> An error occurred while communicating with the server. Please try again.').fadeIn();
        });

        return false;
    }
</script>

</body>
</html>
