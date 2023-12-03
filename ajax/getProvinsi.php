<?php
include '../config/helper.php';
include '../config/db.php';
$table = 'mst_provinsi';
$provinsi = get($conn,$table);
echo '<option value="semua">-- SEMUA PROVINSI --</option>';
foreach($provinsi as $p){
    echo '<option value="'. $p['id_prop'] .'">'. $p['propinsi'] . '</option>';
}
?>
