<?php

  require_once('db.php');

  function operators($id){
    $result = query_graph("harian","SELECT waktu_terima, SUM(jml_dok_terima) as jml_dok_terima FROM entrian WHERE is_terima=1 AND operator_id='".$id."' GROUP BY waktu_terima");
    return json_encode($result);
  }

  if(isset($_GET['id'])){
    echo operators($_GET['id'] == '' ? '00' : $_GET['id']);
  }

?>
