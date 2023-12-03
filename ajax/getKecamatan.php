<?php
include '../config/helper.php';
include '../config/db.php';
$id_kab = $_POST['id_kab'];
$id_prop = $_POST['id_prop'];
$table = 'mst_kecamatan';
$params = array(
    'id_prop' => $id_prop,
    'id_kab' => $id_kab
);
$kecamatan = get($conn,$table,$params);
// Format dan kirim data sebagai pilihan dropdown
echo '<option value="semua">-- SEMUA KECAMATAN --</option>';
foreach($kecamatan as $k){
    echo '<option value="'. $k['id_kec'] .'">'. $k['kecamatan'] . '</option>';
}

?>
