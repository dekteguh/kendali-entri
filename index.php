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
  include 'util.php';

  $total_batch_sedang_entri = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_serah=1");
  $total_batch_sudah_entri = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_terima=1");
  $total_dok_sedang_entri = query_count("SELECT sum(jml_dok_serah) as total FROM entrian WHERE is_serah=1");
  $total_dok_sudah_entri = query_count("SELECT sum(jml_dok_terima) as total FROM entrian WHERE is_terima=1");

  $rekap_kabkota_all = query_rows("kabkota", "SELECT w.nama as nama_kabkota, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM wilayah w LEFT JOIN entrian e ON w.id=e.kabkota_id  GROUP BY w.id ORDER BY w.id");

  $rekap_operator_all = query_rows("operator","SELECT o.nama as nama_operator, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM operator o LEFT JOIN entrian e ON o.id=e.operator_id WHERE o.status='Mitra'  GROUP BY o.id ORDER BY o.id");

  $rekap_operator_perhari = query_rows("hari", "SELECT o.nama as nama_operator, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-05' THEN e.jml_dok_terima END),0) as tgl5, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-06' THEN e.jml_dok_terima END),0) as tgl6, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-09' THEN e.jml_dok_terima END),0) as tgl9, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-10' THEN e.jml_dok_terima END),0) as tgl10, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-11' THEN e.jml_dok_terima END),0) as tgl11, IFNULL(SUM(CASE WHEN e.waktu_terima='2017-10-12' THEN e.jml_dok_terima END),0) as tgl12, IFNULL(SUM(e.jml_dok_terima),0) as total FROM operator o LEFT JOIN entrian e ON o.id=e.operator_id WHERE o.status='Mitra' AND e.is_terima=1 GROUP BY o.id ORDER BY o.id");
?>

<?php include 'partials/header.php'; ?>
  <body>
    <div class="container">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link btn btn-danger" href="<?php echo base_url();?>">Entri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>validasi.php">Validasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>about.php">Tentang Kendali Pengolahan</a>
        </li>
      </ul>
      <br />
      <div class="alert alert-danger" role="alert">
        <h3 class="text-center">Progress Report Kendali Pengolahan SE2016 UMK dan UMB</h3>
      </div>
      <div class="navbar-text">
        <b>ENTRI</b> sampai dengan <?php echo date('d-M-Y');?>
      </div>
      <hr />
      <br />
      <div class="row">
        <div class="col-3">
          <div class="card text-white bg-danger">
            <div class="card-header">Batch sedang entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_batch_sedang_entri; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-warning">
            <div class="card-header">Batch sudah entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_batch_sudah_entri; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-success">
            <div class="card-header">Dokumen sedang entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_dok_sedang_entri; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-primary">
            <div class="card-header">Dokumen sudah entri</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_dok_sudah_entri; ?></h4>
            </div>
          </div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Entri Per Kabupaten/Kota (Batch)</h3>
      <h6>Berdasarkan batch yang sudah dikembalikan ke pengawas pengolahan</h6>
      <div class="row">
        <div class="col-12">
          <div id="rekapEntriKabkota"></div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Entri Per Operator</h3>
      <h6>Sedang entri => batch/dokumen masih di operator dalam masa entri.</h6>
      <h6>Sudah entri => batch/dokumen sudah dientri dan dikembalikan ke pengawas pengolahan, siap validasi.</h6>
      <br />
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-hover table-bordered">
            <tbody>
              <tr style="background-color: #A52238;color: white; font-weight: bold;">
                <td class="text-center">No.</td>
                <td class="text-center">Nama Operator</td>
                <td class="text-center">Batch sedang Entri</td>
                <td class="text-center">Dokumen sedang Entri</td>
                <td class="text-center">Batch sudah Entri</td>
                <td class="text-center">Dokumen sudah Entri</td>
                <td class="text-center">Jumlah Batch Entri</td>
                <td class="text-center">Jumlah Dokumen Entri</td>
              </tr>
              <?php
                $i = 0;
                $jml1 = 0;
                $jml2 = 0;
                $jml3 = 0;
                $jml4 = 0;
                $jml5 = 0;
                $jml6 = 0;
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
                  $jml1+=$row['jml_batch_sedang_entri'];
                  $jml2+=$row['jml_dok_sedang_entri'];
                  $jml3+=$row['jml_batch_sudah_entri'];
                  $jml4+=$row['jml_dok_sudah_entri'];
                  $jml5+=$row['total_batch_entri'];
                  $jml6+=$row['total_dok_entri'];
                }
              ?>
              <tr style="background-color: #A52238; color: white; font-weight: bold;">
                <td colspan="2">Total Entri</td>
                <td class="text-center"><?php echo $jml1;?></td>
                <td class="text-center"><?php echo $jml2;?></td>
                <td class="text-center"><?php echo $jml3;?></td>
                <td class="text-center"><?php echo $jml4;?></td>
                <td class="text-center"><?php echo $jml5;?></td>
                <td class="text-center"><?php echo $jml6;?></td>
              </tr>
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
                <td rowspan="2" class="text-center">Jumlah Entri per Orang</td>
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
                $tgl5 = 0;
                $tgl6 = 0;
                $tgl9 = 0;
                $tgl10 = 0;
                $tgl11 = 0;
                $tgl12 = 0;
                $tgltotal = 0;
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
                  $tgl5+=$row['tgl5'];
                  $tgl6+=$row['tgl6'];
                  $tgl9+=$row['tgl9'];
                  $tgl10+=$row['tgl10'];
                  $tgl11+=$row['tgl11'];
                  $tgl12+=$row['tgl12'];
                  $tgltotal+=$row['total'];
                  $j++;
                }
              ?>
              <tr style="background-color: #A52238; color: white; font-weight: bold;">
                <td colspan="2">Total Entri Per Hari</td>
                <td class="text-center"><?php echo $tgl5;?></td>
                <td class="text-center"><?php echo $tgl6;?></td>
                <td class="text-center"><?php echo $tgl9;?></td>
                <td class="text-center"><?php echo $tgl10;?></td>
                <td class="text-center"><?php echo $tgl11;?></td>
                <td class="text-center"><?php echo $tgl12;?></td>
                <td class="text-center"><?php echo $tgltotal;?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr />
      <?php include 'partials/footer.php';?>
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
