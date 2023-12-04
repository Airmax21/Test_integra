<?php
include '../config/helper.php';
include '../config/db.php';

$table = 'mst_penduduk';
if($_POST['penduduk_id'] != '' || $_POST['penduduk_id'] != null){
    update($conn,$table,$_POST,['penduduk_id' => $_POST['penduduk_id']]);
} else {
    insert($conn,$table,$_POST);
}