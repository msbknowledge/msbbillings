<section class="content-header" style="padding: 15px 15px 5px 15px;">
    <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0; display: inline-block;">
        <i class="fa fa-th-large text-theme" style="margin-right: 6px;"></i>
        <?= isset($page_config['title']) ? $page_config['title'] : (isset($title) ? $title : ucfirst($this->uri->segment(2))) ?>
    </h1>

    <div class="pull-right">
        <ul class="breadcrumb" style="background: transparent; padding: 0; margin: 0; display: inline-block; vertical-align: middle;">
            <li><a href="<?= console_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <?php if (isset($site_breadcrumb)): ?>
                <?php foreach ($site_breadcrumb as $node_name => $node_link): ?>
                    <li><a href="<?= $node_link ?>"><?= $node_name ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <button class="btn btn-default btn-xs" onclick="goBack();" style="margin-left: 10px; border-radius: 4px;" title="Go Back">
            <i class="fa fa-arrow-left"></i> Back
        </button>
    </div>
</section>

<script>
    function goBack() {
        if (typeof $('ul.breadcrumb li:nth-last-child(2)').children('a').attr('href') != 'undefined') {
            window.location.href = $('ul.breadcrumb li:nth-last-child(2)').children('a').attr('href');
        } else {
            window.history.back();
        }
    }
</script>