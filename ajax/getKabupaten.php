<?php
include '../config/helper.php';
include '../config/db.php';
$id_prop = $_POST['id_prop'];
$table = 'mst_kabupaten';
$params = array(
    'id_prop' => $id_prop
);
$kabupaten = get($conn,$table,$params);
var_dump($kabupaten);
// Format dan kirim data sebagai pilihan dropdown
echo '<option value="semua">-- SEMUA KABUPATEN --</option>';
foreach($kabupaten as $k){
    echo '<option value="'. $k['id_kab'] .'">'. $k['kabupaten'] . '</option>';
}

?>
