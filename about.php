<?php
/**
 * Short description for about.php
 *
 * @package about
 * @author Eko Teguh Widodo <dekteguh@gmail.com>
 * @version 0.1
 * @copyright (C) 2017 Eko Teguh Widodo <dekteguh@gmail.com>
 * @license MIT
 */

  include 'util.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="assets/js/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script src="assets/js/plotly-latest.min.js"></script>
  </head>
  <body>
    <div class="container">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>">Entri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>validasi.php">Validasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-danger" href="<?php echo base_url();?>about.php">Tentang Kendali Pengolahan</a>
        </li>
      </ul>
      <br />
      <div class="alert alert-info" role="alert">
        <h3 class="text-center">Tentang Kendali Pengolahan</h3>
      </div>
      <p>
        Progress report Kendali Pengolahan adalah aplikasi dalam bentuk web untuk menampilkan informasi progress pengolahan SE2016 UMK dan UMB.
      </p>
      <p>Untuk input kendali pengolahan menggunakan aplikasi berbasis desktop.</p>
      <p>Aplikasi dikembangkan oleh Eko Teguh Widodo (Staf Seksi IPD). Pengembangan dan informasi lebih lanjut bisa menghubungi kami di <b>ekoteguh@bps.go.id</b>.</p>
  </body>
</html>
