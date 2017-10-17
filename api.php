<?php

  require_once('commons/db.php');

  function operators($id, $status){
    $result = [];
    if($status == 'Mitra'){
      $result = query_graph("harian","SELECT waktu_terima, SUM(jml_dok_terima) as jml_dok_terima FROM entrian WHERE is_terima=1 AND operator_id='".$id."' GROUP BY waktu_terima");
    }

    if($status == 'Organik'){
      $result = query_graph("harian","SELECT waktu_terima, SUM(jml_dok_terima) as jml_dok_terima FROM validasi WHERE is_terima=1 AND operator_id='".$id."' GROUP BY waktu_terima");
    }

    return json_encode($result);
  }

  if(isset($_GET['id']) && isset($_GET['status'])){
    echo operators($_GET['id'], $_GET['status']);
  }

?>
