<style>
/* Modern styling for Sale Return Report in AdminLTE Console Layout */
.report-header-card {
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    margin-bottom: 16px;
    border: 1px solid #e2e8f0;
}
.report-title {
    font-size: 17px !important;
    font-weight: 700 !important;
    color: #0f172a;
    margin: 0 0 4px 0 !important;
    display: flex;
    align-items: center;
    gap: 8px;
}
.report-filter-bar {
    background: #f8fafc;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    padding: 14px 16px 6px 16px;
    margin-bottom: 18px;
}
.filter-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: #475569;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
    display: block;
}
.kpi-card {
    background: #fff;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    padding: 14px 16px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    transition: transform 0.2s, box-shadow 0.2s;
}
.kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.kpi-icon {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-right: 14px;
    flex-shrink: 0;
}
.kpi-title {
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}
.kpi-value {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.2;
}

/* Table Card */
.table-card {
    background: #fff;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    margin-bottom: 20px;
    overflow: hidden;
}
.table-card-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
}
.table-card-title {
    font-size: 13px !important;
    font-weight: 700 !important;
    color: #1e293b;
    margin: 0 !important;
    display: flex;
    align-items: center;
    gap: 6px;
}
.gst-table th {
    background: #f1f5f9 !important;
    color: #334155 !important;
    font-weight: 700 !important;
    font-size: 11px !important;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    border-top: none !important;
    padding: 10px 12px !important;
    vertical-align: middle !important;
}
.gst-table td {
    font-size: 12px !important;
    padding: 9px 12px !important;
    vertical-align: middle !important;
    color: #1e293b;
}
.gst-table tbody tr:hover {
    background-color: #f8fafc !important;
}
.gst-table tfoot td {
    background: #e2e8f0 !important;
    font-weight: 700 !important;
    font-size: 12px !important;
    color: #0f172a !important;
    border-top: 2px solid #cbd5e1 !important;
    padding: 10px 12px !important;
}

/* Print Styles */
@media print {
    body, .wrapper, .content-wrapper, .content, #content {
        background: #fff !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
    .main-header, .main-sidebar, .content-header, .main-footer, .breadcrumb,
    .report-filter-bar, .report-actions, .no-print {
        display: none !important;
    }
    .print-only {
        display: block !important;
    }
    .table-card, .kpi-card {
        border: 1px solid #cbd5e1 !important;
        box-shadow: none !important;
        margin-bottom: 12px !important;
    }
    .table-responsive {
        overflow: visible !important;
    }
    .gst-table th, .gst-table td {
        border: 1px solid #94a3b8 !important;
        font-size: 10px !important;
        padding: 4px 6px !important;
    }
}
.print-only {
    display: none;
}
</style>

<!-- Print-Only Header -->
<div class="print-only" style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #0f172a; padding-bottom: 10px;">
    <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 5px 0; color: #0f172a;">Sale Return Billing Report</h2>
    <p style="font-size: 12px; color: #475569; margin: 0;">Period: <strong class="print-start-date"><?= !empty($start) ? htmlspecialchars($start) : '-' ?></strong> to <strong class="print-end-date"><?= !empty($end) ? htmlspecialchars($end) : '-' ?></strong></p>
</div>

<!-- Main Report Container -->
<div class="report-wrapper">
    <!-- Top Header Card -->
    <div class="report-header-card" style="padding: 14px 18px;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 class="report-title">
                    <i class="fa fa-reply-all text-danger"></i> Sale Return Report
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Detailed record of customer sales returns, credit refunds, and returned medicine stock
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center;">
                <a href="<?= console_url('return_sale/sale_report_export'); ?>?start=<?= !empty($start) ? urlencode($start) : '' ?>&end=<?= !empty($end) ? urlencode($end) : '' ?>&customer_name=<?= !empty($customer_name) ? urlencode($customer_name) : '' ?>&return_sale_medicine=<?= !empty($return_sale_medicine) ? urlencode($return_sale_medicine) : '' ?>&return_sale_Batch=<?= !empty($return_sale_Batch) ? urlencode($return_sale_Batch) : '' ?>&return_sale_ref=<?= !empty($return_sale_ref) ? urlencode($return_sale_ref) : '' ?>&return_sale_invoice=<?= !empty($return_sale_invoice) ? urlencode($return_sale_invoice) : '' ?>&return_sale_entry_number=<?= !empty($return_sale_entry_number) ? urlencode($return_sale_entry_number) : '' ?>" 
                   id="btn_export_excel" class="btn btn-success btn-sm" style="font-weight: 600; border-radius: 4px;">
                    <i class="fa fa-file-excel-o"></i> Export to Excel
                </a>
                <button type="button" onclick="window.print();" class="btn btn-default btn-sm" style="font-weight: 600; border-radius: 4px; border-color: #cbd5e1;">
                    <i class="fa fa-print"></i> Print Report
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Bar Card -->
    <div class="report-filter-bar no-print">
        <form id="saleReturnFilterForm" method="post" action="<?= console_url('return_sale/sale_report') ?>" style="margin: 0;">
            <div class="row">
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Customer Name</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-user"></i></span>
                        <input type="text" name="customer_name" id="customer_name" list="customer_list" value="<?= !empty($customer_name) ? htmlspecialchars($customer_name) : '' ?>" class="form-control input-sm" placeholder="Search customer..." style="border-color: #cbd5e1;">
                        <datalist id="customer_list">
                            <?php if (!empty($customer)): ?>
                                <?php foreach ($customer as $val): ?>
                                    <option value="<?= htmlspecialchars($val['customer_name']) ?>">
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Medicine Name</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-medkit"></i></span>
                        <input type="text" name="return_sale_medicine" id="return_sale_medicine" value="<?= !empty($return_sale_medicine) ? htmlspecialchars($return_sale_medicine) : '' ?>" class="form-control input-sm" placeholder="Medicine name..." style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Batch #</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-barcode"></i></span>
                        <input type="text" name="return_sale_Batch" id="return_sale_Batch" value="<?= !empty($return_sale_Batch) ? htmlspecialchars($return_sale_Batch) : '' ?>" class="form-control input-sm" placeholder="Batch..." style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Sale Invoice #</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-file-text-o"></i></span>
                        <input type="text" name="return_sale_invoice" id="return_sale_invoice" value="<?= !empty($return_sale_invoice) ? htmlspecialchars($return_sale_invoice) : '' ?>" class="form-control input-sm" placeholder="Invoice #..." style="border-color: #cbd5e1;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Return Entry #</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-hashtag"></i></span>
                        <input type="text" name="return_sale_entry_number" id="return_sale_entry_number" value="<?= !empty($return_sale_entry_number) ? htmlspecialchars($return_sale_entry_number) : '' ?>" class="form-control input-sm" placeholder="Entry #..." style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Reference</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-commenting-o"></i></span>
                        <input type="text" name="return_sale_ref" id="return_sale_ref" value="<?= !empty($return_sale_ref) ? htmlspecialchars($return_sale_ref) : '' ?>" class="form-control input-sm" placeholder="Reference note..." style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Start Date</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-calendar"></i></span>
                        <input type="date" name="start" id="start_date" value="<?= !empty($start) ? $start : date('Y-m-d', strtotime('-1 month')) ?>" class="form-control input-sm" style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">End Date</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-calendar"></i></span>
                        <input type="date" name="end" id="end_date" value="<?= !empty($end) ? $end : date('Y-m-d') ?>" class="form-control input-sm" style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label" style="opacity: 0;">Actions</label>
                    <div style="display: flex; gap: 6px;">
                        <button type="submit" id="btn_filter" class="btn btn-primary btn-sm" style="font-weight: 600; width: 50%; border-radius: 4px;" title="Apply Filter">
                            <i class="fa fa-search"></i> Filter
                        </button>
                        <button type="button" id="btn_reset" class="btn btn-default btn-sm" style="font-weight: 600; width: 50%; border-radius: 4px; border-color: #cbd5e1;" title="Reset filters">
                            <i class="fa fa-refresh"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Container (loaded with initial data and updated via AJAX) -->
    <div id="report_results_container">
        <?php $this->load->view('console/return_sale/sale_ajax_report_tpl'); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    var exportBaseUrl = '<?= console_url("return_sale/sale_report_export"); ?>';
    var ajaxUrl = '<?= console_url("return_sale/sale_report"); ?>';

    function updateExportLink() {
        var start = $('#start_date').val();
        var end = $('#end_date').val();
        var customer_name = $('#customer_name').val();
        var return_sale_medicine = $('#return_sale_medicine').val();
        var return_sale_Batch = $('#return_sale_Batch').val();
        var return_sale_ref = $('#return_sale_ref').val();
        var return_sale_invoice = $('#return_sale_invoice').val();
        var return_sale_entry_number = $('#return_sale_entry_number').val();

        var params = [];
        if (start) params.push('start=' + encodeURIComponent(start));
        if (end) params.push('end=' + encodeURIComponent(end));
        if (customer_name) params.push('customer_name=' + encodeURIComponent(customer_name));
        if (return_sale_medicine) params.push('return_sale_medicine=' + encodeURIComponent(return_sale_medicine));
        if (return_sale_Batch) params.push('return_sale_Batch=' + encodeURIComponent(return_sale_Batch));
        if (return_sale_ref) params.push('return_sale_ref=' + encodeURIComponent(return_sale_ref));
        if (return_sale_invoice) params.push('return_sale_invoice=' + encodeURIComponent(return_sale_invoice));
        if (return_sale_entry_number) params.push('return_sale_entry_number=' + encodeURIComponent(return_sale_entry_number));

        var fullUrl = exportBaseUrl + (params.length ? '?' + params.join('&') : '');
        $('#btn_export_excel').attr('href', fullUrl);
        $('.print-start-date').text(start || '-');
        $('.print-end-date').text(end || '-');
    }

    function doFilter() {
        updateExportLink();
        var $container = $('#report_results_container');
        $container.html('<div style="text-align: center; padding: 45px;"><i class="fa fa-spinner fa-spin fa-2x text-primary" style="color: #35aa47;"></i><p style="margin-top: 12px; color: #64748b; font-size: 13px; font-weight: 500;">Loading report data, please wait...</p></div>');

        var postData = {
            key: 'ajax_resp',
            start: $('#start_date').val(),
            end: $('#end_date').val(),
            customer_name: $('#customer_name').val(),
            return_sale_medicine: $('#return_sale_medicine').val(),
            return_sale_Batch: $('#return_sale_Batch').val(),
            return_sale_ref: $('#return_sale_ref').val(),
            return_sale_invoice: $('#return_sale_invoice').val(),
            return_sale_entry_number: $('#return_sale_entry_number').val()
        };

        $.post(ajaxUrl, postData, function(response) {
            $container.html(response);
        }).fail(function() {
            $container.html('<div class="alert alert-danger" style="margin: 20px 0;"><i class="fa fa-exclamation-triangle"></i> Failed to load report data. Please check connection and try again.</div>');
        });
    }

    $('#saleReturnFilterForm').on('submit', function(e) {
        e.preventDefault();
        doFilter();
    });

    $('#start_date, #end_date').on('change', function() {
        doFilter();
    });

    var debounceTimer = null;
    $('#customer_name, #return_sale_medicine, #return_sale_Batch, #return_sale_ref, #return_sale_invoice, #return_sale_entry_number').on('keyup', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            doFilter();
        }, 400);
    });

    $('#btn_reset').on('click', function() {
        $('#customer_name').val('');
        $('#return_sale_medicine').val('');
        $('#return_sale_Batch').val('');
        $('#return_sale_ref').val('');
        $('#return_sale_invoice').val('');
        $('#return_sale_entry_number').val('');
        $('#start_date').val('<?= date("Y-m-d", strtotime("-1 month")) ?>');
        $('#end_date').val('<?= date("Y-m-d") ?>');
        doFilter();
    });
});
</script>
