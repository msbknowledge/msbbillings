<?php

/**
 * Modern Responsive Sale Entry View (Point of Sale / Add Detail)
 * Module: Antu / Medical POS
 * Location: modules/antu/views/console/sale/add_detail_tpl.php
 */
?>
<style>
    /* Scoped Modern UI for Sale Add Detail */
    .sale-ui-wrap {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #1e293b;
        margin: 5px 0 40px 0;
    }

    /* Page Header */
    .sale-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e2e8f0;
    }

    .sale-page-header .header-titles h1 {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: -0.02em;
    }

    .sale-page-header .header-titles p {
        margin: 0;
        font-size: 11.5px;
        color: #64748b;
    }

    /* Modern Card Box */
    .sale-ui-wrap .pv-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 2px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 16px;
        overflow: hidden;
    }

    .sale-ui-wrap .pv-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 8px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
    }

    .sale-ui-wrap .pv-card-header h3 {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sale-ui-wrap .pv-card-body {
        padding: 12px 14px;
    }

    /* Form Controls */
    .sale-ui-wrap .control-label {
        font-size: 11px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 3px;
    }

    .sale-ui-wrap .form-control {
        border-radius: 4px;
        border-color: #cbd5e1;
        box-shadow: none;
        font-size: 11.5px;
        height: 28px;
        padding: 3px 8px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .sale-ui-wrap .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    .sale-ui-wrap .input-group-addon {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #64748b;
        border-radius: 4px 0 0 4px;
        font-size: 11.5px;
        padding: 3px 8px;
    }

    /* Grid Table Styles */
    .sale-table-container {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #ffffff;
        max-height: 520px;
        overflow-y: auto;
        overflow-x: auto;
    }

    .sale-grid-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .sale-grid-table thead th {
        position: sticky;
        top: 0;
        z-index: 5;
        background: linear-gradient(180deg, #f0f7ff 0%, #e0eefe 100%) !important;
        color: #1e40af !important;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        padding: 6px 4px;
        border: 1px solid #cbd5e1 !important;
        border-bottom: 2px solid #93c5fd !important;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    .sale-grid-table tbody td {
        padding: 0px !important;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }

    .sale-grid-table tbody td input,
    .sale-grid-table tbody td select {
        padding: 0px !important;
    }

    .sale-grid-table tbody tr.rowline:hover td {
        background-color: #f8fafc;
    }

    .sale-grid-table tbody tr.row-active td {
        background-color: #eff6ff !important;
    }

    /* Compact Table Inputs */
    .grid-input {
        height: 22px !important;
        line-height: 20px !important;
        padding: 0px 2px !important;
        font-size: 11px !important;
        border: 1px solid #cbd5e1;
        border-radius: 2px;
        background-color: #ffffff;
        color: #0f172a;
        box-sizing: border-box;
        transition: all 0.15s ease-in-out;
    }

    .grid-input:focus {
        border-color: #2563eb !important;
        outline: 0 !important;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2) !important;
        background-color: #ffffff !important;
    }

    .grid-readonly {
        background-color: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
        color: #475569 !important;
        cursor: not-allowed;
        font-weight: 600;
    }

    .grid-total-cell {
        background-color: #ecfdf5 !important;
        color: #065f46 !important;
        font-weight: 700;
        border-color: #a7f3d0 !important;
    }

    /* Hide number spinners for maximum compactness */
    .grid-input::-webkit-outer-spin-button,
    .grid-input::-webkit-inner-spin-button,
    .rowline input::-webkit-outer-spin-button,
    .rowline input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .grid-input[type=number],
    .rowline input[type=number] {
        -moz-appearance: textfield;
    }

    /* Expiry Input Group */
    .expiry-input-group {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 1px;
    }

    .expiry-input-group .exp-month,
    .expiry-input-group .exp-year {
        width: 25px !important;
        height: 22px !important;
        text-align: center;
        padding: 0px !important;
        font-size: 11px !important;
    }

    .expiry-input-group .exp-sep {
        font-weight: bold;
        color: #94a3b8;
        font-size: 11px;
        user-select: none;
    }

    /* Batch Chooser Dropdown */
    .batchchooser {
        display: block;
        width: 100%;
        margin-top: 2px;
        font-size: 10px !important;
        height: 20px !important;
        border-radius: 2px;
        border: 1px solid #3b82f6;
        background: #eff6ff;
        color: #1e3a8a;
        padding: 0px !important;
        font-weight: 600;
    }

    /* Summary Breakdown Styles */
    .summary-card-inner {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 16px;
    }

    .summary-stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 4px 0;
        font-size: 11.5px;
        color: #475569;
        border-bottom: 1px dashed #e2e8f0;
    }

    .summary-stat-row:last-child {
        border-bottom: none;
    }

    .summary-stat-val {
        font-weight: 600;
        color: #1e293b;
    }

    .payable-hero-badge {
        margin-top: 10px;
        padding: 12px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border-radius: 6px;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    .payable-hero-badge .payable-title {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        opacity: 0.9;
    }

    .payable-hero-badge .payable-amount {
        font-size: 20px;
        font-weight: 800;
        margin: 2px 0;
    }

    .payable-hero-badge .payable-words {
        font-size: 10.5px;
        font-style: italic;
        opacity: 0.9;
        line-height: 1.3;
    }

    /* Autocomplete Dropdown */
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==') right center no-repeat;
    }

    /* Modern jQuery UI Autocomplete Floating Dropdown */
    .ui-autocomplete {
        position: absolute !important;
        max-height: 320px;
        min-width: 280px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 9999999 !important;
        border-radius: 8px !important;
        box-shadow: 0 14px 35px -4px rgba(15, 23, 42, 0.28), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        border: 1px solid #cbd5e1 !important;
        padding: 5px !important;
        background: #ffffff !important;
        list-style: none !important;
        margin: 0 !important;
        outline: none !important;
    }

    .ui-autocomplete::-webkit-scrollbar {
        width: 6px;
    }

    .ui-autocomplete::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .ui-autocomplete::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .ui-autocomplete::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Menu Items */
    .ui-autocomplete .ui-menu-item {
        list-style: none !important;
        margin: 2px 0 !important;
        padding: 0 !important;
        border-radius: 6px !important;
        cursor: pointer !important;
        border: 1px solid transparent !important;
        background: #ffffff !important;
        color: #1e293b !important;
        transition: all 0.12s ease-in-out !important;
        user-select: none !important;
        display: block !important;
        text-align: left !important;
    }

    .ui-autocomplete .ui-menu-item>a,
    .ui-autocomplete .ui-menu-item>div,
    .ui-autocomplete .ac-item-inner {
        color: inherit !important;
        text-decoration: none !important;
        display: block !important;
        cursor: pointer !important;
        background: transparent !important;
        border: none !important;
        padding: 8px 12px !important;
        margin: 0 !important;
        pointer-events: auto !important;
    }

    /* Rich Item Content */
    .ui-autocomplete .ac-item-inner {
        display: flex;
        flex-direction: column;
        gap: 3px;
        cursor: pointer !important;
    }

    .ui-autocomplete .ac-item-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.3;
        cursor: pointer !important;
    }

    .ui-autocomplete .ac-item-sub {
        font-size: 11px;
        font-weight: 500;
        color: #64748b;
        line-height: 1.2;
        cursor: pointer !important;
    }

    /* SELECTED / HOVERED / ACTIVE ITEM HIGHLIGHT */
    .ui-autocomplete .ui-menu-item.ui-state-focus,
    .ui-autocomplete .ui-menu-item.ui-state-active,
    .ui-autocomplete .ui-menu-item:hover,
    .ui-autocomplete .ui-menu-item:focus,
    .ui-autocomplete .ui-menu-item.ui-state-hover,
    .ui-autocomplete .ui-state-focus,
    .ui-autocomplete .ui-state-active {
        background: #2563eb !important;
        background-color: #2563eb !important;
        border-color: #1d4ed8 !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.3) !important;
    }

    .ui-autocomplete .ui-menu-item.ui-state-focus .ac-item-title,
    .ui-autocomplete .ui-menu-item.ui-state-active .ac-item-title,
    .ui-autocomplete .ui-menu-item:hover .ac-item-title,
    .ui-autocomplete .ui-menu-item.ui-state-focus *,
    .ui-autocomplete .ui-menu-item.ui-state-active *,
    .ui-autocomplete .ui-menu-item:hover * {
        color: #ffffff !important;
    }

    .ui-autocomplete .ui-menu-item.ui-state-focus .ac-item-sub,
    .ui-autocomplete .ui-menu-item.ui-state-active .ac-item-sub,
    .ui-autocomplete .ui-menu-item:hover .ac-item-sub {
        color: #dbeafe !important;
    }
</style>

<div class="sale-ui-wrap">
    <!-- Top Header Navigation -->
    <div class="sale-page-header">
        <div class="header-titles">
            <h1><i class="fa fa-shopping-bag text-primary"></i> Point of Sale / Create New Sale</h1>
            <p>Generate retail and wholesale customer sales invoices, manage customer dues, track batch inventory, and auto-compute GST.</p>
        </div>
        <div class="header-actions">
            <a href="<?= console_url('sale') ?>" class="btn btn-default" style="border-radius: 6px; font-weight: 600;">
                <i class="fa fa-arrow-left"></i> Back to Sales
            </a>
        </div>
    </div>

    <!-- Alert Notifications -->
    <?php if (isset($status)) : ?>
        <div class="alert alert-<?= $status ?> alert-dismissible" style="border-radius: 6px; font-size: 11.5px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 8px 12px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Main Sale Form -->
    <form method="post" action="" id="saleForm">
        <!-- Section 1: Customer, Doctor & Invoice Card -->
        <div class="pv-card">
            <div class="pv-card-header">
                <h3><i class="fa fa-user-circle text-primary"></i> Customer & Doctor Details</h3>
                <div class="header-right-badges">
                    <span class="label label-primary" style="font-size: 11px; padding: 3px 8px; border-radius: 4px;">
                        Invoice #: <strong><?= generate_invoice_number() ?></strong>
                    </span>
                </div>
            </div>
            <div class="pv-card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Customer Contact <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" autocomplete="off" name="customer_contact" class="form-control" placeholder="Mobile / Phone number" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Customer Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input required="required" type="text" autocomplete="off" name="customer_name" class="form-control" placeholder="Enter customer name" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Customer Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input required="required" type="email" autocomplete="off" name="email" class="form-control" placeholder="customer@example.com" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Invoice Date & Time <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" required="required" autocomplete="off" value="<?= date('d-M-Y H:i:s', time()) ?>" name="sale_date" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 6px;">
                    <div class="col-md-4 col-sm-6 form-group">
                        <label class="control-label">Customer Address</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" autocomplete="off" name="customer_address" class="form-control" placeholder="Address, City, Pincode" />
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <label class="control-label">Customer GSTIN</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                            <input type="text" value="N/A" autocomplete="off" name="customer_gst" class="form-control" placeholder="GSTIN" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Prescribing Doctor <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                            <input required="required" type="text" value="N/A" autocomplete="off" name="doctor_name" class="form-control" placeholder="Dr. Name" />
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Invoice Reference Number</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                            <input readonly="readonly" required="required" type="text" autocomplete="off" value="<?= generate_invoice_number() ?>" name="sale_invoice" class="form-control" style="background-color: #f8fafc; font-weight: 600;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Items Data Grid Card -->
        <div class="pv-card">
            <div class="pv-card-header">
                <h3><i class="fa fa-list-ol text-primary"></i> Sale Items (Medicines)</h3>
                <div class="pv-header-actions" style="display: flex; align-items: center; gap: 8px;">
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 600; color: #475569;">
                        <span>Discount Mode:</span>
                        <select id="discount" name="discount" class="form-control" style="height: 26px; padding: 2px 6px; font-size: 11px; width: 130px; border-radius: 4px;">
                            <option value="1">Individual Disc</option>
                            <option value="2">Grand Disc</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary addm" onclick="addmore()" style="font-weight: 600; border-radius: 4px; font-size: 11px; padding: 3px 8px;">
                        <i class="fa fa-plus"></i> Add Medicine Line
                    </button>
                </div>
            </div>
            <div class="pv-card-body" style="padding: 12px;">
                <div class="table-responsive sale-table-container">
                    <table class="table table-bordered sale-grid-table" id="tableData">
                        <thead>
                            <tr>
                                <th style="width: 28px;">#</th>
                                <th style="min-width: 170px; text-align: left;">Product / Medicine Name <span class="text-danger">*</span></th>
                                <th style="width: 48px;">HSN</th>
                                <th style="width: 52px;">Category</th>
                                <th style="width: 48px;">Schedule</th>
                                <th style="width: 38px; text-align: right;">Strip <span class="text-danger">*</span></th>
                                <th style="width: 38px; text-align: right;">Loose</th>
                                <th style="width: 34px; text-align: center;">Unit</th>
                                <th style="width: 82px;">Batch</th>
                                <th style="width: 65px;">Exp (MM/YY)</th>
                                <th style="width: 95px; text-align: right;">New MRP / MRP (₹)</th>
                                <th style="width: 38px; text-align: right;">Disc %</th>
                                <th style="width: 58px; text-align: right;">Taxable (₹)</th>
                                <th style="width: 38px; text-align: right;">CGST %</th>
                                <th style="width: 50px; text-align: right;">CGST (₹)</th>
                                <th style="width: 38px; text-align: right;">SGST %</th>
                                <th style="width: 50px; text-align: right;">SGST (₹)</th>
                                <th style="width: 65px; text-align: right;">Total (₹)</th>
                                <th style="width: 28px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendHere">
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                    <button type="button" class="btn btn-sm btn-primary addm" onclick="addmore()" style="border-radius: 6px; font-weight: 600;">
                        <i class="fa fa-plus"></i> Add Medicine Line
                    </button>
                    <span class="text-muted" style="font-size: 11px;">
                        <i class="fa fa-keyboard-o"></i> Press <kbd>Tab</kbd> on Discount to auto-insert next line | Click any product to view current live inventory
                    </span>
                </div>
            </div>
        </div>

        <!-- Section 3: Medicine Live Stock Quick Info Panel -->
        <div id="med-info-panel" class="pv-card" style="display: none; border-left: 4px solid #10b981; margin-bottom: 20px;">
            <div id="med_information"></div>
        </div>

        <!-- Section 4: Settlement, Dues & Totals -->
        <div class="row">
            <!-- Left: Payment Method & Notes -->
            <div class="col-md-4 col-sm-12">
                <div class="pv-card" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="pv-card-header">
                        <h3><i class="fa fa-credit-card text-primary"></i> Payment & Settlement</h3>
                    </div>
                    <div class="pv-card-body">
                        <div class="form-group">
                            <label class="control-label">Payment Method</label>
                            <select name="sale_paid_by" class="form-control">
                                <option value="Cash">Cash</option>
                                <option value="Paytm">Paytm / UPI</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Mobikwik">Mobikwik</option>
                                <option value="Bank Deposit">Bank Deposit</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Payment / Transaction Note</label>
                            <textarea name="sale_note" class="form-control" rows="2" placeholder="Reference, transaction ID, comments..."></textarea>
                        </div>
                        <div class="form-group" style="margin-bottom: 14px;">
                            <label style="font-size: 11.5px; font-weight: 600; color: #1e293b; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="print" checked="checked" style="margin: 0; width: 14px; height: 14px;">
                                <span>Print Invoice Immediately After Generation</span>
                            </label>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <button type="submit" id="submit-btn" class="btn btn-success" style="padding: 6px 16px; font-weight: 700; font-size: 12px; border-radius: 6px; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);">
                                <i class="fa fa-check-circle"></i> Generate Bill
                            </button>
                            <button type="button" class="btn btn-default" onclick="goBack()" style="padding: 6px 14px; border-radius: 6px; font-weight: 600; font-size: 11.5px;">
                                <i class="fa fa-arrow-left"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Middle: Due & Payment Breakdown -->
            <div class="col-md-4 col-sm-12">
                <div class="pv-card" style="height: 100%;">
                    <div class="pv-card-header">
                        <h3><i class="fa fa-balance-scale text-primary"></i> Customer Due & Payment</h3>
                    </div>
                    <div class="pv-card-body">
                        <div class="form-group">
                            <label class="control-label">Customer Previous Due (₹)</label>
                            <div class="input-group">
                                <span class="input-group-addon">₹</span>
                                <input type="text" name="sale_total_previous_due" value="0.00" onkeyup="calculateTotal()" class="form-control text-right" style="font-weight: 600; font-size: 11.5px; height: 28px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Amount Paid by Customer (₹)</label>
                            <div class="input-group">
                                <span class="input-group-addon">₹</span>
                                <input type="text" autocomplete="off" name="sale_total_paid" value="" onkeyup="currentdue()" class="form-control sale_total_paid text-right" style="font-weight: 700; font-size: 12.5px; height: 28px; color: #047857;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Current Balance / Remaining Due (₹)</label>
                            <div class="input-group">
                                <span class="input-group-addon">₹</span>
                                <input type="text" name="sale_total_current_due" readonly="readonly" class="form-control text-right" style="font-weight: 700; font-size: 12.5px; height: 28px; color: #dc2626; background: #fef2f2;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Totals & Net Payable -->
            <div class="col-md-4 col-sm-12">
                <div class="pv-card" style="height: 100%;">
                    <div class="pv-card-header">
                        <h3><i class="fa fa-calculator text-primary"></i> Invoice Totals & GST</h3>
                    </div>
                    <div class="pv-card-body">
                        <div class="summary-card-inner">
                            <div class="summary-stat-row">
                                <span>Unique Items:</span>
                                <span class="summary-stat-val totalItem">0</span>
                            </div>
                            <div class="summary-stat-row">
                                <span>MRP Total:</span>
                                <span class="summary-stat-val">₹ <span class="mrptotal">0.00</span></span>
                            </div>
                            <div class="summary-stat-row">
                                <span>Total Discount:</span>
                                <span class="summary-stat-val text-success">₹ <span class="discounttotal">0.00</span></span>
                            </div>
                            <div class="summary-stat-row">
                                <span>Total CGST:</span>
                                <span class="summary-stat-val">₹ <span class="totalCgst">0.00</span></span>
                            </div>
                            <div class="summary-stat-row">
                                <span>Total SGST:</span>
                                <span class="summary-stat-val">₹ <span class="totalSgst">0.00</span></span>
                            </div>
                            <div class="summary-stat-row">
                                <span style="font-weight: 700; color: #1e293b;">Total GST:</span>
                                <span class="summary-stat-val" style="font-weight: 700; color: #1e293b;">₹ <span class="totalgst">0.00</span></span>
                            </div>
                            <div class="summary-stat-row">
                                <span style="font-weight: 700; color: #1e293b;">Bill Amount:</span>
                                <span class="summary-stat-val" style="font-weight: 700; color: #1e293b;">₹ <span class="totalAmount">0.00</span></span>
                            </div>
                        </div>

                        <div class="payable-hero-badge">
                            <div class="payable-title">Customer Payable (Inc. Due)</div>
                            <div class="payable-amount">₹ <span class="customer_payable">0.00</span></div>
                            <div class="payable-words" id="payableWords"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    var rowcount = 0;
    window.currentActiveAutocompleteInput = null;

    function applyBatchData(targetRow, bData, bValue) {
        if (!bData) return;
        var batchName = bValue || bData.batch || bData.sale_batch || bData.medicine_stock_batch || '';
        if (batchName) {
            targetRow.find('[name^="sale_batch[]"]').val(batchName).attr('readonly', 'readonly');
        }

        if (bData.sale_expire_month || bData.expire_month) {
            var em = bData.sale_expire_month || bData.expire_month;
            if (em && em.toString().length === 1) em = '0' + em;
            targetRow.find('[name^="sale_expire_month[]"]').val(em);
        }
        if (bData.sale_expire_year || bData.expire_year) {
            targetRow.find('[name^="sale_expire_year[]"]').val(bData.sale_expire_year || bData.expire_year);
        }

        var mrp = parseFloat(bData.sale_mrp || bData.medicine_mrp || bData.mrp) || 0;
        var newMrp = parseFloat(bData.sale_new_mrp) || 0;
        if (!newMrp && mrp) {
            var gst = (parseFloat(bData.sale_cgst_percent || bData.cgst_percent) || 2.5) * 2;
            if (gst === 12) {
                newMrp = parseFloat((mrp * 0.9375).toFixed(2));
            } else if (gst === 18) {
                newMrp = parseFloat((mrp * 0.8898).toFixed(2));
            } else {
                newMrp = mrp;
            }
        }
        targetRow.find('[name^="sale_mrp[]"]').val(mrp.toFixed(2));
        targetRow.find('[name^="sale_new_mrp[]"]').val((newMrp || mrp).toFixed(2));

        var rate = parseFloat(bData.sale_rate) || 0;
        if (!rate && newMrp) {
            rate = parseFloat((newMrp * 0.7619).toFixed(2));
        }
        targetRow.find('[name^="sale_rate[]"]').val((rate || newMrp || mrp).toFixed(2));

        if (bData.sale_cgst_percent !== undefined && bData.sale_cgst_percent !== null && bData.sale_cgst_percent !== '') {
            var cgstP = parseFloat(bData.sale_cgst_percent) || 2.5;
            targetRow.find('[name^="sale_cgst_percent[]"]').val(cgstP);
            targetRow.find('[name^="sale_sgst_percent[]"]').val(cgstP);
        }

        if (bData.medicine_category && !targetRow.find('[name^="medicine_category[]"]').val()) {
            targetRow.find('[name^="medicine_category[]"]').val(bData.medicine_category);
        }
        if (bData.medicine_schedule && !targetRow.find('[name^="medicine_schedule[]"]').val()) {
            targetRow.find('[name^="medicine_schedule[]"]').val(bData.medicine_schedule);
        }

        if (bData.left_strip !== undefined && bData.left_strip !== null) {
            targetRow.find('[name^="sale_strip_quantity[]"]').attr('max', bData.left_strip);
        }

        calculate_the_sale(targetRow.find('[name^="sale_strip_quantity[]"]'));

        setTimeout(function() {
            targetRow.find('[name^="sale_strip_quantity[]"]').focus().select();
        }, 50);
    }

    function chooseBatch(targetObj) {
        var theRow = $(targetObj).closest('tr');
        var val = $(targetObj).val();

        if (val === "addnew") {
            theRow.find("[name^='sale_batch[]']").removeAttr("readonly").attr("placeholder", "Enter new batch").val("").focus();
        } else if (val && val !== "-") {
            theRow.find("[name^='sale_batch[]']").val(val).attr("readonly", "readonly");
            var medId = theRow.find('[name^="medicine_id[]"]').val();

            $.post('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + medId + '&term=' + encodeURIComponent(val), function(resp) {
                if (resp && resp[0] && resp[0].complete) {
                    applyBatchData(theRow, resp[0].complete, val);
                }
            }, 'json');
        }
    }

    function loadStockBatchesForMedicine(targetRow, medId) {
        if (!medId) {
            calculate_the_sale(targetRow.find('[name^="sale_strip_quantity[]"]'));
            return;
        }

        $.getJSON('<?= console_url("medicine_stock/stock_by_batch") ?>/?medicine_id=' + medId, function(resp) {
            targetRow.find('.batchchooser').remove();

            var batchchooser = $('<select class="batchchooser form-control" onchange="chooseBatch(this)" id="list_' + medId + '" style="height: 28px; padding: 2px 4px; font-size: 11px; font-weight: 600; width: 100%; border-radius: 4px; border: 1px solid #cbd5e1; margin-top: 3px;"></select>');
            batchchooser.append($('<option value="-">--CHOOSE BATCH--</option>'));

            var bestBatch = null;

            if (resp && resp.length > 0) {
                $.each(resp, function(k, v) {
                    batchchooser.append($('<option value="' + v.value + '">' + v.label + '</option>'));
                    if (!bestBatch) {
                        bestBatch = v;
                    } else if (bestBatch.complete && (parseFloat(bestBatch.complete.left_strip) || 0) <= 0 && v.complete && (parseFloat(v.complete.left_strip) || 0) > 0) {
                        bestBatch = v;
                    }
                });
                batchchooser.append($('<option value="addnew">+ Add New Batch</option>'));

                targetRow.find('[name^="sale_batch[]"]').removeAttr('list');
                targetRow.find('[name^="sale_batch[]"]').parent().find('datalist').remove();
                targetRow.find('[name^="sale_batch[]"]').parent().append(batchchooser);
                targetRow.find('[name^="sale_batch[]"]').attr('list', 'list_' + medId);

                // Auto-fill first/best batch details automatically
                if (bestBatch && bestBatch.complete) {
                    batchchooser.val(bestBatch.value);
                    applyBatchData(targetRow, bestBatch.complete, bestBatch.value);
                }
            } else {
                batchchooser.append($('<option value="addnew">+ Add New Batch</option>'));
                targetRow.find('[name^="sale_batch[]"]').removeAttr('list');
                targetRow.find('[name^="sale_batch[]"]').parent().find('datalist').remove();
                targetRow.find('[name^="sale_batch[]"]').parent().append(batchchooser);
                targetRow.find('[name^="sale_batch[]"]').removeAttr('readonly').attr('placeholder', 'Enter batch #').val('').focus();
                calculate_the_sale(targetRow.find('[name^="sale_strip_quantity[]"]'));
            }
        }).fail(function() {
            calculate_the_sale(targetRow.find('[name^="sale_strip_quantity[]"]'));
        });
    }

    function onMedicineSelect(inputElem, item) {
        if (!item) return;
        var targetRow = $(inputElem).closest('tr');
        var comp = item.complete || {};
        var medName = item.value || comp.medicine_name || '';
        var medId = comp.medicine_id || comp.medicine_ID || item.id || '';

        // 1. Fill medicine name into input
        $(inputElem).val(medName);

        // 2. Fill hidden medicine_id
        targetRow.find('[name^="medicine_id[]"]').val(medId);

        // 3. Fill HSN
        if (comp.medicine_hsn !== undefined && comp.medicine_hsn !== null && comp.medicine_hsn !== '') {
            targetRow.find('[name^="medicine_hsn[]"]').val(comp.medicine_hsn);
        }

        // 4. Fill Category
        if (comp.medicine_category) {
            targetRow.find('[name^="medicine_category[]"]').val(comp.medicine_category);
        }

        // 5. Fill Schedule
        if (comp.medicine_schedule) {
            targetRow.find('[name^="medicine_schedule[]"]').val(comp.medicine_schedule);
        }

        // 6. Fill Unit
        if (comp.medicine_unit) {
            var u = parseInt(comp.medicine_unit, 10) || 1;
            targetRow.find('[name^="medicine_unit[]"]').val(u);
        }

        // 7. Fill Discount
        var disc = parseFloat(comp.sale_discount_percent !== undefined ? comp.sale_discount_percent : comp.medicine_discount) || 0;
        targetRow.find('[name^="sale_discount_percent[]"]').val(disc);

        // 8. Fill GST %
        if (comp.medicine_gst !== undefined && comp.medicine_gst !== null && comp.medicine_gst !== '') {
            var fullGst = parseFloat(comp.medicine_gst) || 0;
            var hGst = fullGst > 0 ? (fullGst / 2) : 2.5;
            targetRow.find('[name^="sale_cgst_percent[]"]').val(hGst);
            targetRow.find('[name^="sale_sgst_percent[]"]').val(hGst);
        } else if (comp.sale_cgst_percent) {
            var hGst = parseFloat(comp.sale_cgst_percent) || 2.5;
            targetRow.find('[name^="sale_cgst_percent[]"]').val(hGst);
            targetRow.find('[name^="sale_sgst_percent[]"]').val(hGst);
        }

        // 9. IMMEDIATELY HIDE / REMOVE AUTOCOMPLETE DROPDOWN
        $('.ui-autocomplete').hide();
        try {
            $(inputElem).autocomplete('close');
        } catch (e) {}

        // 10. Automatically fetch stock batches & fill Batch, Expiry, MRP, Rate, Totals
        if (medId) {
            loadStockBatchesForMedicine(targetRow, medId);
        } else {
            calculate_the_sale(targetRow.find('[name^="sale_strip_quantity[]"]'));
        }

        // 11. Refresh quick stock info panel
        get_info(inputElem);
    }

    function addmore() {
        rowcount++;
        var therow = '<tr class="rowline" onclick="highlight_row(this)">' +
            '<td class="text-center">' +
            '<span class="row-sr-number" style="font-weight: 700; color: #475569; font-size: 11px;">' + rowcount + '</span>' +
            '</td>' +
            '<td>' +
            '<input required="required" type="hidden" name="medicine_id[]">' +
            '<input onkeyup="get_info(this)" onfocus="get_info(this)" onclick="get_info(this)" required="required" type="text" name="medicine_name[]" class="grid-input med-name-input" placeholder="Type medicine name..." autocomplete="off" style="width: 100%; min-width: 170px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" readonly="readonly" type="text" name="medicine_hsn[]" class="grid-input grid-readonly text-center" placeholder="HSN" style="width: 48px;">' +
            '</td>' +
            '<td>' +
            '<input readonly="readonly" type="text" name="medicine_category[]" class="grid-input grid-readonly text-center" placeholder="Category" style="width: 52px;">' +
            '</td>' +
            '<td>' +
            '<input readonly="readonly" type="text" name="medicine_schedule[]" class="grid-input grid-readonly text-center" placeholder="Schedule" style="width: 48px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="number" step="1" min="0" name="sale_strip_quantity[]" value="1" oninput="calculate_the_sale(this)" class="grid-input text-right" style="width: 38px; font-weight: 600;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="number" step="1" name="sale_loose_quantity[]" min="0" oninput="calculate_the_sale(this)" value="0" class="grid-input text-right" style="width: 38px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="text" name="medicine_unit[]" onkeyup="calculate_the_sale(this)" class="grid-input text-center" value="1" style="width: 34px;">' +
            '</td>' +
            '<td>' +
            '<div style="position: relative;">' +
            '<input type="text" onchange="calculate_the_sale(this)" autocomplete="off" name="sale_batch[]" pattern="^\\S+$" placeholder="Batch #" class="grid-input text-center" style="width: 100%; min-width: 80px;">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="expiry-input-group">' +
            '<input required="required" type="text" name="sale_expire_month[]" max="12" min="1" maxlength="2" placeholder="MM" class="grid-input exp-month" onfocusout="focusvalidation(this)" pattern="^[0-9]+$" title="Month (01-12)">' +
            '<span class="exp-sep">/</span>' +
            '<input required="required" type="text" name="sale_expire_year[]" onfocusout="focusvalidation(this)" min="17" maxlength="4" placeholder="YY" class="grid-input exp-year" pattern="^[0-9]+$" title="Year (YY or YYYY)">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div style="display: flex; gap: 1px;">' +
            '<input required="required" readonly="readonly" type="text" name="sale_new_mrp[]" onkeyup="calculate_the_sale(this)" value="0.00" class="grid-input text-right grid-readonly" style="width: 46px;" title="Calculated New MRP">' +
            '<input required="required" type="text" name="sale_mrp[]" onkeyup="calculate_the_sale(this)" value="0.00" class="grid-input text-right" style="width: 46px;" title="Original MRP">' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<input required="required" type="hidden" readonly="readonly" name="sale_rate[]" onkeyup="calculate_the_sale(this)" value="0.00">' +
            '<input required="required" class="grid-input sale_grand_dis text-right" type="number" step="0.01" min="0" max="100" name="sale_discount_percent[]" onkeyup="calculate_the_sale(this); calculate_grand_dis();" value="0" style="width: 38px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="text" readonly="readonly" name="sale_taxable[]" class="grid-input text-right grid-readonly" value="0.00" style="width: 58px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="number" step="0.01" min="0" max="100" name="sale_cgst_percent[]" value="2.5" onkeyup="calculate_the_sale(this)" class="grid-input text-right" style="width: 38px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="text" readonly="readonly" name="sale_cgst[]" class="grid-input text-right grid-readonly" value="0.00" style="width: 50px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="number" step="0.01" min="0" max="100" name="sale_sgst_percent[]" value="2.5" onkeyup="calculate_the_sale(this)" class="grid-input text-right" style="width: 38px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" type="text" readonly="readonly" name="sale_sgst[]" class="grid-input text-right grid-readonly" value="0.00" style="width: 50px;">' +
            '</td>' +
            '<td>' +
            '<input required="required" readonly="readonly" type="text" name="sale_total[]" class="grid-input text-right grid-readonly grid-total-cell" value="0.00" style="width: 65px;">' +
            '</td>' +
            '<td class="text-center">' +
            '<button type="button" class="btn btn-xs btn-danger" onclick="removeRow(this)" title="Delete Row" style="padding: 1px 5px; font-size: 10px; border-radius: 3px; line-height: 18px;"><i class="fa fa-trash"></i></button>' +
            '</td>' +
            '</tr>';

        var $newRow = $(therow);
        $('.appendHere').append($newRow);

        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {
                    var $input = $newRow.find('[name="' + targetField + '[]"], [name^="' + targetField + '"]');
                    if (!$input.length) return;

                    var ac = $input.autocomplete({
                        source: '/search.php?location=sale&table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        autoFocus: false,
                        appendTo: "body",
                        open: function() {
                            window.currentActiveAutocompleteInput = $(this);
                            $(this).autocomplete('widget').data('current-input', $(this));
                        },
                        select: function(event, ui) {
                            if (!ui || !ui.item) return false;
                            $('.ui-autocomplete').hide();
                            onMedicineSelect(this, ui.item);
                            return false;
                        }
                    });

                    // Custom Rich Item Card for Medicine Autocomplete
                    if (targetField === 'medicine_name') {
                        var inst = ac.autocomplete("instance") || ac.data("ui-autocomplete");
                        if (inst) {
                            inst._renderItem = function(ul, item) {
                                var comp = item.complete || {};
                                var details = [];
                                if (comp.medicine_manufacturer) details.push(comp.medicine_manufacturer);
                                if (comp.medicine_unit) details.push('Unit: ' + comp.medicine_unit);
                                if (comp.medicine_category) details.push(comp.medicine_category);
                                if (comp.medicine_hsn) details.push('HSN: ' + comp.medicine_hsn);
                                if (comp.medicine_storage) details.push('Loc: ' + comp.medicine_storage);

                                var subHtml = details.length ? '<div class="ac-item-sub">' + details.join(' &bull; ') + '</div>' : '';
                                var itemHtml = '<div class="ac-item-inner">' +
                                    '  <div class="ac-item-title">' + $('<div>').text(item.label).html() + '</div>' +
                                    subHtml +
                                    '</div>';

                                return $("<li>")
                                    .data("ui-autocomplete-item", item)
                                    .append(itemHtml)
                                    .appendTo(ul);
                            };
                        }
                    }

                    $newRow.find('[name^="sale_discount_percent[]"]').keydown(function(e) {
                        var keyCode = e.keyCode || e.which;
                        if (keyCode === 9 && !(e.shiftKey)) {
                            e.preventDefault();
                            $('.addm:first').click();
                        }
                    });
                });
            });
        <?php endif; ?>

        calculateTotal();
        disp_calc();
        $(".rowline:last").find('[name^="medicine_name[]"]').focus();
    }

    function removeRow(targetObj) {
        if ($('.rowline').length > 1) {
            $(targetObj).closest('.rowline').remove();
            renumber_rows();
            calculateTotal();
            disp_calc();
        } else {
            alert('At least one item line is required for sales generation.');
        }
    }

    function renumber_rows() {
        $('.rowline').each(function(index) {
            $(this).find('.row-sr-number').text(index + 1);
        });
        rowcount = $('.rowline').length;
    }

    function highlight_row(elem) {
        $('.rowline').removeClass('row-active');
        $(elem).addClass('row-active');
    }

    function currentdue() {
        var paid = parseFloat($(document).find('[name="sale_total_paid"]').val()) || 0;
        var payableVal = parseFloat($('.customer_payable').attr('data-payable')) || parseFloat($('.customer_payable').text()) || 0;
        var due = Math.round(payableVal - paid);
        $('[name="sale_total_current_due"]').val(due.toFixed(2));
    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;
        var previousDue = parseFloat($(document).find('[name="sale_total_previous_due"]').val()) || 0;

        $('.rowline').each(function() {
            totalCgst += parseFloat($(this).find('[name="sale_cgst[]"]').val()) || 0;
            totalSgst += parseFloat($(this).find('[name="sale_sgst[]"]').val()) || 0;
            totalTotal += parseFloat($(this).find('[name="sale_total[]"]').val()) || 0;
        });

        var totalPayableAmount = (previousDue + totalTotal);

        $('.totalItem').html(totalItem);
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));

        var roundedPayable = Math.round(totalPayableAmount);
        $('.customer_payable').attr('data-payable', roundedPayable);
        $('.customer_payable').html(roundedPayable.toFixed(2));

        var words = price_in_words(roundedPayable);
        $('#payableWords').html(words ? words : '');

        // Auto-fill paid if not explicitly edited by user
        if (!$('.sale_total_paid').data('user-edited')) {
            $('.sale_total_paid').val(roundedPayable.toFixed(2));
            currentdue();
        } else {
            currentdue();
        }
    }

    $(document).ready(function() {
        // Track manual changes to paid field
        $('.sale_total_paid').on('input change', function() {
            $(this).data('user-edited', true);
            currentdue();
        });

        $('#discount').change(function() {
            var select_dis = $('#discount').val();
            if (select_dis === "2") {
                var first_enter_value = $(".sale_grand_dis").first().val() || "0";
                $('.sale_grand_dis').val(first_enter_value);
            } else {
                $('.sale_grand_dis').val(0.00);
            }
            disp_calc();
        });

        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);

        // Add initial row
        addmore();

        $('[name="customer_contact"]').focus();

        $("[name='sale_date']").datetimepicker({
            format: 'd-M-Y H:i:s'
        });

        <?php if (isset($this->page_config['autocomplete'])) : ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function(targetField, value) {
                $.each(value, function(model, fieldToSearch) {
                    var $custInput = $('[name="' + targetField + '"]');
                    if (!$custInput.length) return;

                    var custAC = $custInput.autocomplete({
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        autoFocus: false,
                        appendTo: "body",
                        open: function() {
                            window.currentActiveAutocompleteInput = $(this);
                            $(this).autocomplete('widget').data('current-input', $(this));
                        },
                        select: function(event, ui) {
                            if (!ui || !ui.item) return false;
                            $('.ui-autocomplete').hide();
                            $(this).val(ui.item.value);

                            if (ui.item.complete) {
                                $.each(ui.item.complete, function(populate_field, populate_value) {
                                    $('[name="' + populate_field + '"]').val(populate_value);
                                });
                                calculateTotal();
                                disp_calc();
                            }
                            return false;
                        }
                    });

                    if (targetField === 'customer_name' || targetField === 'customer_contact' || targetField === 'doctor_name') {
                        var custInst = custAC.autocomplete("instance") || custAC.data("ui-autocomplete");
                        if (custInst) {
                            custInst._renderItem = function(ul, item) {
                                var comp = item.complete || {};
                                var details = [];
                                if (comp.customer_contact) details.push('Ph: ' + comp.customer_contact);
                                if (comp.customer_address) details.push(comp.customer_address);
                                if (comp.customer_gst) details.push('GST: ' + comp.customer_gst);

                                var subHtml = details.length ? '<div class="ac-item-sub">' + details.join(' &bull; ') + '</div>' : '';
                                var itemHtml = '<div class="ac-item-inner">' +
                                    '  <div class="ac-item-title">' + $('<div>').text(item.label).html() + '</div>' +
                                    subHtml +
                                    '</div>';

                                return $("<li>")
                                    .data("ui-autocomplete-item", item)
                                    .append(itemHtml)
                                    .appendTo(ul);
                            };
                        }
                    }
                });
            });
        <?php endif; ?>

        // 100% Robust Instant Selection and Removal of Autocomplete Dropdown on Mouse Click
        $(document).on('mousedown', '.ui-autocomplete .ui-menu-item', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $item = $(this).closest('.ui-menu-item');
            var itemData = $item.data('ui-autocomplete-item') || $item.data('item.autocomplete');
            var $menu = $item.closest('.ui-autocomplete');
            var $targetInput = $menu.data('current-input') || window.currentActiveAutocompleteInput;

            // Remove and hide all autocomplete dropdown menus immediately
            $('.ui-autocomplete').hide();

            if ($targetInput && $targetInput.length && itemData) {
                try {
                    $targetInput.autocomplete('close');
                } catch (err) {}

                if ($targetInput.is('[name^="medicine_name"]')) {
                    onMedicineSelect($targetInput, itemData);
                } else {
                    $targetInput.val(itemData.value);
                    if (itemData.complete) {
                        $.each(itemData.complete, function(populate_field, populate_value) {
                            $('[name="' + populate_field + '"]').val(populate_value);
                        });
                        calculateTotal();
                        disp_calc();
                    }
                }
            }
        });

        // Close / remove autocomplete menu when clicking anywhere outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.ui-autocomplete, input').length) {
                $('.ui-autocomplete').hide();
            }
        });
    });

    function calculate_grand_dis() {
        var select_dis_val = $('#discount').val();
        if (select_dis_val === "2") {
            var first_enter_value = $(".sale_grand_dis").first().val();
            $('.sale_grand_dis').val(first_enter_value);
        }
    }

    function saveTheData(targetObj) {
        $.post(page_url + 'add_detail', $(targetObj).serialize(), function(resp) {
            return false;
        });
        return false;
    }

    function calculate_the_sale(targetObject) {
        const $row = $(targetObject).closest('tr');

        let old_mrp = parseFloat($row.find('[name="sale_mrp[]"]').val()) || 0;
        let old_gst = (parseFloat($row.find('[name="sale_cgst_percent[]"]').val()) || 0) * 2;
        let new_mrp = parseFloat($row.find('[name="sale_new_mrp[]"]').val()) || 0;

        if (old_mrp && (!new_mrp || new_mrp === old_mrp)) {
            if (old_gst === 12) {
                new_mrp = (old_mrp * 0.9375).toFixed(2);
            } else if (old_gst === 18) {
                new_mrp = (old_mrp * 0.8898).toFixed(2);
            } else {
                new_mrp = old_mrp.toFixed(2);
            }
            $row.find('[name="sale_new_mrp[]"]').val(new_mrp);
        }

        const cgst_percent = parseFloat($row.find('[name="sale_cgst_percent[]"]').val()) || 2.5;
        const sgst_percent = parseFloat($row.find('[name="sale_sgst_percent[]"]').val()) || cgst_percent;
        $row.find('[name="sale_cgst_percent[]"]').val(cgst_percent);
        $row.find('[name="sale_sgst_percent[]"]').val(sgst_percent);

        let rate = parseFloat(new_mrp).toFixed(2);
        $row.find('[name="sale_rate[]"]').val(rate);

        const unit = parseFloat($row.find('[name="medicine_unit[]"]').val()) || 1;
        const strip_qty = parseFloat($row.find('[name="sale_strip_quantity[]"]').val()) || 0;
        const loose_qty = parseFloat($row.find('[name="sale_loose_quantity[]"]').val()) || 0;
        const discount_percent = parseFloat($row.find('[name="sale_discount_percent[]"]').val()) || 0;
        const qty = (strip_qty * unit) + loose_qty;

        const total = (rate * qty / unit);
        const total_discount = total * discount_percent / 100;
        const taxable = total - total_discount;
        const cgst_amt = taxable * cgst_percent / 100;
        const sgst_amt = taxable * sgst_percent / 100;
        const grand_total = taxable + cgst_amt + sgst_amt;

        $row.find('[name="sale_taxable[]"]').val(taxable.toFixed(2));
        $row.find('[name="sale_cgst[]"]').val(cgst_amt.toFixed(2));
        $row.find('[name="sale_sgst[]"]').val(sgst_amt.toFixed(2));
        $row.find('[name="sale_total[]"]').val(grand_total.toFixed(2));

        calculateTotal();
        disp_calc();
    }

    function mrp2rate(mrp, cgst) {
        return mrp * 50 / (50 + cgst);
    }

    function focusvalidation(obg) {
        var val = parseInt($(obg).val(), 10);
        if (val > 31 || val < 1) {
            alert('Value must be a valid month or year.');
            $(obg).val('');
            setTimeout(function() {
                $(obg).focus();
            }, 50);
            return false;
        }
    }

    function disp_calc() {
        var total_mrp = 0;
        var total = 0;

        $('.rowline').each(function() {
            var new_mrp = parseFloat($(this).find('[name="sale_new_mrp[]"]').val()) || 0;
            var line_total = parseFloat($(this).find('[name="sale_total[]"]').val()) || 0;
            total_mrp += new_mrp;
            total += line_total;
        });

        var finalDiscount = (total_mrp - total);
        $('span.discounttotal').html(Math.max(0, finalDiscount).toFixed(2));
        $('span.mrptotal').html(total_mrp.toFixed(2));
    }

    function get_info(targetObj) {
        var medName = $(targetObj).closest('.rowline').find('[name^="medicine_name[]"]').val();
        if (!medName || medName.trim().length <= 1) return;

        $.post('/console/medicine_stock/get_info', {
            medicine: medName.trim()
        }, function(resp) {
            $('#med_information').html(resp);
            $('#med-info-panel').slideDown(200);
        });
    }

    function hide_info() {
        $('#med-info-panel').slideUp(150, function() {
            $('#med_information').html('');
        });
    }

    function get_stock_info(targetObj) {
        var medName = $(targetObj).closest('.rowline').find('[name^="medicine_name[]"]').val();
        if (!medName) return;

        $.post('/console/medicine_stock/get_stock_info', {
            medicine: medName
        }, function(resp) {
            var current_val = parseFloat($(targetObj).val()) || 0;
            if (resp && resp.left_strip && current_val > resp.left_strip) {
                alert("Entered quantity exceeds available stock (" + resp.left_strip + " strips).");
                $(targetObj).val(resp.left_strip);
                calculate_the_sale(targetObj);
            }
        });
    }

    function price_in_words(price) {
        var sglDigit = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"],
            dblDigit = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"],
            tensPlace = ["", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"],
            handle_tens = function(dgt, prevDgt) {
                return 0 == dgt ? "" : " " + (1 == dgt ? dblDigit[prevDgt] : tensPlace[dgt])
            },
            handle_utlc = function(dgt, nxtDgt, denom) {
                return (0 != dgt && 1 != nxtDgt ? " " + sglDigit[dgt] : "") + (0 != nxtDgt || dgt > 0 ? " " + denom : "")
            };

        var str = "",
            digitIdx = 0,
            digit = 0,
            nxtDigit = 0,
            words = [];
        if (price += "", isNaN(parseInt(price))) str = "";
        else if (parseInt(price) > 0 && price.length <= 10) {
            for (digitIdx = price.length - 1; digitIdx >= 0; digitIdx--) switch (digit = price[digitIdx] - 0, nxtDigit = digitIdx > 0 ? price[digitIdx - 1] - 0 : 0, price.length - digitIdx - 1) {
                case 0:
                    words.push(handle_utlc(digit, nxtDigit, ""));
                    break;
                case 1:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 2:
                    words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] && 0 != price[digitIdx + 2] ? " and" : "") : "");
                    break;
                case 3:
                    words.push(handle_utlc(digit, nxtDigit, "Thousand"));
                    break;
                case 4:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 5:
                    words.push(handle_utlc(digit, nxtDigit, "Lakh"));
                    break;
                case 6:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 7:
                    words.push(handle_utlc(digit, nxtDigit, "Crore"));
                    break;
                case 8:
                    words.push(handle_tens(digit, price[digitIdx + 1]));
                    break;
                case 9:
                    words.push(0 != digit ? " " + sglDigit[digit] + " Hundred" + (0 != price[digitIdx + 1] || 0 != price[digitIdx + 2] ? " and" : " Crore") : "")
            }
            str = words.reverse().join("") + " Rupees Only";
        } else str = "";
        return str;
    }
</script>