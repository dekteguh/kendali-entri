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

<?php include 'partials/header.php'; ?>
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
      <?php include 'partials/footer.php';?>
  </body>
</html>
