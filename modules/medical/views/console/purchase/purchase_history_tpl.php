<?php if (!empty($data)): ?>
<div class="purchase-history-card" style="padding: 10px 14px; background: #fff;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
        <div style="font-weight: 700; font-size: 13px; color: #0f172a;">
            <i class="fa fa-history text-primary" style="margin-right: 5px;"></i> Last 5 Purchase Records for: 
            <span class="label label-info" style="font-size: 12px; margin-left: 5px;"><?= htmlspecialchars(isset($medicine) ? $medicine : (isset($product) ? $product : 'Item')) ?></span>
        </div>
        <button type="button" class="btn btn-default btn-xs" onclick="hide_history()" style="font-weight: 600;">
            <i class="fa fa-times"></i> Close
        </button>
    </div>
    <div class="table-responsive" style="margin-bottom: 0;">
        <table class="table table-bordered table-striped table-hover" style="font-size: 12px; margin-bottom: 0; background: #fff;">
            <thead>
                <tr style="background: #f1f5f9; color: #334155;">
                    <th style="padding: 6px 10px; font-weight: 700; width: 100px;">Date</th>
                    <th style="padding: 6px 10px; font-weight: 700;">Supplier</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 110px;">Invoice #</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 90px;">Batch</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 70px; text-align: right;">Qty</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 85px; text-align: right;">MRP (₹)</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 110px; text-align: right;">Purchase Rate (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td style="padding: 6px 10px; vertical-align: middle;">
                        <?= !empty($row['purchase_date']) && $row['purchase_date'] != '0000-00-00' ? date('d-M-Y', strtotime($row['purchase_date'])) : 'N/A' ?>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; font-weight: 600; color: #1e293b;">
                        <?= htmlspecialchars(!empty($row['supplier_name']) ? $row['supplier_name'] : 'N/A') ?>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle;">
                        <span class="label label-default" style="font-size: 11px;"><?= htmlspecialchars(!empty($row['purchase_invoice']) ? $row['purchase_invoice'] : '-') ?></span>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle;">
                        <?= htmlspecialchars(!empty($row['purchase_batch']) ? $row['purchase_batch'] : '-') ?>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: right; font-weight: 600;">
                        <?= htmlspecialchars(!empty($row['purchase_quantity']) ? $row['purchase_quantity'] : '0') ?>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: right;">
                        <?= number_format((float)(!empty($row['purchase_mrp']) ? $row['purchase_mrp'] : 0), 2) ?>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: right; font-weight: 700; color: #059669;">
                        ₹ <?= number_format((float)(!empty($row['purchase_rate']) ? $row['purchase_rate'] : 0), 2) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div style="padding: 12px 16px; background: #fff; display: flex; align-items: center; justify-content: space-between;">
    <div style="color: #64748b; font-size: 12px;">
        <i class="fa fa-info-circle text-info"></i> No previous purchase history found for <strong><?= htmlspecialchars(isset($medicine) ? $medicine : (isset($product) ? $product : 'this item')) ?></strong>.
    </div>
    <button type="button" class="btn btn-default btn-xs" onclick="hide_history()"><i class="fa fa-times"></i> Close</button>
</div>
<?php endif; ?>