<?php if (!empty($medicine['medicine_name'])): ?>
<div class="med-stock-info-card" style="padding: 10px 14px; background: #ffffff;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px;">
        <div style="font-weight: 700; font-size: 13px; color: #0f172a;">
            <i class="fa fa-cubes text-success" style="margin-right: 5px;"></i> Current Live Stock: 
            <span class="label label-info" style="font-size: 12px; margin-left: 5px;"><?= htmlspecialchars($medicine['medicine_name']) ?></span>
        </div>
        <button type="button" class="btn btn-default btn-xs" onclick="hide_info()" style="font-weight: 600;">
            <i class="fa fa-times"></i> Close
        </button>
    </div>
    <div class="table-responsive" style="margin-bottom: 0;">
        <table class="table table-bordered table-striped" style="font-size: 12px; margin-bottom: 0; background: #fff;">
            <thead>
                <tr style="background: #f1f5f9; color: #334155;">
                    <th style="padding: 6px 10px; font-weight: 700;">Manufacturer</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 120px; text-align: center;">Unit / Strip</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 140px; text-align: right;">In-Stock (Strips)</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 140px; text-align: right;">In-Stock (Loose)</th>
                    <th style="padding: 6px 10px; font-weight: 700; width: 100px; text-align: center;">Storage</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 6px 10px; vertical-align: middle; font-weight: 600; color: #1e293b;">
                        <?= htmlspecialchars(!empty($medicine['medicine_manufacturer']) ? $medicine['medicine_manufacturer'] : 'N/A') ?>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: center;">
                        <span class="label label-default" style="font-size: 11px;"><?= htmlspecialchars(!empty($medicine['medicine_unit']) ? $medicine['medicine_unit'] : '1') ?></span>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: right;">
                        <?php $strips = (int)(!empty($stock['left_strip']) ? $stock['left_strip'] : 0); ?>
                        <span class="label <?= $strips > 0 ? 'label-success' : 'label-danger' ?>" style="font-size: 12px; padding: 3px 8px;">
                            <?= $strips ?> strips
                        </span>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: right;">
                        <?php $loose = (int)(!empty($stock['left_loose']) ? $stock['left_loose'] : 0); ?>
                        <span class="label <?= $loose > 0 ? 'label-success' : 'label-default' ?>" style="font-size: 12px; padding: 3px 8px;">
                            <?= $loose ?> units
                        </span>
                    </td>
                    <td style="padding: 6px 10px; vertical-align: middle; text-align: center;">
                        <span class="label label-primary" style="font-size: 11px;"><?= htmlspecialchars(!empty($medicine['medicine_storage']) ? $medicine['medicine_storage'] : 'Rack') ?></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
