<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings Console' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?= isset($site_settings['site_setting_description']) ? $site_settings['site_setting_description'] : '' ?>">
    <meta name="author" content="MsbBillings">
    <meta name="theme-color" content="#35aa47">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('img/simplebillingsfav.png') ?>" type="image/x-icon">

    <!-- Google Fonts & Smart School Theme CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="<?= base_url('assets/backend/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/style-main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/themes/default/skins/_all-skins.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/themes/default/ss-main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/custom_style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/theme.css') ?>?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/dist/css/jquery.mCustomScrollbar.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/backend/plugins/datatables/dataTables.bootstrap.css') ?>">

    <style>
        /* Modern AdminLTE / Smart School adjustments */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        .content-wrapper,
        .right-side,
        .main-content {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            font-size: 12px !important;
            line-height: 1.45;
        }

        /* High-Density Compact Medical Font Hierarchy for Content UI */
        .content-wrapper .content {
            font-size: 12px !important;
        }

        .content-wrapper h1,
        .content-header h1 {
            font-size: 16px !important;
            font-weight: 700 !important;
            margin: 0 0 6px 0;
        }

        .content-wrapper h2 {
            font-size: 14px !important;
            font-weight: 700 !important;
            margin: 0 0 4px 0;
        }

        .content-wrapper h3,
        .content-wrapper .box-title,
        .content-wrapper .pv-card-header h3 {
            font-size: 13px !important;
            font-weight: 600 !important;
        }

        .content-wrapper h4 {
            font-size: 12px !important;
            font-weight: 600 !important;
        }

        .content-wrapper h5,
        .content-wrapper h6 {
            font-size: 11.5px !important;
            font-weight: 600 !important;
        }

        .content-wrapper p,
        .content-wrapper span:not(.label):not(.badge):not(.payable-amount),
        .content-wrapper li,
        .content-wrapper a:not(.btn) {
            font-size: 12px;
        }

        .content-wrapper .breadcrumb,
        .content-wrapper .breadcrumb li,
        .content-wrapper .breadcrumb a {
            font-size: 11px !important;
        }

        .content-wrapper .control-label,
        .content-wrapper label,
        .content-wrapper .form-group label {
            font-size: 11.5px !important;
            font-weight: 600 !important;
            margin-bottom: 3px !important;
        }

        .content-wrapper table,
        .content-wrapper .table,
        .content-wrapper .dataTable,
        .content-wrapper .dataTables_wrapper table {
            font-size: 11px !important;
            color: #334155 !important;
            background-color: #ffffff !important;
        }

        .content-wrapper table th,
        .content-wrapper .table th,
        .content-wrapper .table-bordered th,
        .content-wrapper table thead th,
        .content-wrapper .dataTable thead th,
        .content-wrapper .dataTables_wrapper thead th,
        .content-wrapper table tr th {
            color: #1e40af !important;
            background: linear-gradient(180deg, #f0f7ff 0%, #e0eefe 100%) !important;
            border: 1px solid #cbd5e1 !important;
            border-bottom: 2px solid #93c5fd !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.3px;
            padding: 6px 8px !important;
        }

        .content-wrapper table td,
        .content-wrapper .table td,
        .content-wrapper .table-bordered td,
        .content-wrapper table tbody td,
        .content-wrapper .dataTable tbody td {
            font-size: 11px !important;
            color: #334155 !important;
            border-color: #e2e8f0 !important;
            padding: 6px 8px !important;
        }

        .content-wrapper .table-striped > tbody > tr:nth-of-type(odd) > td {
            background-color: #f8fafc !important;
        }

        .content-wrapper .table-striped > tbody > tr:nth-of-type(even) > td {
            background-color: #ffffff !important;
        }

        .content-wrapper .table-hover > tbody > tr:hover > td {
            background-color: #eff6ff !important;
        }

        .content-wrapper .btn {
            font-size: 11px !important;
            padding: 3px 8px !important;
            border-radius: 4px !important;
        }

        .content-wrapper .btn-sm {
            font-size: 10.5px !important;
            padding: 2px 7px !important;
        }

        .content-wrapper .btn-xs {
            font-size: 10px !important;
            padding: 1px 5px !important;
        }

        .content-wrapper .label,
        .content-wrapper .badge {
            font-size: 10px !important;
            padding: 2px 6px !important;
            font-weight: 700 !important;
        }

        .content-wrapper .help-block,
        .content-wrapper .help-inline,
        .content-wrapper .text-muted,
        .content-wrapper small {
            font-size: 10.5px !important;
            color: #64748b !important;
        }

        .content-wrapper .dataTables_info,
        .content-wrapper .dataTables_paginate {
            font-size: 11px !important;
        }

        .well,
        .box,
        .card,
        .panel {
            background: #ffffff !important;
            color: #1e293b !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        }

        .box-header,
        .box-header.well,
        .panel-heading,
        .card-header {
            background: #f8fafc !important;
            color: #1e293b !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 8px 14px !important;
        }

        .box-header .box-title,
        .box-header h2,
        .box-header h3 {
            color: #0f172a !important;
            font-size: 13px !important;
            font-weight: 700 !important;
        }

        .box-body,
        .panel-body,
        .card-body {
            background: #ffffff !important;
            color: #1e293b !important;
            padding: 14px !important;
        }

        .noty_bar {
            position: fixed;
            top: 60px;
            right: 20px;
            z-index: 99999;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            font-weight: 500;
        }

        /* Modal Smart School Styling & z-index guarantees */
        .modal {
            z-index: 1060 !important;
        }

        .modal-backdrop {
            z-index: 1055 !important;
            background-color: #0f172a !important;
        }

        .modal-backdrop.in {
            opacity: 0.55 !important;
        }

        .modal-dialog {
            margin: 30px auto;
            z-index: 1061;
        }

        .modal-content {
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            border: none;
            overflow: hidden;
            background-color: #ffffff !important;
            color: #1e293b !important;
        }

        .modal-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 20px;
        }

        .modal-header .close {
            font-size: 24px;
            color: #64748b;
            opacity: 0.8;
            margin-top: -2px;
        }

        .modal-header .close:hover {
            color: #0f172a;
            opacity: 1;
        }

        .modal-title {
            color: #1e293b;
            font-size: 17px;
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
            color: #334155 !important;
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }

        .modal-footer {
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 12px 20px;
        }

        /* High-Contrast Tables across Console */
        .table,
        .table-bordered,
        .table-striped {
            color: #334155 !important;
        }

        .table th,
        .table-bordered th,
        table thead th {
            color: #1e40af !important;
            background: linear-gradient(180deg, #f0f7ff 0%, #e0eefe 100%) !important;
            border-color: #cbd5e1 !important;
            border-bottom: 2px solid #93c5fd !important;
            font-weight: 700 !important;
        }

        .table td,
        .table-bordered td,
        table tbody td {
            color: #334155 !important;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>td {
            background-color: #f8fafc !important;
            color: #334155 !important;
        }

        .table-striped>tbody>tr:nth-of-type(even)>td {
            background-color: #ffffff !important;
            color: #334155 !important;
        }

        /* Universal Form Inputs & Textareas Styling & Text Color */
        input:not([type="button"]):not([type="submit"]):not([type="reset"]):not([type="checkbox"]):not([type="radio"]):not([type="file"]):not([type="image"]),
        select,
        textarea,
        .form-control,
        .search_box input,
        .search_box select,
        .dataTables_filter input,
        .dataTables_length select,
        .input-xlarge,
        .input-large,
        .input-medium,
        .input-small,
        .table input,
        .table select,
        .table textarea,
        .rowline input,
        .rowline select,
        #tableData input,
        #tableData select {
            color: #0f172a !important;
            /* Solid Slate-900, clear & dark readable text */
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
            font-size: 11.5px !important;
            font-weight: 500 !important;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04) !important;
            -webkit-text-fill-color: #0f172a !important;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="number"],
        input[type="tel"],
        input[type="search"],
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        input[type="month"],
        input[type="url"],
        input:not([type]) {
            color: #0f172a !important;
            background-color: #ffffff !important;
            -webkit-text-fill-color: #0f172a !important;
        }

        select option {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }

        input::placeholder,
        textarea::placeholder,
        .form-control::placeholder {
            color: #64748b !important;
            opacity: 1 !important;
            font-weight: 400 !important;
            -webkit-text-fill-color: #64748b !important;
        }

        input:focus,
        select:focus,
        textarea:focus,
        .form-control:focus,
        .chosen-container-active .chosen-single {
            color: #0f172a !important;
            background-color: #ffffff !important;
            border-color: #35aa47 !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(53, 170, 71, 0.25) !important;
            -webkit-text-fill-color: #0f172a !important;
        }

        /* Readonly & Disabled Inputs */
        input[readonly],
        input:disabled,
        select:disabled,
        textarea[readonly],
        textarea:disabled,
        .form-control[readonly],
        .form-control:disabled {
            background-color: #f8fafc !important;
            color: #1e293b !important;
            border-color: #cbd5e1 !important;
            cursor: default;
            opacity: 1 !important;
            -webkit-text-fill-color: #1e293b !important;
        }

        /* Checkboxes & Radios */
        input[type="checkbox"],
        input[type="radio"] {
            background-color: #ffffff !important;
            accent-color: #35aa47 !important;
            cursor: pointer;
        }

        /* Autocomplete Dropdown Styling */
        .ui-autocomplete {
            background: #ffffff !important;
            background-color: #ffffff !important;
            color: #0f172a !important;
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1) !important;
            max-height: 280px;
            overflow-y: auto;
            z-index: 999999 !important;
        }

        .ui-autocomplete .ui-menu-item a {
            color: #0f172a !important;
            padding: 8px 14px !important;
        }

        .ui-autocomplete .ui-menu-item a:hover,
        .ui-autocomplete .ui-menu-item a.ui-state-focus {
            background-color: #35aa47 !important;
            color: #ffffff !important;
        }

        /* Input labels & control group headers */
        .control-label,
        label,
        .form-group label {
            color: #1e293b !important;
            font-weight: 600 !important;
            font-size: 11.5px !important;
            margin-bottom: 3px !important;
        }

        .help-block,
        .help-inline,
        .text-muted {
            color: #64748b !important;
        }

        /* Universal High-Contrast Badges & Labels (.label) Fix */
        .label {
            display: inline-block !important;
            padding: 2px 6px !important;
            font-size: 10px !important;
            font-weight: 700 !important;
            line-height: 1.2 !important;
            text-align: center !important;
            white-space: nowrap !important;
            vertical-align: middle !important;
            border-radius: 4px !important;
            text-transform: uppercase !important;
            letter-spacing: 0.03em !important;
            text-shadow: none !important;
        }

        .label:not([class*="label-"]),
        span.label:not([class*="label-"]),
        .label-default {
            background-color: #334155 !important;
            color: #ffffff !important;
        }

        .label-important,
        .label-danger {
            background-color: #ef4444 !important;
            color: #ffffff !important;
        }

        .label-primary {
            background-color: #2563eb !important;
            color: #ffffff !important;
        }

        .label-success {
            background-color: #10b981 !important;
            color: #ffffff !important;
        }

        .label-info {
            background-color: #0284c7 !important;
            color: #ffffff !important;
        }

        .label-warning {
            background-color: #f59e0b !important;
            color: #ffffff !important;
        }

        /* ========================================================
           Comprehensive Professional Medical Button System
           ======================================================== */
        .content-wrapper .btn,
        .box-content .btn,
        .choose_entry_form .btn,
        .modal-footer .btn {
            border-radius: 5px !important;
            font-size: 11.5px !important;
            padding: 4px 11px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 5px !important;
            line-height: 1.4 !important;
            vertical-align: middle !important;
            font-weight: 500 !important;
            text-decoration: none !important;
            transition: all 0.15s ease-in-out !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            cursor: pointer !important;
        }

        /* Default / Secondary Buttons (Back, Cancel, Clear, Export, etc.) */
        .btn-default,
        .btn-secondary,
        .content-wrapper .btn-default,
        .box-content .btn-default,
        .modal-footer .btn-default,
        button.btn:not([class*="btn-"]):not([class*="search_"]):not([class*="btn_"]),
        a.btn:not([class*="btn-"]):not([class*="search_"]):not([class*="btn_"]) {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            color: #334155 !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
        }

        .btn-default:hover,
        .btn-default:focus,
        .btn-default:active,
        .btn-secondary:hover,
        .btn-secondary:focus,
        .content-wrapper .btn-default:hover,
        .box-content .btn-default:hover,
        .modal-footer .btn-default:hover,
        button.btn:not([class*="btn-"]):not([class*="search_"]):not([class*="btn_"]):hover,
        a.btn:not([class*="btn-"]):not([class*="search_"]):not([class*="btn_"]):hover {
            background-color: #f8fafc !important;
            border-color: #94a3b8 !important;
            color: #0f172a !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06) !important;
        }

        .btn-default i,
        .btn-secondary i {
            color: #64748b !important;
        }

        .btn-default:hover i,
        .btn-secondary:hover i {
            color: #334155 !important;
        }

        /* Select All Button - Light Emerald Medical Accent */
        .btn_select_all,
        .box-content .btn_select_all,
        .choose_entry_form .btn_select_all {
            background-color: #f0fdf4 !important;
            border: 1px solid #86efac !important;
            color: #166534 !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 2px rgba(22, 101, 52, 0.08) !important;
        }

        .btn_select_all:hover,
        .btn_select_all:focus,
        .box-content .btn_select_all:hover {
            background-color: #dcfce7 !important;
            border-color: #4ade80 !important;
            color: #14532d !important;
            box-shadow: 0 2px 5px rgba(22, 101, 52, 0.16) !important;
        }

        .btn_select_all i,
        .btn_select_all .fa {
            color: #16a34a !important;
        }

        .btn_select_all:not(:has(i))::before {
            content: "\f046";
            font-family: FontAwesome;
            margin-right: 5px;
            color: #16a34a !important;
        }

        /* Clear Selected Button - Light Slate Professional */
        .btn_deselect_all,
        .box-content .btn_deselect_all,
        .choose_entry_form .btn_deselect_all {
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            color: #475569 !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04) !important;
        }

        .btn_deselect_all:hover,
        .btn_deselect_all:focus,
        .box-content .btn_deselect_all:hover {
            background-color: #f1f5f9 !important;
            border-color: #94a3b8 !important;
            color: #1e293b !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06) !important;
        }

        .btn_deselect_all i,
        .btn_deselect_all .fa {
            color: #64748b !important;
        }

        .btn_deselect_all:not(:has(i))::before {
            content: "\f096";
            font-family: FontAwesome;
            margin-right: 5px;
            color: #64748b !important;
        }

        /* Primary Button - Medical Green */
        .btn-primary,
        .box-content .btn-primary,
        .modal-footer .btn-primary {
            background-color: #10b981 !important;
            border: 1px solid #059669 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 3px rgba(16, 185, 129, 0.25) !important;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .box-content .btn-primary:hover,
        .modal-footer .btn-primary:hover {
            background-color: #059669 !important;
            border-color: #047857 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(5, 150, 105, 0.35) !important;
        }

        .btn-primary i,
        .btn-primary .fa {
            color: #ffffff !important;
        }

        /* Success Button */
        .btn-success,
        .box-content .btn-success {
            background-color: #10b981 !important;
            border: 1px solid #059669 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 3px rgba(16, 185, 129, 0.25) !important;
        }

        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active,
        .box-content .btn-success:hover {
            background-color: #059669 !important;
            border-color: #047857 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(5, 150, 105, 0.35) !important;
        }

        .btn-success i,
        .btn-success .fa {
            color: #ffffff !important;
        }

        /* Info Button - Ocean Sky Blue (Create Sale, Add Detail, Search) */
        .btn-info,
        .box-content .btn-info {
            background-color: #0284c7 !important;
            border: 1px solid #0369a1 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 3px rgba(2, 132, 199, 0.25) !important;
        }

        .btn-info:hover,
        .btn-info:focus,
        .btn-info:active,
        .box-content .btn-info:hover {
            background-color: #0369a1 !important;
            border-color: #075985 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(3, 105, 161, 0.35) !important;
        }

        .btn-info i,
        .btn-info .fa {
            color: #ffffff !important;
        }

        /* Danger Button (Delete Selected, Delete Single) */
        .btn-danger,
        .search_remove.btn-danger,
        .box-content .btn-danger,
        .box-content .search_remove.btn-danger {
            background-color: #ef4444 !important;
            border: 1px solid #dc2626 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 3px rgba(239, 68, 68, 0.25) !important;
        }

        .btn-danger:hover,
        .btn-danger:focus,
        .btn-danger:active,
        .search_remove.btn-danger:hover,
        .box-content .btn-danger:hover {
            background-color: #dc2626 !important;
            border-color: #b91c1c !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(220, 38, 38, 0.35) !important;
        }

        .btn-danger i,
        .btn-danger .fa,
        .search_remove.btn-danger i {
            color: #ffffff !important;
        }

        .search_remove.btn-danger:not(:has(i))::before {
            content: "\f014";
            font-family: FontAwesome;
            margin-right: 5px;
            color: #ffffff !important;
        }

        /* Warning Button */
        .btn-warning,
        .box-content .btn-warning {
            background-color: #f59e0b !important;
            border: 1px solid #d97706 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            box-shadow: 0 1px 3px rgba(245, 158, 11, 0.25) !important;
        }

        .btn-warning:hover,
        .btn-warning:focus,
        .btn-warning:active,
        .box-content .btn-warning:hover {
            background-color: #d97706 !important;
            border-color: #b45309 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(217, 119, 6, 0.35) !important;
        }

        .btn-warning i,
        .btn-warning .fa {
            color: #ffffff !important;
        }

        /* Table List Toolbar Refinement */
        .choose_entry_form {
            display: inline-block;
            margin-bottom: 8px;
        }

        .choose_entry_form .btn,
        .box-content > .btn {
            margin-right: 6px !important;
            margin-bottom: 6px !important;
        }

        .box-content hr,
        .choose_entry_form hr {
            border: 0 !important;
            border-top: 1px solid #e2e8f0 !important;
            margin: 8px 0 12px 0 !important;
        }

        /* Table Row Action Buttons (View, Edit, Delete, Print) */
        .table td .btn,
        .table_view_wrapper .btn {
            border-radius: 4px !important;
            font-size: 11px !important;
            padding: 2.5px 7px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 4px !important;
            transition: all 0.15s ease !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            border: none !important;
            text-decoration: none !important;
            margin: 1px 2px !important;
        }

        .table td .btn i,
        .table_view_wrapper .btn i {
            font-size: 11px !important;
            vertical-align: middle;
        }

        .table td .btn-success,
        .btn-action-view {
            background-color: #10b981 !important;
            color: #ffffff !important;
        }

        .table td .btn-success:hover,
        .btn-action-view:hover {
            background-color: #059669 !important;
            color: #ffffff !important;
        }

        .table td .btn-info,
        .btn-action-edit {
            background-color: #0284c7 !important;
            color: #ffffff !important;
        }

        .table td .btn-info:hover,
        .btn-action-edit:hover {
            background-color: #0369a1 !important;
            color: #ffffff !important;
        }

        .table td .btn-warning,
        .btn-action-billing {
            background-color: #f59e0b !important;
            color: #ffffff !important;
        }

        .table td .btn-warning:hover,
        .btn-action-billing:hover {
            background-color: #d97706 !important;
            color: #ffffff !important;
        }

        .table td .btn-danger,
        .btn-action-delete {
            background-color: #ef4444 !important;
            color: #ffffff !important;
        }

        .table td .btn-danger:hover,
        .btn-action-delete:hover {
            background-color: #dc2626 !important;
            color: #ffffff !important;
        }

        .table td a[title*="Print"],
        .table td a[title*="print"],
        .btn-action-print {
            background-color: #6366f1 !important;
            color: #ffffff !important;
        }

        .table td a[title*="Print"]:hover,
        .table td a[title*="print"]:hover,
        .btn-action-print:hover {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
        }

        /* FontAwesome Compatibility Map for Legacy Icon Classes */
        .icon-zoom-in:before,
        .icon-eye-open:before {
            content: "\f06e" !important;
            /* fa-eye */
            font-family: FontAwesome !important;
        }

        .icon-edit:before,
        .icon-pencil:before {
            content: "\f040" !important;
            /* fa-pencil */
            font-family: FontAwesome !important;
        }

        .icon-trash:before {
            content: "\f014" !important;
            /* fa-trash-o */
            font-family: FontAwesome !important;
        }

        .icon-print:before {
            content: "\f02f" !important;
            /* fa-print */
            font-family: FontAwesome !important;
        }

        .icon-list-alt:before,
        .icon-list:before {
            content: "\f1ec" !important;
            /* fa-calculator */
            font-family: FontAwesome !important;
        }

        .icon-white,
        .icon-red {
            color: inherit !important;
        }

        [class^="icon-"],
        [class*=" icon-"] {
            display: inline-block;
            font-family: FontAwesome !important;
            font-style: normal;
            font-weight: normal;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
        }

        /* ========================================================
           Modern Left Sidebar & Submenu Styling (High Contrast & Professional)
           ======================================================== */
        .skin-blue .main-sidebar {
            background-color: #0f172a !important;
        }

        .skin-blue .sidebar-menu > li.header {
            color: #94a3b8 !important;
            background: #020617 !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: 0.8px !important;
            padding: 12px 18px 8px !important;
            text-transform: uppercase !important;
        }

        .skin-blue .sidebar-menu > li > a {
            color: #cbd5e1 !important;
            border-left: 3px solid transparent !important;
            padding: 10px 14px !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            transition: all 0.15s ease-in-out !important;
        }

        .skin-blue .sidebar-menu > li:hover > a,
        .skin-blue .sidebar-menu > li.menu-open > a {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08) !important;
            border-left-color: #35aa47 !important;
        }

        .skin-blue .sidebar-menu > li.active > a {
            color: #ffffff !important;
            background: rgba(53, 170, 71, 0.15) !important;
            border-left-color: #35aa47 !important;
        }

        /* Submenu container (treeview-menu) */
        .skin-blue .treeview-menu,
        .skin-blue .sidebar-menu .treeview-menu {
            background: #020617 !important;
            padding: 6px 8px !important;
            margin: 0 !important;
        }

        /* Submenu items default */
        .skin-blue .treeview-menu > li > a,
        .skin-blue .sidebar-menu .treeview-menu > li > a {
            color: #94a3b8 !important;
            padding: 7px 12px 7px 24px !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            border-radius: 6px !important;
            margin: 2px 0 !important;
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
            transition: all 0.15s ease-in-out !important;
        }

        /* Submenu items on hover (regular item hover) */
        .skin-blue .treeview-menu > li > a:hover,
        .skin-blue .sidebar-menu .treeview-menu > li > a:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08) !important;
        }

        /* Submenu ACTIVE item - ALWAYS CRISP WHITE ON MEDICAL GREEN PILL */
        .skin-blue .treeview-menu > li.active > a,
        .skin-blue .sidebar-menu .treeview-menu > li.active > a,
        .skin-blue .sidebar-menu .treeview-menu > li.active > a:focus {
            color: #ffffff !important;
            background: #35aa47 !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 8px rgba(53, 170, 71, 0.45) !important;
            border-radius: 6px !important;
        }

        /* Submenu ACTIVE item on HOVER - CRISP WHITE ON DARKER GREEN */
        .skin-blue .treeview-menu > li.active > a:hover,
        .skin-blue .sidebar-menu .treeview-menu > li.active > a:hover {
            color: #ffffff !important;
            background: #2d913c !important;
            box-shadow: 0 4px 12px rgba(53, 170, 71, 0.6) !important;
        }

        /* Text and icons inside active item stay 100% white */
        .skin-blue .treeview-menu > li.active > a *,
        .skin-blue .sidebar-menu .treeview-menu > li.active > a * {
            color: #ffffff !important;
        }
    </style>

    <!-- Core Scripts -->
    <script src="<?= base_url('assets/backend/custom/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/backend/bootstrap/js/bootstrap.min.js') ?>"></script>

    <!-- jQuery Backwards Compatibility Layer -->
    <script>
        (function($) {
            if (!$) return;
            // .live() compatibility shim
            if (!$.fn.live) {
                $.fn.live = function(types, data, fn) {
                    if (!types) return this;
                    if (typeof types === 'function') {
                        return this.each(types);
                    }
                    var sel = this.selector;
                    if (sel) {
                        $(document).on(types, sel, data, fn);
                    } else {
                        $(this).on(types, data, fn);
                    }
                    return this;
                };
            }
            // .die() compatibility shim
            if (!$.fn.die) {
                $.fn.die = function(types, fn) {
                    if (!types) return this;
                    var sel = this.selector;
                    if (sel) {
                        $(document).off(types, sel, fn);
                    } else {
                        $(this).off(types, fn);
                    }
                    return this;
                };
            }
            // $.browser compatibility shim
            if (!$.browser) {
                var ua = navigator.userAgent.toLowerCase();
                $.browser = {
                    msie: /msie|trident/.test(ua),
                    mozilla: /firefox/.test(ua),
                    webkit: /webkit/.test(ua),
                    opera: /opera/.test(ua),
                    chrome: /chrome/.test(ua),
                    safari: /safari/.test(ua) && !/chrome/.test(ua),
                    version: (ua.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1]
                };
            }
            window.docReady = window.docReady || function() {};
        })(jQuery);
    </script>

    <script>
        var console_url = '<?= console_url() ?>';
        var cdn_url = '<?= cdn_url() ?>';
        var page_url = '<?= base_url() . $this->uri->segment(1) ?>/<?= $this->uri->segment(2) ?>/';
        var section = '<?= isset($orderByModelData) ? $orderByModelData : '' ?>';

        // Pre-apply sidebar state to avoid layout shift
        (function() {
            try {
                if (localStorage.getItem('ss_sidebar_state') === 'collapsed' && window.innerWidth > 767) {
                    document.documentElement.classList.add('sidebar-collapse');
                    window.addEventListener('DOMContentLoaded', function() {
                        document.body.classList.add('sidebar-collapse');
                    });
                }
            } catch (e) {}
        })();
    </script>

    <? execute_hook('header'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="noty_bar noty_theme_default noty_layout_center" id="noty_xhr" style="background-color: #f8fafc; border: 1px solid #e2e8f0; cursor: pointer; display: none;">
        <div class="noty_message"><span class="noty_text"><i class="fa fa-spinner fa-spin"></i> Processing...</span></div>
    </div>

    <?php if ($current_user_session): ?>
        <div class="wrapper">
            <!-- Main Top Header Navbar -->
            <header class="main-header" id="alert">
                <!-- Logo -->
                <a href="<?= console_url() ?>" class="logo">
                    <span class="logo-mini">
                        <img src="<?= base_url('msb/msbbillingslogo.png') ?>" style="height: 26px; width: auto; max-width: 42px;" alt="MsbBillings">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('msb/msbbillingslogo.png') ?>" style="height: 30px; width: auto; margin-right: 8px; vertical-align: middle;" alt="MsbBillings">
                        <!-- <span style="font-size: 16px; font-weight: 700; color: #fff; letter-spacing: -0.3px; vertical-align: middle;">
                            <?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings' ?>
                        </span> -->
                    </span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar Toggle Button -->
                    <a href="javascript:void(0)" onclick="collapseSidebar()" class="sidebar-toggle" data-toggle="offcanvas" role="button" title="Toggle Sidebar" style="color: #fff; font-size: 16px; padding: 15px 18px; float: left; text-decoration: none;">
                        <span class="sr-only">Toggle Navigation</span>
                    </a>

                    <!-- Session / Node title -->
                    <div class="col-lg-4 col-md-3 col-sm-2 col-xs-4 hidden-xs">
                        <span class="sidebar-session" style="color: #cbd5e1; font-size: 14px; font-weight: 600; line-height: 35px; display: inline-block;">
                            <i class="fa fa-building-o" style="color: #35aa47; margin-right: 6px;"></i>
                            <?= defined('NODE') ? ucfirst(NODE) : 'Console' ?>
                        </span>
                    </div>

                    <!-- Right Menu: User profile dropdown & quick links -->
                    <div class="navbar-custom-menu pull-right">
                        <?php $this->load->view('console/elements/user_dropdown_tpl'); ?>
                    </div>
                </nav>
            </header>

            <!-- Left Sidebar Navigation -->
            <?php $this->load->view('console/elements/left_navigation_tpl'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Breadcrumb Header -->
                <?php $this->load->view('console/elements/breadcrumb_tpl'); ?>

                <!-- Main content section -->
                <section class="content" id="content" style="padding: 15px 20px;">
                <?php endif; ?>