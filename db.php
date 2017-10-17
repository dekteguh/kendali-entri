<?php
/**
 * Short description for db.php
 *
 * @package db
 * @author Eko Teguh Widodo <dekteguh@gmail.com>
 * @version 0.1
 * @copyright (C) 2017 Eko Teguh Widodo <dekteguh@gmail.com>
 * @license MIT
 */

$host = "your_host";
$database = "your_db";
$username = "your_username";
$password = "your_pass";

function get_connection($h,$u,$p){
  // buat koneksi
  $c = mysqli_connect($h, $u, $p);

  // cek koneksi
  if(!$c){
    die("Connection's not successful: " . mysqli_connect_error());
    exit();
  }else{
    return $c;
  }
}

function close_connection($c){
  mysqli_close($c);
}

function query_count($query){
  $c = get_connection($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password']);
  mysqli_select_db($c, $GLOBALS['database']);

  $r = mysqli_query($c, $query);
  $count = mysqli_fetch_assoc($r);

  mysqli_free_result($r);
  mysqli_close($c);

  return $count['total'];
}

function query_graph($jenis, $query){
  $c = get_connection($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password']);
  mysqli_select_db($c, $GLOBALS['database']);
  $r = mysqli_query($c, $query);
  $result = [];
  if(mysqli_num_rows($r) > 0){
    if($jenis == "harian"){
      while($row = mysqli_fetch_assoc($r)){
        $arr['waktu_terima'] = $row['waktu_terima'];
        $arr['jml_dok_terima'] = $row['jml_dok_terima'];
        $result[] = $arr;
      }
    }
  }
  mysqli_free_result($r);
  mysqli_close($c);
  return $result;
}

function query_rows($jenis, $query){
  $c = get_connection($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password']);
  mysqli_select_db($c, $GLOBALS['database']);
  $r = mysqli_query($c, $query);
  $result = [];
  if(mysqli_num_rows($r) > 0){
    if($jenis == "operator"){
      while($row = mysqli_fetch_assoc($r)){
        $arr['nama_operator'] = $row['nama_operator'];
        $arr['jml_batch_sedang_entri'] = $row['jml_batch_sedang_entri'];
        $arr['jml_batch_sudah_entri'] = $row['jml_batch_sudah_entri'];
        $arr['jml_dok_sedang_entri'] = $row['jml_dok_sedang_entri'];
        $arr['jml_dok_sudah_entri'] = $row['jml_dok_sudah_entri'];
        $arr['total_batch_entri'] = $row['total_batch_entri'];
        $arr['total_dok_entri'] = $row['total_dok_entri'];
        $result[] = $arr;
      }
    }
    if($jenis == "kabkota"){
      while($row = mysqli_fetch_assoc($r)){
        $arr['nama_kabkota'] = $row['nama_kabkota'];
        $arr['jml_batch_sedang_entri'] = $row['jml_batch_sedang_entri'];
        $arr['jml_batch_sudah_entri'] = $row['jml_batch_sudah_entri'];
        $arr['jml_dok_sedang_entri'] = $row['jml_dok_sedang_entri'];
        $arr['jml_dok_sudah_entri'] = $row['jml_dok_sudah_entri'];
        $arr['total_batch_entri'] = $row['total_batch_entri'];
        $arr['total_dok_entri'] = $row['total_dok_entri'];
        $result[] = $arr;
      }
    }
    if($jenis == "hari"){
      while($row = mysqli_fetch_assoc($r)){
        $arr['nama_operator'] = $row['nama_operator'];
        $arr['tgl5'] = $row['tgl5'];
        $arr['tgl6'] = $row['tgl6'];
        $arr['tgl9'] = $row['tgl9'];
        $arr['tgl10'] = $row['tgl10'];
        $arr['tgl11'] = $row['tgl11'];
        $arr['tgl12'] = $row['tgl12'];
        $arr['total'] = $row['total'];
        $result[] = $arr;
      }
    }
    if($jenis == "o"){
      while($row = mysqli_fetch_assoc($r)){
        $arr['id'] = $row['id'];
        $arr['nama'] = $row['nama'];
        $arr['status'] = $row['status'];
        $result[] = $arr;
      }
    }
  }

  mysqli_free_result($r);
  mysqli_close($c);

  return $result;
}
