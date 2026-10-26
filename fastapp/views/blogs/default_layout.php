

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blog</title>


<link rel="stylesheet" href="<?php echo base_url('blog_assets/front_assets');?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('blog_assets/front_assets');?>/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url('blog_assets/front_assets');?>/css/animate.css">
<link rel="stylesheet" href="<?php echo base_url('blog_assets/front_assets');?>/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('blog_assets/front_assets');?>/css/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('blog_assets/front_assets');?>/css/slick-theme.css">
<link rel="stylesheet" href="<?php echo base_url('blog_assets/front_assets');?>/css/custom-select.css">
<link rel="stylesheet" href="<?php echo base_url('blog_assets/front_assets');?>/css/style.css">


</head>
<body id="top-page">

<?php $this->load->view('blogs/header');?>
<?php echo $contents; ?>
<?php $this->load->view('blogs/footer');?>


<a href="#top-page" class="to-top js-scroll-trigger"><span><i class="fas fa-arrow-up"></i></span></a>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/jquery.min.js'></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/bootstrap.bundle.min.js'></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/swiper.min.js'></script>
<script src="<?php echo base_url('blog_assets/front_assets');?>/js/slick.js"></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/jquery-easeing.min.js'></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/scroll-nav.js'></script>
<script src="<?php echo base_url('blog_assets/front_assets');?>/js/jquery.elevatezoom.js"></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/price-range.js'></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/custom-select.js'></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/theia-sticky-sidebar.js'></script>
<script src='<?php echo base_url('blog_assets/front_assets');?>/js/functions.js'></script>


</body>
</html>