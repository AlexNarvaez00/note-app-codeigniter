<?= helper('html') ?>
<?php
/***
 * @author Narvaez Ruiz Alexis
 */
?>
<!--auther: Narvaez Ruiz Alexis-->
<!--Codigo HTML estraido de "layout-empty"-->
<!DOCTYPE html>
<html lang="es">

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
 <title>
  <?= $this->renderSection('title-page') ?>
 </title>
 <link rel="icon" type="image/x-icon" href="<?= base_url('cork')?>/src/assets/img/favicon.ico" />
 <?= link_tag("cork/layouts/vertical-light-menu/css/light/loader.css") ?>
 <?= link_tag("cork/layouts/vertical-light-menu/css/dark/loader.css") ?>
 <?= script_tag("cork/layouts/vertical-light-menu/loader.js") ?>
 <!-- BEGIN GLOBAL MANDATORY STYLES -->
 <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
 <?= link_tag("cork/src/bootstrap/css/bootstrap.min.css") ?>
 <?= link_tag("cork/layouts/vertical-light-menu/css/light/plugins.css") ?>
 <?= link_tag("cork/layouts/vertical-light-menu/css/dark/plugins.css") ?>

 <!-- END GLOBAL MANDATORY STYLES -->

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
 <?= link_tag('cork/src/assets/css/light/elements/alert.css') ?>
 <?= link_tag('cork/src/assets/css/dark/elements/alert.css') ?>
 <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

 <?= $this->renderSection('styles') ?>


 <style>
  body.dark .layout-px-spacing,
  .layout-px-spacing {
   min-height: calc(100vh - 155px) !important;
  }
 </style>

</head>

<body class="layout-boxed">

 <!-- BEGIN LOADER -->
 <div id="load_screen">
  <div class="loader">
   <div class="loader-content">
    <div class="spinner-grow align-self-center"></div>
   </div>
  </div>
 </div>
 <!--  END LOADER -->

 <!--  BEGIN NAVBAR  -->
 <?= $this->include('components/navbar') ?>
 <!--  END NAVBAR  -->


 <!--  BEGIN MAIN CONTAINER  -->
 <div class="main-container " id="container">

  <div class="overlay"></div>
  <div class="search-overlay"></div>

  <!--  BEGIN SIDEBAR  -->
  <?= $this->include('components/sidebar') ?>
  <!--  END SIDEBAR  -->

  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
   <div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

     <!-- BREADCRUMB -->
     <div class="page-meta">
      <nav class="breadcrumb-style-one" aria-label="breadcrumb">
       <ol class="breadcrumb">
        <?= $this->renderSection('indexes-page') ?>
        <!--
                                                                        <li class="breadcrumb-item"><a href="#">Layouts</a></li>
                                                                        <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
                                                                -->
       </ol>
      </nav>
     </div>
     <!-- /BREADCRUMB -->

     <!-- CONTENT AREA -->
     <div class="row layout-top-spacing">

      <div class="col-12">
       <?= $this->renderSection('main-content') ?>
       <!--BEGIN ALERT-->
       <!-- <?= $this->include('components/alert') ?> -->
       <!--END ALERT-->
      </div>
      <div class="col-md-12">
      </div>

     </div>
     <!-- CONTENT AREA -->

    </div>

   </div>
   <!-- BEGIN FOOTER-->
   <?= $this->include('components/footer') ?>
   <!-- END FOOTER-->
  </div>
  <!--  END CONTENT AREA  -->
 </div>
 <!-- END MAIN CONTAINER -->

 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <?= script_tag('cork/src/plugins/src/global/vendors.min.js') ?>
 <?= script_tag("cork/src/bootstrap/js/bootstrap.bundle.min.js") ?>
 <?= script_tag("cork/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js") ?>
 <?= script_tag("cork/src/plugins/src/mousetrap/mousetrap.min.js") ?>
 <?= script_tag("cork/layouts/vertical-light-menu/app.js") ?>
 <?= script_tag('cork/src/plugins/src/table/datatable/datatables.js') ?>
 <?= script_tag('cork/src/assets/js/custom.js') ?>
 <!-- END GLOBAL MANDATORY SCRIPTS -->

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 <script>
  let darkLogoLink = "<?= base_url('cork/src/assets/img/logo.svg') ?>";
  let lightLogoLink = "<?= base_url('cork/src/assets/img/logo2.svg') ?>";
 </script>
 <?= $this->renderSection('script-section' ) ?>
 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>
