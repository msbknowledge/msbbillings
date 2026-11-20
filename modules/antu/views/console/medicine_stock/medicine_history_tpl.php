<?php
$preloaded = isset($preloaded_medicine) ? $preloaded_medicine : null;
$pre_id    = !empty($preloaded['medicine_id']) ? $preloaded['medicine_id'] : '';
$pre_name  = !empty($preloaded['medicine_name']) ? $preloaded['medicine_name'] : '';
$pre_mfg   = !empty($preloaded['medicine_manufacturer']) ? $preloaded['medicine_manufacturer'] : '';
$pre_cat   = !empty($preloaded['medicine_category']) ? $preloaded['medicine_category'] : '';
$pre_hsn   = !empty($preloaded['medicine_hsn']) ? $preloaded['medicine_hsn'] : '';
$pre_unit  = !empty($preloaded['medicine_unit']) ? $preloaded['medicine_unit'] : '';
$pre_store = !empty($preloaded['medicine_storage']) ? $preloaded['medicine_storage'] : '';
?>

<style>
/* Modern styling for Medicine History in AdminLTE Console Layout */
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
    padding: 14px 16px;
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

/* Medicine Profile Info Strip */
.med-profile-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 12px 16px;
    margin-top: 12px;
    display: none;
}
.med-profile-pill {
    display: inline-flex;
    flex-direction: column;
    margin-right: 20px;
    margin-bottom: 4px;
}
.med-profile-pill .pill-label {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    color: #94a3b8;
    letter-spacing: 0.5px;
}
.med-profile-pill .pill-value {
    font-size: 13px;
    font-weight: 700;
    color: #0f172a;
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

.ui-autocomplete {
    max-height: 280px;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 99999 !important;
    border-radius: 4px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    border: 1px solid #cbd5e1;
    font-family: inherit;
    font-size: 12px;
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
    .table-card, .kpi-card, .med-profile-card {
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
    <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 5px 0; color: #0f172a;">Medicine Stock Movement & Audit Ledger</h2>
    <p style="font-size: 12px; color: #475569; margin: 0;">
        Medicine: <strong class="print-med-name"><?= !empty($pre_name) ? htmlspecialchars($pre_name) : 'Selected Medicine' ?></strong>
        (Printed on: <?= date('d M Y, h:i A') ?>)
    </p>
</div>

<!-- Main Report Container -->
<div class="report-wrapper">
    <!-- Top Header Card -->
    <div class="report-header-card" style="padding: 14px 18px;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 class="report-title">
                    <i class="fa fa-history text-primary"></i> Medicine Stock & Movement History
                </h1>
                <span style="font-size: 12px; color: #64748b; display: inline-block;">
                    Select any medicine to track its purchases, sales, customer/supplier returns, adjustments, and current live balance
                </span>
            </div>
            <div class="report-actions" style="display: flex; gap: 8px; align-items: center;">
                <a href="#" id="btn_fast_edit" target="_blank" class="btn btn-default btn-sm" style="display: none; font-weight: 600; border-radius: 4px; border-color: #cbd5e1;">
                    <i class="fa fa-pencil-square-o"></i> Edit Medicine Details
                </a>
                <button type="button" onclick="window.print();" class="btn btn-default btn-sm" style="font-weight: 600; border-radius: 4px; border-color: #cbd5e1;">
                    <i class="fa fa-print"></i> Print History
                </button>
            </div>
        </div>
    </div>

    <!-- Medicine Search Bar Card -->
    <div class="report-filter-bar no-print">
        <div class="medicine_chooser">
            <div class="row" style="margin-left: -6px; margin-right: -6px;">
                <div class="col-md-7 col-sm-8" style="padding-left: 6px; padding-right: 6px; margin-bottom: 6px;">
                    <label class="filter-label" for="search_medicine_name">Search Medicine Name</label>
                    <div class="input-group" style="width: 100%;">
                        <span class="input-group-addon" style="background: #fff; border-color: #cbd5e1;"><i class="fa fa-search text-muted"></i></span>
                        <input type="text" 
                               name="medicine_name" 
                               id="search_medicine_name" 
                               value="<?= htmlspecialchars($pre_name) ?>" 
                               class="form-control input-sm" 
                               placeholder="Type medicine name to search (e.g. Paracetamol, Pantop, Azithromycin)..." 
                               autocomplete="off"
                               style="border-color: #cbd5e1; font-weight: 600;" />
                        <span class="input-group-addon" id="btn_clear_med" style="cursor: pointer; background: #fff; border-color: #cbd5e1;" title="Clear Search">
                            <i class="fa fa-times text-muted"></i>
                        </span>
                    </div>
                </div>

                <div class="col-md-5 col-sm-4" style="padding-left: 6px; padding-right: 6px; margin-bottom: 6px;">
                    <label class="filter-label">&nbsp;</label>
                    <div style="font-size: 11px; color: #64748b; line-height: 28px;">
                        <i class="fa fa-info-circle text-primary"></i> Start typing to see instant matching medicines
                    </div>
                </div>
            </div>

            <!-- Hidden Inputs to Store Medicine Attributes -->
            <input type="hidden" name="medicine_id" id="val_medicine_id" value="<?= htmlspecialchars($pre_id) ?>">
            <input type="hidden" name="medicine_manufacturer" id="val_medicine_manufacturer" value="<?= htmlspecialchars($pre_mfg) ?>">
            <input type="hidden" name="medicine_category" id="val_medicine_category" value="<?= htmlspecialchars($pre_cat) ?>">
            <input type="hidden" name="medicine_hsn" id="val_medicine_hsn" value="<?= htmlspecialchars($pre_hsn) ?>">
            <input type="hidden" name="medicine_unit" id="val_medicine_unit" value="<?= htmlspecialchars($pre_unit) ?>">
            <input type="hidden" name="medicine_storage" id="val_medicine_storage" value="<?= htmlspecialchars($pre_store) ?>">
        </div>

        <!-- Selected Medicine Profile Info Card -->
        <div class="med-profile-card" id="med_profile_display" <?= !empty($pre_id) ? 'style="display: block;"' : '' ?>>
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                <div>
                    <div class="med-profile-pill">
                        <span class="pill-label">Selected Medicine</span>
                        <span class="pill-value text-primary" id="disp_medicine_name"><?= !empty($pre_name) ? htmlspecialchars($pre_name) : '-' ?></span>
                    </div>
                    <div class="med-profile-pill">
                        <span class="pill-label">Manufacturer</span>
                        <span class="pill-value" id="disp_medicine_mfg"><?= !empty($pre_mfg) ? htmlspecialchars($pre_mfg) : '-' ?></span>
                    </div>
                    <div class="med-profile-pill">
                        <span class="pill-label">Category</span>
                        <span class="pill-value" id="disp_medicine_cat"><?= !empty($pre_cat) ? htmlspecialchars($pre_cat) : '-' ?></span>
                    </div>
                    <div class="med-profile-pill">
                        <span class="pill-label">HSN Code</span>
                        <span class="pill-value" id="disp_medicine_hsn"><?= !empty($pre_hsn) ? htmlspecialchars($pre_hsn) : '-' ?></span>
                    </div>
                    <div class="med-profile-pill">
                        <span class="pill-label">Unit / Pack</span>
                        <span class="pill-value" id="disp_medicine_unit"><?= !empty($pre_unit) ? htmlspecialchars($pre_unit) : '-' ?></span>
                    </div>
                    <div class="med-profile-pill">
                        <span class="pill-label">Storage / Rack</span>
                        <span class="pill-value" id="disp_medicine_storage"><?= !empty($pre_store) ? htmlspecialchars($pre_store) : '-' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Results Container -->
    <div id="history_results_container" style="position: relative; min-height: 250px;">
        <!-- Initial Empty State -->
        <div id="history_placeholder" style="<?= !empty($pre_id) ? 'display: none;' : '' ?> text-align: center; padding: 60px 20px; background: #fff; border-radius: 6px; border: 1px dashed #cbd5e1;">
            <i class="fa fa-search" style="font-size: 42px; color: #94a3b8; margin-bottom: 14px; display: inline-block;"></i>
            <h3 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 6px 0;">No Medicine Selected</h3>
            <p style="font-size: 12px; color: #64748b; max-width: 450px; margin: 0 auto;">
                Use the search bar above to select a medicine and view its complete stock audit trail, sales, purchases, and current balance.
            </p>
        </div>

        <!-- Target AJAX Injection Div -->
        <div class="form-actions" id="history_content"></div>
    </div>
</div>

<script>
$(document).ready(function () {
    var fastEditBaseUrl = "<?= console_url('medicine_stock/fast_update/'); ?>";

    function updateProfileCard(item) {
        if (!item) {
            $('#med_profile_display').hide();
            $('#btn_fast_edit').hide();
            return;
        }

        $('#disp_medicine_name').text(item.medicine_name || '-');
        $('#disp_medicine_mfg').text(item.medicine_manufacturer || '-');
        $('#disp_medicine_cat').text(item.medicine_category || '-');
        $('#disp_medicine_hsn').text(item.medicine_hsn || '-');
        $('#disp_medicine_unit').text(item.medicine_unit || '-');
        $('#disp_medicine_storage').text(item.medicine_storage || '-');
        $('.print-med-name').text(item.medicine_name || '-');

        if (item.medicine_id) {
            $('#btn_fast_edit').attr('href', fastEditBaseUrl + item.medicine_id).show();
        } else {
            $('#btn_fast_edit').hide();
        }

        $('#med_profile_display').slideDown(200);
    }

    function loadMedicineHistory(medId, page, perPage) {
        if (!medId) return;
        page = page || 1;
        perPage = perPage || $('.history-per-page-select').val() || 50;

        $('#history_placeholder').hide();
        $('#history_content').html('<div style="text-align: center; padding: 50px 20px;"><i class="fa fa-spinner fa-spin" style="font-size: 32px; color: #3b82f6;"></i><p style="margin-top: 10px; font-size: 13px; color: #64748b; font-weight: 600;">Loading stock movement history...</p></div>');

        var searchUrl = '/purchase_sale_medicine_search.php?table_purchase=purchases&table_sale=sales&table_medicine_stock=medicine_stocks&table_return_sale=returns_sales&table_return_purchase=return_purchases';

        $.get(searchUrl, { term: medId, page: page, per_page: perPage }, function (resp) {
            $('#history_content').html(resp);
        }).fail(function () {
            $('#history_content').html('<div class="alert alert-danger" style="margin: 20px 0;"><i class="fa fa-exclamation-circle"></i> Failed to load medicine transaction history. Please try again.</div>');
        });
    }

    // Pagination Click for Medicine History (Bottom Pagination)
    $(document).on('click', '.history-page-link', function(e) {
        e.preventDefault();
        var parentLi = $(this).parent();
        if (parentLi.hasClass('disabled') || parentLi.hasClass('active')) {
            return;
        }
        var targetPage = $(this).data('page');
        var medId = $('#val_medicine_id').val();
        var perPage = $('.history-per-page-select').val() || 50;
        if (targetPage && medId) {
            loadMedicineHistory(medId, targetPage, perPage);
            $('html, body').animate({
                scrollTop: $("#history_results_container").offset().top - 70
            }, 200);
        }
    });

    // Per-page change listener
    $(document).on('change', '.history-per-page-select', function() {
        var newPerPage = $(this).val();
        var medId = $('#val_medicine_id').val();
        if (medId) {
            loadMedicineHistory(medId, 1, newPerPage);
        }
    });

    // Autocomplete Setup
    $('[name^="medicine_name"]').autocomplete({
        source: '/search.php?table=medicines&fieldToSearch=medicine_name',
        search: function (event, ui) {
            // Keep user typed value
        },
        minLength: 1,
        select: function (event, ui) {
            var med = ui.item.complete;
            if (med) {
                $('#val_medicine_id').val(med.medicine_id);
                $('#val_medicine_manufacturer').val(med.medicine_manufacturer);
                $('#val_medicine_category').val(med.medicine_category);
                $('#val_medicine_hsn').val(med.medicine_hsn);
                $('#val_medicine_unit').val(med.medicine_unit);
                $('#val_medicine_storage').val(med.medicine_storage);

                updateProfileCard(med);
                loadMedicineHistory(med.medicine_id);
            }
        }
    });

    // Clear Button
    $('#btn_clear_med').on('click', function () {
        $('#search_medicine_name').val('');
        $('#val_medicine_id').val('');
        $('#val_medicine_manufacturer').val('');
        $('#val_medicine_category').val('');
        $('#val_medicine_hsn').val('');
        $('#val_medicine_unit').val('');
        $('#val_medicine_storage').val('');

        $('#med_profile_display').slideUp(150);
        $('#btn_fast_edit').hide();
        $('#history_content').empty();
        $('#history_placeholder').show();
    });

    // Auto load if preloaded medicine is present
    <?php if (!empty($pre_id)) : ?>
        var preloadedMed = {
            medicine_id: "<?= addslashes($pre_id) ?>",
            medicine_name: "<?= addslashes($pre_name) ?>",
            medicine_manufacturer: "<?= addslashes($pre_mfg) ?>",
            medicine_category: "<?= addslashes($pre_cat) ?>",
            medicine_hsn: "<?= addslashes($pre_hsn) ?>",
            medicine_unit: "<?= addslashes($pre_unit) ?>",
            medicine_storage: "<?= addslashes($pre_store) ?>"
        };
        updateProfileCard(preloadedMed);
        loadMedicineHistory(preloadedMed.medicine_id);
    <?php endif; ?>
});
</script>
