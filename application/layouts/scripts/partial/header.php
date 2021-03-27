<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>SI - VIS@Vapehitz</title>

  <!-- Favicons -->
  <link href="<?php echo $this->baseUrl(); ?>/img/favicon.png" rel="icon">
  <link href="<?php echo $this->baseUrl(); ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo $this->baseUrl(); ?>/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?php echo $this->baseUrl(); ?>/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/lib/gritter/css/jquery.gritter.css" />
  <script src="<?php echo $this->baseUrl(); ?>/lib/jquery.js" charset="utf-8"></script>
  <script src="<?php echo $this->baseUrl(); ?>/lib/jquery.min.js"></script>
  <script src="<?php echo $this->baseUrl(); ?>/lib/jquery.form.js"></script>
  <!-- Custom styles for this template -->

  <link href="<?php echo $this->baseUrl(); ?>/css/select2.min.css" rel="stylesheet">
  <link href="<?php echo $this->baseUrl(); ?>/css/fileinput/fileinput.min.css" rel="stylesheet">
  <script src="<?php echo $this->baseUrl(); ?>/lib/select2.full.min.js"></script>

  <link href="<?php echo $this->baseUrl(); ?>/css/style-responsive.css" rel="stylesheet">
  <script src="<?php echo $this->baseUrl(); ?>/lib/chart-master/Chart.js"></script>

  <link href="<?php echo $this->baseUrl(); ?>/lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="<?php echo $this->baseUrl(); ?>/lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $this->baseUrl(); ?>/lib/advanced-datatable/css/DT_bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->baseUrl(); ?>/lib/bootstrap-datetimepicker/datertimepicker.css" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>


  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <style>
    <?php require('style.css'); ?>
  </style>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>VAPE<span>HITZ</span></b></a>
      <!--logo end-->

      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li>
            <a class="logout" onClick="logout()">Logout</a>
          </li>
        </ul>
      </div>
    </header>
    <!--header end-->

    <script>
      function logout() {
        var url = "<?php echo $this->baseUrl(); ?>/index/logout";

        jQuery.get(url, function(data) {
          //alert('Logout Berhasil');
          location.href = "<?php echo $this->baseUrl(); ?>/index";
        });

        //alert(test);
      }

      function open_url_to_div(pageAction, act) {
        var opt = {
          act: act
        };
        //alert (act);
        //var lod = $('#loader').show();
        jQuery.get(pageAction, opt, function(data) {
          jQuery("#page-content").html(data);
          jQuery.getScript(scriptAction);
          lod.hide();
        });
      }
    </script>