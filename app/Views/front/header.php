<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Node Nale</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/assets/icons/icon_isem.png') ?>">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <?php

  helper('minify');

  $cssFiles = [
    'assets/fonts/Kanit.css',
    'assets/sweetaert2/css/sweetalert2.min.css',
    'assets/sb-admin-2/sb-admin-2.min.css',
    'assets/aos/css/aos.css',
    'assets/dataTable/css/datatables.min.css',
    'assets/bootstrap5/css/bootstrap.min.css',
    'assets/date-picker/css/daterangepicker.css',
    'assets/swiper/css/swiper-bundle.min.css',
    'assets/splide/css/splide.min.css',

  ];
  $minifiedCssFile = 'assets/css/minified_backend.css';


  $inputJsFiles = [
    'assets/jquery/jquery.min.js',
    'assets/bootstrap5/js/bootstrap.bundle.min.js',
    'assets/dataTable/js/dataTables.min.js',
    'assets/sweetaert2/js/sweetalert2@11.js',
    'assets/aos/js/aos.js',
    'assets/chart/chart.js',
    // 'assets/date-picker/js/jquery.min.js',
    'assets/date-picker/js/moment.min.js',
    'assets/date-picker/js/daterangepicker.min.js',
    'assets/swiper/js/swiper-bundle.min.js',
    'assets/splide/js/splide.min.js',

  ];
  $outputJsFile = 'assets/js/minified_backend.min.js';

  if (getenv('CI_ENVIRONMENT') != 'production') {
    minify_css($cssFiles, $minifiedCssFile);
    minify_js($inputJsFiles, $outputJsFile);
  }

  ?>
  <link rel="stylesheet" type="text/css" href="<?= asset_url($minifiedCssFile) ?>">

  <script>
    var base_url = '<?= base_url(); ?>';
    var asset_url = '<?= asset_url(); ?>';


    // window.onload = function () {
    //   if (typeof jQuery === 'undefined') {
    //     console.error('jQuery is not loaded!');
    //   } else {
    //     $(document).ready(function () {
    //       console.log('loaded');
    //     });
    //   }
    // }
  </script>


  <script src="<?= asset_url($outputJsFile); ?>"></script>
</head>

<style>
  * {
    font-family: 'Kanit', sans-serif;
    font-size: 12px;
  }

  :root {
    /* --swiper-theme-color: #fcb045; */
  }

  body {
    color: black;
  }

  .fw-400 {
    font-weight: 400;
  }

  .fw-500 {
    font-weight: 500;
  }

  .btn-green-gradient {
    color: #ffffff;
    border: 0;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 8px;
    background: linear-gradient(90deg, rgba(4, 131, 33, 1) 0%, rgba(45, 208, 80, 1) 100%);
    /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background 0.4s ease-in-out, filter 0.3s ease-in-out;
  }

  .btn-green-gradient:hover {
    color: #ffffff;
    background: linear-gradient(90deg, rgba(45, 208, 80, 1) 0%, rgba(4, 131, 33, 1) 100%);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    /* transform: translateY(-3px); */
    filter: brightness(1.15);
  }

  .btn.active {
    color: #ffffff;
    background: linear-gradient(90deg, rgba(45, 208, 80, 1) 0%, rgba(4, 131, 33, 1) 100%);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    filter: brightness(1.15);
  }
</style>


<body>