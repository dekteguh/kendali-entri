<?php
/**
 * Short description for index.php
 *
 * @package index
 * @author Eko Teguh Widodo <dekteguh@gmail.com>
 * @version 0.1
 * @copyright (C) 2017 Eko Teguh Widodo <dekteguh@gmail.com>
 * @license MIT
 */

  include 'db.php';

  $total_batch_sedang_entri = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_serah=1");
  $total_batch_sudah_entri = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_terima=1");
  $total_dok_sedang_entri = query_count("SELECT sum(jml_dok_serah) as total FROM entrian WHERE is_serah=1");
  $total_dok_sudah_entri = query_count("SELECT sum(jml_dok_terima) as total FROM entrian WHERE is_terima=1");

  $rekap_kabkota_all = query_rows("kabkota", "SELECT w.nama as nama_kabkota, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM wilayah w LEFT JOIN entrian e ON w.id=e.kabkota_id  GROUP BY w.id ORDER BY w.id");

  $rekap_operator_all = query_rows("operator","SELECT o.nama as nama_operator, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM operator o LEFT JOIN entrian e ON o.id=e.operator_id WHERE o.status='Mitra'  GROUP BY o.id ORDER BY o.id");

  $rekap_operator_perhari = query_rows("hari", "SELECT o.nama as nama_operator, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-05' THEN e.jml_dok_terima END),0) as tgl5, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-06' THEN e.jml_dok_terima END),0) as tgl6, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-09' THEN e.jml_dok_terima END),0) as tgl9, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-10' THEN e.jml_dok_terima END),0) as tgl10, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-11' THEN e.jml_dok_terima END),0) as tgl11, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-12' THEN e.jml_dok_terima END),0) as tgl12, IFNULL(SUM(e.jml_dok_terima),0) as total FROM operator o LEFT JOIN entrian e ON o.id=e.operator_id WHERE o.status='Mitra' AND e.is_terima=1 GROUP BY o.id ORDER BY o.id");
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
      <div class="alert alert-danger" role="alert">
        <h3 class="text-center">Progress Report Kendali Pengolahan SE2016 UMK dan UMB</h3>
      </div>
      <div class="navbar-text">
        Sampai dengan <?php echo date('d-M-Y');?>
      </div>
      <hr />
      <br />
      <div class="row">
        <div class="col-3">
          <div class="card text-white bg-primary">
            <div class="card-header">Batch sedang entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_batch_sedang_entri; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-success">
            <div class="card-header">Batch sudah entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_batch_sudah_entri; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-warning">
            <div class="card-header">Dokumen sedang entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_dok_sedang_entri; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-danger">
            <div class="card-header">Dokumen sudah entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_dok_sudah_entri; ?></h4>
            </div>
          </div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Entri Per Kabupaten/Kota</h3>
      <h6>Berdasarkan dokumen yang sudah dikembalikan ke pengawas pengolahan</h6>
      <div class="row">
        <div class="col-12">
          <div id="rekapEntriKabkota"></div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Entri Per Operator</h3>
      <h6>Sedang entri => dokumen masih di operator dalam masa entri.</h6>
      <h6>Sudah entri => dokumen sudah dientri dan dikembalikan ke pengawas pengolahan, siap validasi.</h6>
      <br />
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <th>No.</th>
              <th>Nama Operator</th>
              <th>Batch sedang Entri</th>
              <th>Dokumen sedang Entri</th>
              <th>Batch sudah Entri</th>
              <th>Dokumen sudah Entri</th>
              <th>Total Batch Entri</th>
              <th>Total Dokumen Entri</th>
            </thead>
            <tbody>
              <?php
                $i = 0;
                foreach ($rekap_operator_all as $list => $row) {
                  echo "<tr>";
                  echo "<td class='text-center'>".($i + 1)."</td>";
                  echo "<td>".($row['nama_operator'])."</td>";
                  echo "<td class='text-center'>".($row['jml_batch_sedang_entri'])."</td>";
                  echo "<td class='text-center'>".($row['jml_dok_sedang_entri'] != null ? $row['jml_dok_sedang_entri'] : 0)."</td>";
                  echo "<td class='text-center'>".($row['jml_batch_sudah_entri'])."</td>";
                  echo "<td class='text-center'>".($row['jml_dok_sudah_entri'] != null ? $row['jml_dok_sudah_entri'] : 0)."</td>";
                  echo "<td class='text-center'>".($row['total_batch_entri'])."</td>";
                  echo "<td class='text-center'>".($row['total_dok_entri'] != null ? $row['total_dok_entri'] : 0)."</td>";
                  echo "</tr>";
                  $i++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Entri Per Operator Per hari</h3>
      <h6>Berdasarkan dokumen yang sudah dikembalikan ke pengawas pengolahan</h6>
      <br />
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-hover table-bordered">
            <tbody>
              <tr style="background-color: #A52238;color: white; font-weight: bold;">
                <td rowspan="2" class="text-center">No.</td>
                <td rowspan="2" class="text-center">Nama Operator</td>
                <td colspan="6" class="text-center">Tanggal Entri</td>
                <td rowspan="2" class="text-center">Total Entri</td>
              </tr>
              <tr style="background-color: #A52238; color: white; font-weight: bold;">
                <td class="text-center">5 Okt</td>
                <td class="text-center">6 Okt</td>
                <td class="text-center">9 Okt</td>
                <td class="text-center">10 Okt</td>
                <td class="text-center">11 Okt</td>
                <td class="text-center">12 Okt</td>
              </tr>
              <?php
                $j = 0;
                foreach ($rekap_operator_perhari as $list => $row) {
                  echo "<tr>";
                  echo "<td class='text-center'>".($j+1)."</td>";
                  echo "<td>".($row['nama_operator'])."</td>";
                  echo "<td class='text-center'>".($row['tgl5'])."</td>";
                  echo "<td class='text-center'>".($row['tgl6'])."</td>";
                  echo "<td class='text-center'>".($row['tgl9'])."</td>";
                  echo "<td class='text-center'>".($row['tgl10'])."</td>";
                  echo "<td class='text-center'>".($row['tgl11'])."</td>";
                  echo "<td class='text-center'>".($row['tgl12'])."</td>";
                  echo "<td class='text-center'>".($row['total'])."</td>";
                  echo "</tr>";
                  $j++;
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-12">
          <p class="text-center">Copyright &copy; 2017  <a href="http://lampung.bps.go.id">BPS Provinsi Lampung</a></p>
        </div>
      </div>
    </div>
    <!-- Chart code -->
    <script>
      //let dataKabkota = [];
      let jsonData = <?php echo json_encode($rekap_kabkota_all);?>;

      let kabkota = [];
      let jumlah = [];
      for(x = 0; x < jsonData.length; x++){
        let label = jsonData[x].nama_kabkota;
        let y = jsonData[x].total_batch_entri;
        //dataKabkota.push({nama: label, jumlah:y});
        kabkota.push(label);
        jumlah.push(y);
      }

      let data = [{
        x: kabkota,
        y: jumlah,
        type: 'bar',
        name: 'Jumlah batch entri',
        marker: {
          color: 'rgb(49,130,189)',
          opacity: 0.7,
        }
      }];

      Plotly.newPlot('rekapEntriKabkota', data);

    </script>
  </body>
</html>
