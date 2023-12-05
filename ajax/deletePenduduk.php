<?php
include '../config/helper.php';
include '../config/db.php';

$table = 'mst_penduduk';
if($_POST['penduduk_id'] != '' || $_POST['penduduk_id'] != null){
    update($conn,$table,['is_deleted' => '1'],['penduduk_id' => $_POST['penduduk_id']]);
}