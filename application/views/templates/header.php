<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>DCRS</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <style type="text/css">
        body,
        html {
            overscroll-behavior: none;
        }
    </style>
</head>

<body class="bg-light">
    <div class="wrapper">
        <!-- alert  -->
        <div id="alert" class="w-50 position-absolute" style="z-index: 1; top:10%; left: 25%;">
        </div>
        <!-- sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header d-flex flex-row">
                <img src="../model/upload/img/logo.png" class="img-fluid  " width="70" alt="No image">
                <h3 class="ml-3 mb-0 font-weight-bold">MYITD PAHANG</h3>
            </div>
            <ul class="list-unstyled components">
                <li><a href="#"><i class="fas fa-chart-pie"></i> Dashboard</a></li>
                <li><a href="#"><i class="fas fa-chart-pie"></i> Pge 1</a></li>
                <li><a href="manage?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>