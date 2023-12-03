<?php
include 'variabel.php';
$conn = new mysqli($host,$username,$pass,$db);
if(!$conn) die("<script>alert('Gagal tersambung')</script>");
?>