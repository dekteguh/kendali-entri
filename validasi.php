<?php
/**
 * Short description for validasi.php
 *
 * @package validasi
 * @author Eko Teguh Widodo <dekteguh@gmail.com>
 * @version 0.1
 * @copyright (C) 2017 Eko Teguh Widodo <dekteguh@gmail.com>
 * @license MIT
 */

  include 'commons/db.php';
  include 'commons/util.php';
  include 'commons/query.php';
  require_once('api.php');
?>

<?php include 'partials/header.php'; ?>
  <body>
    <div class="container">
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url();?>">Entri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-danger" href="<?php echo base_url();?>validasi.php">Validasi</a>
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
        <b>VALIDASI</b> sampai dengan <?php echo date('d-M-Y');?>
      </div>
      <hr />
      <br />
      <div class="row">
        <div class="col-3">
          <div class="card text-white bg-danger">
            <div class="card-header">Batch sedang validasi</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_batch_sedang_validasi; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-warning">
            <div class="card-header">Batch sudah validasi</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_batch_sudah_validasi; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-success">
            <div class="card-header">Dokumen sedang validasi</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_dok_sedang_validasi; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-white bg-primary">
            <div class="card-header">Dokumen sudah validasi</div>
            <div class="card-body">
               <h4 class="text-center"><?php echo $total_dok_sudah_validasi; ?></h4>
            </div>
          </div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap validasi Per Kabupaten/Kota (Dokumen)</h3>
      <h6>Berdasarkan dokumen yang sudah dikembalikan ke pengawas pengolahan</h6>
      <div class="row">
        <div class="col-12">
          <div id="rekapValidasiKabkota"></div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Validasi Harian (Dokumen)</h3>
      <h6>Berdasarkan dokumen yang sudah dikembalikan ke pengawas pengolahan</h6>
      <div class="row">
        <div class="col-12">
          <div id="rekapValidasiHarian"></div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap Validasi Per Operator Per hari (Dokumen)</h3>
      <h6>Berdasarkan dokumen yang sudah dikembalikan ke pengawas pengolahan</h6>
      <br />
      <div class="row">
        <div class="col-12">
          <form>
            <div class="form-group">
              <label for="pilihOperatorValidasi">Pilih Operator untuk melihat progress Report Validasi</label>
              <select class="form-control col-6" id="pilihOperatorValidasi" name="pilihOperatorValidasi">
                <option value="00">- Pilih Operator -</option>
                <?php foreach ($operators_validasi as $list => $row) {
                  echo '<option value="'.$row['id'].'">'.$row['nama'].'</option>';
                }?>
              </select>
            </div>
          </form>
          <div id="rekap_harian_operator_validasi"></div>
        </div>
      </div>
      <br /><br />
      <h3>Rekap validasi Per Operator</h3>
      <h6>Sedang validasi => batch/dokumen masih di operator dalam masa validasi.</h6>
      <h6>Sudah validasi => batch/dokumen sudah divalidasi dan dikembalikan ke pengawas pengolahan.</h6>
      <br />
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-hover table-bordered">
            <tbody>
              <tr style="background-color: #A52238;color: white; font-weight: bold;">
                <td class="text-center">No.</td>
                <td class="text-center">Nama Operator</td>
                <td class="text-center">Batch sedang validasi</td>
                <td class="text-center">Dokumen sedang validasi</td>
                <td class="text-center">Batch sudah validasi</td>
                <td class="text-center">Dokumen sudah validasi</td>
                <td class="text-center">Jumlah Batch validasi</td>
                <td class="text-center">Jumlah Dokumen validasi</td>
              </tr>
              <?php
                $i = 0;
                $jml1 = 0;
                $jml2 = 0;
                $jml3 = 0;
                $jml4 = 0;
                $jml5 = 0;
                $jml6 = 0;
                foreach ($rekap_operator_validasi as $list => $row) {
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
                <td colspan="2">Total validasi</td>
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
      <hr />
      <?php include 'partials/footer.php';?>
    </div>
    <!-- Chart code -->
    <script>

      $('#pilihOperatorValidasi').change(function(e){
        e.preventDefault();
        let operator = $('#pilihOperatorValidasi').val();
        let tgl_operator = [];
        let nilai_operator = [];

        axios.get('<?php echo base_url();?>api.php/operators?id='+ operator + '&status=Organik').
            then(function(response){
              let operator_harians = response.data;
              for(y = 0; y < operator_harians.length; y++){
                tgl_operator.push(operator_harians[y].waktu_terima);
                nilai_operator.push(operator_harians[y].jml_dok_terima);
              }
              Plotly.newPlot('rekap_harian_operator_validasi', rekapData(tgl_operator,nilai_operator,'line','Jumlah Dokumen Validasi','rgb(49,130,189)',0.6));
            });
      });

      let kabkotas = <?php echo json_encode($rekap_kabkota_validasi);?>;
      let harians = <?php echo json_encode($rekap_harian_validasi);?>;

      let label_kabkota = [];
      let label_jumlah = [];
      for(x = 0; x < kabkotas.length; x++){
        label_kabkota.push(kabkotas[x].nama_kabkota);
        label_jumlah.push(kabkotas[x].total_dok_entri);
      }

      let label_tgl = [];
      let label_nilai = [];

      for(y = 0; y < harians.length; y++){
        label_tgl.push(harians[y].waktu_terima);
        label_nilai.push(harians[y].jml_dok_terima);
      }

      const rekapData = (x,y,type,title,color,opacity) => {
        return type=='bar' ? [{
          x: x,
          y: y,
          type: type,
          name: title,
          marker: {
            color: color,
            opacity: opacity
          }
        }]
        :
        [{
          x: x,
          y: y,
          type: type,
          name: title,
          mode: 'lines+markers',
          marker: {
            color: color,
            opacity: 1,
            size: 20
          },
          line: {
            color: 'rgb(100,23,122)',
            width: 5
          }
        }]
      }

      Plotly.newPlot('rekapValidasiKabkota', rekapData(label_kabkota,label_jumlah,'bar','Jumlah Dokumen Validasi','rgb(49,130,189)',0.6));
      Plotly.newPlot('rekapValidasiHarian', rekapData(label_tgl,label_nilai,'line','Jumlah Dokumen Validasi','rgb(49,130,189)',0.6));
    </script>
  </body>
</html>
