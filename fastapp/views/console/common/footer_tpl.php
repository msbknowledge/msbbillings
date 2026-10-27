<?php if ($current_user_session): ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Standard System Modals -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Settings</h4>
                    </div>
                    <div class="modal-body">
                        <p>Configure parameters...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="subscription_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Subscription</h4>
                    </div>
                    <div class="modal-body"><p></p></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="formModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Form Details</h4>
                    </div>
                    <div class="modal-body"><p></p></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="formAddEditModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Entry</h4>
                    </div>
                    <div class="modal-body"><p></p></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Smart School Main Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Cloud POS</b> v4.0
            </div>
            <strong>© <?= date('Y') ?> <a href="<?= base_url() ?>" target="_blank" style="color: #35aa47; text-decoration: none;"><?= !empty($site_settings['site_setting_title']) ? $site_settings['site_setting_title'] : 'MsbBillings' ?></a>.</strong> All rights reserved.
        </footer>
    </div><!-- /.wrapper -->
<?php endif; ?>

<!-- External JavaScript Libraries from Smart School Assets -->
<script src="<?= base_url('assets/backend/dist/js/jquery-ui.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/backend/dist/js/app.min.js'); ?>"></script>

<!-- Smart School Sidebar & Interactive Collapse Engine -->
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
    });
</script>

<?php execute_hook('footer'); ?>
</body>
</html>
