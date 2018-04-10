<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?php echo (isset($pageTitle)) ? $pageTitle : DEFAULT_TITLE; ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-grid.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-reboot.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/css/colors.css" rel="stylesheet" id="themecolor"/>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet"/>
    <!-- BEGIN PAGE LEVEL STYLE -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/amcharts/export.css" type="text/css" media="all"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet"/>
    <!-- END PAGE LEVEL STYLE -->
    <style id="clock-animations"></style>
</head>
<!--Body Begins-->
<body>
<!--Begin Loading-->
<div class="preloader">
    <div class="loading">
        <h2>
            Loading...
        </h2>
        <span class="progress"></span>
    </div>
</div>
<!--End Loading-->
<!--Begin wrapper-->
<div class="wrapper">