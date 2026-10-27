<?php if ($current_user_session): ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Smart School Main Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Cloud POS</b> v4.0
            </div>
            <strong>© <?= date('Y') ?> <a href="<?= base_url() ?>" target="_blank" style="color: #35aa47; text-decoration: none;"><?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings' ?></a>.</strong> All rights reserved.
        </footer>
    </div><!-- /.wrapper -->
<?php endif; ?>

<!-- Standard System Modals (Placed as direct children of body to avoid z-index/stacking context trapping) -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" style="margin: 0; font-size: 18px; font-weight: 600;">Detail</h3>
            </div>
            <div class="modal-body">
                <p style="margin: 0;">Please Wait...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#myModal').modal('hide')">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="subscription_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" style="margin: 0; font-size: 18px; font-weight: 600;">Subscription</h3>
            </div>
            <div class="modal-body"><p style="margin: 0;"></p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" style="margin: 0; font-size: 18px; font-weight: 600;">Form Details</h3>
            </div>
            <div class="modal-body"><p style="margin: 0;"></p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-save-modal">Save!</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formAddEditModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" style="margin: 0; font-size: 18px; font-weight: 600;">Entry</h3>
            </div>
            <div class="modal-body">
                <p style="margin: 0;">Please Wait...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-save-modal">Save!</button>
            </div>
        </div>
    </div>
</div>

<!-- External JavaScript Libraries from Smart School Assets -->
<script src="<?= base_url('assets/backend/dist/js/jquery-ui.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/dist/js/app.min.js'); ?>"></script>

<!-- Project Libraries & Console Core Utilities -->
<script src="<?= base_url('js/jquery.cookie.js'); ?>"></script>
<script src="<?= base_url('js/chosen.jquery.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.uniform.min.js'); ?>"></script>
<script src="<?= base_url('js/jquery.noty.js'); ?>"></script>
<script src="<?= base_url('js/jquery.iphone.toggle.js'); ?>"></script>
<script src="<?= base_url('js/jquery.datetimepicker.js'); ?>"></script>
<script src="<?= base_url('js/fastapp.js'); ?>?v=<?= time() ?>"></script>

<!-- Smart School Sidebar & Interactive Table / Modal Engine -->
<script>
    // Global collapseSidebar function for Smart School
    window.collapseSidebar = function() {
        if ($(window).width() > 767) {
            $('body').toggleClass('sidebar-collapse');
            try {
                if ($('body').hasClass('sidebar-collapse')) {
                    localStorage.setItem('ss_sidebar_state', 'collapsed');
                } else {
                    localStorage.setItem('ss_sidebar_state', 'expanded');
                }
            } catch(e) {}
        } else {
            $('body').toggleClass('sidebar-open');
        }
    };

    $(document).ready(function() {
        // Event delegation for sidebar toggle buttons
        $(document).on('click', '.sidebar-toggle, [data-toggle="offcanvas"]', function(e) {
            e.preventDefault();
            e.stopPropagation();
            window.collapseSidebar();
        });

        // Sidebar Treeview slide toggle
        $(document).on('click', '.sidebar-menu .treeview > a', function(e) {
            e.preventDefault();
            var parent = $(this).parent();
            var subMenu = $(this).next('.treeview-menu');

            if (parent.hasClass('active')) {
                subMenu.slideUp(200, function() {
                    parent.removeClass('active');
                });
            } else {
                parent.siblings('.treeview.active').removeClass('active').children('.treeview-menu').slideUp(200);
                subMenu.slideDown(200, function() {
                    parent.addClass('active');
                });
            }
        });

        // Close sidebar on mobile when clicking on content-wrapper
        $(document).on('click', '.content-wrapper', function() {
            if ($(window).width() <= 767 && $('body').hasClass('sidebar-open')) {
                $('body').removeClass('sidebar-open');
            }
        });

        // Select All checkboxes delegation
        $(document).on('click', '.btn_select_all', function(e) {
            e.preventDefault();
            var $form = $(this).closest('form');
            if ($form.length === 0) {
                $form = $('.choose_entry_form').length ? $('.choose_entry_form') : $(document);
            }
            var $boxes = $form.find('input.selectedItem, .selectedItem');
            $boxes.prop('checked', true).attr('checked', 'checked');
            $boxes.parent('span').addClass('checked');
            if ($.fn.iCheck) {
                $boxes.iCheck('check');
            }
            if ($.uniform && $.uniform.update) {
                $.uniform.update($boxes);
            }
        });

        // Deselect All checkboxes delegation
        $(document).on('click', '.btn_deselect_all', function(e) {
            e.preventDefault();
            var $form = $(this).closest('form');
            if ($form.length === 0) {
                $form = $('.choose_entry_form').length ? $('.choose_entry_form') : $(document);
            }
            var $boxes = $form.find('input.selectedItem, .selectedItem');
            $boxes.prop('checked', false).removeAttr('checked');
            $boxes.parent('span').removeClass('checked');
            if ($.fn.iCheck) {
                $boxes.iCheck('uncheck');
            }
            if ($.uniform && $.uniform.update) {
                $.uniform.update($boxes);
            }
        });

        // Modal Save button handler for #formAddEditModal
        $(document).on('click', '#formAddEditModal .modal-footer .btn-save-modal, #formAddEditModal .modal-footer .btn-primary', function(e) {
            var modalTitle = ($('#formAddEditModal .modal-header h3').text() || $('#formAddEditModal .modal-header .modal-title').text() || '').toLowerCase();
            if (modalTitle.indexOf('edit') !== -1 && typeof saveSingleOperation === 'function') {
                e.preventDefault();
                saveSingleOperation();
            } else if (typeof addSingleOperation === 'function') {
                e.preventDefault();
                addSingleOperation();
            } else {
                var $form = $('#formAddEditModal form');
                if ($form.length) {
                    $form.submit();
                }
            }
        });
    });
</script>

<?php execute_hook('footer'); ?>
</body>
</html>
