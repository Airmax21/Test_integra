<?php
include '../config/helper.php';
include '../config/db.php';
session_set_cookie_params(360, '/', '.search.integra', false, true);
session_start();
$_SESSION = $_POST;
var_dump($_SESSION);