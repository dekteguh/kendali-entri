<?php

  // Query Entri

  $total_batch_sedang_entri = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_serah=1");

  $total_batch_sudah_entri = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_terima=1");

  $total_dok_sedang_entri = query_count("SELECT sum(jml_dok_serah) as total FROM entrian WHERE is_serah=1");

  $total_dok_sudah_entri = query_count("SELECT sum(jml_dok_terima) as total FROM entrian WHERE is_terima=1");

  $rekap_harian_entri = query_graph("harian","SELECT waktu_terima, SUM(jml_dok_terima) as jml_dok_terima FROM entrian WHERE is_terima=1 GROUP BY waktu_terima");

  $rekap_kabkota_entri = query_rows("kabkota", "SELECT w.nama as nama_kabkota, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM wilayah w LEFT JOIN entrian e ON w.id=e.kabkota_id  GROUP BY w.id ORDER BY w.id");

  $rekap_operator_entri = query_rows("operator","SELECT o.nama as nama_operator, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM operator o LEFT JOIN entrian e ON o.id=e.operator_id WHERE o.status='Mitra'  GROUP BY o.id ORDER BY o.id");

  $operators_entri = query_rows("o","SELECT * FROM operator WHERE status='Mitra'");


  // Query Validasi

  $total_batch_sedang_validasi = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_serah=1");

  $total_batch_sudah_validasi = query_count("SELECT COUNT(*) as total FROM entrian WHERE is_terima=1");

  $total_dok_sedang_validasi = query_count("SELECT sum(jml_dok_serah) as total FROM entrian WHERE is_serah=1");

  $total_dok_sudah_validasi = query_count("SELECT sum(jml_dok_terima) as total FROM entrian WHERE is_terima=1");

  $rekap_harian_validasi = query_graph("harian","SELECT waktu_terima, SUM(jml_dok_terima) as jml_dok_terima FROM validasi WHERE is_terima=1 GROUP BY waktu_terima");

  $rekap_kabkota_validasi = query_rows("kabkota", "SELECT w.nama as nama_kabkota, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM wilayah w LEFT JOIN validasi e ON w.id=e.kabkota_id  GROUP BY w.id ORDER BY w.id");

  $rekap_operator_validasi = query_rows("operator","SELECT o.nama as nama_operator, COUNT(CASE WHEN e.is_serah=1 THEN e.id END) as jml_batch_sedang_entri, SUM(CASE WHEN e.is_serah=1 THEN e.jml_dok_serah END) as jml_dok_sedang_entri, COUNT(CASE WHEN e.is_terima=1 THEN e.id END) as jml_batch_sudah_entri, SUM(CASE WHEN e.is_terima=1 THEN e.jml_dok_terima END) as jml_dok_sudah_entri, COUNT(e.id) as total_batch_entri, SUM(e.jml_dok_serah) as total_dok_entri FROM operator o LEFT JOIN validasi e ON o.id=e.operator_id WHERE o.status='Organik'  GROUP BY o.id ORDER BY o.id");

  $operators_validasi = query_rows("o","SELECT * FROM operator WHERE status='Organik'");

?>
