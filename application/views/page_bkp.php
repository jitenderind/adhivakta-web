<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="icon" type="image/png"
	href="<?php echo base_url(); ?>assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php echo (isset($pageTitle)) ? $pageTitle : DEFAULT_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
	name='viewport' />
<meta name="keywords" content="">
<meta name="description" content="">
<!--Fonts-->
<link
	href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900"
	rel="stylesheet">
<!-- CSS Files -->
<link
	href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css"
	rel="stylesheet" />
<link
	href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-grid.css"
	rel="stylesheet" />
<link
	href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-reboot.css"
	rel="stylesheet" />
	<link
	href="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/css/bootstrap-editable.css"
	rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/colors.css"
	rel="stylesheet" id="themecolor" />
<link href="<?php echo base_url(); ?>assets/css/style.css"
	rel="stylesheet" />
<!-- BEGIN PAGE LEVEL STYLE -->
	<link href="<?php echo base_url(); ?>assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet"/>
<link
	href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css"
	rel="stylesheet" />
	<link href="<?php echo base_url(); ?>assets/plugins/parsley/parsley.css" rel="stylesheet"/>
	<link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet"/>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<!-- END PAGE LEVEL STYLE -->
<style id="clock-animations"></style>
</head>
<!--Body Begins-->
<body>
	<!--Begin Loading-->
	<div class="preloader">
		<div class="loading">
			<h2>Loading...</h2>
			<span class="progress"></span>
		</div>
	</div>
	<!--End Loading-->
	<!--Begin wrapper-->
	<div class="wrapper">
		<!--Begin Main Panel-->
		<div class="main-panel">
			<!--Begin Sidebar-->
			<div class="sidebar" data-color="purple"></div>
			<!--End Sidebar-->
			<nav class="navbar navbar-expand-lg" id="nav"></nav>
			<div id="page-content">
			
			</div>

		</div>
		<!--EndMain Panel-->
	</div>
	<!--End wrapper-->

	<!-- begin scroll to top btn -->
	<a href="javascript:void(0)"
		class="btn btn-icon btn-circle btn-scroll-to-top btn-sm animated invisible text-light"
		data-color="purple" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</body>
<!--End Body-->
<!--   Core JS Files   -->
<script 
	src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.autocomplete.min.js"
	type="text/javascript"></script>
	<script 
	src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-ui.min.js"
	type="text/javascript"></script>
	<script 
	src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-dateformat.min.js"
	type="text/javascript"></script>
	
	<script 
	src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.tmpl.min.js"
	type="text/javascript"></script>
	
	<script 
	src="<?php echo base_url(); ?>assets/plugins/pagination/jquery.twbsPagination.min.js"
	type="text/javascript"></script>
	
	<script 
	src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"
	type="text/javascript"></script>
	
	
<script 
	src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script async
	src="<?php echo base_url(); ?>assets/plugins/waitMe/waitMe.min.js"></script>
	<script async
	src="<?php echo base_url(); ?>assets/plugins/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script async
	src="https://www.googletagmanager.com/gtag/js?id=UA-66289183-8"></script>
<!-- BEGIN PAGE LEVEL JS -->
<script async
	src="<?php echo base_url(); ?>assets/plugins/countup/countUp.min.js"></script>
<script async
	src="<?php echo base_url(); ?>assets/plugins/real-shadow/realShadow.js"
	type="text/javascript"></script>
<script async
	src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/lite_app.js" id="appjs"></script>
	<script src="<?php echo base_url(); ?>assets/js/lite_form.js" id="appjs"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/parsley/parsley.remote.min.js"></script>

<!-- END PAGE LEVEL JS -->
</html>