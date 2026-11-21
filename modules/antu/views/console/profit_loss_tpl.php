<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$period_start = isset($period_start) ? $period_start : (isset($start) ? $start : date('Y-04-01'));
$period_end   = isset($period_end) ? $period_end : (isset($end) ? $end : date('Y-m-d'));
$per_page     = isset($per_page) ? $per_page : 25;
$page         = isset($page) ? (int)$page : 1;
?>

<style>
/* Modern styling for Profit & Loss Report in AdminLTE Console Layout */
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
    padding: 14px 16px 10px 16px;
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

/* Date Preset Pill Buttons */
.date-preset-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #fff;
    border: 1px solid #cbd5e1;
    color: #1e293b;
    padding: 3px 9px;
    border-radius: 14px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
    margin-right: 4px;
    margin-bottom: 4px;
}
.date-preset-btn:hover {
    background: #eff6ff;
    border-color: #3b82f6;
    color: #2563eb;
    transform: translateY(-1px);
}
.date-preset-btn.active {
    background: #3b82f6;
    border-color: #2563eb;
    color: #fff;
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
    background: rgba(255, 255, 255, 0.85);
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
    <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 5px 0; color: #0f172a;">Profit &amp; Loss Financial Statement</h2>
    <p style="font-size: 12px; color: #475569; margin: 0;">
        Period: <strong class="print-period"><?= date('d M Y', strtotime($period_start)) ?> to <?= date('d M Y', strtotime($period_end)) ?></strong>
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
                    <i class="fa fa-balance-scale text-primary"></i> Profit &amp; Loss Financial Statement
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Executive trading account, revenue analysis, tax liability, and daily net profitability ledger
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center;">
                <a href="<?= console_url('profit_loss/export_excel'); ?>?start=<?= urlencode($period_start) ?>&end=<?= urlencode($period_end) ?>" 
                   id="btn_export_excel" class="btn btn-success btn-sm" style="font-weight: 600; border-radius: 4px;">
                    <i class="fa fa-file-excel-o"></i> Export to Excel
                </a>
                <button type="button" onclick="window.print();" class="btn btn-default btn-sm" style="font-weight: 600; border-radius: 4px; border-color: #cbd5e1;">
                    <i class="fa fa-print"></i> Print Statement
                </button>
            </div>
        </div>
    </div>

    <!-- Filter Bar Card -->
    <div class="report-filter-bar no-print">
        <form id="profitLossFilterForm" method="post" action="<?= console_url('profit_loss') ?>" style="margin: 0;">
            <input type="hidden" name="page" id="filter_page" value="<?= isset($page) ? (int)$page : 1 ?>">
            <div class="row" style="margin-left: -6px; margin-right: -6px;">
                <!-- Start Date -->
                <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_start_date">Period Start Date</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-calendar text-muted"></i></span>
                        <input type="date" 
                               name="start" 
                               id="filter_start_date" 
                               value="<?= htmlspecialchars($period_start) ?>" 
                               class="form-control" 
                               style="border-color: #cbd5e1; font-weight: 600;" />
                    </div>
                </div>

                <!-- End Date -->
                <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_end_date">Period End Date</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-calendar text-muted"></i></span>
                        <input type="date" 
                               name="end" 
                               id="filter_end_date" 
                               value="<?= htmlspecialchars($period_end) ?>" 
                               class="form-control" 
                               style="border-color: #cbd5e1; font-weight: 600;" />
                    </div>
                </div>

                <!-- Per Page -->
                <div class="col-md-2 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_per_page">Per Page</label>
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <select name="per_page" id="filter_per_page" class="form-control" style="border-color: #cbd5e1; font-weight: 600;">
                            <option value="25" <?= (!isset($per_page) || $per_page == 25) ? 'selected' : '' ?>>25 days</option>
                            <option value="50" <?= (isset($per_page) && $per_page == 50) ? 'selected' : '' ?>>50 days</option>
                            <option value="100" <?= (isset($per_page) && $per_page == 100) ? 'selected' : '' ?>>100 days</option>
                            <option value="250" <?= (isset($per_page) && $per_page == 250) ? 'selected' : '' ?>>250 days</option>
                            <option value="all" <?= (isset($per_page) && ($per_page === 'all' || $per_page == 0)) ? 'selected' : '' ?>>All days</option>
                        </select>
                    </div>
                </div>

                <!-- Filter Actions -->
                <div class="col-md-4 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label">&nbsp;</label>
                    <div style="display: flex; gap: 6px;">
                        <button type="submit" id="btn_apply_filter" class="btn btn-primary btn-sm btn-block" style="font-weight: 600; border-radius: 4px;">
                            <i class="fa fa-filter"></i> Calculate P&amp;L
                        </button>
                        <button type="button" id="btn_reset_filter" class="btn btn-default btn-sm" title="Reset Filters" style="border-radius: 4px; border-color: #cbd5e1;">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Date Presets Bar -->
            <div style="margin-top: 4px; display: flex; align-items: center; flex-wrap: wrap; gap: 4px;">
                <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-right: 6px;">
                    <i class="fa fa-bolt text-warning"></i> Presets:
                </span>
                <button type="button" class="date-preset-btn" id="btn_preset_this_month">This Month</button>
                <button type="button" class="date-preset-btn" id="btn_preset_last_month">Last Month</button>
                <button type="button" class="date-preset-btn" id="btn_preset_fy">Current Financial Year (Apr - Mar)</button>
                <button type="button" class="date-preset-btn" id="btn_preset_last_fy">Last Financial Year</button>
            </div>
        </form>
    </div>

    <!-- Results Wrapper with Smart UI Loading Overlay -->
    <div id="report_results_wrapper" style="position: relative; min-height: 250px;">
        <!-- Loading Overlay (Visible during data calculation) -->
        <div id="report_loading_overlay">
            <div class="loading-box">
                <i class="fa fa-spinner fa-spin text-primary" style="font-size: 38px; color: #3b82f6;"></i>
                <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 12px 0 4px 0;">Calculating Profit &amp; Loss Statement...</h4>
                <p style="font-size: 12px; color: #64748b; margin: 0;">Aggregating sales, purchases, GST reconciliation, and daily profitability.</p>
            </div>
        </div>

        <!-- Target AJAX Container -->
        <div id="report_results_container">
            <?php $this->load->view('console/profit_loss_table_tpl'); ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    function updateExportUrl() {
        var baseExportUrl = "<?= console_url('profit_loss/export_excel'); ?>";
        var params = $('#profitLossFilterForm').serialize();
        $('#btn_export_excel').attr('href', baseExportUrl + '?' + params);
    }

    function fetchReportData() {
        var form = $('#profitLossFilterForm');
        var formData = form.serialize() + '&ajax_resp=1';
        var container = $('#report_results_container');
        var overlay = $('#report_loading_overlay');
        var btnFilter = $('#btn_apply_filter');

        // Show prominent smart UI loading overlay
        overlay.fadeIn(150);
        btnFilter.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Calculating...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            success: function(resp) {
                container.html(resp);
                overlay.hide();
                btnFilter.prop('disabled', false).html('<i class="fa fa-filter"></i> Calculate P&amp;L');
                updateExportUrl();

                // Keep bottom per-page dropdown synced with top selector
                var currentPerPage = $('#filter_per_page').val();
                $('.bottom-per-page-select').val(currentPerPage);

                // Update print period header
                var sDate = $('#filter_start_date').val();
                var eDate = $('#filter_end_date').val();
                $('.print-period').text(sDate + ' to ' + eDate);
            },
            error: function(xhr, status, error) {
                overlay.hide();
                btnFilter.prop('disabled', false).html('<i class="fa fa-filter"></i> Calculate P&amp;L');
                alert("Failed to calculate Profit & Loss statement. Please try again.");
            }
        });
    }

    // Intercept form submit (resets to page 1)
    $('#profitLossFilterForm').on('submit', function(e) {
        e.preventDefault();
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Auto reload on date or per-page change
    $('#filter_start_date, #filter_end_date, #filter_per_page').on('change', function() {
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

    // Bottom Pagination link click handler (niche paginate used)
    $(document).on('click', '#profit_loss_pagination .page-link', function(e) {
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

    // Quick Date Presets
    function pad(n) { return (n < 10 ? '0' : '') + n; }

    $('#btn_preset_this_month').on('click', function(e) {
        e.preventDefault();
        $('.date-preset-btn').removeClass('active');
        $(this).addClass('active');
        var now = new Date();
        var firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
        var lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0);
        var s = firstDay.getFullYear() + '-' + pad(firstDay.getMonth() + 1) + '-' + pad(firstDay.getDate());
        var e = lastDay.getFullYear() + '-' + pad(lastDay.getMonth() + 1) + '-' + pad(lastDay.getDate());
        $('#filter_start_date').val(s);
        $('#filter_end_date').val(e);
        $('#filter_page').val('1');
        fetchReportData();
    });

    $('#btn_preset_last_month').on('click', function(e) {
        e.preventDefault();
        $('.date-preset-btn').removeClass('active');
        $(this).addClass('active');
        var now = new Date();
        var firstDay = new Date(now.getFullYear(), now.getMonth() - 1, 1);
        var lastDay = new Date(now.getFullYear(), now.getMonth(), 0);
        var s = firstDay.getFullYear() + '-' + pad(firstDay.getMonth() + 1) + '-' + pad(firstDay.getDate());
        var e = lastDay.getFullYear() + '-' + pad(lastDay.getMonth() + 1) + '-' + pad(lastDay.getDate());
        $('#filter_start_date').val(s);
        $('#filter_end_date').val(e);
        $('#filter_page').val('1');
        fetchReportData();
    });

    $('#btn_preset_fy').on('click', function(e) {
        e.preventDefault();
        $('.date-preset-btn').removeClass('active');
        $(this).addClass('active');
        var now = new Date();
        var curMonth = now.getMonth() + 1; // 1-12
        var fyStartYear = (curMonth >= 4) ? now.getFullYear() : (now.getFullYear() - 1);
        var s = fyStartYear + '-04-01';
        var e = now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());
        $('#filter_start_date').val(s);
        $('#filter_end_date').val(e);
        $('#filter_page').val('1');
        fetchReportData();
    });

    $('#btn_preset_last_fy').on('click', function(e) {
        e.preventDefault();
        $('.date-preset-btn').removeClass('active');
        $(this).addClass('active');
        var now = new Date();
        var curMonth = now.getMonth() + 1;
        var fyStartYear = (curMonth >= 4) ? (now.getFullYear() - 1) : (now.getFullYear() - 2);
        var s = fyStartYear + '-04-01';
        var e = (fyStartYear + 1) + '-03-31';
        $('#filter_start_date').val(s);
        $('#filter_end_date').val(e);
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Reset button
    $('#btn_reset_filter').on('click', function() {
        $('.date-preset-btn').removeClass('active');
        $('#btn_preset_fy').click();
    });

    // Initial sync of export URL
    updateExportUrl();
});
</script>
