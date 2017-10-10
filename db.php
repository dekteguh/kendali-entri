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
  }

  mysqli_free_result($r);
  mysqli_close($c);

  return $result;
}
