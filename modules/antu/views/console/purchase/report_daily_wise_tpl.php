<style>
/* Modern styling for Purchase Daily / Invoice-Wise Report in AdminLTE Console Layout */
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
    <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 5px 0; color: #0f172a;">Purchase Daily / Invoice-Wise Report</h2>
    <p style="font-size: 12px; color: #475569; margin: 0;">Period: <strong class="print-start-date"><?= !empty($start) ? htmlspecialchars($start) : '-' ?></strong> to <strong class="print-end-date"><?= !empty($end) ? htmlspecialchars($end) : '-' ?></strong></p>
</div>

<!-- Main Report Container -->
<div class="report-wrapper">
    <!-- Top Header Card -->
    <div class="report-header-card" style="padding: 14px 18px;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 class="report-title">
                    <i class="fa fa-calendar-check-o text-primary"></i> Purchase Daily / Invoice-Wise Report
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Daily purchase transactions grouped by invoice and entry with detailed GST rate and HSN breakdowns
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center;">
                <a href="<?= console_url('purchase/report_daily_wise_export'); ?>?start=<?= !empty($start) ? urlencode($start) : '' ?>&end=<?= !empty($end) ? urlencode($end) : '' ?>&supplier_name=<?= !empty($supplier_name) ? urlencode($supplier_name) : '' ?>&supplier_gst=<?= !empty($supplier_gst) ? urlencode($supplier_gst) : '' ?>&purchase_invoice=<?= !empty($purchase_invoice) ? urlencode($purchase_invoice) : '' ?>" 
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
        <form id="dailyFilterForm" method="post" action="<?= console_url('purchase/report_daily_wise') ?>" style="margin: 0;">
            <div class="row">
                <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Supplier Name</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-user"></i></span>
                        <input type="text" name="supplier_name" id="supplier_name" value="<?= !empty($supplier_name) ? htmlspecialchars($supplier_name) : '' ?>" class="form-control input-sm" placeholder="Search supplier..." style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Invoice Number</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-file-text-o"></i></span>
                        <input type="text" name="purchase_invoice" id="purchase_invoice" value="<?= !empty($purchase_invoice) ? htmlspecialchars($purchase_invoice) : '' ?>" class="form-control input-sm" placeholder="Invoice #..." style="border-color: #cbd5e1;">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label">Supplier GSTIN</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-id-card-o"></i></span>
                        <input type="text" name="supplier_gst" id="supplier_gst" value="<?= !empty($supplier_gst) ? htmlspecialchars($supplier_gst) : '' ?>" class="form-control input-sm" placeholder="GSTIN..." style="border-color: #cbd5e1;">
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
                <div class="col-md-1 col-sm-6" style="margin-bottom: 10px;">
                    <label class="filter-label" style="opacity: 0;">Actions</label>
                    <div style="display: flex; gap: 4px;">
                        <button type="submit" id="btn_filter" class="btn btn-primary btn-sm" style="font-weight: 600; width: 50%; border-radius: 4px;" title="Filter">
                            <i class="fa fa-search"></i>
                        </button>
                        <button type="button" id="btn_reset" class="btn btn-default btn-sm" style="font-weight: 600; width: 50%; border-radius: 4px; border-color: #cbd5e1;" title="Reset filters">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Container (loaded with initial data and updated via AJAX) -->
    <div id="report_results_container">
        <?php $this->load->view('console/purchase/report_daily_wise_table_tpl'); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    var exportBaseUrl = '<?= console_url("purchase/report_daily_wise_export"); ?>';
    var ajaxUrl = '<?= console_url("purchase/report_daily_wise"); ?>';

    function updateExportLink() {
        var start = $('#start_date').val();
        var end = $('#end_date').val();
        var supplier_name = $('#supplier_name').val();
        var supplier_gst = $('#supplier_gst').val();
        var purchase_invoice = $('#purchase_invoice').val();

        var params = [];
        if (start) params.push('start=' + encodeURIComponent(start));
        if (end) params.push('end=' + encodeURIComponent(end));
        if (supplier_name) params.push('supplier_name=' + encodeURIComponent(supplier_name));
        if (supplier_gst) params.push('supplier_gst=' + encodeURIComponent(supplier_gst));
        if (purchase_invoice) params.push('purchase_invoice=' + encodeURIComponent(purchase_invoice));

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
            supplier_name: $('#supplier_name').val(),
            supplier_gst: $('#supplier_gst').val(),
            purchase_invoice: $('#purchase_invoice').val()
        };

        $.post(ajaxUrl, postData, function(response) {
            $container.html(response);
        }).fail(function() {
            $container.html('<div class="alert alert-danger" style="margin: 20px 0;"><i class="fa fa-exclamation-triangle"></i> Failed to load report data. Please check connection and try again.</div>');
        });
    }

    $('#dailyFilterForm').on('submit', function(e) {
        e.preventDefault();
        doFilter();
    });

    $('#start_date, #end_date').on('change', function() {
        doFilter();
    });

    var debounceTimer = null;
    $('#supplier_name, #supplier_gst, #purchase_invoice').on('keyup', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            doFilter();
        }, 400);
    });

    $('#btn_reset').on('click', function() {
        $('#supplier_name').val('');
        $('#supplier_gst').val('');
        $('#purchase_invoice').val('');
        $('#start_date').val('<?= date("Y-m-d", strtotime("-1 month")) ?>');
        $('#end_date').val('<?= date("Y-m-d") ?>');
        doFilter();
    });
});
</script>
