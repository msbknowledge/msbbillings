<?php
/**
 * Modern Responsive Purchase Entry View (Add Detail)
 * Module: Antu / Medical POS
 * Location: modules/antu/views/console/purchase/add_detail.php
 */
?>
<style>
    /* Scoped Modern UI for Purchase Add Detail */
    .purchase-ui-wrap {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #1e293b;
        margin: 5px 0 40px 0;
    }

    /* Page Header */
    .purchase-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e2e8f0;
    }
    .purchase-page-header .header-titles h1 {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: -0.02em;
    }
    .purchase-page-header .header-titles p {
        margin: 0;
        font-size: 11.5px;
        color: #64748b;
    }

    /* Modern Card Box */
    .purchase-ui-wrap .pv-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 2px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 16px;
        overflow: hidden;
    }
    .purchase-ui-wrap .pv-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 8px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
    }
    .purchase-ui-wrap .pv-card-header h3 {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .purchase-ui-wrap .pv-card-body {
        padding: 12px 14px;
    }

    /* Form Fields */
    .purchase-ui-wrap .control-label {
        font-size: 11px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 3px;
    }
    .purchase-ui-wrap .form-control {
        border-radius: 4px;
        border-color: #cbd5e1;
        box-shadow: none;
        font-size: 11.5px;
        height: 28px;
        padding: 3px 8px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .purchase-ui-wrap .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
    .purchase-ui-wrap .input-group-addon {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #64748b;
        border-radius: 4px 0 0 4px;
        font-size: 11.5px;
        padding: 3px 8px;
    }

    /* Grid Table Styles */
    .purchase-table-container {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #ffffff;
        max-height: 540px;
        overflow-y: auto;
        overflow-x: auto;
    }
    .purchase-grid-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    .purchase-grid-table thead th {
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
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }
    .purchase-grid-table tbody td {
        padding: 0px !important;
        border: 1px solid #e2e8f0;
        vertical-align: middle;
        background-color: #ffffff;
    }
    .purchase-grid-table tbody td input,
    .purchase-grid-table tbody td select {
        padding: 0px !important;
    }
    .purchase-grid-table tbody tr.rowline:hover td {
        background-color: #f8fafc;
    }
    .purchase-grid-table tbody tr.row-active td {
        background-color: #eff6ff !important;
    }
    .purchase-grid-table tbody tr.row-expiring-soon td {
        background-color: #fef2f2 !important;
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

    /* Totals & Summary Breakdown */
    .summary-breakdown {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px 18px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 4px 0;
        font-size: 11.5px;
        color: #475569;
        border-bottom: 1px dashed #e2e8f0;
    }
    .summary-row:last-child {
        border-bottom: none;
    }
    .summary-value {
        font-weight: 600;
        color: #1e293b;
    }
    .summary-grand-total {
        margin-top: 10px;
        padding: 10px 14px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border-radius: 6px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }
    .summary-grand-total .grand-label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }
    .summary-grand-total .grand-amount {
        font-size: 19px;
        font-weight: 800;
    }

    /* Autocomplete Styling */
    .ui-autocomplete-loading {
        background: white url('data:image/gif;base64,R0lGODlhEAAQAPMPALu7u5mZmTMzM93d3REREQAAAHd3d1VVVWZmZqqqqoiIiO7u7kRERCIiIgARAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFBwAPACwAAAAAEAAQAEAEcPDJtyg6dUrFetDTIopMoSyFcxxD1krD8AwCkASDIlPaUDQLR6G1Cy0SgqIkE1IQGMrFAKCcGWSBzwPAnAwarcKQ15MpTMJYd1ZyUDXSDGelBY0qIoBh/ZoYGgELCjoxCRRvIQcGD1kzgSAgAACQDxEAIfkEBQcADwAsAAAAAA8AEAAABF3wyfkMkotOJpscRKJJwtI4Q1MAoxQ0RFBw0xEvhGAVRZZJh4JgMAEQW7TWI4EwGFjKR+CAQECjn8DoN0kwDtvBT8FILAKJgfoo1iAGAPNVY9DGJXNMIHN/HJVqIxEAIfkEBQcADwAsAAAAABAADwAABFrwyfmColgiydpaQiY5x9Ith7hURdIl0wBIhpCAjKIIxaAUPQ0hFQsAC7MJALFSFi4SgC4wyHyuCYNWxH3AuhSEotkNGAALAPqqkigG8MWAjAnM4A8594vPUyIAIfkEBQcADwAsAAAAABAAEAAABF3wySkDvdKsddg+APYIWrcg2DIRQAcU6DJICjIsjBEETLEEBYLqYSDdJoCGiHgZwG4LQCCRECEIBAdoF5hdEIWwgBJqDs7DgcKyRHZl3uUwuhm2AbNNW+LV7yd+FxEAIfkEBQcACAAsAAAAABAADgAABEYQyYmMoVgeWQrP3NYhBCgZBdAFRUkdBIAUguVVo1ZsWFcEGB5GMBkEjiCBL2a5ZAi+m2SAURExwKqPiuCafBkvBSCcmiYRACH5BAUHAA4ALAAAAAAQABAAAARs0MnpAKDYrbSWMp0xZIvBKYrXjNmADOhAKBiQDF5gGcICNAyJTwFYTBaDQ0HAkgwSmAUj0OkMrkZM4HBgKK7YTKDRICAo2clAEIheKc9CISjEVTuEQrJASGcSBQcSUFEUDQUXJBgDBW0Zj34RACH5BAUHAA8ALAAAAAAQABAAAARf8Mn5xqBYgrVC4EEmBcOSfAEjSopJMglmcQlgBYjE5NJgZwjCAbO4YBAJjpIjSiAQh5ayyRAIDKvJIbnIagoFRFdkQDQKC0RBsCIUFAWsT7RwG410R8HiiK0WBwJjFBEAIfkEBQcADgAsAQABAA8ADwAABFrQybEWADXJLUHHAMJxIDAgnrOo2+AOibEMh1LN62gIxphzitRoCDAYNcNN6FBLShao4WzwHDQKvVGhoFAwGgtFgQHENhoB7nCwHRAIC0EyUcC8Zw1ha3NIRgAAIfkEBQcADwAsAAAAABAAEAAABGDwyfnWoljaNYYFV+Zx3hCEGEcuypBtMJBISpClAWLfWODymIFiCJwMDMiZBNAAYFqUAaNQ2E0YBIXGURAMCo1AAsFYBBoIScBJEwgSVcmP0li4FwcHz+FpCCQMPCFINxEAIfkEBQcADgAsAAABABAADwAABFzQyemWXYNqaSXY2vVtw3UNmROM4JQowKKlFOsgRI6ASQ8IhSADFAjAMIMAgSYJtByxyQIhcEoaBcSiwegpDgvAwSBJ0AIHBoCQqIAEi/TCIAABGhLG8MbcKBQgEQAh+QQFBwAPACwAAAEAEAAPAAAEXfDJSd+qeK5RB8fDRRWFspyotAAfQBbfNLCVUSSdKDV89gDAwcFBIBgywMRnkWBgcJUDKSZRIKAPQcGwYByAAYTEEJAAJIGbATEQ+B4ExmK9CDhBd8ThdHw/AmUYEQAh+QQFBwAPACwAAAEADwAPAAAEXvBJQIa8+ILSspdHkXxS9wxF4Q3L2aTBeC0sFjhAtuyLIjAMhYc2GBgaSKGuyNoBDp7czFAgeBIKwC6kWCAMxUSAFjtNCAAFGGF5tCQLAaJnWCTqHoREvQuQJAkyGBEAOw==')
        right center no-repeat;
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
    .ui-autocomplete .ui-menu-item > a,
    .ui-autocomplete .ui-menu-item > div,
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

<div class="purchase-ui-wrap">
    <!-- Page Header Bar -->
    <div class="purchase-page-header">
        <div class="header-titles">
            <h1><i class="fa fa-shopping-cart text-primary"></i> New Purchase Entry</h1>
            <p>Record supplier invoices, incoming products, batch tracking, expiry dates, and automatic GST computations.</p>
        </div>
        <div class="header-actions">
            <a href="<?= console_url('purchase') ?>" class="btn btn-default" style="border-radius: 6px; font-weight: 600;">
                <i class="fa fa-arrow-left"></i> Back to Purchases
            </a>
        </div>
    </div>

    <!-- System Alerts -->
    <?php if (isset($status)): ?>
        <div class="alert alert-<?= $status ?> alert-dismissible" style="border-radius: 6px; font-size: 11.5px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 8px 12px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $message ?>
        </div>
    <?php endif; ?>

    <!-- Main Entry Form -->
    <form method="post" action="" enctype="multipart/form-data" id="purchaseAddForm">
        <!-- Section 1: Supplier & Invoice Details Card -->
        <div class="pv-card">
            <div class="pv-card-header">
                <h3><i class="fa fa-truck text-primary"></i> Supplier & Invoice Details</h3>
                <span class="label label-primary" style="font-size: 11px; padding: 3px 8px; border-radius: 4px;">
                    Entry #: <strong><?= generate_purchase_number() ?></strong>
                </span>
            </div>
            <div class="pv-card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Supplier Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input required="required" type="text" autocomplete="off" name="supplier_name" class="form-control" placeholder="Search / enter supplier"/>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Supplier Address <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input required="required" type="text" autocomplete="off" name="supplier_address" class="form-control" placeholder="Address, City"/>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <label class="control-label">Supplier Contact <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input required="required" type="text" autocomplete="off" name="supplier_contact" class="form-control" placeholder="Phone number"/>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <label class="control-label">Supplier GSTIN</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                            <input type="text" autocomplete="off" name="supplier_gst" class="form-control" placeholder="GSTIN No"/>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <label class="control-label">Purchase Date <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" required="required" autocomplete="off" name="purchase_date" class="form-control" value="<?= date('d-m-Y') ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 6px;">
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Supplier Invoice No <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                            <input required="required" onkeyup="check_invoice()" onblur="check_invoice()" type="text" autocomplete="off" name="purchase_invoice" class="form-control" placeholder="Invoice Number"/>
                        </div>
                        <div id="duplicate_invoice_alert" style="display: none; margin-top: 6px; padding: 5px 10px; font-size: 11px; border-radius: 4px; background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;">
                            <i class="fa fa-exclamation-triangle"></i> <strong>Duplicate Detected:</strong> Invoice number already exists for this supplier!
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 form-group">
                        <label class="control-label">Purchase Entry Number</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input required="required" readonly="readonly" value="<?= generate_purchase_number() ?>" type="text" name="purchase_entry_number" class="form-control" style="background-color: #f8fafc; font-weight: 600;"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group" style="padding-top: 24px;">
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-info-circle text-primary"></i> Select an existing supplier to auto-populate address, contact, and GSTIN details.
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Purchased Items Card -->
        <div class="pv-card">
            <div class="pv-card-header">
                <h3><i class="fa fa-list-ol text-primary"></i> Purchased Items Grid</h3>
                <div class="pv-header-actions">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addmore()" style="font-weight: 600; border-radius: 6px;">
                        <i class="fa fa-plus"></i> Add Item Row
                    </button>
                </div>
            </div>
            <div class="pv-card-body" style="padding: 12px;">
                <div class="table-responsive purchase-table-container">
                    <table class="table table-bordered purchase-grid-table">
                        <thead>
                            <tr>
                                <th style="width: 28px;">#</th>
                                <th style="min-width: 170px; text-align: left;">Product / Medicine Name <span class="text-danger">*</span></th>
                                <th style="width: 52px;">HSN</th>
                                <th style="width: 52px;">Storage</th>
                                <th style="width: 52px;">Category</th>
                                <th style="width: 52px;">Schedule</th>
                                <th style="width: 78px;">Manufacturer</th>
                                <th style="width: 42px; text-align: right;">Qty <span class="text-danger">*</span></th>
                                <th style="width: 42px; text-align: right;">Free Qty</th>
                                <th style="width: 36px;">Unit</th>
                                <th style="width: 78px;">Batch <span class="text-danger">*</span></th>
                                <th style="width: 65px;">Exp (MM/YY) <span class="text-danger">*</span></th>
                                <th style="width: 54px; text-align: right;">MRP (₹)</th>
                                <th style="width: 54px; text-align: right;">Rate (₹) <span class="text-danger">*</span></th>
                                <th style="width: 38px; text-align: right;">Disc %</th>
                                <th style="width: 38px; text-align: right;">Bonus %</th>
                                <th style="width: 60px; text-align: right;">Taxable (₹)</th>
                                <th style="width: 38px; text-align: right;">CGST %</th>
                                <th style="width: 54px; text-align: right;">CGST (₹)</th>
                                <th style="width: 38px; text-align: right;">SGST %</th>
                                <th style="width: 54px; text-align: right;">SGST (₹)</th>
                                <th style="width: 70px; text-align: right;">Total (₹)</th>
                                <th style="width: 28px;">Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendHere">
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addmore()" style="border-radius: 6px; font-weight: 600;">
                        <i class="fa fa-plus"></i> Add Item Row
                    </button>
                    <span class="text-muted" style="font-size: 11px;">
                        <i class="fa fa-keyboard-o"></i> Press <kbd>Tab</kbd> on Total to auto-add new row | Click any item to inspect previous purchase rates
                    </span>
                </div>
            </div>
        </div>

        <!-- Section 3: Product Purchase History Panel (Appears on row click/focus) -->
        <div id="history-panel" class="pv-card" style="display: none; border-left: 4px solid #2563eb; margin-bottom: 20px;">
            <div id="history"></div>
        </div>

        <!-- Section 4: Totals & Save Actions Row -->
        <div class="row">
            <!-- Left: Confirmation & Actions -->
            <div class="col-md-6 col-sm-12">
                <div class="pv-card" style="min-height: 250px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div class="pv-card-header">
                        <h3><i class="fa fa-check-square-o text-success"></i> Save Purchase Bill</h3>
                    </div>
                    <div class="pv-card-body">
                        <p style="font-size: 11.5px; color: #475569; margin-bottom: 10px;">
                            Please double-check invoice numbers, batch identifiers, expiry dates, and calculated totals before submitting.
                        </p>
                        <div style="font-size: 11px; color: #64748b; line-height: 1.6; margin-bottom: 16px;">
                            <div><i class="fa fa-check-circle text-success"></i> Inventory stock levels will be immediately updated.</div>
                            <div><i class="fa fa-check-circle text-success"></i> Expiry dates within 30 days are flagged in soft warning color.</div>
                            <div><i class="fa fa-check-circle text-success"></i> GST & Taxable amounts are auto-rounded to 2 decimal places.</div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                            <button type="submit" class="btn btn-success" onclick="check_medicine()" style="padding: 6px 16px; font-weight: 700; font-size: 12px; border-radius: 6px; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);">
                                <i class="fa fa-save"></i> Save Purchase Bill
                            </button>
                            <button type="button" class="btn btn-default" onclick="goBack()" style="padding: 6px 14px; border-radius: 6px; font-weight: 600; font-size: 11.5px;">
                                <i class="fa fa-arrow-left"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Calculation Breakdown -->
            <div class="col-md-6 col-sm-12">
                <div class="pv-card">
                    <div class="pv-card-header">
                        <h3><i class="fa fa-calculator text-primary"></i> Invoice Summary & GST Totals</h3>
                    </div>
                    <div class="pv-card-body" style="padding: 15px 18px;">
                        <div class="summary-breakdown">
                            <div class="summary-row">
                                <span class="summary-label">Total Product Lines:</span>
                                <span class="summary-value font-bold totalItem">0</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Total Taxable Amount:</span>
                                <span class="summary-value">₹ <span class="totalTaxable">0.00</span></span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Total CGST:</span>
                                <span class="summary-value">₹ <span class="totalCgst">0.00</span></span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Total SGST:</span>
                                <span class="summary-value">₹ <span class="totalSgst">0.00</span></span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label font-bold" style="color: #334155;">Total GST Tax:</span>
                                <span class="summary-value font-bold" style="color: #334155;">₹ <span class="totalgst">0.00</span></span>
                            </div>
                            <div class="summary-grand-total">
                                <div class="grand-label">Grand Total (Net Payable)</div>
                                <div class="grand-amount">₹ <span class="totalAmount">0.00</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    var rowcount = 0;

    function addmore() {
        rowcount++;
        var therow = '<tr class="rowline" onclick="highlight_row(this); get_history(this);">' +
            '<td class="text-center">' +
                '<span class="row-sr-number" style="font-weight: 700; color: #475569; font-size: 11px;">' + rowcount + '</span>' +
            '</td>' +
            '<td>' +
                '<input required="required" type="text" name="medicine_name[]" onchange="check_medicine(this)" class="grid-input med-name-input" placeholder="Type medicine name..." autocomplete="off" style="width: 100%; min-width: 170px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="text" name="medicine_hsn[]" class="grid-input text-center" placeholder="HSN" style="width: 52px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="text" name="medicine_storage[]" class="grid-input text-center" placeholder="Storage" style="width: 52px;">' +
            '</td>' +
            '<td>' +
                '<input type="text" name="medicine_category[]" class="grid-input text-center" placeholder="Category" style="width: 52px;">' +
            '</td>' +
            '<td>' +
                '<input type="text" name="medicine_schedule[]" class="grid-input text-center" placeholder="Schedule" style="width: 52px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="text" name="medicine_manufacturer[]" class="grid-input" placeholder="Mfg / Company" style="width: 78px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" name="purchase_quantity[]" step="0.01" min="0" onkeyup="gst_calculation(this)" onchange="gst_calculation(this)" value="1" class="grid-input text-right" style="width: 42px; font-weight: 600;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" name="purchase_free_quantity[]" step="0.01" min="0" onkeyup="gst_calculation(this)" onchange="gst_calculation(this)" value="0" class="grid-input text-right" style="width: 42px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" name="medicine_unit[]" class="grid-input text-center" value="1" style="width: 36px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="text" name="purchase_batch[]" onclick="get_reminder(this)" pattern="^\\S+$" class="grid-input text-center" placeholder="Batch #" style="width: 78px;" title="No spaces allowed">' +
            '</td>' +
            '<td>' +
                '<div class="expiry-input-group">' +
                    '<input required="required" type="text" name="purchase_expire_month[]" max="12" min="1" maxlength="2" placeholder="MM" class="grid-input exp-month" onfocusout="focusvalidation(this)" pattern="^[0-9]+$" title="Month (01-12)">' +
                    '<span class="exp-sep">/</span>' +
                    '<input required="required" type="text" name="purchase_expire_year[]" maxlength="4" placeholder="YY" class="grid-input exp-year" pattern="^[0-9]+$" title="Year (YY or YYYY)">' +
                '</div>' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" step="0.01" min="0" name="purchase_mrp[]" value="0.00" class="grid-input text-right" style="width: 54px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" step="0.01" min="0" name="purchase_rate[]" onkeyup="gst_calculation(this)" onchange="gst_calculation(this)" value="0.00" class="grid-input text-right" style="width: 54px; font-weight: 600;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" step="0.01" min="0" max="100" name="purchase_discount_percent[]" onkeyup="gst_calculation(this)" onchange="gst_calculation(this)" value="0" class="grid-input text-right" style="width: 38px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" step="0.01" min="0" max="100" name="purchase_bonus[]" onkeyup="gst_calculation(this)" onchange="gst_calculation(this)" value="0.00" class="grid-input text-right" style="width: 38px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" readonly="readonly" type="text" name="purchase_taxable[]" class="grid-input text-right grid-readonly" value="0.00" style="width: 60px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" type="number" step="0.01" min="0" max="100" name="purchase_cgst_percent[]" value="0" onkeyup="gst_calculation(this)" onchange="gst_calculation(this)" class="grid-input text-right" style="width: 38px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" readonly="readonly" type="text" name="purchase_cgst[]" class="grid-input text-right grid-readonly" value="0.00" style="width: 54px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" readonly="readonly" type="text" name="purchase_sgst_percent[]" value="0" class="grid-input text-right grid-readonly" style="width: 38px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" readonly="readonly" type="text" name="purchase_sgst[]" class="grid-input text-right grid-readonly" value="0.00" style="width: 54px;">' +
            '</td>' +
            '<td>' +
                '<input required="required" readonly="readonly" type="text" name="purchase_total[]" class="grid-input text-right grid-readonly grid-total-cell" value="0.00" style="width: 70px;">' +
            '</td>' +
            '<td class="text-center">' +
                '<button type="button" class="btn btn-xs btn-danger" onclick="removeRow(this)" title="Delete Row" style="padding: 1px 5px; font-size: 10px; border-radius: 3px; line-height: 18px;"><i class="fa fa-trash"></i></button>' +
            '</td>' +
        '</tr>';

        var $newRow = $(therow);
        $('.appendHere').append($newRow);

        <?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    var $input = $newRow.find('[name="' + targetField + '[]"], [name^="' + targetField + '"]');
                    if (!$input.length) return;

                    var ac = $input.autocomplete({
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        autoFocus: false,
                        appendTo: "body",
                        open: function () {
                            $(this).autocomplete('widget').data('current-input', $(this));
                        },
                        select: function (event, ui) {
                            var targetRow = $(this).closest('tr');
                            if (!ui || !ui.item) return false;

                            $(this).val(ui.item.value);

                            if (targetField === 'medicine_name' && ui.item.complete) {
                                var comp = ui.item.complete;
                                if (comp.medicine_hsn) targetRow.find('[name="medicine_hsn[]"]').val(comp.medicine_hsn);
                                if (comp.medicine_manufacturer) targetRow.find('[name="medicine_manufacturer[]"]').val(comp.medicine_manufacturer);
                                if (comp.medicine_category) targetRow.find('[name="medicine_category[]"]').val(comp.medicine_category);
                                if (comp.medicine_storage) targetRow.find('[name="medicine_storage[]"]').val(comp.medicine_storage);
                                if (comp.medicine_schedule) targetRow.find('[name="medicine_schedule[]"]').val(comp.medicine_schedule);
                                if (comp.medicine_unit) targetRow.find('[name="medicine_unit[]"]').val(comp.medicine_unit);

                                // Map medicine GST to CGST and SGST
                                if (comp.medicine_gst !== undefined && comp.medicine_gst !== null && comp.medicine_gst !== "") {
                                    var fullGst = parseFloat(comp.medicine_gst) || 0;
                                    var halfGst = (fullGst / 2).toFixed(2);
                                    targetRow.find('[name="purchase_cgst_percent[]"]').val(halfGst);
                                    targetRow.find('[name="purchase_sgst_percent[]"]').val(halfGst);
                                }

                                if (comp.medicine_name) {
                                    fetch_history_by_name(comp.medicine_name);
                                }

                                gst_calculation(targetRow.find('[name="purchase_cgst_percent[]"]'));

                                setTimeout(function() {
                                    targetRow.find('[name="purchase_quantity[]"]').focus().select();
                                }, 50);
                            }
                            return false;
                        }
                    });

                    // Custom Rich Item Card for Medicine Autocomplete
                    if (targetField === 'medicine_name') {
                        var inst = ac.autocomplete("instance") || ac.data("ui-autocomplete");
                        if (inst) {
                            inst._renderItem = function (ul, item) {
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
                                    .append(itemHtml)
                                    .appendTo(ul);
                            };
                        }
                    }
                });
            });
        <?php endif; ?>

        // Re-bind focus event to Total field for keyboard fast entry
        $("[name^='purchase_total[]']").off('keydown').on('keydown', function (e) {
            if (e.keyCode === 9 && !e.shiftKey) { // Tab key
                e.preventDefault();
                addmore();
            }
        });

        calculateTotal();
        $newRow.find('[name^="medicine_name[]"]').focus();
    }

    function removeRow(targetObj) {
        if ($('.rowline').length > 1) {
            $(targetObj).closest('.rowline').remove();
            renumber_rows();
            calculateTotal();
        } else {
            alert('At least one item row is required in the purchase bill.');
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

    function gst_calculation(targetObject) {
        var $row = $(targetObject).closest('tr');

        var rate = parseFloat($row.find('[name="purchase_rate[]"]').val()) || 0;
        var qty = parseFloat($row.find('[name="purchase_quantity[]"]').val()) || 0;
        var discount = parseFloat($row.find('[name="purchase_discount_percent[]"]').val()) || 0;
        var bonusPercent = parseFloat($row.find('[name="purchase_bonus[]"]').val()) || 0;
        var cgstRate = parseFloat($row.find('[name="purchase_cgst_percent[]"]').val()) || 0;

        // Intra-state purchase mirrors SGST from CGST
        var sgstRate = cgstRate;
        $row.find('[name="purchase_sgst_percent[]"]').val(sgstRate.toFixed(2));

        discount = Math.min(100, Math.max(0, discount));
        bonusPercent = Math.min(100, Math.max(0, bonusPercent));
        cgstRate = Math.max(0, cgstRate);
        sgstRate = cgstRate;

        // Calculate taxable after trade discount
        var gross = rate * qty;
        var discountAmount = gross * discount / 100;
        var taxable = Math.round((gross - discountAmount) * 100) / 100;

        // Calculate GST
        var cgst = Math.round(taxable * cgstRate / 100 * 100) / 100;
        var sgst = Math.round(taxable * sgstRate / 100 * 100) / 100;

        var totalBeforeBonus = Math.round((taxable + cgst + sgst) * 100) / 100;
        var bonusAmount = Math.round(totalBeforeBonus * bonusPercent / 100 * 100) / 100;
        var grandTotal = Math.round((totalBeforeBonus - bonusAmount) * 100) / 100;

        $row.find('[name="purchase_taxable[]"]').val(taxable.toFixed(2));
        $row.find('[name="purchase_cgst[]"]').val(cgst.toFixed(2));
        $row.find('[name="purchase_sgst[]"]').val(sgst.toFixed(2));
        $row.find('[name="purchase_total[]"]').val(grandTotal.toFixed(2));

        calculateTotal();
    }

    function calculateTotal() {
        var totalItem = $('.rowline').length;
        var totalTaxable = 0;
        var totalCgst = 0;
        var totalSgst = 0;
        var totalTotal = 0;

        $('.rowline').each(function () {
            var taxable = parseFloat($(this).find('[name="purchase_taxable[]"]').val()) || 0;
            var cgst = parseFloat($(this).find('[name="purchase_cgst[]"]').val()) || 0;
            var sgst = parseFloat($(this).find('[name="purchase_sgst[]"]').val()) || 0;
            var total = parseFloat($(this).find('[name="purchase_total[]"]').val()) || 0;

            totalTaxable += taxable;
            totalCgst += cgst;
            totalSgst += sgst;
            totalTotal += total;
        });

        $('.totalItem').html(totalItem);
        $('.totalTaxable').html(totalTaxable.toFixed(2));
        $('.totalCgst').html(totalCgst.toFixed(2));
        $('.totalSgst').html(totalSgst.toFixed(2));
        $('.totalgst').html((totalSgst + totalCgst).toFixed(2));
        $('.totalAmount').html(totalTotal.toFixed(2));
    }

    $(document).ready(function () {
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 3000);

        // Add initial row
        addmore();

        // Datepicker init
        $("[name='purchase_date']").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true
        });

        <?php if (isset($this->page_config['autocomplete'])): ?>
            var autoComplete = $.parseJSON('<?= json_encode($this->page_config['autocomplete']); ?>');
            $.each(autoComplete, function (targetField, value) {
                $.each(value, function (model, fieldToSearch) {
                    var $supInput = $('[name="' + targetField + '"]');
                    if (!$supInput.length) return;

                    var supAC = $supInput.autocomplete({
                        source: '/search.php?table=' + model + '&fieldToSearch=' + fieldToSearch,
                        minLength: 1,
                        autoFocus: false,
                        appendTo: "body",
                        open: function () {
                            $(this).autocomplete('widget').data('current-input', $(this));
                        },
                        select: function (event, ui) {
                            if (!ui || !ui.item) return false;
                            $(this).val(ui.item.value);

                            if (ui.item.complete) {
                                var c = ui.item.complete;
                                if (c.supplier_name) $('[name="supplier_name"]').val(c.supplier_name);
                                if (c.supplier_address) $('[name="supplier_address"]').val(c.supplier_address);
                                if (c.supplier_contact) $('[name="supplier_contact"]').val(c.supplier_contact);
                                if (c.supplier_gst) $('[name="supplier_gst"]').val(c.supplier_gst);
                            }
                            check_invoice();
                            if (targetField === 'supplier_name') {
                                $('[name="purchase_invoice"]').focus();
                            }
                            return false;
                        }
                    });

                    if (targetField === 'supplier_name') {
                        var supInst = supAC.autocomplete("instance") || supAC.data("ui-autocomplete");
                        if (supInst) {
                            supInst._renderItem = function (ul, item) {
                                var comp = item.complete || {};
                                var details = [];
                                if (comp.supplier_gst) details.push('GST: ' + comp.supplier_gst);
                                if (comp.supplier_contact) details.push('Ph: ' + comp.supplier_contact);
                                if (comp.supplier_address) details.push(comp.supplier_address);

                                var subHtml = details.length ? '<div class="ac-item-sub">' + details.join(' &bull; ') + '</div>' : '';
                                var itemHtml = '<div class="ac-item-inner">' +
                                               '  <div class="ac-item-title">' + $('<div>').text(item.label).html() + '</div>' +
                                               subHtml +
                                               '</div>';

                                return $("<li>")
                                    .append(itemHtml)
                                    .appendTo(ul);
                            };
                        }
                    }
                });
            });
        <?php endif; ?>

        // 100% Robust Mouse Click & Selection handling for Autocomplete Dropdown
        $(document).on('mousedown', '.ui-autocomplete .ui-menu-item', function (e) {
            e.preventDefault(); // Prevents input from blurring before click completes
            var $item = $(this).closest('.ui-menu-item');
            var $menu = $item.closest('.ui-menu');
            var menuInst = $menu.data('ui-menu') || $menu.data('uiMenu');
            if (menuInst) {
                menuInst.active = $item;
            }
        });

        $(document).on('click', '.ui-autocomplete .ui-menu-item', function (e) {
            var $item = $(this).closest('.ui-menu-item');
            var itemData = $item.data('ui-autocomplete-item');
            if (!itemData) return;

            var $menu = $item.closest('.ui-autocomplete');
            var $targetInput = $menu.data('current-input');
            if ($targetInput && $targetInput.length) {
                var acInst = $targetInput.data('ui-autocomplete') || $targetInput.data('autocomplete');
                if (acInst && acInst.menu && acInst.menu.element.is(':visible')) {
                    acInst._trigger('select', e, { item: itemData });
                    acInst.close(e);
                }
            }
        });
    });

    function saveTheData(targetObj) {
        $.post(page_url + 'add_detail?autosave=true', $(targetObj).serialize(), function (resp) {
            console.log(resp);
            return false;
        });
        return false;
    }

    function focusvalidation(obg) {
        var val = parseInt($(obg).val(), 10);
        if (val > 12 || val < 1) {
            alert('Invalid Expiry Month. Please enter a value between 01 and 12.');
            $(obg).val('');
            setTimeout(function() { $(obg).focus(); }, 50);
            return false;
        }
    }

    function check_invoice() {
        var invoiceNo = $('[name="purchase_invoice"]').val();
        var supplierName = $('[name="supplier_name"]').val();

        if (!invoiceNo || !supplierName) {
            $('#duplicate_invoice_alert').hide();
            return;
        }

        $.post(page_url + 'check_duplicate_invoice', {
            purchase_invoice: invoiceNo,
            supplier_name: supplierName
        }, function (resp) {
            if (resp && resp.invoice_count > 0) {
                $('#duplicate_invoice_alert').slideDown(150);
            } else {
                $('#duplicate_invoice_alert').slideUp(150);
            }
        });
    }

    function check_medicine(elem) {
        var $medInput = elem ? $(elem) : $('[name="medicine_name[]"]').first();
        var val = $medInput.val();
        if (!val || val.trim() === '') return;
        $.post('/console/purchase/check_duplicate_medicine', {
            medicine: val.trim()
        }, function (resp) {
            if (resp && resp.medicine_count === 0) {
                $medInput.css('border-color', '#f59e0b');
            } else {
                $medInput.css('border-color', '#cbd5e1');
            }
        });
    }

    function get_history(targetObj) {
        var med = $(targetObj).find('[name^="medicine_name[]"]').val();
        if (med && med.trim().length > 1) {
            fetch_history_by_name(med.trim());
        }
    }

    function fetch_history_by_name(medName) {
        $.post('/console/purchase/purchase_history', {medicine: medName}, function (resp) {
            $('#history').html(resp);
            $('#history-panel').slideDown(200);
        });
    }

    function get_reminder(targetObj) {
        var $row = $(targetObj).closest('tr');
        var med = $row.find('[name^="medicine_name[]"]').val();
        if (!med || med.trim() === '') return;

        $.post('/console/purchase/purchase_reminder', {medicine: med}, function (resp) {
            if (resp && resp.data && resp.data.length > 0) {
                console.log("Previous purchase batch for " + med + ": " + resp.data[0].purchase_batch);
            }
        });
    }

    function hide_history() {
        $('#history-panel').slideUp(150, function() {
            $('#history').html('');
        });
    }

    function isExpiryLessThan30Days(monthStr, yearStr) {
        var month = parseInt(monthStr, 10);
        var year = parseInt(yearStr, 10);

        if (isNaN(month) || isNaN(year)) return false;

        if (year < 100) {
            year += 2000;
        }

        var expiryDate = new Date(year, month, 0);
        var today = new Date();
        var diff = expiryDate - today;
        var diffDays = diff / (1000 * 60 * 60 * 24);

        return diffDays < 30;
    }

    $(document).on('focusout', '.exp-month, .exp-year', function () {
        var $row = $(this).closest('tr.rowline');
        var month = $row.find('[name="purchase_expire_month[]"]').val();
        var year = $row.find('[name="purchase_expire_year[]"]').val();

        if (month && year) {
            if (isExpiryLessThan30Days(month, year)) {
                $row.addClass('row-expiring-soon');
            } else {
                $row.removeClass('row-expiring-soon');
            }
        }
    });
</script>