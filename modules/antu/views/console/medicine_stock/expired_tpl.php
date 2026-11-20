<style>
/* Modern styling for Expired Medicine Stock Report in AdminLTE Console Layout */
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
    <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 5px 0; color: #dc2626;">Expired Medicine Stock Audit Report</h2>
    <p style="font-size: 12px; color: #475569; margin: 0;">
        Expired Batches in Active Stock (As of: <strong><?= date('F Y') ?></strong> | Printed on: <?= date('d M Y, h:i A') ?>)
    </p>
</div>

<!-- Main Report Container -->
<div class="report-wrapper">
    <!-- Top Header Card -->
    <div class="report-header-card" style="padding: 14px 18px;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 class="report-title">
                    <i class="fa fa-ban text-danger"></i> Expired Medicine Stock Report
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Audit expired medicine batches currently holding active positive stock. Quarantine, return to supplier, or write off.
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center;">
                <a href="<?= console_url('medicine_stock/expired_export'); ?>?medicine_name=<?= !empty($medicine_name) ? urlencode($medicine_name) : '' ?>&batch=<?= !empty($batch) ? urlencode($batch) : '' ?>&storage=<?= !empty($storage) ? urlencode($storage) : '' ?>" 
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
        <form id="expiredFilterForm" method="post" action="<?= console_url('medicine_stock/expired_view') ?>" style="margin: 0;">
            <input type="hidden" name="page" id="filter_page" value="<?= isset($page) ? (int)$page : 1 ?>">
            <div class="row" style="margin-left: -6px; margin-right: -6px;">
                <!-- Medicine Name / Manufacturer -->
                <div class="col-md-3 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_medicine_name">Medicine / Manufacturer</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-search text-muted"></i></span>
                        <input type="text" 
                               name="medicine_name" 
                               id="filter_medicine_name" 
                               value="<?= !empty($medicine_name) ? htmlspecialchars($medicine_name) : '' ?>" 
                               class="form-control" 
                               placeholder="Search expired medicine or company..." 
                               autocomplete="off"
                               style="border-color: #cbd5e1;" />
                    </div>
                </div>

                <!-- Batch Number -->
                <div class="col-md-2 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_batch">Batch Number</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-barcode text-muted"></i></span>
                        <input type="text" 
                               name="batch" 
                               id="filter_batch" 
                               value="<?= !empty($batch) ? htmlspecialchars($batch) : '' ?>" 
                               class="form-control" 
                               placeholder="e.g. BT987..." 
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

                <!-- Per Page -->
                <div class="col-md-2 col-sm-6" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
                    <label class="filter-label" for="filter_per_page">Per Page</label>
                    <div class="input-group input-group-sm" style="width: 100%;">
                        <select name="per_page" id="filter_per_page" class="form-control" style="border-color: #cbd5e1; font-weight: 600;">
                            <option value="25" <?= (!isset($per_page) || $per_page == 25) ? 'selected' : '' ?>>25 per page</option>
                            <option value="50" <?= (isset($per_page) && $per_page == 50) ? 'selected' : '' ?>>50 per page</option>
                            <option value="100" <?= (isset($per_page) && $per_page == 100) ? 'selected' : '' ?>>100 per page</option>
                            <option value="all" <?= (isset($per_page) && $per_page == 0) ? 'selected' : '' ?>>All records</option>
                        </select>
                    </div>
                </div>

                <!-- Filter Actions -->
                <div class="col-md-3 col-sm-12" style="padding-left: 6px; padding-right: 6px; margin-bottom: 8px;">
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

    <!-- Results Container (Table & KPIs) -->
    <div id="report_results_container" style="position: relative; min-height: 200px;">
        <?php $this->load->view('console/medicine_stock/expired_table_tpl'); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    var searchTimer = null;

    function updateExportUrl() {
        var baseExportUrl = "<?= console_url('medicine_stock/expired_export'); ?>";
        var params = $('#expiredFilterForm').serialize();
        $('#btn_export_excel').attr('href', baseExportUrl + '?' + params);
    }

    function fetchReportData() {
        var form = $('#expiredFilterForm');
        var formData = form.serialize() + '&ajax_resp=1';
        var container = $('#report_results_container');

        // Loading overlay
        container.css('opacity', '0.5');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            success: function(resp) {
                container.html(resp);
                container.css('opacity', '1');
                updateExportUrl();
            },
            error: function(xhr, status, error) {
                container.css('opacity', '1');
                alert("Failed to load report data. Please try again.");
            }
        });
    }

    // Intercept form submit (resets to page 1)
    $('#expiredFilterForm').on('submit', function(e) {
        e.preventDefault();
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Auto reload on per_page change
    $('#filter_per_page').on('change', function() {
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Debounced search on typing
    $('#filter_medicine_name, #filter_batch, #filter_storage').on('keyup input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function() {
            $('#filter_page').val('1');
            fetchReportData();
        }, 350);
    });

    // Pagination link click handler (bottom pagination)
    $(document).on('click', '#expired_pagination .page-link', function(e) {
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
                scrollTop: $("#report_results_container").offset().top - 70
            }, 200);
        }
    });

    // Reset button
    $('#btn_reset_filter').on('click', function() {
        $('#filter_medicine_name').val('');
        $('#filter_batch').val('');
        $('#filter_storage').val('');
        $('#filter_per_page').val('25');
        $('#filter_page').val('1');
        fetchReportData();
    });

    // Initial sync
    updateExportUrl();
});
</script>
