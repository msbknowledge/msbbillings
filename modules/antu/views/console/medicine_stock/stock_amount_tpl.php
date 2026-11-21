<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<style>
/* Modern styling for Medicine Stock Valuation / Amount Report in AdminLTE Console Layout */
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
    padding: 14px 16px 8px 16px;
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

/* Bottom Pagination Styling */
.pagination > li > a, .pagination > li > span {
    color: #475569;
    border-color: #cbd5e1;
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 4px;
    margin: 0 2px;
}
.pagination > .active > a, .pagination > .active > span {
    background-color: #3b82f6 !important;
    border-color: #3b82f6 !important;
    color: #fff !important;
}
.pagination > li > a:hover {
    background-color: #f1f5f9;
    border-color: #94a3b8;
    color: #1e293b;
}

/* Loading Overlay Styles */
#report_loading_overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.82);
    z-index: 50;
    display: none;
    border-radius: 6px;
    backdrop-filter: blur(1px);
}
.loading-box {
    position: sticky;
    top: 220px;
    text-align: center;
    padding: 30px 20px;
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
    <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 5px 0; color: #0f172a;">Medicine Stock Valuation & Amount Report</h2>
    <p style="font-size: 12px; color: #475569; margin: 0;">
        Filter: <strong class="print-filter-status"><?= (isset($stock_filter) && $stock_filter === 'all') ? 'All Medicines' : ((isset($stock_filter) && $stock_filter === 'out_of_stock') ? 'Out of Stock' : 'In Stock Only') ?></strong>
        | Printed on: <?= date('d M Y, h:i A') ?>
    </p>
</div>

<!-- Main Report Container -->
<div class="report-wrapper">
    <!-- Top Header Card -->
    <div class="report-header-card" style="padding: 14px 18px;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 class="report-title">
                    <i class="fa fa-line-chart text-primary"></i> Medicine Stock Valuation & Amount Report
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Comprehensive valuation of current medicine inventory on hand based on latest MRP and purchase cost rates
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center;">
                <a href="<?= console_url('medicine_stock/stock_amount_export'); ?>?medicine_name=<?= !empty($medicine_name) ? urlencode($medicine_name) : '' ?>&medicine_manufacturer=<?= !empty($medicine_manufacturer) ? urlencode($medicine_manufacturer) : '' ?>&storage=<?= !empty($storage) ? urlencode($storage) : '' ?>&stock_filter=<?= !empty($stock_filter) ? urlencode($stock_filter) : 'in_stock' ?>" 
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
        <form id="stockAmountFilterForm" method="post" action="<?= console_url('medicine_stock/stock_amount') ?>" style="margin: 0;">
            <input type="hidden" name="page" id="filter_page" value="<?= isset($page) ? (int)$page : 1 ?>">
            <div class="row" style="margin-left: -6px; margin-right: -6px;">
                <!-- Medicine Name -->
                <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_medicine_name">Medicine Name</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-search text-muted"></i></span>
                        <input type="text" 
                               name="medicine_name" 
                               id="filter_medicine_name" 
                               value="<?= !empty($medicine_name) ? htmlspecialchars($medicine_name) : '' ?>" 
                               class="form-control" 
                               placeholder="Search medicine name..." 
                               autocomplete="off"
                               style="border-color: #cbd5e1;" />
                    </div>
                </div>

                <!-- Manufacturer -->
                <div class="col-md-2 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_medicine_manufacturer">Manufacturer</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-building text-muted"></i></span>
                        <input type="text" 
                               name="medicine_manufacturer" 
                               id="filter_medicine_manufacturer" 
                               value="<?= !empty($medicine_manufacturer) ? htmlspecialchars($medicine_manufacturer) : '' ?>" 
                               class="form-control" 
                               placeholder="Company / Mfg..." 
                               autocomplete="off"
                               style="border-color: #cbd5e1;" />
                    </div>
                </div>

                <!-- Storage / Rack -->
                <div class="col-md-2 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_storage">Storage / Rack</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-archive text-muted"></i></span>
                        <input type="text" 
                               name="storage" 
                               id="filter_storage" 
                               value="<?= !empty($storage) ? htmlspecialchars($storage) : '' ?>" 
                               class="form-control" 
                               placeholder="e.g. Rack A-1..." 
                               autocomplete="off"
                               style="border-color: #cbd5e1;" />
                    </div>
                </div>

                <!-- Stock Filter Dropdown -->
                <div class="col-md-2 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_stock_filter">Stock Status</label>
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <select name="stock_filter" id="filter_stock_filter" class="form-control" style="border-color: #cbd5e1; font-weight: 600;">
                            <option value="in_stock" <?= (!isset($stock_filter) || $stock_filter === 'in_stock') ? 'selected' : '' ?>>In Stock Only (&gt; 0)</option>
                            <option value="all" <?= (isset($stock_filter) && $stock_filter === 'all') ? 'selected' : '' ?>>All Medicines (Inc. 0 Stock)</option>
                            <option value="out_of_stock" <?= (isset($stock_filter) && $stock_filter === 'out_of_stock') ? 'selected' : '' ?>>Out of Stock (&le; 0)</option>
                        </select>
                    </div>
                </div>

                <!-- Per Page -->
                <div class="col-md-1 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_per_page">Per Page</label>
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <select name="per_page" id="filter_per_page" class="form-control" style="border-color: #cbd5e1; font-weight: 600;">
                            <option value="25" <?= (!isset($per_page) || $per_page == 25) ? 'selected' : '' ?>>25</option>
                            <option value="50" <?= (isset($per_page) && $per_page == 50) ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= (isset($per_page) && $per_page == 100) ? 'selected' : '' ?>>100</option>
                            <option value="250" <?= (isset($per_page) && $per_page == 250) ? 'selected' : '' ?>>250</option>
                            <option value="all" <?= (isset($per_page) && ($per_page === 'all' || $per_page == 0)) ? 'selected' : '' ?>>All</option>
                        </select>
                    </div>
                </div>

                <!-- Filter Actions -->
                <div class="col-md-2 col-sm-12" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label">&nbsp;</label>
                    <div style="display: flex; gap: 6px;">
                        <button type="submit" id="btn_apply_filter" class="btn btn-primary btn-sm btn-block" style="font-weight: 600; border-radius: 4px;">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                        <button type="button" id="btn_reset_filter" class="btn btn-default btn-sm" title="Reset Filters" style="border-radius: 4px; border-color: #cbd5e1;">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Wrapper with Smart UI Loading Overlay -->
    <div id="report_results_wrapper" style="position: relative; min-height: 250px;">
        <!-- Loading Overlay (Visible during data fetch) -->
        <div id="report_loading_overlay">
            <div class="loading-box">
                <i class="fa fa-spinner fa-spin text-primary" style="font-size: 38px; color: #3b82f6;"></i>
                <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 12px 0 4px 0;">Calculating Stock Valuation...</h4>
                <p style="font-size: 12px; color: #64748b; margin: 0;">Updating live stock quantities, rates, and valuation ledger.</p>
            </div>
        </div>

        <!-- Target AJAX Container -->
        <div id="report_results_container">
            <?php $this->load->view('console/medicine_stock/stock_ajax_amount_tpl'); ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var searchTimer = null;

    function updateExportUrl() {
        var baseExportUrl = "<?= console_url('medicine_stock/stock_amount_export'); ?>";
        var params = $('#stockAmountFilterForm').serialize();
        $('#btn_export_excel').attr('href', baseExportUrl + '?' + params);
    }

    function fetchReportData() {
        var form = $('#stockAmountFilterForm');
        var formData = form.serialize() + '&ajax_resp=1';
        var container = $('#report_results_container');
        var overlay = $('#report_loading_overlay');
        var btnFilter = $('#btn_apply_filter');

        // Show prominent smart UI loading overlay
        overlay.fadeIn(150);
        btnFilter.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Filtering...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            success: function(resp) {
                container.html(resp);
                overlay.hide();
                btnFilter.prop('disabled', false).html('<i class="fa fa-filter"></i> Filter');
                updateExportUrl();

                // Keep bottom per-page dropdown synced with top selector
                var currentPerPage = $('#filter_per_page').val();
                $('.bottom-per-page-select').val(currentPerPage);

                // Update print header status
                var stockFilter = $('#filter_stock_filter option:selected').text();
                $('.print-filter-status').text(stockFilter);
            },
            error: function(xhr, status, error) {
                overlay.hide();
                btnFilter.prop('disabled', false).html('<i class="fa fa-filter"></i> Filter');
                alert("Failed to load stock valuation data. Please try again.");
            }
        });
    }

    // Intercept form submit (resets to page 1)
    $('#stockAmountFilterForm').on('submit', function(e) {
        e.preventDefault();
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Auto reload on stock_filter or top per_page change
    $('#filter_stock_filter, #filter_per_page').on('change', function() {
        var selectedPerPage = $('#filter_per_page').val();
        $('.bottom-per-page-select').val(selectedPerPage);
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Bottom Per-Page dropdown change handler (niche paginate used)
    $(document).on('change', '.bottom-per-page-select', function() {
        var newPerPage = $(this).val();
        $('#filter_per_page').val(newPerPage);
        $('#filter_page').val('1');
        fetchReportData();
        $('html, body').animate({
            scrollTop: $("#report_results_wrapper").offset().top - 70
        }, 200);
    });

    // Debounced search on typing
    $('#filter_medicine_name, #filter_medicine_manufacturer, #filter_storage').on('keyup input', function(e) {
        // If user pressed enter, ignore debounce (submit handler catches it)
        if (e.which === 13) return;
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            $('#filter_page').val('1');
            fetchReportData();
        }, 350);
    });

    // Bottom Pagination link click handler (niche paginate used)
    $(document).on('click', '#stock_amount_pagination .page-link', function(e) {
        e.preventDefault();
        var parentLi = $(this).parent();
        if (parentLi.hasClass('disabled') || parentLi.hasClass('active')) {
            return;
        }
        var targetPage = $(this).data('page');
        if (targetPage) {
            $('#filter_page').val(targetPage);
            fetchReportData();
            $('html, body').animate({
                scrollTop: $("#report_results_wrapper").offset().top - 70
            }, 200);
        }
    });

    // Reset button
    $('#btn_reset_filter').on('click', function() {
        $('#filter_medicine_name').val('');
        $('#filter_medicine_manufacturer').val('');
        $('#filter_storage').val('');
        $('#filter_stock_filter').val('in_stock');
        $('#filter_per_page').val('25');
        $('.bottom-per-page-select').val('25');
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Initial sync of export URL
    updateExportUrl();
});
</script>
